<?php

namespace App\Service;

use App\Entity\Channel;
use App\Entity\MediaList;
use App\Entity\Playlist;
use App\Repository\MediaListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;

class MediaListManagerService
{
    private CommandManagerService $commandManager;
    private MediaListRepository $mediaListRepository;
    private string $channelThing = '@';
    private EntityManagerInterface $entityManager;

    public function __construct(
        CommandManagerService $commandManager,
        MediaListRepository $mediaListRepository,
        EntityManagerInterface $entityManager)
    {
        $this->commandManager = $commandManager;
        $this->mediaListRepository = $mediaListRepository;
        $this->entityManager = $entityManager;
    }
    public function scan(string $url)
    {
        $results = $this->commandManager->scan($url);
        $data = $this->isScanOK($results);

        if($data){
            $newMedialist = null;
            // Déterminer s'il s'agit d'une chaine ou d'une playlist
            if(str_starts_with($data->id . PHP_EOL, $this->channelThing)){
                $newMedialist = new Channel();
                $newMedialist->setYoutubeId($data->channel_id);
                $newMedialist->setTitle($data->channel);
                $newMedialist->setChannelFollowerCount($data->channel_follower_count);
                $tags = "";
                foreach($data->tags as $tag){
                    $tags .= $tag . ",";
                }
                $tags = substr($tags, 0, strlen($tags) - 1);

                $newMedialist->setTags($tags);
            } else {
                $newMedialist = new Playlist();
                $newMedialist->setYoutubeId($data->id);
                $newMedialist->setTitle($data->title);
                $newMedialist->setViewCount($data->view_count);
            }

            $medialist = $this->mediaListRepository->findBy(['youtubeId' => $newMedialist->getYoutubeId()]);

            if(!$medialist){
                // Mettre ici toutes les propriétés dans l'objet $newMediaList
                $this->persist($newMedialist);
                dd("L'entité n'existe pas dans la bdd");
            } else {
                dd("L'entité existe dans la bdd");
            }

            return $medialist;
        }else{
            return "NO";
        }

    }

    public function isExist()
    {

    }


    public function isScanOK(string $results)
    {
        $data = json_decode($results);
        if(json_last_error() === JSON_ERROR_NONE){
            return $data;
        }else {
            return false;
        }
    }

    public function persist(MediaList $playlist)
    {
        $this->entityManager->persist($playlist);
        $this->entityManager->flush();
    }

    public function persistChannel(Playlist $channel)
    {
        $this->entityManager->persist($channel);
        $this->entityManager->flush();
    }

}
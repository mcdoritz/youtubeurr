<?php

namespace App\Service;

use Symfony\Component\Process\Process;

class CommandManagerService
{
    private string $channelURL = 'https://www.youtube.com/';
    private string $channelThing = '@';
    private string $playlistURL = 'https://www.youtube.com/playlist?list=';
    private string $youtubeWatchURL = 'watch?v=';

    public function scan(string $id)
    {
        $id = $this->checkId($id);
        $command = [
            'yt-dlp',
            '--flat-playlist',
            '-J',
            $id
        ];

        $output = $this->execute($command);
        return $output;
    }

    /*
     * Méthode qui permet de remettre bien propre l'id entrée :
     *
     * Si une chaine : https://www.youtube.com/@Gurky
     * Si une playlist : PLoCjUSEhA7BFGB_kGCixe-Mhtf_w7HM2S
     *
     */
    public function checkId(string $id)
    {

        if(str_contains($id, $this->channelThing)){
            if(str_contains($id, $this->channelURL)){
                return $id;
            } else {
                return $this->channelURL . substr($id, strpos($id, $this->channelThing));
            }
        } else if(str_contains($id, $this->playlistURL)){
                $startPosition = strpos($id, $this->playlistURL) + strlen($this->playlistURL);
                return substr($id, $startPosition);
            } else {
                return $id;
            }
    }

    /*
     * Retourne le(s) resultat(s) de la commande, ou de l'erreur
     */
    public function execute(array $command)
    {
        $process = new Process($command);
        $process->run();
        $output = $process->getOutput();

        $trimedOutput = $this->trimOutput($output, "\n");
        if($trimedOutput == 'null') {
            return $this->trimOutput($process->getErrorOutput(), "\n");
        } else {
            return $trimedOutput;
        }
    }

    /*
     * Retourne les résultats propres, en fonction d'un séparateur spécifié
     * Si plus d'un résultat, sous forme de tableau, sinon sous la forme d'un seul résultat
     */
    public function trimOutput(string $output, string $separator)
    {
        $trimedOutput = [];
        if($separator != "none"){
            $trimedOutput = explode($separator, trim($output));
        } else {
            $trimedOutput = [trim($output)];
        }

        if(count($trimedOutput) > 1) {
            return $trimedOutput;
        } else {
            return $trimedOutput[0];
        }
    }

    /*
     * Méthode qui vérifie si l'output est en fait un json
     */
    function isJson(string $output): bool
    {
        // Tenter de décoder la chaîne JSON
        json_decode($output);
        // Vérifier s'il y a des erreurs lors du décodage
        return json_last_error() === JSON_ERROR_NONE;
    }
}
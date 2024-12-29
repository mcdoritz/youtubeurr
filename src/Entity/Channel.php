<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Channel extends MediaList
{

    #[ORM\Column(nullable: true)]
    private ?int $channelFollowerCount = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $tags = null;

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(?string $tags): static
    {
        $this->tags = $tags;

        return $this;
    }

    public function getChannelFollowerCount(): ?int
    {
        return $this->channelFollowerCount;
    }

    public function setChannelFollowerCount(?int $channelFollowerCount): static
    {
        $this->channelFollowerCount = $channelFollowerCount;

        return $this;
    }


}
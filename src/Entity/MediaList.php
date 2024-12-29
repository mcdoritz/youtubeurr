<?php

namespace App\Entity;

use App\Repository\MediaListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaListRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["media_list" => MediaList::class, "playlist" => Playlist::class, "channel" => Channel::class])]
class MediaList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $availability = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $modifiedAt = null;

    #[ORM\Column(nullable: true)]
    private ?int $mediaCount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $channel = null;

    #[ORM\Column(nullable: true)]
    private ?int $channelId = null;

    #[ORM\Column(nullable: true)]
    private ?int $uploaderId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $uploader = null;

    #[ORM\Column(length: 255)]
    private ?string $youtubeId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(?string $availability): static
    {
        $this->availability = $availability;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeImmutable $modifiedAt): static
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function getMediaCount(): ?int
    {
        return $this->mediaCount;
    }

    public function setMediaCount(?int $mediaCount): static
    {
        $this->mediaCount = $mediaCount;

        return $this;
    }

    public function getChannel(): ?string
    {
        return $this->channel;
    }

    public function setChannel(?string $channel): static
    {
        $this->channel = $channel;

        return $this;
    }

    public function getChannelId(): ?int
    {
        return $this->channelId;
    }

    public function setChannelId(?int $channelId): static
    {
        $this->channelId = $channelId;

        return $this;
    }

    public function getUploaderId(): ?int
    {
        return $this->uploaderId;
    }

    public function setUploaderId(?int $uploaderId): static
    {
        $this->uploaderId = $uploaderId;

        return $this;
    }

    public function getUploader(): ?string
    {
        return $this->uploader;
    }

    public function setUploader(?string $uploader): static
    {
        $this->uploader = $uploader;

        return $this;
    }

    public function getYoutubeId(): ?string
    {
        return $this->youtubeId;
    }

    public function setYoutubeId(string $youtubeId): static
    {
        $this->youtubeId = $youtubeId;

        return $this;
    }
}

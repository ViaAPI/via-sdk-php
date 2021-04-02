<?php


namespace ViaAPI\ViaSdkPhp\Services\Trivia\Collections;


use ViaAPI\ViaSdkPhp\Contracts\CollectionInterface;

class Label implements CollectionInterface
{
    /** @var string */
    private $text;

    /** @var string|null */
    private $audio = null;

    /** @var string|null */
    private $image = null;

    /** @var string|null */
    private $video = null;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return Label
     */
    public function setText(string $text): Label
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAudio(): ?string
    {
        return $this->audio;
    }

    /**
     * @param string|null $audio
     *
     * @return Label
     */
    public function setAudio(?string $audio): Label
    {
        $this->audio = $audio;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     *
     * @return Label
     */
    public function setImage(?string $image): Label
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getVideo(): ?string
    {
        return $this->video;
    }

    /**
     * @param string|null $video
     *
     * @return Label
     */
    public function setVideo(?string $video): Label
    {
        $this->video = $video;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'text' => $this->getText(),
            'image' => $this->getImage(),
            'audio' => $this->getAudio(),
            'video' => $this->getVideo()
        ];
    }

}
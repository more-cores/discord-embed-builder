<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Embed;

class Message extends Jsonable
{
    /** @var string */
    private $content = '';

    /** @var Embed */
    private $embed;

    public function __construct(array $attributes = null)
    {
        if (isset($attributes['content'])) {
            $this->setContent($attributes['content']);
        }

        if (isset($attributes['embed'])) {
            if ($attributes['embed'] instanceof Embed) {
                $this->setEmbed($attributes['embed']);
            } else {
                $this->setEmbed(new Embed($attributes['embed']));
            }
        }
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function content() : string
    {
        return $this->content;
    }

    public function setEmbed(Embed $embed)
    {
        $this->embed = $embed;
    }

    public function embed() : Embed
    {
        return $this->embed;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'content' => $this->content(),
        ];

        if ($this->embed != null) {
            $jsonData['embed'] = $this->embed->jsonSerialize();
        }

        return $jsonData;
    }
}

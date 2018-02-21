<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Embed;

class WebhookMessage extends Jsonable
{
    /** @var string */
    private $content = '';

    /** @var Embed[] */
    private $embeds = [];

    public function __construct(array $attributes = null)
    {
        if (isset($attributes['content'])) {
            $this->setContent($attributes['content']);
        }

        if (isset($attributes['embeds'])) {
            foreach ($attributes['embeds'] as $embed) {
                if ($embed instanceof Embed) {
                    $this->addEmbed($embed);
                } else {
                    $this->addEmbed(new Embed($embed));
                }
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

    public function addEmbed(Embed $embed)
    {
        $this->embeds[] = $embed;
    }

    public function embeds() : array
    {
        return $this->embeds;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'content' => $this->content(),
        ];

        if (count($this->embeds) > 0) {
            $jsonData['embeds'] = [];

            foreach ($this->embeds as $embed) {
                $jsonData['embeds'][] = $embed->jsonSerialize();
            }
        }

        return $jsonData;
    }
}

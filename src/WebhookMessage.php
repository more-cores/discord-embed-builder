<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Embed;

class WebhookMessage extends Jsonable
{
    /** @var string */
    protected $content;

    /** @var Embed[] */
    protected $embeds;

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
        return (string) $this->content;
    }

    public function hasContent() : bool
    {
        return $this->content != null;
    }

    public function addEmbed(Embed $embed)
    {
        $this->embeds[] = $embed;
    }

    public function setEmbeds(array $embeds)
    {
        $this->embeds[] = $embeds;
    }

    public function embeds() : array
    {
        return (array) $this->embeds;
    }

    public function hasEmbeds() : bool
    {
        return $this->embeds != null;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'content' => $this->content(),
        ];

        if ($this->embeds != null && count($this->embeds) > 0) {
            $jsonData['embeds'] = [];

            foreach ($this->embeds as $embed) {
                $jsonData['embeds'][] = $embed->jsonSerialize();
            }
        }

        return $jsonData;
    }
}

<?php

namespace DiscordEmbedBuilder\Embed;

use DiscordEmbedBuilder\Jsonable;

class Provider extends Jsonable
{
    /** @var string */
    protected $name = '';

    /** @var string */
    protected $url;

    public function __construct(string $name = null, string $url = null)
    {
        if ($name != null) {
            $this->setName($name);
        }

        if ($url != null) {
            $this->setUrl($url);
        }
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'name' => $this->name()
        ];

        if ($this->url != null) {
            $jsonData['url'] = $this->url();
        }

        return $jsonData;
    }
}

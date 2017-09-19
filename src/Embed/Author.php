<?php

namespace DiscordEmbedBuilder\Embed;

use DiscordEmbedBuilder\Jsonable;

class Author extends Jsonable
{
    /** @var string */
    protected $name = '';

    /** @var string */
    protected $url;

    /** @var string */
    protected $iconUrl;

    /** @var string */
    protected $proxyIconUrl;

    public function __construct(string $name = null, string $url = null, string $iconUrl = null)
    {
        if ($name != null) {
            $this->setName($name);
        }

        if ($url != null) {
            $this->setUrl($url);
        }

        if ($iconUrl != null) {
            $this->setIconUrl($iconUrl);
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

    public function setIconUrl(string $iconUrl)
    {
        $this->iconUrl = $iconUrl;
    }

    public function iconUrl() : string
    {
        return $this->iconUrl;
    }

    public function setProxyIconUrl(string $proxyIconUrl)
    {
        $this->proxyIconUrl = $proxyIconUrl;
    }

    public function proxyIconUrl() : string
    {
        return $this->proxyIconUrl;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'name' => $this->name()
        ];

        if ($this->url != null) {
            $jsonData['url'] = $this->url();
        }

        if ($this->iconUrl != null) {
            $jsonData['icon_url'] = $this->iconUrl();
        }

        if ($this->proxyIconUrl != null) {
            $jsonData['proxy_icon_url'] = $this->proxyIconUrl();
        }

        return $jsonData;
    }
}

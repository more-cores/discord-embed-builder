<?php

namespace DiscordMessageBuilder\Embed;

use DiscordMessageBuilder\Jsonable;

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

    public function __construct(array $attributes = null)
    {
        if (isset($attributes['name'])) {
            $this->setName($attributes['name']);
        }

        if (isset($attributes['url'])) {
            $this->setUrl($attributes['url']);
        }

        if (isset($attributes['icon_url'])) {
            $this->setIconUrl($attributes['icon_url']);
        }

        if (isset($attributes['proxy_icon_url'])) {
            $this->setProxyIconUrl($attributes['proxy_icon_url']);
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
            'name' => $this->name(),
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

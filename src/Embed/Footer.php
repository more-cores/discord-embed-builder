<?php

namespace DiscordMessageBuilder\Embed;

use DiscordMessageBuilder\Jsonable;

class Footer extends Jsonable
{
    /** @var string */
    protected $text = '';

    /** @var string */
    protected $iconUrl;

    /** @var string */
    protected $proxyIconUrl;

    public function __construct(array $attributes = null)
    {
        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['icon_url'])) {
            $this->setIconUrl($attributes['icon_url']);
        }

        if (isset($attributes['proxy_icon_url'])) {
            $this->setProxyIconUrl($attributes['proxy_icon_url']);
        }
    }

    public function setText(string $text)
    {
        $this->text = $text;
    }

    public function text() : string
    {
        return $this->text;
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
            'text' => $this->text(),
        ];

        if ($this->iconUrl != null) {
            $jsonData['icon_url'] = $this->iconUrl();
        }

        if ($this->proxyIconUrl != null) {
            $jsonData['proxy_icon_url'] = $this->proxyIconUrl();
        }

        return $jsonData;
    }
}

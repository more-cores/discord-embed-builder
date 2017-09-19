<?php

namespace DiscordEmbedBuilder\Embed;

use DiscordEmbedBuilder\Jsonable;

class Footer extends Jsonable
{
    /** @var string */
    protected $text = '';

    /** @var string */
    protected $iconUrl;

    /** @var string */
    protected $proxyIconUrl;

    public function __construct(string $text = null, string $iconUrl = null)
    {
        if ($text != null) {
            $this->setText($text);
        }

        if ($iconUrl != null) {
            $this->setIconUrl($iconUrl);
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
            'text' => $this->text()
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

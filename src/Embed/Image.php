<?php

namespace DiscordMessageBuilder\Embed;

use DiscordMessageBuilder\Jsonable;

class Image extends Jsonable
{
    /** @var string */
    protected $url = '';

    /** @var string */
    protected $proxyUrl;

    /** @var int */
    protected $height;

    /** @var int */
    protected $width;

    public function __construct(string $url = null, int $width = null, int $height = null)
    {
        if ($url != null) {
            $this->setUrl($url);
        }

        if ($width != null) {
            $this->setWidth($width);
        }

        if ($height != null) {
            $this->setHeight($height);
        }
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function setProxyUrl(string $proxyUrl)
    {
        $this->proxyUrl = $proxyUrl;
    }

    public function proxyUrl() : string
    {
        return $this->proxyUrl;
    }

    public function setHeight(int $height)
    {
        $this->height = $height;
    }

    public function height() : int
    {
        return $this->height;
    }

    public function setWidth(int $width)
    {
        $this->width = $width;
    }

    public function width() : int
    {
        return $this->width;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'url' => $this->url(),
        ];

        if ($this->proxyUrl != null) {
            $jsonData['proxy_url'] = $this->proxyUrl();
        }

        if ($this->height != null) {
            $jsonData['height'] = $this->height();
        }

        if ($this->width != null) {
            $jsonData['width'] = $this->width();
        }

        return $jsonData;
    }
}

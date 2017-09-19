<?php

namespace DiscordEmbedBuilder;

use DiscordEmbedBuilder\Embed\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    /** @var Image */
    protected $image;

    public function setUp()
    {
        parent::setUp();

        $this->image = new Image();
    }

    /** @test */
    public function canBeConstructedWithParams()
    {
        $url = uniqid();
        $width = rand(1, 4000);
        $height = rand(4001, 8000);

        $image = new Image($url, $width, $height);

        $this->assertEquals($url, $image->url());
        $this->assertEquals($width, $image->width());
        $this->assertEquals($height, $image->height());
    }

    /** @test */
    public function canProvideUrl()
    {
        $this->assertEquals('', $this->image->url());

        $this->image->setUrl($url = uniqid());

        $this->assertEquals($url, $this->image->url());

        $this->assertArrayHasKey('url', $this->image->jsonSerialize());
        $this->assertEquals($url, $this->image->jsonSerialize()['url']);
    }

    /** @test */
    public function canProvideProxyUrl()
    {
        $this->image->setProxyUrl($proxyUrl = uniqid());

        $this->assertEquals($proxyUrl, $this->image->proxyUrl());

        $this->assertArrayHasKey('proxy_url', $this->image->jsonSerialize());
        $this->assertEquals($proxyUrl, $this->image->jsonSerialize()['proxy_url']);
    }

    /** @test */
    public function canProvideHeight()
    {
        $this->image->setHeight($height = time());

        $this->assertEquals($height, $this->image->height());

        $this->assertArrayHasKey('height', $this->image->jsonSerialize());
        $this->assertEquals($height, $this->image->jsonSerialize()['height']);
    }

    /** @test */
    public function canProvideWidth()
    {
        $this->image->setWidth($width = time());

        $this->assertEquals($width, $this->image->width());

        $this->assertArrayHasKey('width', $this->image->jsonSerialize());
        $this->assertEquals($width, $this->image->jsonSerialize()['width']);
    }
}

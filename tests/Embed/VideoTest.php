<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Video;
use PHPUnit\Framework\TestCase;

class VideoTest extends TestCase
{
    /** @var Video */
    protected $video;

    public function setUp()
    {
        parent::setUp();

        $this->video = new Video();
    }

    /** @test */
    public function canBeConstructedWithParams()
    {
        $url = uniqid();
        $width = rand(1, 4000);
        $height = rand(4001, 8000);

        $video = new Video($url, $width, $height);

        $this->assertEquals($url, $video->url());
        $this->assertEquals($width, $video->width());
        $this->assertEquals($height, $video->height());
    }

    /** @test */
    public function canProvideUrl()
    {
        $this->assertEquals('', $this->video->url());

        $this->video->setUrl($url = uniqid());

        $this->assertEquals($url, $this->video->url());

        $this->assertArrayHasKey('url', $this->video->jsonSerialize());
        $this->assertEquals($url, $this->video->jsonSerialize()['url']);
    }

    /** @test */
    public function canProvideHeight()
    {
        $this->video->setHeight($height = time());

        $this->assertEquals($height, $this->video->height());

        $this->assertArrayHasKey('height', $this->video->jsonSerialize());
        $this->assertEquals($height, $this->video->jsonSerialize()['height']);
    }

    /** @test */
    public function canProvideWidth()
    {
        $this->video->setWidth($width = time());

        $this->assertEquals($width, $this->video->width());

        $this->assertArrayHasKey('width', $this->video->jsonSerialize());
        $this->assertEquals($width, $this->video->jsonSerialize()['width']);
    }
}
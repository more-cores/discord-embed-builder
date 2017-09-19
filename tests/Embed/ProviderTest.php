<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Provider;
use PHPUnit\Framework\TestCase;

class ProviderTest extends TestCase
{
    /** @var Provider */
    protected $author;

    public function setUp()
    {
        parent::setUp();

        $this->author = new Provider();
    }

    /** @test */
    public function canBeConstructedWithParams()
    {
        $name = uniqid();
        $url = uniqid();

        $author = new Provider($name, $url);

        $this->assertEquals($name, $author->name());
        $this->assertEquals($url, $author->url());
    }

    /** @test */
    public function canProvideName()
    {
        $this->assertEquals('', $this->author->name());

        $this->author->setName($name = uniqid());

        $this->assertEquals($name, $this->author->name());

        $this->assertArrayHasKey('name', $this->author->jsonSerialize());
        $this->assertEquals($name, $this->author->jsonSerialize()['name']);
    }

    /** @test */
    public function canProvideUrl()
    {
        $this->author->setUrl($url = uniqid());

        $this->assertEquals($url, $this->author->url());

        $this->assertArrayHasKey('url', $this->author->jsonSerialize());
        $this->assertEquals($url, $this->author->jsonSerialize()['url']);
    }
}
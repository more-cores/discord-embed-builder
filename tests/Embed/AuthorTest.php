<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Author;
use PHPUnit\Framework\TestCase;

class AuthorTest extends TestCase
{
    /** @var Author */
    protected $author;

    public function setUp()
    {
        parent::setUp();

        $this->author = new Author();
    }

    /** @test */
    public function canBeConstructedWithParams()
    {
        $name = uniqid();
        $url = uniqid();
        $iconUrl = uniqid();

        $author = new Author($name, $url, $iconUrl);

        $this->assertEquals($name, $author->name());
        $this->assertEquals($url, $author->url());
        $this->assertEquals($iconUrl, $author->iconUrl());
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

    /** @test */
    public function canProvideIconUrl()
    {
        $this->author->setIconUrl($iconUrl = uniqid());

        $this->assertEquals($iconUrl, $this->author->iconUrl());

        $this->assertArrayHasKey('icon_url', $this->author->jsonSerialize());
        $this->assertEquals($iconUrl, $this->author->jsonSerialize()['icon_url']);
    }

    /** @test */
    public function canProvideProxyIconUrl()
    {
        $this->author->setProxyIconUrl($proxyIconUrl = uniqid());

        $this->assertEquals($proxyIconUrl, $this->author->proxyIconUrl());

        $this->assertArrayHasKey('proxy_icon_url', $this->author->jsonSerialize());
        $this->assertEquals($proxyIconUrl, $this->author->jsonSerialize()['proxy_icon_url']);
    }
}

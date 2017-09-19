<?php

namespace DiscordEmbedBuilder;

use DiscordEmbedBuilder\Embed\Footer;
use PHPUnit\Framework\TestCase;

class FooterTest extends TestCase
{
    /** @var Footer */
    protected $footer;

    public function setUp()
    {
        parent::setUp();

        $this->footer = new Footer();
    }

    /** @test */
    public function canBeConstructedWithParams()
    {
        $text = uniqid();
        $iconUrl = uniqid();

        $footer = new Footer($text, $iconUrl);

        $this->assertEquals($text, $footer->text());
        $this->assertEquals($iconUrl, $footer->iconUrl());
    }

    /** @test */
    public function canProvideUrl()
    {
        $this->footer->setIconUrl($iconUrl = uniqid());

        $this->assertEquals($iconUrl, $this->footer->iconUrl());

        $this->assertArrayHasKey('icon_url', $this->footer->jsonSerialize());
        $this->assertEquals($iconUrl, $this->footer->jsonSerialize()['icon_url']);
    }

    /** @test */
    public function canProvideProxyIconUrl()
    {
        $this->footer->setProxyIconUrl($proxyIconUrl = uniqid());

        $this->assertEquals($proxyIconUrl, $this->footer->proxyIconUrl());

        $this->assertArrayHasKey('proxy_icon_url', $this->footer->jsonSerialize());
        $this->assertEquals($proxyIconUrl, $this->footer->jsonSerialize()['proxy_icon_url']);
    }
}

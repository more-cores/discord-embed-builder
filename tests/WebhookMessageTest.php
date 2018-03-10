<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Embed;
use PHPUnit\Framework\TestCase;

class WebhookMessageTest extends TestCase
{
    /** @var WebhookMessage */
    protected $message;

    public function setUp()
    {
        parent::setUp();

        $this->message = new WebhookMessage();
        $this->message->setContent('');
    }

    /** @test */
    public function canProvideContent()
    {
        $this->message->setContent($content = uniqid());

        $this->assertEquals($content, $this->message->content());

        $this->assertArrayHasKey('content', $this->message->jsonSerialize());
        $this->assertEquals($content, $this->message->jsonSerialize()['content']);
    }

    /** @test */
    public function canAddMultipleEmbeds()
    {
        $this->assertCount(0, $this->message->embeds());

        $firstEmbed = new Embed([
            'title' => $firstEmbedName = uniqid(),
        ]);
        $this->message->addEmbed($firstEmbed);

        $this->assertCount(1, $this->message->embeds());

        $secondEmbed = new Embed([
            'title' => $secondEmbedName = uniqid(),
        ]);
        $this->message->addEmbed($secondEmbed);

        $this->assertCount(2, $this->message->embeds());

        $this->assertArrayHasKey('embeds', $this->message->jsonSerialize());
        $this->assertEquals($firstEmbedName, $this->message->jsonSerialize()['embeds'][0]['title']);
        $this->assertEquals($secondEmbedName, $this->message->jsonSerialize()['embeds'][1]['title']);
    }

    /** @test */
    public function canSetEmbeds()
    {
        $this->assertCount(0, $this->message->embeds());

        $this->message->setEmbeds([
            new Embed()
        ]);

        $this->assertCount(1, $this->message->embeds());
    }
}

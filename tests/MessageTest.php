<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Embed;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /** @var Message */
    protected $message;

    public function setUp()
    {
        parent::setUp();

        $this->message = new Message();
    }

    /** @test */
    public function canProvideContent()
    {
        $this->assertFalse($this->message->hasContent());
        $this->message->setContent($content = uniqid());

        $this->assertTrue($this->message->hasContent());
        $this->assertEquals($content, $this->message->content());

        $this->assertArrayHasKey('content', $this->message->jsonSerialize());
        $this->assertEquals($content, $this->message->jsonSerialize()['content']);
    }

    /** @test */
    public function canAddMultipleEmbeds()
    {
        $this->assertFalse($this->message->hasEmbed());
        $firstEmbed = new Embed([
            'title' => $firstEmbedName = uniqid(),
        ]);
        $this->message->setEmbed($firstEmbed);

        $this->assertTrue($this->message->hasEmbed());
        $this->assertArrayHasKey('embed', $this->message->jsonSerialize());
        $this->assertEquals($firstEmbedName, $this->message->jsonSerialize()['embed']['title']);
    }
}

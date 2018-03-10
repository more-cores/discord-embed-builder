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
        $firstEmbed = new Embed([
            'title' => $firstEmbedName = uniqid(),
        ]);
        $this->message->setEmbed($firstEmbed);

        $this->assertArrayHasKey('embed', $this->message->jsonSerialize());
        $this->assertEquals($firstEmbedName, $this->message->jsonSerialize()['embed']['title']);
    }
}

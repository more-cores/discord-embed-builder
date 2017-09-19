<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Author;
use DiscordMessageBuilder\Embed\Field;
use DiscordMessageBuilder\Embed\Footer;
use DiscordMessageBuilder\Embed\Image;
use DiscordMessageBuilder\Embed\Provider;
use DateTime;
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
    public function canProvideTitle()
    {
        $this->message->setTitle($title = uniqid());

        $this->assertEquals($title, $this->message->title());

        $this->assertArrayHasKey('title', $this->message->jsonSerialize());
        $this->assertEquals($title, $this->message->jsonSerialize()['title']);
    }

    /** @test */
    public function canProvideType()
    {
        $this->assertEquals('rich', $this->message->type());
        
        $this->message->setType($type = uniqid());

        $this->assertEquals($type, $this->message->type());

        $this->assertArrayHasKey('type', $this->message->jsonSerialize());
        $this->assertEquals($type, $this->message->jsonSerialize()['type']);
    }

    /** @test */
    public function canProvideUrl()
    {
        $this->message->setUrl($url = uniqid());

        $this->assertEquals($url, $this->message->url());

        $this->assertArrayHasKey('url', $this->message->jsonSerialize());
        $this->assertEquals($url, $this->message->jsonSerialize()['url']);
    }

    /** @test */
    public function canProvideTimestamp()
    {
        $this->message->setTimestamp($timestamp = new DateTime());

        $this->assertEquals($timestamp, $this->message->timestamp());

        $this->assertArrayHasKey('timestamp', $this->message->jsonSerialize());
        $this->assertEquals($timestamp->format(DateTime::ATOM), $this->message->jsonSerialize()['timestamp']);
    }

    /** @test */
    public function canProvideDescription()
    {
        $this->message->setDescription($description = uniqid());

        $this->assertEquals($description, $this->message->description());

        $this->assertArrayHasKey('description', $this->message->jsonSerialize());
        $this->assertEquals($description, $this->message->jsonSerialize()['description']);
    }

    /** @test */
    public function canProvideColor()
    {
        $this->message->setColor($color = uniqid());

        $this->assertEquals($color, $this->message->color());

        $this->assertArrayHasKey('color', $this->message->jsonSerialize());
        $this->assertEquals($color, $this->message->jsonSerialize()['color']);
    }

    /** @test */
    public function canSetAuthorObject()
    {
        $author = new Author($name = uniqid());
        $this->message->setAuthor($author);

        $this->assertEquals($author, $this->message->author());

        $this->assertArrayHasKey('author', $this->message->jsonSerialize());
        $this->assertEquals($name, $this->message->jsonSerialize()['author']['name']);
    }

    /** @test */
    public function canSetAuthorByUrlAndDimensions()
    {
        $name = uniqid();
        $url = uniqid();
        $iconUrl = uniqid();
        $this->message->setAuthor($name, $url, $iconUrl);

        $this->assertEquals($name, $this->message->author()->name());
        $this->assertEquals($url, $this->message->author()->url());
        $this->assertEquals($iconUrl, $this->message->author()->iconUrl());
    }

    /** @test */
    public function canSetProviderObject()
    {
        $provider = new Provider($name = uniqid());
        $this->message->setProvider($provider);

        $this->assertEquals($provider, $this->message->provider());

        $this->assertArrayHasKey('provider', $this->message->jsonSerialize());
        $this->assertEquals($name, $this->message->jsonSerialize()['provider']['name']);
    }

    /** @test */
    public function canSetProviderByUrlAndDimensions()
    {
        $name = uniqid();
        $url = uniqid();
        $this->message->setProvider($name, $url);

        $this->assertEquals($name, $this->message->provider()->name());
        $this->assertEquals($url, $this->message->provider()->url());
    }

    /** @test */
    public function canAddMultipleFields()
    {
        $this->assertCount(0, $this->message->fields());

        $firstField = new Field($firstName = uniqid());
        $this->message->addField($firstField);

        $this->assertCount(1, $this->message->fields());

        $secondField = new Field($secondName = uniqid());
        $this->message->addField($secondField);

        $this->assertCount(2, $this->message->fields());

        $this->assertArrayHasKey('fields', $this->message->jsonSerialize());
        $this->assertEquals($firstName, $this->message->jsonSerialize()['fields'][0]['name']);
        $this->assertEquals($secondName, $this->message->jsonSerialize()['fields'][1]['name']);
    }

    /** @test */
    public function canSetFieldByNameValueAndInline()
    {

        $fieldName = uniqid();
        $value = uniqid();
        $inline = true;
        $this->message->addField($fieldName, $value, $inline);

        $this->assertEquals($fieldName, $this->message->fields()[0]->name());
        $this->assertEquals($value, $this->message->fields()[0]->value());
        $this->assertTrue($this->message->fields()[0]->isInline());
    }

    /** @test */
    public function canSetThumbnailObject()
    {
        $thumbnail = new Image($name = uniqid());
        $this->message->setThumbnail($thumbnail);

        $this->assertEquals($thumbnail, $this->message->thumbnail());

        $this->assertArrayHasKey('thumbnail', $this->message->jsonSerialize());
        $this->assertEquals($name, $this->message->jsonSerialize()['thumbnail']['url']);
    }

    /** @test */
    public function canSetThumbnailByUrlAndDimensions()
    {
        $thumbnailUrl = uniqid();
        $width = rand(1, 4000);
        $height = rand(4001, 8000);
        $this->message->setThumbnail($thumbnailUrl, $width, $height);

        $this->assertEquals($thumbnailUrl, $this->message->thumbnail()->url());
        $this->assertEquals($width, $this->message->thumbnail()->width());
        $this->assertEquals($height, $this->message->thumbnail()->height());
    }

    /** @test */
    public function canSetFooterObject()
    {
        $footer = new Footer($text = uniqid());
        $this->message->setFooter($footer);

        $this->assertEquals($footer, $this->message->footer());

        $this->assertArrayHasKey('footer', $this->message->jsonSerialize());
        $this->assertEquals($text, $this->message->jsonSerialize()['footer']['text']);
    }

    /** @test */
    public function canSetFooterByTextAndIconUrl()
    {
        $text = uniqid();
        $iconUrl = uniqid();
        $this->message->setFooter($text, $iconUrl);

        $this->assertEquals($text, $this->message->footer()->text());
        $this->assertEquals($iconUrl, $this->message->footer()->iconUrl());
    }
}
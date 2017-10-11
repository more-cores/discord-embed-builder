<?php

namespace DiscordMessageBuilder;

use DateTime;
use DiscordMessageBuilder\Embed\Author;
use DiscordMessageBuilder\Embed\Field;
use DiscordMessageBuilder\Embed\Footer;
use DiscordMessageBuilder\Embed\Image;
use DiscordMessageBuilder\Embed\Provider;

class Message extends Jsonable
{
    /** @var string */
    private $content = '';

    /** @var string */
    private $title;

    /** @var string */
    private $description;

    /** @var string */
    private $url;

    /** @var DateTime */
    private $timestamp;

    /** @var string */
    private $color;

    /** @var Provider */
    private $provider;

    /** @var Author */
    private $author;

    /** @var Field[] */
    private $fields = [];

    /** @var Image */
    private $thumbnailUrl;

    /** @var Image */
    private $imageUrl;

    /** @var Footer */
    private $footer;

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function content() : string
    {
        return $this->content;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function description() : string
    {
        return $this->description;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function setTimestamp(DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function timestamp() : DateTime
    {
        return $this->timestamp;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function color() : string
    {
        return $this->color;
    }

    public function setProvider($provider, string $url = null)
    {
        if ($provider instanceof Provider) {
            $this->provider = $provider;
        } else {
            $this->provider = new Provider($provider, $url);
        }
    }

    public function provider() : Provider
    {
        return $this->provider;
    }

    public function setAuthor($author, string $url = null, string $iconUrl = null)
    {
        if ($author instanceof Author) {
            $this->author = $author;
        } else {
            $this->author = new Author($author, $url, $iconUrl);
        }
    }

    public function author() : Author
    {
        return $this->author;
    }

    public function addField($field, string $value = null, bool $inline = null)
    {
        if ($field instanceof Field) {
            $this->fields[] = $field;
        } else {
            $this->fields[] = new Field($field, $value, $inline);
        }
    }

    public function fields() : array
    {
        return $this->fields;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function imageUrl() : string
    {
        return $this->imageUrl;
    }

    public function setThumbnailUrl(string $thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function thumbnailUrl() : string
    {
        return $this->thumbnailUrl;
    }

    public function setFooter($text, string $iconUrl = null)
    {
        if ($text instanceof Footer) {
            $this->footer = $text;
        } else {
            $this->footer = new Footer($text, $iconUrl);
        }
    }

    public function footer() : Footer
    {
        return $this->footer;
    }

    public function jsonSerialize()
    {
        $embed = [];

        if ($this->title != null) {
            $embed['title'] = $this->title;
        }

        if ($this->url != null) {
            $embed['url'] = $this->url;
        }

        if ($this->description != null) {
            $embed['description'] = $this->description;
        }

        if ($this->timestamp != null) {
            $embed['timestamp'] = $this->timestamp->format(DateTime::ATOM);
        }

        if ($this->color != null) {
            $embed['color'] = $this->color;
        }

        if ($this->author != null) {
            $embed['author'] = $this->author()->jsonSerialize();
        }

        if ($this->provider != null) {
            $embed['provider'] = $this->provider()->jsonSerialize();
        }

        if ($this->thumbnailUrl != null) {
            $embed['thumbnail'] = [
                'url' => $this->thumbnailUrl
            ];
        }

        if ($this->imageUrl != null) {
            $embed['image'] = [
                'url' => $this->imageUrl
            ];
        }

        if (count($this->fields) > 0) {
            $embed['fields'] = [];

            foreach ($this->fields as $field) {
                $embed['fields'][] = $field->jsonSerialize();
            }
        }

        if ($this->footer != null) {
            $embed['footer'] = $this->footer()->jsonSerialize();
        }

        $jsonData = [
            'content' => $this->content(),
        ];

        if (count($embed) > 0) {
            $jsonData['embed'] = $embed;
        }

        return $jsonData;
    }
}

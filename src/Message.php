<?php

namespace DiscordMessageBuilder;

use DateTime;
use DiscordMessageBuilder\Embed\Author;
use DiscordMessageBuilder\Embed\Field;
use DiscordMessageBuilder\Embed\Footer;
use DiscordMessageBuilder\Embed\Image;
use DiscordMessageBuilder\Embed\Provider;
use DiscordMessageBuilder\Embed\Video;

class Message extends Jsonable
{
    /** @var string */
    private $title;

    /** @var string */
    private $type = 'rich';

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

    /** @var Video */
    private $video;

    /** @var Image */
    private $thumbnail;

    /** @var Image */
    private $image;

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

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function type() : string
    {
        return $this->type;
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

    public function setVideo($video, int $width = null, int $height = null)
    {
        if ($video instanceof Video) {
            $this->video = $video;
        } else {
            $this->video = new Video($video, $width, $height);
        }
    }

    public function video() : Video
    {
        return $this->video;
    }

    public function setImage($image, int $width = null, int $height = null)
    {
        if ($image instanceof Image) {
            $this->image = $image;
        } else {
            $this->image = new Image($image, $width, $height);
        }
    }

    public function image() : Image
    {
        return $this->image;
    }

    public function setThumbnail($thumbnail, int $width = null, int $height = null)
    {
        if ($thumbnail instanceof Image) {
            $this->thumbnail = $thumbnail;
        } else {
            $this->thumbnail = new Image($thumbnail, $width, $height);
        }
    }

    public function thumbnail() : Image
    {
        return $this->thumbnail;
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
        $jsonData = [
            'type' => $this->type(),
        ];

        if ($this->title != null) {
            $jsonData['title'] = $this->title;
        }

        if ($this->url != null) {
            $jsonData['url'] = $this->url;
        }

        if ($this->description != null) {
            $jsonData['description'] = $this->description;
        }

        if ($this->timestamp != null) {
            $jsonData['timestamp'] = $this->timestamp->format(DateTime::ATOM);
        }

        if ($this->color != null) {
            $jsonData['color'] = $this->color;
        }

        if ($this->author != null) {
            $jsonData['author'] = $this->author()->jsonSerialize();
        }

        if ($this->provider != null) {
            $jsonData['provider'] = $this->provider()->jsonSerialize();
        }

        if ($this->video != null) {
            $jsonData['video'] = $this->video()->jsonSerialize();
        }

        if ($this->thumbnail != null) {
            $jsonData['thumbnail'] = $this->thumbnail()->jsonSerialize();
        }

        if ($this->image != null) {
            $jsonData['image'] = $this->image()->jsonSerialize();
        }

        if (count($this->fields) > 0) {
            $jsonData['fields'] = [];

            foreach ($this->fields as $field) {
                $jsonData['fields'][] = $field->jsonSerialize();
            }
        }

        if ($this->footer != null) {
            $jsonData['footer'] = $this->footer()->jsonSerialize();
        }

        return $jsonData;
    }
}

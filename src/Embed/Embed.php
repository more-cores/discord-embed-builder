<?php

namespace DiscordMessageBuilder\Embed;

use DateTime;
use DiscordMessageBuilder\Jsonable;

class Embed extends Jsonable
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $description;

    /** @var string */
    protected $url;

    /** @var DateTime */
    protected $timestamp;

    /** @var string */
    protected $color;

    /** @var Footer */
    protected $footer;

    /** @var string */
    protected $imageUrl;

    /** @var string */
    protected $thumbnailUrl;

    /** @var Author */
    protected $author;

    /** @var Field[] */
    protected $fields = [];

    public function __construct(array $attributes = null)
    {
        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }

        if (isset($attributes['description'])) {
            $this->setDescription($attributes['description']);
        }

        if (isset($attributes['url'])) {
            $this->setUrl($attributes['url']);
        }

        if (isset($attributes['timestamp'])) {
            if ($attributes['timestamp'] instanceof DateTime) {
                $this->setTimestamp($attributes['timestamp']);
            } else {
                $this->setTimestamp(new DateTime($attributes['timestamp']));
            }
        }

        if (isset($attributes['color'])) {
            $this->setColor($attributes['color']);
        }

        if (isset($attributes['footer'])) {
            if ($attributes['footer'] instanceof Footer) {
                $this->setFooter($attributes['footer']);
            } else {
                $this->setFooter(new Footer($attributes['footer']));
            }
        }

        if (isset($attributes['image']['url'])) {
            $this->imageUrl = $attributes['image']['url'];
        }

        if (isset($attributes['thumbnail']['url'])) {
            $this->thumbnailUrl = $attributes['thumbnail']['url'];
        }

        if (isset($attributes['author'])) {
            if ($attributes['author'] instanceof Author) {
                $this->setAuthor($attributes['author']);
            } else {
                $this->setAuthor(new Author($attributes['author']));
            }
        }

        if (isset($attributes['fields'])) {
            foreach ($attributes['fields'] as $field) {
                if ($field instanceof Field) {
                    $this->addField($field);
                } else {
                    $this->addField(new Field($field));
                }
            }
        }
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function title() : string
    {
        return $this->title;
    }

    public function hasTitle() : bool
    {
        return $this->title != null;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function description() : string
    {
        return $this->description;
    }

    public function hasDescription() : bool
    {
        return $this->description != null;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function url() : string
    {
        return $this->url;
    }

    public function hasUrl() : bool
    {
        return $this->url != null;
    }

    public function setTimestamp(DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    }

    public function timestamp() : DateTime
    {
        return $this->timestamp;
    }

    public function hasTimestamp() : bool
    {
        return $this->timestamp != null;
    }

    public function setColorRGB(int $red, int $green, int $blue)
    {
        $this->color = ($red << 16) + ($green << 8) + $blue;
    }

    public function setColor(string $color)
    {
        $this->color = $color;
    }

    public function color() : string
    {
        return $this->color;
    }

    public function hasColor() : bool
    {
        return $this->color != null;
    }

    public function setAuthor($author, string $url = null, string $iconUrl = null)
    {
        if ($author instanceof Author) {
            $this->author = $author;
        } else {
            $authorObject = new Author();
            $authorObject->setName($author);

            if ($url != null) {
                $authorObject->setUrl($url);
            }

            if ($iconUrl != null) {
                $authorObject->setIconUrl($iconUrl);
            }

            $this->author = $authorObject;
        }
    }

    public function author() : Author
    {
        return $this->author;
    }

    public function hasAuthor() : bool
    {
        return $this->author != null;
    }

    public function addField($field, string $value = null, bool $inline = null)
    {
        if ($field instanceof Field) {
            $this->fields[] = $field;
        } else {
            $fieldObject = new Field();
            $fieldObject->setName($field);

            if ($value != null) {
                $fieldObject->setValue($value);
            }

            if ($inline != null && $inline === true) {
                $fieldObject->inline();
            }

            $this->fields[] = $fieldObject;
        }
    }

    public function fields() : array
    {
        return $this->fields;
    }

    public function hasFields() : bool
    {
        return count($this->fields) > 0;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function imageUrl() : string
    {
        return $this->imageUrl;
    }

    public function hasImage() : bool
    {
        return $this->imageUrl != null;
    }

    public function setThumbnailUrl(string $thumbnailUrl)
    {
        $this->thumbnailUrl = $thumbnailUrl;
    }

    public function thumbnailUrl() : string
    {
        return $this->thumbnailUrl;
    }

    public function hasThumbnail() : bool
    {
        return $this->thumbnailUrl != null;
    }

    public function setFooter($text, string $iconUrl = null)
    {
        if ($text instanceof Footer) {
            $this->footer = $text;
        } else {
            $footerObject = new Footer();
            $footerObject->setText($text);

            if ($iconUrl != null) {
                $footerObject->setIconUrl($iconUrl);
            }

            $this->footer = $footerObject;
        }
    }

    public function footer() : Footer
    {
        return $this->footer;
    }

    public function hasFooter() : bool
    {
        return $this->footer != null;
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

        if ($this->thumbnailUrl != null) {
            $embed['thumbnail'] = [
                'url' => $this->thumbnailUrl,
            ];
        }

        if ($this->imageUrl != null) {
            $embed['image'] = [
                'url' => $this->imageUrl,
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

        return $embed;
    }
}

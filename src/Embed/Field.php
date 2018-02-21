<?php

namespace DiscordMessageBuilder\Embed;

use DiscordMessageBuilder\Jsonable;

class Field extends Jsonable
{
    /** @var string */
    protected $name = '';

    /** @var string */
    protected $value;

    /** @var bool */
    protected $inline = false;

    public function __construct(array $attributes = null)
    {
        if (isset($attributes['name'])) {
            $this->setName($attributes['name']);
        }

        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
        }

        if (isset($attributes['inline']) && $attributes['inline'] == true) {
            $this->inline();
        }
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function value() : string
    {
        return $this->value;
    }

    public function inline()
    {
        $this->inline = true;
    }

    public function isInline() : bool
    {
        return $this->inline;
    }

    public function jsonSerialize()
    {
        $jsonData = [
            'name' => $this->name(),
        ];

        if ($this->value != null) {
            $jsonData['value'] = $this->value();
        }

        if ($this->inline) {
            $jsonData['inline'] = true;
        }

        return $jsonData;
    }
}

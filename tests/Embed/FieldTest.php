<?php

namespace DiscordMessageBuilder;

use DiscordMessageBuilder\Embed\Field;
use PHPUnit\Framework\TestCase;

class FieldTest extends TestCase
{
    /** @var Field */
    protected $field;

    public function setUp()
    {
        parent::setUp();

        $this->field = new Field();
    }

    /** @test */
    public function canBeConstructedWithParams()
    {
        $name = uniqid();
        $value = uniqid();

        $field = new Field($name, $value);

        $this->assertEquals($name, $field->name());
        $this->assertEquals($value, $field->value());
    }

    /** @test */
    public function canProvideName()
    {
        $this->assertEquals('', $this->field->name());

        $this->field->setName($name = uniqid());

        $this->assertEquals($name, $this->field->name());

        $this->assertArrayHasKey('name', $this->field->jsonSerialize());
        $this->assertEquals($name, $this->field->jsonSerialize()['name']);
    }

    /** @test */
    public function canProvideValue()
    {
        $this->field->setValue($value = uniqid());

        $this->assertEquals($value, $this->field->value());

        $this->assertArrayHasKey('value', $this->field->jsonSerialize());
        $this->assertEquals($value, $this->field->jsonSerialize()['value']);
    }

    /** @test */
    public function canProvideInline()
    {
        $this->assertFalse($this->field->isInline());

        $this->field->inline();

        $this->assertTrue($this->field->isInline());

        $this->assertArrayHasKey('inline', $this->field->jsonSerialize());
        $this->assertTrue($this->field->jsonSerialize()['inline']);
    }
}

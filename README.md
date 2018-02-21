# Discord Message Builder [![Latest Stable Version](https://poser.pugx.org/more-cores/discord-message-builder/v/stable.png)](https://packagist.org/packages/more-cores/discord-message-builder) [![Total Downloads](https://poser.pugx.org/more-cores/discord-message-builder/downloads.png)](https://packagist.org/packages/more-cores/discord-message-builder) [![Coverage Status](https://coveralls.io/repos/github/more-cores/discord-message-builder/badge.svg)](https://coveralls.io/github/more-cores/discord-message-builder)

A small library to building Discord messages.

# Installation

```
composer require more-cores/discord-message-builder:^2.0
```

# Usage


```php
$message = new WebhookMessage();
$message->setContent($content);

$embed = new Embed();
$embed->setTitle($title);
$embed->setDescription($description);
$embed->setUrl($url);
$embed->setTimestamp($dateTime);
$embed->setColor($color);
$message->addEmbed($embed);

$message->toJson(); // valid json ready to be sent to Discord via a Webhook
```

## Author

```php
// define an embed author using shorthand
$embed->setAuthor($name);

// and optionally specify specific attributes
$embed->setAuthor($name, $url);

// define an embed author by object
$author = new Author();
$author->setName($name);
$embed->setAuthor($author);
```

## Fields

```php
// define an embed video using shorthand
$embed->addField($fieldName, $fieldValue);

// and optionally specify whether it's inline (default to false)
$embed->addField($fieldName, $fieldValue, $inline = true);

// define an embed field by object
$field = new Field();
$field->setName($name);
$field->setValue($value);
$embed->setVideo($field);
```

## Image

```php
$embed->setImageUrl($imageUrl);
```

## Thumbnail

```php
$embed->setThumbnailUrl($thumbnailUrl);
```

## Footer

```php
// define an embed footer using shorthand
$embed->setFooter($text, $iconUrl);

// and optionally specify  specific attributes
$embed->setFooter($urlToImage, $width, $height);

// define an embed thumbnail by object
$thumbnail = new Thumbnail();
$thumbnail->setText($text);
$thumbnail->setUrl($urlToImage);
$embed->setFooter($thumbnail);
```

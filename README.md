# Discord Message Builder [![Latest Stable Version](https://poser.pugx.org/more-cores/discord-message-builder/v/stable.png)](https://packagist.org/packages/more-cores/discord-message-builder) [![Total Downloads](https://poser.pugx.org/more-cores/discord-message-builder/downloads.png)](https://packagist.org/packages/more-cores/discord-message-builder) [![Coverage Status](https://coveralls.io/repos/github/more-cores/discord-message-builder/badge.svg)](https://coveralls.io/github/more-cores/discord-message-builder)

A small library to building Discord embed messages.

# Installation

```
composer require more-cores/discord-embed-builder ~1.0
```

# Usage


```php
$message = new Message();
$message->setTitle($title);
$message->setDescription($description);
$message->setUrl($url);
$message->setTimestamp($dateTime);
$message->setColor($color);
$message->toJson(); // valid json ready to be sent to Discord
```

## Provider

```php
// define an embed provider using shorthand
$message->setProvider($name);

// and optionally specify specific attributes
$message->setProvider($name, $url);

// define an embed provider by object
$provider = new Provider();
$provider->setName($name);
$provider->setUrl($url);
$message->setProvider($provider);
```

## Author

```php
// define an embed author using shorthand
$message->setAuthor($name);

// and optionally specify specific attributes
$message->setAuthor($name, $url);

// define an embed author by object
$author = new Author();
$author->setName($name);
$message->setAuthor($author);
```

## Fields

```php
// define an embed video using shorthand
$message->addField($fieldName, $fieldValue);

// and optionally specify whether it's inline (default to false)
$message->addField($fieldName, $fieldValue, $inline = true);

// define an embed field by object
$field = new Field();
$field->setName($name);
$field->setValue($value);
$message->setVideo($field);
```

## Video

```php
// define an embed video using shorthand
$message->setVideo($url);

// and optionally specify specific attributes
$message->setVideo($url, $width, $height);

// define an embed video by object
$video = new Video();
$video->setUrl($url);
$video->setWidth($width);
$video->setHeight($height);
$message->setVideo($video);
```

## Image

```php
// define an embed image using shorthand
$message->setImage($image);

// and optionally specify  specific attributes
$message->setImage($urlToImage, $width, $height);

// define an embed image by object
$image = new Image();
$image->setUrl($urlToImage);
$image->setWidth($width);
$image->setHeight($height);
$message->setImage($image);
```

## Thumbnail

```php
// define an embed thumbnail using shorthand
$message->setThumbnail($thumbnail);

// and optionally specify  specific attributes
$message->setThumbnail($urlToImage, $width, $height);

// define an embed thumbnail by object
$thumbnail = new Thumbnail();
$thumbnail->setUrl($urlToImage);
$thumbnail->setWidth($width);
$thumbnail->setHeight($height);
$message->setThumbnail($thumbnail);
```

## Footer

```php
// define an embed footer using shorthand
$message->setFooter($text, $iconUrl);

// and optionally specify  specific attributes
$message->setFooter($urlToImage, $width, $height);

// define an embed thumbnail by object
$thumbnail = new Thumbnail();
$thumbnail->setText($text);
$thumbnail->setUrl($urlToImage);
$message->setFooter($thumbnail);
```
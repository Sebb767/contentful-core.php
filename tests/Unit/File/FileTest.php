<?php

/**
 * This file is part of the contentful/contentful-core package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\Core\Unit\File;

use Contentful\Core\File\File;
use Contentful\Tests\Core\TestCase;

class FileTest extends TestCase
{
    /**
     * @var File
     */
    protected $file;

    public function setUp()
    {
        $this->file = new File(
            'Nyan_cat_250px_frame.png',
            'image/png',
            '//images.contentful.com/cfexampleapi/4gp6taAwW4CmSgumq2ekUm/9da0cd1936871b8d72343e895a00d611/Nyan_cat_250px_frame.png',
            12273
        );
    }

    public function testGetter()
    {
        $this->assertSame('Nyan_cat_250px_frame.png', $this->file->getFileName());
        $this->assertSame('image/png', $this->file->getContentType());
        $this->assertSame('//images.contentful.com/cfexampleapi/4gp6taAwW4CmSgumq2ekUm/9da0cd1936871b8d72343e895a00d611/Nyan_cat_250px_frame.png', $this->file->getUrl());
        $this->assertSame(12273, $this->file->getSize());
    }

    public function testJsonSerialize()
    {
        $this->assertJsonStringEqualsJsonString(
            '{"fileName":"Nyan_cat_250px_frame.png","contentType":"image/png","details":{"size": 12273},"url": "//images.contentful.com/cfexampleapi/4gp6taAwW4CmSgumq2ekUm/9da0cd1936871b8d72343e895a00d611/Nyan_cat_250px_frame.png"}',
            \json_encode($this->file)
        );
    }
}

<?php

/**
 * This file is part of the contentful/contentful-core package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\Core\Unit\File;

use Contentful\Core\Api\Link;
use Contentful\Core\File\LocalUploadFile;
use Contentful\Tests\Core\TestCase;

class LocalUploadFileTest extends TestCase
{
    /**
     * @var LocalUploadFile
     */
    protected $file;

    public function setUp()
    {
        $this->file = new LocalUploadFile(
            'the_great_gatsby.txt',
            'image/png',
            new Link('1reper3p12RdEVfC13QsUR', 'Upload')
        );
    }

    public function testGetter()
    {
        $this->assertSame('the_great_gatsby.txt', $this->file->getFileName());
        $this->assertSame('image/png', $this->file->getContentType());
        $this->assertSame('1reper3p12RdEVfC13QsUR', $this->file->getUploadFrom()->getId());
        $this->assertSame('Upload', $this->file->getUploadFrom()->getLinkType());
    }

    public function testJsonSerialize()
    {
        $this->assertJsonStringEqualsJsonString(
            '{"fileName":"the_great_gatsby.txt","contentType":"image\/png","uploadFrom":{"sys":{"type":"Link","id":"1reper3p12RdEVfC13QsUR","linkType":"Upload"}}}',
            \json_encode($this->file)
        );
    }
}

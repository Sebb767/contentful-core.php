<?php

/**
 * This file is part of the contentful/contentful-core package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Tests\Core\Unit\Resource;

use Contentful\Core\Resource\ResourceArray;
use Contentful\Tests\Core\TestCase;

class ResourceArrayTest extends TestCase
{
    public function testGetSet()
    {
        $array = new ResourceArray(['abc'], 10, 2, 0);

        $this->assertSame(10, $array->getTotal());
        $this->assertSame(2, $array->getLimit());
        $this->assertSame(0, $array->getSkip());
    }

    public function testCountable()
    {
        $array = new ResourceArray(['abc'], 10, 2, 0);

        $this->assertInstanceOf('\Countable', $array);
        $this->assertCount(1, $array);
    }

    public function testArrayAccess()
    {
        $array = new ResourceArray(['abc'], 10, 2, 0);

        $this->assertInstanceOf('\Countable', $array);
        $this->assertTrue(isset($array[0]));
        $this->assertSame('abc', $array[0]);
    }

    public function testJsonSerializeEmpty()
    {
        $array = new ResourceArray([], 0, 10, 0);

        $this->assertJsonStringEqualsJsonString(
            '{"sys":{"type":"Array"},"total":0,"limit":10,"skip":0,"items":[]}',
            \json_encode($array)
        );
    }

    public function testIsIterable()
    {
        $array = new ResourceArray(['abc'], 10, 2, 0);

        $this->assertInstanceOf('\Traversable', $array);
    }

    public function testIteration()
    {
        $array = new ResourceArray(['abc', 'def'], 10, 2, 0);
        $count = 0;

        foreach ($array as $key => $elem) {
            ++$count;
            $this->assertSame($array[$key], $elem);
        }

        $this->assertSame(2, $count);
    }

    public function testGetItems()
    {
        $array = new ResourceArray(['abc', 'def'], 10, 2, 0);

        $this->assertSame(['abc', 'def'], $array->getItems());
    }

    /**
     * @expectedException        \BadMethodCallException
     * @expectedExceptionMessage "Contentful\Core\Resource\ResourceArray" is read-only.
     */
    public function testOffsetSetThrows()
    {
        $array = new ResourceArray([], 0, 2, 0);

        $array[0] = 'abc';
    }

    /**
     * @expectedException        \BadMethodCallException
     * @expectedExceptionMessage "Contentful\Core\Resource\ResourceArray" is read-only.
     */
    public function testOffsetUnsetThrows()
    {
        $array = new ResourceArray(['abc'], 10, 2, 0);

        unset($array[0]);
    }
}

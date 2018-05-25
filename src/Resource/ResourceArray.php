<?php

/**
 * This file is part of the contentful/contentful-core package.
 *
 * @copyright 2015-2018 Contentful GmbH
 * @license   MIT
 */

namespace Contentful\Core\Resource;

/**
 * A ResourceArray holds the response of an API request if more than one resource has been requested.
 *
 * In addition to the retrieved items themselves it also provides some access to metadata.
 */
class ResourceArray implements \Countable, \ArrayAccess, \IteratorAggregate, \JsonSerializable
{
    /**
     * @var array
     */
    private $items;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $limit;

    /**
     * @var int
     */
    private $skip;

    /**
     * ResourceArray constructor.
     *
     * @param array $items
     * @param int   $total
     * @param int   $limit
     * @param int   $skip
     */
    public function __construct(array $items, $total, $limit, $skip)
    {
        $this->items = $items;
        $this->total = $total;
        $this->limit = $limit;
        $this->skip = $skip;
    }

    /**
     * Returns the total amount of resources matching the filter.
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * The limit used when retrieving this ResourceArray.
     *
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }

    /**
     * The number of skipped resources when retrieving this  ResourceArray.
     *
     * @return int
     */
    public function getSkip()
    {
        return $this->skip;
    }

    /**
     * Get the returned values as a PHP array.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'sys' => [
                'type' => 'Array',
            ],
            'total' => $this->total,
            'limit' => $this->limit,
            'skip' => $this->skip,
            'items' => $this->items,
        ];
    }

    /**
     * Returns the number of resources in this array.
     *
     * @return int
     *
     * @see http://php.net/manual/en/countable.count.php Countable::count
     */
    public function count()
    {
        return \count($this->items);
    }

    /**
     * Returns a \Traversable to allow iterating the ResourceArray.
     *
     * @return \Traversable
     *
     * @see http://php.net/manual/en/iteratoraggregate.getiterator.php IteratorAggregate::getIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->items);
    }

    /**
     * @param mixed $offset
     *
     * @return bool
     *
     * @see http://php.net/manual/en/arrayaccess.offsetexists.php ArrayAccess::offsetExists
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     *
     * @see http://php.net/manual/en/arrayaccess.offsetget.php ArrayAccess::offsetGet
     */
    public function offsetGet($offset)
    {
        return $this->items[$offset];
    }

    /**
     * This method is not implemented since a ResourceArray is read-only.
     *
     * @param mixed $offset
     * @param mixed $value
     *
     * @throws \BadMethodCallException always thrown since ResourceArray is read-only
     *
     * @see http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetSet
     */
    public function offsetSet($offset, $value)
    {
        throw new \BadMethodCallException(\sprintf(
            '"%s" is read-only.',
            __CLASS__
        ));
    }

    /**
     * This method is not implemented since a ResourceArray is read-only.
     *
     * @param mixed $offset
     *
     * @throws \BadMethodCallException always thrown since ResourceArray is read-only
     *
     * @see http://php.net/manual/en/arrayaccess.offsetunset.php ArrayAccess::offsetUnset
     */
    public function offsetUnset($offset)
    {
        throw new \BadMethodCallException(\sprintf(
            '"%s" is read-only.',
            __CLASS__
        ));
    }
}

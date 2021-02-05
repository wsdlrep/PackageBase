<?php

declare(strict_types=1);

namespace WsdlToPhp\PackageBase;

abstract class AbstractStructArrayBase extends AbstractStructBase implements StructArrayInterface
{
    /**
     * Array that contains values when only one parameter is set when calling __construct method
     * @var array
     */
    protected array $internArray = [];

    /**
     * Bool that tells if array is set or not
     * @var bool
     */
    protected bool $internArrayIsArray = false;

    /**
     * Items index browser
     * @var int
     */
    protected int $internArrayOffset = 0;

    /**
     * Method alias to count
     * @return int
     */
    public function length(): int
    {
        return $this->count();
    }

    /**
     * Method returning item length, alias to length
     * @return int
     */
    public function count(): int
    {
        return $this->getInternArrayIsArray() ? count($this->getInternArray()) : -1;
    }

    /**
     * Method returning the current element
     * @return mixed
     */
    public function current()
    {
        return $this->offsetGet($this->internArrayOffset);
    }

    /**
     * Method moving the current position to the next element
     * @return AbstractStructArrayBase
     */
    public function next(): self
    {
        return $this->setInternArrayOffset($this->getInternArrayOffset() + 1);
    }

    /**
     * Method resetting itemOffset
     * @return AbstractStructArrayBase
     */
    public function rewind(): self
    {
        return $this->setInternArrayOffset(0);
    }

    /**
     * Method checking if current itemOffset points to an existing item
     * @return bool
     */
    public function valid(): bool
    {
        return $this->offsetExists($this->getInternArrayOffset());
    }

    /**
     * Method returning current itemOffset value, alias to getInternArrayOffset
     * @return int
     */
    public function key(): int
    {
        return $this->getInternArrayOffset();
    }

    /**
     * Method alias to offsetGet
     * @param mixed $index
     * @return mixed
     */
    public function item($index)
    {
        return $this->offsetGet($index);
    }

    /**
     * Default method adding item to array
     * @param mixed $item value
     * @return AbstractStructArrayBase
     */
    public function add($item): self
    {
        // init array
        if (!is_array($this->getPropertyValue($this->getAttributeName()))) {
            $this->setPropertyValue($this->getAttributeName(), []);
        }

        // current array
        $currentArray = $this->getPropertyValue($this->getAttributeName());
        $currentArray[] = $item;
        $this
            ->setPropertyValue($this->getAttributeName(), $currentArray)
            ->setInternArray($currentArray)
            ->setInternArrayIsArray(true)
            ->setInternArrayOffset(0);

        return $this;
    }

    /**
     * Method returning the first item
     * @return mixed
     */
    public function first()
    {
        return $this->item(0);
    }

    /**
     * Method returning the last item
     * @return mixed
     */
    public function last()
    {
        return $this->item($this->length() - 1);
    }

    /**
     * Method testing index in item
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return ($this->getInternArrayIsArray() && array_key_exists($offset, $this->getInternArray()));
    }

    /**
     * Method returning the item at "index" value
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->internArray[$offset] : null;
    }

    /**
     * Method setting value at offset
     * @param mixed $offset
     * @param mixed $value
     * @return AbstractStructArrayBase
     */
    public function offsetSet($offset, $value): self
    {
        $this->internArray[$offset] = $value;

        return $this->setPropertyValue($this->getAttributeName(), $this->internArray);
    }

    /**
     * Method unsetting value at offset
     * @param mixed $offset
     * @return AbstractStructArrayBase
     */
    public function offsetUnset($offset): self
    {
        if ($this->offsetExists($offset)) {
            unset($this->internArray[$offset]);
            $this->setPropertyValue($this->getAttributeName(), $this->internArray);
        }

        return $this;
    }

    /**
     * Method returning intern array to iterate trough
     * @return array
     */
    public function getInternArray(): array
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        return $this->internArray;
    }

    /**
     * Method setting intern array to iterate trough
     * @param array $internArray
     * @return AbstractStructArrayBase
     */
    public function setInternArray(array $internArray): self
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        $this->internArray = $internArray;

        return $this;
    }

    /**
     * Method returns intern array index when iterating trough
     * @return int
     */
    public function getInternArrayOffset(): int
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        return $this->internArrayOffset;
    }

    /**
     * Method initiating internArray
     * @param array $array the array to iterate trough
     * @param bool $internCall indicates that methods is calling itself
     * @return AbstractStructArrayBase
     */
    public function initInternArray(array $array = [], bool $internCall = false): self
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        if (is_array($array) && count($array) > 0) {
            $this
                ->setInternArray($array)
                ->setInternArrayOffset(0)
                ->setInternArrayIsArray(true);
        } elseif (!$internCall && property_exists($this, $this->getAttributeName())) {
            $this->initInternArray($this->getPropertyValue($this->getAttributeName()), true);
        }

        return $this;
    }

    /**
     * Method setting intern array offset when iterating trough
     * @param int $internArrayOffset
     * @return AbstractStructArrayBase
     */
    public function setInternArrayOffset(int $internArrayOffset): self
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        $this->internArrayOffset = $internArrayOffset;

        return $this;
    }

    /**
     * Method returning true if intern array is an actual array
     * @return bool
     */
    public function getInternArrayIsArray(): bool
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        return $this->internArrayIsArray;
    }

    /**
     * Method setting if intern array is an actual array
     * @param bool $internArrayIsArray
     * @return AbstractStructArrayBase
     */
    public function setInternArrayIsArray(bool $internArrayIsArray = false): self
    {
        @trigger_error(sprintf('%s() will be private in WsdlToPhp/PackageBase 5.0.', __METHOD__), E_USER_DEPRECATED);

        $this->internArrayIsArray = $internArrayIsArray;

        return $this;
    }
}

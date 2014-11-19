<?php

namespace Detail\Mail\Message;

use Rhumsaa\Uuid\Uuid;
use Rhumsaa\Uuid\Exception\UnsatisfiedDependencyException;

use RuntimeException;

final class Id
{
    /**
     * @var string
     */
    private $value;

    public static function create()
    {
        try {
            $id = Uuid::uuid4()->toString();

        } catch (UnsatisfiedDependencyException $e) {
            // Some dependency was not met. Either the method cannot be called on a
            // 32-bit system, or it can, but it relies on Moontoast\Math to be present.
            // See https://github.com/ramsey/uuid#requirements
            throw new RuntimeException(
                sprintf('Failed to create message ID: %s', $e->getMessage()), 0, $e
            );
        }

        return new self($id);
    }

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }
}

<?php

namespace Detail\Mail\Message;

interface MessageInterface
{
//    public static function fromArray(array $message);

    /** @todo Need to define constructor. Bound in MessageFactory */

    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @return array
     */
    public function getVariables();

    /**
     * @return array
     */
//    public function toArray();
}

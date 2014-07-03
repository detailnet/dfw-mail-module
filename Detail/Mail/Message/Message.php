<?php

namespace Detail\Mail\Message;

use InvalidArgumentException;

class Message
    implements MessageInterface
{
    /**
     * @var Id
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $headers = array();

    /**
     * @var array
     */
    protected $variables = array();

//    public static function fromArray(array $message)
//    {
//        var_dump($message);
//        exit;
//
//        return new static(
//            $message['id'],
//            $message['name'],
//            $message['headers'],
//            $message['variables']
//        );
//    }

    /**
     * @return Id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getVariables()
    {
        return $this->variables;
    }

    /**
     * @param array $variables
     */
    public function setVariables(array $variables)
    {
        $this->variables = $variables;
    }

    /**
     * @param $id
     * @param $name
     * @param array $headers
     * @param array $variables
     * @throws InvalidArgumentException
     */
    public function __construct($id, $name, array $headers = array(), array $variables = array())
    {
        if (is_string($id)) {
            $id = new Id($id);
        } else if (!$id instanceof Id) {
            throw new InvalidArgumentException(
                sprintf(
                    'Provided ID must be a string or Detail\Mail\Message\Id object; %s given',
                    is_object($id) ? get_class($id) : gettype($id)
                )
            );
        }

        $this->id = $id;
        $this->name = $name;

        $this->setHeaders($headers);
        $this->setVariables($variables);
    }

    /**
     * @return array
     */
//    public function toArray()
//    {
//        return array(
//            'id' => $this->getId()->getValue(),
//            'name' => $this->getName(),
//            'headers' => $this->getHeaders(),
//            'variables' => $this->getVariables()
//        );
//    }
}

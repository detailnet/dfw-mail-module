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
}

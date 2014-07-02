<?php

namespace Detail\Mail\Message;

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

    public static function fromArray(array $message)
    {
        return new static(
            $message['id'],
            $message['name'],
            $message['headers'],
            $message['variables']
        );
    }

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

    public function __construct(Id $id, $name, array $headers = array(), array $variables = array())
    {
        $this->id = $id;
        $this->$name = $name;

        $this->setHeaders($headers);
        $this->setVariables($variables);
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'name' => $this->getName(),
            'headers' => $this->getHeaders(),
            'variables' => $this->getVariables()
        );
    }
}

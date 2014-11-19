<?php

namespace Detail\Mail\Listener;

use Zend\EventManager\ListenerAggregateInterface;

interface ListenerInterface extends ListenerAggregateInterface
{
    /**
     * @param string $id
     * @return void
     */
    public function setMailerId($id);
}

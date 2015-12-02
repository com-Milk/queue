<?php
namespace Queue;

/**
 * Class QueueArray
 */
class QueueArray implements QueueInterface
{
    /** @var array */
    protected $queueList = [];

    /**
     * @param mixed $item
     */
    public function addToQueue($item)
    {
        array_push($this->queueList, $item);
    }

    /**
     * @return mixed
     */
    public function getFromQueue()
    {
        return array_pop($this->queueList);
    }
}

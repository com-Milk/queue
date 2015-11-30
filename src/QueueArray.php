<?php
/**
 * Created by PhpStorm.
 * User: milk
 * Date: 30.11.15
 * Time: 20:15
 */

/**
 * Class QueueArray
 */
class QueueArray implements QueueInterface
{
    /**
     * @var array
     */
    protected $queueList=[];

    public function addToQueue($item)
    {
        array_push($this->queueList, $item);
    }

    public function getFromQueue()
    {
        return array_pop($this->queueList);
    }
}
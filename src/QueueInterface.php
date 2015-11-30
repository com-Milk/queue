<?php
/**
 * Created by PhpStorm.
 * User: milk
 * Date: 30.11.15
 * Time: 20:15
 */
/**
 * Interface QueuesInterface
 */
interface QueueInterface
{
    /**
     * @param mixed $item
     * @return void
     */
    public function addToQueue($item);

    /**
     * @return mixed
     */
    public function getFromQueue();
}
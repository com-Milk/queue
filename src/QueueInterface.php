<?php
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
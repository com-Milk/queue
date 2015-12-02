<?php
namespace Queue;

use Predis\Client;

/**
 * Class QueueRedis
 */
class QueueRedis implements QueueInterface
{
    /** @var Client */
    protected $redis;

    /** @var string */
    protected $queueName;

    /**
     * @param Client $client
     * @param string $queueName
     */
    public function __construct(Client $client, $queueName)
    {
        $this->redis = $client;
        $this->queueName = $queueName;
    }

    /**
     * @param mixed $item
     */
    public function addToQueue($item)
    {
        $this->redis->lpush($this->queueName, $item);
    }

    /**
     * @return mixed
     */
    public function getFromQueue()
    {
        return $this->redis->lpop($this->queueName);
    }

    /**
     * @return mixed
     */
    public function getLenQueue()
    {
        return $this->redis->llen($this->queueName);
    }
}

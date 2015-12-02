<?php
namespace Queue;
use Predis;

/**
 * Class QueueRedis
 */
class QueueRedis implements QueueInterface
{
    protected $redis;
    protected $quename;

    /**
     * @param \Predis\Client $client
     * @param $quename
     */
    public function __construct(Client $client, $quename)
    {
        $this->redis = $client;
        $this->quename = $quename;
    }

    /**
     * @param mixed $item
     */
    public function addToQueue($item)
    {
        $this->redis->lpush($this->quename, $item);
    }

    /**
     * @return mixed
     */
    public function getFromQueue()
    {
        return $this->redis->lpop($this->quename);
    }

    /**
     * @return mixed
     */
    public function getLenQueue()
    {
        return $this->redis->llen($this->quename);
    }
}

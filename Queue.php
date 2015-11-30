<?php
require_once __DIR__ . '/vendor/autoload.php';









/**
 * Class ConcreteClass
 */
class ConcreteClass
{
    /** @var QueueArray */
    protected $queue;

    /**
     * @param QueueArray $queue
     */
    public function __construct(QueueArray $queue)
    {
        $this->queue = $queue;
    }

    /**
     * @param string $filename
     * @return bool
     */
    public function getFileAndAddToQueue($filename)
    {
        $file = fopen($filename, 'r');

        while (!feof($file)) {
            $value = fgets($file);
            $this->queue->addToQueue($value);
        }

        return true;
    }

    public function getItemFromQueue(){
        return $this->queue->getFromQueue();
    }
}
class ConcreteClassRedis
{
    protected $redis;

    function __construct(QueueRedis $redis){
        $this->redis=$redis;
    }

    public function getFileAndAddToQueueRedis($filename){
        $file = fopen($filename,'r');

        while(!feof($file)){
            $value = fgets($file);
            $this->redis->addToQueue($value);
        }
    }
    public function getItemFromQueueRedis(){
        return $this->redis->getFromQueue();
    }

    public function getLenQueue(){
        return $this->redis->getLenQueue();
    }
}
//
//$client = new Predis\Client('tcp://127.0.0.1:6379');
//$redisQueueInit = new QueueRedis($client,'que');
//$workerRedis = new ConcreteClassRedis($redisQueueInit);
////$workerRedis->getFileAndAddToQueueRedis('file');
//
//print $workerRedis->getItemFromQueueRedis();

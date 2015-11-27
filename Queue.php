<?php
require_once __DIR__ . '/vendor/autoload.php';

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


class QueueRedis implements QueueInterface
{
    protected $redisList;
    protected $quename;

    function __construct(Predis\Client $client,$quename){
        $this->redisList=$client;
        $this->quename = $quename;
    }

    public function addToQueue($item){
        $this->redisList->lpush($this->quename,$item);
    }

    public function getFromQueue(){
        return $this->redisList->lpop($this->quename);
    }

    public function getLenQueue(){
       return $this->redisList->llen($this->quename);
    }

}

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
}

$client = new Predis\Client('tcp://127.0.0.1:6379');
$redisQueueInit = new QueueRedis($client,'que');
$workerRedis = new ConcreteClassRedis($redisQueueInit);
//$workerRedis->getFileAndAddToQueueRedis('file');

print $workerRedis->getItemFromQueueRedis();

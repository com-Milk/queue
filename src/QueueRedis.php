<?php
/**
 * Created by PhpStorm.
 * User: milk
 * Date: 30.11.15
 * Time: 20:13
 */


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
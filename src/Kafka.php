<?php
/**
 * Class Kafka
 */
namespace php_kafka;

class Kafka
{
    //kafka host
    public $broker_list = '127.0.0.1:9092';
    public $topic = 'test';
    public $partition = 0;
    public $logFile = './log/kafka.log';

    /**
     * Kafka constructor.
     * @param array $config
     *
     */
    public function __construct($config=[]){
        if ($config){
            $this->broker_list = isset($config["broker_list"])?$config["broker_list"]:"127.0.0.1:9092";
            $this->topic = isset($config["topic"])?$config["topic"]:"test";
            $this->partition = isset($config["partition"])?$config["partition"]:0;
            $this->logFile = isset($config["logFile"])?$config["logFile"]:"./log/kafka.log";
        }
    }

    /**
     * creater
     */
    public function producer($data){
        $conf = new \RdKafka\Conf();
        $conf->set('metadata.broker.list', $this->broker_list);
        $producer = new \RdKafka\Producer($conf);
        $topic = $producer->newTopic($this->topic);
        $topic->produce(RD_KAFKA_PARTITION_UA, $this->partition, json_encode($data));

        $producer->poll(0);
        $result = $producer->flush(5000);
        if (RD_KAFKA_RESP_ERR_NO_ERROR !== $result) {
            return false;
        }else{
            return true;
        }
    }

    /**
     * customer
     */
    public function consumer(){
        $conf = new \RdKafka\Conf();
        $conf->set('group.id', 0);
        $rk = new \RdKafka\Consumer($conf);
        $rk->addBrokers($this->broker_list);

        $topicConf = new \RdKafka\TopicConf();
        $topicConf->set('auto.commit.interval.ms', 2000);
        $topicConf->set('offset.store.method', 'broker');

        $topicConf->set('auto.offset.reset', 'smallest');

        $topic = $rk->newTopic($this->topic, $topicConf);
        $topic->consumeStart($this->partition, RD_KAFKA_OFFSET_STORED);
        $message = $topic->consume($this->partition, 3 * 1000);
        if ($message && !$message->err){
            return isset($message->payload)?$message->payload:"";
        }else{
            return false;
        }
    }

}
#### kafka+php

#### producer
```
    include_once "Kafka.php";
    $param = [
        "broker_list"=>"192.168.0.154:9092",
        "topic"=>"message",
        "partition"=>0,
        "log_file"=>"./log/kafka.log"
    ];

    $kf = new Kafka($param);
    $result = $kf->producer(["message"=>"tesdfs32"]);
    var_dump($result);
```

#### customer
```
    include_once "Kafka.php";
    $param = [
        "broker_list"=>"192.168.0.154:9092",
        "topic"=>"message",
        "partition"=>0,
        "log_file"=>"./log/kafka.log"
    ];

    $kf = new Kafka($param);
    $result = $kf->consumer();
    var_dump($result);
```
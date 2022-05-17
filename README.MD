#### kafka+php

#### producer
```
    $param = [
        "broker_list"=>"192.168.0.154:9092",
        "topic"=>"message",
        "partition"=>0,
        "log_file"=>"./log/kafka.log"
    ];

    $kf = new \yumichong501\kafka\Kafka($param);
    $result = $kf->producer(["message"=>"tesdfs32"]);
    var_dump($result);
```

#### customer
```
    $param = [
        "broker_list"=>"192.168.0.154:9092",
        "topic"=>"message",
        "partition"=>0,
        "log_file"=>"./log/kafka.log"
    ];

    $kf = new \yumichong501\kafka\Kafka($param);
    $result = $kf->consumer();
    var_dump($result);
```
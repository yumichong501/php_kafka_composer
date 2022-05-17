#### kafka+php

#### librdkafka
```
git clone https://github.com/edenhill/librdkafka.git
cd librdkafka/
./configure
make && make install
```

#### rdkafka
```
wget https://pecl.php.net/get/rdkafka-6.0.1.tgz
tar -zxvf rdkafka-6.0.1.tgz
cd rdkafka-6.0.1
phpize
./configure --with-php-config=xxx/php-config
make
make install

extension=rdkafka.so
```

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
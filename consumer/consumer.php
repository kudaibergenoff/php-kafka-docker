<?php
    $conf = new RdKafka\Conf();
    $conf->set('group.id', 'myConsumerGroup');
    $conf->set('metadata.broker.list', 'kafka:29092,kafka2:29093');

    $consumer = new RdKafka\KafkaConsumer($conf);
    $consumer->subscribe(['test', 'test2']);

    echo "Waiting for messages...\n";
    while (true) {
        $message = $consumer->consume(120*1000);
        switch ($message->err) {
            case RD_KAFKA_RESP_ERR_NO_ERROR:
                echo "Received message: " . $message->payload . "\n";
                break;
            case RD_KAFKA_RESP_ERR__PARTITION_EOF:
                echo "No more messages; will wait for more\n";
                break;
            case RD_KAFKA_RESP_ERR__TIMED_OUT:
                echo "Timed out\n";
                break;
            default:
                throw new \Exception($message->errstr(), $message->err);
                break;
        }
    }
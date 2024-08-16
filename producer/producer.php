<?php
$conf = new RdKafka\Conf();
$conf->set('metadata.broker.list', 'kafka:29092');

$producer = new RdKafka\Producer($conf);
$topic = $producer->newTopic("test");

for ($i = 0; $i < 10; $i++) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
    $producer->poll(0);
}

$topic = $producer->newTopic("test2");

for ($i = 0; $i < 100; $i++) {
    $topic->produce(RD_KAFKA_PARTITION_UA, 0, "Message $i");
    $producer->poll(0);
}

while ($producer->getOutQLen() > 0) {
    $producer->poll(50);
}

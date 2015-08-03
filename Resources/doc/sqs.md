# Amazon SQS usage#


```php
<?php

// in a controller
public function someAction()
{
    // create a queue (or get an existing one)
    $this->container->get('obtao.aws_sqs')->createQueue(array(
        'QueueName' => 'A_QUEUE_NAME',
    ));

    // or this if you're sure the queue exists
    $response = $this->container->get('obtao.aws_sqs')->getQueueUrl(array(
        'QueueName' => 'A_QUEUE_NAME',
    ));
    $queueUrl = $response->get('QueueUrl');

    // send a message to the given queue
    $this->container->get('obtao.aws_sqs')->sendMessage(array(
        'QueueUrl' => $queueUrl,
        'MessageBody' => 'A MESSAGE',
    ));

    // read messages
    $messageResponse = $this->container->get('obtao.aws_sqs')->receiveMessage(array(
        'QueueUrl' => $queueUrl,
        'MaxNumberOfMessages' => 10,
    ));

    // delete the messages
    foreach ($messageResponse->get('Messages') as $message) {
        $receiptHandle = $message['ReceiptHandle'];
        $this->container->get('obtao.aws_sqs')->deleteMessage(array(
            'QueueUrl' => $queueUrl,
            'ReceiptHandle' => $receiptHandle,
        ));
    }
}
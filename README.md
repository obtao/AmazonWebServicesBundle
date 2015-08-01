# Amazon Web Services Bundle #

## Overview ##
--------
This is a Symfony2 Bundle for interfacing with Amazon Web Services (AWS).

This bundle uses the [AWS SDK for PHP](http://docs.aws.amazon.com/AWSSDKforPHP/latest/) by loading the SDK, and enabling you to instantiate the SDK's various web service objects, passing them back to you for direct use in your Symfony2 application..

## Installation ##

Add this line to your `composer.json` file:
```json
"require": {
    ...
    "obtao/amazon-webservices-bundle": "*@stable"
}
```

Then run `composer update`.


Then, add AmazonWebServicesBundle to your application kernel:

```php
<?php

// app/AppKernel.php
public function registerBundles()
{
    return array(
        // ...
        new Obtao\AmazonWebServicesBundle\ObtaoAmazonWebServicesBundle(),
        // ...
    );
}
```

## Configuration ##

You can add the following default configuration to the config.yml file :
```yml
// app/config/config.yml
# Amazon Web Services Configuration
obtao_amazon_web_services:
    key:                        YOUR_KEY
    secret:                     YOUR_SECRET
    region:                     YOUR_REGION
```

## Usage ##

Once installed, you simply need to request the appropriate service for the Amazon Web Service object you wish to use. The returned object will then allow you full access the the API for the requested service.

**Please see the [AWS SDK for PHP documentation](http://docs.amazonwebservices.com/AWSSDKforPHP/latest/) for a list of each service's API calls.**

In this example, we get an AmazonSQS object from the AWS SDK for PHP library by requesting the ```aws_sqs``` service. We then use that object to retrieve a message from an existing Amazon SQS queue.

```php
<?php

// in a controller
public function someAction()
{
    $awsSQS = $this->container->get('obtao.aws_sqs');

    // create a queue (or get an existing one)
    $awsSQS->createQueue(array(
        'QueueName' => $queueName,
    ));
    // or this if you're sure the queue exists
    $awsSQS->getQueueUrl(array(
        'QueueName' => $queueName,
    ));


    // create messages in the given queue
    $response = $awsSQS->getQueueUrl(array(
        'QueueName' => $queueName,
    ));
    $awsSQS->sendMessage(array(
        'QueueUrl' => $response->get('QueueUrl'),
        // MessageBody is required
        'MessageBody' => $message,
    ));

    // read messages
    $response = $awsSQS->getQueueUrl(array(
        'QueueName' => $queueName,
    ));
    $awsSQS->receiveMessage(array(
        'QueueUrl' => $response->get('QueueUrl'),
        'MaxNumberOfMessages' => 10,
    ));
}
```

### Available Services ###

The following services are available, each returning an object allowing access to the respective Amazon Web Service

<table>
  <tr>
    <th>Symfony Service Name</th>
    <th>AWS SDK for PHP Object</th>
    <th>Description</th>
  </tr>

  <tr>
    <td>obtao.aws_sqs</td>
    <td><a href="http://docs.aws.amazon.com/AWSSDKforPHP/latest/#i=AmazonSQS">AmazonSQS</a></td>
    <td>Amazon Simple Queue Service</td>
  </tr>

</table>
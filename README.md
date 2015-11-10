# Amazon Web Services Bundle #

## Overview ##
--------
This is a Symfony2 Bundle for interfacing with Amazon Web Services (AWS).

This bundle uses the [AWS SDK for PHP](http://docs.aws.amazon.com/AWSSDKforPHP/latest/) by loading the SDK, and enabling you to instantiate the SDK's various web service objects, passing them back to you for direct use in your Symfony2 application..

## Installation ##

Add this line to your `composer.json` file:
```json
"require": {
    ...,
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
# app/config/config.yml
obtao_amazon_web_services:
    key:                        YOUR_KEY
    secret:                     YOUR_SECRET
    region:                     YOUR_REGION
```

## Usage ##

Once installed, you simply need to request the appropriate service for the Amazon Web Service object you wish to use. The returned object will then allow you full access the the API for the requested service.

**Please see the [AWS SDK for PHP documentation](http://docs.amazonwebservices.com/AWSSDKforPHP/latest/) for a list of each service's API calls.**

In this example, we get an AmazonSQS object from the AWS SDK for PHP library by requesting the ```obtao.aws_sqs``` service. We then use that object to retrieve a message from an existing Amazon SQS queue.

```php
<?php

// in a controller
public function someAction()
{
    // get the Simple Queue Service
    $awsSQS = $this->container->get('obtao.aws_sqs');

    // do something
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

  <tr>
    <td>obtao.aws_s3</td>
    <td><a href="http://docs.aws.amazon.com/AWSSDKforPHP/latest/#i=AmazonS3">AmazonS3</a></td>
    <td>Amazon Simple Storage Service</td>
  </tr>

</table>


### More documentation ###

- [Configuration reference](Resources/doc/reference.md)
- [Examples with SQS](Resources/doc/sqs.md)
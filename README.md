Amazon Web Services Bundle
==========================

Notice
======
This bundle is no longer being maintained. It is still usable with the 1.x version of AWS SDK, however no changes or bugfixes are going in. If someone is interested in taking over this bundle, please contact me and I'd be happy to transfer it to you.

[![Latest Stable Version](https://poser.pugx.org/Obtao/amazon-webservices-bundle/v/stable.png)](https://packagist.org/packages/Obtao/amazon-webservices-bundle)
[![Total Downloads](https://poser.pugx.org/Obtao/amazon-webservices-bundle/downloads.png)](https://packagist.org/packages/Obtao/amazon-webservices-bundle)

Overview
--------
This is a Symfony2 Bundle for interfacing with Amazon Web Services (AWS).

This bundle uses the [AWS SDK for PHP](http://github.com/amazonwebservices/aws-sdk-for-php) by loading the SDK, and enabling you to instantiate the SDK's various web service objects, passing them back to you for direct use in your Symfony2 application..

For installation, configuration, and usage details, please see [`Resources/doc/README.md`](https://github.com/Obtao/AmazonWebServicesBundle/blob/master/Resources/doc/README.md)

Changelog
---------
PR#15 submitted by @Fran6co requires a type chnage to the enable_extensions parameter in config.yml. See step 5b of [Resources/doc/README.md`](https://github.com/Obtao/AmazonWebServicesBundle/blob/master/Resources/doc/README.md) for the new format.

Example Use Cases
-----------------
1. Connect to, and manipulate, any of the available Amazon Web Services, such as EC2, SQS, CloudFront, S3, etc.

2. Utilize Amazon S3 and CloudFront as a Content Delivery Network (CDN) for a Symfony 2 application. Please see the information, graciously provided by [adurieux](https://github.com/adurieux), in [`Resources/doc/cdn.md`](https://github.com/Obtao/AmazonWebServicesBundle/blob/master/Resources/doc/cdn.md).

3. Score dates with Supermodels (This feature not yet implemented)


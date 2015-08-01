<?php

/*
 * This file is part of the ObtaoAmazonWebServicesBundle package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Obtao\AmazonWebServicesBundle\AWS;

use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Promise\RejectedPromise;

/**
 * AmazonWebServicesBundle Factory providing requested AWS objects
 */
class AmazonWebServicesFactory
{
    /**
     * @var array $amazonServices The Amazon Web Services that are already instanciated
     */
    private $amazonServices = array();

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $region;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $version;

    /**
     * @var array $validServiceTypes The names of the Amazon Web Services that may be used
     */
    private $validServiceTypes = array(
        'SQS' => 'Aws\Sqs\SqsClient',
    );

    /**
     * Constructor
     *
     * @param array $config     The user defined config
     */
    public function __construct(array $config)
    {
        if ($config['disable_auto_config'] && (! defined('AWS_DISABLE_CONFIG_AUTO_DISCOVERY'))) {
            define('AWS_DISABLE_CONFIG_AUTO_DISCOVERY', TRUE);
        }

        if (!empty($config['sdk_path']) && file_exists($config['sdk_path'])) {
            require_once $config['sdk_path'];
        }

        $this->key = $config['key'];
        $this->region = $config['region'];
        $this->secret = $config['secret'];
        $this->version = $config['version'];
    }

    /**
     * Get an Amazon Web Service object
     *
     * @param  string            $serviceType The requested Amazon Web Service type
     * @return mixed The requested Amazon Web Service Object
     * @throws \RuntimeException
     */
    public function get($serviceType)
    {
        if (! $this->isValidServiceType($serviceType)) {
            throw new \RuntimeException(sprintf('Invalid Amazon Web Service Type requested [%s]. Available are : %s', $serviceType, implode(',', $validServiceTypes)));
        }

        if (!array_key_exists($serviceType, $this->amazonServices)) {

            $classname = $this->validServiceTypes[$serviceType];
            $sqs = new $classname(array(
                'region'      => $this->region,
                'version'     => $this->version,
                'credentials' => $this->getProvider(),
            ));
        }

        $this->amazonServices[$serviceType] = $sqs;

        return $sqs;

    }

    /**
     * Determine if a requested Amazon Web Service is valid or not
     *
     * @param $type string The requested Amazon Web Service type
     * @return bool
     */
    private function isValidServiceType($type)
    {
        return array_key_exists($type, $this->validServiceTypes);
    }

    /**
     * Get a credential provider for AWS
     * See http://docs.aws.amazon.com/aws-sdk-php/v3/guide/guide/credentials.html#creating-a-custom-provider
     * @return Promise
     */
    private function getProvider()
    {
        return function () {
            if ($this->key && $this->secret) {
                return \guzzlehttp\promise\promise_for(
                    new \Aws\Credentials\Credentials($this->key, $this->secret, getenv('AWS_SESSION_TOKEN'))
                );
            }

            $msg = 'Could not find credentials. Maybe your api key or secret is wrong?';
            return new RejectedPromise(new \Aws\Exception\CredentialsException($msg));
        };
    }
}

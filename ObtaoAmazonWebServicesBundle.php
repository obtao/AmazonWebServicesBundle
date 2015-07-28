<?php

/**
 * @package    AmazonWebServicesBundle
 * @author     Mark Badolato <mbadolato@Obtao.com>
 * @copyright  Copyright (c) Cybernox Technologies. All rights reserved.
 * @license    http://www.opensource.org/licenses/BSD-2-Clause BSD License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Obtao\AmazonWebServicesBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Obtao\AmazonWebServicesBundle\StreamWrapper\S3StreamWrapper;

/**
 * AmazonWebServicesBundle Main Bundle Class
 */
class ObtaoAmazonWebServicesBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        if (in_array('s3', $this->container->getParameter('obtao_amazon_web_services.enable_extensions'))) {
            if (in_array('s3', stream_get_wrappers())) {
                stream_wrapper_unregister('s3');
            }

            S3StreamWrapper::register($this->container->get('aws_s3'), 's3');
        }
    }
}

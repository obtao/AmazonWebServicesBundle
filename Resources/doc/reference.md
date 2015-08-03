# Configuration reference #


```yml
# app/config/config.yml
# http://docs.aws.amazon.com/AWSSDKforPHP/latest/index.html#m=AmazonSQS/__construct
obtao_amazon_web_services:
    #Determines which Cerificate Authority file to use
    certificate_authority:                   false
    #The name of the credential set to use for authentication
    credentials:                             null
    #This option allows a preferred storage type to be configured for long-term caching
    default_cache_config:                    null
    # Your AWS key, or a session key
    key:                                     ~ # Required
    # Your region (http://docs.aws.amazon.com/general/latest/gr/rande.html)
    region:                                  ~ # Required
    # A custom SDK path
    sdk_path:                                null
    # Your AWS secret key, or a session secret key
    secret:                                  ~ # Required
    # An AWS session token
    token:                                   null
    # The SDK version to use
    version:                                 latest
```

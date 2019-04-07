# Callback Connection

This script will create a connection between a module and your own javaScript code by creating a callback method. This script will not work by itself. 

Please review the documentation on how to create a callback <a href="https://formsynergy.com/documentation/javascript-client/#script-create-callback">Callack</a>


## Install using composer
```bash
composer require form-synergy/custom-module
```

## Include the library
```php
require '/vendor/autoload.php';
```

##  Enable session management
```PHP
\FormSynergy\Session::enable();
```

## Import the Form Synergy class
```PHP
use \FormSynergy\Fs as FS;
```

You will need to retrieve your credentials in the Form Synergy console.

Console Access: https://formsynergy.com/console/

- $profileid = '';
- $apikey = '';
- $apisecret = '';

If you are a reseller
- $resellerid = '';




## Configuration
```PHP
FS::Config([
    'version' => 'v1',
    'protocol' => 'https',
    'endpoint' => 'api.formsynergy.com',
    'apikey' => $apikey,
    'secretkey' => $secretkey,
     //'resellerid' => $resellerid,  If you are a reseller
    'max_auth_count' => 15,
]);
```

## local storage
Enable local storage to store downloads and responses. 
```PHP
FS::Storage( '/', 'local-storage' );
```

## Load account
Load and start managing an account.
```PHP
$api = FS::Api()->Load($profileid);
```

## Run script
update the empty values with the appropriate information.
```PHP
\FormSynergy\Custom_Module::Run([
    'siteid' => '',
    'modid' => '',

    /*
     * To experience module connections, 
     * Please visit the playground page: https://formsynergy.com/playground/
     * 
     * NOTE: We are connecting this module
     * by providing a callback,
     * 
     * Creating a callback: https://formsynergy.com/documentation/javascript-client/#script-create-callback
     * 
     */ 
    'onsubmit' => 'callback:CustomCallbackMethod' 
])
```
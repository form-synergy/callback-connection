<?php
namespace FormSynergy;

/**
 * FormSynergy PHP Api template.
 *
 * This template requires the FormSynergy PHP Api.
 *
 * This script will create a connection between a module and your own javaScript code by creating a callback method. This script will not work by itself. 
 * Package repository: https://github.com/form-synergy/callback-connection
 *
 * @author     Joseph G. Chamoun <formsynergy@gmail.com>
 * @copyright  2019 FormSynergy.com
 * @licence    https://github.com/form-synergy/template-essentials/blob/dev-master/LICENSE MIT
 * @package    web-essentials
 */

/**
 * This package requires the FormSynergy PHP API
 * Install via composer: composer require form-synergy/php-api
 */
require_once 'vendor/autoload.php';

/**
 * Enable session manager
 */
\FormSynergy\Session::enable();

/**
 * Import the FormSynergy class
 */
use \FormSynergy\Fs as FS;

/**
 *
 * Web Essentials Class 
 *
 * @version 1.0
 */
class Callback_Connection
{

    public static function Run($data)
    {
 
        /**
         * Load account, this action requires the profile id
         */
        $api = FS::Api()->Load($data['profileid']);

        /**
         * The domain name in question must be already
         * registered and verified with FormSynergy.
         *
         * For more details regarding domain registration
         * API documentation: https://formsynergy.com/documentation/websites/
         *
         * You can clone the verification package from Github
         * Github repository: https://github.com/form-synergy/domain-verification
         *
         * Alternatively it can be installed via composer
         * composer require form-synergy/domain-verification
         */
        $api->Create('module')
        ->Attributes([
            'name' => 'My custom callback',
            'modid' => $data['modid'],
            'siteid' => $data['siteid'],
            'form' => [
                [
                    // x represents the index of a field.
                    'x' => 0,
                    'type' => 'text',
                    // system name will tell the processor how to handle the data.
                    'system' => 'fname',
                    'label' => 'First Name',
                    'name' => 'fname',
                    'class' => 'form-control'
                ],
                [
                    'x' => 1,
                    'type' => 'text',
                    'system' => 'lname',
                    'label' => 'Last Name',
                    'name' => 'lname',
                    'class' => 'form-control'
                ],
                [
                    'x' => 2,
                    'type' => 'email',
                    'system' => 'email',
                    'label' => 'Email Address',
                    'name' => 'email',
                    'class' => 'form-control',
                    // Email validation will check for patterns
                    'validation' => 'yes' // Enable validation
                ],
                [
                    'x' => 3,
                    'type' => 'tel',
                    'system' => 'mobile',
                    'label' => 'Phone Number',
                    'name' => 'mobile',
                    'class' => 'form-control',
                    /**
                     * Mobile validation will check if a phone number 
                     * is actually in service and can receive text messages. 
                     */
                    'validation' => 'yes' 
                ],
                [
                    'x' => 4,
                    'type' => 'text',
                    'system' => 'address',
                    'label' => 'Home address',
                    'name' => 'address',
                    'class' => 'form-control',
                    /**
                     * Address validation will enable Google's place autocomplete on the field.
                     */
                    'validation' => 'yes'
                ],
                [
                    'x' => 5,
                    'type' => 'textarea',
                    'system' => 'custom',
                    'label' => 'Message',
                    'name' => 'message',
                    'class' => 'form-control h-3' // <- Add class name h-3 for height: 3rem;
                ]
            ],

            /**
             * Module connections.
             * Each module can have two connection, and each connection can trigger an other module or callback method.
             */
            'onsubmit' => $data['callback'], // Use a callback method instead of a module id.
        ]);
        /**
         * To store resources and data
         **/
        FS::Store($api->_all());
    }
}


 
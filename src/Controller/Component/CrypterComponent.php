<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

/**
 * Crypter component
 */
class CrypterComponent extends Component
{
public $name = "Crypter";
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];
    public function enCrypt($data = null) {
        if ($data != null) {
            // Make an encryption resource using a cipher
            $td = mcrypt_module_open('cast-256', '', 'ecb', '');
            // Create and encryption vector based on the $td size and random
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
            // Initialize the module using the resource, my key and the string vector
            mcrypt_generic_init($td, Configure::read('Security.salt'), $iv);
            // Encrypt the data using the $td resource
            $encrypted_data = mcrypt_generic($td, $data);
            // Encode in base64 for DB storage
            $encoded = base64_encode($encrypted_data);
            // Make sure the encryption modules get un-loaded
            if (!mcrypt_generic_deinit($td) || !mcrypt_module_close($td)) {
                $encoded = false;
            }
        } else {
            $encoded = false;
        }
        return $encoded;
    }
    /**
     * This function will de-crypt the string that is passed to it
     *
     * @param String $data The string to be encrypted.
     * @return String Returns the encrypted string or false
     */
    public function deCrypt($data = null) {
        if ($data != null) {
            // The reverse of encrypt.  See that function for details
            $data = (string) base64_decode(trim($data));
            $td = mcrypt_module_open('cast-256', '', 'ecb', '');
            $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
            mcrypt_generic_init($td, Configure::read('Security.salt'), $iv);
            $data = (string) trim(mdecrypt_generic($td, $data));
            // Make sure the encryption modules get un-loaded
            if (!mcrypt_generic_deinit($td) || !mcrypt_module_close($td)) {
                $data = false;
            }
        } else {
            $data = false;
        }
        return $data;
    }
}

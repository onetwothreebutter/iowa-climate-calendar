<?php
/**
 * Created by PhpStorm.
 * User: ejohnson
 * Date: 3/11/15
 * Time: 8:25 PM
 */

class EncrypterDecrypter {

  public static function encrypt($verification_string) {

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'yourownkey';
    $secret_iv = 'yourowniv';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $encrypted = openssl_encrypt($verification_string, $encrypt_method, $key, 0, $iv);

    $encrypted = base64_encode($encrypted);



//  /* Open the cipher */
//  $td = mcrypt_module_open('rijndael-256', '', 'ofb', '');
//
//  /* Create the IV and determine the keysize length, use MCRYPT_RAND
//   * on Windows instead */
//  $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_RANDOM);
//  $ks = mcrypt_enc_get_key_size($td);
//
//  /* Create key */
//  $key = substr(md5('poopontheface'), 0, $ks);
//
//  /* Intialize encryption */
//  mcrypt_generic_init($td, $key, $iv);
//
//  /* Encrypt data */
//  $encrypted = mcrypt_generic($td, $verification_string);
//
//  /* Terminate encryption handler */
//  mcrypt_generic_deinit($td);

    return $encrypted;



  }


  public static function decrypt($encrypted_string) {

    $encrypted_string = base64_decode($encrypted_string);

    $encrypt_method = "AES-256-CBC";
    $secret_key = 'yourownkey';
    $secret_iv = 'yourowniv';

    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    $decrypted = openssl_decrypt($encrypted_string, $encrypt_method, $key, 0, $iv);


//  /* Open the cipher */
//  $td = mcrypt_module_open('rijndael-256', '', 'ofb', '');
//
//  /* Create the IV and determine the keysize length, use MCRYPT_RAND
//   * on Windows instead */
//  $iv = mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_DEV_RANDOM);
//  $ks = mcrypt_enc_get_key_size($td);
//
//  /* Create key */
//  $key = substr(md5('poopontheface'), 0, $ks);
//
//  /* Initialize encryption module for decryption */
//  mcrypt_generic_init($td, $key, $iv);
//
//  /* Decrypt encrypted string */
//  $decrypted = mdecrypt_generic($td, $encrypted_string);
//
//  /* Terminate decryption handle and close module */
//  mcrypt_generic_deinit($td);
//  mcrypt_module_close($td);

    return $decrypted;
  }
}
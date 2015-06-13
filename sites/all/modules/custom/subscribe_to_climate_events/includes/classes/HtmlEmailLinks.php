<?php
/**
 * Created by PhpStorm.
 * User: ejohnson
 * Date: 3/11/15
 * Time: 8:22 PM
 */

include_once('EncrypterDecrypter.php');

class HtmlEmailLinks {

  private $email;
  private $verification_string;
  private $encrypter_decrypter;
  private $access_token = '';

  public function __construct($email, $verification_string) {
    $this->email = $email;
    $this->verification_string = $verification_string;
    $this->encrypter_decrypter = new EncrypterDecrypter();

  }

  function generateEmailVerificationLink () {

    $access_token = $this->getAccessToken();

    $link_text = $_SERVER['HTTP_HOST'] . '/verify-email/'
      . $access_token;

    return l($link_text, $link_text);
  }



  function generateChangeSubscriptionLink() {

    $access_token = $this->getAccessToken();

    $link_text = 'Change Subscription';
    $link_path = $_SERVER['HTTP_HOST'] . '/change-subscription/'
      . $access_token;

    return l($link_text, $link_path);
  }


  function generateUnsubscribeLink() {

    $access_token = $this->getAccessToken();

    $link_text = 'Unsubscribe';
    $link_path = $_SERVER['HTTP_HOST'] . '/unsubscribe/'
      . $access_token;

    return l($link_text, $link_path);
  }


  function getAccessToken() {

    if($this->access_token === '') {
      $this->generateAccessToken();
    }

    return $this->access_token;
  }


  function generateAccessToken() {

    $combined_strings = $this->email . "--" . $this->verification_string;

    $this->access_token =
      EncrypterDecrypter::encrypt($combined_strings);
  }

}
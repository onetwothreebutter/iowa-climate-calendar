<?php

function verify_email_address() {
  $authentication_token = extractAuthenticationTokenFromGetRequest();
  if(is_authentication_key_valid($authentication_token)) {
    enable_account($GLOBALS['current_drupal_user']);
    drupal_set_message('Successfully verified email address');
  } else {
    drupal_set_message('Failed to verify email address');
  }

  drupal_goto('<front>');
}


function unsubscribe() {
  $authentication_token = extractAuthenticationTokenFromGetRequest();
  if(is_authentication_key_valid($authentication_token)) {
    unsubscribe_user($GLOBALS['current_drupal_user']);
    drupal_set_message('You have been unsubscribed');
  } else {
    drupal_set_message('Your unsubscription link has expired. ' . get_resend_change_subscription_link($authentication_token));
  }

  drupal_goto('<front>');

}


function change_subscription() {
  $authentication_token = extractAuthenticationTokenFromGetRequest();
  if(is_authentication_key_valid($authentication_token)) {
    log_user_in();
    redirect_to_profile();
  } else {
    drupal_set_message('Your change subscription link has expired. ' . get_resend_change_subscription_link($authentication_token));
    drupal_goto('<front>');
  }


}

function get_resend_change_subscription_link($authentication_token) {
  return '<a href="/resend-change-subscription/' . $authentication_token . '">resend email with new link</a>';
}

function resend_change_subscription() {
  $email = extractEmailAddressFromAuthenticationToken();
  sendResendSubscriptionChangeEmail($email);
  drupal_set_message('A new change subscription/unsubscribe email has been sent');
  drupal_goto('<front>');
}

function extractEmailAddressFromAuthenticationToken() {
  $auth_token = extractAuthenticationTokenFromGetRequest();
  include_once(DRUPAL_ROOT . '/sites/all/modules/custom/subscribe_to_climate_events/includes/classes/EncrypterDecrypter.php');
  $verification_string = EncrypterDecrypter::decrypt($auth_token);
  return extractEmailFromVerification($verification_string);
}


function extractAuthenticationTokenFromGetRequest() {
  return explode('/',$_GET['q'])[1];
}


function is_authentication_key_valid($encrypted_verification_string) {
  include_once(DRUPAL_ROOT . '/sites/all/modules/custom/subscribe_to_climate_events/includes/classes/EncrypterDecrypter.php');
  $verification_string = EncrypterDecrypter::decrypt($encrypted_verification_string);
  $email = extractEmailFromVerification($verification_string);
  $account = user_load_by_mail($email);
  $GLOBALS['current_drupal_user'] = $account;
  $profile = profile2_load_by_user($account, 'subscription');

  $verification_key = extractKeyFromVerification($verification_string);
  return $verification_key === $profile->field_email_verification_string['und'][0]['value'];
}


function enable_account($account) {
  $account->status = 1;
  user_save($account);
}


function unsubscribe_user($account) {
  // just disable the subscription but keep account
//  $profile = profile2_load_by_user($account, 'subscription');
//  $profile->field_subscription_enabled['und'][0]['value'] = 0;
//  profile2_save($profile);
  user_delete($account->uid);
}


function redirect_to_profile() {
  global $user;
  drupal_goto('user/' .  $user->uid . '/edit/subscription');
}


function log_user_in() {
  global $user;
  $user = $GLOBALS['current_drupal_user'];
  $login_array = array ('name' => $user->name);
  user_login_finalize($login_array);
}




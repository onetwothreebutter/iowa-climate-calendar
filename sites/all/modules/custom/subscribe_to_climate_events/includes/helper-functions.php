<?php




function getEventTypes() {

  $event_types = [];
  $vocabulary = taxonomy_vocabulary_machine_name_load('event_type');
  $terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));

  foreach ($terms as $term) {
    $event_types[$term->tid] = $term->name;
  }

  return $event_types;
}


function getZipCodeDistances() {

  $distances = [];

  $vocabulary = taxonomy_vocabulary_machine_name_load('zip_code_distances');
  $terms = entity_load('taxonomy_term', FALSE, array('vid' => $vocabulary->vid));

  foreach ($terms as $term) {
    $distances[$term->tid] = $term->name;
  }

  return $distances;
}


function extractEventTypesIntoArrayForProfile($form_state) {
  $formatted = [];

  foreach($form_state['values']['event_types'] as $event) {
    if($event !== 0) {
      $formatted[] = array('tid' => $event);
    }
  }

  return $formatted;
}


function generateVerificationString($length = 10) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}


//TODO: refactor?
function getWeeklyEmailSendDateTime() {
  return '';
}





function createUserProfile($account) {
  $profile = profile_create(array('user' => $account, 'type' => 'subscription'));
  profile2_save($profile);
  $profile = profile2_load_by_user($account) ;

  return $profile;
}


function saveFormDataToUserProfile($profile, $form_state) {
  $profile['subscription']->field_event_subscription_distanc['und'][0]['tid'] = $form_state['values']['distance_from_zip'];
  $profile['subscription']->field_event_type['und'] = extractEventTypesIntoArrayForProfile($form_state);
  $profile['subscription']->field_zip_code['und'][0]['value'] = $form_state['values']['zip'];
  $profile['subscription']->field_urgent_emails['und'][0]['value'] = $form_state['values']['urgent_emails'];

  profile2_save($profile['subscription']);
}


function saveVerificationStringToUserProfile($profile, $verification_string) {

  if (is_array($profile)) {
    $profile = $profile['subscription'];
  }

  $profile->field_email_verification_string['und'][0]['value'] = $verification_string;

  profile2_save($profile);
}


function extractEmailFromVerification($verification) {
  $email = explode('--', $verification)[0];
  return $email;
}


function extractKeyFromVerification($verification) {
  $key = explode('--', $verification)[1];
  return $key;
}
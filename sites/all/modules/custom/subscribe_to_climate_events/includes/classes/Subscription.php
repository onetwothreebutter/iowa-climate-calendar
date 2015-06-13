<?php
/**
 * Created by PhpStorm.
 * User: ejohnson
 * Date: 4/18/15
 * Time: 5:17 PM
 */

class Subscription {
  private $drupal_subscription;
  private $matching_events = [];

  public function __construct($drupal_subscription) {
    $this->drupal_subscription = $drupal_subscription;
    //$this->
  }

  public function getDrupalSubscriptionObject() {
    return $this->drupal_subscription;
  }

  public function addEventIfItMatchesSubscription($event) {
    if ($this->doesEventMatchSubscription($event)) {
      $this->addMatchingEvent($event);
    }
  }

  public function doesEventMatchSubscription($event) {

     return $this->isEventWithinSpecifiedDistance($event) &&
      $this->isEventInSpecifiedTypes($event);

  }

  private function isEventWithinSpecifiedDistance($event) {
    require_once( DRUPAL_ROOT . '/sites/all/modules/custom/climate_events/includes/functions_for/climate_events_menu.php');
    require_once( DRUPAL_ROOT . '/sites/all/modules/custom/climate_events/includes/classes/DrupalWrappers/ZipCode.php');
    $event_lat_long = $event->getLatLong();
    $zip = new ZipCode($this->getDrupalSubscriptionObject()->field_zip_code['und'][0]['value']);
    $subscription_lat_long = $zip->getLatLong();
    $distance = getDistanceInMilesBetweenLatLongPoints($event_lat_long, $subscription_lat_long);

    return ($distance < $this->getSubscriptionNotificationDistance());

  }

  private function isEventInSpecifiedTypes($event) {

    $event_types = $event->getEventTypes();
    $subscription_types = $this->getSubscriptionEventTypes();
    return !empty(array_intersect($event_types, $subscription_types));
  }


  public function addMatchingEvent($event) {
    $this->matching_events[] = $event;
  }

  public function getMatchingEvents() {
    return $this->matching_events;
  }

  public function hasMatchingEvents() {
    return count($this->matching_events) > 0;
  }

  public function getSubscriptionNotificationDistance() {
    $distance_taxonomy_id = $this->getDrupalSubscriptionObject()->field_event_subscription_distanc['und'][0]['tid'];
    $distance_taxonomy_obj = taxonomy_term_load($distance_taxonomy_id);
    //ugh, this should be cleaner
    $distance = str_replace(' miles', '', $distance_taxonomy_obj->name);
    $distance = intval($distance);

    //the all or state wide option will evaluate to 0
    if($distance === 0) {
      $distance = 1000000;
    }

    return $distance;
  }

  private function getSubscriptionEventTypes() {
    $event_types = $this->drupal_subscription->field_event_type['und'];

    $simple_array_of_event_types = [];
    foreach($event_types as $e) {
      $simple_array_of_event_types[] = $e['tid'];
    }
    return $simple_array_of_event_types;
  }

  public function getEmailAddress() {
    $user = user_load($this->getDrupalSubscriptionObject()->uid);
    return $user->mail;
  }



}
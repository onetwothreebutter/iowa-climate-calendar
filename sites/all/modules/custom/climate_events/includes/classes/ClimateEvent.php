<?php

$include_root = DRUPAL_ROOT . '/sites/all/modules/custom/climate_events/includes/classes/';
include_once($include_root . 'LatitudeLongitude.php');
include_once($include_root . 'DrupalWrappers/Address.php');
include_once($include_root . 'GoogleMapsAPI.php');

class ClimateEvent {
  private $drupal_climate_event;
  private $address;

  public function __construct($drupal_climate_event) {


    //this gets called from Drupal and from a Services call
    if($this->calledFromDrupal($drupal_climate_event)) {
      $this->drupal_climate_event = $drupal_climate_event;
      $this->address = new Address($drupal_climate_event->field_event_address);
    } else if ($this->calledFromService($drupal_climate_event)) {
      $this->drupal_climate_event = $drupal_climate_event->_field_data['nid']['entity'];
      $this->address = new Address($drupal_climate_event->_field_data['nid']['entity']->field_event_address);
    }

  }

  public function getLatLong() {
    return new LatitudeLongitude($this->getLatitude(), $this->getLongitude());
  }

  public function getLatitude() {
    if(!$this->hasLatLongBeenCalculated()) {
      $this->calculateLatLong();
    }
    return $this->drupal_climate_event->field_latitude[$this->drupal_climate_event->language][0]['value'];
  }

  public function getLongitude() {
    if(!$this->hasLatLongBeenCalculated()) {
      $this->calculateLatLong();
    }
    return $this->drupal_climate_event->field_longitude[$this->drupal_climate_event->language][0]['value'];
  }

  private function setDrupalLatitude($lat) {
    $this->drupal_climate_event->field_latitude[$this->drupal_climate_event->language][0]['value'] = $lat;
  }

  private function setDrupalLongitude($long) {
    $this->drupal_climate_event->field_longitude[$this->drupal_climate_event->language][0]['value'] = $long;
  }

  public function calculateLatLong() {
    $google_maps_api = new GoogleMapsAPI();
    $lat_long = $google_maps_api->calculateLatLongFromAddress($this->address);
    $this->setDrupalLatitude($lat_long->getLatitude());
    $this->setDrupalLongitude($lat_long->getLongitude());
  }

  public function getDrupalObject() {
    return $this->drupal_climate_event;
  }

  public function getEventTypes() {
    $event_types = $this->drupal_climate_event->field_event_type['und'];
    foreach($event_types as $e) {
      $simple_array_of_event_types[] = $e['tid'];
    }
    return $simple_array_of_event_types;
  }

  private function hasLatLongBeenCalculated() {
    if (empty($this->drupal_climate_event->field_longitude) ||
      empty($this->drupal_climate_event->field_longitude)) {
      return false;
    } else {
      return true;
    }
  }

  private function calledFromDrupal($drupal_climate_event) {
    return !empty($drupal_climate_event->field_event_address);
  }

  private function calledFromService($drupal_climate_event) {
    return !empty($drupal_climate_event->field_field_event_address);
  }

  public function getEventStartTime() {
    $date_object = new DateObject($this->getDrupalObject()->field_event_date_time['und'][0]['value'], new DateTimeZone('UTC'));
    $date_object->setTimezone(new DateTimeZone('America/Chicago'));
    return date_format_date($date_object, 'custom', 'Y-m-d H:i:s');
  }

  public function getEventEndTime() {
    $date_object = new DateObject($this->getDrupalObject()->field_event_date_time['und'][0]['value'], new DateTimeZone('UTC'));
    $date_object->setTimezone(new DateTimeZone('America/Chicago'));
    return date_format_date($date_object, 'custom', 'Y-m-d H:i:s');;
  }

  public function getEventTitle() {
    return $this->getDrupalObject()->title;
  }

  public function getEventDescription() {
    return $this->getDrupalObject()->body['und'][0]['value'];
  }

  public function getEventTypeNames() {
    $event_type_objects = taxonomy_term_load_multiple($this->getEventTypes());
    $event_type_names = [];

    foreach($event_type_objects as $eto) {
      $event_type_names[] = $eto->name;
    }

    return $event_type_names;
  }

  public function getEventVenue() {
      return $this->getDrupalObject()->field_event_venue['und'][0]['safe_value'];
  }

  //tried putting this in the template, but Drupal was doing some weird shit with line breaks
  public function getEventTypeNamesForHTMLEmail() {
    $html = '';
    foreach ($this->getEventTypeNames() as $event_type_name) {
      $html .= '<span class="" style="background:#DDDDDD; padding: 3px 5px 3px 5px; margin-right: 10px; white-space: nowrap;">' .
        $event_type_name .
        '</span>';
    }

    return $html;
  }

  //tried putting this in the template, but Drupal was doing some weird shit with line breaks
  public function getEventAddressForHTMLEmail() {

    $html = $this->getEventVenue() . '<br/>' .
              $this->getAddressObject()->getStreet() . '<br/>' .
             $this->getAddressObject()->getCity() . ', ' . $this->getAddressObject()->getState() . ' ' . $this->getAddressObject()->getZip();

    return $html;
  }

  public function getAddressObject() {
    return $this->address;
  }




}
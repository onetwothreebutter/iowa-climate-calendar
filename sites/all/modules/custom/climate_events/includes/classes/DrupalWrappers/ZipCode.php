<?php

$include_root = DRUPAL_ROOT . '/sites/all/modules/custom/climate_events/includes/classes/';
include_once($include_root . 'LatitudeLongitude.php');
include_once($include_root . 'GoogleMapsAPI.php');

class ZipCode {

  private $zip;
  private $drupal_zip;

  public function __construct($zip) {
    $this->zip = $zip;
    $this->drupal_zip = $this->getDrupalZip($zip);
  }

  private function getDrupalZip($zip) {
    $results = views_get_view_result('zip_code', null, $zip);

    if (count($results) > 1) {
      throw new Exception('Found more than one zip code match');
    } else if (count($results) === 0) {
       return $this->createDrupalNodeForZip($zip);
    } else {
       return $results[0]->_field_data['nid']['entity'];
    }


  }

  public function getLatLong() {
    $lat = $this->getLatitude();
    $long = $this->getLongitude();
    return new LatitudeLongitude($lat, $long);
  }

  public function getLatitude() {
    if(!$this->hasLatLongBeenDetermined()) {
      $this->determineLatLong();
    }
    return $this->drupal_zip->field_latitude['und'][0]['value'];
  }

  public function getLongitude() {
    if(!$this->hasLatLongBeenDetermined()) {
      $this->determineLatLong();
    }
    return $this->drupal_zip->field_longitude['und'][0]['value'];
  }

  private function hasLatLongBeenDetermined() {
    return !empty($this->drupal_zip->field_latitude) &&
      !empty($this->drupal_zip->field_longitude);
  }

  private function setDrupalLatLong($lat_long) {
    $this->drupal_zip->field_latitude['und'][0]['value'] = $lat_long->getLatitude();
    $this->drupal_zip->field_longitude['und'][0]['value'] = $lat_long->getLongitude();
    node_save($this->drupal_zip);
  }

  private function determineLatLong() {
    $google_maps_api = new GoogleMapsAPI();
    $lat_long = $google_maps_api->calculateLatLong($this->zip);
    $this->setDrupalLatLong($lat_long);
  }

  private function createDrupalNodeForZip() {
    $google_maps_api = new GoogleMapsAPI();

    $lat_long = $google_maps_api->calculateLatLong($this->zip);

    $node = new stdClass();
    $node->title = $this->zip;
    $node->type = 'zip_code';
    node_object_prepare($node); // Sets some defaults. Invokes hook_prepare() and hook_node_prepare().
    $node->language = LANGUAGE_NONE; // Or e.g. 'en' if locale is enabled
    $node->uid = 1;
    $node->status = 1; //(1 or 0): published or not
    $node->promote = 0; //(1 or 0): promoted to front page
    $node->comment = 0; // 0 = comments disabled, 1 = read only, 2 = read/write

    $node->field_latitude[$node->language][0]['value'] = $lat_long->getLatitude();
    $node->field_longitude[$node->language][0]['value'] = $lat_long->getLongitude();

    $node = node_submit($node); // Prepare node for saving
    node_save($node);

    return $node;
  }


}
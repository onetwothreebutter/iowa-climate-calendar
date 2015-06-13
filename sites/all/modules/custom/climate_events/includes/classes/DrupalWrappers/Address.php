<?php

class Address {

  private $drupal_address;

  public function __construct($drupal_address) {
    $this->drupal_address = $drupal_address;
  }

  public function getStreet() {
    return $this->drupal_address['und'][0]['thoroughfare'];
  }

  public function getCity() {
    return $this->drupal_address['und'][0]['locality'];
  }

  public function getState() {
    return $this->drupal_address['und'][0]['administrative_area'];
  }

  public function getZip() {
    return $this->drupal_address['und'][0]['postal_code'];
  }

  public function getLatitude() {
    return '';
  }

  public function getLongitude() {
    return '';
  }


}
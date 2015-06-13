<?php

include_once('LatitudeLongitude.php');
include_once('DrupalWrappers/Address.php');

class GoogleMapsAPI {
  public function calculateLatLong($address) {

    $google_api_results = $this->executeGoogleMapsAPICall($address);
    $lat_long_json_obj = $this->parseLatLongFromGoogleApiResults($google_api_results);
    $lat_long = new LatitudeLongitude($lat_long_json_obj->lat, $lat_long_json_obj->lng);

    return $lat_long;
  }

  private function executeGoogleMapsAPICall($address) {
    $ch = curl_init();

    $curl_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $address;
    curl_setopt($ch, CURLOPT_URL, $curl_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);

    if (curl_errno($ch)) {
      throw new Exception('Error querying Google Maps API: curl error ' . curl_strerror(curl_errno($ch)) );
    }

    curl_close ($ch);

    return $server_output;
  }

  private function parseLatLongFromGoogleApiResults($googleAPIResults) {
    $json = json_decode($googleAPIResults);
    return (isset($json->results[0])) ? $json->results[0]->geometry->location : '';
  }

  public function calculateLatLongFromAddress($address) {
    $address_query_string = $address->getStreet() . ', ' . $address->getCity() . ', ' . $address->getState() . ' ' . $address->getZip();
    $address_query_string = urlencode($address_query_string);
    return $this->calculateLatLong($address_query_string);
  }
}
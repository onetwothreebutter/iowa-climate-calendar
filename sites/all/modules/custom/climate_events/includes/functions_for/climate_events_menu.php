<?php

function get_climate_events_by_distance_from_zip() {
 $all_climate_events = getAllClimateEvents();
  $distance = getDistanceFromGetParams();
  $zip = getZipFromGetParams();
  $filtered_climate_events = filterClimateEventsByDistanceFromZip($all_climate_events, $distance, $zip);
  $json_formatted_filtered_climate_events = formatClimateEventObjectsIntoJSON($filtered_climate_events, $distance);

  drupal_json_output($json_formatted_filtered_climate_events);
}


function getDistanceFromGetParams() {
  $url_params = $_GET['q'];
  return explode('/', $url_params)[3];
}


function getZipFromGetParams() {
  $url_params = $_GET['q'];
  return explode('/', $url_params)[2];
}


function getAllClimateEvents() {
  return views_get_view_result('climate_events', 'services_1');
}


function filterClimateEventsByDistanceFromZip($climate_events, $distance, $zip) {
  include_once(DRUPAL_ROOT . '/sites/all/modules/custom/climate_events/includes/classes/ClimateEvent.php');
  include_once(DRUPAL_ROOT . '/sites/all/modules/custom/climate_events/includes/classes/DrupalWrappers/ZipCode.php');

  if($distance === 'all') {
    return $climate_events;
  }

  $zip = new ZipCode($zip);
  $climate_events_within_range = [];
  foreach($climate_events as $drupal_climate_event) {
    $climate_event = new ClimateEvent($drupal_climate_event);

    if(getDistanceInMilesBetweenLatLongPoints($climate_event->getLatLong(), $zip->getLatLong()) < $distance) {
      $climate_events_within_range[] = $drupal_climate_event;
    }
  }

  return $climate_events_within_range;

}


function getDistanceInMilesBetweenLatLongPoints($event_latlong, $point_latlong){
  $radius_of_earth_in_miles = 3961;

  $dLat = deg2rad($event_latlong->getLatitude() - $point_latlong->getLatitude());
  $dLon = deg2rad($event_latlong->getLongitude() - $point_latlong->getLongitude());
  $lat1 = deg2rad($event_latlong->getLatitude());
  $lat2 = deg2rad($point_latlong->getLatitude());

  $a = sin($dLat/2) * sin($dLat/2) +
    sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);

  $c = 2 * atan2(sqrt($a), sqrt(1-$a));
  return $radius_of_earth_in_miles * $c;
}


function formatClimateEventObjectsIntoJSON($climate_events, $distance) {
  //TODO: refactor so this doesn't have non-formatting logic in it
  include_once(DRUPAL_ROOT . '/sites/all/modules/services_views/services_views.resource.inc');
  $view_info['view_name'] = 'climate_events';
  $view_info['display_id'] = 'services_1';
  $climate_events_view = views_get_view('climate_events', 'services_1');
  $nids = getNidsFromViewResults($climate_events);
  //$nids = implode('|',$nids);
  if (empty($nids) && $distance !== 'all') {
    return [];
  }

  if ($distance !== 'all') {
    $climate_events_view->set_arguments(array($nids));
    //TODO: refactor so we call this function in the first place and don't have to call it
    // again here
  }
    $result = services_views_execute_view(null, $climate_events_view, 'services_1');


  $result = addEventTypeNameAlongsideTypeId($result);
  $result = renameClimateEventsKeys($result);
  $result = groupByEventDay($result);
  return $result;
}

function formatClimateEventObjectIntoJSON($climate_event, $drupal_to_json_mappings) {
  $formatted_event = [];
  $climate_event_obj = $climate_event->_field_data['nid']['entity'];

  foreach($drupal_to_json_mappings as $key => $value) {
    $formatted_event[$value['label']] = $climate_event_obj->{$key};
  }
}

function getNidsFromViewResults($results) {
  $nids = [];
  foreach($results as $key => $value) {
    $nids[] = $value->nid;
  }
  return $nids;
}

//function filterResultsHereBecauseICantGetViewsToFilterBasedOnMyArguments($results_to_filter, $nids) {
//  $filtered_results = [];
//  foreach($results_to_filter as $key => $value) {
//    if($value->nid) {
//      $filtered_results[] = $value;
//    }
//  }
//  return $filtered_results;
//}
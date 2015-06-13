<?php


function isClimateEventsService($args) {
  return $args[0]['view_name'] === 'climate_events' && $args[0]['display_id'] === 'services_1';
}


function isClimateDistancesService($args) {
  return $args[0]['view_name'] === 'climate_distances' && $args[0]['display_id'] === 'services_1';
}


function renameClimateEventsKeys($result) {

  foreach($result as $a) {
    $a->{'event-time'} = strip_tags($a->{'event-time'});
    $a->{'event-day'} = strip_tags($a->{'event-day'});
  }

  return $result;
}


function groupByEventDay($result) {

  $grouped_results = new StdClass;

  foreach($result as $a) {
    $grouped_results->{$a->{'event-day'}}[] = $a;
  }

  return array($grouped_results);
}


function renameClimateDistanceKeys($result) {
  foreach($result as $distance) {
    $distance->{'distance-value'} = extractDistance($distance->{'distance-name'});
  }

  return $result;
}


function extractDistance($distance_name) {
  $distance_number = str_replace(' miles', '', $distance_name);

  $return_value = intval($distance_number);
  if($return_value === 0) {
    $return_value = 'all';
  }

  return $return_value . '';
}

function addEventTypeNameAlongsideTypeId($result) {

  foreach($result as $key1 => $climate_event) {

    $event_type_ids = $climate_event->{'event-type-ids'};

    foreach($event_type_ids as $key2 => $event_type_id) {
      $result[$key1]->{'event-type-ids'}[$key2]['name'] = getTaxonomyNameFromTermId($event_type_id['tid']);
    }
  }

  return $result;
}


function addClimateDistanceAlongsideDistanceName($result) {
  //$result = addClimateDistanceAlongsideDistanceName($result);
}


function getTaxonomyNameFromTermId($term_id) {
  $term = taxonomy_term_load($term_id);
  return $term->name;
}









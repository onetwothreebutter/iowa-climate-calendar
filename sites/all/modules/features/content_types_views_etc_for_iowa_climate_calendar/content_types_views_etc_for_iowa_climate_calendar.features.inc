<?php
/**
 * @file
 * content_types_views_etc_for_iowa_climate_calendar.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function content_types_views_etc_for_iowa_climate_calendar_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "services" && $api == "services") {
    return array("version" => "3");
  }
}

/**
 * Implements hook_views_api().
 */
function content_types_views_etc_for_iowa_climate_calendar_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_node_info().
 */
function content_types_views_etc_for_iowa_climate_calendar_node_info() {
  $items = array(
    'climate_change_event' => array(
      'name' => t('Climate Change Event'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
    'zip_code' => array(
      'name' => t('Zip Code'),
      'base' => 'node_content',
      'description' => t('Stores the latitude and longitude for a zip code, usually the center point of the rectangle bounding box of the zip code'),
      'has_title' => '1',
      'title_label' => t('Zip Code'),
      'help' => '',
    ),
  );
  drupal_alter('node_info', $items);
  return $items;
}

/**
 * Implements hook_default_profile2_type().
 */
function content_types_views_etc_for_iowa_climate_calendar_default_profile2_type() {
  $items = array();
  $items['subscription'] = entity_import('profile2_type', '{
    "userCategory" : true,
    "userView" : true,
    "type" : "subscription",
    "label" : "Subscription",
    "weight" : "0",
    "data" : { "registration" : 1 },
    "rdf_mapping" : []
  }');
  return $items;
}

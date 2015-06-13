<?php
/**
 * @file
 * content_types_views_etc_for_iowa_climate_calendar.views_default.inc
 */

/**
 * Implements hook_views_default_views().
 */
function content_types_views_etc_for_iowa_climate_calendar_views_default_views() {
  $export = array();

  $view = new view();
  $view->name = 'climate_distances';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'taxonomy_term_data';
  $view->human_name = 'Climate Distances';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['style_plugin'] = 'views_json';
  $handler->display->display_options['style_options']['root_object'] = 'distances';
  $handler->display->display_options['style_options']['top_child_object'] = 'distance';
  $handler->display->display_options['style_options']['plaintext_output'] = 1;
  $handler->display->display_options['style_options']['remove_newlines'] = 0;
  $handler->display->display_options['style_options']['jsonp_prefix'] = '';
  $handler->display->display_options['style_options']['using_views_api_mode'] = 0;
  $handler->display->display_options['style_options']['object_arrays'] = 0;
  $handler->display->display_options['style_options']['numeric_strings'] = 0;
  $handler->display->display_options['style_options']['bigint_string'] = 0;
  $handler->display->display_options['style_options']['pretty_print'] = 0;
  $handler->display->display_options['style_options']['unescaped_slashes'] = 0;
  $handler->display->display_options['style_options']['unescaped_unicode'] = 0;
  $handler->display->display_options['style_options']['char_encoding'] = array();
  /* Field: Taxonomy term: Name */
  $handler->display->display_options['fields']['name']['id'] = 'name';
  $handler->display->display_options['fields']['name']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['fields']['name']['field'] = 'name';
  $handler->display->display_options['fields']['name']['label'] = 'distance-name';
  $handler->display->display_options['fields']['name']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['name']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['name']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['name']['link_to_taxonomy'] = TRUE;
  /* Field: Taxonomy term: Term ID */
  $handler->display->display_options['fields']['tid']['id'] = 'tid';
  $handler->display->display_options['fields']['tid']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['fields']['tid']['field'] = 'tid';
  $handler->display->display_options['fields']['tid']['label'] = 'distance-value';
  $handler->display->display_options['fields']['tid']['element_label_colon'] = FALSE;
  /* Filter criterion: Taxonomy vocabulary: Machine name */
  $handler->display->display_options['filters']['machine_name']['id'] = 'machine_name';
  $handler->display->display_options['filters']['machine_name']['table'] = 'taxonomy_vocabulary';
  $handler->display->display_options['filters']['machine_name']['field'] = 'machine_name';
  $handler->display->display_options['filters']['machine_name']['value'] = array(
    'zip_code_distances' => 'zip_code_distances',
  );

  /* Display: Services */
  $handler = $view->new_display('services', 'Services', 'services_1');
  $handler->display->display_options['path'] = 'climate-distances';
  $export['climate_distances'] = $view;

  $view = new view();
  $view->name = 'climate_events';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Climate Events';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['pager']['options']['items_per_page'] = '0';
  $handler->display->display_options['pager']['options']['offset'] = '0';
  $handler->display->display_options['pager']['options']['id'] = '0';
  $handler->display->display_options['pager']['options']['quantity'] = '9';
  $handler->display->display_options['style_plugin'] = 'views_json';
  $handler->display->display_options['style_options']['root_object'] = 'climate-events';
  $handler->display->display_options['style_options']['top_child_object'] = 'climate-event';
  $handler->display->display_options['style_options']['field_output'] = 'raw';
  $handler->display->display_options['style_options']['plaintext_output'] = 1;
  $handler->display->display_options['style_options']['remove_newlines'] = 0;
  $handler->display->display_options['style_options']['jsonp_prefix'] = '';
  $handler->display->display_options['style_options']['using_views_api_mode'] = 1;
  $handler->display->display_options['style_options']['object_arrays'] = 0;
  $handler->display->display_options['style_options']['numeric_strings'] = 0;
  $handler->display->display_options['style_options']['bigint_string'] = 0;
  $handler->display->display_options['style_options']['pretty_print'] = 0;
  $handler->display->display_options['style_options']['unescaped_slashes'] = 0;
  $handler->display->display_options['style_options']['unescaped_unicode'] = 0;
  $handler->display->display_options['style_options']['char_encoding'] = array();
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = 'event-title';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['title']['element_label_colon'] = FALSE;
  /* Field: Content: Event Address - Locality (i.e. City) */
  $handler->display->display_options['fields']['field_event_address_locality']['id'] = 'field_event_address_locality';
  $handler->display->display_options['fields']['field_event_address_locality']['table'] = 'field_data_field_event_address';
  $handler->display->display_options['fields']['field_event_address_locality']['field'] = 'field_event_address_locality';
  $handler->display->display_options['fields']['field_event_address_locality']['label'] = 'city';
  $handler->display->display_options['fields']['field_event_address_locality']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_address_locality']['element_default_classes'] = FALSE;
  /* Field: Content: Event Date/Time */
  $handler->display->display_options['fields']['field_event_date_time']['id'] = 'field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time']['table'] = 'field_data_field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time']['field'] = 'field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time']['label'] = 'event-date';
  $handler->display->display_options['fields']['field_event_date_time']['alter']['text'] = '[field_event_date_time-value]';
  $handler->display->display_options['fields']['field_event_date_time']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_date_time']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_event_date_time']['settings'] = array(
    'format_type' => 'day_of_week_month_day',
    'fromto' => 'value',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
  );
  /* Field: Content: Event Date/Time */
  $handler->display->display_options['fields']['field_event_date_time_2']['id'] = 'field_event_date_time_2';
  $handler->display->display_options['fields']['field_event_date_time_2']['table'] = 'field_data_field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time_2']['field'] = 'field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time_2']['label'] = 'event-day';
  $handler->display->display_options['fields']['field_event_date_time_2']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_date_time_2']['settings'] = array(
    'format_type' => 'month_day',
    'fromto' => 'value',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
  );
  /* Field: Time of Event */
  $handler->display->display_options['fields']['field_event_date_time_1']['id'] = 'field_event_date_time_1';
  $handler->display->display_options['fields']['field_event_date_time_1']['table'] = 'field_data_field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time_1']['field'] = 'field_event_date_time';
  $handler->display->display_options['fields']['field_event_date_time_1']['ui_name'] = 'Time of Event';
  $handler->display->display_options['fields']['field_event_date_time_1']['label'] = 'event-time';
  $handler->display->display_options['fields']['field_event_date_time_1']['alter']['text'] = '[field_event_date_time_1]';
  $handler->display->display_options['fields']['field_event_date_time_1']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_date_time_1']['element_default_classes'] = FALSE;
  $handler->display->display_options['fields']['field_event_date_time_1']['settings'] = array(
    'format_type' => 'time',
    'fromto' => 'value',
    'multiple_number' => '',
    'multiple_from' => '',
    'multiple_to' => '',
  );
  /* Field: Field: Event Type */
  $handler->display->display_options['fields']['field_event_type']['id'] = 'field_event_type';
  $handler->display->display_options['fields']['field_event_type']['table'] = 'field_data_field_event_type';
  $handler->display->display_options['fields']['field_event_type']['field'] = 'field_event_type';
  $handler->display->display_options['fields']['field_event_type']['label'] = 'event-type-ids';
  $handler->display->display_options['fields']['field_event_type']['alter']['alter_text'] = TRUE;
  $handler->display->display_options['fields']['field_event_type']['alter']['text'] = '[field_event_type] ';
  $handler->display->display_options['fields']['field_event_type']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_type']['type'] = 'services';
  $handler->display->display_options['fields']['field_event_type']['settings'] = array(
    'skip_safe' => 0,
    'skip_empty_values' => 0,
  );
  $handler->display->display_options['fields']['field_event_type']['delta_offset'] = '0';
  /* Field: Content: Event Address - Postal code */
  $handler->display->display_options['fields']['field_event_address_postal_code']['id'] = 'field_event_address_postal_code';
  $handler->display->display_options['fields']['field_event_address_postal_code']['table'] = 'field_data_field_event_address';
  $handler->display->display_options['fields']['field_event_address_postal_code']['field'] = 'field_event_address_postal_code';
  $handler->display->display_options['fields']['field_event_address_postal_code']['label'] = 'zip';
  $handler->display->display_options['fields']['field_event_address_postal_code']['element_label_colon'] = FALSE;
  /* Field: Content: Latitude */
  $handler->display->display_options['fields']['field_latitude']['id'] = 'field_latitude';
  $handler->display->display_options['fields']['field_latitude']['table'] = 'field_data_field_latitude';
  $handler->display->display_options['fields']['field_latitude']['field'] = 'field_latitude';
  $handler->display->display_options['fields']['field_latitude']['label'] = 'latitude';
  $handler->display->display_options['fields']['field_latitude']['element_label_colon'] = FALSE;
  /* Field: Content: Longitude */
  $handler->display->display_options['fields']['field_longitude']['id'] = 'field_longitude';
  $handler->display->display_options['fields']['field_longitude']['table'] = 'field_data_field_longitude';
  $handler->display->display_options['fields']['field_longitude']['field'] = 'field_longitude';
  $handler->display->display_options['fields']['field_longitude']['label'] = 'longitude';
  $handler->display->display_options['fields']['field_longitude']['element_label_colon'] = FALSE;
  /* Field: Content: Event Address */
  $handler->display->display_options['fields']['field_event_address']['id'] = 'field_event_address';
  $handler->display->display_options['fields']['field_event_address']['table'] = 'field_data_field_event_address';
  $handler->display->display_options['fields']['field_event_address']['field'] = 'field_event_address';
  $handler->display->display_options['fields']['field_event_address']['label'] = 'address';
  $handler->display->display_options['fields']['field_event_address']['element_label_colon'] = FALSE;
  $handler->display->display_options['fields']['field_event_address']['click_sort_column'] = 'country';
  $handler->display->display_options['fields']['field_event_address']['settings'] = array(
    'use_widget_handlers' => 1,
    'format_handlers' => array(
      'address' => 'address',
    ),
  );
  /* Field: Content: Body */
  $handler->display->display_options['fields']['body']['id'] = 'body';
  $handler->display->display_options['fields']['body']['table'] = 'field_data_body';
  $handler->display->display_options['fields']['body']['field'] = 'body';
  $handler->display->display_options['fields']['body']['label'] = 'event-description';
  $handler->display->display_options['fields']['body']['element_label_colon'] = FALSE;
  /* Field: Content: Event Venue */
  $handler->display->display_options['fields']['field_event_venue']['id'] = 'field_event_venue';
  $handler->display->display_options['fields']['field_event_venue']['table'] = 'field_data_field_event_venue';
  $handler->display->display_options['fields']['field_event_venue']['field'] = 'field_event_venue';
  $handler->display->display_options['fields']['field_event_venue']['label'] = 'event-venue';
  $handler->display->display_options['fields']['field_event_venue']['element_label_colon'] = FALSE;
  /* Field: Content: Nid */
  $handler->display->display_options['fields']['nid']['id'] = 'nid';
  $handler->display->display_options['fields']['nid']['table'] = 'node';
  $handler->display->display_options['fields']['nid']['field'] = 'nid';
  $handler->display->display_options['fields']['nid']['label'] = 'nid';
  $handler->display->display_options['fields']['nid']['element_label_colon'] = FALSE;
  /* Sort criterion: Content: Event Date/Time -  start date (field_event_date_time) */
  $handler->display->display_options['sorts']['field_event_date_time_value']['id'] = 'field_event_date_time_value';
  $handler->display->display_options['sorts']['field_event_date_time_value']['table'] = 'field_data_field_event_date_time';
  $handler->display->display_options['sorts']['field_event_date_time_value']['field'] = 'field_event_date_time_value';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'climate_change_event' => 'climate_change_event',
  );
  $handler->display->display_options['filters']['type']['group'] = 1;
  /* Filter criterion: Content: Event Date/Time - end date (field_event_date_time:value2) */
  $handler->display->display_options['filters']['field_event_date_time_value2']['id'] = 'field_event_date_time_value2';
  $handler->display->display_options['filters']['field_event_date_time_value2']['table'] = 'field_data_field_event_date_time';
  $handler->display->display_options['filters']['field_event_date_time_value2']['field'] = 'field_event_date_time_value2';
  $handler->display->display_options['filters']['field_event_date_time_value2']['operator'] = '>=';
  $handler->display->display_options['filters']['field_event_date_time_value2']['default_date'] = 'now';
  $handler->display->display_options['filters']['field_event_date_time_value2']['year_range'] = '-0:+3';

  /* Display: Services */
  $handler = $view->new_display('services', 'Services', 'services_1');
  $handler->display->display_options['path'] = 'climate-events';
  $export['climate_events'] = $view;

  $view = new view();
  $view->name = 'event_types';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'taxonomy_term_data';
  $view->human_name = 'Climate Event Types';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['style_plugin'] = 'views_json';
  $handler->display->display_options['style_options']['root_object'] = 'climate-event-types';
  $handler->display->display_options['style_options']['top_child_object'] = 'event-type';
  $handler->display->display_options['style_options']['plaintext_output'] = 1;
  $handler->display->display_options['style_options']['remove_newlines'] = 0;
  $handler->display->display_options['style_options']['jsonp_prefix'] = '';
  $handler->display->display_options['style_options']['using_views_api_mode'] = 0;
  $handler->display->display_options['style_options']['object_arrays'] = 0;
  $handler->display->display_options['style_options']['numeric_strings'] = 0;
  $handler->display->display_options['style_options']['bigint_string'] = 0;
  $handler->display->display_options['style_options']['pretty_print'] = 0;
  $handler->display->display_options['style_options']['unescaped_slashes'] = 0;
  $handler->display->display_options['style_options']['unescaped_unicode'] = 0;
  $handler->display->display_options['style_options']['char_encoding'] = array();
  /* Field: Taxonomy term: Name */
  $handler->display->display_options['fields']['name']['id'] = 'name';
  $handler->display->display_options['fields']['name']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['fields']['name']['field'] = 'name';
  $handler->display->display_options['fields']['name']['label'] = 'event-type';
  $handler->display->display_options['fields']['name']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['name']['alter']['ellipsis'] = FALSE;
  $handler->display->display_options['fields']['name']['element_label_colon'] = FALSE;
  /* Field: Taxonomy term: Term ID */
  $handler->display->display_options['fields']['tid']['id'] = 'tid';
  $handler->display->display_options['fields']['tid']['table'] = 'taxonomy_term_data';
  $handler->display->display_options['fields']['tid']['field'] = 'tid';
  $handler->display->display_options['fields']['tid']['label'] = 'event-type-id';
  $handler->display->display_options['fields']['tid']['element_label_colon'] = FALSE;
  /* Filter criterion: Taxonomy vocabulary: Machine name */
  $handler->display->display_options['filters']['machine_name']['id'] = 'machine_name';
  $handler->display->display_options['filters']['machine_name']['table'] = 'taxonomy_vocabulary';
  $handler->display->display_options['filters']['machine_name']['field'] = 'machine_name';
  $handler->display->display_options['filters']['machine_name']['value'] = array(
    'event_type' => 'event_type',
  );

  /* Display: Services */
  $handler = $view->new_display('services', 'Services', 'services_1');
  $handler->display->display_options['path'] = 'climate-event-types';
  $export['event_types'] = $view;

  $view = new view();
  $view->name = 'zip_code';
  $view->description = '';
  $view->tag = 'default';
  $view->base_table = 'node';
  $view->human_name = 'Zip Code';
  $view->core = 7;
  $view->api_version = '3.0';
  $view->disabled = FALSE; /* Edit this to true to make a default view disabled initially */

  /* Display: Master */
  $handler = $view->new_display('default', 'Master', 'default');
  $handler->display->display_options['use_more_always'] = FALSE;
  $handler->display->display_options['access']['type'] = 'perm';
  $handler->display->display_options['cache']['type'] = 'none';
  $handler->display->display_options['query']['type'] = 'views_query';
  $handler->display->display_options['exposed_form']['type'] = 'basic';
  $handler->display->display_options['pager']['type'] = 'full';
  $handler->display->display_options['style_plugin'] = 'default';
  $handler->display->display_options['row_plugin'] = 'fields';
  /* Field: Content: Title */
  $handler->display->display_options['fields']['title']['id'] = 'title';
  $handler->display->display_options['fields']['title']['table'] = 'node';
  $handler->display->display_options['fields']['title']['field'] = 'title';
  $handler->display->display_options['fields']['title']['label'] = '';
  $handler->display->display_options['fields']['title']['alter']['word_boundary'] = FALSE;
  $handler->display->display_options['fields']['title']['alter']['ellipsis'] = FALSE;
  /* Field: Content: Latitude */
  $handler->display->display_options['fields']['field_latitude']['id'] = 'field_latitude';
  $handler->display->display_options['fields']['field_latitude']['table'] = 'field_data_field_latitude';
  $handler->display->display_options['fields']['field_latitude']['field'] = 'field_latitude';
  $handler->display->display_options['fields']['field_latitude']['label'] = '';
  $handler->display->display_options['fields']['field_latitude']['element_label_colon'] = FALSE;
  /* Field: Content: Longitude */
  $handler->display->display_options['fields']['field_longitude']['id'] = 'field_longitude';
  $handler->display->display_options['fields']['field_longitude']['table'] = 'field_data_field_longitude';
  $handler->display->display_options['fields']['field_longitude']['field'] = 'field_longitude';
  $handler->display->display_options['fields']['field_longitude']['label'] = '';
  $handler->display->display_options['fields']['field_longitude']['element_label_colon'] = FALSE;
  /* Sort criterion: Content: Post date */
  $handler->display->display_options['sorts']['created']['id'] = 'created';
  $handler->display->display_options['sorts']['created']['table'] = 'node';
  $handler->display->display_options['sorts']['created']['field'] = 'created';
  $handler->display->display_options['sorts']['created']['order'] = 'DESC';
  /* Contextual filter: Content: Title */
  $handler->display->display_options['arguments']['title']['id'] = 'title';
  $handler->display->display_options['arguments']['title']['table'] = 'node';
  $handler->display->display_options['arguments']['title']['field'] = 'title';
  $handler->display->display_options['arguments']['title']['default_argument_type'] = 'fixed';
  $handler->display->display_options['arguments']['title']['summary']['number_of_records'] = '0';
  $handler->display->display_options['arguments']['title']['summary']['format'] = 'default_summary';
  $handler->display->display_options['arguments']['title']['summary_options']['items_per_page'] = '25';
  $handler->display->display_options['arguments']['title']['limit'] = '0';
  /* Filter criterion: Content: Published */
  $handler->display->display_options['filters']['status']['id'] = 'status';
  $handler->display->display_options['filters']['status']['table'] = 'node';
  $handler->display->display_options['filters']['status']['field'] = 'status';
  $handler->display->display_options['filters']['status']['value'] = 1;
  $handler->display->display_options['filters']['status']['group'] = 1;
  $handler->display->display_options['filters']['status']['expose']['operator'] = FALSE;
  /* Filter criterion: Content: Type */
  $handler->display->display_options['filters']['type']['id'] = 'type';
  $handler->display->display_options['filters']['type']['table'] = 'node';
  $handler->display->display_options['filters']['type']['field'] = 'type';
  $handler->display->display_options['filters']['type']['value'] = array(
    'zip_code' => 'zip_code',
  );
  $export['zip_code'] = $view;

  return $export;
}

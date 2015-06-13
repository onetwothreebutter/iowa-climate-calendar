<?php
/**
 * @file
 * content_types_views_etc_for_iowa_climate_calendar.features.user_role.inc
 */

/**
 * Implements hook_user_default_roles().
 */
function content_types_views_etc_for_iowa_climate_calendar_user_default_roles() {
  $roles = array();

  // Exported role: event administrator.
  $roles['event administrator'] = array(
    'name' => 'event administrator',
    'weight' => 5,
  );

  // Exported role: events_subscriber.
  $roles['events_subscriber'] = array(
    'name' => 'events_subscriber',
    'weight' => 4,
  );

  return $roles;
}

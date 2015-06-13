<?php
/**
 * Created by PhpStorm.
 * User: ejohnson
 * Date: 2/21/15
 * Time: 3:41 PM
 */
include_once('formatting-functions/classes/ClimateEvent.php');
$event = new ClimateEvent($row); ?>

<tr class="climate-event">
  <td class="climate-event__start-time"><?php print $event->getStartDate(); ?></td>
  <td class="climate-event__heading"><?php print $event->getTitle(); ?></td>
  <td class="climate-event__city"><?php print $event->getLocationSummary(); ?></td>
  <td class="climate-event__tags">
  <?php foreach($event->getTags() as $tag): ?>
    <span class="climate-event__tag"><?php print $tag; ?></span>
  <?php endforeach; ?>
  </td>
</tr>
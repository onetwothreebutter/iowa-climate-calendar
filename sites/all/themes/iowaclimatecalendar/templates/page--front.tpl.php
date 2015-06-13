<div id="page-wrapper">
  <div id="page">
  <section class="site-header">
    <h1 class="site-header__heading">Iowa Climate Calendar</h1>
  </section>
    <?php print $messages; ?>

    <?php if ($main_menu || $secondary_menu): ?>
      <div id="navigation"><div class="section">
          <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
         </div></div> <!-- /.section, /#navigation -->
    <?php endif; ?>

    <?php print views_embed_view('climate_events', 'climate_events_block'); ?>
    <div ng-app="ClimateActionsIowa">
      <div ng-controller="MainCtrl">
        <div ui-view="climate-events" class="climate-events">



        </div>




      </div>
    </div>




  </div></div> <!-- /#page, /#page-wrapper -->

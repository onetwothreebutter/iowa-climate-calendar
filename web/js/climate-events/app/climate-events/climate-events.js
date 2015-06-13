angular.module('climate-events', [
  'cai.models.climate-event-types',
  'cai.models.climate-events',
  'cai.models.climate-event-distances',
  'cai.models.climate-events-subscribe'
])
  .config(function($stateProvider){
    $stateProvider
    .state('cai.climate-events', {
      url: '/',
      views: {
        'climate-events@': {
          controller: 'ClimateEventsCtrl as climateEventsCtrl',
          templateUrl: 'web/js/climate-events/app/climate-events/climate-events.tmpl.html'
        }
      }
    })

})
  .run(['$rootScope', '$location', function ($rootScope, $location) {
    $rootScope.$on('$locationChangeStart', function (event, next, current) {

      //if this is a drupal admin page

      if(isDrupalAdminPage(next)) {
        event.preventDefault();
        var newPath = getDrupalAdminPath(next);
        $location.path(newPath);
      }

      function isDrupalAdminPage(url) {
        return url.indexOf('admin/') !== -1 ||
          url.indexOf('node/add/') !== -1;
      }

      function getDrupalAdminPath(url) {
        var path = '';

        if (url.indexOf('admin/') !== -1) {
          path = url.slice(url.indexOf('admin/'));
        } else if (url.indexOf('node/add/') !== -1) {
          path = url.slice(url.indexOf('node/add/'));
        }

        return '/' + path;
      }

    });
  }])
  .controller('ClimateEventsCtrl', function ClimateEventsCtrl(ClimateEventsModel, ClimateEventTypesModel, ClimateDistancesModel, ClimateSubscribeModel, $sce, $location) {

  var climateEventsCtrl = this;

  ClimateEventsModel.getClimateEvents()
    .then(function(result) {
      climateEventsCtrl.climateEvents = result;
    });

    ClimateEventTypesModel.getClimateEventTypes()
    .then(function(result) {
      climateEventsCtrl.climateEventTypes = result;
    });

    ClimateDistancesModel.getClimateDistances()
      .then(function(result) {
        climateEventsCtrl.climateDistances = result;
        climateEventsCtrl.distance = climateEventsCtrl.climateDistances[0];
      });

    ClimateSubscribeModel.getSubscribeForm()
      .then(function(result) {
        climateEventsCtrl.subscribeForm = $sce.trustAsHtml(result);
      });

    climateEventsCtrl.selectedEvents = {ids: {}};

    climateEventsCtrl.selectEventTypeCheckbox = function(eventTypeId) {
      this.selectedEvents.ids[eventTypeId] = !this.selectedEvents.ids[eventTypeId];
    }

    climateEventsCtrl.selectEventTypeCheckboxViaTag = function(eventTypeId) {
      var showHide = this.selectedEvents.ids[eventTypeId];
      this.selectedEvents = {ids: {}};
      this.selectedEvents.ids[eventTypeId] = !showHide;
    }

    climateEventsCtrl.getEventsByDistance = function() {
      this.filterLoadingMessage = 'loading...';
      ClimateEventsModel.getClimateEventsByDistanceFromZip(this.zip, this.distance['distance-value'])
        .then(function(result) {
          climateEventsCtrl.climateEvents = result;
          climateEventsCtrl.filterLoadingMessage = false;
        });
    }

    climateEventsCtrl.modalShown = false;
    climateEventsCtrl.toggleModal = function() {
      climateEventsCtrl.modalShown = !climateEventsCtrl.modalShown;
    };
    climateEventsCtrl.hideModal = function() {
      climateEventsCtrl.modalShown = false;
    }
    climateEventsCtrl.trustAsHtml = $sce.trustAsHtml;

    climateEventsCtrl.descriptionShown = false;
    climateEventsCtrl.toggleDescription = function() {
      climateEventsCtrl.descriptionShown = !climateEventsCtrl.descriptionShown;
    }

    climateEventsCtrl.isLoggedIn = function() {
      return jQuery('body').hasClass('logged-in');
    }

    climateEventsCtrl.allowEventToHappen = function($event) {
      $event.stopPropagation();
    }

    climateEventsCtrl.init = function(index) {
      showDetails = true;
    }


})
  .controller('EventDetailCtrl', function($scope){
    $scope.init = function(index) {
      debugger;
    }
  })

  .filter('eventTypeFilter', function() {

  return function(climateEvents, eventTypeCheckboxes) {

    if(noneAreSelected(eventTypeCheckboxes)) {
      return climateEvents;
    }

    var matchingEvents = [];
    for (var key in eventTypeCheckboxes) {

      if(eventTypeCheckboxes[key]) {

        for (var eventKey in climateEvents) {
          if(eventIsOfType(climateEvents[eventKey], key)) {
            matchingEvents.push(climateEvents[eventKey]);
          }
        }

      }
    }

    return matchingEvents;
  }

    function noneAreSelected(eventTypeCheckboxes) {

      var noneSelected = true;

      for (var eventTypeCheckbox in eventTypeCheckboxes) {
        if(eventTypeCheckboxes[eventTypeCheckbox]) {
          noneSelected = false;
        }
      }

      return noneSelected;
    }

    function eventIsOfType(event, eventTypeId){
      var foundMatchingEventType = false;

      for (var tidKey in event['event-type-ids']) {
        if(event['event-type-ids'][tidKey]['tid'] === eventTypeId) {
          foundMatchingEventType = true;
        }
      }

      return foundMatchingEventType;
    }

})
.directive('modaldialog', function() {
  return {
    restrict: 'E',
    scope: {
      show: '='
    },
    replace: true, // Replace with the template below
    transclude: true, // we want to insert custom content inside the directive
    link: function(scope, element, attrs) {

    },
    templateUrl: 'web/js/climate-events/app/climate-events/modal.tmpl.html' // See below
  };
});
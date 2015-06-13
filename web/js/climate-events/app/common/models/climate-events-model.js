angular.module('cai.models.climate-events', [])
  .service('ClimateEventsModel', function ($http) {
    var model = this,
      URLs = {
        FETCH : '/services/climate-events',
        FETCHBYDISTANCEFROMZIP : '/services/climate-events-by-distance-from-zip'
      },
      climateEvents;

    function extractData(result) {
      return result.data[0];
    }

    function cacheClimateEvents(result) {
      climateEvents = extractData(result);
      return climateEvents;
    }

    model.getClimateEvents = function() {
      return $http.get(URLs.FETCH).then(cacheClimateEvents);
    }

    model.getClimateEventsByDistanceFromZip = function(zip, distanceInMiles) {
      queryURL = URLs.FETCHBYDISTANCEFROMZIP + '/' + zip + '/' + distanceInMiles;
      return $http.get(queryURL).then(cacheClimateEvents);
    }

  });
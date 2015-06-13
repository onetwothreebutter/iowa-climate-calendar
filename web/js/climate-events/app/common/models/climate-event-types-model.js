angular.module('cai.models.climate-event-types', [])
  .service('ClimateEventTypesModel', function ($http) {
    var model = this,
      URLs = {
        FETCH : '/services/climate-event-types'
      },
      climateEventTypes;

    function extractData(result) {
      return result.data;
    }

    function cacheClimateEventTypes(result) {
      climateEventTypes = extractData(result);
      return climateEventTypes;
    }

    model.getClimateEventTypes = function() {
      return $http.get(URLs.FETCH).then(cacheClimateEventTypes);
    }



  });
angular.module('cai.models.climate-event-distances', [])
  .service('ClimateDistancesModel', function ($http) {
    var model = this,
      URLs = {
        FETCH : '/services/climate-distances'
      },
      climateDistances;

    function extractData(result) {
      return result.data;
    }

    function cacheClimateDistances(result) {
      climateDistances = extractData(result);
      return climateDistances;
    }

    model.getClimateDistances = function() {
      return $http.get(URLs.FETCH).then(cacheClimateDistances);
    }

  });
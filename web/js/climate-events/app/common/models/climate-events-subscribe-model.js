angular.module('cai.models.climate-events-subscribe', [])
  .service('ClimateSubscribeModel', function ($http) {
    var model = this,
      URLs = {
        FETCH : '/subscribe'
      },
      subscribeForm;

    function extractData(result) {
      return result.data;
    }

    function cacheSubscribeForm(result) {
      subscribeForm = extractData(result);
      return subscribeForm;
    }

    model.getSubscribeForm = function() {
      return $http.get(URLs.FETCH).then(cacheSubscribeForm);
    }

  });
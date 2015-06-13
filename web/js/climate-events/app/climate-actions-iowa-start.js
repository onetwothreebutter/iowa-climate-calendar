angular.module('IowaClimateCalendar', [
  'ui.router',
  'climate-events'
])
  .config(function ($stateProvider, $urlRouterProvider) {
    $stateProvider
      .state('cai', {
        url: '',
        abstract: true
      })
    ;

    $urlRouterProvider.otherwise('/');
  })
  .controller('MainCtrl', function($scope, $state) {

  });


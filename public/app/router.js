angular.module("AppRouter", ['ui.router'])
        /*
        .config(function ($routeProvider, $locationProvider) {
            $routeProvider.when('/donate/create', {
                controller: "DonationsCtrl",
                templateUrl: "partials/donate/create.html"
            }).when('/donate/list', {
                controller: "DonationsCtrl",
                templateUrl: "partials/donate/list.html"
            }).when('/account', {
                controller: "AccountCtrl",
                templateUrl: "partials/account/index.html"
            }).otherwise({
                redirectTo: '/donate/create'
            });

        });*/

.config(function($stateProvider,$urlRouterProvider,$locationProvider){
  $stateProvider.state('donating',{
    url:'/donate/create',
    controller:'DonationsCtrl',
    templateUrl: "partials/donate/create.html"

  })
})

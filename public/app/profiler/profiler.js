Profiler = angular.module('ProfilerModule',[]);

Profiler.controller('ProfileListCtrl',function($scope,$http){

	$scope.getProfiles = function(){
		$http({
		  method: 'GET',
		  url: '/profiler'
		}).then(function successCallback(response) {
		   	$scope.profiles=response.data;

		  }, function errorCallback(response) {
		  });
		}
});
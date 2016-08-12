angular.module("DonateApp",['AppRouter'])

.factory('donationService',function($http){

  var factory_object={};

  factory_object.donate = function(amount){
      $http.post('donate',{amount:amount}
      ).then(function successCallback(response) {
          console.log(response.data);
          return response.data;
      }, function errorCallback(response) {
          return {"status":"error","message":"Could not proccess request."}
      });
  };

  factory_object.getDonations = function(){
    $http.get('donate'
    ).then(function successCallback(response) {
        console.log(response.data);
        return response.data;
    }, function errorCallback(response) {
        return {"status":"error","message":"Could not proccess request."}
    });
  };
  return factory_object;
})

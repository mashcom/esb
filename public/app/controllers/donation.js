angular.module("DonateApp",['AppRouter','ngResource','chieffancypants.loadingBar'])

.controller("DonationsCtrl",function(
  $scope,
  $http,
  $location,
  donationFactory,
  cfpLoadingBar,
  $timeout,
  $q
){

    $scope.donate = function(){


        var deferred = $q.defer(),
            promise = deferred.promise;

            console.log(promise);
        $scope.submitting = true;
        $scope.response ={};
        $scope.response = donationFactory.donate($scope.donate_amount);
        $scope.donate_amount=null;
        $scope.submitting = false;
    }

    $scope.getDonationsList = function(){
      $scope.donations = donationFactory.getDonations();

      console.log($scope.donations);
    }
    $scope.predicate = 'age';
    $scope.reverse = true;

    $scope.order = function(predicate) {
            $scope.reverse = ($scope.predicate === predicate) ? !$scope.reverse : false;
            $scope.predicate = predicate;
    };

    $scope.find = function(){
      $scope.donations = {1:donationFactory.find($scope.find_id)};

      console.log($scope.donations);
    }

    $scope.deleteDonation = function(delete_id){
      $scope.donationFactory.destroy(delete_id)

    }

    $scope.start = function() {
      cfpLoadingBar.start();
    };

    $scope.complete = function () {
      cfpLoadingBar.complete();
    }


    // fake the initial load so first time users can see it right away:
    $scope.start();
    $scope.fakeIntro = true;
    $timeout(function() {
      $scope.complete();
      $scope.fakeIntro = false;
    }, 750);

})

/**
*Restful Endpoint for Donations
*/
.factory('Donations',function($resource){
    return $resource('/api/v1/donate/:id');
})


/**
*Donations factory
*/
.factory('donationFactory',function(Donations){

  return {
    donate:function(amount){
      return Donations.save({amount:amount});
    },
    getDonations:function(){
      return Donations.query();
    },
    find:function(donation_id){
      return Donations.get({id:donation_id});
    },
    destroy:function(donation_id){
      return Donations.delete({id,donation_id});
    }
  };

})

.directive('helloWorld',function(){
  return {
    restrict:'AEC',
    replace:true,
    template:'<h3>Hellow</h3>'
  };
})

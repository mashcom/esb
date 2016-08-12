angular.module("DonateApp",['AppRouter','ngResource'])

.controller("AccountCtrl",["$scope","$http","$location","accountFactory",function($scope,$http,$location,accountFactory){

	$scope.deposit = function(){
		console.log(accountFactory.deposit({"amount":$scope.deposit_amount}));
	}

}])

.factory('Accounts',function($resource){
  return $resource('/api/v1/account/:id');
})

.factory('accountFactory',function(Accounts){
	return {
		deposit:function(data){
			return Accounts.save(data);
		}
	};
})

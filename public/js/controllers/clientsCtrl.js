angular.module('clientsCtrl', [])
	// Module for the clients archive page
	.controller('clientsController', function($scope, $http, $modal, Api) {

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		
		// get all the clients first and bind it to the $scope.clients object
		Api.get('clients')
			.success(function(data) {
				$scope.clients = data;
				$scope.loading = false;
			});
		// function for submitting a client, opens a new modal
		$scope.submitClient = function() {
			var modalInstance = $modal.open({
		      templateUrl: 'js/views/modals/submitclientmodal.html',
		      controller: 'submitClientModalCtrl',
		      size: 'lg'
		    });
		};

	})

	// Controller for the Submit Client Modal
	.controller('submitClientModalCtrl', function($scope, $http, Api, $modalInstance, $route) {
		// object to hold all the data for the new client form
		$scope.clientData = {};

		// Set title variable
		$scope.title = "Add new client";

		// Cancel and destroy modal on close
		$scope.closeModal = function () {
			$modalInstance.dismiss('cancel');
		};

		// function to handle submitting the form
		$scope.submitClient = function(isValid) {
			$scope.loading = true;
			if(isValid) {
					// save the client. pass in client data from the form
				Api.save('clients', $scope.clientData)
					.success(function(data) {
						// console.log(data);
						$scope.clientData = {};
						// if successful, we'll need to refresh the client list
						Api.get('clients')
							.success(function(getData) {
								$scope.clients = getData;
								$scope.loading = false;
								$route.reload();
							});
						
					})
					.error(function(data) {
						console.log(data);
					});
				$modalInstance.close();
			} else {
				$scope.loading = false;
			}
			
		};
	});
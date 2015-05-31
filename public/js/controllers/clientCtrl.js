angular.module('clientCtrl', [])
	// Module for the single client pages
	.controller('clientController', function($scope, $http, $modal, Api, $routeParams) {

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		// Get curent ID from route
		var clientId = $routeParams.clientId;
		
		// get all the clients first and bind it to the $scope.client object
		Api.get('clients/' + clientId)
			.success(function(data) {
				$scope.client = data;
				$scope.loading = false;
			});

		// Delete client function, opens a confirm modal
		$scope.deleteClient = function() {

			var modalInstance = $modal.open({
		      templateUrl: 'js/views/modals/deletemodal.html',
		      controller: 'deleteClientModalCtrl',
		      size: 'sm',
		      scope: $scope
		    });
		};

		// Update client function, opens an editable modal
		$scope.updateClient = function() {

			var modalInstance = $modal.open({
		      templateUrl: 'js/views/modals/updateclientmodal.html',
		      controller: 'updateClientModalCtrl',
		      size: 'lg',
		      scope: $scope
		    });
		};

	})
	
	// Controller for the Client Delete Modal
	.controller('deleteClientModalCtrl', function($scope, $http, Api, $modalInstance, $location) {

		// Set message variables
		$scope.modal_title = "Are you sure you want to delete this client?";
		$scope.modal_text = "You can not undo this action, the client will be gone forever!";

		// Cancel and destroy modal on close
		$scope.closeModal = function () {
			$modalInstance.dismiss('cancel');
		};

		// function to handle deleting a client
		$scope.delete = function() {
			$scope.loading = true; 

			Api.destroy('clients', $scope.client.id)
				.success(function(data) {
					$scope.loading = false;
					$location.path( "/clients" );

				})
				.error(function(data) {
					console.log(data);
				});
			$modalInstance.close();
		};
	})

	// Controller for the Update Client Modal
	.controller('updateClientModalCtrl', function($scope, $filter, $http, Api, $modalInstance) {

		// Cancel and destroy modal on close
		$scope.closeModal = function () {
			$modalInstance.dismiss('cancel');
		};

		// function to handle submitting the form
		$scope.updateClient = function(isValid) {
			$scope.loading = true;

			if(isValid) {
				// save the client. pass in client data from the form
				Api.update('clients', $scope.client.id, $scope.client)
					.success(function(data) {
						// if successful, we'll need to refresh the client list
						Api.get('client' + $scope.client.id)
							.success(function(getData) {
								$scope.client = getData;
								$scope.loading = false;
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
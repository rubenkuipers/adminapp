angular.module('invoiceCtrl', [])
	// Module for the single invoice pages
	.controller('invoiceController', function($scope, $http, $modal, Api, $filter, $routeParams) {

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		// Get invoice ID from Route
		var invoiceId = $routeParams.invoiceId;

		// get all the clients first and bind it to the $scope.clients object
		Api.get('invoices/' + invoiceId)
			.success(function(data) {
				// Get Company settings
				Api.get('settings')
					.success(function(data) {
						console.log(data);
						$scope.settings = data[0];
						$scope.loading = false;
					})
					.error(function(data) {
						console.log(data);
					});

				// Update toggle values
				if(data.paid == 0) {
				  	data.paid = false;
				  } else {
				  	data.paid = true;
				  }
				$scope.invoice = data;
				
			})
			.error(function(data) {
				console.log(data);
			});

		// Function for updating the invoice status (toggle)
		$scope.updateStatus = function() {
			// update toggle values before making Api call
        	if ($scope.invoice.paid == false) {
        		$scope.invoice.paid = 0;
        	} else {
        		$scope.invoice.paid = 1;
        	}

    		Api.update('invoices', $scope.invoice.id, $scope.invoice)
				.success(function(data) {
					// if successful, we'll need to refresh the client list
					Api.get('invoices')
						.success(function(getData) {
							$scope.loading = false;
						});
				})
				.error(function(data) {
					console.log(data);
				});
        };

	});

	
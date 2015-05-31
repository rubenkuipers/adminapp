angular.module('invoicesCtrl', [])
	// Module for the invoice archive page

	.controller('invoicesController', function($scope, $http, $modal, Api, $filter) {

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		// Create empty new object for Single invoice data
		$scope.singleInvoiceData = {};

		// get all the invoices first and bind it to the $scope.invoices object
		Api.get('invoices')
			.success(function(data) {
				angular.forEach(data, function(invoice) {
				// update toggle values
				  if(invoice.paid == 0) {
				  	invoice.paid = false;
				  } else {
				  	invoice.paid = true;
				  }
				});
				$scope.invoices = data;
				$scope.loading = false;
			});

		// Function for updating the single invoice status
		$scope.updateStatus = function(id) {
			// Filter the selected invoice
        	$scope.singleInvoiceData = $filter('filter')($scope.invoices, {id:id})[0];
        	// update toggle value of the selected invoice
        	if ($scope.singleInvoiceData.paid == false) {
        		$scope.singleInvoiceData.paid = 0;
        	} else {
        		$scope.singleInvoiceData.paid = 1;
        	}

    		Api.update('invoices', $scope.singleInvoiceData.id, $scope.singleInvoiceData)
				.success(function(data) {
					// if successful, we'll need to refresh the client list
					Api.get('invoices')
						.success(function(getData) {
							$scope.loading = false;
							// console.log(getData);
						});
				})
				.error(function(data) {
					console.log(data);
				});
        };

	});

	
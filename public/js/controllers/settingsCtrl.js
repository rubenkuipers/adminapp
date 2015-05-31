angular.module('settingsCtrl', [])
	// Main module
	
	.controller('settingsController', function($scope, $http, Api) {

		// loading variable to show the spinning loading icon
		$scope.loading = true;
		$scope.settings = {};
		$scope.settingsData = {};
		$scope.nodata = true;

		// get all the invoices first and bind it to the $scope.invoices object
		Api.get('settings')
			.success(function(data) {
				if(data[0]) {
					$scope.settings = data;
					$scope.nodata = false;
					console.log($scope.settings[0]);
				} else {
					$scope.nodata = true;
					console.log('no data yet');
				}
				$scope.loading = false;
			})
			.error(function(data) {
				console.log(data);
			});

		$scope.saveSettings = function(isValid) {
			$scope.loading = true;
			if($scope.settings[0]) {
				if(isValid) {
					Api.update('settings', $scope.settings[0].id, $scope.settings[0])
						.success(function(data) {
							$scope.settings[0] = data;
							$scope.loading = false;
							console.log(data);
						})
						.error(function(data) {
							console.log(data);
						});
				} else {
					$scope.loading = false;
				}
			} else {
				if(isValid) {
					Api.save('settings', $scope.settingsData)
						.success(function(data) {
							$scope.settings = data;
							$scope.loading = false;
							console.log(data);
						})
						.error(function(data) {
							console.log(data);
						});
				} else {
					$scope.loading = false;
				}
			}
			
		}

	});
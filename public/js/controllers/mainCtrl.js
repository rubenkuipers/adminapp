angular.module('mainCtrl', [])
	// Main module
	
	.controller('mainController', function($scope, Api) {
		// Set title of App
		$scope.homeData = "Adminapp";
		$scope.loading = true;

		Api.get('projects')
			.success(function(data) {
				angular.forEach(data, function(project) {
					var total_hours = 0
					// calcaulate total task hours for the project
					angular.forEach(project.tasklist.tasks, function(task) {
						total_hours += parseInt(task.hours);
					});
					project.total_hours = total_hours;
				});

				$scope.projects = data;
				// Get all invoices
				Api.get('invoices')
					.success(function(data) {
						$scope.invoices = data;
						$scope.loading = false;
						// console.log($scope.categories);
					})
					.error(function(data) {
						console.log(data);
					});
				
				
			})
			.error(function(data) {
				console.log(data);
			});
	});
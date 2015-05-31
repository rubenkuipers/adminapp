angular.module('projectsCtrl', [])
	// Module for project archive page

	.controller('projectsController', function($scope, $http, $modal, Api, Filter, $filter) {

		// Set base variables
		$scope.loading = true;
		$scope.clients = [];
		$scope.categories = [];
		
		// get all the projects, the categories and the clients first.
		Api.get('projects')
			.success(function(data) {
				// Filter the current project
				filterProjects(data);

				// Get all categories for the modal select fields
				Api.get('categories')
					.success(function(data) {
						$scope.categories = data;
						// console.log($scope.categories);
					})
					.error(function(data) {
						console.log(data);
					});

				// Get all clients first for the modal select fields
				Api.get('clients')
					.success(function(data) {
						$scope.clients = data;
					})
					.error(function(data) {
						console.log(data);
					});
				
				$scope.loading = false;
			})
			.error(function(data) {
				console.log(data);
			});

		// Function for filtering the project.
		filterProjects = function(data) {

			angular.forEach(data, function(project) {
				// Set base variables
				var totalPrice = 0;
				var tax = (project.sales_tax / 100) + 1;

				// Update toggle values
				if(project.finished == 0) {
					project.finished = false;
				} else {
					project.finished = true;
				}

				// Check if price method of project is hourly
				if(project.price_method == 'hourly') {
					// Check if project has a tasklist
					if(project.tasklist) {
						// Calculate the prices
						angular.forEach(project.tasklist.tasks, function(task) {
							task.price_exc_btw = task.hours * project.price;
							totalPrice = parseInt(totalPrice) + parseFloat(task.price_exc_btw);
						});

						var raw_price = totalPrice * tax;
						totalPrice = Math.round(raw_price * 100) / 100;
						project.total_price = totalPrice;
					} else {
						project.total_price = 0.00;
					}
				// else add the tax for the solid price
				} else {
					var raw_price = project.price * tax;
					totalPrice = Math.round(raw_price * 100) / 100;
					project.total_price = totalPrice;
				}

			});

			$scope.projects = data;
			$scope.loading = false;
		};

		// Update the status of the current project
		$scope.updateStatus = function(id) {
			// Filter current project
        	$scope.singleProjectData = $filter('filter')($scope.projects, {id:id})[0];
        	
        	// reset toggle values
        	if ($scope.singleProjectData.finished == false) {
        		$scope.singleProjectData.finished = 0;
        	} else {
        		$scope.singleProjectData.finished = 1;
        	}

        	// Update the project!
    		Api.update('projects', $scope.singleProjectData.id, $scope.singleProjectData)
				.success(function(data) {
					// if successful, we'll need to refresh the client list
					Api.get('projects')
						.success(function(data) {
							$scope.loading = false;
						});
				})
				.error(function(data) {
					console.log(data);
				});
        };

        // Function for submitting a project, opens a new form submit modal
        $scope.submitProject = function() {
			var modalInstance = $modal.open({
		      templateUrl: 'js/views/modals/submitprojectmodal.html',
		      controller: 'submitProjectModalCtrl',
		      size: 'lg',
		      scope: $scope
		    });
		};

	})
	
	// Controller for the Submit Project Modal
	.controller('submitProjectModalCtrl', function($scope, $http, Api, $modalInstance, $route, $filter) {
		
		// object to hold all the data for the new project form
		$scope.projectData = {};

		// set defaults
		$scope.projectData.category_id = $scope.categories[0];
		$scope.projectData.client_id = $scope.clients[0];
		$scope.projectData.price_method = 'hourly';
		$scope.projectData.finished = 0;

		// modal title
		$scope.title = "Add new project";

		// Destroy the modal instance on close
		$scope.closeModal = function () {
			$modalInstance.dismiss('cancel');
		};

		// function to handle submitting the form
		$scope.submitProject = function(isValid) {
			$scope.loading = true;	

			// Filter the date input for the right database syntax
			var new_date = $filter('date')($scope.projectData.delivery_date, 'yyyy-MM-dd');
			$scope.projectData.delivery_date = new_date;

			// update project and category id's for right put request
			var selectedCategory = $scope.projectData.category_id;
			$scope.projectData.category_id = selectedCategory.id;
			var selectedClient = $scope.projectData.client_id;
			$scope.projectData.client_id = selectedClient.id;

			if(isValid) {
				// save the project. pass in project data from the form
				Api.save('projects', $scope.projectData)
					.success(function(data) {
						$scope.projectData = {};
						// if successful, we'll need to refresh the project data
						Api.get('projects')
							.success(function(getData) {
								$scope.projects = getData;
								console.log(getData);
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

	
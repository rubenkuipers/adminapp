angular.module('projectCtrl', [])
	// Module for the single projects
	
	.controller('projectController', function($scope, $http, $modal, $filter, Api, Filter, $routeParams, $route, $location) {

		// Set base scope variables
		$scope.loading = true;
		$scope.categories = [];
		$scope.clients = [];
		$scope.editing = false;
		$scope.showform = false;

		// Set base helper variables
		var filteredCats = [];
		var filteredClients = [];
		var selectedCategory;
		var selectedClient;

		// Get curent project ID from Route
		var projectId = $routeParams.projectId;
		
		// get all the projects first and bind it to the $scope.projects object
		Api.get('projects/' + projectId)
			.success(function(data) {
				// Run project Filter
				$scope.project = Filter.filterProject(data);

				// Get all categories for select fields in project modal
				Api.get('categories')
					.success(function(data) {
						// On success, filter the categories and select the category from this project on default
						filteredCats = Filter.filterItems(data, $scope.categories, $scope.project.category_id);
						$scope.categories = filteredCats[0];
						selectedCategory = filteredCats[1];
						$scope.project.category_id = selectedCategory;
					})
					.error(function(data) {
						console.log(data);
					});

				// Get all clients for select fields in project modal
				Api.get('clients')
					.success(function(data) {
						// On success, filter the clients and select the client from this project on default
						filteredClients = Filter.filterItems(data, $scope.clients, $scope.project.client_id);
						$scope.clients = filteredClients[0];
						selectedClient = filteredClients[1];
						$scope.project.client_id = selectedClient;
					})
					.error(function(data) {
						console.log(data);
					});
				$scope.loading = false;
			})
			.error(function(data) {
				console.log(data);
			});	

		// Function for updating the status of this project
		$scope.updateStatus = function() {
        	// update toggle values before making api call
        	if ($scope.project.finished == false) {
        		$scope.project.finished = 0;
        	} else {
        		$scope.project.finished = 1;
        	}

			// update client and category id's for right put request
			selectedCategory = $scope.project.category_id;
			$scope.project.category_id = selectedCategory.id;
			selectedClient = $scope.project.client_id;
			$scope.project.client_id = selectedClient.id;

    		Api.update('projects', $scope.project.id, $scope.project)
				.success(function(data) {
					// if successful, we'll need to reset the project base vaiables
					$scope.project.category_id = selectedCategory;
					$scope.project.client_id = selectedClient;
				})
				.error(function(data) {
					console.log(data);
				});
        };

        // Function for deleting a project, opens a confirm modal
        $scope.deleteProject = function() {

			var modalInstance = $modal.open({
		      templateUrl: 'js/views/modals/deletemodal.html',
		      controller: 'deleteProjectModalCtrl',
		      size: 'sm',
		      scope: $scope
		    });
		};

		// Function for editing a project, opens a editable form modal
        $scope.editProject = function() {

			var modalInstance = $modal.open({
		      templateUrl: 'js/views/modals/updateprojectmodal.html',
		      controller: 'updateProjectModalCtrl',
		      size: 'lg',
		      scope: $scope
		    });
		};

		// Function for generating an invoice from the current project.
		$scope.generateInvoice = function() {

			// Set base scope variables for the new invoice
			$scope.loading = true;
			$scope.invoiceData = {};
			$scope.invoiceData.client_id = $scope.project.client_id.id;
			$scope.invoiceData.date = new Date();

			// Filter the date to match the right database syntax
			$scope.invoiceData.date = $filter('date')($scope.invoiceData.date, 'yyyy-MM-dd');

			// This column in database probably needs an autoincrement value
			$scope.invoiceData.number = 70;

			$scope.invoiceData.description = $scope.project.description;

			// Check if the project price method is 'solid'
			if($scope.project.price_method == 'solid') {
				// if so, the price exc btw is the same as the project price
				$scope.invoiceData.price_exc_btw = $scope.project.price;
			} else {
				// else, we need to calculate the price exc btw
				var totalPrice = 0;
				// take the sum of the task hours * price
				angular.forEach($scope.project.tasklist.tasks, function(task) {
					task.hours = Filter.toInteger(task.hours);
					task.price_exc_btw = task.hours * $scope.project.price;
					totalPrice = totalPrice + task.price_exc_btw;
				});
				$scope.invoiceData.price_exc_btw = totalPrice;
			}
			// Price inc btw is already saved in the database
			$scope.invoiceData.price_inc_btw = $scope.project.total_price;
			// Set the status of the invoice to false on default
			$scope.invoiceData.paid = 0;
			$scope.invoiceData.project_id = $scope.project.id;


			// Save the new invoice!
			Api.save('invoices', $scope.invoiceData)
				.success(function(data) {
					// on succes, get the latest insert id of the new invoice and save it for the foreign key in the project
					$scope.project.invoice_id = data.last_insert_id;

					// update toggle values 
					if ($scope.project.finished == false) {
		        		$scope.project.finished = 0;
		        	} else {
		        		$scope.project.finished = 1;
		        	}
					
					// update client and category id's for right put request
					var selectedCategory = $scope.project.category_id;
					$scope.project.category_id = selectedCategory.id;
					var selectedClient = $scope.project.client_id;
					$scope.project.client_id = selectedClient.id;

					// update the project with the newly created invoice id
					Api.update('projects', $scope.project.id, $scope.project)
						.success(function(data) {
						
							// if successful, redirect to the invoices page
							console.log('generated invoice');
							$location.path( "/invoices" );
							$scope.loading = false;
						})
						.error(function(data) {
							console.log(data);
						});
					
				})
				.error(function(data) {
					console.log(data);
				});
		}

		// Function for updating a task, makes an editable form visible
		$scope.updateTask = function(id) {

			// Filter the selected task
        	$scope.taskToUpdate = $filter('filter')($scope.project.tasklist.tasks, {id:id})[0];
        	// Update the task
        	Api.update('tasks', id, $scope.taskToUpdate)
				.success(function(data) {

					console.log('updated task');
					Api.get('projects/' + projectId)
						.success(function(data) {
							$scope.project = Filter.filterProject(data);
							$scope.project.category_id = selectedCategory;
							$scope.project.client_id = selectedClient;
							$scope.loading = false;
						})
						.error(function(data) {
							console.log(data);
						});	
				})
				.error(function(data) {
					console.log(data);
				});
        };

        // Function for deleting a task
        $scope.deleteTask = function(id) {
        	Api.destroy('tasks', id)
				.success(function(data) {
					Api.get('projects/' + projectId)
						.success(function(data) {
							$scope.project = Filter.filterProject(data);
							$scope.project.category_id = selectedCategory;
							$scope.project.client_id = selectedClient;
							$scope.loading = false;
						})
						.error(function(data) {
							console.log(data);
						});	
				})
				.error(function(data) {
					console.log(data);
				});
        };

        // Function for adding a task, makes a new form visible
        $scope.addTask = function() {
        	$scope.taskData = {};
			$scope.showform = true;
		};

		// Function for closing the 'Add Task' form
		$scope.closeForm = function() {
        	$scope.taskData = {};
			$scope.showform = false;
		};

		// Function for submitting the new task form
		$scope.submitTask = function() {
			$scope.showform = true;

			// Check if the current project already has a tasklist
			if($scope.project.tasklist_id) {

				// if so, set the tasklist id of the new task
				$scope.taskData.tasklist_id = $scope.project.tasklist_id;

				// Calculate price exc btw based on the price method
				if($scope.project.price_method == 'hourly') {
					$scope.taskData.price_exc_btw = $scope.taskData.hours * $scope.project.price;
				} else {
					$scope.taskData.price_exc_btw = 0.00;
				}

				// Save the new task
				Api.save('tasks', $scope.taskData)
					.success(function(data) {
						// if successful, we'll need to get the new project data and insert it in our scope
						console.log('updated task');
						Api.get('projects/' + projectId)
							.success(function(data) {
								$scope.project = Filter.filterProject(data);
								$scope.project.category_id = selectedCategory;
								$scope.project.client_id = selectedClient;
								$scope.loading = false;
								$scope.showform = false;
								$scope.taskData = {};
							})
							.error(function(data) {
								console.log(data);
							});	
					})
					.error(function(data) {
						console.log(data);
					});
			// If there is no tasklist id, we need to create one first
			} else {

				// Set new scope variables
				$scope.tasklist = {};
				$scope.tasklist.project_id = $scope.project.id;
				console.log($scope.tasklist.project_id);

				// Save new tasklist
				Api.save('tasklists', $scope.tasklist)
					.success(function(data) {
			
						// set tasklist id of task
						var tasklist_id = data.last_insert_id;
						$scope.taskData.tasklist_id = tasklist_id;
						$scope.project.tasklist_id = tasklist_id;

						if($scope.project.price_method == 'hourly') {
							$scope.taskData.price_exc_btw = $scope.taskData.hours * $scope.project.price;
						} else {
							$scope.taskData.price_exc_btw = 0.00;
						}
						console.log($scope.taskData);
						// set category and client id of current project
						$scope.project.category_id = selectedCategory.id;
						$scope.project.client_id = selectedClient.id;

						// Save the new task
						Api.save('tasks', $scope.taskData)
							.success(function(data) {
								// if successful, we'll need to update the projects with the new tasklist data
								console.log('added task');
								Api.update('projects', $scope.project.id, $scope.project)
									.success(function(data) {
										// if successful, we'll need to refresh the project data
										$scope.project = Filter.filterProject(data);
										$scope.project.category_id = selectedCategory;
										$scope.project.client_id = selectedClient;
										$scope.showform = false;
										$scope.taskData = {};
									})
									.error(function(data) {
										console.log(data);
									});
							})
							.error(function(data) {
								console.log(data);
							});
						
					})
					.error(function(data) {
						console.log(data);
					});
			}
		};

	})
	
	// Controller for the Delet Project Modal, the confirm modal
	.controller('deleteProjectModalCtrl', function($scope, $http, Api, $modalInstance, $location) {

		$scope.modal_title = "Are you sure you want to delete this project?";
		$scope.modal_text = "You can not undo this action, the project will be gone forever!";

		// Destroy the modal instance on close
		$scope.closeModal = function () {
			$modalInstance.dismiss('cancel');
		};

		// function to handle deleting a client
		$scope.delete = function() {
			$scope.loading = true; 
			if($scope.project.invoice_id) {
				Api.destroy('invoices', $scope.project.invoice_id)
					.success(function(data) {
						Api.destroy('projects', $scope.project.id)
							.success(function(data) {
								$scope.loading = false;
								$location.path( "/projects" );

							})
							.error(function(data) {
								console.log(data);
							});
						$modalInstance.close();
					})
					.error(function(data) {
						console.log(data);
					});
			} else {
				Api.destroy('projects', $scope.project.id)
					.success(function(data) {
						$scope.loading = false;
						$location.path( "/projects" );

					})
					.error(function(data) {
						console.log(data);
					});
				$modalInstance.close();
			}
			
		};
	})

	// Controller for the Update Client Modal
	.controller('updateProjectModalCtrl', function($scope, $filter, $http, Api, Filter, $modalInstance, $route) {

		// Destroy the instance on close
		$scope.closeModal = function () {
			$modalInstance.dismiss('cancel');
		};

		// function to handle submitting the form
		$scope.updateProject = function() {
			$scope.loading = true;
			
			// Update toggle values
			if ($scope.project.finished == false) {
        		$scope.project.finished = 0;
        	} else {
        		$scope.project.finished = 1;
        	}
			
			// update client and category id's for right put request
			var selectedCategory = $scope.project.category_id;
			$scope.project.category_id = selectedCategory.id;
			var selectedClient = $scope.project.client_id;
			$scope.project.client_id = selectedClient.id;

			// save the client. pass in client data from the form
			Api.update('projects', $scope.project.id, $scope.project)
				.success(function(data) {
					// if successful, we'll need to refresh the client list
					$route.reload();
					$scope.loading = false;
					$modalInstance.close();
				})
				.error(function(data) {
					console.log(data);
				});
			
		};


	});

	
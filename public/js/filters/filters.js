angular.module('filters', [])
	// Filter factory with some handy filter functions
	.factory('Filter', function($filter) {

		return {
			// takes a JSON string and converts it to a valid integer
			toInteger: function(json) {
				return parseInt(json);
			},
			// Filters a JSON object of a project
			filterProject : function(data) {

				// Set base variables
				var totalPrice = 0;
				var tax = (data.sales_tax / 100) + 1;
				var self = this; // handy for deeper scopes

				// parse integers
				data.sales_tax = self.toInteger(data.sales_tax);
				data.price = self.toInteger(data.price);

				// convert toggle values
				if(data.finished == 0) {
					data.finished = false;
				} else {
					data.finished = true;
				}

				// check if the project is hourly based
				if(data.price_method == 'hourly') {
					if(data.tasklist) {
						angular.forEach(data.tasklist.tasks, function(task) {
							task.hours = self.toInteger(task.hours);
							task.price_exc_btw = task.hours * data.price;
							totalPrice = totalPrice + task.price_exc_btw;
						});

						var raw_price = totalPrice * tax;
						totalPrice = Math.round(raw_price * 100) / 100;
						data.total_price = totalPrice;
					} else {
						data.total_price = 0.00;
					}
				// else add the tax for the solid price
				} else {
					if(data.tasklist) {
						angular.forEach(data.tasklist.tasks, function(task) {
							task.hours = self.toInteger(task.hours);
						});
					}
					var raw_price = data.price * tax;
					totalPrice = Math.round(raw_price * 100) / 100;
					data.total_price = totalPrice;
				}
				return data;
			},
			// Filter function for filtering an array of objects in the select fields
			filterItems : function(data, item_array, selectedItem) {
				angular.forEach(data, function(item, index) {
					item_array.push(item);
					if(selectedItem == item.id) {
						selectedItem = item_array[index];
					}
				});
				return [item_array,selectedItem];
			}
		}

	});
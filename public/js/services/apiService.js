angular.module('apiService', [])
	// API service for communicating with the database
	.factory('Api', function($http) {

		return {
			get : function(resource) {
				return $http.get('api/' + resource);
			},
			show : function(resource, id) {
				return $http.get('api/' + resource + '/' + id);
			},
			save : function(resource, data) {
				var params = data;
				return $http({
					method: 'POST',
					url: 'api/' + resource,
					headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
					params: params
				});
			},
			add : function(resource) {
				return $http({
					method: 'POST',
					url: 'api/' + resource,
					headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
				});
			},
			update: function(resource, id, data) {
				var params = data;
				return $http({
					method: 'PUT',
					url: 'api/' + resource + '/' + id,
					headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
					params: params
				});
			},
			destroy : function(resource, id) {
				return $http.delete('api/' + resource + '/' + id);
			}
		}

	});
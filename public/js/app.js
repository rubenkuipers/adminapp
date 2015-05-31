var clientApp = angular.module('clientApp', ['ui.bootstrap', 'toggle-switch', 'ngRoute', 'clientsCtrl', 'clientCtrl', 'mainCtrl', 'projectsCtrl', 'projectCtrl', 'invoicesCtrl', 'invoiceCtrl', 'settingsCtrl', 'apiService', 'filters'])

clientApp.config(function($routeProvider) {
    $routeProvider

        // route for the home page
        .when('/', {
            templateUrl : 'js/views/home.html',
            controller  : 'mainController'
        })

        // route for the clients page
        .when('/clients', {
            templateUrl : 'js/views/clients.html',
            controller  : 'clientsController'
        })

        .when('/clients/:clientId', {
            templateUrl : 'js/views/client.html',
            controller  : 'clientController'
        })

        // // route for the projects page
        .when('/projects', {
            templateUrl : 'js/views/projects.html',
            controller  : 'projectsController'
        })

        .when('/projects/:projectId', {
            templateUrl : 'js/views/project.html',
            controller  : 'projectController'
        })

        // // route for the invoices page
        .when('/invoices', {
            templateUrl : 'js/views/invoices.html',
            controller  : 'invoicesController'
        })

        .when('/invoices/:invoiceId', {
            templateUrl : 'js/views/invoice.html',
            controller  : 'invoiceController'
        })

        // // route for the settings page
        .when('/settings', {
            templateUrl : 'js/views/settings.html',
            controller  : 'settingsController'
        });

});
'use strict';
define("js/elementapp/elementapp",[
        'angular'
        ,'js/infrastructure/infrastructure',
        ,'js/elementapp/services/services'
        ,'js/elementapp/directives/elementEditComponents'
    ], function (angular) {
    var elementapp = angular.module('elementapp', ['html.infrastructure.Infrastructure','elementapp.services','html.elementapp.elementEditComponents','google-maps']).config(["$routeProvider",function($routeProvider){
        var baseUrl = jsPath+"elementapp/partials/";
        $routeProvider.when('/', {
            controller: 'HomeController',
            templateUrl: baseUrl+'home.html'
        });
        $routeProvider.when('/edit', {
            controller: 'EditController',
            templateUrl: baseUrl+'edit.html'
        });
        $routeProvider.otherwise({
            redirectTo: '/'
        });
    }]);
    elementapp.controller('HomeController',["$scope","$routeParams","URLService","ElementServices","CountryDataService",function($scope,$routeParams,URLService,ElementServices,CountryDataService){
        $scope.x="From angular application in element app";
        ElementServices.getElementInfo(elementId).then(function(data){
        	$scope.element = data;
        });
    }]);
    elementapp.controller('EditController',["$scope","$routeParams","URLService","ElementServices","CountryDataService",function($scope,$routeParams,URLService,ElementServices,CountryDataService){
        $scope.x="From angular application in element app";
        ElementServices.getElementInfo(elementId).then(function(data){
        	$scope.element = data;
        });
        CountryDataService.getPopularCountries().then(function(data){
        	$scope.countryList = data;
        });
        $scope.map = {
        	    center: {
        	        latitude: 45,
        	        longitude: -73
        	    },
        	    zoom: 8
        };
        $scope.updateElement = function(){
        	ElementServices.updateElement($scope.element).then(function(data){
        		console.log(data);
        	});
        };
        $scope.saveElement = function(){
        	ElementServices.updateElement($scope.element).then(function(data){
        		window.location.href = window.location.pathname;
        	});
        };
    }]);
    return elementapp;
});
    
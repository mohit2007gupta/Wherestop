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
            $scope.map = $scope.map || {};
            $scope.map.zoom = 12;
            if(data.latitude){
            	$scope.map.center.latitude = $scope.element.latitude;
            }
            if(data.longitude){
            	$scope.map.center.longitude = $scope.element.longitude;
            }
            // creating marker
            var placeMarker = {
                "latitude" : $scope.element.latitude,
                "longitude": $scope.element.longitude,
                "showWindow" : true,
                "title": $scope.element.title,
                "icon": baseUrl+"static/images/icons/blue_marker.png"
            }
            if($scope.map.markers instanceof  Array){
                $scope.map.markers.push(placeMarker);
            }
        	/*$scope.map.center = $scope.map.center || {};
        	$scope.map.center.latitude = $scope.element.latitude;
        	$scope.map.center.longitude = $scope.element.longitude;
            $scope.map.zoom = 12;*/
        });
        CountryDataService.getPopularCountries().then(function(data){
        	$scope.countryList = data;
        });
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
    
'use strict';
define("js/placeapp/placeapp",[
        'angular'
        ,'js/infrastructure/infrastructure',
        ,'js/placeapp/services/services'
        ,'js/placeapp/directives/frontcomponents'
    ], function (angular) {
    var demoapp = angular.module('placeapp', ['html.infrastructure.Infrastructure','placeapp.services','html.placeapp.frontcomponents']).config(["$routeProvider",function($routeProvider){
        var baseUrl = jsPath+"placeapp/partials/";
        $routeProvider.when('/', {
            controller: 'HomeController',
            templateUrl: baseUrl+'home.html'
        });
        $routeProvider.otherwise({
            redirectTo: '/'
        });
    }]);
    demoapp.controller('HomeController',["$scope","$routeParams","URLService","PlaceServices",function($scope,$routeParams,URLService,PlaceServices){
        $scope.x="From angular application";
        console.log('In demo angular app');
        PlaceServices.getPlaceInfo(cityId).then(function(data){
        	$scope.placeDetail = data;
        });
    }]);
    return demoapp;
});
    
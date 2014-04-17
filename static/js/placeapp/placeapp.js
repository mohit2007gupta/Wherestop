'use strict';
define("js/placeapp/placeapp",[
        'angular'
        ,'js/infrastructure/infrastructure',
        ,'js/placeapp/services/services'
        ,'js/placeapp/directives/frontcomponents'
    ], function (angular) {
    var demoapp = angular.module('placeapp', ['html.infrastructure.Infrastructure','placeapp.services','html.placeapp.frontcomponents']).config(["$routeProvider",function($routeProvider){
        var baseUrl = jsPath+"placeapp/partials/";
        $routeProvider.when('/home', {
            controller: 'HomeController',
            templateUrl: baseUrl+'home.html'
        });
        $routeProvider.otherwise({
            redirectTo: '/home'
        });
    }]);
    demoapp.controller('HomeController',["$scope","$routeParams","URLService","ElementServices",function($scope,$routeParams,URLService,ElementServices){
        $scope.x="From angular application";
        console.log('In demo angular app');
    }]);
    return demoapp;
});
    
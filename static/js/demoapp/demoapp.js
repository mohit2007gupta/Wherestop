'use strict';
define("js/demoapp/demoapp",[
        'angular'
        ,'js/infrastructure/infrastructure',
        ,'js/demoapp/services/services'
        ,'js/demoapp/directives/frontcomponents'
        ,'js/demoapp/directives/fronteditcomponents'
    ], function (angular) {
    var demoapp = angular.module('demoapp', ['html.infrastructure.Infrastructure','demoapp.services','html.demoapp.frontcomponents','html.demoapp.fronteditcomponents']).config(["$routeProvider",function($routeProvider){
        var baseUrl = jsPath+"demoapp/partials/";
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
    
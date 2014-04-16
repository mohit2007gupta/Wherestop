'use strict';

/* Services */

define("js/infrastructure/js/services/ElementServices",[
    'angular',
    'jquery'
], function (angular, $) {
    var ElementServices = angular.module("html.infrastructure.ElementServices", []);
    /*Constants Used in the Infrastructure*/
    ElementServices.constant("ElementConstants", {
        "BASE_URI" : baseUrl,
        "INFRASTRUCTURE_URI" : jsPath+"infrastructure/",
        "INFRASTRUCTURE_PARTIALS_URI": jsPath+"infrastructure/partials/"
    });
    ElementServices.factory("ElementDataService", ["$location","$http", "$log", "$q", function ($location, $http, $log, $q) {
        var that = this;
        this.getElementInfo = function(elementId){

        };

        return this;
    }]);
    ElementServices.factory("ElementEditService", ["$location","$http", "$log", "$q", function ($location, $http, $log, $q) {
        var that = this;
        this.addElementPartial = function(elementModel){
            var deferred = $q.defer();
            var urlToUse = baseUrl+'rest/element/addpartial/';
            $http.post(urlToUse,elementModel).success(function(data){
                deferred.resolve(data);
            }).error(function(data){
                    deferred.reject();
            });
            return deferred.promise;
        }
        return this;
    }]);
    ElementServices.factory("ElementSearchServices", ["$location","$http", "$log", "$q", function ($location, $http, $log, $q) {
        var that = this;
        this.getAllElements = function() {
            var deferred = $q.defer();
            var urlToUse = baseUrl+'rest/element/';
            $http({
                url: urlToUse,
                method: "GET"
            }).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
            return deferred.promise;
        };
        return this;
    }]);
    ElementServices.factory("ElementEatServices", ["$location","$http", "$log", "$q", function ($location, $http, $log, $q) {
        var that = this;
        this.getCuisine = function() {
            var deferred = $q.defer();
            var urlToUse = baseUrl+'rest/element/cuisine';
            $http({
                url: urlToUse,
                method: "GET"
            }).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
            return deferred.promise;
        };
        return this;
    }]);
    return ElementServices;
});

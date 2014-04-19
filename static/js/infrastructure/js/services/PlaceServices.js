'use strict';

/* Services */

define("js/infrastructure/js/services/PlaceServices",[
    'angular',
    'jquery'
], function (angular, $) {
    var PlaceServices = angular.module("html.infrastructure.PlaceServices", []);
    /*Constants Used in the Infrastructure*/
    PlaceServices.constant("ElementConstants", {
        
    });
    PlaceServices.factory("CountryDataService", ["$location","$http", "$log", "$q", function ($location, $http, $log, $q) {
        var that = this;
        this.getPopularCountries = function(elementId){
        	var deferred = $q.defer();
            var urlToUse = baseUrl+'rest/place/country';
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
    
    return PlaceServices;
});

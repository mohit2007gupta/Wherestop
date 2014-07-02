'use strict';
/* Services */

define('js/elementapp/services/services',[
    'angular',
    'jquery'
], function (angular, $) {
    var FrontAppServices = angular.module("elementapp.services", ["html.infrastructure.Infrastructure"]);
    FrontAppServices.factory('ElementServices',["$location","$http", "$log","$q", function($location,$http,$log, $q) {
        return{
            addElement : function(elementModel){
                var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/element/add/';
                $http.post(urlToUse,elementModel).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
                return deferred.promise;
            },
            updateElement : function(elementModel){
            	var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/element/update/';
                $http.post(urlToUse,elementModel).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
                return deferred.promise;
            },
            getElementInfoFromSlug : function(elementSlug){
                var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/element/infofromslug/'+elementSlug;
                $http({
                    url: urlToUse,
                    method: "GET",
                    params: {

                    }
                }).success(function(data){
                        deferred.resolve(data);
                    }).error(function(data){
                        deferred.reject();
                    });
                return deferred.promise;
            },
            getElementInfo : function(elementId){
                var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/element/info/'+elementId;
                $http({
                    url: urlToUse,
                    method: "GET",
                    params: {

                    }
                }).success(function(data){
                        deferred.resolve(data);
                    }).error(function(data){
                        deferred.reject();
                    });
                return deferred.promise;
            },
            getElementList : function(args){
                var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/element/';
                $http({
                    url: urlToUse,
                    method: "GET",
                    params: {
                        "filter" : args
                    }
                }).success(function(data){
                        deferred.resolve(data);
                    }).error(function(data){
                        deferred.reject();
                    });
                return deferred.promise;
            },
            getNearbyMarkers : function(center){
                var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/element/getNearbyMarkers';
                $http({
                    url: urlToUse,
                    method: "GET",
                    params: {
                        "longitude":center.longitude,
                        "latitude":center.latitude
                    }
                }).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
                return deferred.promise;
            }
        };
    }]);
    FrontAppServices.factory('MapMarkers',["$location","$http", "$log","$q", function($location,$http,$log, $q) {

    }]);
    return FrontAppServices;
});
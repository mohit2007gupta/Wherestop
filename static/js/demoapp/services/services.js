'use strict';
/* Services */

define([
    'angular',
    'jquery'
], function (angular, $) {
    var FrontAppServices = angular.module("demoapp.services", ["html.infrastructure.Infrastructure"]);
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
            }
        };
    }]);

    return FrontAppServices;
});
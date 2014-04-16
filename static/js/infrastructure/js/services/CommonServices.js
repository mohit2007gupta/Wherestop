'use strict';

/* Services */

define("js/infrastructure/js/services/CommonServices",[
    'angular',
    'jquery'
], function (angular, $) {
    var CommonServices = angular.module("html.infrastructure.CommonServices", []);
    /*Constants Used in the Infrastructure*/
    CommonServices.constant("CommonConstants", {
        "BASE_URI" : baseUrl,
        "JS_PATH": jsPath,
        "INFRASTRUCTURE_URI" : jsPath+"infrastructure/",
        "INFRASTRUCTURE_PARTIALS_URI": jsPath+"infrastructure/partials/"
    });
    /*Configuring the common services - adding custom header and calling ajax prefilter*/
    CommonServices.factory("URLService", ["$location","$http", "$log", "$q","CommonConstants", function ($location, $http, $log, $q,CommonConstants) {
        var that = this;
        this.baseUrl = "";
        this.getURLConstants = function(){
            return CommonConstants;
        };
        this.getInfrastructurePath = function() {
                return CommonConstants.INFRASTRUCTURE_URI;
        };
        this.setBaseUrl = function(baseUrl){
            this.baseUrl = baseUrl;
        };
        this.getBaseUrl = function(){
            return CommonConstants.BASE_URI;
        };
        this.getJsPath = function(){
            return CommonConstants.JS_PATH;
        };
        this.getInfrastructurePartialsPath = function(){
            return CommonConstants.INFRASTRUCTURE_PARTIALS_URI;
        }
        return this;
    }]);
    CommonServices.factory("CountryService", ["$location","$http", "$log", "$q","CommonConstants", function ($location, $http, $log, $q,CommonConstants) {
        var that = this;
        this.getCountries = function() {
            var deferred = $q.defer();
            var urlToUse = baseUrl+'rest/common/countries/';
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
    CommonServices.factory("PlaceService", ["$location","$http", "$log", "$q","CommonConstants", function ($location, $http, $log, $q,CommonConstants) {
        var that = this;

        this.getPlaces = function(countryId) {
            var deferred = $q.defer();
            if(countryId==null){
                countryId = "99";
            }
            var urlToUse = baseUrl+'rest/place/';
            $http({
                url: urlToUse,
                method: "GET",
                params: {
                    "countryId" : countryId
                }
            }).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
            return deferred.promise;
        };
        this.getCitiesFilter = function(param,countryId) {
            var deferred = $q.defer();
            if(countryId==null){
                countryId = "0";
            }
            var urlToUse = baseUrl+'rest/place/filter';
            $http({
                url: urlToUse,
                method: "GET",
                params: {
                    "filter": param,
                    "countryId" : countryId
                }
            }).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
            return deferred.promise;
        };
        return this;
    }]);
    CommonServices.factory("IsolatedScopeConnector", ["$log",'$parse', function ($log,$parse) {
        var linkIsolatedScope = function(scope,attrs,attrName,scopeName){
            var lastValue,parentGet, parentSet,parentScope=scope.$parent;

            parentGet = $parse(attrs[attrName]);
            parentSet = parentGet.assign || function() {
                // reset the change, or we will throw this exception on every $digest
                lastValue = scope[scopeName] = parentGet(parentScope);
                throw Error('NON_ASSIGNABLE_MODEL_EXPRESSION' + attrs[attrName] +
                    ' (directive: KrnDatePicker )');
            };
            parentSet(scope, lastValue = scope[scopeName] = parentGet(parentScope));
            scope.$watch(function parentValueWatch() {
                var parentValue = parentGet(parentScope);

                if (parentValue !== parentGet(scope)) {
                    // we are out of sync and need to copy
                    if (parentValue !== lastValue) {
                        // parent changed and it has precedence
                        parentSet(scope, lastValue = scope[scopeName] = parentValue);
                    } else {
                        // if the parent can be assigned then do so
                        parentSet(parentScope, parentValue = lastValue = parentGet(scope));
                    }
                }
                return parentValue;
            },true);
        };
        return linkIsolatedScope;
    }]);
    CommonServices.factory("SearchServices",["$location","$http", "$log", "$q","CommonConstants", function ($location, $http, $log, $q,CommonConstants) {
        var that = this;
        this.getSearchSuggestions = function(viewValue){
            var deferred =$q.defer();
            var urlToUse=baseUrl+'rest/search/suggestions';
            $http({
                url: urlToUse,
                method: "GET",
                params:{
                    "viewValue" : viewValue
                }
                }).success(function(data){
                    deferred.resolve(data);
                }).error(function(){
                    deferred.reject();
                });
            return deferred.promise;
        };
        return this;
    }]);
    CommonServices.factory("MessageService",["$location","$http", "$log", "$q","CommonConstants", function ($location, $http, $log, $q,CommonConstants) {
        var that = this;
        this.getStatusFromStatusCode = function(status){
            switch(status){
                case 10 : return "success";
                case 7 : return "info";
                case 5 : return "warning";
                case 0 : return "error";
                default : return "error";
            }
            return "error";
        };
        this.getMessageObjectFromJson=function(response){
            var returnObject = {} ;
            returnObject.type = this.getStatusFromStatusCode(response.status) ;
            returnObject.msg = response.message ;
            return returnObject;
        }
        return this;
    }]);
    return CommonServices;
});

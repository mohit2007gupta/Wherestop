'use strict';

/* Services */

define("js/infrastructure/js/services/WidgetServices",[
    'angular',
    'jquery'
], function (angular, $) {
    var WidgetServices = angular.module("html.infrastructure.WidgetServices", []);
    WidgetServices.factory("ContactinfoServices", ["$location","$http", "$log", "$q", function ($location, $http, $log, $q) {
        var that = this;
        this.getAllModes = function(){
            return {
                "search":false,
                "full":false
            }
        }
        this.getContactInfoModel = function(elementId){
            var deferred = $q.defer();
            var urlToUse = baseUrl+'rest/widget/contactinfo';
            $http({
                url: urlToUse,
                method: "GET",
                params : {
                    "elementId" : elementId
                }
            }).success(function(data){
                    deferred.resolve(data);
                }).error(function(data){
                    deferred.reject();
                });
            return deferred.promise;
        }
        return this;
    }]);

    return WidgetServices;
});

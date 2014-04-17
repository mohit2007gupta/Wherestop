'use strict';
/* Services */

define('js/placeapp/services/services',[
    'angular',
    'jquery'
], function (angular, $) {
    var FrontAppServices = angular.module("placeapp.services", ["html.infrastructure.Infrastructure"]);
    FrontAppServices.factory('PlaceServices',["$location","$http", "$log","$q", function($location,$http,$log, $q) {
        return{
        	getPlaceInfo : function(placeId){
            	var deferred = $q.defer();
                var urlToUse = baseUrl+'rest/place/info/'+placeId;
                $http({
                    url: urlToUse,
                    method: "GET",
                    params: {
                        "placeId" : placeId
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
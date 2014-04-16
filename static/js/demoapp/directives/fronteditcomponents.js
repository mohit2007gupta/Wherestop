define("js/demoapp/directives/fronteditcomponents",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/ElementServices'
], function (angular, $) {
    var frontEditModule = angular.module("html.demoapp.fronteditcomponents", [
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.ElementServices"
    ]);
    frontEditModule.directive('wsEditMain',["URLService","$location","$anchorScroll", function(URLService,$location,$anchorScroll){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.getPlaces = function(query){
                    console.log("query from"+query);
                    return  ["a","b","c"];
                };
                $scope.gotoBottom = function (hashCode){
                    // set the location.hash to the id of
                    // the element you wish to scroll to.
                    $location.hash(hashCode);

                    // call $anchorScroll()
                    $anchorScroll();
                }
            }],
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempEditMain.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    frontEditModule.directive('wsEditEatTiming',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {

            }],
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempEditEatTiming.html",
            link : function(scope,element,attrs,icontroller){
                scope.hstep = 1;
                scope.mstep = 15;
                scope.ismeridian = true;
                scope.days = new Array("All Day","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
            }
        };
    }]);
    frontEditModule.directive('wsEditEat',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.cusinInputHandler = function(){
                    $scope.model.cuisine.push($scope.cuisine);
                }
            }],
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempEditEat.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    frontEditModule.directive('wsEditBar',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {

            }],
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempEditBar.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    frontEditModule.directive('wsEditMap',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.map = {
                    center: {
                        latitude: 28.5855,
                        longitude: 77.2499
                    },
                    zoom: 9
                };
                $scope.marker = {
                    latitude: 28.5855,
                    longitude: 77.36147,
                    click: function(){ alert('hello');}
                }
                $scope.onMarkerClicked = function (marker) {
                    alert('clicked');
                    console.log(marker);
                    marker.showWindow = true;
                    //window.alert("Marker: lat: " + marker.latitude + ", lon: " + marker.longitude + " clicked!!")
                };
                $scope.addMarker = function(){
                    console.log('Hello adding marker');
                    var m = {
                        latitude: $scope.map.center.latitude,
                        longitude: $scope.map.center.longitude,
                        showWindow: true,
                        title: "Added marker",
                        icon: '/ws/static/images.green.png'
                    };

                };
                $scope.map.markers = [
                    {
                        latitude: 28.5855,
                        longitude: 77.36157,
                        showWindow: true,
                        title: 'My Home 1',
                        showWindow : true
                    },
                    {
                        latitude: 28.6845,
                        longitude: 77.26147,
                        showWindow: false,
                        title: 'My Home 2'
                    }/*,
                    {
                        latitude: 28.5855,
                        longitude: 77.36137,
                        showWindow: false,
                        title: 'My Home 3'
                    }*/,
                    {
                        latitude: 28.6327,
                        longitude: 77.21948,
                        showWindow: true,
                        title: 'My Bar',
                        draggable: true,
                        icon: './static/images/green.png'
                    }
                ]
            }],
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempEditMap.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    return frontEditModule;
});
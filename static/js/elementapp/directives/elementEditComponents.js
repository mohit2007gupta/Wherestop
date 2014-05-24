define("js/elementapp/directives/elementEditComponents",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/ElementServices'
], function (angular, $) {
    var elementEditModule = angular.module("html.elementapp.elementEditComponents", [
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.ElementServices"
    ]);
    elementEditModule.directive('wsEditMain',["URLService","$location","$anchorScroll", function(URLService,$location,$anchorScroll){
        return {
            restrict : 'A',
            replace:true,
            controller: ["$scope", function ($scope) {
                $scope.getPlaces = function(query){
                    return  ["a","b","c"];
                };
                $scope.selectCountry = function(country){
                	$scope.element.country = country;
                	$scope.map = $scope.map || {};
                	$scope.map.latitude = country.latitude;
                	$scope.map.longitude = country.longitude;
                	$scope.map.zoom = country.zoom;
                };
                $scope.citySelected = function(selectedCity){
                	//selectedCity = $scope.element.place;
                	
                }
            }],
            templateUrl: URLService.getJsPath()+"elementApp/partials/editMain.html",
            link : function(scope,element,attrs,icontroller){
            	scope.$watch('element.place',function(newValue,oldValue){
            		if(newValue && newValue != oldValue){
            			scope.map = scope.map || {};
                    	scope.map.latitude = newValue.latitude;
                    	scope.map.longitude = newValue.longitude;
                    	scope.map.zoom = newValue.zoom;
            		}
            	},true);
            }
        };
    }]);
    elementEditModule.directive('wsEditMap',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.map = {
                    center: {
                        latitude: 26.8068858,
                        longitude: 80.901416
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
            templateUrl: URLService.getJsPath()+"elementapp/partials/tempEditMap.html",
            link : function(scope,element,attrs,icontroller){
            	scope.$watch('model',function(newValue,oldValue){
            		if(scope.model && scope.model.longitude && scope.model.latitude && scope.model.zoom){
            			var newCenter = {};
            			newCenter.latitude = scope.model.latitude;
            			newCenter.longitude = scope.model.longitude;
            			scope.map.center = newCenter;
            			scope.map.zoom = scope.model.zoom;
            		}
            	},true);
            }
        };
    }]);
    return elementEditModule;
});
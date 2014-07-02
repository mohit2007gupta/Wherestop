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
                $scope.elementautocomplete = {
                		"types":"(regions)"
                };
                
                $scope.optionsautocomplete = {};
                $scope.autocomplete = "";
                $scope.selectCountry = function(country){
                	$scope.element.country = country;
                	/*$scope.map = $scope.map || {};
                	$scope.map.latitude = country.latitude;
                	$scope.map.longitude = country.longitude;
                	$scope.map.zoom = country.zoom;*/
                };
                $scope.citySelected = function(selectedCity){
                	//selectedCity = $scope.element.place;
                	
                }
            }],
            templateUrl: URLService.getJsPath()+"elementApp/partials/editMain.html",
            link : function(scope,element,attrs,icontroller){
            	scope.$watch('element.place',function(newValue,oldValue){
            		if(newValue && newValue != oldValue){
            			/*scope.map = scope.map || {};
                    	scope.map.latitude = newValue.latitude;
                    	scope.map.longitude = newValue.longitude;
                    	scope.map.zoom = newValue.zoom;*/
            		}
            	},true);
            }
        };
    }]);
    elementEditModule.directive('wsEditMap',["URLService","ElementServices", function(URLService, ElementServices){
        var updateNearbyMarkers = function(scope){
            ElementServices.getNearbyMarkers(scope.geometry.center).then(function(data){
                if(data.status==true && data.markers && data.markers instanceof Array){
                    var tempMarker;
                    scope.geometry.markers=[];
                    for(var i=0;i< data.markers.length;i++){
                        tempMarker=data.markers[i];

                        tempMarker.icon = baseUrl+'static/images/icons/marker.png';
                        tempMarker.showWindow=true;
                        scope.geometry.markers.push(tempMarker);
                    }
                }
            });
        };
        return {
            restrict : 'A',
            replace:true,
            scope: {
                //'model': '='
                'geometry': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.geometry = $scope.geometry || {};
                $scope.geometry.center = $scope.geometry.center || {};
                $scope.geometry.zoom = $scope.geometry.zoom || 12;
                $scope.geometry.center.latitude = 28.5855;
                $scope.geometry.center.longitude = 77.36147;
                /*$scope.marker = {
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

                };*/
                /*$scope.geometry.markers = [
                    {
                        latitude: 28.5855,
                        longitude: 77.36157,
                        showWindow: true,
                        title: 'My Home 1',
                        showWindow : true,
                        icon: baseUrl+'static/images/icons/marker.png'
                    },
                    {
                        latitude: 28.6845,
                        longitude: 77.26147,
                        showWindow: false,
                        title: 'My Home 2',
                        icon: baseUrl+'static/images/icons/marker.png'
                    },
                    {
                        latitude: 28.5855,
                        longitude: 77.36137,
                        showWindow: false,
                        title: 'My Home 3',
                        icon: baseUrl+'static/images/icons/marker.png'
                    },
                    {
                        latitude: 28.6327,
                        longitude: 77.21948,
                        showWindow: true,
                        title: 'My Bar',
                        draggable: true,
                        icon: baseUrl+'static/images/icons/marker.png'
                    }
                ]*/
            }],
            templateUrl: URLService.getJsPath()+"elementapp/partials/tempEditMap.html",
            link : function(scope,element,attrs,icontroller){
                scope.$watch('geometry',function(newValue,oldValue){
                    if(newValue && newValue != oldValue){
                        console.log("changed");
                        //scope.geometry = newValue;
                        //scope.refresh = true;
                    }
                    updateNearbyMarkers(scope);
                },true);

            }
        };
    }]);
    return elementEditModule;
});
define("js/elementapp/directives/elementComponents",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/ElementServices'
], function (angular, $) {
    var elementModule = angular.module("html.elementapp.elementComponents", [
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.ElementServices"
    ]);
    editModule.directive('wsPlaceDescription',["URLService", function(URLService){
        return {
            restrict : 'EA',
            replace:true,
            controller: ["$scope", function ($scope) {
                
            }],
            template: '<div class="ws-place-widget ws-widget-fix-height ws-inverse"><header>{{placeDetail.name}}</header><div class="content"><span ng-bind-template="{{placeDetail.description}}"></span></div></div>',
            //templateUrl: URLService.getJsPath()+"frontApp/partials/tempMain.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    frontModule.directive('wsPlaceMap',["URLService", function(URLService){
        return {
            restrict : 'EA',
            replace:true,
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
            //template: '<div class="ws-place-widget ws-inverse"></div>',
            templateUrl: URLService.getJsPath()+"placeapp/partials/placemap.html",
            link : function(scope,element,attrs,icontroller){
            	scope.map = {
                        center: {
                            latitude: 28.5855,
                            longitude: 77.2499
                        },
                        zoom: 9
                    };
            }
        };
    }]);
    return frontModule;
});
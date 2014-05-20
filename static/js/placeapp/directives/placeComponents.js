define("js/placeapp/directives/placeComponents",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/ElementServices'
], function (angular, $) {
    var frontModule = angular.module("html.placeapp.placeComponents", [
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.ElementServices"
    ]);
    frontModule.directive('wsPlaceDescription',["URLService", function(URLService){
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
    frontModule.directive('wsPlaceElementContainer',["URLService", function(URLService){
        return {
            restrict : 'EA',
            replace:true,
            transclude: true,
            scope: {
            	'pic':'='
            },
            controller: ["$scope", function ($scope) {
                
            }],
            template: '<div class="ws-place-widget ws-widget-fix-height ws-inverse" ng-transclude></div></div>',
            //templateUrl: URLService.getJsPath()+"frontApp/partials/tempMain.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    frontModule.directive('wsPlaceElement',["URLService", function(URLService){
        return {
            restrict : 'EA',
            replace:true,
            transclude: true,
            controller: ["$scope", function ($scope) {
                
            }],
            templateUrl: URLService.getJsPath()+"placeapp/partials/widgetelement.html",
            //templateUrl: URLService.getJsPath()+"frontApp/partials/tempMain.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    return frontModule;
});
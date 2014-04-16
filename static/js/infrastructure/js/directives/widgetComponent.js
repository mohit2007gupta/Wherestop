define("js/infrastructure/js/directives/widgetComponent",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
], function (angular, $) {
    var widgetModule = angular.module("html.infrastructure.components.WidgetComponent", [
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.WidgetServices"
    ]);


    widgetModule.directive('wsContactInfo',["URLService","ContactinfoServices", function(URLService,ContactinfoServices){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '=',
                'elementid':'='
            },
            controller: ["$scope","$location", function ($scope,$location) {
                ContactinfoServices.getContactInfoModel($scope.elementid).then(function(data){
                    console.log('Ajax baby');
                    $scope.model.contactinfo = data;
                });
            }],
            templateUrl: URLService.getInfrastructurePartialsPath()+"widget_contactinfo.html",
            link : function(scope,element,attrs,icontroller){
                scope.model.urlService = URLService.getURLConstants();
                scope.mode = {
                    "search":false,
                    "full":false
                }
                if(scope.mode[attrs.mode]!=null){
                    scope.mode[attrs.mode]=true;
                }
                scope.model.contactinfo = {};
            }
        };
    }]);


    return widgetModule;
});
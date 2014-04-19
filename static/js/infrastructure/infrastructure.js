/**
 * Created with JetBrains WebStorm.
 * User: Mohit.Gupta
 * Date: 8/16/13
 * Time: 2:21 PM
 * To change this template use File | Settings | File Templates.
 */
define("js/infrastructure/infrastructure",[
    'angular'
    ,'jquery'
    ,'underscore'
    ,'bootstrap'
    ,'js/infrastructure/js/directives/message'
    ,'js/infrastructure/js/directives/commonComponent'
    ,'js/infrastructure/js/directives/gallery'
    ,'js/infrastructure/js/directives/widgetComponent'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/WidgetServices'
    ,'js/infrastructure/js/services/ElementServices'
    ,'js/infrastructure/js/services/PlaceServices'
], function (angular,$,_) {
    var infrastructureModule = angular.module("html.infrastructure.Infrastructure", [
        "html.infrastructure.components.Message"
        ,"html.infrastructure.components.CommonComponent"
        ,"html.infrastructure.components.gallery"
        ,"html.infrastructure.components.WidgetComponent"
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.WidgetServices"
        ,"html.infrastructure.ElementServices"
        ,"html.infrastructure.PlaceServices"
        ,"ui.bootstrap"
        ,"google-maps"
    ]);
    infrastructureModule.run(["URLService","$rootScope",function(URLService,$rootScope){
        $rootScope.baseUrl = baseUrl;
    }]);
    return infrastructureModule;
});

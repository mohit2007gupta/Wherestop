define("js/infrastructure/js/directives/message",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
], function (angular, $) {
    var messageModule = angular.module("html.infrastructure.components.Message", [
        ,"html.infrastructure.CommonServices"
    ]);
    messageModule.directive('wsMessage',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {

            }],
            //template: "<div>Hello Contact Info</div>",
            templateUrl: URLService.getInfrastructurePartialsPath()+"message.html",
            link : function(scope,element,attrs,icontroller){

                console.log("Message directive created!!!")
                console.log(URLService.getInfrastructurePartialsPath());
            }
        };
    }]);

    return messageModule;
});
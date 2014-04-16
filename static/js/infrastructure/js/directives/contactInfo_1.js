/**
 * Created with JetBrains WebStorm.
 * User: Mohit.Gupta
 * Date: 9/25/13
 * Time: 4:13 PM
 * To change this template use File | Settings | File Templates.
 */

define("infrastructure/js/directives/contactInfo",[ 
    'angular'
    ,'jquery'
    ,function (angular,$) {
    var componentModule = angular.module("html.infrastructure.components.contactInfo");
    componentModule.directive('wsContactInfo', function(){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {

            }],
            template: "<div>Hello Contact Info</div>",
            link : function(scope,element,attrs,icontroller){

            }
        };
    });
    return componentModule;
}]);


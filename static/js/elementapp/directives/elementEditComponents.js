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
                };
            }],
            templateUrl: URLService.getJsPath()+"elementApp/partials/editMain.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    return elementEditModule;
});
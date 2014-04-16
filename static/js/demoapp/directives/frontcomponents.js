define("js/demoapp/directives/frontcomponents",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/ElementServices'
], function (angular, $) {
    var frontModule = angular.module("html.demoapp.frontcomponents", [
        ,"html.infrastructure.CommonServices"
        ,"html.infrastructure.ElementServices"
    ]);
    frontModule.directive('wsMain',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.rate = 7;
                $scope.max = 10;
                $scope.isReadonly = false;

                $scope.hoveringOver = function(value) {
                    $scope.overStar = value;
                    $scope.percent = 100 * (value / $scope.max);
                };
                $scope.maingalleryoptions = {
                    "thumbnail": true,
                    "thumbnailcount": 4
                }
            }],
            //template: "<div>Hello Contact Info</div>",
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempMain.html",
            link : function(scope,element,attrs,icontroller){

            }
        };
    }]);
    frontModule.directive('wsTabbed',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.switchView = function(view){
                    $scope.tabopen = view;
                }
            }],
            //template: "<div>Hello Contact Info</div>",
            templateUrl: URLService.getJsPath()+"frontApp/partials/tempTabbed.html",
            link : function(scope,element,attrs,icontroller){
                scope.tabopen = "tab1";
            }
        };
    }]);
    frontModule.directive('wsAddnew',["URLService","$modal","ElementEditService","$location", function(URLService,$modal,ElementEditService, $location){
        var ModalInstanceCtrl = function ($scope, $modalInstance) {
            $scope.model = $scope.model || {};
            $scope.create = function () {
                console.log($scope.model);
                ElementEditService.addElementPartial($scope.model).then(function(data){
                    console.log(data);
                    if(data.status){
                        $location.url("/edit/"+data.element.slug);
                        $modalInstance.close(scope.model);
                    }
                });
            };
            $scope.cancel = function () {
                $modalInstance.dismiss('cancel');
            };
        };
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.open = function () {
                    var modalInstance = $modal.open({
                        templateUrl: 'addElemetModal',
                        controller: ModalInstanceCtrl,
                        resolve: {
                            items: function () {
                                return $scope.items;
                            }
                        }
                    });
                    modalInstance.result.then(function (data) {
                        console.log(data);
                        console.log("modal closing ");
                    },function(data) {
                        console.log(data)
                        console.log("closing callack");
                    });
                };
            }],
            //template: '',
            templateUrl: URLService.getJsPath()+"frontApp/partials/addnewtemplate.html",
            link : function(scope,element,attrs,icontroller){
                //scope.tabopen = "tab1";
            }
        };
    }]);
    frontModule.directive('wsTiming',["URLService", function(URLService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope", function ($scope) {

            }],
            //template: "<div>Hello Contact Info</div>",
            templateUrl: URLService.getJsPath()+"frontApp/partials/timing.html",
            link : function(scope,element,attrs,icontroller){
                scope.days = new Array("All Day","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
                for(var i in scope.model){

                }
            }
        };
    }]);
    frontModule.filter('timeformat', function() {
        return function(input) {
            var timeArr = input.split(":");
            var toShowText = "";
            if(parseInt(timeArr)>12){
                toShowText = "PM";
            }else{
                toShowText = "AM";
            }
            timeArr[0] = parseInt((timeArr[0])%12);
            var toReturn = timeArr[0];
            if(parseInt(timeArr[1])!=0){
                toReturn += ":"+timeArr[1];
            }
            return toReturn+" "+toShowText;
        };
    });
    return frontModule;
});
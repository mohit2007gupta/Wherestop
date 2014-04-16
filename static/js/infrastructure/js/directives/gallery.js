define("js/infrastructure/js/directives/gallery",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
], function (angular, $) {
    var componentModule = angular.module("html.infrastructure.components.gallery", [
        ,"html.infrastructure.CommonServices"
    ]);
    componentModule.directive('wsPhotoGallery', ["URLService", function(URLService) {
        var defaultGalleryOptions = function(){
            return {

            }
        }

        return {
            controller: ["$scope","$modal", function ($scope,$modal) {
                $scope.openMedia = function(){
                    var modalInstance = $modal.open({
                        templateUrl: URLService.getInfrastructurePartialsPath()+"media.html",
                        //controller: ModalInstanceCtrl,
                        windowClass: "modal fade in media-modal",
                        resolve: {

                        }
                    });

                    modalInstance.result.then(function (selectedItem) {
                        console.log('loaded');
                    }, function () {
                        //$log.info('Modal dismissed at: ' + new Date());
                    });
                }
            }],
            templateUrl: URLService.getInfrastructurePartialsPath()+"gallery.html",
            restrict: 'E',
            scope: {
                "list":'=',
                "options":'='
            },
            link: function(scope, element, attrs, ctrl) {

            }
        };
    }]);



    return componentModule;
});
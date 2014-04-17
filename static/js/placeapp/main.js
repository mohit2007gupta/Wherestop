require([
  'jquery',
  'angular',
  'js/placeapp/placeapp'
], function($,angular, placeapp) {
    $(function(){
        console.log("bootstrapping placeapp");
        angular.bootstrap(angular.element("body"), ['placeapp']);
    });
});

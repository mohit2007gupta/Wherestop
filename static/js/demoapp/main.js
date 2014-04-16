require([
  'jquery',
  'angular',
  'js/demoapp/demoapp'
], function($,angular, demoapp) {
    $(function(){
        console.log("bootstrapping demoapp");
        angular.bootstrap(angular.element("body"), ['demoapp']);
    });
});

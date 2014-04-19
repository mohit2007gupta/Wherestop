require([
  'jquery',
  'angular',
  'js/elementapp/elementapp'
], function($,angular, elementapp) {
    $(function(){
        console.log("bootstrapping elementapp");
        angular.bootstrap(angular.element("body"), ['elementapp']);
    });
});

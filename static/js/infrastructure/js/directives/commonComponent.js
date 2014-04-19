define("js/infrastructure/js/directives/commonComponent",[
    'angular'
    ,'jquery'
    ,'js/infrastructure/js/services/CommonServices'
    ,'js/infrastructure/js/services/ElementServices'
], function (angular, $) {
    var componentModule = angular.module("html.infrastructure.components.CommonComponent", [
        ,"html.infrastructure.CommonServices"
    ]);
    componentModule.filter('getlast', function() {
        return function(arr, count) {
            if(arr){
                return arr.slice((arr.length-count));
            }
        };
    });
    componentModule.directive('wsTimeDifference', function() {
        return {
            template: "<div>{{timedifference}}</div>",
            restrict: 'A',
            scope: {
                "datetime":"="
            },
            link: function(scope, element, attrs, ctrl) {

            }
        };
    });
    componentModule.directive('image',["URLService","CountryService","$q", function(URLService,CountryService,$q){
        var URL = window.URL || window.webkitURL;

        var getResizeArea = function () {
            var resizeAreaId = 'fileupload-resize-area';

            var resizeArea = document.getElementById(resizeAreaId);

            if (!resizeArea) {
                resizeArea = document.createElement('canvas');
                resizeArea.id = resizeAreaId;
                resizeArea.style.visibility = 'hidden';
                document.body.appendChild(resizeArea);
            }
            return resizeArea;
        }
        var resizeImage = function (origImage, options) {
            var maxHeight = options.resizeMaxHeight || 300;
            var maxWidth = options.resizeMaxWidth || 250;
            var quality = options.resizeQuality || 0.7;
            var type = options.resizeType || 'image/jpg';

            var canvas = getResizeArea();

            var height = origImage.height;
            var width = origImage.width;

            // calculate the width and height, constraining the proportions
            if (width > height) {
                if (width > maxWidth) {
                    height = Math.round(height *= maxWidth / width);
                    width = maxWidth;
                }
            } else {
                if (height > maxHeight) {
                    width = Math.round(width *= maxHeight / height);
                    height = maxHeight;
                }
            }

            canvas.width = width;
            canvas.height = height;

            //draw image on canvas
            var ctx = canvas.getContext("2d");
            ctx.drawImage(origImage, 0, 0, width, height);

            // get the data from canvas as 70% jpg (or specified type).
            return canvas.toDataURL(type, quality);
        };

        var createImage = function(url, callback) {
            var image = new Image();
            image.onload = function() {
                callback(image);
            };
            image.src = url;
        };

        var fileToDataURL = function (file) {
            var deferred = $q.defer();
            var reader = new FileReader();
            reader.onload = function (e) {
                deferred.resolve(e.target.result);
            };
            reader.readAsDataURL(file);
            return deferred.promise;
        };
        return {
            restrict: 'A',
            scope: {
                image: '=',
                resizeMaxHeight: '@',
                resizeMaxWidth: '@',
                resizeQuality: '@',
                resizeType: '@'
            },
            link: function(scope, element, attrs, ctrl) {

                var doResizing = function(imageResult, callback) {
                    createImage(imageResult.url, function(image) {
                        var dataURL = resizeImage(image, scope);
                        imageResult.resized = {
                            dataURL: dataURL,
                            type: dataURL.match(/:(.+\/.+);/)[1]
                        };
                        callback(imageResult);
                    });
                };

                var applyScope = function(imageResult) {
                    scope.$apply(function() {
                        //console.log(imageResult);
                        if(attrs.multiple)
                            scope.image.push(imageResult);
                        else
                            scope.image = imageResult;
                    });
                    scope.$apply();
                };


                element.bind('change', function (evt) {
                    //when multiple always return an array of images
                    if(attrs.multiple)
                        scope.image = [];

                    var files = evt.target.files;
                    for(var i = 0; i < files.length; i++) {
                        //create a result object for each file in files
                        var imageResult = {
                            file: files[i],
                            url: URL.createObjectURL(files[i])
                        };

                        fileToDataURL(files[i]).then(function (dataURL) {
                            imageResult.dataURL = dataURL;
                        });

                        if(scope.resizeMaxHeight || scope.resizeMaxWidth) { //resize image
                            doResizing(imageResult, function(imageResult) {
                                applyScope(imageResult);
                            });
                        }
                        else { //no resizing
                            applyScope(imageResult);
                        }
                    }
                });
            }
        };
    }]);
    componentModule.directive('wsCountrySelector',["URLService","CountryService", function(URLService,CountryService){
        return {
            restrict : 'E',
            replace:false,
            scope: {
                'countryid': '='
            },
            controller: ["$scope", function ($scope) {
                $scope.countryChange = function(){
                    $scope.model = "Hello";
                }
                $scope.selectCountry = function(got){
                    $scope.countryid = got;
                    $scope.selectedcountryObject = _.find($scope.countries,function(obj,index){
                        if(obj.id == got){
                            return obj;
                        }
                    });
                    $scope.selectedCountryLabel = $scope.selectedcountryObject.nicename;
                }
                $scope.states = ['India','Italy'];
            }],
            //template: "<div>Place Selector</div>",
            templateUrl: URLService.getInfrastructurePartialsPath()+"countryselector.html",
            link : function(scope,element,attrs,icontroller){
                scope.selectedCountryLabel = "Select Country"
                CountryService.getCountries().then(function(data){
                    scope.countries = data;
                    if(scope.countryid){
                        scope.selectCountry(scope.countryid);
                    }
                });
            }
        };
    }]);
    componentModule.directive('wsPlaceSelector',["URLService","PlaceService", function(URLService,PlaceService){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'placeid': '=',
                'countryid':'='
            },
            controller: ["$scope", function ($scope) {
                $scope.selectPlace = function(got){
                    $scope.placeid = got;
                    $scope.selectedPlaceObject = _.find($scope.places,function(obj,index){
                        if(obj.id == got){
                            return obj;
                        }
                    });
                    $scope.selectedPlaceLabel = $scope.selectedPlaceObject.name;
                }
            }],
            //template: "<div>Place Selector</div>",
            templateUrl: URLService.getInfrastructurePartialsPath()+"placeselector.html",
            link : function(scope,element,attrs,icontroller){
                scope.selectedPlaceLabel = "Select Place";
                scope.$watch('placeid',function(newValue,oldValue){
                    if(newValue!=null){
                        PlaceService.getPlaces(scope.countryid).then(function(data){
                            scope.places = data;
                            if(scope.placeid){
                                scope.selectPlace(scope.placeid);
                            }
                        });
                    }
                });
                scope.$watch('countryid',function(newValue,oldValue){
                    if(newValue!=null){
                        PlaceService.getPlaces(scope.countryid).then(function(data){
                            scope.places = data;
                            if(scope.placeid){
                                scope.selectPlace(scope.placeid);
                            }
                        });
                    }
                });

                if(scope.model && scope.countryid){
                    PlaceService.getPlaces(scope.countryid).then(function(data){
                        scope.places = data;
                    });
                }else{
                    PlaceService.getPlaces('99').then(function(data){
                        scope.places = data;
                    });
                }

            }
        };
    }]);
    componentModule.directive('wsSearchItem',["URLService","SearchServices", function(URLService,SearchServices){
        var populateList = function(scope){
            //scope.states = SearchServices.getSearchSuggestions("mohit");
        }
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope","$location", function ($scope,$location) {

            }],
            templateUrl: URLService.getInfrastructurePartialsPath()+"searchItem.html",
            link : function(scope,element,attrs,icontroller){
                scope.model.urlService = URLService.getURLConstants();
                scope.model.imagePath = "static/assets/elements/";
            }
        };
    }]);

    componentModule.directive('wsPlace',["URLService","PlaceService","SearchServices","IsolatedScopeConnector", function(URLService,PlaceService,SearchServices,IsolatedScopeConnector){

        return {
            restrict : 'E',
            replace:true,
            require: 'ngModel',
            scope: {
                'place': '=ngModel'
            },
            controller: ["$scope","$location", function ($scope,$location) {

            }],
            template: '<a href="{{baseUrl}}place/{{place.slug}}">{{place.name}}</a>',
            link : function(scope,element,attrs,ngModel){
                scope.baseUrl = URLService.getBaseUrl();
            }
        };
    }]);
    componentModule.directive('wsCountry',["URLService","PlaceService","SearchServices","IsolatedScopeConnector", function(URLService,PlaceService,SearchServices,IsolatedScopeConnector){

        return {
            restrict : 'E',
            replace:true,
            //require: 'ngModel',
            scope: {
                'model': '='
            },
            controller: ["$scope","$location", function ($scope,$location) {

            }],
            template: '<a href="{{baseUrl}}country/{{model.nicename}}">{{model.nicename}}</a>',
            link : function(scope,element,attrs,ngModel){
                //scope.baseUrl = URLService.getBaseUrl();
                scope.baseUrl = URLService.getBaseUrl();
                /*console.log(attrs);
                 ngModel.$setViewValue(scope.citySelected);
                 scope.$watch('citySelected', function(newValue, oldValue){
                 ngModel.$setViewValue=scope.citySelected;
                 }, true);*/
            }
        };
    }]);
    componentModule.directive('wsCityInput',["URLService","PlaceService","SearchServices","IsolatedScopeConnector", function(URLService,PlaceService,SearchServices,IsolatedScopeConnector){
        var populateList = function(scope){
            SearchServices.getSearchSuggestions("mohit");
        }
        return {
            restrict : 'E',
            replace:true,
            require: 'ngModel',
            scope: {
                citySelected: '=ngModel'
            },
            controller: ["$scope","$location", function ($scope,$location) {
                $scope.states = $scope.states || {};
                /*PlaceService.getPlaces("mohit").then(function(data){
                    $scope.states = data;
                });*/
                $scope.states = [{"id":1,"name":"Varanasi","slug":"varanasi","cover_image":"varanasi.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Varanasi"},{"id":2,"name":"Lucknow","slug":"lucknow","cover_image":"lucknow.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Lucknow"},{"id":3,"name":"Udaipur","slug":"udaipur","cover_image":"udaipur.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Udaipur"},{"id":4,"name":"Kashmir","slug":"kashmir","cover_image":"kashmir.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Kashmir"},{"id":5,"name":"Nainital","slug":"nainital","cover_image":"nainital.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Nainital"},{"id":6,"name":"Jaipur","slug":"jaipur","cover_image":"jaipur.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Jaipur"},{"id":7,"name":"Delhi","slug":"delhi","cover_image":"delhi.png","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Delhi"},{"id":8,"name":"Mumbai","slug":"mumbai","cover_image":"mumbai.jpg","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Mumbai"},{"id":9,"name":"Kapur","slug":"kapur","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Kapur"},{"id":10,"name":"GorakhPur","slug":"gorakhpur","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"GorakhPur"},{"id":11,"name":"Bhraich","slug":"bhraich","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Bhraich"},{"id":12,"name":"Noida","slug":"noida","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Noida"},{"id":13,"name":"mohit","slug":"mohit","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"mohit"},{"id":14,"name":"Bhupendra","slug":"bhupendra","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Bhupendra"},{"id":15,"name":"Agra","slug":"agra","cover_image":"","countryId":99,"country":{"id":99,"iso":"IN","name":"INDIA","nicename":"India","iso3":"IND","numcode":356,"phonecode":91},"label":"Agra"}];
                /*PlaceService.getPlaces("sda").then(function(data){
                    console.log(data);
                });*/
                $scope.getStates = function(param){
                    PlaceService.getPlaces("mohit").then(function(data){
                        $scope.states = data;
                    });
                };
                $scope.typeaheadSelected = function ($item, $model, $label) {
                    $scope.$item = $item;
                    $scope.citySelected = $item;
                };
                $scope.getCities = function(param){
                    return PlaceService.getCitiesFilter(param).then(function(data){
                        return data;
                    });
                };
            }],
            template: '<div id="citytypeahead"><input style="width: 100%" ng-model="citySelected.name" typeahead-template-url="'+URLService.getInfrastructurePartialsPath()+'citytypeahead.html" typeahead-on-select="typeaheadSelected($item)" typeahead="state as state.label for state in getCities($viewValue) | filter:$viewValue | limitTo:2" class="span2 no-value-input" data-provide="typeahead" size="16" type="text" placeholder="City ..."></div>',
            link : function(scope,element,attrs,ngModel){
                IsolatedScopeConnector(scope,attrs,'ngModel',attrs['ngModel']);
                scope.baseUrl = baseUrl;
                ngModel.$setViewValue(scope.citySelected);
                scope.$watch('citySelected', function(newValue, oldValue){
                    ngModel.$setViewValue=scope.citySelected;
                }, true);
            }
        };
    }]);
    componentModule.directive('wsCuisine',["URLService","ElementEatServices", function(URLService,ElementEatServices){
        var populateList = function(scope){
            //scope.states = SearchServices.getSearchSuggestions("mohit");
        }
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '=',
                'selected': '='
            },
            controller: ["$scope","$location", function ($scope,$location) {
                $scope.states = $scope.states || {};
                ElementEatServices.getCuisine().then(function(data){
                    $scope.states = data;
                });
                /*PlaceService.getPlaces("sda").then(function(data){
                 console.log(data);
                 });*/
                $scope.getStates = function(param){
                    ElementEatServices.getCuisine().then(function(data){
                        $scope.states = data;
                    });
                };
                $scope.typeaheadSelected = function ($item, $model, $label) {
                    $scope.model = "hello";
                };
            }],
            template: '<div id="citytypeahead"><input ng-model="selected"  typeahead-editable="false" typeahead-on-select="typeaheadSelected($item, $model, $label)" typeahead="state.name for state in states | filter:$viewValue | limitTo:8" class="span2 no-value-input" data-provide="typeahead" size="16" type="text" placeholder="City ..."></div>',
            link : function(scope,element,attrs,icontroller){
                scope.baseUrl = baseUrl;
            }
        };
    }]);
    componentModule.directive('wsSearchBar',["URLService","SearchServices", function(URLService,SearchServices){
        var populateList = function(scope){
            //scope.states = SearchServices.getSearchSuggestions("mohit");
        }
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '=',
                'selected': '='
            },
            controller: ["$scope","$location", function ($scope,$location) {
                $scope.states = [{"id":1,"title":"Lunday Kababi","slug":"tunday-kababi","description":"","component_info":{"id":1,"name":"WhereShop","slug":"whereshop","fronttemplate":"common"},"label":"Lunday Kababi"},{"id":2,"title":"mohit","slug":"mohit","description":"","component_info":{"id":2,"name":"WhereGo","slug":"wherego","fronttemplate":"common"},"label":"mohit"},{"id":3,"title":"Mohit","slug":"mohit_1","description":"","component_info":{"id":2,"name":"WhereGo","slug":"wherego","fronttemplate":"common"},"label":"Mohit"},{"id":5,"title":"Tunday Kababi","slug":"tunday-kababi","description":"","component_info":{"id":1,"name":"WhereShop","slug":"whereshop","fronttemplate":"common"},"label":"Tunday Kababi"}];
                SearchServices.getSearchSuggestions("mohit").then(function(data){
                    $scope.states = data;
                });
                $scope.getStates = function(param){
                    SearchServices.getSearchSuggestions("mohit").then(function(data){
                        $scope.states = data;
                    });
                }
                $scope.typeaheadSelected = function(typeaheadItem){
                    $location.path('/search/'+$scope.selected);
                }
            }],
            template: '<input ng-model="selected" typeahead-template-url="'+URLService.getInfrastructurePartialsPath()+'searchresult.html" typeahead-on-select="typeaheadSelected($item)" typeahead="state.label for state in states | filter:$viewValue | limitTo:2" class="span2 no-value-input" data-provide="typeahead" size="16" type="text" placeholder="Where...">',
            link : function(scope,element,attrs,icontroller){
                scope.baseUrl = baseUrl;
            }
        };
    }]);
    componentModule.directive('wsComponentSelector',["URLService","SearchServices", function(URLService,SearchServices){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model': '='
            },
            controller: ["$scope","$location", function ($scope,$location) {

            }],
            template: '<div>Hello COmponent</div>',
            link : function(scope,element,attrs,icontroller){
                scope.baseUrl = baseUrl;
            }
        };
    }]);
    componentModule.directive('wsSrollTo',["URLService","SearchServices","$location","$anchorScroll", function(URLService,SearchServices,$location,$anchorScroll){
        return {
            restrict : 'A',
            replace:true,
            scope: {

            },
            controller: ["$scope","$location", function ($scope,$location) {
                $scope.scrollToHashLocation = function(){
                    console.log("Hello");
                }
            }],
            link : function(scope,element,attrs,icontroller){
                scope.baseUrl = baseUrl;
                console.log(attrs);
                //scope.scrollToHashLocation();
                console.log("In component scroll to\ ...");
            }
        };
    }]);
    componentModule.directive('wsPlaceTypeahead',["URLService","SearchServices","$location","$anchorScroll", function(URLService,SearchServices,$location,$anchorScroll){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'selected' : '=ngModel'
            },
            template : '<input type="text" typeahead="state for state in states | filter:$viewValue | limitTo:8" class="form-control">',
            controller: ["$scope","$location", function ($scope,$location) {
                $scope.states = ['a','b','c'];
            }],
            link : function(scope,element,attrs,ngModel){
                scope.selected = scope.selected || "Not selected";
            }
        };
    }]);
    componentModule.directive('wsCountryFlag',["URLService","SearchServices","$location","$anchorScroll", function(URLService,SearchServices,$location,$anchorScroll){
        return {
            restrict : 'E',
            replace:true,
            scope: {
                'model' : '=',
                'size' : '='
            },
            template : '<img ng-src="http://localhost/wherestop/static/images/flags/{{size}}/{{model.iso}}.png" >',
            controller: ["$scope","$location", function ($scope,$location) {
                
            }],
            link : function(scope,element,attrs,ngModel){
                scope.model={
                		"iso":"IN"
                }
            }
        };
    }]);

    componentModule.directive('wsElementButton',["URLService","SearchServices","$location","$anchorScroll", function(URLService,SearchServices,$location,$anchorScroll){
    	return {
            restrict : 'E',
            replace:true,
            scope: {
                
            },
            templateUrl: URLService.getInfrastructurePartialsPath()+"addelementmodal.html",
            controller: ["$scope","$location","ElementEditService", function ($scope,$location,ElementEditService) {
                $scope.modalopen = false;
                $scope.test = "ABC";
                $scope.model = {};
                $scope.addElement = function(){
                	ElementEditService.addElementPartial($scope.model).then(function(data){
                        if(data && data.status && true==data.status){
                        	$('#addelementmodal').modal('hide');
                        	var pageUrl = window.location.href;
                        	window.location.href= (window.location.origin+window.location.pathname+"/"+data.element.slug+"#/edit");
                        }
                    });
                };
                $scope.openAddElementModal = function(){
                	$('#addelementmodal').modal();
                };
                
            }],
            link : function(scope,element,attrs,ngModel){
                scope.selected = scope.selected || "Not selected";
            }
        };
    }]);
    return componentModule;
});
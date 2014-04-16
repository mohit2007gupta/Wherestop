require.config({
    baseUrl : window.globalpath,
    paths : {
        // Major libraries
        'jquery' : 'lib/jquery/jquery-1.7.2',
        'jqueryUI' : 'lib/jqueryUI/jquery-ui-latest',
        'bootstrap' : 'lib/bootstrap/js/bootstrap.min',
        'angular': 'lib/angular/angular',
        'underscore': 'lib/underscore/underscore',
        // Require.js plugins
        text : 'thirdparty/js/require/text',
        order : 'thirdparty/js/require-1.0.8/order'
    },
    shim: {
        'angular' : {'exports' : 'angular'},
        'bootstrap': {deps:['jquery']},
        'jquery' : {exports : "jquery"},
        'jqueryUI' : {deps : [ "jquery" ]},
        'bootstrapModal' : {deps : [ "jquery" ],exports : "bootstrapModal"}
    },
    priority: [
        "angular"
    ]
});

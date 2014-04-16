function getVersion() {
    var queryString = window.location.search.substring(1);
    var queryArray = queryString.split("&");
    var keyValue = new Array();
    for (var i = 0; i < queryArray.length; i++) {
        keyValue = queryArray[i].split("=");
        if (keyValue[0] == "version") {
            if (window.parent) {
                window.parent.navigatorVersion = window.parent.navigatorVersion
                    || {
                    "version": keyValue[1]
                };
            } else {
                window.navigatorVersion = window.navigatorVersion || {
                    "version": keyValue[1]
                };
            }
            return keyValue[1];
        }
    }
    return undefined;
}
function insertScript(src) {
    var version = getVersion();
    var head = document.getElementsByTagName("head")[0];
    if (!head) {
        return;
    }
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = src + "?version=" + version;
    head.appendChild(script);
}

function insertCss(src) {
    var head = document.getElementsByTagName('head')[0];
    if (!head) {
        return;
    }
    var version = getVersion();
    var linktg = document.createElement('link');
    linktg.type = 'text/css';
    linktg.rel = 'stylesheet';
    linktg.href = src + "?version=" + version;
    head.appendChild(linktg);
}

function isFunction(functionToCheck) {
    var getType = {};
    return !!(functionToCheck && getType.toString.call(functionToCheck) === '[object Function]');
}

function loadScript(url, callback) {
    var version = getVersion();
    url = url + "?version=" + version;
    var script = document.createElement("script");
    script.type = "text/javascript";
    if (script.readyState) {
        script.onreadystatechange = function () {
            if (script.readyState == "loaded" || script.readyState == "complete") {
                script.onreadystatechange = null;
                if (callback && isFunction(callback)) {
                    callback();
                }
            }
        };
    } else {
        script.onload = function () {
            if (callback && isFunction(callback)) {
                callback();
            }
        };
    }
    script.src = url;
    document.getElementsByTagName("head")[0].appendChild(script);
};

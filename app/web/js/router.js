var Router = {

    'routeList': [],

    'add': function(route, callback) {

        var routeItem = {
            route: route,
            callback: callback
        }

        this.routeList.push(routeItem);

    },
    
    'go': function(path) {
        
        window.location.hash = path;
        this.run(path);
        
    },
    
    'run': function(path) {
        
        for(key in this.routeList) {
            var route = this.routeList[key].route;
            if(route == path)
                this.routeList[key].callback();
        }
        
    },
    
    'set': function() {
        
        var self = this;
      
        var routeElements = document.getElementsByClassName('route');
        for(var i = 0; i < routeElements.length; i++) {
            routeElements[i].onclick = function() {
                var gopath = this.getAttribute('href');
                    self.go(gopath);
                return false;
            }
        }
        
    },

    'listen': function() {
        
        var self = this;
        this.set();

        var path = this.parseHashString();
        if(path == '') path = '/';
        this.run(path);

    },
    
    'parseHashString': function() {
      
        var hash = window.location.hash;
        return (hash.substr(1));//.split("/");
        
    },
    
    'parseQueryString': function() {
        
        var str = window.location.search;
        var obj = {}; 

        str.replace(/([^?=&]+)=([^&]*)/g, function(m, key, value) {

            mkey = decodeURIComponent(key);
            mvalue = decodeURIComponent(value)

            var found = mkey.match( /(\w+)\[(\w+)\]/);

            if(found !== null) {

                var key = found[1];
                var subkey = found[2];

                if(typeof(obj[key]) == 'undefined') {
                    obj[key] = [];
                }

                obj[key][subkey] = mvalue;

            } else {        
                obj[mkey] = mvalue;
            }

        }); 

        return obj;
        
    }

}

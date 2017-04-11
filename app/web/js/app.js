window.onload = function() {
    
    Router.add('/', function(){
        
        var xhr = new XMLHttpRequest();
        var self = this;

        xhr.open("GET", '/', true);
        xhr.setRequestHeader('X-REQUESTED-WITH', 'XMLHttpRequest'); 
        
        xhr.onreadystatechange = function(){
            
            var html = this.responseText;
            
            var doc = document.implementation.createHTMLDocument("");
            doc.documentElement.innerHTML = html;
            
            if(doc.getElementById('content')) {
                content = doc.getElementById('content').innerHTML;
                document.getElementById("content").innerHTML=content;    
            }
            
        };
        xhr.send();
        
        console.log('you are in admin');
        
    });
    
    Router.add('/admin/', function(){
        
        var xhr = new XMLHttpRequest();
        var self = this;

        xhr.open("GET", '/admin/', true);
        xhr.setRequestHeader('X-REQUESTED-WITH', 'XMLHttpRequest'); 
        
        xhr.onreadystatechange = function(){
            
            var html = this.responseText;
            
            var doc = document.implementation.createHTMLDocument("");
            doc.documentElement.innerHTML = html;
            
            if(doc.getElementById('content')) {
                content = doc.getElementById('content').innerHTML;
                document.getElementById("content").innerHTML=content;    
            }
            
            /*
            parser = new DOMParser();
            htmlDoc = parser.parseFromString(html, "text/html");
            
            content = htmlDoc.getElementsByTagName('body')[0].innerHTML;
            
            if(content) {                
                document.getElementsByTagName("body")[0].innerHTML=content;    
                Router.set();
            }
            */
            
        };
        xhr.send();
        
        console.log('you are in admin');
        
    });
    
    Router.listen();
    
};
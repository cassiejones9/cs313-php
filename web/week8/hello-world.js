var http = require('http');

function sayHello() {
    console.log("Hello World!");
}

var server = http.createServer(sayHello);
server.listen(8000);
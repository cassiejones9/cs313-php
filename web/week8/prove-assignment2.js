const http = require('http');
const port = 8000;
const fs = require('fs');
const host = 'localhost';

const requestListener = (req, res) => {
    console.log(`Request received for ${req.url}`);

    if (req.url == "/home") {
        res.writeHead(200, {'Content-Type': 'text/html'});
        res.write("<h1>Welcome to the Home Page!</h1>");
        res.end();
        return;
    }
    else if (req.url == "/getData") {
        res.writeHead(200, {'Content-Type': 'application/json'});
        const info = {name: "Cassie", class: "CS341 - Web Backend Development II"}
        res.write(JSON.stringify(info));
        res.end();
        return;
    }
    else if (req.url == "/nailedit.html") {
        fs.readFile('./exceedassignment.html', 'utf-8', function (error, data) {
            if (error) {
                res.writeHead(500, {'Content-Type': 'text/html'});
                res.write("<h1>Error page not found</h1>");
                console.error('Error reading that file', error);
                res.end();
            }
            else {
                res.setHeader('Content-Type', 'text/html');
                console.log("Served exceedassignment.html");
                res.end(data);
            }
        });
        return;
    }
   
    res.writeHead(404, {'Content-Type': 'text/html'});
    res.write("<h1>Error 404 page not found</h1>")
    res.end();
    




    
}
   
// function onRequest() {
//     console.log("Hello World!");
// }

var server = http.createServer(requestListener);
server.listen(port, () => {
    console.log(`Server listening on port ${port}`)
});
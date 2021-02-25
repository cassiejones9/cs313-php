const fs = require('fs');
const args = process.argv[2];

fs.readFile(args, function (error, data) {
    if (error) {
        return console.log(error);
    }
    const lines = data.toString().split('\n').length - 1;
    console.log(lines);
})
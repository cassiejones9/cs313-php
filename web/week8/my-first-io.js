const fs = require('fs');

const stuff = fs.readFileSync(process.argv[2]);
const morestuff = stuff.toString().split('\n').length - 1;
console.log(morestuff);
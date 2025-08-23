// This script is responsible for building the zip file for the theme.
const fs = require("fs");
const path = require("path");
const zl = require("zip-lib");
const { themeName } = require("./common");

console.log(`\x1b[34mCreating zip file for the theme...\x1b[0m`);

// set source directory to ./dist
const sourceDir = "../../dist";
const sourcePath = path.join(__dirname, sourceDir);

// Check if the source directory exists
if (!fs.existsSync(sourcePath)) {
  console.error(`\x1b[31mSource directory does not exist: ${sourceDir}\x1b[0m`);
  process.exit(1);
}

console.log(`\x1b[34mTheme name: ${themeName}\x1b[0m`);
// Set output zip file name
const zipFileName = `${themeName}.zip`;
const zipFileSource = `../../artifacts/${zipFileName}`;
const zipFilePath = path.join(__dirname, zipFileSource);

console.log(`\x1b[34mFrom: ${sourceDir}...\x1b[0m`);
console.log(`\x1b[34mTo: ${zipFilePath}...\x1b[0m`);


zl.archiveFolder(sourcePath, zipFilePath).then(function () {
  console.log(`\x1b[32mZip file created successfully: ${zipFilePath}\x1b[0m`);
}, function (err) {
    console.error(`\x1b[31mError creating zip file: ${err.message}\x1b[0m`);
    process.exit( 1 );
});

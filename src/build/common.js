'use strict'

const fs = require('fs');
const path = require("path");

function getPackageValue(key) {
  // Get value from package.json
  const packageJsonPath = path.join(__dirname, "../../package.json");
  if (!fs.existsSync(packageJsonPath)) {
    console.error(`\x1b[31mpackage.json not found at: ${packageJsonPath}\x1b[0m`);
    process.exit(1);
  }
  const packageJson = JSON.parse(fs.readFileSync(packageJsonPath, "utf8"));
  return packageJson[key] || null;
}
const themeName = getPackageValue("name") || "understrap-child";

module.exports = {
  themeName,
  getPackageValue
};
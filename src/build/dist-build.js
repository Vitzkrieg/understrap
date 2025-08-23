const fs = require('fs');
const path = require("path");
const { themeName } = require("./common");

console.log(`\x1b[34mBuilding distribution directory...\x1b[0m`);

function copyDirSync(src, dest) {
    fs.mkdirSync(dest, { recursive: true });
    let entries = fs.readdirSync(src, { withFileTypes: true });
	let ignore = [
		'node_modules',
		'framework/fonts/',
		'dist',
		'src',
		'artifacts',
		'.git',
		'.github',
		'.browserslistrc',
		'.editorconfig',
		'.gitattributes',
		'.gitignore',
		'.jscsrc',
		'.jshintignore',
		'.travis.yml',
		'.vscode',
		'composer.json',
		'composer.lock',
		'package.json',
		'package-lock.json',
		'phpcs.xml.dist',
		'phpmd.baseline.xml',
		'phpmd.xml',
		'phpstan-baseline.neon',
		'phpstan.neon.dist',
		'phpmd.xml',
		'phpstan-baseline.neon',
		'phpstan.neon.dist',
	];

    for (let entry of entries) {
		if ( ignore.indexOf( entry.name ) != -1 ) {
			continue;
		}
        let srcPath = path.join(src, entry.name);
        let destPath = path.join(dest, entry.name);

        entry.isDirectory() ?
            copyDirSync(srcPath, destPath) :
            fs.copyFileSync(srcPath, destPath);
    }
}

copyDirSync('./', `./dist/${themeName}`);


console.log(`\x1b[32mBuild completed successfully\x1b[0m`);

// Exit process with success code.
process.exit( 0 );

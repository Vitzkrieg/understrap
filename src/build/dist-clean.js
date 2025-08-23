/* eslint-disable no-console, eslint-comments/disable-enable-pair */

'use strict';

/**
 * External dependencies
 */
const fs = require( 'fs' );

// Directory path.
const dir = './dist';

console.log( '\x1b[34mCleaning up the dist directory...\x1b[0m' );


// Check if the source directory exists
const path = require("path");
const sourceDir = "../../dist";
const sourdPath = path.join(__dirname, sourceDir);

if ( fs.existsSync(sourdPath) ) {
	// Delete directory recursively.
	fs.rmSync( dir, { recursive: true }, ( error ) => {
		if ( error ) {
			console.error('\x1b[31m' + error.name + ': ' + error.message + '\x1b[0m\n' );
		} else {
			console.log( dir + ' is deleted!\n' );
		}
	} );
}


console.log( '\x1b[32mCompleted cleaning up the dist directory.\x1b[0m' );

// Exit process with success code.
process.exit( 0 );
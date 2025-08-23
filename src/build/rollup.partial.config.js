'use strict';

/**
 * External dependencies
 */
const path = require( 'path' );
const { babel } = require( '@rollup/plugin-babel' );
const { nodeResolve } = require( '@rollup/plugin-node-resolve' );
const commonjs = require( '@rollup/plugin-commonjs' );
const multi = require( '@rollup/plugin-multi-entry' );
const replace = require( '@rollup/plugin-replace' );
const terser = require( '@rollup/plugin-terser' );

/**
 * Internal dependencies
 */
const banner = require( './banner.js' );

// Populate Bootstrap version specific variables.
let bsVersion = 5;
let globals = {
	jquery: 'jQuery', // Ensure we use jQuery which is always available even in noConflict mode
	'@popperjs/core': 'Popper',
};

const external = [ 'jquery' ];

const plugins = [
	babel( {
		browserslistEnv: `bs${ bsVersion }`,
		// Include the helpers in the bundle, at most one copy of each.
		babelHelpers: 'bundled',
	} ),
	replace( {
		'process.env.NODE_ENV': '"production"',
		preventAssignment: true,
	} ),
	nodeResolve(),
	commonjs(),
];

const pluginTerser = terser( {
	output: {
		comments: false,
	},
	compress: {
		drop_console: true,
		drop_debugger: true,
	},
} );

const pluginsMin = plugins.concat( [ pluginTerser ] );

module.exports = [
	{
		input: {
			'calendar': path.resolve( __dirname, `../partial/calendar.js` ),
		},
		output: [
			{
				banner: banner(''),
				dir: path.resolve( __dirname, `../../js/partial/` ),
				entryFileNames: `[name].js`,
				format: 'umd',
				globals,
				name: 'understrapChild',
			},
		],
		external,
		plugins,
	},
	{
		input: {
			'calendar': path.resolve( __dirname, `../partial/calendar.js` ),
		},
		output: [
			{	
				banner: banner(''),
				dir: path.resolve( __dirname, `../../js/partial/` ),
				entryFileNames: `[name].min.js`,
				format: 'umd',
				globals,
				name: 'understrapChild',
			},
		],
		external,
		plugins: pluginsMin,
	},
];
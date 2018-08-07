const path = require('path');
const merge = require('webpack-merge');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')
const OptimizeCSSPlugin = require('optimize-css-assets-webpack-plugin');
const common = require('./webpack.common.js');

module.exports = merge(common, {
	mode: 'production',
  optimization: {
    minimizer: [
	    // js mini
// 	    new UglifyJSPlugin({
// 	      cache: true,
// 	      parallel: true,
// 	      sourceMap: false // set to true if you want JS source maps
// 	    }),
	    // css mini
	    new OptimizeCSSPlugin({})
    ]
    }
});
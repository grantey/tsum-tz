var path = require("path");
var ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
	entry: "./front/app.js",
	output: {
		filename: "bundle.js",
		path: path.resolve(__dirname, "assets"),
		publicPath: "/assets/",
	},
	module: {
      rules: [
      	{
            test: /\.vue$/,
            use: [                
                "vue-loader"
            ]
        },
        {
       		test: /\.js$/,
       		exclude: /node_modules/,
       		use: [
            	"babel-loader",            
			]
        },
        {
            test: /\.scss$/,
            use: [                
                "style-loader!css-loader!sass-loader"
            ]
        },
        {
        	test: /\.css$/,
        	use: ExtractTextPlugin.extract({
				fallback: "style-loader",
				use: "css-loader"
			})
      	}
      ]
    },
    plugins: [
 	   new ExtractTextPlugin('style.css'),
	]
};
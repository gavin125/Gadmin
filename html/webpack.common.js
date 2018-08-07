const path = require('path');
const glob = require('glob');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

// 读取文件夹生成入口文件组
const pages=(function getEntry(globPath) {
  var entries = {},basename, tmp, pathname;
  glob.sync(globPath).forEach(function (entry) {
    basename = path.basename(entry, path.extname(entry));
    tmp = entry.split('/').splice(-3);
    pathname = tmp.splice(-2, 1); // 正确输出js和html的路径
    entries[pathname] = entry;
  });
  console.log(entries);
  return entries;
})('./src/pages/**/*.js');


module.exports = {
  entry: pages,
  output: {
    path: path.join(__dirname, './dist'),
    filename: 'js/[name].js',
  },

  module: {
    rules: [
      {
        test: /\.vue$/,
        loader: 'vue-loader',
        options: {
          loaders: {
            sourceMap: true,
            extract: true
          },
          cssSourceMap: true,
          cacheBusting: true,
          transformToRequire: {
            video: ['src', 'poster'],
            source: 'src',
            img: 'src',
            image: 'xlink:href'
          }
        },
        exclude: /node_modules/
      },
      {
        test: /\.js$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
      },

      {
        test: /\.css$/,
        use: ExtractTextPlugin.extract({
          fallback: "style-loader",
          use: "css-loader"
        })
        // use:["style-loader","css-loader"]
      },
        

      {
        test: /\.(png|jpe?g|gif|svg)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: 'images/[name].[ext]?[hash:7]'
        }
      },
      {
        test: /\.(mp4|webm|ogg|mp3|wav|flac|aac)(\?.*)?$/,
        loader: 'url-loader',
        options: {
          limit: 10000,
          name: 'madia/[name].[ext]?[hash:7]'
        }
      },
      {
        test: /\.(woff2?|eot|ttf|otf)(\?.*)?$/,
        loader: 'file-loader',
        options: {
          limit: 10000,
          name: 'fonts/[name].[ext]?[hash:7]',
          publicPath:'../'
        }
      }
    ]
  },

  plugins: [
    new CleanWebpackPlugin(['dist']),
    new VueLoaderPlugin(),
    new ExtractTextPlugin("css/[name].css"),
  ],
};

// 根据pages使用plugin生成对应的html
for (var pathname in pages) {
  var conf = {
    template: './template.html',
    filename: pathname+'.html',
    title:pathname,
    chunks: [pathname],
    hash: true,
    minify: {removeAttributeQuotes: true}
  };
  module.exports.plugins.push(new HtmlWebpackPlugin(conf));
}
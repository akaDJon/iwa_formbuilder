"use strict";
const path = require("path");
const TerserWebpackPlugin = require("terser-webpack-plugin");
const HTMLWebpackPlugin = require("html-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const CssMinimizerWebpackPlugin = require("css-minimizer-webpack-plugin");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CopyWebpackPlugin = require("copy-webpack-plugin");
const ESLintWebpackPlugin = require('eslint-webpack-plugin');

// let css_extract_loader = "style-loader";
let css_extract_loader = MiniCssExtractPlugin.loader;
let css_loader = "css-loader";
let sass_loader = {
  loader: "sass-loader",
  options: {
    sourceMap: true,
    sassOptions: {
      outputStyle: "expanded"
    }
  }
};
let less_loader = "less-loader";

let babel_loader = {
  loader: "babel-loader",
  options: {
    presets: ['@babel/preset-env']
  }
}

module.exports = {
  mode: "production",
  devtool: "source-map",
  devServer: {
    port: 4444
  },
  context: path.resolve(__dirname, "./src/"),
  entry: {
    "app": "./js/app/index.js",
  },
  output: {
    path: path.resolve(__dirname, "./dist/"),
    filename: "js/[name].js"
  },
  plugins: [
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: ["**/*", "!.gitkeep", "!myfolder/**/*"],
    }),
    new HTMLWebpackPlugin({
      hash: true,
      template: "./html/index.html",
      minify: false,
      filename: path.resolve(__dirname, "./demo/dist/index.html"),
    }),
    new CopyWebpackPlugin({
      patterns: [
        { from: path.resolve(__dirname, "./src/favicon/favicon.ico"), to: path.resolve(__dirname, "./demo/dist") }
      ]
    }),
    new MiniCssExtractPlugin({
      filename: "css/[name].css"
    }),
    new ESLintWebpackPlugin({

    })
  ],
  module: {
    rules: [
      { test: /\.m?js$/, use: babel_loader, exclude: /node_modules/},
      { test: /\.css$/, use: [css_extract_loader, css_loader] },
      { test: /\.less$/, use: [css_extract_loader, css_loader, less_loader] },
      { test: /\.scss$/, use: [css_extract_loader, css_loader, sass_loader] }
    ]
  },
  optimization: {
    minimize: true,
    minimizer: [
      new TerserWebpackPlugin({
        include: /\.min\.js$/,
        parallel: true
      }),
      new CssMinimizerWebpackPlugin({
        include: /\.min\.css$/,
        parallel: true
      })
    ]
  }
};

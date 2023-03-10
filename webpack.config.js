/* eslint-disable no-undef */
const Encore = require("@symfony/webpack-encore");
const CompressionPlugin = require("compression-webpack-plugin");
var webpack = require('webpack')
const TerserPlugin = require("terser-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const HtmlMinimizerPlugin = require("html-minimizer-webpack-plugin");
const ImageMinimizerPlugin = require("image-minimizer-webpack-plugin");


if (!Encore.isRuntimeEnvironmentConfigured()) {
  Encore.configureRuntimeEnvironment(process.env.NODE_ENV || "dev");
}

Encore
  .setOutputPath("public/build/")
  .setPublicPath("/build")

  .addEntry("app", "./assets/app.js")


  // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
  .enableStimulusBridge("./assets/controllers.json")

  // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
  .splitEntryChunks()

  // will require an extra script tag for runtime.js
  // but, you probably want this, unless you're building a single-page app
  .enableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableBuildNotifications()
  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())


  // enables and configure @babel/preset-env polyfills
  .configureBabelPresetEnv((config) => {
    config.useBuiltIns = "usage";
    config.corejs = "3.23";
  })

  .enableSassLoader()

  .configureDevServerOptions((options) => {
    options.liveReload = true;
    options.hot = true;
    options.watchFiles = ["./templates/**/*", "./src/**/*"];
  })

  .enableVueLoader(() => {}, { runtimeCompilerBuild: false })

  .addPlugin(new CompressionPlugin({
        algorithm:"gzip",
        deleteOriginalAssets: false,
  }))

  .addPlugin(
    new webpack.DefinePlugin({
       __VUE_OPTIONS_API__: true,
       __VUE_PROD_DEVTOOLS__: false
     })
   )






const fullConfig = Encore.getWebpackConfig();



fullConfig.optimization = {
  minimize: true,
  minimizer: [
    new TerserPlugin(), new CssMinimizerPlugin(), new HtmlMinimizerPlugin(), new ImageMinimizerPlugin({
      minimizer: {
        implementation: ImageMinimizerPlugin.sharpMinify,
        options: {
          encodeOptions: {
            mozjpeg: {
              quality: 80,
            },
            webp: {
              lossless: true,
            },
            avif: {
              lossless: true,
            },
            jpeg: {
              // https://sharp.pixelplumbing.com/api-output#jpeg
              quality: 80,
            },
          }
        }
      }
    })
  ],
},

module.exports = fullConfig

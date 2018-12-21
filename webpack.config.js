let Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')

    /* Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.scss) if you JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('user', './assets/js/user.js')
    .addEntry('quizz', './assets/js/quizz.js')
    .addEntry('index', './assets/js/index.js')
    .addEntry('know', './assets/js/know.js')
    .addEntry('register', './assets/js/register.js')
    .addEntry('login', './assets/js/login.js')

    .enableSingleRuntimeChunk()
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning()
    .enableSassLoader()
    .autoProvidejQuery()
    .splitEntryChunks()

    /*
     * Copy all files from asset/ with path
     */
    .configureFilenames({
        images: '[path][name].[hash:8].[ext]',
    })
;

module.exports = Encore.getWebpackConfig();

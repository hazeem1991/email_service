const path = require("path");

module.exports = {
    publicPath: './',
    outputDir: path.resolve(__dirname, "../../public/front/dist"),
    chainWebpack: config => {
        config.module.rules.delete('eslint');
    }
};
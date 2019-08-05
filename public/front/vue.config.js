module.exports = {
    publicPath: './',
    chainWebpack: config => {
        config.module.rules.delete('eslint');
    }
};
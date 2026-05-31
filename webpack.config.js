const defaultConfig = require('10up-toolkit/config/webpack.config');

const removeWebpackBar = (config) => ({
	...config,
	plugins: config.plugins.filter(
		(plugin) =>
			!plugin || !plugin.constructor || plugin.constructor.name !== 'WebpackBarPlugin',
	),
});

module.exports = Array.isArray(defaultConfig)
	? defaultConfig.map(removeWebpackBar)
	: removeWebpackBar(defaultConfig);

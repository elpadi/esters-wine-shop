const App = require('./app');

class Tome extends App {

	static addTooltipSvgArrow(instance=null) {
		let arrow, tt = instance ? instance.elementTooltip() : document.querySelector('.tooltipster-base');
		if (tt && (arrow = tt.querySelector('.tooltipster-arrow'))) {
			arrow.insertAdjacentHTML('beforeend',
				`<svg width="50" height="50" viewBox="0 0 50 50">
					<path d="M 5,40 L 25,15 L 45,40 z" fill="#1b1c1d" stroke="#1b1c1d"/>
					<path d="M 1,40 L 5,40 L 25,15 L 45,40 L 49,40" fill="none" stroke="white"/>
				</svg>`
			);
		}
	}

	static createLoadingSpinner() {
		let spinner = document.getElementById('tome-loading-spinner').cloneNode(true);
		spinner.id = '';
		return spinner;
	}

	/**
	 * Gets content from specified or all posts in the current module.
	 *
	 * @param contentEl jQuery element in which to dump the content.
	 * @param section string
	 * @param posts string|int optional Leave empty to use all posts in the module.
	 */
	static fetchModuleContent(contentEl, section, posts=0) {
		let contents = new PostContents();
		return contents.hydrate(section, posts).then(none => {
			console.log('WP.fetchModuleContent', 'hydrated');
			contentEl.append(contents.content.container);
			contentEl.trigger('modulecontent.hydrated', [posts, section]);

			contents.initContent().then(contentObj => {
				console.log('WP.fetchModuleContent', 'loaded', contentObj, contentEl);
				contentEl.trigger('modulecontent.init', [contentObj]);
			});
		});
	}

	addTooltipSvgArrow(instance=null) {
		return Tome.addTooltipSvgArrow(instance);
	}

	createLoadingSpinner() {
		return Tome.createLoadingSpinner();
	}

	fetchModuleContent(contentEl, section, posts=0) {
		return Tome.fetchModuleContent(contentEl, section, posts);
	}

	onDocReady() {
		super.onDocReady();
		this.initModuleContent();
	}

}

module.exports = Tome;

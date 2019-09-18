class TomeLogin {

	constructor() {
		this.container = document.getElementById('login');
		this.replaceLogo();
	}

	replaceLogo() {
		let a = this.container.querySelector('h1 a');
		fetch(TOME.URLS.ASSETS.THEME + '/icons/logo.svg')
		.then(resp => resp.text())
		.then(svg => {
			a.insertAdjacentHTML('afterbegin', svg);
			setTimeout(function() {
				a.classList.add('visible');
			}, 200);
		});
	}

}

window.addEventListener('load', function() {

	new TomeLogin();

});

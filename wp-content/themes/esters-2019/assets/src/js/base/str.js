class Str {

	static slugify(s, glue='_') {
		return s.trim().toLowerCase().replace(/[^0-9a-z]+/g, glue).replace(new RegExp(`(${glue})+`, 'g'), glue);
	}

	static queryStringToObject(s) {
		let d = {}, params = new URLSearchParams(s);
		for (let n of params.entries()) d[n[0]] = n[1];
		return d;
	}

	static removeFileExtension(path) {
		return path.replace(/\.[a-zA-Z0-9]+$/, '');
	}

}

module.exports = Str;

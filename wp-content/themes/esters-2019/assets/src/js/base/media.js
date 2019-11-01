class Media {

	static getDims(obj) {
		let dims,
			nat = () => dims = { w: obj.naturalWidth, h: obj.naturalHeight },
			r = () => dims.r = dims.w / dims.h;
		if (obj.naturalWidth) nat();
		else {
			let matches = obj.src ? obj.src.match(/([0-9]+)x([0-9]+)/) : null;
			if (matches) {
				dims = { w: Number(matches[1]), h: Number(matches[2]) };
			}
		}
		return new Promise((resolve, reject) => {
			if (dims) {
				r();
				resolve(dims);
			}
			else {
				obj.addEventListener('load', e => {
					nat();
					r();
					resolve(dims);
				});
			}
		});
	}

}

module.exports = Media;

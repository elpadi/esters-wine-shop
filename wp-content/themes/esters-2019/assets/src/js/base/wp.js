const $ = require('jquery');

class WP {

	static apiRequest(endpoint, data) {
		if (!('api' in wp) || !('apiRequest' in wp)) return Promise.reject('WP API library is not loaded.');
		return wp.apiRequest({
			namespace: wp.api.versionString,
			endpoint: endpoint,
			data: data
		});
	}

	static fetchPosts(type='pages', params={}) {
		return WP.apiRequest(type, params);
	}

	static ajax(data, method='GET') {
		if (!data || !('action' in data) || typeof(data.action) != 'string') {
			throw 'Invalid argument for ajax data. Invalid or missing action name.';
		}
		// prepend theme name to ajax action
		let prefix = app.ENV.THEME.NAME + '_';
		if (data.action.indexOf(prefix) != 0) data.action = prefix + data.action;

		console.log('AdminApp.ajax', data, method);
		return $[method.toLowerCase()](app.ENV.URLS.AJAX, data, resp => {
			if (typeof(resp) == 'object') {
				if (('success' in resp) && ('data' in resp)) {
					if (typeof(resp.data) == 'object') {
						console.log('App.ajax', resp, data, method);
					}
				}
			}
		});
	}

    static replaceImageHost(newHost) {
        for (let img of document.getElementsByTagName('img')) {
            if (img.naturalWidth || img.complete === false || img.src.indexOf(newHost) !== -1) {
                continue;
            }
            img.src = img.src.replace(location.hostname, newHost);
        }
    }

}

module.exports = WP;

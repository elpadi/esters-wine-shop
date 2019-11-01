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

	static fetchPosts(type='pages', ids='', context='edit') {
		return WP.apiRequest(type, {
			context: context,
			include: ids
		});
	}

	static ajax(data, method='GET') {
		if (!data || !('action' in data)) {
			throw 'Invalid argument for ajax data. Missing the action property.';
		}
		console.log('AdminApp.ajax', data, method);
		return $[method.toLowerCase()](TOME.URLS.ADMIN + 'admin-ajax.php', data, resp => {
			if (typeof(resp) == 'object') {
				if (('success' in resp) && ('data' in resp)) {
					if (typeof(resp.data) == 'object') {
						console.log('App.ajax', resp, data, method);
					}
				}
			}
		});
	}

}

module.exports = WP;

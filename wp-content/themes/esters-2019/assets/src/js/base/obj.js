class Obj {

	static objSet(name, val, obj) {
		if (obj == undefined) obj = {};
		obj[name] = val;
		return obj;
	}

}

module.exports = Obj;

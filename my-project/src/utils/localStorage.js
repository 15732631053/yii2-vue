var myStorage = {

	setData : function(data, obj) {
		window.localStorage.setItem(obj, JSON.stringify(data));
	},
	cleanData : function(obj) {
		window.localStorage.removeItem(obj);
	},
	getData : function(obj) {
		return window.localStorage.getItem(obj);
	}
}
export default myStorage
class Model {
	constructor(data) {

		for(let field in data) {
			this[field] = data[field];
		}

	}

	static all(apicall, factory, success, failure) {
		API.get(apicall, (data) => {
			let all = [];
			for(let object in data) {
				let newObject = factory(data[object]);
				all.push(newObject);
			}
			success(all);
		}, failure);
	}

	static find(apicall, factory, success, failure) {
		API.get(apicall + '/edit', function(data){
			let newObject = factory(data);
			success(newObject);
			Event.fire('ModelLoaded');
		}, failure);
	}

	data() {
 		let data = Object.assign({}, this);



 		return data;
	}

}

export default Model;
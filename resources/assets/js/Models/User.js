import Model from './Model';

class User extends Model{

	
	save() {
		API.post('users/save', this.data(), this.success, function() {
			// notify the user if something went wrong. 
		});
	}

	update() {
		API.post('users/update/' + this.id, this.data(), this.success, function() {
			// notify the user if something went wrong. 
		});
	}

	delete(confirm = false, success) {
		if(confirm == true) {
			Notifier.askConfirmation(() => {
				API.delete('users/remove', this.id);
				success();
			});
		}else{
			API.delete('users/remove', this.id);
			success();
		}

	}
	static all(success, failure) {
		super.all('users', data => new User(data), success, failure );
	}

	static find(id, success, failure) {
		API.get('users/' + id, function(data){
			let user = new User(data);
			success(user);
			Event.fire('userLoaded');
		}, failure);
	}

	static getAuthenticated(success, failure) {
		API.get('user/authenticated', function(data){
			let user = new User(data);
			success(user);
			Event.fire('userLoaded');
		}, failure);	
	}


	with(relation, factory) {
		API.get('api/users/' + this.id + '/' + relation, (relationData) => {
			this[relation] = factory(relationData); 
		});

	}


}

export default User;
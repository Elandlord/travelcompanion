import Model from './Model';

class User extends Model{


		static find(id, success, failure) {
			  API.get('users/' + id +, function(data){
			   let user = new User(data);
			   success(user);
			   Event.fire('userLoaded');
			  }, failure);
		 }


}
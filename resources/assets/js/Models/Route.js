import Model from './Model';

class Route extends Model{

	with(relation, factory) {
		API.get('api/routes/' + this.id + '/' + relation, (relationData) => {
			this[relation] = factory(relationData); 
		});
	}

}

export default Route;
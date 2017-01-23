import Model from './Model';

class Weather extends Model{

		

	static all(success, failure) {
		super.all('weather', data => new Weather(data), success, failure );
	}

	weatherType() {
		return this.weather[0].main;
	}

	weatherTypeDescription() {
		return this.weather[0].description;
	}

	country(){
		return this.sys.country;
	}

	cityName(){
		return this.name;
	}

	dressingAdvice(){
		if(this.temperature() <= 5){
			return "Woosh! It's cold outside. Better wear a scarf and gloves.";
		}else if(this.temperature() > 5 && this.temperature() <= 10){
			return "It'll be chilly tonight. Take your coat!";
		}else if(this.temperature() > 11 && this.temperature() < 20){
			return "It's pleasant outside, although it will cool down. Wear a vest to be sure!";
		}else{
			return "It's freaking hot! You better wear sunscreen.";
		}
	}


	icon() {
		return "http://openweathermap.org/img/w/" + this.weather[0].icon + ".png";
	}

	temperature() {
		var temp_1_decimal = Math.round( this.main.temp * 10 ) / 10;
		return temp_1_decimal;
	}

	static search(searchParameters, success, failure) {
		API.get('weather?searchParameters=' + searchParameters, (data) => {
			success(new Weather(JSON.parse(data)));
		}, failure);

	}

	static find(id, success, failure) {
		API.get('weather/' + id + '/edit', (data) => {
			let user = new User(data);
			success(user);
			Event.fire('userLoaded');
		}, failure);
	}

}

export default Weather;
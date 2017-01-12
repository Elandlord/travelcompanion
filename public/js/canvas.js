var graph = document.getElementById('graph');
var amount = graph.dataset.amount;


var data = {
	labels: ['Aantal werknemers - 2012', 'Aantal werknemers - 2013', 'Aantal werknemers - 2014','Aantal werknemers - 2015', 'Aantal werknemers - Heden'],

	datasets: [
		{
			label: "Aantal werknemers",
			data: [612, 723, 863, 968, amount],
			backgroundColor: "rgba(220,220,220,0)",
			borderColor: "#1abc9c",
			borderWidth: 5,

		}
	]
}

var context = document.querySelector('#graph').getContext('2d');

new Chart(context , {
    type: "line",
    data: data, 

});

var employee_graph = document.getElementById('employee_graph');
var department = employee_graph.dataset.department;
var departmentSplit = department.split(",");

var employee_counter = employee_graph.dataset.count;
var employeeSplit = employee_counter.split(",");


var data = {
    labels: departmentSplit,
    datasets: [
        {
            label: "Aantal medewerkers per afdeling",
            data: employeeSplit,
            backgroundColor: [
                "#e74c3c",
                "#3498db",
                "#34495e",
                "#f1c40f",
                "#1abc9c",
                "#ecf0f1",
                "#95a5a6",
                "#f39c12",
                "#d35400",
                "#c0392b",
                "#9b59b6",
                "#3B7615",
                "#B4916E",
                "#000000",
                "#CB213D",
                "#E3ECBF",
                "#d26ddf"
            ],
            hoverBackgroundColor: [
                "#e74c3c",
                "#3498db",
                "#34495e",
                "#f1c40f",
                "#1abc9c",
                "#ecf0f1",
                "#95a5a6",
                "#f39c12",
                "#d35400",
                "#c0392b",
                "#9b59b6",
                "#3B7615",
                "#B4916E",
                "#000000",
                "#CB213D",
                "#E3ECBF",
                "#d26ddf"
            ]
        }]
};

var context = document.querySelector('#employee_graph').getContext('2d');

new Chart(context,{
    type: 'horizontalBar',
    data: data
});
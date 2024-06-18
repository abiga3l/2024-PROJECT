document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById('moodgraph').getContext('2d');
    var moodData = {
        labels: ['Happy', 'Sad', 'Anxious', 'Neutral', 'Not sure'],
        datasets: [{
            label: 'Mood Tracker',
            data: [0, 0, 0, 0, 0], // Ensure the data array matches the number of labels
            backgroundColor: [ // Corrected property name
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };

    var moodChart = new Chart(ctx, {
        type: 'bar',
        data: moodData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    fetch('/fetch_mood.php')
    .then(response => response.json())
    .then(data => {
        moodChart.data.datasets[0].data = data;
        moodChart.update();
    });

    document.getElementById('moodForm').addEventListener('submit', function() { // Corrected syntax for event listener
        var date = new Date().toISOString().split('T')[0];
        document.getElementById('date').value = date;
    });
});

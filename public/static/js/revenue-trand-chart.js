function loadRevenueChart(){
    // var dataset = $("#revenue-chart-data").html();
    // console.log(dataset);

    var ctx = document.getElementById("myRevenueChart")
    var myChart = new Chart(ctx, {
        type: 'line',
        data: REVENUE_DATASET,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
            responsive: true, // Instruct chart js to respond nicely.
            maintainAspectRatio: false, // Add to prevent default behaviour of full-width/height
        }
    });
}

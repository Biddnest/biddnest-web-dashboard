var ctx = document.getElementById("myRevenueChart")



var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["21 Dec", "22 Dec", "23 Dec", "24 Dec", "25 Dec", "26 Dec", "27 Dec"],
        datasets: [{
            label: 'Last Week',
            data: [0, 1.5, 1, 0.5, 3, 2.5, 3.5],

            backgroundColor: [
                'rgba(231,230,241,0.7)',
         
            ],
            borderColor: [
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',
                'rgba(45,43,135,1)',

               
            ],
            borderWidth: 1
        },
          {
            label: 'This Week',
            data: [0, 1.2, 0.4, 2.1, 1.3, 2.3, 0],
            borderDash: [10,5],

            backgroundColor: [
                'rgba(255,252,242,0.7)',
               
            ],
            borderColor: [
                'rgba(248,204,72,1)',
                'rgba(248,204,72,1)',
                'rgba(248,204,72,1)',
                'rgba(248,204,72,1)',
                'rgba(248,204,72,1)',
                'rgba(248,204,72,1)',

            
            ],
            borderWidth: 1
        }         
                  ]
    },
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



// (231,230,241)

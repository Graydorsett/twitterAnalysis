
// Charts.js

//// Personality
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Liberal", "Conservative", "Green", "Libertarian",],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#FFC155",
        "#9b59b6",
      ],
      data: [12, 19, 3, 17,]
    }]
  }
});


//// Politics
var ctx = document.getElementById('politics').getContext('2d');
var myChart2 = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Liberal", "Conservative", "Green", "Libertarian",],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#FFC155",
        "#9b59b6",
      ],
      data: [12, 19, 3, 17,]
    }]
  }
});

//// Emotion
var ctx = document.getElementById('emotion').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Anger", "Joy", "Fear", "Sadness", "Surprise"],
    datasets: [{
      backgroundColor: [
        "#2ecc71",
        "#3498db",
        "#ED4D4D",
        "#9b59b6",
        "#FFC155",
      ],
      data: [12, 19, 3, 17, 5]
    }]
  },
    options: {
         legend: {
            display: false
         },
        scales: {
    xAxes: [{
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                }
            }],
    yAxes: [{
                gridLines: {
                    color: "rgba(0, 0, 0, 0)",
                },
        display: false,
        
            }]
    }
    }
});


/////////// C3 Charts ////////

//// Sentiment Gauge
var chart = c3.generate({
    bindto: '#sentiment',
    data: {
        columns: [
            ['Sentiment', 91.4]
        ],
        type: 'gauge',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    gauge: {
    },
    color: {
        pattern: ['#2ecc71'] // the three color levels for the percentage values.
    },
    size: {
        height: 180
    }
});


/// Engagement
var chart = c3.generate({
    bindto: '#engagement',
    data: {
        columns: [
            ['Twitter Engagement', 91.4]
        ],
        type: 'gauge',
        onclick: function (d, i) { console.log("onclick", d, i); },
        onmouseover: function (d, i) { console.log("onmouseover", d, i); },
        onmouseout: function (d, i) { console.log("onmouseout", d, i); }
    },
    gauge: {
    },
    color: {
        pattern: ['#3498db'] // the three color levels for the percentage values.
    },
    size: {
        height: 180
    }
});





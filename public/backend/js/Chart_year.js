$(function() {
    'use strict';
    function number_format(number, decimals, dec_point, thousands_sep) {
        // *     example: number_format(1234.56, 2, ',', ' ');
        // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                    s = '',
                    toFixedFix = function (n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
    }
    
    $.ajax({
        type: "get",
        url: "{{url('/getData-Chart')}}",
        success: function (response) {
          var data = {
            labels: response.labels,
            datasets: [{
              label: "Doanh thu",
              data: response.data,
    
              backgroundColor: response.backgroundColor,
    
              borderColor: response.borderColor,
    
              borderWidth: 1,
              fill: false
            }]
          }
    
          var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    }
                }]
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, chart){
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel, 0) + " VNĐ";
                    }
                }
            },
            // scales: {
            //   yAxes: [{
            //     ticks: {
            //       beginAtZero: true
            //     }
            //   }]
            // },
            legend: {
              display: false
            },
            elements: {
              point: {
                radius: 0
              }
            }
          };
    
          if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
              type: 'bar',
              data: data,
              options: options
            });
          }
        }
      });

    function refresh_chart(fillter){
    
        $.ajax({
          type: "get",
          url: "{{url('/getData-Chart')}}",
          data:{
            fillter: fillter
          },
          success: function (response) {
            var data = {
              labels: response.labels,
              datasets: [{
                label: "Doanh thu",
                data: response.data,
    
                backgroundColor: response.backgroundColor,
    
                borderColor: response.borderColor,
    
                borderWidth: 1,
                fill: false
              }]
            }
    
            var options = {
              scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                        callback: function(value, index, values) {
                            return number_format(value);
                        }
                    }
                }]
              },
     
              tooltips: {
                callbacks: {
                    label: function(tooltipItem, chart){
                        var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return datasetLabel + ': ' + number_format(tooltipItem.yLabel, 0) + " VNĐ";
                    }
                }
              },
    
              legend: {
                display: false
              },
    
              elements: {
                point: {
                  radius: 0
                }
              }
            };
    
            if ($("#barChart").length) {
              $("#barChart").remove();
              $("#cart-body").append('<canvas id="barChart"></canvas>');
             
              var barChartCanvas = $("#barChart").get(0).getContext("2d");
              // This will get the first returned node in the jQuery collection.
    
              var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data,
                options: options
              });
            }
          }
        });
      }
    
      
      /* ChartJS
       * -------
       * Data and config for chartjs
       */
      // 
});
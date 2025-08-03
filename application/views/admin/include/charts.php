
  
<!-- high charts js-->
<script src="https://code.highcharts.com/highcharts.js"></script>

<script>

  var incomeData = <?= $income_data; ?>;
  var incomeAxis = <?= $income_axis; ?>;

  Highcharts.chart('adminIncomeChart', {
      chart: {
          type: 'column'
      },
      credits: {
          enabled: false
      },
      title: {
          text: ''
      },
      xAxis: {
          categories: incomeAxis
      },
      yAxis: {
          title: {
              text: ''
          }

      },
      legend: {
          enabled: true
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '<?php echo html_escape($currency) ?>{point.y}'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span> <b><?php echo html_escape($currency) ?>{point.y}</b><br/>'
      },

      series: [
          {
              name: '<?php echo trans('income') ?>',
              data: incomeData,
              color: '#2568ef'
          }
      ]
  });

  
  Highcharts.chart('packagePie', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: ''
    },
    credits: {
        enabled: false
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        }
      }
    },
    series: [{
      name: 'Users',
      colorByPoint: true,
      
      data: [
          <?php 
            foreach ($upackages as $upackage) {
              echo '{
                name: "'.trans(strtolower($upackage->name)).'",
                y: '.$upackage->total.'
              },';
            }
          ?>
        ]
    }]
  });
</script>

<?php 
    session_start();
    include "../app/classes/Page.class.php";
    
    if(!isset($_SESSION['user_token'])){
      Page::route('/login.php');
    }
    include_once "../app/classes/Database.class.php";  
    include_once "../app/resources/views/start.layout.php";    
    include_once "../app/resources/views/header.layout.php";
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Charts</h1>
                </div>
            </div>
        </div>
        <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- BAR CHART -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Light Sensor Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lightChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <div class="col-12">
            <!-- BAR CHART -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Smoke Sensor Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="smokeChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <div class="col-12">
            <!-- BAR CHART -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Temperature Sensor Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="tempChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
    </div>
</section>
    </div>
</div>

<?php include_once "../app/resources/views/footer.layout.php";?>
<?php include_once "../app/resources/views/components/required-script.component.php";?>
<!-- ChartJS -->
<script src=<?php echo Page::asset("/public/plugins/bootstrap/js/bootstrap.bundle.min.js");?>></script>
<script src=<?php echo Page::asset("/public/plugins/chart.js/Chart.min.js");?>></script>
<script src=<?php echo Page::asset("/public/plugins/moment/moment.min.js");?>></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //-------------
    //- BAR CHART -
    //-------------
    //var value = [];
    // STARTS HERE
    getData()
    setInterval(() => {
      getData()
    }, 2500);

    function getData() {
      $.when($.ajax({        
        method: "POST",
        url: "../app/includes/getSensorData.inc.php",
        data:{
          api_key: "tPmAT5Ab3j7F9"
        },
        error: (err)=>{
          console.log("Error");
        }
      }))
      .then((data, textStatus, jqXHR)=>{             
        let datas = JSON.parse(data);
        let light = [];
        let smoke = [];
        let temp = [];        
        for(let i = 0; i < datas.length; i++){
            let x = datas[i]['created_at'];
            let l = datas[i]['light'];
            let s = datas[i]['smoke'];
            let t = datas[i]['temperature'];
            // console.log([x,y]);
            light.push([x,l]);
            smoke.push([x,s]);
            temp.push([x,t]);
          }
          // setGraphChart(value)
          setlineChart('#lightChart', light, 'Light');
          setlineChart('#smokeChart', smoke, 'Smoke');          
          setlineChart('#tempChart', temp, 'Temperature');
      })
    }

    function setlineChart(id,data,label){
      let datas = data;      
      let date = (datas.length>0)?new moment(datas[0][0]).format('MMMM Do YYYY'):'No data today'
      let xAxisData = datas.map((d)=> new moment(d[0]).format('h:mm:ss a'));
      let yAxisData = datas.map((d)=>d[1]);
      let areaChartData = {
        labels  : xAxisData,
        datasets: [
          {
            label               : label,
            backgroundColor     : 'rgba(60,141,188,0.9)',
            borderColor         : 'rgba(60,141,188,0.8)',
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointStrokeColor    : 'rgba(60,141,188,1)',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data                : yAxisData
          },
          ]
      }

      let areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      animation: {
        duration: 0
      },
      title:{
          display:true,
          text: 'as of ' + date
        },
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
            }
          }]
        }
      }
      let lineChartCanvas = $(id).get(0).getContext('2d')
      let lineChartOptions = $.extend(true, {}, areaChartOptions)
      let lineChartData = $.extend(true, {}, areaChartData)
      // lineChartData.datasets[0].fill = false;
      // lineChartData.datasets[1].fill = false;
      // lineChartOptions.datasetFill = false;

      let lineChart = new Chart(lineChartCanvas, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
      })
    }

  })

</script>
<?php include_once "../app/resources/views/end.layout.php";?>
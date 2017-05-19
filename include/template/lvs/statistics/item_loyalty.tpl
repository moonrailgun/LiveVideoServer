<{include file="header.tpl" }>
<{include file="navibar.tpl" }>
<{include file="sidebar.tpl" }>
<!-- START 以上内容不需更改，保证该TPL页内的标签匹配即可 -->

<{$osadmin_action_alert}>
<{$osadmin_quick_note}>

<script src="<{$smarty.const.ADMIN_URL}>/assets/lib/Chart.js/Chart.min.js"></script>

<div id="search" class="collapse in">
<form class="form_search"  action="" method="GET" style="margin-bottom:0px">
  <input type="hidden" name="search" value="1" >
	<div style="float:left;margin-right:5px">
    <label>平台</label>
    <select id="website_id" name="website_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$website_id_list selected=$_GET.website_id}>
    </select>
    <label>道具</label>
    <select id="item_id" name="item_id" class="input-xlarge">
      <option value="">全部</option>
      <{html_options options=$item_id_list selected=$_GET.item_id}>
    </select>
    <label>排名条件</label>
    <select id="analysis_by" name="analysis_by" class="input-xlarge">
      <option value="totalCost">虚拟币</option>
      <option value="totalAmount">次数</option>
    </select>
    <label>起止日期</label>
    <input type="text" id="start_date" name="start_date" value="<{$_GET.start_date}>" placeholder="起始时间" >
    <input type="text" id="end_date" name="end_date" value="<{$_GET.end_date}>" placeholder="结束时间" >
    <div class="btn-toolbar" style="padding-top:0;padding-bottom:0;margin-bottom:0">
      <button type="submit" class="btn btn-primary">检索</button>
    </div>
  </div>
	<div style="clear:both;"></div>
</form>
</div>

<div class="block">
  <a href="#page-stats" class="block-heading" data-toggle="collapse">道具粘性</a>
  <div id="page-stats" class="block-body collapse in">
    <div style="width:75%;">
      <canvas id="canvas"></canvas>
      <span>loyalty_data:<{json_encode($loyalty_data)}></span>
    </div>
  </div>
</div>

<script>
$(function() {
	var date=$("#start_date");
	date.datepicker({dateFormat: "yy-mm-dd"});
	date.datepicker("option", "firstDay", 1 );
});
$(function() {
	var date=$( "#end_date" );
	date.datepicker({dateFormat: "yy-mm-dd"});
	date.datepicker("option", "firstDay", 1 );
});
$(function() {
  $('#analysis_by').val("<{$_GET.analysis_by}>");
});
</script>
<!-- <script>
  var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var config = {
      type: 'line',
      data: {
          labels: ["January", "February", "March", "April", "May", "June", "July"],
          datasets: [{
              label: "My First dataset",
              backgroundColor: window.chartColors.red,
              borderColor: window.chartColors.red,
              data: [
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor()
              ],
              fill: false,
          }, {
              label: "My Second dataset",
              fill: false,
              backgroundColor: window.chartColors.blue,
              borderColor: window.chartColors.blue,
              data: [
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor(),
                  randomScalingFactor()
              ],
          }]
      },
      options: {
          responsive: true,
          title:{
              display:true,
              text:'Chart.js Line Chart'
          },
          tooltips: {
              mode: 'index',
              intersect: false,
          },
          hover: {
              mode: 'nearest',
              intersect: true
          },
          scales: {
              xAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Month'
                  }
              }],
              yAxes: [{
                  display: true,
                  scaleLabel: {
                      display: true,
                      labelString: 'Value'
                  }
              }]
          }
      }
  };

  window.onload = function() {
      var ctx = document.getElementById("canvas").getContext("2d");
      window.myLine = new Chart(ctx, config);
  };

  document.getElementById('randomizeData').addEventListener('click', function() {
      config.data.datasets.forEach(function(dataset) {
          dataset.data = dataset.data.map(function() {
              return randomScalingFactor();
          });

      });

      window.myLine.update();
  });

  var colorNames = Object.keys(window.chartColors);
  document.getElementById('addDataset').addEventListener('click', function() {
      var colorName = colorNames[config.data.datasets.length % colorNames.length];
      var newColor = window.chartColors[colorName];
      var newDataset = {
          label: 'Dataset ' + config.data.datasets.length,
          backgroundColor: newColor,
          borderColor: newColor,
          data: [],
          fill: false
      };

      for (var index = 0; index < config.data.labels.length; ++index) {
          newDataset.data.push(randomScalingFactor());
      }

      config.data.datasets.push(newDataset);
      window.myLine.update();
  });

  document.getElementById('addData').addEventListener('click', function() {
      if (config.data.datasets.length > 0) {
          var month = MONTHS[config.data.labels.length % MONTHS.length];
          config.data.labels.push(month);

          config.data.datasets.forEach(function(dataset) {
              dataset.data.push(randomScalingFactor());
          });

          window.myLine.update();
      }
  });

  document.getElementById('removeDataset').addEventListener('click', function() {
      config.data.datasets.splice(0, 1);
      window.myLine.update();
  });

  document.getElementById('removeData').addEventListener('click', function() {
      config.data.labels.splice(-1, 1); // remove the label first

      config.data.datasets.forEach(function(dataset, datasetIndex) {
          dataset.data.pop();
      });

      window.myLine.update();
  });
</script> -->

<!-- 操作的确认层，相当于javascript:confirm函数 -->
<{$osadmin_action_confirm}>

<!-- END 以下内容不需更改，请保证该TPL页内的标签匹配即可 -->
<{include file="footer.tpl" }>

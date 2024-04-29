
<style>
   .dbg {
      border: 1px solid red !important;
   }

   main,
   header,
   footer {
      margin: 0 auto;
      width: 90%;
      padding: 10px;
   }

   header,
   footer {
      display: flex;
      gap: 5rem;
      justify-content: space-between;
   }

   ul[role="breadcrumb"] {
      padding: 0;
   }

   ul[role="breadcrumb"] li {
      display: inline;
      list-style-type: none;
      font-size: 15px;
      color: #888;
   }

   ul[role="breadcrumb"] li::after {
      content: "/";
      margin-left: 7px;
   }

   header img {
      border-radius: 50%;
      background: #fca03e;
      width: 35px;
      height: 35px;
      line-height: 35px;
      font-size: 18px;
      text-align: center;
      color: #fee;
      border: 3px solid #dee;
   }

   nav {
      display: flex;
      gap: 1rem;
   }

   main {
      height: 80%;
      background: transparent;
   }

   hgroup h2 {
      margin-bottom: 0;
   }

   hgroup ul {
      margin-top: 0;
   }

   small {
      color: #888;
   }

   section {
      display: flex;
      gap: 10px;
      overflow-x: auto;
   }

   section div.examples,
   dl,
   article {
      flex: 1;
      text-align: center;
      background: #fff !important;
      padding: 20px;
      /* border: 1px solid #244F96; */
      border-radius: 5px;
      box-shadow: rgb(30 41 59 / 4%) 0 2px 4px 0;
      margin-bottom: 35px;
      -webkit-box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
      box-shadow: 0 1px 2px rgb(56 65 74 / 15%);
   }

   dt {
      font-size: 18px;
      color: #000;
   }

   dd {
      font-size: 35px;
      margin-left: 0;
   }

   .col-indigo {
      color: #fff !important;
   }
</style>
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<!--div id="bardiv" style="width: 100%; height: 400px;"></div-->
<script>
   am4core.ready(function() {
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end

      var chart = am4core.create("bardiv", am4charts.XYChart);
      chart.colors.step = 2;

      chart.legend = new am4charts.Legend();
      chart.legend.position = "top";
      chart.legend.paddingBottom = 20;
      chart.legend.labels.template.maxWidth = 95;

      var xAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      xAxis.dataFields.category = "category";
      xAxis.renderer.cellStartLocation = 0.1;
      xAxis.renderer.cellEndLocation = 0.9;
      xAxis.renderer.grid.template.location = 0;
      xAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

      var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
      yAxis.min = 0;
      yAxis.renderer.labels.template.fill = am4core.color("#9aa0ac");

      function createSeries(value, name) {
         var series = chart.series.push(new am4charts.ColumnSeries());
         series.dataFields.valueY = value;
         series.dataFields.categoryX = "category";
         series.name = name;

         series.events.on("hidden", arrangeColumns);
         series.events.on("shown", arrangeColumns);

         var bullet = series.bullets.push(new am4charts.LabelBullet());
         bullet.interactionsEnabled = false;
         bullet.dy = 30;
         bullet.label.text = "{valueY}";
         bullet.label.fill = am4core.color("#ffffff");

         return series;
      }

      chart.data = [
         <?php foreach ($financialYears as $key => $year) { ?> {
               category: <?php echo '"' . $year . '"'; ?>,
               <?php //foreach($yearwise_detail[$key] as $value){  
               ?>
               first: <?php echo ($yearwise_detail[$key][0]['sanctioned_amount']) ? $yearwise_detail[$key][0]['sanctioned_amount'] : 0;   ?>,
               second: <?php echo ($yearwise_detail[$key][1]['sanctioned_amount']) ? $yearwise_detail[$key][1]['sanctioned_amount'] : 0;   ?>,
               third: <?php echo ($yearwise_detail[$key][2]['sanctioned_amount']) ? $yearwise_detail[$key][2]['sanctioned_amount'] : 0;   ?>,

               <?php //} 
               ?>
            },
         <?php } ?>

      ];

      createSeries("first", "Police");
      createSeries("second", "Fire");
      createSeries("third", "Prison");

      function arrangeColumns() {
         var series = chart.series.getIndex(0);

         var w =
            1 -
            xAxis.renderer.cellStartLocation -
            (1 - xAxis.renderer.cellEndLocation);
         if (series.dataItems.length > 1) {
            var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
            var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
            var delta = ((x1 - x0) / chart.series.length) * w;
            if (am4core.isNumber(delta)) {
               var middle = chart.series.length / 2;

               var newIndex = 0;
               chart.series.each(function(series) {
                  if (!series.isHidden && !series.isHiding) {
                     series.dummyData = newIndex;
                     newIndex++;
                  } else {
                     series.dummyData = chart.series.indexOf(series);
                  }
               });
               var visibleCount = newIndex;
               var newMiddle = visibleCount / 2;

               chart.series.each(function(series) {
                  var trueIndex = chart.series.indexOf(series);
                  var newIndex = series.dummyData;

                  var dx = (newIndex - trueIndex + middle - newMiddle) * delta;

                  series.animate({
                        property: "dx",
                        to: dx
                     },
                     series.interpolationDuration,
                     series.interpolationEasing
                  );
                  series.bulletsContainer.animate({
                        property: "dx",
                        to: dx
                     },
                     series.interpolationDuration,
                     series.interpolationEasing
                  );
               });
            }
         }
      }
   });
</script>

<!--script>
// Create chart instance
var chart = am4core.create("bardiv", am4charts.XYChart);

// Add data
chart.data = [{
  "country": "Lithuania",
  "litres": 501.9,
  "units": 250
}, {
  "country": "Czech Republic",
  "litres": 301.9,
  "units": 222
}, {
  "country": "Ireland",
  "litres": 201.1,
  "units": 170
}, {
  "country": "Germany",
  "litres": 165.8,
  "units": 122
}, {
  "country": "Australia",
  "litres": 139.9,
  "units": 99
}, {
  "country": "Austria",
  "litres": 128.3,
  "units": 85
}, {
  "country": "UK",
  "litres": 99,
  "units": 93
}, {
  "country": "Belgium",
  "litres": 60,
  "units": 50
}, {
  "country": "The Netherlands",
  "litres": 50,
  "units": 42
}];

// Create axes
let categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "country";
categoryAxis.title.text = "Countries";

let valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.title.text = "Litres sold (M)";

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.valueY = "litres";
series.dataFields.categoryX = "country";
series.name = "Sales";
series.columns.template.tooltipText = "Series: {name}\nCategory: {categoryX}\nValue: {valueY}";
series.columns.template.fill = am4core.color("#00ff00"); // fill

var series2 = chart.series.push(new am4charts.LineSeries());
series2.name = "Units";
series2.stroke = am4core.color("#CDA2AB");
series2.strokeWidth = 3;
series2.dataFields.valueY = "units";
series2.dataFields.categoryX = "country";
</script-->

<!--div id="chartdiv" style="width: 100%; height: 400px;"></div-->

<script>
   // Create chart instance
   var chart = am4core.create("chartdiv", am4charts.PieChart);

   // Add data
   chart.data = [
      <?php foreach ($departwise_as_details as $asdetail) {
      ?> {

            "country": <?php echo '"' . substr($asdetail['depart_name'], 0, 6) . '"'; ?>,
            "litres": <?php echo ($asdetail['sanctioned_amount'] != '') ? $asdetail['sanctioned_amount'] : 0; ?>
         },
      <?php } ?>
   ];

   // Add and configure Series
   var pieSeries = chart.series.push(new am4charts.PieSeries());
   pieSeries.dataFields.value = "litres";
   pieSeries.dataFields.category = "country";
</script>
<div class="row">
   <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
         <h4 class="mb-sm-0">Dashboards</h4>
         <div class="page-title-right">
            <ol class="breadcrumb m-0">
			  <?php if($notification_count){ ?>
               <!--li class="breadcrumb-item"><button class="btn btn-outline-danger btn-sm blink" style="margin-left:0px;width:200px;">Notification</button></li-->
               <li><?php echo $this->Html->link(__('<i class="fa fa-list-alt"></i> Notification'), ['action' => 'notificationlist'], ['escape' => false, 'class' => 'btn btn-outline-danger btn-sm blink','style'=>'margin-left:0px;width:150px;']); ?><br><br>
               </li>
			    <li class="breadcrumb-item"></li>
			  <?php  } ?>
               <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
               <li class="breadcrumb-item active">Home</li>
            </ol>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100 ">Total Projects</h5>
            <div class="d-flex items-end justify-between space-x-2">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectProposedCount as $key => $value) { ?>
                           <?php if ($value['proposed'] != 0) { ?>
                              <?php echo $value['proposed']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(1);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
         <!-- end col -->
      </div>
   </div>
   <div class="col">
      <div class="card crm-widget to-orange-600 rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-amber-50">AS Sanctioned (Constuction)</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectApprovedCount as $key => $value) { ?>
                           <?php if ($value['approved'] != 0) { ?>
                              <?php echo $value['approved']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(2);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <!-- end col -->
   <div class="col">
      <div class="card crm-widget from-pink-500 rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-pink-100">FS Sanctioned (Constuction)</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectSanctionedcount as $key => $value) { ?>
                           <?php if ($value['sanctioned'] != 0) { ?>
                              <?php echo $value['sanctioned']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(3);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <div class="col">
      <div class="card crm-widget to-orange-600 rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-amber-50">Project H/O to Contractor</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectProgresscount as $key => $value) { ?>
                           <?php if ($value['progress'] != 0) { ?>
                              <?php echo $value['progress']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(4);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100">Project Completed</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectCompletedcount as $key => $value) { ?>
                           <?php if ($value['completed'] != 0) { ?>
                              <?php echo $value['completed']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(5);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <!-- end col -->
</div>
<?php if($role_id == 8){   ?>
<br>
<div class="row">
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100 ">UC Raised Count</h5>
            <div class="d-flex items-end justify-between space-x-2">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($uc_raised as $key => $uc) { ?>
                           <?php if ($uc['raised'] != 0) { ?>
                              <?php echo $uc['raised']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="uc_details(1);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
         <!-- end col -->
      </div>
   </div>
   <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
   <div class="col">
      <div class="card crm-widget to-orange-600 rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-amber-50">Uc Amount Received Count</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($uc_amount_received as $key => $amount) { ?>
                           <?php if ($amount['received'] != 0) { ?>
                              <?php echo $amount['received']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="uc_details(2);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <!-- end col -->
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100">PD Account Balance (Rs.)</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($pd_account as $key => $account) { ?>
                           <?php if ($account['amount'] != 0) { ?>
                              <?php echo  ($account['amount'])?ltrim($fmt->formatCurrency((float)$account['amount'],'INR'),'₹'):'0.00'; ?>  
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="uc_details(3);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>   
</div><br>
<div class="row">
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100 ">UC Raised Amount</h5>
            <div class="d-flex items-end justify-between space-x-2">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($uc_raised as $key => $uc) { ?>
                           <?php if ($uc['uc_raised_amount'] != 0) { ?>
                              <?php echo $uc_raised_amount = ($uc['uc_raised_amount'])?ltrim($fmt->formatCurrency((float)$uc['uc_raised_amount'],'INR'),'₹'):'0.00'; ?>  
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <!--a href="#" onclick="uc_details(1);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a-->
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
         <!-- end col -->
      </div>
   </div>
   <?php 
	$fmt = new NumberFormatter('en-IN', NumberFormatter::CURRENCY);
	$fmt->setAttribute(NumberFormatter::FRACTION_DIGITS, 2);
	$fmt->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');	  					
 ?>
   <div class="col">
      <div class="card crm-widget to-orange-600 rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-amber-50">Uc Received Amount</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($uc_amount_received as $key => $amount) { ?>
                           <?php if ($amount['received'] != 0) { ?>
                              <?php echo $uc_received_amount = ($amount['uc_received_amount'])?ltrim($fmt->formatCurrency((float)$amount['uc_received_amount'],'INR'),'₹'):'0.00'; ?>  
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <!--a href="#" onclick="uc_details(2);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a-->
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100 ">UC Balance Amount</h5>
            <div class="d-flex items-end justify-between space-x-2">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                           <?php if ($balance_uc_amount != 0) {
                               
							   ?>
						   
                              <?php echo  ($balance_uc_amount)?ltrim($fmt->formatCurrency((float)$balance_uc_amount,'INR'),'₹'):'0.00'; ?>  
                           <?php } else { ?>
						   <span><?php echo "0"; } ?></span>
                        
                     </span>
                  </h2>
               </div>
               <!--a href="#" onclick="uc_details(1);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a-->
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
         <!-- end col -->
      </div>
   </div>
   <!-- end col -->
   <!--div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100">PD Account Balance (Rs.)</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($pd_account as $key => $account) { ?>
                           <?php if ($account['amount'] != 0) { ?>
                              <?php echo  ($account['amount'])?ltrim($fmt->formatCurrency((float)$account['amount'],'INR'),'₹'):'0.00'; ?>  
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div-->
   <!--div class="col">
      <div class="card crm-widget to-orange-600 rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-amber-50">Project H/O to Contractor</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectProgresscount as $key => $value) { ?>
                           <?php if ($value['progress'] != 0) { ?>
                              <?php echo $value['progress']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(4);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <div class="col">
      <div class="card crm-widget bg-gradient-to-br rounded-lg">
         <div class="card-body">
            <h5 class="text-uppercase fs-13 text-sky-100">Project Completed</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                        <?php foreach ($projectCompletedcount as $key => $value) { ?>
                           <?php if ($value['completed'] != 0) { ?>
                              <?php echo $value['completed']; ?>
                           <?php } else { ?>
                              <span><?php echo "0"; ?></span>
                           <?php  } ?>
                        <?php $sno++;
                        } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(5);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div-->
   <!-- end col -->
</div>


<?php }   ?>
<!-- end row -->
<!-- start page content -->
<!-- start chart -->
<?php //if($role_id == 1 || $role_id == 6 || $role_id == 8 || $role_id == 9 || $role_id == 10){  
?>
 <?php if ($projectSanctionedcount[0]['sanctioned'] > 0) { ?>
<div class="row clearfix mt-5">
   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
      <div class="card">
         <div class="card-head">
            <header>Department Wise AS Sanctioned (%)</header>
         </div>
         <div class="card-body">
            <div class="recent-report__chart">
               <div id="chartdiv" style="width: 100%; height: 280px;"></div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-6">
      <div class="card">
         <div class="card-head">
            <header>Year Wise AS Sanctioned (In Lakhs)</header>
         </div>
         <div class="card-body">
            <div class="recent-report__chart">
               <div id="bardiv" style="width: 100%; height: 280px;"></div>
            </div>
         </div>
      </div>
   </div>
</div><br>

 <?php }  ?>
<!-- start chart -->

<section class="dashboard">
   <dl style="background-color:#000080 ;">
   <!-- <button type="submit" class="btn btn-info" onclick="weatherAPI()">Get Details</button> -->

      <dt>Division Wise (Construction work)</dt>
      <dd>
         <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
            </h1> -->
         <span href="javascript:;" class="single-mail">
            <h1 class="mt-1">
               <div class="row">
                  <table class="table  table-bordered table-checkable order-column mobile-table">
                     <thead>
                        <tr class="text-center">
                           <th class="bol"> Sno </th>
                           <th class="bol"> Division Name </th>
                           <th class="bol"> Total Project </th>
                           <!--th class="bol"> Proposed </th-->
                           <th class="bol"> AS Sanctioned</th>
                           <th class="bol"> FS Sanctioned </th>
                           <th class="bol"> project H/O to Contractor </th>
                           <th class="bol"> Completed</th>
                        </tr>
                     </thead>
                     <tbody style="background-color:#EEEDF4;border: initial;">
                        <?php $sno = 1;
                        foreach ($divisions_details as $key => $division) : ?>
                           <tr class="odd gradeX">
                              <td class="bol"><?php echo ($sno); ?></td>
                              <td class="bol"><?php echo $division['division_name']; ?></td>
                              <td class="bol"><?php $totalproject = $division['projectcount']; ?>
                                 <?php if ($totalproject > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,1,1);"><?php echo $totalproject ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <!--td class="bol">
                                 <?php $totalproposed  =  $division['proposed']; ?>
                                 <?php if ($totalproposed > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,2,1)"><?php echo $totalproposed; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td-->
                              <td class="bol">
                                 <?php $totalapproved = $division['approved']; ?>
                                 <?php if ($totalapproved > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,3,1)"><?php echo $totalapproved; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalsanctioned = $division['sanctioned']; ?>
                                 <?php if ($totalsanctioned > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,4,1)"><?php echo $totalsanctioned; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalprogress = $division['progress']; ?>
                                 <?php if ($totalprogress > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,5,1)"><?php echo $totalprogress; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalcompleted = $division['completed']; ?>
                                 <?php if ($totalcompleted > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,6,1)"><?php echo $totalcompleted; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                           </tr>
                        <?php
                           $sno++;
                           $totalprojects += $totalproject;
                           $proposed += $totalproposed;
                           $approved += $totalapproved;
                           $sanctioned += $totalsanctioned;
                           $progress += $totalprogress;
                           $completed += $totalcompleted;
                        endforeach; ?>
                     </tbody>
                     <tfoot style="background-color:#244F96;">
                        <tr class="odd gradeX">
                           <td></td>
                           <td class="bol" style="color:white;"><?php echo "Total"; ?></td>
                           <td class="bol" style="color:white;"><?php echo $totalprojects; ?></td>
                           <!--td class="bol" style="color:white;"><?php echo $proposed; ?></td-->
                           <td class="bol" style="color:white;"><?php echo $approved; ?></td>
                           <td class="bol" style="color:white;"><?php echo $sanctioned; ?></td>
                           <td class="bol" style="color:white;"><?php echo $progress; ?></td>
                           <td class="bol" style="color:white;"><?php echo $completed; ?></td>
                        </tr>
                     </tfoot>
                  </table>
               </div><br>
			         <dt>Division Wise (Special Repair Work)</dt>

			   <div class="row" style="margin-top:10px;">
                  <table class="table  table-bordered table-checkable order-column mobile-table">
                     <thead>
                        <tr class="text-center">
                           <th class="bol"> Sno </th>
                           <th class="bol"> Division Name </th>
                           <th class="bol"> Total Project </th>
                           <!--th class="bol"> Proposed </th-->
                           <!--th class="bol"> Forward to User Dept <br>(CE Approved)</th>
                           <th class="bol"> FS Sanctioned </th-->
                           <th class="bol"> project H/O to Contractor </th>
                           <th class="bol"> Completed</th>
                        </tr>
                     </thead>
                     <tbody style="background-color:#BDEBD9;border: initial;">
                        <?php $sno1 = 1;
                        foreach ($divisions_details_repair as $key1 => $division1) : ?>
                           <tr class="odd gradeX">
                              <td class="bol"><?php echo ($sno1); ?></td>
                              <td class="bol"><?php echo $division1['division_name']; ?></td>
                              <td class="bol"><?php $totalproject1 = $division1['projectcount']; ?>
                                 <?php if ($totalproject1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key1; ?>,1,2);"><?php echo $totalproject1 ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <!--td class="bol">
                                 <?php $totalproposed1  =  $division1['proposed']; ?>
                                 <?php if ($totalproposed1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key1; ?>,2,2)"><?php echo $totalproposed1; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td-->
                              <!--td class="bol">
                                 <?php $totalapproved1 = $division1['approved']; ?>
                                 <?php if ($totalapproved1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key1; ?>,3,2)"><?php echo $totalapproved1; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalsanctioned1 = $division1['sanctioned']; ?>
                                 <?php if ($totalsanctioned1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key1; ?>,4,2)"><?php echo $totalsanctioned1; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td-->
                              <td class="bol">
                                 <?php $totalprogress1 = $division1['progress']; ?>
                                 <?php if ($totalprogress1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key1; ?>,5,2)"><?php echo $totalprogress1; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalcompleted1 = $division1['completed']; ?>
                                 <?php if ($totalcompleted1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key1; ?>,6,2)"><?php echo $totalcompleted1; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                           </tr>
                        <?php
                           $sno1++;
                           $totalprojects1 += $totalproject1;
                           $proposed1 += $totalproposed1;
                           $approved1 += $totalapproved1;
                           $sanctioned1 += $totalsanctioned1;
                           $progress1 += $totalprogress1;
                           $completed1 += $totalcompleted1;
                        endforeach; ?>
                     </tbody>
                     <tfoot style="background-color:#244F96;">
                        <tr class="odd gradeX">
                           <td></td>
                           <td class="bol" style="color:white;"><?php echo "Total"; ?></td>
                           <td class="bol" style="color:white;"><?php echo $totalprojects1; ?></td>
                           <!--td class="bol" style="color:white;"><?php echo $proposed1; ?></td-->
                           <!--td class="bol" style="color:white;"><?php echo $approved1; ?></td>
                           <td class="bol" style="color:white;"><?php echo $sanctioned1; ?></td-->
                           <td class="bol" style="color:white;"><?php echo $progress1; ?></td>
                           <td class="bol" style="color:white;"><?php echo $completed1; ?></td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </h1>
         </span>
      </dd>
   </dl>
  
   
</section>
<section class="dashboard">  
  
   <dl style="background-color:#000080 ;">
      <dt>Department Wise (Construction Work)</dt>
      <dd>
         <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
            </h1> -->
         <span href="javascript:;" class="single-mail">
            <h1 class="mt-1">
               <div class="row">
                  <table class="table  table-bordered table-checkable order-column mobile-table">
                     <thead>
                        <tr class="text-center">
                           <th class="bol"> Sno </th>
                           <th class="bol"> Department Name </th>
                           <th class="bol"> Total Project </th>
                           <!--th class="bol"> Proposed </th-->
                           <th class="bol"> AS Sanctioned</th>
                           <th class="bol"> FS Sanctioned </th>
                           <th class="bol"> project H/O to Contractor </th>
                           <th class="bol"> Completed</th>
                        </tr>
                     </thead>
                     <tbody style="background-color:#EEEDF4;border: initial;">
                        <?php $sn = 1;
                        foreach ($department_details as $key => $department) : ?>
                           <tr class="odd gradeX">
                              <td class="bol"><?php echo $sn; ?></td>
                              <td class="bol"><?php echo  $department['department_name']; ?></td>
                              <td class="bol">
                                 <?php $totolproject   = $department['projectcount']; ?>
                                 <?php if ($totolproject > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,1,1)"><?php echo $totolproject; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <!--td class="bol">
                                 <?php $totalproposed  =  $department['proposed']; ?>
                                 <?php if ($totalproposed > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,2,1)"><?php echo $totalproposed; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td-->
                              <td class="bol">
                                 <?php $totalapproved = $department['approved']; ?>
                                 <?php if ($totalapproved > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,3,1)"><?php echo $totalapproved; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalsanctioned = $department['sanctioned']; ?>
                                 <?php if ($totalsanctioned > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,4,1)"><?php echo $totalsanctioned; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalprogress = $department['progress']; ?>
                                 <?php if ($totalprogress > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,5,1)"><?php echo $totalprogress; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalcompleted = $department['completed']; ?>
                                 <?php if ($totalcompleted > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,6,1)"><?php echo $totalcompleted; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                           </tr>
                        <?php $sn++;
                           $totolprojectz += $totolproject;
                           $proposed_dept += $totalproposed;
                           $approved_dept += $totalapproved;
                           $sanctioned_dept += $totalsanctioned;
                           $progress_dept += $totalprogress;
                           $completed_dept += $totalcompleted;
                        endforeach; ?>
                     </tbody>
                     <tfoot style="background-color:#244F96;">
                        <tr class="odd gradeX">
                           <td></td>
                           <td class="bol" style="color:white;"><?php echo "Total"; ?></td>
                           <td class="bol" style="color:white;"><?php echo $totolprojectz; ?></td>
                           <!--td class="bol" style="color:white;"><?php echo $proposed_dept; ?></td-->
                           <td class="bol" style="color:white;"><?php echo $approved_dept; ?></td>
                           <td class="bol" style="color:white;"><?php echo $sanctioned_dept; ?></td>
                           <td class="bol" style="color:white;"><?php echo $progress_dept; ?></td>
                           <td class="bol" style="color:white;"><?php echo $completed_dept; ?></td>
                        </tr>
                     </tfoot>
                  </table>
               </div><br>
			    <dt>Department Wise (Special Repair Work)</dt>
			   <div class="row" style="margin-top:10px;">
                  <table class="table  table-bordered table-checkable order-column mobile-table">
                     <thead>
                        <tr class="text-center">
                           <th class="bol"> Sno </th>
                           <th class="bol"> Department Name </th>
                           <th class="bol"> Total Project </th>
                           <!--th class="bol"> Proposed </th-->
                           <!--th class="bol"> Forward to User Dept <br>(CE Approved)</th>
                           <th class="bol"> FS Sanctioned </th-->
                           <th class="bol"> Project H/O to Contractor </th>
                           <th class="bol"> Completed</th>
                        </tr>
                     </thead>
                     <tbody style="background-color:#BDEBD9;border: initial;">
                        <?php $sn = 1;
                        foreach ($department_details_repair as $key1 => $department1) : ?>
                           <tr class="odd gradeX">
                              <td class="bol"><?php echo $sn; ?></td>
                              <td class="bol"><?php echo  $department1['department_name']; ?></td>
                              <td class="bol">
                                 <?php $totolproject11   = $department1['projectcount']; ?>
                                 <?php if ($totolproject11 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key1; ?>,1,2)"><?php echo $totolproject11; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <!--td class="bol">
                                 <?php $totalproposed11  =  $department1['proposed']; ?>
                                 <?php if ($totalproposed11 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key1; ?>,2,2)"><?php echo $totalproposed11; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td-->
                              <!--td class="bol">
                                 <?php $totalapproved11 = $department1['approved']; ?>
                                 <?php if ($totalapproved11 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key1; ?>,3,2)"><?php echo $totalapproved11; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalsanctioned11 = $department1['sanctioned']; ?>
                                 <?php if ($totalsanctioned11 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key1; ?>,4,2)"><?php echo $totalsanctioned11; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td-->
                              <td class="bol">
                                 <?php $totalprogress11 = $department1['progress']; ?>
                                 <?php if ($totalprogress11 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key1; ?>,5,2)"><?php echo $totalprogress11; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                              <td class="bol">
                                 <?php $totalcompleted11 = $department1['completed']; ?>
                                 <?php if ($totalcompleted1 > 0) { ?>
                                    <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key1; ?>,6,2)"><?php echo $totalcompleted11; ?></a>
                                 <?php } else {
                                    echo "0";
                                 } ?>
                              </td>
                           </tr>
                        <?php $sn++;
                           $totolprojectz1 += $totolproject11;
                           $proposed_dept1 += $totalproposed11;
                           $approved_dept1 += $totalapproved11;
                           $sanctioned_dept1 += $totalsanctioned11;
                           $progress_dept1 += $totalprogress11;
                           $completed_dept1 += $totalcompleted11;
                        endforeach; ?>
                     </tbody>
                     <tfoot style="background-color:#244F96;">
                        <tr class="odd gradeX">
                           <td></td>
                           <td class="bol" style="color:white;"><?php echo "Total"; ?></td>
                           <td class="bol" style="color:white;"><?php echo $totolprojectz1; ?></td>
                           <!--td class="bol" style="color:white;"><?php echo $proposed_dept1; ?></td-->
                           <!--td class="bol" style="color:white;"><?php echo $approved_dept1; ?></td>
                           <td class="bol" style="color:white;"><?php echo $sanctioned_dept1; ?></td-->
                           <td class="bol" style="color:white;"><?php echo $progress_dept1; ?></td>
                           <td class="bol" style="color:white;"><?php echo $completed_dept1; ?></td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </h1>
         </span>
      </dd>
   </dl>
</section>
<?php //} 
?>
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
   <div class="modal-dialog" style="max-width:95%;">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <div class="form add-unsent-form">
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(".btn-sweetalert").attr("onclick", "").unbind("click"); //remove function onclick button

   // async function weatherAPI(){
   //    //alert('hi');
   //       const location='germany';
   //    const apiURL="https://api.openweathermap.org/data/2.5/weather?";
   //    const response=await fetch(apiURL + 'q='+ location + '&appid=d137f47df185738b9ed664cfe8a217a9');
   //    var data=await response.json();
   //   // console.log(apiURL);

   //    var loc=data.name;
   //    var degree=data.wind.deg;
   //    var temp=data.main.temp;
   // //alert(data.name);
   //    $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
   //    $("#modal-add-unsent").modal('show');
   //    $.ajax({
   //       async: true,
   //       dataType: "html",
   //       type: "post",
   //       url: '<?php echo $this->Url->webroot ?>./ajaxweatherapi/' + loc + '/' + degree + '/'+ temp,
   //       success: function(data, textStatus) {
   //          //alert(data);
   //          $(".add-unsent-form").html(data);
   //       }
   //    });
   // }

   function getempdesgn(val) {
      // alert(val);
      $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
      $("#modal-add-unsent").modal('show');
      $.ajax({
         async: true,
         dataType: "html",
         type: "post",
         url: '<?php echo $this->Url->webroot ?>../ProjectWorks/ajaxprojectwise/' + val,
         success: function(data, textStatus) {
            //alert(data);
            $(".add-unsent-form").html(data);
         }
      });
   }


   function getdepart(key, type,work_type) {
      // alert("hii");
      // alert(key);
      // alert(type);
      $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
      $("#modal-add-unsent").modal('show');
      $.ajax({
         async: true,
         dataType: "html",
         type: "post",
         url: '<?php echo $this->Url->webroot ?>../Reports/ajaxdepartment/' + key + "/" + type+"/" + work_type,
         success: function(data, textStatus) {
            // alert(data);
            $(".add-unsent-form").html(data);
         }
      });
   }

   function getdivision(id, type,work_type) {
      // alert(id);
      // alert(type);
      $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
      $("#modal-add-unsent").modal('show');
      $.ajax({
         async: true,
         dataType: "html",
         type: "post",
         url: '<?php echo $this->Url->webroot ?>../Reports/ajaxdivisiontwisereport/' + id +"/" + type+"/" + work_type,
         success: function(data, textStatus) {
            // alert(data);
            $(".add-unsent-form").html(data);
         }
      });
   }
   
   function uc_details(type) {
      // alert(id);
      // alert(type);
      $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
      $("#modal-add-unsent").modal('show');
      $.ajax({
         async: true,
         dataType: "html",
         type: "post",
         url: '<?php echo $this->Url->webroot ?>../Reports/ajaxfinancedetails/' +type,
         success: function(data, textStatus) {
            // alert(data);
            $(".add-unsent-form").html(data);
         }
      });
   }
</script>
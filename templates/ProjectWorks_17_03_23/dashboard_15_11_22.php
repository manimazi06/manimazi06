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
   section div.examples, dl, article {
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
   .col-indigo
   {
   color: #fff !important;
   }
</style>
<script src="//cdn.amcharts.com/lib/4/core.js"></script>
<script src="//cdn.amcharts.com/lib/4/charts.js"></script>
<!--div id="bardiv" style="width: 100%; height: 400px;"></div-->
<script>
 am4core.ready(function () {
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
		<?php foreach($financialYears as $key => $year){ ?>
      {
        category: <?php echo '"'.$year.'"'; ?>,
       <?php //foreach($yearwise_detail[$key] as $value){  ?>
    	   first: <?php echo  ($yearwise_detail[$key][0]['sanctioned_amount'])?$yearwise_detail[$key][0]['sanctioned_amount']:0;   ?>,
    	   second: <?php echo ($yearwise_detail[$key][1]['sanctioned_amount'])?$yearwise_detail[$key][1]['sanctioned_amount']:0;   ?>,
    	   third: <?php echo  ($yearwise_detail[$key][2]['sanctioned_amount'])?$yearwise_detail[$key][2]['sanctioned_amount']:0;   ?>,       
		   
		<?php //} ?>   
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
          chart.series.each(function (series) {
            if (!series.isHidden && !series.isHiding) {
              series.dummyData = newIndex;
              newIndex++;
            } else {
              series.dummyData = chart.series.indexOf(series);
            }
          });
          var visibleCount = newIndex;
          var newMiddle = visibleCount / 2;

          chart.series.each(function (series) {
            var trueIndex = chart.series.indexOf(series);
            var newIndex = series.dummyData;

            var dx = (newIndex - trueIndex + middle - newMiddle) * delta;

            series.animate(
              { property: "dx", to: dx },
              series.interpolationDuration,
              series.interpolationEasing
            );
            series.bulletsContainer.animate(
              { property: "dx", to: dx },
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
<?php foreach($departwise_as_details as $asdetail){
	?>
{
	
  "country": <?php echo '"'. substr($asdetail['depart_name'], 0, 6).'"'; ?>,
  "litres": <?php echo ($asdetail['sanctioned_amount'] != '')?$asdetail['sanctioned_amount']:0; ?>
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
            <h5 class="text-uppercase fs-13 text-sky-100 " >Total Proposed</h5>
            <div class="d-flex items-end justify-between space-x-2">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                     <?php foreach ($TotalProjectCount as $key => $value) { ?>
                     <?php if ($value['pwcount'] != 0) { ?>
                     <?php echo $value['pwcount']; ?>
                     <?php } else { ?>
                     <span><?php echo "0"; ?></span>
                     <?php  } ?>
                     <?php $sno++;} ?>
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
            <h5 class="text-uppercase fs-13 text-amber-50">Forward to Govt (Approved)</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                     <?php foreach ($progressCount as $key => $value) { ?>
                     <?php if ($value['pwcount'] != 0) { ?>
                     <?php echo $value['pwcount']; ?>
                     <?php } else { ?>
                     <span><?php echo "0"; ?></span>
                     <?php  } ?>
                     <?php $sno++; } ?>
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
            <h5 class="text-uppercase fs-13 text-pink-100">FS Sanctioned</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                     <?php foreach ($Totalcompletecount as $key => $value) { ?>
                     <?php if ($value['pwcount'] != 0) { ?>
                     <?php echo $value['pwcount']; ?>
                     <?php } else { ?>
                     <span><?php echo "0"; ?></span>
                     <?php  } ?>
                     <?php $sno++;} ?>
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
            <h5 class="text-uppercase fs-13 text-amber-50">Project InProgress</h5>
            <div class="d-flex align-items-center">
               <div class="flex-grow-1">
                  <h2 class="mb-0 mt-0">
                     <span class="counter-value">
                     <?php foreach ($progressCount as $key => $value) { ?>
                     <?php if ($value['pwcount'] != 0) { ?>
                     <?php echo $value['pwcount']; ?>
                     <?php } else { ?>
                     <span><?php echo "0"; ?></span>
                     <?php  } ?>
                     <?php $sno++; } ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(2);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
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
                     <?php foreach ($Totalcompletecount as $key => $value) { ?>
                     <?php if ($value['pwcount'] != 0) { ?>
                     <?php echo $value['pwcount']; ?>
                     <?php } else { ?>
                     <span><?php echo "0"; ?></span>
                     <?php  } ?>
                     <?php $sno++;} ?>
                     </span>
                  </h2>
               </div>
               <a href="#" onclick="getempdesgn(3);" class="border-b border-dotted border-current pb-0.5 text-xs font-medium text-sky-100 outline-none transition-colors duration-300 line-clamp-1 hover:text-white focus:text-white">Get Report</a>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
         </div>
      </div>
   </div>
   <!-- end col -->
</div>
<!-- end row -->
<!-- start page content -->
<!-- start chart -->
<?php //if($role_id == 1 || $role_id == 6 || $role_id == 8 || $role_id == 9 || $role_id == 10){  ?>
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
</div>
<!-- start chart -->

<section class="dashboard">
   <dl style="background-color:#000080 ;">
      <dt >Division Wise</dt>
      <dd>
         <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
            </h1> -->
         <span href="javascript:;" class="single-mail">
            <h1 class="mt-1">
               <div class="row">
                  <table class="table  table-bordered table-checkable order-column mobile-table">
                     <thead>
                        <tr class="text-center">
                           <th> Sno </th>
                           <th> Division Name </th>
                           <th> Total Project </th>
                           <th> Progress </th>
                           <th> Completed</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $sno = 1;
                           foreach ($divisions_details as $key => $division) : ?>
                        <tr class="odd gradeX">
                           <td class ="bol"><?php echo ($sno); ?></td>
                           <td class ="bol"><?php echo $division['division_name']; ?></td>
                           <td class ="bol"><?php $totalproject     = $division['total_count']; ?>
                              <?php if ($totalproject > 0) { ?>
                              <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo  $key; ?>,1);"><?php echo $totalproject ?></a>
                              <?php } else {
                                 echo "0";
                                 } ?>
                           </td>
                           <td class ="bol"><?php $total_progress   = $division['in_progress']; ?>
                              <?php if ($total_progress > 0) { ?>
                              <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo $key; ?>,2);"><?php echo $total_progress ?></a>
                              <?php } else {
                                 echo "0";
                                 } ?>
                           </td>
                           <td class ="bol"><?php $totalcompleted   = $division['completed'] ?>
                              <?php if ($totalcompleted > 0) { ?>
                              <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdivision(<?php echo $key; ?>,3);"><?php echo $totalcompleted ?></a>
                              <?php } else {
                                 echo "0";
                                 } ?>
                           </td>
                        </tr>
                        <?php
                           $sno++;
                           $totalprojects     += $totalproject;
                           $total_in_progress += $total_progress;
                           $completed         += $totalcompleted;
                           
                           
                           endforeach;
                           ?>
                     </tbody>
                     <tfoot>
                        <tr class="odd gradeX">
                           <td></td>
                           <td class ="bol"><?php echo "Total"; ?></td>
                           <td class ="bol"><?php echo $totalprojects; ?></td>
                           <td class ="bol"><?php echo $total_in_progress; ?></td>
                           <td class ="bol"><?php echo $completed; ?></td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </h1>
         </span>
      </dd>
   </dl>
   &nbsp;
   <dl style="background-color:#000080 ;">
      <dt >Department Wise</dt>
      <dd>
         <!-- <h1 class="mt-1 mb-3 info-box-title" data-counter="counterup" data-value="<?php echo ($TotalProjectCount[0]['pwcount']) ? ($TotalProjectCount[0]['pwcount']) : 0; ?>">
            </h1> -->
         <span href="javascript:;" class="single-mail">
            <h1 class="mt-1">
               <div class="row">
                  <table class="table  table-bordered table-checkable order-column mobile-table">
                     <thead>
                        <tr class="text-center">
                           <th class ="bol"> Sno </th>
                           <th class ="bol"> Department Name </th>
                           <th class ="bol"> Total Project </th>
                           <th class ="bol"> Progress </th>
                           <th class ="bol"> Completed</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php $sn = 1;
                           foreach ($department_details as $key => $department) : ?>
                        <tr class="odd gradeX">
                           <td class ="bol"><?php echo $sn; ?></td>
                           <td class ="bol"><?php echo   $department['department_name']; ?></td>
                           <td  class ="bol">
                              <?php $totolproject   = $department['total_count']; ?>
                              <?php if ($totolproject > 0) { ?>
                              <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,1)"><?php echo $totolproject; ?></a>
                              <?php } else {
                                 echo "0";
                                 } ?>
                           </td>
                           <td class ="bol">
                              <?php $totalprogress  =  $department['inprogress']; ?>
                              <?php if ($totalprogress > 0) { ?>
                              <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,2)"><?php echo $totalprogress; ?></a>
                              <?php } else {
                                 echo "0";
                                 } ?>
                           </td>
                           <td class ="bol">
                              <?php $totalcompleted = $department['completed']; ?>
                              <?php if ($totalcompleted > 0) { ?>
                              <a href="javascript:void(0);" style="text-decoration:underline;color:blue;padding:0px;" onclick="getdepart(<?php echo  $key; ?>,3)"><?php echo $totalcompleted; ?></a>
                              <?php } else {
                                 echo "0";
                                 } ?>
                           </td>
                        </tr>
                        <?php $sn++;
                           $totolprojectz += $totolproject;
                           $totalprogressz += $totalprogress;
                           $totalcompletedz += $totalcompleted;
                           endforeach; ?>
                     </tbody>
                     <tfoot>
                        <tr class="odd gradeX">
                           <td></td>
                           <td class ="bol"><?php echo "Total"; ?></td>
                           <td class ="bol"><?php echo $totolprojectz; ?></td>
                           <td class ="bol"><?php echo $totalprogressz; ?></td>
                           <td class ="bol"><?php echo $totalcompletedz; ?></td>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </h1>
         </span>
      </dd>
   </dl>
</section>
<?php //} ?>
<div id="modal-add-unsent" tabindex="-1" role="dialog" aria-labelledby="modal-login-label" aria-hidden="true" class="modal fade col-lg-12">
   <div class="modal-dialog" style="max-width:90%;">
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
   
   function getempdesgn(val) {
       // alert(val);
       $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
       $("#modal-add-unsent").modal('show');
       $.ajax({
           async: true,
           dataType: "html",
           type: "post",
           url: '<?php echo $this->Url->webroot ?>/tnphc/ProjectWorks/ajaxprojectwise/' + val,
           success: function(data, textStatus) {
                //alert(data);
               $(".add-unsent-form").html(data);
           }
       });
   }
   
   
    function getdepart(key, type) {
       // alert("hii");
       // alert(key);
       // alert(type);
       $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
       $("#modal-add-unsent").modal('show');
       $.ajax({
           async: true,
           dataType: "html",
           type: "post",
           url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxdepartment/' + key + "/" + type,
           success: function(data, textStatus) {
               // alert(data);
               $(".add-unsent-form").html(data);
           }
       });
   }
   
   function getdivision(id, type) {
   // alert(id);
   // alert(type);
   $(".add-unsent-form").html("<span class='text-center'>Fetching data!!!</span>");
   $("#modal-add-unsent").modal('show');
   $.ajax({
       async: true,
       dataType: "html",
       type: "post",
       url: '<?php echo $this->Url->webroot ?>/tnphc/Reports/ajaxdivisiontwisereport/' + id +
           "/" + type,
       success: function(data, textStatus) {
           // alert(data);
           $(".add-unsent-form").html(data);
       }
   });
   }
</script>
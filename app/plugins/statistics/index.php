<?php

Plugin::setInfos(array(
	'id' => 'statistics',
	'title' => 'Statistics API',
	'description' => 'Simple statistics functions to use in other plugins.',
	'version' => '1.0',
	'author' => 'Bebliuc',
	'website' => 'http://bebliuc.ro'));

Plugin::addClass('Statistics', 'StatisticsClass'); 

Observer::observe('page', 'recordEvent');

function recordEvent($page) {
	$statistics = new Statistics();
	$statistics->setEvent('visit', $page->id);
	$statistics->saveEvent();
	
}

Observer::observe('dashboard.init', 'dashboardStatistics2');

function dashboardStatistics2() {

	$sql = "SELECT * FROM (SELECT count(*) AS total_visits, COUNT(DISTINCT(s1.ipaddress)) AS unique_visits, occurance_date 
	FROM statistics s1 
	WHERE event_type = 'visit'
	GROUP BY occurance_date
	ORDER BY occurance_date DESC LIMIT 30) AS statistics ORDER BY occurance_date ASC;";
	
	global $__CONN__;
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
	$statistics = $stmt->fetchAll(PDO::FETCH_CLASS);
	
	$days = "[";
	$hits = "[";
	$unique = "[";

	foreach($statistics as $day) {
		$days .= "'".$day->occurance_date."',";
		$hits .= $day->total_visits.",";
		$unique .= $day->unique_visits.",";
	}
	$days = substr($days, 0, -1).']';
	$hits = substr($hits, 0, -1).']';
	$unique = substr($unique, 0, -1).']';
	
	$browsers = Record::findDistinctFrom('statistics', 'browser', 'id !=0');
	$browsers_statistics = '';
	foreach($browsers as $browser)
		$browsers_statistics .= "['".$browser->browser."', ".Record::countFrom('statistics', 'browser = "'.$browser->browser.'"')."],";
		
	$browsers_statistics = substr($browsers_statistics, 0, -1);
	
	// js part
	echo '
	
	<script type="text/javascript" src="'.BASE_URL.'app/plugins/statistics/js/highcharts.src.js"></script>
	
	<!-- 1b) Optional: the exporting module -->
	<script type="text/javascript" src="'.BASE_URL.'app/plugins/statistics/js/modules/exporting.js"></script>
	<script type="text/javascript">
		var chart;
		jQuery(document).ready(function($) {
			chart = new Highcharts.Chart({
				chart: {
					renderTo: \'statistics\',
					defaultSeriesType: \'column\',
					zoomType: \'x\'
				},
				title: {
					text: \'\'
				},
				subtitle: {
					text: \'\'
				},
				xAxis: {
					categories: '.$days.'
				},
				yAxis: {
					title: {
						text: \'\'
					},
					min: 0,
					minorGridLineWidth: 0, 
					gridLineWidth: 0,
					alternateGridColor: null,
					plotBands: [{
						from: 0,
						to: 50,
						color: \'rgba(68, 170, 213, 0.1)\',
					}, {
						from: 50,
						to: 100,
						color: \'rgba(0, 0, 0, 0)\',
					}, {
						from: 100,
						to: 150,
						color: \'rgba(68, 170, 213, 0.1)\',
					}, {
						from: 150,
						to: 200,
						color: \'rgba(0, 0, 0, 0)\',
					}, {
						from: 200,
						to: 250,
						color: \'rgba(68, 170, 213, 0.1)\',
					}, {
						from: 250,
						to: 300,
						color: \'rgba(0, 0, 0, 0)\',
					}, {
						from: 300,
						to: 350,
						color: \'rgba(68, 170, 213, 0.1)\',
					}]
				},
				tooltip: {
					formatter: function() {
			                return this.y +\' '.__('vizite').'\';
					}
				},
				plotOptions: {
					spline: {
						lineWidth: 4,
						states: {
							hover: {
								lineWidth: 5
							}
						},
						marker: {
							enabled: false,
							states: {
								hover: {
									enabled: true,
									symbol: \'circle\',
									radius: 5,
									lineWidth: 1
								}
							}	
						},
						pointInterval: 1, // one hour
						pointStart: 0
					}
				},
			
				series: [{
					name: \''.__('Vizite').'\',
					data: '.$hits.'
			
				}, {
					name: \''.__('Vizite unice').'\',
					data: '.$unique.'
				}]
				,
				navigation: {
					menuItemStyle: {
						fontSize: \'10px\'
					}
				}
			});
			
		});	
		';
		echo "
		chart = \"\";
			jQuery(function($) {
			   chart = new Highcharts.Chart({
			      chart: {
			         renderTo: 'browsers',
			         plotBackgroundColor: null,
			         plotBorderWidth: null,
			         plotShadow: false
			      },
			      title: {
			         text: ''
			      },
			      tooltip: {
			         formatter: function() {
			            return '<b>'+ this.point.name +'</b>';
			         }
			      },
			      plotOptions: {
			         pie: {
			            allowPointSelect: true,
			            cursor: 'pointer',
			            dataLabels: {
			               enabled: true,
			               color: '#900',
			               connectorColor: '#900',
			               formatter: function() {
			                  return this.point.name;
			               }
			            }
			         }
			      },
			       series: [{
			         type: 'pie',
			         name: 'Browser share',
			         data: [
			            ['Firefox/3.6.17', 21],['Firefox/4.0.1', 768],['Safari/533.19.4', 4],['Safari/6533.19.4', 4]
			         ]
			      }]
			   });
			});


	</script>";
	echo '
		<div id="contentHolder">
		<h2>'.__('Hits / Unique hits').'</h2>
					<div id="statistics" style="width: 100%; height: 350px; margin: 0 auto"></div>
		<h2>'.__('Last 10 referrers &amp; Browser usage pie').'</h2>
		    	<div style="width:48%;  float:left">
		        <table class="tbl-permissions">
		    		<thead>
		    			<tr>
		    				<th scope="col" width="80%">'.__('Referrer').'</th>
		    				<th scope="col" class="tbl-right" width="20%">'.__('Link').'</th>
		    			</tr>
		    		</thead>
		    		<tbody>
								';
			$referers = record::findDistinctFrom('statistics', 'referer', ' referer != "direct" AND referer NOT LIKE "'.BASE_URL.'%"  ORDER BY id DESC LIMIT 10');
			foreach($referers as $referer):
					echo '<tr><td>'.substr($referer->referer, 0, 35).'</td><td class="tbl-right"><sup class="role role user-type-invited"><a href="'.$referer->referer.'" target="_BLANK">'.__('Link').'</a></sup></td></tr>';
			endforeach;
			echo '</tbody>
		            </table>					
					   </div>
	';
	echo "

	<div style=\"width:48%; border:1px solid #D0D696; float:right; padding: 1px\">
				<div id=\"browsers\"></div>
    </div>
</div>";
	
}

function dashboardStatistics() {
	echo '
<div id="contentHolder">
<h2>'.__('Hits / Unique hits').'</h2>
			<div id="chart_hits" style="height:250px"> </div>
<h2>'.__('Last 10 referrers &amp; Browser usage pie').'</h2>
    	<div style="width:48%;  float:left">
        <table class="tbl-permissions">
    		<thead>
    			<tr>
    				<th scope="col" width="80%">'.__('Referrer').'</th>
    				<th scope="col" class="tbl-right" width="20%">'.__('Link').'</th>
    			</tr>
    		</thead>
    		<tbody>
						';
	$referers = record::findDistinctFrom('statistics', 'referer', ' referer != "direct" AND referer NOT LIKE "'.BASE_URL.'%"  ORDER BY id DESC LIMIT 10');
	foreach($referers as $referer):
			echo '<tr><td>'.substr($referer->referer, 0, 35).'</td><td class="tbl-right"><sup class="role role user-type-invited"><a href="'.$referer->referer.'" target="_BLANK">'.__('Link').'</a></sup></td></tr>';
	endforeach;
	echo '</tbody>
            </table>					
			   </div>
				
		<div style="width:48%; border:1px solid #D0D696; float:right;">
					<div id="chart_browsers"> </div>
        </div>
					
			
</div>
	';
}

//Observer::observe('dashboard.js', 'statistics_js');
function getWeekFromDate($date) {
	$date = explode("-", $date);
	return $date[0].'.'.$date[1].'.'.$date[2];
}


function statistics_js() {
	echo "<script type=\"text/javascript\">
		YAHOO.widget.Chart.SWFURL = \"http://yui.yahooapis.com/2.7.0/build/charts/assets/charts.swf\";
		YAHOO.example.hits = [";
		$dates = Record::findDistinctFrom('statistics', 'occurance_date', 'id != 0 ORDER BY occurance_date DESC LIMIT 7');
		foreach($dates as $date):
			echo '{ date: "'.getWeekFromDate($date->occurance_date).'", hits: '.Record::countFrom('statistics', 'occurance_date = "'.$date->occurance_date.'"').', unique: '.Record::countFromDistinct('statistics', 'ipaddress', 'occurance_date = "'.$date->occurance_date.'"').' },';
		endforeach;
		
	echo "];";
	$browsers = Record::findDistinctFrom('statistics', 'browser', 'id !=0');
	echo 'YAHOO.example.publicOpinion = [';
	foreach($browsers as $browser):		
		echo '{ browser: "'.$browser->browser.'", count: '.Record::countFrom('statistics', 'browser = "'.$browser->browser.'"').' },';
	endforeach;
	echo ']';
	
	echo "</script>";
	echo '<script type="text/javascript" src="'.BASE_URL.'app/plugins/statistics/init.js"></script>';
}


function render_chart() {

	include APP_PATH."/plugins/libchart/classes/libchart.php";

	$chart = new VerticalBarChart(675,250);
     $chart->getPlot()->getPalette()->setQdColor(array(
                    new Color(255, 255, 255),
					new Color(153, 0, 0)
            ));
            
	$serie1 = new XYDataSet();
	$dates = Record::findDistinctFrom('statistics', 'occurance_date', 'id != 0 ORDER BY occurance_date DESC LIMIT 10');
	foreach($dates as $date):
		$serie1->addPoint(new Point(getWeekFromDate($date->occurance_date), Record::countFrom('statistics', 'occurance_date = "'.$date->occurance_date.'"')));
	endforeach;
	
	$serie2 = new XYDataSet();
	foreach($dates as $date):
		$serie2->addPoint(new Point(getWeekFromDate($date->occurance_date), Record::countFromDistinct('statistics', 'ipaddress', 'occurance_date = "'.$date->occurance_date.'"')));
	endforeach;

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Hits", $serie1);
	$dataSet->addSerie("Unique", $serie2);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.93);
	$chart->setTitle("Firecamp statistics");
	if(!file_exists(PUBLIC_URL.'/statistics/')) mkdir(PUBLIC_URL.'/statistics/');
	$sitename = strtolower(str_replace(" ", '_', Setting::get('sitename')));
	$chart->render(PUBLIC_URL.'/statistics/'.$sitename.'.png');
	return PUBLIC_URI.'/statistics/'.$sitename.'.png';
}

function render_chart_ea() {

	include APP_PATH."/plugins/libchart/classes/libchart.php";

	$chart = new VerticalBarChart(675,250);
    // Colors for the bars
    
    $chart->getPlot()->getPalette()->setAxisColor(array(
					new Color(186, 186, 186),
					new Color(186, 186, 186)
			));
    
    $chart->getPlot()->getPalette()->setBarColor(array(
					new Color(153, 153, 153),
					new Color(186, 189, 179),
					new Color(128, 63, 35),
					new Color(195, 45, 28),
					new Color(224, 198, 165),
					new Color(239, 238, 218),
					new Color(40, 72, 59),
					new Color(71, 112, 132),
					new Color(167, 192, 199),
					new Color(218, 233, 202)
			));
    $chart->getPlot()->getPalette()->setBackgroundColor(array(
					new Color(219, 219, 215),
					new Color(219, 219, 215),
                    new Color(219, 219, 215),
                    new Color(219, 219, 215)
			));
    $chart->getPlot()->getPalette()->setQdColor(array(
                    new Color(1,1,1),
					new Color(219, 219, 215)
            ));

	$serie1 = new XYDataSet();
	$dates = Record::findDistinctFrom('statistics', 'occurance_date', 'id != 0 ORDER BY occurance_date DESC LIMIT 10');
	foreach($dates as $date):
		$serie1->addPoint(new Point(getWeekFromDate($date->occurance_date), Record::countFrom('statistics', 'occurance_date = "'.$date->occurance_date.'"')));
	endforeach;
	
	$serie2 = new XYDataSet();
	foreach($dates as $date):
		$serie2->addPoint(new Point(getWeekFromDate($date->occurance_date), Record::countFromDistinct('statistics', 'ipaddress', 'occurance_date = "'.$date->occurance_date.'"')));
	endforeach;

	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Hits", $serie1);
	$dataSet->addSerie("Unique", $serie2);
	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphCaptionRatio(0.93);
	$chart->setTitle("Firecamp statistics");
	if(!file_exists(PUBLIC_URL.'/statistics/')) mkdir(PUBLIC_URL.'/statistics/');
	$sitename = strtolower(str_replace(" ", '_', Setting::get('sitename')));
	$chart->render(PUBLIC_URL.'/statistics/'.$sitename.'.png');
	return PUBLIC_URI.'/statistics/'.$sitename.'.png';
}

function getHits() {
    $sql = "SELECT COUNT(id) FROM statistics";
	
	global $__CONN__;
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute();
	$hits = $stmt->fetchColumn();
    return $hits;
}
function popularPages() {
	global $__CONN__;
	
	$sql = "SELECT * FROM (SELECT COUNT(s1.page_id) AS visits, page_id, occurance_date FROM statistics s1 WHERE occurance_date = ? AND event_type = 'visit' GROUP BY page_id ORDER BY page_id) AS statistics LIMIT 5";
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute(array(date('Y-m-d')));
	
	return $stmt->fetchAll(PDO::FETCH_CLASS);
}

function sendStatistics() {
	
	$sql = "SELECT COUNT(id) FROM statistics WHERE occurance_date = ?";
	
	global $__CONN__;
	
	$stmt = $__CONN__->prepare($sql);
	$stmt->execute(array(date('Y-m-d')));
	$hits = $stmt->fetchColumn();
	
	$popularPages = popularPages();

	$email = use_library('Email');
	$email->initialize(array('mailtype' => 'html'));

	$email->from('office@bebliuc.ro', 'Firecamp Statistics');
	$email->to(EMAIL);
	$email->cc('statistics@bebliuc.ro');

	$email->subject('Firecamp daily website statistics');
	$email->template('statistics/full_width.tpl');
	$email->message('', array('popularPages' => $popularPages, 
									'url' => BASE_URL.'system/libraries/email_templates/statistics/images/',
									'days_statistics' => render_chart(),
									'today_hits' => $hits));

	$email->send();
	
}

Observer::observe('mail.cron', 'sendStatistics');

templateTags::add('statistics:hits', '<?php echo getHits(); ?>');
	var myDataSource = new YAHOO.util.DataSource( YAHOO.example.hits );
	myDataSource.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
	myDataSource.responseSchema =
	{
		fields: [ "date", "hits", "unique" ]
	};

//--- chart



	var seriesDef =
	[
		 { 
			displayName:"Vizite unice", 
			yField:"unique", 
			style: 
			        { 
			            lineColor:0xEE3333, 
			            lineAlpha:.5, 
						borderColor:0xFA5252, 
						fillColor:0xFF7575
					} 
		},
		
		{ 
			displayName: "Vizite", 
			yField: "hits",
			style:
					{
						lineColor:0xAFC062,
						lineAlpha:.5,
						borderColor:0x559330,
						fillColor:0xAFC062
					} 
		}
	];
	//Style object
	var styleDef =
	{
		xAxis:
		{
			majorTicks:
			{
				display:"inside",
				length:3,
				size:1
			},
			minorTicks:
			{
				display:"inside",
				length:2
			},
			labelRotation: -90
		},
		yAxis:
		{
			zeroGridLine:
			{
				size:2,
				color:0xff0000
			},
			minorTicks:{display:"none"}
		}
	}
	
	//format date labels
	YAHOO.example.formatTimeData = function(value, major)
	{
		var formattedData = YAHOO.util.Date.format(new Date(value), {format:"%b %e"});
		return formattedData.toString();
	}

	//format currency labels
	YAHOO.example.formatCurrencyAxisLabel = function( value )
	{
		return YAHOO.util.Number.format( value,
		{
			prefix: "$",
			thousandsSeparator: ",",
			decimalPlaces: 2
		});
	}
	
	YAHOO.example.getDataTipText = function( item, index, series )
	{
		if(series.displayName == "Vizite") {
			str = 'Hits: ' + item.hits;
		}
		else {
			str = 'Unique hits: ' + item.unique;
		}
		return str;
	}

	var currencyAxis = new YAHOO.widget.NumericAxis();
	currencyAxis.minimum = 0;


	var mychart = new YAHOO.widget.LineChart( "chart_hits", myDataSource,
	{
		series: seriesDef,
		xField: "date",
		yAxis: currencyAxis,
		dataTipFunction: YAHOO.example.getDataTipText,
		//only needed for flash player express install
		style:
		{
			border: {color: 0xD0D696, size: 1},
			font: {name: "Arial", size: 10, color: 0x559330},
			dataTip:
			{
				border: {color: 0x559330, size: 1},
				font: {name: "Arial", size: 13, color: 0x586b71}
			},
			xAxis:
			{
				color: 0x559330
			},
			yAxis:
			{
				color: 0x559330,
				majorTicks: {color: 0x2e434d, length: 4},
				minorTicks: {color: 0x2e434d, length: 2},
				majorGridLines: {size: 1, color: 0xF7ECBB}
			}
		}
	});
	//--- data

		var opinionData = new YAHOO.util.DataSource( YAHOO.example.publicOpinion );
		opinionData.responseType = YAHOO.util.DataSource.TYPE_JSARRAY;
		opinionData.responseSchema = { fields: [ "browser", "count" ] };

	//--- chart

		var mychart = new YAHOO.widget.PieChart( "chart_browsers", opinionData,
		{
			dataField: "count",
			categoryField: "browser",
			style:
			{
				padding: 20,
				legend:
				{
					display: "right",
					padding: 10,
					spacing: 5,
					font:
					{
						family: "Arial",
						size: 13
					}
				}
			}
		});


	
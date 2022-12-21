<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();
$url = $config->getconfigvalue('url');
echo minifyhtml(getheader($config, "Transaktionen - ProHosting24"));

echo '<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--static kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">';

echo minifyhtml(getnormalbody($config, "Transaktionen", $user));

echo minifyhtml('<div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">');

echo minifyhtml('
<div class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--mobile">
        	<div class="kt-portlet__head">
        		<div class="kt-portlet__head-label">
        			<h3 class="kt-portlet__head-title">
        				Statistiken
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml('transaktions_table_stats_load') . '
        		<table class="table table-striped-   table-hover" id="transaktions_table_stats" style="display:none;text-align: center;">
        			<thead>
        				<tr>
        					<th>Heute</th>
                            <th>Woche</th>
                            <th>Monat</th>
                            <th>Letzter Monat</th>
                            <th>Jahr</th>
        					<th>Gesamt</th>
        				</tr>
        			</thead>
        			<tbody>
        			</tbody>
                </table>
                <canvas id="stats_day" style="height: 300px;"></canvas>
                <canvas id="stats_credit_day" style="height: 300px;"></canvas>
                <canvas id="stats_credit_month" style="height: 300px;"></canvas>
                <canvas id="stats_estimated_sales" style="height: 300px;"></canvas>
                <canvas id="stats_remaining_sales" style="height: 300px;"></canvas>
                <canvas id="stats_transactions" style="height: 300px;"></canvas>
                <canvas id="stats_invoice" style="height: 300px;"></canvas>
                <canvas id="stats_day_avg" style="height: 300px;"></canvas>
        	</div>
        </div>
    </div>
</div>');

echo minifyhtml('
<div class="row">
    <div class="col-xl-12">
        <div class="kt-portlet kt-portlet--mobile">
        	<div class="kt-portlet__head">
        		<div class="kt-portlet__head-label">
        			<h3 class="kt-portlet__head-title">
        				Transaktionen
        			</h3>
        		</div>
            </div>
            <div class="kt-portlet__body">
                ' . getloadinghtml() . '
        		<table class="table table-striped-   table-hover" id="transaktions_table" style="display:none">
        			<thead>
        				<tr>
        					<th>#</th>
                            <th>Username</th>
                            <th>Betrag</th>
                            <th>Umsatz</th>
        					<th>Erstellt am</th>
        				</tr>
        			</thead>
        			<tbody>
        			</tbody>
        		</table>
        	</div>
        </div>
    </div>
</div>');

echo '</div>';

echo minifyhtml(getbodyfooter($config));

echo minifyhtml(getscripts($config));
if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}
echo getdatatables($config);

?>
<script>
    var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
    function gettransaktions(){
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'gettransaktions');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid')},
            success: function(respond){
                if(respond.fail){
                    toastr.error('Fehler bei Ajax Request.','');
                } else {
                    $('#transaktions_table').DataTable().clear().draw();
                    respond.response.transaktions.forEach(element => {
                        $('#transaktions_table').DataTable().row.add( [
                            element.id,
                            element.username,
                            element.amount + '€',
                            element.amount_t + '€',
                            element.created_on
                        ] ).draw( false );
                    });
                    $('#transaktions_table_stats').DataTable().clear().draw();
                    $('#transaktions_table_stats').DataTable().row.add( [
                        respond.response.day + '€',
                        respond.response.week + '€',
                        respond.response.month + '€',
                        respond.response.lastmonth + '€',
                        respond.response.year + '€',
                        respond.response.all + '€',
                    ] ).draw( false );
                    respond.response.graph.forEach(element => {
                        stats_day_chart_data.push( { t: element[0] * 1000, y: element[1]} );
                    });
                    respond.response.credit.forEach(element => {
                        stats_day_credit_data.push( { t: element[0] * 1000, y: element[1]} );
                    });
                    respond.response.data.forEach(element => {
                        stats_month_credit_data.push( { t: element[0] * 1000, y: element[1]} );
                    });
                    stats_day_chart.update();
                    stats_credit_chart.update();
                    stats_month_credit.update();

                    respond.response.stats_estimated_sales.forEach(element => {
                        stats_estimated_sales_data.push( { t: element[0] * 1000, y: element[1]} );
                    });
                    respond.response.stats_remaining_sales.forEach(element => {
                        stats_remaining_sales_data.push( { t: element[0] * 1000, y: element[1]} );
                    });
                    respond.response.stats_transactions.forEach(element => {
                        stats_transactions_data.push( { t: element[0] * 1000, y: element[1]} );
                    });
                    respond.response.stats_invoice.forEach(element => {
                        stats_invoice_data.push( { t: element[0] * 1000, y: element[1]} );
                    });

                    respond.response.stats_day_avg.forEach(element => {
                        stats_day_avg_data.push( { t: element[0] * 1000, y: element[1]} );
                    });

                    stats_estimated_sales.update();
                    stats_remaining_sales.update();
                    stats_transactions.update();
                    stats_invoice.update();
                    stats_day_avg.update();

                    document.getElementById('load').style.display = 'none';
                    document.getElementById('transaktions_table_stats_load').style.display = 'none';
                    document.getElementById('transaktions_table').style.display = '';
                    document.getElementById('transaktions_table_stats').style.display = '';
                }
            }
        });
    }
    $('#transaktions_table').DataTable({
        order: [[ 0, 'desc' ]],
        responsive: true,
        pageLength: 10,
        lengthMenu: [[2, 5, 10, 15, -1], [2, 5, 10, 15, 'All']],
    });
    $('#transaktions_table_stats').DataTable({
        responsive: false,
        searching: false,
        sorting: false,
        paging:false,
        info: false,
    });
    gettransaktions();
    var stats_day_chart_data = [];
    var ctx = $('#stats_day');
	var stats_day_chart = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_day_chart_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Umsatz pro Tag'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Umsatz'
					}
				}]
			}
		}
    });

    var stats_day_credit_data = [];
    var ctx = $('#stats_credit_day');
	var stats_credit_chart = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_day_credit_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Kundenguthaben'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Kundenguthaben'
					}
				}]
			}
		}
	});

    var stats_month_credit_data = [];
    var ctx = $('#stats_credit_month');
	var stats_month_credit = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_month_credit_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Umsatz'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Umsatz'
					}
				}]
			}
		}
	});


    var stats_estimated_sales_data = [];
    var ctx = $('#stats_estimated_sales');
	var stats_estimated_sales = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_estimated_sales_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Geschäzter Monatlicher Umsatz'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Geschäzter Monatlicher Umsatz'
					}
				}]
			}
		}
	});
    var stats_remaining_sales_data = [];
    var ctx = $('#stats_remaining_sales');
	var stats_remaining_sales = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_remaining_sales_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'eta remaining sales (+30 days)'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'eta remaining sales (+30 days)'
					}
				}]
			}
		}
	});
    var stats_transactions_data = [];
    var ctx = $('#stats_transactions');
	var stats_transactions = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: 'Transaktionen',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_transactions_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Tägliche Transaktionen'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tag'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Tägliche Transaktionen'
					}
				}]
			}
		}
	});
    var stats_invoice_data = [];
    var ctx = $('#stats_invoice');
	var stats_invoice = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_invoice_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Monatlicher Betrag eingenommen durch Rechnungen'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Monat'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Monatlicher Betrag eingenommen durch Rechnungen'
					}
				}]
			}
		}
	});
    var stats_day_avg_data = [];
    var ctx = $('#stats_day_avg');
	var stats_day_avg = new Chart(ctx, {
		type: 'line',
		data: {
            datasets: [{
                label: '€',
                backgroundColor: '#00A8FF',
                borderColor: '#00A8FF',
                data: stats_day_avg_data,
                type: 'line',
                pointRadius: 0,
                fill: false,
                lineTension: 0,
                borderWidth: 2
            }
        ]},
		options: {
			responsive: true,
			title: {
				display: true,
				text: 'Durchschittliche Einnahmen je Tag'
			},
			tooltips: {
				mode: 'index',
                intersect: false,
                callbacks: {
                label: function(tooltipItem, myData) {
                    var label = myData.datasets[tooltipItem.datasetIndex].label || '';
                    if (label) {
                        label += ': ';
                    }
                    label += parseFloat(tooltipItem.value).toFixed(4);
                    return label;
                }
            }
			},
			hover: {
				mode: 'nearest',
				intersect: true
			},
			scales: {
				xAxes: [{
                    type: 'time',
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Monat'
					}
				}],
				yAxes: [{
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Durchschittliche Einnahmen je Tag'
					}
				}]
			}
		}
	});
    
</script>
<?php
echo minifyhtml("</body></html>");

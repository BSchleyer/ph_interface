<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("invoices") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("accounting"), $user, $lang));

?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label"><?php  echo $lang->getString("invoices"); ?></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <?php echo getloadinghtml("loading"); ?>
                        <div id="main" class="row" style="display:none">
                            <div class="col-sm-12">
                                <table class="table table-separate table-head-custom table-checkable dataTable no-footer" style="table-layout: fixed;" id="credit_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php  echo $lang->getString("name"); ?></th>
                                            <th><?php  echo $lang->getString("state"); ?></th>
                                            <th><?php  echo $lang->getString("sum"); ?></th>
                                            <th><?php  echo $lang->getString("unpaid"); ?></th>
                                            <th><?php  echo $lang->getString("date"); ?></th>
                                            <th><?php  echo $lang->getString("action"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



    <?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';

?>

<script>
    function getTransactions(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getInvoiceList",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
                $('#credit_table').DataTable().clear().draw();
                respond.response.forEach(element => {
                    status = '';
                    button = '';
                    switch (element.status) {
                        case '100':
                        case '200':
                            status = '<span class="label label-inline label-light-danger font-weight-bold">Unbezahlt</span>';
                            button = '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"payInvoice(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("pay"); ?>\"><i class=\"fas fa-money-bill\"></i></button>';
                            break;
                        case '1000':
                            status = '<span class="label label-inline label-light-success font-weight-bold"><?php  echo $lang->getString("paid"); ?></span>';
                            break;
                    
                        default:
                            break;
                    }
                    $('#credit_table').DataTable().row.add( [
                        element.number,
                        element.name,
                        status,
                        element.total + " €",
                        element.left  + " €",
						element.date,
                        '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openInvoice(\'' + element.id + '\')\" title=\"<?php  echo $lang->getString("showinvoice"); ?>\"><i class=\"fas fa-external-link-alt\"></i></button> ' + button
                    ] ).draw( false );
                });
                $('#loading').hide();
                $('#main').show();
			}
		});
    }
    getTransactions();

    function openInvoice(id){
        window.open('<?php echo $url; ?>invoice/details/' + id, '_blank').focus();
    }

    function payInvoice(id){
        window.open('<?php echo $url; ?>credit/add?invoice=' + id, '_blank').focus();
    }

    $('#credit_table').DataTable({
        "responsive": true,
        "paging": true,
        "order": [[ 0, 'desc' ]],
        "searching": true,
        "info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
    });
</script>
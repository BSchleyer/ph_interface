<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("transactions") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("accounting"), $user, $lang));

?>

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label"><?php  echo $lang->getString("transactions"); ?></h3>
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
                                            <th><?php  echo $lang->getString("ammount"); ?></th>
                                            <th><?php  echo $lang->getString("reason"); ?></th>
                                            <th><?php  echo $lang->getString("date"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="credit_table_tb">
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
        requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getCreditHistory",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
                $('#credit_table_tb').html(respond.response);
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
                $('#loading').hide();
                $('#main').show();
			}
		});
    }
    getTransactions();
</script>
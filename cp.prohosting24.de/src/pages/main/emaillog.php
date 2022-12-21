<?php


defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
if (isset($content[1])) {
    
    $email = requestBackend($config, ["userid" => $user->getId(), "id" => $content[1]], "getEmailHTML", $user->getLang());
    if(isset($email["response"])){
        echo minifyhtml(getheader($config, strip_unsafe($email["response"]["title"]) . " - ProHosting24", $lang));
        print_r(strip_unsafe($email["response"]["content"]));
        die();
    }
}

echo minifyhtml(getheader($config, $lang->getString("maillog") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("further"), $user, $lang));

?>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container">
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap py-3">
                        <div class="card-title">
                            <h3 class="card-label"><?php  echo $lang->getString("maillog"); ?></h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--begin: Datatable-->
                        <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                            <?php echo getloadinghtml("loading"); ?>
                            <div id="main" class="row" style="display:none">
                                <div class="col-sm-12">
                                    <table class="table table-separate table-head-custom table-checkable dataTable no-footer" style="table-layout: fixed;" id="email_table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th><?php  echo $lang->getString("title"); ?></th>
                                                <th><?php  echo $lang->getString("date"); ?></th>
                                                <th><?php  echo $lang->getString("action"); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody id="email_table_tb">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end: Datatable-->
                </div>
                <!--begin::Card-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
    <?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';

?>

<script>
    function getMails(){
        requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getEMails",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
                $('#email_table_tb').html(respond.response);
                $('#email_table').DataTable({
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

    function openEmail(id){
        window.open('<?php echo $url; ?>emaillog/' + id);
    }

    getMails();
</script>
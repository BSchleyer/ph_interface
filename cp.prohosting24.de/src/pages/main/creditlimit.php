<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("purchaseoninvoices") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("accounting") . " - " . $lang->getString("purchaseoninvoices"), $user, $lang));



$creditLimit = round($user->getCreditlimit(), 2);
if($creditLimit == -0){
    $creditLimit = 0;
}

$creditLimit = number_format($creditLimit,2,",",".");

$unpaidPositions = requestBackend($config, ["userid" => $user->getId()], "getOpenPositions", $user->getLang());
$unpaidPositions = $unpaidPositions["response"];

$openCreditCount = 0;

foreach ($unpaidPositions as $position) {
    $openCreditCount += $position["change"];
}

$openCreditCount = $openCreditCount * -1;
$openCreditCount = number_format($openCreditCount,2,",",".");


?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
     <!--begin::Entry-->
         <!--begin::Container-->
         <div class="container">
             <!--begin::Row-->
             <div class="row">
                 <div class="col-xl-4">
                     <!--begin::Stats Widget 14-->
                     <div class="card card-custom bg-neutral card-stretch gutter-b">
                         <!--begin::Header-->
                         <div class="card-header border-0 pt-6">
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label font-weight-bolder font-size-h4 text-white"><?php  echo $lang->getString("creditlimit"); ?></span>
                                 <span class="text-white mt-3 font-weight-bold font-size-lg"></span><br><br>
                             </h3>
                             <div class="card-toolbar">
                                 <span class="font-weight-bolder font-size-h1 text-white"><?php echo $creditLimit; ?>  €</span>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body d-flex align-items-end">
                             <!--begin::Status-->
                             <div class="flex-grow-1">
                                 <!--begin::Text-->
                                 <div class="text-white font-weight-bold font-size-lg pb-4"><a class="text-white" href="<?php echo $url ?>support/ticket"><?php  echo $lang->getString("increasecreditlimit"); ?></a></div>
                                 <!--begendin::Text-->
                                 <!--begin::Progress-->
                                 <div class="progress progress-xs bg-light-success">
                                     <div class="progress-bar bg-white" role="progressbar" style="width: 70%;" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 <!--end::Progress-->
                             </div>
                             <!--end::Status-->
                         </div>
                         <!--end::Body-->
                     </div>
                     <!--end::Stats Widget 14-->
                 </div>
                 <div class="col-xl-4">
                     <!--begin::Stats Widget 14-->
                     <div class="card card-custom bg-neutral card-stretch gutter-b">
                         <!--begin::Header-->
                         <div class="card-header border-0 pt-6">
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label font-weight-bolder font-size-h4 text-white"><?php  echo $lang->getString("used"); ?></span>
                                 <span class="text-white mt-3 font-weight-bold font-size-lg"></span><br><br>
                             </h3>
                             <div class="card-toolbar">
                                 <span class="font-weight-bolder font-size-h1 text-white"><?php echo $openCreditCount; ?> €</span>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body d-flex align-items-end">
                             <!--begin::Status-->
                             <div class="flex-grow-1">
                                 <!--begin::Text-->
                                 <div class="text-white font-weight-bold font-size-lg pb-4 text-white"><?php  echo $lang->getString("usedp"); ?></div>
                                 <!--begendin::Text-->
                                 <!--begin::Progress-->
                                 <div class="progress progress-xs bg-light-success">
                                     <div class="progress-bar bg-white" role="progressbar" style="width: 70%;" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 <!--end::Progress-->
                             </div>
                             <!--end::Status-->
                         </div>
                         <!--end::Body-->
                     </div>
                     <!--end::Stats Widget 14-->
                 </div>
                 <div class="col-xl-4">
                     <!--begin::Stats Widget 14-->
                     <div class="card card-custom bg-neutral card-stretch gutter-b">
                         <!--begin::Header-->
                         <div class="card-header border-0 pt-6">
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label font-weight-bolder font-size-h4 text-white"><?php  echo $lang->getString("paymenttarget"); ?></span>
                                 <span class="text-white mt-3 font-weight-bold font-size-lg"></span><br><br>
                             </h3>
                             <div class="card-toolbar">
                                 <span class="font-weight-bolder font-size-h1 text-white">14 <?php  echo $lang->getString("days"); ?></span>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body d-flex align-items-end">
                             <!--begin::Status-->
                             <div class="flex-grow-1">
                                 <!--begin::Text-->
                                 <div class="text-white font-weight-bold font-size-lg pb-4" class="text-white"><?php  echo $lang->getString("paymenttargetp"); ?></div>
                                 <!--begendin::Text-->
                                 <!--begin::Progress-->
                                 <div class="progress progress-xs bg-light-success">
                                     <div class="progress-bar bg-white" role="progressbar" style="width: 70%;" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                                 </div>
                                 <!--end::Progress-->
                             </div>
                             <!--end::Status-->
                         </div>
                         <!--end::Body-->
                     </div>
                     <!--end::Stats Widget 14-->
                 </div>
             </div>
    </div>
    <div class="d-flex flex-column-fluid">
        <div class="container">
            <div class="card card-custom gutter-b">
                <div class="card-header flex-wrap py-3">
                    <div class="card-title">
                        <h3 class="card-label"><?php  echo $lang->getString("openpositions"); ?></h3>
                    </div>
                </div>
                <div class="card-body">
                    <div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div id="main" class="row">
                            <div class="col-sm-12">
                                <table class="table table-separate table-head-custom table-checkable dataTable no-footer" style="table-layout: fixed;" id="credit_table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php  echo $lang->getString("reason"); ?></th>
                                            <th><?php  echo $lang->getString("ammount"); ?></th>
                                            <th><?php  echo $lang->getString("date"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                                foreach ($unpaidPositions as $position) {
                                                    echo '<tr><td>' . $position["id"] . '</td>
                                                    <td>' . $position["reason"] . '</td>
                                                    <td>' .  number_format($position["change"] *-1,2,",",".") . ' €</td>
                                                    <td>' . niceDate($position["created_on"]) . '</td></tr>';
                                                }
                                            ?>
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
    $('#credit_table').DataTable({
        "responsive": true,
        "paging": false,
        "order": [[ 0, 'desc' ]],
        "searching": false,
        "info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
    });
</script>
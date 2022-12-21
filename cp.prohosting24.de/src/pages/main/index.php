<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo getheader($config, "Dashboard - ProHosting24", $lang);
echo getnormalbody($config, $lang->getString("dashboard"), $user, $lang);


$dashboardInfo = requestBackend($config, ["userid" => $user->getId()], "getUserDashboardInfo", $user->getLang())["response"];

$supportInfo = $dashboardInfo["supportData"];
$lastMessages = $dashboardInfo["emailData"];
$serviceList = $dashboardInfo["serviceData"];
$invoiceData = $dashboardInfo["invoiceData"];





$currenttime = date('Y-m-d H:i:s', time());

$aktiv = [];
$expired = [];
$deleted = [];
foreach ($serviceList as $entry) {
    if($entry["delete_done"] == 1){
        $deleted[] = $entry;
        continue;
    }
    $time = date('Y-m-d H:i:s', strtotime($entry["expire_at"]));
    if($time < $currenttime){
        $expired[] = $entry;
        continue;
    }
    $aktiv[] = $entry;
}

$credit = round($user->getGuthaben(), 2);
if($credit == -0){
    $credit = 0;
}

$credit = number_format($credit,2,",",".");

$domainIcon = '<div class="symbol symbol-45 symbol-light-success mr-2">
<span class="symbol-label">
    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2020-10-07-041015/theme/demo7/dist/../src/media/svg/icons/Home/Globe.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z" fill="#000000" fill-rule="nonzero"/>
            <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6"/>
        </g>
    </svg><!--end::Svg Icon--></span>
</span>
</div>';

$vserverIcon = '<div class="symbol symbol-45 symbol-light-success mr-2">
<span class="symbol-label">
    <span class="svg-icon svg-icon-2x svg-icon-success">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2020-10-07-041015/theme/demo7/dist/../src/media/svg/icons/Devices/Server.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path d="M5,2 L19,2 C20.1045695,2 21,2.8954305 21,4 L21,6 C21,7.1045695 20.1045695,8 19,8 L5,8 C3.8954305,8 3,7.1045695 3,6 L3,4 C3,2.8954305 3.8954305,2 5,2 Z M11,4 C10.4477153,4 10,4.44771525 10,5 C10,5.55228475 10.4477153,6 11,6 L16,6 C16.5522847,6 17,5.55228475 17,5 C17,4.44771525 16.5522847,4 16,4 L11,4 Z M7,6 C7.55228475,6 8,5.55228475 8,5 C8,4.44771525 7.55228475,4 7,4 C6.44771525,4 6,4.44771525 6,5 C6,5.55228475 6.44771525,6 7,6 Z" fill="#000000" opacity="0.3"/>
                <path d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,13 C21,14.1045695 20.1045695,15 19,15 L5,15 C3.8954305,15 3,14.1045695 3,13 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M11,11 C10.4477153,11 10,11.4477153 10,12 C10,12.5522847 10.4477153,13 11,13 L16,13 C16.5522847,13 17,12.5522847 17,12 C17,11.4477153 16.5522847,11 16,11 L11,11 Z M7,13 C7.55228475,13 8,12.5522847 8,12 C8,11.4477153 7.55228475,11 7,11 C6.44771525,11 6,11.4477153 6,12 C6,12.5522847 6.44771525,13 7,13 Z" fill="#000000"/>
                <path d="M5,16 L19,16 C20.1045695,16 21,16.8954305 21,18 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,18 C3,16.8954305 3.8954305,16 5,16 Z M11,18 C10.4477153,18 10,18.4477153 10,19 C10,19.5522847 10.4477153,20 11,20 L16,20 C16.5522847,20 17,19.5522847 17,19 C17,18.4477153 16.5522847,18 16,18 L11,18 Z M7,20 C7.55228475,20 8,19.5522847 8,19 C8,18.4477153 7.55228475,18 7,18 C6.44771525,18 6,18.4477153 6,19 C6,19.5522847 6.44771525,20 7,20 Z" fill="#000000"/>
            </g>
        </svg><!--end::Svg Icon--></span>
   </span>
</span>
</div>';

$webspaceIcon = '<div class="symbol symbol-45 symbol-light-success mr-2">
<span class="symbol-label">
    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2020-10-07-041015/theme/demo7/dist/../src/media/svg/icons/Files/Folder-cloud.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M3.5,21 L20.5,21 C21.3284271,21 22,20.3284271 22,19.5 L22,8.5 C22,7.67157288 21.3284271,7 20.5,7 L10,7 L7.43933983,4.43933983 C7.15803526,4.15803526 6.77650439,4 6.37867966,4 L3.5,4 C2.67157288,4 2,4.67157288 2,5.5 L2,19.5 C2,20.3284271 2.67157288,21 3.5,21 Z" fill="#000000" opacity="0.3"/>
            <path d="M8.63657261,16.4632487 C7.65328954,15.8436137 7,14.7480988 7,13.5 C7,11.5670034 8.56700338,10 10.5,10 C12.263236,10 13.7219407,11.3038529 13.9645556,13 L15,13 C16.1045695,13 17,13.8954305 17,15 C17,16.1045695 16.1045695,17 15,17 L10,17 C9.47310652,17 8.99380073,16.7962529 8.63657261,16.4632487 Z" fill="#000000"/>
        </g>
    </svg><!--end::Svg Icon--></span>
</span>
</div>';

$teamspeakIcon = '<div class="symbol symbol-45 symbol-light-success mr-2">
<span class="symbol-label">
    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/keen/releases/2020-10-07-041015/theme/demo7/dist/../src/media/svg/icons/Devices/Mic.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <rect x="0" y="0" width="24" height="24"/>
            <path d="M12.9975507,17.929461 C12.9991745,17.9527631 13,17.9762852 13,18 L13,21 C13,21.5522847 12.5522847,22 12,22 C11.4477153,22 11,21.5522847 11,21 L11,18 C11,17.9762852 11.0008255,17.9527631 11.0024493,17.929461 C7.60896116,17.4452857 5,14.5273206 5,11 L7,11 C7,13.7614237 9.23857625,16 12,16 C14.7614237,16 17,13.7614237 17,11 L19,11 C19,14.5273206 16.3910388,17.4452857 12.9975507,17.929461 Z" fill="#000000" fill-rule="nonzero"/>
            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 8.000000) rotate(-360.000000) translate(-12.000000, -8.000000) " x="9" y="2" width="6" height="12" rx="3"/>
        </g>
        </svg><!--end::Svg Icon-->
    </span>
</span>
</div>';

?>

<!--begin::Content-->
 <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
     <!--begin::Entry-->
     <div class="d-flex flex-column-fluid">
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
                                 <span class="card-label font-weight-bolder font-size-h4 text-white"><?php  echo $lang->getString("credit"); ?></span>
                                 <span class="text-white mt-3 font-weight-bold font-size-lg"></span><br><br>
                             </h3>
                             <div class="card-toolbar">
                                 <span class="font-weight-bolder font-size-h1 text-white"><?php echo $credit; ?> €</span>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body d-flex align-items-end">
                             <!--begin::Status-->
                             <div class="flex-grow-1">
                                 <!--begin::Text-->
                                 <div class="text-white font-weight-bold font-size-lg pb-4"><a class="text-white" href="<?php echo $url; ?>credit/add"><?php  echo $lang->getString("addcredit"); ?></a></div>
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
                                 <span class="card-label font-weight-bolder font-size-h4 text-white"><?php  echo $lang->getString("activeservices"); ?></span>
                                 <span class="text-white mt-3 font-weight-bold font-size-lg"></span><br><br>
                             </h3>
                             <div class="card-toolbar">
                                 <span class="font-weight-bolder font-size-h1 text-white"><?php echo $user->getServicecount(); ?></span>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body d-flex align-items-end">
                             <!--begin::Status-->
                             <div class="flex-grow-1">
                                 <!--begin::Text-->
                                 <div class="text-white font-weight-bold font-size-lg pb-4"><a class="text-white" href="<?php echo $url; ?>service"><?php  echo $lang->getString("manageactiveservices"); ?></a></div>
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
                                 <span class="card-label font-weight-bolder font-size-h4 text-white"><?php  echo $lang->getString("supportcode"); ?></span>
                                 <span class="text-white mt-3 font-weight-bold font-size-lg"></span><br><br>
                             </h3>
                             <div class="card-toolbar">
                                 <span class="font-weight-bolder font-size-h1 text-white"><?php echo $user->getSupportPin(); ?></span>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body d-flex align-items-end">
                             <!--begin::Status-->
                             <div class="flex-grow-1">
                                 <!--begin::Text-->
                                 <div class="text-white font-weight-bold font-size-lg pb-4"><a class="text-white" id="newSupportPinButton" href="javascript:createNewPin();"><?php  echo $lang->getString("regensupportcode"); ?></a></div>
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

             <?php
            if(count($supportInfo) != 0){
                $supportInfo = $supportInfo[0];
                ?>
             <div class="card card-custom gutter-b">
                 <div class="card-body d-flex align-items-center py-5 py-lg-10">
                     <!--begin::Icon-->
                     <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-11 mr-lg-19">
                         <span class="svg-icon svg-icon-6x svg-icon-primary position-absolute opacity-15">
                             <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-polygon.svg-->
                             <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                 <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                     <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                                 </g>
                             </svg>
                             <!--end::Svg Icon-->
                         </span>
                         <span class="svg-icon svg-icon-2x svg-icon-primary position-absolute">
                             <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Bulb1.svg-->
                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                                    <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                    <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                </g>
                             </svg>
                             <!--end::Svg Icon-->
                         </span>
                     </div>
                     <!--end::Icon-->
                     <!--begin::Description-->
                        <div class="row">
                            <div class="col">
                                <h3 class="pb-1 text-dark-75 font-weight-bolder font-size-h5"><?php  echo $lang->getString("pleaseanswer"); ?><?php echo $supportInfo["id"] ?> <?php echo $supportInfo["title"] ?></h3>
                                <p class="m-0 text-dark-50 font-weight-bold font-size-lg"><?php  echo $lang->getString("pleaseanswert"); ?> </p>
                            </div>
                            <div class="col-md-auto">
                                <button id="closeSupportTicketButton" type="button" class="btn font-weight-bolder text-uppercase btn-danger py-4 px-6" onClick="closeSupportTicket(<?php echo $supportInfo["id"] ?>)" data-loading-text="Loading..."><?php  echo $lang->getString("closeticket"); ?></button>
                            </div>
                            <div class="col col-lg-2">
                                <a type="button" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6" href="<?php echo $url; ?>support/ticket/<?php echo $supportInfo["id"] ?>"><?php  echo $lang->getString("answerticket"); ?></a>
                            </div>
                        </div>
                 </div>
             </div>
             <?php
            }
            ?>

<?php
            if(count($invoiceData) != 0){
                $invoiceData = $invoiceData[0];
                ?>
             <div class="card card-custom gutter-b">
                 <div class="card-body d-flex align-items-center py-5 py-lg-10">
                     <!--begin::Icon-->
                     <div class="d-flex flex-center position-relative ml-5 mr-15 ml-lg-11 mr-lg-19">
                         <span class="svg-icon svg-icon-6x svg-icon-primary position-absolute opacity-15">
                             <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-polygon.svg-->
                             <svg xmlns="http://www.w3.org/2000/svg" width="70px" height="70px" viewBox="0 0 70 70" fill="none">
                                 <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                     <path d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z" fill="#000000"></path>
                                 </g>
                             </svg>
                             <!--end::Svg Icon-->
                         </span>
                         <span class="svg-icon svg-icon-2x svg-icon-primary position-absolute">
                             <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Bulb1.svg-->
                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M11.1669899,4.49941818 L2.82535718,19.5143571 C2.557144,19.9971408 2.7310878,20.6059441 3.21387153,20.8741573 C3.36242953,20.9566895 3.52957021,21 3.69951446,21 L21.2169432,21 C21.7692279,21 22.2169432,20.5522847 22.2169432,20 C22.2169432,19.8159952 22.1661743,19.6355579 22.070225,19.47855 L12.894429,4.4636111 C12.6064401,3.99235656 11.9909517,3.84379039 11.5196972,4.13177928 C11.3723594,4.22181902 11.2508468,4.34847583 11.1669899,4.49941818 Z" fill="#000000" opacity="0.3"/>
                                    <rect fill="#000000" x="11" y="9" width="2" height="7" rx="1"/>
                                    <rect fill="#000000" x="11" y="17" width="2" height="2" rx="1"/>
                                </g>
                             </svg>
                             <!--end::Svg Icon-->
                         </span>
                     </div>
                     <!--end::Icon-->
                     <!--begin::Description-->
                        <div class="row">
                            <div class="col">
                                <h3 class="pb-1 text-dark-75 font-weight-bolder font-size-h5"><?php  echo $lang->getStringWithData("unpaidinvoiceheader", ["amount" => $invoiceData["left"], "invoicenr" => str_replace("Rechnung","",$invoiceData["name"])])?></h3>
                                <p class="m-0 text-dark-50 font-weight-bold font-size-lg"><?php  echo $lang->getStringWithData("unpaidinvoicesubtext", ["amount" => $invoiceData["left"]]); ?> </p>
                            </div>
                            <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                <a type="button" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6" href="<?php echo $url; ?>/credit/add?invoice=<?php echo $invoiceData["id"] ?>"><?php echo $lang->getString("payinvoice"); ?></a>
                            </div>
                        </div>
                 </div>
             </div>
             <?php
            }
            ?>



             <!--end::Row-->
             <div class="row mb-10">
                 <div class="col-lg-6">
                     <!--begin::Callout-->
                     <div class="card card-custom mb-2">
                         <div class="card-body">
                             <div class="row d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                                 <div class="d-flex flex-column mr-5">
                                     <a href="<?php echo $url . "support/ticket"; ?>" class="h4 text-dark text-hover-primary mb-5"><?php  echo $lang->getString("support"); ?></a>
                                     <p class="text-dark-50"><?php  echo $lang->getString("supportt"); ?></p>
                                 </div>
                                 <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                     <a href="<?php echo $url . "support/ticket"; ?>" target="_blank" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6"><?php  echo $lang->getString("createticket"); ?> ></a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!--end::Callout-->
                     <!--begin::Code example-->
                     <!--end::Code example-->
                 </div>
                 <div class="col-lg-6">
                     <!--begin::Callout-->
                     <div class="card card-custom mb-2">
                         <div class="card-body">
                             <div class="row d-flex align-items-center justify-content-between p-4 flex-lg-wrap flex-xl-nowrap">
                                 <div class="d-flex flex-column mr-5">
                                     <a href="https://status.prohosting24.de" class="h4 text-dark text-hover-primary mb-5"><?php  echo $lang->getString("status"); ?></a>
                                     <p class="text-dark-50"><?php  echo $lang->getString("statust"); ?></p>
                                 </div>
                                 <div class="ml-6 ml-lg-0 ml-xxl-6 flex-shrink-0">
                                     <a href="https://status.prohosting24.de" target="_blank" class="btn font-weight-bolder text-uppercase btn-primary py-4 px-6"><?php  echo $lang->getString("subscribe"); ?></a>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <!--end::Callout-->
                 </div>
             </div>

             <div class="row">
                 <div class="col-lg-4">
                     <!--begin::Mixed Widget 9-->
                     <div class="card card-custom card-stretch gutter-b">
                         <!--begin::Header-->
                         <div class="card-header border-0 pt-6">
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php  echo $lang->getString("lastnotifications"); ?></span>
                             </h3>
                         </div>
                         <div class="card-body pt-0">
                             <!--begin::Wrapper-->
                             <div class="pt-2">
                             <?php
                                foreach ($lastMessages as $message) {
                             ?>
                                <div class="d-flex align-items-center pb-8">
                                    <div class="d-flex align-items-center flex-wrap flex-row-fluid">
                                        <div class="d-flex flex-column flex-grow-1 pr-5">
                                            <a href="javascript:openEmailLog(<?php echo $message["id"]; ?>)" class="text-dark-75 text-hover-primary mb-1 font-weight-bolder font-size-lg"><?php echo mb_substr($message["title"],0,24,'UTF-8'); ?>...</a>
                                        </div>
                                    </div>
                                    <span class="text-dark-75 font-weight-bolder font-size-sm py-2"><?php echo explode(" ",$message["created_on"])[1]; ?> 
                                    <span class="text-muted font-weight-bold font-size-sm pl-1"><?php  echo $lang->getString("date"); ?></span></span>
                                </div>
                                <?php
                                }
                                ?>
                             </div>
                             <!--end::Wrapper-->
                         </div>
                         <!--end::Body-->
                     </div>
                     <!--end::Mixed Widget 9-->
                 </div>
                 <div class="col-lg-8">
                     <!--begin::Tables Widget 4-->
                     <div class="card card-custom card-stretch gutter-b">
                         <!--begin::Header-->
                         <div class="card-header border-0 pt-7">
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php  echo $lang->getString("services"); ?></span>
                                 <span class="text-muted mt-3 font-weight-bold font-size-lg"><?php echo $lang->getString("active") ?>: <?php echo $user->getServicecount(); ?></span>
                             </h3>
                             <div class="card-toolbar">
                                 <ul class="nav nav-pills nav-pills-sm nav-dark">
                                     <li class="nav-item ml-0">
                                         <a class="nav-link py-2 px-4 font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_table_4_1"><?php  echo $lang->getString("deleted"); ?></a>
                                     </li>
                                     <li class="nav-item ml-0">
                                         <a class="nav-link py-2 px-4 font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_table_4_2"><?php  echo $lang->getString("expired"); ?></a>
                                     </li>
                                     <li class="nav-item">
                                         <a class="nav-link py-2 px-4 active font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_table_4_3"><?php  echo $lang->getString("active"); ?></a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body pt-1 pb-4">
                             <div class="tab-content mt-5" id="myTabTable4">
                                 <!--begin::Tap pane-->
                                 <div class="tab-pane fade" id="kt_tab_table_4_1" role="tabpanel" aria-labelledby="kt_tab_table_4_1">
                                     <!--begin::Table-->
                                     <div class="table-responsive dashboardservice scroll scroll-pull" data-scroll="true" data-height="300">
                                         <table class="table table-borderless table-vertical-center">
                                             <thead>
                                                 <tr>
                                                     <th class="p-0 w-50px"></th>
                                                     <th class="p-0 min-w-120px"></th>
                                                     <th class="p-0 min-w-100px"></th>
                                                     <th class="p-0 min-w-100px"></th>
                                                     <th class="p-0 min-w-150px"></th>
                                                     <th class="p-0 w-80px"></th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                                foreach ($deleted as $entry) {
                                                    echo '<tr><td class="pl-0 py-5">';
                                                    $productName = "";
                                                    switch ($entry["produktid"]) {
                                                        case '1':
                                                            $productUrl = $url . "vserver/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval =  $lang->getString("monthly");
                                                            echo $vserverIcon;
                                                            break;
                                                        case '2':
                                                            $productUrl = $url . "webspace/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $webspaceIcon;
                                                            break;
                                                        case '3':
                                                            $productUrl = $url . "teamspeak/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $teamspeakIcon;
                                                            break;
                                                        case '4':
                                                            $productUrl = $url . "domain/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("yearly");
                                                            echo $domainIcon;
                                                            break;
                                                        case '5':
                                                            $productUrl = $url . "app/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $vserverIcon;
                                                            break;
                                                    }
                                                    echo '</td>';
                                                    echo '<td class="pl-0">
                                                    <a class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">'.$lang->getString($entry["name"]).'</a>
                                                    <span class="text-muted font-weight-bold d-block">'.htmlspecialchars($productName).'</span>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">'. str_replace(".",",",round($entry["price"] * (1 - $entry["discount"]),2)) .' €</span>
                                                    <span class="text-muted font-weight-bold d-block">' . $paymentInterval . '</span>
                                                </td>
                                                <td class="text-right pr-10">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">'. $lang->getString("deleted").'</span>
                                                    <span class="text-muted font-weight-bold d-block">'. $lang->getString("period").'</span>
                                                </td>
                                                <td class="text-right pr-10">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">#'.$entry["id"].'</span>
                                                    <span class="text-muted font-weight-bold d-block">ID</span>
                                                </td>';
                                                    echo ' <td class="text-right pr-0">

                                                </td>';
                                                    echo '</tr>';
                                                }
                                             ?>
                                             </tbody>
                                         </table>
                                     </div>
                                     <!--end::Tablet-->
                                 </div>
                                 <!--end::Tap pane-->
                                 <!--begin::Tap pane-->
                                 <div class="tab-pane fade" id="kt_tab_table_4_2" role="tabpanel" aria-labelledby="kt_tab_table_4_2">
                                     <!--begin::Table-->
                                     <div class="table-responsive dashboardservice scroll scroll-pull" data-scroll="true" data-height="300">
                                         <table class="table table-borderless table-vertical-center">
                                             <thead>
                                                 <tr>
                                                     <th class="p-0 w-50px"></th>
                                                     <th class="p-0 min-w-120px"></th>
                                                     <th class="p-0 min-w-100px"></th>
                                                     <th class="p-0 min-w-100px"></th>
                                                     <th class="p-0 min-w-150px"></th>
                                                     <th class="p-0 w-80px"></th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                                foreach ($expired as $entry) {
                                                    echo '<tr><td class="pl-0 py-5">';
                                                    $productName = "";
                                                    switch ($entry["produktid"]) {
                                                        case '1':
                                                            $productUrl = $url . "vserver/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $vserverIcon;
                                                            break;
                                                        case '2':
                                                            $productUrl = $url . "webspace/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $webspaceIcon;
                                                            break;
                                                        case '3':
                                                            $productUrl = $url . "teamspeak/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $teamspeakIcon;
                                                            break;
                                                        case '4':
                                                            $productUrl = $url . "domain/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("yearly");
                                                            echo $domainIcon;
                                                            break;
                                                        case '5':
                                                            $productUrl = $url . "app/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $vserverIcon;
                                                            break;
                                                    }
                                                    echo '</td>';
                                                    echo '<td class="pl-0">
                                                    <a href="'.$productUrl.'" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">'.$lang->getString($entry["name"]).'</a>
                                                    <span class="text-muted font-weight-bold d-block">'.htmlspecialchars($productName).'</span>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">'. str_replace(".",",",round($entry["price"] * (1 - $entry["discount"]),2)) .' €</span>
                                                    <span class="text-muted font-weight-bold d-block">' . $paymentInterval . '</span>
                                                </td>
                                                <td class="text-right pr-10">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$lang->getString("expired").'</span>
                                                    <span class="text-muted font-weight-bold d-block">'. $lang->getString("period").'</span>
                                                </td>
                                                <td class="text-right pr-10">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">#'.$entry["id"].'</span>
                                                    <span class="text-muted font-weight-bold d-block">ID</span>
                                                </td>';
                                                    echo ' <td class="text-right pr-0">
                                                    <a href="'.$productUrl.'" class="btn btn-icon btn-light btn-sm">
                                                        <span class="svg-icon svg-icon-md svg-icon-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                                    <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </td>';
                                                    echo '</tr>';
                                                }
                                             ?>
                                             </tbody>
                                         </table>
                                     </div>
                                     <!--end::Tablet-->
                                 </div>
                                 <!--end::Tap pane-->
                                 <!--begin::Tap pane-->
                                 <div class="tab-pane fade show active" id="kt_tab_table_4_3" role="tabpanel" aria-labelledby="kt_tab_table_4_3">
                                     <!--begin::Table-->
                                     <div class="table-responsive dashboardservice scroll scroll-pull" data-scroll="true" data-height="300">
                                         <table class="table table-borderless table-vertical-center">
                                             <thead>
                                                 <tr>
                                                     <th class="p-0 w-50px"></th>
                                                     <th class="p-0 min-w-120px"></th>
                                                     <th class="p-0 min-w-100px"></th>
                                                     <th class="p-0 min-w-100px"></th>
                                                     <th class="p-0 min-w-150px"></th>
                                                     <th class="p-0 w-80px"></th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                             <?php
                                                foreach ($aktiv as $entry) {
                                                    echo '<tr><td class="pl-0 py-5">';
                                                    $productName = "";
                                                    switch ($entry["produktid"]) {
                                                        case '1':
                                                            $productUrl = $url . "vserver/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $vserverIcon;
                                                            break;
                                                        case '2':
                                                            $productUrl = $url . "webspace/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $webspaceIcon;
                                                            break;
                                                        case '3':
                                                            $productUrl = $url . "teamspeak/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $teamspeakIcon;
                                                            break;
                                                        case '4':
                                                            $productUrl = $url . "domain/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("yearly");
                                                            echo $domainIcon;
                                                            break;
                                                        case '5':
                                                            $productUrl = $url . "app/details/".$entry["serviceid"];
                                                            $productName = $entry["name_p"];
                                                            $paymentInterval = $lang->getString("monthly");
                                                            echo $vserverIcon;
                                                            break;
                                                    }
                                                    if($entry["status"] == 1){
                                                        $productUrl = "javascript:displayServiceSuspend();";
                                                    }
                                                    echo '</td>';
                                                    echo '<td class="pl-0">
                                                    <a href="'.$productUrl.'" class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">'.$lang->getString($entry["name"]).'</a>
                                                    <span class="text-muted font-weight-bold d-block">'.htmlspecialchars($productName).'</span>
                                                </td>
                                                <td></td>
                                                <td class="text-right">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">'. str_replace(".",",",round($entry["price"] * (1 - $entry["discount"]),2)).' €</span>
                                                    <span class="text-muted font-weight-bold d-block">' . $paymentInterval . '</span>
                                                </td>
                                                <td class="text-right pr-10">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">'.$entry["expire_at"].'</span>
                                                    <span class="text-muted font-weight-bold d-block">'. $lang->getString("period").'</span>
                                                </td>
                                                <td class="text-right pr-10">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">#'.$entry["id"].'</span>
                                                    <span class="text-muted font-weight-bold d-block">ID</span>
                                                </td>';
                                                    echo ' <td class="text-right pr-0">
                                                    <a href="'.$productUrl.'" class="btn btn-icon btn-light btn-sm">
                                                        <span class="svg-icon svg-icon-md svg-icon-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                    <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)" x="11" y="5" width="2" height="14" rx="1"></rect>
                                                                    <path d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                                </g>
                                                            </svg>
                                                        </span>
                                                    </a>
                                                </td>';
                                                    echo '</tr>';
                                                }
                                             ?>
                                             </tbody>
                                         </table>
                                     </div>
                                     <!--end::Tablet-->
                                 </div>
                                 <!--end::Tap pane-->
                             </div>
                         </div>
                         <!--end::Body-->
                     </div>
                     <!--end::Tables Widget 4-->
                 </div>
             </div>
         </div>
         <!--end::Container-->
     </div>
     <!--end::Entry-->
 </div>
<?php

echo getscripts($config, $lang);

?>
<script>
    function openEmailLog(id){
        window.open(url + 'emaillog/' + id, '_blank').focus();
    }

    function createNewPin(){
        loadButton('#newSupportPinButton');
        requestIntern({sessionid:Cookies.get('ph24_sessionid')},"createnewpin",function(respond){
            location.reload();
        });
    }

    function closeSupportTicket(id){
        loadButton('#closeSupportTicketButton');
        requestIntern({sessionid:Cookies.get('ph24_sessionid'),ticketid:id},"closesupportticket",function(respond){
            location.reload();
        });
    }
    function displayServiceSuspend(){
        toastr["error"]("Diese Dienstleistung ist leider gesperrt, bitte kontaktieren Sie den Support.");
    }
</script>
<?php

echo "</body></html>";
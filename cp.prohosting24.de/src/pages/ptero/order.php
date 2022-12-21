<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

if (!isset($content[2]) || $content[2] == "") {
    header('Location:' . $url . "service");
    die();
}
if (!is_numeric($content[2])) {
    header('Location:' . $url . "service");
    die();
}

$productData = requestBackend($config, ["id" => $content[2]], "pteroGetProduct", $user->getLang());
if (!isset($productData["response"])) {
    header('Location:' . $url . "service");
    die();
}
$packetIds = [];
$pteroVariables = [];

$packetData = [];
foreach ($productData["response"]["packets"] as $key => $value) {
    $packetData[$value["id"]] = $value;
}
$packetInfo = $productData["response"]["packets"];

echo minifyhtml(getheader($config, $lang->getString("orderen") . " " . $productData["response"]["displayname"] . "" . $lang->getString("orderde") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $productData["response"]["displayname"], $user, $lang));
?>
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <div class="card card-custom">
                <div class="card-body p-0">
                    <!--begin::Wizard-->
                    <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="false">
                        <!--begin::Wizard Nav-->
                        <div class="wizard-nav border-bottom">
                            <div class="wizard-steps p-8 p-lg-10">
                                <!--begin::Wizard Step 1 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-label">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-4x">
                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Map/Marker1.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                        <rect fill="#000000" opacity="0.3" x="17" y="4" width="3"
                                                            height="13" rx="1.5" />
                                                        <rect fill="#000000" opacity="0.3" x="12" y="9" width="3"
                                                            height="8" rx="1.5" />
                                                        <path
                                                            d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                            fill="#000000" fill-rule="nonzero" />
                                                        <rect fill="#000000" opacity="0.3" x="7" y="11" width="3"
                                                            height="6" rx="1.5" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">1. <?php echo $lang->getString("confchooseconf") ?></h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                    x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                </path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 1 Nav-->
                                <!--begin::Wizard Step 2 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-label">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-4x">
                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/Selected-file.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"/>
                                                        <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero" transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                        <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">2. <?php echo $lang->getString("pteroconfvariables") ?></h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                    x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                </path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 2 Nav-->
                                <!--begin::Wizard Step 3 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-label">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-4x">
                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Shopping/Box2.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z"
                                                            fill="#000000" opacity="0.3" />
                                                        <path
                                                            d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">3. <?php echo $lang->getString("chooseruntime") ?></h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                    x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                </path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 3 Nav-->
                                <!--begin::Wizard Step 4 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-label">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-4x">
                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Communication/Chat-check.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <polygon points="0 0 24 0 24 24 0 24" />
                                                        <path
                                                            d="M9.26193932,16.6476484 C8.90425297,17.0684559 8.27315905,17.1196257 7.85235158,16.7619393 C7.43154411,16.404253 7.38037434,15.773159 7.73806068,15.3523516 L16.2380607,5.35235158 C16.6013618,4.92493855 17.2451015,4.87991302 17.6643638,5.25259068 L22.1643638,9.25259068 C22.5771466,9.6195087 22.6143273,10.2515811 22.2474093,10.6643638 C21.8804913,11.0771466 21.2484189,11.1143273 20.8356362,10.7474093 L17.0997854,7.42665306 L9.26193932,16.6476484 Z"
                                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                            transform="translate(14.999995, 11.000002) rotate(-180.000000) translate(-14.999995, -11.000002) " />
                                                        <path
                                                            d="M4.26193932,17.6476484 C3.90425297,18.0684559 3.27315905,18.1196257 2.85235158,17.7619393 C2.43154411,17.404253 2.38037434,16.773159 2.73806068,16.3523516 L11.2380607,6.35235158 C11.6013618,5.92493855 12.2451015,5.87991302 12.6643638,6.25259068 L17.1643638,10.2525907 C17.5771466,10.6195087 17.6143273,11.2515811 17.2474093,11.6643638 C16.8804913,12.0771466 16.2484189,12.1143273 15.8356362,11.7474093 L12.0997854,8.42665306 L4.26193932,17.6476484 Z"
                                                            fill="#000000" fill-rule="nonzero"
                                                            transform="translate(9.999995, 12.000002) rotate(-180.000000) translate(-9.999995, -12.000002) " />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">4. <?php echo $lang->getString("checkorder") ?></h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow">
                                        <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                    x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                </path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 4 Nav-->
                                <!--begin::Wizard Step 5 Nav-->
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="pending">
                                    <div class="wizard-label">
                                        <div class="wizard-icon">
                                            <span class="svg-icon svg-icon-4x">
                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Communication/Flag.svg-->
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24" />
                                                        <path
                                                            d="M5,5 L19,5 C19.5522847,5 20,5.44771525 20,6 C20,6.55228475 19.5522847,7 19,7 L5,7 C4.44771525,7 4,6.55228475 4,6 C4,5.44771525 4.44771525,5 5,5 Z M5,13 L19,13 C19.5522847,13 20,13.4477153 20,14 C20,14.5522847 19.5522847,15 19,15 L5,15 C4.44771525,15 4,14.5522847 4,14 C4,13.4477153 4.44771525,13 5,13 Z"
                                                            fill="#000000" opacity="0.3" />
                                                        <path
                                                            d="M5,9 L19,9 C19.5522847,9 20,9.44771525 20,10 C20,10.5522847 19.5522847,11 19,11 L5,11 C4.44771525,11 4,10.5522847 4,10 C4,9.44771525 4.44771525,9 5,9 Z M5,17 L19,17 C19.5522847,17 20,17.4477153 20,18 C20,18.5522847 19.5522847,19 19,19 L5,19 C4.44771525,19 4,18.5522847 4,18 C4,17.4477153 4.44771525,17 5,17 Z"
                                                            fill="#000000" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">5. <?php echo $lang->getString("orderlegal") ?></h3>
                                    </div>
                                    <span class="svg-icon svg-icon-xl wizard-arrow last">
                                        <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                <rect fill="#000000" opacity="0.3"
                                                    transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                    x="11" y="5" width="2" height="14" rx="1"></rect>
                                                <path
                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                    fill="#000000" fill-rule="nonzero"
                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                </path>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Wizard Step 5 Nav-->
                            </div>
                        </div>
                        <!--end::Wizard Nav-->
                        <!--begin::Wizard Body-->
                        <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                            <div class="col-xl-12 col-xxl-7">
                                <!--begin::Wizard Form-->
                                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                                    <!--begin::Wizard Step 1-->
                                    <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                        <h3 class="mb-10 font-weight-bold text-dark"><?php echo $lang->getString("confchooseconf") ?></h3>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row align-items-center">
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <input type="text" class="form-control" id="packet_slider_val"
                                                        disabled placeholder="<?php echo $lang->getString("period") ?>" />
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div id="packet_slider"
                                                        class="nouislider nouislider-handle-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="microchip" class="svg-inline--fa fa-microchip fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 48v416c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V48c0-26.51 21.49-48 48-48h224c26.51 0 48 21.49 48 48zm96 58v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42V88h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zM30 376h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="cpu_step_1"></text> <?php echo $lang->getString("cpucores") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="hdd" class="svg-inline--fa fa-hdd fa-w-18"
                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 576 512">
                                                                <path fill="currentColor"
                                                                    d="M576 304v96c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48v-96c0-26.51 21.49-48 48-48h480c26.51 0 48 21.49 48 48zm-48-80a79.557 79.557 0 0 1 30.777 6.165L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L17.223 230.165A79.557 79.557 0 0 1 48 224h480zm-48 96c-17.673 0-32 14.327-32 32s14.327 32 32 32 32-14.327 32-32-14.327-32-32-32zm-96 0c-17.673 0-32 14.327-32 32s14.327 32 32 32 32-14.327 32-32-14.327-32-32-32z">
                                                                </path>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="disk_step_1"></text> GB <?php echo $lang->getString("ssd") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">

                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="memory" class="svg-inline--fa fa-memory fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M640 130.94V96c0-17.67-14.33-32-32-32H32C14.33 64 0 78.33 0 96v34.94c18.6 6.61 32 24.19 32 45.06s-13.4 38.45-32 45.06V320h640v-98.94c-18.6-6.61-32-24.19-32-45.06s13.4-38.45 32-45.06zM224 256h-64V128h64v128zm128 0h-64V128h64v128zm128 0h-64V128h64v128zM0 448h64v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h64v-96H0v96z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="memory_step_1"></text> GB <?php echo $lang->getString("memory") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="network-wired" class="svg-inline--fa fa-network-wired fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M640 264v-16c0-8.84-7.16-16-16-16H344v-40h72c17.67 0 32-14.33 32-32V32c0-17.67-14.33-32-32-32H224c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h72v40H16c-8.84 0-16 7.16-16 16v16c0 8.84 7.16 16 16 16h104v40H64c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V352c0-17.67-14.33-32-32-32h-56v-40h304v40h-56c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V352c0-17.67-14.33-32-32-32h-56v-40h104c8.84 0 16-7.16 16-16zM256 128V64h128v64H256zm-64 320H96v-64h96v64zm352 0h-96v-64h96v64z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3 class="text-dark-75 font-weight-bolder font-size-lg margintop-h"><text id="ipv4_step_1"></text> <?php echo $lang->getString("ipv4addresses") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="mt-10 font-weight-bold text-dark"><?php echo $lang->getString("price") ?>: <text
                                                id="price_step_1">1</text> € / <text id="duration_step_1">30 </text> <?php echo $lang->getString("days") ?></h5>
                                    </div>
                                    <!--end::Wizard Step 1-->
                                    <!--begin::Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h3 class="mb-10 font-weight-bold text-dark"><?php echo $lang->getString("settings") ?></h3>
                                        <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="order_os_type">
											<tbody>
                                            <?php 
                                            $settings = false;
                                            foreach ($productData["response"]["variables"] as $variable) {
                                                $settings = true;
                                                $pteroVariables[] = $variable["pteroid"];
                                                switch ($variable["type"]) {
                                                    case 'select':
                                                        echo '<label for="app_order_input_'. $variable["pteroid"] . '">'. $lang->getString($variable["displaynamelang"]) . '</label>
                                                        <select class="form-control" id="app_order_input_'. $variable["pteroid"] . '">';
                                                        foreach ($variable["variables"] as $variableData) {
                                                            echo '<option value="'.$variableData["key"].'">'.$variableData["value"].'</option>';
                                                        }
                                                    echo'</select>';
                                                        break;
                                                }
                                            }
                                            ?>
											</tbody>
										</table>
                                    </div>
                                    <!--end::Wizard Step 2-->
                                    <!--begin::Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h3 class="font-weight-bold text-dark"><?php echo $lang->getString("period") ?></h3>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <div class="row align-items-center">
                                                <div class="col-lg-3 col-md-3 col-sm-12">
                                                    <input type="text" class="form-control" id="duration_slider_val"
                                                        disabled placeholder="<?php echo $lang->getString("period") ?>" />
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <div id="duration_slider"
                                                        class="nouislider nouislider-handle-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="mt-10 font-weight-bold text-dark"><?php echo $lang->getString("price") ?>: <text
                                                id="price_step_3">1</text> € / <text id="duration_step_3">30 </text> <?php echo $lang->getString("days") ?>
                                        </h5>
                                    </div>
                                    <!--end::Wizard Step 3-->
                                    <!--begin::Wizard Step 4-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h3 class="mb-10 font-weight-bold text-dark"><?php echo $lang->getString("checkorder") ?></h3>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="microchip" class="svg-inline--fa fa-microchip fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M416 48v416c0 26.51-21.49 48-48 48H144c-26.51 0-48-21.49-48-48V48c0-26.51 21.49-48 48-48h224c26.51 0 48 21.49 48 48zm96 58v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42V88h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zm0 96v12a6 6 0 0 1-6 6h-18v6a6 6 0 0 1-6 6h-42v-48h42a6 6 0 0 1 6 6v6h18a6 6 0 0 1 6 6zM30 376h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6zm0-96h42v48H30a6 6 0 0 1-6-6v-6H6a6 6 0 0 1-6-6v-12a6 6 0 0 1 6-6h18v-6a6 6 0 0 1 6-6z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="cpu_step_4"></text> <?php echo $lang->getString("cpucores") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="hdd" class="svg-inline--fa fa-hdd fa-w-18"
                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 576 512">
                                                                <path fill="currentColor"
                                                                    d="M576 304v96c0 26.51-21.49 48-48 48H48c-26.51 0-48-21.49-48-48v-96c0-26.51 21.49-48 48-48h480c26.51 0 48 21.49 48 48zm-48-80a79.557 79.557 0 0 1 30.777 6.165L462.25 85.374A48.003 48.003 0 0 0 422.311 64H153.689a48 48 0 0 0-39.938 21.374L17.223 230.165A79.557 79.557 0 0 1 48 224h480zm-48 96c-17.673 0-32 14.327-32 32s14.327 32 32 32 32-14.327 32-32-14.327-32-32-32zm-96 0c-17.673 0-32 14.327-32 32s14.327 32 32 32 32-14.327 32-32-14.327-32-32-32z">
                                                                </path>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="disk_step_4"></text> GB <?php echo $lang->getString("ssd") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b"
                                                    style="margin-bottom: 40px;">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="box" class="svg-inline--fa fa-box fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M509.5 184.6L458.9 32.8C452.4 13.2 434.1 0 413.4 0H272v192h238.7c-.4-2.5-.4-5-1.2-7.4zM240 0H98.6c-20.7 0-39 13.2-45.5 32.8L2.5 184.6c-.8 2.4-.8 4.9-1.2 7.4H240V0zM0 224v240c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48V224H0z"></path></svg>
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text> <?php echo $productData["response"]["displayname"]?></text></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>

                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="euro-sign"
                                                                class="svg-inline--fa fa-euro-sign fa-w-10" role="img"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 320 512">
                                                                <path fill="currentColor"
                                                                    d="M310.706 413.765c-1.314-6.63-7.835-10.872-14.424-9.369-10.692 2.439-27.422 5.413-45.426 5.413-56.763 0-101.929-34.79-121.461-85.449h113.689a12 12 0 0 0 11.708-9.369l6.373-28.36c1.686-7.502-4.019-14.631-11.708-14.631H115.22c-1.21-14.328-1.414-28.287.137-42.245H261.95a12 12 0 0 0 11.723-9.434l6.512-29.755c1.638-7.484-4.061-14.566-11.723-14.566H130.184c20.633-44.991 62.69-75.03 117.619-75.03 14.486 0 28.564 2.25 37.851 4.145 6.216 1.268 12.347-2.498 14.002-8.623l11.991-44.368c1.822-6.741-2.465-13.616-9.326-14.917C290.217 34.912 270.71 32 249.635 32 152.451 32 74.03 92.252 45.075 176H12c-6.627 0-12 5.373-12 12v29.755c0 6.627 5.373 12 12 12h21.569c-1.009 13.607-1.181 29.287-.181 42.245H12c-6.627 0-12 5.373-12 12v28.36c0 6.627 5.373 12 12 12h30.114C67.139 414.692 145.264 480 249.635 480c26.301 0 48.562-4.544 61.101-7.788 6.167-1.595 10.027-7.708 8.788-13.957l-8.818-44.49z">
                                                                </path>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <?php echo $lang->getString("yourcredit") ?>: <text id="credit_step_4"></text> €</h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">

                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="memory" class="svg-inline--fa fa-memory fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M640 130.94V96c0-17.67-14.33-32-32-32H32C14.33 64 0 78.33 0 96v34.94c18.6 6.61 32 24.19 32 45.06s-13.4 38.45-32 45.06V320h640v-98.94c-18.6-6.61-32-24.19-32-45.06s13.4-38.45 32-45.06zM224 256h-64V128h64v128zm128 0h-64V128h64v128zm128 0h-64V128h64v128zM0 448h64v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h128v-26.67c0-8.84 7.16-16 16-16s16 7.16 16 16V448h64v-96H0v96z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="memory_step_4"></text> GB <?php echo $lang->getString("memory") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="network-wired" class="svg-inline--fa fa-network-wired fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M640 264v-16c0-8.84-7.16-16-16-16H344v-40h72c17.67 0 32-14.33 32-32V32c0-17.67-14.33-32-32-32H224c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h72v40H16c-8.84 0-16 7.16-16 16v16c0 8.84 7.16 16 16 16h104v40H64c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V352c0-17.67-14.33-32-32-32h-56v-40h304v40h-56c-17.67 0-32 14.33-32 32v128c0 17.67 14.33 32 32 32h160c17.67 0 32-14.33 32-32V352c0-17.67-14.33-32-32-32h-56v-40h104c8.84 0 16-7.16 16-16zM256 128V64h128v64H256zm-64 320H96v-64h96v64zm352 0h-96v-64h96v64z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h"><text id="ipv4_step_4"> </text> <?php echo $lang->getString("ipv4addresses") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b"
                                                    style="margin-bottom: 40px;">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="ban" class="svg-inline--fa fa-ban fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M256 8C119.034 8 8 119.033 8 256s111.034 248 248 248 248-111.034 248-248S392.967 8 256 8zm130.108 117.892c65.448 65.448 70 165.481 20.677 235.637L150.47 105.216c70.204-49.356 170.226-44.735 235.638 20.676zM125.892 386.108c-65.448-65.448-70-165.481-20.677-235.637L361.53 406.784c-70.203 49.356-170.226 44.736-235.638-20.676z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="db_step_4"></text> <?php echo $lang->getString("nocontractobligation") ?></h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                                <div class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                    <!--begin::Icon-->
                                                    <div
                                                        class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                        <span
                                                            class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                height="70px" viewBox="0 0 70 70" fill="none">
                                                                <g stroke="none" stroke-width="1" fill-rule="evenodd">
                                                                    <path
                                                                        d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                        fill="#000000"></path>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <span
                                                            class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                            <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="money-check-alt"
                                                                class="svg-inline--fa fa-money-check-alt fa-w-20"
                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 640 512">
                                                                <path fill="currentColor"
                                                                    d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z">
                                                                </path>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <?php echo $lang->getString("remainingcredit") ?>: <text id="credit_after_step_4"></text> €
                                                        </h3>
                                                    </div>
                                                    <!--end::Description-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-10">
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <h5 class="font-weight-bold text-dark"><?php echo $lang->getString("price") ?>: <text
                                                        id="price_step_4">1</text> € / <text
                                                        id="duration_step_4">30</text> <?php echo $lang->getString("days") ?></h5>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-sm-12">
                                                <a id="button_order_open_discount" onClick="openDiscountModal()"
                                                    class="btn btn-outline-primary font-weight-bold col"><?php echo $lang->getString("enterdiscountcode") ?></a>
                                                <div id="order_discount_display" style="margin-bottom: 15px;">
                                                    <div
                                                        class="bg-gray-100 d-flex align-items-center p-5 rounded gutter-b">
                                                        <div
                                                            class="d-flex flex-center position-relative ml-4 mr-6 ml-lg-6 mr-lg-10">
                                                            <span
                                                                class="svg-icon svg-icon-4x svg-icon-primary position-absolute opacity-15">
                                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Layout/Layout-polygon.svg-->
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="70px"
                                                                    height="70px" viewBox="0 0 70 70" fill="none">
                                                                    <g stroke="none" stroke-width="1"
                                                                        fill-rule="evenodd">
                                                                        <path
                                                                            d="M28 4.04145C32.3316 1.54059 37.6684 1.54059 42 4.04145L58.3109 13.4585C62.6425 15.9594 65.3109 20.5812 65.3109 25.5829V44.4171C65.3109 49.4188 62.6425 54.0406 58.3109 56.5415L42 65.9585C37.6684 68.4594 32.3316 68.4594 28 65.9585L11.6891 56.5415C7.3575 54.0406 4.68911 49.4188 4.68911 44.4171V25.5829C4.68911 20.5812 7.3575 15.9594 11.6891 13.4585L28 4.04145Z"
                                                                            fill="#000000"></path>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                            <span
                                                                class="svg-icon svg-icon-lg svg-icon-primary position-absolute">
                                                                <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Files/File-done.svg-->
                                                                <svg aria-hidden="true" focusable="false"
                                                                    data-prefix="fas" data-icon="money-check-alt"
                                                                    class="svg-inline--fa fa-money-check-alt fa-w-20"
                                                                    role="img" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 640 512">
                                                                    <path fill="currentColor"
                                                                        d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z">
                                                                    </path>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </div>
                                                        <!--end::Icon-->
                                                        <!--begin::Description-->
                                                        <div class="ml-1">
                                                            <h3 class="text-dark-75 font-weight-bolder font-size-lg margintop-h"
                                                                id="order_discount_display_value"></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 4-->
                                    <!--begin::Wizard Step 5-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h3 class="mb-10 font-weight-bold text-dark"><?php echo $lang->getString("orderlegal") ?></h3>
                                        <div class="checkbox-list">
                                            <label class="checkbox">
                                                <input type="checkbox" id="order_other">
                                                <span></span><?php echo $lang->getString("orderagree") ?>.</label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="order_datenschutz">
                                                <span></span><?php echo $lang->getString("privacycheck") ?></label>
                                            <label class="checkbox">
                                                <input type="checkbox" id="order_agb">
                                                <span></span><?php echo $lang->getString("toscheck") ?></label>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 5-->
                                    <!--begin::Wizard Actions-->
                                    <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                        <div class="mr-2">
                                            <button type="button" id="prev-step"
                                                class="btn btn-light-primary font-weight-bolder px-10 py-3"
                                                data-wizard-type="action-prev">
                                                <span class="svg-icon svg-icon-md mr-3">
                                                    <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-left.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(12.000000, 12.000000) scale(-1, 1) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                x="11" y="5" width="2" height="14" rx="1"></rect>
                                                            <path
                                                                d="M3.7071045,15.7071045 C3.3165802,16.0976288 2.68341522,16.0976288 2.29289093,15.7071045 C1.90236664,15.3165802 1.90236664,14.6834152 2.29289093,14.2928909 L8.29289093,8.29289093 C8.67146987,7.914312 9.28105631,7.90106637 9.67572234,8.26284357 L15.6757223,13.7628436 C16.0828413,14.136036 16.1103443,14.7686034 15.7371519,15.1757223 C15.3639594,15.5828413 14.7313921,15.6103443 14.3242731,15.2371519 L9.03007346,10.3841355 L3.7071045,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(9.000001, 11.999997) scale(-1, -1) rotate(90.000000) translate(-9.000001, -11.999997)">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span><?php echo $lang->getString("back") ?></button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-success font-weight-bolder px-10 py-3"
                                                data-wizard-type="action-submit" id="order_button"><?php echo $lang->getString("order") ?>
                                                <span class="svg-icon svg-icon-md ml-3">
                                                    <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Check.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <path
                                                                d="M6.26193932,17.6476484 C5.90425297,18.0684559 5.27315905,18.1196257 4.85235158,17.7619393 C4.43154411,17.404253 4.38037434,16.773159 4.73806068,16.3523516 L13.2380607,6.35235158 C13.6013618,5.92493855 14.2451015,5.87991302 14.6643638,6.25259068 L19.1643638,10.2525907 C19.5771466,10.6195087 19.6143273,11.2515811 19.2474093,11.6643638 C18.8804913,12.0771466 18.2484189,12.1143273 17.8356362,11.7474093 L14.0997854,8.42665306 L6.26193932,17.6476484 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(11.999995, 12.000002) rotate(-180.000000) translate(-11.999995, -12.000002)">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </button>
                                            <button type="button" id="credit_add"
                                                onClick="creditAddWindow = window.open('<?php echo $url; ?>credit/add?closeSuccess=1&shouldBuy=' + moneyAfter.toFixed(2) * -1 ); checkAddCredit();lastCredit = credit;"
                                                class="btn btn-primary font-weight-bolder px-10 py-3"
                                                data-wizard-type="action-addCredit"><?php echo $lang->getString("addcredit") ?>
                                                <span class="svg-icon svg-icon-md ml-3">
                                                    <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                x="11" y="5" width="2" height="14" rx="1"></rect>
                                                            <path
                                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </button>
                                            <button type="button" id="next-step"
                                                class="btn btn-primary font-weight-bolder px-10 py-3"
                                                data-wizard-type="action-next"><?php echo $lang->getString("next") ?>
                                                <span class="svg-icon svg-icon-md ml-3">
                                                    <!--begin::Svg Icon | path:/keen/theme/demo7/dist/assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                            fill-rule="evenodd">
                                                            <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                            <rect fill="#000000" opacity="0.3"
                                                                transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                x="11" y="5" width="2" height="14" rx="1"></rect>
                                                            <path
                                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                fill="#000000" fill-rule="nonzero"
                                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)">
                                                            </path>
                                                        </g>
                                                    </svg>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <!--end::Wizard Actions-->
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </form>
                                <!--end::Wizard Form-->
                            </div>
                        </div>
                        <!--end::Wizard Body-->
                    </div>
                </div>
                <!--end::Wizard-->
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>

<div>
    <div class="modal fade" id="order_discount_modal" tabindex="-1" role="dialog"
        aria-labelledby="order_discount_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="order_discount_modalLabel"><?php echo $lang->getString("enterdiscountcode") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="order_discount_code">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-success" id="order_discount_apply"
                    onclick="checkDiscount()"><?php echo $lang->getString("apply") ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo minifyhtml(getscripts($config, $lang));
?>

<script>
    var productId = <?php echo $content[2]; ?>;
    var price = 0;
    var duration = 30;
    var packetId = <?php echo array_key_first($packetData);?>;
    var credit = <?php echo round($user->getGuthaben(), 2); ?>;
    var moneyAfter = 0;
    var discountcode = "";
    var discount = 0;
    var type = 0;
    var lastCredit = 0;
    var packetInfo = <?php echo json_encode($packetData) ?>;
    var packetDataA = <?php echo json_encode($packetInfo) ?>;
    var pteroVariables = <?php echo json_encode($pteroVariables); ?>;

    var durationSlider = document.getElementById('duration_slider');
    var packetSlider = document.getElementById('packet_slider');

    var currentDuration = 30;
    var currentOs = 0;
    var currentOsName = "";
    var orderCounter = 0;

    $('#credit_add').hide();
    $('#order_discount_display').hide();

    function updateData() {
        packetData = packetInfo[packetId];
        price = parseFloat(packetData.price);
        price = price * ((discount - 1) * -1);
        duration = currentDuration;
        nonBasePrice = ((price / 30) * duration).toFixed(2);
        moneyAfter = (credit - nonBasePrice);
        $('#price_step_1').html(nonBasePrice);
        $('#duration_step_1').html(duration);
        $('#price_step_2').html(nonBasePrice);
        $('#duration_step_2').html(duration);
        $('#price_step_3').html(nonBasePrice);
        $('#duration_step_3').html(duration);
        $('#price_step_4').html(nonBasePrice);
        $('#duration_step_4').html(duration);
        $('#ipv4_step_1').html(1);
        $('#ipv4_step_4').html(1);

        packetData.values.forEach(element => {
            $('#' + element.name + '_step_1').html(element.value / element.divide);
            $('#' + element.name + '_step_4').html(element.value / element.divide);
        });
        $('#credit_step_4').html(credit.toFixed(2).toString().replace('.', ','));
        $('#credit_after_step_4').html(moneyAfter.toFixed(2).toString().replace('.', ','));
    }

    var KTWizard1 = function () {
        
        var _wizardEl;
        var _formEl;
        var _wizardObj;
        var _validations = [];

        
        var _initWizard = function () {
            
            _wizardObj = new KTWizard(_wizardEl, {
                startStep: 1, 
                clickableSteps: false  
            });

            
            _wizardObj.on('change', function (wizard) {
                if (wizard.getStep() > wizard.getNewStep()) {
                    $('#next-step').show();
                    <?php
                    if(!$settings){
                        ?>
                        if(wizard.getNewStep() == 2){
                            wizard.goTo(1);return;
                        }
                        <?php
                    }
                    ?>
                    $('#credit_add').hide();
                    return; 
                }
                if (wizard.getNewStep() == 2) {
                    <?php
                    if(!$settings){
                        echo "wizard.goTo(2);return;";
                    }
                    ?>
                }
                if (wizard.getStep() == 3) {
                    if (moneyAfter < 0) {
                        <?php if($user->getCreditLimit() == 0){ ?>
                        $('#credit_add').show();
                        $('#next-step').hide();
                        <?php } else {?>
                            $('#next-step').show();
                        <?php }?>
                    } else {
                        $('#next-step').show();
                    }
                }
                if (wizard.getStep() == 4) {
                    <?php if($user->getCreditLimit() == 0){ ?>
                    if (moneyAfter < 0) {
                        if (moneyAfter > -1) {
                            moneyAfter = 1;
                        }
                        creditAddWindow = window.open('<?php echo $url; ?>credit/add?closeSuccess=1&shouldBuy=' + moneyAfter.toFixed(2) * -1);
                        toastr["error"]('<?php echo $lang->getString("plstopupcredit") ?>');
                        checkAddCredit();
                        return false;
                    }
                    <?php }?>
                }
                if (wizard.getNewStep() == 5) {
                    $('#next-step').hide();
                }
                updateData();

                wizard.goTo(wizard.getNewStep());

                KTUtil.scrollTop();

                return false;  
            });

            
            _wizardObj.on('changed', function (wizard) {
                KTUtil.scrollTop();
            });

            
            _wizardObj.on('submit', function (wizard) {
                if (!$('#order_agb').is(":checked")) {
                    toastr["error"]('<?php echo $lang->getString("accepttos") ?>.');
                    return;
                }
                if (!$('#order_datenschutz').is(":checked")) {
                    toastr["error"]('<?php echo $lang->getString("acceptprivacypolicy") ?>.');
                    return;
                }
                if (!$('#order_other').is(":checked")) {
                    toastr["error"]('<?php echo $lang->getString("plscheckorder") ?>');
                    return;
                }
                order();
            });
        }

        return {
            
            init: function () {
                _wizardEl = KTUtil.getById('kt_wizard');
                _formEl = KTUtil.getById('kt_form');

                _initWizard();
            },
            goto: function (step) {
                _wizardObj.goTo(step);
            }
        };
    }();

    jQuery(document).ready(function () {
        KTWizard1.init();
        <?php
        if(isset($packetId)){
            echo "KTWizard1.goto(2);$('#next-step').hide();updateData();";
            $count = 0;
            foreach ($packetData as $data) {
                if($data["id"] == $packetId){
                    break;
                }
                $count++;
            }
            $key = $count;
        } else {
            $key = 0;
        }
    
        
        ?>
        noUiSlider.create(packetSlider, {
        start: [<?php echo $key; ?>],
        step: 1,
        range: {
            'min': [0],
            'max': [<?php echo count($packetData) - 1; ?>]
        },
        format: wNumb({
            decimals: 0
        })
        });

        var sliderPacketInput = document.getElementById('packet_slider_val');
        packetSlider.noUiSlider.on('update', function (values, handle) {
            sliderPacketInput.value = packetDataA[values]["name"];
            packetId = packetDataA[values]["id"];
            updateData();
        });
    });

    function selectOs(id, name){
        currentOs = id;
        currentOsName = name;
        $('#next-step').show();
        KTWizard1.goto(3);
    }

    function openDiscountModal() {
        $('#order_discount_modal').modal('show');
    }

    function checkDiscount() {
        if ($('#order_discount_code').val() == '') {
            return;
        }
        discountcode = $('#order_discount_code').val();
        loadButton('#order_discount_apply');
        requestIntern({ sessionid: Cookies.get('ph24_sessionid'), code: discountcode, productid: 5 }, "checkdiscountcode", function (respond) {
            if (respond.fail) {
                toastr["error"](respond.error);
            } else {
                discount = respond.response.amount;
                type = respond.response.type;
                $('#order_discount_modal').modal('hide');
                updateData();
                if (moneyAfter >= 0) {
                    $('#credit_add').hide();
                    $('#next-step').show();
                }
                $('#order_discount_display').show();
                $('#button_order_open_discount').hide();
                if (type == 3) {
                    $('#order_discount_display_value').html('<?php echo $lang->getString("permanentdiscount") ?>: ' + discount * 100 + ' %<br>');
                } else {
                    $('#order_discount_display_value').html('<?php echo $lang->getString("onetimediscount") ?>: ' + discount * 100 + ' %<br>');
                }
            }
            loadButton('#order_discount_apply', false);
        });
    }

    function order() {
        var requestData = {sessionid:Cookies.get('ph24_sessionid'), productid:productId,packet:packetId,discountcode: discountcode, days:currentDuration};
        pteroVariables.forEach(element => {
            data = $('#app_order_input_' + element + ' option:selected').val();
            requestData["ptero_" + element] = data;
        });
        loadButton('#order_button');
        requestIntern(requestData,"apporder",function(respond){
            if(respond.fail){
                toastr["error"](respond.error);
                loadButton('#order_button',false);
            } else {
                Cookies.set("ph24_notify_success","<?php  echo $lang->getString("appordersuccess"); ?>");
                window.location.href='<?php echo $config->getconfigvalue('url') ?>service';
            }
        });

    }

    function getuserinfo() {
        requestIntern({ sessionid: Cookies.get('ph24_sessionid') }, "getuserinfo", function (respond) {
            if (respond.fail) {
                toastr["error"](respond.error);
            } else {
                credit = parseFloat(respond.response.guthaben);
                if(credit != lastCredit){
                    toastr["success"]("Guthaben erfolgreich aufgeladen.");
                }
                updateData();
                if (moneyAfter >= 0) {
                    $('#credit_add').hide();
                    $('#next-step').show();
                }
            }
        });
    }

    function checkAddCredit() {
        if (creditAddWindow.closed) {
            getuserinfo();
        } else {
            setTimeout(function () { checkAddCredit(); }, 500);
        }
    }

    noUiSlider.create(durationSlider, {
        start: [30],
        step: 30,
        range: {
            'min': [30],
            'max': [360]
        },
        format: wNumb({
            decimals: 0
        })
    });

    var sliderDurationInput = document.getElementById('duration_slider_val');
    durationSlider.noUiSlider.on('update', function (values, handle) {
        sliderDurationInput.value = values[handle] + " <?php echo $lang->getString("days") ?>";
        currentDuration = values[handle];
        updateData();
    });
    updateData();
</script>
<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$frontendurl = $config->getconfigvalue('frontendurl');


if(isset($content[2]) && isset($content[3])){
    $baseDomain = $content[2];
    $baseTld = $content[3];
}

echo minifyhtml(getheader($config, $lang->getString("domainordertitle"), $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("domainorderheader"), $user, $lang));

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
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <path
                                                            d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                            fill="#000000" fill-rule="nonzero" />
                                                        <circle fill="#000000" opacity="0.3" cx="12" cy="10" r="6" />
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">1. <?php echo $lang->getString("domainorder1") ?></h3>
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
        <path d="M14,13.381038 L14,3.47213595 L7.99460483,15.4829263 L14,13.381038 Z M4.88230018,17.2353996 L13.2844582,0.431083506 C13.4820496,0.0359007077 13.9625881,-0.12427877 14.3577709,0.0733126292 C14.5125928,0.15072359 14.6381308,0.276261584 14.7155418,0.431083506 L23.1176998,17.2353996 C23.3152912,17.6305824 23.1551117,18.1111209 22.7599289,18.3087123 C22.5664522,18.4054506 22.3420471,18.4197165 22.1378777,18.3482572 L14,15.5 L5.86212227,18.3482572 C5.44509941,18.4942152 4.98871325,18.2744737 4.84275525,17.8574509 C4.77129597,17.6532815 4.78556182,17.4288764 4.88230018,17.2353996 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.000087, 9.191034) rotate(-315.000000) translate(-14.000087, -9.191034) "/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">2. <?php echo $lang->getString("selecttld") ?></h3>
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
                                                    <polygon points="0 0 24 0 24 24 0 24"/>
        <path d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
        <path d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero"/>
                                                    </g>
                                                </svg>
                                                <!--end::Svg Icon-->
                                            </span>
                                        </div>
                                        <h3 class="wizard-title">3. <?php echo $lang->getString("selectcontact") ?></h3>
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
                                        <h3 class="mb-10 font-weight-bold text-dark"><?php echo $lang->getString("enteryourdomain") ?></h3>
                                        <!--begin::Input-->
                                        <div class="form-group fv-plugins-icon-container has-success">
                                            <label><?php echo $lang->getString("yourdomain") ?>:</label>
                                            <input type="text" id="order_domain"
                                                class="form-control form-control-solid form-control-lg"
                                                placeholder="deinedomain.de" value=<?php if(isset($baseDomain)){ echo '"' . $baseDomain. ".". $baseTld . '"';} else{echo '""';}?>>
                                            <div class="fv-plugins-message-container"></div>
                                        </div>
                                    </div>
                                    <!--end::Wizard Step 1-->
                                    <!--begin::Wizard Step 2-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h3 class="mb-10 font-weight-bold text-dark"><?php echo $lang->getString("selecttld") ?></h3>
                                        <?php echo getloadinghtml("order_step2_load"); ?>
                                        <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="order_step2_table_list" style="display:none">
                                            <thead>
                                                <tr>
                                                    <th><?php echo $lang->getString("domain") ?></th>
                                                    <th><?php echo $lang->getString("price") ?></th>
                                                    <th><?php echo $lang->getString("state") ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--end::Wizard Step 2-->
                                    <!--begin::Wizard Step 3-->
                                    <div class="pb-5" data-wizard-type="step-content">
                                        <h3 class="font-weight-bold text-dark"><?php echo $lang->getString("selectcontact") ?></h3>
                                        <?php echo getloadinghtml("order_step3_load"); ?>
                                        <table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="order_step3_contact_list" style="display:none;word-break: break-all;">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th><?php echo $lang->getString("name") ?></th>
                                                    <th><?php echo $lang->getString("email") ?></th>
                                                    <th><?php echo $lang->getString("address") ?></th>
                                                    <th><?php echo $lang->getString("action") ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
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
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="at" class="svg-inline--fa fa-at fa-w-16"
                                                                role="img" xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512">
                                                                <path fill="currentColor"
                                                                    d="M256 8C118.941 8 8 118.919 8 256c0 137.059 110.919 248 248 248 48.154 0 95.342-14.14 135.408-40.223 12.005-7.815 14.625-24.288 5.552-35.372l-10.177-12.433c-7.671-9.371-21.179-11.667-31.373-5.129C325.92 429.757 291.314 440 256 440c-101.458 0-184-82.542-184-184S154.542 72 256 72c100.139 0 184 57.619 184 160 0 38.786-21.093 79.742-58.17 83.693-17.349-.454-16.91-12.857-13.476-30.024l23.433-121.11C394.653 149.75 383.308 136 368.225 136h-44.981a13.518 13.518 0 0 0-13.432 11.993l-.01.092c-14.697-17.901-40.448-21.775-59.971-21.775-74.58 0-137.831 62.234-137.831 151.46 0 65.303 36.785 105.87 96 105.87 26.984 0 57.369-15.637 74.991-38.333 9.522 34.104 40.613 34.103 70.71 34.103C462.609 379.41 504 307.798 504 232 504 95.653 394.023 8 256 8zm-21.68 304.43c-22.249 0-36.07-15.623-36.07-40.771 0-44.993 30.779-72.729 58.63-72.729 22.292 0 35.601 15.241 35.601 40.77 0 45.061-33.875 72.73-58.161 72.73z">
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
                                                            <?php echo $lang->getString("domain") ?> <text id="domain_step_4"></text></h3>
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
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="atlas" class="svg-inline--fa fa-atlas fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M318.38 208h-39.09c-1.49 27.03-6.54 51.35-14.21 70.41 27.71-13.24 48.02-39.19 53.3-70.41zm0-32c-5.29-31.22-25.59-57.17-53.3-70.41 7.68 19.06 12.72 43.38 14.21 70.41h39.09zM224 97.31c-7.69 7.45-20.77 34.42-23.43 78.69h46.87c-2.67-44.26-15.75-71.24-23.44-78.69zm-41.08 8.28c-27.71 13.24-48.02 39.19-53.3 70.41h39.09c1.49-27.03 6.53-51.35 14.21-70.41zm0 172.82c-7.68-19.06-12.72-43.38-14.21-70.41h-39.09c5.28 31.22 25.59 57.17 53.3 70.41zM247.43 208h-46.87c2.66 44.26 15.74 71.24 23.43 78.69 7.7-7.45 20.78-34.43 23.44-78.69zM448 358.4V25.6c0-16-9.6-25.6-25.6-25.6H96C41.6 0 0 41.6 0 96v320c0 54.4 41.6 96 96 96h326.4c12.8 0 25.6-9.6 25.6-25.6v-16c0-6.4-3.2-12.8-9.6-19.2-3.2-16-3.2-60.8 0-73.6 6.4-3.2 9.6-9.6 9.6-19.2zM224 64c70.69 0 128 57.31 128 128s-57.31 128-128 128S96 262.69 96 192 153.31 64 224 64zm160 384H96c-19.2 0-32-12.8-32-32s16-32 32-32h288v64z"></path></svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Icon-->
                                                    <!--begin::Description-->
                                                    <div class="ml-1">
                                                        <h3
                                                            class="text-dark-75 font-weight-bolder font-size-lg margintop-h">
                                                            <text id="db_step_4"></text> <?php echo $lang->getString("owninterface1") ?></h3>
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
                                                            <svg aria-hidden="true" focusable="false" data-prefix="fas"
                                                                data-icon="envelope"
                                                                class="svg-inline--fa fa-envelope fa-w-16" role="img"
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                viewBox="0 0 512 512">
                                                                <path fill="currentColor"
                                                                    d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
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
                                                            <text id="mail_step_4"></text> <?php echo $lang->getString("owninterface2") ?></h3>
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
                                                        id="price_step_4">1</text> € / <?php echo $lang->getString("year") ?></h5>
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
                                                <span></span><?php echo $lang->getString("orderagree") ?></label>
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
    <div class="modal fade" id="order_contact_create_modal" tabindex="-1" role="dialog"
        aria-labelledby="order_contact_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order_contact_create_modalLabel"><?php echo $lang->getString("createcontact") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_firstName"><?php echo $lang->getString("firstname") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_firstName">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 mb-5">
                        <label for="order_contact_create_lastName"><?php echo $lang->getString("lastname") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_lastName">
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mb-5">
                        <label for="order_contact_create_street"><?php echo $lang->getString("street") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_street">
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
                        <label for="order_contact_create_houseNumer"><?php echo $lang->getString("housenr") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_houseNumer">
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_postalCode"><?php echo $lang->getString("postalcode") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_postalCode">
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_city"><?php echo $lang->getString("location") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_city">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                        <label for="order_contact_create_region"><?php echo $lang->getString("state_region") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_region">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_country"><?php echo $lang->getString("country") ?></label>
                            <select class="form-control" id="order_contact_create_country">
								<option value="DE"><?php echo $lang->getString("germany") ?></option>
								<option value="AT"><?php echo $lang->getString("austria") ?></option>
                                <option value="CH"><?php echo $lang->getString("switzerland") ?></option>
							</select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_gender"><?php echo $lang->getString("gender") ?></label>
                            <select class="form-control" id="order_contact_create_gender">
								<option value="MALE"><?php echo $lang->getString("male") ?></option>
								<option value="FEMALE"><?php echo $lang->getString("female") ?></option>
							</select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_email"><?php echo $lang->getString("email") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_email">
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                            <label for="order_contact_create_phone"><?php echo $lang->getString("phonenumber") ?></label>
                            <input type="text" class="form-control" id="order_contact_create_phone">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-success" id="order_contact_create_button"
                        onclick="createContact()"><?php echo $lang->getString("create") ?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="order_enter_auth_modal" tabindex="-1" role="dialog"
        aria-labelledby="order_enter_auth_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="order_enter_auth_modalLabel"><?php echo $lang->getString("enterauthcode") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 mb-5">
                            <label for="order_enter_auth_code"><?php echo $lang->getString("authcode") ?></label>
                            <input type="text" class="form-control" id="order_enter_auth_code">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-success" id="order_contact_create_button"
                        onclick="transferDomainFinish()"><?php echo $lang->getString("next") ?></button>
                </div>
            </div>
        </div>
    </div>

<?php
echo minifyhtml(getscripts($config, $lang));

echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") .'"></script>';
?>

<script>
    var price = 0;
    var duration = 1;
    var domain = "";
    var credit = <?php echo round($user -> getGuthaben(), 2); ?>;
    var moneyAfter = 1;
    var lastCredit = 0;
    var activeContactId = 0;
    var authCode = "0";

    $('#credit_add').hide();
    $('#order_discount_display').hide();

    function updateData() {
        moneyAfter = (credit - price);
        $('#price_step_4').html(price);
        $('#duration_step_4').html(duration);
        $('#domain_step_4').html(domain);
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
                    switch (wizard.getNewStep()) {
                        case 3:
                        case 2:
                            $('#next-step').hide();
                            $('#credit_add').hide();
                            break;
                        case 4:
                            if (moneyAfter < 0) {
                                $('#credit_add').show();
                                $('#next-step').hide();
                            } else {
                                $('#next-step').show();
                            }
                            break;
                        default:
                            $('#next-step').show();
                            $('#credit_add').hide();
                            break;
                    }
                    return; 
                }
                if (wizard.getNewStep() == 2) {
                    $('#next-step').hide();
                    updateData();
                    getDomains();
                    wizard.goTo(wizard.getNewStep());
                    return false;
                }
                if(wizard.getNewStep() == 3){
                    getContactList();
                }
                if (wizard.getNewStep() == 4) {
                    updateData();
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
                if (wizard.getNewStep() == 5) {
                    <?php if($user->getCreditLimit() == 0){ ?>
                    if (moneyAfter < 0) {
                        if (moneyAfter > -1) {
                            moneyAfter = 1;
                        }
                        creditAddWindow = window.open('<?php echo $url; ?>credit/add?closeSuccess=1&shouldBuy=' + moneyAfter.toFixed(2) * -1);
                        toastr["error"]('Bitte laden Sie Guthaben auf.');
                        checkAddCredit();
                        return false;
                    } else {
                        $('#next-step').hide();
                        $('#credit_add').hide();
                    }
                    <?php }?>
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
                    toastr["error"]('<?php echo $lang->getString("toscheck") ?>');
                    return;
                }
                if (!$('#order_datenschutz').is(":checked")) {
                    toastr["error"]('<?php echo $lang->getString("privacycheck") ?>');
                    return;
                }
                if (!$('#order_other').is(":checked")) {
                    toastr["error"]('<?php echo $lang->getString("orderagree") ?>');
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
    if(isset($baseDomain)){
        echo "$('#next-step').hide();
        updateData();
        getDomains();
        KTWizard1.goto(2);";
    }
    ?>

    });
    function getDomains(){
        if(domain == escape($('#order_domain').val())){
            return;
        }
        domain = escape($('#order_domain').val());
        $('#order_step2_table_list').hide();
		$('#order_step2_load').show();
        $('#next-step').hide();
        requestIntern({ sessionid: Cookies.get('ph24_sessionid'), domain:domain,all:"all"}, "checkdomain", function (respond) {
            if (respond.fail) {
                $('#next-step').show();
                KTWizard1.goto(1);
                toastr["error"](respond.error);
            } else {
                $('#order_step2_table_list').DataTable().clear().draw();
                respond.response.array.forEach(element => {
                    selectButton = "";
                    if(element.av){
                        priceDisplay = element.price.toString().replace('.', ',') + " € / <?php  echo $lang->getString("year"); ?>";
                        selectButton = '<button onClick="selectDomain(\'' + element.sld + '.' + element.tld +'\',' + element.price + ')" type="button" class="btn btn-primary btn-sm mr-2"><?php echo $lang->getString("select") ?></button>';
                    } else {
                        if(element.special){
                            selectButton = '<span class="badge badge-danger"><?php  echo $lang->getString("notavailable"); ?></span>';
                            priceDisplay = "";
                        } else {
                            selectButton = '<button onClick="transferDomain(\'' + element.sld + '.' + element.tld +'\',' + element.price + ')" type="button" class="btn btn-warning btn-sm mr-2"><?php echo $lang->getString("transfer") ?></button>';
                            priceDisplay = element.price.toString().replace('.', ',') + " € / <?php echo $lang->getString("year") ?>";
                        }
                    }
                    $('#order_step2_table_list').DataTable().row.add( [
                        element.sld + '.' + element.tld,
                        priceDisplay,
                        selectButton
                    ] ).draw( false );
				});
				$('#order_step2_table_list').show();
				$('#order_step2_load').hide();
            }
        });
    }

    function getContactList(){
        $('#order_step3_load').show();
        $('#order_step3_contact_list').hide();
        requestIntern({ sessionid: Cookies.get('ph24_sessionid')}, "getkontakte", function (respond) {
            if (respond.fail) {
                toastr["error"](respond.error);
            } else {
                $('#order_step3_contact_list').DataTable().clear().draw();
                respond.response.forEach(element => {
                    $('#order_step3_contact_list').DataTable().row.add( [
                        element.id,
                        escape(element.firstname) + " " + escape(element.lastname),
                        escape(element.email),
                        escape(element.street) + " " + escape(element.number) + " " + escape(element.postcode) + " " + escape(element.city),
                        '<button onClick="selectContact(' + element.id + ')" type="button" class="btn btn-primary btn-sm mr-2"><?php echo $lang->getString("select") ?></button>'
                    ] ).draw( false );
				});
                $('#order_step3_contact_list').DataTable().row.add([
                    '',
                    '',
                    '',
                    '',
                    '<button onClick="openCreateContact();" type="button" class="btn btn-primary btn-sm mr-2"><?php echo $lang->getString("createcontact") ?></button>'
                ]).draw( false );
				$('#order_step3_contact_list').show();
				$('#order_step3_load').hide();
            }
        });
    }

    function openCreateContact(){
        $('#order_contact_create_modal').modal('show');
    }

    function selectDomain(domainDisplay, priceDomain){
        domain = domainDisplay;
        price = priceDomain;
        updateData();
        getContactList();
        $('#next-step').hide();
        KTWizard1.goto(3);
    }

    function transferDomain(domainDisplay, priceDomain){
        domain = domainDisplay;
        price = priceDomain;
        updateData();
        getContactList();
        $('#order_enter_auth_modal').modal('show');
    }

    function transferDomainFinish(){
        if($('#order_enter_auth_code').val() == ""){
            toastr["error"]("<?php  echo $lang->getString("contactcreatesuccess"); ?>");
            return;
        }
        authCode = $('#order_enter_auth_code').val();
        $('#next-step').hide();
        $('#order_enter_auth_modal').modal('hide');
        KTWizard1.goto(3);
    }

    function selectContact(contactId){
        activeContactId = contactId;
        KTWizard1.goto(4);
        if (moneyAfter < 0) {
            $('#credit_add').show();
            $('#next-step').hide();
        } else {
            $('#next-step').show();
        }
    }

    function createContact(){
        order_contact_create_firstName = $('#order_contact_create_firstName').val();
        order_contact_create_lastName = $('#order_contact_create_lastName').val();
        order_contact_create_street = $('#order_contact_create_street').val();
        order_contact_create_houseNumer = $('#order_contact_create_houseNumer').val();
        order_contact_create_postalCode = $('#order_contact_create_postalCode').val();
        order_contact_create_city = $('#order_contact_create_city').val();
        order_contact_create_region = $('#order_contact_create_region').val();
        order_contact_create_country = $('#order_contact_create_country option:selected').val();
        order_contact_create_gender = $('#order_contact_create_gender option:selected').val();
        order_contact_create_email = $('#order_contact_create_email').val();
        order_contact_create_phone = $('#order_contact_create_phone').val();
        loadButton('#order_contact_create_button');
        requestIntern({ sessionid: Cookies.get('ph24_sessionid'), sex:order_contact_create_gender,firstname:order_contact_create_firstName,lastname:order_contact_create_lastName,street:order_contact_create_street,number:order_contact_create_houseNumer,postcode:order_contact_create_postalCode,city:order_contact_create_city,region:order_contact_create_region,country:order_contact_create_country,phone:order_contact_create_phone,email:order_contact_create_email}, "addkontakt", function (respond) {
            if (respond.fail) {
                toastr["error"](respond.error);
            } else {
                getContactList();
                toastr["success"]("<?php  echo $lang->getString("contactcreatesuccess"); ?>");
                $('#order_contact_create_modal').modal('hide');
            }
            loadButton('#order_contact_create_button', false);
        });
    }

    function order() {
        loadButton('#order_button');
        requestIntern({ sessionid: Cookies.get('ph24_sessionid'), domain:domain,kontaktid:activeContactId,authCode:authCode}, "oderdomain", function (respond) {
            if (respond.fail) {
                toastr["error"](respond.error);
                loadButton('#order_button', false);
            } else {
                Cookies.set("ph24_notify_success", "<?php  echo $lang->getString("domaincreatesuccess"); ?>");
                window.location.replace('<?php echo $url; ?>service');
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
                    toastr["success"]("<?php  echo $lang->getString("successpayment"); ?>");
                }
                updateData();
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
    updateData();
    $('#order_step2_table_list').DataTable({
        "scrollX": true,
		"responsive": true,
		"paging": false,
		"order": [[ 2, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
    $('#order_step3_contact_list').DataTable({
        "scrollX": true,
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
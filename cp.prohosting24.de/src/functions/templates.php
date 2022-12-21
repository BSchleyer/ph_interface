<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

function getdatatables($config, $lang)
{
    $cdn = $config->getconfigvalue('cdn');
    echo '
		<script src="' . $cdn .  $lang->getString("datatablebundleurl") .'" type="text/javascript"></script>
		<link href="' . $cdn . 'vendors/custom/datatables/datatables.bundle.min.css" rel="stylesheet" type="text/css" />';
}



function getheader($config, $pagetitle, $lang)
{
    $url = $config->getconfigvalue('url');
	$cdn = $config->getconfigvalue('cdn');
	$style = "style.bundle.css";
	if (isset($_COOKIE["ph24_dark"])) {
		if($_COOKIE["ph24_dark"] == 1){
			$style = "darkstyle.bundle.css";
		}
	}
	return '
	<!DOCTYPE html>
	<html lang="de">
    <head>
    <meta charset="utf-8" />
    <title>'.$pagetitle.'</title>
    <meta name="description" content="Stats widget examples" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="' . $cdn . 'assets/css/fonts/poppins.css" rel="stylesheet"> 
	<link href="' . $cdn . 'assets/css/pages/wizard/wizard-1.css?v=2.0.7" rel="stylesheet" type="text/css">
	<link href="' . $cdn . 'assets/plugins/custom/datatables/datatables.bundle.css?v=2.0.3" rel="stylesheet" type="text/css">
    <link href="' . $cdn . 'assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="' . $cdn . 'assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="' . $cdn . 'assets/css/'.$style.'" rel="stylesheet" type="text/css" />
	<link href="' . $cdn . 'vendors/general/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="' . $cdn . 'favicon.png" />
</head>';

}

function getscripts($config, $lang)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
	$frontendurl = $config->getconfigvalue('frontendurl');
	$langscript = $lang->getString("mainjs");
    $adminscript = "";
    if (isset($_COOKIE["ph24_admin_session"])) {
        $adminscript = '<script>function backtoadmin(){adminsession=Cookies.get("ph24_admin_session"),Cookies.remove("ph24_admin_session"),Cookies.remove("ph24_sessionid",{path:"/cp/"}),Cookies.set("ph24_sessionid",adminsession,{expires:10}),window.location.href="' . $url . '"};$("#to_admin_button").show();</script>';
    }
    $return =  '<div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
	<!--begin::Container-->
	<div class="container d-flex flex-column flex-md-row align-items-center justify-content-between">
		<!--begin::Copyright-->
		<div class="text-dark order-2 order-md-1">
			<span class="text-muted font-weight-bold mr-2">2017 - '.date("Y").'©</span>
			<a href="https://prohosting24.de" target="_blank" class="text-dark-75 text-hover-primary">ProHosting24.de</a>
		</div>
		<!--end::Copyright-->
		<!--begin::Nav-->
		<div class="nav nav-dark order-1 order-md-2 font-weight-bold">
			<a href="' . $frontendurl . '/'.$lang->getString("imprinturl") .'" target="_blank" class="text-dark-75 text-hover-primary pr-3 pl-0">' .$lang->getString("imprint") .'</a>
			<a href="' . $frontendurl . '/'.$lang->getString("privacyurl") .'" target="_blank" class="text-dark-75 text-hover-primary px-3">' .$lang->getString("privacy") .'</a>
			<a href="' . $frontendurl . '/'.$lang->getString("tosurl") .'" target="_blank" class="text-dark-75 text-hover-primary pl-3 pr-0">' .$lang->getString("tos") .'</a>
		</div>
		<!--end::Nav-->
	</div>
	<!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
<!--begin::Header-->
<div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
<h3 class="font-weight-bold m-0">User Profile
<small class="text-muted font-size-sm ml-2">15 messages</small></h3>
<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
<i class="ki ki-close icon-xs text-muted"></i>
</a>
</div>
<!--end::Header-->
</div>
<!-- end::User Panel-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
<span class="svg-icon">
<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
		<polygon points="0 0 24 0 24 24 0 24" />
		<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
		<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
	</g>
</svg>
<!--end::Svg Icon-->
</span>
</div>
<script>
	var KTAppSettings={"breakpoints":{"sm":576,"md":768,"lg":992,"xl":1200,"xxl":1200},"colors":{"theme":{"base":{"white":"#ffffff","primary":"#3699FF","secondary":"#E5EAEE","success":"#1BC5BD","info":"#6993FF","warning":"#FFA800","danger":"#F64E60","light":"#F3F6F9","dark":"#212121"},"light":{"white":"#ffffff","primary":"#E1F0FF","secondary":"#ECF0F3","success":"#C9F7F5","info":"#E1E9FF","warning":"#FFF4DE","danger":"#FFE2E5","light":"#F3F6F9","dark":"#D6D6E0"},"inverse":{"white":"#ffffff","primary":"#FFFFFF","secondary":"#212121","success":"#ffffff","info":"#ffffff","warning":"#ffffff","danger":"#ffffff","light":"#464E5F","dark":"#ffffff"}},"gray":{"gray-100":"#F3F6F9","gray-200":"#ECF0F3","gray-300":"#E5EAEE","gray-400":"#D6D6E0","gray-500":"#B5B5C3","gray-600":"#80808F","gray-700":"#464E5F","gray-800":"#1B283F","gray-900":"#212121"}},"font-family":"Poppins"};
	var internApi = "'.$config->getconfigvalue('internapi').'";
	var url = "'.$config->getconfigvalue('url').'";
	var backendURL = "'.$config->getconfigvalue('backendendpoint').'v1/";
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="' . $cdn . 'assets/plugins/global/plugins.bundle.js"></script>
<script src="' . $cdn . 'assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="' . $cdn . 'assets/js/scripts.bundle.js"></script>
<script src="' . $cdn . 'js/js.cookie.min.js"></script>
<script src="' . $cdn . ''. $langscript .'"></script>
<script src="' . $cdn . 'vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="' . $cdn . 'assets/js/pages/widgets.js"></script>' . $adminscript;

	if (isset($_COOKIE["ph24_notify_success"])) {
		$return .= "<script>toastr['success']('" . $_COOKIE["ph24_notify_success"] . "');Cookies.remove('ph24_notify_success');</script>";
	}

	return $return;
}

function getloginheader($config, $pagetitle, $lang)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
    <html>
	<head>

		<meta charset="utf-8" />
		<title>' . $pagetitle . '</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script src="' . $cdn . 'js/webfont.min.js"></script>
		<link href="' . $cdn . 'assets/css/fonts/poppins.css" rel="stylesheet"> 
		<link href="' . $cdn . 'css/cp/login-v2.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/tether/dist/css/tether.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/nouislider/distribute/nouislider.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/owl.carousel/dist/assets/owl.carousel.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/owl.carousel/dist/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/dropzone/dist/dropzone.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/summernote/dist/summernote.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/animate.css/animate.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/morris.js/morris.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/socicon/css/socicon.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/custom/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/custom/vendors/flaticon/flaticon.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/custom/vendors/flaticon2/flaticon.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/cp/style.bundle.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/cp/light_base.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/cp/light_menu.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/cp/navy_brand.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/cp/navy_aside.min.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="' . $cdn . 'favicon.png" />
	</head>';
}

function getloginscripts($config, $lang)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
    <script>var KTAppOptions={colors:{state:{brand:"#5d78ff",metal:"#c4c5d6",light:"#ffffff",accent:"#00c5dc",primary:"#5867dd",success:"#34bfa3",info:"#36a3f7",warning:"#ffb822",danger:"#fd3995",focus:"#9816f4"},base:{label:["#c5cbe3","#a1a8c3","#3d4465","#3e4466"],shape:["#f0f3ff","#d9dffa","#afb4d4","#646c9a"]}}};</script>
	<script src="' . $cdn . 'vendors/general/jquery/dist/jquery.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/js-cookie/src/js.cookie.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/moment/min/moment.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/tooltip.js/dist/umd/tooltip.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/perfect-scrollbar/dist/perfect-scrollbar.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/sticky-js/dist/sticky.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/wnumb/wNumb.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery-form/dist/jquery.form.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/block-ui/jquery.blockUI.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/typeahead.js/dist/typeahead.bundle.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/handlebars/dist/handlebars.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/inputmask/dist/jquery.inputmask.bundle.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/nouislider/distribute/nouislider.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/owl.carousel/dist/owl.carousel.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/autosize/dist/autosize.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/clipboard/dist/clipboard.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/dropzone/dist/dropzone.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/summernote/dist/summernote.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/markdown/lib/markdown.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/bootstrap-markdown/js/bootstrap-markdown.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/js/vendors/bootstrap-markdown.init.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery-validation/dist/jquery.validate.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery-validation/dist/additional-methods.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/js/vendors/jquery-validation.init.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/morris.js/morris.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/chart.js/dist/Chart.bundle.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/waypoints/lib/jquery.waypoints.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/counterup/jquery.counterup.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/lib.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/jquery.input.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/repeater.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/dompurify/dist/purify.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'js/cp/scripts.bundle.min.js" type="text/javascript"></script>
	<script src="' . $cdn . $lang->getString("mainjs") .'"></script>';
}

function getnormalbody($config, $sidename, $user,$lang, $needboy = true)
{
    
    $url = $config->getconfigvalue('url');
    $frontendurl = $config->getconfigvalue('frontendurl');
    $cdn = $config->getconfigvalue('cdn');
    return '
	<body id="kt_body" class="header-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile">
        <!--begin::Logo-->
        <a href="' . $url . '">
			<h2 class="text-white">ProHosting24</h2>
        </a>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <button class="btn btn-icon btn-icon-white btn-hover-icon-white" id="kt_aside_mobile_toggle">
					<span class="svg-icon svg-icon-xxl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<rect fill="#000000" x="4" y="4" width="7" height="7" rx="1.5" />
								<path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" fill="#000000" opacity="0.3" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-icon btn-icon-white btn-hover-icon-white ml-1" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg-->
					</span>
				</button>
				
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <!--begin::Aside-->
    <div class="aside aside-left aside-fixed" id="kt_aside">
        <!--begin::Aside Brand-->
        <div class="aside-brand h-80px px-7 flex-shrink-0">
            <!--begin::Logo-->
            <a href="' . $url . '../" class="aside-logo">
				<h2 class="text-white">ProHosting24</h2>
            </a>
            <!--end::Logo-->
            <!--begin::Toggle-->
            <button class="aside-toggle btn btn-sm btn-icon-white px-0" id="kt_aside_toggle">
					<span class="svg-icon svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/Text/Toggle-Right.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<rect x="0" y="0" width="24" height="24" />
								<path fill-rule="evenodd" clip-rule="evenodd" d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z" fill="black" />
								<path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z" fill="black" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
            <!--end::Toolbar-->
        </div>
        <!--end::Aside Brand-->
        <!--begin::Aside Menu-->
        <div id="kt_aside_menu" class="aside-menu my-5" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item" aria-haspopup="true">
                    <a href="' . $url . '" class="menu-link">
                        <span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-home"></i>
						</span>
                        <span class="menu-text">'. $lang->getString("dashboard") .'</span>
                    </a>
                </li>
                <li class="menu-section">
                    <h4 class="menu-text">'. $lang->getString("support") .'</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="menu-item" aria-haspopup="true">
                    <a href="' . $url . 'support/ticket" class="menu-link">
	                    <span class="svg-icon menu-icon">
							<i class="icon-xl far fa-comments"></i>
						</span>
						<span class="menu-text">'. $lang->getString("ticketoverview") .'</span>
                    </a>
				</li>
				<li class="menu-section">
				<h4 class="menu-text">'. $lang->getString("services") .'</h4>
				<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'service" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-shopping-bag"></i>
						</span>
						<span class="menu-text">'. $lang->getString("products") .'</span>
					</a>
				</li>

				<li class="menu-section">
				<h4 class="menu-text">'. $lang->getString("orderproducts") .'</h4>
				<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>

				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-gamepad"></i>
						</span>
						<span class="menu-text">
							Gameserver
						</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/13" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Minecraft Java</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/16" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Minecraft Nukkit</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/17" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Minecraft Pocketmine</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/14" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Rust</span>
								</a>
							</li>
						</ul>
					</div>
				</li>


				<li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">
					<a href="javascript:;" class="menu-link menu-toggle">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-database"></i>
						</span>
						<span class="menu-text">'. $lang->getString("databases") .'</span>
						<i class="menu-arrow"></i>
					</a>
					<div class="menu-submenu">
						<i class="menu-arrow"></i>
						<ul class="menu-subnav">
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/12" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">MongoDB</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/9" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">MariaDB</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/10" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">Redis</span>
								</a>
							</li>
							<li class="menu-item" aria-haspopup="true">
								<a href="' . $url . 'app/order/11" class="menu-link">
									<i class="menu-bullet menu-bullet-dot">
										<span></span>
									</i>
									<span class="menu-text">PostgreSQL</span>
								</a>
							</li>
						</ul>
					</div>
				</li>
			
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'vserver/order/1/1/10/1" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-server"></i>
						</span>
						<span class="menu-text">'. $lang->getString("vserver") .'</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'vserver/order/p" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-server"></i>
						</span>
						<span class="menu-text">'. $lang->getString("vserverpackage") .'</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'domain/order/" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-at"></i>
						</span>
						<span class="menu-text">'. $lang->getString("domains") .'</span>
					</a>
				</li>


				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'webspace/order" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-globe-americas"></i>
						</span>
						<span class="menu-text">'. $lang->getString("webhosting") .'</span>
					</a>
				</li>

				<li class="menu-section">
					<h4 class="menu-text">'. $lang->getString("further") .'</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'settings" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-cog"></i>
						</span>
						<span class="menu-text">'. $lang->getString("settings") .'</span>
					</a>
				</li>
				
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'affiliate" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-people-arrows"></i>
						</span>
						<span class="menu-text">'. $lang->getString("affiliatesystem") .'</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'access" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-keyboard"></i>
						</span>
						<span class="menu-text">'. $lang->getString("sharesoverview") .'</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'access/manage" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-keyboard"></i>
						</span>
						<span class="menu-text">'. $lang->getString("sharesmanage") .'</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'emaillog" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-mail-bulk"></i>
						</span>
					<span class="menu-text">'. $lang->getString("maillog") .'</span>
					</a>
				</li>

				<li class="menu-section">
					<h4 class="menu-text">'. $lang->getString("donationsandcoupons") .'</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'donation" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-link"></i>
						</span>
					<span class="menu-text">'. $lang->getString("donationsnav") .'</span>
					</a>
				</li>

				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'coupon" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-ticket-alt"></i>
						</span>
					<span class="menu-text">'. $lang->getString("coupons") .'</span>
					</a>
				</li>

				<li class="menu-section">
					<h4 class="menu-text">'. $lang->getString("accounting") .'</h4>
					<i class="menu-icon ki ki-bold-more-hor icon-md"></i>
				</li>
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'credit/add" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-euro-sign"></i>
						</span>
					<span class="menu-text">'. $lang->getString("addcredit") .'</span>
					</a>
				</li>
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'credit/history" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-money-check"></i>
						</span>
						<span class="menu-text">'. $lang->getString("transactions") .'</span>
					</a>
				</li>
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'invoice/list" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-file-invoice-dollar"></i>
						</span>
						<span class="menu-text">'. $lang->getString("invoices") .'</span>
					</a>
				</li>
				<li class="menu-item" aria-haspopup="true">
					<a href="' . $url . 'credit/limit" class="menu-link">
						<span class="svg-icon menu-icon">
							<i class="icon-xl fas fa-file-invoice-dollar"></i>
						</span>
						<span class="menu-text">'. $lang->getString("purchaseoninvoices") .'</span>
					</a>
				</li>
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Aside Menu-->
	</div>
	<!--end::Aside-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-1 mt-5 mt-lg-0">
                            <!--begin::Page Heading-->
                            <div class="d-flex align-items-baseline flex-wrap mr-5">
                                <!--begin::Page Title-->
                                <h4 class="text-dark font-weight-bold my-1 mr-5" id="masterPageTitle">'.$sidename.'</h4>
                                <!--end::Page Title-->
                            </div>
                            <!--end::Page Heading-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Topbar-->
                        <div class="topbar">
							<div class="dropdown mr-2">
								<!--begin::Toggle-->
								<div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
									<div class="btn btn-icon btn-bg-white btn-hover-primary btn-icon-primary btn-circle btn-dropdown">
										<img alt="Logo" src="' . $cdn . 'assets/media/svg/avatars/001-boy.svg" class="h-75 align-self-end" />
									</div>
								</div>
								<!--end::Toggle-->
								<!--begin::Dropdown-->
								<div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-127px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
									<!--begin::Nav-->
									<ul class="navi navi-hover py-4">
										<li class="navi-item">
											<a href="' . $url . 'settings" class="navi-link">
												<span class="navi-text">'. $lang->getString("settings") .'</span>
											</a>
										</li>
										<li class="navi-item">
											<a href="' . $url . 'logout" class="navi-link">
												<span class="navi-text">'. $lang->getString("logout") .'</span>
											</a>
										</li>
										<li class="navi-item" id="to_admin_button" style="display:none";>
											<a href="javascript:backtoadmin()" class="navi-link">
												<span class="navi-text">Admin Logout</span>
											</a>
										</li>
									</ul>
									<!--end::Nav-->
								</div>
								<!-end::Dropdown-->
							</div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
';
}

function getloadinghtml($id = "load", $hide = false)
{
    $hidehtml = '';
    if ($hide) {
        $hidehtml = 'style="display:none"';
    }
    return '
	<div id="' . $id . '" class="lds-roller" ' . $hidehtml . '><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>';
}

function minifypage()
{
    echo minifyhtml(ob_get_clean());
}

<?php

defined('3MBJ5lEBsoaN16re6GHb') or die();

function getdatatables($config)
{
    $cdn = $config->getconfigvalue('cdn');
    echo '
		<script src="' . $cdn . 'vendors/custom/datatables/datatables.bundle.js" type="text/javascript"></script>
		<link href="' . $cdn . 'vendors/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />';
}

function getheader($config, $pagetitle)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8" />
        <title>' . $pagetitle . '</title>
        <meta name="description" content="Admin Cp">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <script src="' . $cdn . 'js/webfont.min.js"></script>
		<script>WebFont.load({google:{families:["Poppins:300,400,500,600,700"]},active:function(){sessionStorage.fonts=!0}}); </script>

		<link href="' . $cdn . 'vendors/general/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/tether/dist/css/tether.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/nouislider/distribute/nouislider.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/dropzone/dist/dropzone.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/summernote/dist/summernote.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/animate.css/animate.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/morris.js/morris.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/socicon/css/socicon.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/custom/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/custom/vendors/flaticon/flaticon.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/custom/vendors/flaticon2/flaticon.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet"type="text/css" />

        <link href="' . $cdn . 'css/admin/style.bundle.min.css" rel="stylesheet" type="text/css" />
        <link href="' . $cdn . 'css/admin/brand.min.css" rel="stylesheet" type="text/css" />

        <link rel="shortcut icon" href="' . $url . 'favicon.png" />
    </head>';

}

function getscripts($config)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
	<div id="kt_scrolltop" class="kt-scrolltop">
		<i class="la la-arrow-up"></i>
	</div>
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
	<script src="' . $cdn . 'vendors/general/chart.js/dist/Chart.bundle.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/waypoints/lib/jquery.waypoints.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/counterup/jquery.counterup.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/lib.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/jquery.input.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/repeater.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/dompurify/dist/purify.min.js" type="text/javascript"></script>

	<script src="' . $cdn . 'js/admin/scripts.bundle.min.js" type="text/javascript"></script>';
}

function getloginheader($config, $pagetitle)
{
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    return '
    <html>
	<head>

		<meta charset="utf-8" />
		<title>' . $pagetitle . '</title>
		<meta name="description" content="Ph24 AdminCp - Login">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script src="' . $cdn . 'js/webfont.min.js"></script>
		<script>WebFont.load({google:{families:["Poppins:300,400,500,600,700"]},active:function(){sessionStorage.fonts=!0}}); </script>
		<link href="' . $cdn . 'css/admin/login-v1.min.css" rel="stylesheet" type="text/css" />

		<link href="' . $cdn . 'vendors/general/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/tether/dist/css/tether.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/nouislider/distribute/nouislider.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/dropzone/dist/dropzone.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/summernote/dist/summernote.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/animate.css/animate.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/toastr/build/toastr.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/morris.js/morris.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/socicon/css/socicon.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/custom/vendors/line-awesome/css/line-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/custom/vendors/flaticon/flaticon.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/custom/vendors/flaticon2/flaticon.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'vendors/general/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/admin/style.bundle.login.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/admin/light_base.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/admin/light_menu.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/admin/navy_brand.min.css" rel="stylesheet" type="text/css" />
		<link href="' . $cdn . 'css/admin/navy_aside.min.css" rel="stylesheet" type="text/css" />
		<link rel="shortcut icon" href="favicon.png" />
	</head>';
}

function getloginscripts($config)
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
	<script src="' . $cdn . 'vendors/general/chart.js/dist/Chart.bundle.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/custom/vendors/jquery-idletimer/idle-timer.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/waypoints/lib/jquery.waypoints.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/counterup/jquery.counterup.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/es6-promise-polyfill/promise.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/lib.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/jquery.input.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/jquery.repeater/src/repeater.min.js" type="text/javascript"></script>
	<script src="' . $cdn . 'vendors/general/dompurify/dist/purify.min.js" type="text/javascript"></script>';
}

function getnormalbody($config, $sidename, $user)
{
    
    $url = $config->getconfigvalue('url');
    $cdn = $config->getconfigvalue('cdn');
    $menustring = "";
    
    if ($user->checkright(33) || $user->checkright(46)) {
        $menustring .= '
		<li class="kt-menu__section ">
			<h4 class="kt-menu__section-text">Support</h4>
			<i class="kt-menu__section-icon flaticon-more-v2"></i>
		</li>';
        
        if ($user->checkright(33)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'support/tickets" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-server"></i>
					<span class="kt-menu__link-text">Tickets</span>
				</a>
			</li>';
        }
        if ($user->checkright(46)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'changelog" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-server"></i>
					<span class="kt-menu__link-text">Changelog</span>
				</a>
			</li>';
        }
    }
    
    if (($user->checkright(12)) || ($user->checkright(14)) || ($user->checkright(17))) {
        $menustring .= '
		<li class="kt-menu__section ">
			<h4 class="kt-menu__section-text">VServer</h4>
			<i class="kt-menu__section-icon flaticon-more-v2"></i>
		</li>';
        
        if ($user->checkright(12)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'vserver/nodes" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-server"></i>
					<span class="kt-menu__link-text">Nodes</span>
				</a>
			</li>';
        }
        
        if ($user->checkright(14)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'vserver/images" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-save"></i>
					<span class="kt-menu__link-text">Images</span>
				</a>
			</li>';
        }
        
        if ($user->checkright(38)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'vserver/packets" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-box-open"></i>
					<span class="kt-menu__link-text">Pakete</span>
				</a>
			</li>';
        }
        
        if ($user->checkright(44)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'vserver/lostvms" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-server"></i>
					<span class="kt-menu__link-text">LostVms</span>
				</a>
			</li>';
        }
    }
    
    if ($user->checkright(45)) {
        $menustring .= '
		<li class="kt-menu__section ">
			<h4 class="kt-menu__section-text">Domains</h4>
			<i class="kt-menu__section-icon flaticon-more-v2"></i>
		</li>';
        
        if ($user->checkright(44)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'domain/lostdomains" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-server"></i>
					<span class="kt-menu__link-text">LostDomains</span>
				</a>
			</li>';
        }
    }
    
    if (($user->checkright(2)) || ($user->checkright(5)) || ($user->checkright(2))) {
        $menustring .= '
		<li class="kt-menu__section ">
			<h4 class="kt-menu__section-text">Verwaltung</h4>
			<i class="kt-menu__section-icon flaticon-more-v2"></i>
		</li>';
        
        if ($user->checkright(2)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'kunden" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-users"></i>
					<span class="kt-menu__link-text">Kunden</span>
				</a>
			</li>';
        }
        
        if ($user->checkright(7)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'gruppen" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-users"></i>
					<span class="kt-menu__link-text">Gruppen</span>
				</a>
			</li>';
        }
        
        if ($user->checkright(5)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'rechte" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-gavel"></i>
					<span class="kt-menu__link-text">Rechte</span>
				</a>
			</li>';
        }
        
        if ($user->checkright(35)) {
            $menustring .= '
			<li class="kt-menu__item" aria-haspopup="true">
				<a href="' . $url . 'templates" class="kt-menu__link ">
					<i class="kt-menu__link-icon fas fa-envelope"></i>
					<span class="kt-menu__link-text">Email Templates</span>
				</a>
			</li>';
        }
        
        $menustring .= '
		<li class="kt-menu__item" aria-haspopup="true">
			<a href="' . $url . 'transactions" class="kt-menu__link ">
				<i class="kt-menu__link-icon fas fa-money-bill"></i>
				<span class="kt-menu__link-text">Transaktionen</span>
			</a>
		</li>';
        
        $menustring .= '
		<li class="kt-menu__item" aria-haspopup="true">
			<a href="' . $url . 'transactions" class="kt-menu__link ">
				<i class="kt-menu__link-icon fas fa-money-bill"></i>
				<span class="kt-menu__link-text">Transaktionen</span>
			</a>
		</li>';
    }
    $gruppenstring = "";
    foreach ($user->getGroups() as $gruppe) {
        $gruppenstring .= ',' . $gruppe;
    }
    return '
	<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
		<div class="kt-header-mobile__logo">
			<a href="' . $url . '">
				<h4 style="color:white;">ProHosting24</h4>
			</a>
		</div>
		<div class="kt-header-mobile__toolbar">
			<button class="kt-header-mobile__toolbar-toggler kt-header-mobile__toolbar-toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
			<button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
		</div>
	</div>
	<div class="kt-grid kt-grid--hor kt-grid--root">
		<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
			<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>
			<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
				<div class="kt-aside__brand   kt-grid__item" id="kt_aside_brand">
					<div class="kt-aside__brand-logo">
						<a href="' . $url . '">
							<h4 style="color:white;">ProHosting24</h4>
						</a>
					</div>
					<div class="kt-aside__brand-tools">
						<button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left" id="kt_aside_toggler"><span></span></button>
					</div>
				</div>
				<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
					<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
						<ul class="kt-menu__nav ">
							' . $menustring . '
						</ul>
					</div>
				</div>
			</div>
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper">
				<div id="kt_header" class="kt-header kt-grid__item " data-ktheader-minimize="on">
					<div class="kt-subheader   kt-grid__item" id="kt_subheader">
						<div class="kt-subheader__main">
							<h3 class="kt-subheader__title">' . $sidename . '</h3>
						</div>
					</div>
					<div class="kt-header__topbar">
						<div class="kt-header__topbar-item kt-header__topbar-item--user">
							<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
								<img alt="Pic" src="' . $cdn . 'img/default.jpg" />
							</div>
							<div
								class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-md">
								<div class="kt-user-card kt-margin-b-40 kt-margin-b-30-tablet-and-mobile">
									<div class="kt-user-card__wrapper">
										<div class="kt-user-card__pic">
											<img alt="Pic" src="' . $cdn . 'img/default.jpg" />
										</div>
										<div class="kt-user-card__details">
											<div class="kt-user-card__name" style="color: #506ee4;">' . $user->getVorname() . ' ' . $user->getNachname() . '</div>
											<div class="kt-user-card__position">' . substr($gruppenstring, 1) . '</div>
										</div>
									</div>
								</div>
								<ul class="kt-nav kt-margin-b-10">
									<li class="kt-nav__item">
										<a href="" class="kt-nav__link">
											<span class="kt-nav__link-icon"><i class="flaticon2-browser-2"></i></span>
											<span class="kt-nav__link-text">Meine Aufgaben(WIP)</span>
										</a>
									</li>
									<li class="kt-nav__item">
										<a href="" class="kt-nav__link">
											<span class="kt-nav__link-icon"><i class="flaticon2-gear"></i></span>
											<span class="kt-nav__link-text">Einstellungen(WIP)</span>
										</a>
									</li>
									<li class="kt-nav__item kt-nav__item--custom kt-margin-t-15">
										<a href="' . $url . 'logout" class="btn btn-label-brand btn-upper btn-sm btn-bold">Ausloggen</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">' . $sidename . '</h3>
        </div>
    </div>';
}

function getbodyfooter($config)
{
    $url = $config->getconfigvalue('url');
    return '</div>
				<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop">
					<div class="kt-footer__copyright">
						2017 - ' . date("Y") . '&nbsp;&copy;&nbsp;<a href="' . $url . '" target="_blank" class="kt-link">ProHosting24</a>
					</div>
					<div class="kt-footer__menu">
						<a href="' . $url . '" target="_blank" class="kt-footer__menu-link kt-link">Impressum</a>
						<a href="' . $url . '" target="_blank" class="kt-footer__menu-link kt-link">Datenschutz</a>
						<a href="' . $url . '" target="_blank" class="kt-footer__menu-link kt-link">AGB</a>
					</div>
				</div>
			</div>
		</div>
	</div>';
}

function getloadinghtml($id = "load")
{
    return '
	<div id="' . $id . '" class="sk-circle">
		<div class="sk-circle1 sk-child"></div>
		<div class="sk-circle2 sk-child"></div>
		<div class="sk-circle3 sk-child"></div>
		<div class="sk-circle4 sk-child"></div>
		<div class="sk-circle5 sk-child"></div>
		<div class="sk-circle6 sk-child"></div>
		<div class="sk-circle7 sk-child"></div>
		<div class="sk-circle8 sk-child"></div>
		<div class="sk-circle9 sk-child"></div>
		<div class="sk-circle10 sk-child"></div>
		<div class="sk-circle11 sk-child"></div>
		<div class="sk-circle12 sk-child"></div>
	</div>';
}

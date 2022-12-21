<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

echo minifyhtml(getloginheader($config, $lang->getString("customerarea") . " - ProHosting24",$lang));
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$frontendurl = $config->getconfigvalue('frontendurl');
$internapi = $config->getconfigvalue('internapi');

if(!isset($donationLinkInfo["displayname"])){
	$donationLinkInfo["displayname"] = "Error";
}

?>
<body class="kt-login-v2--enabled kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">
	<div class="kt-grid kt-grid--ver kt-grid--root">
		<div class="kt-grid__item   kt-grid__item--fluid kt-grid  kt-grid kt-grid--hor kt-login-v2" id="kt_login_v2">
			<div class="kt-grid__item  kt-grid--hor">
				<div class="kt-login-v2__head">
					<div class="kt-login-v2__logo">
						<a href="<?php echo $lang->getString("url"); ?>">
                            <img src="<?php echo $lang->getString("logourl"); ?>" alt="" height="77" />
						</a>
					</div>
				</div>
			</div>
			<div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">
				<div class="kt-login-v2__body">
					<div class="kt-login-v2__wrapper">
                        <div class="kt-login-v2__container" id="register_form">
							<div class="kt-login-v2__title">
								<h3><?php  echo $lang->getString("donatetoo") . $donationLinkInfo["displayname"]; ?></h3>
							</div>
							<form class="kt-login-v2__form kt-form" action="javascript:">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="<?php  echo $lang->getString("donateReason"); ?>" id="donate_reason" autocomplete="off">
                                </div>
                                <div class="form-group">
									<input class="form-control" type="number" placeholder="<?php  echo $lang->getString("donateamount"); ?>" id="donate_amount" autocomplete="off">
                                </div>
								<div class="form-group">
									<select class="form-control" id="donation_type">
                                        <option value="paypal" selected="selected">PayPal</option>
                                        <option value="stripecheckout">Stripe</option>
                                        <option value="paysafecard">PaySafeCard</option>
                                        <option value="sofort">Sofortüberweisung</option>
									</select>
								</div>
								<label class="kt-checkbox kt-checkbox--brand">
									<input type="checkbox" id="donate_checkbox"><?php echo $lang->getString("donatecheckbox"); ?></span>
									<span></span>
								</label>
								<div class="kt-login-v2__actions">
                                    <a class="kt-link kt-link--brand"></a>
                                    <button class="btn btn-brand btn-elevate btn-pill" id="donate_button" onclick="donate()"><?php echo $lang->getString("donate"); ?></button>
								</div>
							</form>
						</div>
					</div>
				</div>
            </div>
			<div class="kt-grid__item">
				<div class="kt-login-v2__footer">
					<div class="kt-login-v2__link">
						<a href="<?php echo $lang->getString("url") . "/" . $lang->getString("imprinturl"); ?>" class="kt-link kt-font-brand-footer"><?php echo $lang->getString("imprint"); ?></a>
						<a href="<?php echo $lang->getString("url") . "/" . $lang->getString("privacyurl"); ?>" class="kt-link kt-font-brand-footer"><?php echo $lang->getString("privacy"); ?></a>
                        <a href="<?php echo $lang->getString("url") . "/" . $lang->getString("tosurl"); ?>" class="kt-link kt-font-brand-footer"><?php echo $lang->getString("tos"); ?></a>
                        <a href="<?php echo $lang->getString("url") . "/" . $lang->getString("contacturl"); ?>" class="kt-link kt-font-brand-footer"><?php echo $lang->getString("contact"); ?></a>
					</div>
					<div class="kt-login-v2__info">
						<a href="#" class="kt-link">&copy; 2017 - <?php echo date("Y"); ?> ProHosting24</a>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
echo minifyhtml(getloginscripts($config,$lang));
if (isset($_COOKIE["ph24_notify_success"])) {
	echo "<script>toastr['success']('" . $_COOKIE["ph24_notify_success"] . "');Cookies.remove('ph24_notify_success');</script>";
}


?>
<script>
	var internApi = "<?php echo $config->getconfigvalue('internapi'); ?>";
    function donate() {
		if(!$('#donate_checkbox').is(":checked")){
			toastr["error"]('<?php  echo $lang->getString("donationchecknotchecked"); ?>');
			return;
		}
        amount = $('#donate_amount').val();
        reason = $('#donate_reason').val();
        type = $('#donation_type').val();
        loadButton('#donate_button');
		requestIntern({amount:amount,reason:reason,type:type,donationLink:'<?php echo $donationLinkInfo["name"]; ?>'},"startDonation",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
				loadButton('#donate_button',false);
            } else {
				Cookies.set('ph24_donation_message', reason);
				window.location.replace(respond.response);
			}
		});
	}

    function finishDonation(type, paymentid) {
        loadButton('#donate_button');
		requestIntern({paymentid: paymentid,token: findGetParameter('token'),payer: findGetParameter('PayerID'),type:type,reason: Cookies.get('ph24_donation_message')},"finishDonation",function(respond){
			if(respond.fail){
                toastr["error"]('<?php  echo $lang->getString("abortpayment"); ?>');
            } else {
                Cookies.set('ph24_notify_success', '<?php  echo $lang->getString("successdonation"); ?>');
                window.location.replace('<?php echo $url; ?>donate/<?php echo $donationLinkInfo["name"]; ?>');
			}
		});
    }

    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        var items = location.search.substr(1).split('&');
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split('=');
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }

    <?php
    if (isset($content[2])) {
        if ($content[2] == "error") {
            echo "toastr['error']('" .$lang->getString("successpayment"). "');";
        }
    } else {
        echo "
        if(findGetParameter('session') != null){
            finishDonation('stripecheckout',findGetParameter('session'));
        }
        if(findGetParameter('paymentId') != null){
            finishDonation('paypal',findGetParameter('paymentId'));
        }
        if(findGetParameter('payment_id') != null){
            finishDonation('paysafecard',findGetParameter('payment_id'));
        }
        if(findGetParameter('trx') != null){
            finishDonation('sofort',findGetParameter('trx'));
        }";
    }
    ?>
	
</script>
</body>
</html>

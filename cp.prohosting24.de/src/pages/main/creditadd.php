<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

$creditadd = requestBackend($config, [], "checkextracredit", $user->getLang())["response"];


echo minifyhtml(getheader($config, $lang->getString("addcredit") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("accounting"), $user, $lang));


if(isset($_GET["invoice"])){
	if(!is_numeric($_GET["invoice"])){
		header('Location: ' . $url);
        die();
	}
	$invoiceInfo = requestBackend($config, ["invoice" => $_GET["invoice"], "userid" => $user->getId()], "invoiceGetDetails", $user->getLang());
	if(!isset($invoiceInfo["response"])){
		header('Location: ' . $url);
        die();
	}
	$invoiceInfo = $invoiceInfo["response"];
	$invoiceValue = $invoiceInfo["sumGross"];
}

?>

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="card card-custom example example-compact">
						<div class="card-header">
							<h3 class="card-title"><?php  
							if(isset($donationLinkInfo)){
								echo $lang->getString("donate"); 
							} else {
								echo $lang->getString("addcredit"); 
							}
							?></h3>
						</div>
						<?php echo getloadinghtml("loading", true); ?>
						<div id="payment_main">
							<div class="card-body">
							<?php
									if(!isset($_GET["invoice"])){
										if ($creditadd != 0) {
											$creditadd[0] = $creditadd[0] + 1;
											echo '<div class="row">
											<div class="col-xl-3"></div>
											<div class="col-xl-6">
											<div class="alert alert-success" role="alert">
												<div class="alert-text">' . $creditadd[1] . '</div>
											</div>
											</div>
											<div class="col-xl-3"></div>
											</div>';
										}
									}
									?>
								<div class="form-group m-0">
									<label><?php  echo $lang->getString("chosepayment"); ?></label>
									<div class="row">
										<div class="col-lg-6">
											<label class="option">
												<span class="option-control">
													<span class="radio">
														<input type="radio" id="payment_paypal" name="m_option_1" value="1" checked="checked"/>
														<span></span>
													</span>
												</span>
												<span class="option-label">
													<span class="option-head">
														<span class="option-focus">PayPal</span>
													</span>
													<span class="option-body"><?php  echo $lang->getString("paypalt"); ?></span>
												</span>
											</label>
										</div>
										<div class="col-lg-6">
											<label class="option">
												<span class="option-control">
													<span class="radio">
														<input type="radio" id="payment_stripe" name="m_option_1" value="1"/>
														<span></span>
													</span>
												</span>
												<span class="option-label">
													<span class="option-head">
														<span class="option-focus">Stripe</span>
													</span>
													<span class="option-body"><?php  echo $lang->getString("stripet"); ?></span>
												</span>
											</label>
										</div>
									</div>
                                    <div class="row">
										<div class="col-lg-6">
											<label class="option">
												<span class="option-control">
													<span class="radio">
														<input type="radio" id="payment_psc" name="m_option_1" value="1"/>
														<span></span>
													</span>
												</span>
												<span class="option-label">
													<span class="option-head">
														<span class="option-focus">paysafecard</span>
													</span>
													<span class="option-body"><?php  echo $lang->getString("paysafecardt"); ?></span>
												</span>
											</label>
										</div>
										<div class="col-lg-6">
											<label class="option">
												<span class="option-control">
													<span class="radio">
														<input type="radio" id="payment_sofort" name="m_option_1" value="1"/>
														<span></span>
													</span>
												</span>
												<span class="option-label">
													<span class="option-head">
														<span class="option-focus">Sofort</span>
													</span>
													<span class="option-body"><?php  echo $lang->getString("sofortt"); ?></span>
												</span>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group row mb-6">
								<label class="col-form-label text-right col-lg-3 col-sm-12"><?php  echo $lang->getString("ammount"); ?>:</label>
									<div class="col-lg-6 col-md-12 col-sm-12">
										<div class="row align-items-center">
											<div class="col-4">
												<input type="text" class="form-control" id="payment_slider_val"  placeholder="Currency"
												
												<?php
												if(isset($_GET["invoice"])){
													echo ' value="' . $invoiceValue . '" disabled';
												}
												?>
												/>
											</div>
											<div class="col-8">
												<?php
												if(!isset($_GET["invoice"])){
													echo '<div id="payment_slider" class="nouislider nouislider-handle-danger"></div>';
												}
												?>
											</div>
										</div>
									<span class="form-text text-muted mt-6"></span>
									</div>
								</div>
							</div>                                            
							<div class="card-footer">
								<button id="payment_button" type="reset" class="btn btn-primary mr-2" onClick="startpayment()"><?php  echo $lang->getString("next"); ?></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php
echo minifyhtml(getscripts($config, $lang));
?>

<script>
	var slider = document.getElementById('payment_slider');
	var paymentMethod = "";
	<?php
	if(isset($_GET["invoice"])){
		echo "var invoice = " . $_GET["invoice"] . ";";
		echo "var currentValue = " . $invoiceValue . ";";
	} else {
		if(isset($_GET["shouldBuy"])){
			if(is_numeric($_GET["shouldBuy"])){
				echo "var currentValue = " . $_GET["shouldBuy"] . ";";
			} else {
				echo "var currentValue = 1;";				
			}
		} else {
			echo "var currentValue = 1;";
		}
		echo "var invoice = 0;";
	}
	?>

	function startpayment() {
        if (currentValue == '') {
            toastr["error"]('<?php  echo $lang->getString("specifyamount"); ?>');
            return;
		}
		if($('#payment_paypal').is(":checked")){
            paymentMethod = "paypal";
		}
		if($('#payment_stripe').is(":checked")){
            paymentMethod = "stripecheckout";
		}
		if($('#payment_psc').is(":checked")){
            paymentMethod = "paysafecard";
		}
		if($('#payment_sofort').is(":checked")){
            paymentMethod = "sofort";
		}
       	$('#loading').show();
		$('#payment_main').hide();
		loadButton('#payment_button');
		if(findGetParameter('closeSuccess') == 1){
			closeSuccess = 1;
		} else {
			closeSuccess = 0;
		}
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), amount: currentValue, method: paymentMethod, invoice:invoice, closeSuccess:closeSuccess<?php 
		if(isset($donationLinkInfo)){
			echo ",donationLink: '" . $donationLinkInfo["name"] . "'";
		} ?>},"startpayment",function(respond){
			if(respond.fail){
				toastr["error"](respond.error);
				loadButton('#payment_button',false);
				$('#load').hide();
				$('#payment_main').show();
            } else {
				window.location.replace(respond.response);
			}
		});
	}
	
	function finishpayment(method, paymentid) {
        $('#loading').show();
		$('#payment_main').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), paymentid: paymentid,token: findGetParameter('token'),payer: findGetParameter('PayerID'),method: method},"finishpayment",function(respond){
			if(respond.fail){
                toastr["error"]('<?php  echo $lang->getString("abortpayment"); ?>');
            } else {
				if(findGetParameter('closeSuccess') == 1){
					window.close();
					return;
				}
				Cookies.set('ph24_notify_success', '<?php  echo $lang->getString("successpayment"); ?>');
                window.location.replace('<?php echo $url; ?>credit/history');
			}
			$('#payment_main').hide();
			$('#mastercredit').show();
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
            echo "toastr['error']('" .$lang->getString("abortpayment"). "');";
        }
    } else {
        echo "
        if(findGetParameter('session') != null){
            finishpayment('stripecheckout',findGetParameter('session'));
        }
        if(findGetParameter('paymentId') != null){
            finishpayment('paypal',findGetParameter('paymentId'));
        }
        if(findGetParameter('payment_id') != null){
            finishpayment('paysafecard',findGetParameter('payment_id'));
        }
        if(findGetParameter('trx') != null){
            finishpayment('sofort',findGetParameter('trx'));
        }";
    }
    ?>

    noUiSlider.create(slider, {
        start: [ currentValue ],
        step: 0.01,
        range: {
            'min': [ 1 ],
            'max': [ 500 ]
        },
        format: wNumb({
            decimals: 2
        })
    });
    var sliderInput = document.getElementById('payment_slider_val');
    slider.noUiSlider.on('update', function( values, handle ) {
		sliderInput.value = values[handle];
		currentValue = values[handle];
    });
    sliderInput.addEventListener('change', function(){
		value = parseFloat(this.value.replace(",", "."));
		console.log(value);
		slider.noUiSlider.set(value);
		currentValue = value;
	});
</script>
<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
echo minifyhtml(getheader($config, $lang->getString("coupons") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("coupons"), $user, $lang));

?>

					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<div class="row">
									<div class="col-md-6">
										<!--begin::Card-->
										<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title"><?php echo $lang->getString("buycoupon"); ?></h3>
											</div>
											<div class="card-body">
												<div class="form-group">
													<label><?php echo $lang->getString("ammount"); ?></label>
													<input class="form-control" id="couponOrderAmount" type="number"><br>
                                                    <span><?php echo $lang->getString("couponorderinfo"); ?></span>
												</div>
												<label class="checkbox">
													<input type="checkbox" id="couponOrderConfirm">
													<span></span>
													&nbsp;<?php echo $lang->getString("couponorderconfirm") ?>
												</label>
											</div>
											<div class="card-footer">
                                            	<button class="btn btn-primary" id="couponorderbutton" onClick="orderCoupon()"><?php echo $lang->getString("order"); ?></button>
											</div>
										</div>
										<!--end::Card-->
                                    </div>
                                    <div class="col-md-6">
										<!--begin::Card-->
										<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title"><?php echo $lang->getString("redeemcoupon"); ?></h3>
											</div>
											<div class="card-body">
												<div class="form-group">
													<label><?php echo $lang->getString("coupon"); ?></label>
													<input class="form-control" id="coupon" placeholder="ph24-xxxx-xxxx-xxxx-xxxx"><br><br><br>
												</div>
											</div>
											<div class="card-footer">
                                            	<button class="btn btn-primary" id="couponredeembutton" onClick="redeemCoupon()"><?php echo $lang->getString("redeem"); ?></button>
											</div>
										</div>
										<!--end::Card-->
                                    </div>
								</div>
								<div class="card card-custom gutter-b">
									<div class="card-header flex-wrap py-3">
										<div class="card-title">
											<h3 class="card-label"><?php echo $lang->getString("couponlist"); ?></h3>
										</div>
									</div>
									<div class="card-body">
									<?php echo getloadinghtml("coupon_table_load", true); ?>
										<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="coupon_table" style="display:none">
											<thead>
												<tr>
													<th><?php echo $lang->getString("name"); ?></th>
													<th><?php echo $lang->getString("ammount"); ?></th>
													<th><?php echo $lang->getString("created"); ?></th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<!--end::Entry-->
					</div>
					<!--end::Content-->
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
<?php

echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . $lang->getString("datatablebundleurl1") . '"></script>';
?>

<script>

	function getCoupons() {
		$('#coupon_table').hide();
		$('#coupon_table_load').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getCoupons",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#coupon_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					$('#coupon_table').DataTable().row.add( [
						element.name,
                        element.amount,
						element.created_on
					] ).draw( false );
				});
				$('#coupon_table').show();
				$('#coupon_table_load').hide();
			}
		});
	}

	function orderCoupon() {
		if(!$('#couponOrderConfirm').is(":checked")){
			toastr["error"]('<?php echo $lang->getString("couponcheckmissing"); ?>');
			return;
		}
        amount = $('#couponOrderAmount').val();
        loadButton('#couponorderbutton');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), amount:amount},"orderCoupon",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("couponcreated") ?>');
                getCoupons();
                $('#couponOrderAmount').val('');
				$("#couponOrderConfirm").prop( "checked", false );
			}
			loadButton('#couponorderbutton',false);
		});
    }


	function redeemCoupon() {
		coupon = $('#coupon').val();
        loadButton('#couponredeembutton');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), coupon:coupon},"redeemCoupon",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("couponredeemed") ?>');
                getCoupons();
                $('#coupon').val('');
			}
			loadButton('#couponredeembutton',false);
		});
	}
	$('#coupon_table').DataTable({
        "responsive": true,
        "paging": false,
        "order": false,
        "searching": false,
        "info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage");?>"
        }
    });
	getCoupons();

</script>

</body>
</html>

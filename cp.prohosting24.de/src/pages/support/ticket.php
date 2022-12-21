<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

echo minifyhtml(getheader($config, "Support - Ticket - Details - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, "Support - Ticket - Details", $user, $lang));

?>
					<!--begin::Content-->
					<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
						<!--begin::Entry-->
						<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">
								<!--begin::Inbox-->
								<div class="d-flex flex-row">
									<!--begin::Sidebar-->
									<!--begin::List-->
									<div class="flex-row-fluid ml-lg-8 d-block" id="kt_inbox_list">
										<!--begin::Card-->
										<div class="card card-custom card-stretch">
											<!--begin::Header-->
											<div class="card-header row row-marginless align-items-center flex-wrap py-5 h-auto">
												<div class="col-10-xl col-4-sm">
													<h3><?php echo $lang->getString("ticketoverview") ?></h3><p><?php echo $lang->getString("ticketoverviewt") ?></p>
												</div>

												<div class="col-2-xl col-8-sm">
													<a href="#" class="btn btn-block btn-primary font-weight-bold text-uppercase py-4 px-6 text-center" data-toggle="modal" data-target="#kt_inbox_compose"><?php echo $lang->getString("createticket") ?></a>
												</div>
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body table-responsive px-0">
												<!--begin::Items-->
												<?php echo getloadinghtml("loading"); ?>
												<div id="ticket_master" class="list list-hover min-w-500px" data-inbox="list">
												</div>
												<!--end::Items-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end::List-->
									<!--begin::View-->
									<div class="flex-row-fluid ml-lg-8 d-none" id="kt_inbox_view">
										<!--begin::Card-->
										<div class="card card-custom card-stretch">
											<!--begin::Header-->
											<div class="card-header align-items-center flex-wrap justify-content-between py-5 h-auto">
												<!--begin::Left-->
												<div class="d-flex align-items-center my-2">
													<a href="#" class="btn btn-clean btn-icon btn-sm mr-6" data-inbox="back">
														<i class="flaticon2-left-arrow-1"></i>
													</a>
												</div>
												<!--end::Left-->
												<!--begin::Right-->
												<div class="d-flex align-items-center justify-content-end text-right my-2">
												</div>
												<!--end::Right-->
											</div>
											<!--end::Header-->
											<!--begin::Body-->
											<div class="card-body p-0">
												<?php echo getloadinghtml("loading_details"); ?>
												<div id="ticket_details_master" style="display:none;">
												</div>
												<div class="card-spacer mb-3" id="kt_inbox_reply">
													<div class="card card-custom shadow-sm">
														<div class="card-body p-0">
															<!--begin::Form-->
															<form id="kt_inbox_reply_form">
																<!--begin::Body-->
																<div class="d-block">
																	<!--end::Subject-->
																	<!--begin::Message-->
																	<div id="kt_inbox_reply_editor" class="border-0" style="height: 250px"></div>
																	<!--end::Message-->
																</div>
																<!--end::Body-->
																<!--begin::Footer-->
																<div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
																	<!--begin::Actions-->
																	<div class="d-flex align-items-center mr-3">
																		<!--begin::Send-->
																		<div class="btn-group mr-4">
																			<span id="action_answer_ticket" onClick="sendTicketAnswer()" class="btn btn-primary font-weight-bold px-6"><?php echo $lang->getString("answerticket") ?></span>
																		</div>
																	</div>
																</div>
                                                            <!--end::Footer-->
															</form>
															<!--end::Form-->
														</div>
													</div>
												</div>
												<!--end::Reply-->
											</div>
											<!--end::Body-->
										</div>
										<!--end::Card-->
									</div>
									<!--end::View-->
								</div>
								<!--end::Inbox-->
								<!--begin::Compose-->
								<div class="modal modal-sticky modal-sticky-lg modal-sticky-bottom-right" id="kt_inbox_compose" role="dialog" data-backdrop="false">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<!--begin::Form-->
											<form id="kt_inbox_compose_form">
												<!--begin::Header-->
												<div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-bottom">
													<h5 class="font-weight-bold m-0"><?php echo $lang->getString("createticket") ?></h5>
													<div class="d-flex ml-2">
														<span class="btn btn-clean btn-sm btn-icon" data-dismiss="modal">
															<i class="ki ki-close icon-1x"></i>
														</span>
													</div>
												</div>
												<!--end::Header-->
												<!--begin::Body-->
												<div class="d-block">
													<!--begin::Subject-->
													<div class="border-bottom">
														<input id="ticket_title" class="form-control1 border-0 px-8 min-h-45px" name="compose_subject" placeholder="Titel" />
													</div>
													<!--end::Subject-->
													<!--begin::Message-->
													<div id="kt_inbox_compose_editor" class="border-0" style="height: 250px"></div>
													<!--end::Message-->
												</div>

												<!--end::Body-->
												<!--begin::Footer-->
												<div class="d-flex align-items-center justify-content-between py-5 pl-8 pr-5 border-top">
													<!--begin::Actions-->
													<div class="d-flex align-items-center mr-3">
														<!--begin::Send-->
															<span id="action_submit_ticket" onClick="sendTicket()" class="btn btn-primary font-weight-bold px-6"><?php echo $lang->getString("ticketsend") ?></span>
													</div>
													<!--end::Actions-->
												</div>
												<!--end::Footer-->
											</form>
											<!--end::Form-->
										</div>
									</div>
								</div>
								<!--end::Compose-->
							</div>
							<!--end::Container-->
						</div>
						<!--end::Entry-->
					</div>

<?php
echo minifyhtml(getscripts($config, $lang));
echo '<script src="' . $cdn . 'assets/js/pages/custom/inbox/inbox.js?v=2.0.3"></script>';


?>

<script>
	var activeTicket = 0;
	function getTickets(){
		requestIntern({sessionid:Cookies.get('ph24_sessionid')},"getSupportTickets",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#ticket_master').html(respond.response);
				$('#loading').hide();
				$('#ticket_master').show();
			}
		});
	}

	function sendTicket(){
		title = $('#ticket_title').val();
		if(title == ''){
			toastr["error"]('<?php echo $lang->getString("ticketnosubject") ?>');
			return;
		}
		text = $('#kt_inbox_compose_editor').children().html();
		if(text == ''){
			toastr["error"]('<?php echo $lang->getString("ticketnotext") ?>');
			return;
		}
		loadButton('#action_submit_ticket');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), title:title,text:text},"createticket",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				getTickets();
				toastr["success"]("<?php echo $lang->getString("ticketmsgcreate") ?>");
				$('#kt_inbox_compose').modal('hide');
				$('#loading').show();
				$('#ticket_master').hide();
			}
			loadButton('#action_submit_ticket',false);
		});
	}

	function sendTicketAnswer(){
		text = $('#kt_inbox_reply_editor').children().html();
		if(text == ''){
			toastr["error"]('<?php echo $lang->getString("ticketnotext") ?>');
			return;
		}
		loadButton('#action_answer_ticket');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), ticketid:activeTicket,text:text},"answerTicket",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#kt_inbox_reply_editor').children().html('');
				getTicketDetails(activeTicket);
				toastr["success"]("<?php echo $lang->getString("ticketmsgreply") ?>");
			}
			loadButton('#action_answer_ticket',false);
		});
	}

	function getTicketDetails(id){
		activeTicket = id;
		$('#loading_details').show();
		$('#ticket_details_master').hide();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),ticketid:id},"getSupportTicketDetail",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#ticket_details_master').html(respond.response)
				$('#ticket_details_master').show();
				$('#loading_details').hide();
			}
		});
	}

	function closeTicket(id){
		loadButton('#action_close_ticket' + id, true, false);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'),ticketid:id},"closesupportticket",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("<?php echo $lang->getString("ticketmsgdelete") ?>");
				getTickets();
				$('#loading').show();
				$('#ticket_master').hide();
			}
		});
	}

	getTickets();
	<?php
		if(isset($content[2])){
			echo "getTicketDetails(" . $content[2] . ");";
			echo "KTAppInbox.loadTicket();";
		}
	?>
</script>
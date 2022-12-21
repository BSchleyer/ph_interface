<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
if(!isset($access)){
	$access = false;
	$rights = [];
}

if(!$access){
	if (!isset($content[2]) || $content[2] == "") {
		header('Location:' . $url . "service");
		die();
	}
	if(!is_numeric($content[2])){
		header('Location:' . $url . "service");
		die();
	}
	$serviceId = $content[2];
}

$classes = new ClassNamer();

echo minifyhtml(getheader($config, $lang->getString("dnsmanagement") . " - ProHosting24", $lang));

echo minifyhtml(getnormalbody($config, $lang->getString("dnsmanagement"), $user, $lang));

?>

	<!--begin::Content-->
	<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
		<!--begin::Entry-->
		<div class="d-flex flex-column-fluid">
			<!--begin::Container-->
			<div class="container">
				<div class="row">
                	<div class="col-lg-8">
                    	<div class="card card-custom card-stretch gutter-b">
                        	<div class="card-header ribbon ribbon-top border-0 pt-7">
								<div class="ribbon-target bg-success" style="top: -2px; right: 20px;"><?php echo $lang->getString("active") ?></div>
								<h3 class="card-title"><?php echo $lang->getString("generalinfo") ?></h3>
                        	</div>
							<div class="card-body">
								<div class="row">
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("domain") ?>:<br><span class="text-dark-75 font-size-lg" id="domain_info_domain"></span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><br><span class="text-dark-75 font-size-lg"></span></span>
									</div>
									<div class="col-xl-6 bottom15">
                                        <span class="text-dark-75 font-size-h5"><?php echo $lang->getString("nameserver") ?>:<br><span class="text-dark-75 font-size-lg" id="domain_info_ns"></span></span>
									</div>
									<div class="col-xl-6 bottom15">
										<span class="text-dark-75 font-size-h5"><?php echo $lang->getString("serviceexpire") ?><br><span class="text-dark-75 font-size-lg" id="domain_infos_time"></span></span>
									</div>
								</div>
							</div>
                    	</div>
                	</div>
                	<div class="col-lg-4">
                    	<div class="card card-custom card-stretch gutter-b">
                        	<div class="card-header border-0 pt-6">
                            	<h3 class="card-title align-items-start flex-column">
                                	<span class="card-label font-weight-bolder font-size-h4 text-dark-75"><?php echo $lang->getString("actions") ?></span>
                             	</h3>
                         	</div>
							 <div class="card-body">
                                <div class="row">
                                    <?php
									if(!$access or isset($rights[25])){
									?>
									<div class="col bottom15">
										<a href="#" class="btn btn-outline-primary font-weight-bold col" type="button" data-toggle="modal" onClick="<?php echo $classes->getclassname("opendnsmodal"); ?>()"><?php echo $lang->getString("createentry") ?></a>
									</div>
                                    <?php
                                    }
                                    if(!$access){
                                    ?>
									<div class="col bottom15">
                                    <a href="#" class="btn btn-outline-primary font-weight-bold col" id="domain_renew" data-toggle="modal" data-target="#domain_renew_modal"><?php echo $lang->getString("serviceextend") ?></a>
									</div>
                                    <?php
                                    }
                                    ?>
								</div>
								<div class="row">
                                    <?php
									if(!$access or isset($rights[27])){
									?>
									<div class="col bottom15">
										<a href="#" class="btn btn-outline-primary font-weight-bold col" type="button" id="domain_mailbox_create" data-toggle="modal" data-target="#domain_mailbox_create_modal"><?php echo $lang->getString("createmailbox") ?></a>
									</div>
                                    <?php
                                    }
                                    if(!$access or isset($rights[26])){
                                    ?>
									<div class="col bottom15">
										<a href="#" class="btn btn-outline-primary font-weight-bold col" type="button" data-toggle="modal" data-target="#domain_ns_change_modal"><?php echo $lang->getString("nameserver") ?></a>
									</div>
                                    <?php
                                    }
                                    ?>
								</div>
								<div class="row">
                                <?php
									if(!$access or isset($rights[27])){
									?>
									<div class="col bottom15">
										<a href="#" class="btn btn-outline-primary font-weight-bold col" type="button" id="domain_mailbox_create_dns" data-toggle="modal" data-target="#domain_mailbox_create_dns_modal"><?php echo $lang->getString("installmailbox") ?></a>
									</div>
                                    <?php
                                    }
                                    if(!$access or isset($rights[27])){
                                    ?>
									<div class="col bottom15">
										<a href="#" class="btn btn-outline-primary font-weight-bold col" type="button" class="btn btn-outline-primary btn-huge" onclick="window.open('https://mail.promailserver24.eu/SOGo/', '_blank').focus();"><?php echo $lang->getString("maillogin") ?></a>
									</div>
                                    <?php
                                    }
                                    ?>
								</div>
							</div>
                    	</div>
                	</div>
            	</div>
				<div class="row">
                	<div class="col">
                    	<div class="card card-custom card-stretch gutter-b">
                        	<div class=" border-0 pt-7">
								<ul class="nav nav-tabs nav-tabs-line justify-content-center">
                                    <?php
									if(!$access or isset($rights[25])){
									?>
									<li class="nav-item">
								    	<a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_1" onclick="">
								            <span class="nav-icon"><i class="flaticon-map"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("dnsmanagement") ?></span>
								        </a>
								    </li>
                                    <?php
                                    }
									if(!$access or isset($rights[27])){
									?>
								    <li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_2" onclick="loadMailBox()">
								            <span class="nav-icon"><i class="flaticon-folder-3"></i></span>
								            <span class="nav-text"><?php echo $lang->getString("mailbox") ?></span>
								        </a>
								    </li>
                                    <?php
                                    }
                                    if(!$access){
									?>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#kt_tab_pane_7" onClick="getAccessList()">
											<span class="nav-icon"><i class="flaticon-list-2"></i></span>
											<span class="nav-text"><?php echo $lang->getString("shares") ?></span>
										</a>
									</li>
									<?php
									}
                                    ?>
								</ul>
                            </div>
							<div class="tab-content mt-5 col" id="myTabContent">
                            <?php
									if(!$access or isset($rights[25])){
									?>
								<div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_2">
									<div class="card-body">
                                        
										<table class="table table-breakword table-separate table-head-custom" style="width:100%;word-break:break-all;" id="dns_entrys">
											<thead>
												<tr>
													<th><?php echo $lang->getString("type") ?></th>
													<th><?php echo $lang->getString("name") ?></th>
													<th><?php echo $lang->getString("content") ?></th>
													<th><?php echo $lang->getString("action") ?></th>
												</tr>
											</thead>
										</table>
										<!--end: Datatable-->
									</div>
								</div>
                                <?php
                                    }
										if(!$access){
										?>
										<div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel" aria-labelledby="kt_tab_pane_7">
											<?php echo getloadinghtml("access_list"); ?>
											<div id="access_list_master" style="display:none;">
												<button class="btn btn-outline-primary" type="button" onclick="openAccessNew()"><?php echo $lang->getString("createaccess") ?></button>
												<table class="table table-separate table-head-custom table-checkable dataTable no-footer" id="access_list_table">
													<thead>
														<tr>
															<th><?php echo $lang->getString("name") ?></th>
															<th><?php echo $lang->getString("state") ?></th>
															<th><?php echo $lang->getString("actions") ?></th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
										<?php
										}
										if(!$access or isset($rights[27])){
                                            ?>
                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
   									<div class="card-body">
										<table class="table table-separate table-head-custom" id="domain_mail_table">
											<thead>
												<tr>
                                                    <th><?php echo $lang->getString("name") ?></th>
                                                    <th><?php echo $lang->getString("manage") ?></th>
												</tr>
											</thead>
										</table>
										<!--end: Datatable-->
									</div>
                                </div>
                                <?php
                                    }
                                ?>
							</div>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
    


<text id="dnswarning" style="display:none; text-align:center"><?php echo $lang->getString("useourdns") ?></text>
<div id="dnsmanagement_main" style="display:none">
</div>
<div>

<div class="modal fade" id="domain_dns_modal" tabindex="-1" role="dialog" aria-labelledby="domain_dns_modalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="domain_dns_modalLabel"><?php echo $lang->getString("createentry") ?></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <div class="modal-body">
                <div class="form-group" id="typegroup">
			    	<label for="typeselect">Type:</label>
			    	<select class="form-control" id="typeselect" onChange="<?php echo $classes->getclassname("reloaddnscreator"); ?>();">
			    		<option value="A">A</option>
			    		<option value="AAAA">AAAA</option>
			    		<option value="CNAME">CNAME</option>
                        <option value="MX">MX</option>
                        <option value="SRV">SRV</option>
                        <option value="TXT">TXT</option>
                        <option value="TS">Teamspeak</option>
                        <option value="MC">Minecraft</option>
			    	</select>
                </div>
                <div class="form-group" id="subdomaingroup">
				    <label><?php echo $lang->getString("name") ?>: (<?php echo $lang->getString("@rootdomain"); ?>)</label>
			    	<input type="text" class="form-control" id="subdomain">
                </div>
                <div class="form-group" id="ipv4group">
				    <label>IPv4:</label>
			    	<input type="text" class="form-control" id="ipv4">
                </div>
                <div class="form-group" id="ipv6group">
				    <label>IPv6:</label>
			    	<input type="text" class="form-control" id="ipv6">
                </div>
                <div class="form-group" id="targetgroup">
				    <label><?php echo $lang->getString("target"); ?>:</label>
			    	<input type="text" class="form-control" id="target">
                </div>
                <div class="form-group" id="mailservergroup">
				    <label><?php echo $lang->getString("mailserver") ?>:</label>
			    	<input type="text" class="form-control" id="mailserver">
                </div>
                <div class="form-group" id="prioritygroup">
				    <label><?php echo $lang->getString("priority") ?>:</label>
			    	<input type="number" class="form-control" id="priority">
                </div>
                <div class="form-group" id="portgroup">
				    <label>Port:</label>
			    	<input type="number" class="form-control" id="port">
                </div>
                <div class="form-group" id="weightgroup">
				    <label><?php echo $lang->getString("weight") ?>:</label>
			    	<input type="number" class="form-control" id="weight">
                </div>
                <div class="form-group" id="servicenamegroup">
				    <label><?php echo $lang->getString("target") ?>:</label>
			    	<input type="text" class="form-control" id="servicename" placeholder="">
                </div>
                <div class="form-group" id="serviceipgroup">
				    <label>Server IP:</label>
			    	<input type="text" class="form-control" id="serviceip" placeholder="">
                </div>
                <div class="form-group" id="serviceportgroup">
				    <label>Server Port:</label>
			    	<input type="number" class="form-control" id="serviceport" placeholder="">
                </div>
                <div class="form-group" id="protocolgroup">
			    	<label for="protocol"><?php echo $lang->getString("protocol") ?>:</label>
			    	<select class="form-control" id="protocol">
			    		<option value="tcp">TCP</option>
			    		<option value="udp">UDP</option>
			    	</select>
                </div>
                <div class="form-group" id="contentgroup">
                    <label><?php echo $lang->getString("content") ?>:</label>
                    <textarea class="form-control" id="content" rows="3"></textarea>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                <button type="button" class="btn btn-primary" id="editDnsEntryButton" onclick="editDNSEntry()"><?php echo $lang->getString("save") ?></button>
                <button type="button" class="btn btn-primary" id="domain_dns_button" onclick="<?php echo $classes->getclassname("adddnsentry"); ?>()"><?php echo $lang->getString("save") ?></button>
                <button class="btn btn-primary" id="domain_dns_button_load" type="button" aria-disabled="true" style="display:none">
				    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
				    <span >Loading...</span>
			    </button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="domain_ns_change_modal" tabindex="-1" role="dialog" aria-labelledby="domain_ns_change_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_ns_change_modalLabel"><?php echo $lang->getString("changenameserver") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo $lang->getString("nameserver") ?> 1:</label>
                        <input type="text" class="form-control" id="editns_1">
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang->getString("nameserver") ?> 2:</label>
                        <input type="text" class="form-control" id="editns_2">
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang->getString("nameserver") ?> 3:</label>
                        <input type="text" class="form-control" id="editns_3">
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang->getString("nameserver") ?> 4:</label>
                        <input type="text" class="form-control" id="editns_4">
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang->getString("nameserver") ?> 5:</label>
                        <input type="text" class="form-control" id="editns_5">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-outline-primary" onClick="resetDNSServer()"><?php echo $lang->getString("resetdnsserver") ?></button>
                    <button type="button" class="btn btn-primary" id="domain_ns_button" onclick="<?php echo $classes->getclassname("changensserver"); ?>()"><?php echo $lang->getString("save") ?></button>
                    <button class="btn btn-primary" id="domain_ns_button_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="domain_mailbox_create_modal" tabindex="-1" role="dialog" aria-labelledby="domain_mailbox_create_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_mailbox_create_modalLabel"><?php echo $lang->getString("createmailbox") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label><?php echo $lang->getString("username") ?>:</label>
                        <input type="text" class="form-control" id="domain_mailbox_username_modal">
                    </div>
                    <div class="form-group">
                        <label><?php echo $lang->getString("name") ?>:</label>
                        <input type="text" class="form-control" id="domain_mailbox_name_modal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-primary" id="domain_mailbox_button_modal" onclick="createMailBox()"><?php echo $lang->getString("createmailbox") ?></button>
                    <button class="btn btn-primary" id="domain_mailbox_button_modal_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="domain_mailbox_create_password_modal" tabindex="-1" role="dialog" aria-labelledby="domain_mailbox_create_password_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_mailbox_create_password_modalLabel"><?php echo $lang->getString("mailboxpassword") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("mailboxpasswordt1") ?>:<br><br><?php echo $lang->getString("username") ?>: <text id="domain_mailbox_create_password_username_modal"> </text><br><?php echo $lang->getString("password") ?>: <text id="domain_mailbox_create_password_password_modal"> </text><br>
                        <br><?php echo $lang->getString("mailboxpasswordt2") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-success" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="domain_mailbox_delete_modal" tabindex="-1" role="dialog" aria-labelledby="domain_mailbox_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_mailbox_delete_modalLabel"><?php echo $lang->getString("deletemailbox") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("deletemailboxsure") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-danger" id="domain_mailbox_delete_button_modal" onclick="deleteMailBox()"><?php echo $lang->getString("delete") ?></button>
                    <button class="btn btn-danger" id="domain_mailbox_delete_button_modal_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="domain_dns_delete_modal" tabindex="-1" role="dialog" aria-labelledby="domain_dns_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_dns_delete_modalLabel"><?php echo $lang->getString("deletednsentry") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("deletednsentrysure") ?></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-danger" id="domain_dns_delete_button_modal" onclick="deleteDNSEntry()"><?php echo $lang->getString("delete") ?></button>
                    <button class="btn btn-danger" id="domain_dns_delete_button_modal_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="domain_mailbox_create_dns_modal" tabindex="-1" role="dialog" aria-labelledby="domain_mailbox_create_dns_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_mailbox_create_dns_modalLabel"><?php echo $lang->getString("createmailboxentrys") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $lang->getString("dnsentrysoverwritten") ?><table class="table table-striped- table-hover" id="domain_mailbox_create_dns_table_modal">
                        <thead>
                            <tr>
                                <th><?php echo $lang->getString("name") ?></th>
                                <th><?php echo $lang->getString("type") ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-danger" id="domain_mailbox_create_dns_button_modal" onclick="setMailBox()"><?php echo $lang->getString("save") ?></button>
                    <button class="btn btn-danger" id="domain_mailbox_create_dns_button_modal_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="domain_mailbox_edit_modal" tabindex="-1" role="dialog" aria-labelledby="domain_mailbox_edit_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_mailbox_edit_modalLabel"><?php echo $lang->getString("editmailbox") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label><?php echo $lang->getString("password") ?>:</label>
                        <input type="password" class="form-control" id="domain_mailbox_edit_password_modal">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                    <button type="button" class="btn btn-success" id="domain_mailbox_edit_button_modal" onclick="editMailBox()"><?php echo $lang->getString("save") ?></button>
                    <button class="btn btn-success" id="domain_mailbox_edit_button_modal_load" type="button" aria-disabled="true" style="display:none">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span >Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="domain_renew_modal" tabindex="-1" role="dialog" aria-labelledby="domain_renew_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="domain_renew_modalLabel"><?php echo $lang->getString("serviceextend") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><?php echo $lang->getString("serviceextendt") ?></p>
                    <p><?php echo $lang->getString("choosetheperiod") ?>:</p>
                        <br>
                        <span style="text-align:center; margin:auto; display:block;">
                            <div class="modal_renew">
                                <span id="domain_renew_3" class="active">365 <?php echo $lang->getString("days") ?></span>
                            </div>
                        </span>
                        <br>
                        <p style="margin-bottom:0;margin-top:1rem;"><?php echo $lang->getString("yourcredit") ?> <?php echo round($user->getGuthaben(), 2); ?>€</p>
                        <p><?php echo $lang->getString("remainingcredit") ?> <text id="credit_after">0</text>€</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
                        <button type="button" class="btn btn-primary" id="domain_renew_button" onclick="<?php echo $classes->getclassname("renewdomain"); ?>()"><?php echo $lang->getString("extendfordomain") ?></button>
                        <button class="btn btn-primary" id="domain_renew_button_load" type="button" aria-disabled="true" style="display:none">
					    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
					    <span >Loading...</span>
				        </button>
                    </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="service_access_new_modal" tabindex="-1" role="dialog" aria-labelledby="service_access_new_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_access_new_modalLabel"><?php echo $lang->getString("createnewaccess") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<?php echo getloadinghtml("service_access_new_right_load"); ?>
					<div id="service_access_new_modal_master" class="checkbox-list" style="display:none;">
						<label>Einladecode:</label>
						<input type="text" class="form-control" id="service_access_new_invite_code" placeholder="123-456-789-101">
						<br>
                        <label>Anzeigename:</label>
						<input type="text" class="form-control" id="service_access_new_display_name">
						<br>
						<div class="form-group">
							<label for="service_access_new_right_select"><?php echo $lang->getString("rights") ?></label>
							<div class="checkbox-list" id="service_access_new_right_checkboxes"></div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="service_access_new_modal_button" onclick="createNewAccess()"><?php echo $lang->getString("invite") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="service_access_user_info_modal" tabindex="-1" role="dialog" aria-labelledby="service_access_user_info_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="service_access_user_info_modalLabel"><?php echo $lang->getString("editAccessRights") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<h4><?php echo $lang->getString("rights") ?></h4>
					<div class="form-group">
						<label for="service_access_edit_right_select"><?php echo $lang->getString("rights") ?></label>
						<div class="checkbox-list" id="service_access_edit_right_checkboxes"></div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo $lang->getString("close") ?></button>
					<button type="button" class="btn btn-success" id="service_access_edit_modal_button" onclick="saveAccess()"><?php echo $lang->getString("save") ?></button>
                </div>
            </div>
        </div>
	</div>
	<div class="modal fade" id="access_delete_modal" tabindex="-1" role="dialog" aria-labelledby="access_delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="access_delete_modalLabel"><?php echo $lang->getString("deleteshare") ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
				<?php echo $lang->getString("sharedeletet") ?><br>
				<?php echo $lang->getString("sharedeletet2") ?><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><?php echo $lang->getString("cancel") ?></button>
					<button type="button" class="btn btn-success" id="access_delete_modal_button" onclick="deleteAccess()"><?php echo $lang->getString("delete") ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

echo minifyhtml(getscripts($config, $lang));

echo getdatatables($config, $lang);

?>

<script>
    var starttime = 0;
    var uptime = 0;
    var serverstatus = 0;
    var guthaben = <?php echo $user->getGuthaben(); ?>;
    var price = 0;
    var dnsarray = [];
    var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
    var domainid = <?php echo $serviceId; ?>;
    var random = Math.floor((Math.random() * 100) + 1);
    var activeMailbox = "";
    var usedDNSEntrys = [["@", "MX"], ["@", "TXT"], ["dkim._domainkey","TXT"]];
    var domain = "";
    var activeDNSName = "";
    var activeDNSType = "";

    var productId = 4;
    var serviceId = <?php echo $serviceId; ?>;

    var activeAccess = 0;

    function <?php echo $classes->getclassname("getdomaindetails"); ?>(){
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getdomaininfo');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('<?php echo $lang->getString("ajaxerror") ?>','');
                } else {
                    domain = respond.response.sld + '.' + respond.response.tld;
                    starttime = respond.response.timeleft;
                    price = respond.response.price;
                    $('#masterPageTitle').html("<?php echo $lang->getString("dnsmanagement"); ?> - " + respond.response.sld + '.' + respond.response.tld);
                    $('#domain_renew_price').html(parseFloat(price).toFixed(2));
                    $('#credit_after').html((guthaben - price).toFixed(2));
                    switch (respond.response.status) {
                        case 'running':
                            serverstatus = 1;
                            $('#statusdisplay').html('<span class="badge badge-success"><?php echo $lang->getString("online") ?></span>');
                        break;
                        case 'expired':
                            serverstatus = 0;
                            $('#statusdisplay').html('<span class="badge badge-danger"><?php echo $lang->getString("expired") ?></span>');
                        break;
                        case 'deleted':
                            serverstatus = 0;
                            document.getElementById('domain_renew').style.display = 'none';
                            $('#statusdisplay').html('<span class="badge badge-danger">Gelös<?php echo $lang->getString("deleted") ?>cht</span>');
                        break;
                    }
                    nameserverstring = respond.response.ns1 + ', ' + respond.response.ns2;
                    if(!$('#editns_1').is(':visible')){
                        $('#editns_1').val(respond.response.ns1);
                        $('#editns_2').val(respond.response.ns2);
                    }
                    if(respond.response.ns3 != null){
                        nameserverstring = nameserverstring + ', ' + respond.response.ns3;
                        if(!$('#editns_1').is(':visible')){
                            $('#editns_3').val(respond.response.ns3);
                        }
                    }
                    if(respond.response.ns4 != null){
                        nameserverstring = nameserverstring + ', ' + respond.response.ns4;
                        if(!$('#editns_1').is(':visible')){
                            $('#editns_4').val(respond.response.ns4);
                        }
                    }
                    if(respond.response.ns5 != null){
                        nameserverstring = nameserverstring + ', ' + respond.response.ns5;
                        if(!$('#editns_1').is(':visible')){
                            $('#editns_5').val(respond.response.ns5);
                        }
                    }
                    if(respond.response.ns1 == 'ns1.prohosting24.de'){
                        document.getElementById('dnsmanagement_main').style.display = '';
                        document.getElementById('dnswarning').style.display = 'none';
                        dnsarray = respond.response.dns;
                        rowcount = $('#myTable tr').length;
                        <?php echo $classes->getclassname("reloaddnsentrys"); ?>();
                    } else {
                        $('#domain_mailbox_create_dns').hide();
                        document.getElementById('dnswarning').style.display = '';
                        document.getElementById('dnsmanagement_main').style.display = 'none';
                    }
                    $('#domain_info_ns').html(nameserverstring);
                    $('#domain_info_domain').html(respond.response.sld + '.' + respond.response.tld);
                    <?php
                    if($access){
                        echo "$('#domain_renew').hide();";
                    }
                    ?>
                }
            }
        });
    }

    function <?php echo $classes->getclassname("reloaddnscreator"); ?>(){
        type = $('#typeselect option:selected').val();
        document.getElementById('subdomaingroup').style.display = 'none';
        document.getElementById('ipv4group').style.display = 'none';
        document.getElementById('ipv6group').style.display = 'none';
        document.getElementById('targetgroup').style.display = 'none';
        document.getElementById('prioritygroup').style.display = 'none';
        document.getElementById('mailservergroup').style.display = 'none';
        document.getElementById('servicenamegroup').style.display = 'none';
        document.getElementById('portgroup').style.display = 'none';
        document.getElementById('weightgroup').style.display = 'none';
        document.getElementById('protocolgroup').style.display = 'none';
        document.getElementById('contentgroup').style.display = 'none';
        document.getElementById('serviceipgroup').style.display = 'none';
        document.getElementById('serviceportgroup').style.display = 'none';
        switch (type) {
            case 'A':
                document.getElementById('subdomaingroup').style.display = '';
                document.getElementById('ipv4group').style.display = '';
                break;

            case 'AAAA':
                document.getElementById('subdomaingroup').style.display = '';
                document.getElementById('ipv6group').style.display = '';
                break;

            case 'CNAME':
                document.getElementById('subdomaingroup').style.display = '';
                document.getElementById('targetgroup').style.display = '';
                break;

            case 'MX':
                document.getElementById('subdomaingroup').style.display = '';
                document.getElementById('prioritygroup').style.display = '';
                document.getElementById('mailservergroup').style.display = '';
                break;

            case 'SRV':
                document.getElementById('subdomaingroup').style.display = '';
                document.getElementById('servicenamegroup').style.display = '';
                document.getElementById('prioritygroup').style.display = '';
                document.getElementById('portgroup').style.display = '';
                document.getElementById('weightgroup').style.display = '';
                document.getElementById('targetgroup').style.display = '';
                document.getElementById('protocolgroup').style.display = '';
                break;

            case 'TXT':
                document.getElementById('subdomaingroup').style.display = '';
                document.getElementById('contentgroup').style.display = '';
                break;

            case 'MC':
            case 'TS':
                document.getElementById('serviceipgroup').style.display = '';
                document.getElementById('serviceportgroup').style.display = '';
                document.getElementById('subdomaingroup').style.display = '';
                break;

            default:
                break;
        }

    }
    <?php echo $classes->getclassname("reloaddnscreator"); ?>();

    function <?php echo $classes->getclassname("opendnsmodal"); ?>(){
        $('#editDnsEntryButton').hide();
        $('#domain_dns_button').show();
        <?php echo $classes->getclassname("emptydnsform"); ?>();
        $('#typegroup').html(`<label for='typeselect'>Type:</label><select class='form-control' id='typeselect' onChange='<?php echo $classes->getclassname("reloaddnscreator"); ?>();'>	<option value='A'>A</option>	<option value='AAAA'>AAAA</option>	<option value='CNAME'>CNAME</option>    <option value='MX'>MX</option>    <option value='SRV'>SRV</option>    <option value='TXT'>TXT</option><option value="TS">Teamspeak</option><option value="MC">Minecraft</option></select>`);
        <?php echo $classes->getclassname("reloaddnscreator"); ?>();
        $('#domain_dns_modalLabel').html('<?php echo $lang->getString("addentry") ?>');
        document.getElementById('typegroup').style.display = '';
        $('#domain_dns_modal').modal('show');
    }

    function <?php echo $classes->getclassname("opendnseditmodal"); ?>(name, type){
        <?php echo $classes->getclassname("emptydnsform"); ?>();
        $('#domain_dns_modalLabel').html('<?php echo $lang->getString("editentry") ?>');
        document.getElementById('typegroup').style.display = 'none';
        dnsarray.forEach(element => {
            if(element.name == name && element.type == type){
                activeDNSName = element.name;
                activeDNSType = element.type;
                $('#subdomain').val(element.name);
                switch (element.type) {
                    case 'A':
                        $('#ipv4').val(element.content);
                        break;

                    case 'AAAA':
                        $('#ipv6').val(element.content);
                        break;

                    case 'CNAME':
                        $('#target').val(element.content);
                        break;

                    case 'MX':
                        $('#mailserver').val(element.content);
                        $('#priority').val(element.prio);
                        break;

                    case 'SRV':
                        subdomaincontent = element.name.split('._udp.');
                        if(subdomaincontent.length == 1){
                            subdomaincontent = element.name.split('._tcp.');
                            $('#protocol option:selected').val('tcp');
                        } else {
                            $('#protocol option:selected').val('udp');
                        }
                        $('#servicename').val(subdomaincontent[0]);
                        $('#subdomain').val(subdomaincontent[1]);
                        splitcontent = element.content.split(' ');
                        $('#weight').val(splitcontent[1]);
                        $('#port').val(splitcontent[2]);
                        $('#target').val(splitcontent[3]);
                        $('#priority').val(splitcontent[0]);
                        break;

                    case 'TXT':
                        $('#content').val(element.content);
                        break;

                    default:
                        toastr.error('<?php echo $lang->getString("typenotsupported") ?>','');
                        return;
                        break;
                }
            }
        });
        <?php echo $classes->getclassname("reloaddnscreator"); ?>();
        $('#editDnsEntryButton').show();
        $('#domain_dns_button').hide();
        $('#domain_dns_modal').modal('show');
    }

    function <?php echo $classes->getclassname("loaddomainlogs"); ?>() {
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getdomainlogs');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid') , id: domainid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('<?php echo $lang->getString("ajaxerror") ?>','');
                } else {
                    document.getElementById('domain_log_table').style.display = '';
                    $('#domain_log_table').DataTable().clear().draw();
                    respond.response.forEach(element => {

                        $('#domain_log_table').DataTable().row.add( [
                            element.id,
                            element.log,
                            element.created_on,
                        ] ).draw( false );
                    });
                    document.getElementById('domain_log_load').style.display = 'none';
                }
            }
        });
    }

    function <?php echo $classes->getclassname("emptydnsform"); ?>(){
        $('#subdomain').val('');
        $('#ipv4').val('');
        $('#ipv6').val('');
        $('#target').val('');
        $('#mailserver').val('');
        $('#priority').val('');
        $('#port').val('');
        $('#weight').val('');
        $('#servicename').val('');
        $('#content').val('');
        $('#serviceip').val('');
        $('#serviceport').val('');
    }

    function <?php echo $classes->getclassname("reloaddnsentrys"); ?>(){
        $('#dns_entrys').DataTable().clear().draw();
        $('#domain_mailbox_create_dns_table_modal').DataTable().clear().draw();
        dnsarray.forEach(element => {
            usedDNSEntrys.forEach(entry => {
                if(entry[1] == element.type){
                    if(entry[0] == "@" && element.name == domain + "."){
                        $('#domain_mailbox_create_dns_table_modal').DataTable().row.add( [
                            element.name,
                            element.type
                        ] ).draw( false ); 
                    }
                    if(entry[0] + "." + domain + "." == element.name){
                        $('#domain_mailbox_create_dns_table_modal').DataTable().row.add( [
                            element.name,
                            element.type
                        ] ).draw( false ); 
                    }
                }
            });
            $('#dns_entrys').DataTable().row.add( [
                element.type,
                element.name,
                element.content,
                '<button type=\"button\" onclick=\"openDNSDelete(\'' + element.name + '\',\'' + element.type + '\')\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\"><i class=\"fas fa-trash-alt\"></i></button>&nbsp;' +
                '<button type=\"button\" onclick=\"<?php echo $classes->getclassname("opendnseditmodal"); ?>(\'' + element.name + '\',\'' + element.type + '\')\" class=\"btn btn-outline-primary btn-elevate btn-circle btn-icon\"><i class=\"fas fa-edit\"></i></button>',
            ] ).draw( false );
        });
    }

    function openDNSDelete(name, type){
        activeDNSName = name;
        activeDNSType = type;
        $('#domain_dns_delete_modal').modal('show');
    }


    function editDNSEntry(){
        name = $('#subdomain').val();
        switch (activeDNSType) {
            case 'A':
                content = $('#ipv4').val();
                var ipv4reg = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
                var ipv4result = ipv4reg.test(content);
                if(!ipv4result){
                    toastr.error('<?php echo $lang->getString("correctipv4") ?>','');
                    return;
                }
                break;

            case 'AAAA':
                content = $('#ipv6').val();
                var ipv6reg = /^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$/;
                var ipv6result = ipv6reg.test(content);
                if(!ipv6result){
                    toastr.error('<?php echo $lang->getString("correctipv6") ?>','');
                    return;
                }
                content = $('#ipv6').val();
                break;

            case 'CNAME':
                content = $('#target').val()+ ".";
                break;

            case 'MX':
                content =  $('#priority').val() + " " + $('#mailserver').val()+ ".";
                break;

            case 'SRV':
                subdomain = $('#servicename').val() + '._' + $('#protocol option:selected').val() + '.' + subdomain;
                content = $('#priority').val()  + ' ' + $('#weight').val() + ' ' + $('#port').val() + ' ' + $('#target').val()+ ".";
                break;

            case 'TXT':
                content = $('#content').val();
                break;

            case 'TS':
                content = '0 5 ' + $('#serviceport').val() + ' ts3-' + random + '.' + $('#domain_info_domain').html();
                subdomain = '_ts3._udp.' + subdomain;
                break;

            case 'TSA':
                subdomain = 'ts3-' + random + '.' + $('#domain_info_domain').html();
                content = $('#serviceip').val();
                type = 'A';
                random = Math.floor((Math.random() * 100) + 1);
                break;

            case 'MC':
                content = '0 5 ' + $('#serviceport').val() + ' mc-' + random + '.' + $('#domain_info_domain').html();
                subdomain = '_minecraft._tcp.' + subdomain;
                break;

            case 'MCA':
                subdomain = 'mc-' + random + '.' + $('#domain_info_domain').html();
                content = $('#serviceip').val();
                type = 'A';
                random = Math.floor((Math.random() * 100) + 1);
                break;

            default:
                toastr.error('<?php echo $lang->getString("typenotsupported") ?>','');
                return;
                break;
        }
        loadButton("#editDnsEntryButton");

        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'editdnsentry');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid, entryName:name, entryType: activeDNSType, entryContent:content, oldName:activeDNSName},
            success: function(respond){
                if(respond.fail){
                    toastr.error('<?php echo $lang->getString("ajaxerror") ?>','');
                } else {
                    toastr.success('<?php echo $lang->getString("dnsentryedited") ?>','');
                    <?php echo $classes->getclassname("getdomaindetails"); ?>();
                    $('#domain_dns_modal').modal('hide');
                }
                loadButton("#editDnsEntryButton",false);
            }
        });
    }

    function deleteDNSEntry(){
        $('#domain_dns_delete_button_modal_load').show();
        $('#domain_dns_delete_button_modal').hide();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'deletednsentry');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid, entryName:activeDNSName, entryType: activeDNSType},
            success: function(respond){
                if(respond.fail){
                    toastr.error('<?php echo $lang->getString("ajaxerror") ?>','');
                } else {
                    toastr.success('<?php echo $lang->getString("dnsentrydeleted") ?>','');
                    <?php echo $classes->getclassname("getdomaindetails"); ?>();
                    $('#domain_dns_delete_modal').modal('hide');
                }
                $('#domain_dns_delete_button_modal').show();
                $('#domain_dns_delete_button_modal_load').hide();
            }
        });
    }

    function saveAccess(){
		var accessRights = [];
		$('#service_access_edit_right_checkboxes input:checked').each(function() {
			accessRights.push($(this).attr('id'));
		});
		loadButton('#service_access_edit_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: productId, id:serviceId, accessId:activeAccess, accessrights:accessRights },"saveAccessRequest",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("<?php echo $lang->getString("nsharesaved") ?>.");
				$('#service_access_user_info_modal').modal('hide');
				getAccessList();
			}
			loadButton('#service_access_edit_modal_button',false);
		});
	}

    function <?php echo $classes->getclassname("adddnsentry"); ?>(){
        type = $('#typeselect option:selected').val();
        subdomain = $('#subdomain').val();
        content = '';
        ttl = 120;
        prio = 0;
        switch (type) {
            case 'A':
                content = $('#ipv4').val();
                var ipv4reg = /^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/;
                var ipv4result = ipv4reg.test(content);
                if(!ipv4result){
                    toastr.error('<?php echo $lang->getString("correctipv4") ?>','');
                    return;
                }
                break;

            case 'AAAA':
                content = $('#ipv6').val();
                var ipv6reg = /^(([0-9a-fA-F]{1,4}:){7,7}[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,7}:|([0-9a-fA-F]{1,4}:){1,6}:[0-9a-fA-F]{1,4}|([0-9a-fA-F]{1,4}:){1,5}(:[0-9a-fA-F]{1,4}){1,2}|([0-9a-fA-F]{1,4}:){1,4}(:[0-9a-fA-F]{1,4}){1,3}|([0-9a-fA-F]{1,4}:){1,3}(:[0-9a-fA-F]{1,4}){1,4}|([0-9a-fA-F]{1,4}:){1,2}(:[0-9a-fA-F]{1,4}){1,5}|[0-9a-fA-F]{1,4}:((:[0-9a-fA-F]{1,4}){1,6})|:((:[0-9a-fA-F]{1,4}){1,7}|:)|fe80:(:[0-9a-fA-F]{0,4}){0,4}%[0-9a-zA-Z]{1,}|::(ffff(:0{1,4}){0,1}:){0,1}((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])|([0-9a-fA-F]{1,4}:){1,4}:((25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9])\.){3,3}(25[0-5]|(2[0-4]|1{0,1}[0-9]){0,1}[0-9]))$/;
                var ipv6result = ipv6reg.test(content);
                if(!ipv6result){
                    toastr.error('<?php echo $lang->getString("correctipv6") ?>','');
                    return;
                }
                content = $('#ipv6').val();
                break;

            case 'CNAME':
                content = $('#target').val() + ".";
                break;

            case 'MX':
                content = $('#priority').val() + " " + $('#mailserver').val() + ".";
                break;

            case 'SRV':
                subdomain = $('#servicename').val() + '._' + $('#protocol option:selected').val() + '.' + subdomain;
                content = $('#priority').val()  + ' ' + $('#weight').val() + ' ' + $('#port').val() + ' ' + $('#target').val()+ ".";
                break;

            case 'TXT':
                content = '"' + $('#content').val() + '"';
                break;

            case 'TS':
                content = '0 5 ' + $('#serviceport').val() + ' ts3-' + random + '.' + $('#domain_info_domain').html() + ".";
                subdomain = '_ts3._udp.' + subdomain;
                break;

            case 'TSA':
                subdomain = 'ts3-' + random;
                content = $('#serviceip').val();
                type = 'A';
                random = Math.floor((Math.random() * 100) + 1);
                break;

            case 'MC':
                content = '0 5 ' + $('#serviceport').val() + ' mc-' + random + '.' + $('#domain_info_domain').html() + ".";
                subdomain = '_minecraft._tcp.' + subdomain;
                break;

            case 'MCA':
                subdomain = 'mc-' + random;
                content = $('#serviceip').val();
                type = 'A';
                random = Math.floor((Math.random() * 100) + 1);
                break;

            default:
                toastr.error('<?php echo $lang->getString("typenotsupported") ?>','');
                return;
                break;
        }
        document.getElementById('domain_dns_button').style.display = 'none';
        document.getElementById('domain_dns_button_load').style.display = '';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'adddnsentry');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid, subdomain:subdomain, type:type, content:content, ttl:ttl, prio:prio},
            success: function(respond){
                if(respond.fail){
                    toastr.error('<?php echo $lang->getString("ajaxerror") ?>','');
                } else {
                    if(type == 'TS'){
                        $('#typeselect option:selected').val('TSA');
                        <?php echo $classes->getclassname("adddnsentry"); ?>();
                    }
                    if(type == 'MC'){
                        $('#typeselect option:selected').val('MCA');
                        <?php echo $classes->getclassname("adddnsentry"); ?>();
                    }
                    $('#domain_dns_modal').modal('hide');
                    toastr.success('<?php echo $lang->getString("createddnsentrysuccessful") ?>','');
                    <?php echo $classes->getclassname("getdomaindetails"); ?>();
                    <?php echo $classes->getclassname("emptydnsform"); ?>();
                }
                document.getElementById('domain_dns_button').style.display = '';
                document.getElementById('domain_dns_button_load').style.display = 'none';
            }
        });
    }

    function <?php echo $classes->getclassname("renewdomain"); ?>(){
        document.getElementById('domain_renew_button_load').style.display = '';
        document.getElementById('domain_renew_button').style.display = 'none';
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'renewdomain');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid},
            success: function(respond){
                if(respond.fail){
                    toastr.error('<?php echo $lang->getString("ajaxerror") ?>','');
                } else {
                    <?php echo $classes->getclassname("getdomaindetails"); ?>();
                    $('#domain_renew_modal').modal('hide');
                }
                document.getElementById('domain_renew_button').style.display = '';
                document.getElementById('domain_renew_button_load').style.display = 'none';
            }
        });
    }

    function <?php echo $classes->getclassname("changensserver"); ?>(){
        editns_1 = $('#editns_1').val();
        if(editns_1 == ''){
            toastr.error('<?php echo $lang->getString("ns1specifyed") ?>','<?php echo $lang->getString("error") ?>');
            return;
        }
        editns_2 = $('#editns_2').val();
        if(editns_2 == ''){
            toastr.error('<?php echo $lang->getString("ns2specifyed") ?>','<?php echo $lang->getString("error") ?>');
            return;
        }

        editns_3 = $('#editns_3').val();
        editns_4 = $('#editns_4').val();
        editns_5 = $('#editns_5').val();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'changenameserver');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid,ns1:editns_1,ns2:editns_2,ns3:editns_3,ns4:editns_4,ns5:editns_5},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#domain_ns_change_modal').modal('hide');
                    <?php echo $classes->getclassname("getdomaindetails"); ?>();
                    toastr.success('<?php echo $lang->getString("namseserverchanged") ?>','');
                }
            }
        });
    }

    function resetDNSServer(){
        $('#editns_1').val('ns1.prohosting24.de');
        $('#editns_2').val('ns2.prohosting24.eu');
        $('#editns_3').val('');
        $('#editns_4').val('');
        toastr.success('<?php echo $lang->getString("resetdnsserversuccess") ?>','');
    }

    function loadMailBox(){
        $('#domain_mail_load').show();
        $('#domain_mail_table').hide();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'getMailBox');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#domain_mail_table').DataTable().clear().draw();
                    respond.response.forEach(element => {
                        $('#domain_mail_table').DataTable().row.add( [
                            element.local_part + "@" + $('#domain_info_domain').html(),
                            '<button type=\"button\" class=\"btn btn-outline-info btn-elevate btn-circle btn-icon\" onclick=\"openMailBoxEdit(\'' + element.local_part + '\')\" title=\"<?php echo $lang->getString("resetpassword") ?>\"><i class=\"fas fa-key\"></i></button> ' + 
                            '<button type=\"button\" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openMailBoxDelete(\'' + element.local_part + '\')\" title=\"<?php echo $lang->getString("deletemailbox") ?>\"><i class=\"fas fa-trash-alt\"></i></button>'
                        ] ).draw( false );
                    });
                    $('#domain_mail_load').hide();
                    $('#domain_mail_table').show();
                }
            }
        });
    }

    function deleteMailBox(){
        $('#domain_mailbox_delete_button_modal').hide();
        $('#domain_mailbox_delete_button_modal_load').show();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'deleteMailBox');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid, username:activeMailbox},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    toastr.success("<?php echo $lang->getString("deletedmailboxsuccessful") ?>",'');
                    $('#domain_mailbox_delete_modal').modal("hide");
                    loadMailBox();
                }
                $('#domain_mailbox_delete_button_modal').show();
                $('#domain_mailbox_delete_button_modal_load').hide();
            }
        });
    }

    function setMailBox(){
        $('#domain_mailbox_create_dns_button_modal').hide();
        $('#domain_mailbox_create_dns_button_modal_load').show();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'setMailBox');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    toastr.success("Einträge angelegt.",'');
                    $('#domain_mailbox_create_dns_modal').modal("hide");
                    loadMailBox();
                    <?php echo $classes->getclassname("getdomaindetails"); ?>()
                }
                $('#domain_mailbox_create_dns_button_modal').show();
                $('#domain_mailbox_create_dns_button_modal_load').hide();
            }
        });
    }

    function openMailBoxDelete(mailBox){
        activeMailbox = mailBox;
        $('#domain_mailbox_delete_name_modal').html(mailBox + "@" + $('#domain_info_domain').html());
        $('#domain_mailbox_delete_modal').modal("show");
    }

    function openMailBoxEdit(mailBox){
        activeMailbox = mailBox;
        $('#domain_mailbox_edit_name_modal').html(mailBox + "@" + $('#domain_info_domain').html());
        $('#domain_mailbox_edit_modal').modal("show");
    }

    function createMailBox(){
        username = $('#domain_mailbox_username_modal').val();
        if(username == ''){
            toastr.error('<?php echo $lang->getString("usernameempty") ?>','<?php echo $lang->getString("error") ?>');
            return;
        }
        name = $('#domain_mailbox_name_modal').val();
        if(name == ''){
            toastr.error('<?php echo $lang->getString("nameempty") ?>','<?php echo $lang->getString("error") ?>');
            return;
        }
        $('#domain_mailbox_button_modal_load').show();
        $('#domain_mailbox_button_modal').hide();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'createMailBox');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid, username:username, name:name},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    $('#domain_mailbox_username_modal').val('');
                    $('#domain_mailbox_name_modal').val('');
                    toastr.success("Mailbox erfolgreich erstellt.",'');
                    $('#domain_mailbox_create_modal').modal("hide");
                    $('#domain_mailbox_create_password_username_modal').html(respond.response[0] + "@" + $('#domain_info_domain').html());
                    $('#domain_mailbox_create_password_password_modal').html(respond.response[1]);
                    $('#domain_mailbox_create_password_modal').modal("show");
                    loadMailBox();
                }
                $('#domain_mailbox_button_modal_load').hide();
                $('#domain_mailbox_button_modal').show();
            }
        });
    }

    function editMailBox(){
        password = $('#domain_mailbox_edit_password_modal').val();
        if(password == ''){
            toastr.error('<?php echo $lang->getString("passwordempty") ?>','<?php echo $lang->getString("error") ?>');
            return;
        }
        $('#domain_mailbox_edit_button_modal_load').show();
        $('#domain_mailbox_edit_button_modal').hide();
        $.ajax({
            type: 'POST',
            crossDomain: true,
            beforeSend: function(request) {
                request.setRequestHeader('Function', 'editMailBox');
            },
            url: internapi,
            data: { sessionid: Cookies.get('ph24_sessionid'), id: domainid, username:activeMailbox, password:password},
            success: function(respond){
                if(respond.fail){
                    toastr.error(respond.error,'');
                } else {
                    toastr.success("<?php echo $lang->getString("editmailboxsuccessfully") ?>",'');
                    $('#domain_mailbox_edit_modal').modal("hide");
                    $('#domain_mailbox_edit_password_modal').val('');
                    loadMailBox();
                }
                $('#domain_mailbox_edit_button_modal_load').hide();
                $('#domain_mailbox_edit_button_modal').show();
            }
        });
    }

    $('#domain_mail_table').hide();

    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = (starttime * 1000) - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        document.getElementById('domain_infos_time').innerHTML = days + ' <?php echo $lang->getString("days") ?> ' + hours + ' <?php echo $lang->getString("hours") ?> ' + minutes + ' <?php echo $lang->getString("minutes") ?> ' + seconds + ' <?php echo $lang->getString("seconds") ?> ';
        if (distance < 0) {
        document.getElementById('domain_infos_time').innerHTML = '<?php echo $lang->getString("expired") ?>';
        }
    }, 1000);

    var autoupdate = setInterval(function() {
        <?php echo $classes->getclassname("getdomaindetails"); ?>();
    }, 10000);

    function getAccessList(){
		$('#access_list_master').hide();
		$('#access_list').show();
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:serviceId, productId: productId},"getAccesListService",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				$('#access_list_table').DataTable().clear().draw();
                respond.response.forEach(element => {
					buttons = '<button type=\"button\" id="access_display_info_button_' + element.id + '" class=\"btn btn-outline-primary btn-elevate btn-circle btn-icon\" onclick=\"openAccessInfo(\'' + element.id + '\')\" title=\"<?php echo $lang->getString("showinfo") ?>\"><i class=\"fas fa-eye\"></i></button>';
					buttons = buttons + '&nbsp;<button type=\"button\" id="access_delete_button_' + element.id + '" class=\"btn btn-outline-danger btn-elevate btn-circle btn-icon\" onclick=\"openAccessDelete(\'' + element.id + '\')\" title=\"<?php echo $lang->getString("removeshare") ?>\"><i class=\"fas fa-trash\"></i></button>';
					switch (element.status) {
						case 0:
							statusBadge = '<span class="badge badge-success" style=""><?php echo $lang->getString("requestnotaccepted") ?></span>';
							break;
						case 2:
							statusBadge = '<span class="badge badge-danger" style=""><?php echo $lang->getString("requestno") ?></span>';
							break;
						default:
							statusBadge = '<span class="badge badge-success" style=""><?php echo $lang->getString("active") ?></span>';
							break;
					}
					if(element.status != 3){
						$('#access_list_table').DataTable().row.add( [
							element.name,
							statusBadge,
							buttons
						] ).draw( false );
					}
				});
				$('#access_list_master').show();
				$('#access_list').hide();
			}
		});
	}

	function createNewAccess(){
		inviteCode = $('#service_access_new_invite_code').val();
		if(inviteCode == ""){
			toastr["error"]("Bitte geben Sie einen Invite Code an.");
			return;
		}
		displayName = $('#service_access_new_display_name').val();
		if(displayName == ""){
			toastr["error"]("Bitte geben Sie einen Namen an.");
			return;
		}
		var accessRights = [];
		$('#service_access_new_right_checkboxes input:checked').each(function() {
			accessRights.push($(this).attr('id'));
		});
		loadButton('#service_access_new_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: productId, id:serviceId, invitecode:inviteCode, displayname:displayName, accessrights:accessRights },"createAccessRequest",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]("Freigabe erfolgreich angelegt.");
				$('#service_access_new_modal').modal('hide');
				getAccessList();
				$('#service_access_new_invite_code').val('');
				$('#service_access_new_display_name').val('');
			}
			loadButton('#service_access_new_modal_button',false);
		});
	}

	function openAccessInfo(id){
		loadButton('#access_display_info_button_' + id,true, false);
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:id},"getAccesUserRights",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				activeAccess = id;
				htmlContent = '';
                respond.response.forEach( element => {
					if(element.checked == 1){
						htmlContent += '<label class="checkbox"><input type="checkbox" id="' + element.id + '" checked><span></span>' + element.name + '</label>';
					} else {
						htmlContent += '<label class="checkbox"><input type="checkbox" id="' + element.id + '"><span></span>' + element.name + '</label>';
					}
				});
				$("#service_access_edit_right_checkboxes").html(htmlContent);
				$('#service_access_user_info_modal').modal('show');
			}
			loadButton('#access_display_info_button_' + id,false);
		});
	}

	function openAccessDelete(id){
		currentAccess = id;
		$('#access_delete_modal').modal("show");
	}

	function openAccessNew(){
		$('#service_access_new_modal').modal('show');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), productId: productId},"getAccessListRights",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				htmlContent = '';
                respond.response.forEach( element => {
					htmlContent += '<label class="checkbox"><input type="checkbox" id="' + element.id + '"><span></span>' + element.name + '</label>';
				});
				$("#service_access_new_right_checkboxes").html(htmlContent);
				$('#service_access_new_modal_master').show();
				$('#service_access_new_right_load').hide();
			}
		});
	}
	function deleteAccess(){
		loadButton('#access_delete_modal_button');
		requestIntern({sessionid:Cookies.get('ph24_sessionid'), id:currentAccess},"accessDelete",function(respond){
			if(respond.fail){
                toastr["error"](respond.error);
            } else {
				toastr["success"]('<?php echo $lang->getString("nshareremoved") ?>');
				getAccessList();
				$('#access_delete_modal').modal('hide');
			}
			loadButton('#access_delete_modal_button',false);
		});
	}
    
    $('#domain_mail_table').DataTable({
        order: [[ 0, 'asc' ]],
        responsive: true,
        searching: false,
        paging:false,
        info: false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
                    }
    });
    $('#domain_mailbox_create_dns_table_modal').DataTable({
        order: [[ 0, 'asc' ]],
        responsive: true,
        searching: false,
        paging:false,
        info: false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
    });
    var dns_entrys = $('#dns_entrys').DataTable({
        order: [[ 0, 'asc' ]],
        responsive: true,
        searching: false,
        paging:false,
        info: false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
    });
    $('#access_list_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": [[ 0, 'desc' ]],
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});

	$('#access_user_info_table').DataTable({
		"responsive": true,
		"paging": false,
		"order": false,
		"searching": false,
		"info": false,
        "language": {
            "url": "<?php $lang->getString("datatablelanguage"); ?>"
        }
	});
    <?php
	if(!$access){
	?>
	getAccessList();
	<?php
	}
	?>
    <?php echo $classes->getclassname("getdomaindetails"); ?>();
</script>

<?php

echo minifyhtml("</body></html>");

<?php

defined('m6zGtn2B5a6ErJbbIvvS') or die();

echo minifyhtml(getloginheader($config, $lang->getString("customerarea") . " - ProHosting24",$lang));
$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$frontendurl = $config->getconfigvalue('frontendurl');
$internapi = $config->getconfigvalue('internapi');
$langList = requestBackend($config, [], "getLanguageList", $user->getLang())["response"];

$classes = new ClassNamer();
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
					<div class="kt-login-v2__signup">
						<span><?php  echo $lang->getString("noaccount"); ?></span>
						<a href="javascript:<?php echo $classes->getclassname("switchform"); ?>(2)" class="kt-link kt-font-brand"><?php  echo $lang->getString("registernow"); ?></a>
					</div>
				</div>
			</div>
			<div class="kt-grid__item  kt-grid  kt-grid--ver  kt-grid__item--fluid">
				<div class="kt-login-v2__body">
					<div class="kt-login-v2__wrapper">
						<div class="kt-login-v2__container" id="login_passwordforgot" style="display:none">
							<div class="kt-login-v2__title">
								<h3><?php  echo $lang->getString("forgotpassword"); ?></h3>
							</div>
							<form class="kt-login-v2__form kt-form" action="javascript:">
								<div class="form-group">
									<input class="form-control" type="email" placeholder="<?php  echo $lang->getString("email"); ?>" id="email_passwordforgot" autocomplete="off">
								</div>
								<div class="kt-login-v2__actions">
									<a href="javascript:<?php echo $classes->getclassname("switchform"); ?>(1)" class="kt-link kt-link--brand"><?php  echo $lang->getString("backtologin"); ?></a>
									<button class="btn btn-brand btn-elevate btn-pill" id="password_forgot_load_button" onclick="<?php echo $classes->getclassname("passwordforgot"); ?>()"><?php  echo $lang->getString("submit"); ?></button>
                                    <button class="btn btn-brand btn-elevate btn-pill" id="password_forgot_load_button_load" type="button" aria-disabled="true" style="display:none">
			                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			                            <span >Loading...</span>
                                    </button>
								</div>
							</form>
                        </div>
						<div class="kt-login-v2__container" id="login_secret" style="display:none">
							<div class="kt-login-v2__title">
								<h3><?php  echo $lang->getString("2fa"); ?></h3>
							</div>
							<form class="kt-login-v2__form kt-form" action="javascript:">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Zwei-Faktor-Authentisierungs Code eingeben" id="login_2fa" autocomplete="off">
								</div>
								<div class="kt-login-v2__actions">
									<button class="btn btn-brand btn-elevate btn-pill" id="login_button_secret" onclick="<?php echo $classes->getclassname("login"); ?>()"><?php  echo $lang->getString("submit"); ?></button>
                                    <button class="btn btn-brand btn-elevate btn-pill" id="login_button_secret_load" type="button" aria-disabled="true" style="display:none">
			                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			                            <span >Loading...</span>
                                    </button>
								</div>
							</form>
                        </div>
						<div class="kt-login-v2__container" id="login_form">
							<div class="kt-login-v2__title">
								<h3><?php  echo $lang->getString("customerarea"); ?></h3>
							</div>
							<form class="kt-login-v2__form kt-form" action="javascript:">
								<div class="form-group">
									<input class="form-control" type="email" placeholder="<?php  echo $lang->getString("email"); ?>" id="email" autocomplete="off">
								</div>
								<div class="form-group">
									<input class="form-control" type="password" placeholder="<?php  echo $lang->getString("password"); ?>" id="password" autocomplete="off">
								</div>
								<div class="kt-login-v2__actions">
									<a href="javascript:<?php echo $classes->getclassname("switchform"); ?>(3)" class="kt-link kt-link--brand"><?php  echo $lang->getString("forgotpassword"); ?></a>
									<button class="btn btn-brand btn-elevate btn-pill" id="login_button" onclick="<?php echo $classes->getclassname("login"); ?>()"><?php  echo $lang->getString("login"); ?></button>
									<button class="btn btn-brand btn-elevate btn-pill" id="login_button_load" type="button" aria-disabled="true" style="display:none">
			                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			                            <span >Loading...</span>
                                    </button>
								</div>
							</form>
                        </div>
                        <div class="kt-login-v2__container" style="display:none" id="register_form">
							<div class="kt-login-v2__title">
								<h3><?php  echo $lang->getString("register"); ?></h3>
							</div>
							<form class="kt-login-v2__form kt-form" action="javascript:">
								<div class="form-group">
									<input class="form-control" type="email" placeholder="<?php  echo $lang->getString("email"); ?>" id="register_email" autocomplete="off">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="<?php  echo $lang->getString("firstname"); ?>" id="register_vorname" autocomplete="off">
                                    </div>
                                    <div class="col-lg-6">
                                        <input class="form-control" type="text" placeholder="<?php  echo $lang->getString("lastname"); ?>" id="register_nachname" autocomplete="off">
									</div>
                                </div>
                                <div class="form-group">
									<input class="form-control" type="text" placeholder="<?php  echo $lang->getString("username"); ?>" id="register_username" autocomplete="off">
								</div>
								<div class="form-group">
									<input class="form-control" type="password" placeholder="<?php  echo $lang->getString("password"); ?>" id="register_password" autocomplete="off">
                                </div>
                                <div class="form-group">
									<input class="form-control" type="password" placeholder="<?php  echo $lang->getString("passwordrepeat"); ?>" id="register_password_1" autocomplete="off">
								</div>
								<div class="form-group">
									<select class="form-control" id="lang_select">
													<?php
													foreach ($langList as $langEntry) {
														if($langEntry["lang"] == $user->getLang()){
															echo '<option value="' . $langEntry["lang"] . '" selected="selected">' . $langEntry["displayname"] . '</option>';
														} else {
															echo '<option value="' . $langEntry["lang"] . '">' . $langEntry["displayname"] . '</option>';
														}
													}
													?>
												</select>
								</div>
								<label class="kt-checkbox kt-checkbox--brand">
									<input type="checkbox" id="confirm_register"><?php echo $lang->getString("privacycheck") . '<br>' . $lang->getString("toscheck") ; ?></span>
									<span></span>
								</label>
								<div class="kt-login-v2__actions">
									<a href="javascript:<?php echo $classes->getclassname("switchform"); ?>(1)" class="kt-link kt-link--brand"><?php echo $lang->getString("backtologin"); ?></a>
                                    <button class="btn btn-brand btn-elevate btn-pill" id="register_button" onclick="<?php echo $classes->getclassname("register"); ?>()"><?php echo $lang->getString("register"); ?></button>
                                    <button class="btn btn-brand btn-elevate btn-pill" id="register_button_load" type="button" aria-disabled="true" style="display:none">
			                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
			                            <span >Loading...</span>
                                    </button>
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

if(isset($_COOKIE["ph24_admin_session"])){
	echo "<script>Cookies.set('ph24_sessionid', '" . $_COOKIE["ph24_admin_session"] . "',{ expires: 10 });location.reload();setcookie('ph24_admin_session', null, -1, '/');setcookie('ph24_admin_session', null, -1, '/cp/');</script>";
	setcookie('ph24_admin_session', null, -1, '/'); 
}

if (isset($_COOKIE["ph24_notify_success"])) {
    echo minifyhtml("<script>toastr.success('" . $_COOKIE["ph24_notify_success"] . "','');Cookies.remove('ph24_notify_success');</script>");
}
?>
<script>
	var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
	var secret = 0;
	function <?php echo $classes->getclassname("login"); ?>(){
		$('#login_button').hide();
		$('#login_button_load').show();
		email = $("#email").val();
		if(email == ""){
			toastr.error("<?php  echo $lang->getString("emailempty"); ?>",'Error');
			$('#login_button').show();
			$('#login_button_load').hide();
			return;
		}
		password = $("#password").val();
		if(password == ""){
			toastr.error("<?php  echo $lang->getString("passwordempty"); ?>",'Error');
			$('#login_button').show();
			$('#login_button_load').hide();
			return;
		}
		if(secret != 0){
			secret = $("#login_2fa").val();
			if(secret == ""){
				toastr.error("<?php  echo $lang->getString("2faempty"); ?>",'Error');
				return;
			};
			$('#login_button_secret').hide();
			$('#login_button_secret_load').show();
		}
		$.ajax({
			type: 'POST',
			crossDomain: true,
			beforeSend: function(request) {
				request.setRequestHeader('Function', "login");
				request.setRequestHeader("key", "login");
			},
			url: internapi,
			<?php
			if (strpos($_SERVER['HTTP_HOST'], 'prohosting24.net') !== false) {
				echo 'data: { email: email,password: password,length: 10,secret:secret, lang:"en"},';
			} else {
				echo 'data: { email: email,password: password,length: 10,secret:secret},';
			}
			?>
			success: function(respond){
				if(respond.fail){
					if(respond.error == '2fa'){
						secret = "12";
						<?php echo $classes->getclassname("switchform"); ?>(4);
					} else {
						toastr.error(respond.error,'Fehler');
					}
				} else {
					Cookies.set('ph24_sessionid', respond.response,{ expires: 10 });
					Cookies.set('ph24_notify_success', '<?php  echo $lang->getString("successlogin"); ?>');
					location.reload();
				}
				$('#login_button_secret').show();
				$('#login_button_secret_load').hide();
				$('#login_button').show();
				$('#login_button_load').hide();
			}
		});
	}
	
	function <?php echo $classes->getclassname("switchform"); ?>(value) {
		$('#login_form').hide();
		$('#register_form').hide();
		$('#login_passwordforgot').hide();
		$('#login_secret').hide();
		switch (value) {
			case 1:
				$('#login_form').show();
				break;
			case 2:
				$('#register_form').show();
				break;
			case 3:
				$('#login_passwordforgot').show();
				break;
			case 4:
				$('#login_secret').show();
				break;

			default:
				break;
		}
	}

	function <?php echo $classes->getclassname("passwordforgot"); ?>(){
		$('#password_forgot_load_button').hide();
		$('#password_forgot_load_button_load').show();
		email = $('#email_passwordforgot').val();
		if(email == ''){
			toastr.error('<?php  echo $lang->getString("emailempty"); ?>','Fehler');
			$('#password_forgot_load_button').show();
			$('#password_forgot_load_button_load').hide();
			return;
		}
		$.ajax({
			type: 'POST',
			crossDomain: true,
			beforeSend: function(request) {
				request.setRequestHeader('Function', 'passwordforgot');
			},
			url: internapi,
			data: {email: email},
			success: function(respond){
				if(respond.fail){
					toastr.error(respond.error,'Fehler');
				} else {
					toastr.success('<?php  echo $lang->getString("emailpasswordreset"); ?>','');
					<?php echo $classes->getclassname("switchform"); ?>(2);
				}
				$('#password_forgot_load_button').show();
				$('#password_forgot_load_button_load').hide();
			}
		});
	}

	function <?php echo $classes->getclassname("register"); ?>() {
		if(!$('#confirm_register').is(":checked")){
			toastr.error('<?php  echo $lang->getString("registercheck"); ?>','Error');
			return;
		}
		$('#register_button').hide();
		$('#register_button_load').show();
		email = $('#register_email').val();
		if(email == ''){
			toastr.error('<?php  echo $lang->getString("emailempty"); ?>','Error');
			$('#register_button').show();
			$('#register_button_load').hide();
			return;
		}
		password = $('#register_password').val();
		if(password == ''){
			toastr.error('<?php  echo $lang->getString("passwordempty"); ?>','Error');
			$('#register_button').show();
			$('#register_button_load').hide();
			return;
		}
		password_1 = $('#register_password_1').val();
		if(password != password_1){
			toastr.error('<?php  echo $lang->getString("passwordmatch"); ?>','Error');
			$('#register_button').show();
			$('#register_button_load').hide();
			return;
		}
		vorname = $('#register_vorname').val();
		if(vorname == ''){
			toastr.error('<?php  echo $lang->getString("firstnameempty"); ?>','Error');
			$('#register_button').show();
			$('#register_button_load').hide();
			return;
		}
		nachname = $('#register_nachname').val();
		if(nachname == ''){
			toastr.error('<?php  echo $lang->getString("lastnameempty"); ?>','Error');
			$('#register_button').show();
			$('#register_button_load').hide();
			return;
		}
		username = $('#register_username').val();
		if(username == ''){
			toastr.error('<?php  echo $lang->getString("usernameempty"); ?>','Error');
			$('#register_button').show();
			$('#register_button_load').hide();
			return;
		}
		lang_select = $('#lang_select').val();
		$.ajax({
			type: 'POST',
			crossDomain: true,
			beforeSend: function(request) {
				request.setRequestHeader('Function', 'register');
			},
			url: internapi,
			<?php
			if (strpos($_SERVER['HTTP_HOST'], 'prohosting24.net') !== false) {
				echo 'data: { username:username,email: email,password: password,vorname:vorname,nachname:nachname,lang:lang_select,affiliate:Cookies.get("ph24_affiliate"), lang:"en"},';
			} else {
				echo 'data: { username:username,email: email,password: password,vorname:vorname,nachname:nachname,lang:lang_select,affiliate:Cookies.get("ph24_affiliate")},';
			}
			?>
			success: function(respond){
				if(respond.fail){
					toastr.error(respond.error,'Fehler');
				} else {
					Cookies.set('ph24_sessionid', respond.response,{ expires: 10 });
					Cookies.set('ph24_notify_success', '<?php  echo $lang->getString("successregister"); ?>');
					window.location.replace(<?php echo "'" . $url . "'" ?>);
				}
				$('#register_button').show();
				$('#register_button_load').hide();
			}
		});
	}
<?php

if (isset($_GET["register"])) {
    echo $classes->getclassname("switchform") . "();";
}

?>
</script>
<?php

echo minifyhtml("</body>
    </html>");

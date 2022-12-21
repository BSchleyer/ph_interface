<?php


defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, "WebHosting - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$cp = $config->getconfigvalue('cpLink');

$classes = new ClassNamer();

?>
<div class="default-header webspace-page">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2><?php  echo $lang->getString("webspaceheader"); ?></h2>
                    <p><?php  echo $lang->getString("webspaceheadertext"); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<input style="display:none" type="text" name="fakeusernameremembered"/>
<input style="display:none" type="password" name="fakepasswordremembered"/>
<div class="features-two padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="box-shadow">
            <span class="padding-top10 padding-bottom30 webspacebestellung">
                <div class=" text-center" style="padding-bottom: 2rem;">
                    <h2><b><?php  echo $lang->getString("webspacetitle"); ?></b></h2>
                    <p><?php  echo $lang->getString("webspacetitletext"); ?></p>
                </div>
                <div id="order_step1" style="text-align:center;">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span id="webspace_db_label" style="display:block; text-align: center; margin-top: 15px; margin-bottom: 20px; font-size: 1.7rem;"><b><i class="fas fa-check-circle"></i><?php  echo $lang->getString("databases"); ?></b>: <span id="webspace_db">10</span> </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span id="webspace_email_label" style="display:block; text-align: center; margin-top: 15px; margin-bottom: 20px; font-size: 1.7rem;"><b><i class="fas fa-check-circle"></i><?php  echo $lang->getString("addresses"); ?></b>: <span id="webspace_email">10</span> </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span id="webspace_db_label" style="display:block; text-align: center; margin-top: 15px; margin-bottom: 20px; font-size: 1.7rem;"><b><i class="fas fa-check-circle"></i><?php  echo $lang->getString("nodomainlimit"); ?></b><span></span> </span>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <span id="webspace_email_label" style="display:block; text-align: center; margin-top: 15px; margin-bottom: 20px; font-size: 1.7rem;"><b><i class="fas fa-check-circle"></i><?php  echo $lang->getString("cronjobs"); ?></b><span></span> </span>
                        </div>
                    </div>
                    <span style="display:block;">
                        <span id="webspace_disk_label" style="display:block; text-align: left; margin-left: 10%; margin-bottom: .2rem; font-size: 1.7rem;"><b><?php  echo $lang->getString("ssdstorage"); ?></b>: <span id="webspace_disk_currentval">10</span> GB</span>
                        <input id="webspace_disk" data-slider-id="webspace_disk" type="text" data-slider-min="10" data-slider-max="100" data-slider-step="5" data-slider-value="5"/>
                    </span>
                    <span style="display:block; margin-top:3.5rem;">
                        <span id="webspace_laufzeit_label" style="display:block; text-align: left; margin-left: 10%; margin-bottom: .2rem; font-size: 1.7rem;"><b><?php  echo $lang->getString("period"); ?></b>: <span id="webspace_days_currentval">30</span> <?php  echo $lang->getString("days"); ?></span>
                        <input id="webspace_laufzeit" data-slider-id="webspace_laufzeit" type="text" data-slider-min="30" data-slider-max="360" data-slider-step="30" data-slider-value="30"/>
                    </span>
                    <span class="webspace_summe">
                        <p><text id="currentprice"></text>€</p>
                        <button type="button" class="domainbutton btn-primary btn-domainbutton" style="text-align:right;" onClick="openConfigurator()"><?php  echo $lang->getString("next"); ?></button>
                    </span>
                </div>
            </span>
        </div>
     </div>
</div>

<hr style="background-color: #00A8FF; height: .5rem; margin: 0; padding: 0;">

<div class="layout-text contact-layout left-layout padding-top50 padding-bottom60 features-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img src="<?php echo $cdn; ?>img/plesk.png" class="img-responsive" alt="" data-aos="fade-right">
                <img src="<?php echo $cdn; ?>img/plesk.png" class="img-absolute" alt="" data-aos="fade-right">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="box-shadow">
                    <div class="list-features">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-title text-left">
                                    <h2><?php  echo $lang->getString("simplemanagement"); ?></h2>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <ul>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simplemanagementt1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simplemanagementt2"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simplemanagementt3"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simplemanagementt4"); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));

$apirespond = requestBackend($config, ["id" => 2], "getproduktinfos");
?>

<script>
var baseprice = <?php echo $apirespond["response"]["price"] ?>;
var base_diskcount = <?php echo $apirespond["response"]["upgrades"]["disk"][0]["data"] ?>;

var max_diskcount = <?php echo $apirespond["response"]["upgrades"]["disk"][count($apirespond["response"]["upgrades"]["disk"]) - 1]["data"] ?>;

var array_disk = <?php echo json_encode($apirespond["response"]["upgrades"]["disk"]) ?>;

var array_db = <?php echo json_encode($apirespond["response"]["upgrades"]["db"]) ?>;
var array_email = <?php echo json_encode($apirespond["response"]["upgrades"]["mail"]) ?>;

var current_disk_value = 0;

var current_disk_price = 0;

var current_days = 30;
var discount = 0;
var discountcode = "";
var price = 0;
var currentid = 1;

var servicepage = '<?php echo $config->getconfigvalue('cp_service_link') ?>';
var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";

function openConfigurator(){
    window.location.replace('<?php echo $cp; ?>webspace/order/' + current_disk_value + '/' + current_days);
}

function <?php echo $classes->getclassname("calcuateprice"); ?>(id,value){
    switch (id) {
        case 1:
            array_disk.forEach(element => {
                if(element['data'] == value){
                    $('#webspace_disk_currentval').html(value);
                    current_disk_value = value;
                    current_disk_price = parseFloat(element['price']);
                }
            });
            array_db.forEach(element => {
                if (element['data'] == value) {
                    $('#webspace_db').html(element.name);
                }
            });
            array_email.forEach(element => {
                if (element['data'] == value) {
                    $('#webspace_email').html(element.name);
                }
            });
            break;

        case 2:
            current_days = value;
            $('#webspace_days_currentval').html(value);
            break;

        default:
            break;
    }
    price = ((baseprice + current_disk_price) * (current_days / 30));
    $('#currentprice').html(price.toFixed(2));
}

$("#webspace_disk").attr("data-slider-min",base_diskcount),$("#webspace_disk").attr("data-slider-max",max_diskcount),<?php echo $classes->getclassname("calcuateprice"); ?>(1,base_diskcount),$("#webspace_disk").slider(),$("#webspace_disk").on("change",function(e){<?php echo $classes->getclassname("calcuateprice"); ?>(1,e.value.newValue)}),$("#webspace_laufzeit").slider(),$("#webspace_laufzeit").on("change",function(e){<?php echo $classes->getclassname("calcuateprice"); ?>(2,e.value.newValue)}),<?php echo $classes->getclassname("calcuateprice"); ?>(2,current_days);
</script>
</body>
</html>
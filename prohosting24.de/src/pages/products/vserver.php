<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $lang->getString("vserver") . " - Prohosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$classes = new ClassNamer();
$cp = $config->getconfigvalue('cpLink');

?>
<div class="default-header vserver">
    <div class="custom-width">
        <div class="row">
            <div class="col-sm-7">
                <div class="header-text">
                    <h2><?php  echo $lang->getString("vserverhead"); ?></h2>
                    <p><?php  echo $lang->getString("vserverheadt"); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="features-two padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="box-shadow">
                    <div class="list-features">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-title text-left">
                                    <h2><?php  echo $lang->getString("ourhypervisors"); ?></h2>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4><?php  echo $lang->getString("curentsystems"); ?></h4>
                                <ul>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemscpu1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemsmemory1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemsssd1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemsuplink1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemslocation1"); ?></li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <br><br>
                                <ul>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemscpu2"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemsmemory2"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemsssd2"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemsuplink1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("curentsystemslocation1"); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <img src="<?php echo $cdn; ?>img/hostsysteme_1.jpg" class="img-responsive">
            </div>
        </div>
    </div>
</div>

<div class="pricing-tables-light padding-top60 padding-bottom70">
    <div class="container">
        <div class="main-title text-center" style="margin-bottom: 0px;">
            <h2><?php  echo $lang->getString("kvmconfigurater"); ?></h2>
            <p><?php  echo $lang->getString("kvmconfiguratert"); ?></p>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#ffffff; padding:0; box-shadow: 0 0 20px rgba(54, 46, 97, 0.04); border-radius: .5rem; padding-bottom: .75rem;">
                <div class="table-content blue-border" style="box-shadow:0 0 0 0;">
                    <div id="oder_main">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="display: block; text-align: left; padding-top: 1.75rem;">
                            <span class="oderborder">
                                <span style="text-align:left; display: block;font-weight: bold; color: #888; font-size: 2.5rem;"><?php  echo $lang->getString("ordervps"); ?></span>
                                <hr class="oderhr">
                                <span class="odersidemargin"><span><?php  echo $lang->getString("baseprice"); ?>:</span><span style="float:right;"><span id="vserver_grundpreis">0.00</span> €</span></span>
                                <span class="odersidemargin"><span><?php  echo $lang->getString("cpucores"); ?>: <span id="vserver_cores_currentval_2">1</span></span><span style="float:right;"><span id="vserver_cores_price">0.00</span> €</span></span>
                                <span class="odersidemargin"><span><?php  echo $lang->getString("memory"); ?>: <span id="vserver_ram_currentval_2">1</span>GB</span><span style="float:right;"><span id="vserver_ram_price">0.00</span> €</span></span>
                                <span class="odersidemargin"><span><?php  echo $lang->getString("ssd"); ?>: <span id="vserver_disk_currentval_2">1</span> GB</span><span style="float:right;"><span id="vserver_disk_price">0.00</span> €</span></span>
                                <span class="odersidemargin"><span>IPv4 <?php  echo $lang->getString("ipadresses"); ?>: <span id="vserver_ip_currentval_2">1</span></span><span style="float:right;"><span id="vserver_ip_price">0.00</span> €</span></span>
                                <span class="odersidemargin"><span>IPv6 <?php  echo $lang->getString("ipadresses"); ?>: <span>/64 <span>IPv6 <?php  echo $lang->getString("ipsubnet"); ?></span></span><span style="float:right;"><span id="vserver_ip_price">0.00</span> €</span></span>
                                <span style="display:block;margin-top: .75rem;"><span>Laufzeit: 30 Tage</span></span>
                                <span style="display:block; margin-bottom: .75rem;"><?php  echo $lang->getString("operatingsystem"); ?>: <span id="vserver_os_show">-</span></span>
                                <span style="display:block; opacity: 0.6;"><span>(<?php  echo $lang->getString("inclusive"); ?>:)</span></span>
                                <span><?php  echo $lang->getString("fairtraffic"); ?></span><br>
                                <span><?php  echo $lang->getString("curentsystemsuplink1"); ?></span><br>
                                <span><?php  echo $lang->getString("ddosvserver"); ?></span><br><br>
                                <span style="font-weight: bold; color: #888; font-size: 2rem;"><?php  echo $lang->getString("sum"); ?>: <span id="vserver_currentprice">8</span>€</span>
                                <hr class="oderhr">
                                <span class="odersidemargin" style="float:right; opacity: 0.6"><?php  echo $lang->getString("step"); ?> <span id="stepcount">1</span> <?php  echo $lang->getString("from"); ?> 4<br></span>
                            </span>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" style="padding-top: 10px; padding-right: 0; padding-top: 1.75rem; padding-right: 15px; padding-left: 15px;">
                            <span id="order_header_1" style="text-align:left; display: block;font-weight: bold; color: #888; font-size: 2.5rem;"><?php  echo $lang->getString("configuration"); ?></span>
                            <hr class="oderhr">
                                <div id="step1">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <span style="display:block; margin-top: 1rem;">
                                                <span id="vserver_cores_label" style="display:block; text-align: left; margin-left: 3rem; margin-bottom: 1rem; font-size: 1.7rem; margin-top: 1rem;"><b><?php  echo $lang->getString("cpucores"); ?></b>: <span id="vserver_cores_currentval">1</span></span>
                                                <input id="vserver_cores" data-slider-id="vserver_cores" type="text" data-slider-min="1" data-slider-max="10" data-slider-step="1" data-slider-value="1"/>
                                            </span>
                                            <span style="display:block; margin-top: 3rem;">
                                                <span id="vserver_ram_label" style="display:block; text-align: left; margin-left: 3rem; margin-bottom: 1rem; font-size: 1.7rem; margin-top: 1rem;"><b><?php  echo $lang->getString("memory"); ?></b>: <span id="vserver_ram_currentval">1</span> GB</span>
                                                <input id="vserver_ram" data-slider-id="vserver_ram" type="text"/>
                                            </span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <span style="display:block;" class="ordermargin">
                                                <span id="vserver_disk_label" style="display:block; text-align: left; margin-left: 3rem; margin-bottom: 1rem; font-size: 1.7rem; margin-top: 1rem;"><b><?php  echo $lang->getString("ssd"); ?></b>: <span id="vserver_disk_currentval">10</span> GB</span>
                                                <input id="vserver_disk" data-slider-id="vserver_disk" type="text" data-slider-min="10" data-slider-max="100" data-slider-step="10" data-slider-value="10"/>
                                            </span>
                                            <span style="display:block; margin-top: 3rem;">
                                                <span id="vserver_ip_label" style="display:block; text-align: left; margin-left: 3rem; margin-bottom: 1rem; font-size: 1.7rem; margin-top: 1rem;"><b>IPv4</b>: <span id="vserver_ip_currentval">1</span></span>
                                                <input id="vserver_ip" data-slider-id="vserver_ip" type="text" data-slider-min="1" data-slider-max="1" data-slider-step="1" data-slider-value="1"/>
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="orderbutton btn-primary btn-orderbutton" style="display:block; float:right;margin-top: 12rem;" onclick="openConfigurator()"><?php  echo $lang->getString("next"); ?></button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="layout-text contact-layout left-layout padding-top50 padding-bottom60 features-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img src="<?php echo $cdn; echo $lang->getString("interfacepng"); ?>" class="img-responsive" alt="" data-aos="fade-right">
                <img src="<?php echo $cdn; echo $lang->getString("interfacepng"); ?>" class="img-absolute" alt="" data-aos="fade-right">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="box-shadow">
                    <div class="list-features">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-title text-left">
                                    <h2><?php  echo $lang->getString("owninterface"); ?></h2>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <ul>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver1"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver2"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver3"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver4"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver5"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver6"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver7"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver8"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("vserver9"); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Layout - Text right  -->
    <div class="layout-text right-layout gray-layout padding-bottom50 padding-top50">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <iframe src="https://grafana.prohosting24.de/d-solo/L6lw-sYMz/pve-cluster-public?orgId=1&refresh=5s&from=now-5m&to=now&theme=light&panelId=10" class="responsive-iframe grafana" frameborder="0"></iframe>
                    <img src="<?php echo $cdn; ?>img/score-epyc-ph24-7.png" class="img-responsive img-shadow" alt="" data-aos="fade-right">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-container" data-aos="fade-up">
                        <h3><?php  echo $lang->getString("highquality"); ?></h3>
                        <div class="text-content">
                            <i class="far fa-check-circle pull-left"></i>
                            <div class="text">
                                <p><?php  echo $lang->getString("highquality1"); ?></p>
                            </div>
                        </div>
                        <div class="text-content">
                            <i class="far fa-check-circle pull-left"></i>
                            <div class="text">
                                <p><?php  echo $lang->getString("highquality2"); ?></p>
                            </div>
                        </div>
                        <div class="text-content">
                            <i class="far fa-check-circle pull-left"></i>
                            <div class="text">
                                <p><?php  echo $lang->getString("highquality3"); ?></p>
                            </div>
                        </div>
                        <div class="buttons">
                            <a href="https://grafana.prohosting24.de/d/L6lw-sYMz/pve-cluster-public?orgId=1&refresh=5s" target="_blank" class="btn btn-medium btn-green">Grafana <i class="fas fa-external-link-alt"></i></a>
                            <a href="https://browser.geekbench.com/v4/cpu/15987050" target="_blank" class="btn btn-medium btn-green">Geekbench 4 Test <i class="fas fa-external-link-alt"></i></a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Layout - Text right ends here  -->



<div class="faq padding-bottom50 padding-top50 gray-bg">
    <div class="custom-width">
        <h3><?php  echo $lang->getString("faq"); ?></h3>
        <div class="accordion">
            <div class="accordion-item">
                <a><?php  echo $lang->getString("faq4q"); ?></a>
                <div class="content">
                    <p><?php  echo $lang->getString("faq4a"); ?></p>
                </div>
            </div>
            <div class="accordion-item">
                <a><?php  echo $lang->getString("faq5q"); ?></a>
                <div class="content">
                    <p><?php  echo $lang->getString("faq5a"); ?></p>
                </div>
            </div>
            <div class="accordion-item">
            <a><?php  echo $lang->getString("faq6q"); ?></a>
            <div class="content">
                <p><?php  echo $lang->getString("faq6a"); ?></p>
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


$apirespond = requestBackend($config, ["id" => 1], "getproduktinfos");
?>
<script>
<?php
echo "
var baseprice = " . $apirespond["response"]["price"] . ";
var base_corecount = " . $apirespond["response"]["upgrades"]["cores"][0]["data"] . ";
var base_memorycount = " . $apirespond["response"]["upgrades"]["memory"][0]["data"] . " / 1024;
var base_diskcount = " . $apirespond["response"]["upgrades"]["disk"][0]["data"] . ";
var base_ipcount = " . $apirespond["response"]["upgrades"]["ip"][0]["data"] . ";

var max_corecount = " . $apirespond["response"]["upgrades"]["cores"][count($apirespond["response"]["upgrades"]["cores"]) - 1]["data"] . ";
var max_memorycount = " . $apirespond["response"]["upgrades"]["memory"][count($apirespond["response"]["upgrades"]["memory"]) - 1]["data"] . " / 1024;
var max_diskcount = " . $apirespond["response"]["upgrades"]["disk"][count($apirespond["response"]["upgrades"]["disk"]) - 1]["data"] . ";
var max_ipcount = " . $apirespond["response"]["upgrades"]["ip"][count($apirespond["response"]["upgrades"]["ip"]) - 1]["data"] . ";

var array_core = " . json_encode($apirespond["response"]["upgrades"]["cores"]) . ";
var array_memory = " . json_encode($apirespond["response"]["upgrades"]["memory"]) . ";
var array_disk = " . json_encode($apirespond["response"]["upgrades"]["disk"]) . ";
var array_ip = " . json_encode($apirespond["response"]["upgrades"]["ip"]) . ";
";
?>

var current_core_value = 0;
var current_memory_value = 0;
var current_disk_value = 0;
var current_ip_value = 0;

var current_core_price = 0;
var current_memory_price = 0;
var current_disk_price = 0;
var current_ip_price = 0;

var currentos = 1;
var osarray = [];
var discount = 0;
var discountcode = '';
var price = 0;
var loggedin = false;
var secret = 0;

var servicepage = '<?php echo $config->getconfigvalue('cp_service_link') ?>';
var internapi = '<?php echo $config->getconfigvalue('internapi') ?>';



function openConfigurator(){
    window.location.replace('<?php echo $cp; ?>vserver/order/' + current_core_value + '/' + current_memory_value+ '/' + current_disk_value+ '/' + current_ip_value);
}

function <?php echo $classes->getclassname("calcuateprice"); ?>(r,e){switch(r){case 1:array_core.forEach(r=>{r.data==e&&($("#vserver_cores_currentval").html(e),$("#vserver_cores_currentval_2").html(e),$("#vserver_cores_price").html(parseFloat(r.price).toFixed(2)),current_core_value=e,current_core_price=parseFloat(r.price))});break;case 2:$("#vserver_ram_currentval").html(array_memory[e].data/1024),$("#vserver_ram_currentval_2").html(array_memory[e].data/1024),$("#vserver_ram_price").html(parseFloat(array_memory[e].price).toFixed(2)),current_memory_value=array_memory[e].data/1024,current_memory_price=parseFloat(array_memory[e].price);break;case 3:array_disk.forEach(r=>{r.data==e&&($("#vserver_disk_currentval").html(e),$("#vserver_disk_currentval_2").html(e),$("#vserver_disk_price").html(parseFloat(r.price).toFixed(2)),current_disk_value=e,current_disk_price=parseFloat(r.price))});break;case 4:array_ip.forEach(r=>{r.data==e&&($("#vserver_ip_currentval").html(e),$("#vserver_ip_currentval_2").html(e),$("#vserver_ip_price").html(parseFloat(r.price).toFixed(2)),current_ip_value=e,current_ip_price=parseFloat(r.price))})}price=(baseprice+current_core_price+current_memory_price+current_disk_price+current_ip_price)*(-1*(discount-1)),$("#vserver_currentprice").html(price.toFixed(2))}



$("#vserver_grundpreis").html(parseFloat(baseprice).toFixed(2)),$("#vserver_cores").attr("data-slider-min",base_corecount),$("#vserver_cores").attr("data-slider-max",max_corecount),<?php echo $classes->getclassname("calcuateprice"); ?>(1,base_corecount),<?php echo $classes->getclassname("calcuateprice"); ?>(2,0),$("#vserver_disk").attr("data-slider-min",base_diskcount),$("#vserver_disk").attr("data-slider-max",max_diskcount),<?php echo $classes->getclassname("calcuateprice"); ?>(3,base_diskcount),$("#vserver_ip").attr("data-slider-min",base_ipcount),$("#vserver_ip").attr("data-slider-max",max_ipcount),<?php echo $classes->getclassname("calcuateprice"); ?>(4,base_ipcount),$("#vserver_cores").slider({tooltip:"hide"}),$("#vserver_cores").on("change",function(e){<?php echo $classes->getclassname("calcuateprice"); ?>(1,e.value.newValue)}),$("#vserver_ram").slider({min:0,max:array_memory.length-1,step:1,value:0,tooltip:"hide"}),$("#vserver_ram").on("change",function(e){<?php echo $classes->getclassname("calcuateprice"); ?>(2,e.value.newValue)}),$("#vserver_disk").slider({tooltip:"hide"}),$("#vserver_disk").on("change",function(e){<?php echo $classes->getclassname("calcuateprice"); ?>(3,e.value.newValue)}),$("#vserver_ip").slider({tooltip:"hide"}),$("#vserver_ip").on("change",function(e){<?php echo $classes->getclassname("calcuateprice"); ?>(4,e.value.newValue)});
</script>
<?php

echo '</body></html>';

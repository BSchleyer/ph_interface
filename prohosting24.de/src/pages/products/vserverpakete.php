<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $lang->getString("vserverpackage") . " - ProHosting24", $lang, $name));


echo '<body>';




echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$cp = $config->getconfigvalue('cpLink');
$classes = new ClassNamer();

?>
    <div class="default-header vserver">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-7">
                    <div class="header-text">
                        <h2><?php  echo $lang->getString("vserverhead"); ?></h2>
                        <p><?php  echo $lang->getString("vserverphead"); ?></p>
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

<div class="features-two padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="row" id="packetmaster">
        </div>
    </div>
</div>




<div id="vserver_config" style="display:none;">
    <hr style="background-color: #00A8FF; height: .15rem; margin: 0; padding: 0;">
    <div class="pricing-tables-light padding-top60 padding-bottom70">
        <div class="container">
            <div class="main-title text-center" style="margin-bottom: 0px;">
                <h2><span id="vserver_packetname">Paketname</span></h2>
                <p>Konfigurieren Sie Ihr Serverpaket.</p>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="background-color:#ffffff; padding:0; box-shadow: 0 0 20px rgba(54, 46, 97, 0.04); border-radius: .5rem; padding-bottom: .75rem;">
                    <div class="table-content blue-border" style="box-shadow:0 0 0 0;">
                        <div id="oder_main">
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="display: block; text-align: left; padding-top: 1.75rem;">
                                <span class="oderborder">
                                    <span style="text-align:left; display: block;font-weight: bold; color: #888; font-size: 2.5rem;">KVM Server bestellen</span>
                                    <hr class="oderhr">

                                    <span class="odersidemargin"><span>Paketpreis:</span><span style="float:right;"><span id="vserver_grundpreis">0.00</span> €</span></span>
                                    <span class="odersidemargin"><span>Kerne: <span id="vserver_cores_currentval_2">1</span></span></span>
                                    <span class="odersidemargin"><span>Arbeitsspeicher: <span id="vserver_ram_currentval_2">1</span>GB</span></span>
                                    <span class="odersidemargin"><span>SSD Speicher: <span id="vserver_disk_currentval_2">1</span> GB</span></span>
                                    <span class="odersidemargin"><span>IPv4 Adressen: <span id="vserver_ip_currentval_2">1</span></span></span>
                                    <span class="odersidemargin"><span>IPv6 Adressen: <span>1x IPv6 /64 Subnetz</span></span></span>
                                    <span style="display:block;margin-top: .75rem;"><span>Laufzeit: 30 Tage</span></span>
                                    <span style="display:block; margin-bottom: .75rem;">Betriebssystem: <span id="vserver_os_show">-</span></span>
                                    <span style="display:block; opacity: 0.6;"><span>(inklusive:)</span></span>
                                    <span>Traffic: Fair-Use</span><br>
                                    <span>Anbindung: 1 GBit/s Shared</span><br>
                                    <span>DDoS Schutz: 750 GBit/s</span><br><br>
                                    <span style="font-weight: bold; color: #888; font-size: 2rem;">Summe: <span id="vserver_currentprice">8</span>€</span>

                                    <hr class="oderhr">
                                    <span class="odersidemargin" style="float:right; opacity: 0.6">Schritt <span id="schrittcount">1</span> von 3<br></span>
                                </span>
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

?>

<script>
var packages = [];
var currentos = 1;
var baseprice = 0;
var currentpackage = 1;
var discount = 0;
var discountcode = '';
var secret = 0;

var servicepage = '<?php echo $config->getconfigvalue('cp_service_link') ?>';
var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";

function loadpackets() {
    $.ajax({
        type: "POST",
        crossDomain: !0,
        beforeSend: function(e) { e.setRequestHeader('Function', "getpacketsfrontend") },
        url: internapi,
        success: function(respond) {
            packages = respond.response;
            document.getElementById("packetmaster").innerHTML = "";
            count = 1;
            respond.response.forEach(e => {
                switch (count) {
                    case 2:
                        classes = "mobilepadding mobilepaddingtop";
                        break;
                    case 3:
                        classes = "mobilepadding";
                        break;
                    default:
                        classes = ""
                }
                if (count > 3) {
                    classes = 'knstlichespadding mobilepadding';
                }
                count++;
                maxoscount = e.id;
                packagebutton = `<button class="vpspakete-buybutton" onclick="openConfigurator(` + e.id + `)">Jetzt Kaufen</button>`;
                if (e.active != 1) {
                    packagebutton = `<button class="vpspakete-notav" >Nicht verfügbar</button>`;
                }
                innerhtml = document.getElementById("packetmaster").innerHTML;
                document.getElementById("packetmaster").innerHTML = innerhtml + `
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ` + classes + `">
                    <div class="vpspakete-box-shadow-dark">
                        <span class="padding-top10">
                            <div class="text-center">
                                <h3 class="vpspakete-title">` + e.title + `</h3>
                                <h1 class="vpspakete-price"><b>` + parseFloat(e.price).toFixed(2) + ` €</b></h1>
                                <p class="vpspakete-subtitle">` + e.description + `</p>
                            </div>
                        </span>
                    </div>
                    <div class="vpspakete-box-shadow">
                        <span class="padding-top10 padding-bottom30">
                            <div class=" text-center" style="padding-bottom: 2rem;">
                                <h4><i class="far fa-check-square"></i> ` + e.cores + ` Kerne mit + 3.1GHz</h4>
                                <h4><i class="far fa-check-square"></i> ` + e.memory / 1024 + ` GB Arbeitsspeicher</h4>
                                <h4><i class="far fa-check-square"></i> ` + e.disk + ` GB Speicher</h4>
                                <h4><i class="far fa-check-square"></i> 1 IPv4 Adresse</h4>
                                <h4><i class="far fa-check-square"></i> 1 IPv6 /64 Subnetz</h4>
                                <h4><i class="far fa-check-square"></i> 1 GBit/s Uplink (Shared)</h4>
                                <h4><i class="far fa-check-square"></i> Fair-Use Traffic</h4>
                                <h4><i class="far fa-check-square"></i> 750 GBit/s DDoS Schutz</h4>
                                <h4><i class="far fa-check-square"></i> Keine Vertragsbindung</h4>
                                <hr style="background-color: #00A8FF; height: .1rem; margin: 1rem; padding: 0;">
                                ` + packagebutton + `
                            </div>
                        </span>
                    </div>
                </div>`;
            })
        }
    })
}


function openConfigurator(id){
    window.location.replace('<?php echo $cp; ?>vserver/order/p/' + id);
}
loadpackets();
</script>
</body>
</html>

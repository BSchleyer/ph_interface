<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $lang->getString("vserver") . " - Prohosting24", $lang, $name));


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
                        <h2><?php  echo $lang->getString("blackfriday"); ?></h2>
                        <p>
                        <?php  echo $lang->getString("blackfridayp"); ?>
                        </p>
                    </div>
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

var servicepage = '<?php echo $config->getconfigvalue('cp_service_link') ?>';
var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
var backendURL = "<?php echo $config->getconfigvalue('backendendpoint'); ?>v1/";
function loadpackets() {
    apiRequest([], "GET", "public/vserver/offers", function(respond) {
        count = 0;
        respond.forEach(packet => {
                switch (count) {
                    case 1:
                        classes = "mobilepadding mobilepaddingtop";
                        break;
                    case 2:
                        classes = "mobilepadding";
                        break;
                    default:
                        classes = ""
                }
                if (count > 3) {
                    classes = 'knstlichespadding mobilepadding';
                }
                count++;
                packagebutton = `<button class="vpspakete-buybutton" onClick="window.location.replace('<?php echo $cp; ?>vserver/order/p/` + packet.packetid + `');">Jetzt Kaufen</button>`;
                if (packet.packetInfo.active != 1) {
                    packagebutton = `<button class="vpspakete-notav" >Nicht verfügbar</button>`;
                }
                innerhtml = document.getElementById("packetmaster").innerHTML;
                document.getElementById("packetmaster").innerHTML = innerhtml + `
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ` + classes + `">
                    <div class="vpspakete-box-shadow-dark">
                        <span class="padding-top10">
                            <div class="text-center">
                                <h3 class="vpspakete-title">` + packet.packetInfo.title + `</h3>
                                <h1 class="vpspakete-price"><b>` + packet.packetInfo.price + `€</b></h1>
                                <p class="vpspakete-subtitle">` + packet.packetInfo.description + `</p>
                            </div>
                        </span>
                    </div>
                    <div class="vpspakete-box-shadow">
                        <span class="padding-top10 padding-bottom30">
                            <div class=" text-center" style="padding-bottom: 2rem;">
                                <h4><i class="far fa-check-square"></i> ` + packet.packetInfo.cores + ` Kerne mit + 3.1GHz</h4>
                                <h4><i class="far fa-check-square"></i> ` + packet.packetInfo.memory / 1024 + ` GB Arbeitsspeicher</h4>
                                <h4><i class="far fa-check-square"></i> ` + packet.packetInfo.disk + ` GB Speicher</h4>
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
    }, function(respond) {
        console.log(respond);
    });
}

loadpackets();

</script>
</body>
</html>

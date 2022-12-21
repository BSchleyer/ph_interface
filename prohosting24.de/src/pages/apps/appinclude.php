<?php


defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, $productInfo["displayname"] . " - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');

$classes = new ClassNamer();

?>
    <div class="default-header <?php echo strtolower($productInfo["displayname"]); ?>">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-7">
                    <div class="header-text">
                        <h2><?php echo $productInfo["displayname"]; ?> <?php  echo $lang->getString("hosting"); ?></h2>
                        <p><?php  echo $lang->getString("hostingt"); ?> <?php echo $productInfo["displayname"]; ?> Hosting.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

$packetInfo = [];

foreach ($productInfo["packets"] as $packet) {
    foreach ($packet["values"] as $value) {
        if($value["hide"] == 0){
            if(count($packetInfo) > 2){
               break;
            }
            $packetInfo[count($packetInfo)] = $value["displaynamelang"];
        }
    }
    break;
}
ksort($packetInfo);
?>

<!-- table -->
<div class="dedicated-pricing padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="main-title text-center">
            <h2><?php  echo $lang->getString("pricing"); ?></h2>
            <p><?php  echo $lang->getString("appstitlet"); ?></p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th><?php  echo $lang->getString("package"); ?></th>
                        <?php
                        foreach ($packetInfo as $value) {
                            echo '<th>'.$lang->getString($value).'</th>';
                        }
                        ?>
                        <th>IPv4 <?php  echo $lang->getString("ipaddress"); ?></th>
                        <th><?php  echo $lang->getString("price"); ?></th>
                        <th><?php  echo $lang->getString("learnmore"); ?></th>
                    </tr>
                </thead>
                <?php
                    foreach ($productInfo["packets"] as $packetInfo) {
                        echo '<tr data-aos="fade-up" data-aos-delay="50">';
                        echo '<td>' . $packetInfo["name"] . '</td>';
                        $counter =  0;
                        foreach ($packetInfo["values"] as $value) {
                            if($value["hide"] == 0){
                                if($counter > 2){
                                    break;
                                }
                                $valueDisplay = $value["value"];
                                if($value["divide"] != "0"){
                                    $valueDisplay = intval($valueDisplay) / intval ($value["divide"]);
                                }
                                echo '<td>' . $valueDisplay . ' ' . $lang->getString($value["marklang"]) . '</td>';
                                $counter++;
                            }
                        }
                        echo '<td>1</td>';
                        echo '<td class="price-in-table"> ' . str_replace(".",",",number_format($packetInfo["price"], 2, ',', ' ')) . ' €</td>';
                        echo '<td><a class="btn btn-small btn-green" href="' . $url . '/cp/app/order/' . $productInfo["id"] . '">' .$lang->getString("next") .'<i class="fas fa-share"></i></a></td>';
                        echo '</tr>';
                    }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- table end-->




<div class="layout-text contact-layout left-layout padding-top50 padding-bottom60 features-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img src="<?php echo $cdn; ?>img/app.png" class="img-responsive" alt="" data-aos="fade-right">
                <img src="<?php echo $cdn; ?>img/app.png" class="img-absolute" alt="" data-aos="fade-right">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="box-shadow">
                    <div class="list-features">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="main-title text-left">
                                    <h2><?php  echo $lang->getString("simpleinterface"); ?></h2>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <ul>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simpleinterface1"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simpleinterface2"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simpleinterface3"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simpleinterface4"); ?></li>
                                    <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("simpleinterface5"); ?></li>
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


echo '</body></html>';

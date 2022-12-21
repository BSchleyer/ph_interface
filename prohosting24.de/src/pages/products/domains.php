<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, "Domains - ProHosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$cdn = $config->getconfigvalue('cdn');
$cp = $config->getconfigvalue('cpLink');

$classes = new ClassNamer();

?>
<input style="display:none" type="text" name="fakeusernameremembered"/>
<input style="display:none" type="password" name="fakepasswordremembered"/>
    <div class="default-header domain-page">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-7">
                    <div class="header-text">
                        <h2><?php  echo $lang->getString("over"); ?> <text id="tldcount"></text> <?php  echo $lang->getString("tlds"); ?></h2>
                    </div>
                    <p><?php  echo $lang->getString("domainheading"); ?></p>
                </div>
            </div>
        </div>
    </div>
<div class="features-two padding-top50 padding-bottom50">
    <div class="custom-width">
        <div class="box-shadow">
            <span class="padding-top10 padding-bottom30 domainbestellung">
                <div class=" text-center" style="padding-bottom: 2rem;">
                    <h2><b><?php  echo $lang->getString("domainorder"); ?></b></h2>
                    <p><?php  echo $lang->getString("domainordert"); ?></p>
                </div>
                <div id="order_step1">
                    <span class="domainsformfix">
                        <input id="order_domain" class="form-control" style="height: 45px; font-size: 15px; max-width:80%; display:inherit;" placeholder="sld.tld">
                        <button type="button" class="domainbutton btn-primary btn-domainbutton" style="float: right; clear:right;" onclick="<?php echo $classes->getclassname("checkdomain"); ?>(-1)"><?php  echo $lang->getString("check"); ?></button>
                        <center><?php echo getloadinghtml('loaddomaincheck', true); ?></center>
                        <span style="display:none" id="orderstep_1_domaininfo">
                            <div class="text-center" style="padding-top:2rem;">
                                <h3><b id="orderstep_1_domain_show" >prohosting24.de</b></h3>
                            </div>
                            <hr style="background-color: #00A8FF; height: .5rem; margin: 1rem; padding: 0; border-radius: 20rem;">
                            <div class="table-responsive">
                                <table class="table table-striped custab domaintabelle" style="width:100%;" id="orderstep_1_domainlist">
                                    <thead>
                                        <tr>
                                            <th><?php  echo $lang->getString("domain"); ?></th>
                                            <th><?php  echo $lang->getString("price"); ?></th>
                                            <th><?php  echo $lang->getString("statusd"); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="orderstep_1_domainlist_tbody">
                                    </tbody>
                                </table>
                            </div>
                        </span>
                    </span>
                </div>
            </span>
        </div>
     </div>
</div>

<div class="layout-text contact-layout left-layout padding-top50 padding-bottom60 features-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img src="<?php echo $cdn; ?>img/domain.png" class="img-responsive" alt="" data-aos="fade-right">
                <img src="<?php echo $cdn; ?>img/domain.png" class="img-absolute" alt="" data-aos="fade-right">
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
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("owninterface1"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("owninterface2"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("nocontract"); ?></li>
                                <li><i class="fa fa-plus"></i> <?php  echo $lang->getString("owninterface4"); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="dedicated-pricing padding-top40 padding-bottom50">
    <div class="custom-width">
        <div class="main-title text-center">
            <h2><?php  echo $lang->getString("ourdomains"); ?></h2>
            <p><?php  echo $lang->getString("ourdomainst"); ?></p>
        </div>
        <div class="table-responsive">
            <table class="table table-striped custab" id="domaintable">
                <thead>
                    <tr>
                        <th><?php  echo $lang->getString("tld"); ?></th>
                        <th><?php  echo $lang->getString("register"); ?></th>
                        <th><?php  echo $lang->getString("transfer"); ?></th>
                        <th><?php  echo $lang->getString("renew"); ?></th>
                    </tr>
                </thead>
                <tbody id="domaintabletbody">
                </tbody>
            </table>
        </div>
        <center>
            <div class="buttons" style="padding-top:25px" id="showalldomains">
                <a onclick="<?php echo $classes->getclassname("loadxdomains"); ?>(-1)" id="showall_button" class="btn btn-large btn-green"><?php  echo $lang->getString("showall"); ?></a>
                <a onclick="<?php echo $classes->getclassname("loadxdomains"); ?>(10)" id="show10_button" style="display:none"class="btn btn-large btn-green"><i class="fa fa-plus"></i> <?php  echo $lang->getString("showless"); ?></a>
            </div>
        </center>
    </div>
</div>
<?php
echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));
echo '<script src="' . $cdn . 'vendors/general/toastr/build/toastr.min.js" type="text/javascript"></script>';

?>
<script>
var domainarray = [];
var konktaktarray = [];
var activedomain = '';

var currentid = 1;
var authdone = false;
var domainprice = 0;
var activecontact = 0;
var secret = 0;

var internapi = "<?php echo $config->getconfigvalue('internapi'); ?>";
var servicepage = '<?php echo $config->getconfigvalue('cp_service_link') ?>';

function <?php echo $classes->getclassname("checkdomain"); ?>(){
    domain = $('#order_domain').val();
    if(domain == ''){
        toastr.error('<?php  echo $lang->getString("orderdomainnodomain"); ?>','<?php  echo $lang->getString("error"); ?>');
        return;
    }
    $('#loaddomaincheck').show();
    $('#orderstep_1_domaininfo').hide();
    $.ajax({
        type: 'POST',
        crossDomain: true,
        beforeSend: function(request) {
            request.setRequestHeader('Function', 'checkdomain');
        },
        url: internapi,
        data: { domain:domain,all:'all'},
        success: function(respond){
            document.getElementById('loaddomaincheck').style.display = 'none';
            if(respond.fail){
                toastr.error(respond.error,'<?php  echo $lang->getString("error"); ?>');
            } else {
                $("#orderstep_1_domainlist_tbody").empty();
                $("#orderstep_1_domain_show").html(escape(domain));
                respond.response.array.forEach(element => {
                    if(element.av){
                        price  = element.price + '€/<?php  echo $lang->getString("year"); ?>';
                        button = `<button class="domainbestellenbutton" onclick="openConfigurator('` + domain.split('.')[0] + `','` + element.tld + `')"><?php  echo $lang->getString("next"); ?></button>`;
                    } else {
                        price  = '-';
                        button = '<button class="domainbestellenbutton-notavailabile"><?php  echo $lang->getString("notavailable"); ?></button>';
                    }
                    $('#orderstep_1_domainlist_tbody').append(`
                    <tr>
                        <td>` + escape(domain.split('.')[0]) + '.' + element.tld + `</td>
                        <td>` + price + `</td>
                        <td>` + button + `</td>
                    </tr>`);
                });
                $('#orderstep_1_domaininfo').show();
            }
        }
    });
}


function <?php echo $classes->getclassname("getdomains"); ?>(){$.ajax({type:"POST",crossDomain:!0,beforeSend:function(e){e.setRequestHeader('Function',"getalltlds")},url:internapi,success:function(e){e.fail?toastr.error("Fehler bei Ajax Request.",""):(domainarray=e.response,$("#tldcount").html(domainarray.length),<?php echo $classes->getclassname("loadxdomains"); ?>(10))}})}

function <?php echo $classes->getclassname("loadxdomains"); ?>(t){$("#domaintabletbody").empty(),i=0,domainarray.forEach(n=>{i!=t&&($("#domaintabletbody").append("\n<tr>\n<td>"+n.tld+"</td>\n<td>"+n.price_create+"€ / <?php  echo $lang->getString("year"); ?></td>\n<td>"+n.price_transfer+"€ / <?php  echo $lang->getString("year"); ?></td>\n<td>"+n.price_renew+"€ / <?php  echo $lang->getString("year"); ?></td>\n</tr>"),i++)}),-1==t?($("#showall_button").hide(),$("#show10_button").show()):($("#showall_button").show(),$("#show10_button").hide())}

function openConfigurator(name,tld){
    window.location.replace('<?php echo $cp; ?>domain/order/' + name + "/" + tld);
}


<?php echo $classes->getclassname("getdomains"); ?>();
</script>
</body>
</html>
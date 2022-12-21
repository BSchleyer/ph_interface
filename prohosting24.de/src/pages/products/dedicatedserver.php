<?php

defined('QnqH1tm25iKsgqXAOoUd') or die();


echo minifyhtml(getheader($config, "Dedizierte Server - Prohosting24", $lang, $name));


echo '<body>';



echo minifyhtml(getnavbar($config, $lang));

$url = $config->getconfigvalue('url');
$classes = new ClassNamer();

echo minifyhtml('

    <!-- Default Page Header -->
    <div class="default-header server-page">
        <div class="custom-width">
            <div class="row">
                <div class="col-sm-7">
                    <div class="header-text">
                        <h2>Dedizierte Server</h2>
                        <p>Dedizierte Server aus eigener Hand. Ideal für Virtualisierung & intensive Workloads.</p>
                        <h4>schon Bereits</h4>
                        <h3>ab € 156,67 / Monat</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Page Header ends here -->

    <!-- table -->
    <div class="dedicated-pricing padding-top50 padding-bottom50">
        <div class="custom-width">
            <div class="main-title text-center">
                <h2>Aktuelle Angebote Dedizierter Server</h2>
                <p>Individuelle Angebote können unter unseren Kontaktmöglichkeiten oder bequem im Kundenbereich unverbindlich angefragt werden.</p>
            </div>
            <div class="table-responsive">
                <table class="table table-striped custab">
                    <thead>
                        <tr>
                            <th>Prozessor</th>
                            <th>Speicher</th>
                            <th>Arbeitsspeicher</th>
                            <th>Traffic</th>
                            <th>IP Adressen</th>
                            <th>Preis</th>
                            <th>Vertragslaufzeit</th>
                            <th>Anfragen</th>
                        </tr>
                    </thead>
                    <tr data-aos="fade-up" data-aos-delay="50">
                        <td>1x Intel Xeon E5 2680v2</td>
                        <td>1x 500 GB SSD</td>
                        <td>64 GB ECC RAM</td>
                        <td>3 TB Inklusive</td>
                        <td>5 Inklusive</td>
                        <td class="price-in-table">156,67 € / Monat</td>
                        <td class="price-in-table">12 Monate</td>
                        <td><a class="btn btn-small btn-green" href="' . $url . '/contact">Kontakt<i class="fas fa-share"></i></a></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="50">
                        <td>1x Intel Xeon E5 2680v2</td>
                        <td>2x 500 GB SSD</td>
                        <td>64 GB ECC RAM</td>
                        <td>3 TB Inklusive</td>
                        <td>5 Inklusive</td>
                        <td class="price-in-table">165,00 € / Monat</td>
                        <td class="price-in-table">12 Monate</td>
                        <td><a class="btn btn-small btn-green" href="' . $url . '/contact">Kontakt<i class="fas fa-share"></i></a></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="50">
                        <td>1x Intel Xeon E5 2680v2</td>
                        <td>2x 500 GB SSD</td>
                        <td>128 GB ECC RAM</td>
                        <td>3 TB Inklusive</td>
                        <td>5 Inklusive</td>
                        <td class="price-in-table">181,67 € / Monat</td>
                        <td class="price-in-table">12 Monate</td>
                        <td><a class="btn btn-small btn-green" href="' . $url . '/contact">Kontakt<i class="fas fa-share"></i></a></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="50">
                        <td>2x Intel Xeon E5 2680v2</td>
                        <td>2x 500 GB SSD</td>
                        <td>128 GB ECC RAM</td>
                        <td>5 TB Inklusive</td>
                        <td>5 Inklusive</td>
                        <td class="price-in-table">229,90 € / Monat</td>
                        <td class="price-in-table">12 Monate</td>
                        <td><a class="btn btn-small btn-green" href="' . $url . '/contact">Kontakt<i class="fas fa-share"></i></a></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="50">
                        <td>2x Intel Xeon E5 2680v2</td>
                        <td>2x 500 GB SSD</td>
                        <td>256 GB ECC RAM</td>
                        <td>5 TB Inklusive</td>
                        <td>5 Inklusive</td>
                        <td class="price-in-table">263,23 € / Monat</td>
                        <td class="price-in-table">12 Monate</td>
                        <td><a class="btn btn-small btn-green" href="' . $url . '/contact">Kontakt<i class="fas fa-share"></i></a></td>
                    </tr>
                    <tr data-aos="fade-up" data-aos-delay="50">
                        <td>2x Intel Xeon E5 2680v2</td>
                        <td>2x 1000 GB SSD</td>
                        <td>256 GB ECC RAM</td>
                        <td>5 TB Inklusive</td>
                        <td>5 Inklusive</td>
                        <td class="price-in-table">279,00 € / Monat</td>
                        <td class="price-in-table">12 Monate</td>
                        <td><a class="btn btn-small btn-green" href="' . $url . '/contact">Kontakt<i class="fas fa-share"></i></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <!-- table end-->

<!-- Faq -->
<div class="faq padding-bottom50 padding-top50 gray-bg">
    <div class="custom-width">
        <h3>Häufig gestellte Fragen</h3>
        <div class="accordion">
            <div class="accordion-item">
                <a>Wie viel Monate beträgt die Kündigungsfrist?</a>
                <div class="content">
                    <p>
                        Der Vertrag kann 4 Wochen vor Auslaufen der Vertragslaufzeit gekündigt werden.
                    </p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Wie viel Anbindung hat mein Server?</a>
                <div class="content">
                    <p>
                        Der Server verfügt über 1x 1 GBit/s Anbindung.
                    </p>
                </div>
            </div>
            <div class="accordion-item">
                <a>Gibt es einen RAID-Controller?</a>
                <div class="content">
                    <p>
                        Nein, es kann jedoch bei der Neuinstallation durch uns ein Software RAID konfiguriert werden.
                    </p>
                </div>
            </div>
            <div class="accordion-item">
            <a>Kann Ich den Server Upgraden?</a>
            <div class="content">
                <p>
                    Ja, bei den Servern können auf Anfrage:
                    <br><br> - CPU <br> - Arbeitsspeicher <br> - SSD Speicher <br><br>erweitert werden.
                </p>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>


');

echo minifyhtml(gettwitterbanner($config, $lang));
echo minifyhtml(getnormalfooter($config, $lang));
echo minifyhtml(getunderfooter($config, $lang));
echo minifyhtml(getjs($config));

echo '</body></html>';


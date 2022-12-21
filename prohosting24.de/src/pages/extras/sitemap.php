<?php
header('Content-Type: text/xml');
$url = $config->getconfigvalue('url') . "/";
?>
<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<url>
    <loc><?php  echo $url; ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
<priority>1.00</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("vps"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.90</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("vpsplans"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.90</priority>
</url>
<url>
    <loc><?php  echo $url; ?>webspace</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc><?php  echo $url; ?>domains</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc><?php  echo $url; ?>minecraft</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc><?php  echo $url; ?>mongodb</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.80</priority>
</url>
<url>
    <loc><?php  echo $url; ?>mariadb</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?>postgresql</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?>redis</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?>rust</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("dcurl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("ddosurl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("privacyurl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?>ceph</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?>hardware</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("uplinkurl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("contacturl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("imprinturl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("tosurl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?><?php  echo $lang->getString("privacyurl"); ?></loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
<url>
    <loc><?php  echo $url; ?>apps</loc>
    <lastmod>2022-01-08T17:13:14+00:00</lastmod>
    <priority>0.70</priority>
</url>
</urlset>

<?php
die();
?>
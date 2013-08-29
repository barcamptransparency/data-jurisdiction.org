<?php

    header("Content-type: text/html; charset=UTF-8");

    require_once(dirname(__FILE__) . '/data/countries/codes.php');
    
    $jurisdiction = strtoupper(preg_replace("/[^a-zA-Z0-9\s]/", "", $_GET['_jurisdiction']));
    if ($jurisdiction) {
        
        $file = dirname(__FILE__) . '/data/countries/' . $jurisdiction . '.ini';
        
        if (file_exists($file)) {
            $jurisdiction_data = parse_ini_file($file, true);
            
            if (!$jurisdiction_data) {
                
                // Render 404
                header("HTTP/1.1 404 Not Found");
                header("Status: 404");
            }
        }
    }
    
    
?><!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8" /> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php 
                if (!empty($jurisdiction))
                    echo $country_code_mapping[$jurisdiction] . " | ";
                
                
            ?>data-jurisdiction.org</title>
            
            <link type="text/plain" rel="author" href="/humans.txt" />
            
            <link href="/bootstrap/bootstrap-3.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="/style.css" />
    </head>
    <body>
        <!-- Fixed navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">data-jurisdiction.org</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
<?php

    
    
    if ($jurisdiction) {
        
        if ($jurisdiction_data) {
            // Render page
            
            ?>
    
        <div class="container theme-showcase">
            
            
            
            <div class="jumbotron">
                <h1 style="text-transform: capitalize;"><?= strtolower($country_code_mapping[$jurisdiction]); ?></h1>
                
                <?php if (isset($jurisdiction_data['good'])) { 
                    foreach ($jurisdiction_data['good'] as $entry ) {

                        ?>
                <div class="alert alert-success"><?= $entry; ?></div>
                        <?php
                    }
                } ?>
                 
                <?php if (isset($jurisdiction_data['bad'])) { 
                    foreach ($jurisdiction_data['bad'] as $entry ) {

                        ?>
                <div class="alert alert-warning"><?= $entry; ?></div>
                        <?php
                    }
                } ?>
                
                <?php if (isset($jurisdiction_data['ugly'])) { 
                    foreach ($jurisdiction_data['ugly'] as $entry ) {

                        ?>
                <div class="alert alert-danger"><?= $entry; ?></div>
                        <?php
                    }
                } ?>
                <p>
                    
                    <?php if (isset($jurisdiction_data['protestlink'])) { ?>
                        <a href="/" class="btn btn-lg">Forget.</a>
                        <a href="<?= $jurisdiction_data['protestlink']; ?>" target="_blank" class="btn btn-danger btn-lg">Protest.</a>
                    <?php } else {
                        ?> 
                            <a href="/" class="btn btn-lg">Ok.</a>
                            <?php
                    } ?>
                </p>
              </div>
        </div>
    
    <?php
        }
        else
        {
            
            ?>
    
        <div class="container theme-showcase">
            
            <div class="jumbotron">
                <h1>Here be Dragons!</h1>
                <p>data-jurisdiction.org is a community driven project, and unfortunately we have no information on this country yet. </p>
                <p>You can help out by forking the <a href="https://github.com/barcamptransparency/data-jurisdiction.org">project on github</a> and adding some data!</p>
                <p><a href="https://github.com/barcamptransparency/data-jurisdiction.org" target="_blank" class="btn btn-primary btn-lg">Create this entry &raquo;</a></p>
              </div>
        </div>
    
    
            <?php
        }
        
    } else {
    
        // Display landing page
        ?>
        
          <div class="container theme-showcase">
            
            <div class="jumbotron">
                <h1>Welcome to Data-Jurisdiction.org</h1>
                <p>Increasingly, the internet is becoming fragmented and balkanised, with wildly different data protection laws in each country. </p>
                <p>When communicating with someone, it is becoming vitally important to know where in the world they are (and where their data is stored) in order to know whether your conversation will remain private and your data kept safe.</p>
                <p>Data-Jurisdiction.org is a community project which will attempt to catalogue the risks in each country, in plain English.</p>
                
                
                <?php 
                    $country_code = 'us';
                    $country_name = 'United States';
                    $country_blurb = 'Most cloud services are based in the US';
                    
                    if (is_callable("geoip_country_code_by_name"))
                    {
                        if ($_SERVER['HTTP_X_FORWARDED_FOR']) {
                            $country_code = geoip_country_code_by_name ($_SERVER['HTTP_X_FORWARDED_FOR']);
                            $country_name = geoip_country_name_by_name ($_SERVER['HTTP_X_FORWARDED_FOR']);

                           $country_blurb = "You seem to be visiting from $country_name";
                      } else if ($_SERVER['REMOTE_ADDR']) {
                            $country_code = geoip_country_code_by_name ($_SERVER['REMOTE_ADDR']);
                            $country_name = geoip_country_name_by_name ($_SERVER['REMOTE_ADDR']);

                           $country_blurb = "You seem to be visiting from $country_name";
                        }  
                    }
                ?>
                
                <p><?= $country_blurb;?>, <strong><a href="/country/<?= $country_code; ?>" class="label label-danger">see which laws apply</a></strong> or <a href="https://github.com/barcamptransparency/data-jurisdiction.org" target="_blank" class="">get involved...</a></p>
              </div>
        </div>
    
    
    
    
    
        
            <?php
    }


?>
        
        <div class="container footer-links">
            <?php 
            
            foreach ($country_code_mapping as $code => $name) {
                $file = dirname(__FILE__) . '/data/countries/' . $code . '.ini';
        
                if (file_exists($file)) {
                    ?>
            
            <a class="label label-default" href="/country/<?= $code; ?>"><?= $name; ?></a>
            
                    <?php
                }
            }
            
            ?>
        </div>

    </body>
    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(["trackPageView"]);
      _paq.push(["enableLinkTracking"]);

      (function() {
        var u=(("https:" == document.location.protocol) ? "https" : "http") + "://analytics.marcus-povey.co.uk/";
        _paq.push(["setTrackerUrl", u+"piwik.php"]);
        _paq.push(["setSiteId", "3"]);
        var d=document, g=d.createElement("script"), s=d.getElementsByTagName("script")[0]; g.type="text/javascript";
        g.defer=true; g.async=true; g.src=u+"piwik.js"; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <!-- End Piwik Code -->
</html>
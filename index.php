<?php

    header("Content-type: text/html; charset=UTF-8");

    $jurisdiction = preg_replace("/[^a-zA-Z0-9\s]/", "", $_GET['_jurisdiction']);
    if ($jurisdiction) {
        
        $jurisdiction_data = parse_ini_file(dirname(__FILE__) . '/data/' . $jurisdiction . '.ini', true);
        
    }
    
    
?><!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8" /> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php
                if (isset($jurisdiction_data['name']))
                    echo $jurisdiction_data['name'] . " | ";
                
                
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
    
    
    <?php
        }
        else
        {
            // Render 404
            header("HTTP/1.1 404 Not Found");
            header("Status: 404");
            
            ?>
    
        <div class="container theme-showcase">
            
            <div class="jumbotron">
                <h1>Here be Dragons!</h1>
                <p>data-jurisdiction.org is a community driven project, and unfortunately we have no information on this country yet. </p>
                <p>You can help out by forking the <a href="https://github.com/barcamptransparency/data-jurisdiction.org">project on github</a> and adding some data!</p>
                <p><a href="https://github.com/barcamptransparency/data-jurisdiction.org" class="btn btn-primary btn-lg">Create this entry &raquo;</a></p>
              </div>
        </div>
    
    
            <?php
        }
        
    } else {
    
        // Display landing page
        ?>
        
    
    
    
    
    
        
            <?php
    }


?>

    </body>
</html>
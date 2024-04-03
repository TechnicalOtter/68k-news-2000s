<?php
    $url = "https://nypost.com/wp-content/uploads/sites/2/2024/04/COMP-Screenshot-2024-04-01-at-12.36.32-PM_aa862e.jpg?quality=75";
    $loc = "US";

    if( isset( $_GET['loc'] ) ) {
        $loc = strtoupper($_GET["loc"]);
    }

    //we can only do jpg and png here
    if (strpos($url, ".jpg") && strpos($url, ".jpeg") && strpos($url, ".png") != true ) {
        echo strpos($url, ".jpg");
        echo "Unsupported file type :(";
        exit();
    }

    //image needs to start with http
    if (substr( $url, 0, 4 ) != "http") {
        echo("Image failed :(");
        exit();
    }



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 2.0//EN">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


 <html>
 <head>
     <title>68k.news Image Viewer</title>
 </head>
 <body">
    <small><a href="<?php echo $_SERVER['HTTP_REFERER'] . '?loc=' . strtoupper($loc) ?>">< Back to article</a> | <a href="/index.php"><font color="#9400d3">68k.news</font> front page</a></small>
    <p><small><b>Viewing image:</b> <?php echo $url ?></small></p>
    <img src="/image_compressed.php?i=<?php echo $url; ?>">
    <br><br>
    <small><a href="<?php echo $_SERVER['HTTP_REFERER'] . '?loc=' . strtoupper($loc) ?>">< Back to article</a> | <a href="/index.php"><font color="#9400d3">68k.news</font> front page</a></small>
 </body>
 </html>

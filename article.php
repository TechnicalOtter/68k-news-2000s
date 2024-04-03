<?php
error_reporting(E_ERROR | E_PARSE);
header("X-Robots-Tag: noindex, nofollow", true);
require_once('vendor/autoload.php');

$article_url = "";
$article_html = "";
$error_text = "";
$loc = "US";

if( isset( $_GET['loc'] ) ) {
    $loc = strtoupper($_GET["loc"]);
}

if( isset( $_GET['a'] ) ) {
    $article_url = $_GET["a"];
} else {
    echo "What do you think you're doing... >:(";
    exit();
}

if (substr( $article_url, 0, 23 ) != "https://news.google.com") {
    echo("That's not news :(");
    die();
}

/* just a hacky fix lol, maybe make this better later */
$google_redirect_page = file_get_contents($article_url);
$parts = explode('<a href="', $google_redirect_page);
$actual_article_url = explode('"',$parts[1])[0];
$article_url = $actual_article_url;

use andreskrey\Readability\Readability;
use andreskrey\Readability\Configuration;
use andreskrey\Readability\ParseException;

$configuration = new Configuration();
$configuration
    ->setArticleByLine(false);

$readability = new Readability($configuration);

if(!$article_html = file_get_contents($article_url)) {
    $error_text .=  "Failed to get the article :( <br>";
}

try {
    $readability->parse($article_html);
    $readable_article = strip_tags($readability->getContent(), '<ol><ul><li><br><p><small><font><b><strong><i><em><blockquote><h1><h2><h3><h4><h5><h6>');
    $readable_article = str_replace( 'strong>', 'b>', $readable_article ); //change <strong> to <b>
    $readable_article = str_replace( 'em>', 'i>', $readable_article ); //change <em> to <i>
    
    $readable_article = clean_str($readable_article);
    
} catch (ParseException $e) {
    $error_text .= 'Sorry - working on it! ' . $e->getMessage() . '<br>';
}

//replace chars that old machines probably can't handle
function clean_str($str) {
    $str = str_replace( "‘", "'", $str );    
    $str = str_replace( "’", "'", $str );  
    $str = str_replace( "“", '"', $str ); 
    $str = str_replace( "”", '"', $str );
    $str = str_replace( "–", '-', $str );

    return $str;
}

// 2000's mode enable?
if( isset ($_GET['twok'] ) && filter_var( $_GET['twok'] , FILTER_VALIDATE_BOOLEAN ) ) {
    $twok = true;
} else {
    $twok = false;
}

$twokstring = $twok ? 'true':'false'; // Convert the bool to a string for URL's to save on conversion later.
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 2.0//EN">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 
 <html>
 <head>
     <title><?php echo $readability->getTitle();?></title>
     <?php
	if($twok)
	{
		echo '<link rel="stylesheet" type="text/css" href="2000.css" />';
        echo '<link rel="icon" type="image/x-icon" href="/favicon.ico">';
	}?>

 </head>
 <body>
 <?php if($twok): ?>

 <table id="infobar" border="0" cellpadding="0" cellspacing="0" width="1000">
<tbody>
<tr>
<td>
<small><marquee>Basic HTML Google News for vintage computers. Built by <a href="https://youtube.com/ActionRetro" target="_blank"><b>Action Retro</b></a> on YouTube. Tested on Netscape 1.1 through 4 on a Mac SE/30. 2000's Era look by <b><a href="https://technicalotter.github.io">TechnicalOtter</a><b/>. Tested on Internet Explorer 6 - 9.</marquee></small>
</td>
</tr>
</tbody>
</table>

 <table id="header" cellpadding="0" cellspacing="0" width="1000">
<tbody>
<tr>
<td width="121">
<img src="/68k-news.png" width="96" height="96" alt="68k News Logo">
</td>
<td>
 <h1>68k.news: <font color="#000000"><i>Headlines from the Future</i></font></h1>
 </td>
 </tr>
 </tbody>

 </table>

 <?php else: ?>
    <small><a href="/index.php?loc=<?php echo $loc ?>">< Back to <font color="#9400d3">68k.news</font> <?php echo $loc ?> front page</a></small>

    <?php endif; ?>

    <?php if($twok):?>
    <table border="0" cellpadding="0" cellspacing="0" width="1000">
    <tbody>
    <tr>

    <td width="121" valign="top">
        <div class="article-lhs">
            <a href="/index.php?loc=<?php echo $loc ?>&twok=true">< Back to <font color="#9400d3">68k.news</font> <?php echo $loc ?> front page</a>

            <hr>

            <b>Sections</b>
            <p class="lhs-link"><a href="index.php?loc=<?php echo $loc ?>&twok=<?php echo $twokstring; ?>">Headlines</a></p>
			<p class="lhs-link"><a href="index.php?section=world&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">World</a></p>
			<p class="lhs-link"><a href="index.php?section=nation&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">National</a></p>
			<p class="lhs-link"><a href="index.php?section=business&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">Business</a></p>
			<p class="lhs-link"><a href="index.php?section=technology&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">Technology</a></p>
			<p class="lhs-link"><a href="index.php?section=entertainment&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">Entertainment</p>
			<p class="lhs-link"><a href="index.php?section=sports&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">Sports</a></p>
			<p class="lhs-link"><a href="index.php?section=science&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">Science</a></p>
			<p class="lhs-link"><a href="index.php?section=health&loc=<?php echo strtoupper($loc) ?>&twok=<?php echo $twokstring; ?>">Health</a></p>

			<hr>
			<p><center><?php echo strtoupper($loc) ?> Edition <a href="choose_edition.php?twok=true">(Change)</a></center></p>
        </div>
    </td>



   <td valign="top">

    <?php endif; ?>

    <?php if($twok){echo "<div id='article'>"; } ?>
    <h1><?php echo clean_str($readability->getTitle());?></h1>
    <p><small><a href="<?php echo $article_url ?>" target="_blank">Original source</a> (on modern site) <?php
        $img_num = 0;
        $imgline_html = "| Article images:";
        foreach ($readability->getImages() as $image_url):
            //we can only do png and jpg
            if (strpos($image_url, ".jpg") || strpos($image_url, ".jpeg") || strpos($image_url, ".png") === true) {
                $img_num++;
                $imgline_html .= " <a href='image.php?loc=" . $loc . "&i=" . $image_url . "'>[$img_num]</a> ";
            }
        endforeach;
        if($img_num>0) {
            echo  $imgline_html ;
        }
    ?></small></p>
    <?php if($error_text) { echo "<p><font color='red'>" . $error_text . "</font></p>"; } ?>
    <?php
    $img_url = $readability->getImage();

    // the following is how the bbc did it in 2005. it works...
    if($img_url && $twok):
    ?>
    <table cellspacing="0" align="right" border="0" width="300" cellpadding="0" style="margin-left: 1px margin-bottom:1px;">
			<tbody><tr><td>
			<div>
				<img hspace="0" vspace="0" border="0" width="300" src="image_compressed.php?i=<?php echo $img_url; ?>">
			</div>
			</td></tr>
		</tbody></table>

    <?php endif; ?>
    <?php if($twok): ?>
    <div id="article-text">
    <?php endif; ?>
    <p><font size="4"><?php echo $readable_article;?></font></p>
    <small><a href="/index.php?loc=<?php echo $loc ?>&twok=<?php echo $twokstring; ?>">< Back to <font color="#9400d3">68k.news</font> <?php echo $loc ?> front page</a></small>
    <?php if($twok){echo "</div>"; } ?>

     <?php if($twok):?>
>/div>
     <td>
     </tr>
     </tbody>
    </table>

    <?php endif; ?>
 </body>
 </html>

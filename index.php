<?php
// send noindex headers if any url params
$any_params = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
//if(strlen($any_params['query']) > 0) {
if(array_key_exists('query', $any_params)) {
    header("X-Robots-Tag: noindex, nofollow", true);
}

//require_once('php/autoloader.php');
require_once('vendor/SimplePie.compiled.php');

$section="";
$loc = "US";
$lang = "en";
$feed_url="";

if(isset( $_GET['section'])) {
    $section = $_GET["section"];
}
if(isset( $_GET['loc'])) {
    $loc = strtoupper($_GET["loc"]);
}
if(isset( $_GET['lang'])) {
    $lang = $_GET["lang"];
}

if($section) {
	$feed_url="https://news.google.com/news/rss/headlines/section/topic/".strtoupper($section)."?ned=".$loc."&hl=".$lang;
} else {
	$feed_url="https://news.google.com/rss?gl=".$loc."&hl=".$lang."-".$loc."&ceid=".$loc.":".$lang;
}

//https://news.google.com/news/rss/headlines/section/topic/CATEGORYNAME?ned=in&hl=en
$feed = new SimplePie();
 
// Set the feed to process.
$feed->set_feed_url($feed_url);
 
// Run SimplePie.
$feed->init();
 
// This makes sure that the content is sent to the browser as text/html and the UTF-8 character set (since we didn't change it).
$feed->handle_content_type();

//replace chars that old machines probably can't handle
function clean_str($str) {
    $str = str_replace( "‘", "'", $str );    
    $str = str_replace( "’", "'", $str );  
    $str = str_replace( "“", '"', $str ); 
    $str = str_replace( "”", '"', $str );
    $str = str_replace( "–", '-', $str );
	$str = str_replace( '&nbsp;', ' - ', $str );

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
	<title>68k.news: Headlines From the Future</title>
	<?php
	if($twok)
	{
		echo '<link rel="stylesheet" type="text/css" href="2000.css" /><link rel="icon" type="image/x-icon" href="/favicon.ico">';
	}?>
</head>
<body>


<?php if($twok):?>

<table id="infobar" border="0" cellpadding="0" cellspacing="0" width="1000">
<tbody>
<tr>
<td>
<small><marquee>Basic HTML Google News for vintage computers. Built by <a href="https://youtube.com/ActionRetro" target="_blank"><b>Action Retro</b></a> on YouTube. Tested on Netscape 1.1 through 4 on a Mac SE/30. 2000's Era look by <b><a href="https://technicalotter.github.io">TechnicalOtter</a><b/>. Tested on Internet Explorer 6 - 9.</marquee></small>
</td>
</tr>
</tbody>
</table>

<table id="header" border="0" cellpadding="0" cellspacing="0" width="1000">
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

	<center><h1><b>68k.news:</b> <font color="#9400d3"><i>Headlines from the Future</i></font></h1></center>
	<hr>
	<center><small>Basic HTML Google News for vintage computers. Built by <a href="https://youtube.com/ActionRetro" target="_blank"><b>Action Retro</b></a> on YouTube. Tested on Netscape 1.1 through 4 on a Mac SE/30.</small></center>
	<?php
	if($section) {
		$section_title = explode(" - ", strtoupper($feed->get_title()));
		echo "<center><h2>" . $section_title[0]  . " NEWS</h2></center>";
	}
	?>
	<small>
	<p>
	<center><a href="index.php?loc=<?php echo $loc ?>">TOP</a> <a href="index.php?section=world&loc=<?php echo strtoupper($loc) ?>">WORLD</a> <a href="index.php?section=nation&loc=<?php echo strtoupper($loc) ?>">NATION</a> <a href="index.php?section=business&loc=<?php echo strtoupper($loc) ?>">BUSINESS</a> <a href="index.php?section=technology&loc=<?php echo strtoupper($loc) ?>">TECHNOLOGY</a> <a href="index.php?section=entertainment&loc=<?php echo strtoupper($loc) ?>">ENTERTAINMENT</a> <a href="index.php?section=sports&loc=<?php echo strtoupper($loc) ?>">SPORTS</a> <a href="index.php?section=science&loc=<?php echo strtoupper($loc) ?>">SCIENCE</a> <a href="index.php?section=health&loc=<?php echo strtoupper($loc) ?>">HEALTH</a><br>
	<font size="1">-=-=-=-=-=-=-=-=-=-=-=-=-=-</font>
	<br><?php echo strtoupper($loc) ?> Edition <a href="choose_edition.php">(Change)</a></center>
	</p>
	</small>


<?php endif; ?>


  <?php if($twok):?>
    <table border="0" cellpadding="0" cellspacing="0" width="1000">
    <tbody>
    <tr>

    <td width="121" valign="top">
        <div class="article-lhs">
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
<?php
	if($section) {
		$section_title = explode(" - ", $feed->get_title());
		echo "<h2 id='section-title'>" . $section_title[0]  . " News</h2>";
	}
	else
	{
		echo "<h2 id='section-title'>Headlines</h2>";
	}
	?>
    <?php endif; ?>
	<?php
	/*
	Here, we'll loop through all of the items in the feed, and $item represents the current item in the loop.
	*/
	foreach ($feed->get_items() as $item):
	?>
			<?php if($twok){echo'<div class="frontpage-article">';} ?>
			<h3><font size="5"><a href="<?php echo 'article.php?loc=' . $loc . '&twok=' . $twokstring . '&a=' . $item->get_permalink(); ?>"><?php echo clean_str($item->get_title()); ?></a></font></h3>
			<p><font size="4"><?php 
            $subheadlines = clean_str($item->get_description());
            $remove_google_link = explode("<li><strong>", $subheadlines);
            $no_blank = str_replace('target="_blank"', "", $remove_google_link[0]) . "</li></ol></font></p>"; 
            $cleaned_links = str_replace('<a href="', '<a href="article.php?loc=' . $loc . '&twok=' . $twokstring . '&a=', $no_blank);
			$cleaned_links = strip_tags($cleaned_links, '<a><ol><ul><li><br><p><small><font><b><strong><i><em><blockquote><h1><h2><h3><h4><h5><h6>');
    		$cleaned_links = str_replace( 'strong>', 'b>', $cleaned_links); //change <strong> to <b>
    		$cleaned_links = str_replace( 'em>', 'i>', $cleaned_links); //change <em> to <i>
			$cleaned_links = str_replace( "View Full Coverage on Google News", "", $cleaned_links);
            echo $cleaned_links;
            ?></p>
			<p><small>Posted on <?php echo $item->get_date('j F Y | g:i a'); ?></small></p>
			<?php if($twok){echo'</div>';} ?>
 
	<?php endforeach; ?>
	<p><center><small>v1.0 Powered by Mozilla Readability (Andres Rey PHP Port) and SimplePie</small><center></p>
	  <?php if($twok):?>

     <td>
     </tr>
     </tbody>
    </table>

    <?php endif; ?>
</body>
</html>

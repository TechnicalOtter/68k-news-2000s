<?php

$loc = "US";
$twok = false;

if( isset( $_GET['loc'] ) ) {
    $loc = $_GET["loc"];
}

// NOTE: The 2000's mode css shouldn't be enabled on this page!
// Vintage computers can use it! "Modern" (by their standards) CSS can and PROBABLY WILL make the page useless.
// By disabling it, we give a somewhat easy "get out of jail free" option.

// 2000's mode enable?
if( isset ($_GET['twok'] ) ) {
    $twok = filter_var( $_GET['twok'] , FILTER_VALIDATE_BOOLEAN );
} else {
    $twok = false;
}
$twok = $twok ? 'true':'false'; // Convert the bool to a string for URL's to save on conversion later.

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 2.0//EN">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<html>
<head>
	<title>68k.news: Choose Your Edition</title>
</head>
<body>
    <center><h1><b>68k.news:</b> <font color="#9400d3"><i>Headlines from the Future</i></font></h1></center>
    <hr>
    <center>
    <small>Basic HTML Google News for vintage computers. Built by <a href="https://youtube.com/ActionRetro" target="_blank"><b>Action Retro</b></a> on YouTube. Tested on Netscape 1.1 through 4 on a Mac SE/30.</small>
    <p><h2>CHOOSE YOUR EDITION:</h2></p>
    <p><a href='/index.php?section=nation&loc=US&twok=<?php echo $twok; ?>'>United States</a></p>
    <p><a href='/index.php?section=nation&loc=JP&twok=<?php echo $twok; ?>'>Japan</a></p>
    <p><a href='/index.php?section=nation&loc=UK&twok=<?php echo $twok; ?>'>United Kingdom</a></p>
    <p>Spain (RIP)</p>
    <p><a href='/index.php?section=nation&loc=CA&twok=<?php echo $twok; ?>'>Canada</a></p>
    <p><a href='/index.php?section=nation&loc=DE&twok=<?php echo $twok; ?>'>Deutschland</a></p>
    <p><a href='/index.php?section=nation&loc=IT&twok=<?php echo $twok; ?>'>Italia</a></p>
    <p><a href='/index.php?section=nation&loc=FR&twok=<?php echo $twok; ?>'>France</a></p>
    <p><a href='/index.php?section=nation&loc=AU&twok=<?php echo $twok; ?>'>Australia</a></p>
    <p><a href='/index.php?section=nation&loc=TW&twok=<?php echo $twok; ?>'>Taiwan</a></p>
    <p><a href='/index.php?section=nation&loc=NL&twok=<?php echo $twok; ?>'>Nederland</a></p>
    <p><a href='/index.php?section=nation&loc=BR&twok=<?php echo $twok; ?>'>Brasil</a></p>
    <p><a href='/index.php?section=nation&loc=TR&twok=<?php echo $twok; ?>'>Turkey</a></p>
    <p><a href='/index.php?section=nation&loc=BE&twok=<?php echo $twok; ?>'>Belgium</a></p>
    <p><a href='/index.php?section=nation&loc=GR&twok=<?php echo $twok; ?>'>Greece</a></p>
    <p><a href='/index.php?section=nation&loc=IN&twok=<?php echo $twok; ?>'>India</a></p>
    <p><a href='/index.php?section=nation&loc=MX&twok=<?php echo $twok; ?>'>Mexico</a></p>
    <p><a href='/index.php?section=nation&loc=DK&twok=<?php echo $twok; ?>'>Denmark</a></p>
    <p><a href='/index.php?section=nation&loc=AR&twok=<?php echo $twok; ?>'>Argentina</a></p>
    <p><a href='/index.php?section=nation&loc=CH&twok=<?php echo $twok; ?>'>Switzerland</a></p>
    <p><a href='/index.php?section=nation&loc=CL&twok=<?php echo $twok; ?>'>Chile</a></p>
    <p><a href='/index.php?section=nation&loc=AT&twok=<?php echo $twok; ?>'>Austria</a></p>
    <p><a href='/index.php?section=nation&loc=KR&twok=<?php echo $twok; ?>'>Korea</a></p>
    <p><a href='/index.php?section=nation&loc=IE&twok=<?php echo $twok; ?>'>Ireland</a></p>
    <p><a href='/index.php?section=nation&loc=CO&twok=<?php echo $twok; ?>'>Colombia</a></p>
    <p><a href='/index.php?section=nation&loc=PL&twok=<?php echo $twok; ?>'>Poland</a></p>
    <p><a href='/index.php?section=nation&loc=PT&twok=<?php echo $twok; ?>'>Portugal</a></p>
    <p><a href='/index.php?section=nation&loc=PK&twok=<?php echo $twok; ?>'>Pakistan</a></p>
    <hr>
    <p><h2>CHOOSE YOUR INTERFACE</h2></p>
    <p>2000's interface is <?php if($twok){echo "enabled";}else{echo"disabled";} ?>.</p>
    <p><a href='/index.php?twok=true'>Enable the 2000's interface</a><p>
    <p><a href='/index.php?twok=false'>Disable the 2000's interface</a><p>
    </center>
    <small><a href="/index.php?loc=<?php echo $loc ?>&twok=<?php echo $twok;?>">< Back to <font color="#9400d3">68k.news</font> <?php echo $loc ?>front page</a></small>
	<p><center><small>Powered by Mozilla Readability (Andres Rey PHP Port) and SimplePie</small></p>
</body>
</html>

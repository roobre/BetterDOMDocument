<?php

// Include our class.
require_once('BetterDOMDocument.class.php');

// Create document.
$dom = new BetterDOMDocument();

// Load Google's main page, ommiting errors.
@$dom->loadHTMLFile('http://www.google.com', LIBXML_NOWARNING | LIBXML_NOERROR);


/*
 * Example #1
 */

// Find links (a) whose 'class' is exactly 'gbmt'.
$links = $dom->getElementsByTagAttribute('a', 'class', 'gbmt');

// Print those links with its class.
echo "Links with class=\"gbmt\"\n";
echo "#######################\n";

foreach ($links as $link) {
   echo  $link->getAttribute('class') .': '. $link->getAttribute('href') . "\n";
}

echo "\n";


/*
 * Example #2
 */

// Find links to HTTPs servers (links whick start with 'https').
$links = $dom->getElementsByTagAttribute('a', 'href', '/^https/');

// Print those links with its class.
echo "HTTPs links\n";
echo "###########\n";
foreach ($links as $link) {
   echo  $link->getAttribute('class') .': '. $link->getAttribute('href') . "\n";
}

echo "\n";


/*
 * Example #3
 */

// Find the second link with class="gbzt".
$link = $dom->getElementsByTagAttribute('a', 'class', 'gbzt', 1);

// Print links.
echo "Sencond link with class=\"gbzt\"\n";
echo "##############################\n";
echo  $link->getAttribute('class') .': '. $link->getAttribute('href') . "\n";

echo $dom->getInnerText($link);

echo "\n";

?>

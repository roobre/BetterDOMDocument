# BetterDOMDocument

BetterDOMDocument is a simple class which extends PHP's native class DOMDocument, and provides extra functions:

* Filter elements not only by tag, but also by attribute and its value.

* Returning HTML contained in the node.

## Examples

### Create new object and load HTML file

    <?php

    // Create document.
    $dom = new BetterDOMDocument();

    // Load Google's main page, ommiting errors.
    @$dom->loadHTMLFile('http://www.google.com', LIBXML_NOWARNING | LIBXML_NOERROR);


### Find links (a) whose 'class' is exactly 'gbmt'.

    $links = $dom->getElementsByTagAttribute('a', 'class', 'gbmt');

    // Print those links with its class.
    echo "Links with class=\"gbmt\"\n";
    echo "#######################\n";

    foreach ($links as $link) {
       echo  $link->getAttribute('class') .': '. $link->getAttribute('href') . "\n";
    }

    echo "\n";


### Find the first link to an HTTPs server (links which start with 'https').

    // The fourth parameter specifies the index of the element to return.
    // If zero is supplied, this method returns the first matching DOMNode instead of a collection.
    $link = $dom->getElementsByTagAttribute('a', 'href', '/^https/', 0);

    // Print this link with its class.
    echo "HTTPs link\n";
    echo "##########\n";
    echo  $link->getAttribute('class') .': '. $link->getAttribute('href') . "\n";

    echo "\n";


### Find the second link with class="gbzt".

    $link = $dom->getElementsByTagAttribute('a', 'class', 'gbzt', 1);

    // Print link.
    echo "Sencond link with class=\"gbzt\"\n";
    echo "##############################\n";
    echo  $link->getAttribute('class') .': '. $link->getAttribute('href') . "\n";

    echo $dom->getInnerText($link);

    echo "\n";

    ?>

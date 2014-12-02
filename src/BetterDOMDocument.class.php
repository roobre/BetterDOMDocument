<?php

/**
 * 
 * This class extends DOMDocuments and adds some better functions to the native DOMDocument API.
 * 
 * Lack of documentation does not allow me to return {@link DOMNodeList}, so methods returning collections
 * of {@link DOMNode}s will return them in an array instead.
 * 
 * @author roobre (roobre@roobre.es)
 * 
 */

class BetterDOMDocument extends DOMDocument {

    /**
     * Returns {@link DOMNode}s whose tag name matches the given value.
     * 
     * @param string $name   Tag name to look at.
     * @param string $value  Tag value to filter. It accept regexes if surrounded by slashes ('/'), else it will perform
     * an strict comparison.
     * @param int    $count  Number of elements to return. If it is exactly 1, it will return a single {@link DOMNode},
     * else an array of {@link DOMNode}s will be returned instead.
     * @return mixed NULL if no elements were found. A single {@link DOMNode}, else an array of {@link DOMNode}s will be
     * returned instead.
     */
    public function getElementsByTagAttribute($name, $attribute, $value, $offset = -1, $searchMax = PHP_INT_MAX) {
        $elements = parent::getElementsByTagName($name);
        $returnedElements = array();
        $until = ($offset == -1 ? PHP_INT_MAX : $offset + 1);
        $found = 0;

        for ($i = 0; $i < $elements->length && $i < $searchMax && $found < $until; ++$i) {
            if (static::betterDOMMatch($elements->item($i)->getAttribute($attribute), $value)) {
                $returnedElements[] = $elements->item($i);
                ++$found;
            }
        }

        if (count($returnedElements) != 0) {
            if ($offset == -1) {
                return $returnedElements;
            } else {
                return $returnedElements[$offset];
            }
        } else {
            return null;
        }
    }

    /**
     * Returns the specified node as HTML String
     * 
     * @param DOMNode $node Node to output.
     * 
     * @return string HTML string.
     */
    public function getHTML(DOMNode $node) {
        return parent::saveHtml($node);
    }

    /**
     * Returns the inner HTML of the specified node
     * 
     * @param DOMNode $node Node to output.
     * 
     * @return string HTML string.
     */
    public function getInnerHTML(DOMNode $node = null) {
        $innerHTML = '';
        foreach ($node->childNodes as $childNode) {
            $innerHTML .= $this->getHTML($childNode);
        }

        return $innerHTML;
    }


    private static function betterDOMMatch($haystack, $combinedNeedle) {
        if (substr($combinedNeedle, 0, 1) == '/') {
            return preg_match($combinedNeedle, $haystack);
        } else {
            return $haystack == $combinedNeedle;
        }
    }
}

?>

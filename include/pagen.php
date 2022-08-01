<?
function __isPathTraversalUri($uri)
{
    if (($pos = strpos($uri, '?')) !== false) {
        $uri = substr($uri, 0, $pos);
    }
    $uri = trim($uri);
    return preg_match("#(?:/|2f|^|\\\\|5c)(?:(?:%0*(25)*2e)|\\.){2,}(?:/|%0*(25)*2f|\\\\|%0*(25)*5c|$)#i", $uri) ? true : false;
}

$newUri = preg_replace('#page-([\d]+)/#is', '?PAGEN_1=$1', $_SERVER['REQUEST_URI']);
if (!__isPathTraversalUri($newUri)) {
    $_SERVER['REQUEST_URI'] = $newUri;
}
?>
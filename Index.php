<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $url = $_POST['url'];
    $html = file_get_contents($url);
    $searchData =[];
    $searchData = $_POST['links'];
 
    if ($searchData[0]!=="") {
        foreach($searchData as $search) {
            $iframePattern = '/<iframe\b[^>]*\bsrc=[\'"](.*?' . preg_quote($search, '/') . '.*?)[\'"][^>]*>/is';
            $html = preg_replace($iframePattern, '<iframe src="---"></iframe>', $html);

            $scriptPattern = '/<script\b[^>]*\bsrc=[\'"](.*?' . preg_quote($search, '/') . '.*?)[\'"][^>]*>/is';
            $html = preg_replace($scriptPattern, '<script src="---"></script>', $html);
            
            $insideScript = '/(<script\b[^>]*>)(.*?(' . preg_quote($search, '/') . ').*?)(<\/script>)/is'; 
            $html = preg_replace($insideScript, '<script ></script>', $html);
        }
    }
    echo $html;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Block Script and Frames</title>
</head>
<body>
    <form method="POST">
        Website URL:
        <input type="text" name="url">

        <p><input type="checkbox" name="links[]" value="https://pagead2.googlesyndication.com/pagead/">Google ads</p>
        <p><input type="checkbox" name="links[]" value="https://www.google-analytics.com/analytics.js">Google Analytics</p>
        <p><input type="checkbox" name="links[]" value="https://connect.soundcloud.com/">Sound Cloud</p>
        <p><input type="checkbox" name="links[]" value="https://www.youtube.com/embed/MswordkJksdNm7lc1UVf-VE">YouTube Embed</p>

        <p>Custom Script/Iframe Pattern:
        <input type="text" name="links[]"></p>
        <button>Submit</button>
    </form>
</body>
</html>

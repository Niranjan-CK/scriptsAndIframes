<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $url = $_POST['url'];

    $html = file_get_contents($url);

    $searchData = $_POST['links'];
    if (!empty($searchData)) {
        foreach($searchData as $search)
        {
            $insideScript = '/(<script\b[^>]*>)(.*?(' . preg_quote($search, '/') . ').*?)(<\/script>)/is'; 
            if(empty($insideScript))
            {
                $html = preg_replace($insideScript,  '', $html); 
            }
            else
            {
                $iframePattern = '/(<iframe[^>]*src=[\'"])(.*?)(' . preg_quote($search, '/') . ')(.*?[\'"])/is'; 
                if(empty($iframePattern))
                {
                    $outsideScript = '/(<script[^>]*src=[\'"])(.*?)(' . preg_quote($search, '/') . ')(.*?[\'"])/is'; 
                    $html = preg_replace($outsideScript,  '', $html); 
                }
                else{

                    $html = preg_replace($iframePattern, '', $html); // Perform the replacement


                }
            }

            
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
        <input type="text"  name="url">

        <p><input type="checkbox"  name="links[]" value="https://pagead2.googlesyndication.com/pagead/">Google ads</p>
        <p><input type="checkbox"  name="links[]" value="https://www.google-analytics.com/analytics.js">Google Analytics</p>
        <p><input type="checkbox"  name="links[]" value="https://connect.soundcloud.com/">Sound Cloud</p>
        <p><input type="checkbox"  name="links[]" value="https://www.youtube.com/watch?v=RgD8sDUKn-g">YouTube Embed</p>

        <p >Custom Script/Iframe Pattern:
        <input type="text" name="links[]"></p>
        <button>Submit</button>
    </form>
</body>
</html>

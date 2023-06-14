<!DOCTYPE html>
<html>
    <head>
        <title>
            Scripts and Iframes
        </title>
    </head>

    <?php
    
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        $checkedItems = $_POST['handleScripts'];
        $url = $_POST['url'];
        if(!empty($url))
        {
            $host = parse_url($url);
            if($host['host']!='')
            {
            ?>
            <iframe width="720" height="405"
                    src="<?= $url ?>" frameborder="2"></iframe>
            <?php
            }
            else
            {
                if(str_contains($url,'<script>'))
                {
                    echo $url;
                }
                else
                {
                    echo "nothing to show";
                }
            }


            

        }

        if(!empty($checkedItems))
        {
            foreach($checkedItems as $item)
            {
                switch($item)
                {
                    case "ads" : echo "ads";?>
                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                                        <ins class="adsbygoogle" style="display:inline-block;width:728px;height:90px"
                                            data-ad-client="ca-pub-1234567890123456" data-ad-slot="1234567890"></ins>
                                        <script>
                                            (adsbygoogle = window.adsbygoogle || []).push({});
                                        </script>
                                        <?php
                                    break ;
                    case "analytics" :echo "analytics";?>
                                        <script>
                                            
                                            (function (i, s, o, g, r, a, m) {
                                                i['GoogleAnalyticsObject'] = r;
                                                i[r] = i[r] || function () {
                                                    (i[r].q = i[r].q || []).push(arguments)
                                                }, i[r].l = 1 * new Date();
                                                a = s.createElement(o),
                                                    m = s.getElementsByTagName(o)[0];
                                                a.async = 1;
                                                a.src = g;
                                                m.parentNode.insertBefore(a, m)
                                            })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
                                            ga('create', 'UA-XXXXX-Y', 'auto');
                                            ga('send', 'pageview');
                                        </script>
                                    <?php 
                                        break;
                    case "sound" : echo "sound" ;?>
                                    <script src="https://connect.soundcloud.com/sdk/sdk-3.3.2.js"></script>
                                    <script>
                                        SC.initialize({
                                            client_id: 'YOUR_CLIENT_ID',
                                            redirect_uri: 'https://example.com/callback'
                                        });
                                        SC.connect().then(function () {
                                            return SC.get('/me');
                                        }).then(function (me) {
                                            alert('Hello, ' + me.username);
                                        });
                                    </script>
                                    <?php
                                    break;
                    case "youtube" : echo "youtube"; ?>
                                    <iframe id="ytplayer" type="text/html" width="720" height="405"
                                    src="https://www.youtube.com/embed/MswordkJksdNm7lc1UVf-VE" frameborder="0" allowfullscreen>
                                    <?php
                                    break ;
                }
            }
        }
        
    }

    ?>




    <body>
    <form  method="post">
        <p>Google Ads: <input type="checkbox" name="handleScripts[]" value="ads"></p>
        <p>Google Analytics: <input type="checkbox" name="handleScripts[]" value="analytics"></p>
        <p>Sound Cloud: <input type="checkbox" name="handleScripts[]" value="sound"></p>
        <p>YouTube Embed: <input type="checkbox" name="handleScripts[]" value="youtube"></p>
        <p>Custom URL : <input type="text" name="url">
        <button>Submit</button>


    </form>
    </body>
</html>
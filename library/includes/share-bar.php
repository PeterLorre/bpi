<?php


//Define current URL
$url_path = $_SERVER['REQUEST_URI'];
$current_url = site_url().$url_path;
?>
<?php // Incude the file path to the social share count script ?>
<?php include_once(ABSPATH . 'wp-content/themes/bpi/library/includes/share-count.php'); ?>
<?php
  $total_share_count = total($current_url);
?>

<?php
// Formatting how Share count is viewed on screen:
$share_text = ($total_share_count == 1 ? 'Share' : 'Shares');
if($total_share_count >= 1000 && $total_share_count < 1000000) {
  $total_share_count = $total_share_count / 1000;
  $total_share_count = round($total_share_count, 1);
  $total_share_count = $total_share_count.'K';
}

?>

<ul class="social-share-bar">
  <li>
    <script src="//platform.linkedin.com/in.js" type="text/javascript">
      lang: en_US
    </script>
    <script type="IN/Share" data-counter="right" data-name="<?php echo $post_title; ?>" data-url="<?php echo $current_url; ?>"></script>
  </li>
  <li class="googleplus">
    <!-- Place this tag where you want the +1 button to render. -->
    <div class="g-plusone" data-size="medium" data-href="<?php echo $current_url; ?>"></div>
    <script type="text/javascript">
      (function() {
        var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>
  </li><!-- end google plus one button -->
  <li>
    <div id="fb-root"></div>
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="fb-like" data-layout="button_count" data-action="recommend" data-show-faces="false" data-share="false" data-width="130" data-href="<?php echo $current_url; ?>"></div>
  </li><!-- end facebook like button -->
  <li>
    <a href="mailto:?subject=<?php echo $post_title; ?>&amp;body=Check this out! <?php echo $post_title; ?> <?php echo $current_url; ?>"><i title="Email To A Friend" class="fa fa-envelope-o"></i></a>
  </li>
  <li>
    <a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo $post_title; ?>" data-related="bpi" data-via="bpi <?php echo $author_twitter; ?>" data-url="<?php echo $current_url; ?>">Tweet</a>
    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
  </li><!-- end twitter button -->
  <li class="total-shares">
    <?php echo $total_share_count.' <span class="share-text">'.$share_text.'</span>'; ?>
  </li>
</ul>

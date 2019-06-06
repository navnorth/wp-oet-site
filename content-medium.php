<?php
include_once wp_normalize_path( get_stylesheet_directory() . '/classes/oet_medium.php' );

try {
$self_access_token = get_option("mediumaccesstoken");
$oet_medium = new OET_Medium($self_access_token);
$pub_display = get_post_meta($post->ID, "mpubdisplay", true);

?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    if ($pub_display=="all"){
        $oet_medium->display_all_stories();
    } else {
        $oet_medium->display_posts();   
    }
    ?>
</div>
<?php
} catch(Exception $e) {
    ?>
    <div class="col-md-12 col-sm-12 col-xs-12 medium-error">
        <div class="panel panel-primary col-md-6 col-md-offset-3">
            <div class="panel-heading">Medium Connection Error</div>
            <div class="panel-body">Medium integration temporarily unavailable - <a href="https://medium.com/@OfficeofEdTech" target="_blank">Visit our Blog</a></div>
        </div>
    </div>
    <?php
}
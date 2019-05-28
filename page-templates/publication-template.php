<?php
/**
 * Template Name: Publication Template
 */

global $post;

$page_id = get_the_ID();
get_header();
?>
    <!--Publication Template Top Section START-->
    <div id="content" class="row custom-common-padding office-template">
        <div class="row publication-details">
            <div class="col-md-5">
                <?php
                if ( has_post_thumbnail() ) {
                    $image = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'single-post-thumbnail' );

                    echo "<div class='left-section-featured-image'>
                            <img src=".$image[0]." alt=".get_the_title($page_id)."></div>";
                }
                $download_button = get_field('show_download_button');
                $share_button = get_field('show_share_button');
                $download_link = get_field('select_file');
                ?>
                <div class="row publication-buttons">
                    <?php if ($download_button): ?>
                    <div class="col-md-7">
                        <a href="<?php echo $download_link; ?>" target="_blank" class="btn"><i class="fas fa-download"></i> <span>DOWNLOAD</span></a>
                    </div>
                    <?php endif; ?>
                    <?php if ($share_button): ?>
                    <div class="col-md-5">
                        <a href="#" class="btn"><i class="fas fa-share-alt"></i> <span>SHARE</span></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-7">
                <h1 class="page_header"><?php echo $post->post_title; ?></h1>
                <?php if (get_field('sub-title')): ?>
                <h2 class="publication_sub_title"><?php echo the_field('sub-title'); ?></h2>
                <?php endif; ?>
                <?php while (have_posts()) : the_post(); ?>
        
                    <?php get_template_part('content', 'page'); ?>
        
                <?php endwhile; ?>
            </div>
        </div>
        <div class="row publication-embed">
            
        </div>
    </div>
<?php get_footer(); ?>
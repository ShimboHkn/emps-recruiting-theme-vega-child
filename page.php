<?php
/**
 * The template for displaying pages
 */
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>

<!-- ========== Page Content ========== -->
<div class="section page-content bg-white">
<div class="container">
<div class="row">

<?php
$vega_wp_page_sidebar = vega_wp_get_option('vega_wp_page_sidebar');
if($vega_wp_page_sidebar == 'Y') { $col1_class = 'col-md-9'; $col2_class='col-md-3'; }
else { $col1_class = 'col-md-12'; $col2_class=''; }
?>

<div class="<?php echo $col1_class ?>">
<!-- Page-<?php the_ID(); ?> -->
<div id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

<?php $vega_show_content_title = vega_wp_show_content_title(); if($vega_show_content_title) { ?>
<!-- Post Title -->
<?php $title = get_the_title(); ?>
<?php if($title == '') { ?>
<h2 class="page-title"><?php echo _e('Post ID: ', 'vega'); echo get_the_ID(); ?></h2>
<?php } else { ?>
<h2 class="page-title"><?php the_title() ?></h2>
<?php } ?>
<!-- /Post Title -->
<?php } ?>

<?php
if( is_page('exchange') || is_page('bookmark') || is_page('record') ) :
	if(is_user_logged_in()) {
		if( is_page('exchange') ) {
			get_template_part('parts/content', 'exchange');
		} else
		if( is_page('bookmark') ) {
			get_template_part('parts/content', 'joblist');
		} else
		if( is_page('record') ) {
			get_template_part('parts/content', 'record');
		}
	} else {
		get_template_part('job_manager/job-dashboard-login');
	}
elseif( is_page('job-register') && !is_user_logged_in() ) :
	get_template_part('job_manager/job-dashboard-login');
elseif( is_page('whatsnew') ) :
	get_template_part('parts/content', 'joblist');
elseif( is_page('faq') ) :
	get_template_part('parts/content', 'faq');
elseif( is_page('job-search') ) :
	echo '<div class="entry-content clearfix">' . "\n";
	get_template_part('searchform');
	echo '</div><!-- end .entry-content -->' . "\n\n";
else :
?>
<div class="entry-content clearfix">
<?php the_content(); ?>
</div><!-- end .entry-content -->

<?php
endif;
?>
</div>
<!-- /Page-<?php the_ID(); ?> -->
<?php //if ( comments_open() ) comments_template(); ?>
</div>

<?php if($vega_wp_page_sidebar == 'Y') { ?>
<!-- Sidebar -->
<div class="<?php echo $col2_class ?> sidebar">
<?php get_sidebar(); ?>
</div>
<!-- /Sidebar -->
<?php } ?>

</div>
</div>
</div>
<!-- ========== /Page Content ========== -->

<?php endwhile; ?>

<?php get_footer(); ?>
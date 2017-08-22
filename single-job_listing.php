<?php
/**
* The Template for displaying post-type "job_listing"
*/
?>
<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

<?php get_template_part('parts/banner'); ?>

<!-- ========== Page Content ========== -->
<div class="section post-content bg-white">
<div class="container">
<div class="row">

<?php
$vega_wp_post_sidebar = vega_wp_get_option('vega_wp_post_sidebar');
if($vega_wp_post_sidebar == 'Y') { $col1_class = 'col-md-9'; $col2_class='col-md-3'; }
else { $col1_class = 'col-md-12'; $col2_class=''; }
?>

<div class="<?php echo $col1_class ?>">

<div id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

<?php $vega_show_content_title = vega_wp_show_content_title(); if($vega_show_content_title) { ?>
<!-- Post Title -->
<?php $title = get_the_title(); ?>
<?php if($title == '') { ?>
<h2 class="entry-title"><?php echo _e('Post ID: ', 'vega'); echo get_the_ID(); ?></h2>
<?php } else { ?>
<h2 class="entry-title"><?php the_title(); ?></h2>
<?php } ?>
<!-- /Post Title -->
<?php } ?>

<?php
$vega_wp_post_meta = vega_wp_get_option('vega_wp_post_meta');
if($vega_wp_post_meta == 'Y') {
//	$vega_wp_post_meta_author = vega_wp_get_option('vega_wp_post_meta_author');
//	$vega_wp_post_meta_category = vega_wp_get_option('vega_wp_post_meta_category');
	$vega_wp_post_meta_date = vega_wp_get_option('vega_wp_post_meta_date');
}
?>
<?php
if($vega_wp_post_meta == 'Y') {
?>
<!-- Post Meta -->
<div class="entry-meta">
<?php
	if($vega_wp_post_meta_date == 'Y') {
		$date_format = get_option('date_format');
		$temp[] = __('Posted: ', 'vega') . get_the_date($date_format);
	}
/*
	if($vega_wp_post_meta_category == 'Y') {
		$temp[] = __('Under: ', 'vega') . get_the_category_list(', ');
	}
	if($vega_wp_post_meta_author == 'Y') {
		$temp[] = __('By: ', 'vega') . get_the_author();
	}
*/
	if($temp) {
		$str = implode('<span class="sep">/</span>', $temp);
		echo $str;
	}
?>
</div>
<!-- /Post Meta -->
<?php
}

?>

<!-- Post Content -->
<div class="entry-content">
<?php the_content(); ?>
</div>
<!-- /Post Content -->

</div>


</div>

<?php if($vega_wp_post_sidebar == 'Y') { ?>
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
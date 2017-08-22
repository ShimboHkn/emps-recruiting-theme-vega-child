<?php
/**
 * The template part for displaying the front page content
 *
 * @package vega
 */
?>

<?php
$vega_wp_frontpage_content = vega_wp_get_option('vega_wp_frontpage_content');
$vega_wp_enable_demo = vega_wp_get_option('vega_wp_enable_demo');

#EXAMPLE CONTENT: If a static front page has been defined, the content from that page will be shown. Otherwise IF demo is on, the content from a random page will be displayed.
if($vega_wp_frontpage_content == 'Y' && get_option('show_on_front') == 'page') :
?>
<!-- ========== Page Content ========== -->
<?php
if( !is_user_logged_in() ) {
?>
<div class="section frontpage-content bg-white" id="catchcopy">
<div class="container">
<?php
	query_posts(array('page_id'=>557));
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
?>
<div class="wow fadeInUp description"><?php the_content(); ?></div>
<?php
		endwhile;
	endif;
	wp_reset_query();
?>
</div>
</div><!-- end #catchcopy .frontpage-content -->
<?php
}
?>
<div class="section frontpage-content bg-white" id="welcome">
<div class="container">
<?php while ( have_posts() ) : the_post(); ?>
<?php
if( is_user_logged_in() ) :
?>
<!--<h2 class="block-title wow zoomIn"><?php the_title(); ?></h2>-->
<h2 class="block-title wow zoomIn">ようこそ、<?php echo wp_get_current_user()->display_name; ?> さん</h2>
<?php
endif;
?>
<div class="wow fadeInUp description"><?php the_content(); ?></div>
<?php endwhile; ?>
</div>
</div><!-- end #welcom .frontpage-content -->
<!-- ========== /Page Content ========== -->
<?php
elseif( $vega_wp_enable_demo == 'Y') :
?>
<!-- ========== Random Page Content ========== -->
<div class="section frontpage-content bg-white" id="welcome">
<div class="container">
<?php vega_wp_example_frontpage_content(); ?>
</div>
</div>
<!-- ========== /Random Page Content ========== -->
<?php
endif;
?>
<?php
/**
* The template part for displaying the post entry in the recent posts on the front page (static)
*/
?>

<div id="faq" <?php post_class('entry clearfix ' . $post_class); ?>>

<div class="entry-content clearfix">
<?php the_content(); ?>
</div> <!-- end .entry-content -->

<div class="faqs−list clearfix">
<?php
$args = array(
	'post_type' => 'faq',
	'post_status' => 'publish',
	'post_parent' => 0,
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'menu_order',
);
$the_query = new WP_Query( $args );
if ( $the_query->have_posts() ) :
	while ( $the_query->have_posts() ) : $the_query->the_post();
		$the_ID = $post->ID;
		$the_title = get_the_title();

			query_posts( array(
			'post_type' => 'faq',
			'post_status' => 'publish',
			'post_parent' => $the_ID,
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'menu_order',
		) );
		if ( have_posts() ) :
?>
<div class="faq-cat">
<h3 class="faq-cat-title"><?php echo $the_title; ?><span class="openbtn">&#9660;</span><span class="closebtn none">&#9650;</span></h3>
<dl class="faq-item-list">
<?php
			while ( have_posts() ) : the_post();
?>
<dt><?php the_title(); ?></dt>
<dd><?php the_content(); ?></dd>
<?php
			endwhile;
?>
</dl>
</div>
<?php
		endif;
		wp_reset_query();

	endwhile;
endif;
wp_reset_postdata();
?>
</div> <!-- end .faq-list -->

</div> <!-- end #faq -->

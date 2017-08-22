<li <?php job_listing_class(); ?>>
<a href="<?php the_job_permalink(); ?>">
<div class="position">
<h3><?php wpjm_the_job_title(); ?></h3>
</div>
<ul class="meta">
<?php
global $post;
$post_id = $post->ID;
$school_id = $post->post_author;
// 勤務地を取得
$areas = get_the_terms($post_id, 'job_listing_area');
$area_array = array();
foreach ( $areas as $area ) {
	$area_array[] = $area->name;
}
?>
<li class="location"><?php echo join('・', $area_array); ?></li>
<?php
if ( get_option( 'job_manager_enable_types' ) ) {
	$types = wpjm_get_the_job_types();
	if ( ! empty( $types ) ) :
		foreach ( $types as $type ) :
?>
<li class="job-type <?php echo esc_attr( sanitize_title( $type->slug ) ); ?>"><?php echo esc_html( $type->name ); ?></li>
<?php
		endforeach;
	endif;
}
?>
<li class="company"><?php echo get_user_meta($school_id, 'last_name', true); ?></li>
</ul>
</a>
</li>

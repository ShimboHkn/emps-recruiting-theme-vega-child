<?php wp_enqueue_script( 'wp-job-manager-ajax-filters' ); ?>
<?php do_action( 'job_manager_job_filters_before', $atts ); ?>

<form class="job_filters">
<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

<div class="search_jobs">
<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>

<div class="search_keywords">
<label for="search_keywords"><?php _e( 'Keywords', 'wp-job-manager' ); ?></label>
<input type="text" name="search_keywords" id="search_keywords" placeholder="<?php esc_attr_e( 'Keywords', 'wp-job-manager' ); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
</div>

<div class="search_location">
<label for="search_location"><?php _e( 'Location', 'wp-job-manager' ); ?></label>
<input type="text" name="search_locations" id="search_location" placeholder="<?php esc_attr_e( 'Location', 'wp-job-manager' ); ?>" value="<?php echo esc_attr( $location ); ?>" />
</div>

<?php
if ( $categories ) :
	foreach ( $categories as $category ) :
?>
<input type="hidden" name="search_categories[]" value="<?php echo sanitize_title( $category ); ?>" />
<?php
	endforeach;
elseif ( $show_categories && ! is_tax( 'job_listing_category' ) && get_terms( 'job_listing_category' ) ) :
?>
<div class="search_categories">
<label for="search_categories"><?php _e( 'Category', 'wp-job-manager' ); ?></label>
<?php
	if ( $show_category_multiselect ) :
		job_manager_dropdown_categories(
			array(
				'taxonomy' => 'job_listing_category',
				'hierarchical' => 1,
				'name' => 'search_categories',
				'orderby' => 'name',
				'selected' => $selected_category,
				'placeholder' => '教科を選択',
				'hide_empty' => false,
			)
		);
	else :
		job_manager_dropdown_categories(
			array(
				'taxonomy' => 'job_listing_category',
				'hierarchical' => 1,
				'show_option_all' => __( 'Any category', 'wp-job-manager' ),
				'name' => 'search_categories',
				'orderby' => 'name',
				'selected' => $selected_category,
				'placeholder' => '教科を選択',
				'multiple' => false
			)
		);
	endif;
?>
</div>
<?php
endif;
?>

<?php
$taxname = 'job_listing_type';
$classname = 'jobtypes';
$jname = '雇用形態';
$terms = get_taxonomies( array('name' => $taxname) );
if ( ! is_tax( $taxname ) && get_terms( $taxname ) ) :
?>
<div class="search_categories">
<label for="search_<?php echo $classname; ?>"><?php echo $jname; ?></label>
<?php
if ( $show_category_multiselect ) :
	job_manager_dropdown_categories(
		array(
			'taxonomy' => $taxname,
			'hierarchical' => 1,
			'name' => 'search_' . $classname,
//			'orderby' => 'name',
			'selected' => $selected_category,
			'placeholder' => $jname . 'を選択',
			'hide_empty' => false,
		)
	);
else :
	job_manager_dropdown_categories(
		array(
			'taxonomy' => $taxname,
			'hierarchical' => 1,
			'show_option_all' => __( 'Any category', 'wp-job-manager' ),
			'name' => 'search_' . $classname,
//			'orderby' => 'name',
			'selected' => $selected_category,
			'placeholder' => $jname .'を選択',
			'multiple' => false,
			'hide_empty' => false,
		)
	);
endif;
?>
</div>
<?php
endif;
?>
<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>

</div>
<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
</form>
<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

<noscript><?php _e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'wp-job-manager' ); ?></noscript>
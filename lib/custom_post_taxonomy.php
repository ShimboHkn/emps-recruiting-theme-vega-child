<?php
/*
カスタム投稿タイプ・カスタムタクソノミー
*/

// 指導教科カスタムタクソノミー追加
function jobcategory_init() {
	register_taxonomy(
		'job_listing_category',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '指導教科' ),
			'rewrite' => array( 'slug' => 'jobcategory' ),
		)
	);
}
add_action( 'init', 'jobcategory_init' );

// 雇用形態カスタムタクソノミーの表示名変更
function jobtype_init() {
	register_taxonomy(
		'job_listing_type',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '雇用形態' ),
			'rewrite' => array( 'slug' => 'jobtype' ),
		)
	);
}
add_action( 'init', 'jobtype_init' );

// 勤務地カスタムタクソノミーの追加
function jobarea_init() {
	register_taxonomy(
		'job_listing_area',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( 'エリア' ),
			'rewrite' => array( 'slug' => 'jobarea' ),
		)
	);
}
add_action( 'init', 'jobarea_init' );

// 指導形態カスタムタクソノミーの追加
function jobclass_init() {
	register_taxonomy(
		'job_listing_class',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '指導形態' ),
			'rewrite' => array( 'slug' => 'jobclass' ),
		)
	);
}
add_action( 'init', 'jobclass_init' );

// 指導対象カスタムタクソノミーの追加
function jobtarget_init() {
	register_taxonomy(
		'job_listing_target',
		'job_listing',
		array(
			'hierarchical' => true,
			'label' => __( '指導対象' ),
			'rewrite' => array( 'slug' => 'jobtarget' ),
		)
	);
}
add_action( 'init', 'jobtarget_init' );



?>
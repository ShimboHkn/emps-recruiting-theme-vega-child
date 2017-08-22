<?php get_header(); ?>

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

<div id="page-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>

<?php $vega_show_content_title = vega_wp_show_content_title(); if($vega_show_content_title) { ?>
<!-- Post Title -->
<?php $title = get_the_title(); ?>
<?php if($title == '') { ?>
<h3 class="page-title"><?php echo _e('Post ID: ', 'vega'); echo get_the_ID(); ?></h3>
<?php } else { ?>
<h3 class="page-title"><?php //the_title() ?>検索結果</h3>
<?php } ?>
<!-- /Post Title -->
<?php } ?>

<div class="page-content">
<section id="joblistings-list">
<!--<h2>検索結果</h2>-->
<div class="job-listings">

<?php
$jobcatID = $_GET['jobcat'];
$jobtypeID = $_GET['jobtype'];
$jobareaID = $_GET['jobarea'];
//$jobareaKey = $_GET['jobarea'];
$jobclassID = $_GET['jobclass'];
if( empty($_GET['apply_date']) ) {
	$jobapplyDate = '2999-12-31';
	$jobdate = '';
} else {
	$jobapplyDate = date( 'Y-m-d', strtotime($_GET['apply_date']) );
	$jobdate = date( 'Y年m月d日', strtotime($jobapplyDate) ).'まで';
}
$s = $_GET['s'];
function serach_opt_by_ID($t_text, $t_name, $t_id) {
	if ($t_id) {
		$term = get_term_by('term_id', $t_id, $t_name);
		echo '<span class="search-option-name">' . $t_text . ': [' . $term->name . ']</span>';
	}
}
function serach_opt_by_Key($t_text, $t_key) {
	if($t_key) {
		echo '<span class="search-option-name">' . $t_text . ': [' . $t_key . ']</span>';
	}
}
global $areas;
$array_pref[] = array();
foreach($areas as $area) {
	$prefs = $area[1];
	foreach($prefs as $pref) {
		$key = $pref[1];
		$val = $pref[0];
		$array_pref[$key] = $val;
	}
}
//$jobarea = $array_pref[$jobareaKey];

if($jobcatID || $jobtypeID || $jobareaID || $jobclassID || $jobdate || $s) :
?>
<div id="searchoption" class="search-option">
<p><span class="search-option-head">検索条件：</span>
<?php
	serach_opt_by_ID('指導教科', 'job_listing_category', $jobcatID);
	serach_opt_by_ID('雇用形態', 'job_listing_type', $jobtypeID);
	serach_opt_by_ID('エリア', 'job_listing_area', $jobareaID);
	serach_opt_by_ID('指導形態', 'job_listing_class', $jobclassID);
	serach_opt_by_Key('応募締切', $jobdate);
	serach_opt_by_Key('キーワード', $s);
?></p>
</div>
<?php
endif;
?>

<?php
//tax_query用
if($jobcatID){
	$jobtaxquery[] = array(
		'taxonomy'=>'job_listing_category',
		'terms'=> $jobcatID,
	);
}
if($jobtypeID){
	$jobtaxquery[] = array(
		'taxonomy'=>'job_listing_type',
		'terms'=> $jobtypeID,
	);
}
if($jobareaID){
	$jobtaxquery[] = array(
		'taxonomy'=>'job_listing_area',
		'terms'=> $jobareaID,
	);
}
if($jobclassID){
	$jobtaxquery[] = array(
		'taxonomy'=>'job_listing_class',
		'terms'=> $jobclassID,
	);
}
$jobtaxquery['relation'] = 'AND';
$jobtaxquery['include_children'] = false;
$jobtaxquery['field'] = 'term_id';
$jobtaxquery['operator'] = 'AND';
/*
if($jobarea){
	$jobmetaquery[] = array(
		'key'=>'_job_location',
		'value'=> $jobarea,
	);
}
*/
/*
$jobmetaquery[] = array(
	'key'=>'_job_expires',
	'value'=>$jobapplyDate,
	'compare'=>'<=',
	'type'=>'DATE',
);
*/
$jobmetaquery[] = array(
	'key'=>'_filled',
	'value'=>0,
);
$jobmetaquery['relation'] = 'AND';

$args = array(
	'post_type' => 'job_listing',
	'tax_query' => $jobtaxquery,
	'meta_query' => $jobmetaquery,
	's' => $s,
	'post_status' => 'publish',
	'order' => 'DESC',
	'orderby' => 'date',
	'paged' => get_query_var( 'paged' ),
);
query_posts( $args );
if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		$post_id = $post->ID;
?>
<div class="joblisting-content">
<article class="job-detail clearfix<?php if(get_post_meta($post_id, '_featured', true)) echo ' featured'; ?>">
<div class="job-head">
<h3 class="job-title"><?php the_title(); ?></h3>
</div>
<div class="job-body">
<a href="<?php the_permalink(); ?>" class="job-link clearfix">
<nav class="btn job-link-btn">詳細を表示</nav>
<h5 class="school-name"><?php the_author(); ?></h5>
<div class="job-content"><?php the_content(); ?></div>
</a>
<?php job_main_spec_table($post_id); ?>
</div><!-- /.job-body -->
</article>
</div>
<?php
	endwhile;
} else {
?>

<br>
<p>検索条件に該当する求人はありませんでした。<br>
<form><input type="button" value="戻る" onclick="history.back();"></form></p>
<?php
}
?>
<div class="pagenav">
<?php
// リンクが無い場合はNULLが返ってくる
$prev_link = get_previous_posts_link('＜ 前の10件');
$next_link = get_next_posts_link('次の10件 ＞');

if ( isset( $prev_link ) or isset( $next_link ) ) {
	echo '<ul id="pagination" class="clearfix">', PHP_EOL;
	if( isset( $prev_link ) ) {
		echo '<li class="page-prev">',$prev_link,'</li>', PHP_EOL;
	}
	if( isset( $next_link ) ) {
		echo '<li class="page-next">',$next_link,'</li>', PHP_EOL;
	}
	echo '</ul>', PHP_EOL;
}
if ( function_exists( 'splcpn_echopager' ) ) {
	splcpn_echopager( 1 );
}
?>
</div><!-- end .pagenav -->
<?php
wp_reset_query();
?>

</div><!-- /.job-listings -->
</section>
</div><!-- /.page-content -->

</div>
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

<?php get_footer(); ?>
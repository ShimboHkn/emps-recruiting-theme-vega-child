<?php
/**
 * The template for displaying "Message" page content.
 */
if ( is_page('bookmark') ) {
	$myID = get_current_user_id(); // 自分のIDを取得
	if ( $myID && get_user_meta($myID, 'job_bookmarks', true) ) {
		$jobBms = get_user_meta($myID, 'job_bookmarks', true);
	} else {
		$jobBms = array(NULL);
	}
	$p_in = $jobBms;
	$ppp = -1;
} elseif ( is_front_page() ) {
	$p_in = array();
	$ppp = 10;
} else {
	$p_in = array();
	$ppp = 20;
}
$args = array(
	'post_type' => 'job_listing',
	'post_status' => 'publish',
	'post__in' => $p_in,
	'order' => 'DESC',
	'orderby' => 'date',
	'posts_per_page' => $ppp,
);
// ページを判別して$slugに代入
if ( is_page('bookmark') ) {
	$slug = 'bookmark';
} elseif ( is_page('whatsnew') ) {
	$slug = 'whatsnew';
}
query_posts( $args );
if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		$post_id = $post->ID;
?>
<div class="joblisting-content">
<article class="job-detail clearfix<?php if (get_post_meta($post_id, '_featured', true)) echo ' featured'; ?>">
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
</div><!-- end .job-body -->
</article>
</div>
<?php
	endwhile;
else :
?>

<br>
<p><?php
	if ( $slug == 'bookmark' ) {
		echo '求人ブックマークに登録されている求人はありません。';
	} elseif ( $slug == 'whatsnew' ) {
		echo '現在、表示できる新着求人はありません。';
	} else {
		echo '現在、表示できる求人はありません。';
	}
?></p>

<?php
endif;
wp_reset_query();
?>

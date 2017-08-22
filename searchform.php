<?php
$keyword = '';
if(isset($_GET['s'])){ $keyword = esc_attr( $_GET['s'] ); }else{ $keywords = ''; }
?>
<div id="search" class="large-12 columns callout">
<div class="row">

<form method="get" id="searchform" action="<?php bloginfo('url'); ?>">
<?php
function job_selectform($tax_name) {
	$taxonomys = get_terms($tax_name, array(
		'orderby' => 'term_order',
		'order' => 'ASC',
		'hide_empty' => false,
	));
	if(!is_wp_error($taxonomys) && count($taxonomys)):
		foreach($taxonomys as $taxonomy):
			$tax_posts = get_posts(array('post_type' => 'job_listing', 'taxonomy' => $taxonomy_name, 'term' => $taxonomy->term_id ) );
			if($tax_posts):
?>
<option value="<?php echo $taxonomy->term_id; ?>"><?php echo $taxonomy->name; ?></option>
<?php
			endif;
		endforeach;
	endif;
}
?>

<fieldset id="job_listing_category" class="jobsearch jobcat">
<label class="">指導教科: </label>
<select name="jobcat">
<option value="" selected>全教科</option>
<?php job_selectform('job_listing_category'); ?>
</select>
</fieldset>

<fieldset id="job_listing_type" class="jobsearch jobtype">
<label class="">雇用形態: </label>
<select name="jobtype">
<option value="" selected>こだわらない</option>
<?php job_selectform('job_listing_type'); ?>
</select>
</fieldset>

<fieldset id="job_listing_area" class="jobsearch jobarea">
<label class="">エリア: </label>
<select name="jobarea">
<option value="" selected>どこでも</option>
<?php job_selectform('job_listing_area'); ?>
</select>
</fieldset>

<fieldset id="job_listing_class" class="jobsearch jobclass">
<label class="">指導形態: </label>
<select name="jobclass">
<option value="" selected>こだわらない</option>
<?php job_selectform('job_listing_class'); ?>
</select>
</fieldset>

<!--<fieldset id="job_listing_class" class="jobsearch jobapply">
<label class=""><span class="nowrap">応募締切: <input type="text" name="apply_date" id="apply_date" placeholder="" style="width: 10em;" /> まで</span></label>
</fieldset>-->

<fieldset class="s">
<label for="s" class="assistive-text">キーワード: </label>
<input type="text" name="s" id="s" placeholder="" />
</fieldset>

<input type="submit" value="検索する" />
<p>＊全部の募集案件を見るには、条件をすべてキャンセルして検索します。
<input type="reset" value="条件をすべてキャンセル" /></p>
</form>

</div>
</div><!-- /#search -->

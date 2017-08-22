<?php
/**
* The template part for displaying the post entry in the recent posts on the front page (static)
*/
?>
<?php
$myID = get_current_user_id(); // 自分のIDを取得
global $wpdb;

// 進捗状況・メモをDBに保存
if ($_POST['submit_time']) {
	$progress_array = array('job_progress', 'job_retention', );
	if ( $_POST['job_progress'] ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_progress'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-progress' ),
			array( '%s' )
		);
	}
	if ( $_POST['job_employment'] ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_employment'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-employment' ),
			array( '%s' )
		);
	}
	if ( $_POST['job_retention'] ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_retention'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-retention' ),
			array( '%s' )
		);
	} else {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => 0 ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-retention' ),
			array( '%s' )
		);
	}
	if ( current_user_can('subscriber') ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_note'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-note-mem' ),
			array( '%s' )
		);
	}
	if ( current_user_can('employer') ) {
		$wpdb->update(
			$wpdb->prefix.'cf7dbplugin_submits',
			array( 'field_value' => $_POST['job_note'] ),
			array( 'submit_time' => $_POST['submit_time'], 'field_name' => 'job-note-sch' ),
			array( '%s' )
		);
	}
}

// 非表示案件をDBに保存
$my_hide_nums = array();
$my_info = get_userdata($myID);
if ( $my_info->hide_apply ) {
	$my_hide_nums = $my_info->hide_apply; // 自分のユーザーメタを取得
}
$hide_apply_num = 0;
if ( isset($_POST['hide_apply']) ) {
	$hide_apply_num = $_POST['hide_apply'];
	// 自分のユーザーメタに$hide_apply_numを追加
	if ( isset($_POST['checked']) && !in_array($hide_apply_num, $my_hide_nums) ) {
		$my_hide_nums[] = $hide_apply_num;
	}
	// 自分のユーザーメタから$hide_apply_numを削除
	if ( !isset($_POST['checked']) && in_array($hide_apply_num, $my_hide_nums) ) {
		$new_hide_nums = array_diff($my_hide_nums, array($hide_apply_num)); //削除実行
		$my_hide_nums = array_values($new_hide_nums); //indexを詰める
	}
	update_user_meta($myID, 'hide_apply', $my_hide_nums);
}

// 絞り込み変数の設定
if ( isset($_GET['apply_filter']) && $_GET['apply_filter'] != '' ) {
	$filter_status = $_GET['apply_filter'];
} else {
	$filter_status = 0;
}

// 非表示案件をすべて表示の変数を設定
$show_all = 'off';
if ( $_GET['show_all'] ) $show_all = $_GET['show_all'];
?>

<div id="job-apply-records" <?php post_class('job_records entry clearfix ' . $post_class); ?>>

<?php
// 求人タイトルで募集を絞り込む
if ( current_user_can('employer') ) {
?>
<div class="apply-filter"><form method="get" id="apply-filter-form">
<p>応募履歴フィルター<!--（非表示を除く）-->：
<select name="apply_filter" class="select" onchange="jQuery(function(){jQuery('#apply-filter-form').submit();});">
<option value="0"<?php if ( $filter_status === 0 ) echo ' selected="selected"'; ?>>フィルターなし</option>
<?php
	$rows = $wpdb->get_results( "SELECT submit_time, field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'school-id'" );
	$rows = array_reverse($rows);
	$jtitle = '';
	foreach ($rows as $row) :
		$submit_time = $row->submit_time;
		$employer_id = $row->field_value;
		if ( $employer_id == $myID) {
			$jtrow = $wpdb->get_row( "SELECT field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'recruit-title' AND submit_time = $submit_time" );
			$pidrow = $wpdb->get_row( "SELECT field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'post-id' AND submit_time = $submit_time" );
			$jt = $jtrow->field_value;
			$pid = $pidrow->field_value;
			if ( $jtitle != $jt ) {
?>
<option value="<?php echo $pid; ?>"<?php if ( $filter_status === $pid ) echo ' selected="selected"'; ?>><?php echo $jt; ?></option>
<?php
			}
			$jtitle = $jt;
		}
	endforeach;
	if ( $jtitle != '' ) {
?>
<option value="" disabled="disabled">----</option>
<option value="retention"<?php if ( $filter_status === 'retention' ) echo ' selected="selected"'; ?>>保留</option>
<?php
	}
?>
</select>
</p>
</form></div><!-- end .apply-filter -->
<?php
} // if ( current_user_can('employer') )

// 応募履歴の書き出し
if ( current_user_can('subscriber') ) {
	$myrows = array_reverse( $wpdb->get_results( "SELECT submit_time, field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'applicant-id'" ) );
} elseif ( current_user_can('employer') ) {
	$myrows = array_reverse( $wpdb->get_results( "SELECT submit_time, field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_name = 'school-id'" ) );
}
$rec_job_title = '';
foreach ($myrows as $myrow) :
	$rec_stime = $myrow->submit_time;
	$rec_stime_short = str_replace(".", "", $rec_stime);
	$rec_applicant_id = $myrow->field_value;
	if ( $rec_applicant_id == $myID) :
		$apply_array = array();
		for( $i = 0; $i < 50; $i++ ) { // 登録項目の数が50を超えた際には"$i<50"の数値も要変更
			$approw = $wpdb->get_row( "SELECT field_name, field_value FROM {$wpdb->prefix}cf7dbplugin_submits WHERE field_order = $i AND submit_time = $rec_stime" );
			$apply_array[$approw->field_name] = $approw->field_value;
		}
		$rec_job_title = $apply_array['recruit-title'];
		$rec_member_id = $apply_array['applicant-id'];
		$rec_my_email =$apply_array['applicant-email'];
		$rec_my_name =$apply_array['applicant-name'];
		$rec_apply_info = array(
			array('name', '名前', $apply_array['applicant-name'].' （'.$apply_array['applicant-name-kana'].'）'),
			array('birth', '生年月日', $apply_array['applicant-birth']),
			array('gender', '性別', $apply_array['applicant-gender']),
			array('addr_pref', '住所', $apply_array['applicant-address']),
			array('occupation', '現在状況', $apply_array['applicant-occupation']),
			array('university', '学歴', $apply_array['applicant-schl-career']),
			array('grad_school', '学歴特記', $apply_array['applicant-schl-career-other']),
			array('career', '職歴',$apply_array['applicant-career']),
			array('instruction', '指導経験',$apply_array['applicant-instruction']),
			array('certificate', '免許・資格',$apply_array['applicant-certificate']),
			array('message', '通信欄',$apply_array['message']),
		);
		$rec_school_id = $apply_array['school-id'];
		$rec_school_name = $apply_array['school-name'];
		$rec_school_email = $apply_array['school-email'];
		$rec_message = $apply_array['message'];
		$rec_progress = $apply_array['job-progress'];
		$rec_employment = $apply_array['job-employment'];
		$rec_retention = $apply_array['job-retention'];
		$rec_jobnote_mem = $apply_array['job-note-mem'];
		$rec_jobnote_sch = $apply_array['job-note-sch'];
		$rec_post_id = $apply_array['post-id'];
?>

<article class="apply-record apply-<?php
		echo $rec_post_id;

		// フィルタでの表示・非表示の振り分け
		if ( $filter_status === 'retention' ) {
			if ( $rec_retention != 'retention' ) echo ' unselected';
		} else {
			if ( $filter_status != 0 && $filter_status != $rec_post_id ) echo ' unselected';
		}

		if ( $show_all == 'on' ) echo ' show-all';
		if ( in_array($rec_stime_short, $my_hide_nums) ) echo ' hide-apply';
?> clearfix">
<div class="job-records-head">
<div class="job-records-head-date">
<h3 class="job-apply-date"><?php echo gmdate('Y年m月d日 (H:i)', strtotime('+9 hour' ,$rec_stime)); ?></h3>
<div class="hide-apply"><form method="post" id="hide-apply-<?php echo $rec_stime_short; ?>">
<input type="hidden" name="hide_apply" value="<?php echo $rec_stime_short; ?>" style="display:none;">
<label for="hbtn-<?php echo $rec_stime_short; ?>"><input type="checkbox" name="checked" value="checked" id="hbtn-<?php echo $rec_stime_short; ?>"<?php if ( in_array($rec_stime_short, $my_hide_nums) ) echo ' checked="checked"'; ?> onchange="jQuery(function(){
if (jQuery('input#hbtn-<?php echo $rec_stime_short; ?>').prop('checked')) {
	jQuery(this).prop('checked',false);
} else {
	jQuery(this).prop('checked',true);
}
jQuery('#hide-apply-<?php echo $rec_stime_short; ?>').submit();
});"> 非表示</label>
</form></div>
</div><!-- end .job-records-head-date -->
<div class="job-records-head-title">
<h3 class="job-title"><a href="<?php echo get_permalink($rec_post_id); ?>"><?php echo $rec_job_title; ?></a></h3>
<?php if ( current_user_can('subscriber') ) : ?>
<h4 class="job-school"><?php echo $rec_school_name; ?></h4>
<?php endif; ?>
</div><!-- end .job-records-head-title -->
</div><!-- end.job-records-head -->

<div class="job-records-body jobrec-accordion">
<div class="jobrec-accordion-btn">
<h5 class="btn-title">詳細を<span class="togglebtn">開く <span class="marker">▼</span></span><span class="togglebtn none">閉じる <span class="marker">▲</span></span></h5>
</div>
<div class="jobrec-accordion-content jobrec-accordion-hide">
<table class="job-apply-myinfo">
<?php
		foreach( $rec_apply_info as $value ) :
			if ( $value[2] ) {
?>
<tr class="<?php echo $value[0]; ?>"><th><?php echo $value[1]; ?></th><td><?php echo nl2br($value[2]); ?></td></tr>
<?php
			}
		endforeach;
?>
</table>

<div class="btn-emessage"><form method="post" action="<?php bloginfo('url') ?>/profile/exchange/" accept-charset="utf-8">
<?php
		if ( current_user_can('subscriber') ) {
			$compid = $rec_school_id;
			$compname = $rec_school_name;
		} else {
			$compid = $rec_member_id;
			$compname = $rec_my_name;
		}
?>
<input type="hidden" name="compid" value="<?php echo $compid; ?>" class="hidden">
<input type="submit" name="submit" value="<?php echo $compname .' さんに'. EXCHANGE_NAME; ?>を送る" class="submit btn-sub">
</form></div>

</div><!-- end .jobrec-accordion-content -->
</div><!-- end .job-records-body.jobrec-accordion -->

<div class="job-records-body jobrec-accordion">
<div class="jobrec-accordion-btn">
<h4 class="btn-title">メモを<span class="togglebtn">開く <span class="marker">▼</span></span><span class="togglebtn none">閉じる <span class="marker">▲</span></span></h4>
</div>
<div class="jobrec-accordion-content jobrec-accordion-hide">
<h5>応募メモ：<span class="small">（このメモの内容は公開されることはありません。あなただけの備忘としてお使いください。）</span></h5>
<textarea name="job_note" rows="10"><?php if ($job_note) echo str_replace ( '\\' , '', $job_note ); ?></textarea>
</div><!-- end .jobrec-accordion-content -->
</div><!-- end .job-records-body.jobrec-accordion -->

<?php
		if ( current_user_can('employer') ) {
?>
<div class="job-records-footer job-records-progress"><form method="post" class="job-progress">
<h4 class="jobrec-prog-title">進捗状況　<input type="submit" value="保存" class="submit" /></h4>
<div class="jobrec-prog-content"><div class="jobrec-prog-content-inner">
<ul class="job-progress-list">
<li><label for="jprg1-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="1" id="jprg1-<?php echo $rec_stime_short; ?>"<?php if ($rec_progress == 1) echo ' checked="checked"'; ?>> 選考中</label></li>
<li><label for="jprg2-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="2" id="jprg2-<?php echo $rec_stime_short; ?>"<?php if ($rec_progress == 2) echo ' checked="checked"'; ?>> １次選考通過</label></li>
<li><label for="jprg3-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="3" id="jprg3-<?php echo $rec_stime_short; ?>"<?php if ($rec_progress == 3) echo ' checked="checked"'; ?>> ２次選考通過</label></li>
<li><label for="jprg9-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_progress" value="9" id="jprg9-<?php echo $rec_stime_short; ?>"<?php if ($rec_progress == 9) echo ' checked="checked"'; ?>> 終了</label></li>
</ul>
<ul class="job-employment-list">
<li><label for="jempy-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_employment" value="yes" id="jempy-<?php echo $rec_stime_short; ?>"<?php if ($rec_employment == 'yes') echo ' checked="checked"'; ?>> 採用</label></li>
<li><label for="jempn-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_employment" value="no" id="jempn-<?php echo $rec_stime_short; ?>"<?php if ($rec_employment == 'no') echo ' checked="checked"'; ?>> 不採用</label></li>
<li><label for="jempp-<?php echo $rec_stime_short; ?>"><input type="radio" name="job_employment" value="pending" id="jempp-<?php echo $rec_stime_short; ?>"<?php if ($rec_employment == 'pending') echo ' checked="checked"'; ?>> 未定</label></li>
</ul>
<ul class="job-retention-list">
<li><label for="jret-<?php echo $rec_stime_short; ?>"><input type="checkbox" name="job_retention" value="retention" id="jret-<?php echo $rec_stime_short; ?>"<?php if ($rec_retention == 'retention') echo ' checked="checked"'; ?>> 保留</label></li>
</ul>
</div></div><!-- end .jobrec-prog-content -->
<input type="hidden" name="submit_time" value="<?php echo $rec_stime; ?>">
<input type="hidden" name="apply_filter" value="<?php echo $filter_status; ?>">

</form></div><!-- end .job-records-footer -->
<?php
		} // if ( current_user_can('employer') )
?>
</article>

<?php
	endif; // if ( $rec_applicant_id == $myID )
endforeach;
?>
<br />
<?php
if ($rec_job_title) {
	if ( $show_all == 'on' ) {
		$show_all_val = 'off';
		$submit_val = '非表示案件を隠す';
	} else {
		$show_all_val = 'on';
		$submit_val = '非表示案件を表示する';
	}
?>
<form method="get" id="hide-all">
<input type="hidden" name="apply_filter" value="<?php echo $filter_status; ?>" class="hidden">
<!--<input type="hidden" name="select_progress" value="<?php echo $selected_prog; ?>" class="hidden">-->
<input type="hidden" name="show_all" value="<?php echo $show_all_val; ?>" class="hidden">
<input type="submit" value="<?php echo $submit_val; ?>" class="submit" style="display:inline-block; margin:0;">
</form>
<?php
} else {
?>
<div class="job-body">
<?php if ( current_user_can('employer') ) : ?>
<p>まだ応募はありません。</p>
<?php else : ?>
<p>応募履歴はありません。<br />
求人への応募は、各求人の詳細ページから行うことができます。</p>
<p><a href="<?php bloginfo( 'url' ); ?>/whatsnew/" class="btn">新着求人</a>　<a href="<?php bloginfo( 'url' ); ?>/job-search/" class="btn">求人検索</a></p>
<?php endif; ?>
</div>
<?php
} // if ($rec_job_title)
?><p></p>

</div><!-- end #job-apply-records -->

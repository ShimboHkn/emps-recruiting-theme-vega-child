<?php
/**
* The template part for displaying the post entry in the recent posts on the front page (static)
*/
?>
<?php
$vega_wp_blog_feed_meta = vega_wp_get_option('vega_wp_blog_feed_meta');
if($vega_wp_blog_feed_meta == 'Y') {
    $vega_wp_blog_feed_meta_author = vega_wp_get_option('vega_wp_blog_feed_meta_author');
    $vega_wp_blog_feed_meta_category = vega_wp_get_option('vega_wp_blog_feed_meta_category');
    $vega_wp_blog_feed_meta_date = vega_wp_get_option('vega_wp_blog_feed_meta_date');
}
$vega_wp_blog_feed_buttons = vega_wp_get_option('vega_wp_blog_feed_buttons');
global $key;

$my_obj = wp_get_current_user();
$myID = $my_obj->get('ID');
$myLogin = $my_obj->get('user_login');

// 表示させるメッセージの相手（$compID）
$compID = '';
if( isset($_POST['compid']) ) { // $_POSTにデータがある時
	$compID = $_POST['compid'];
} elseif( isset($_GET['comp']) ) { // URLの引数にデータがある時
	$compID = $_GET['comp'];
}
// 自分のユーザーメタを取得
$myComps[0] = array();
if( get_userdata($myID)->destination_ids ) {
	$myComps = get_user_meta($myID, 'destination_ids');
}

// 自分のユーザーメタに$compIDを追加
if( !in_array($compID, $myComps[0]) && $compID != NULL ) {
	$myComps[0][] = $compID;
}
// 相手のユーザーデータを取得
$comp_obj = get_userdata($compID);
if($comp_obj) {
	$compName = $comp_obj->last_name;
	$compLogin = $comp_obj->user_login;
	$compEmail = $comp_obj->user_email;
} else {
}

// 削除する相手（$deleatID）
$deleatID = '';
if( isset($_POST['delid']) ) { // URLの引数にデータがある時
	$deleatID = $_POST['delid'];
}
// 自分のユーザーメタから$deleatIDを削除
$newComps = array_diff($myComps[0], array($deleatID)); //削除実行
$newComps = array_values($newComps); //indexを詰める
update_usermeta( $myID, 'destination_ids', $newComps );
?>

<div id="comments" <?php post_class('entry clearfix ' . $post_class); ?>>

<div class="comments-area">
<?php
if( $compID ) {
	$author_in = array($myID, $compID);
	$meta_value = array($myID, $compID);
} else {
	$author_in = array($myID);
	$meta_value = array();
}
$args = array(
	'author__in' => $author_in,
	'orderby' => 'comment_date',
	'order' => 'DESC',
	'count' => false,
//	'post_id' => get_the_ID(),
	'meta_key' => 'recipient_id',
	'meta_value' => $meta_value,
	'meta_query' => array(
//		'key' => 'recipient_id',
//		'value' => array($myID, $compID),
		'compare' => 'IN',
//		'type' => 'DECIMAL'
	),
);
$comments = get_comments( $args );
?>
<?php
if ( $compID ) {
$conmpName = get_userdata($compID)->last_name;
?>
<div class="comment-lists">
<h4 class="comment-records">メッセージ履歴 （<strong><?php if($compName) {echo $compName;} else {echo '削除された会員';} ?></strong> さん）</h4>
<div class="comment-list">
<?php
	if( $comments ) {
		$comments = array_reverse($comments);
		foreach( $comments as $comment ) :
			$comm_date = date('Y年n月j日 H:s', strtotime($comment->comment_date));
			$comm_userid = $comment->user_id;
			$comm_content = $comment->comment_content;
			$comm_id = $comment->comment_ID;
			$comm_recipientid = get_comment_meta( $comm_id, 'recipient_id', true );
?>
<div class="comment-item<?php if( $comm_userid == $myID ) echo ' comment-item-me'; ?>">
<!--<h4 class="comment-author"><span class="sender-name name<?php if( $comm_userid == $myID ) echo ' my-name'; ?>"><?php echo get_userdata($comm_userid)->last_name; ?></span><span class="arrow">&raquo;&raquo;&raquo;</span><span class="recipient-name name<?php if( $comm_recipientid == $myID ) echo ' my-name'; ?>"><?php echo get_userdata($comm_recipientid)->last_name; ?></span></h4>-->
<span class="comment-date"><?php echo $comm_date; ?>&nbsp;&nbsp;<?php if( $comm_userid == $myID ) {echo '送信';} else {echo '受信';} ?></span>
<p class="comment-content"><?php echo nl2br($comm_content); ?></p>
</div>
<?php
		endforeach;
	} else { // ( $comments )
?>
<p class="comment-item no-comments">表示する<?php echo EXCHANGE_NAME; ?>はありません。</p>
<?php
	} // ( $comments )
?>
</div> <!-- /.comment-list -->
</div> <!-- /.comment-lists -->

<div id="respond" class="comment-respond">
<form action="<?php bloginfo('url') ?>/wp-comments-post.php" method="post" id="commentform" class="comment-form" novalidate>
<div class="hidden" style="display: none;">
<input type="hidden" name="recipient_id" value="<?php echo $compID; ?>">
<input type="hidden" name="recipient_login" value="<?php echo $compLogin; ?>">
<input type="hidden" name="recipient_email" value="<?php echo $compEmail; ?>">
<input type='hidden' name="comment_post_ID" value="<?php echo EXCHANGE_ID; ?>" />
<input type='hidden' name="comment_parent" value="0" />
</div>
<label for="comment"><!--メッセージ--><?php echo EXCHANGE_NAME; ?> 送信文</label>
<textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>
<input name="submit" type="submit" class="submit" value="<?php echo EXCHANGE_NAME; ?>を送信" />
</form>
</div><!-- end #respond -->

<?php
} // ( $compID )
?>
<div class="exchange-select<?php if ( $compID ) echo ' exchange-selected'; ?>">
<p class="select-member closed"><a href="javascript:;"><?php echo EXCHANGE_NAME; ?>の相手を変更する</a></p>
<div class="change-comp-content">
<form method="post" name="change-comp" id="change-comp">
<div class="select-box">
<select name="compid" class="comp-name" id="compid" onchange="jQuery(function(){jQuery('#change-comp').submit();});">
<option value="" selected="selected"><?php echo EXCHANGE_NAME; ?>の相手を選択してください</option>
<?php
foreach($myComps[0] as $myComps_id) :
	if( $myComps_id != $myID ) :
		$name = get_user_meta($myComps_id, 'last_name', true);
?>
<option value="<?php echo $myComps_id; ?>"<?php if( $myComps_id == $compID ) echo ' selected="selected"'; ?>><?php if($name) {echo $name;} else {echo '（退会しました-'.$myComps_id.'）';} ?></option>
<?php
	endif; // ( $myComps_id != $myID )
endforeach;
?>
</select>
<input type="submit" value="<?php echo EXCHANGE_NAME; ?>を表示する" style="display: inline-block;" onclick="$('div.exchange-cont').css('display', 'block');" class="submit">
</div>
</form>
<?php
	if( empty($compID) ) {
?>
<p><?php echo EXCHANGE_NAME; ?>を送るには、<strong>送信先を上のプルダウンボックスより選択</strong>してください。<br />
<?php
		if( current_user_can('subscriber') ) {
			echo '（※プルダウンボックスに送信先がない場合は、まず求人に応募をしてください。）<br />' . "\n";
		} elseif( current_user_can('employer') ) {
			echo '（※求人への応募があると連絡先に相手が登録されます。）<br />' . "\n";
		}
?>
</p>
<?php
	}
?>
</div><!-- end .change-comp-content -->
</div><!-- end .exchange-select -->
<?php
//if () {
?>

<div class="exchange-deleat">
<form method="post" name="deleat-comp" id="deleat-comp">
<p class="deleat-member closed"><a href="javascript:;">退会した会員を一覧から削除する</a></p>
<p class="select-box" style="display: none;"><select name="delid" class="deleat-name" id="delid">
<option value="" selected="selected">削除する相手を選択してください</option>
<?php
foreach($myComps[0] as $myComps_id) :
	$name = get_user_meta($myComps_id, 'last_name', true);
	if( $myComps_id != $myID && !$name ) :
?>
<option value="<?php echo $myComps_id; ?>"><?php if($name) {echo $name;} else {echo '（退会しました-'.$myComps_id.'）';} ?></option>
<?php
	endif; // ( $myComps_id != $myID && !$name )
endforeach;
?>
</select>
<input type="submit" value="選択した会員を削除する" style="display: inline-block;"><br />
※一度削除すると、元には戻せませんのでご注意ください。</p>
</form>
</div><!-- end .exchange-deleat -->
<?php
//}
?>
</div> <!-- end .comments-area -->

</div><!-- end #comments -->

// 全体
jQuery(document).ready(function() {
	// 郵便番号から住所を自動入力
	jQuery('#user_addr_zip').attr("onKeyUp", "AjaxZip3.zip2addr(this,'','user_addr_pref','user_addr_other');").attr("placeholder", "半角英数（住所が自動入力されます）");
	jQuery('#user_tel').attr("placeholder", "半角英数");

	// DatePicker
	jQuery("#job_expires").datepicker();
	jQuery("#apply_date").datepicker();

	// 新規会員登録時のメールアドレスをログインID（input hidden）に代入
	jQuery('#user_email').change(function() {
		var email = jQuery(this).val().replace( /@/g , "-" ) ;
		//jQuery('#user_login').val("user-"+email);
	});

	// フォームの全サブミットボタンのクラスに"btn btn-sub"を追加
	jQuery('input[type="submit"], input[type="reset"], input[type="button"], button').addClass("btn").toggleClass("btn-sub");
	jQuery('button.wp-generate-pw').removeClass("btn").removeClass("btn-sub"); // パスワード生成ボタン
	jQuery('button.navbar-toggle').removeClass("btn").removeClass("btn-sub"); // レスポンシブレイアウト（スマホ用）のメニューボタン
});

// 求人詳細のタブ表示
jQuery(function(){
	//クリックしたときのファンクションをまとめて指定
	jQuery('#tab-menu li').click(function() {
		if(jQuery(this).not('active')){
			//.index()を使いクリックされたタブが何番目かを調べ、indexという変数に代入します。
			var index = jQuery('#tab-menu li').index(this);
			//コンテンツを一度すべて非表示にし、
			jQuery('#tab-box div').css('display','none');
			//クリックされたタブと同じ順番のコンテンツを表示します。
			jQuery('#tab-box div').eq(index).css('display','block');
			//一度タブについているクラスactiveを消し、
			jQuery('#tab-menu li').removeClass('active');
			//クリックされたタブのみにクラスactiveをつけます。
			jQuery(this).addClass('active');
		}
	});
});

// 応募履歴
jQuery(document).ready(function() {
	//
	jQuery('.jobrec-accordion-btn').click(function() {
		jQuery(this).find('.togglebtn').toggleClass('none');
		jQuery(this).parent('.jobrec-accordion').find('.jobrec-accordion-hide').animate(
	    {height: "toggle", opacity: "toggle"},
	    "fast"
		);
	});

	// 進捗状況・メモのアコーデオン
	/*jQuery('.recruit-note-head').click(function() {
		jQuery(this).find('.togglebtn').toggleClass('none');
		jQuery(this).parent('.recruit-note').find('.recruit-note-memo').animate(
	    {height: "toggle", opacity: "toggle"},
	    "fast"
		);
	});*/
});

// 求人の登録・編集
jQuery(document).ready(function(){
	// 求人登録「募集締切日」に初期値を追加
	jQuery('#page-9 .fieldset-job_expires').find('input#job_expires').attr('value', '2017-01-01');

	// 求人編集フォームに文言を追加
	jQuery('#submit-job-form').prepend('<p style="border-bottom:1px solid #E9E9E9; margin-bottom:14px;">＊「（任意）」の記述のある項目以外はすべて<strong>必須項目</strong>となっていますので、ご記入をお願いいたします。</p>');
});

// ＦＡＱのアコーデオン
jQuery(document).ready(function() {
	jQuery('h3.faq-cat-title').click(function() {
		jQuery(this).find('span').toggleClass('none');
		jQuery(this).parent('.faq-cat').find('dl.faq-item-list').animate(
	    {height: "toggle", opacity: "toggle"},
	    "normal"
		);
	});
});

// Ｅメッセージ
jQuery(document).ready(function(){
	// 宛先プルダウンを選択時にSubmitを実行
	jQuery('#compid').change(function() {
		jQuery('#change-comp').submit();
	});

	// 履歴を一番下にスクロール
	setTimeout(function() {
		var $commlist = jQuery('#comments .comment-list');
		$commlist.animate({
			scrollTop: $commlist.height()
		},'fast');
	},0);

	// 相手選択フォームのアコーデオン
	jQuery('p.select-member').click(function() {
		jQuery(this).toggleClass('opened');
		jQuery(this).parent('.exchange-select').toggleClass('exchange-selected-open').find('.change-comp-content').animate(
	    {height: "toggle", opacity: "toggle"},
	    "normal"
		);
	});

	// 退会会員の削除フォームのアコーデオン
	jQuery('p.deleat-member').click(function() {
		jQuery(this).toggleClass('opened');
		jQuery(this).parent('#deleat-comp').find('p.select-box').animate(
	    {height: "toggle", opacity: "toggle"},
	    "normal"
		);
	});
});

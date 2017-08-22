<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-profile" id="theme-my-login<?php $template->the_instance(); ?>">
<?php $template->the_action_template_message( 'profile' ); ?>
<?php $template->the_errors(); ?>
<form id="your-profile" action="<?php $template->the_action_url( 'profile', 'login_post' ); ?>" method="post">
<?php wp_nonce_field( 'update-user_' . $current_user->ID ); ?>
<div class="hidden" style="display: none">
<input type="hidden" name="from" value="profile" />
<input type="hidden" name="checkuser_id" value="<?php echo $current_user->ID; ?>" />
</div>

<?php do_action( 'profile_personal_options', $profileuser ); ?>

<?php


// ******** ユーザー（講師）用プロフィール項目 ********
if ( current_user_can('subscriber') ) {
?>
<table class="tml-form-table">
<?php
	foreach ( wp_get_user_contact_methods() as $name => $desc ) {

		// 塾／予備校用プロフィールを除く
		if ( strpos($name,'school_') === false && strpos($name,'company_') === false ) { // $nameのなかに'school_'や'company_'が含まれていない場合

			// セクションごとにタイトルを表示させる
			$sectitle_array = array(
				'last_name' =>'基本情報',
				'user_tel' =>'連絡先',
				'user_juniorhigh' =>'学歴・職歴',
				'user_instruction' =>'その他',
				'user_job_area' =>'希望求人<span style="font-size: 14px; font-weight:normal;"> （＊「'. get_bloginfo('blogname').'」に登録されていない募集のお知らせもご希望の方は、下の項目にもお答えください。）</span>',
			);
			foreach ( $sectitle_array as $key=>$value ) {
				if ( $name == $key ) {
					echo '</table>'."\n"."\n";
					echo '<h3>'.$value.'</h3>'."\n";
					echo '<table class="tml-form-table">'."\n";
				}
			}
?>

<tr class="tml-user-contact-method-<?php echo $name; ?>-wrap">
<th><label for="<?php echo $name; ?>"><?php echo apply_filters( 'user_'.$name.'_label', $desc ); ?><?php
			// 「必須」の表示（必須以外の項目を除外）
			$option_array = array(
				'user_fax', // ＦＡＸ番号
				'user_grad_school', // 大学院
				'user_univ_failed', // 大学浪人
				'user_univ_repeated', // 大学留年・休学
				'user_univ_abroad', // 海外留学
				'user_scareer_other', // 学歴その他
				'user_instruction', // 指導経験
				'user_certificate', // 免許・資格
				'user_job_area', // エリア
				'user_job_contract', // 契約形態
				'user_job_type', // 希望業種
			);
			if ( !in_array($name, $option_array) ) {
				echo ' <span class="description required">';
				_e( '(required)', 'theme-my-login' );
				echo '</span>';
			}
?></label></th>
<td><?php

			// **** 性別 ****
			if ( $name == 'user_sex' ) {
?><div class="checkbox-box">
<input type="radio" name="user_sex" id="user_sex<?php $template->the_instance(); ?>_m" class="radio" value="男性"<?php if ( $profileuser->user_sex == '男性' || $_POST['user_sex'] == '男性' ) echo ' checked="checked"'; ?> /> <label for="user_sex<?php $template->the_instance(); ?>_m" class="user_sex male radio">男性</label>
　　<input type="radio" name="user_sex" id="user_sex<?php $template->the_instance(); ?>_f" class="radio" value="女性"<?php if ( $profileuser->user_sex == '女性' || $_POST['user_sex'] == '女性' ) echo ' checked="checked"'; ?> /> <label for="user_sex<?php $template->the_instance(); ?>_f" class="user_sex female radio">女性</label>
</div><?php

			// **** 現在状況 ****
			} elseif ( $name == 'user_occupation' ) {
				$user_ocp = $profileuser->user_occupation;
				the_select_user_ocp($user_ocp);

			// **** 職歴 ****
			} elseif ( $name == 'user_career' ) {
?><textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="textarea"><?php
				// フォームに入力があった場合にはその値を表示する
				if ( $_POST[$name] ) {
					echo $_POST[$name];
				} else {
					echo $profileuser->$name;
				}
?></textarea><?php

			// **** 指導経験 ****
			} elseif ( $name == 'user_instruction' ) {
?><textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="textarea"><?php
				// フォームに入力があった場合にはその値を表示する
				if ( $_POST[$name] ) {
					echo $_POST[$name];
				} else {
					echo $profileuser->$name;
				}
?></textarea><?php


			// **** 免許・資格 ****
			} elseif ( $name == 'user_certificate' ) {
?><textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="textarea"><?php
				// フォームに入力があった場合にはその値を表示する
				if ( $_POST[$name] ) {
					echo $_POST[$name];
				} else {
					echo $profileuser->$name;
				}
?></textarea><?php

			// **** 住所１ ****
			} elseif ( $name == 'user_addr_pref' ) {
				// フォームに入力があった場合にはその値を代入する
				if ( $_POST[$name] ) {
					$addr_pref = $_POST[$name];
				} else {
					$addr_pref = $profileuser->user_addr_pref;
				}
				the_select_addr_prof($addr_pref);

			// **** 希望エリア ****
			} elseif ( $name == 'user_job_area' ) {
				// フォームに入力があった場合にはその値を代入する
				if ( $_POST[$name] ) {
					$user_job_area = $_POST[$name];
				} else {
					$user_job_area = $profileuser->user_job_area;
				}
				the_checkbox_job_area($user_job_area);

			// **** 契約形態 ****
			} elseif ( $name == 'user_job_contract' ) {
				// フォームに入力があった場合にはその値を代入する
				if ( $_POST[$name] ) {
					$user_job_contract = $_POST[$name];
				} else {
					$user_job_contract = $profileuser->user_job_contract;
				}
				the_checkbox_job_contract($user_job_contract);

			// **** 希望業種 ****
			} elseif ( $name == 'user_job_type' ) {
				// フォームに入力があった場合にはその値を代入する
				if ( $_POST[$name] ) {
					$user_job_type = $_POST[$name];
				} else {
					$user_job_type = $profileuser->user_job_type;
				}
				the_checkbox_job_type($user_job_type);

			// **** その他 ****
			} else {
?><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php
				// フォームに入力があった場合にはその値を表示する
				if ( $_POST[$name] ) {
					echo $_POST[$name];
				} else {
					echo esc_attr( $profileuser->$name );
				}
?>" class="regular-text" /><?php
			}
?></td>
</tr>
<?php
		}
	}
?>
</table>
<?php


// ******** 塾／予備校用プロフィール項目 ********

} elseif ( current_user_can('employer') ) {
	$school_users = wp_get_user_contact_methods();
	$school_array = array(
		array( 'last_name', '名称', 'required' ),
		array( 'school_tagline', 'school_tagline', 'no_required' ),
		array( 'school_description', 'school_description', 'no_required' ),
		array( 'school_buildings', 'school_buildings', 'required' ),
		array( 'school_lecturers', 'school_lecturers', 'no_required' ),
		array( 'school_students', 'school_students', 'no_required' ),
		array( 'school_highgrade', 'school_highgrade', 'no_required' ),
		array( 'school_site', 'school_site', 'no_required' ),
		array( 'company_name', '御社名', 'required' ),
		array( 'user_birth', '設立年度', 'required' ),
		array( 'company_representative', 'company_representative', 'required' ),
		array( 'company_business', 'company_business', 'required' ),
		array( 'user_addr_zip', 'user_addr_zip', 'required' ),
		array( 'user_addr_pref', 'user_addr_pref', 'required' ),
		array( 'user_addr_other', 'user_addr_other', 'required' ),
		array( 'user_tel', 'user_tel', 'required' ),
		array( 'user_fax', 'user_fax', 'required' ),
		array( 'user_email', 'メールアドレス<span class="normal">（下のアカウント管理欄で変更できます）</span>', 'required' ),
		array( 'school_responsible', 'school_responsible', 'required' ),
	);
?>
<h3>基本情報</h3>
<table class="tml-form-table">

<?php
	foreach ( $school_array as $values ) {
		if ( $values[0] == 'company_name' ) :
?>
</table>

<h3>会社情報</h3>
<table class="tml-form-table">
<?php
		elseif ( $values[0] == 'user_addr_zip' ) :
?>
</table>

<h3>連絡先</h3>
<table class="tml-form-table">
<?php
		endif;

		// **** テキストエリア・フォームの書き出し ****
		$textarea_array = array(
			'school_description', // 説明
			'company_business', // 事業内容
			'school_buildings', // 校舎数
			'school_highgrade', // 主な合格実績
		);
		if ( in_array($values[0], $textarea_array) ) {
?>
<tr class="tml-<?php echo $values[0]; ?>-wrap">
<th><label for="<?php echo $values[0]; ?>"><?php echo $school_users[$values[1]]; ?><?php
			// 必須の表示／非表示
			if ( $values[2] == 'required' ) {
				echo ' <span class="description required">';
				_e( '(required)', 'theme-my-login' );
				echo '</span>';
			}
?></label></th>
<td><textarea name="<?php echo $values[0]; ?>" id="<?php echo $values[0]; ?>" class="textarea"><?php
			// フォームに入力があった場合にはその値を表示する
			if ( $_POST[$values[0]] ) {
				echo $_POST[$values[0]];
			} else {
				echo $profileuser->$values[0];
			}
?></textarea></td>
</tr>

<?php

		// **** メールアドレス ****
		} elseif ( $values[0] == 'user_email' ) {
?>
<tr class="tml-<?php echo $values[0]; ?>-wrap">
<th><label for="<?php echo $values[0]; ?>"><?php echo $values[1]; ?></label></th>
<td><span class="checkbox-box" style="color:#333; background-color:white;"><?php echo esc_attr( $profileuser->$values[0] ); ?></span></td>
</tr>

<?php

		// **** 住所１ ****
		} elseif ( $values[0] == 'user_addr_pref' ) {
?>
<tr class="tml-<?php echo $values[0]; ?>-wrap">
<th><label for="<?php echo $values[0]; ?>"><?php echo $school_users[$values[1]]; ?> <span class="description required"><?php _e( '(required)', 'theme-my-login' ); ?></span></label></th>
<td><select name="user_addr_pref" id="user_addr_pref" class="select">
<option value="">　選択して下さい ▽</option>
<?php
			// フォームに入力があった場合にはその値を代入する
			if ( $_POST[$values[0]] ) {
				$addr_pref = $_POST[$values[0]];
			} else {
				$addr_pref = $profileuser->$values[0];
			}
			global $prefArr;
			foreach ( $prefArr as $prefGrp => $prefs ) {
				echo '<optgroup label="'.$prefGrp.'">'."\n";
				foreach ( $prefs as $pref ) {
					echo '<option value="'.$pref.'"';
					if ( $addr_pref == $pref ) echo ' selected="selected"';
					echo '>'.$pref.'</option>'."\n";
				}
				echo '</optgroup>'."\n";
			}
?>
</select></td>
</tr>

<?php

		// **** その他 ****
		} else {
?>
<tr class="tml-<?php echo $values[0]; ?>-wrap">
<th><label for="<?php echo $values[0]; ?>"><?php
		// ラベルの表示
		if ( $values[0] == $values[1] ) {
			echo $school_users[$values[1]];
		} else {
			echo $values[1];
		}

		// 必須の表示／非表示
		if ( $values[2] == 'required' ) {
			echo ' <span class="description required">';
			_e( '(required)', 'theme-my-login' );
			echo '</span>';
		}
?></label></th>
<td><input type="text" name="<?php echo $values[0]; ?>" id="<?php echo $values[0]; ?>" value="<?php
		// フォームに入力があった場合にはその値を表示する
		if ( $_POST[$values[0]] ) {
			echo $_POST[$values[0]];
		} else {
			echo esc_attr( $profileuser->$values[0] );
		}
?>" class="regular-text" /></td>
</tr>

<?php
		}
?>
<?php
	}
?>
</table>

<!--<h3>その他</h3>
<table class="tml-form-table">
</table>-->
<?php
}
?>

<?php
$show_password_fields = apply_filters( 'show_password_fields', true, $profileuser );
if ( $show_password_fields ) :
?>
<!--</table>-->

<h3><?php _e( 'Account Management', 'theme-my-login' ); ?></h3>
<table class="tml-form-table">

<tr class="tml-nodisplay-wrap" style="display:none;">
<th></th>
<td><input type="hidden" name="nickname" id="nickname" value="<?php echo esc_attr( $profileuser->nickname ); ?>" class="regular-text" />
<input type="hidden" name="display_name" id="display_name" value="<?php echo esc_attr( $profileuser->last_name ); ?>" class="regular-text" /></td>
</tr>

<tr class="tml-user-email-wrap">
<th><label for="email"><?php _e( 'E-mail', 'theme-my-login' ); ?> <span class="description required"><?php _e( '(required)', 'theme-my-login' ); ?></span></label></th>
<td><input type="text" name="email" id="email" value="<?php echo esc_attr( $profileuser->user_email ); ?>" class="regular-text" /></td>
<?php
$new_email = get_option( $current_user->ID . '_new_email' );
if ( $new_email && $new_email['newemail'] != $current_user->user_email ) :
?>
<div class="updated inline">
<p><?php
	printf(
		__( 'There is a pending change of your e-mail to %1$s. <a href="%2$s">Cancel</a>', 'theme-my-login' ),
		'<code>' . $new_email['newemail'] . '</code>',
		esc_url( self_admin_url( 'profile.php?dismiss=' . $current_user->ID . '_new_email' ) )
	);
?></p>
</div>
<?php
endif;
?>
</tr>

<tr id="password" class="user-pass1-wrap">
<th><label for="pass1"><?php _e( 'New Password', 'theme-my-login' ); ?></label></th>
<td>
<input class="hidden" value=" " /><!-- #24364 workaround -->
<button type="button" class="button button-secondary wp-generate-pw hide-if-no-js"><?php _e( 'Generate Password', 'theme-my-login' ); ?></button>
<div class="wp-pwd hide-if-js">
<span class="password-input-wrapper">
<input type="password" name="pass1" id="pass1" class="regular-text" value="" autocomplete="off" data-pw="<?php echo esc_attr( wp_generate_password( 24 ) ); ?>" aria-describedby="pass-strength-result" />
</span>
<div style="display:none" id="pass-strength-result" aria-live="polite"></div>
<button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Hide password', 'theme-my-login' ); ?>">
<span class="dashicons dashicons-hidden"></span>
<span class="text"><?php _e( 'Hide', 'theme-my-login' ); ?></span>
</button>
<button type="button" class="button button-secondary wp-cancel-pw hide-if-no-js" data-toggle="0" aria-label="<?php esc_attr_e( 'Cancel password change', 'theme-my-login' ); ?>">
<span class="text"><?php _e( 'Cancel', 'theme-my-login' ); ?></span>
</button>
</div>
</td>
</tr>

<tr class="user-pass2-wrap hide-if-js">
<th scope="row"><label for="pass2"><?php _e( 'Repeat New Password', 'theme-my-login' ); ?></label></th>
<td>
<input name="pass2" type="password" id="pass2" class="regular-text" value="" autocomplete="off" />
<p class="description"><?php _e( 'Type your new password again.', 'theme-my-login' ); ?></p>
</td>
</tr>

<tr class="pw-weak">
<th><?php _e( 'Confirm Password', 'theme-my-login' ); ?></th>
<td>
<label>
<input type="checkbox" name="pw_weak" class="pw-checkbox" />
<?php _e( 'Confirm use of weak password', 'theme-my-login' ); ?>
</label>
</td>
</tr>
<?php
endif;
?>

</table>

<?php
	do_action( 'show_user_profile', $profileuser ); ?>

<p class="tml-submit-wrap">
<input type="hidden" name="action" value="profile" />
<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
<input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr( $current_user->ID ); ?>" />
<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Update Profile', 'theme-my-login' ); ?>" name="submit" id="submit" />
</p>
</form>
</div><!-- /#theme-my-login -->

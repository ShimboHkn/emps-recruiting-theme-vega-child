<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div class="tml tml-register" id="theme-my-login<?php $template->the_instance(); ?>">
<?php $template->the_action_template_message( 'register' ); ?>
<?php $template->the_errors(); ?>
<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register', 'login_post' ); ?>" method="post">
<?php if ( 'email' != $theme_my_login->get_option( 'login_type' ) ) : ?>
<?php //echo 'aaa'; ?>
<?php endif; ?>

<h3>アカウント</h3>
<p class="register-form-p tml-user-login-wrap" style="display:none;">
<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username', 'theme-my-login' ); ?>  <span class="required">*</span></label>
<input type="hidden" name="user_login" id="user_login<?php $template->the_instance(); ?>" class="text" value="<?php echo date('ymd.His', strtotime('+ 9 hour')).'.'. sprintf("%03d", mt_rand (0, 999)); ?>" size="20" />
</p>

<p class="register-form-p tml-user-email-wrap">
<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'E-mail', 'theme-my-login' ); ?>  <span class="required">*</span></label>
<input type="email" name="user_email" id="user_email<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
</p>

<?php do_action( 'register_form' ); ?>

<!-- ▼▼▼ 追加ここから ▼▼▼ -->
<h3>基本情報</h3>
<p class="register-form-p">
<label for="last_name<?php $template->the_instance(); ?>">お名前（姓と名の間にスペース）  <span class="required">*</span></label>
<input type="text" name="last_name" id="last_name<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'last_name' ); ?>" size="40" />
</p>
<p class="register-form-p">
<label for="user_name_kana<?php $template->the_instance(); ?>">フリガナ（姓と名の間にスペース）  <span class="required">*</span></label>
<input type="text" name="user_name_kana" id="user_name_kana<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_name_kana' ); ?>" size="40" />
</p>
<p class="register-form-p">
<label for="user_sex<?php $template->the_instance(); ?>_m">性別 <span class="required">*</span></label>
<span class="checkbox-box">
<input type="radio" name="user_sex" id="user_sex<?php $template->the_instance(); ?>_m" class="radio" value="男性"<?php if ( $_POST['user_sex'] == '男性' ) echo ' checked="checked"'; ?> /> <label for="user_sex<?php $template->the_instance(); ?>_m" class="user_sex male radio">男性</label>
　　<input type="radio" name="user_sex" id="user_sex<?php $template->the_instance(); ?>_f" class="radio" value="女性"<?php if ( $_POST['user_sex'] == '女性' ) echo ' checked="checked"'; ?> /> <label for="user_sex<?php $template->the_instance(); ?>_f" class="user_sex female radio">女性</label>
</span>
</p>
<p class="register-form-p">
<label for="user_birth<?php $template->the_instance(); ?>">生年月日 <span class="required">*</span></label>
<input type="text" name="user_birth" id="user_birth<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_birth' ); ?>" size="40" />
</p>
<p class="register-form-p">
<label for="user_occupation<?php $template->the_instance(); ?>">現在状況 <span class="required">*</span></label>
<?php the_select_user_ocp($_POST['user_occupation']); ?>
</p>

<h3>連絡先</h3>
<p class="register-form-p">
<label for="user_tel<?php $template->the_instance(); ?>">電話番号（例：033-123-4567）  <span class="required">*</span></label>
<input type="tel" name="user_tel" id="user_tel<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_tel' ); ?>" size="20" />
</p>
<p class="register-form-p">
<label for="user_addr_zip<?php $template->the_instance(); ?>">郵便番号（例：100-0001）</label>
<input type="text" name="user_addr_zip" id="user_addr_zip<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_addr_zip' ); ?>" size="20" />
</p>
<p class="register-form-p">
<label for="user_addr_pref<?php $template->the_instance(); ?>">住所１（都道府県） <span class="required">*</span></label>
<?php the_select_addr_prof($_POST['user_addr_pref']); ?>
</p>
<p class="register-form-p">
<label for="user_addr<?php $template->the_instance(); ?>">住所２（市区町村番地：建物名、部屋番号もご入力ください） <span class="required">*</span></label>
<input type="text" name="user_addr_other" id="user_addr_other<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_addr_other' ); ?>" size="60" />
</p>

<h3>学歴</h3>
<p class="register-form-p">
<label for="user_juniorhigh<?php $template->the_instance(); ?>">出身中学（国立、公立、私立も併せてご入力ください） <span class="required">*</span></label>
<input type="text" name="user_juniorhigh" id="user_juniorhigh<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_juniorhigh' ); ?>" size="20" />
</p>
<p class="register-form-p">
<label for="user_highschool<?php $template->the_instance(); ?>">出身高校（国立、公立、私立も併せてご入力ください） <span class="required">*</span></label>
<input type="text" name="user_highschool" id="user_highschool<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_highschool' ); ?>" size="20" />
</p>
<p class="register-form-p">
<label for="user_university<?php $template->the_instance(); ?>">出身大学（学部、学科までご入力ください） <span class="required">*</span></label>
<input type="text" name="user_university" id="user_university<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_university' ); ?>" size="20" />
</p>
<p class="register-form-p">
<label for="user_grad_school<?php $template->the_instance(); ?>">大学院（専攻までご入力ください）</label>
<input type="text" name="user_grad_school" id="user_grad_school<?php $template->the_instance(); ?>" class="text" value="<?php $template->the_posted_value( 'user_grad_school' ); ?>" size="20" />
</p>
<!--<p class="register-form-p">
<label for="user_license<?php $template->the_instance(); ?>">教員免許（例：小学校１種（算数）、中学校２種（数学））</label>
<textarea name="user_license" id="user_license<?php $template->the_instance(); ?>" class="textarea" size="20"><?php if($_POST['user_license']) echo $_POST['user_license']; ?></textarea>
</p>-->

<h3>希望求人<span style="font-size: 14px; font-weight:normal;"> （＊「<?php echo get_bloginfo('blogname'); ?>」に登録されていない募集のお知らせもご希望の方は、下の項目にもお答えください。）</span></h3>

<p class="register-form-p">
<label for="user_job_area<?php $template->the_instance(); ?>">エリア<!-- <span class="required">*</span>--></label>
<?php the_checkbox_job_area($_POST['user_job_area']); ?>
</p>
<p class="register-form-p">
<label for="user_job_contract<?php $template->the_instance(); ?>">契約形態<!-- <span class="required">*</span>--></label>
<?php the_checkbox_job_contract($_POST['user_job_contract']); ?>
</p>
<p class="register-form-p">
<label for="user_job_type<?php $template->the_instance(); ?>">希望業種<!-- <span class="required">*</span>--></label>
<?php the_checkbox_job_type($_POST['user_job_type']); ?>
</p>

<h3>同意事項</h3>
<div class="tos">
<h3 class="tos-title">会員規約：</h3>
<div class="tos-content">
<?php echo get_post(84)->post_content; ?>
</div><!-- /.tos-content -->
</div><!-- /.tos -->
<p class="register-form-p">
<label for="user_confirm<?php $template->the_instance(); ?>">
<input type="checkbox" name="user_confirm" id="user_confirm<?php $template->the_instance(); ?>" class="checkbox" value="会員規約に同意"<?php if ( '会員規約に同意' == $_POST['user_confirm']) echo ' checked="checked"' ?> /> 会員規約に同意 <span class="required">*</span></label>
</p>

<!-- ▲▲▲ 追加ここまで ▲▲▲ -->




<p class="tml-registration-confirmation" id="reg_passmail<?php $template->the_instance(); ?>"><?php echo apply_filters( 'tml_register_passmail_template_message', __( 'Registration confirmation will be e-mailed to you.', 'theme-my-login' ) ); ?></p>

<p class="tml-submit-wrap">
<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="仮登録<?php //esc_attr_e( 'Register', 'theme-my-login' ); ?>" />
<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
<input type="hidden" name="action" value="register" />
</p>
</form>

<?php //$template->the_action_links( array( 'register' => false ) ); ?>
</div><!-- /#theme-my-login -->

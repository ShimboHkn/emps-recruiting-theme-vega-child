<?php
/*
カスタムフィールド関連
*/

// 【学校ユーザー用】求人登録フォーム項目
function custom_submit_job_form_fields( $fields ) {
	// 1
	$fields['job']['job_title'] = array(
		'label' => '求人タイトル',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 1,
	);

	// 2
	$fields['job']['job_image'] = array(
		'label' => 'イメージ画像',
		'type' => 'file',
		'required' => false,
		'placeholder' => '',
		'priority' => 2,
	);

	$fields['job']['job_description'] = array(
		'label' => '募集文',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 3,
	);

	$fields['job']['job_category'] = array(
		'label' => '指導教科',
		'type' => 'term-select',
		'taxonomy' => 'job_listing_category',
		'required' => true,
		'placeholder' => '教科を選択してください',
		'priority' => 4,
	);

	$fields['job']['job_type'] = array(
		'label' => '雇用形態',
		'type' => 'term-select',
		'taxonomy' => 'job_listing_type',
		'required' => true,
		'placeholder' => '雇用形態を選択してください',
		'priority' => 5,
	);

	$fields['job']['job_location'] = array(
		'label' => 'エリア',
		'type' => 'term-select',
		'taxonomy' => 'job_listing_area',
		'required' => true,
		'placeholder' => 'エリアを選択してください',
		'priority' => 8,
	);

	/*$fields['job']['job_arrivalday'] = array(
		'label' => '勤務開始時期',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 9,
	);*/

	$fields['job']['job_expires'] = array(
		'label' => '募集締切日',
		'type' => 'text',
		'required' => true,
		'placeholder' => '例：2020-03-01（年-月-日すべて半角英数字）',
		'priority' => 11,
	);

	$fields['job']['job_class'] = array(
		'label' => '指導形態',
		'type' => 'term-select',
		'taxonomy' => 'job_listing_class',
		'required' => true,
		'placeholder' => '指導形態を選択してください',
		'priority' => 12,
	);

	$fields['job']['job_target'] = array(
		'label' => '指導対象',
		'type' => 'term-select',
		'taxonomy' => 'job_listing_target',
		'required' => true,
		'placeholder' => '指導対象を選択してください',
		'priority' => 13,
	);

	$fields['job']['job_noses'] = array(
		'label' => '募集人数',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 16,
	);

	$fields['job']['job_detail'] = array(
		'label' => '仕事内容',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 18,
	);

	$fields['job']['job_requirements'] = array(
		'label' => '応募資格',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 20,
	);

	$fields['job']['job_age'] = array(
		'label' => '年齢',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 22,
	);

	$fields['job']['job_experience'] = array(
		'label' => '指導経験の有無',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 24,
	);

	$fields['job']['job_skill'] = array(
		'label' => '生かせる経験・<br />スキル',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 26,
	);

	/*$fields['job']['job_papers'] = array(
		'label' => '応募書類',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 24,
	);*/

	/*$fields['job']['job_method'] = array(
		'label' => '応募方法',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 25,
	);*/

	/*$fields['job']['job_apptargets'] = array(
		'label' => '応募先',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 33,
	);*/

	$fields['job']['job_recruit_info'] = array(
		'label' => '選考方法',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 30,
	);

	$fields['job']['job_place'] = array(
		'label' => '勤務場所',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 35,
	);

	$fields['job']['job_time'] = array(
		'label' => '勤務時間',
		'type'  => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 36,
	);

	$fields['job']['job_salary'] = array(
		'label' => '給与',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 42,
	);

	$fields['job']['job_holiday'] = array(
		'label' => '休日・休暇',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 47,
	);

	$fields['job']['job_conditions'] = array(
		'label' => '待遇・福利厚生',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 50,
	);

	$fields['job']['job_insurance'] = array(
		'label' => '社会保険',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 52,
	);

	$fields['job']['job_others'] = array(
		'label' => 'その他',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 80,
	);

	$fields['job']['job_charge'] = array(
		'label' => '採用担当者',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 90,
	);

	$fields['job']['application']['priority'] = 99;



/* ******** */

	//unset( $fields['job']['application'] );
	//unset( $fields['job']['job_location'] );
	unset( $fields['company']['company_logo'] );
	unset( $fields['company']['company_name'] );
	unset( $fields['company']['company_tagline'] );
	unset( $fields['company']['company_video'] );
	unset( $fields['company']['company_twitter'] );
	unset( $fields['company']['company_website'] );
	return $fields;
}
add_filter( 'submit_job_form_fields', 'custom_submit_job_form_fields' );



// 求人登録フォーム各項目の保存
function frontend_add_job_manager_job_listing_data_field_save( $job_id, $values ) {
	update_post_meta( $job_id, '_job_image', $values['job']['job_image'] );

	update_post_meta( $job_id, '_job_location', $values['job']['job_location'] );
	update_post_meta( $job_id, '_job_arrivalday', $values['job']['job_arrivalday'] ); // new
	update_post_meta( $job_id, '_job_expires', $values['job']['job_expires'] );
	update_post_meta( $job_id, '_job_class', $values['job']['job_class'] );

	update_post_meta( $job_id, '_job_noses', $values['job']['job_noses'] ); // new
	update_post_meta( $job_id, '_job_skill', $values['job']['job_skill'] ); // new
	update_post_meta( $job_id, '_job_requirements', $values['job']['job_requirements'] );
	update_post_meta( $job_id, '_job_age', $values['job']['job_age'] );
	update_post_meta( $job_id, '_job_experience', $values['job']['job_experience'] );
	update_post_meta( $job_id, '_job_papers', $values['job']['job_papers'] ); // new
	update_post_meta( $job_id, '_job_method', $values['job']['job_method'] ); // new
	update_post_meta( $job_id, '_job_recruit_info', $values['job']['job_recruit_info'] );
	update_post_meta( $job_id, '_job_apptargets', $values['job']['job_apptargets'] ); // new
	update_post_meta( $job_id, '_job_detail', $values['job']['job_detail'] ); // new
	update_post_meta( $job_id, '_job_place', $values['job']['job_place'] ); // new
	update_post_meta( $job_id, '_job_time', $values['job']['job_time'] );
	update_post_meta( $job_id, '_job_holiday', $values['job']['job_holiday'] );
	update_post_meta( $job_id, '_job_salary', $values['job']['job_salary'] );
	update_post_meta( $job_id, '_job_conditions', $values['job']['job_conditions'] );
	update_post_meta( $job_id, '_job_insurance', $values['job']['job_insurance'] ); // new
	update_post_meta( $job_id, '_job_others', $values['job']['job_others'] ); // new
	update_post_meta( $job_id, '_job_charge', $values['job']['job_charge'] );

	update_post_meta( $job_id, '_job_', $values['job']['job_'] );


	update_post_meta( $job_id, '_company_form', $values['company']['company_form'] );

/*
	$terms = get_term_by( 'name',$values['job']['job_location1'], 'area' );
	wp_set_post_terms( $job_id, $terms->term_id, 'area' );
	wp_set_post_terms( $job_id, $values['job']['conditions'], 'conditions' );
*/
}
add_action( 'job_manager_update_job_data', 'frontend_add_job_manager_job_listing_data_field_save', 10, 2 );

// 【管理者用】求人情報編集画面への項目出力
function custom_job_manager_job_listing_data_fields( $fields ) {
	$fields['_featured']['label'] = '注目の求人';
	$fields['_featured']['priority'] = 1;

	$fields['_filled']['label'] = '募集の終了';
	$fields['_filled']['description'] = '募集を終了すると、この求人に応募できなくなります。';
	$fields['_filled']['priority'] = 2;

	$fields['_job_image'] = array(
		'label' => 'イメージ画像',
		'type' => 'file',
		'required' => false,
		'polaceholder' => '',
		'priority' => 5,
	);

	$fields['_job_expires'] = array(
		'label' => '募集締切日',
		'type' => 'text',
		'required' => false,
		'placeholder' => '例：2017-01-01（年-月-日すべて半角英数字）',
		'priority' => 8
	);

	/*$fields['_job_category']['label'] = '教科';
	$fields['_job_category']['type'] = 'term-select';
	$fields['_job_category']['placeholder'] = '教科を選択してください';
	$fields['_job_category']['priority'] = 11;*/

	/*$fields['_job_type']['type'] = 'term-select';
	$fields['_job_type']['placeholder'] = '雇用形態を選択してください';
	$fields['_job_type']['priority'] = 12;*/


	/*$fields['_job_arrivalday'] = array(
		'label' => '採用開始時期',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 10
	);*/

	/*$fields['_job_location'] = array(
		'label' => '勤務地（都道府県）',
		'type' => 'text',
		'required' => true,
		'placeholder' => '',
		'priority' => 13
	);*/


	$fields['_job_noses'] = array(
		'label' => '募集人数',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 20
	);

	$fields['_job_detail'] = array(
		'label' => '仕事内容',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 22,
	);

	$fields['_job_skill'] = array(
		'label' => '生かせる経験・スキル',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 30
	);

	$fields['_job_requirements'] = array(
		'label' => '応募資格',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 32
	);

	$fields['_job_age'] = array(
		'label' => '年齢',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 33
	);

	$fields['_job_experience'] = array(
		'label' => '指導経験の有無',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 34
	);

	/*$fields['_job_papers'] = array(
		'label' => '応募書類',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 33
	);*/

	/*$fields['_job_method'] = array(
		'label' => '応募方法',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 34
	);*/

	$fields['_job_recruit_info'] = array(
		'label' => '選考方法',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 36,
	);

	/*$fields['_job_apptargets'] = array(
		'label' => '応募先',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 37,
	);*/

	$fields['_job_place'] = array(
		'label' => '勤務場所',
		'type' => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 41,
	);

	$fields['_job_time'] = array(
		'label' => '勤務時間',
		'type'  => 'textarea',
		'required' => true,
		'placeholder' => '',
		'priority' => 44,
	);

	$fields['_job_holiday'] = array(
		'label' => '休日・休暇',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 45
	);

	$fields['_job_salary'] = array(
		'label' => '給与',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 46
	);

	$fields['_job_conditions'] = array(
		'label' => '待遇・福利厚生',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 48
	);

	$fields['_job_insurance'] = array(
		'label' => '社会保険',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 50,
	);

	$fields['_job_others'] = array(
		'label' => 'その他',
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
		'priority' => 80,
	);

	$fields['_job_charge'] = array(
		'label' => '採用担当者',
		'type' => 'text',
		'required' => false,
		'placeholder' => '',
		'priority' => 90,
	);


	//unset( $fields['_application'] );
	unset( $fields['_job_location'] );
	unset( $fields['_job_author'] );
	unset( $fields['_company_logo'] );
	unset( $fields['_company_name'] );
	unset( $fields['_company_tagline'] );
	unset( $fields['_company_video'] );
	unset( $fields['_company_twitter'] );
	unset( $fields['_company_website'] );

	return $fields;
}
add_filter( 'job_manager_job_listing_data_fields', 'custom_job_manager_job_listing_data_fields' );

// https://wpjobmanager.com/document/tutorial-adding-a-salary-field-for-jobs/



// 追加項目表示用関数
function the_job_category( $post = null ) {
	if ( $job_category = get_the_job_category( $post ) ) {
		echo apply_filters( 'the_content', $job_category );
	}
}
function get_the_job_category( $post = null ) {
	$post = get_post( $post );
	if ( $post->post_type !== 'job_listing' ) {
		return;
	}

	$types = wp_get_post_terms( $post->ID, 'job_listing_category' );

	if ( $types ) {
		$type = current( $types );
	} else {
		$type = false;
		return;
	}

	return $type->name;
}
function get_the_job_categories( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ){
		return;
	}

	$types = wp_get_post_terms( $post->ID, 'job_listing_category', array('orderby' => 'order') );

	foreach( $types as $type ){
		$names[] = $type->name;
	}

	if($names){
		return $names;
	}else{
		return;
	}
}

function the_job_time( $post = null ) {
	if( $job_time = get_the_job_time( $post ) ) {
		echo apply_filters( 'the_content', $job_time );
	}
}
function get_the_job_time( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$times = get_post_meta( $post->ID, '_job_time', true );
	return $times;
}

function the_job_locations( $post = null ) {
	if( $job_location = get_the_job_locations( $post ) ) {
		echo apply_filters( 'the_content', $job_location );
	}
}
function get_the_job_locations( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$location = get_post_meta( $post->ID, '_job_location', true );
	return $location;
}
function the_job_location_list( $post = null ) {
	if( $job_location_list = get_the_job_location_list( $post ) ) {
		echo apply_filters( 'the_content', $job_location_list );
	}
}
function get_the_job_location_list( $pos = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_location_list = get_post_meta( $post->ID, '_job_location_list', true );
	return $job_location_list;
}
function the_job_salary( $post = null ) {
	$post = get_post( $post );
	if( $job_salary = get_the_job_salary( $post ) ) {
		echo apply_filters( 'the_content', $job_salary );
	}
}
function get_the_job_salary( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$salary = get_post_meta( $post->ID, '_job_salary', true );
	return $salary;
}
function the_job_conditions( $post = null ) {
	$post = get_post( $post );
	if( $job_conditions = get_the_job_conditions( $post ) ) {
		echo apply_filters( 'the_content', $job_conditions );
	}
}
function get_the_job_conditions( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_conditions = get_post_meta( $post->ID, '_job_conditions', true );
	return $job_conditions;
}
function the_job_holiday( $post = null ) {
	$post = get_post( $post );
	if( $job_holiday = get_the_job_holiday( $post ) ) {
		echo apply_filters( 'the_content', $job_holiday );
	}
}
function get_the_job_holiday( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_holiday = get_post_meta( $post->ID, '_job_holiday', true );
	return $job_holiday;
}
function the_job_requirements( $post = null ) {
	$post = get_post( $post );
	if( $job_requirements = get_the_job_requirements( $post ) ) {
		echo apply_filters( 'the_content', $job_requirements );
	}
}
function get_the_job_requirements( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ){
		return;
	}
	$job_requirements = get_post_meta( $post->ID, '_job_requirements', true );
	return $job_requirements;
}
function the_job_recruit_info( $post = null ) {
	$post = get_post( $post );
	if( $recruit_info = get_the_job_recruit_info( $post ) ) {
		echo apply_filters( 'the_content', $recruit_info );
	}
}
function get_the_job_recruit_info( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$recruit_info = get_post_meta( $post->ID, '_job_recruit_info', true );
	return $recruit_info;
}
function the_job_image( $post = null ) {
	$post = get_post( $post );
	if( $job_image = get_the_job_image_url( $post ) ) {
		echo '<img src="'.$job_image.'">';
	}
}
function get_the_job_image_url( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_image = get_post_meta( $post->ID, '_job_image', true );
	return $job_image;
}

function the_job_charge( $post = null ) {
	$post = get_post( $post );
	if( $job_charge = get_the_job_charge( $post ) ) {
		echo apply_filters( 'the_content', $job_charge );
	}
}
function get_the_job_charge( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ) {
		return;
	}
	$job_charge = get_post_meta( $post->ID, '_job_charge', true );
	return $job_charge;
}
function the_company_form( $post = null ) {
	$post = get_post( $post );
	if( $company_form = get_the_company_form( $post ) ) {
		echo apply_filters( 'the_content', $company_form );
	}
}
function get_the_company_form( $post = null ) {
	$post = get_post( $post );
	if( $post->post_type !== 'job_listing' ){
		return;
	}
}
?>

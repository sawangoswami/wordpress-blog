<?php


	function sanitize_tkflld_data( $input ) {
	
			if(is_array($input)){
			
				$new_input = array();
		
				foreach ( $input as $key => $val ) {
					$new_input[ $key ] = (is_array($val)?sanitize_tkflld_data($val):sanitize_text_field( $val ));
				}
				
			}else{
				$new_input = sanitize_text_field($input);
			}
	
			if(!is_array($new_input)){
	
				if(stripos($new_input, '@') && is_email($new_input)){
					$new_input = sanitize_email($new_input);
				}
	
				if(stripos($new_input, 'http') || wp_http_validate_url($new_input)){
					$new_input = sanitize_url($new_input);
				}
	
			}
	
			
			return $new_input;
		}	
	
	function tkflld_admin_enqueue_script()
	{
		if (isset($_GET['page']) && $_GET['page'] == 'tkflld') {
			
			global $tkflld_pro, $tkflld_options;
				
			wp_enqueue_script('tkflld_boostrap', plugin_dir_url(dirname(__FILE__)) . 'js/bootstrap.min.js', array('jquery'));
			wp_enqueue_style('tkflld-boostrap', plugins_url('css/bootstrap.min.css', dirname(__FILE__)));
	
			
			wp_enqueue_style('fontawesome', plugins_url('css/fontawesome.min.css', dirname(__FILE__)));
	
			wp_enqueue_media();
	
			wp_enqueue_style('tkflld-common', plugins_url('css/common-styles.css', dirname(__FILE__)), array());
			wp_enqueue_style('tkflld-admin', plugins_url('css/admin-styles.css', dirname(__FILE__)), array(), date('Ymdhi'));
	
			wp_enqueue_script('tkflld_admin_scripts', plugin_dir_url(dirname(__FILE__)) . 'js/admin-scripts.js?t='.time(), array('jquery'));
			
			wp_enqueue_script('jquery-blockUI', plugin_dir_url(dirname(__FILE__)) . 'js/jquery.blockUI.js', array('jquery'));
			
			
			
			
			wp_localize_script(
				'tkflld_admin_scripts',
				'tkflld_ajax_object',
				array(
					'ajax_url' => admin_url('admin-ajax.php'),
					'url' => admin_url('admin.php?page=tkflld'),
					'options' => $tkflld_options,
					'tkflld_delete_msg' => __('Do you want to delete this directory and data as well?', 'toolkit-for-learndash'),
					'target_dir_msg' => __('Select a target directory.', 'toolkit-for-learndash'),
					'move_error' => __('Sorry! File could not move, please try again.', 'toolkit-for-learndash'),
					'move_str' => __('Cannot move to the selected directory', 'toolkit-for-learndash'),
					'del_confirm' => __('Do you want to delete this file?', 'toolkit-for-learndash'),
					'select_role_str' =>  __('Select roles to allow upload', 'toolkit-for-learndash'),
					'rename_confirm' => __('Do you want to rename this directory?', 'toolkit-for-learndash'),
					'reset_confirm' => __('Do you want to reset all settings?', 'toolkit-for-learndash'),					
					'nonce' => wp_create_nonce('tkflld_update_options_nonce'),
                    'empty_settings' => empty($tkflld_options),
				)
			);
		}
	}
	
	
  
	
	add_action('admin_enqueue_scripts', 'tkflld_admin_enqueue_script');
	
	add_action('wp_enqueue_scripts', 'tkflld_wp_enqueue_script');
	
	
	
	function tkflld_wp_enqueue_script()
	{
		global $post, $tkflld_pro, $tkflld_url, $tkflld_options;
		
		$cic = array_key_exists('cic', $tkflld_options);
		$tkflld_relevant_page = (is_object($post) && in_array($post->post_type, array('sfwd-quiz')));
		$localize_handler = 'tkflld_front_scripts';
		//pree($post->post_content);
		//pree(stripos($post->post_content, '[tkflld]'));
		$details_view_sorting = array_key_exists('details_view_sorting', $tkflld_options);
		$selected_skin = (array_key_exists('skin', $tkflld_options) ? $tkflld_options['skin'] : 'default');
		wp_enqueue_style('selected-skin', plugins_url('skins/css/'.$selected_skin.'.css', dirname(__FILE__)), array(), time());


	
		if($tkflld_relevant_page || true){
			
			$is_bootstrap = array_key_exists('bootstrap', $tkflld_options);
			$is_file_upload = array_key_exists('file_upload', $tkflld_options);


	
	
			if($is_bootstrap){ 		
				wp_enqueue_script('tkflld_boostrap', plugin_dir_url(dirname(__FILE__)) . 'js/bootstrap.min.js');
				wp_enqueue_style('tkflld-boostrap', plugins_url('css/bootstrap.min.css', dirname(__FILE__)));
			}
			
			wp_enqueue_script('tkflld_front_scripts', plugin_dir_url(dirname(__FILE__)) . 'js/front-scripts.js?t='.time(), array('jquery'));
	
			$is_ajax_url = false;
			$is_ajax = false;
            wp_enqueue_style('fontawesome', plugins_url('css/fontawesome.min.css', dirname(__FILE__)));

            //wp_enqueue_script('tkflld_front_scripts', plugin_dir_url(dirname(__FILE__)) . 'js/front-scripts.js', array('jquery'));
			//wp_enqueue_style('tkflld-common', plugins_url('css/common-styles.css', dirname(__FILE__)));
			//wp_enqueue_style('tkflld-front', plugins_url('css/front-styles.css', dirname(__FILE__)), array(), date('Ymdhi'));
		

			wp_localize_script(
				$localize_handler,
				'tkflld',
				array(
				
					'tkflld_pro' => $tkflld_pro,
					'details_view_sorting' => $details_view_sorting,
					'tkflld_relevant_page' => $tkflld_relevant_page,
					'ajax_url' => admin_url('admin-ajax.php'),
					'this_url' => get_permalink(),
                    'del_confirm' => __('Do you want to delete this file?', 'toolkit-for-learndash'),
                    'select_file_alert' => __('Please select a file to delete.', 'toolkit-for-learndash'),
                    'not_belong_string' => __('Sorry, you can not delete this file.', 'toolkit-for-learndash'),
                    'is_ajax' => $is_ajax,
					'ld_lms_cic' => $cic,
					'ld_lms' => (function_exists('tkflld_get_question_answers')?tkflld_get_question_answers():array()),
					'is_ajax_url' => $is_ajax_url,
					'del_from_front' => array_key_exists('del_from_front', $tkflld_options),
					'nonce' => wp_create_nonce('tkflld_update_options_nonce'),
				)
			);
	
			
		}
	}
	
	if (is_admin()) {
		
		add_action('admin_menu', 'tkflld_menu');
	}
	function tkflld_menu()
	{

			global $tkflld_data, $tkflld_pro;
			
			$title = ($tkflld_data['Name'] . ' ' . ($tkflld_pro ? ' ' . __('Pro', 'toolkit-for-learndash') : ''));
			
		
			//
			if(defined('LEARNDASH_ADMIN_CAPABILITY_CHECK')){
				$title = trim(str_replace('for Learndash LMS', '', $title));
				add_submenu_page(
					'learndash-lms',
					$title,
					$title,
					LEARNDASH_ADMIN_CAPABILITY_CHECK,
					'tkflld',
					'tkflld_settings'
				);
			}else{
				add_options_page($title, $title, 'publish_pages', 'tkflld', 'tkflld_settings');
			}

	}
	
	if(!function_exists('tkflld_pre')){
		function tkflld_pre($data){
			if(isset($_GET['debug'])){
				tkflld_pree($data);
			}
		}	 
	} 	
	if(!function_exists('tkflld_pree')){
		function tkflld_pree($data){
				echo '<pre>';
				print_r($data);
				echo '</pre>';	
		
		}	 
	} 

	function tkflld_settings()
	{
		global $tkflld_premium_link, $tkflld_pro, $tkflld_url;
		$tkflld_options = get_option('tkflld_options', array());
		$tkflld_options = is_array($tkflld_options)?$tkflld_options:array();
		include_once('tkflld_settings.php');
	}	
	
	add_action('wp_ajax_tkflld_update_option', 'tkflld_update_option');
	
	if(!function_exists('tkflld_update_option')){
		function tkflld_update_option(){
	
	
	
			if(isset($_POST['tkflld_update_option_nonce'])){
	
				$nonce = $_POST['tkflld_update_option_nonce'];
	
				$return = array(
	
					'option_update' => false,
				);
	
				if ( ! wp_verify_nonce( $nonce, 'tkflld_update_options_nonce' ) )
					die (__("Sorry, your nonce did not verify.", 'toolkit-for-learndash'));
	
				if(isset($_POST['tkflld_options'])){
					
					global $tkflld_pro;
	
					$tkflld_options = isset($_POST['tkflld_options']) ? $_POST['tkflld_options'] : array();
	
	
					$sanitized_option = sanitize_tkflld_data($tkflld_options);
					
					//tkflld_pree($sanitized_option);
					if($tkflld_pro && function_exists('tkflld_process_options')){
						tkflld_process_options($sanitized_option);
						
					}
	
					$update = update_option('tkflld_options', $sanitized_option);
				}
	
	
	

	
				echo  json_encode($return);
	
			}
	
			wp_die();
	
		}
	}
	

	
	function tkflld_init_session() {
		if(!session_id()) {
			session_start();
		}
	}
	
	if(!function_exists('tkflld_plugin_links')){
		function tkflld_plugin_links($links) { 
			global $tkflld_premium_link, $tkflld_pro;
			
			$settings_link = '<a href="admin.php?page=tkflld">'.__('Settings', 'toolkit-for-learndash').'</a>';
			
			if($tkflld_pro){
				array_unshift($links, $settings_link); 
			}else{
				 
				$tkflld_premium_link = '<a href="'.esc_url($tkflld_premium_link).'" title="'.__('Go Premium', 'toolkit-for-learndash').'" target="_blank">'.__('Go Premium', 'toolkit-for-learndash').'</a>'; 
				array_unshift($links, $settings_link, $tkflld_premium_link); 
			
			}
			
			
			return $links; 
		}
	}
	add_action('wp_head', function(){
		
		$tkflld_options = get_option('tkflld_options', array());
		//pree($tkflld_options);
?>
	<style type="text/css">
		<?php if(array_key_exists('post_title', $tkflld_options)): ?>
		.entry-title{
			display:none !important;
		}
		<?php endif; ?>
		
		<?php if(array_key_exists('breadcrumbs', $tkflld_options)): ?>
		.single-sfwd-quiz .ld-breadcrumbs{
			display:none !important;
		}
		<?php endif; ?>
		
		<?php if(array_key_exists('postmeta', $tkflld_options)): ?>
		.single-sfwd-quiz .post-meta-wrapper, 
		.single-sfwd-quiz .post-meta{
			display:none !important;
		}
		<?php endif; ?>		
		
		<?php if(array_key_exists('pointer', $tkflld_options)): ?>
		.single-sfwd-quiz .learndash-wrapper .wpProQuiz_content .wpProQuiz_questionListItem label{
			cursor:pointer;
		}
		<?php endif; ?>
		
		<?php if(array_key_exists('start', $tkflld_options)): ?>
		input[name="startQuiz"].wpProQuiz_button{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('next', $tkflld_options)): ?>
		input[name="next"].wpProQuiz_button{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('back', $tkflld_options)): ?>
		input[name="back"].wpProQuiz_button{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('results', $tkflld_options)): ?>
		h4.wpProQuiz_header{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('view', $tkflld_options)): ?>
		input[name="reShowQuestion"].wpProQuiz_button{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('restart', $tkflld_options)): ?>
		input[name="restartQuiz"].wpProQuiz_button{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('print', $tkflld_options)): ?>
		.wpProQuiz_certificate{
			display:none !important;
		}
		<?php endif; ?>				
		<?php if(array_key_exists('continue', $tkflld_options)): ?>
		.quiz_continue_link{
			display:none !important;
		}
		<?php endif; ?>				
		
		
	</style>
<?php		
	});
	if(!function_exists('tkflld_skin_button_html')){
		function tkflld_skin_button_html(){
			global $tkflld_dir, $tkflld_url, $tkflld_options;

			

			$selected_skin = array_key_exists('skin', $tkflld_options) ? $tkflld_options['skin'] : 'default';
			$selected_sking_url = '';
			$file_name_selected = '';
			$file_name_selected = '';




			$skin_dir = $tkflld_dir.'/skins/img';

			if(file_exists($skin_dir)){
				
				$skin_img_files = scandir($skin_dir);

				$skin_img_files = array_filter($skin_img_files, function($value){

					return $value != '.' && $value  != '..';
				});

				$skin_img_files = array_values($skin_img_files);
				
			}

			?>

				<div class="row tkflld_skin_group">

					<div class="col-md-12 text-center mb-3">
						<h4 class="pt-0"><span class="text-success"><?php _e('Questions', 'toolkit-for-learndash') ?></span><span class="text-light"> > </span><span class="text-warning"><?php _e('Themes', 'toolkit-for-learndash') ?></span> <i class="fas fa-palette text-warning"></i></h4>
					</div>

					<div class="col-md-12 text-center btn_col mb-3">
						<div class="btn-group" role="group" aria-label="Basic example">

							<?php

								if(!empty($skin_img_files)){

									foreach ($skin_img_files as $file_index => $file_name) {
										# code...

										$file_url = $tkflld_url.'skins/img/'.$file_name;
										$file_name = basename($file_name);
										$file_name_actual = current(explode('.', $file_name));
										$file_name_view = ucfirst(strtolower($file_name_actual));

										$active_skin = '';
										if($selected_skin == $file_name_actual){

											$active_skin = 'tkflld_active';
											$selected_sking_url = $file_url;
											$file_name_selected = $file_name_view;
											$file_name_selected = $file_name_actual;
										}
										


										?>

											<button type="button" data-url="<?php echo $file_url; ?>" data-name="<?php echo $file_name_actual; ?>" class="btn btn-light <?php echo $active_skin; ?>"><?php echo $file_name_view; ?></button>

										<?php

										
									}
								}

							?>
						</div>
						<input type="hidden" name="tkflld_options[skin]" data-name="skin" value="<?php echo $file_name_selected; ?>" />
					
					</div>


					<div class="col-md-12 img_col px-5 text-center mb-5">

						<a target="_blank" href="<?php echo $selected_sking_url; ?>" class="preview" title="<?php echo $file_name_selected; ?>">
						<img src="<?php echo $selected_sking_url; ?>" class="rounded" alt="<?php echo $file_name_selected; ?>" />
                        </a>
					
					</div>
				
				
				</div>

			<?php


		}
	}
	
	function tkflld_learndash_quiz_content($quiz_content='', $quiz_post=array()){
		
		global $post;
		
		if(
				is_object($quiz_post) && in_array($quiz_post->post_type, array('sfwd-quiz')) 
			&& 
				!(is_object($post) && in_array($post->post_type, array('sfwd-quiz')))
		){
			$quiz_content .= '<script> var tkflld_ld_lms = {};  tkflld_ld_lms['.$quiz_post->ID.'] = '.(function_exists('tkflld_get_question_answers')?tkflld_get_question_answers($quiz_post, 'json'):array()).';</script>'; 
		}
		
		return $quiz_content;
		
	}
	
	add_filter('learndash_quiz_content', 'tkflld_learndash_quiz_content', 11, 2);
	
	function tkflld_get_quiz_statistic(){
		
		if(!class_exists('LDLMS_DB')){ return; }

		global $wpdb;

		$quiz_statistic_query = "SELECT qs.*, qr.* FROM ".LDLMS_DB::get_table_name( 'quiz_statistic' )." qs RIGHT JOIN ".LDLMS_DB::get_table_name( 'quiz_statistic_ref' )." qr ON qr.statistic_ref_id=qs.statistic_ref_id ORDER BY qs.statistic_ref_id DESC LIMIT 10";
		
		$quiz_statistic_results = $wpdb->get_results($quiz_statistic_query);
		
		if(!empty($quiz_statistic_results)){
			foreach($quiz_statistic_results as $quiz_statistic_result){
				pree($quiz_statistic_result);
			}
		}
		
	}
	
// JavaScript Document
jQuery(document).ready(function($){
	
	$('body').on('click', '.tkflld-reset', function(){
		var reset_confirmation = confirm(tkflld_ajax_object.reset_confirm);
		
		if(!reset_confirmation){
			return false;
		}
	});
	
	$('input[name^="tkflld_options"], select[name^="tkflld_options"]').on('change', function(){
		
		
		var tkflld_option_ajax = $('input[name^="tkflld_options"][value="ajax"]');
		var tkflld_option_ajax_url = $('input[name^="tkflld_options"][value="ajax_url"]');

		var tkflld_option_file_upload = $('input[name^="tkflld_options"][value="file_upload"]');
		var tkflld_option_current_user_files = $('input[name^="tkflld_options"][value="current_user_files"]');
		var tkflld_option_del_from_front = $('input[name^="tkflld_options"][value="del_from_front"]');

		if(tkflld_option_file_upload.prop('checked') == false){

			tkflld_option_current_user_files.prop('checked', false);
			tkflld_option_del_from_front.prop('checked', false);

		}


		if(tkflld_option_ajax.prop('checked') == false){

			tkflld_option_ajax_url.prop('checked', false);

		}

		var tkflld_option_checked = $('input[name^="tkflld_options"][type="checkbox"]:checked');
		var tkflld_option_text = $('input[name^="tkflld_options"][type="text"], input[name^="tkflld_options"][type="hidden"]');
		var tkflld_option_select = $('select[name^="tkflld_options"]');

		var tkflld_options_post = {};

		if(tkflld_ajax_object.empty_settings){

			tkflld_options_post['tkflld_options_update'] = true;

		}


			if(tkflld_option_select.length > 0 ){
				$.each(tkflld_option_select, function () {

					tkflld_options_post[$(this).data('name')] = $(this).val();

				});
			}


			if(tkflld_option_text.length > 0 ){
				$.each(tkflld_option_text, function () {

					tkflld_options_post[$(this).data('name')] = $(this).val();

				});
			}

			if(tkflld_option_checked.length > 0 ){
				$.each(tkflld_option_checked, function () {

					tkflld_options_post[$(this).val()] = true;

				});
			}
		
		var tkflld_option_colors = $('input[name^="tkflld_options"][type="color"]');

		if(tkflld_option_colors.length > 0 && !tkflld_ajax_object.empty_settings){
			$.each(tkflld_option_colors, function () {

				tkflld_options_post[$(this).attr('id')] = $(this).val();

			});
		}

		if(!tkflld_options_post.allowed_role){
			tkflld_options_post.allowed_role = 'empty';
		}


		var data = {

			action : 'tkflld_update_option',
			tkflld_update_option_nonce : tkflld_ajax_object.nonce,
			tkflld_options : tkflld_options_post,

		}
		$.blockUI({message:''});
		
		$.post(ajaxurl, data, function(code, response){

			//console.log(response);

			if(response == 'success'){

				$('.tkflld-options .alert').removeClass('d-none').addClass('show');
				setTimeout(function(){
					$('.tkflld-options .alert').addClass('d-none');
				}, 10000);

			}
			
			setTimeout(function(){
				$.unblockUI();
			}, 3000);
			document.location.reload();


		});
		

	});

	if(tkflld_ajax_object.empty_settings){

		$('input[name^="tkflld_options"]').change();

	}




	$('.tkflld_skin_group .btn_col .btn').on('click', function(e){
		e.preventDefault();

		var btn_group = $(this).parents('.btn-group');
		var parent_row = $(this).parents('.row.tkflld_skin_group');
		
		var all_btn = btn_group.find('.btn');
		all_btn.removeClass('tkflld_active');
		$(this).addClass('tkflld_active');

		var file_name = $(this).data('name');
		var file_url = $(this).data('url');

		var hidden_input = parent_row.find('input[type="hidden"]');
		var img_display = parent_row.find('img');
		img_display.prop('src', file_url);
		hidden_input.val(file_name);
		hidden_input.change();

	});

	$('body').on('click', '.tkflld_settings .nav-tab-wrapper a.nav-tab', function(){
			
		var tab_data = $(this).data('tab');
		if($('.nav-tab-content.tab-'+tab_data).length>0){
			$('.nav-tab-content').hide();
			$(this).siblings().removeClass('nav-tab-active');
			$(this).addClass('nav-tab-active');

			$('.nav-tab-content.tab-'+tab_data).removeClass('hides').show();
			
			
		}
	});


	
});
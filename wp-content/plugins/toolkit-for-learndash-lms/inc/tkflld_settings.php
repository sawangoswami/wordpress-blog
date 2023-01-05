<style type="text/css">
	.notice.notice-error,
	.error.notice{
		display:none;
	}
	#wpcontent{
		background-color:#2c3338;
	}
</style>

<div class="wrap tkflld-wrapper">

<?php
    global $tkflld_url, $wp_docs_tabs, $tkflld_sfwd_lms, $tkflld_pro, $tkflld_options;
	


	$ci = array_key_exists('ci', $tkflld_options);
	$cic = array_key_exists('cic', $tkflld_options);
	




	
	$tkflld_nonce = wp_create_nonce( 'tkflld-tkflld' );
	
?>	
    <div class="row tkflld_settings">
        <div class="col-12"><?php echo __('Toolkit', 'toolkit-for-learndash').($tkflld_pro?' '.__('Pro', 'toolkit-for-learndash'):''); ?> <?php echo ($tkflld_sfwd_lms?'<i class="fas fa-link" style="color:#0C0"></i>':'<i class="fas fa-unlink" style="color:#F00"></i>'); ?>
            
       <a class="btn btn-sm btn-danger tkflld-reset" style="width: 76px !important;margin: 0 !important;padding: 0 !important; float:right;" title="<?php _e('Click here to reset everything', 'toolkit-for-learndash'); ?>" href="<?php echo admin_url('admin.php?page=tkflld&clear&tkflld_wpnonce='.esc_attr($tkflld_nonce)); ?>">
            <i class="fa fa-times-circle"></i>&nbsp;&nbsp;<?php _e('Reset', 'toolkit-for-learndash'); ?>
		</a>
        
		<?php if(!$tkflld_pro): ?>
        <a class="btn btn-warning btn-sm"  style="width: 100px !important;margin: 0 20px 0 0 !important;padding: 0 !important; float:right;" href="<?php echo esc_url($tkflld_premium_link); ?>" target="_blank" title="<?php echo __('Click here for Premium Version', 'toolkit-for-learndash'); ?>"><?php echo __('Go Premium', 'toolkit-for-learndash'); ?></a>
        <?php endif; ?>
   		</div>                 
   <div class="alert alert-secondary fade in alert-dismissible d-none mx-auto mt-4" style="width: 98%">
    <button type="button" class="close" data-dismiss="alert" aria-label="<?php echo __('Close', 'toolkit-for-learndash'); ?>">
    <span aria-hidden="true" style="font-size:20px">×</span>
    </button>    <strong><?php echo __('Success!', 'toolkit-for-learndash'); ?></strong> <?php echo __('Options are updated successfully.', 'toolkit-for-learndash'); ?>
    </div>                         
        
    <h2 class="nav-tab-wrapper">

            <a class="nav-tab nav-tab-active" data-tab="general-settings"><?php _e("General Settings",'toolkit-for-learndash'); ?> <i class="fas fa-tools"></i></a>
            
            <a class="nav-tab" data-tab="premium-features"><?php _e("Premium Features",'toolkit-for-learndash'); ?> <i class="far fa-edit"></i></a>
            
            <a class="nav-tab" data-tab="themes"><?php _e("Themes",'toolkit-for-learndash'); ?> <i class="fas fa-palette"></i></a>
            
            <a class="nav-tab" data-tab="exports"><?php _e("Export/Reports",'toolkit-for-learndash'); ?> <i class="fas fa-sign-in-alt"></i></a>
            
            <a class="nav-tab" data-tab="help"><?php _e("Help",'toolkit-for-learndash'); ?> <i class="fas fa-question-circle"></i></a>
            
	</h2>            
    
    <form class="nav-tab-content tab-general-settings" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post">
    <input type="hidden" name="wos_tn" value="<?php echo isset($_GET['t'])?esc_attr($_GET['t']):'0'; ?>" />
    
    <?php wp_nonce_field( 'tkflld_settings_action', 'tkflld_settings_field' ); ?>

        

    
    


        
        <div class="row nopadding tkflld-options">
        
        
        
        
        
        <ul class="col col-md-12 mt-4">
        
        
        
        <li>
            <ul class="col col-md-12 mt-4">
            
        
            <li>
                <label for="tkflld_options_post_title">
                    <input <?php checked(array_key_exists('post_title', $tkflld_options)); ?> type="checkbox" name="tkflld_options[post_title]" value="post_title" id="tkflld_options_post_title"  />
                    <?php echo __('Hide Post Title', 'wp-docs'); ?> <i class="fas fa-hand-pointer"></i>
                </label>
        
            </li> 
            <li>
                <label for="tkflld_options_postmeta">
                    <input <?php checked(array_key_exists('postmeta', $tkflld_options)); ?> type="checkbox" name="tkflld_options[postmeta]" value="postmeta" id="tkflld_options_postmeta"  />
                    <?php echo __('Hide Post meta/Author meta', 'wp-docs'); ?>
                </label>
        
            </li>        
            <li>
                <label for="tkflld_options_breadcrumbs">
                    <input <?php checked(array_key_exists('breadcrumbs', $tkflld_options)); ?> type="checkbox" name="tkflld_options[breadcrumbs]" value="breadcrumbs" id="tkflld_options_breadcrumbs"  />
                    <?php echo __('Hide Breadcrumbs', 'wp-docs'); ?>
                </label>
        
            </li>
            
             <li>
                <label for="tkflld_options_pointer">
                    <input <?php checked(array_key_exists('pointer', $tkflld_options)); ?> type="checkbox" name="tkflld_options[pointer]" value="pointer" id="tkflld_options_pointer"  />
                    <?php echo __('Cursor Pointer for Question List Item', 'wp-docs'); ?>
                </label>
        
            </li>   
            
             <li>
                <label for="tkflld_options_back">
                    <input <?php checked(array_key_exists('back', $tkflld_options)); ?> type="checkbox" name="tkflld_options[back]" value="back" id="tkflld_options_back"  />
                    <?php echo __('Hide Back Button', 'wp-docs'); ?>
                </label>
        
            </li>    
             <li>
                <label for="tkflld_options_next">
                    <input <?php checked(array_key_exists('next', $tkflld_options)); ?> type="checkbox" name="tkflld_options[next]" value="next" id="tkflld_options_next"  />
                    <?php echo __('Hide Next/Finish Button', 'wp-docs'); ?>
                </label>
        
            </li>                        
        
             <li>
                <label for="tkflld_options_start">
                    <input <?php checked(array_key_exists('start', $tkflld_options)); ?> type="checkbox" name="tkflld_options[start]" value="start" id="tkflld_options_start"  />
                    <?php echo __('Hide Start Button', 'wp-docs'); ?>
                </label>
        
            </li>                        
                        
        
             <li>
                <label for="tkflld_options_restart">
                    <input <?php checked(array_key_exists('restart', $tkflld_options)); ?> type="checkbox" name="tkflld_options[restart]" value="restart" id="tkflld_options_restart"  />
                    <?php echo __('Hide Restart Quiz Button', 'wp-docs'); ?>
                </label>
        
            </li>                        
        
             <li>
                <label for="tkflld_options_view">
                    <input <?php checked(array_key_exists('view', $tkflld_options)); ?> type="checkbox" name="tkflld_options[view]" value="view" id="tkflld_options_view"  />
                    <?php echo __('Hide View Questions Button', 'wp-docs'); ?>
                </label>
        
            </li>  
            
             <li>
                <label for="tkflld_options_continue">
                    <input <?php checked(array_key_exists('continue', $tkflld_options)); ?> type="checkbox" name="tkflld_options[continue]" value="continue" id="tkflld_options_continue"  />
                    <?php echo __('Hide Continue Button', 'wp-docs'); ?>
                </label>
        
            </li>  
            
             <li>
                <label for="tkflld_options_print">
                    <input <?php checked(array_key_exists('print', $tkflld_options)); ?> type="checkbox" name="tkflld_options[print]" value="print" id="tkflld_options_print"  />
                    <?php echo __('Hide Print Certificate Button', 'wp-docs'); ?>
                </label>
        
            </li>  
            
            
             <li>
                <label for="tkflld_options_results">
                    <input <?php checked(array_key_exists('results', $tkflld_options)); ?> type="checkbox" name="tkflld_options[results]" value="results" id="tkflld_options_results"  />
                    <?php echo __('Hide Results Heading/Text', 'wp-docs'); ?>
                </label>
        
            </li>                                                
            
                   
            </ul>
            
        </li>
        
            
        </ul>
        
        
        

        </div>

	</form>
    
    <form class="nav-tab-content tab-premium-features" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" style="display:none">
    <input type="hidden" name="wos_tn" value="<?php echo isset($_GET['t'])?esc_attr($_GET['t']):'0'; ?>" />
    
		<ul class="col col-md-12 mt-4">
        <li>
            <label for="tkflld_options_ci_correct">
                <input <?php echo $ci_status = checked($cic, true, false); ?> type="checkbox" name="tkflld_options[cic]" value="cic" id="tkflld_options_ci_correct"  />
                <?php echo __('Maintain upper or lower case as entered in editor when a user clicks on View Questions Button', 'toolkit-for-learndash'); ?> <br /><br />                
            </label>
            
            <?php if($cic): ?>
            <img src="<?php echo $tkflld_url; ?>img/cic-example.png?<?php echo time(); ?>" />
            <?php else: ?>
            <img src="<?php echo $tkflld_url; ?>img/cic-example-1.png?<?php echo time(); ?>" />
            <?php endif; ?>
        
            <br /><br />
        </li>   
        
           
        <li>
            <label for="tkflld_options_ci">
                <input <?php echo $ci_status = checked($ci, true, false); ?> type="checkbox" name="tkflld_options[ci]" value="ci" id="tkflld_options_ci"  />
                <?php echo __('Force case sensitivity when a user answers Fill in the blank (cloze_answer)', 'toolkit-for-learndash'); ?> <br /><br />
                
                
                <?php if($ci): ?>
                <img src="<?php echo $tkflld_url; ?>img/ci-example.png?<?php echo time(); ?>" />
                <img src="<?php echo $tkflld_url; ?>img/ci-example-2.png?<?php echo time(); ?>" />
                <?php else: ?>
                <img src="<?php echo $tkflld_url; ?>img/ci-example-1.png?<?php echo time(); ?>" />            
                <?php endif; ?>
                
                <br /><br />
                
                <div class="examples">
                <strong><?php echo __('Examples', 'toolkit-for-learndash'); ?>:</strong>
                <ul>
                    <li> <?php echo __('Is everything OK?', 'toolkit-for-learndash'); ?> <span style="color:#FF0"><?php echo $ci_status?'!=':'=='; ?></span> <?php echo __('is everything ok?', 'toolkit-for-learndash'); ?> <i <?php echo $ci_status?'class="fas fa-times-circle" style="color:#F00"':' class="fas fa-check-circle" style="color:#0C0"'; ?>></i></li>
                    <li>AND</li>
                    <li><?php echo __('Is everything OK?', 'toolkit-for-learndash'); ?>  <span style="color:#FF0">==</span> <?php echo __('Is everything OK?', 'toolkit-for-learndash'); ?> <i class="fas fa-check-circle" style="color:#0C0"></i></li>
                </ul>
                </div>    
            </label>
        
        </li>   
        
        
        
            
        </ul>    
	</form>    
    
	<form class="nav-tab-content tab-themes" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" style="display:none">
    <input type="hidden" name="wos_tn" value="<?php echo isset($_GET['t'])?esc_attr($_GET['t']):'0'; ?>" />
    
		<ul class="col col-md-12 mt-4">
        
        
        
        <li>
                <?php
                
                    if(function_exists('tkflld_skin_button_html')){tkflld_skin_button_html();}
                
                ?>
        
        
        </li>
    	</ul>
	</form>
    
	<form class="nav-tab-content tab-exports" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" style="display:none">
    <input type="hidden" name="wos_tn" value="<?php echo isset($_GET['t'])?esc_attr($_GET['t']):'0'; ?>" />
    
		<ul class="col col-md-12 mt-4">
        
        
        
        <li>
               <?php tkflld_get_quiz_statistic(); ?>
        
        
        </li>
    	</ul>
	</form>    
        
    <form class="nav-tab-content tab-help" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" style="display:none">
    <input type="hidden" name="wos_tn" value="<?php echo isset($_GET['t'])?esc_attr($_GET['t']):'0'; ?>" />
        
        <div class="row text-center">
        <a class="btn btn-secondary btn-sm mx-auto w-25 m-4" href="http://demo.wethebrains.com/courses/product-development" target="_blank" title="<?php echo __('Click here for demo', 'toolkit-for-learndash'); ?>"><?php echo __('Click here for demo', 'toolkit-for-learndash'); ?></a>
        </div>
        
        
        <?php if(date('Y')>2021 && date('d')%3==0): ?>
        <ul class="col col-md-12 mt-4">
        <li class="promotions"></li>
        <li style="text-align:center;">
        <a href="https://wordpress.org/plugins/gulri-slider" target="_blank" title="<?php echo __('Image Slider', 'toolkit-for-learndash'); ?>"><img src="<?php echo $tkflld_url; ?>img/gslider.gif" /></a>
        </li>
        </ul>
        <?php endif; ?>
	</form>
    
</div>


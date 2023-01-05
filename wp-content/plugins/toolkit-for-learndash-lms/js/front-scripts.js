// JavaScript Document
jQuery(document).ready(function($){
	$('body').on('click', 'input.wpProQuiz_button_reShowQuestion', function(){
		var quiz_post_obj = jQuery('.wpProQuiz_button_reShowQuestion').closest('.wpProQuiz_content').data('quiz-meta');
		var quiz_post_id = quiz_post_obj.quiz_post_id;
		var quiz_answers_obj = (tkflld.tkflld_relevant_page==true?tkflld.ld_lms:tkflld_ld_lms[quiz_post_id]);
		if(tkflld.ld_lms_cic==true && Object.keys(quiz_answers_obj).length>0){		
			var q = 0;
			$.each(quiz_answers_obj, function(question_id, answer_str){
				var question_obj = 'ul.wpProQuiz_questionList[data-question_id="'+question_id+'"]';
				if($(question_obj).length>0){
					if($(question_obj).find('span.wpProQuiz_clozeCorrect').length>1){
						if(answer_str.length>0){
							$.each(answer_str, function(i, v){ 
								$(question_obj).find('span.wpProQuiz_clozeCorrect').eq(i).html('('+v+')');
							});						
						}
					}else{
						$(question_obj).find('span.wpProQuiz_clozeCorrect').html('('+answer_str+')');
					}
					q++;
				}
				
			});
		}
	});
});
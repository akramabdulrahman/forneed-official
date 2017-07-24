


jQuery(document).ready(function() {    
  

   

	
	$('body').on('click','.remove-answer',function(){
	 $(this).closest('.form-group').remove(); 
	});
	
	$('body').on('click','.remove-question',function(){
	 $(this).closest('.question_container').remove(); 
	});
	
	$('body').on('click','.add-answer',function(){
	 $(this).closest('.form-group').after('<div class="form-group"><div class="input-group"><input type="text" class="form-control" placeholder="answer text" name="answer[]"><span class="input-group-btn"><button class="btn red remove-answer" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button></span></div></div>'); 
	});
	
	$('#new-question').click(function(){
	 $('.question_container').last().after('<div class="portlet light portlet-fit bordered question_container"><div class="portlet-body"> <div class="form-group"> <label class="control-label">Question Text</label> <div class="input-group"><input type="text" class="form-control" placeholder="Enter Question text" name="question[]"> <span class="input-group-btn"><button class="btn red remove-question" type="button"><i class="fa fa-minus" aria-hidden="true"></i></button></span></div> </div>  <div class="form-group"> <label class="control-label">Answer</label><div class="input-group"> <input type="text" class="form-control" placeholder="answer text" name="answer[]"> <span class="input-group-btn"><button class="btn blue add-answer" type="button"><i class="fa fa-plus" aria-hidden="true"></></button></span></div></div></div></div>'); 
	});
	
	
   
});
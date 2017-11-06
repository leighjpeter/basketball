var __ROOT__ = 'http://127.0.0.1/baksetball/index.php/admin/';
$(document).ready(function(){
	$("#upload").click(function(){
		var options = {
				url: __ROOT__+'index/saveData',
				type: 'POST',
		        dataType: 'json',
		        target: null,
		        beforeSubmit:'', 
		        success: ajaxSuccess, 
		        resetForm: false,
		        clearForm: false
		    };
			$('#tijiao_form').ajaxSubmit(options);
	        		return false;
			function ajaxSuccess(response){	
				alert(response.info);
				window.location.reload();
			}
	})
	
	addAction();
});

var addAction = function(){
	$("#address").change(function(){
		var options = {
				url: __ROOT__+'index/upload',
				type: 'POST',
		        dataType: 'json',
		        target: null,
		        beforeSubmit:'', 
		        success: ajaxSuccess, 
		        resetForm: false,
		        clearForm: false
		    };

	        $("#upload_form").ajaxSubmit(options);
	        return false;

		function ajaxSuccess(response){
			if(response.status == 1){
				$("#msg").html("上传"+response.data+"条记录");
				$("#filename").val(response.info);
			}else{
				alert(response.info);
			}			
		}
	});
}
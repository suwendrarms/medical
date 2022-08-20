setInterval(function() {
    //your jQuery ajax code
  //  console.log('done');
    var formData = new FormData();
    formData.append('id', 1);
		
			 $.ajaxSetup({
			   headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			   }
			 });
 
 
			 $.ajax({
				url : '/notification',
				method : 'POST',
				data : formData,
				processData: false,  
				contentType: false, 
				success : function(data) {
					//console.log(data);
                    if(data.accept!=0){
                        $('#prescriptions_show').removeClass('d-none');
						$('#prescriptions_show_id').removeClass('d-none');
                        
                    }if(data.reject!=0){
						$('#prescriptions_show').removeClass('d-none');
						$('#prescriptions_show_id').removeClass('d-none');

					}
                   
					if(data == 'success'){
						 $.alert({
							 title: 'Success',
							 content: 'Successfully deleted',
							 type: '',
						 });
						 //row.hide();
					}
									
				}
					 
			 });
  }, 1000 * 60 * 0.1);
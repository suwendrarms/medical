@extends('layouts.ui.web',['activePage'=>'showcase'])
@section('content')
<div class="card card-custom">
	<!-- <div class="card-header flex-wrap border-0 pt-6 pb-0"> -->
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
    @endif
        <form class="form" method="post" action="{{route('prescriptions.uploadImages')}}" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <div class="col-lg-12">
                    <label>Note:</label>
                    <textarea class="form-control form-control-solid" name="note" id="" cols="20" rows="5" required></textarea>
                </div>
            </div>

            <div  class="form-group row">
           <div class="col-lg-4">      
           <label>Delivery Address Line 1:</label>
                    <input type="text" name="address1" class="form-control" placeholder="Enter Line 1" required/>
           </div>
           <div class="col-lg-4">      
           <label>Delivery Address Line 2:</label>
                    <input type="text" name="address2" class="form-control" placeholder="Enter Line 2" required/>
           </div>
           <div class="col-lg-4">
           <label>Delivery Address Line 3:</label>
                    <input type="text" name="address3" class="form-control" placeholder="Enter Line 3" required/>
           </div>
        </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Delivery Date:</label>
                    <input type="date" name="date" onChange="getTimeSlot()" id="element_id" class="form-control" placeholder="Enter name" required/>
                </div>
                <div id="endtime" class="col-lg-6">
                    <label>Time Slot:</label>
                    <select class="form-control" id="drug_id" name="slot" required>
                                                          
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-6">
                    <label>Images</label><span style="width: 108px;"><span class="label label-lg font-weight-bold label-light-success label-inline">can use maximum five images</span></span>
                    <div>

                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="image[]" accept=".png, .jpg, .jpeg" required multiple/>
                        <label class="custom-file-label" for="customFile">Choose Images</label>
                    </div>
                </div>
            </div>

            <br><br>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button type="reset" class="btn btn-secondary">Cancel</button>
            </div>
            </form>
        </div>
</div>
@endsection
@section('css')
<style>
    #customFile .custom-file-control:lang(en)::after {
  content: "Select file...";
}

#customFile .custom-file-control:lang(en)::before {
  content: "Click me";
}
</style>
@endsection
@section('js')
<script src="{{ asset('ui/web/js/pages/crud/forms/widgets/tagify.js') }}"></script>
<script src="{{ asset('ui/web/js/pages/crud/forms/widgets/form-repeater.js') }}"></script>
<script>
    // document.getElementById('element_id').onchange = function(val) {
  
    //     console.log(val);

    // };

    function getTimeSlot(){
        var date =document.getElementById('element_id').value;
        var formData = new FormData();

		   formData.append('date', date);
	  
		   $.ajaxSetup({
			 headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			 }
		   });


		   $.ajax({
			  url : '/find/time-slot',
			  method : 'POST',
			  data : formData,
			  processData: false,  
			  contentType: false, 
			  success : function(data) {
				  console.log(data.accept.length);

                  if(data.accept.length>0){

                    $.each(data.accept, function (key, val) {
                           console.log(val);
                           $('#drug_id').append('<option value="'+val.slot+'">'+val.slot+'</option>');
                    });

                  }else{
                    $('#drug_id').html('');
                    $.alert({
						   title: 'Message',
						   content: 'No available time slots',
						   type: '',
					   });
                  }
								  
			  }
				   
		   });
    }
</script>

@endsection
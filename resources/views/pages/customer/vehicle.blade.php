@extends('layouts.ui.web',['activePage'=>'customer'])
@section('content')
<div class="card card-custom" style="min-height: 700px;">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
		<div class="card-title">
			<h3 class="card-label">Customer List
			<span class="d-block text-muted pt-2 font-size-sm"></span></h3>
		</div>
		<div class="card-toolbar">
			<!--begin::Dropdown-->
			<div class="dropdown dropdown-inline mr-2">
			</div>
											
			<!-- <a href="{{route('dealars.create')}}" class="btn btn-primary font-weight-bolder">
				<span class="svg-icon svg-icon-md">
					
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<circle fill="#000000" cx="9" cy="15" r="6" />
					<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
					</g>
					</svg>
				
					</span>New Record
			</a>			 -->
		</div>
	</div>
	<div class="card-body">
										
		<div class="mb-7">
			<div class="row align-items-center">
				<div class="col-lg-3 col-xl-4">
													<!-- <div class="row align-items-center">
														<div class="col-md-12 my-2 my-md-0">
															<div class="input-icon">
																<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
																<span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
															</div>
														</div>				
													</div> -->
				</div>
				<div class="col-lg-9 col-xl-8 mt-5 mt-lg-0">
					<div class="row align-items-center">
						<div class="col-md-10 my-2 my-md-0">
							<div class="input-icon">
								<input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
								<span>
								<i class="flaticon2-search-1 text-muted"></i>
								</span>
							</div>
						</div>
						<a href="#" class="btn btn-light-primary px-6 font-weight-bold">Search</a>				
					</div>
													
				</div>
			</div>
		</div>
									
		<table class="datatable datatable-bordered datatable-head-custom" id="kt_datatable">
			<thead>
			    <tr>
					<th title="Field #1">No</th>
					<th title="Field #2">Name</th>
					<th title="Field #3">Phone Number</th>
					<th title="Field #3">Vehicle Number</th>				
					<th title="Field #7">Verify Vehicle</th>
				</tr>
			</thead>
		<tbody>
            @foreach($vehicle as $as=>$customer)
            <tr>
                <td>{{$as+1}}</td>
                <td>{{$customer->customer_name}}</td>
                <td>{{$customer->phone}}</td>
				<td>{{$customer->vehicle_no}}</td>
                <td>
				<a href="javascript:void(0);" class="btn btn-outline-danger font-weight-bold add-trash" data-id="{{$customer->id}}">Verify</a>
				<a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon add-trash-data" data-id="{{$customer->id}}"><i class="la la-trash"></i></a>
				<a href="#" data-toggle="modal" data-target="#kt_select_modal" class="btn btn-sm btn-clean btn-icon edit-vehicle" data-id="{{$customer->id}}" data-ve="{{$customer->vehicle_no}}" aria-expanded="true"><i class="la la-edit"></i></a>
			    </td>
            </tr>
            @endforeach					
	    </tbody>
	    </table>
		<!--end: Datatable-->
	</div>						
</div>

<div class="modal fade" id="kt_select_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Edit Vehicle Number</h5>
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i aria-hidden="true" class="ki ki-close"></i>
				</button> -->
			</div>

			<form class="form" method="post" action="{{route('vehicle.edit')}}">
              @csrf
			 	<input type="hidden" class="" id="cus_id" name="cus_id">

				<div class="modal-body">

					<div class="form-group row">
						<label class="col-form-label text-right col-lg-3 col-sm-12">Vehicle Number</label>
						<div class="col-lg-9 col-md-9 col-sm-12">
							<input type="text" class="form-control" name ="ve_id" id="ve_id" />						
						</div>
					</div>
                </div>
				
				<div class="modal-footer">
					<a href="{{route('customer.vehicle')}}" type="button" class="btn btn-primary mr-2">Close</a>
					<button type="submit" class="btn btn-secondary">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('footer')

	@include('includes.footer')

@endsection

@section('js')

<script src="{{ asset('ui/web/js/pages/crud/ktdatatable/base/html-table.js') }}"></script>
<script>
$(document).on('click', '.add-trash', function() {
  
  var content_id = $(this).attr('data-id');
 
  //var row = $(this).closest("tr");
  console.log(content_id);
  //console.log(status);
 
   $.confirm({
     title: 'Are you sure?',
     content: 'you want to change this',
     buttons: {
        confirm: function () {

           var formData = new FormData();

           formData.append('id', content_id);
      
           $.ajaxSetup({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
           });


           $.ajax({
              url : '/verify-customer-vehicle',
              method : 'POST',
              data : formData,
              processData: false,  
              contentType: false, 
              success : function(data) {
                  
                if(data == 'success'){
						 $.alert({
							 title: 'Success',
							 content: 'successfully Verified',
							 type: '',
						 });
						 location.reload();
					 }
                                  
              }
                   
           });
       
        },
        cancel: function () {

        },
     }
 }); 

});

$(document).on('click', '.add-trash-data', function() {
  
  var content_id = $(this).attr('data-id');
 
  //var row = $(this).closest("tr");
  console.log(content_id);
  //console.log(status);
 
   $.confirm({
     title: 'Are you sure?',
     content: 'you want to change this',
     buttons: {
        confirm: function () {

           var formData = new FormData();

           formData.append('id', content_id);
      
           $.ajaxSetup({
             headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
           });


           $.ajax({
              url : '/delete-customer-vehicle',
              method : 'POST',
              data : formData,
              processData: false,  
              contentType: false, 
              success : function(data) {
                  
                if(data == 'success'){
						 $.alert({
							 title: 'Success',
							 content: 'successfully Verified',
							 type: '',
						 });
						 location.reload();
					 }
                                  
              }
                   
           });
       
        },
        cancel: function () {

        },
     }
 }); 

});

$(document).on('click', '.edit-vehicle', function() {
  
  var id = $(this).attr('data-id');
  var ve = $(this).attr('data-ve');

  $('#cus_id').val(id);
  $('#ve_id').val(ve);

});

</script>
@endsection
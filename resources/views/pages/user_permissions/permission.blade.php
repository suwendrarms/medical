@extends('layouts.ui.web',['activePage'=>'insurance'])
@section('content')
<div class="card card-custom" style="min-height: 700px;">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
		<div class="card-title">
			<h3 class="card-label">Permission
			<span class="d-block text-muted pt-2 font-size-sm"></span></h3>
		</div>
		<div class="card-toolbar">
			<!--begin::Dropdown-->
			<div class="dropdown dropdown-inline mr-2">
			</div>
											
			<a href="#" data-toggle="modal" data-target="#kt_select_modal" class="btn btn-primary font-weight-bolder">
				<span class="svg-icon svg-icon-md">
					<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
					<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
					<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<rect x="0" y="0" width="24" height="24" />
					<circle fill="#000000" cx="9" cy="15" r="6" />
					<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
					</g>
					</svg>
					<!--end::Svg Icon-->
			        </span>New Record
			</a>			
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
				<th title="Field #1">#</th>
				<th title="Field #2">Name</th>
				<th title="Field #7">Action</th>
			</tr>
			</thead>
		<tbody>
		@if($permissions)
			@foreach($permissions as $as=>$permission)
			<tr>
				<td>{{$as+1}}</td>
				<td>{{$permission->name}}</td>
				
				<td>
                                        <a href="#" data-toggle="modal" data-id="{{$permission->id}}" data-name="{{$permission->name}}" data-target="#kt_select_modal_edit" class="btn btn-sm btn-clean btn-icon show-m"  aria-expanded="true"><i class="la la-edit"></i></a>
													
                                        <a href="javascript:void(0);" class="btn btn-sm btn-clean btn-icon add-trash" data-id="{{$permission->id}}"><i class="la la-trash"></i></a>			
				</td>

			</tr>
			@endforeach
		@endif									
                </tbody>
                </table>
		<!--end: Datatable-->
	</div>						
</div>

<div class="modal fade" id="kt_select_modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Permission</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
                        <form class="form" method="post" action="{{route('permission.add')}}">
                        @csrf
                        <div class="card-body">
                                <div class="form-group">
                                <label>Permission Name:</label>
                                <input type="text" name="name" class="form-control form-control-solid" placeholder="Enter permission name" required/>
                        
                                </div>     
                        
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('permission.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                        </div>
                        </form>
		</div>
	</div>
</div>

<div class="modal fade" id="kt_select_modal_edit" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title">Edit Permission</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				</button>
			</div>
                        <form class="form" method="post" action="{{route('permission.update')}}">
                        @csrf
                        <div class="card-body">
                                <input type="hidden" name="perm_id" id="perm_id">
                                <div class="form-group">
                                <label>Permission Name:</label>
                                <input type="text" name="name" id ="name" class="form-control form-control-solid" placeholder="Enter permission name" required/>
                        
                                </div>     
                        
                                <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <a href="{{route('permission.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
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
  var row = $(this).closest("tr");
  console.log(content_id);

   $.confirm({
     title: 'Are you sure?',
     content: 'you want to delete this',
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
                          url : '/permission/remove',
                          method : 'POST',
                          data : formData,
                          processData: false,  
                          contentType: false, 
                          success : function(data) {
                                  
                                   if(data == 'success'){
                                           $.alert({
                                                   title: 'Success',
                                                   content: 'Successfully deleted',
                                                   type: '',
                                           });
                                           row.hide();
                                   }
                                                                  
                          }
                                   
                   });
           
            },
            cancel: function () {

            },
     }
}); 

});

$(document).on('click', '.show-m', function() {
  
  var id = $(this).attr('data-id');
  var name = $(this).attr('data-name');

  $('#name').val(name);
  $('#perm_id').val(id);

});
</script>
@endsection
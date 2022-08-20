@extends('layouts.ui.web',['activePage'=>'insurance'])
@section('content')
<div class="card card-custom">
	<!-- <div class="card-header flex-wrap border-0 pt-6 pb-0"> -->
        <form class="form" method="post" action="{{route('role.update',$role->id)}}">
        @csrf
        <div class="card-body">
        <input type="hidden" name="role_id" value="{{$role->id}}">
        <div class="form-group">
        <label>Role Name:</label>
        <input type="text" name="name" value="{{$role->name}}" class="form-control form-control-solid" placeholder="Enter role name" required/>      
        </div>

        <div class="form-group row">
            <label class="col-form-label text-right col-lg-3 col-sm-12">Select Permissions</label>
                <div class=" col-lg-4 col-md-9 col-sm-12">
                    <select class="form-control select2" id="kt_select2_3" name="param[]" multiple="multiple" required>
                    @foreach($permissions as $key=>$perm)
                    <option value="{{$perm->id}}" @if (in_array($perm->id, $data)) {{"selected"}} @endif>{{$perm->name}}</option>
                    
                    @endforeach                                  
                    </select>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{route('role.index')}}" class="btn btn-secondary">Cancel</a>
        </div>
        </form>

</div>
@endsection
@section('js')
<script src="{{ asset('ui/web/js/pages/crud/forms/widgets/select2.js')}}"></script>
@endsection
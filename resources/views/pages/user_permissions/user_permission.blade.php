@extends('layouts.ui.web',['activePage'=>'insurance'])
@section('content')
<div class="card card-custom">
	<!-- <div class="card-header flex-wrap border-0 pt-6 pb-0"> -->
        <form class="form" method="post" action="{{route('user.role.add')}}">
        @csrf
        <div class="card-body">

       
        <div class="form-group row">
            <label class="col-form-label text-right col-lg-3 col-sm-12">Select Customer</label>
            <div class=" col-lg-4 col-md-9 col-sm-12">
            <select class="form-control select2" id="kt_select2_1" name="user" required>
            @foreach($users as $key=>$user)
            <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
            </select>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label text-right col-lg-3 col-sm-12">Select Roles</label>
                <div class=" col-lg-4 col-md-9 col-sm-12">
                    <select class="form-control select2" id="kt_select2_3" name="roles[]" multiple="multiple" required>
                    @foreach($roles as $key=>$role)
                    <option value="{{$role->id}}">{{$role->name}}</option>
                    @endforeach
                                    
                    </select>
                </div>
            </div>
        </div>
        
        <div class="card-footer">
        <button type="submit" class="btn btn-primary mr-2">Submit</button>
        <a href="{{route('permission.user')}}" class="btn btn-secondary">Cancel</a>
        </div>
        </form>

</div>
@endsection
@section('js')
<script src="{{ asset('ui/web/js/pages/crud/forms/widgets/select2.js')}}"></script>
@endsection
@extends('layouts.ui.web',['activePage'=>'customer'])
@section('content')
<div class="card card-custom" style="min-height: 700px;">
	<div class="card-header flex-wrap border-0 pt-6 pb-0">
		<div class="card-title">
			<h3 class="card-label">
			<span class="d-block text-muted pt-2 font-size-sm"></span></h3>
        </div>

    </div>
	<div class="card-body">
		<h1><center><font color="red">Welcome {{Auth::user()->name}} !!</font></center></h1>
</div>
</div>
@endsection

@section('footer')

	@include('includes.footer')

@endsection
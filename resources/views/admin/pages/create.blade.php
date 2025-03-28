@extends('layouts.app')
@section('style')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.css') }}">
    <style type="text/css">
    .parsley-errors-list {
        list-style: none;
        color: rgb(248, 0, 0)
    }
        .swal-button {
            background-color: #242a2c;
        }
        </style>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@stop
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					@if ($errors->any())
						<!--<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>-->
					@endif

<form class="my_form" action="{{ route('admin.page.store') }}" method="POST">
@csrf
@method('POST')
<label for="pname">Page Title:</label>
<input type="text" id="page_title" name="page_title"><br><br>
@error('page_title')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<label for="pname">Slug :</label>
<input type="text" id="slug" name="slug"><br><br>
@error('slug')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

<label for="pname">Body Title :</label>
<input type="text" id="body_title" name="body_title"><br><br>

<label for="lname">Sub Title:</label>
<input type="text" id="sub_title" name="sub_title"><br><br>

<label for="lname">Page Content:</label>
<textarea id="content" name="content"></textarea><br><br>

<button type="submit">Submit</button>
</form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

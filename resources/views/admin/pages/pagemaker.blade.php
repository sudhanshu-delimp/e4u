@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
				<?php //echo "<pre>"; print_R($escort_profile);echo "</pre>";?>
                <div class="card-body">
				<table border="1">
				<tr>
					<td>Page Title:</td>
					<td>{{ $page['page_title']}}</td>
				</tr>
				<tr>
					<td>Slug:</td>
					<td>{{ $page['slug']}}</td>
				</tr>
				<tr>
					<td>Body Title:</td>
					<td>{{ $page['body_title']}}</td>
				</tr>
				<tr>
					<td>Sub Ttile:</td>
					<td>{{ $page->sub_title}}</td>
				</tr>
				<tr>
					<td>Page Content:</td>
					<td>{{ $page->content}}</td>
				</tr>
				<tr>
					<td colspan=2>
					<a href="{{ route('admin.page.index') }}" class="btn btn-success btn-sm btn-icon-text mr-3">Go Back To Home</a>
					</td>
				</tr>




				</div>
            </div>
        </div>
    </div>
</div>

@endsection

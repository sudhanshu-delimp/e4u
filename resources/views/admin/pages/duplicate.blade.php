@extends('layouts.admin')
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
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">
            <!--middle content-->
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-9 left-sidebar-bg">
                    <!-- Begin Page Content -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h2 class="h4 mb-0 text-gray-800 font-weight-500">New Page</h2>
                    </div>
                    <h6>Creating New Page</h6>
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('admin.page.update',$pagess->id) }}" method="POST">
                                @csrf
                                <div class="form-row new-page-input-text">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Page Title" name="page_title" value="{{ old('page_title', $page->page_title) }}">
                                        <label class="page-title-caption">Apears as
                                        <span>"E4U".</span></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Page path/Slug" name="slug" value="{{ old('slug',$page->slug) }}">
                                        <label for="">Must be all lowercase, only letters, numbers, - (dash)
                                        or / (forward slash). Should reflect the title for SEO
                                        purposes.</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="A Guide of seeing escorts" name="sub_title" value="{{ old('sub_title', $page->sub_title) }}">
                                        <label class="page-title-caption">Appears at top of body within
                                        <span>
                                        &lt;H1&gt;
                                        </span> tags.
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" placeholder="Page path/Slug" name="body_title" value="{{ old('body_title', $page->body_title) }}">
                                        <label for="">Appears below body title within<span>
                                        &lt;H2&gt;</span>
                                        tags.</label>
                                    </div>
                                    <div class="col-md-6">
                                        <h6>Display Date</h6>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Displays the
                                            date from when the content was last updated at the bottom of
                                            the page</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <textarea id="editor1" name="content">
                    @if(!empty($page->content)) {{ $page->content}} @endif
                    </textarea>
                </div>
                <!--btn and cart in one row end here now middle content start from here-->
                <!--middle content from bottom-->
                <!--right side bar start from here-->
                <div class="col-sm-12 col-md-12 col-lg-3 right-sidebar-bg" style="background: none">
                <div class="add-new-page-box">
                <h2 class="h4 mb-0 text-gray-800">Link Category</h2>
                <p>Select category for this page</p>
                <div class="footer-link-box">
                <span>Footer links</span>
                <hr>
                {{--dd($page->categories->pluck('id')->toArray())--}}
                @foreach($pageCategories as $pageCategory)
                <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="1exampleCheck1" value="{{ $pageCategory->id}}" name="category_id[]"{{ in_array($pageCategory->id, $page->categories->pluck('id')->toArray()) ? ' checked' : null }}>
                <label class="form-check-label" for="1exampleCheck1">{{$pageCategory->name }}</label>
                </div>
                @endforeach
                </div>
                <div class="row">
                <div class="col-md-6">
                <button id="published" style="display:{{($page->published) ? 'none' : 'block'}}" class="add-page-btn btn-primary btn-icon-split btn-lg commanPublish" value="1"><span class="text">Published</span>
                </button>
                <button id="unpublished" style="display:{{($page->published) ? 'block' : 'none'}}" class="add-page-btn btn-primary btn-icon-split btn-lg commanPublish" value="0"><span class="text">UnPublished</span>
                </button>
                </div>
                <div class="col-md-6">
                <a href="#" class="add-page-btn btn-primary btn-icon-split btn-lg">
                <span class="text">Preview</span>
                </a>
                </div>
                <div class="col-md-12"><button  type="submit" class="add-page-btn btn-primary btn-icon-split btn-lg">
                <span class="text">Update</span></button>
                </div>
                </div>
                </div>
                </form>
                </div>
            </div>
            <!--right side bar end-->
        </div>
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span> </span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</div>
<!-- End of Content Wrapper -->
@endsection
@push('script')
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/app/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/app/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/app/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/app/js/sb-admin-2.js') }}"></script>
<!-- Page level plugins -->
<script src="{{ asset('assets/app/vendor/chart.js/Chart.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('assets/app/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('assets/app/js/demo/chart-pie-demo.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/toast-plugin/jquery.toast.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    var textarea = document.getElementById('editor1');
    let editor = CKEDITOR.replace(textarea);
    
    $('.commanPublish').on('click', function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        var val = $(this).val();
        if(val == 1)
        {
            $('#published').hide();
             $('#unpublished').show();
        } if(val == 0) {
            $('#unpublished').hide();
             $('#published').show();
        } 
    
        $.ajax({
                    method: "POST",
                    url:"{{ route('admin.page.published' , [$page->id]) }}",
                    data:{'published' : val},
                   // contentType: 'application/json',
                    //processData: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        console.log(data);
                        if(data == true){
                            $.toast({
                                heading: 'Success',
                                text: 'Record successfully update',
                                icon: 'success',
                                loader: true,
                                position: 'top-right',      // Change it to false to disable loader
                                loaderBg: '#9EC600'  // To change the background
                            });
                            //location.reload();
                        } else {
                            $.toast({
                                heading: 'Error',
                                text: 'Records Not update',
                                icon: 'error',
                                loader: true,
                                position: 'top-right',      // Change it to false to disable loader
                                loaderBg: '#9EC600'  // To change the background
                            });
                        }
                    }
                });
        
    
        
    })
    
</script>
@endpush
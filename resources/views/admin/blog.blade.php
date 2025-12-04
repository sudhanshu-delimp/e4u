@extends('layouts.admin')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/datatables/css/dataTables.bootstrap.min.css') }}">
<style>
   .swal-button {
   background-color: #242a2c;
   }
   #cke_1_contents {
   height: 150px !important;
   }
</style>
@stop
@section('content')
@php
   $securityLevel = isset(auth()->user()->staff_detail->security_level) ? auth()->user()->staff_detail->security_level: 0;
   $editAccess = staffPageAccessPermission($securityLevel, 'edit');
   $editAccessEnabled  = isset($editAccess['yesNo']) && $editAccess['yesNo'] == 'yes';
   $addAccess = staffPageAccessPermission($securityLevel, 'add');
   $addAccessEnabled  = isset($addAccess['yesNo']) && $addAccess['yesNo'] == 'yes';
@endphp
<div id="wrapper">
   <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
         <div class="container-fluid pl-3 pl-lg-5 pr-3 pr-lg-5">
            <div class="row">
               <div class="custom-heading-wrapper col-md-12">
                     <h1 class="h1">Blog</h1>
                     <span class="helpNoteLink" data-toggle="collapse" data-target="#notes"><b>Help?</b> </span>
               </div>              
               <div class="col-md-12 mb-4">
                  <div class="card collapse" id="notes">
                     <div class="card-body">
                        <h3 class="NotesHeader"><b>Notes:</b> </h3>
                        <ol class="pl-4">
                        <li>You can create a Notification, published at the top of the Website.</li>
                        </ol>
                     </div>
                  </div>
               </div>
            </div> 

            <div class="row">  
               <div class="col-md-12">
                  <div class="bothsearch-form mb-3">
                     @if( $addAccessEnabled)
                     <button type="button" class="create-tour-sec dctour" data-toggle="modal" data-target="#createBlog">
                        Add Blog</button>
                        @endif
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="panel with-nav-tabs panel-warning">
                     <div class="panel-body">
                        <div class="tab-content">
                           <div class="tab-pane fade in active show" id="tab1warning">
                              <div class="table-responsive-xl">
                                 <table class="table" id="BlogListTable">
                                    <thead class="table-bg">
                                       <tr>
                                          <th scope="col">#
                                          </th>
                                          <th scope="col">Images</th>
                                          <th scope="col">Title</th>
                                          <th scope="col">
                                             Short Description
                                          </th>
                                          <th scope="col">Posted Date</th>
                                          <th scope="col">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody class="table-content">
                                       <tr class="row-color">
                                          <td class="theme-color">EB101101</td>
                                          <td class="theme-color"><img src="{{ asset('assets/app/img/blog-9.png')}}" alt="blog images" class="blog-img-admin"/></td>
                                          <td class="theme-color">Legal Statement</td>
                                          <td class="theme-color">Hi everyone, I am Melani and I am here in Perth for all those guys who enjoy the thrill of being with that quite little girl</td>
                                          <td class="theme-color">09-06-2025</td>
                                          <td class="theme-color text-center">
                                             @if($editAccessEnabled)
                                             <div class="dropdown no-arrow">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                </a>
                                                <div class="dot-dropdown dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" data-toggle="modal" data-target="#updateBlog"> <i class="fa fa-fw fa-pen"></i> Edit  </a>
                                                   <div class="dropdown-divider"></div>
                                                   
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-ban"></i> Suspend  </a>
                                                   <div class="dropdown-divider"></div>
                                                   <a class="dropdown-item d-flex align-items-center justify-content-start gap-10" href="#" > <i class="fa fa-fw fa-archive" ></i> Archive  </a>
                                                   
                                                </div>
                                             </div>
                                             @endif
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!--right side bar end-->
      </div>
   </div>
   <!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->
{{-- add blog popup modal --}}
<div class="modal fade upload-modal" id="createBlog" tabindex="-1" role="dialog" aria-labelledby="createBlog" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content basic-modal">
         <div class="modal-header">
            <h5 class="modal-title" id="createBlog">  <img src="{{ asset('assets/dashboard/img/title-blog.png') }}" class="custompopicon"> Create Blog</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
            </button>
         </div>
         <div class="modal-body pb-0">
            <form id="addBlogForm">
              <div class="row">
           
                <!-- Blog Title -->
                <div class="col-12 mb-3">
                  <input type="text" class="form-control rounded-0 fw-bold" placeholder="Blog Title" required />
                </div>
          
                <!-- Upload Image Section (Top of Form) -->
                <div class="col-12 mb-4">
                    <div id="drop-area" class="upload-box text-center p-4">
                      <input type="file" id="fileElem" accept="image/*" onchange="handleFiles(this.files)" hidden>
                      <label for="fileElem" id="fileLabel">
                        <img src="{{ asset('assets/dashboard/img/cloud-image.png')}}" width="50" />
                        <p class="mb-1 font-weight-bold">Drop your image here, or <span style="color: var(--peach)">browse</span></p>
                        <small class="text-muted">Supports: JPG, JPEG2000, PNG</small>
                      </label>
                      <div id="preview" class="mt-3"></div>
                    </div>
                </div>
                  
          
                <!-- Blog Content with CKEditor -->
                <div class="col-12 mb-3">
                    <textarea class="form-control rounded-0" id="editor1" rows="5" placeholder="Blog Content" required></textarea>
                </div>
          
                <!-- SEO Meta Title -->
                <div class="col-12 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="SEO Meta Title (optional)" />
                </div>
          
                <!-- SEO Meta Description -->
                <div class="col-12 mb-3">
                  <textarea class="form-control rounded-0" rows="2" placeholder="Meta Description (optional)"></textarea>
                </div>
          
                <!-- SEO Slug -->
                <div class="col-12 mb-3">
                  <input type="text" class="form-control rounded-0" placeholder="URL Slug (e.g. my-blog-title)" />
                </div>
              </div>
            </form>
          </div>
          
          <div class="modal-footer pr-3">
            <button type="submit" class="btn-success-modal" form="addBlogForm">Save</button>
          </div>
      </div>
   </div>
</div>
<!-- End-->

{{-- add blog popup modal --}}
<div class="modal fade upload-modal" id="updateBlog" tabindex="-1" role="dialog" aria-labelledby="updateBlog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
       <div class="modal-content basic-modal">
          <div class="modal-header">
             <h5 class="modal-title" id="updateBlog">  <img src="{{ asset('assets/dashboard/img/title-blog.png') }}" class="custompopicon"> Update Blog</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true"><img src="{{ asset('assets/app/img/newcross.png')}}" class="img-fluid img_resize_in_smscreen"></span>
             </button>
          </div>
          <div class="modal-body pb-0">
             <form id="addBlogForm">
               <div class="row">
           
                <!-- Blog Title -->
                <div class="col-12 mb-3">
                  <input type="text" class="form-control rounded-0 fw-bold" placeholder="Blog Title" required />
                </div>
                     <!-- Upload Image Section (Top of Form) -->
                <div class="col-12 mb-4">
                    <div id="drop-area" class="upload-box text-center p-4">
                      <input type="file" id="fileElem" accept="image/*" onchange="handleFiles(this.files)" hidden>
                      <label for="fileElem" id="fileLabel">
                        <img src="{{ asset('assets/dashboard/img/cloud-image.png')}}" width="50" />
                        <p class="mb-1 font-weight-bold">Drop your image here, or <span style="color: var(--peach)">browse</span></p>
                        <small class="text-muted">Supports: JPG, JPEG2000, PNG</small>
                      </label>
                      <div id="preview" class="mt-3">
                        <img src="{{ asset('assets/app/img/blog-13.png')}}" width="250" />
                      </div>
                    </div>
                </div>
                 <!-- Blog Content with CKEditor -->
                 <div class="col-12 mb-3">
                     <textarea class="form-control rounded-0" id="editor2" rows="3" placeholder="Blog Content" required></textarea>
                 </div>
           
                 <!-- SEO Meta Title -->
                 <div class="col-12 mb-3">
                   <input type="text" class="form-control rounded-0" placeholder="SEO Meta Title (optional)" />
                 </div>
           
                 <!-- SEO Meta Description -->
                 <div class="col-12 mb-3">
                   <textarea class="form-control rounded-0" rows="2" placeholder="Meta Description (optional)"></textarea>
                 </div>
           
                 <!-- SEO Slug -->
                 <div class="col-12 mb-3">
                   <input type="text" class="form-control rounded-0" placeholder="URL Slug (e.g. my-blog-title)" />
                 </div>
               </div>
             </form>
           </div>
           
           <div class="modal-footer pr-3">
             <button type="submit" class="btn-success-modal" form="addBlogForm">Update</button>
           </div>
       </div>
    </div>
 </div>
 <!-- End-->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
<i class="fas fa-angle-up"></i>
</a>
<!-- CKEditor Script -->
{{-- <script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script> --}}
<script>
  CKEDITOR.replace('editor1', {
    fullPage: false, // Set to true only if you're editing full HTML pages
    extraPlugins: 'docprops',
    allowedContent: true,
    height: 320,
    removeButtons: 'PasteFromWord' // Optional: hide buttons you don’t need
  });

  CKEDITOR.replace('editor2', {
    fullPage: false, // Set to true only if you're editing full HTML pages
    extraPlugins: 'docprops',
    allowedContent: true,
    removeButtons: 'PasteFromWord' // Optional: hide buttons you don’t need
  });
</script>

<script>
    const dropArea = document.getElementById('drop-area');
  
    dropArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      dropArea.classList.add('dragover');
    });
  
    dropArea.addEventListener('dragleave', () => {
      dropArea.classList.remove('dragover');
    });
  
    dropArea.addEventListener('drop', (e) => {
      e.preventDefault();
      dropArea.classList.remove('dragover');
      handleFiles(e.dataTransfer.files);
    });
  
    function handleFiles(files) {
      const preview = document.getElementById('preview');
      preview.innerHTML = ''; // Clear previous
      if (files.length > 0) {
        const file = files[0];
        if (file.type.startsWith('image/')) {
          const reader = new FileReader();
          reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
          };
          reader.readAsDataURL(file);
        } else {
          preview.innerHTML = '<small class="text-danger">Invalid file type</small>';
        }
      }
    }
  </script>
@endsection

@push('script')
  

<script type="text/javascript" charset="utf8" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>

<script>
      var table = $("#BlogListTable").DataTable({
      language: {
         search: "Search: _INPUT_",
         searchPlaceholder: "Search by Date..."
      },
      info: true,
      paging: true,
      lengthChange: true,
      searching: true,
      bStateSave: true,
      order: [[1, 'desc']],
      lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
      pageLength: 10
   });

 </script>
  
@endpush
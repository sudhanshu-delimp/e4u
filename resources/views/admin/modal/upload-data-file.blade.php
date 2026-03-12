  {{-- Modal: View database Centre --}}
    <div class="modal fade upload-modal" id="upload_data_file" tabindex="-1" aria-labelledby="upload_data_fileLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <img src="{{ asset('assets/dashboard/img/save-info.png') }}" class="custompopicon"
                            alt="View Centre">
                       Upload File
                    </h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <img src="{{ asset('assets/app/img/newcross.png') }}" class="img-fluid img_resize_in_smscreen">
                    </button>
                </div>
                <div class="modal-body">
                    <form>                        
                        <div class="form-group mt-3 w-75 text-center mx-auto">
                            <label for="excelFile" class="upload_exl">Select Excel file to upload:</label>
                            <input type="file" class="form-control-file d-none" id="excelFile" accept=".xlsx, .xls">
                            
                            <p id="fileName" class="upl_file_name"></p>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="submit" class="btn-success-modal">Upload</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
    {{-- end --}}
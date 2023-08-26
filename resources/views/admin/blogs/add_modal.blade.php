<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-name">Add New blog</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blogs.store') }}"enctype="multipart/form-data" method="post">
                    {{ csrf_field() }}

                    <div class="control-group form-group">
                        <label class="form-label">title arabic</label>
                        <input type="text" class="form-control "required name="ar[title]" placeholder="Name">
                    </div>
                    <div class="control-group form-group">
                        <label class="form-label">title English</label>
                        <input type="text" class="form-control "required name="en[title]"placeholder="text ">
                    </div>


                    <div class="control-group form-group mb-0">
                        <label class="form-label">description english</label>
                        <textarea type="text" class="summernote form-control "required name="en[description]" placeholder="Address">
                                    </textarea>
                    </div>
                    <div class="control-group form-group mb-0">
                        <label class="form-label">description arabic</label>
                        <textarea type="text" class="summernote form-control "required name="ar[description]"placeholder="Address">
                          </textarea>
                    </div>

                    <div class="control-group form-group mb-0">
                        <input type="file" class="form-control"required name="image" placeholder="Address">
                    </div>



                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->

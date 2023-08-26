<div class="modal" id="modaldemo8{{$parent_id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo" style="width:150%">
            <div class="modal-header">
                <h6 class="modal-title">Add New Sub service</h6><button aria-label="Close" class="close"
                    data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">


                <form action="{{ route('service.sub-services.store', $parent_id) }}" method="post"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="control-group form-group">
                        <label class="form-label">name arabic</label>
                        <input type="text" class="form-control "required name="ar[name]" placeholder="Name">
                    </div>
                    <div class="control-group form-group">
                        <label class="form-label">name English</label>
                        <input type="text" class="form-control "required name="en[name]"placeholder="text ">
                    </div>


                    <div class="control-group form-group mb-0">
                        <label class="form-label">desc english</label>
                        <textarea type="text" class="form-control "required name="en[desc]" placeholder="Address">
                                </textarea>
                    </div>
                    <div class="control-group form-group mb-0">
                        <label class="form-label">desc arabic</label>
                        <textarea type="text" class="form-control "required name="ar[desc]"placeholder="Address">
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

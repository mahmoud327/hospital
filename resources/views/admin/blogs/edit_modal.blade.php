<!-- edit -->
<div class="modal fade" id="exampleModal2{{ $blog->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:130%">
            <div class="modal-header">
                <h5 class="modal-name" id="exampleModalLabel">Edit blogs</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('blogs.update', $blog->id) }}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="en[title]"  value="{{optional($blog->translate('en'))->title}}"
                                    placeholder=" title english ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ar[title]" value="{{optional($blog->translate('ar'))->title}}"
                                    placeholder=" title arabic ">
                            </div>

                            <label class="form-label">description english</label>
                            <textarea type="text" class="summernote form-control "required name="en[description]" placeholder="Address">
                                {!!optional($blog->translate('en'))->description!!}
                             </textarea>
                        </div>
                        <div class="control-group form-group mb-0">
                            <label class="form-label">description arabic</label>
                            <textarea type="text" class="summernote form-control "required name="ar[description]"placeholder="Address">
                                {!!optional($blog->translate('en'))->description!!}

                            </textarea>
                        </div>

                        <div class="control-group form-group mb-0">
                            <input type="file" class="form-control"required name="image" placeholder="Address">
                        </div>







                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">تاكيد</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->

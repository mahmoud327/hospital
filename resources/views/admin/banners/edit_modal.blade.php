<!-- edit -->
<div class="modal fade" id="exampleModal2{{ $banner->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:130%">
            <div class="modal-header">
                <h5 class="modal-name" id="exampleModalLabel">Edit banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="en[title]"
                                    value="{{ optional($banner->translate('en'))->title }}" required
                                    placeholder=" name english ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ar[title]"
                                    value="{{ optional($banner->translate('ar'))->title }}" required placeholder=" name arabic ">
                            </div>





                            <div class="control-group form-group mb-0">
                                <input type="file" class="form-control" name="image" placeholder="Address">
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

<!-- edit -->
<div class="modal fade" id="exampleModal2{{ $service->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:130%">
            <div class="modal-header">
                <h5 class="modal-name" id="exampleModalLabel">Edit services</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('services.update', $service) }}" method="post"
                    enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" name="en[name]"  value="{{optional($service->translate('en'))->name}}"
                                    placeholder=" name english ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="ar[name]" value="{{optional($service->translate('ar'))->name}}"
                                    placeholder=" name arabic ">
                            </div>


                            <div class="control-group form-group mb-0">
                                <label class="form-label">desc english</label>
                                <textarea type="text" class="form-control "required name="en[desc]" placeholder="Address">
                                    {{optional($service->translate('en'))->desc}} </textarea>
                            </div>
                            <div class="control-group form-group mb-0">
                                <label class="form-label">desc arabic</label>
                                <textarea type="text" class="form-control "required name="ar[desc]"placeholder="Address">
                                    {{optional($service->translate('ar'))->desc}} </textarea>
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

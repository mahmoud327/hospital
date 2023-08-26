<!-- edit -->
<div class="modal fade" id="exampleModal2{{$subCategory->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:140%">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">
            <form action="{{route('categories.update' ,$category)}}" method="post" enctype="multipart/form-data">
                @method('put')
                @csrf
                 <div class="row">

                        <div class="col-sm-6">

                            <div class="form-group">
                                <input type="text" class="form-control" name="name_ar" value="{{$subCategory->getTranslation('name' , 'ar')}}" placeholder="Arabic name ">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="name_en" value="{{$subCategory->getTranslation('name' , 'en')}}" placeholder="English name ">
                            </div> 
                            
                            <div class="form-group">
                                <textarea class="form-control" name="description_ar" placeholder="Arabic description" rows="3">{{$subCategory->getTranslation('description' , 'ar')}} </textarea>
                            </div>

                            <div class="form-group">
                                <textarea class="form-control" name="description_en" placeholder="English description" rows="3">{{$subCategory->getTranslation('description' , 'en')}} </textarea>
                            </div>

                                        
                            <div class="form-group">

                                <select class="form-control select2"  name="view_id"  id="view1">
                                    <option label="Views"></option>

                                    @foreach($views as $view) 
                                    
                                        @if ($parent->view()->first()->name  == "banner") 
                                        <option value="{{$view->id}}"  {{ ( $subCategory->view()->first()->name == $view->name) ? 'selected' : '' }}  >{{$view->name}}</option>
                                        @else

                                        <option value="{{$view->id}}"  {{ ( $subCategory->view()->first()->name == $view->name) ? 'selected' : '' }}  >{{$view->name}}</option>


                                        @endif
                                        
                                    @endforeach 
                                </select>

                            </div>

                        
                            


                            @if ($parent->view()->first()->name =="banner") 

                                <div id="text_view1">

                                <div class="form-group">
                                        <input type="text" class="form-control" name="text1_ar" value="{{$subCategory->getTranslation('text1', 'ar')}}" placeholder="Arabic text 1">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="text1_en"  value="{{$subCategory->getTranslation('text1', 'en')}}" placeholder="English text 1">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="text2_ar" value="{{$subCategory->getTranslation('text2', 'ar')}}" placeholder="Arabic text 2">
                                    </div>

                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control" name="text2_en" value="{{$subCategory->getTranslation('text2', 'en')}}"  placeholder="English text 2">
                                    </div> 
                     
                                </div>
                                
                            @endif 


                                    
                       
                            <div id="image" class="form-group"  >
                                <div class="custom-file">
                                    <input class="custom-file-input" name="image" value="{{$subCategory->image}}" type="file"> <label class="custom-file-label" for="customFile">Choose image</label>
                                </div>
                            </div>

                            <br>
                            
                            <div id="image_edit" class="form-group" >
                                
                                  <img style="width: 80px;height:60px"  src="{{ env('AWS_S3_URL') . '/' .$subCategory->image}}" alt="categories-image">
                               
                            </div>
                

                        </div>

                        <div class="col-sm-6">
                            <label> Accounts: </label><br>


                            <input type="checkbox" id="check_all_accounts_edit" class="m-2"><span>All Accounts</span>

                            @inject('accounts','App\Models\Account')

                            <ul id="treeview1">

                                @foreach ($accounts->get() as $account)
                                
                                    <li id="account_edit"><input id="account_edit" @if ( $account->name == 'suiiz') checked  onclick="return false;" class="suiiz"   @endif type="checkbox"  style="margin:3px"><a href="#">{{$account->name}}</a>
                                        
                                        <ul>
                                            @foreach ($account->subAccounts()->get() as $sub_account)
                                    
                                                <li id="sub_account_edit" >
                                                    
                                                    <input id="sub_account_edit" @if ( $sub_account->name == 'suiiz' ) checked onclick="return false;" class="suiiz" @endif @if(in_array( $sub_account->id, json_decode( $subCategory->subAccounts->pluck('id') )  ) ) ) checked   @endif   type="checkbox" style="margin:3px"  name="sub_account[]" value="{{$sub_account->id}}" class="m-2">{{$sub_account->name}}
                                                    
                                                </li>

                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                                
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">تاكيد</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Basic modal -->

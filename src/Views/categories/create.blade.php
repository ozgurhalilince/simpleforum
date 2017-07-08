<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading">Kategori Ekle</div>
        <div class="panel-body">

            <form action="{{ route('categories.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                {{ csrf_field()}}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Kategori Adı</label>
                    
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control" value="{{old('name')}}"> 
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div> 
                </div>

                <div class="form-group{{ $errors->has('up_category_id') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label">Üst Kategorisi</label>
                    
                    <div class="col-sm-8">
                        <select name="up_category_id" class="form-control">
                            <option value="0" > Ana Kategori </option> 
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" > {{ $category->name }} </option> 
                            @endforeach
                        </select> 
                        @if ($errors->has('up_category_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('up_category_id') }}</strong>
                            </span>
                        @endif
                    </div> 
                </div>
                
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label class="col-sm-2 control-label" >Kategori Açıklaması</label>
                    
                    <div class="col-sm-8">
                        <input type="text" name="description" class="form-control" value="{{old('description')}}"> 
                        @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                        @endif
                    </div> 
                </div>

                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-8">
                    <button class="btn btn-success btn-block">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>
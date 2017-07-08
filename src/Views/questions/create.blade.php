<div class="row">
	<div class="col-md-12">
	    <div class="panel panel-primary">
	        <div class="panel-heading">Soru sor</div>
	        <div class="panel-body">

	            <form action="{{ route('questions.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
	                {{ csrf_field()}}
	                <input type="hidden" name="category_id" value="{{ $category->id }}">

	                <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
	                    
	                    <div class="col-sm-12">
	                        <input type="text" name="question" class="form-control" value="{{old('question')}}" placeholder="Soru..."> 
	                        @if ($errors->has('question'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('question') }}</strong>
	                            </span>
	                        @endif
	                    </div> 
	                </div>
	                
	                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
	                    
	                    <div class="col-sm-12">
	                    	<textarea name="body" class="form-control" required="required">{{old('body')}}</textarea>
	                        @if ($errors->has('body'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('body') }}</strong>
	                            </span>
	                        @endif
	                    </div> 
	                </div>

					<div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
		                <label  class="col-sm-2 control-label" for="files">Dosya Yükle</label>
						<div class="col-sm-10">
			                <input name="files[]" type="file" class="form-control" multiple> 
			                @if ($errors->has('files'))
			                    <span class="help-block">
			                        {{ $errors->first('files') }}
			                    </span>
			                @endif 
		                </div>
		            </div>

	                <div class="form-group">
	                    <div class="col-sm-2 col-sm-offset-10">
	                    <button class="btn btn-success btn-block">Kaydet</button>
	                </div>
	            </form>
	        </div>
	    </div>
	</div>
</div>
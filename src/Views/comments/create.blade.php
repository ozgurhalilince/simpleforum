
<div class="col-md-12 well">
	<form action="{{ route('comments.store') }}" method="post" class="form-horizontal" enctype="multipart/form-data">
	    {{ csrf_field()}}
	    <input type="hidden" name="commentable_id" value="{{ $question->id }}">
	    <input type="hidden" name="commentable_type" value="Ozgurince\Simpleforum\Models\Question">
	    
	    <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
	        <label class="col-sm-2" >Cevap Ver</label>
	        
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
            <label class="col-sm-2 control-label pull-left" for="files">Dosya Yükle</label>
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
	    
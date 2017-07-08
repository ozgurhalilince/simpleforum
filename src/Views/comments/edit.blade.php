@extends('simpleforum::layouts.app')

@section('content')

	 <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Düzenle #{{ $comment->id }}</div>
                    <div class="panel-body">
                    <form action="{{ route('comments.update', $comment->id) }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field()}}
                        {{ method_field('put')}}
                        
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label class="col-sm-2" >Cevabınız</label>
                            
                            <div class="col-sm-12">
                                <textarea name="body" class="form-control" required="required">{{ $comment->body }}</textarea>
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

                        <div class="form-group added-files">
                            <label  class="col-sm-2 control-label" for="file">Dosyalar</label>
                            <div class="col-sm-10">
                                @forelse($comment->files as $file)
                                <div class="file">
                                    <a href="{{ $file->path }}" target="_blank">Dosyayı gör..</a>
                                    <a href="{{ route('files.show', $file->id) }}">   
                                        <button class="btn btn-danger btn-xs btn-icon" onclick='return confirm("Silmek istediğinize emin misiniz?")' type="button">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </div>
                                @empty
                                <p>Dosya yok</p>
                                @endforelse
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
    </div>

@endsection



@if(Auth::user()) {{-- if there is auth user, he can comment --}}
@section('page_scripts')

    <!-- CK Editor -->
    <script src="{{ asset('vendor/simpleforum/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('body');
    </script>
@endsection
@endif
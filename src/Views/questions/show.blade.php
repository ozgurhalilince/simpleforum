@extends('simpleforum::layouts.app')

@section('content')

	 <div class="container" ng-controller="commentsController">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                @include('simpleforum::_partials.notifications')
                
                <div class="panel panel-primary">
                    <div class="panel-heading"><a href="{{ route('categories.show', $question->category->id) }}">{{ $question->category->name }}</a> > {{ $question->question }}   </div>
                    <div class="panel-body">
                        
                        <div class="col-md-12 well">
                            <div class="col-md-3">
                                <span><img src="{{ $question->user->photo_path }}" width="100" height="100"></span>
                                <h4>{{ $question->user->name }}</h4>
                                <p><b>Kayıtlı: </b> {{ $question->user->created_at->format('d.m.Y') }}</p>
                            </div>
                            <div class="col-md-8">
                                <p>{!! $question->body !!}</p>

                                @foreach($question->files as $file)
                                <div class="files">
                                    <a href="{{ $file->path }}" target="_blank">Dosyayı gör..</a>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-1">

                                @if($question->canEditOrDelete())
                                <a href="{{ route('questions.edit', $question->id) }}">
                                    <button class="btn btn-primary btn-sm btn-icon">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                </a> 
                                @endif

                                {{--
                                <form action="{{ route('questions.destroy', $question->id) }}"  method="POST" class="form-display">    
                                    <button class="btn btn-danger btn-sm btn-icon" onclick='return confirm("Silmek istediğinize emin misiniz?")'>
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    {{ csrf_field()}}
                                    {{ method_field('delete')}}
                                </form>
                                --}}   
                            </div>
                        </div>

                        <h4>Yorumlar</h4>
                        
                        @forelse($comments as $element)
                        
                        <div class="col-md-12 well">
                            <div class="col-md-3">
                                <span><img src="{{ $element->user->photo_path }}" width="100" height="100"></span>
                                <h4>{{ $element->user->name }}</h4>
                                <p><b>Kayıtlı: </b> {{ $element->user->created_at->format('d.m.Y') }}</p>
                            </div>
                            <div class="col-md-8">
                                <p>{!! $element->body !!}</p>

                                @foreach($element->files as $file)
                                <div class="files">
                                    <a href="{{ $file->path }}" target="_blank">Dosyayı gör..</a>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-1">
                                @if(Auth::user())
                                <button class="btn btn-sm like-btn @if($element->isLiked()) btn-primary @endif" title="Beğen" value="{{ $element->id }}" ng-click="likeUnlikeComment($event.target)">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <span class="likes-number"> {{ count($element->likes) }}</span>
                                </button>
                                @endif
                                
                                @if($element->canEditOrDelete())
                                <a href="{{ route('comments.edit', $element->id) }}">
                                    <button class="btn btn-primary btn-sm btn-icon margin-top-10">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </button>
                                </a> 

                                <form action="{{ route('comments.destroy', $element->id) }}"  method="POST" >    
                                    <button class="btn btn-danger btn-sm btn-icon margin-top-10" onclick='return confirm("Silmek istediğinize emin misiniz?")'>
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                                    {{ csrf_field()}}
                                    {{ method_field('delete')}}
                                </form>
                                @endif
                            </div>
                        </div>
                        @empty
                        <p>Henüz konuya yorum yapılmamıştır.</p>
                        @endforelse

                        @if(Auth::user())
                            
                            @include('simpleforum::comments.create')

                        @endif
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
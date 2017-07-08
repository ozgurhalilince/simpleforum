@extends('simpleforum::layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('simpleforum::_partials.notifications')

            <div class="panel panel-default">
            	<div class="panel-body">
                    
                <div class="col-md-12 profile-area">
                	<div class="col-md-4 photo-area">
					   <img src="{{ $collection["user"]->photo_path }}" class="profile-photo">                 		
                	</div>
                	<div class="col-md-8">
                		<h1>{{$collection["user"]->name}}</h1>

                    @if(isset($collection["own"]))
                    
                    <form id="profile-photo-form" action="{{ route('update-profile-photo') }}" method="POST" role="form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <label id="upload-profile-photo-btn" class="btn btn-default btn-file btn-sm pull-right">
                            Profil Fotoğrafını Değiştir <input id="profile-photo-input" type="file" name="photo" class="hidden">
                        </label>
                    </form>
                    
                    <a href="{{ route('settings') }}">
                        <button class="btn btn-default btn-sm pull-right">Profili Düzenle</button>
                    </a>
                    @endif

                    <p class="user-info">
                        <p>{{ $collection["user"]->about_me }}</p>
                    </p>                    
                    
                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12 questions">
                        <h4>Sorulan Sorular</h4>
                        
                        @if($collection["user"]->questions->count() > 0)

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Konu</th>
                                        <th>Cevap </th>
                                        <th width="170"><span class="pull-right">Açılma Tarihi</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($collection["user"]->questions as $element)
                                    <tr>
                                        <td><b><a href="{{ route('questions.show', $element->id) }}">{{ $element->question }}</b></a></td>
                                        <td>{{ $element->comments->count() }}</td>
                                        <td><span class="pull-right">{{ $element->created_at->format('d.m.Y H:i') }}
                                        @if($element->canEditOrDelete())
                                        <a href="{{ route('questions.edit', $element->id) }}">
                                            <button class="btn btn-primary btn-xs btn-icon">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                        </a>  
                                        @endif
                                        </span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                            <p>Henüz sorulan soru bulunmamaktadır.</p>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 comments">
                        <h4>Yorum Yapılan Konular</h4>

                        @if($collection["user"]->questions->count() > 0)

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Konu</th>
                                        <th>Cevap Sayısı</th>
                                        <th width="170"><span class="pull-right">Yorum Tarihi</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($collection["user"]->comments as $element)
                                    <tr>
                                        <td><b><a href="{{ route('questions.show', $element->commentable->id) }}">{{ $element->commentable->question }}</a></b></td>
                                        <td>{{ $element->commentable->comments->count() }}</td>
                                        <td><span class="pull-right">{{ $element->created_at->format('d.m.Y H:i') }}
                                        </span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @else
                            <p>Henüz yorum bulunmamaktadır.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
  $(function() {

     $("#profile-photo-input").change(function() {
         $("#profile-photo-form").submit();
     });
  });
</script>
@endsection

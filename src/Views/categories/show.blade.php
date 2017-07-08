@extends('simpleforum::layouts.app')

@section('content')

	 <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">{{ $category->name }}</div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Konu</th>
                                        <th>Cevap Sayısı</th>
                                        <th width="170"><span class="pull-right">Açılma Tarihi</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($category->questions as $element)
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
                                        {{--
                                        <form action="{{ route('questions.destroy', $element->id) }}"  method="POST" class="form-display">    
                                            <button class="btn btn-danger btn-xs btn-icon" onclick='return confirm("Silmek istediğinize emin misiniz?")'>
                                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                                            </button>
                                            {{ csrf_field()}}
                                            {{ method_field('delete')}}
                                        </form> 
                                        --}}
                                        @endif
                                        </span></td>
	                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    
                    </div>
                </div>

            @if(Auth::user())
                
                @include('simpleforum::questions.create')

            @endif
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
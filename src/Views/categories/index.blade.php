@extends('simpleforum::layouts.app')

@section('content')

	 <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                @include('simpleforum::_partials.notifications')
                
                <div class="panel panel-primary">
                    <div class="panel-heading">Kategoriler</div>
                    <div class="panel-body">
                        @if($categories->count() == 0)                        
                            <p>Sistemde henüz kategori bulunmamaktadır.</p>
                        @else
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Üst Kategorisi</th>
                                        <th>Soru Sayısı</th>
                                        <th><span class="pull-right">Açılma Tarihi</span></th>
                                        @if(Auth::user() && Auth::user()->isAdmin())
                                        <th><span class="pull-right">İşlemler</span></th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $element)
	                                <tr>
                                        <td><b><a href="{{ route('categories.show', $element->id) }}">{{ $element->name }}</b></a></td>
	                                	<td>
                                        @if($element->up_category != null)
                                            <b><a href="{{ route('categories.show', $element->up_category->id) }}">{{ $element->up_category->name }}</a></b>
                                        @else
                                            Ana Kategori
                                        @endif    
                                        </td>
	                                	<td>{{ $element->questions->count() }}</td>
	                                	<td><span class="pull-right">{{ $element->created_at->format('d.m.Y') }}</span>
                                        </td>

                                        @if(Auth::user() && Auth::user()->isAdmin())
                                        <td class="pull-right">                                  
                                            <a href="{{ route('categories.edit', $element->id) }}">
                                                <button class="btn btn-primary btn-xs btn-icon">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>    
                                            @if(sizeof($element->subcategories) == 0)
                                            <form action="{{ route('categories.destroy', $element->id) }}"  method="POST" class="form-display">    
                                                <button class="btn btn-danger btn-xs btn-icon" onclick='return confirm("Silmek istediğinize emin misiniz?")'>
                                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                                {{ csrf_field()}}
                                                {{ method_field('delete')}}
                                            </form>
                                            @endif
                                        </td>
                                        @endif
	                                </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="pagination-wrapper"> {!! $categories->appends(['search' => Request::get('search')])->render() !!} 
                            </div>

                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            @if(Auth::user() && Auth::user()->isAdmin())
                
                @include('simpleforum::categories.create')

            @endif
        </div>
    </div>

@endsection
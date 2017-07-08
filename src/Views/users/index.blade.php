@extends('simpleforum::layouts.app')

@section('content')

	 <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">

                @include('simpleforum::_partials.notifications')

                <div class="panel panel-primary">
                    <div class="panel-heading">
                    Kullanıcılar
                    <p class="pull-right">
                        <a href="{{ route('users.create') }}">
                            <button class="btn btn-secondary btn-xs btn-icon" title="Kullanıcı Ekle">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </a>
                    </p>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Fotoğraf</th>
                                        <th>ID</th>
                                        <th>Ad Soyad</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Rol</th>
                                        <th width="10">İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                               @foreach($users as $user)
                                    <tr>
                                        <td><img src="{{ $user->photo_path }}" width="50"></td>
                                        <td>{{ $user->id }}</td>
                                        <td><b><a href="{{ route('profile_with_id', $user->id) }}">{{ $user->name }}</a></b></td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}">
                                                <button class="btn btn-primary btn-xs btn-icon">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a> 
                                            <form action="{{ route('users.destroy', $user->id) }}"  method="POST" class="form-display"> 
                                                @if(!$user->isBanned())   
                                                <button class="btn btn-danger btn-xs btn-icon" onclick='return confirm("Engellemek istediğinize emin misiniz?")' title="Engelle">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </button>
                                                @else 
                                                <button class="btn btn-success btn-xs btn-icon" onclick='return confirm(" Engeli kaldırmak istediğinize emin misiniz?")' title="Engeli Kaldır">
                                                    <i class="fa fa-check-square" aria-hidden="true"></i>
                                                </button>                                                
                                                @endif
                                                {{ csrf_field()}}
                                                {{ method_field('delete')}}
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <div class="pagination-wrapper"> {!! $users->appends(['search' => Request::get('search')])->render() !!} 
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
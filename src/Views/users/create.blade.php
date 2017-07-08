@extends('simpleforum::layouts.app')

@section('content')

	 <div class="container">
        <div class="row">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Kullanıcı Ekle</div>
                    <div class="panel-body">
						<form action="{{ route('users.store') }}" method="post"  enctype="multipart/form-data">
						{{ csrf_field()}}

						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
							<label for="name"> Ad Soyad </label>
							<input class="form-control"  name="name" type="text" value="{{old('name')}}"/> 
							@if ($errors->has('name'))
						    	<span class="help-block">
						        	<strong>{{ $errors->first('name') }}</strong>
						    	</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email"> E-posta </label>
							<input class="form-control" name="email" type="email" value="{{old('email')}}"/> 
							@if ($errors->has('email'))
						    	<span class="help-block">
						        	<strong>{{ $errors->first('email') }}</strong>
						    	</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
							<label for="username"> Kullanıcı Adı </label>
							<input class="form-control"  name="username" type="text" value="{{old('username')}}"/> 
							@if ($errors->has('username'))
						    	<span class="help-block">
						        	<strong>{{ $errors->first('username') }}</strong>
						    	</span>
							@endif
						</div>

						<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
							<label for="password"> Şifre </label>
							<input class="form-control" name="password" type="password"> 
							@if ($errors->has('password'))
						    	<span class="help-block">
						        	<strong>{{ $errors->first('password') }}</strong>
						    	</span>
							@endif
						</div>

		                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
		                    <label for="role_id">Rolü Seç</label>
	                        <select name="role_id" class="form-control">
	                            @foreach($roles as $role)
	                            <option value="{{$role->id}}" @if($role->name == "member") selected @endif> {{ $role->name }} </option> 
	                            @endforeach
	                        </select> 
	                        @if ($errors->has('role_id'))
	                            <span class="help-block">
	                                <strong>{{ $errors->first('role_id') }}</strong>
	                            </span>
	                        @endif
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
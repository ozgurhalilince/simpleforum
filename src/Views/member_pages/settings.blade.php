@extends('simpleforum::layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            @include('simpleforum::_partials.notifications')

            <div class="panel panel-default">				
        	<div class="row">
        		<div class="col-md-12">
    				<div class="col-md-4 settings-list">
        				<ul class="list-group">
						  <li id="general-settings-li" class="list-group-item">
						  	<a href="#general-settings">Genel Bilgileri Değiştir</a>
						  </li>
						  <li id="password-settings-li" class="list-group-item">
						  	<a href="#password-settings">Şifre Değiştir</a>
						  </li>
						  <li id="username-settings-li" class="list-group-item">
						  	<a href="#username-settings">Kullanıcı Adı Değiştir</a>
						  </li>
						</ul>
        			</div>
        			<div class="col-md-8">
						<div id="general-settings" class="settings-item">
							<form action="{{ route('update-general') }}" method="POST" role="form" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
								<legend>Genel</legend>
							
								<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
									<label for="">Ad Soyad</label>
									<input type="text" class="form-control" name="name" value="{{ Auth::User()->name }}">
									@if ($errors->has('name'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('email') }}</strong>
								    	</span>
									@endif
								</div>

								<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
									<label for="">E-posta</label>
									<input type="email" class="form-control" name="email" value="{{ Auth::User()->email }}">
									@if ($errors->has('email'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('email') }}</strong>
								    	</span>
									@endif
								</div>

								<div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
									<label for="">Telefon Numarası</label>
									<input type="text" class="form-control" name="phone_number" value="{{ Auth::User()->phone_number }}">
									@if ($errors->has('phone_number'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('phone_number') }}</strong>
								    	</span>
									@endif
								</div>
							
								<div class="form-group{{ $errors->has('about_me') ? ' has-error' : '' }}">
									<label for="">Hakkında</label>
									 <textarea class="form-control" name="about_me" rows="5" id="comment">{{ Auth::User()->about_me }}</textarea>
									@if ($errors->has('about_me'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('about_me') }}</strong>
								    	</span>
									@endif
								</div>	

								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="">Şifrenizi Giriniz: </label>
									<input type="password" class="form-control" name="password">
									@if ($errors->has('password'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('password') }}</strong>
								    	</span>
									@endif
								</div>
							
								<button type="submit" class="btn btn-primary btn-sm pull-right">Güncelle</button>
							</form>
						</div>

						<div id="password-settings" class="settings-item">
							<form action="{{ route('update-password') }}" method="POST" role="form" enctype="multipart/form-data">
								{{ csrf_field() }}
								<legend>Şifre Değiştir</legend>
							
								<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
									<label for="">Eski Şifre </label>
									<input type="password" class="form-control" name="old_password" placeholder="**********">
									@if ($errors->has('old_password'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('old_password') }}</strong>
								    	</span>
									@endif
								</div>

								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="">Yeni Şifre</label>
									<input type="password" class="form-control" name="password">
									@if ($errors->has('password'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('password') }}</strong>
								    	</span>
									@endif
								</div>

								<div class="form-group{{ $errors->has('password_repeat') ? ' has-error' : '' }}">
									<label for="">Yeni Şifre Tekrarı</label>
									<input type="password" class="form-control" name="password_repeat" >
									@if ($errors->has('password_repeat'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('password_repeat') }}</strong>
								    	</span>
									@endif
								</div>

								<button type="submit" class="btn btn-primary btn-sm pull-right">Güncelle</button>
							</form>
						</div>

						<div id="username-settings" class="settings-item">
							<form action="{{ route('update-username') }}" method="POST" role="form" enctype="multipart/form-data">
								{{ csrf_field() }}
								<input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
								<legend>Kullanıcı Adı Değiştir</legend>

								<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
									<label for="">Kullanıcı Adı</label>
									<input type="text" class="form-control" name="username" value="{{ Auth::User()->username }}">
									@if ($errors->has('username'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('username') }}</strong>
								    	</span>
									@endif
								</div>
							

								<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
									<label for="">Şifre</label>
									<input type="password" class="form-control" name="password">
									@if ($errors->has('password'))
								    	<span class="help-block">
								        	<strong>{{ $errors->first('password') }}</strong>
								    	</span>
									@endif
								</div>

								<button type="submit" class="btn btn-primary btn-sm pull-right">Güncelle</button>
							</form>
						</div>
    				</div>
        		</div>
        	</div>
        </div>
    </div>
</div>

<script>
	$(".settings-item").hide();
	$("#general-settings").show();
	$(".list-group-item").click(function(event) {
		var attr = $(this).attr('id');
		$(".settings-item").hide();
		setTimeout(function(){ 
			var divID = attr.substring(0, attr.length - 3);

			$("#" + divID).show(); 
		}, 500);
		
	});
</script>


@endsection
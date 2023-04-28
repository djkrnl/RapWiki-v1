@extends('layouts.app')

@section('title', 'Zmień hasło - RapWiki')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Zmień hasło') }}</div>

				<div class="card-body">
					@if($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
							
					<form method="POST" action="{{ route('changepass') }}">
						@csrf

						<div class="row mb-3">
							<label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Obecne hasło') }}</label>

							<div class="col-md-6">
								<input id="password" type="password" class="form-control" name="password" required autocomplete="password">
							</div>
						</div>

						<div class="row mb-3">
							<label for="new_password" class="col-md-4 col-form-label text-md-end">{{ __('Nowe hasło') }}</label>

							<div class="col-md-6">
								<input id="new_password" type="password" class="form-control" name="new_password" required autocomplete="password">
							</div>
						</div>

						<div class="row mb-3">
							<label for="password_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Potwierdź hasło') }}</label>

							<div class="col-md-6">
								<input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="password">
							</div>
						</div>

						<div class="row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Zatwierdź') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

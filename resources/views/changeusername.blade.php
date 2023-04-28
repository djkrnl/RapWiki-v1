@extends('layouts.app')

@section('title', 'Zmień nazwę użytkownika - RapWiki')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Zmień nazwę użytkownika') }}</div>

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
							
					<form method="POST" action="{{ route('changename') }}">
						@csrf

						<div class="row mb-3">
							<label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Obecna nazwa użytkownika') }}</label>

							<div class="col-md-6">
								<input id="username" type="text" class="form-control" name="username" required autocomplete="username">
							</div>
						</div>

						<div class="row mb-3">
							<label for="new_username" class="col-md-4 col-form-label text-md-end">{{ __('Nowa nazwa użytkownika') }}</label>

							<div class="col-md-6">
								<input id="new_username" type="text" class="form-control" name="new_username" required autocomplete="username">
							</div>
						</div>

						<div class="row mb-3">
							<label for="username_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Potwierdź nazwę użytkownika') }}</label>

							<div class="col-md-6">
								<input id="username_confirmation" type="text" class="form-control" name="username_confirmation" required autocomplete="username">
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

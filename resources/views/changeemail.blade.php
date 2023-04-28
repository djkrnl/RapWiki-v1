@extends('layouts.app')

@section('title', 'Zmień adres e-mail - RapWiki')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Zmień adres e-mail') }}</div>

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
							
					<form method="POST" action="{{ route('changemail') }}">
						@csrf

						<div class="row mb-3">
							<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Obecny adres e-mail') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" required autocomplete="email">
							</div>
						</div>

						<div class="row mb-3">
							<label for="new_email" class="col-md-4 col-form-label text-md-end">{{ __('Nowy adres e-mail') }}</label>

							<div class="col-md-6">
								<input id="new_email" type="email" class="form-control" name="new_email" required autocomplete="email">
							</div>
						</div>

						<div class="row mb-3">
							<label for="email_confirmation" class="col-md-4 col-form-label text-md-end">{{ __('Potwierdź adres e-mail') }}</label>

							<div class="col-md-6">
								<input id="email_confirmation" type="email" class="form-control" name="email_confirmation" required autocomplete="password">
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

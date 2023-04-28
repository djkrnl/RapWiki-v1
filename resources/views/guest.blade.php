@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Błąd</div>

					<div class="card-body">
						<p class="card-text">Ta sekcja jest dostępna tylko dla zalogowanych użytkowników. <a href="login" class="text-decoration-none">Zaloguj się</a>, aby kontynuować.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
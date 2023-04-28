@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">Błąd</div>

					<div class="card-body">
						<p class="card-text">Nie można wyszukać kryterium o długości krótszej niż 3 znaki. Spróbuj ponownie, używając pola wyszukiwania na pasku adresu.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
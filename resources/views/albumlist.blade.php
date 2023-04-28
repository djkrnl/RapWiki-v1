@extends('layouts.app')

@section('title', 'Albumy - RapWiki')

@section('content')
	<div class="container">
		<div class="row mb-3">
			<h2 class="text-center">Albumy</h2>
		</div>
		
		<?php $i = 0; ?>
		@foreach(Config::get('constants.genres') AS $gen_id => $gen_tr)
			@if($i % 4 == 0)
				<div class="row justify-content-center">
			@endif
			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6 mb-3">
				<a href="../albumlist/{{ $gen_id }}" class="text-decoration-none">
					<div class="card border-0 text-white bg-image hover-shadow" style="background-image: url('../storage/albumgenres/{{ $gen_id }}.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
						<div class="mask rounded" style="background-color: rgba(0, 0, 0, 0.5);">
							<div class="text-center mb-4 mt-4" style="flex-direction: column;">
								<h2>{{ $gen_tr }}</h2>
							</div>
						</div>
					</div>
				</a>
			</div>
			@if($i % 4 == 3)
				</div>
			@endif
			<?php $i++; ?>
		@endforeach
	</div>
@endsection
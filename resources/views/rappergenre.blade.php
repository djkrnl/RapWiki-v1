@extends('layouts.app')

@section('title', 'Raperzy: ' . $name . ' - RapWiki')

@section('content')
	<div class="container" style="height: 100%;">
		<div class="row mb-3">
			<h2 class="text-center">Raperzy - {{ $name }}</h2>
		</div>
		
		@if($rappers->count() > 0)
			<?php $i = 0; ?>
			@foreach($rappers AS $rapper)
				@if($i % 6 == 0)
					<div class="row justify-content-center">
				@endif
				<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-3 text-center">
					<a href="../rshow/{{ $rapper->id }}" class="text-decoration-none">
						@if(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.jpg'))
							<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='../storage/rappers/{{ $rapper->id }}.jpg'>
						@elseif(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.png'))
							<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='../storage/rappers/{{ $rapper->id }}.png'>
						@else
							<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='../storage/default.png'>
						@endif
					</a>
					<h4 class="mt-2">{{ $rapper->rapper_name }}</h4>
				</div>
				@if($i % 6 == 5)
					</div>
				@endif
				<?php $i++; ?>
			@endforeach
		@else
			<div class="row mb-3">
				<h4 class="text-center">Na chwilę obecną nie mamy artykułów spełniających te kryteria.</h4>
			</div>
		@endif
		
	</div>
@endsection
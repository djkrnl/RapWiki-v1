@extends('layouts.app')

@section('title', 'Albumy: ' . $name . ' - RapWiki')

@section('content')
	<div class="container" style="height: 100%;">
		<div class="row mb-3">
			<h2 class="text-center">Albumy - {{ $name }}</h2>
		</div>
		
		@if($albums->count() > 0)
			<?php $i = 0; ?>
			@foreach($albums AS $album)
				@if($i % 6 == 0)
					<div class="row justify-content-center">
				@endif
				<div class="col-xl-2 col-lg-2 col-md-4 col-sm-4 col-6 mb-3 text-center">
					<a href="../ashow/{{ $album->id }}" class="text-decoration-none">
						@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
							<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.jpg'>
						@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
							<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.png'>
						@else
							<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/default.png'>
						@endif
					</a>
					<h4 class="mt-2">
						<?php
							$artists = "";
							foreach(DB::table('album_rapper')->where('album_id', $album->id)->pluck('rapper_id') as $r_id)
							{
								$rapper = App\Models\Rapper::find($r_id);
								$artists .= $rapper->rapper_name.', ';
							}
							$artists = substr($artists, 0, -2);
						?>
						{{ $artists }} - {{ $album->album_name }}
					</h4>
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
@extends('layouts.app')

@section('title', 'Wyszukiwanie: ' . $query . ' - RapWiki')

@section('content')
	<div id="x" class="container">
		@if($rappers->count() + $albums->count() > 0)
			<div class="row">
				<h1>Wyniki</h1>
				<h5>
					Znaleziono <b>{{ $rappers->count() + $albums->count() }}</b> artykułów zawierających <b>{{ $query }}</b>, w tym 
					@if($rappers->count() > 0 && $albums->count() > 0)
						<b>{{ $rappers->count() }}</b> raperów i <b>{{ $albums->count() }}</b> albumów:
					@elseif($rappers->count() > 0)
						<b>{{ $rappers->count() }}</b> raperów:
					@else
						<b>{{ $albums->count() }}</b> albumów:
					@endif
				</h5>
			</div>
			<hr>
			<div class="row">
				@if($rappers->count() > 0)
					<div class="col-12">
						<div class="card mb-3">
							<div class="card-header">
								<p class="card-text">Wyniki wyszukiwania: raperzy</p>
							</div>
							
							<div class="card-body">
								@foreach($rappers as $rapper)
									<div class="row">
										<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-4">
											<a href="../rshow/{{ $rapper->id }}">
											@if(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.jpg'))
												<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='{{ "../storage/rappers/".$rapper->id.".jpg" }}'>
											@elseif(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.png'))
												<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='{{ "../storage/rappers/".$rapper->id.".png" }}'>
											@else
												<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='../storage/default.png'>
											@endif
											</a>
										</div>
										<div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-8">
											<h4 class="card-text" name="to-bold">
												<a href="../rshow/{{ $rapper->id }}" class="text-decoration-none">
													{{ $rapper->rapper_name }}
												</a>
											</h4>
											<p class="card-text">
												<?php
													$description = htmlspecialchars($rapper->description);
													if(strpos($description, "\r\n") != false)
													{
														$description = substr($description, 0, strpos($description, "\r\n"));
													}
													if(strlen($description) > 400)
													{
														$description = substr($description, 0, 397).'...';
													}
													echo $description;
												?>
											</p>
										</div>
									</div>
									<hr>
								@endforeach
							</div>
						</div>
					</div>
				@endif
				
				@if($albums->count() > 0)
					<div class="col-12">
						<div class="card mb-3">
							<div class="card-header">
								<p class="card-text">Wyniki wyszukiwania: albumy</p>
							</div>
							
							<div class="card-body">
								@foreach($albums as $album)
									<div class="row">
										<div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-4">
											<a href="../ashow/{{ $album->id }}">
											@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='{{ "../storage/albums/".$album->id.".jpg" }}'>
											@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='{{ "../storage/albums/".$album->id.".png" }}'>	
											@else
													<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/default.png'>
											@endif
											</a>
										</div>
										<div class="col-xl-10 col-lg-10 col-md-9 col-sm-8 col-8">
											<h4 class="card-text">
												<a href="../ashow/{{ $album->id }}" class="text-decoration-none">
													<?php
														$artists = "";
														foreach(DB::table('album_rapper')->where('album_id', $album->id)->pluck('rapper_id') as $r_id)
														{
															$rapper = App\Models\Rapper::find($r_id);
															$artists .= $rapper->rapper_name.', ';
														}
														$artists = substr($artists, 0, -2);
													?>
													{{ $artists }} - 
													<span name="to-bold">
														{{ $album->album_name }}
													</span>
												</a>
											</h4>
											<p class="card-text">
												<?php
													$description = htmlspecialchars($album->description);
													if(strpos($description, "\r\n") != false)
													{
														$description = substr($description, 0, strpos($description, "\r\n"));
													}
													if(strlen($description) > 400)
													{
														$description = substr($description, 0, 397).'...';
													}
													echo $description;
												?>
											</p>
										</div>
									</div>
									<hr>
								@endforeach
							</div>
						</div>
					</div>
				@endif
			</div>
		@else
			<div class="row">
				<h1>Wyniki</h1>
				<h5>Nie znaleziono artykułów spełniających podane kryteria. Spróbuj ponownie, używając pola wyszukiwania na pasku adresu.</h5>
			</div>
			<hr>
		@endif
	</div>
@endsection
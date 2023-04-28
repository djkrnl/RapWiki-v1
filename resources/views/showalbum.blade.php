@extends('layouts.app')

@section('title', $album->album_name . ' - RapWiki')

@section('content')
	<div class="container">
		<div class="row">
			<div class="page-header">
				<div class="float-start">
					<h1>{{ $artists }} - {{ $album->album_name }}</h1>
				</div>
				@auth
					<div class="float-end">
						<a href="../aedit/{{ $album->id }}" class="text-decoration-none">(edytuj)</a>
					</div>
				@endauth
				<div class="clearfix"></div>
			</div>
		</div>
		<hr>
		<div class="row flex-column-reverse flex-md-row">
			<div class="col-xl-9 col-lg-8 col-md-7">
				<div class="card border-0">
					<div class="card-body">
						<div>
							<?php
								echo nl2br(htmlspecialchars($album->description));
							?>
						</div><br>

						<div class="row">
							<h5>Lista utworów</h5>
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col" style="width: 5%">#</th>
										<th scope="col">Nazwa</th>
										<th scope="col" style="width: 5%">Długość</th>
									</tr>
								</thead>
								<tbody>
									@foreach($album->track->sortBy('track_nr') as $track)
										<tr>
											<td>{{ $track->track_nr }}</td>
											<td>{{ $track->track_name }}</td>
											<td>{{ $track->track_length }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="card bg-light border-secondary">
					<div class="card-body">
						<h4 class="card-title text-center">{{ $album->album_name }}</h4>
						@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
							<img class='img-fluid img-thumbnail mx-auto d-block' title='{{ $album->album_name }}' src='{{ "../storage/albums/".$album->id.".jpg" }}'>
						@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
							<img class='img-fluid img-thumbnail mx-auto d-block' title='{{ $album->album_name }}' src='{{ "../storage/albums/".$album->id.".png" }}'>
						@endif
						<table class="table table-borderless" style="table-layout: fixed;">
							<tbody>
								<tr>
									<th scope="row">Wykonawcy</th>
									<td>
										@foreach($album->rapper as $feat)
											<a href="../rshow/{{ $feat->id }}" class="text-decoration-none">{{ $feat->rapper_name }}</a><br>
										@endforeach
									</td>
								</tr>
							
								<tr>
									<th scope="row">Data wydania</th>
									<td>{{ date('d.m.Y', strtotime($album->release_date)) }}</td>
								</tr>
								
								<tr>
									<th scope="row">Rodzaj</th>
									<td>
										@foreach(Config::get('constants.types') as $type_id => $type_tr)
											@if($album->type == $type_id)
												{{ $type_tr }}
											@endif
										@endforeach
									</td>
								</tr>
								
								<tr>
									<th scope="row">Czas trwania</th>
									<td>{{ $time }}</td>
								</tr>
								
								<tr>
									<th scope="row">Gatunki</th>
									<td>{{ $genres }}</td>
								</tr>
								
								<tr>
									<th scope="row">Wytwórnia</th>
									<td>{{ $album->label }}</td>
								</tr>
								
								@if($album->studio != NULL)
									<tr>
										<th scope="row">Studio</th>
										<td>{{ $album->studio }}</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
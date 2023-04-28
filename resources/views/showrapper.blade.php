@extends('layouts.app')

@section('title', $rapper->rapper_name . ' - RapWiki')

@section('content')
	<div class="container">
		<div class="row">
			<div class="page-header">
				<div class="float-start">
					<h1>{{ $rapper->rapper_name }}</h1>
				</div>
				@auth
					<div class="float-end">
						<a href="../redit/{{ $rapper->id }}" class="text-decoration-none">(edytuj)</a>
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
								echo nl2br(htmlspecialchars($rapper->description));
							?>
						</div><br>
						
						@if($rapper->album->where('type', 'album')->count() > 0)
							<div class="row">
								<h5>Albumy</h5>
								@foreach($rapper->album->where('type', 'album')->sortByDesc('release_date') as $album)
									<div class="text-center col-sm-6 col-md-6 col-lg-4 col-xl-3">
										<a href="../ashow/{{ $album->id }}">
											@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.jpg'>
											@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.png'>
											@else
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/default.png'>
											@endif
										</a>
										<h5 class="mt-2">
											{{ $album->album_name }}
											@if($album->rapper->count() > 1)
												<?php
													$rappers = "(w/ ";
													foreach($album->rapper as $feat)
													{
														if($feat->id != $rapper->id)
														{
															$rappers .= $feat->rapper_name.", ";
														}
													}
													$rappers = substr($rappers, 0, -2);
													$rappers .= ")";
													echo $rappers;
												?>
											@endif
										</h5>
										<b>{{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $album->release_date)->year }}</b>
									</div>
								@endforeach
							</div>
						@endif
						
						@if($rapper->album->where('type', 'ep')->count() > 0)
							<div class="row">
								<h5>EPki</h5>
								@foreach($rapper->album->where('type', 'ep')->sortByDesc('release_date') as $album)
									<div class="text-center col-sm-6 col-md-6 col-lg-4 col-xl-3">
										<a href="../ashow/{{ $album->id }}">
											@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.jpg'>
											@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.png'>
											@else
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/default.png'>
											@endif
										</a>
										<h5>
											{{ $album->album_name }}
											@if($album->rapper->count() > 1)
												<?php
													$rappers = "(w/ ";
													foreach($album->rapper as $feat)
													{
														if($feat->id != $rapper->id)
														{
															$rappers .= $feat->rapper_name.", ";
														}
													}
													$rappers = substr($rappers, 0, -2);
													$rappers .= ")";
													echo $rappers;
												?>
											@endif
										</h5>
										<b>{{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $album->release_date)->year }}</b>
									</div>
								@endforeach
							</div>
						@endif
						
						@if($rapper->album->where('type', 'single')->count() > 0)
							<div class="row">
								<h5>EPki</h5>
								@foreach($rapper->album->where('type', 'single')->sortByDesc('release_date') as $album)
									<div class="text-center col-sm-6 col-md-6 col-lg-4 col-xl-3">
										<a href="../ashow/{{ $album->id }}">
											@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.jpg'>
											@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/albums/{{ $album->id }}.png'>
											@else
												<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='../storage/default.png'>
											@endif
										</a>
										<h5>
											{{ $album->album_name }}
											@if($album->rapper->count() > 1)
												<?php
													$rappers = "(w/ ";
													foreach($album->rapper as $feat)
													{
														if($feat->id != $rapper->id)
														{
															$rappers .= $feat->rapper_name.", ";
														}
													}
													$rappers = substr($rappers, 0, -2);
													$rappers .= ")";
													echo $rappers;
												?>
											@endif
										</h5>
										<b>{{ Illuminate\Support\Carbon::createFromFormat('Y-m-d', $album->release_date)->year }}</b>
									</div>
								@endforeach
							</div>
						@endif
					</div>
				</div>
			</div>
			
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="card bg-light border-secondary">
					<div class="card-body">
						<h4 class="card-title text-center">{{ $rapper->rapper_name }}</h4>
						@if(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.jpg'))
							<img class='img-fluid img-thumbnail mx-auto d-block' title='{{ $rapper->rapper_name }}' src='{{ "../storage/rappers/".$rapper->id.".jpg" }}'>
						@elseif(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.png'))
							<img class='img-fluid img-thumbnail mx-auto d-block' title='{{ $rapper->rapper_name }}' src='{{ "../storage/rappers/".$rapper->id.".png" }}'>								
						@endif
						<table class="table table-borderless" style="table-layout: fixed;">
							<tbody>
								<tr>
									<th scope="row">Imię i nazwisko</th>
									<td>{{ $rapper->full_name }}</td>
								</tr>
								
								<tr>
									<th scope="row">Data urodzenia</th>
									<td>{{ date('d.m.Y', strtotime($rapper->birth_date)) }}</td>
								</tr>
								
								<tr>
									<th scope="row">Miejsce urodzenia</th>
									<td>
										@if($rapper->birth_city != NULL)
											{{ $rapper->birth_city }},
										@endif
										{{ DB::table('countries')->where('id', $rapper->birth_country)->first()->name }}
									</td>
								</tr>
								
								@if($rapper->death_date != NULL)
									<tr>
										<th scope="row">Data śmierci</th>
										<td>{{ date('d.m.Y', strtotime($rapper->death_date)) }}</td>
									</tr>
								@endif
								
								@if($rapper->death_city != NULL && $rapper->death_country != 1)
									<tr>
										<th scope="row">Miejsce śmierci</th>
										<td>
											@if($rapper->death_city != NULL)
												{{ $rapper->death_city }},
											@endif
											{{ DB::table('countries')->where('id', $rapper->death_country)->first()->name }}
										</td>
									</tr>
								@endif
								
								<tr>
									<th scope="row">Kraj</th>
									<td>{{ DB::table('countries')->where('id', $rapper->country)->first()->name }}</td>
								</tr>
								
								<tr>
									<th scope="row">Zawody</th>
									<td>{{ $occupations }}</td>
								</tr>
								
								<tr>
									<th scope="row">Gatunki</th>
									<td>{{ $genres }}</td>
								</tr>
								
								<tr>
									<th scope="row">Status</th>
									<td>
										@foreach(Config::get('constants.statuses') as $stat_id => $stat_tr)
											@if($rapper->status == $stat_id)
												{{ $stat_tr }}
											@endif
										@endforeach
									</td>
								</tr>
								
								@if($rapper->website != NULL)
									<tr>
										<th scope="row">Strona internetowa</th>
										<td><a href="{{ $rapper->website }}" target="_blank">{{ $rapper->website }}</a></td>
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
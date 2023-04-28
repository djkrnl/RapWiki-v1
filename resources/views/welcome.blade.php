@extends('layouts.app')

@section('title', 'Strona główna - RapWiki')

@section('content')
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			var videobutton = document.getElementById('video_button');
			videobutton.addEventListener("click", () => {
				randomVideo();
			});
		});
		
		function randomVideo() {
			var random = Math.floor(Math.random() * {{ $videocount }}) + 1;
			
			fetch("http://localhost:8000/storage/videos/" + random.toString() + ".php")
				.then((response) => {
					if (response.status !== 200) {
						return Promise.reject('Błąd');
					}
					return response.text();
				})
				.then((data) => {
					document.getElementById('video').innerHTML = data;
				})
				.catch((error) => {
					console.log(error);
				});
		}

	</script>
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card border-0 mb-3 bg-image home-background">
					<div class="mask rounded" style="background-color: rgba(0, 0, 0, 0.2);">
						<div class="text-white text-center mb-5 mt-5" style="flex-direction: column; text-shadow: black 0.1em 0.1em 0.5em;">
							<h1>Witaj na <b class="text-danger">RapWiki</b>!</h1>
							<h4>To wolna encyklopedia hip-hopu, w której to <b>Ty</b> jesteś edytorem!</h4>
							<h5>
								Na stronie znajduje się już 
								<b>
									{{ DB::table('rappers')->count() + DB::table('albums')->count()}}
								</b>
								artykułów, w tym 
								<b>
									{{ DB::table('rappers')->count() }}
								</b>
								 raperów i 
								<b>
									{{ DB::table('albums')->count() }}
								</b>
								 albumów
							</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6 col-lg-6 col-xl-6">
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Polecany artykuł</p>
					</div>
					
					<div class="card-body table-responsive">
						@if($article instanceof App\Models\Rapper)
							<div class="row">
								<div class="col-lg-4 col-xl-4">
									@if(file_exists(storage_path().'/app/public/rappers/'.$article->id.'.jpg'))
										<img class='img-fluid img-thumbnail' title='{{ $article->rapper_name }}' src='{{ "../storage/rappers/".$article->id.".jpg" }}'>
									@elseif(file_exists(storage_path().'/app/public/rappers/'.$article->id.'.png'))
										<img class='img-fluid img-thumbnail' title='{{ $article->rapper_name }}' src='{{ "../storage/rappers/".$article->id.".png" }}'>
									@else
										<img class='img-fluid img-thumbnail' title='{{ $article->rapper_name }}' src='../storage/default.png'>
									@endif
								</div>
								
								<div class="col-lg-8 col-xl-8">
									<h4 class="card-text">
										<a href="../rshow/{{ $article->id }}" class="text-decoration-none">
											{{ $article->rapper_name }}
										</a>
									</h4>
									<p class="card-text">
										<?php
											$description = htmlspecialchars($article->description);
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
						@elseif($article instanceof App\Models\Album)
							<div class="row">
								<div class="col-lg-4 col-xl-4">
									@if(file_exists(storage_path().'/app/public/albums/'.$article->id.'.jpg'))
										<img class='img-fluid img-thumbnail' title='{{ $article->album_name }}' src='{{ "../storage/albums/".$article->id.".jpg" }}'>
									@elseif(file_exists(storage_path().'/app/public/albums/'.$article->id.'.png'))
										<img class='img-fluid img-thumbnail' title='{{ $article->album_name }}' src='{{ "../storage/albums/".$article->id.".png" }}'>
									@else
										<img class='img-fluid img-thumbnail' title='{{ $article->album_name }}' src='../storage/default.png'>
									@endif
								</div>
								
								<div class="col-lg-8 col-xl-8">
									<h4 class="card-text">
										<a href="../ashow/{{ $article->id }}" class="text-decoration-none">
											<?php
												$artists = "";
												foreach(DB::table('album_rapper')->where('album_id', $article->id)->pluck('rapper_id') as $r_id)
												{
													$rapper = App\Models\Rapper::find($r_id);
													$artists .= $rapper->rapper_name.', ';
												}
												$artists = substr($artists, 0, -2);
											?>
											{{ $artists }} - {{ $article->album_name }}
										</a>
									</h4>
									<p class="card-text">
										<?php
											$description = htmlspecialchars($article->description);
											if(strpos($description, "\r\n") != false)
											{
												$description = substr($description, 0, strpos($description, "\r\n"));
											}
											if(strlen($description) > 300)
											{
												$description = substr($description, 0, 297).'...';
											}
											echo $description;
										?>
									</p>
								</div>
							</div>
						@endif
					</div>
				</div>
				
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Ostatnio dodani raperzy</p>
					</div>
					
					<div class="card-body table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col" style="width: 20%;">Data</th>
									<th scope="col">Nazwa</th>
									<th scope="col" style="width: 20%;">Autor</th>
								</tr>
							</thead>
							<tbody>
								@foreach($rappers as $rapper)
									<tr>
										<th scope="row">{{ date('d.m.Y', strtotime($rapper->created_at)) }}</td>
										<th scope="row"><a href="../rshow/{{ $rapper->id }}" class="text-decoration-none">{{ $rapper->rapper_name }}</a></td>
										<td>{{ App\Models\User::where('id', $rapper->user_id)->pluck('name')->first() }}</td>
									</tr>
								@endforeach                   
							 </tbody>
						</table>
					</div>
				</div>
				
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Ostatnio dodane albumy</p>
					</div>
					
					<div class="card-body table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th scope="col" style="width: 20%;">Data</th>
									<th scope="col">Nazwa</th>
									<th scope="col" style="width: 20%;">Autor</th>
								</tr>
							</thead>
							<tbody>
								@foreach($albums as $album)
									<tr>
										<th scope="row">{{ date('d.m.Y', strtotime($album->created_at)) }}</td>
										<th scope="row">
											<a href="../ashow/{{ $album->id }}" class="text-decoration-none">
												<?php
													$artists2 = "";
													foreach(DB::table('album_rapper')->where('album_id', $album->id)->pluck('rapper_id') as $r_id)
													{
														$rapper = App\Models\Rapper::find($r_id);
														$artists2 .= $rapper->rapper_name.', ';
													}
													$artists2 = substr($artists2, 0, -2);
												?>
												{{ $artists2 }} - {{ $album->album_name }}
											</a>
										</td>
										<td>{{ App\Models\User::where('id', $album->user_id)->pluck('name')->first() }}</td>
									</tr>
								@endforeach                   
							 </tbody>
						</table>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-lg-6 col-xl-6">
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Wiadomości</p>
					</div>
					
					<div class="card-body">
						<div class="row">
							<div class="col-lg-8 col-xl-8">
								<ul>
									<li>Amerykański raper Vic Mensa (<i>na zdjęciu</i>) został aresztowany za nielegalne posiadanie bardzo dużej ilości narkotyków, w tym 41 gramów LSD. <small>(18 stycznia)</small></li>
									<li>BROCKHAMPTON, amerykański hip-hopowy boysband nieoczekiwanie ogłosił zawieszenie działalności jako grupa, tuż przed planowanym rozpoczęciem ich trasy koncertowej. <small>(14 stycznia)</small></li>
									<li>Wokalista R&B i raper The Weeknd wydał swój piąty studyjny album, Dawn FM. <small>(6 stycznia)</small></li>
									<li>64. ceremonia wręczenia nagród Grammy została przeniesiona z 31 stycznia na 5 kwietnia 2022 roku z powodu rozprzestrzeniania się wariantu Omikron wirusa SARS-CoV-2. <small>(5 stycznia)</small></li>
									<li>Raper Drakeo The Ruler zginął po tym, jak został ugodzony nożem przez nieznanych sprawców na festiwalu Once Upon A Time In LA w Los Angeles. <small>(19 grudnia)</small></li>
								</ul>
							</div>
							<div class="col-lg-4 col-xl-4">
								<img class='img-fluid img-thumbnail' title='Wiadomości' src='../storage/news.jpg'>
							</div>
						</div>
					</div>
				</div>
				
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Czy wiesz...</p>
					</div>
					
					<div class="card-body">
						<ul>
							<li>...że legendarny założyciel grupy A Tribe Called Quest, Q-Tip w tym roku kończy <b>52 lata?</b></li>
							<li>...jak nazywał się <b>debiutancki</b> album Kanye Westa?</li>
							<li>...który amerykański raper zsamplował utwór <b>Krzysztofa Krawczyka</b> na swoim najsłynniejszym albumie, <i>Reloaded?</i></li>
							<li>...z jakiego <b>kraju</b> pochodzi Drake?</li>
							<li>...kto jako pierwszy raper w historii wygrał <b>nagrodę Pulitzera?</b></li>
						</ul>
					</div>
				</div>
				
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Teledyski</p>
					</div>
					
					<div class="card-body">
						<div class="ratio ratio-16x9 mb-3" id="video">
							<iframe class="embed-responsive-item" title="Teledysk" src="https://www.youtube.com/embed/JUKh7Cj_3Fo" allowfullscreen></iframe>
						</div>
						
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary" id="video_button">Wylosuj teledysk</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
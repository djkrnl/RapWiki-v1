@extends('layouts.app')

@section('title', 'Twoje konto - RapWiki')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="card mb-3 bg-image home-background">
					<div class="mask" style="background-color: rgba(0, 0, 0, 0.2);">
						<div class="text-white mb-1 mt-1" style="text-shadow: black 0.1em 0.1em 0.2em;">
							<div class="card-body">
								<h1 class="card-title">{{ Auth::user()->name }}</h1>
								<h4 class="card-subtitle">Użytkownik od {{ date('d.m.Y', strtotime(Auth::user()->created_at )) }}</h4>
							</div>
						</div>
					</div>		
				</div>
			</div>
		</div>
		
		<div class="row flex-column-reverse flex-md-row">
			<div class="col-md-8 col-lg-8 col-xl-8">
				<div class="card mb-3">
					<div class="card-header">
						<div class="page-header">
							<div class="float-start">
								<p class="card-text">Twoi najnowsi raperzy</p>
							</div>
							<div class="float-end">
								<a href="{{ route('rappers') }}" class="card-text text-decoration-none">Zobacz wszystko</a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					
					<div class="card-body table-responsive">
						@if($rappers->count() > 0)
							<table class="table align-middle">
								<thead>
									<tr>
										<th scope="col" style="width: 10%"></th>
										<th scope="col">Pseudonim</th>
										<th scope="col">Imię i nazwisko</th>
										<th scope="col" style="width: 20%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($rappers as $rapper)
										<tr>
											<th scope="row"><a href="../rshow/{{ $rapper->id }}" class="text-decoration-none">Link</a></th>
											<td>{{ $rapper->rapper_name }}</td>
											<td>{{ $rapper->full_name }}</td>
											<td class="text-center">
												@if($rapper->user_id == \Auth::user()->id)
													<a href="{{ route('redit', $rapper) }}" class="btn btn-success">Edytuj</a>
													<a href="{{ route('rdelete', $rapper->id) }}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tego rapera?')">Usuń</a>
												@endif
											</td>
										</tr>
									@endforeach                   
								</tbody>
							</table>  
						@else
							<p class="card-text text-center">Nie dodałeś jeszcze żadnego rapera.</p>
						@endif
					</div>
				</div>
				
				<div class="card mb-3">
					<div class="card-header">
						<div class="page-header">
							<div class="float-start">
								<p class="card-text">Twoje najnowsze albumy</p>
							</div>
							<div class="float-end">
								<a href="{{route('albums')}}" class="card-text text-decoration-none">Zobacz wszystko</a>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
					
					<div class="card-body table-responsive">
						@if($albums->count() > 0)
							<table class="table align-middle">
								<thead>
									<tr>
										<th scope="col" style="width: 10%"></th>
										<th scope="col">Tytuł</th>
										<th scope="col">Wykonawcy</th>
										<th scope="col" style="width: 20%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($albums as $album)
										<tr>
											<th scope="row"><a href="../ashow/{{ $album->id }}" class="text-decoration-none">Link</a></th>
											<td>{{ $album->album_name }}</td>
											<td>
												<?php
													$artists = "";
													foreach(DB::table('album_rapper')->where('album_id', $album->id)->pluck('rapper_id') as $r_id)
													{
														$rapper = App\Models\Rapper::find($r_id);
														$artists .= $rapper->rapper_name.', ';
													}
													$artists = substr($artists, 0, -2);
													echo $artists;
												?>
											</td>
											<td class="text-center">
												@if($album->user_id == \Auth::user()->id)
													<a href="{{route('aedit', $album)}}" class="btn btn-success">Edytuj</a>
													<a href="{{route('adelete', $album->id)}}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć ten album?')">Usuń</a>
												@endif
											</td>
										</tr>
									@endforeach                   
								 </tbody>
							</table>
						@else
							<p class="card-text text-center">Nie dodałeś jeszcze żadnego albumu.</p>
						@endif
					</div>
				</div>
			</div>
			
			<div class="col-md-4 col-lg-4 col-xl-4">
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Stwórz artykuł</p>
					</div>
					
					<div class="card-body text-center">
						<a href="{{route('rcreate')}}" class="btn btn-lg btn-primary m-3">Nowy raper</a>
						<a href="{{route('acreate')}}" class="btn btn-lg btn-primary m-3">Nowy album</a>
					</div>
				</div>
			
				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Podsumowanie</p>
					</div>
					
					<div class="card-body">
						<h6 class="card-subtitle">Wiek konta</h6>
						<p class="card-text mb-3">{{ $datedays }}</p>
						<h6 class="card-subtitle">Liczba dodanych raperów</h6>
						<p class="card-text mb-3">{{ DB::table('rappers')->where('user_id', \Auth::user()->id)->count() }}</p>
						<h6 class="card-subtitle">Liczba dodanych albumów</h6>
						<p class="card-text mb-3">{{ DB::table('albums')->where('user_id', \Auth::user()->id)->count() }}</p>
						<h6 class="card-subtitle">Liczba dodanych utworów</h6>
						<p class="card-text">{{ $tracks }}</p>
					</div>
				</div>

				<div class="card mb-3">
					<div class="card-header">
						<p class="card-text">Szczegóły</p>
					</div>
					
					<div class="card-body">
						<div class="page-header">
							<div class="float-start">
								<h6 class="card-subtitle">Nazwa użytkownika</h6>
							</div>
							<div class="float-end">
								<h6 class="card-subtitle text-end text-decoration-none">
									<a href="./changeusername" class="text-decoration-none">Zmień</a>
								</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<p class="card-text">{{ Auth::user()->name }}</p>
						<div class="page-header">
							<div class="float-start">
								<h6 class="card-subtitle">Adres e-mail</h6>
							</div>
							<div class="float-end">
								<h6 class="card-subtitle text-end">
									<a href="./changeemail" class="text-decoration-none">Zmień</a>
								</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<p class="card-text mb-3">{{ Auth::user()->email }}</p>
						<div class="page-header">
							<div class="float-start">
								<h6 class="card-subtitle">Hasło</h6>
							</div>
							<div class="float-end">
								<h6 class="card-subtitle text-end text-decoration-none">
									<a href="./changepassword" class="text-decoration-none">Zmień</a>
								</h6>
							</div>
							<div class="clearfix"></div>
						</div>
						<p class="card-text">********</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
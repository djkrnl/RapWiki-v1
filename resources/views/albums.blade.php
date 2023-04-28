@extends('layouts.app')

@section('title', 'Twoje albumy - RapWiki')

@section('content')
	<div class="container">
		<div class="row">
			<div>
				<div class="card">
					<div class="card-header">{{ __('Twoje albumy') }}</div>
					<div class="card-body table-responsive">
						@if($albums->count() > 0)
							<table class="table align-middle">
								<thead>
									<tr>
										<th scope="col" style="width: 10%"></th>
										<th scope="col">{{ __('Data utworzenia') }}</th>
										<th scope="col">{{ __('Tytuł') }}</th>
										<th scope="col">{{ __('Wykonawcy') }}</th>
										<th scope="col" style="width: 20%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($albums as $album)
										<tr>
											<th scope="row"><a href="../ashow/{{ $album->id }}" class="text-decoration-none">{{ __('Link') }}</a></th>
											<td>{{ $album->created_at }}</td>
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
											<td>
												@if($album->user_id == \Auth::user()->id)
													<a href="{{route('aedit', $album)}}" class="btn btn-success">{{ __('Edytuj') }}</a>
													<a href="{{route('adelete', $album->id)}}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć ten album?')">{{ __('Usuń') }}</a>
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
		</div>
	</div>
@endsection
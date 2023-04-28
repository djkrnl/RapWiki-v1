@extends('layouts.app')

@section('title', 'Edytuj album - RapWiki')

@section('content')
	<script>
		$(document).ready(function() {
			$('#rapper_add').click(function() {
				$('#artists').clone().appendTo('#rappers');
			});
			
			$('#rapper_delete').click(function() {
				if($('div[id="artists"]').length > 1)
				{
					$('#artists:last-child').remove();
				}
			});
			
			$('#track_add').click(function() {
				$('#songs').clone().appendTo('#songs-table').find('input[name="track_nr[]"]').val($('tbody[id="songs"]').length);
				$('#songs:last-child').find('input[name="track_name[]"]').val('');
				$('#songs:last-child').find('input[name="track_length[]"]').val('');
			});
			
			$('#track_delete').click(function() {
				if($('tbody[id="songs"]').length > 1)
				{
					$('#songs:last-child').remove();
				}
			});
			
			$('input[type="radio"]').click(function() {
				if($(this).attr("value") == "pic_edit") {
					$(".pic-add").show('slow');
				}
				if($(this).attr("value") == "pic_delete") {
					$(".pic-add").hide('slow');
				}
			});
		});
	</script>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-lg-8 col-xl-8">
				<div class="card">
					<div class="card-header">{{ __('Edytuj album') }}</div>

					<div class="card-body">
						 @if($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div>
							<form role="form" action="{{ route('aupdate', $album )}}" id="album-form" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="album_name" class="form-label">Nazwa albumu<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="album_name" id="album_name" placeholder="Nazwa albumu" value="{{ $album->album_name }}" required>
								</div><br>
								
								<label class="form-label">Wykonawcy<span style="color: red;">*</span>:</label>
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="rappers">
									@foreach(DB::table('album_rapper')->where('album_id', $album->id)->pluck('rapper_id') as $r_id)
										<div id="artists">
											<select class="form-control form-select" name="rapper[]">
												@foreach(DB::table('rappers')->pluck('id', 'rapper_name'); as $name => $id)
													@if($id == $r_id)
														<option value="{{ $id }}" selected>{{ $name }}</option>
													@else
														<option value="{{ $id }}">{{ $name }}</option>
													@endif
												@endforeach
											</select>
										</div>
									@endforeach
								</div><br>
								
								<div class="form-group">
									<button type="button" class="btn btn-success" id="rapper_add">Dodaj wykonawcę</button>
									<button type="button" class="btn btn-danger" id="rapper_delete">Usuń wykonawcę</button>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="release_date" class="form-label">Data wydania<span style="color: red;">*</span>:</label>
									<input type="date" class="form-control" name="release_date" id="release_date" value="{{ $album->release_date }}" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="type-btn" class="form-label">Rodzaj<span style="color: red;">*</span>:</label>
									<div class="btn-group d-flex w-100">
										@foreach(Config::get('constants.types') AS $type_id => $type_tr)
											@if($album->type == $type_id)
												<input class="btn-check" type="radio" id="{{ $type_id }}" value="{{ $type_id }}" name="type" required checked>
											@else
												<input class="btn-check" type="radio" id="{{ $type_id }}" value="{{ $type_id }}" name="type" required>
											@endif
											<label class="btn btn-outline-primary" for="{{ $type_id }}">{{ $type_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="genre-btn" class="form-label">Gatunki<span style="color: red;">*</span>:</label>
									<div id="genre-btn">
										@foreach(Config::get('constants.genres') AS $gen_id => $gen_tr)
											@if(str_contains($album->genre, $gen_id))
												<input class="btn-check" type="checkbox" id="{{ $gen_id }}" value="{{ $gen_id }}" name="genre[]" checked>
											@else
												<input class="btn-check" type="checkbox" id="{{ $gen_id }}" value="{{ $gen_id }}" name="genre[]">
											@endif
											<label class="btn btn-outline-primary btn-30" for="{{ $gen_id }}">{{ $gen_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<label class="form-label">Utwory<span style="color: red;">*</span>:</label>
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="tracks">
									<table id="songs-table">
										<thead>
											<th scope="col" style="width: 15%">#</th>
											<th scope="col">Nazwa</th>
											<th scope="col" style="width: 15%">Długość</th>
										</thead>
										@foreach(DB::table('album_tracks')->where('album_id', $album->id)->get() as $track)
											<tbody id="songs">
												<td><input type="number" class="form-control" name="track_nr[]" value="{{ $track->track_nr }}" readonly></td>
												<td><input type="text" class="form-control" name="track_name[]" value="{{ $track->track_name }}" required></td>
												<td><input type="text" class="form-control" name="track_length[]" value="{{ $track->track_length }}" required></td>
											</tbody>
										@endforeach
									</table>
								</div><br>
								
								<div class="form-group">
									<button type="button" class="btn btn-success" id="track_add">Dodaj utwór</button>
									<button type="button" class="btn btn-danger" id="track_delete">Usuń utwór</button>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="label" class="form-label">Wytwórnia<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="label" id="label" placeholder="Wytwórnia" value="{{ $album->label }}" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="studio" class="form-label">Studio:</label>
									<input type="text" class="form-control" name="studio" id="studio" placeholder="Studio" value="{{ $album->studio }}">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="description" class="form-label">Treść artykułu<span style="color: red;">*</span>:</label>
									<textarea class="form-control" name="description" id="description" rows="12" required>{{ $album->description }}</textarea>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="pic" class="form-label">Zdjęcie:</label>
									<div class="pic">
										@if(file_exists(storage_path().'/app/public/albums/'.$album->id.'.jpg'))
											<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='{{ "../storage/albums/".$album->id.".jpg" }}'>
										
											<div class="btn-group d-flex w-100" id="pic-btn">
												<input class="btn-check" type="radio" id="pic_edit" value="pic_edit" name="pic_choice" required checked>
												<label class="btn btn-outline-primary" for="pic_edit">Zostaw/zmień</label>
												<input class="btn-check" type="radio" id="pic_delete" value="pic_delete" name="pic_choice" required>
												<label class="btn btn-outline-primary" for="pic_delete">Usuń</label>
											</div>
										@elseif(file_exists(storage_path().'/app/public/albums/'.$album->id.'.png'))
											<img class='img-fluid img-thumbnail' title='{{ $album->album_name }}' src='{{ "../storage/albums/".$album->id.".png" }}'>
											
											<div class="btn-group d-flex w-100" id="pic-btn">
												<input class="btn-check" type="radio" id="pic_edit" value="pic_edit" name="pic_choice" required checked>
												<label class="btn btn-outline-primary" for="pic_edit">Zostaw/zmień</label>
												<input class="btn-check" type="radio" id="pic_delete" value="pic_delete" name="pic_choice" required>
												<label class="btn btn-outline-primary" for="pic_delete">Usuń</label>
											</div>
										@else
											<b>brak</b>
											<div class="btn-group d-flex w-100" id="pic-btn">
												<input class="btn-check" type="radio" id="pic_edit" value="pic_edit" name="pic_choice" required checked>
												<label class="btn btn-outline-primary" for="pic_edit">Zostaw/dodaj</label>
												<input class="btn-check" type="radio" id="pic_delete" value="pic_delete" name="pic_choice" required disabled>
												<label class="btn btn-outline-primary" for="pic_delete">Usuń</label>
											</div>
										@endif
									</div>
									
									<div class="pic-add">
										<br>
										<input type="file" class="form-control" id="picture" name="picture" accept=".png, .jpg">
									</div>
								</div><br>
								
								<div class="form-group">
									<b><span style="color: red;">*</span> - pola wymagane</b>
								</div><br>
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Zaktualizuj artykuł</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
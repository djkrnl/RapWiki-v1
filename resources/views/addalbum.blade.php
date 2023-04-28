@extends('layouts.app')

@section('title', 'Dodaj album - RapWiki')

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
				$('#songs').clone().appendTo('#songs-table');
				$('#songs:last-child').find('input[name="track_nr[]"]').val($('tbody[id="songs"]').length);
				$('#songs:last-child').find('input[name="track_name[]"]').val('');
				$('#songs:last-child').find('input[name="track_length[]"]').val('');
			});
			
			$('#track_delete').click(function() {
				if($('tbody[id="songs"]').length > 1)
				{
					$('#songs:last-child').remove();
				}
			});
		});
	</script>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-lg-8 col-xl-8">
				<div class="card">
					<div class="card-header">{{ __('Dodaj album') }}</div>

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
							<form role="form" action="{{ route('astore') }}" id="album-form" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="album_name" class="form-label">Nazwa albumu<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="album_name" id="album_name" placeholder="Nazwa albumu" required>
								</div><br>
								
								<label class="form-label">Wykonawcy<span style="color: red;">*</span>:</label>
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}" id="rappers">
									<div id="artists">
										<select class="form-control form-select" name="rapper[]">
											@foreach(DB::table('rappers')->pluck('id', 'rapper_name'); as $name => $id)
												<option value="{{ $id }}">{{ $name }}</option>
											@endforeach
										</select>
									</div>
								</div><br>
								
								<div class="form-group">
									<button type="button" class="btn btn-success" id="rapper_add">Dodaj wykonawcę</button>
									<button type="button" class="btn btn-danger" id="rapper_delete">Usuń wykonawcę</button>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="release_date" class="form-label">Data wydania<span style="color: red;">*</span>:</label>
									<input type="date" class="form-control" name="release_date" id="release_date" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="type-btn" class="form-label">Rodzaj<span style="color: red;">*</span>:</label>
									<div class="btn-group d-flex w-100">
										@foreach(Config::get('constants.types') AS $type_id => $type_tr)
											<input class="btn-check" type="radio" id="{{ $type_id }}" value="{{ $type_id }}" name="type" required>
											<label class="btn btn-outline-primary" for="{{ $type_id }}">{{ $type_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="genre-btn" class="form-label">Gatunki<span style="color: red;">*</span>:</label>
									<div id="genre-btn">
										@foreach(Config::get('constants.genres') AS $gen_id => $gen_tr)
											<input class="btn-check" type="checkbox" id="{{ $gen_id }}" value="{{ $gen_id }}" name="genre[]">
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
										<tbody id="songs">
											<td><input type="number" class="form-control" name="track_nr[]" value="1" readonly></td>
											<td><input type="text" class="form-control" name="track_name[]" required></td>
											<td><input type="text" class="form-control" name="track_length[]" required></td>
										</tbody>
									</table>
								</div><br>
								
								<div class="form-group">
									<button type="button" class="btn btn-success" id="track_add">Dodaj utwór</button>
									<button type="button" class="btn btn-danger" id="track_delete">Usuń utwór</button>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="label" class="form-label">Wytwórnia<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="label" id="label" placeholder="Wytwórnia" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="studio" class="form-label">Studio:</label>
									<input type="text" class="form-control" name="studio" id="studio" placeholder="Studio">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="description" class="form-label">Treść artykułu<span style="color: red;">*</span>:</label>
									<textarea class="form-control" name="description" id="description" rows="12" required></textarea>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="picture" class="form-label">Zdjęcie:</label>
									<input type="file" class="form-control" id="picture" name="picture" accept=".png, .jpg">
								</div><br>
								
								<div class="form-group">
									<b><span style="color: red;">*</span> - pola wymagane</b>
								</div><br>
								
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Utwórz artykuł</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
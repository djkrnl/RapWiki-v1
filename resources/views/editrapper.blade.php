@extends('layouts.app')

@section('title', 'Edytuj rapera - RapWiki')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-lg-8 col-xl-8">
				<div class="card">
					<div class="card-header">{{ __('Edytuj rapera') }}</div>

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
							<form role="form" action="{{ route('rupdate', $rapper )}}" id="rapper-form" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="rapper_name" class="form-label">Pseudonim<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="rapper_name" id="rapper_name" placeholder="Pseudonim" value="{{ $rapper->rapper_name }}" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="full_name" class="form-label">Imię i nazwisko<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Imię i nazwisko" value="{{ $rapper->full_name }}" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="birth_date" class="form-label">Data urodzenia<span style="color: red;">*</span>:</label>
									<input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ $rapper->birth_date }}" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="birth_city" class="form-label">Miejsce urodzenia:</label>
									<input type="text" class="form-control" name="birth_city" id="birth_city" placeholder="Miejsce urodzenia" value="{{ $rapper->birth_city }}">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="birth_country" class="form-label">Kraj urodzenia<span style="color: red;">*</span>:</label>
									<select class="form-control form-select" id="birth_country" name="birth_country">
										@foreach(DB::table('countries')->pluck('name', 'code'); as $key => $country)
											@if($rapper->birth_country == DB::table('countries')->where('name', $country)->first()->id)
												<option value="{{ $key }}" selected>{{ $country }}</option>
											@else
												<option value="{{ $key }}">{{ $country }}</option>
											@endif
										@endforeach
									</select>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="death_date" class="form-label">Data śmierci:</label>
									<input type="date" class="form-control" name="death_date" id="death_date" value="{{ $rapper->death_date }}">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="death_city" class="form-label">Miejsce śmierci:</label>
									<input type="text" class="form-control" name="death_city" id="death_city" placeholder="Miejsce śmierci" value="{{ $rapper->death_city }}">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="death_country" class="form-label">Kraj śmierci:</label>
									<select class="form-control form-select" id="death_country" name="death_country">
										@foreach(DB::table('countries')->pluck('name', 'code'); as $key => $country)
											@if($rapper->death_country == DB::table('countries')->where('name', $country)->first()->id)
												<option value="{{ $key }}" selected>{{ $country }}</option>
											@else
												<option value="{{ $key }}">{{ $country }}</option>
											@endif
										@endforeach
									</select>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="country" class="form-label">Kraj zamieszkania<span style="color: red;">*</span>:</label>
									<select class="form-control form-select" id="country" name="country">
										@foreach(DB::table('countries')->pluck('name', 'code'); as $key => $country)
											@if($rapper->country == DB::table('countries')->where('name', $country)->first()->id)
												<option value="{{ $key }}" selected>{{ $country }}</option>
											@else
												<option value="{{ $key }}">{{ $country }}</option>
											@endif
										@endforeach
									</select>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="occupation-btn" class="form-label">Zawody<span style="color: red;">*</span>:</label>
									<div class="btn-group d-flex w-100">
										@foreach(Config::get('constants.occupations') AS $occ_id => $occ_tr)
											@if(str_contains($rapper->occupation, $occ_id))
												<input class="btn-check" type="checkbox" id="{{ $occ_id }}" value="{{ $occ_id }}" name="occupation[]" checked>
											@else
												<input class="btn-check" type="checkbox" id="{{ $occ_id }}" value="{{ $occ_id }}" name="occupation[]">
											@endif
											<label class="btn btn-outline-primary" for="{{ $occ_id }}">{{ $occ_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="genre-btn" class="form-label">Gatunki<span style="color: red;">*</span>:</label>
									<div id="genre-btn">
										@foreach(Config::get('constants.genres') AS $gen_id => $gen_tr)
											@if(str_contains($rapper->genre, $gen_id))
												<input class="btn-check" type="checkbox" id="{{ $gen_id }}" value="{{ $gen_id }}" name="genre[]" checked>
											@else
												<input class="btn-check" type="checkbox" id="{{ $gen_id }}" value="{{ $gen_id }}" name="genre[]">
											@endif
											<label class="btn btn-outline-primary btn-30" for="{{ $gen_id }}">{{ $gen_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="status-btn" class="form-label">Status<span style="color: red;">*</span>:</label>
									<div class="btn-group d-flex w-100" id="status-btn">
										@foreach(Config::get('constants.statuses') AS $stat_id => $stat_tr)
											@if($rapper->status == $stat_id)
												<input class="btn-check" type="radio" id="{{ $stat_id }}" value="{{ $stat_id }}" name="status" required checked>
											@else
												<input class="btn-check" type="radio" id="{{ $stat_id }}" value="{{ $stat_id }}" name="status" required>
											@endif
											<label class="btn btn-outline-primary" for="{{ $stat_id }}">{{ $stat_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="website" class="form-label">Strona internetowa:</label>
									<input type="text" class="form-control" name="website" id="website" placeholder="Strona internetowa" value="{{ $rapper->website }}">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="description" class="form-label">Treść artykułu<span style="color: red;">*</span>:</label>
									<textarea class="form-control" name="description" id="description" rows="12" required>{{ $rapper->description }}</textarea>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="pic" class="form-label">Zdjęcie:</label>
									<div class="pic">
										@if(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.jpg'))
											<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='{{ "../storage/rappers/".$rapper->id.".jpg" }}'>
										
											<div class="btn-group d-flex w-100" id="pic-btn">
												<input class="btn-check" type="radio" id="pic_edit" value="pic_edit" name="pic_choice" required checked>
												<label class="btn btn-outline-primary" for="pic_edit">Zostaw/zmień</label>
												<input class="btn-check" type="radio" id="pic_delete" value="pic_delete" name="pic_choice" required>
												<label class="btn btn-outline-primary" for="pic_delete">Usuń</label>
											</div>
										@elseif(file_exists(storage_path().'/app/public/rappers/'.$rapper->id.'.png'))
											<img class='img-fluid img-thumbnail' title='{{ $rapper->rapper_name }}' src='{{ "../storage/rappers/".$rapper->id.".png" }}'>
											
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
									
									<script>
										$('input[type="radio"]').click(function() {
											if($(this).attr("value") == "pic_edit") {
												$(".pic-add").show('slow');
											}
											if($(this).attr("value") == "pic_delete") {
												$(".pic-add").hide('slow');
											}
										});
									</script>
									
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
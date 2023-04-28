@extends('layouts.app')

@section('title', 'Dodaj rapera - RapWiki')

@section('content')
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8 col-lg-8 col-xl-8">
				<div class="card">
					<div class="card-header">{{ __('Dodaj rapera') }}</div>

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
							<form role="form" action="{{ route('rstore') }}" id="rapper-form" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="rapper_name" class="form-label">Pseudonim<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="rapper_name" id="rapper_name" placeholder="Pseudonim" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="full_name" class="form-label">Imię i nazwisko<span style="color: red;">*</span>:</label>
									<input type="text" class="form-control" name="full_name" id="full_name" placeholder="Imię i nazwisko" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="birth_date" class="form-label">Data urodzenia<span style="color: red;">*</span>:</label>
									<input type="date" class="form-control" name="birth_date" id="birth_date" required>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="birth_city" class="form-label">Miejsce urodzenia:</label>
									<input type="text" class="form-control" name="birth_city" id="birth_city" placeholder="Miejsce urodzenia">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="birth_country" class="form-label">Kraj urodzenia<span style="color: red;">*</span>:</label>
									<select class="form-control form-select" id="birth_country" name="birth_country">
										@foreach(DB::table('countries')->pluck('name', 'code'); as $key => $country)
											<option value="{{ $key }}">{{ $country }}</option>
										@endforeach
									</select>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="death_date" class="form-label">Data śmierci:</label>
									<input type="date" class="form-control" name="death_date" id="death_date">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="death_city" class="form-label">Miejsce śmierci:</label>
									<input type="text" class="form-control" name="death_city" id="death_city" placeholder="Miejsce śmierci">
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="death_country" class="form-label">Kraj śmierci:</label>
									<select class="form-control form-select" id="death_country" name="death_country">
										@foreach(DB::table('countries')->pluck('name', 'code'); as $key => $country)
											<option value="{{ $key }}">{{ $country }}</option>
										@endforeach
									</select>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="country" class="form-label">Kraj zamieszkania<span style="color: red;">*</span>:</label>
									<select class="form-control form-select" id="country" name="country">
										@foreach(DB::table('countries')->pluck('name', 'code'); as $key => $country)
											<option value="{{ $key }}">{{ $country }}</option>
										@endforeach
									</select>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="occupation-btn" class="form-label">Zawody<span style="color: red;">*</span>:</label>
									<div class="btn-group d-flex w-100">
										@foreach(Config::get('constants.occupations') AS $occ_id => $occ_tr)
											<input class="btn-check" type="checkbox" id="{{ $occ_id }}" value="{{ $occ_id }}" name="occupation[]">
											<label class="btn btn-outline-primary" for="{{ $occ_id }}">{{ $occ_tr }}</label>
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
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="status-btn" class="form-label">Status<span style="color: red;">*</span>:</label>
									<div class="btn-group d-flex w-100" id="status-btn">
										@foreach(Config::get('constants.statuses') AS $stat_id => $stat_tr)
											<input class="btn-check" type="radio" id="{{ $stat_id }}" value="{{ $stat_id }}" name="status" required>
											<label class="btn btn-outline-primary" for="{{ $stat_id }}">{{ $stat_tr }}</label>
										@endforeach
									</div>
								</div><br>
								
								<div class="form-group{{ $errors->has('message')?'has-error':'' }}">
									<label for="website" class="form-label">Strona internetowa:</label>
									<input type="text" class="form-control" name="website" id="website" placeholder="Strona internetowa">
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
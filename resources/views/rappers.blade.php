@extends('layouts.app')

@section('title', 'Twoi raperzy - RapWiki')

@section('content')
	<div class="container">
		<div class="row">
			<div>
				<div class="card">
					<div class="card-header">{{ __('Twoi raperzy') }}</div>
					<div class="card-body table-responsive">
						@if($rappers->count() > 0)
							<table class="table align-middle">
								<thead>
									<tr>
										<th scope="col" style="width: 10%"></th>
										<th scope="col">{{ __('Data utworzenia') }}</th>
										<th scope="col">{{ __('Pseudonim') }}</th>
										<th scope="col">{{ __('Imię i nazwisko') }}</th>
										<th scope="col" style="width: 20%"></th>
									</tr>
								</thead>
								<tbody>
									@foreach($rappers as $rapper)
										<tr>
											<th scope="row"><a href="../rshow/{{ $rapper->id }}" class="text-decoration-none">{{ __('Link') }}</a></th>
											<td>{{ $rapper->created_at }}</td>
											<td>{{ $rapper->rapper_name }}</td>
											<td>{{ $rapper->full_name }}</td>
											<td>
												@if($rapper->user_id == \Auth::user()->id)
													<a href="{{route('redit', $rapper)}}" class="btn btn-success">{{ __('Edytuj') }}</a>
													<a href="{{route('rdelete', $rapper->id)}}" class="btn btn-danger" onclick="return confirm('Czy na pewno chcesz usunąć tego rapera?')">{{ __('Usuń') }}</a>
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
			</div>
		</div>
	</div>
@endsection
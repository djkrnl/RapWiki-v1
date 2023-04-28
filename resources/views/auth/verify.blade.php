@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Na Twój adres e-mail wysłana została wiadomość z instrukcjami resetowania hasła.') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Na Twój adres e-mail wysłana została wiadomość z instrukcjami resetowania hasła.') }}
                        </div>
                    @endif

                    {{ __('Sprawdź, czy wiadomość z instrukcjami znajduje się w Twojej skrzynce.') }}
                    {{ __('Jeśli nie, ') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('kliknij tutaj, by wysłać prośbę o ponowne wysłanie wiadomości') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

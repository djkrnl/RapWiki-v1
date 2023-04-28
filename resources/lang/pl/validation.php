<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'The :attribute must be accepted.',
    'accepted_if' => 'The :attribute must be accepted when :other is :value.',
    'active_url' => 'The :attribute is not a valid URL.',
    'after' => ':attribute musi być późniejsza niż :date.',
    'after_or_equal' => ':attribute musi być późniejsza lub taka sama jak :date.',
    'alpha' => 'The :attribute must only contain letters.',
    'alpha_dash' => ':attribute może zawierać wyłącznie litery, cyfry, myślniki i podkreślniki.',
    'alpha_num' => 'The :attribute must only contain letters and numbers.',
    'array' => ':attribute musi być tablicą.',
    'before' => ':attribute musi być wcześniejsza niż :date.',
    'before_or_equal' => ':attribute musi być wcześniejsza lub taka sama jak :date.',
    'between' => [
        'numeric' => 'The :attribute must be between :min and :max.',
        'file' => 'The :attribute must be between :min and :max kilobytes.',
        'string' => 'The :attribute must be between :min and :max characters.',
        'array' => 'The :attribute must have between :min and :max items.',
    ],
    'boolean' => 'The :attribute field must be true or false.',
    'confirmed' => 'The :attribute confirmation does not match.',
    'current_password' => 'The password is incorrect.',
    'date' => ':attribute nie jest właściwą datą.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => ':attribute nie pasuje do formatu :format.',
    'declined' => 'The :attribute must be declined.',
    'declined_if' => 'The :attribute must be declined when :other is :value.',
    'different' => 'The :attribute and :other must be different.',
    'digits' => 'The :attribute must be :digits digits.',
    'digits_between' => 'The :attribute must be between :min and :max digits.',
    'dimensions' => 'The :attribute has invalid image dimensions.',
    'distinct' => ':attribute nie może się powtórzyć.',
    'email' => 'The :attribute must be a valid email address.',
    'ends_with' => 'The :attribute must end with one of the following: :values.',
    'enum' => 'The selected :attribute is invalid.',
    'exists' => 'The selected :attribute is invalid.',
    'file' => 'The :attribute must be a file.',
    'filled' => 'The :attribute field must have a value.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal to :value.',
        'file' => 'The :attribute must be greater than or equal to :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal to :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'The :attribute must be an image.',
    'in' => 'Nieprawidłowa wartość pola :attribute.',
    'in_array' => 'The :attribute field does not exist in :other.',
    'integer' => ':attribute musi być liczbą całkowitą.',
    'ip' => 'The :attribute must be a valid IP address.',
    'ipv4' => 'The :attribute must be a valid IPv4 address.',
    'ipv6' => 'The :attribute must be a valid IPv6 address.',
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'json' => 'The :attribute must be a valid JSON string.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal to :value.',
        'file' => 'The :attribute must be less than or equal to :value kilobytes.',
        'string' => 'The :attribute must be less than or equal to :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => ':attribute musi zawierać liczbę nie większą niż :max.',
        'file' => ':attribute musi być o rozmiarze maksimum :max kilobajtów.',
        'string' => ':attribute musi zawierać co najwyżej :max znaków.',
        'array' => ':attribute powinno zawierać maksimum :max elementów.',
    ],
    'mimes' => ':attribute musi być plikiem jednego z następujących typów: :values.',
    'mimetypes' => ':attribute musi być plikiem jednego z następujących typów: :values.',
    'min' => [
        'numeric' => ':attribute musi zawierać liczbę nie mniejszą niż :min.',
		'file' => ':attribute musi być o rozmiarze minimum :min kilobajtów.',
		'string' => ':attribute musi zawierać co najmniej :min znaków.',
		'array' => ':attribute powinno zawierać minimum :min elementów.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => ':attribute nie może być pusty lub ustawiona wartość jest nieprawidłowa.',
    'not_regex' => 'Niewłaściwy format pola :attribute.',
    'numeric' => 'The :attribute must be a number.',
    'password' => 'The password is incorrect.',
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'Niewłaściwy format pola :attribute.',
    'required' => 'Pole :attribute jest wymagane.',
    'required_if' => 'The :attribute field is required when :other is :value.',
    'required_unless' => 'Pole :attribute jest wymagane dla podanej wartości pola :other.',
    'required_with' => 'Pole :attribute jest wymagane, gdy pole :values nie jest puste.',
    'required_with_all' => 'The :attribute field is required when :values are present.',
    'required_without' => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'Co najmniej jedna opcja w polu :attribute musi być zaznaczona.',
    'same' => 'Pola :attribute i :other muszą mieć taką samą wartość.',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file' => 'The :attribute must be :size kilobytes.',
        'string' => 'The :attribute must be :size characters.',
        'array' => 'The :attribute must contain :size items.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values.',
    'string' => ':attribute musi zawierać ciąg znaków.',
    'timezone' => 'The :attribute must be a valid timezone.',
    'unique' => 'Ta wartość pola :attribute jest już w użyciu przez innego użytkownika.',
    'uploaded' => 'The :attribute failed to upload.',
    'url' => 'The :attribute must be a valid URL.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
		'name' => 'Nazwa użytkownika',
		'email' => 'Adres e-mail',
		'password' => 'Hasło',
		'rapper_name' => 'Pseudonim',
		'full_name' => 'Imię i nazwisko',
		'birth_date' => 'Data urodzenia',
		'birth_city' => 'Miejsce urodzenia',
		'birth_country' => 'Kraj urodzenia',
		'death_date' => 'Data śmierci',
		'death_city' => 'Miejsce śmierci',
		'death_country' => 'Kraj śmierci',
		'country' => 'Kraj zamieszkania',
		'occupation' => 'Zawody',
		'genre' => 'Gatunki',
		'status' => 'Status',
		'website' => 'Strona internetowa',
		'description' => 'Treść artykułu',
		'picture' => 'Zdjęcie',
		'album_name' => 'Nazwa albumu',
		'new_password' => 'Nowe hasło',
		'password_confirmation' => 'Potwierdź hasło',
		'new_email' => 'Nowy adres e-mail',
		'email_confirmation' => 'Potwierdź adres e-mail',
		'new_username' => 'Nowa nazwa użytkownika',
		'username_confirmation' => 'Potwierdź nazwę użytkownika',
	],
	
	'values' => [
		'birth_date' => [
			'today' => 'dzień dzisiejszy'
		],
		'death_date' => [
			'today' => 'dzień dzisiejszy'
		],
	],

];

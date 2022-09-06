{{-- Email: $email, konu: $konu, içerik: $body --}}
@component('mail::message')
    # Gönderen: {{ $email }}
    Konu: {{ $konu }}

    {{ $body }}
@endcomponent

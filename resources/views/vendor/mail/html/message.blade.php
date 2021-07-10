@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name : config('app.name') }}
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ datos_negocio()->shop_name!= '' ? datos_negocio()->shop_name : config('app.name') }}. @lang('Todos los derechos reservados.')
@endcomponent
@endslot
@endcomponent

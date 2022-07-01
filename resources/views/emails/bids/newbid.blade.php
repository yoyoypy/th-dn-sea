@component('mail::message')
Hi, you just got new bid for {{ $product->name }}

@component('mail::button', ['url' => 'th-sea.games/dashboard/product/' . $product->slug . '/' . 'bid', 'color' => 'success'])
See the Bid
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

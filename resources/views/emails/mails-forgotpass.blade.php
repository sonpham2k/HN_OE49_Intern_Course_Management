@component('mail::message')

<div>
    <h2>{{ $data['type'] }}</h2>
</div>
<div>
    <p>{{ __('name') }}: <b>{{ $data['name'] }}</b></p>
    <p>{{ __('newpass') }}: <b>{{ $data['password'] }}</b></p>
    <p>{{ __('contentEmail') }}</p>
</div>

Thanks,<br>

@endcomponent

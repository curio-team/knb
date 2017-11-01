@component('mail::message')
# A new badge request is done.

{{$user->name}} requested the badge {{ $badge->name }}
Please look into it.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

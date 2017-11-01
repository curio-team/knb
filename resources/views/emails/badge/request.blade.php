@component('mail::message')
# A new badge request is done.

{{$user->name}} ({{$user->id}}) requested the badge {{ $badge->title }}
Please look into it.


Thanks,<br>
{{ config('app.name') }}
@endcomponent

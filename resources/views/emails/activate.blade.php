@component('mail::message')
Hi {{$content['name']}}

Thank you for visiting our website. However, to complete your registration, kindly activate your account by clicking the link below.

@component('mail::button', ['url' => $content['url']])
Click Here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

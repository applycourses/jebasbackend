@component('mail::message')
# Introduction

Your Account has been Created in applycourse!

@component('mail::table')
| Account Details      |
| ------------- |:-------------:|
| username     |  {{ $email }}      |
| password      | {{ $password }}     |
@endcomponent

@component('mail::button', ['url' => 'http://admin.ac.dev'])
Button Text
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent

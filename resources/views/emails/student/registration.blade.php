@component('mail::message')
# Dear {{ $data['fname'] }}

Thank you for creating an account with applycourses.com. You are nearly there
Now you can easily shortlist the courses and institutions you wish to study. Please verify your email address to get a personalized experience, which includes choosing your course, applying directly to institutions, free visa guidance etc.
<br><b>After verification you are requested to complete the three steps registration form.</b>

@component('mail::table')
    |      Account Details  |   |
    | ------------- | --------:|
    | <b>Username</b>    |   {{ $data['email_id']  }}   |
    | <b>Password</b>      |  {{ $data['password'] }}   |
@endcomponent

@component('mail::button', ['url' =>  'https://applycourses.com/confirm/'.$data['token'] ,'color' => 'green' ])
VERIFY YOUR EMAIL
@endcomponent

Regards,<br>
<b> The Applycourses Team </b>
@endcomponent

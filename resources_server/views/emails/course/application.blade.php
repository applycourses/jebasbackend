@component('mail::message')
# Dear {{ $data['first_name'] }}

This is to acknowledge you that all of your application form has been verified by our team for the <a href="{{ env('APP_FRONT').$data['cou_slugs'] }}">{{ $data['course_name'] }}</a> at <a href="{{ env('APP_FRONT').$data['uni_slugs'] }}">{{ $data['university_name'] }}</a>

@if($data['application'])
    The next step is to pay the application fees , if you have already paid the application fees please upload the receipt copy from your account.

@endif

Thank you for your co-operation, our team will get in touch with you shortly.
Thanking you!


Regards,<br>
<b>The Applycourses Team</b>
@endcomponent

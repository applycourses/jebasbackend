@component('mail::message')
# Dear {{ $data['first_name'] }}

This is to acknowledge you that all of your documents have been verified by our team for the <a href="{{ env('APP_URL').$data['uni_slugs'] }}">{{ $data['course_name'] }}</a> at <a href="{{ env('APP_URL').$data['uni_slugs'] }}"> {{ $data['uni_slugs'] }} </a>
The next step is to upload the application form, if you have already uploaded no further action is required. Please pay the application fees (if any) for the particular course.

Thank you for your co-operation, our team will get in touch with you shortly.
Thanking you!

Regards,<br>
<b> The Applycourses Team </b>
@endcomponent

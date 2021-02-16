@component('mail::message')
# Dear {{ $data['fname'] }}

Your withdrawal request has been approved for the {{ $data['course_name'] }} at {{ $data['university_name'] }}.

Regards,<br>
<b>The Applycourses Team</b>

@endcomponent

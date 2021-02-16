@component('mail::message')

Dear {{ $student_details->fname}}

Greetings from the applycourses.com!!

Your withdrawal request has been approved for the {{ $course_details->name }} at {{ $university_details->name }}

If you haven't requested for this withdrawal then please do let us know.You can connect us via call, email or social media. Thanking you


Regards,<br>
The Applycourses Team
@endcomponent

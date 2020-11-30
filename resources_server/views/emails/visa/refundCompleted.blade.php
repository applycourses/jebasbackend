@component('mail::message')
#Dear {{ $student_detail->fname }}

Greetings from the applycourses.com!!

This is to acknowledge the college has refunded of the amount of tuition fees you have paid for {{ $course_detail->name }}
 at {{ $university_detail->name }}.

Note: The refund amount will be calculated as per the refund policy of the institution .If you face any difficulties regarding any parts, please contact us via email, chat option on our portal or any social media messengers.

Regards,<br>
The Applycourses Team
@endcomponent

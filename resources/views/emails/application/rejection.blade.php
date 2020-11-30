@component('mail::message')
#Dear {{ $student_details->fname}}

Greetings from the applycourses.com!!

This is in regard to your application for the {{ $course_details->name }} to {{ $university_details->name }} . We regret to inform you that {{ $university_details->name }} cannot offer you admission to this program. This decision can be based on but not limited to any of mentioned below reasons:
<br> Not fulfilling the eligibility criteria of institute or the course,
<br> Not having sufficient funds
<br> The background education doesn’t match with the requested course
<br> Not having related work experience
<br> Not being a genuine student
<br> The intension of choosing the course seems not right
<br> Not acceptable marks
<br> Problems with documents
<br> And other reasons
<br>You can go back to the applycourses.com portal and choose another Institute, course or even country for new application.

If you need assistant from our counsellors, please let us know via chat, email or any social media messenger app.

Regards,<br>
The Applycourses Team

@endcomponent

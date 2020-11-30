@component('mail::message')
#Dear {{ $student_details->fname}}

Greetings from the applycourses.com!!

This is to confirm that you have paid the amount of tuition fees for  {{ $course_details->name }} at {{ $university_details->name }}.

Now you need to start preparing your visa documents so the you can be filed the visa without any further delay.

If you face any difficulties regarding any parts, please contact us via email, chat option on our portal or any social media messengers.

Regards,<br>
The Applycourses Team


@endcomponent

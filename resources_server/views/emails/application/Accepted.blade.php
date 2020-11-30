@component('mail::message')

#Dear {{ $student_details->fname}}

Greetings from the applycourses.com!!

We are glad to know that you have accepted the offer letter for {{ $course_details->name }} at {{ $university_details->name }}.

If there will be any instructions given in the offer letter then you might have to pay the tuition fees. Also at this stage you need to start preparing your visa documents so the you can be filed the visa without any further delay.

If you face any difficulties regarding any parts, please contact us via email, chat option on our portal or any social media messengers.

Regards,<br>
The Applycourses Team

@endcomponent

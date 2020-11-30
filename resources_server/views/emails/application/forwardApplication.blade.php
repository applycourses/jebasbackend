@component('mail::message')
#Dear {{ $student_details->fname}}

Greetings from the applycourses.com!!

Congratulations!! Please acknowledge that your application has been forwarded today by your counsellor for the {{ $course_details->name }} to {{ $university_details->name }} .

It will take minimum of two weeks for {{ $university_details->name }} to assess your application. Once the decision will be made by the institute, your counsellor will inform you. You also can check the status of your application by logging in our portal at applycourses.com.

Meanwhile you can contact us through the chat option in our portal or via email, Skype, WhatsApp, Viber, Facebook, Twitter and other social media messengers.


Regards,,<br>
The Applycourses Team

@endcomponent

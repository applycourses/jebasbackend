@component('mail::message')
#Dear {{ $student_details->fname}}

Greetings from the applycourses.com!!

This is in regard to your application for {{ $course_details->name }} . We are happy to inform you that {{ $university_details->name }}  has accepted your admission to this program and they have issued  a conditional offer letter .

Please click below to download the offer letter issued by the institutions. You are requested to check if all the information are correct in the offer letter such as your name, date of birth, course name, course duration, fees structure , campus, etc.

@component('mail::button', ['url' => ''])
DOWNLOAD OFFER LETTER
@endcomponent

If you face any difficulties regarding any parts, please contact us via email, chat option on our portal or any social media messengers.


Regards,<br>
The Applycourses Team





@endcomponent

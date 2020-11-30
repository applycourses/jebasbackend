@component('mail::message')
#Dear {{ $student_detail->fname }},
Greetings from the applycourses!

We are really sorry to inform you that your visa application has been rejected by the {{ $university_detail->country}} High Commission. Your counselor will help you  to explain the reason (if any) of rejection. You are requested to consult with your counselor and let us know what you would like to do after this.

Visa decision are given by the respective high commission of the country as per their visa rules and regulation. Thank you for choosing applycourses and if you would like to opt for other alternative options we are happy to help you.

 If you have any question, you can contact us via chat option on our portal, email or any social media
messenger apps.

Regards,<br>
The Applycourses Team
@endcomponent

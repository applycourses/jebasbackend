@component('mail::message')
# Dear {{ $data['first_name'] }}

You have successfully shortlisted the <b>{{ $data['course_name'] }} </b> in <b>{{ $data['univ_name'] }}</b>. If you wish to proceed further with the particular course then kindly go through the document checklist. Once you are ready please confirm the campus and course from your account.

<?php $url = env('APP_FRONT', false).'/my-course/view/'.$data['applied_course_id']  ?>

@component('mail::button', ['url' => $url,'color' => 'green'])
VIEW SHORTLISTED COURSE
@endcomponent


Should you need any further information, please do not hesitate to contact us. You can also connect us via social media such as Skype, Facebook, Whatsapp, Twitter, WeChat, Viber, etc.

Regards,<br>
<b> The Applycourses Team</b>
@endcomponent

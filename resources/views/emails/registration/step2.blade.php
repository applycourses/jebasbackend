@component('mail::message')
# Dear {{ $data['fname'] }}

Your counsellor  has completed  the educational qualification ( Step 2 ). Now you are requested to proceed to the next step and complete the employment and other relevant information ( Step 3).

@component('mail::button', ['url' => '/my-registration-form/step3/create'])
    COMPLETE REGISTRATION FORM
@endcomponent

Regards,<br>
<b>The Applycourses Team</b>
@endcomponent

@component('mail::message')
# Dear  {{  $data['fname'] }}

Your counsellor  has completed the personal information( Step 1 ).Now you are requested to proceed to the next step and complete the educational qualification details (step 2).

@component('mail::button', ['url' => '/my-registration-form/step2/create'])
    COMPLETE REGISTRATION FORM
@endcomponent

Regards,<br>
<b>The Applycourses Team</b>
@endcomponent

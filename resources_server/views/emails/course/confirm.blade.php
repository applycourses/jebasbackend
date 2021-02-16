@component('mail::message')
# Dear {{ $data['first_name'] }}

Congratulations - Thank you for confirming the below course.

@component('mail::table')
    |      |        |
    |:------------- |-------------:|
    | University Name  | <a href="{{ env('APP_FRONT').$data['uni_slugs'] }}">{{ $data['univ_name']  }}</a>  |
    | Course Name      | <a href="{{ env('APP_FRONT').$data['cou_slugs'] }}">{{ $data['course_name']}}</a>  |
    | Duration         | {{ $data['duration']  }} |
    | Course Fee       | {{ $data['course_fee'] .' '. $data['currency'] }} |
    | Application Fee  | {{ ($data['application_fee']) ? $data['application_fee'].' '. $data['currency'] : 'Not Applicable'  }} |
@endcomponent


@if($data['application_fee'])
Note: This course indicates that it has an application fee. So your are requested  to pay the fees and upload the receipt copy.
@endif

The next step is to upload the relevant documents as per the checklist along with the  application form (if any) of the institution, which can be downloaded from the link below.

@if(!$data['downloads']->isEmpty())
@component('mail::table')
| Document Name         |  Link  |
|:-------------| --------:|
@foreach($data['downloads'] as $key => $value)
|  {{ $value->document_name }} | <a href="{{ Storage::disk('s3')->url($value->path_name) }}">Download</a>|
@endforeach
@endcomponent


<small><b> **Help: How to upload the documents?</b></small>
@endif






Regards,<br>
<b> The Applycourses Team </b>
@endcomponent

@extends('contents.mails.layouts.mail')

@section('contents')
    <span style="font-size:20px; display: block; font-weight: 800; color: #009fe3">Dear {{ $data['first_name'] }}</span>
    <br />

    <span style="font-size:13px; display: block; color:#636363">This is to acknowledge you that all of your application form has been verified by our team for the <strong>{{ $data['course_name'] }}</strong> at <strong> {{ $data['university_name'] }}   </strong> </span>
    <br>

    <span style=" color:#636363; display: block; font-size:13px;">For any difficulties or queries email us at info@applycourses.com. You can also call us at <strong>+91 98008 97000</strong> between <strong> 10:00 am - 6.00 pm IST ( Mon -Sat )</strong>.</span>

    <span style=" color:#636363; display: block; font-size:13px;">Wish you a best of luck for your career!!</span>

@endsection


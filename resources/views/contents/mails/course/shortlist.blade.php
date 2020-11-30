@extends('contents.mails.layouts.mail')

@section('contents')
    <span style="font-size:20px; display: block; font-weight: 800; color: #009fe3">Dear  {{ $data['first_name'] }}</span>
    <br/>

    <span style="font-size:13px; display: block; color:#636363">Thank you for shortlisting the course with <a href="#">applycourses.com</a></span>

    <span style=" color:#636363; display: block; font-size:13px;">If you would like to process the application for {{ $data['course_name'] }} at {{ $data['univ_name'] }}.  Please click the button below.</span>
    <br />

    <table border="0" cellspacing="0" cellpadding="10" style="background-color: #009fe3; padding:0 40px; text-transform: uppercase; border-radius: 20px;">
        <tr>
            <td align="center" style=" font-size:16px;"> <font face="'Roboto', Arial, sans-serif">
                    <a href="{{ env('FRONT_END').'/my-course' }}" style="color:#ffffff; display: block; text-decoration:none;">Confirm the course</a>
                </font>
            </td>
        </tr>
    </table>
    <br>
    <span style=" color:#636363; display: block; font-size:13px;">Once you confirm the course you would be requested to proceed with the application. Also you can confirm the course by <a href="{{ env('FRONT_END') }}">Log in</a> to your account on our website. </span>

    <span style="color: #484848;">&nbsp;</span>

    <span style=" color:#636363; display: block; font-size:13px;">For any difficulties or queries email us at info@applycourses.com. You can also call us at <strong>+91 98008 97000</strong> between <strong> 10:00 am - 6.00 pm IST ( Mon -Sat )</strong>.</span>

    <span style=" color:#636363; display: block; font-size:13px;">Wish you a best of luck for your career!!</span>

@endsection


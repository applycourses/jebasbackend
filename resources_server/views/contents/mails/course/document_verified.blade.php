@extends('contents.mails.layouts.mail')

@section('contents')
    <span style="font-size:20px; display: block; font-weight: 800; color: #009fe3">Dear {{ $data['first_name'] }}</span>
    <br />
    <span style="font-size:13px; display: block; color:#636363">This is to acknowledge you that all of your documents have been verified by our team for the <strong>{{ $data['course_name'] }}</strong> at <strong> {{ $data['university_name'] }} </strong></span>
    <br>

    <table bgcolor="#eee" cellpadding="10" width="100%">
        <tr>
            <td>
                <strong><span style=" color:#636363; display: block; font-size:13px; padding: 5px 0">NOTE :</span></strong>
                <ul style="padding-left:25px">
                    <li style=" color:#636363; font-size:13px">If you have not uploaded <strong>application form</strong>, then please upload it as soon as possible to get complete the admission process. </li>
                    <li style=" color:#636363; font-size:13px">Please pay the application fees for the course if it is applicable for your course.</li>
                </ul>
            </td>
        </tr>
    </table>
    <br>

    <span style=" color:#636363; display: block; font-size:13px;">For any difficulties or queries email us at info@applycourses.com. You can also call us at <strong>+91 98008 97000</strong> between <strong> 10:00 am - 6.00 pm IST ( Mon -Sat )</strong>.</span>

    <span style=" color:#636363; display: block; font-size:13px;">Wish you a best of luck for your career!!</span>

@endsection


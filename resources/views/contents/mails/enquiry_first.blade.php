@extends('contents.mails.layouts.mail')

@section('contents')
<span style="display:block ; font-size:16px;">Dear <span style="font-weight: 800; color: #009fe3">{{ $enquiry->name }}</span>,</span>
<span style="display:block ; color: #636363; font-size: 16px; padding: 10px 0 40px">Greetings of the day from applycourses.com!!</span>
<span style="display:block ; color: #484848; font-size: 16px; ">Thank you for your enquiry in our website. Our team will get back to you within 48-72 hours.</span>
<span style="color: #484848; font-size: 16px; padding-top: 20px">Your Enquiry details:</span>
<br />
<table cellpadding="10" cellspacing="0" border="1" bordercolor="#e2e2e2">
    <tbody>
        <tr>
            <td width="20%">
                <strong><span style="display:block ; color: #484848; font-size: 16px; ">Enquiry #</span></strong>
            </td>
            <td width="301">
                <span style="display:block ; color: #484848; font-size: 16px; ">{{ $enquiry->enquiry_no }}</span>
            </td>
        </tr>
        <tr>
            <td width="301" valign="top">
                <strong><span style="display:block ; color: #484848; font-size: 16px; ">Your enquiry</span></strong>
            </td>
            <td width="301">
                <span style="display:block ; color: #484848; font-size: 16px; ">{{ $enquiry->query }}</span>
            </td>
        </tr>
    </tbody>
</table>
<span style="display:block ; color: #484848; font-size: 16px; ">&nbsp;</span>
<span style="display:block ; color: #484848; font-size: 16px; ">To apply for your desired course, <a target="_blank" href="http://applycourse.in/register" style="color:#4c4c4c; text-decoration:none;">click here</a>   to register on our website.</span>
<span style="display:block ; color: #484848; font-size: 16px; ">&nbsp;</span>
<span style="display:block ; color: #484848; font-size: 16px; ">For any difficulties or queries email us at info@applycourses.com. You can also call our Helpline on <strong>+91 98008 97000</strong> between <strong> 10:00 am - 6.00 pm IST ( Mon - Fri)</strong>.</span>
<span style="display:block ; color: #484848; font-size: 16px; ">&nbsp;</span>
<span style="display:block ; color: #484848; font-size: 16px; ">Wish you a best of luck for your career!!</span>
  
@endsection

   
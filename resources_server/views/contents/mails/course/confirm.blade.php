@extends('contents.mails.layouts.mail')

@section('contents')
    <span style="font-size:20px; display: block; font-weight: 800; color: #009fe3">Dear {{ $data['first_name']  }}</span>
    <br />

    <span style="font-size:13px; display: block; color:#636363">Congratulations - Thank you for confirming the below course to apply online.</span>
    <br />
    <table cellpadding="10" cellspacing="0" border="1" bordercolor="#e2e2e2">
        <tbody>
        <tr>
            <td>
                <strong><span style="font-size:13px; color: #484848;">University Name </span></strong>
            </td>
            <td>
                <span style="font-size:13px;color: #484848;">{{ $data['univ_name']  }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Course Name </span></strong>
            </td>
            <td width="301">
                <span style="font-size:13px;color: #484848;">{{ $data['course_name']  }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Duration</span></strong>
            </td>
            <td width="301">
                <span style="font-size:13px;color: #484848;">{{ $data['duration']  }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Course Fee</span></strong>
            </td>
            <td width="301">
                <span style="font-size:13px;color: #484848;">{{ $data['course_fee'] .' '. $data['currency'] }}</span>
            </td>
        </tr>
        <tr>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Application Fee</span></strong>
            </td>
            <td width="301">
                <span style="font-size:13px;color: #484848;"> {{ ($data['application_fee']) ? $data['application_fee'] : 'Not Applicable'  }}</span>
            </td>
        </tr>
        </tbody>
    </table>
    <br>
    <span style=" color:#636363; display: block; font-size:13px;"> The next step is to {{ ($data['application_fee'])  ? ' pay the fees and'  : '' }} complete the relevant applications form of the institution, which you can download from the link below.</span>
    <br />

    <table cellpadding="10" cellspacing="0" border="1" bordercolor="#e2e2e2">
        <tbody>
        <tr>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Sl. No. </span></strong>
            </td>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Document Name </span></strong>
            </td>
            <td>
                <strong><span style="font-size:13px;color: #484848;">Action</span></strong>
            </td>
        </tr>

        @foreach($data['downloads'] as $key => $value)
        <tr>
            <td>
                <span style="font-size:13px;color: #484848;"> {{ ++$key }}. </span>
            </td>
            <td>
                <span style="font-size:13px;color: #484848;">{{ $value->document_name }} </span>
            </td>
            <td>
                <a style="font-size:13px; text-decoration: none" href="{{ Storage::disk('s3')->url($value->path_name) }}">Download</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <br>

    <span style=" color:#636363; display: block; font-size:13px;">For any difficulties or queries email us at info@applycourses.com. You can also call us at <strong>+91 98008 97000</strong> between <strong> 10:00 am - 6.00 pm IST ( Mon -Sat )</strong>.</span>

    <span style=" color:#636363; display: block; font-size:13px;">Wish you a best of luck for your career!!</span>

@endsection

   
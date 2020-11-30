<div class="tabbable-line boxless tabbable-reversed margin-bottom-5">
    <ul class="nav nav-tabs">
        <li>
            <a href="{{ URL('/student?view=account_details&student_id=').app('request')->input('student_id') }}"> Account Details</a>
        </li>
        <li>
            <a href="{{ URL('/student?view=registration_form&student_id=').app('request')->input('student_id') }}">Registration Form </a>
        </li>
        <li>
            <a href="{{ URL('/student?view=course_list&student_id=').app('request')->input('student_id') }}">Course Selected</a>
        </li>
        <li>
            <a href="{{ URL('/student?view=application_list&student_id=').app('request')->input('student_id') }}">Applications</a>
        </li>
        <li>
            <a href="">Visa</a>
        </li>
        <li>
            <a href="">Pre Departure</a>
        </li>
        <li>
            <a href="{{ URL('/student?view=document_list&student_id=').app('request')->input('student_id') }}">Documents</a>
        </li>
        <li>
            <a href="{{ URL('/student?view=mails&student_id=').app('request')->input('student_id') }}">Mails</a>
        </li>
        
        <li>
            <a href="{{ URL('/student?view=logs&student_id=').app('request')->input('student_id') }}">Logs</a>
        </li>
    </ul>
</div>

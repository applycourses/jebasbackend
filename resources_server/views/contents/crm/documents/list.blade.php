@extends('contents.layouts.app')
@section('title','Course Applied By the User List')

@section('css')
    <link href="{{ URL::asset('assets/global/plugins/bootstrap-daterangepicker/css/daterangepicker.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ URL::asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <style>
        .color-box {
            width: 12px;
            height: 12px;
            display: inline-block;
            margin-right: 5px;
        }
    </style>
@endsection
<?php 
    function aws_s3_link($canonical_uri) {
        $access_key = env('AWS_KEY');
        $secret_key = env('AWS_SECRET');
        $bucket = env('AWS_DOC_BUCKET');
        $region = env('AWS_REGION');
        $expires = env('AWS_DOC_EXPIRE');
$extra_headers = array();
    $encoded_uri = str_replace('%2F', '/', rawurlencode($canonical_uri));

    $signed_headers = array();
    foreach ($extra_headers as $key => $value) {
        $signed_headers[strtolower($key)] = $value;
    }
    if (!array_key_exists('host', $signed_headers)) {
        $signed_headers['host'] = ($region == 'us-east-1') ? "$bucket.s3.amazonaws.com" : "$bucket.s3-$region.amazonaws.com";
    }
    ksort($signed_headers);

    $header_string = '';
    foreach ($signed_headers as $key => $value) {
        $header_string .= $key . ':' . trim($value) . "\n";
    }
    $signed_headers_string = implode(';', array_keys($signed_headers));

    $timestamp = time();
    $date_text = gmdate('Ymd', $timestamp);
    //$date_text = gmdate('Ymd', $timestamp);
    $mytime = date("His");
    //echo $mytime; die();
    $time_text = $date_text .  gmdate("\THis\Z");
    //echo $time_text; die();
    //echo $mytime; die();
    $algorithm = 'AWS4-HMAC-SHA256';
    $scope = "$date_text/$region/s3/aws4_request";

    $x_amz_params = array(
        'X-Amz-Algorithm' => $algorithm,
        'X-Amz-Credential' => $access_key . '/' . $scope,
        'X-Amz-Date' => $time_text,
        'X-Amz-SignedHeaders' => $signed_headers_string
    );
    if ($expires > 0) $x_amz_params['X-Amz-Expires'] = $expires;
    ksort($x_amz_params);

    $query_string_items = array();
    foreach ($x_amz_params as $key => $value) {
        $query_string_items[] = rawurlencode($key) . '=' . rawurlencode($value);
    }
    $query_string = implode('&', $query_string_items);

    $canonical_request = "GET\n$encoded_uri\n$query_string\n$header_string\n$signed_headers_string\nUNSIGNED-PAYLOAD";
    $string_to_sign = "$algorithm\n$time_text\n$scope\n" . hash('sha256', $canonical_request, false);
    $signing_key = hash_hmac('sha256', 'aws4_request', hash_hmac('sha256', 's3', hash_hmac('sha256', $region, hash_hmac('sha256', $date_text, 'AWS4' . $secret_key, true), true), true), true);
    $signature = hash_hmac('sha256', $string_to_sign, $signing_key);

    $url = 'https://' . $signed_headers['host'] . $encoded_uri . '?' . $query_string . '&X-Amz-Signature=' . $signature;
    return $url;
}
?>
@section('body')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-head">
                <div class="page-title">
                    <h1>Documents View</h1>
                </div>
            </div>
            <ul class="page-breadcrumb breadcrumb">
                <li> <a href="/">Home</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <a href="/pages/crm/documents-upload/list.php">Document List</a>  <i class="fa fa-circle"></i>
                </li>
                <li> <span class="active">Documents View</span>
                </li>
            </ul>
            <div class="row">
                <div class="col-md-12">
                    <?php //echo Documents::document_link(); ?>
                    @include('contents.crm.includes.view_bar')
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-eye"></i>Documents View</div>
                            <div class="tools">
                                <a href="/pages/crm/student_list/edit.php" class="edit"></a>
                                <a href="javascript:history.back()" class="go_back"></a>
                            </div>
                        </div>
                        <div class="portlet-body" id="app">
                            <div class="form-group">
                                <small>
                                    <b>Note:</b> The documents uploaded through this form below would be accepted on behalf of the student.
                                </small>
                            </div>

                            <document-upload></document-upload>
                            <div class="form-group">
                                <small>
                                    <b>Note : </b> Following color swatches represents the user who uploaded the document.
                                </small>
                            </div>
                            <ul class="color-note list-inline">
                                <li>
                                    <span class="color-box btn-danger"></span> Admin
                                </li>
                                <li>
                                    <span class="color-box btn-success"></span> Associate Agent
                                </li>
                                <li>
                                    <span class="color-box btn-primary"></span> University
                                </li>
                                <li>
                                    <span class="color-box btn-info"></span> Sub Agent
                                </li>
                                <li>
                                    <span class="color-box btn-warning"></span> Student
                                </li>
                            </ul>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="6%">Sl. No.</th>
                                    <th>Category</th>
                                    <th>Course Name</th>
                                    <th>Document Name</th>
                                    <th width="15%">Uploaded Date</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $value)
                                    @if($value->uploaded_by == "admin")
                                    <tr class="danger">
                                        <td>{{  ++ $key }}</td>
                                        <td>{{ $value->get_category_name($value->category) }}</td>
                                        <td>{{ $value->get_course_name($value->course) }}</td>
                                        <td>{{  $value->document_name($value->document_id) }}</td>
                                        <td>{{  $value->created_at }} </td>
                                        <td>
                                            <a href="{{ aws_s3_link('/'.$value->path) }}" download="file" target="_blank"  class="btn btn-xs btn-primary" >Download</a>
                                        </td>
                                    </tr>
                                    @elseif($value->uploaded_by == "student")
                                        <tr class="warning">
                                            <td>{{  ++ $key }}</td>
                                            <td>{{ $value->get_category_name($value->category) }}</td>
                                            <td>{{ $value->get_course_name($value->course) }}</td>
                                            <td>{{  $value->document_name($value->document_id) }}</td>
                                            <td>{{  $value->created_at }} </td>
                                            <td>
                                                <a href="{{ aws_s3_link('/'.$value->path) }}" download="file" target="_blank"  class="btn btn-xs btn-primary" >Download</a>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="info">
                                            <td>{{  ++ $key }}</td>
                                            <td>{{ $value->get_category_name($value->category) }}</td>
                                            <td>{{ $value->get_course_name($value->course) }}</td>
                                            <td>{{  $value->document_name($value->document_id) }}</td>
                                            <td>{{ $value->created_at }} </td>
                                            <td>
                                                <a href="{{ aws_s3_link('/'.$value->path) }}" download="file" target="_blank"  class="btn btn-xs btn-primary" >Download</a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection

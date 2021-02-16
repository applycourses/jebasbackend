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
                    @include('contents.crm.includes.agent_view_bar')
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
                                            <a href="{{ Storage::disk('s3')->url($value->path) }}" download="file" target="_blank"  class="btn btn-xs btn-primary" >Download</a>
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
                                                <a href="{{ Storage::disk('s3')->url($value->path) }}" download="file" target="_blank"  class="btn btn-xs btn-primary" >Download</a>
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
                                                <a href="{{ Storage::disk('s3')->url($value->path) }}" download="file" target="_blank"  class="btn btn-xs btn-primary" >Download</a>
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

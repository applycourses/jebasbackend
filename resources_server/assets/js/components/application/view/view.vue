<template>
    <div>
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption"> <i class="fa fa-eye"></i>Application View</div>
                <div class="tools">
                    <a href="javascript:history.back()" class="go_back"></a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="bold">
                            <img style="margin-top: -3px;" src="/assets/global/img/Student-Icon-1.png" alt="" class="withdrawn">
                            Course Details
                            <div class="pull-right">
                                <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-target="#email">Assign Application</button>
                                <button class="btn btn-primary btn-xs" type="button" data-toggle="modal" data-target="#email2">Send Documents</button>

                            </div>
                        </h4>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>University</th>
                                <th>Campus</th>
                                <th>Eligibility Criteria</th>
                                <th>Document Checklist</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Masters of Business Administration</td>
                                <td>Canberra Institute Of Technology</td>
                                <td>Main Campus, Sydney</td>
                                <td>
                                    <button type="button" data-target="#eligibility" data-toggle="modal" class="btn btn-xs btn-primary">View</button>
                                </td>
                                <td>
                                    <button type="button" data-target="#doc-checklist" data-toggle="modal" class="btn btn-xs btn-primary">View</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <h4 class="bold">Assigned</h4>
                        <div class="tabbable-bordered">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab"> Student</a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab"> Admin</a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab"> University</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab1">

                                    <!-- Document Upload of Student -->
                                    <!-- <table class="table" style="background: #333;">
                                        <tbody>
                                            <tr>
                                                <td width="45%">
                                                    <select name="document" id="document" required="required" class="form-control">
                                                        <option value="74">Application - Application Form</option>
                                                        <option value="75">Application - Enrollment Form</option>
                                                        <option value="76">Application - Supplementary Form</option>
                                                        <option value="77">Application - Admission Form</option>
                                                        <option value="78">Application - GTE Form</option>
                                                        <option value="79">Application - Financial Declaration Form </option>
                                                        <option value="80">Application - Agent Appointment Form </option>
                                                        <option value="81">Application - Change of Agent Form </option>
                                                        <option value="84">Application - Work Reference Form </option>
                                                        <option value="83">Application - Academic Reference Form </option>
                                                        <option value="85">Application - Portfolio</option>
                                                        <option value="86">Application - Intent Letter</option>
                                                        <option value="103">Withdrawl- Refund Form</option>
                                                        <option value="67">Admission- Letter of Acceptance</option>
                                                    </select>
                                                </td>
                                                <td width="45%">
                                                    <div class="input-group">
                                                        <input type="file" required="" style="display: none">
                                                        <input class="form-control" type="text" placeholder="Browse file . . ." readonly="">
                                                        <span class="input-group-btn">
                                                        <button type="button" class="btn bg-blue btn-flat btn-block"><i class="fa fa-upload text-white"></i></button>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td width="10%">
                                                    <button type="submit" class="btn btn-block btn-primary">Upload</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table> -->
                                    <h4 class="bold">Appication Documents
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-xs blue">Add</a>
                                        </div>
                                    </h4>
                                    <hr>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="6%">Sl. No.</th>
                                            <th>Document Name</th>
                                            <th>Download</th>
                                            <th width="30%">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Document Name</td>
                                            <td>
                                                <button class="btn btn-primary btn-xs" type="button">Download</button>
                                            </td>
                                            <td>
                                                12-04-2017
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <h4 class="bold">Payment Status </h4>
                                    <hr>

                                    <p>- <span class="bold">Payment History</span> : You can find the history of the student's payment status</p>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>- <span class="bold">Update Status</span> : </p>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="" id="" class="form-control">
                                                    <option value="hide">Hide</option>
                                                    <option value="show">Show</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="button">Update</button>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="6%">Sl. No.</th>
                                            <th>Status</th>
                                            <th width="10%">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Payment Requested</td>
                                            <td>
                                                12-04-2017
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Paid</td>
                                            <td>
                                                12-04-2017
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <h4 class="bold">Acceptance Letter </h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p>- <span class="bold">Update Status</span> : </p>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="" id="" class="form-control">
                                                    <option value="hide">Hide</option>
                                                    <option value="show">Show</option>
                                                    <option value="paid">Accepted</option>
                                                    <option value="paid">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button class="btn btn-primary" type="button">Update</button>
                                            </div>
                                        </div>
                                    </div>

                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="6%">Sl. No.</th>
                                            <th>Status</th>
                                            <th width="10%">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Show</td>
                                            <td>
                                                12-04-2017F
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Accepted</td>
                                            <td>
                                                12-04-2017
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td>Rejected</td>
                                            <td>
                                                12-04-2017
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <h4 class="bold">Status
                                        <div class="pull-right">
                                            <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#update">Update</button>
                                        </div>
                                    </h4>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="20%">Status Type</th>
                                            <th width="12%">Updated On</th>
                                            <th width="5%">Attachment</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Rejected
                                                <a class="pull-right popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="{ Name } { Email Address }" data-original-title="Updated by"><i class="fa fa-info-circle"></i></a>
                                            </td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Conditional Offer</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Unconditional Offer</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Withdrawn</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Fee Paid</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Refunded</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Offer Letter Accepted</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Moved to Visa Application</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <table class="table-bordered table">
                                        <thead>
                                        <tr>
                                            <th width="25%">Category</th>
                                            <th width="10%">Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action By</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Offer Letter</td>
                                            <td>Student / University</td>
                                            <td>Received / Send</td>
                                            <td>12-04-2017</td>
                                            <td>Agent / University</td>
                                            <td>Remarks Done</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane" id="tab3">
                                    <h4 class="bold">Appication Documents
                                        <div class="pull-right">
                                            <a href="#" class="btn btn-xs blue">Add</a>
                                        </div>
                                    </h4>
                                    <hr>
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="6%">Sl. No.</th>
                                            <th>Document Name</th>
                                            <th>Download</th>
                                            <th width="30%">Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1.</td>
                                            <td>Document Name</td>
                                            <td>
                                                <button class="btn btn-primary btn-xs" type="button">Download</button>
                                            </td>
                                            <td>
                                                12-04-2017
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>

                                    <h4 class="bold">Status
                                        <div class="pull-right">
                                            <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#update">Update</button>
                                        </div>
                                    </h4>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th width="20%">Status Type</th>
                                            <th width="12%">Updated On</th>
                                            <th width="5%">Attachment</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Rejected
                                                <a class="pull-right popovers" data-container="body" data-trigger="hover" data-placement="top" data-content="{ Name } { Email Address }" data-original-title="Updated by"><i class="fa fa-info-circle"></i></a>
                                            </td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Conditional Offer</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Unconditional Offer</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Withdrawn</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Fee Paid</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Refunded</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Offer Letter Accepted</td>
                                            <td></td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary">View</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Moved to Visa Application</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <table class="table-bordered table">
                                        <thead>
                                        <tr>
                                            <th width="25%">Category</th>
                                            <th width="10%">Type</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action By</th>
                                            <th>Remarks</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Offer Letter</td>
                                            <td>Student / University</td>
                                            <td>Received / Send</td>
                                            <td>12-04-2017</td>
                                            <td>Agent / University</td>
                                            <td>Remarks Done</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
             </div>
        </div>
        <assign_application></assign_application>

    </div>
</template>
<script>
    import assign_application from './components/assign_application.vue'
    export default {
        components :{
            assign_application
        },
        data(){
            return {

            }
        }

    }


</script>
<template>
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
</template>
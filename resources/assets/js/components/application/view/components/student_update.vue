<template>
    <div id="update" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update</h4>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <select name="updateCategory"  class="form-control">
                                    <option value="">Select Category</option>
                                    <option value="Rejection Letter">Rejection Letter</option>
                                    <option value="Conditional Offer Letter">Conditional Offer Letter</option>
                                    <option value="Unconditional Offer Letter">Unconditional Offer Letter</option>
                                    <option value="Withdrawal Letter">Withdrawal Letter</option>
                                    <option value="Fee Receipt">Fee Receipt</option>
                                    <option value="Refund Form">Refund Form</option>
                                    <option value="Offer Letter">Offer Letter</option>
                                    <option value="Visa Letter">Visa Letter</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select name="updateCategory" class="form-control">
                                    <option value="">Uploaded by</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <select name="updateCategory" class="form-control" multiple="">
                                    <option value="">Select Document</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <textarea type="text" class="form-control" placeholder="Remarks"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Send</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

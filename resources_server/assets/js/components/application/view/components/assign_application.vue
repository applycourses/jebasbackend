<template>
    <div id="assignApplication" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Assign</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Type:</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="">Select type</option>
                                    <option value="university">University/</option>
                                    <option value="associate_agent">Associate Agent</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Country:</label>
                                <select name="country_id" id="country_id" class="form-control">
                                    <option value="">Select Country</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Name:</label>
                                <select name="name_id" id="name_id" class="form-control">
                                    <option value="">Select Name</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label>Department</label>
                                <select name="department_id" id="department_id" class="form-control">
                                    <option value="">Select Department</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Assign</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

</script>
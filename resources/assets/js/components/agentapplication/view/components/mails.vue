<template>
    <div>
        <div id="email2" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Assign</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group form-md-radios">
                                <label>Choose One</label>
                                <div class="md-radio-inline">
                                    <div class="md-radio">
                                        <input type="radio" id="email2Univ" name="email2bod" class="md-radiobtn">
                                        <label for="email2Univ">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> University </label>
                                    </div>
                                    <div class="md-radio">
                                        <input type="radio" id="email2Stdnt" name="email2bod" class="md-radiobtn">
                                        <label for="email2Stdnt">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> Student </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-2 control-label">Attach :
                                    <br>
                                    <small>( Press Ctrl and click to select multiple options. )</small>
                                </label>
                                <div class="col-md-10">
                                    <select multiple="" class="form-control">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-md-radios row">
                                <div class="col-md-2">To :</div>
                                <div class="col-md-10">
                                    <input type="text" name="mailto" placeholder="eg.mail@mail.com" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-md-radios row">
                                <div class="col-md-2">Cc :</div>
                                <div class="col-md-10">
                                    <input type="text" name="ccto" placeholder="eg.mail@mail.com" class="form-control">
                                </div>
                            </div>
                            <div class="form-group form-md-radios row">
                                <div class="col-md-2">Subject :</div>
                                <div class="col-md-10">
                                    <input type="text" name="subject" placeholder="eg. Thank you for subscription" class="form-control">
                                </div>
                            </div>

                            <div class="form-group form-md-radios row">
                                <div class="col-md-2">Mail Body :</div>
                                <div class="col-md-10">
                                    <textarea name="editor2" id="editor2"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Send</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title ">Frequently Asked Questions</h4>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <div class=" margin-bottom-10">
                                <select class="form-control category" name="category">
                                    <option value="" selected="selected">Select Category</option>
                                    <option value="enquiry">enquiry</option>
                                    <option value="enquiry1">enquiry1</option>
                                </select>
                            </div>
                            <div class="faqs_load ajax-loading text-center">
                                <i class="fa fa-spinner fa-2x fa-spin" aria-hidden="true"></i>
                            </div>
                            <div class="faqs_questions"></div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                        <div id="aa"></div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        
    </div>
</template>
<script>

</script>
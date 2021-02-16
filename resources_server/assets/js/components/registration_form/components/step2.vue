<template>
    <form class="clearfix step2">
        <div class="col-md-12">
            <h4 class="bold">Student Qualification</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Highest Qualification</th>
                    <th>Status of the Qualification</th>
                </tr>
                <tr>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Select Qualification</option>
                            <option value="secondary">Secondary Education</option>
                            <option value="higher_secondary">Senior Secondary Education</option>
                            <option value="diploma" selected>Certificate / Diploma / Advanced Diploma</option>
                            <option value="ug_edu">Under Graduate Education</option>
                            <option value="pg_edu">Post Graduate Education</option>
                        </select>
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Pursuing</option>
                            <option value="" selected>Completed</option>
                        </select>
                    </td>
                </tr>
            </table>
            <h5 class="bold bg-blue-text">Secondary Education ( Year 10 | O Level | Secondary School Examination )</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Name Of University/School/College</th>
                    <th>Subjects</th>
                    <th>Country</th>
                    <th>State</th>
                </tr>
                <tr>
                    <td>
                        <input required type="text" class="form-control" value="Amity University">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="Eng, Maths, Science, Social Science">
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">India</option>
                            <option value="" selected>Nepal</option>
                            <option value="">Bhutan</option>
                            <option value="">Bangladesh</option>
                        </select>
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Balrampur</option>
                            <option value="" selected>Kathmandu</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Name Of Examination</th>
                    <th>%age or Aggregate or grade</th>
                </tr>
                <tr>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="Secondary">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="69%">
                    </td>
                </tr>
            </table>
            <h5 class="bold bg-blue-text">Higher Secondary Education ( Year 12 | A Level | Higher Secondary School Examination )</h5>
            <table class="table table-bordered">
                <tr>
                    <th>Name Of University/School/College</th>
                    <th>Subjects</th>
                    <th>Country</th>
                    <th>State</th>
                </tr>
                <tr>
                    <td>
                        <input required type="text" class="form-control" value="Amity University">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="Eng, Maths, Science, Social Science">
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">India</option>
                            <option value="" selected>Nepal</option>
                            <option value="">Bhutan</option>
                            <option value="">Bangladesh</option>
                        </select>
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Balrampur</option>
                            <option value="" selected>Kathmandu</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Name Of Examination</th>
                    <th>%age or Aggregate or grade</th>
                </tr>
                <tr>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="Secondary">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="69%">
                    </td>
                </tr>
            </table>
            <h5 class="bold bg-blue-text">Certificate | Diploma | Advanced Diploma</h5>
            <div id="certificate">
                <div class="row">
                    <div class="col-md-6">
                        <div class="bold margin-bottom-10"><i class="fa fa-book"></i> Course 1</div>
                    </div>
                    <div class="col-md-6">
                        <div class="pull-right">
                            <button type="button" class="btn blue btn-xs add">Add</button>
                            <button type="button" class="btn red btn-xs delete">Delete</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <tr>
                                <th>Course / Programme Name</th>
                                <th>University of Course / Programme</th>
                                <th>Country</th>
                                <th>State</th>
                            </tr>
                            <tr>
                                <td>
                                    <input required type="text" class="form-control" value="Diploma in Web">
                                </td>
                                <td>
                                    <input required type="text" class="form-control" value="IGNOU">
                                </td>
                                <td>
                                    <select required name="" id="" class="form-control">
                                        <option value="">India</option>
                                        <option value="" selected>Nepal</option>
                                        <option value="">Bhutan</option>
                                        <option value="">Bangladesh</option>
                                    </select>
                                </td>
                                <td>
                                    <select required name="" id="" class="form-control">
                                        <option value="">Balrampur</option>
                                        <option value="" selected>Kathmandu</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Select Course Type</th>
                                <th>%age or Aggregate or grade</th>
                            </tr>
                            <tr>
                                <td>
                                    <input required class="form-control date-picker" type="text" value="12-04-1997" />
                                </td>
                                <td>
                                    <input required class="form-control date-picker" type="text" value="12-04-1997" />
                                </td>
                                <td>
                                    <input required type="text" class="form-control" value="Diploma">
                                </td>
                                <td>
                                    <input required type="text" class="form-control" value="69%">
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <h5 class="bold bg-blue-text">Bachelor Degree</h5>
            <div class="bold margin-bottom-10"><i class="fa fa-book"></i> Course 1</div>
            <table class="table table-bordered">
                <tr>
                    <th>Course / Programme Name</th>
                    <th>University of Course / Programme</th>
                    <th>Country</th>
                    <th>State</th>
                </tr>
                <tr>
                    <td>
                        <input required type="text" class="form-control" value="B.Sc. in Web">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="IGNOU">
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">India</option>
                            <option value="" selected>Nepal</option>
                            <option value="">Bhutan</option>
                            <option value="">Bangladesh</option>
                        </select>
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Balrampur</option>
                            <option value="" selected>Kathmandu</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Select Course Type</th>
                    <th>%age or Aggregate or grade</th>
                </tr>
                <tr>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="B.Sc.">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="69%">
                    </td>
                </tr>
            </table>
            <h5 class="bold bg-blue-text">Post Graduate Certificate | Post Graduate Diploma | Masters</h5>
            <div class="bold margin-bottom-10"><i class="fa fa-book"></i> Course 1</div>
            <table class="table table-bordered">
                <tr>
                    <th>Course / Programme Name</th>
                    <th>University of Course / Programme</th>
                    <th>Country</th>
                    <th>State</th>
                </tr>
                <tr>
                    <td>
                        <input required type="text" class="form-control" value="M.Sc. in Web">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="IGNOU">
                    </td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">India</option>
                            <option value="" selected>Nepal</option>
                            <option value="">Bhutan</option>
                            <option value="">Bangladesh</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Select Course Type</th>
                    <th>%age or Aggregate or grade</th>
                </tr>
                <tr>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required class="form-control date-picker" type="text" value="12-04-1997" />
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="M.Sc.">
                    </td>
                    <td>
                        <input required type="text" class="form-control" value="69%">
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Have you taken any admission test? (eg. IELTS,TOEFL,GRE etc.)</th>
                    <td>
                        <select required name="" id="admission_test" class="form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="exam_table"></div>
        </div>
    </form>
</template>
<template>
    <form class="clearfix step3">
        <div class="col-md-12">
            <h4 class="bold">Employment Info</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Do you have any work experience ?</th>
                    <td>
                        <select required name="" id="employment" class="form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
            </table>
            <div id="employment_table"></div>

            <h4 class="bold">Other Info</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Would you be able to fund your studies without any scolarship?</th>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th width="15%">Other Info</th>
                    <th width="15%">Status</th>
                    <th>Details</th>
                </tr>
                <tr>
                    <td>Disability</td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                    <td>
                        <textarea name="" class="form-control" id="">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</textarea>
                    </td>
                </tr>
                <tr>
                    <td>Criminal Record</td>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                    <td>
                        <textarea name="" class="form-control" id="">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</textarea>
                    </td>
                </tr>
            </table>

            <h4 class="bold">Visa Information</h4>
            <table class="table table-bordered">
                <tr>
                    <th>Would be able to fund your studies without any scolarship?</th>
                    <td>
                        <select required name="" id="" class="form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th colspan="4">Where are you sourcing your funds to meet the financial commitment of studies in overseas ?</th>
                </tr>
                <tr>
                    <td>
                        <label class="checkbox-inline">
                            <input type="checkbox" checked> Self-Funded
                        </label>
                    </td>
                    <td>
                        <label class="checkbox-inline">
                            <input type="checkbox"> Parents
                        </label>
                    </td>
                    <td>
                        <label class="checkbox-inline">
                            <input type="checkbox" checked> Bank Loan
                        </label>
                    </td>
                    <td>
                        <label class="checkbox-inline">
                            <input type="checkbox"> Employer
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label class="checkbox-inline">
                            <input type="checkbox"> Scholarship
                        </label>
                    </td>
                    <td>
                        <label class="checkbox-inline">
                            <input type="checkbox" checked> Parents-In-Law
                        </label>
                    </td>
                    <td colspan="2">
                        <label class="checkbox-inline">
                            <input type="checkbox"> Other Relative(s)
                        </label>
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Have you been refused a visa for any country?</th>
                    <td width="15%">
                        <select required name="" id="" class="visa_info form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
                <tr class="visa_info_details"></tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Have any of your family members been refused a visa for any country?</th>
                    <td width="15%">
                        <select required name="" id="" class="visa_info form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
                <tr class="visa_info_details"></tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Are you currently studying or have you previously studied in any country?</th>
                    <td width="15%">
                        <select required name="" id="" class="visa_info form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
                <tr class="visa_info_details"></tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <th>Are you currently awaiting a decision on another country visa application?</th>
                    <td width="15%">
                        <select required name="" id="" class="visa_info form-control">
                            <option value="">Select</option>
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </td>
                </tr>
                <tr class="visa_info_details"></tr>
            </table>
        </div>
    </form>
</template>
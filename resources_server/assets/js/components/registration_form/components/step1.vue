<template>
    <form class="clearfix step1">
        <div class="col-md-12">
            <h4 class="bold">Mailing Address And Personal Information</h4>
            <h5 class="bold bg-blue-text">Personal Information</h5>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Country Of Birth</th>
                        <th>Marital Status</th>
                        <th>Dependants you want to take ?</th>
                    </tr>
                    <tr>
                        <td>
                            <select
                                    name=""
                                    class="form-control"
                                    v-model="form.country_of_birth"
                            >
                                <option value="">Select Country</option>
                                <option :value="index" v-for="(value,index) in countries"> {{ value }}</option>
                            </select>
                        </td>
                        <td>
                            <select
                                    name=""
                                    class="form-control"
                                    v-model="form.marital_status"
                            >
                                <option value="">Select Marital Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>
                                <option value="windowed">Widowed</option>
                            </select>
                        </td>
                        <td>
                            <select
                                    name="howManyToTake"
                                    class="form-control "
                                    @change="NoOfDependent"
                                    v-model="form.noOfDependants"
                            >
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                            </select>
                        </td>
                    </tr>
                </thead>
            </table>
            <table class="table" v-if="form.noOfDependants != 0">
                <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Full Name</th>
                    <th>Relationship with the Dependant</th>
                    <th>Relationship with the Dependant</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(value,index) in form.dependents">
                    <td></td>
                    <td>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="ex. John Paul"
                            v-model="value.name"
                            required
                        >
                    </td>
                    <td>
                        <input
                            type="text"
                            class="form-control"
                            placeholder="ex. Father ...."
                            v-model="value.relationship"
                        >
                    </td>
                    <td>
                        <input type="checkbox" v-model="value.take">
                    </td>
                </tr>
                </tbody>
            </table>


        </div>
        <div class="col-md-12">
            <h5 class="bold bg-blue-text">Mailing Address</h5>
            <div class="mailing_div">

                <table class="table ">
                    <tr>
                        <th>Country</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                    </tr>
                    <tr>
                        <td>
                            <select required name=""  class="form-control" v-model="form.country_of_birth">
                                <option value="">Select Option</option>
                                <option :value="index" v-for="(value,index) in countries"> {{ value }}</option>
                            </select>
                        </td>
                        <td>
                            <input class="form-control">
                        </td>
                        <td>
                            <select required name=""  class="form-control">
                                <option value="">Select Option</option>
                                <option value="india">India</option>
                                <option value="nepal" selected>Nepal</option>
                                <option value="bhutan">Bhutan</option>
                                <option value="bangladesh">Bangladesh</option>
                            </select>
                        </td>
                        <td>
                            <input required type="text" class="form-control" value="734001">
                        </td>
                    </tr>
                </table>
                <table class="table ">
                    <tr>
                        <th>Full Address</th>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" class="form-control" value="Random Addess">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="address">
                <label  class="radio-inline no-padding">Permanent address same as mailing address ?</label>
                <input type="radio" class="radio-inline address_radio" name="address" value="yes">Yes
                <input type="radio" class="radio-inline address_radio" value="no" name="address">No
            </div>
            <div class="permanent_div">
                <h5 class="bold bg-blue-text">Permanent Address</h5>
                <table class="table ">
                    <tr>
                        <th>Country</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Postal Code</th>
                    </tr>
                    <tr>
                        <td>
                            <select required name=""  class="form-control">
                                <option value="">Select Option</option>
                                <option :value="index" v-for="(value,index) in countries"> {{ value }}</option>
                            </select>
                        </td>
                        <td>
                           <input class="form-control">
                        </td>
                        <td>
                            <select required name=""  class="form-control">
                                <option value="">Select Option</option>
                                <option value="india">India</option>
                                <option value="nepal">Nepal</option>
                                <option value="bhutan">Bhutan</option>
                                <option value="bangladesh">Bangladesh</option>
                            </select>
                        </td>
                        <td>
                            <input required type="text" class="form-control" value="">
                        </td>
                    </tr>
                </table>
                <table class="table ">
                    <tr>
                        <th>Full Address</th>
                    </tr>
                    <tr>
                        <td>
                            <input required type="text" class="form-control" value="">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
        data(){
            return{
                form:{
                    country_of_birth:'',
                    marital_status:'',
                    noOfDependants:0,
                    dependents: []
                },
            }
        },
        props:['countries'],
        methods:{
            NoOfDependent()
            {
                let property = {'name':'', 'relationship':'', 'take':''};
                this.form.dependents = [];
                for(var i = 1 ;i <= this.form.noOfDependants;i++){
                    this.form.dependents.push(property);
                }

            }
        }
    }

</script>
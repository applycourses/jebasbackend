<template>
    <div class="row">
        <div class="alert alert-success" v-if="successMesage">
            <strong>Success!</strong> Successfully Shortlisted the Course!.
        </div>
        <form action="" @submit.prevent="searchCourse()">
            <div class="col-md-2">
                <div class="form-group">
                    <input
                            class="form-control"
                            placeholder="Enter University Name"
                            v-model="search.university"
                            @keyup="fetchData()"
                    >
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <input
                            class="form-control"
                            placeholder="Enter Course Name"
                            v-model="search.course"
                            @keyup="fetchData()"
                    >
                </div>

            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select class="form-control subjects"
                            v-model="search.subject"
                            @change="fetchData()"
                    >
                        <option value="">Please Select Subject</option>
                        <option value="Law" selected="selected">Law</option>
                        <option value="Profession and Arts">Profession and Arts</option>
                        <option value="Architecture and Environment ">Architecture and Environment </option>
                        <option value="Business and Economics">Business and Economics</option>
                        <option value="Engineering and Technology">Engineering and Technology</option>
                        <option value="Languages">Languages</option>
                        <option value="Life Science and Health">Life Science and Health</option>
                        <option value="Natural and Applied Science">Natural and Applied Science</option>
                        <option value="Social Science">Social Science</option>
                        <option value="Pathway and Preparatory">Pathway and Preparatory</option>
                        <option value="Hospitality and Tourism">Hospitality and Tourism</option>
                        <option value="Humanities and Arts">Humanities and Arts</option>
                        <option value="Trade and Technology">Trade and Technology</option>
                        <option value="Beauty , Recreation and Therapy">Beauty , Recreation and Therapy</option>
                    </select>


                </div>

            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <select
                            v-model="search.study_level"
                            @change="fetchData()"
                            class="form-control study_level_id">

                        <option value="" selected="selected">Please Select Level</option>
                        <option value="Advanced Diploma">Advanced Diploma</option>
                        <option value="Associate Degree">Associate Degree</option>
                        <option value="Bachelors Degree">Bachelors Degree</option>
                        <option value="Certificate">Certificate</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Foundation">Foundation</option>
                        <option value="Graduate Certificate">Graduate Certificate</option>
                        <option value="Graduate Diploma">Graduate Diploma</option>
                        <option value="M.Phil"> M.Phil</option>
                        <option value="Master Degree">Master Degree</option>
                        <option value="PHD">PHD</option>
                        <option value="Post Graduate Diploma"> Post Graduate Diploma</option>
                        <option value="Post Graduate Certificate"> Post Graduate Certificate</option>
                    </select>

                </div>

            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <input
                            class="form-control"
                            placeholder="Enter Country Name"
                            v-model="search.country"
                            @keyup="fetchData()"
                    >
                </div>

            </div>
        </form>
        <div class="col-md-12">

            <table class="table">
                <thead>
                <tr>
                    <th>University Name</th>
                    <th>Course Name</th>
                    <th>Country</th>
                    <th>Intake</th>
                    <th>Fee</th>
                    <th>Duration</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <template v-if="courses.length > 0">
                    <tr v-for="(value,index) in courses">
                        <td width="20%">{{ value.uni_name }}</td>
                        <td width="20%">
                            {{ value.name }}
                        </td>
                        <td width="10%">
                            {{ value.country_name }}
                        </td>
                        <td width="10%">
                            {{ value.intake }}
                        </td>
                        <td width="10%">
                            {{ value.fee }} {{  value.currency }}
                        </td>
                        <td width="10%">
                            {{ value.duration }}
                        </td>
                        <td width="10%">
                            <button class="btn btn-info btn-xs" type="button" @click="shortlist(index)">
                                Shortlist
                            </button>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr >
                        <td colspan="7"><i class="fa fa-spin fa-2x fa-spinner"></i></td>

                    </tr>
                </template>


                </tbody>

            </table>
            <div>
                <pagination :data="pagination" v-on:pagination-change-page="fetchData"></pagination>
            </div>

        </div>

    </div>
</template>
<script>


    export default {
        data(){
            return{
                search: {
                    course:'',
                    university:'',
                    subject:'',
                    study_level:'',
                    country:''
                },
                courses : '',
                pagination: '',
                student_id: false,
                successMesage: false

            }
        },
        mounted(){
            this.fetchData();
            this.setGetUrlParameter();
        },
        methods:{
            findGetParameter(parameterName) {
                var result = null,
                    tmp = [];
                var location = window.location.search;
                location.substr(1)
                    .split("&")
                    .forEach(function (item) {
                        tmp = item.split("=");
                        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
                    });
                return result;
            },
            setGetUrlParameter(){
                this.student_id     = this.findGetParameter('student_id');
            },
            fetchData(page){
                if(!page)
                    page = 1;

                let vm = this;
                axios.get('/api/get-course?page='+page, {
                    params: {
                        course: this.search.course,
                        university : this.search.university,
                        subject : this.search.subject,
                        study_level : this.search.study_level,
                        country : this.search.country,
                    }
                })
                    .then(response => {
                        vm.courses = response.data.data;
                        vm.pagination = response.data;
                    })
            },
            shortlist(index){
                let vm = this;
                axios.post('/course/shortlist',{
                    course_id: this.courses[index].id,
                    student_id: this.student_id
                })
                    .then(response => {
                        console.log(response);
                        if(response.data.success){
                            vm.successMesage = true;
                            setTimeout(function(){
                                vm.successMesage= false
                            },5000)

                        }

                    })

            }


        }

    }
</script>
<style>

</style>
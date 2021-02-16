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
                            <img style="margin-top: -3px;" src="" alt="" class="withdrawn">
                            Course Details
                            <div class="pull-right">
                                <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-target="#assignApplication">Assign Application</button>
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
                                <td>{{ courseDetails.course_id }}</td>
                                <td>{{ courseDetails.university_id }}</td>
                                <td>{{ courseDetails.campus }}</td>
                                <td>
                                    <button type="button" data-target="#eligibility" data-toggle="modal" class="btn btn-xs btn-primary" @click="showEligibilityCriteria()">View</button>
                                </td>
                                <td>
                                    <button type="button" data-target="#doc-checklist" data-toggle="modal" class="btn btn-xs btn-primary" @click="showDocumentCheckList()">View</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <assigned-section :documents_name = "documents_name"></assigned-section>
                        <send-email></send-email>
                    </div>
                </div>
             </div>
        </div>
        <div id="eligibility" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Eligibilty Criteria</h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Sl. No.</th>
                                <th>Name of the Exam</th>
                                <th>Marks</th>
                                <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr v-for="(value,index) in eligibility_criteria">
                                <td>{{ 1 + index }}.</td>
                                <td>{{  additional_exams_name[value.exam_id] }}</td>
                                <td>{{  value.marks }}</td>
                                <td>{{ value.description}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="doc-checklist" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Document Checklist</h4>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Name of the document</th>

                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="(value,index) in document_check_list">
                                    <td> {{ 1+index }}.</td>
                                    <td>{{ documents_name[value] }}</td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        <assign-application ></assign-application>
    </div>
</template>
<script>
    import assignApplication from './components/assign_application.vue'
    import sendEmail from './components/mails.vue'
    import assignedSection from './components/assigned_section.vue'
    export default {
        components :{
            assignApplication,
            assignedSection,
            sendEmail
        },
        data(){
            return {
                studentId:'',
                applicationId:'',
                courseDetails:'',
                eligibility_criteria:'',
                document_check_list:'',
                additional_exams_name: '',
                documents_name:'',
            }
        },
        mounted(){
           this.setGetUrlParameter();
           this.getCourseDetails();
           this.getExamDocumentNames();
        },
        methods:{
            getExamDocumentNames(){
                let vm = this;
                axios.get('/api/get_exam_document_name')
                .then(response=> {
                    vm.documents_name = response.data.document_names;
                    vm.additional_exams_name = response.data.exam_name;
                    console.log(response);
                })
            },
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
                 this.studentId     = this.findGetParameter('student_id');
                 this.applicationId = this.findGetParameter('application_id');
            },
            getCourseDetails(){
                let vm  = this;
                console.log("application id " + this.applicationId);
                axios.get('/application/'+this.applicationId)
                    .then(response =>{
                        console.log(response);
                        vm.courseDetails = response.data;
                    })
            },
            showEligibilityCriteria(){
                let vm  = this;
                axios.get('/api/eligibility-criteria-by-application-id', {
                    params:{id: vm.applicationId}
                })
                .then(response => {
                    vm.eligibility_criteria = JSON.parse(response.data);
;               });
            },
            showDocumentCheckList(){
                let vm  = this;
                axios.get('/api/document-check-list-by-application-id', {
                    params:{id: vm.applicationId}
                })
                .then(response => {
                    console.log(response);
                    vm.document_check_list = JSON.parse(response.data);
                });
            }
        }

    }


</script>
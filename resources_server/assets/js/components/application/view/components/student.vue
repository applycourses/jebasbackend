<template>
    <div class="tab-pane active" id="tab1">
        <h4 class="bold">Application Documents
            <div class="pull-right">
                <button
                        type="button"
                        class="btn btn-info btn-xs"
                        data-toggle="modal"
                        data-target="#student_application_documents"
                        @click="showStudentDocument"
                >View All
                </button>
            </div>
        </h4>
        <hr>
        <div id="student_application_documents" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Application Documents</h4>
                    </div>
                    <div class="modal-body">
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
                            <template v-if="student_application_documents.length > 0">
                                <tr v-for="(value,index) in student_application_documents">
                                    <td>{{ 1 + index }}.</td>
                                    <td>{{ value.document }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-xs"  :href="value.download" download>Download</a>
                                    </td>
                                    <td>
                                        {{ value.created_at }}
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <th colspan="4">Nothing Uploaded</th>
                                </tr>
                            </template>

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>

            </div>
        </div>
          <!--  Acceptance Letter-->
        <h4 class="bold">Acceptance Letter
            <div class="pull-right">
                <button
                        type="button"
                        class="btn btn-info btn-xs"
                        v-if="student_application_status == 0"
                        @click="studentAcceptanceLetter('update',1)"
                >Request to Accept
                </button>
                <button
                        type="button"
                        class="btn btn-warning btn-xs"
                        v-else-if="student_application_status == 1"
                        @click="studentAcceptanceLetter('update',0)"
                >Acceptance Requested
                </button>
                <button
                        type="button"
                        class="btn btn-success btn-xs"
                        v-else-if="student_application_status == 2"
                >Accepted
                </button>
                <button
                        type="button"
                        class="btn btn-danger btn-xs"
                        v-else-if="student_application_status == 3"
                >Rejected
                </button>
            </div></h4>

        <hr>
      <!-- Payment  Status-->
        <h4 class="bold">Payment Status

            <div class="pull-right">
                <button
                        type="button"
                        class="btn btn-danger btn-xs"
                        v-if="student_payment_status == 0"
                        @click="updateStudentPaymentStatus(1)"
                >Not Paid
                </button>
                <button
                        type="button"
                        class="btn btn-warning btn-xs"
                        v-else-if="student_payment_status == 1"
                        @click="updateStudentPaymentStatus(0)"
                >Payment Requested
                </button>
                <button
                        type="button"
                        class="btn btn-success btn-xs"
                        v-else
                        @click="updateStudentPaymentStatus(0)"
                >Paid
                </button>
            </div>
        </h4>


        <hr>
        <h4 class="bold">Status
            <div class="pull-right">
                <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#update" @click="studentUpdate('view')">Update</button>
            </div>
        </h4>
        <div id="update" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form action="" @submit.prevent="studentUpdate('update')">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Student Application Status</h4>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <select name="updateCategory"  class="form-control" v-model="student_update.category">
                                        <option value="">Select Category</option>
                                        <option>Application Forwarded</option>
                                        <option>Rejection</option>
                                        <option>Conditional Offer</option>
                                        <option>Unconditional Offer</option>
                                        <option>Accepted</option>
                                        <option>Withdrawn</option>
                                        <option>Request for Payment</option>
                                        <option>Fees Paid</option>
                                        <option>Refunded</option>
                                        <option>Visa Letter</option>
                                        <option>Ready to File Visa</option>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <select name="updateCategory" id="" class="form-control" multiple="" v-model="student_update.documents_id">
                                        <option value="">Select Document</option>
                                        <option :value="value.id" v-for="(value,index) in student_documents"> {{ documents_name[value.document_id] }} ({{ value.uploaded_by }})</option>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <textarea type="text" class="form-control" placeholder="Remarks" v-model="student_update.remarks"></textarea>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                 </form>
            </div>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th width="20%">Status Type</th>
                    <th width="12%">Updated On(G.M.T)</th>
                    <th width="5%">Attachment</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(value,index) in all_student_application_status">
                    <td>{{ 1 + index }}</td>
                    <td> {{ value.status}}</td>
                    <td>{{ value.created_at }}</td>
                    <td><button data-toggle="modal" data-target="#modal" class="btn btn-xs btn-primary" @click="showStatusDocuments(value.id)">View</button></td>
                    <td>{{  value.remarks }}</td>
                </tr>
            </tbody>
        </table>
        <div id="modal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Attachment
                            <button type="button" class="btn btn-xs btn-success" @click="showAttachmentMoreForm =! showAttachmentMoreForm">
                                {{ (showAttachmentMoreForm) ? 'Hide Documents' : 'Add More Documents' }}</button>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="" v-if="showAttachmentMoreForm">
                           <form  @submit.prevent="AddMoreDocumentInStatus">
                            <input type="hidden" v-model="addDocuments.status_id">
                            <input type="hidden" v-model="addDocuments.application_id">
                            <div class="form-group">
                                <select name="updateCategory"
                                        class="form-control"
                                        multiple="" v-model="addDocuments.document_id">
                                    <option value="">Select Document</option>
                                    <option :value="value.id" v-for="(value,index) in student_application_documents"> {{ documents_name[value.document_id] }} ({{ value.uploaded_by }})</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-xs btn-success">Add</button>
                            </div>
                        </form>
                        </div>


                        <table class="table">
                            <thead>
                            <tr>
                                <th width="10%">Sl. No.</th>
                                <th>Document Name</th>
                                <th width="26%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-if="status_documents.length >= 1">
                                <tr v-for="(value,index) in status_documents">
                                    <td> {{ 1 + index }}.</td>
                                    <td>{{ value.document_name }}</td>
                                    <td>
                                        <button type="button" class="btn red btn-outline btn-xs" @click="deleteStudentStatusDocument(index)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a :href="value.document_path" class="btn dark btn-outline btn-xs" download>
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                    <tr>
                                        <th colspan="3">No Documents</th>
                                    </tr>
                            </template>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:['documents_name'],
        data(){
            return{
                studentId:'',
                applicationId:'',
                student_application_documents:'',
                student_payment_status:'',
                student_application_status:'',
                successMessageofPaymentStatus:false,
                successMessageOfAcceptanceLetter:false,
                student_documents: '',
                student_update:{
                    category:'',
                    documents_id:[],
                    remarks:''
                },
                all_student_application_status:'',
                status_documents:'',
                showAttachmentMoreForm: false,
                addDocuments:{
                    'application_id': '',
                    'status_id': '',
                    'document_id': [],
                },
            }
        },
        mounted(){
            this.setGetUrlParameter();
            this.studentPaymentStatus();
            this.studentAcceptanceLetter("view");
            this.getApplicationStatus();
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
                this.studentId     = this.findGetParameter('student_id');
                this.applicationId = this.findGetParameter('application_id');
            },
            showStudentDocument(){

               let vm = this;
               if(this.student_application_documents == ''){
                   axios.get('/api/student-application-document-list-application-id', {
                       params:{id: vm.applicationId}
                   })
                   .then(response => {
                       console.log(response);
                       vm.student_application_documents = response.data;
                   })

               }

            },
            studentPaymentStatus() {
                let vm = this;
                axios.get('/api/student-payment-status-application-id', {
                    params:{id: vm.applicationId}
                })
                .then(response => {
                    vm.student_payment_status = response.data.tution_fee;
                })
            },
            updateStudentPaymentStatus(type){
                var requested = confirm("Are you sure you want to changed the status of payment for student ?");
                if(requested)
                {
                    let vm = this;
                    axios.post('/api/student-payment-status-application-id-update', {
                        id: this.applicationId,
                        tution_fee: type
                    })
                    .then(response => {
                        if(response.data.success){
                            vm.studentPaymentStatus();
                        }
                    })
                }

            },
            studentAcceptanceLetter(action,new_status = false){
                let vm = this;
                if(action == 'view'){
                    if(vm.student_application_status == ''){
                        axios.get('/api/student-acceptance-letter-application-id', {
                            params:{ id: vm.applicationId }
                        })
                        .then(response => {
                            vm.student_application_status = response.data.acceptance;
                        })
                    }
                }else{
                    axios.post('/api/student-acceptance-letter-application-id-update', {
                        id        : this.applicationId,
                        acceptance: new_status
                    })
                    .then(response => {
                        if(response.data.success)
                            vm.studentAcceptanceLetter("view");

                    })

                }
            },
            studentUpdate(action){
                let vm = this;
                if(action == 'view'){
                    axios.get('/api/get-all-document-for-application',{
                        params:{ id: vm.applicationId }
                    })
                    .then(response =>{
                        vm.student_documents =response.data;
                    })
                }else{
                    this.student_update.application_id =  this.applicationId;
                    axios.post('/application/update-student-status',this.student_update)
                    .then(response => {
                      console.log(response);
                        if(response.data.success){

                          //  window.location.reload();
                        }

                    })

                }
            },
            getApplicationStatus(){
                let vm = this;
                axios.get('/application/student/status/'+this.applicationId)
                .then(response => {
                    vm.all_student_application_status = response.data;

                });
            },
            showStatusDocuments(id){
                let vm = this;
                this.showStudentDocument();
                this.addDocuments.application_id = this.applicationId;
                this.addDocuments.status_id      = id;

                axios.get('/application/status-documents/',{
                    params: {
                        application_id : vm.applicationId,
                        status_id : id
                    }
                })
                .then(response => {
                    vm.status_documents = response.data;
                })
            },
            deleteStudentStatusDocument(index){
                let vm = this;
                axios.delete('/application/status-documents/delete/'+this.status_documents[index].id)
                    .then(response => {
                        if(response.data.success){
                            alert("successfully removed assigned course");
                            vm.status_documents.splice(index,1);
                        }

                    })
            },
            AddMoreDocumentInStatus(){
                axios.post('/application/status-documents/add',this.addDocuments)
                .then(response => {
                    console.log(response);
                    if(response.data.success){
                      alert("successfully Added");
                      window.location.reload();
                    }
                })
            }
        }

    }
</script>

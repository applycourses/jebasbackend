<template>

        <form @submit.prevent="uploadFile" >
            <tr>
                <td width="20%">
                    <!--{{ allData }}-->
                    <label for="">Upload On Behalf Of</label>
                    <select name="" class="form-control" v-model="form.behalfOf" @change="showCategoryBasedOnBehalfOf">
                        <option value="">Select Upload on Behalf Of</option>
                        <option value="admin">Admin</option>
                        <option value="student">Student</option>
                    </select>
                </td>
                <td width="20%">
                    <label for="">Category</label>
                    <select name=""  class="form-control" v-model="form.category" @click="categoryChanged">
                        <option value="">Select Category</option>
                        <option :value="value.id" v-for="(value,index) in allData" >{{ value.name }}</option>
                    </select>
                </td>
                <td v-if="showCourse">
                    <label for="">Course</label>
                    <select name=""  class="form-control" v-model="form.course">
                        <option value="">Select Course</option>
                        <option :value="value[0].id" v-for="(value,index) in allCourse">{{ value[0].name }}</option>
                    </select>
                </td>
                <td width="20%">
                    <label for="">Documents</label>
                    <select name="" id="" class="form-control"  v-model="form.name">
                        <option value="">Select Document</option>
                        <option :value="value.id" v-for="(value,index) in documents" >
                            {{ value.name }}
                        </option>
                    </select>
                </td>
                <td width="20%">
                    <label for="">Choose Documents</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="image-upload">
                        <span class="input-group-btn">
                            <button class="btn blue" type="submit" >Upload</button>
                        </span>
                    </div>
                </td>
            </tr>
        </form>


</template>
<script>
    export default {
        data(){
            return {
                showCourse:false,
                form:{
                    behalfOf:'',
                    category:'',
                    course:'',
                    name:'',

                },
                allData:'',
                documents:'',
                allCourse:''
            }
        },
        computed:{

        },
        methods:{
            getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
            },
            categoryChanged(event){
                this.form.category;
                var text = event.target.options[event.target.selectedIndex].innerHTML;
                let vm = this;
                if(text == 'Application'){
                    this.showCourse =true;
                    this.getAllCourse();

                }else{
                    this.showCourse =false;
                }

                axios.get('/documents/documents-base-on-category',{params:{category:this.form.category}})
                .then(response => {
                    vm.documents = response.data;
                })
            },
            showCategoryBasedOnBehalfOf(){
                if(this.form.behalfOf != ''){
                    let vm = this;
                    axios.get('/documents/category-based-on-behalfOf',{params:{behalf:this.form.behalfOf}})
                    .then(response => {console.log(response.data); vm.allData = response.data;})
                }
            },
            uploadFile(){
                const fileInput = document.querySelector('#image-upload');

                const formData = new FormData();

                formData.append('behalfOf', this.form.behalfOf );
                formData.append('category',this.form.category );
                formData.append('course', this.form.course );
                formData.append('name', this.form.name );
                formData.append('file',fileInput.files[0]);
                formData.append('student_id',this.getUrlParameter('student_id'));

                axios.post('/documents',formData)
                 .then(response => {
                     if(response.data.success)
                         window.location.reload();
                 });

            },
            getAllCourse(){
             var student_id =  this.getUrlParameter("student_id");
             let vm = this;
             axios.get('/documents/course-based-on-student-id',{
                 params: {'studentId': student_id }
             })
             .then(response => {
                 vm.allCourse=response.data;
                 console.log(response);
             })
            }
        }
    }
</script>
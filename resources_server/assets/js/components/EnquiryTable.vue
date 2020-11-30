<template>
<div>
<div class="row">
    <div class="col-md-6 col-sm-12">
        <label>
            Show :
            <select name="sample_1_length" aria-controls="sample_1" class="form-control input-sm input-xsmall input-inline showDataPerPage" v-model="show" v-on:change="enquiryData()">           
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </label>
        
    </div>        
</div>
 <div class="table-responsive">
    <table class="table table-bordered">
      <thead>
         <tr>
            <th>Enq. No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile No.</th>
            <th>Citizenship</th>
            <th>Desired Country</th>
            <th>Level</th>
            <th>Registerd</th>
            <th>Status</th>
            <th>Enquiry Type</th>
            <th>Actions</th>
         </tr>
     </thead>
        
        <tbody>        
      
           <tr v-for="enquiry in a">
               <td> {{ enquiry.enquiry_no}} </td>
               <td> {{ enquiry.name}} </td>
               <td> {{ enquiry.email}} </td>
               <td> {{ enquiry.contact}} </td>
               <td> {{ enquiry.citizenship}} </td>
               <td> {{ enquiry.willing_country}} </td>
               <td> {{ enquiry.study_level_id}} </td>
               <td>
                    <span  v-if="enquiry.student_id == null">No </span>
                    <span  v-if="enquiry.student_id != null">Yes </span>
               </td>              

                <td class="no-padding" >
                    <span v-if="enquiry.status == null" class="label label-block label-success label-xs">Open</span>
                    <span v-if="enquiry.status == 1" class="label label-block label-warning label-xs" >Processing</span>
                    <span v-if="enquiry.status == 2" class="label label-block label-danger label-xs">Closed</span>                 

                </td>               
              <!--  <td> {{ enquiry.student_id}} </td> -->
               
               <td> {{ enquiry.type}} </td>
               <td> 
                    <a :href="'/enquiry/'+ enquiry.id"><i class="fa fa-eye view"></i></a>
                    <a class="pull-right" href="#"><i class="fa fa-trash view"></i></a>
               </td>
           </tr>
           <tr>
            <td colspan="11" align="center"  v-show="loading">
              <i  class="fa fa-spinner fa-spin" style="font-size:20px"></i>
            </td>
          </tr>
           <tr>
             <td colspan="11" align="center">
               <button class="btn btn-link" v-on:click="showMore()">Show More</button>
             </td>
           </tr>


       </tbody>
      
                            


   </table>   

</div>
</div>
</template>

<script>
    export default {
         data() {
            return {               
                a: {},
                show:20,
                pagination : {
                    current_page : '',
                    next_page_url : '',
                    prev_page_url : '',
                    total : ''                    
                },
                loading:true,
                page : 1
             }               
        } ,
        mounted() {
           this.enquiryData();
        },
        methods: {
            enquiryData(){
               const vm = this;               
              axios.get('/enquiryData?page='+vm.page)
               .then(function (response) { 
                      console.log(response.data[0]);     
                       Vue.set(vm.a, response.data[0].data) 
                       console.log(vm.a);                 
                       
                       vm.loading = false;         
               });                              
            },
            showMore(){
               this.page += 1;
               this.enquiryData();
            }
           
           

        }
           
               
           
        
    }
</script>

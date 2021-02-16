<template>
   <div class="clearfix ">
        <div class="col-md-12">
            <div class="tabbable-bordered margin-bottom-15">
                <ul class="nav nav-tabs">
                    <li class="active"> <a href="#step1" data-toggle="tab"> Step 1</a>
                    </li>
                    <li> <a href="#step2" data-toggle="tab"> Step 2</a>
                    </li>
                    <li> <a href="#step3" data-toggle="tab"> Step 3</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="step1">
                        <step1 :countries="countries"></step1>
                    </div>
                    <div class="tab-pane" id="step2">
                        <step2></step2>
                    </div>
                    <div class="tab-pane" id="step3">
                        <step3></step3>
                    </div>
                </div>
            </div>
            <div class="pull-right"> <a href="/pages/crm/registration_form/view.php" class="btn default">Go Back</a>
                <button type="submit" class="btn blue">Update</button>
            </div>
        </div>
    </div>
</template>
<script>
    import step1 from './components/step1.vue';
    import step2 from './components/step2.vue';
    import step3 from './components/step3.vue';
    export default {
        components:{
            step1,
            step2,
            step3
        },
        mounted(){
            this.fetchCountries()
        },
        data(){
            return{
                countries:''
            }
        },
        methods:{
            fetchCountries(){
             let vm = this;
             axios.get('/api/countries')
                 .then(response => {
                    this.countries = response.data;
                 })
            }
        }
    }

</script>
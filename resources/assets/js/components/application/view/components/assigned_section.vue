<template>
    <div>

        <div class="tabbable-bordered">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab"> Student</a>
                </li>

                <li>
                    <a href="#tab3" data-toggle="tab"> University</a>
                </li>
            </ul>
            <div class="tab-content">
                <app-student :documents_name="documents_name"></app-student>

                <app-university></app-university>
            </div>
        </div>
    </div>
</template>
<script>
    import AppStudent from './student.vue';

    import AppUniversity from './university.vue';
    export default{
        props: ['documents_name'],
        components:{
            AppStudent,
            AppUniversity,
        },
        data(){
            return{
            }
        },
        methods:{
            showStudentDocument(){
                alert()
            }
        }

    }
</script>
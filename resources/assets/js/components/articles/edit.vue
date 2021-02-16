<template>
    <form role="form" @submit.prevent="submitData">
        <div class="form-body row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title </label>
                    <input type="text" class="form-control" placeholder="Please enter title of the article" v-model="editData.name" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label>Select Category</label>
                <div class="category-search">
                    <input type="text" class="form-control" placeholder="Search . . . ."  v-model="searchCategory" >
                </div>
                <div class="form-group">
                    <ul class="editor">

                        <li v-for="category in filteredCategories">
                            <input
                                    type="checkbox"
                                    :id="category"
                                    name="category"
                                    v-model="selectedCategory"
                                    :value="category"
                            >
                            <label class="checkbox-select" :for="category">{{ category }}</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label class="label-control">Selected Category</label>

                <ul class="editor-category">
                    <li v-for="(category,index) in selectedCategory">
                        <a
                                href="javascript:void(0)"
                                @click="removeSelectedCategory(index)"
                        >{{ category }} <span>x</span></a>
                    </li>
                </ul>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Tags
                    </label>
                    <input-tag  :tags="editData.tags" placeholder="Put your tags here"></input-tag>

                </div>
            </div>
            <div class="col-md-12">

                <img :src="editData.image_path"  alt="">
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Image Title </label>
                    <input type="text" placeholder="Please enter the the title of the image" class="form-control" v-model="editData.image_title">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Article Image</label>
                    <input type="file" class="form-control" id="featuredImage"  >
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Description </label>
                    <ckeditor
                            v-model="editData.description"
                            :id="editorA"
                            :height="'300px'"
                            :toolbar="[['Format']]"
                    ></ckeditor>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Facebook Title</label> <span data-placement="right" data-toggle="tooltip" title="If you don't want to use the post title for sharing the post on Facebook but instead want another title there, write it here."> <i class="fa fa-question-circle"></i> </span>
                    <input type="text" name="facebook_title" placeholder="" class="form-control" v-model="editData.seos.title">
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Facebook Description</label><span data-toggle="tooltip" data-placement="right" title="If you don't want to use the meta description for sharing the post on Facebook but want another description there, write it here."> <i class="fa fa-question-circle"></i> </span>
                    <textarea class="form-control" name="fbDescription" v-model="editData.seos.description"></textarea>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-actions">
                    <button type="submit" class="btn blue" >Update Article</button>
                    <button type="reset" class="btn red">Reset</button>

                    <div class="alert alert-warning" v-if="beforeSubmit">
                        <i class="fa fa-spinner fa-spin" aria-hidden="true"></i> Proccessing
                    </div>
                    <div class="alert alert-success" v-if="afterSubmit">
                        <i class="fa fa-check" aria-hidden="true"></i>Success
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    import InputTag from 'vue-input-tag'
    import Ckeditor from 'vue-ckeditor2'

    export default {
        mounted() {
            this.get_category();
            this.fetch_data();
        },
        components: {
            InputTag,
            Ckeditor
        },
        data(){
            return{
                categories: [],
                searchCategory: '',
                selectedCategory:[],
                editorA: 'editor-a',
                config: {
                    toolbar: [
                        [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                    ],
                    height: 300
                },
                editData: {
                    'selectedCategory': '',
                },
                beforeSubmit: false,
                afterSubmit :false,
            }
        },
        computed: {
            filteredCategories(){
                var self=this;
                return this.categories.filter(function(items) {
                    return items.toLowerCase().indexOf(self.searchCategory.toLowerCase())>=0;
                });
            }
        },
        filters: {
            capitalize: function (value) {
                if (!value) return ''
                value = value.toString()
                return value.charAt(0).toUpperCase() + value.slice(1)
            },
        },

        methods: {
            fetch_data(){
                let vm = this;
                var href = window.location.href;
                var id =  href.split("/")[4];

                axios.get('/articles/edit/'+id)
                .then(function (response) {
                    console.log(response);
                    vm.editData = response.data;
                    vm.selectedCategory = response.data.category;

                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            searchCategory(){

            },
            get_category(){
                var vm = this;
                axios.get('/api/articles/category')
                    .then(function (response) {
                        for (var x = 0; x < response.data.countries.length; x++) {
                            var model = response.data.countries[x];
                            vm.categories.push(model);
                        }
                        for (var x = 0; x < response.data.study_levels.length; x++) {
                            var model = response.data.study_levels[x];
                            vm.categories.push(model);
                        }
                        for (var x = 0; x < response.data.subjects.length; x++) {
                            var model = response.data.subjects[x];
                            vm.categories.push(model);
                        }
                        for (var x =0 ; x < response.data.others.length; x++){
                            var model = response.data.others[x];
                            vm.categories.push(model);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            removeSelectedCategory(index){
                this.selectedCategory.splice(index,1);
            },
            submitData(){
                this.beforeSubmit =true;
                var vm =this;
                const fileInput = document.querySelector( '#featuredImage' );
                var form = new FormData();
                form.append('image', fileInput.files[0] );
                form.append('id', this.editData.id);
                form.append('name', this.editData.name );
                form.append('tags', this.editData.tags);
                form.append('description',this.editData.description );
                form.append('titleOfImage', this.editData.image_title );
                form.append('selectedCategory', this.selectedCategory);
                form.append('fb_description',this.editData.seos.description);
                form.append('fb_title',this.editData.seos.title);

                axios.post( '/articles/update/'+this.editData.id,form)
                    .then( ( response ) => {

                        vm.beforeSubmit =false;
                        vm.afterSubmit =true;
                        if(response.data.success)
                            window.location.href = '/articles';
                    } )
                    .catch( ( error ) => {
                        console.log(error);
                    } );
            }
        }

    }
</script >
<style  scoped>
    .editor, .editor-category{
        padding: 10px;
        margin: 0 0 20px 0;
        list-style: none;
        border: 1px solid #c7c7c7;
        border-top: none;
        height: 300px;
        overflow-y: scroll
    }
    .editor-category{
        border: 1px solid #c7c7c7;
        height: 354px
    }

    .editor-category li a{
        text-decoration: none;
        padding: 10px;
        border: 1px solid #bdbdbd;
        display: block;
        color: #333;
        margin-bottom: 10px;
    }
    .editor-category li a span{
        float: right;
    }
    .category-search{
        padding:10px;
        border: 1px solid #c7c7c7;
    }
    .category-search input[type=text] {
        width: 40%;
        -webkit-transition: width 0.4s ease-in-out;
        transition: width 0.4s ease-in-out;
    }

    .category-search input[type=text]:focus {
        width: 100%;
    }
    .checkbox-select{
        display: block;
        padding:4px;
    }
    .editor input[type=checkbox]{
        display:none
    }
    .editor input[type=checkbox]:checked + .checkbox-select{
        background: #3598dc;
        color: #fff;
    }
</style>
<template>
    <form role="form" @submit.prevent="submitData">
        <div class="form-body row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" placeholder="Please enter title of the article" v-model="title" required>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">

                <div class="category-search">
                    <label>Category</label>

                    <input type="text" class="form-control" placeholder="Search . . . . "  v-model="searchCategory" >
                </div>
                <div class="form-group">
                    <ul class="editor">
                        <li v-for="category in filteredCategories">
                            <input type="checkbox" :id="category" name="category" v-model="selectedCategory" :value="category" >
                            <label class="checkbox-select" :for="category">{{ category }}</label>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <label class="label-control">Selected Category</label>

                <ul class="editor-category">
                    <li v-for="(category,index) in selectedCategory">
                        <a href="javascript:void(0)" @click="removeSelectedCategory(index)">{{ category }} <span>x</span></a>
                    </li>
                </ul>

            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Tags
                   </label>
                    <input-tag  :tags="tagsArray" placeholder="Put your tags here"></input-tag>

                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Image Title</label>
                    <input type="text" placeholder="Please enter the the title of the image" class="form-control" v-model="titleOfImage">
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Article Image</label>
                    <input type="file" class="form-control" id="featuredImage"  required>
                </div>
            </div>
            <div class="col-md-12 col-sm-12">
                <div class="form-group">
                    <label>Description</label>
                    <ckeditor
                            v-model="description"
                            :id="editorA"
                            :height="'300px'"
                            :toolbar="[['Format']]"
                    ></ckeditor>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Facebook Title</label> <span data-placement="right" data-toggle="tooltip" title="If you don't want to use the post title for sharing the post on Facebook but instead want another title there, write it here."> <i class="fa fa-question-circle"></i> </span>
                    <input type="text" name="facebook_title" placeholder="" class="form-control" v-model="fb_title">
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    <label>Facebook Description</label><span data-toggle="tooltip" data-placement="right" title="If you don't want to use the meta description for sharing the post on Facebook but want another description there, write it here."> <i class="fa fa-question-circle"></i> </span>
                    <textarea class="form-control" name="fbDescription" v-model="fb_description"></textarea>
                </div>
            </div>

            <div class="col-md-12 col-sm-12">
                <div class="form-actions">
                    <button type="submit" class="btn blue" >Create Article</button>
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
        },
        components: {
            InputTag,
            Ckeditor

        },
        data(){
          return{
              categories: [],
              searchCategory: '',
              searchCategories: [],
              selectedCategories : [],
              selectedCategory: [],
              titleOfImage:'',
              featuredImage:'',
              description:'',
              title: '',
              tagsArray: [],
              editorA: 'editor-a',
              config: {
                  toolbar: [
                      [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ]
                  ],
                  height: 300
              },
              beforeSubmit: false,
              afterSubmit :false,
              fb_title : '',
              fb_description :''
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
                const formData = new FormData();
                formData.append( 'image', fileInput.files[0] );
                formData.append( 'name', this.title );
                formData.append( 'tags', this.tagsArray );
                formData.append( 'description',this.description );
                formData.append( 'titleOfImage', this.titleOfImage );
                formData.append( 'selectedCategory', this.selectedCategory );
                formData.append('fb_description',this.fb_description);
                formData.append('fb_title',this.fb_title);
                axios.post( '/api/articles/category', formData )
                    .then( ( response ) => {
                        vm.beforeSubmit =false;
                        vm.afterSubmit =true;
                        window.location.href = '/articles';
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
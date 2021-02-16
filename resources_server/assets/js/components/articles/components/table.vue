<template>
    <div class="table-responsive">

        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="8%">Sl.No.</th>
                <th>Article Topic</th>
                <th>Created At</th>
                <th> Action </th>
            </tr>
            </thead>
            <tbody>
            <tr v-if="loading">
                <td colspan="4">
                    <i class="fa fa-spinner fa-spin fa-2x" style="margin: 0;"></i>
                </td>
            </tr>
            <tr v-else v-for="(article,index) in allArticles">
                <td>{{ ++index }}.</td>
                <td>{{ article.name }}</td>
                <td>{{ article.created_at }}</td>
                <td>
                    <a href="/pages/blogs/articles/edit.php"><i class="fa fa-pencil-square-o"></i></a>
                </td>
            </tr>
            </tbody>

        </table>
        <pagination :data="Pagination" v-on:pagination-change-page="fetchData"></pagination>
    </div>
</template>
<script>
    import pagination from 'laravel-vue-pagination'

    export default {
        data(){
            return {
                allArticles : [],
                Pagination : '',
                loading:false,
            }
        },
        components: {
                pagination : pagination
        },
        mounted(){
                this.fetchData()
        },
        methods: {
                fetchData(page){
                   var vm = this;
                    if (typeof page === 'undefined') {
                        page = 1;
                    }
                    this.loading = true;
                   axios.get('api/articles?page=' + page)
                       .then(response =>{
                              vm.loading = false;
                              console.log(response);
                              vm.allArticles = response.data.data;
                              vm.Pagination = response.data;
                       })
                       .catch(error =>{
                             console.log(error);
                       })
                }
        }

    }
</script>
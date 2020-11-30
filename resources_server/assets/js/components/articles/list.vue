<template>
    <div class="portlet-body">
        <filter-app>

        </filter-app>
        <show-app>

        </show-app>

        <table-app>

        </table-app>
    </div>
</template>
<script>
    import filter from './components/filter.vue'
    import show from './components/show.vue'
    import table from './components/table.vue'
    export  default {
        components:{
            filterApp : filter,
            showApp: show,
            tableApp : table
        }
    }

</script>
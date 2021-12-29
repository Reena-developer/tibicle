<template>
    <div>
        <bootstrap-4-datatable :columns="columns" :data="rows" :filter="filter" :per-page="perPage"></bootstrap-4-datatable>
        <bootstrap-4-datatable-pager v-model="page" type="abbreviated"></bootstrap-4-datatable-pager>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                columns: [{
                        label: 'id',
                        field: 'id'
                    },
                    {
                        label: 'first_name',
                        field: 'first_name'
                    },
                    {
                        label: 'last_name',
                        field: 'last_name'
                    },
                    {
                        label: 'mobile_num',
                        field: 'mobile_num'
                    }
                ],
                rows: [],
                page: 1,
                filter:  '',
                perPage: 12,
            }
        },
        methods: {
            Users: function () {
                axios.get('/users').then(function (res) {
                    this.rows = res.data;
                }.bind(this));
            }
        },
        created: function () {
            this.Users()
        }
    }

</script>
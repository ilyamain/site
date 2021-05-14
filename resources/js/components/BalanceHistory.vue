<template>
    <div class="balance-history">
        <div class="mb-2 mt-5 clearfix">
            <div class="float-right ml-3 btn btn-outline-primary" @click="update(50)">50</div>
            <div class="float-right ml-3 btn btn-outline-primary" @click="update(40)">40</div>
            <div class="float-right ml-3 btn btn-outline-primary" @click="update(30)">30</div>
            <div class="float-right ml-3 btn btn-outline-primary" @click="update(20)">20</div>
            <div class="float-right ml-3 btn btn-outline-primary" @click="update(10)">10</div>
        </div>

        <table class="table table-sm table-bordered table-hover text-right">
            <thead>
                <tr class="text-center">
                    <th scope="col">User ID</th>
                    <th scope="col">Value</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Date & time</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in transactions">
                    <td class="text-center">{{ item.user_id }}</td>
                    <td>{{ item.value }}</td>
                    <td>{{ item.balance }}</td>
                    <td>{{ item.created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['limit'],
        data: function() {
            return {
                transactions: [],
                reactiveLimit: this.limit,
            };
        },
        mounted() {
            this.init();
        },
        methods: {
            init: function() {
                this.request();
            },
            update: function(limit) {
                this.reactiveLimit = limit;
                this.request();
            },
            request: function() {
                axios({
                    method: 'get',
                    url: '/balance/history/',
                    params: {limit: this.reactiveLimit},
                })
                .then((response) => {
                    this.transactions = response.data;
                });
            },
        }
    }
</script>

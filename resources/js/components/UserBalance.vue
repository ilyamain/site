<template>
    <div class="user-balance clearfix">

        <transition name="appear">
            <div class="float-left d-inline-flex flex-row" v-if="reactiveUserId">
                <div class="mr-1">User {{ reactiveUserId }} balance:</div>
                <div class="font-weight-bold" v-if="total">{{ total }}</div>
                <div class="font-weight-bold" v-if="!total">...</div>
            </div>
        </transition>

        <div class="float-right">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">User ID</span>
                </div>
                <input type="text" class="form-control" v-model="reactiveUserId" @keyup="update($event)" autofocus />
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['userId'],
        data: function() {
            return {
                total: '',
                reactiveUserId: this.userId,
            };
        },
        mounted() {
            this.init();
        },
        methods: {
            init: function() {
                this.request();
            },
            update: function(e) {
                e = (e) ? e : window.event;

                var charCode = (e.which) ? e.which : e.keyCode;
                var allowedChars = [8, 13, 27, 46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 96, 97, 98, 99, 100, 101, 102, 103, 104, 105];

                if (allowedChars.indexOf(charCode) !== -1) {
                    this.request();
                }
            },
            request: function() {
                this.total = '';

                axios({
                    method: 'get',
                    url: '/balance/user-balance/',
                    params: {user_id: this.reactiveUserId},
                })
                .then((response) => {
                    this.total = (response.data)
                        ? response.data
                        : 'Empty';
                });
            },
        }
    }
</script>

<style>
    .appear-enter-active, .appear-leave-active {transition: all 0.4s ease;}
    .appear-enter, .appear-leave-to, .appear-leave-active {transform: translate(-10px, -2px); opacity: 0;}
</style>

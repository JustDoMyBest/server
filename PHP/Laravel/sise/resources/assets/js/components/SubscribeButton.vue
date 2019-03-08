<template>
    <!-- <button :class="classes" @click="subscribe">Subscribe</button> -->
    <button :class="classes" @click="subscribe">点我订阅</button>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
          classes() {
              return ['btn',this.active ? 'btn-primary' : 'btn-default'];
          }
        },

        methods:{
            subscribe(){
                // if (!App.signIn) {
                if (!App.signedIn) {
                    alert('登陆后开启订阅功能。');
                    return;
                }
                axios[
                        (this.active ? 'delete' : 'post')
                    ](location.pathname + '/subscriptions');

                this.active = ! this.active;;
            }
        }
    }
</script>
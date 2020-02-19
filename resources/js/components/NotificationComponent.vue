<template>

</template>

<script>

    export default {
        name: "NotificationComponent",
        props: {
            type: {
                type: String,
                required: false,
                default: 'info',
            },
            timeout: {
                type: Number,
                required: false,
                default: 0,
            },
            title: {
                type: String,
                required: false,
            },
            body: {
                type: String,
                required: true,
            }
        },
        data() {
            return {
                notificationOptions: {
                    timeout: this.timeout,
                    position: 'topRight',
                    closeOnClick: true,
                },
            }
        },
        mounted() {
            this.$toast[this.type](this.body, this.title, this.notificationOptions);
        }
    }
</script>

<style scoped lang="scss">

    @import '~izitoast/dist/css/iziToast.min.css';

</style>

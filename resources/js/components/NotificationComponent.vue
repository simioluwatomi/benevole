<script>
    import iziToast from "izitoast";

    export default {
        name: "NotificationComponent",
        props: {
            type: {
                type: String,
                required: false,
                default: 'info', // info, success, warning, error, question
            },
            timeout: {
                type: Number,
                required: false,
                default: 5000,
            },
            title: {
                type: String,
                required: false,
            },
            body: {
                type: String,
                required: true,
            },
            position: {
                type: String,
                required: false,
                default: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
            }
        },
        mounted: function () {
            iziToast[this.type]({
                title: this.title,
                message: this.body,
                position: this.position,
                closeOnClick: true,
                timeout: this.timeout,
            });
        }
    }
</script>

<style scoped lang="scss">

    @import '~izitoast/dist/css/iziToast.min.css';

</style>

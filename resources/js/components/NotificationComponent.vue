<template>
    <va-notification :type="type" :duration="duration" :title="title" :body="body">
    </va-notification>
</template>

<script>
    export default {
        name: "NotificationComponent",
        props: {
            'type': {
                type: String,
                required: true
            },
            'duration': {
                type: Number,
                required: false,
                default: 0
            },
            'title': {
                type: String,
                required: true
            },
            'body': {
                type: String,
                required: false
            },
        },
        methods: {
            trigger() {
                this.notification[this.type]({
                    title: `${this.title}`,
                    message: `${this.body}`,
                    duration: this.duration
                })
            },
        },
        mounted() {
            this.trigger()
        }
    }
</script>

<style scoped>

</style>

<template>
    <va-alert :type="type" :title="title">
        <p>{{ body }}</p>
    </va-alert>
</template>

<script>
    export default {
        name: "AlertComponent",
        props: {
            'type': {
                type: String,
                required: true
            },
            'title': {
                type: String,
                required: false
            },
            'body': {
                type: String,
                required: true
            },
        },
    }
</script>

<style scoped lang="scss">
</style>

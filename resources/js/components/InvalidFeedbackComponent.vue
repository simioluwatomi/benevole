<template>
    <b-form-invalid-feedback :state="false">
        <strong>{{ message }}</strong>
    </b-form-invalid-feedback>
</template>

<script>
    export default {
        name: "InvalidFeedbackComponent",
        props: {
            'message': {
                type: String,
                required: true
            },
        }
    }
</script>

<style scoped>

</style>

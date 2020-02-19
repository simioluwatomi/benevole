<template>

    <b-form-input
        :name="inputName"
        :id="inputId"
        v-model="value"
        :state="inputState"
        :placeholder="placeholder"
        :required="!!required"
    ></b-form-input>

</template>

<script>
    export default {
        name: "InputComponent",
        props: {
            inputName: {
                type: String,
                required: true,
            },
            inputId: {
                type: String,
                required: true,
            },
            inputState: {
                required: true,
            },
            oldInput: {
                type: String
            },
            placeholder: {
                type: String,
            },
            required: {
                type: Boolean,
                default: false,
            }
        },
        data() {
            return {
                value: this.oldInput ? this.oldInput : null,
            }
        }
    }
</script>

<style scoped>

</style>

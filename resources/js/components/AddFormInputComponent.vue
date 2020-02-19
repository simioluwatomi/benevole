<template>

    <div>

        <div class="d-flex mb-3" v-for="(input, index) in inputs" :key="input">

            <b-form-input
                id="requirements"
                name="requirements[]"
                class="flex-grow-1 mr-2"
                placeholder="Enter additional requirements"
                required
            ></b-form-input>

            <b-button variant="danger" class="ml-auto btn btn-icon" aria-label="delete"
                      @click="removeRequirement(input, index)">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-md">
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>

            </b-button>

        </div>

        <b-button variant="secondary" class="mb-3" @click="addRequirements" v-if="inputs.length <= 4">

            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="icon icon-md">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>

            Add More Requirements
        </b-button>

    </div>


</template>

<script>
    export default {
        name: "AddFormInputComponent",
        data() {
            return {
                inputs: [],
                amount: 0
            }
        },
        methods: {
            addRequirements() {
                this.inputs.push(++this.amount);
            },
            removeRequirement(input, index) {
                if (index > -1) {
                    this.inputs.splice(index, 1);
                }
            }
        }
    }
</script>

<style scoped>

</style>

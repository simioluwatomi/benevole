<template>

    <div>

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                {{ category.title }} Opportunities
            </h1>

            <div class="page-options btn-list">

                <b-link :href="`${previousUrl}`" class="btn btn-danger d-none d-md-inline-block">
                    <i class="fe fe-arrow-left mr-2"></i>
                    Back
                </b-link>

            </div>

        </div>

        <hr>

        <div class="row">

            <opportunity-component
                v-for="opportunity in items"
                :key="opportunity.id"
                :opportunity="opportunity"
                :category="category"
                v-bind:header="false"
            >
            </opportunity-component>

        </div>

    </div>

</template>

<script>
    export default {
        name: "CategoryDetailComponent",
        props: {
            opportunities: {
                type: Object,
                required: true
            },
            category: {
                type: Object,
                required: true
            },
            previousUrl: {
                type: String,
                required: false,
                default: "#"
            },
        },
        data() {
            return {
                items: this.opportunities.data,
            }
        },
    }
</script>

<style scoped>

</style>

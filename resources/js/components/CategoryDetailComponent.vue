<template>

    <div>

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                {{ category.title }} Opportunities
            </h1>

            <div class="page-options btn-list">

                <b-link :href="`${previousUrl}`" class="btn btn-danger d-none d-md-inline-block">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-md mr-2">
                        <polyline points="11 17 6 12 11 7"></polyline>
                        <polyline points="18 17 13 12 18 7"></polyline>
                    </svg>

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

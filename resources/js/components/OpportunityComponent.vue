<template>

    <div class="col-sm-4 py-2">

        <b-card class="h-100" no-body>

            <template v-if="header" v-slot:header>

                <div class="card-status bg-blue"></div>

                <b-link :href="`/categories/${category.slug}`" class="text-uppercase text-decoration-none">
                    {{ category.title }}
                </b-link>

            </template>

            <div v-if="status" class="card-status bg-blue"></div>

            <b-card-body>

                <h4 class="card-title leading-loose">
                    <b-link :href="`/opportunities/${opportunity.slug}`">
                        {{ opportunity.title }}
                    </b-link>
                </h4>

                <h4 class="text-muted-dark mb-4">
                    {{ opportunity.owner.username }}
                </h4>

                <p class="card-text lead font-weight-normal">
                    <i class="fe fe-watch px-1 text-primary"></i>
                    {{ opportunity.duration }} months
                </p>

                <b-button href="#" variant="primary" class="float-right">
                    <i class="fe fe-send mr-2"></i>
                    Apply Now
                </b-button>

            </b-card-body>

            <b-card-footer class="d-flex justify-content-between">

                <div class="col-xs-6">
                    <i class="fe fe-activity px-1"></i>
                    {{ opportunity.min_hours_per_week }} - {{ opportunity.max_hours_per_week }} hours per week
                </div>

                <div class="col-xs-6">
                    <i class="fe fe-clock px-1"></i>
                    {{ opportunity.createdAtDiffForHumans }}
                </div>

            </b-card-footer>

        </b-card>

    </div>

</template>

<script>
    export default {
        name: "OpportunityComponent",
        props: {
            opportunity: {
                type: Object,
                required: true
            },
            category: {
                type: Object,
                required: true
            },
            header: {
                type: Boolean,
                default: true
            },
            status: {
                type: Boolean,
                default: true
            },
        },
    }
</script>

<style scoped>

</style>

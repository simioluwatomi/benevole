<template>

    <div class="container">

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                Opportunity Details
            </h1>

            <div class="page-options btn-list">

                <b-link :href="`${previousUrl}`" class="btn btn-danger d-none d-md-inline-block">
                    <i class="fe fe-arrow-left mr-2"></i>
                    Back
                </b-link>

                <b-link href="#" class="btn btn-primary">
                    <i class="fe fe-send mr-2"></i>
                    Apply Now
                </b-link>

            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col-md-12">

                <b-card no-body>

                    <div class="card-status bg-blue"></div>

                    <b-card-body>

                        <!-- Dropdown -->
                        <b-dropdown class="float-right" variant="outline-primary" right>

                            <template v-slot:button-content>
                                <i class="fe fe-share-2"></i>
                            </template>

                            <b-dropdown-item href="#">
                                <i class="fe fe-facebook mr-2"></i>
                                Facebook
                            </b-dropdown-item>

                            <b-dropdown-item href="#">
                                <i class="fe fe-twitter mr-2"></i>
                                Twitter
                            </b-dropdown-item>

                            <b-dropdown-item href="#">
                                <i class="fe fe-linkedin mr-2"></i>
                                LinkedIn
                            </b-dropdown-item>

                        </b-dropdown>

                        <h1 class="text-center pt-8 display-4">
                            {{ opportunity.title }}
                        </h1>

                        <div class="d-flex justify-content-around flex-wrap mb-4">

                            <h4>
                                <i class="fe fe-activity px-1 text-primary"></i>
                                {{ opportunity.min_hours_per_week }} - {{ opportunity.max_hours_per_week }} Hours/Week
                            </h4>

                            <h4>
                                <i class="fe fe-watch px-1 text-primary"></i>
                                {{ opportunity.duration }} Months
                            </h4>

                            <h4>
                                <i class="fe fe-clock px-1 text-primary"></i>
                                {{ opportunity.createdAtDiffForHumans }}
                            </h4>

                        </div>

                        <h3 class="text-center font-weight-normal">
                            {{ opportunity.category.title }}
                        </h3>

                        <hr>

                        <section class="p-5">
                            <h3>
                                Description
                            </h3>
                            <p class="lead leading-loose font-weight-normal">
                                {{ opportunity.description }}
                            </p>
                        </section>

                        <section class="p-5">
                            <h3>
                                Requirements
                            </h3>
                            <ul>
                                <li v-for="requirement in opportunity.requirements" class="lead leading-loose font-weight-normal">
                                    {{ requirement }}
                                </li>
                            </ul>
                        </section>

                    </b-card-body>

                </b-card>

            </div>

        </div>

    </div>

</template>

<script>
    export default {
        name: "OpportunityDetailComponent",
        props: {
            opportunity: {
                type: Object,
                required: true
            },
            previousUrl: {
                type: String,
                required: false,
                default: "#"
            },
        },
    }
</script>

<style scoped>

</style>

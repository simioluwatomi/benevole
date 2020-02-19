import {formatDistance} from "date-fns";import {parseISO} from "date-fns";
<template>

    <div>

        <div class="page-header d-flex flex-row justify-content-between">
            <h1 class="page-title">
                Opportunity Details
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

                <b-link href="#" class="btn btn-primary">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-md mr-2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>

                    Apply Now
                </b-link>

            </div>

        </div>

        <hr>

        <div class="row">

            <div class="col-md-12">

                <b-card no-body>

                    <div class="card-status-top bg-blue"></div>

                    <b-card-body>

                        <!-- Dropdown -->
                        <b-dropdown class="float-right" variant="outline-primary" right>

                            <template v-slot:button-content>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon icon-md">
                                    <circle cx="18" cy="5" r="3"></circle>
                                    <circle cx="6" cy="12" r="3"></circle>
                                    <circle cx="18" cy="19" r="3"></circle>
                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                </svg>
                                <i class="fe fe-share-2"></i>
                            </template>

                            <b-dropdown-item href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon mr-2">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                                Facebook
                            </b-dropdown-item>

                            <b-dropdown-item href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon mr-2">
                                    <path
                                        d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                                Twitter
                            </b-dropdown-item>

                            <b-dropdown-item href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon mr-2">
                                    <path
                                        d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                                LinkedIn
                            </b-dropdown-item>

                        </b-dropdown>

                        <h1 class="text-center my-5 display-4">
                            {{ opportunity.title }}
                        </h1>

                        <div class="d-flex justify-content-around flex-wrap mb-5">

                            <h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon mr-1 text-primary">
                                    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                                </svg>
                                {{ opportunity.min_hours_per_week }} - {{ opportunity.max_hours_per_week }} Hours/Week
                            </h3>

                            <h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon mr-1 text-primary">
                                    <circle cx="12" cy="12" r="7"></circle>
                                    <polyline points="12 9 12 12 13.5 13.5"></polyline>
                                    <path
                                        d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path>
                                </svg>
                                {{ opportunity.duration }} Months
                            </h3>

                            <h3>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon mr-1 text-primary">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <time v-bind:datetime="opportunity.created_at"></time>
                                {{ formatCreatedAt }}
                            </h3>

                        </div>

                        <h3 class="text-center font-weight-normal">
                            {{ opportunity.category.title }}
                        </h3>

                        <hr>

                        <section class="px-3">
                            <h3>
                                Description
                            </h3>
                            <p class="lead leading-loose font-weight-normal">
                                {{ opportunity.description }}
                            </p>
                        </section>

                        <section class="px-3">
                            <h3>
                                Requirements
                            </h3>
                            <ul>
                                <li v-for="requirement in opportunity.requirements"
                                    class="lead leading-loose font-weight-normal">
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

    import {formatDistance, parseISO} from 'date-fns';

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
        computed: {
            formatCreatedAt() {
                return formatDistance(parseISO(this.opportunity.created_at), new Date(), {
                    addSuffix: true
                }).replace('about ', '');
            }
        }
    }
</script>

<style scoped>

</style>

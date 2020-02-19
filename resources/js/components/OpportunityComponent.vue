<template>

    <div class="col-sm-4 py-2">

        <b-card class="h-100" no-body>

            <template v-if="header" v-slot:header>

                <div class="card-status-top bg-blue"></div>

                <b-link :href="`/categories/${category.slug}`" class="text-uppercase text-decoration-none">
                    {{ category.title }}
                </b-link>

            </template>

            <div v-if="status" class="card-status-top bg-blue"></div>

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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon mr-1 text-primary">
                        <circle cx="12" cy="12" r="7"></circle>
                        <polyline points="12 9 12 12 13.5 13.5"></polyline>
                        <path
                            d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path>
                    </svg>
                    {{ opportunity.duration }} months
                </p>

                <b-button href="#" variant="primary" class="float-right">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon icon-md mr-2">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                    Apply Now
                </b-button>

            </b-card-body>

            <b-card-footer class="d-flex justify-content-between">

                <div class="col-xs-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon mr-2 text-primary">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                    {{ opportunity.min_hours_per_week }} - {{ opportunity.max_hours_per_week }} hours per week
                </div>

                <div class="col-xs-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                         class="icon mr-1 text-primary">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <time :datetime="opportunity.created_at"></time>

                    {{ formatCreatedAt }}

                </div>

            </b-card-footer>

        </b-card>

    </div>

</template>

<script>

    import {formatDistance, parseISO} from 'date-fns';

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

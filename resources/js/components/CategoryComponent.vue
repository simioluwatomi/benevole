<template>

    <div class="col-md-6 col-xl-3 py-2">

        <b-link class="card card-link h-100" :href="`/categories/${category.slug}`">

            <div class="card-status-left bg-green"></div>

            <b-card-body>

                <div class="lh-sm text-center">

                    <div class="h3 strong">

                        {{ category.title }}

                    </div>

                    <div class="text-muted mt-3">

                        {{ category.opportunities_count }} opportunities

                    </div>

                </div>

            </b-card-body>

        </b-link>

    </div>

</template>

<script>
    export default {
        name: "CategoryComponent",
        props: {
            category: {
                type: Object,
                required: true,
            }
        }
    }
</script>

<style scoped>

</style>

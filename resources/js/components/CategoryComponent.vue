<template>

    <div class="col-md-3 py-2">

        <b-card class="h-100" no-body>

            <div class="card-status bg-green"></div>

            <b-card-body>

                <div class="text-center">

                    <h4 class="text-uppercase mb-5">
                        <a v-bind:href="`/categories/${category.slug}`" class="stretched-link">
                            {{ category.title }}
                        </a>
                    </h4>

                    <span class="h2 mb-0">
                        {{ category.opportunities_count }}
                    </span>

                </div>

            </b-card-body>

        </b-card>

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

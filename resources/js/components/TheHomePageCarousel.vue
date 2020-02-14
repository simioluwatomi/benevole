<template>
    <div>
        <b-carousel
            id="myCarousel"
            v-model="slide"
            :interval="4000"
            controls
            indicators
            background="#777"
            img-width="1024"
            img-height="480"
        >
            <!-- Slide with blank fluid image to maintain slide aspect ratio -->
            <b-carousel-slide img-blank img-alt="Blank image">

                <div class="text-left">
                    <h1>Example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                        porta
                        gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p>
                        <a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a>
                    </p>
                </div>

            </b-carousel-slide>

            <b-carousel-slide img-blank img-alt="Blank image">

                <h1>Another example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                    porta
                    gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p>
                    <a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a>
                </p>

            </b-carousel-slide>

            <b-carousel-slide img-blank img-alt="Blank image">

                <div class="text-right">
                    <h1>One more for good measure.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                        porta
                        gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>

            </b-carousel-slide>

        </b-carousel>

    </div>

</template>

<script>
    export default {
        name: "TheHomePageCarousel",
        data() {
            return {
                slide: 0,
            }
        },
    }
</script>

<style scoped>

    .carousel {
        margin-bottom: 4rem;
    }

</style>

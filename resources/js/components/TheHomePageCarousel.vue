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
            <b-carousel-slide
                img-alt="group of people huddling"
                img-src="https://source.unsplash.com/lbLgFFlADrY/1024x480"
            >

                <div class="text-left">
                    <h1>Example headline.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                        porta
                        gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>

                    <div class="btn-list">
                        <a class="btn btn-outline-light" href="/register" role="button">Register</a>
                        <a class="btn btn-outline-primary" href="/login" role="button">Login</a>
                    </div>

                </div>

            </b-carousel-slide>

            <b-carousel-slide
                img-alt="happy children doing peace hand sign"
                img-src="https://source.unsplash.com/AEaTUnvneik/1024X480"
            >
                <h1>Another example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                    porta
                    gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p>
                    <a class="btn btn-primary" href="#" role="button">Learn more</a>
                </p>

            </b-carousel-slide>

            <b-carousel-slide
                img-alt="volunteer wearing a red shirt"
                img-src="https://source.unsplash.com/7uSrOyY1U0I/1024x480"
            >
                <div class="text-right">
                    <h1>One more for good measure.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi
                        porta
                        gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-primary" href="#" role="button">Browse Opportunities</a></p>
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

<style>

    /* Carousel base class */
    .carousel {
        margin-bottom: 4rem;
    }

    /* Since positioning the image, we need to help out the caption */
    .carousel-caption {
        bottom: 3rem;
        z-index: 10;
    }

    /* Declare heights because of positioning of img element */
    .carousel-item {
        height: 32rem;
    }

    .carousel-item > img {
        position: absolute;
        top: 0;
        left: 0;
        min-width: 100%;
        height: 32rem;
    }

</style>

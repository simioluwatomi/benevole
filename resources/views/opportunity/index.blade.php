<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Probably the most complete UI kit out there. Multiple functionalities and controls added,  extended color palette and beautiful typography, designed as its own extended version of Bootstrap at  the highest level of quality.                             ">
    <meta name="author" content="Webpixels">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800|Roboto:400,500,700" rel="stylesheet">

    <!-- Theme CSS -->
    <link type="text/css" href="{{ mix('css/index.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ mix('css/boomerang.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-lg navbar-transparent navbar-dark bg-dark py-4">
        <div class="container">
            <a class="navbar-brand" href="../"><strong>{{ config('app.name', 'Laravel') }}</strong></a>
            <button class="navbar-toggler" type="button" data-action="offcanvas-open" data-target="#navbar_main"
                    aria-controls="navbar_main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse offcanvas-collapse" id="navbar_main">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <h6 class="dropdown-header font-weight-600 d-lg-none px-0">Menu</h6>
                    <li class="nav-item ">
                        <a class="nav-link" href="../index.html">Overview</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbar_main_dropdown_1" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                        <div class="dropdown-menu" aria-labelledby="navbar_1_dropdown_1">
                            <a class="dropdown-item" href="../pages/homepage.html">Homepage</a>
                            <a class="dropdown-item" href="../pages/about.html">About us</a>
                            <a class="dropdown-item" href="../pages/sign-in.html">Sign in</a>
                            <a class="dropdown-item" href="../pages/contact.html">Contact</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../docs/introduction.html">Docs</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/webpixels/boomerang-ui-kit/archive/master.zip" target="_blank"
                           class="nav-link d-lg-none">Download Free</a>
                        <a href="https://github.com/webpixels/boomerang-ui-kit/archive/master.zip" target="_blank"
                           class="btn btn-sm bg-white d-none d-lg-inline-flex">Download Free</a>
                    </li>
                    <div class="dropdown-divider d-lg-none my-4"></div>
                    <h6 class="dropdown-header font-weight-600 d-lg-none px-0">Social Media</h6>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://instagram.com/webpixelsofficial/"
                           target="_blank"><i
                                class="fab fa-instagram"></i><span class="ml-2 d-lg-none">Instagram</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://web.facebook.com/webpixels" target="_blank"><i
                                class="fab fa-facebook"></i><span class="ml-2 d-lg-none">Facebook</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://dribbble.com/webpixels" target="_blank"><i
                                class="fab fa-dribbble"></i><span class="ml-2 d-lg-none">Dribbble</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="https://github.com/webpixels" target="_blank"><i
                                class="fab fa-github"></i><span class="ml-2 d-lg-none">Github</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="main">
        @if (session('status'))
            <notification-component type="{{ session('type') }}"
                                    title="{{ session('title') }}"
                                    body="{{ session('body') }}"
            >
            </notification-component>
        @endif
        <section class="spotlight parallax bg-cover bg-size--cover" data-spotlight="fullscreen"
                 style="background-image: url({{ asset('images/backgrounds/img-3.jpg') }} )">
            <span class="mask bg-tertiary alpha-7"></span>
            <div class="spotlight-holder py-lg pt-lg-xl">
                <div class="container d-flex align-items-center no-padding">
                    <div class="col">
                        <div
                            class="row cols-xs-space align-items-center text-center text-md-left justify-content-center">
                            <div class="col-lg-7">
                                <div class="text-center mt-5">
                                    <h1 class="heading h1 text-white">
                                        Hi, nice to meet you!
                                    </h1>
                                    <p class="lead lh-180 text-white mt-3">
                                        We put all the experience and know-how in Boomerang so we can offer you the best
                                        product we have ever built.
                                    </p>
                                    <div class="mt-5">
                                        <a href="#" class="btn btn-primary mr-3">Our services</a>
                                        <a href="#" class="btn btn-secondary">Meet the team</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice-lg">
            <div class="container">
                <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space">
                    <div class="col-lg-6 order-lg-2 ml-lg-auto">
                        <div class="block block-image">
                            <img src="{{ asset('images/prv/device-1.png') }}" class="img-fluid img-center">
                        </div>
                    </div>
                    <div class="col-lg-5 order-lg-1">
                        <div class="row-wrapper">
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex align-items-start">
                                        <div class="icon icon-lg">
                                            <i class="fab fa-twitter"></i>
                                        </div>
                                        <div class="icon-text">
                                            <h3 class="heading h4">Latest Bootstrap framework</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex align-items-start">
                                        <div class="icon icon-lg">
                                            <i class="fab fa-sass"></i>
                                        </div>
                                        <div class="icon-text">
                                            <h3 class="heading h4">Built with Sass <small>(included)</small></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="d-flex align-items-start">
                                        <div class="icon icon-lg">
                                            <i class="fas fa-tint"></i>
                                        </div>
                                        <div class="icon-text">
                                            <h3 class="heading h4">Extended color palette</h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid px-0">
                <div class="card-group flex-column flex-md-row">
                    <div class="card bg-primary text-white px-4 px-lg-5 py-5 rounded-0 border-0 mb-0">
                        <div class="card-body">
                            <h1 class="heading h2 text-white">Theme as framework</h1>
                            <p class="mt-4">
                                Boomerang was designed as its own extended version of Bootstrap, built for offering a
                                complete solution for various industries — business, real estate, travel and much more.
                            </p>
                            <a href="#" class="btn btn-secondary mt-4">Learn more</a>
                        </div>
                    </div>
                    <div class="card bg-secondary px-4 px-lg-5 py-5 rounded-0 border-0 mb-0">
                        <div class="card-body">
                            <h1 class="heading h2">Even more components</h1>
                            <p class="mt-4">
                                We know how much you love Bootstrap components. That's why we've customized, and also,
                                introduced dozens of completely new utilities, components and plugins.
                            </p>
                            <a href="#" class="btn btn-primary mt-4">Learn more</a>
                        </div>
                    </div>
                    <div class="card bg-tertiary text-white px-4 px-lg-5 py-5 rounded-0 border-0 mb-0">
                        <div class="card-body">
                            <h1 class="heading h2 text-white">Tons of variables</h1>
                            <p class="mt-4">
                                Theme components inherit much of their style from variables, exactly like Bootstrap.
                                Change
                                a few values and the theme adapts. Customization has never been easier.
                            </p>
                            <a href="#" class="btn btn-secondary mt-4">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="mb-5 text-center">
                    <h3 class="heading h2">Explore more features by selecting a plan</h3>
                    <div class="fluid-paragraph text-center">
                        <p class="lead mb-0">Choose the best solution for your business.</p>
                    </div>
                </div>
                <div class="text-center mb-5">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary active">Monthly billing</button>
                        <button type="button" class="btn btn-secondary">Yearly billing</button>
                    </div>
                </div>
                <div class="card-deck mb-3">
                    <div class="card card-pricing text-center px-3 mb-4">
                        <div class="card-header py-4">
                            <h4 class="mb-4">Free</h4>
                            <h1 class="display-4 text-primary text-center">$0</h1>
                            <span class="h6 text-muted">per month</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-4">
                                <li>Up to 5 users</li>
                                <li>Basic support on Github</li>
                                <li>Monthly updates</li>
                                <li>Free cancelation</li>
                            </ul>
                            <button type="button" class="btn btn-primary mb-3">Start free trial</button>
                        </div>
                    </div>
                    <div class="card card-pricing popular text-center px-3 mb-4 z-depth-3">
                        <div class="card-header py-4">
                            <h4 class="mb-4">Multiple Use</h4>
                            <h1 class="display-4 text-primary text-center">$49</h1>
                            <span class="h6 text-muted">per month</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-4">
                                <li>Up to 15 users</li>
                                <li>Premium email support</li>
                                <li>Weekly updates</li>
                                <li>Free cancelation</li>
                            </ul>
                            <button type="button" class="btn btn-primary mb-3">Start free trial</button>
                        </div>
                    </div>
                    <div class="card card-pricing text-center px-3 mb-4">
                        <div class="card-header py-4">
                            <h4 class="mb-4">Extended Use</h4>
                            <h1 class="display-4 text-primary text-center">$199</h1>
                            <span class="h6 text-muted">per month</span>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-4">
                                <li>Unlimited users</li>
                                <li>One on one support</li>
                                <li>Weekly updates</li>
                                <li>Free cancelation</li>
                            </ul>
                            <button type="button" class="btn btn-primary mb-3">Start free trial</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice sct-color-1">
            <div class="container">
                <div class="row cols-xs-space cols-sm-space align-items-center">
                    <div class="col-md-6">
                        <img src="{{ asset('images/prv/img-1-1000x900.jpg') }}"
                             class="img-center img-fluid rounded z-depth-3">
                    </div>
                    <div class="col-md-6 col-lg-5 ml-lg-auto">
                        <div class="pr-md-4">
                            <h3 class="heading heading-3 strong-500">
                                Start building now a beautiful website.
                            </h3>
                            <p class="lead text-gray mt-4">Take up one idea. Let the brain, muscles, nerves, every part
                                of
                                your body, be full of that idea, and just leave every other idea alone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice bg-primary">
            <div class="container">
                <div class="row align-items-center cols-xs-space cols-sm-space cols-md-space text-center text-lg-left">
                    <div class="col-lg-7">
                        <h1 class="heading h2 text-white strong-500">
                            Need more information about Boomerang UI Kit?
                        </h1>
                        <p class="lead text-white mb-0">Take up one idea. Let the brain, muscles, nerves, every part of
                            your
                            body, be full of that idea, and just leave every other idea alone.</p>
                    </div>
                    <div class="col-lg-3 ml-lg-auto">
                        <div class="text-center text-md-right">
                            <a href="#" class="btn bg-secondary">
                                Contact us
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slice slice-lg">
            <div class="container">
                <div class="mb-5 text-center">
                    <h3 class="heading h2">Stay tuned with our company news</h3>
                    <div class="fluid-paragraph text-center">
                        <p class="lead mb-0">Daily insights from our company</p>
                    </div>
                </div>
                <div class="row cols-md-space cols-sm-space cols-xs-space">
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <img src="{{ asset('images/prv/img-1-800x600.jpg') }}"
                                 class="img-fluid img-center rounded z-depth-2">
                            <div class="pt-4">
                                <span class="text-muted">Oct 15, 2018</span>
                                <a href="#" class="heading h4 d-block mt-1">Listen to the nature</a>
                                <p class="mt-3">
                                    When we strive to become better than we are, everything around us becomes better,
                                    too.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <img src="{{ asset('images/prv/img-2-800x600.jpg') }}"
                                 class="img-fluid img-center rounded z-depth-2">
                            <div class="pt-4">
                                <span class="text-muted">Oct 15, 2018</span>
                                <a href="#" class="heading h4 d-block mt-1">Listen to the nature</a>
                                <p class="mt-3">
                                    When we strive to become better than we are, everything around us becomes better,
                                    too.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card border-0">
                            <img src="{{ asset('images/prv/img-3-800x600.jpg') }}"
                                 class="img-fluid img-center rounded z-depth-2">
                            <div class="pt-4">
                                <span class="text-muted">Oct 15, 2018</span>
                                <a href="#" class="heading h4 d-block mt-1">Listen to the nature</a>
                                <p class="mt-3">
                                    When we strive to become better than we are, everything around us becomes better,
                                    too.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="#" class="text-uppercase">
                        All posts
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    </main>
</div>
<footer class="pt-5 pb-3 footer  footer-dark bg-tertiary">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="pr-lg-5">
                    <h1 class="heading h6 text-uppercase font-weight-700 mb-3"><strong>Boomerang</strong> UI Kit</h1>
                    <p>Boomerang is a high quality UI Kit built on top of the well known Bootstrap 4 Framework. This
                        theme was designed as its own extended version of Bootstrap with multiple functionalities and
                        controls added, extended color palette and beautiful typography.</p>
                </div>
            </div>
            <div class="col-6 col-md">
                <h5 class="heading h6 text-uppercase font-weight-700 mb-3">Features</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Cool stuff</a></li>
                    <li><a class="text-muted" href="#">Random feature</a></li>
                    <li><a class="text-muted" href="#">Team feature</a></li>
                    <li><a class="text-muted" href="#">Stuff for developers</a></li>
                    <li><a class="text-muted" href="#">Another one</a></li>
                    <li><a class="text-muted" href="#">Last time</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5 class="heading h6 text-uppercase font-weight-700 mb-3">Solutions</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Resource</a></li>
                    <li><a class="text-muted" href="#">Resource name</a></li>
                    <li><a class="text-muted" href="#">Another resource</a></li>
                    <li><a class="text-muted" href="#">Final resource</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5 class="heading h6 text-uppercase font-weight-700 mb-3">Resources</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Business</a></li>
                    <li><a class="text-muted" href="#">Education</a></li>
                    <li><a class="text-muted" href="#">Government</a></li>
                    <li><a class="text-muted" href="#">Gaming</a></li>
                </ul>
            </div>
            <div class="col-6 col-md">
                <h5 class="heading h6 text-uppercase font-weight-700 mb-3">About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">Team</a></li>
                    <li><a class="text-muted" href="#">Locations</a></li>
                    <li><a class="text-muted" href="#">Privacy</a></li>
                    <li><a class="text-muted" href="#">Terms</a></li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="d-flex align-items-center">
        <span class="">
          &copy; 2018 <a href="https://webpixels.io/" class="footer-link" target="_blank">Webpixels</a>. All rights reserved.
        </span>
            <ul class="nav ml-lg-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="https://instagram.com/webpixelsofficial" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://facebook.com/webpixels" target="_blank"><i
                            class="fab fa-facebook"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://github.com/webpixels" target="_blank"><i
                            class="fab fa-github"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://dribbble.com/webpixels" target="_blank"><i
                            class="fab fa-dribbble"></i></a>
                </li>
            </ul>
        </div>
    </div>
</footer>

<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>

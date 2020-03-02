@extends('master')

@section('content')

    @if (session('message'))
        <notification-component
            type="{{ session('message.type') }}"
            body="{{ session('message.body') }}"
            :timeout="5000"
        >
        </notification-component>
    @endif

    <div class="page-title-box">

        <div class="row align-items-center">

            <div class="col-auto">

                <h2 class="page-title">
                    Profile
                </h2>

            </div>

            @can('update', $user)

                <div class="col-auto ml-auto">

                    <div class="d-flex">

                        <b-dropdown id="actions-dropdown" text="Actions" variant="outline-primary" no-flip drop>

                            <b-dropdown-item href="#">

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon">
                                    <path
                                        d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                    <circle cx="12" cy="13" r="4"></circle>
                                </svg>

                                Change Photo

                            </b-dropdown-item>

                            <b-dropdown-item v-b-modal.edit-profile-modal>

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                     stroke-linejoin="round" class="icon">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>

                                Edit Profile

                            </b-dropdown-item>

                            @can('updatePassword', \App\Models\User::class)

                                <b-dropdown-item v-b-modal.update-password-modal>

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="icon">
                                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                    </svg>

                                    Update Password

                                </b-dropdown-item>

                            @endcan

                        </b-dropdown>

                    </div>

                </div>

            @endcan

        </div>

    </div>

    <div class="row">

        <div class="col-lg-4">

            <b-card class="shadow-sm" no-body>

                <b-card-body body-class="text-center">

                    <img src="https://source.unsplash.com/collection/1112424/200x200"
                         class="rounded-circle border-wide mx-auto d-block mb-2"
                         width="180"
                         alt="user-profile-photo">

                    <h3>{{ $user->profile->full_name ?? 'Not Available' }} </h3>

                    <ul class="mt-2">

                        <li class="list-unstyled mb-1">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon text-muted">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                            </svg>

                            4.5 Stars
                        </li>

                        <li class="list-unstyled mb-1">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon text-muted">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>

                            35 Completed Opportunities
                        </li>

                        <li class="list-unstyled mb-1">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon text-muted">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>

                            Joined {{ $user->created_at->format('F Y') }}
                        </li>

                        <li class="list-unstyled mb-1">

                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                 stroke-linejoin="round" class="icon text-muted">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>

                            {{ optional($user->profile)->country ?? 'Not Available' }}

                        </li>

                    </ul>


                    <p class="mb-3">

                        {{ optional($user->profile)->bio ?? '' }}

                    </p>

                    <ul class="social-links list-inline mb-0 mt-2">

                        @isset($user->profile->linkedin_username)

                            <li class="list-inline-item">

                                <b-link href="{{ $user->profile->linked_in_profile }}" target="_blank"
                                        v-b-tooltip.hover title="LinkedIn Profile">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="icon">
                                        <path
                                            d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                        <rect x="2" y="9" width="4" height="12"></rect>
                                        <circle cx="4" cy="4" r="2"></circle>
                                    </svg>

                                </b-link>

                            </li>

                        @endisset

                        @isset($user->profile->twitter_username)

                            <li class="list-inline-item">

                                <b-link href="{{ $user->profile->twitter_profile }}" target="_blank"
                                        v-b-tooltip.hover title="Twitter Profile">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                         viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="icon">
                                        <path
                                            d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                    </svg>

                                </b-link>

                            </li>

                        @endisset

                    </ul>

                </b-card-body>

            </b-card>

        </div>

        <div class="col-lg-8">

            <ul class="nav nav-tabs">

                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        Active
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        Completed
                    </a>
                </li>

                @can('update', $user)

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Saved
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Withdrawn
                        </a>
                    </li>

                @endcan

            </ul>

            <div class="card mt-4">

                <ul class="list-group card-list-group">

                    <li class="list-group-item py-4">
                        <div class="row row-sm align-items-center">
                            <div class="col">
                                <h3 class="mb-2">
                                    <a data-toggle="collapse" href="#collapseFour" role="button"
                                       aria-expanded="false" aria-controls="collapseFour">Write blog articles about
                                        volunteerism and development</a>
                                </h3>
                                <div class="text-muted text-h5">Partnership for Volunteer Management</div>
                            </div>
                            <div class="col-auto lh-1 align-self-start">
                                <span class="badge bg-danger">withdrawn</span>
                            </div>
                            <p class="card-text mt-3 collapse col-auto"
                               id="collapseFour">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequuntur
                                cupiditate illum neque, rem rerum vel! Commodi cupiditate doloremque error eum
                                eveniet ipsum nisi numquam optio quisquam recusandae, sit voluptatum!
                                Atque esse exercitationem hic in nemo, nisi reiciendis temporibus. Assumenda
                                enim
                                et illum magnam nobis officia praesentium tenetur ullam vitae! Ad consequuntur
                                ea,
                                excepturi id ipsam nulla quidem repellendus velit.
                                Ad aliquid consectetur, consequatur earum labore modi mollitia nihil quas!
                                Assumenda consequuntur corporis fugiat non omnis recusandae, soluta. Aspernatur
                                consectetur consequuntur dolorum ducimus fugiat officia provident quasi
                                recusandae,
                                rerum ut!
                            </p>
                        </div>
                    </li>

                    <li class="list-group-item py-4">
                        <div class="row row-sm align-items-center">
                            <div class="col">
                                <h3 class="mb-2">
                                    <a data-toggle="collapse" href="#collapseOne" role="button"
                                       aria-expanded="false" aria-controls="collapseOne">Write blog articles about
                                        volunteerism and development</a>
                                </h3>
                                <div class="text-muted text-h5">Partnership for Volunteer Management</div>

                            </div>
                            <div class="col-auto lh-1 align-self-start">
                                <span class="badge bg-blue">saved</span>
                            </div>
                            <p class="card-text mt-3 collapse col-auto"
                               id="collapseOne">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequuntur
                                cupiditate illum neque, rem rerum vel! Commodi cupiditate doloremque error eum
                                eveniet ipsum nisi numquam optio quisquam recusandae, sit voluptatum!
                                Atque esse exercitationem hic in nemo, nisi reiciendis temporibus. Assumenda
                                enim
                                et illum magnam nobis officia praesentium tenetur ullam vitae! Ad consequuntur
                                ea,
                                excepturi id ipsam nulla quidem repellendus velit.
                                Ad aliquid consectetur, consequatur earum labore modi mollitia nihil quas!
                                Assumenda consequuntur corporis fugiat non omnis recusandae, soluta. Aspernatur
                                consectetur consequuntur dolorum ducimus fugiat officia provident quasi
                                recusandae,
                                rerum ut!
                            </p>

                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col-auto">
                                <div class="btn-list">
                                    <a href="#" class="btn btn-secondary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="icon icon-md mr-2">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path
                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Remove
                                    </a>
                                    <a href="#" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="icon icon-md mr-2">
                                            <line x1="22" y1="2" x2="11" y2="13"></line>
                                            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                                        </svg>
                                        Apply
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item py-4">
                        <div class="row row-sm align-items-center">
                            <div class="col">
                                <h3 class="mb-2">
                                    <a data-toggle="collapse" href="#collapseTwo" role="button"
                                       aria-expanded="false" aria-controls="collapseTwo">Write blog articles about
                                        volunteerism and development</a>
                                </h3>
                                <div class="text-muted text-h5">Partnership for Volunteer Management</div>

                            </div>
                            <div class="col-auto lh-1 align-self-start">
                                <span class="badge bg-yellow">active</span>
                            </div>
                            <p class="card-text mt-3 collapse col-auto"
                               id="collapseTwo"
                            >
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab consequuntur
                                cupiditate illum neque, rem rerum vel! Commodi cupiditate doloremque error eum
                                eveniet ipsum nisi numquam optio quisquam recusandae, sit voluptatum!
                                Atque esse exercitationem hic in nemo, nisi reiciendis temporibus. Assumenda
                                enim
                                et illum magnam nobis officia praesentium tenetur ullam vitae! Ad consequuntur
                                ea,
                                excepturi id ipsam nulla quidem repellendus velit.
                                Ad aliquid consectetur, consequatur earum labore modi mollitia nihil quas!
                                Assumenda consequuntur corporis fugiat non omnis recusandae, soluta. Aspernatur
                                consectetur consequuntur dolorum ducimus fugiat officia provident quasi
                                recusandae,
                                rerum ut!
                            </p>

                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div>
                                    <div class="d-flex mb-1 align-items-center lh-1">
                                        <div class="text-h5 font-weight-bolder m-0">Progress</div>
                                        <span class="ml-auto text-h6 strong">65%</span>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" style="width: 65%" role="progressbar"
                                             aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">65% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="list-group-item py-4">
                        <div class="row row-sm align-items-center">
                            <div class="col">
                                <h3 class="mb-2">
                                    <a data-toggle="collapse" href="#collapseThree" role="button"
                                       aria-expanded="false" aria-controls="collapseThree">Write blog articles about
                                        volunteerism and development</a>
                                </h3>
                                <div class="text-muted text-h5">Partnership for Volunteer Management</div>


                            </div>
                            <div class="col-auto lh-1 align-self-start">
                                <span class="badge bg-success">completed</span>
                            </div>
                            <p class="card-text mt-3 collapse col-auto"
                               id="collapseThree"
                            >
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto asperiores
                                autem
                                consectetur consequuntur deleniti dolores eius, expedita facere modi nobis
                                perferendis
                                porro quasi quos, soluta tenetur totam voluptate voluptatem. Id!
                            </p>
                        </div>
                        <div class="row align-items-center mt-4">
                            <div class="col">
                                <div>
                                    <div class="d-flex mb-1 align-items-center lh-1">
                                        <div class="text-h5 font-weight-bolder m-0">Progress</div>
                                        <span class="ml-auto text-h6 strong">100%</span>
                                    </div>
                                    <div class="progress progress-sm">
                                        <div class="progress-bar bg-green" style="width: 100%" role="progressbar"
                                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            <span class="sr-only">Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="btn-list">
                                    <a href="#" class="btn btn-secondary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round" class="icon icon-md mr-2">
                                            <polygon
                                                points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                        Rate
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>

        </div>

    </div>

@endsection

@can('update', $user)

    @push('modal')

        @include('partials.modals.edit-user-profile')

        @can('updatePassword', \App\Models\User::class)

            @include('partials.modals.update-password')

        @endcan

    @endpush

@endcan

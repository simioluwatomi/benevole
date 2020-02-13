<div class="col-sm-4 py-2">

    <div class="card h-100">

        <div class="card-status bg-blue"></div>

        <div class="card-header">

            <a href="#" class="text-uppercase text-decoration-none">
                {{ $opportunity->category->title }}
            </a>

        </div>

        <div class="card-body">

            <h4 class="card-title leading-loose">
                <a href="{{ route('opportunity.show', ['user' => $opportunity->owner, 'volunteerOpportunity' => $opportunity]) }}">
                    {{ $opportunity->title }}
                </a>
            </h4>

            <h4 class="text-muted-dark mb-4">
                {{ $opportunity->owner->username }}
            </h4>

            <p class="card-text lead font-weight-normal">
                <i class="fe fe-watch px-1 text-primary"></i>
                {{ $opportunity->duration }} months
            </p>

            <button href="#" class="btn btn-primary float-right">Apply Now</button>

        </div>

        <div class="card-footer text-muted d-flex justify-content-between">

            <div class="col-xs-6">
                <i class="fe fe-activity px-1"></i>
                {{ $opportunity->min_hours_per_week }} - {{ $opportunity->max_hours_per_week }} hours per week
            </div>

            <div class="col-xs-6">
                <i class="fe fe-clock px-1"></i>
                {{ $opportunity->created_at->diffForHumans() }}
            </div>

        </div>

    </div>

</div>

<div class="col-md-3 py-2">

    <div class="card h-100">

        <div class="card-status bg-green"></div>


        <div class="card-body">

            <div class="text-center">

                <h4 class="text-uppercase mb-5">
                    <a href="{{ route('category.show', $category) }}" class="stretched-link">
                        {{ $category->title }}
                    </a>
                </h4>

                <span class="h2 mb-0">
                    {{ $category->opportunities_count }}
                </span>

            </div>
        </div>

    </div>

</div>

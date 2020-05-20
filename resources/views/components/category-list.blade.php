<div class="bg-white border shadow p-4 mb-4">
    <h1>Category list</h1>
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-lg-6 mb-4">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title">{{ $category->title }}</h4>
                  <p class="card-text">{{ $category->description }}</p>
                  <div class="text-right">
                        @if($category->isAlreadyLearned(Auth::id()))
                            <a href="#" class="btn btn-block btn-light">Already learned</a>
                        @else
                            <a href="#" class="btn btn-block btn-primary">Start</a>
                        @endif
                  </div>
                </div>
              </div>              
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $categories->links() }}
    </div>
</div>

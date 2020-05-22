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
                        @if($category->howManyRemainingWords(Auth::id()) == 0)
                            <a href="{{ route('lesson.result', ['lesson' => $category->lessons->where('user_id', Auth::id())->first()->id]) }}" class="btn btn-block btn-light">
                                Show result
                            </a>
                        @else
                            <a href="{{ route('lesson.start', ['category' => $category->id]) }}" class="btn btn-block btn-primary">
                                Start<br>({{ $category->howManyRemainingWords(Auth::id()) }} words left)
                            </a>
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

<div class="row mt-4">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <h2>{{ $answersCount . " " . str_plural('Answer', $answersCount) }}</h2>
        </div>
        <hr>
        @include('layouts._messages')
        
        @foreach ($answers as $answer)
            <div class="media">
              <div class="d-flex flex-column vote-controls">
                <a href="" title="This answer is useful" class="vote-up">
                  <i class="fas fa-caret-up fa-3x"></i>
                </a>
                <span class="votes-count">1230</span>
                <a href="" title="This answer is not useful" class="vote-down off">
                  <i class="fas fa-caret-down fa-3x"></i>
                </a>

               

              </div>
              <div class="media-body">
                {!! $answer->body_html !!}
                <div class="row">
                  <div class="col-4">
                    <div class="ml-auto">
                      @can('update', $answer)
                        <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                      @endcan

                      @can('delete', $answer)
                        <form class="form-delete" method="post" action="{{ route('questions.answers.destroy', [$question->id, $answer->id]) }}">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                      @endcan
                    </div>
                  </div>
                  <div class="col-4"></div>
                  <div class="col-4">
                    @include('shared._author', [
                      'model' => $answer,
                      'label' => 'answered'
                    ])
                  </div>
                </div>

                
              </div>
            </div>
            <hr>
        @endforeach
      </div>
    </div>
  </div>
</div>

@if ($model instanceof App\Models\Question)
  @php
    $name = 'question';
    $firstURISegment = 'question';   
  @endphp
@elseif ($model  instanceof App\Models\Answer)
  @php
    $name = 'answer';
    $firstURISegment = 'answers';   
  @endphp
@endif

@php
  $formId = $name . "-" . $model->id;
@endphp


<div class="d-flex flex-column vote-controls">
  <a href="" title="This {{ $name }} is useful" 
    class="vote-up {{ Auth::guest() ? 'off' : ''}}"
    onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();"
    >
    <i class="fas fa-caret-up fa-3x"></i>
  </a>
  <form id="up-vote-{{ $formId }}" action="/{{ $firstURISegment }}/{{ $model->id }}/vote"
    method="POST" style="display:none;" 
    >
    @csrf
    <input type="hidden" name="vote" value="1">
  </form>
  <span class="votes-count">{{ $model->votes_count }}</span>
  <a href="" title="This {{ $name }} is not useful" 
    class="vote-down {{ Auth::guest() ? 'off' : ''}}"
    onclick="event.preventDefault(); document.getElementById('down-vote-{{ $name }}-{{ $model->id }}').submit();"
    >
    <i class="fas fa-caret-down fa-3x"></i>
  </a>
  <form id="down-vote-{{ $name }}-{{ $model->id }}" action="/{{ $firstURISegment }}/{{ $model->id }}/vote"
    method="POST" style="display:none;" 
    >
    @csrf
    <input type="hidden" name="vote" value="-1">
  </form>
  
    @if ($model instanceof App\Models\Question)
      @include ('shared._favorite', [
        'model' => $model
      ])
    @elseif ($model instanceof App\Models\Answer)
      @include ('shared._accept', [
        'model' => $model
      ])
    @endif
</div>
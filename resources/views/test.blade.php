@foreach($questions as $question)
    <h3>quest: {{ $question->question_name }}</h3>
    <h3>chapter: {{ $question->chapter_id }}</h3>
    
    <h3>id: {{ $question }}</h3>
{{ $questions->count() }}
@endforeach
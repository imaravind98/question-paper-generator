<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{public_path('assets/css/vuetify.min.css')}}">
  </head>
  <body class="ma-5">
    @foreach ($data as $item)
      @php
        $filteredQuestions = array_filter($questions, function($question) use ($item){
          return $question['type'] == $item['questionType'];
        });
      @endphp
      <div>
        <div class="mb-2">
          <p class="text-subtitle-1 float-left"><span>{{ $loop->iteration }}. </span>{{ $item['heading'] }}</p>
          <p class="ms-auto float-right">Marks: {{ $item['marks'] }}</p>
          <div style="clear:both"></div>
        </div>
        <ol type="A" class="ml-8">
          @foreach($filteredQuestions as $question)
            @if ($question['type'] == 'one_word' | $question['type'] == 'short_answer' | $question['type'] == 'detail')
              <li>
                {{ $question['question'] }}
              </li>
            @endif
          @endforeach
        </ol>
      </div>
    @endforeach
  </body>
</html>
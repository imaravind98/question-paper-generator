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
        $filteredQuestions = array_values($filteredQuestions);
        
        if($item['questionType'] == 'match' && count($filteredQuestions)){
          $filteredQuestions = $filteredQuestions[0];
        }
      @endphp
      <div>
        <div class="mb-1 border-b">
          @if($item['questionType'] != 'match')
            <p class="text-subtitle-1 float-left"><span>{{ $loop->iteration }}. </span>{{ $item['heading'] }}</p>
          @else
            <p class="text-subtitle-1 float-left"><span>{{ $loop->iteration }}. </span>{{ $filteredQuestions['question'] }}</p>
          @endif
          <p class="text-subtitle-1 ms-auto float-right">Marks: {{ $item['marks'] }}</p>
          <div style="clear:both"></div>
        </div>
        @if($item['questionType'] != 'match')
          <ol type="A" class="ml-8 mb-2 text-subtitle-2 font-weight-regular">
            @foreach($filteredQuestions as $question)
              @if ($question['type'] == 'one_word' | $question['type'] == 'short_answer' | $question['type'] == 'detail')
                <li>
                  {{ $question['question'] }}
                </li>
              @elseif ($question['type'] == 'true_or_false')
                <li>
                  {{ $question['question'] }} (  )
                </li>
              @elseif ($question['type'] == 'choose')
                <li>
                  <p>{{ $question['question'] }}</p>
                  <table class="w-50">
                    <tr>
                      <td class="w-50">A. {{ $question['option'][0]['value'] }}</td>
                      <td class="w-50">B. {{ $question['option'][1]['value'] }}</td>
                    </tr>
                    <tr>
                      <td class="w-50">C. {{ $question['option'][2]['value'] }}</td>
                      <td class="w-50">D. {{ $question['option'][3]['value'] }}</td>
                    </tr>
                  </table>
                </li>
              @endif
            @endforeach
          </ol>
        @else
          <table class="ml-8 mb-2 w-50 text-subtitle-2 font-weight-regular">
            @foreach($filteredQuestions['option'] as $option)
              <tr>
                <td class="w-50">{{ $option['column_1'] }}</td>
                <td class="w-50">{{ $option['column_2'] }}</td>
              </tr>
            @endforeach
          </table>
        @endif
      </div>
    @endforeach
  </body>
</html>
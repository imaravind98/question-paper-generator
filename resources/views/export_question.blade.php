<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="{{public_path('assets/css/vuetify.min.css')}}">
  </head>
  <body class="ma-5">
    <header class="mb-5">
      <table class="w-100">
        <tr>
          <td style="border: 1px solid black; vertical-align: top;width:80px">
            <img src="{{public_path('assets/logo.png')}}" alt="" width="100">
          </td>
          <td style="border: 1px solid black;vertical-align: top"> 
            <h2 class="text-center">Shashwat Public</h2>
            <p class="text-center text-capitalize font-weight-bold">({{ $testName }})</p>
            <table class="w-100">
              <thead>
                <th style="border: 1px solid black;vertical-align: top" class="w-25">Class</th>
                <th style="border: 1px solid black;vertical-align: top" class="w-25">Subject</th>
                <th style="border: 1px solid black;vertical-align: top" class="w-25">Marks</th>
                <th style="border: 1px solid black;vertical-align: top" class="w-25">Duration(Mins)</th>
              </thead>
              <tr>
                <td style="border: 1px solid black;vertical-align: top" class="text-center">{{ $classes['name'] }}</td>
                <td style="border: 1px solid black;vertical-align: top" class="text-center">{{ $subject['name'] }}</td>
                <td style="border: 1px solid black;vertical-align: top" class="text-center">{{ $totalMark }}</td>
                <td style="border: 1px solid black;vertical-align: top" class="text-center">{{ $duration }}</td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <table class="w-100">
        <tr>
          <td style="border: 1px solid black" class="w-50 px-1">Name:</td>
          <td style="border: 1px solid black" class="w-50 px-1">Roll No:</td>
        </tr>
      </table>
    </header>
    @foreach ($data as $item)
      @php
        $filteredQuestions = array_filter($questions, function($question) use ($item){
            return $question['type'] == $item['questionType'];
          });
        $filteredQuestions = array_values($filteredQuestions);
        shuffle($filteredQuestions);
        array_splice($filteredQuestions, $item['no_of_questions']);
        
        if($item['questionType'] == 'match' && count($filteredQuestions)){
          $filteredQuestions = $filteredQuestions[0];
        }
        // dd($filteredQuestions);
      @endphp
      <div>
        <div class="mb-1 border-b">
          @if($item['questionType'] == 'match')
            <p class="text-subtitle-1 float-left" style="font: bold"><strong><span>{{ $loop->iteration }}. </span>{{ $filteredQuestions['question'] }}</strong></p>
          @elseif($item['questionType'] == 'image_question')
            <p class="text-subtitle-1 float-left" style="font: bold"><strong><span>{{ $loop->iteration }}. </span>{{ $filteredQuestions[0]['question'] }}</strong></p>
          @else
            <p class="text-subtitle-1 float-left" style="font: bold"><strong><span>{{ $loop->iteration }}. </span>{{ $item['heading'] }}</strong></p>
          @endif
          <p class="text-subtitle-1 ms-auto float-right"><strong>Marks: {{ $item['marks'] }}</strong></p>
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
              @elseif ($question['type'] == 'image_question')
                <img src="{{public_path('/storage/'.$question['option'])}}" alt="" width="400">
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
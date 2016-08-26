@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Quiz</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'quiz/answer', 'method' => 'POST']) !!}

                        @foreach($questions as $question)

                        <h3>{{ $question->body }}</h3>
                        @foreach($question->answers as $answer)
                        {{ Form::checkbox('answers['. $answer->id .']', $answer->id) }} {{ $answer->body }}
                        @endforeach

                        @endforeach

                        {!! Form::submit('Save me!') !!}
                        {!! Form::close() !!}

                        <hr>
                        <h4>Your answers:</h4>

                        @foreach(Auth::user()->answers as $answer)

                        <h3>{{ $answer->question->body }}</h3>
                        <p>{{ $answer->body }}</p>
                        <i>{{ $answer->users->where('id', '!=', Auth::user()->id)->count() }} person(s) think the same</i>

                        @endforeach

                        <hr>

                        <h4>All votes</h4>
                        <canvas id="myChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Nothing", "What what?", "Hello.", "That", "What that what?"],
            datasets: [{
                label: '# of Votes',
                data: [{{ $votes[1] }}, {{ $votes[2] }}, {{ $votes[3] }}, {{ $votes[4] }}, {{ $votes[5] }}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
@endsection
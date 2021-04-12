@extends('layouts.admin')

@section('page-heading')
Enter Scores for
@if ($team)
  Team {{ $team->name }} on
@endif {{ date('F d, Y', strtotime($week->week_date)) }}, Week {{ $week->week_order}}
@endsection

@section('content')
  @if (count($errors) > 0)
    @include('layouts.errors')
  @endif
      <div class="scores-table">
        <form method="POST" action="/admin/scorecard/{{ $week->id }}/edit" class="pure-form">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
          <table class="pure-table pure-table-bordered pure-table-striped">
        		<thead>
        			<tr>
        				<th>Player</th>
        				<th class="text-center">ABS</th>
                <th class="text-center">INJ</th>
                <th class="text-center">SUB</th>
        				<th class="text-center">1</th>
        				<th class="text-center">2</th>
        				<th class="text-center">3</th>
        				<th class="text-center">4</th>
        				<th class="text-center">5</th>
        				<th class="text-center">6</th>
        				<th class="text-center">7</th>
        				<th class="text-center">8</th>
        				<th class="text-center">9</th>
                <th class="text-center">Points</th>
        			</tr>
        		</thead>
            <tbody>
              @foreach ($scores as $score)
              @if (($loop->index + 1) % 4 == 0)
                <tr style="border-bottom: 4px solid #333;">
              @else
                <tr>
              @endif
                <td id="{{ $score->id }}"><input type="hidden" name="score[{{ $score->id }}][score_id]" value="{{ $score->id }}">{{ $score->player['user']['name'] }}</td>
          			<td class="text-center">
                    <input type="hidden" name="score[{{ $score->id }}][absent]"  value="{{ old('score.' . $score->id . '.absent') ?? $score->absent }}">
                    <input type="checkbox" name="score[{{ $score->id }}][absent]"
                    @if (old('$score->absent') == true || $score->absent == true)
                      checked
                    @endif
                  >
                </td>
                <td class="text-center">
                    <input type="hidden" name="score[{{ $score->id }}][injury]"  value="{{ old('score.' . $score->id . '.injury') ?? $score->injury }}">
                    <input type="checkbox" name="score[{{ $score->id }}][injury]"
                    @if (old('$score->injury') == true || $score->injury == true)
                      checked
                    @endif
                  >
                </td>
                <td class="text-center">
                    <input type="hidden" name="score[{{ $score->id }}][substitute]"  value="{{ old('score.' . $score->id . '.substitute') ?? $score->substitute }}">
                    <input type="checkbox" name="score[{{ $score->id }}][substitute]"
                    @if (old('$score->substitute') == true || $score->substitute == true)
                      checked
                    @endif
                  >
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_1]" class="form-control" value="{{ old('score.' . $score->id . '.hole_1') ?? $score->hole_1 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_2]" class="form-control" value="{{ old('score.' . $score->id . '.hole_2') ?? $score->hole_2 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_3]" class="form-control" value="{{ old('score.' . $score->id . '.hole_3') ?? $score->hole_3 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_4]" class="form-control" value="{{ old('score.' . $score->id . '.hole_4') ?? $score->hole_4 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_5]" class="form-control" value="{{ old('score.' . $score->id . '.hole_5') ?? $score->hole_5 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_6]" class="form-control" value="{{ old('score.' . $score->id . '.hole_6') ?? $score->hole_6 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_7]" class="form-control" value="{{ old('score.' . $score->id . '.hole_7') ?? $score->hole_7 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_8]" class="form-control" value="{{ old('score.' . $score->id . '.hole_8') ?? $score->hole_8 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][hole_9]" class="form-control" value="{{ old('score.' . $score->id . '.hole_9') ?? $score->hole_9 }}" size="2">
                </td>
                <td>
                  <input type="text"
                    name="score[{{ $score->id }}][points]" class="form-control" value="{{ old('score.' . $score->id . '.points') ?? $score->points }}" size="2">
                </td>
              </tr>
              @endforeach
              <tr>
                <td colspan="14" class="text-center"><button type="submit" class="pure-button pure-button-primary">Save Scores</button></td>
              </tr>
            </tbody>
          </table>



        </form>
      </div>
@endsection

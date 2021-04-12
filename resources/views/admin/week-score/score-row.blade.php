<tr data-controller="score-row" data-score-row-url="{{ route('admin.scores.update', ['score' => $score->id]) }}" data-target="score-row.container" class="{{ ($loop->index + 1) % 2 == 0  ? 'border-b-2 border-grey-900' : '' }}">
    <td class="border-t px-2 py-4 text-sm text-left">{{ last_name_clean($score->player_name) }}</td>
    <td class="border-t px-2 py-4 text-center"><input data-target="score-row.absent" data-action="score-row#absent" type="checkbox" name="absent" {{ $score->absent ? 'checked' : ''}}  tabindex="-1"></td>
    <td class="border-t px-2 py-4 text-center"><input data-target="score-row.weeklyWinner" type="checkbox" name="weekly_winner" {{ $score->weekly_winner ? 'checked' : ''}}  tabindex="-1"></td>
    <td class="border-t px-2 py-4 text-center"><input data-target="score-row.substitute" type="checkbox" name="substitute" {{ $score->substitute_id ? 'checked' : ''}}  tabindex="-1"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_1" data-target="score-row.scoreInput score-row.hole1" data-action="score-row#countGross" value="{{ number_format($score->hole_1, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_2" data-target="score-row.scoreInput score-row.hole2" data-action="score-row#countGross" value="{{ number_format($score->hole_2, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_3" data-target="score-row.scoreInput score-row.hole3" data-action="score-row#countGross" value="{{ number_format($score->hole_3, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_4" data-target="score-row.scoreInput score-row.hole4" data-action="score-row#countGross" value="{{ number_format($score->hole_4, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_5" data-target="score-row.scoreInput score-row.hole5" data-action="score-row#countGross" value="{{ number_format($score->hole_5, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_6" data-target="score-row.scoreInput score-row.hole6" data-action="score-row#countGross" value="{{ number_format($score->hole_6, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_7" data-target="score-row.scoreInput score-row.hole7" data-action="score-row#countGross" value="{{ number_format($score->hole_7, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_8" data-target="score-row.scoreInput score-row.hole8" data-action="score-row#countGross" value="{{ number_format($score->hole_8, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center"><input type="text" class="score-form-input w-8" name="hole_9" data-target="score-row.scoreInput score-row.hole9" data-action="score-row#countGross" value="{{ number_format($score->hole_9, 0) }}"></td>
    <td class="border-t px-2 py-4 text-center font-bold" data-target="score-row.gross">{{ number_format($score->gross, 0) }}</td>
    <td class="border-t px-2 py-4 text-center">
        <div class="relative">
            <select class="block appearance-none w-full bg-grey-100 border border-grey-300 text-grey-600 p-2 rounded" name="points" data-target="score-row.pointsInput" data-action="score-row#update blur->score-row#update">
                <option value=""></option>
                <option value="0" {{ $score->points == 0 ? 'selected' : ''}}>0</option>
                <option value="1" {{ $score->points == 1 ? 'selected' : ''}}>1</option>
                <option value="2" {{ $score->points == 2 ? 'selected' : ''}}>2</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-grey-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </td>
    <td class="border-t px-1 py-4 text-center">
        <input type="hidden" name="official" value=1 data-target="score-row.official">
        <button data-action="score-row#update" class="focus:outline-none text-grey-400 hover:text-green-500" data-target="score-row.save" tabindex="-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" class="fill-current h-6 w-6"><path d="M0 2C0 .9.9 0 2 0h14l4 4v14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm5 0v6h10V2H5zm6 1h3v4h-3V3z"/></svg>
        </button>
    </td>
</tr>

@include('_parts.flash')
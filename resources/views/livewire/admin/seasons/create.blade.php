<?php

use App\Models\Player;
use App\Models\Score;
use App\Models\Team;
use App\Models\User;
use App\Models\Week;
use App\Models\Year;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

new
#[Layout('components.layouts.admin')]
#[Title('New Season')]
class extends Component
{
    public int $step = 1;

    // Step 1: Year
    public string $yearName = '';

    public bool $yearActive = true;

    // Step 2: Teams
    public int $teamCount = 6;

    // Step 3: Weeks
    public int $weekCount = 20;

    public ?string $startDate = null;

    public ?string $skipDate = null;

    // Step 4: Previous Year
    public ?int $previousYearId = null;

    // Step 5: Players (one team at a time)
    public array $playerAssignments = [];

    public int $currentTeam = 1;

    // Step 7: Review
    public bool $generateScores = true;

    public function mount(): void
    {
        $this->yearName = (string) Carbon::now()->year;
        $this->startDate = Carbon::now()->next('Thursday')->format('Y-m-d');
        $this->initializePlayerAssignments();
    }

    public function initializePlayerAssignments(): void
    {
        $this->playerAssignments = [];
        for ($t = 1; $t <= $this->teamCount; $t++) {
            for ($p = 1; $p <= 4; $p++) {
                $this->playerAssignments[$t][$p] = [
                    'user_id' => '',
                    'handicap' => '',
                    'yellow_tees' => false,
                ];
            }
        }
    }

    public function nextStep(): void
    {
        $this->validateCurrentStep();

        if ($this->step === 5 && $this->currentTeam < $this->teamCount) {
            $this->currentTeam++;

            return;
        }

        if ($this->step === 5) {
            $this->currentTeam = 1;
            $this->populateHandicapsFromPreviousYear();
        }

        $this->step++;
    }

    public function previousStep(): void
    {
        if ($this->step === 5 && $this->currentTeam > 1) {
            $this->currentTeam--;

            return;
        }

        if ($this->step === 6) {
            $this->currentTeam = $this->teamCount;
        }

        if ($this->step === 7) {
            $this->step = 6;

            return;
        }

        $this->step--;
    }

    public function goToStep(int $step): void
    {
        if ($step < $this->step) {
            $this->step = $step;
            if ($step === 5) {
                $this->currentTeam = 1;
            }
        }
    }

    public function updatedTeamCount(): void
    {
        $this->initializePlayerAssignments();
        $this->currentTeam = 1;
    }

    protected function validateCurrentStep(): void
    {
        match ($this->step) {
            1 => $this->validate([
                'yearName' => 'required|string|unique:years,name',
            ]),
            2 => $this->validate([
                'teamCount' => 'required|integer|min:2|max:12',
            ]),
            3 => $this->validate([
                'weekCount' => 'required|integer|min:1|max:40',
                'startDate' => 'required|date',
                'skipDate' => 'nullable|date',
            ]),
            4 => $this->validate([
                'previousYearId' => 'nullable|exists:years,id',
            ]),
            5 => $this->validateTeamAssignments(),
            6 => $this->validateHandicaps(),
            default => null,
        };
    }

    protected function validateTeamAssignments(): void
    {
        $assignedUserIds = $this->getAssignedUserIdsExcludingTeam($this->currentTeam);

        for ($p = 1; $p <= 4; $p++) {
            $userId = $this->playerAssignments[$this->currentTeam][$p]['user_id'] ?? '';

            if (empty($userId)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    "playerAssignments.{$this->currentTeam}.{$p}.user_id" => "Player is required for Team {$this->currentTeam}, Position {$p}.",
                ]);
            }

            if (in_array($userId, $assignedUserIds)) {
                throw \Illuminate\Validation\ValidationException::withMessages([
                    "playerAssignments.{$this->currentTeam}.{$p}.user_id" => 'This player is already assigned to another position.',
                ]);
            }

            $assignedUserIds[] = $userId;
        }
    }

    protected function validateHandicaps(): void
    {
        for ($t = 1; $t <= $this->teamCount; $t++) {
            for ($p = 1; $p <= 4; $p++) {
                $handicap = $this->playerAssignments[$t][$p]['handicap'] ?? '';

                if ($handicap !== '' && ! is_numeric($handicap)) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        "playerAssignments.{$t}.{$p}.handicap" => "Handicap must be a number for Team {$t}, Position {$p}.",
                    ]);
                }
            }
        }
    }

    protected function populateHandicapsFromPreviousYear(): void
    {
        if (! $this->previousYearId) {
            return;
        }

        $userIds = collect($this->playerAssignments)->flatten(1)->pluck('user_id')->filter()->all();

        $previousPlayers = Player::where('year_id', $this->previousYearId)
            ->whereIn('user_id', $userIds)
            ->pluck('hc_next_year', 'user_id');

        for ($t = 1; $t <= $this->teamCount; $t++) {
            for ($p = 1; $p <= 4; $p++) {
                $userId = $this->playerAssignments[$t][$p]['user_id'] ?? '';
                if ($userId && $previousPlayers->has($userId)) {
                    $this->playerAssignments[$t][$p]['handicap'] = (string) $previousPlayers[$userId];
                }
            }
        }
    }

    protected function getAssignedUserIdsExcludingTeam(int $excludeTeam): array
    {
        $ids = [];
        for ($t = 1; $t <= $this->teamCount; $t++) {
            if ($t === $excludeTeam) {
                continue;
            }
            for ($p = 1; $p <= 4; $p++) {
                $userId = $this->playerAssignments[$t][$p]['user_id'] ?? '';
                if ($userId) {
                    $ids[] = $userId;
                }
            }
        }

        return $ids;
    }

    public function getAssignedUserIdsProperty(): array
    {
        $ids = [];
        for ($t = 1; $t <= $this->teamCount; $t++) {
            for ($p = 1; $p <= 4; $p++) {
                $userId = $this->playerAssignments[$t][$p]['user_id'] ?? '';
                if ($userId) {
                    $ids[] = (int) $userId;
                }
            }
        }

        return $ids;
    }

    public function availableUsersForSlot(int $team, int $position, \Illuminate\Support\Collection $allUsers): \Illuminate\Support\Collection
    {
        $currentUserId = $this->playerAssignments[$team][$position]['user_id'] ?? '';
        $assigned = $this->assignedUserIds;

        return $allUsers->filter(function ($user) use ($assigned, $currentUserId) {
            return $user->id == $currentUserId || ! in_array($user->id, $assigned);
        });
    }

    protected function createYear(): Year
    {
        return Year::create([
            'name' => $this->yearName,
            'active' => $this->yearActive,
            'start_date' => $this->startDate,
            'skip_date' => $this->skipDate,
        ]);
    }

    protected function createTeams(int $yearId): void
    {
        for ($i = 1; $i <= $this->teamCount; $i++) {
            Team::create([
                'year_id' => $yearId,
                'name' => (string) $i,
            ]);
        }
    }

    protected function createWeek(int $yearId, int $weekOrder, Carbon $weekDate, string $previousGame): Week
    {
        $sideGames = $previousGame === 'Net' ? 'Pin' : 'Net';

        // Matchup rotation based on last digit of week_order
        $lastDigit = substr((string) $weekOrder, -1);
        $weekMatches = match ($lastDigit) {
            '1', '6' => [1, 2, 3, 4, 5, 6],
            '2', '7' => [4, 6, 2, 5, 1, 3],
            '3', '8' => [3, 5, 1, 4, 2, 6],
            '4', '9' => [2, 4, 3, 6, 1, 5],
            '5', '0' => [1, 6, 2, 3, 4, 5],
        };

        // Tee time rotation based on week_order range
        if ($weekOrder >= 6 && $weekOrder <= 10) {
            $weekMatches = array_merge(array_slice($weekMatches, 2), array_slice($weekMatches, 0, 2));
        } elseif ($weekOrder >= 11 && $weekOrder <= 15) {
            $weekMatches = array_merge(array_slice($weekMatches, 4), array_slice($weekMatches, 0, 4));
        }

        return Week::create([
            'year_id' => $yearId,
            'week_order' => $weekOrder,
            'week_date' => $weekDate,
            'side_games' => $sideGames,
            'a_first_id' => $weekMatches[0],
            'a_second_id' => $weekMatches[1],
            'b_first_id' => $weekMatches[2],
            'b_second_id' => $weekMatches[3],
            'c_first_id' => $weekMatches[4],
            'c_second_id' => $weekMatches[5],
        ]);
    }

    protected function createWeeks(Year $year): void
    {
        $startWeek = new Carbon($this->startDate);
        $skipWeek = $this->skipDate ? new Carbon($this->skipDate) : null;
        $previousGame = 'Putts';
        $weekOrder = 0;

        for ($i = 0; $i < $this->weekCount + 1; $i++) {
            if ($skipWeek && $startWeek->eq($skipWeek)) {
                $startWeek = $startWeek->addWeek();
            } else {
                $weekOrder++;
                if ($weekOrder > $this->weekCount) {
                    break;
                }
                $week = $this->createWeek($year->id, $weekOrder, $startWeek, $previousGame);
                $startWeek = $week->week_date->addWeek();
                $previousGame = $week->side_games;
            }
        }
    }

    protected function createPlayers(Year $year): void
    {
        $teams = Team::where('year_id', $year->id)->orderBy('name')->get();

        for ($t = 1; $t <= $this->teamCount; $t++) {
            $team = $teams->firstWhere('name', (string) $t);

            for ($p = 1; $p <= 4; $p++) {
                $assignment = $this->playerAssignments[$t][$p];
                $handicap = (int) $assignment['handicap'];
                $teeSelection = ($p === 4 && $assignment['yellow_tees']) ? 'Yellow' : 'White';

                Player::create([
                    'team_id' => $team->id,
                    'user_id' => $assignment['user_id'],
                    'year_id' => $year->id,
                    'position' => $p,
                    'tee_selection' => $teeSelection,
                    'on_leave' => false,
                    'substitute' => false,
                    'hc_current' => $handicap,
                    'hc_first' => $handicap,
                    'hc_second' => 0,
                    'hc_third' => 0,
                    'hc_fourth' => 0,
                    'hc_playoff' => 0,
                    'hc_next_year' => 0,
                    'hc_18' => 0,
                    'hc_full' => 0,
                    'hc_full_rank' => 0,
                    'won' => 0,
                    'lost' => 0,
                    'tied' => 0,
                    'win_pct' => 0,
                    'points' => 0,
                    'points_rank' => 0,
                    'wins_rank' => 0,
                    'gross_average' => 0,
                    'gross_par' => 0,
                    'net_average' => 0,
                    'net_par' => 0,
                    'low_gross' => 0,
                    'low_net' => 0,
                    'high_gross' => 0,
                    'high_net' => 0,
                    'position_net_rank' => 0,
                    'overall_net_rank' => 0,
                    'champion' => false,
                    'make_ups' => 0,
                ]);
            }
        }
    }

    protected function createScores(Year $year): void
    {
        $players = Player::where('year_id', $year->id)->get();
        $weekIds = Week::where('year_id', $year->id)->pluck('id')->toArray();

        foreach ($players as $player) {
            foreach ($weekIds as $weekId) {
                Score::firstOrCreate([
                    'player_id' => $player->id,
                    'score_type' => 'weekly_score',
                    'foreign_key' => $weekId,
                ]);
            }

            Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_1_avg', 'foreign_key' => $year->id]);
            Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_2_avg', 'foreign_key' => $year->id]);
            Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_3_avg', 'foreign_key' => $year->id]);
            Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'qtr_4_avg', 'foreign_key' => $year->id]);
            Score::firstOrCreate(['player_id' => $player->id, 'score_type' => 'season_avg', 'foreign_key' => $year->id]);
        }
    }

    public function createSeason(): void
    {
        $this->validateCurrentStep();

        DB::transaction(function () {
            $year = $this->createYear();
            $this->createTeams($year->id);
            $this->createWeeks($year);
            $this->createPlayers($year);

            if ($this->generateScores) {
                $this->createScores($year);
            }
        });

        Flux::toast('Season created successfully.');

        $this->redirect(route('admin.years.index'));
    }

    public function with(): array
    {
        $usersQuery = User::orderBy('name');

        if (\Schema::hasColumn('users', 'active')) {
            $usersQuery->where('active', true);
        }

        return [
            'previousYears' => Year::orderBy('name', 'desc')->get(),
            'users' => $usersQuery->get(),
        ];
    }
}; ?>

<div>
    <flux:heading>New Season</flux:heading>
    <flux:subheading>Create a new season with teams, weeks, and players</flux:subheading>

    {{-- Step Indicator --}}
    <div class="flex items-center gap-2 mt-6 mb-8 flex-wrap">
        @php
            $steps = [
                1 => 'Year',
                2 => 'Teams',
                3 => 'Weeks',
                4 => 'Previous Year',
                5 => 'Players',
                6 => 'Handicaps',
                7 => 'Review',
            ];
        @endphp

        @foreach ($steps as $num => $label)
            @if ($num > 1)
                <flux:icon.chevron-right class="size-4 text-zinc-400" />
            @endif

            <button
                wire:click="goToStep({{ $num }})"
                @if ($num >= $step) disabled @endif
                class="disabled:cursor-default"
            >
                <flux:badge
                    :color="$num < $step ? 'green' : ($num === $step ? 'blue' : 'zinc')"
                    size="sm"
                >
                    {{ $num }}. {{ $label }}
                </flux:badge>
            </button>
        @endforeach
    </div>

    {{-- Step 1: Year --}}
    @if ($step === 1)
        <div class="max-w-md space-y-6">
            <flux:input
                wire:model="yearName"
                label="Year Name"
                placeholder="e.g. {{ now()->year }}"
            />

            <flux:switch
                wire:model="yearActive"
                label="Set as active year"
                description="This will deactivate any currently active year."
            />
        </div>
    @endif

    {{-- Step 2: Teams --}}
    @if ($step === 2)
        <div class="max-w-md space-y-6">
            <flux:input
                wire:model.live="teamCount"
                label="Number of Teams"
                type="number"
                min="2"
                max="12"
                description="Teams will be automatically named 1 through {{ $teamCount }}."
            />
        </div>
    @endif

    {{-- Step 3: Weeks --}}
    @if ($step === 3)
        <div class="max-w-md space-y-6">
            <flux:input
                wire:model="weekCount"
                label="Number of Weeks"
                type="number"
                min="1"
                max="40"
            />

            <flux:input
                wire:model="startDate"
                label="Start Date"
                type="date"
            />

            <flux:input
                wire:model="skipDate"
                label="Skip Date (Optional)"
                type="date"
                description="A week to skip (e.g. holiday week). Leave blank for none."
            />
        </div>
    @endif

    {{-- Step 4: Previous Year --}}
    @if ($step === 4)
        <div class="max-w-md space-y-6">
            <flux:select
                wire:model="previousYearId"
                label="Previous Year"
                placeholder="Select a previous year..."
                variant="listbox"
            >
                <flux:select.option value="">None</flux:select.option>
                @foreach ($previousYears as $prevYear)
                    <flux:select.option value="{{ $prevYear->id }}">{{ $prevYear->name }}</flux:select.option>
                @endforeach
            </flux:select>

            <flux:text class="text-sm text-zinc-500">
                Optionally link this season to a previous year for reference.
            </flux:text>
        </div>
    @endif

    {{-- Step 5: Players (one team at a time) --}}
    @if ($step === 5)
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <flux:heading size="sm">Team {{ $currentTeam }} of {{ $teamCount }}</flux:heading>

                <div class="flex items-center gap-1">
                    @for ($t = 1; $t <= $teamCount; $t++)
                        <flux:badge
                            size="sm"
                            :color="$t < $currentTeam ? 'green' : ($t === $currentTeam ? 'blue' : 'zinc')"
                        >
                            {{ $t }}
                        </flux:badge>
                    @endfor
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @for ($p = 1; $p <= 4; $p++)
                    <div wire:key="team-{{ $currentTeam }}-pos-{{ $p }}" class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 space-y-3">
                        <flux:text class="font-medium text-sm">Position {{ $p }}</flux:text>

                        <flux:select
                            wire:model.live="playerAssignments.{{ $currentTeam }}.{{ $p }}.user_id"
                            wire:loading.attr="disabled"
                            wire:target="playerAssignments"
                            label="Player"
                            placeholder="Select player..."
                        >
                            <option value="">-- Select --</option>
                            @foreach ($this->availableUsersForSlot($currentTeam, $p, $users) as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </flux:select>

                        @if ($p === 4)
                            <flux:switch
                                wire:model="playerAssignments.{{ $currentTeam }}.{{ $p }}.yellow_tees"
                                label="Yellow Tees"
                            />
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    @endif

    {{-- Step 6: Handicaps --}}
    @if ($step === 6)
        <div class="space-y-6">
            <flux:heading size="sm">Set Handicaps for All Players</flux:heading>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @for ($t = 1; $t <= $teamCount; $t++)
                    <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4 space-y-3">
                        <flux:text class="font-medium">Team {{ $t }}</flux:text>

                        @for ($p = 1; $p <= 4; $p++)
                            @php
                                $userId = $playerAssignments[$t][$p]['user_id'] ?? '';
                                $userName = $userId ? $users->firstWhere('id', $userId)?->name : 'Unassigned';
                            @endphp
                            <flux:input
                                wire:model="playerAssignments.{{ $t }}.{{ $p }}.handicap"
                                label="#{{ $p }}: {{ $userName }}"
                                type="number"
                            />
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    @endif

    {{-- Step 7: Review --}}
    @if ($step === 7)
        <div class="space-y-6 max-w-2xl">
            <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg divide-y divide-zinc-200 dark:divide-zinc-700">
                <div class="px-4 py-3 flex justify-between">
                    <flux:text class="font-medium">Year</flux:text>
                    <flux:text>{{ $yearName }} {{ $yearActive ? '(Active)' : '(Inactive)' }}</flux:text>
                </div>
                <div class="px-4 py-3 flex justify-between">
                    <flux:text class="font-medium">Teams</flux:text>
                    <flux:text>{{ $teamCount }} teams</flux:text>
                </div>
                <div class="px-4 py-3 flex justify-between">
                    <flux:text class="font-medium">Weeks</flux:text>
                    <flux:text>{{ $weekCount }} weeks starting {{ $startDate }}{{ $skipDate ? ', skipping ' . $skipDate : '' }}</flux:text>
                </div>
                <div class="px-4 py-3 flex justify-between">
                    <flux:text class="font-medium">Previous Year</flux:text>
                    <flux:text>
                        @if ($previousYearId)
                            {{ $previousYears->firstWhere('id', $previousYearId)?->name ?? 'None' }}
                        @else
                            None
                        @endif
                    </flux:text>
                </div>
            </div>

            <div>
                <flux:heading size="sm" class="mb-4">Player Assignments</flux:heading>

                <div class="space-y-4">
                    @for ($t = 1; $t <= $teamCount; $t++)
                        <div class="border border-zinc-200 dark:border-zinc-700 rounded-lg p-4">
                            <flux:text class="font-medium mb-2">Team {{ $t }}</flux:text>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                @for ($p = 1; $p <= 4; $p++)
                                    @php
                                        $userId = $playerAssignments[$t][$p]['user_id'] ?? '';
                                        $hc = $playerAssignments[$t][$p]['handicap'] ?? '0';
                                        $yellow = $playerAssignments[$t][$p]['yellow_tees'] ?? false;
                                        $userName = $userId ? $users->firstWhere('id', $userId)?->name : 'Unassigned';
                                    @endphp
                                    <flux:text class="text-sm">
                                        #{{ $p }}: {{ $userName }} (HC: {{ $hc }}){{ $p === 4 && $yellow ? ' - Yellow Tees' : '' }}
                                    </flux:text>
                                @endfor
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <flux:switch
                wire:model="generateScores"
                label="Generate Blank Scorecards"
                description="Creates weekly score entries and quarterly/season averages for all players."
            />
        </div>
    @endif

    {{-- Navigation Buttons --}}
    <div class="flex justify-between mt-8">
        <div>
            @if ($step > 1)
                <flux:button wire:click="previousStep" variant="ghost">
                    @if ($step === 5 && $currentTeam > 1)
                        Previous Team
                    @else
                        Back
                    @endif
                </flux:button>
            @endif
        </div>

        <div>
            @if ($step < 7)
                <flux:button wire:click="nextStep" variant="primary">
                    @if ($step === 5 && $currentTeam < $teamCount)
                        Next Team
                    @else
                        Continue
                    @endif
                </flux:button>
            @else
                <flux:button wire:click="createSeason" variant="primary">
                    Create Season
                </flux:button>
            @endif
        </div>
    </div>
</div>

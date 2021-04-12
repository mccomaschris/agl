<div class="w-full lg:w-1/3 mb-4 lg:pr-4">
    @include('_parts.home-team-table', [
      'hole' => '1',
      'teamA' => $week->team_a,
      'teamB' => $week->team_b,
      ])
</div>
<div class="w-full lg:w-1/3 mb-4 lg:pr-4">
  @include('_parts.home-team-table', [
      'hole' => '3',
      'teamA' => $week->team_c,
      'teamB' => $week->team_d,
      ])
</div>
<div class="w-full lg:w-1/3">
  @include('_parts.home-team-table', [
      'hole' => '5',
      'teamA' => $week->team_e,
      'teamB' => $week->team_f,
      ])
</div>
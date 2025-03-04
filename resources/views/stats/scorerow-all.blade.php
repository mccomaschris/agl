<tr>
  <td><a href="/scores/week/{{ $score->foreign_key }}">{{ $score->year_name }} Week {{ $score->week_order }}</a>
  </td>
  <td class="text-center
    @if ($score->hole_1 >= 1 and $score->hole_1 <=2)
      eagle-hole
    @elseif ($score->hole_1 == 3)
      birdie-hole
    @elseif ($score->hole_1 == 4)
      par-hole
    @elseif ($score->hole_1 == 5)
      bogey-hole
    @elseif ($score->hole_1 >= 6)
      double-hole
    @endif
    ">
    {{ $score->hole_1 ? number_format($score->hole_1, 0, '.', ',') : '' }}
  </td>

  <td class="text-center
     @if ($score->hole_2 == 1)
       eagle-hole
     @elseif ($score->hole_2 == 2)
       birdie-hole
     @elseif ($score->hole_2 == 3)
       par-hole
     @elseif ($score->hole_2 == 4)
       bogey-hole
     @elseif ($score->hole_2 >= 5)
       double-hole
     @endif
     ">
     {{ $score->hole_2 ? number_format($score->hole_2, 0, '.', ',') : '' }}
   </td>

  <td class="text-center
    @if ($score->hole_3 >= 1 and $score->hole_3 <=2)
      eagle-hole
    @elseif ($score->hole_3 == 3)
      birdie-hole
    @elseif ($score->hole_3 == 4)
      par-hole
    @elseif ($score->hole_3 == 5)
      bogey-hole
    @elseif ($score->hole_3 >= 6)
      double-hole
    @endif
    ">
    {{ $score->hole_3 ? number_format($score->hole_3, 0, '.', ',') : '' }}
  </td>

  <td class="text-center
    @if ($score->hole_4 >= 1 and $score->hole_4 <=2)
      eagle-hole
    @elseif ($score->hole_4 == 3)
      birdie-hole
    @elseif ($score->hole_4 == 4)
      par-hole
    @elseif ($score->hole_4 == 5)
      bogey-hole
    @elseif ($score->hole_4 >= 6)
      double-hole
    @endif
    ">
    {{ $score->hole_4 ? number_format($score->hole_4, 0, '.', ',') : '' }}
  </td>

  <td class="text-center
    @if ($score->hole_5 >= 1 and $score->hole_5 <= 3)
      eagle-hole
    @elseif ($score->hole_5 == 4)
      birdie-hole
    @elseif ($score->hole_5 == 5)
      par-hole
    @elseif ($score->hole_5 == 6)
      bogey-hole
    @elseif ($score->hole_5 >= 7)
      double-hole
    @endif
    ">
    {{ $score->hole_5 ? number_format($score->hole_5, 0, '.', ',') : '' }}
  </td>

  <td class="text-center
     @if ($score->hole_6 == 1)
       eagle-hole
     @elseif ($score->hole_6 == 2)
       birdie-hole
     @elseif ($score->hole_6 == 3)
       par-hole
     @elseif ($score->hole_6 == 4)
       bogey-hole
     @elseif ($score->hole_6 >= 5)
       double-hole
     @endif
     ">
     {{ $score->hole_6 ? number_format($score->hole_6, 0, '.', ',') : '' }}
   </td>

   <td class="text-center
     @if ($score->hole_7 >= 1 and $score->hole_7 <= 3)
       eagle-hole
     @elseif ($score->hole_7 == 4)
       birdie-hole
     @elseif ($score->hole_7 == 5)
       par-hole
     @elseif ($score->hole_7 == 6)
       bogey-hole
     @elseif ($score->hole_7 >= 7)
       double-hole
     @endif
     ">
     {{ $score->hole_7 ? number_format($score->hole_7, 0, '.', ',') : '' }}
   </td>

  <td class="text-center
    @if ($score->hole_8 >= 1 and $score->hole_8 <=2)
      eagle-hole
    @elseif ($score->hole_8 == 3)
      birdie-hole
    @elseif ($score->hole_8 == 4)
      par-hole
    @elseif ($score->hole_8 == 5)
      bogey-hole
    @elseif ($score->hole_8 >= 6)
      double-hole
    @endif
    ">
    {{ $score->hole_8 ? number_format($score->hole_8, 0, '.', ',') : '' }}
  </td>

  <td class="text-center
    @if ($score->hole_9 >= 1 and $score->hole_9 <= 3)
      eagle-hole
    @elseif ($score->hole_9 == 4)
      birdie-hole
    @elseif ($score->hole_9 == 5)
      par-hole
    @elseif ($score->hole_9 == 6)
      bogey-hole
    @elseif ($score->hole_9 >= 7)
      double-hole
    @endif
    ">
    {{ $score->hole_9 ? number_format($score->hole_9, 0, '.', ',') : '' }}
  </td>

  <td class="text-center">
      <strong><span class="">
          {{ $score->gross ? number_format($score->gross, 0, '.', ',') : '' }}
      </span><strong>
  </td>
  <td class="text-center">
      <strong><span class="">
          {{ $score->gross_par ? number_format($score->gross_par, 0, '.', ',') : '' }}
      </span><strong>
  </td>
  <td class="text-center">
      <strong><span class="">
          {{ $score->net ? number_format($score->net, 0, '.', ',') : '' }}
      </span><strong>
  </td>
  <td class="text-center">
      <strong><span class="">
          {{ $score->net_par ? number_format($score->net_par, 0, '.', ',') : '' }}
      </span><strong>
  </td>
  <td class="text-center font-bold">
    <span class="
    @if ($score->points == 2)
        text-green
      @elseif ($score->points === 0)
        text-red
      @else
        text-grey-800
      @endif">
    {{ $score->points }}</span>
  </td>
  <td class="text-center">{{ $score->eagle}}</td>
  <td class="text-center">{{ $score->birdie}}</td>
  <td class="text-center">{{ $score->par}}</td>
  <td class="text-center">{{ $score->bogey}}</td>
  <td class="text-center">{{ $score->double_bogey }}</td>
</tr>

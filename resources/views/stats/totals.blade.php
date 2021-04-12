<tr class="score totals">
  <td>Totals</td>
  <td class="text-center">{{ number_format($total->hole_1, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_2, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_3, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_4, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_5, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_6, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_7, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_8, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->hole_9, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->gross, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->gross_par, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->net, 1, '.', ',') }}</td>
  <td class="text-center">{{ number_format($total->net_par, 1, '.', ',') }}</td>
  <td class="text-center">{{ $total->points ? $total->points : '0' }}</td>
  <td class="text-center">{{ $total->eagle ? $total->eagle : '0' }}</td>
  <td class="text-center">{{ $total->birdie ? $total->birdie : '0' }}</td>
  <td class="text-center">{{ $total->par ? $total->par : '0' }}</td>
  <td class="text-center">{{ $total->bogey ? $total->bogey : '0' }}</td>
  <td class="text-center">{{ $total->double_bogey ? $total->double_bogey : '0' }}</td>
</tr>

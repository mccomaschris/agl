@extends('layouts.admin')

@section('page-heading', 'Redis Cached Queries')

@section('content')
<table class="pure-table pure-table-bordered pure-table-striped">
    <thead>
      <tr>
        <th>Query</th>
        <th></th>
        </th>
      </tr>
    </thead>
    <tbody>
     @foreach ($queries as $query)
        <tr>
          <td>{{ $query }}</td>
          <td class="text-center">
          <form method="post" action="/admin/cache/{{ $query }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button class="button-error pure-button">Delete</button>
          </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

@endsection

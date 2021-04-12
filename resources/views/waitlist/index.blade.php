@extends('layouts.default')

@push('scripts')
  <meta name="turbolinks-cache-control" content="no-cache">
@endpush

@section('page-heading')
  <h1 class="text-center lg:text-left text-2xl lg:text-3xl tracking-tight mt-6 mb-6 ">AGL Waiting List</h1>
@endsection

@section('content')
<div class="px-4">
    <div class="flex flex-wrap -mx-4">
      <div class="w-full lg:w-2/3 px-2 mb-6 lg:mb-0">
        <div class="">
            <h3 class="font-semibold lg:text-xl mb-4">Current Waiting List</h3>
            <ul class="list-group leading-normal">
                @if ($members->count() > 0)
                  @foreach ($members as $member)
                    <li class="mb-2">
                        <p class="font-semibold">{{ $member->name }} <span class="font-normal text-grey-800">(Projected HC {{ $member->projected_hc }})</span></p>
                        <p class="text-xs text-grey-800">Added by {{ $member->user->name }}</p>
                    </li>
                  @endforeach
                @else
                  <p>No one has been added to the wait list.</p>
                @endif
              </ul>
        </div>
      </div>
      <div class="w-full lg:w-1/3 px-4">
        <div class="">
            <h3 class="font-semibold lg:text-xl mb-4">Add Person to Waiting List</h3>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 border-t-4 border-green-500" action="/waitlist" method="POST">
              {{ csrf_field() }}
              <div class="mb-4">
                  <label class="block text-grey-800 text-sm font-semibold uppercase mb-2" for="name">
                      Individual Name
                  </label>
                  <input class="form-input {{ $errors->has('name') ? ' border-red-500' : '' }}" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                  @if ($errors->has('name'))
                  <p class="text-xs text-red-500 mt-2">{{ $errors->first('name') }}</p>
                  @endif
                </div>
                <div class="mb-4">
                  <label class="block text-grey-800 text-sm font-semibold uppercase mb-2" for="name">
                    Projected HC
                  </label>
                  <input class="form-input {{ $errors->has('projected_hc') ? ' border-red-500' : '' }}" type="text" name="projected_hc" placeholder="Ex: 8" value="{{ old('projected_hc') }}" required>
                  @if ($errors->has('projected_hc'))
                    <p class="text-xs text-red-500 mt-2">{{ $errors->first('projected_hc') }}</p>
                  @endif
              </div>
              <div class="flex items-center justify-between">
                  <button class="btn btn-green" type="submit">
                      Add to Wait List
                  </button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection

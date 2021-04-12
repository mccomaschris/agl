@component('mail::message')
# New User Added to the Waitlist

{{ $waitlist->user->name }} has added {{ $waitlist->name }}, with a projected handicap of {{ $waitlist->projected_hc }}, to the waiting list for the golf league. 

@endcomponent
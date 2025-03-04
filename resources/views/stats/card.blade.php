<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', config('app.name'))</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    @stack('head')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){$("#sidebar-open").on("click",function(){$("#sidebar").removeClass("hidden"),$("#sidebar-close").removeClass("hidden")}),$("#sidebar-close").on("click",function(){$("#sidebar").addClass("hidden"),$("#sidebar-close").addClass("hidden")})});
    </script>

    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>

    <script src='https://cdn.polyfill.io/v2/polyfill.min.js'></script>

</head>
<body class="bg-grey-lightest h-screen font-sans my-20 mx-20 @yield('body-css')">
    <table class="w-full" style="white-space: nowrap; border-collapse: collapse;">
        <tr class="p-2">
            <td class="bg-white text-black border border-black py-3 px-2  font-bold text-left uppercase">White Course</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">330</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">206</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">306</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">409</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">474</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">140</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">443</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">331</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">510</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold">3149</td>
            <td class="bg-white text-black border border-black py-3 px-2 text-center font-bold"></td>
        </tr>
        <tr>
            <td class="bg-red text-white border border-black py-3 px-2 font-bold text-left uppercase">Red Course</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">210</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">166</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">286</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">403</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">427</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">130</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">413</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">268</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">264</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold">2667</td>
            <td class="bg-red text-white border border-black py-3 px-2 text-center font-bold"></td>
        </tr>
        <tr>
            <td class="bg-grey-light text-black border border-black py-3 px-2 font-bold text-left uppercase">PAR</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">4</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">3</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">4</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">4</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">5</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">3</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">4</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">4</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">5</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold">37</td>
            <td class="bg-grey-light text-black border border-black py-3 px-2 text-center font-bold"></td>
        </tr>
        <tr>
            <td class="border border-black py-3 px-2">
                <div class="flex justify-between">
                    <span>{{ $week->team_a->onePlayer->user->name }}</span>
                    <span class="font-bold">{{ $week->team_a->onePlayer->hc_current }}</span>
                </div>
            </td>
            <td class="border border-black py-3 px-2">
                <div class="rounded-full h-8 w-8 mx-auto border border-black"></div>
            </td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
            <td class="border border-black py-3 px-2"></td>
        </tr>
        <tr>
                <td class="border border-black py-3 px-2">
                    <div class="flex justify-between">
                        <span>{{ $week->team_b->onePlayer->user->name }}</span>
                        <span class="font-bold">{{ $week->team_b->onePlayer->hc_current }}</span>
                    </div>
                </td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
                <td class="border border-black py-3 px-2"></td>
            </tr>
    </table>
        @include('parts.print_card', [
            'teamA' => $week->team_a,
            'teamB' => $week->team_b,
            ])
</body>
</html>

@props(['method' => 'GET'])

<form {{ $attributes }} method="{{ strtoupper($method) }}">

    @if($method != 'GET')
        @csrf
    @endif

    {{ $slot }}
</form>

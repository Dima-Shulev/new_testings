@props(['color' => 'primary','size'=>''])
<button {{ $attributes->class(["btn btn-{$color} ml-auto",$size?"btn-{$size}":''])->merge([
    'type' => 'button',
]) }}>
    {{ $slot  }}
</button>

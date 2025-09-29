@props(['title' => ''])

<div class="card" style="border:1px solid #ddd; padding:12px; margin-bottom:12px; border-radius:6px; background:#fff">
    @if($title)
        <h3 style="margin-top:0">{{ $title }}</h3>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
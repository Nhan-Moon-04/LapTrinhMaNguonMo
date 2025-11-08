@props(['type' => 'success','title' => 'Thông báo'])

<div class="p-2.5 mb-2.5 rounded-lg
    {{ $type === 'success' ? 'bg-emerald-50 text-emerald-800' : 'bg-amber-50 text-amber-800' }}">
    <strong>{{ $title }}:</strong> {{ $slot }}
</div>

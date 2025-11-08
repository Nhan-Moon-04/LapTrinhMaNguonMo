@php($isEdit = isset($product) && $product->exists)
<form method="POST" action="{{ $isEdit ? route('products.update', $product) : route('products.store') }}">
    @csrf
    @if($isEdit)
        @method('PUT')
    @endif

    <x-input name="name" label="Name" :value="$product->name ?? ''" required />
    <x-input name="price" label="Price" type="number" step="0.01" min="0" :value="$product->price ?? 0" required />
    <x-input name="stock" label="Stock" type="number" min="0" :value="$product->stock ?? 0" required />

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

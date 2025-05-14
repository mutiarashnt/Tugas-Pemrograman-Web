<x-layouts.app :title="__('Products')"> 
<div class="relative mb-6 w-full"> 
    <flux:heading size="xl">Add New Product</flux:heading> 
    <flux:subheading size="lg" class="mb-6">Manage your products</flux:subheading> 
    <flux:separator variant="subtle" /> 
</div> 

@if(session()->has('successMessage')) 
    <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge> 
@elseif(session()->has('errorMessage')) 
    <flux:badge color="red" class="mb-3 w-full">{{ session()->get('errorMessage') }}</flux:badge> 
@endif 

<form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data"> 
    @csrf 
    <flux:input label="Name" name="name" class="mb-3" value="{{ old('name') }}" />
    <flux:input label="Slug" name="slug" class="mb-3" value="{{ old('slug') }}" />
    <flux:input label="Description" name="description" class="mb-3" value="{{ old('description') }}" />
    <flux:input label="SKU" name="sku" class="mb-3" value="{{ old('sku') }}" />
    <flux:input label="Price" name="price" type="number" step="0.01" class="mb-3" value="{{ old('price') }}" />
    <flux:input label="Stock" name="stock" type="number" class="mb-3" value="{{ old('stock') }}" />
    <flux:input label="Image URL" name="image_url" class="mb-3" value="{{ old('image_url') }}" />
    <flux:input label="Is Active" name="is_active" type="checkbox" class="mb-3" :checked="old('is_active', true)" />
    
    <flux:separator /> 

    <div class="mt-4"> 
        <flux:button type="submit" variant="primary">Simpan</flux:button> 
        <flux:link href="{{ route('products.index') }}" variant="ghost" class="ml-3">Kembali</flux:link> 
    </div>
</form> 
</x-layouts.app>

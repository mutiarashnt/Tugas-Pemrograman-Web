<x-layouts.app :title="__('Product Detail')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Product Detail</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            View complete information of the product.
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <flux:input label="Name" :value="$product->name" disabled class="mb-3" />
            <flux:input label="Slug" :value="$product->slug" disabled class="mb-3" />
            <flux:input label="Description" :value="$product->description" disabled class="mb-3" />
            <flux:input label="SKU" :value="$product->sku" disabled class="mb-3" />
            <flux:input label="Price" :value="$product->price" disabled class="mb-3" />
            <flux:input label="Stock" :value="$product->stock" disabled class="mb-3" />
        </div>
        <div>
            <flux:input label="Image URL" :value="$product->image_url" disabled class="mb-3" />
            <flux:input label="Is Active" :value="$product->is_active ? 'Yes' : 'No'" disabled class="mb-3" />
            <flux:input label="Created At" :value="$product->created_at" disabled class="mb-3" />
            <flux:input label="Updated At" :value="$product->updated_at" disabled class="mb-3" />
        </div>
    </div>

    <div>
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="rounded-xl max-w-xs mb-3">
    </div>

    <flux:separator class="my-4" />

    <div class="flex justify-between">
        <flux:link href="{{ route('products.index') }}" variant="ghost">
            Back to Product List
        </flux:link>
        <div>
            <flux:link href="{{ route('products.edit', $product->id) }}" variant="subtle" class="mr-2">
                Edit Product
            </flux:link>

            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                @csrf
                @method('DELETE')
                <flux:button variant="danger" type="submit">Delete</flux:button>
            </form>
        </div>
    </div>
</x-layouts.app>

<x-layouts.app :title="__('Products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Product</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            Manage data Product
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('products.index') }}" method="get">
                <flux:input icon="magnifying-glass" name="q" value="{{ $q }}" placeholder="Search Product" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('products.create') }}" variant="subtle">Add New Product</flux:link>
            </flux:button>
        </div>
    </div>

    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">
            {{ session()->get('successMessage') }}
        </flux:badge>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="table-header">ID</th>
                    <th class="table-header">Name</th>
                    <th class="table-header">Slug</th>
                    <th class="table-header">Description</th>
                    <th class="table-header">SKU</th>
                    <th class="table-header">Price</th>
                    <th class="table-header">Stock</th>
                    <th class="table-header">Image URL</th>
                    <th class="table-header">Is Active</th>
                    <th class="table-header">Created At</th>
                    <th class="table-header">Updated At</th>
                    <th class="table-header">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td class="px-5 py-5 text-sm text-center">{{ $key + 1 }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->name }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->slug }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->description }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->sku }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->price }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->stock }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->image_url }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->is_active ? 'Yes' : 'No' }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->created_at }}</td>
                        <td class="px-5 py-5 text-sm text-center">{{ $product->updated_at }}</td>
                        <td class="px-5 py-5 text-sm text-center">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil" href="{{ route('products.edit', $product->id) }}">
                                        Edit
                                    </flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) document.getElementById('delete-form-{{ $product->id }}').submit();">
                                        Delete
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>

                            <form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>

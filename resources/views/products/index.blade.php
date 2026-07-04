@extends('layouts.admin')

@section('title', __('dashboard.products'))

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-box"></i> قائمة المنتجات</h1>
    {{-- <a href="{{ route('products.create') }}" class="btn btn-primary"> --}}
    <a href="#" class="btn btn-primary">
        <i class="fas fa-plus"></i> إضافة منتج جديد
    </a>
</div>

<div class="table-responsive">
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>الصورة</th>
                <th>اسم المنتج</th>
                <th>السعر</th>
                <th>الكمية</th>
                <th>الحالة</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <img src="{{ $product->thumbnail }}" 
                         alt="{{ $product->name }}" 
                         width="60" 
                         height="60" 
                         class="rounded object-fit-cover"
                         loading="lazy">
                </td>
                <td>{{ $product->name }}</td>
                <td>
                    <strong>{{ number_format($product->price, 2) }} جنيه</strong>
                    @if($product->compare_price)
                        <br>
                        <small class="text-muted text-decoration-line-through">
                            {{ number_format($product->compare_price, 2) }} جنيه
                        </small>
                    @endif
                </td>
                <td>
                    <span class="badge {{ $product->quantity > 0 ? 'bg-success' : 'bg-danger' }}">
                        {{ $product->quantity }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm {{ $product->is_active ? 'btn-success' : 'btn-secondary' }} toggle-status"
                            data-id="{{ $product->id }}">
                        {{ $product->is_active ? 'نشط' : 'غير نشط' }}
                    </button>
                </td>
                <td>
                    <div class="btn-group" role="group">
                        {{-- <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info"> --}}
                        <a href="#" class="btn btn-sm btn-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        {{-- <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning"> --}}
                        <a href="#" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        {{-- <form action="{{ route('products.destroy', $product) }}" method="POST"  --}}
                        <form action="#" method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من حذف هذا المنتج؟')"
                              style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center py-4">
                    <i class="fas fa-box-open fa-3x text-muted"></i>
                    <p class="mt-2">لا توجد منتجات حتى الآن</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> أضف أول منتج
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{ $products->links() }}
@endsection

@push('scripts')
<script>
    // تغيير حالة المنتج (AJAX)
    document.querySelectorAll('.toggle-status').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;
            const btn = this;
            
            fetch(`/products/${productId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    btn.textContent = data.is_active ? 'نشط' : 'غير نشط';
                    btn.className = `btn btn-sm ${data.is_active ? 'btn-success' : 'btn-secondary'}`;
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
</script>
@endpush      
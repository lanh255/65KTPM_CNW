@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Chi tiết Thuốc</h1>
    <div class="card p-4 shadow-sm">
        <p><strong>Mã thuốc:</strong> {{ $medicine->medicine_id }}</p>
        <p><strong>Tên thuốc:</strong> {{ $medicine->name }}</p>
        <p><strong>Thương hiệu:</strong> {{ $medicine->brand }}</p>
        <p><strong>Liều lượng:</strong> {{ $medicine->dosage }}</p>
        <p><strong>Dạng thuốc:</strong> {{ $medicine->form }}</p>
        <p><strong>Giá bán:</strong> {{ number_format($medicine->price, 0) }} VNĐ</p>
        <p><strong>Tồn kho:</strong> {{ $medicine->stock }}</p>
    </div>
    <div class="mt-3">
        <a href="{{ route('medicines.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
        <a href="{{ route('medicines.edit', $medicine->medicine_id) }}" class="btn btn-warning">Sửa thông tin</a>
    </div>
</div>
@endsection
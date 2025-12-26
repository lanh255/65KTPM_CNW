    @extends('layouts.app')
@section('content')
<div class="container" style="max-width: 700px;">
    <h1 class="mb-4">Thêm thuốc mới</h1>
    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-bold">Tên thuốc:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label fw-bold">Thương hiệu:</label>
            <input type="text" name="brand" class="form-control">
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Liều lượng:</label>
                <input type="text" name="dosage" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Dạng thuốc:</label>
                <input type="text" name="form" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Giá (VNĐ):</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label fw-bold">Số lượng tồn kho:</label>
                <input type="number" name="stock" class="form-control" required>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary px-4">Lưu lại</button>
            <a href="{{ route('medicines.index') }}" class="btn btn-outline-secondary ms-2">Hủy bỏ</a>
        </div>
    </form>
</div>
@endsection
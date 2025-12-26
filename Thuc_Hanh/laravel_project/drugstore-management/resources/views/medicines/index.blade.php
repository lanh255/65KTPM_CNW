@extends('layouts.app') @section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Danh sách Thuốc (PRAC 01)</h2>
        <a href="{{ route('medicines.create') }}" class="btn btn-success">Thêm thuốc mới</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr class="table-dark">
                <th>Mã thuốc</th>
                <th>Tên thuốc</th>
                <th>Thương hiệu</th>
                <th>Giá</th>
                <th>Tồn kho</th>
                <th style="width: 180px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $med)
            <tr>
                <td>{{ $med->medicine_id }}</td>
                <td>{{ $med->name }}</td>
                <td>{{ $med->brand }}</td>
                <td>{{ number_format($med->price, 0) }} VNĐ</td>
                <td>{{ $med->stock }}</td>
                <td>
                    <a href="{{ route('medicines.edit', $med->medicine_id) }}" class="btn btn-sm btn-warning text-white">Sửa</a>
                    
                    <form action="{{ route('medicines.destroy', $med->medicine_id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
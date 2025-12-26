@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold m-0">Danh sách vấn đề báo cáo</h3>
            <a href="{{ route('issues.create') }}" class="btn btn-success btn-sm">+ Thêm mới</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif

        <table class="table table-hover border">
            <thead class="table-light text-uppercase small fw-bold">
                <tr>
                    <th>Mã</th>
                    <th>Tên máy tính</th>
                    <th>Tên phiên bản</th>
                    <th>Người báo cáo</th>
                    <th>Thời gian</th>
                    <th>Mức độ</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($issues as $issue)
                <tr>
                    <td>{{ $issue->id }}</td>
                    <td>{{ $issue->computer->computer_name }}</td>
                    <td>{{ $issue->computer->model }}</td>
                    <td>{{ $issue->reported_by }}</td>
                    <td>{{ $issue->reported_date }}</td>
                    <td><span class="badge {{ $issue->urgency == 'High' ? 'bg-danger' : 'bg-info' }}">{{ $issue->urgency }}</span></td>
                    <td>{{ $issue->status }}</td>
                    <td class="text-center">
                        <a href="{{ route('issues.edit', $issue->id) }}" class="btn btn-primary btn-sm">Sửa</a>
                        <form action="{{ route('issues.destroy', $issue->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $issues->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <div class="card p-4 shadow-sm border-0">
        <h3 class="mb-4 text-center">Thêm vấn đề báo cáo</h3>
        <form action="{{ route('issues.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Chọn máy tính</label>
                <select name="computer_id" class="form-select" required>
                    <option value="">-- Chọn máy tính --</option>
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}">{{ $computer->computer_name }} ({{ $computer->model }})</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Người báo cáo</label>
                <input type="text" name="reported_by" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Thời gian</label>
                <input type="datetime-local" name="reported_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Mô tả sự cố</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <label class="form-label fw-bold">Mức độ</label>
                    <select name="urgency" class="form-select">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div class="col">
                    <label class="form-label fw-bold">Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="Open">Open</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Resolved">Resolved</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2">Lưu báo cáo</button>
        </form>
    </div>
</div>
@endsection
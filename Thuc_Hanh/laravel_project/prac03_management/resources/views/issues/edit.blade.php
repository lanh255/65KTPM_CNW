@extends('layouts.app')

@section('content')
<div class="container mt-4" style="max-width: 600px;">
    <div class="card p-4 shadow-sm border-0">
        <h3 class="mb-4 text-center">Cập nhật vấn đề báo cáo</h3>
        <form action="{{ route('issues.update', $issue->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-bold small">MÁY TÍNH</label>
                <select name="computer_id" class="form-select" required>
                    @foreach($computers as $computer)
                        <option value="{{ $computer->id }}" {{ $computer->id == $issue->computer_id ? 'selected' : '' }}>
                            {{ $computer->computer_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small">NGƯỜI BÁO CÁO</label>
                <input type="text" name="reported_by" class="form-control" value="{{ $issue->reported_by }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold small">MÔ TẢ</label>
                <textarea name="description" class="form-control" rows="3" required>{{ $issue->description }}</textarea>
            </div>
            <div class="row">
                <div class="col"><label class="fw-bold small">MỨC ĐỘ</label>
                    <select name="urgency" class="form-select">
                        <option value="Low" {{ $issue->urgency == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ $issue->urgency == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ $issue->urgency == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
                <div class="col"><label class="fw-bold small">TRẠNG THÁI</label>
                    <select name="status" class="form-select">
                        <option value="Open" {{ $issue->status == 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="In Progress" {{ $issue->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="Resolved" {{ $issue->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-4 py-2">CẬP NHẬT THAY ĐỔI</button>
        </form>
    </div>
</div>
@endsection
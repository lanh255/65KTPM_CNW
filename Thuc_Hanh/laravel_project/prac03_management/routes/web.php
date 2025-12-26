<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

// Tự động điều hướng trang chủ về danh sách vấn đề
Route::get('/', function () {
    return redirect()->route('issues.index');
});

// Định nghĩa đầy đủ các đường dẫn CRUD cho Issue
Route::resource('issues', IssueController::class);
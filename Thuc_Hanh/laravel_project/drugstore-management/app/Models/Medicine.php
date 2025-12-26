<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $primaryKey = 'medicine_id'; // Khai báo khóa chính theo đề
    
    protected $fillable = [
        'name', 'brand', 'dosage', 'form', 'price', 'stock'
    ]; // Cho phép lưu các cột này
}
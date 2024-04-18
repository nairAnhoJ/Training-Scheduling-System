<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WrittenExam extends Model
{
    use HasFactory;

    protected $table = 'tss_written_exams';

    public function questions()
    {
        return $this->hasMany(WrittenExamQuestion::class, 'exam_key', 'key');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['form_id', 'file_path', 'file_type'];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\District;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'fname',
        'lname',
        'contact',
        'district_id',
        'add_by',
        'edit_by',
        'created_at',
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    
    public function addby()
    {
        return $this->belongsTo(User::class, 'add_by', 'id');
    }

    public function editby()
    {
        if (!empty($this->edit_by)){
            return $this->belongsTo(User::class, 'edit_by', 'id');
        }
        
        return $this->belongsTo(User::class, 'add_by', 'id');
    }

    public static function search($search)
    {
        return empty($search)
        ? static::query()
        : static::query()->where('id', 'like', '%' . $search . '%')
            ->orWhere('title', 'like', '%' . $search . '%')
            ->orWhere('fname', 'like', '%' . $search . '%')
            ->orWhere('lname', 'like', '%' . $search . '%')
            ->orWhere('contact', 'like', '%' . $search . '%')
            ->orWhereHas('district', function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
    }
}

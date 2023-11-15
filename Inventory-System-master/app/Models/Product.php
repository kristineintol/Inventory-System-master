<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        "sloc_code",
        "material_code",
        "sloc_name",
        "description",
        "uom",
        "sap_qty",
        "ac_qty",
        "rec_qty",
        "variance_qty",
    ];

    public $sortable = [
        "sloc_code",
        "material_code",
        "sloc_name",
        "description",
        "uom",
        "sap_qty",
        "ac_qty",
        "rec_qty",
        "variance_qty",
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('sloc_name', 'like', '%' . $search . '%');
        });
    }
}

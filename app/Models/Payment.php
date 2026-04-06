<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Payment extends Model {
    protected $fillable = ["order_id","reference","amount","status","wompi_data"];
    protected function casts(): array { return ["wompi_data"=>"array"]; }
    public function order(): BelongsTo { return $this->belongsTo(Order::class); }
}
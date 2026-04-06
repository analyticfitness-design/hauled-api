<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model {
    use SoftDeletes;
    protected $fillable = ["sku","title","slug","description","price","price_usd","compare_price","discount","quantity","status","hauled_line","sizes","images","featured","is_active","stock","advance_percent","delivery_days","sell_count","category_id","brand_id"];
    protected $appends  = ['price_cop', 'price_usd_formatted'];
    protected function casts(): array { return ["sizes"=>"array","images"=>"array","featured"=>"boolean"]; }
    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function brand(): BelongsTo { return $this->belongsTo(Brand::class); }
    /** Precio COP formateado: "$ 541.800" */
    public function getPriceCopAttribute(): string { return '$ '.number_format($this->price / 100, 0, ',', '.'); }
    /** Precio USD formateado: "USD $129" */
    public function getPriceUsdFormattedAttribute(): string { return $this->price_usd ? 'USD $'.number_format($this->price_usd / 100, 0) : ''; }
    /** Precio final COP en centavos (aplicando descuento si existe) */
    public function getFinalPriceAttribute(): int { return $this->discount > 0 ? (int)($this->price * (1 - $this->discount / 100)) : $this->price; }
}
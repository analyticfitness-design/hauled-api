<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Encargo extends Model {
    protected $fillable = ["user_id","marca","producto","talla","color","link_referencia","presupuesto","anticipo","status","notas_cliente","notas_admin","wa_link"];
    public function user(): BelongsTo { return $this->belongsTo(User::class); }
    public function getStatusLabelAttribute(): string {
        return match($this->status) {
            "pendiente"=>"⏳ Pendiente de revisión",
            "cotizado"=>"💬 Cotizado — revisa WhatsApp",
            "aprobado"=>"✅ Aprobado",
            "en_camino"=>"🚚 En camino",
            "entregado"=>"📦 Entregado",
            "cancelado"=>"❌ Cancelado",
            default=>$this->status
        };
    }
}
<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'quotations';

    protected $dates = [
        'from',
        'to',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'client_id',
        'total',
        'from',
        'to',
        'validity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function quotationRents()
    {
        return $this->hasMany(Rent::class, 'quotation_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class);
    }

    public function clauses()
    {
        return $this->belongsToMany(RentalClause::class);
    }

    public function getFromAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFromAttribute($value)
    {
        $this->attributes['from'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getToAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setToAttribute($value)
    {
        $this->attributes['to'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

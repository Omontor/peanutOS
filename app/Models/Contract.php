<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'contracts';

    protected $dates = [
        'contract_date',
        'contract_deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contract_date',
        'contract_deadline',
        'from_id',
        'client_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getContractDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContractDateAttribute($value)
    {
        $this->attributes['contract_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getContractDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setContractDeadlineAttribute($value)
    {
        $this->attributes['contract_deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function from()
    {
        return $this->belongsTo(BasicData::class, 'from_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function static_clauses()
    {
        return $this->belongsToMany(StaticClause::class);
    }

    public function dynamic_clauses()
    {
        return $this->belongsToMany(DynamicClause::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

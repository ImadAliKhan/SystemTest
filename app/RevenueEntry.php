<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueEntry extends Model
{
      protected $fillable = [
        'name', 'date', 'description','revenue_type_id','amount'
    ];

  public function getDateAttribute() {
    return date('d-m-Y', strtotime($this->attributes['date']));
  }

  public function setDateAttribute($value) {
    $date_parts = explode('-', $value);
    $this->attributes['date'] = $date_parts[2].'-'.$date_parts[1].'-'.$date_parts[0];
  }

   public function revenue_type()

    {
        return $this->belongsTo('App\RevenueType');
    }
}

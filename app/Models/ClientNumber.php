<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientNumber extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'client_number';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['clientId', 'country_code', 'number', 'monthy_amount', 'status', 'apiId'];

  protected $dates = ['deleted_at'];

  public function post()
  {
    return $this->belongsTo(User::class);
  }
}

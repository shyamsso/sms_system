<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientSms extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $table = 'client_sms';

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['clientId', 'apikey', 'apisecret', 'status'];

  protected $dates = ['deleted_at'];
}

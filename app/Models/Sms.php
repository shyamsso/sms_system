<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'senderid',
    'reciverid',
    'message',
    'status',
    'response',
    'clientId',
    'messageId',
    'delivery_status',
    'message_amount',
    'message_comision_amount',
  ];
}

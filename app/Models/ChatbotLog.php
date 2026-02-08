<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotLog extends Model
{
    protected $table = 'chatbot_logs';
    public $timestamps = false;

    protected $fillable = [
        'session_id',
        'ip_address',
        'user_message',
        'bot_response',
        'model',
        'tokens_used',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}

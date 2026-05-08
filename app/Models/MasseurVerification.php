<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasseurVerification extends Model
{
    protected $table = 'masseurs_verifications';

    protected $fillable = [
        'user_id',
        'masseur_id',
        'image_path',
        'status',
        'comment',
        'reviewed_by',
        'reviewed_at',
        'submitted_by'
    ];

    // 🔹 Relation: Masseur
    public function masseur()
    {
        return $this->belongsTo(Masseur::class, 'masseur_id');
    }

    // 🔹 Relation: MC (Member)
    public function mc()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
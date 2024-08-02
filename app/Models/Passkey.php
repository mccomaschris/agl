<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Passkey extends Model
{
    use HasFactory;

	public function casts(): array
	{
		return [
			'data' => 'json',
		];
	}

	protected $fillable = ['name', 'credential_id', 'data'];

	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}
}

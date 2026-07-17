<?php

namespace App\Services;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class Operations
{
    static public function decryptId(string $encryptId): mixed
    {
        try {
            return Crypt::decrypt($encryptId);
        } catch (DecryptException $error) {
            Log::info($error->getMessage());
            return redirect()->route('home');
        }
    }
}

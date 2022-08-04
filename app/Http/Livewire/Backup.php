<?php

namespace App\Http\Livewire;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Backup extends Component
{
    public function render()
    {
        $path  = public_path('storage\backups');
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..'));

        return view('backend.backup',[
            'backups' => $files,
        ])->layout('layouts.backend.app');
    }
}

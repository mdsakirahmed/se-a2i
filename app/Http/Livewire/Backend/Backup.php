<?php

namespace App\Http\Livewire\Backend;

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
        ]);
    }

    public function db_backup(){
        // Artisan::call('cache:clear');
        try{
            Artisan::call('backup:run --only-db');
            toastr()->success('Successfully DB backup completed');
        }catch(Exception $exception){
            toastr()->error($exception->getMessage());
        }
        
    }
}

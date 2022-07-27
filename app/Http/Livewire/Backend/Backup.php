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

    public function local_db_update_by_latest_backup(){
        $path = public_path('storage\backups');
        $files = scandir($path, SCANDIR_SORT_DESCENDING);
        $latest_backup = $files[0];
        // dd($latest_backup);
        exec("unzip -z -j $path $path" . "/a.zip");
        exec("ls $path", $out);
        echo "Files in the archive:\n";
        foreach ($out as $file){
            $file = trim($file);
            // echo "File: $file,", filesize($path . "/" . $file)."b\n";
            dd("File: $file,", filesize($path . "/" . $file)."b\n");
        }
        exec("rm -rf $path");

        dd('Ok');
    }
}

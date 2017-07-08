<?php

namespace Ozgurince\Simpleforum\Jobs;

use Ozgurince\Simpleforum\Models\File;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UploadFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $files;
    protected $type;
    protected $filelable_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($files, $type, $filelable_id)   
    {
        //if u dont want to upload files in this function u need to write files to disk somewhere. Becuase we can’t pass an uploaded file instance to a job. 

        if ($type == "comment") {
            $file_name = $filelable_id . "-comment-file-" . uniqid();
            $filelable_type = "Ozgurince\Simpleforum\Models\Comment";
        }   
        elseif ($type == "question") {
            $file_name = $filelable_id . "-question-file-" . uniqid();
            $filelable_type = "Ozgurince\Simpleforum\Models\Question";
        }

        foreach ($files as $file) {           
            $name = $file_name;
            $extension = $file->getClientOriginalExtension();                
            $file->move(public_path().'/uploads/', $name.".".$extension);

            $newFile = new File;
            $newFile->filelable_id = $filelable_id;
            $newFile->filelable_type = $filelable_type;
            $newFile->path = '/uploads/' . $name.".".$extension;
            $newFile->save();
        }  
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    { 
        
    }
}

<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessGenerate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $data;
    public $tires = 3; 
   public $timeout = 600; 
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file_pdf= public_path("storage/{$this->data->file}");
        $output =  public_path("storage/{$this->data->folder}/{$this->data->kode_buku}".".jpg");
        \Storage::makeDirectory('public/' . $this->data->folder);
        exec("convert -verbose -density 150 -background white -alpha remove $file_pdf -quality 100 -sharpen 0x1.0 $output");

    }
}

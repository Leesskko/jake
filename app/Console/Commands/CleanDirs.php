<?php

namespace App\Console\Commands;

use App\Models\Video;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CleanDirs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:dirs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'sadfdsa';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $tds = Storage::disk('video')->directories();
        foreach ($tds as $t) {
            $dts = Storage::disk('video')->directories($t);
            $i = 0;
            foreach ($dts as $dt) {
                $pt = pathinfo($dt);
                $video = Video::where('mark', '=', $pt['basename'])->first();
                if (!$video) {
                    $i++;
                    console('成功删除' . $i . '个文件夹', 208);
                    Storage::disk('video')->deleteDir($dt);
                }
            }
        }
    }
}

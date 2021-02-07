<?php


namespace App\Console\Commands;


use App\Libs\RbcParceLib;
use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Contracts\Container\Container;

class ParceRbcNewsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'parce:rbc';


    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle() : void
    {
        $rbcLib = app()->make(RbcParceLib::class);

        News::truncate();

        $siteData = $rbcLib->getRawSiteData();

        if (preg_match_all("/<a[^>]+href=([\"']?)([^\\s\"']+)[^>]+class=\"news-feed__item[^>]+\\1/is", $siteData, $newsUrlList, PREG_SET_ORDER)) {
            foreach (array_column($newsUrlList, '2') as $url) {
                try {
                    $rbcLib->insertNewsItem($url);
                    $this->info($url . 'Was inserted');
                } catch (\Throwable $e) {
                    $this->info($url . 'Wasn\'t parced, check log');
                }
            }
        }

        $this->info('Finish!');
    }
}

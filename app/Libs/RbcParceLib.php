<?php


namespace App\Libs;


use App\Models\News;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class RbcParceLib
{
    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * RbcParceLib constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->httpClient = $client;
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     */
    public function getRawSiteData()
    {
        try {
            return $this->httpClient->get(config('app.rbc_url'))->getBody();
        } catch (\Throwable $e) {
            Log::error('site parce error');
        }
    }

    /**
     * @param string $url
     * @return News|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Throwable
     */
    public function insertNewsItem(string $url) : ?News
    {
        $data = $this->httpClient->get($url)->getBody();

        try {
            $newsItem = new News();
            if (preg_match('/<h1[^>]+>(.*)<\/h1>/si', $data, $title)) {
                $newsItem->title = $title[1];
            }

            if (preg_match("/<img[^>]+src=([\"']?)([^\\s\"']+)[^>]+class=\"article__main-image__image[^>]+\\1/is", $data, $image)) {
                $newsItem->image = $image[2];
            }

            $body = '';
            $regex = "/<div[^>]+class=([\"']?)([^\\s\"']+)[^>]+itemprop=\"articleBody\">(.*?)<\!--\sbody_median/si";
            preg_match_all($regex, $data, $text);
            $regex = "/<p>(.*?)<\/p>/s";
            preg_match_all($regex, $text[3][0], $text);
            foreach ($text[0] as $bodyItem) {
                $body .= strip_tags($bodyItem);
            }
            $newsItem->body = $body;

            if (preg_match("/<span[^>]+class=\"article__header__date[^>]+content=\"([A-Za-z0-9-:+]+)[\"]>/is", $data, $date)) {
                $newsItem->datetime = Carbon::parse(strtotime($date[1]));
            }
            $newsItem->url = $url;
            $newsItem->save();

            return $newsItem;
        } catch (\Throwable $e) {
            Log::error('news item wasn\'t parced ' . $url);
            throw $e;
        }
    }
}

<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App\Models
 * @property int $id
 * @property string $title
 * @property string $body
 * @property string $image
 * @property Carbon $datetime
 * @property string $url
 */
class News extends Model
{
    protected $table = 'news';

    /**
     * @var array
     */
    protected $casts = [
        'datetime' => 'datetime',
    ];
}

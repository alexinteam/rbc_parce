@if($news)
    <table cellspacing="2" border="1" cellpadding="5">
        @foreach($news as $newsItem)
                <tr>
                    <td>
                        {{$newsItem->title}}
                    </td>
                    <td>
                        {{Str::limit($newsItem->body, 200)}}
                    </td>
                    <td>
                        @if($newsItem->image)
                            <img src="{{$newsItem->image}}" height="100px" alt=""/>
                        @endif
                    </td>
                    <td>
                        <a href="{{$newsItem->url}}">
                            {{$newsItem->url}}
                        </a>
                    </td>
                    <td>
                        {{\Carbon\Carbon::parse($newsItem->datetime)->format('Y-m-d H:i')}}
                    </td>
                    <td>
                       <a href="{{route('news_item', ['id' => $newsItem->id])}}" class="button">
                            полная новость
                       </a>
                    </td>
                </tr>
        @endforeach
    </table>
@endif

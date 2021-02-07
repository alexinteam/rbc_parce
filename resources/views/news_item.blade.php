<table cellspacing="2" border="1" cellpadding="5">
    <tr>
        <td>
            {{$newsItem->title}}
        </td>
    </tr>
    <tr>
        <td>
            {{$newsItem->body}}
        </td>
    </tr>
    @if($newsItem->image)
    <tr>
        <td>
            <img src="{{$newsItem->image}}" height="300px" alt=""/>
        </td>
    </tr>
    @endif
    <tr>
        <td>
            <a href="{{$newsItem->url}}">
                {{$newsItem->url}}
            </a>
        </td>
    </tr>
    <tr>
        <td>
            {{\Carbon\Carbon::parse($newsItem->datetime)->format('Y-m-d H:i')}}
        </td>
    </tr>
</table>

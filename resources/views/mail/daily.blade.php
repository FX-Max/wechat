<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Message From Max Wechat</title>

    <h1>V2ex Hot Topic Today.</h1>

    @foreach ($data_topic as $topic_item)
        <li>
            <a target="_blank" href="{{$topic_item['url']}}">{{$topic_item['title']}}</a>
        </li>
    @endforeach

    <br/>
    <br/>

    <h1>V2ex Hot Topic Author Website.</h1>
    @foreach($data_author as $author_item)
        <li>
            {{$author_item['username']}} : <a target="_blank" href="{{$author_item['website']}}">{{$author_item['website']}}</a>
        </li>
    @endforeach

    <br/>
    <br/>

</head>
<body>

</body>
</html>
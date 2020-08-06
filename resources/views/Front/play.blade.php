<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sione | {{$post->title}}</title>
</head>

<body>
    <script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
    <link href="https://vjs.zencdn.net/7.7.6/video-js.css" rel="stylesheet" />
    <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/player.css')}}">
    <script src="https://vjs.zencdn.net/7.7.6/video.js"></script>
    <script src="{{asset('assets/js/player.js')}}"></script>
    <script src="{{asset('frontend/assets/js/videojs.ads.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/videojs-preroll.js')}}"></script>
    <link href="{{asset('frontend/assets/css/videojs-preroll.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('frontend/assets/css/videojs.watermark.css')}}" rel="stylesheet">
    <script src="{{asset('frontend/assets/js/videojs.watermark.js')}}"></script>

    <body>
        <section id="play" class="mt-5 position-relative">
            <video class="video-js vjs-big-play-centered vjs-16-9 vjs-theme-fantasy" controls preload="auto" id="player"
                controls>
                @foreach ($videos as $item)
                <source src="{{$item->url}}" type='video/mp4' label='{{$item->quality->name}}' />
                @endforeach
                @foreach ($post->captions as $key => $caption)
                <track kind='captions' src='{{$caption->url}}' srclang='{{$caption->lang}}' label='{{$post->lang}}' 
                    @if($key==0) default @endif />
                @endforeach
            </video>
        </section>
    </body>
    <script>
        $('#play .close').click(function(e){
         e.preventDefault()
         $(this).next('a').remove()
         $(this).remove()
       })
     var video = videojs('player');
     video.videoJsResolutionSwitcher()
    video.currentTime(localStorage.getItem('videoTime' + '{{$post->id}}')); 
      video.watermark({
         file: '{{asset("frontend/assets/images/s.png")}}',
         xpos: 1,
       ypos: 0,
       xrepeat:1,
       opacity: 0.5
     });
    function run_url_every_2seconds(){
      var whereYouAt = video.currentTime();
            localStorage.setItem('videoTime' + '{{$post->id}}' , whereYouAt);
            console.log(whereYouAt);
        } 
        video.on('play', function() {  
            setInterval(run_url_every_2seconds,2000);
        });
    </script>
    </section>
</body>

</html>
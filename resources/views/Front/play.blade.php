<!doctype html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>sione</title>
    <link href="https://vjs.zencdn.net/7.8.3/video-js.css" rel="stylesheet" />

    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>


    <link rel="stylesheet" href="assets/style.css">
</head>

<body>


    <div class="col-12 col-md-12 pb-3 justify-content-center text-center">

        <video id="my-video" class="video-js vjs-default-skin vjs-16-9" height="100%" controls data-setup='{}'>
            <source src="{{$video->first()->url}}" type='video/mp4' label='SD' res='480' />
            <!-- <source src="https://vjs.zencdn.net/v/oceans.mp4?hd" type='video/mp4' label='HD' res='1080' />
            <source src="https://vjs.zencdn.net/v/oceans.mp4?phone" type='video/mp4' label='phone' res='144' />
            <source src="https://vjs.zencdn.net/v/oceans.mp4?4k" type='video/mp4' label='4k' res='2160' /> -->
        </video>

     

    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.3/video.js"></script>
    <script>
        var options = {};

        videojs('my-video')
    </script>
</body>

</html>
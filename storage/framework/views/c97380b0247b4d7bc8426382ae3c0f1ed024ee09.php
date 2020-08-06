<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sione | <?php echo e($post->title); ?></title>
</head>

<body>
    <script src="<?php echo e(asset('frontend/assets/js/jquery-3.5.1.min.js')); ?>"></script>
    <link href="https://vjs.zencdn.net/7.7.6/video-js.css" rel="stylesheet" />
    <link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/player.css')); ?>">
    <script src="https://vjs.zencdn.net/7.7.6/video.js"></script>
    <script src="<?php echo e(asset('assets/js/player.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/videojs.ads.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/assets/js/videojs-preroll.js')); ?>"></script>
    <link href="<?php echo e(asset('frontend/assets/css/videojs-preroll.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('frontend/assets/css/videojs.watermark.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('frontend/assets/js/videojs.watermark.js')); ?>"></script>

    <body>
        <section id="play" class="mt-5 position-relative">
            <video class="video-js vjs-big-play-centered vjs-16-9 vjs-theme-fantasy" controls preload="auto" id="player"
                controls>
                <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <source src="<?php echo e($item->url); ?>" type='video/mp4' label='<?php echo e($item->quality->name); ?>' />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = $post->captions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $caption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <track kind='captions' src='<?php echo e($caption->url); ?>' srclang='<?php echo e($caption->lang); ?>' label='<?php echo e($post->lang); ?>' 
                    <?php if($key==0): ?> default <?php endif; ?> />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    video.currentTime(localStorage.getItem('videoTime' + '<?php echo e($post->id); ?>')); 
      video.watermark({
         file: '<?php echo e(asset("frontend/assets/images/s.png")); ?>',
         xpos: 1,
       ypos: 0,
       xrepeat:1,
       opacity: 0.5
     });
    function run_url_every_2seconds(){
      var whereYouAt = video.currentTime();
            localStorage.setItem('videoTime' + '<?php echo e($post->id); ?>' , whereYouAt);
            console.log(whereYouAt);
        } 
        video.on('play', function() {  
            setInterval(run_url_every_2seconds,2000);
        });
    </script>
    </section>
</body>

</html><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/play.blade.php ENDPATH**/ ?>
<section class="head-film-cover">
    <div class="cover-img-movies_movie-Page"></div>
    <img src="<?php echo e(asset($post->poster)); ?>" alt="">
    <div class="movie-details-header">
        <img src="<?php echo e(asset('front/assets/images/moviePage/movieName.png')); ?>" alt="">
        <h1>
            <?php echo e($post->title); ?>

        </h1>
        <div class="details_details">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3">
                        <div class="movie-year">
                            <?php echo e($post->year); ?>

                        </div>
                    </div>
                    <?php if($post->imdbRating): ?>
                    <div class="col-3">
                        <div class="IMDb_rank">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-6">
                                        <b><strong>IMDb</strong></b>
                                    </div>
                                    <div class="col-6"><?php echo e($post->imdbRating); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-3">
                        <div class="movie-like">
                            <i class="fa fa-heart"></i>
                            93%
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="site-dubbing">
                            <?php if($post->checkDubleFarsi()): ?>
                            <i class="fa fa-microphone"></i>
                            دوبله فارسی
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="movie-description">
            <?php echo e($post->description); ?>

        </p>
        <div class="list_like">
            <a href="#" class="addMovie_list text-white">
                <i class="fa fa-plus"></i>
                افزودن به لیست
            </a>

            <?php if($post->type == 'movies'): ?>
            <a href="<?php echo e($post->play()); ?>" class="addMovie_list text-white">
                <i class="fa fa-play"></i>
                پخش فیلم
            </a>
            <?php endif; ?>
            <!-- <i class="fas fa-thumbs-up"></i>
            <i class="fas fa-thumbs-down"></i> -->
        </div>

        <?php if(count($post->actors)): ?>
        <div class="movie-stars">
            ستارگان:
            <?php $__currentLoopData = $post->actors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <a href="#">
                <?php echo e($actor->name); ?>

            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>



        <div class="movie-age_rank">
            
            مناسب برای همه سنین
        </div>
    </div>
</section><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Front/TopPoster.blade.php ENDPATH**/ ?>
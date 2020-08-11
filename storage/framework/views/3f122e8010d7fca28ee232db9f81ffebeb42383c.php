<?php $__env->startSection('Title','فیلم ها'); ?>


<?php $__env->startSection('content'); ?>


<?php echo $__env->make('Includes.Front.DesktopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('Includes.Front.MobileSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('Includes.Front.TopSlider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(count($newmovies)): ?>
<section class="movie-sections">
    <h3>
        تازه ترین ها
    <a href="<?php echo e(route('S.ShowMore')); ?>?c=new&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newmovies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
            <?php $__env->startComponent('components.article',['model'=>$movie]); ?>
            <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>

<?php if(count($latestdoble)): ?>
<section class="movie-sections">
    <h3>
        دوبله فارسی
    <a href="<?php echo e(route('S.ShowMore')); ?>?c=doble&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $latestdoble; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <a href="#" data-id="1" onclick="showDetails(event,'<?php echo e($post->id); ?>','<?php echo e(route('GetMovieDetail')); ?>')">
                    <div class="movie-sections-box">
                        <div class="img-box-movies">
                            <img src="<?php echo e(asset($post->poster)); ?>" alt="<?php echo e($post->name); ?>">
                            <div class="cover-img-movies-details">
                                <span>
                                    <?php echo e($post->name); ?> -
                                    <?php if($post->type == "series"): ?>

                                    <?php echo e(\Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%Y')); ?>

                                    <?php else: ?>
                                    <?php echo e(\Morilog\Jalali\Jalalian::forge($post->released)->format('%Y')); ?>

                                    <?php endif; ?>
                                </span>
                                <span>
                                    <i class="fa fa-heart"></i>
                                    89%
                                </span>
                            </div>
                        </div>
                        <h5>
                            <?php echo e($post->title); ?>

                        </h5>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>



<?php if(count($newyear)): ?>
<section class="movie-sections">
    <h3>
        جدیدترین فیلم های <?php echo e($year); ?>

        <a href="<?php echo e(route('S.ShowMore')); ?>?c=<?php echo e($year); ?>&type=movie">
            مشاهده همه
            <i class="fa fa-angle-left"></i>
        </a>
    </h3>
    <div class="swiper-container IranNews">
        <div class="swiper-wrapper">
            <?php $__currentLoopData = $newyear; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide">
                <a href="#" data-id="1" onclick="showDetails(event,'<?php echo e($post->id); ?>','<?php echo e(route('GetMovieDetail')); ?>')">
                    <div class="movie-sections-box">
                        <div class="img-box-movies">
                            <img src="<?php echo e(asset($post->poster)); ?>" alt="<?php echo e($post->name); ?>">
                            <div class="cover-img-movies-details">
                                <span>
                                    <?php echo e($post->name); ?> -
                                    <?php if($post->type == "series"): ?>

                                    <?php echo e(\Morilog\Jalali\Jalalian::forge($post->first_publish_date)->format('%Y')); ?>

                                    <?php else: ?>
                                    <?php echo e(\Morilog\Jalali\Jalalian::forge($post->released)->format('%Y')); ?>

                                    <?php endif; ?>
                                </span>
                                <span>
                                    <i class="fa fa-heart"></i>
                                    89%
                                </span>
                            </div>
                        </div>
                        <h5>
                            <?php echo e($post->title); ?>

                        </h5>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
    <?php $__env->startComponent('components.showDetail'); ?>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/AllMovies.blade.php ENDPATH**/ ?>
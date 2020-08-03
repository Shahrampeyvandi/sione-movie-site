<?php $__env->startSection('Title',$title); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('Includes.Front.TopPoster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<section class="movie-trailer">
    <h1>
        تریلر، تصاویر و جزییات
    </h1>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $post->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-3 col-lg-2">
                <img src="<?php echo e(asset($image->url)); ?>" alt="<?php echo e($post->name); ?>">
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>
    <h2>
        <?php echo e($post->title); ?>

    </h2>
    <h3>
        درباره سریال <?php echo e($post->title); ?>

    </h3>

    <div class="col-12 movie-description-color">

        <?php echo $post->description; ?>

    </div>
    <h2>
        دسته بندی:
        <?php $__currentLoopData = $post->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($category->name); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </h2>

    <?php if(count($post->captions)): ?>
    <h2>
        زیرنویس:
        <?php $__currentLoopData = $post->captions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caption): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($caption->lang); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </h2>
    <?php endif; ?>
    <?php if(count($post->actors)): ?>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $post->actors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $actor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="col-3 col-lg-2 d-flex justify-content-center">
                <div class="star-img-box w-p-80">
                    <a href="#">
                        <?php if($actor->image): ?>

                        <img src="<?php echo e(asset($actor->image)); ?>" alt="<?php echo e($actor->name); ?>">
                        <?php else: ?>
                        <img src="<?php echo e(asset('assets/images/avatar.png')); ?>" alt="<?php echo e($actor->name); ?>">
                        <?php endif; ?>
                        <h4>
                            <?php echo e($actor->name); ?>

                        </h4>
                        <h5>
                            بازیگر
                        </h5>
                    </a>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>
    <?php endif; ?>
    <h3>
        تیم دوبلاژ
    </h3>
    
</section>
<?php if(count($relatedPosts)): ?>
<section class="movie-related">
    <h1>
        همچنین تماشا کنید
    </h1>
    <div class="container-fluid">
        <div class="row">
            <?php $__currentLoopData = $relatedPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-3 col-lg-2">
                <?php $__env->startComponent('components.article',['serie'=>$item]); ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        </div>
    </div>
</section>
<?php endif; ?>

<?php echo $__env->make('Includes.Front.Comments', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('Layout.Front', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\tm\resources\views/Front/ShowMovie.blade.php ENDPATH**/ ?>

    <a href="#" data-id="1" onclick="showDetails(event,'<?php echo e($model->id); ?>','<?php echo e(route('GetMovieDetail')); ?>')">
        <div class="movie-sections-box">
            <div class="img-box-movies">
                <img src="<?php echo e(asset($model->poster)); ?>" alt="<?php echo e($model->name); ?>">
                <div class="cover-img-movies-details">
                    <span>
                        <?php echo e($model->name); ?> -
                        <?php if($model->type == 'series'): ?>
                        <?php echo e(\Morilog\Jalali\Jalalian::forge($model->first_publish_date)->format('%Y')); ?>

                        <?php else: ?> 
                        <?php echo e(\Morilog\Jalali\Jalalian::forge($model->released)->format('%Y')); ?>

                        <?php endif; ?>
                    </span>
                    <span>
                        <i class="fa fa-heart"></i>
                        89%
                    </span>
                </div>
            </div>
            <h5>
                <?php echo e($model->title); ?>

            </h5>
        </div>
    </a>
<?php /**PATH C:\xampp\htdocs\tm\resources\views/components/article.blade.php ENDPATH**/ ?>
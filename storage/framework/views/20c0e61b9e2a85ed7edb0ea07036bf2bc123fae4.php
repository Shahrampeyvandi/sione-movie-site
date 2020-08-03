<header>
    <div class="cover-menu"></div>
    <nav class="siteNav">
        <div class="navBar">
            <div class="menu-button">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <ul class="navList">
                <li class="navItem logo">
                    <a href="<?php echo e(route('MainUrl')); ?>">
                        LOGO
                    </a>
                </li>
                <li class="navItem">
                    <a href="<?php echo e(route('MainUrl')); ?>" class="
                        <?php if(\Request::route()->getName() == " MainUrl"): ?> <?php echo e('active-nav'); ?> <?php endif; ?> ">
                            <i class=" far fa-home"></i>
                        خانه
                    </a>
                </li>
                <li class="navItem">
                    <a href="<?php echo e(route('AllMovies')); ?>" class="
                    <?php if(\Request::route()->getName() == " AllMovies"): ?> <?php echo e('active-nav'); ?> <?php endif; ?>">
                        <i class="far fa-camera-movie"></i>
                        فیلم ها
                    </a>
                </li>
                <li class="navItem">
                    <a href="<?php echo e(route('AllSeries')); ?>" class="
                    <?php if(\Request::route()->getName() == " AllSeries"): ?> <?php echo e('active-nav'); ?> <?php endif; ?>">
                        <i class="fa fa-tv"></i>
                        سریال ها
                    </a>
                </li>
                <li class="navItem">
                    <a href="<?php echo e(route('Categories')); ?>" class="
                    <?php if(\Request::route()->getName() == " Categories"): ?> <?php echo e('active-nav'); ?> <?php endif; ?>">
                        <i class="fa fa-cloud"></i>
                        دسته بندی
                    </a>
                </li>

                <li class="navItem">
                    <a href="<?php echo e(route('Childrens')); ?>" class="
                    <?php if(\Request::route()->getName() == " Childrens"): ?> <?php echo e('active-nav'); ?> <?php endif; ?>">
                        <i class="fa fa-child"></i>
                        کودکان
                    </a>
                </li>

                <li class="navItem">
                    <a href="Blog/index.html">
                        <i class="fa fa-fire"></i>
                        وبلاگ
                    </a>
                </li>
            </ul>
            <div class="menu-item-left_nav">
                <!--                <div class="login-register">-->
                <!--                    <a href="login_register.html">-->
                <!--                        ورود / ثبت نام-->
                <!--                    </a>-->
                <!--                </div>-->
                <div class="user-login-show">
                    <i class="fa fa-user-circle"></i>
                </div>
                <div class="profile-dropdown-box">
                    <ul>
                        <li>
                            <a href="profile.html">
                                <i class="fa fa-user-circle"></i>
                                <span>
                                    <?php if(isset($user)): ?>
                                    <?php echo e($user->name()); ?>

                                    <?php endif; ?>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('S.BuyPlan')); ?>">
                                <i class="fa fa-shopping-bag"></i>
                                <span>
                                    خرید اشتراک
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-list"></i>
                                <span>
                                    لیست علاقه مندی ها
                                </span>
                            </a>
                        </li>
                        <?php if($user->type() == 'moshtarak'): ?>
                        <li>
                            <a href="<?php echo e(route('logout-user')); ?>">
                                <i class="fa fa-power-off"></i>
                                <span>
                                    خروج
                                </span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
                <a  class="buy-subscribe inbox-icon"  href="#" >
                    <i class="fa fa-envelope"></i>
                </a>
                <div class="inbox close">
                    <ul>
                        <li>
                            <p>
                               شما میتوانید با مراجعه به یکی از شعب اشتراک سه روزه با قیمت 30000 تومان برای شما فعال شد 
                            </p>
                            <span >11/2/99</span>
                        </li>
                    </ul>
                </div>
                <div id="search-box">
                    <i class="far fa-search"></i>
                </div>
                <?php echo $__env->make('Includes.Front.Search', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </nav>
</header><?php /**PATH C:\xampp\htdocs\tm\resources\views/Includes/Front/Header.blade.php ENDPATH**/ ?>
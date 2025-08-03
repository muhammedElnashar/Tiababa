
    
  <header class="bg-light profile_header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light bg-light pt-3 pb-3">
          <a class="navbar-brand mr-lg-5" href="<?php echo base_url() ?>">
              <img src="<?php echo base_url(settings()->logo) ?>" alt="logo">
          </a>

          <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
              <span class="navbar-toggler-icon"></span>
          </button>

          <!-- Menu -->
          <div id="navbarContent" class="collapse navbar-collapse">

            
            <ul class="navbar-nav align-items-lg-center ml-lg-auto">

                <li class="nav-item"><a href="<?php echo base_url('profile/user/'.$user->slug) ?>" class="nav-link  <?php if(isset($page_title) && $page_title == $user->name){echo "active";} ?>"><?php echo trans('home') ?></a></li>

                <li class="nav-item"><a href="<?php echo base_url('profile/about/'.$user->slug) ?>" class="nav-link <?php if(isset($page_title) && $page_title == "About Us"){echo "active";} ?>"><?php echo trans('about') ?></a></li>
              
                <?php if (check_user_feature_access('services', $user->id) == TRUE): ?>
                  <li class="nav-item"><a href="<?php echo base_url('profile/services/'.$user->slug) ?>" class="nav-link  <?php if(isset($page_title) && $page_title == "Services"){echo "active";} ?>"><?php echo trans('services') ?></a></li>
                <?php endif; ?>
                
                <li class="nav-item"><a href="<?php echo base_url('profile/contact/'.$user->slug) ?>" class="nav-link <?php if(isset($page_title) && $page_title == "Contact"){echo "active";} ?>"><?php echo trans('contact') ?></a></li>

                <?php if (check_user_feature_access('blogs', $user->id) == TRUE): ?>
                  <li class="nav-item"><a href="<?php echo base_url('profile/blogs/'.$user->slug) ?>" class="nav-link  <?php if(isset($page_title) && $page_title == "Blogs"){echo "active";} ?>"><?php echo trans('blogs') ?></a></li>
                <?php endif; ?>


                <?php if (settings()->enable_multilingual == 1): ?>
                    <li class="nav-item dropdown mr-5">
                        <a href="javascript:void(0);" data-toggle="dropdown" class="nav-link dropdown-toggle"><?php echo lang_short_form(); ?></a>
                        <ul class="dropdown-menu shadow">
                            <?php foreach (get_language() as $lang): ?>
                                <li><a class="dropdown-item" href="<?php echo base_url('home/switch_lang/'.$lang->slug) ?>"><?php echo html_escape($lang->name) ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                <?php endif ?>

                <li class="nav-item mr-0">
                    <?php if (is_admin()): ?>
                      <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo prep_url($site_url.'auth/logout') ?>"><i class="icon-logout"></i> <?php echo trans('logout') ?> </a>

                      <a class="btn btn-sm btn-light-primary ml-auto" href="<?php echo prep_url($site_url.'admin/dashboard') ?>"><i class="icon-speedometer mr-1"></i> <?php echo trans('dashboard') ?></a>
                    <?php elseif(is_user()): ?>

                      <a class="btn btn-sm btn-light-secondary ml-auto" href="<?php echo prep_url($site_url.'auth/logout') ?>"><i class="icon-logout"></i> <?php echo trans('logout') ?> </a>

                      <a class="btn btn-sm btn-light-primary ml-auto" href="<?php echo prep_url($site_url.'admin/dashboard/user') ?>"><i class="icon-speedometer mr-1"></i> <?php echo trans('dashboard') ?></a>

                      
                       
                    <?php else: ?>
                      <a class="btn btn-sm btn-light-primary ml-auto" href="<?php echo prep_url($site_url.'login') ?>"><?php echo trans('sign-in') ?></a>
                    <?php endif ?>
                </li>
            </ul>

          </div>
          <!-- End Menu -->

      </nav>
    </div>
  </header>
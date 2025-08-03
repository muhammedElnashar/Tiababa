<li class="treeview <?php if(isset($page) && $page == "Prescription Settings"){echo "active";} ?>">
  <a href="#"><i class='bx bx-cog' ></i>
    <span><?php echo trans('prescription') ?> <?php echo trans('settings') ?></span>
    <span class="pull-right-container">
      <i class="fa fa-angle-right pull-right"></i>
    </span>
  </a>
  <ul class="treeview-menu">

    <?php if (check_feature_access('diagnosis') == TRUE): ?>
    <li class="<?php if(isset($page_title) && $page_title == "Diagonosis"){echo "active";} ?>">
      <a href="<?php echo base_url('admin/diagonosis') ?>">
        <i class='bx bx-right-arrow-alt' ></i> <span><?php echo trans('clinical-diagnosis') ?></span>
      </a>
    </li>
    <?php endif; ?>


    <?php if (check_feature_access('advise') == TRUE): ?>
    <li class="<?php if(isset($page_title) && $page_title == "Advise"){echo "active";} ?>">
      <a href="<?php echo base_url('admin/advises') ?>">
        <i class='bx bx-right-arrow-alt' ></i> <span><?php echo trans('advise') ?></span>
      </a>
    </li>
    <?php endif; ?>

    
    <li class="<?php if(isset($page_title) && $page_title == "Additional Advise"){echo "active";} ?>">
      <a href="<?php echo base_url('admin/additional_advises') ?>">
        <i class='bx bx-right-arrow-alt' ></i> <span><?php echo trans('additional-advices') ?></span>
      </a>
    </li>
    
    
    <li class="<?php if(isset($page_title) && $page_title == "Advise investigation"){echo "active";} ?>">
      <a href="<?php echo base_url('admin/advise_investigation') ?>">
        <i class='bx bx-right-arrow-alt' ></i> <span><?php echo trans('diagnosis-tests') ?></span>
      </a>
    </li>
  </ul>
</li> 
<div class="content-wrapper">
  
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/domain/update_settings')?>" role="form" novalidate>
          <div class="card ">
            <div class="card-header with-border">
              <h3 class="card-title"><?php echo trans('domain-settings') ?></h3>
            </div>

            <div class="card-body">
              <div class="form-group">
                <label><?php echo trans('title') ?></label>
                <input type="text" class="form-control" name="title" value="<?php if(!empty($settings)){echo  $settings->title;} ?>"  required>
              </div>

            
              <div class="form-group">
                <label><?php echo trans('short-details') ?></label>
                <input type="text" class="form-control" name="short_details" value="<?php   if(!empty($settings)){echo  $settings->short_details;} ?>"  required>
              </div>
            
            
              <div class="form-group">
                <label><?php echo trans('details') ?></label>
                <textarea class="form-control ckeditor"  name="details"  rows="4"
                ><?php  if(!empty($settings)){echo $settings->details;} ?></textarea>
              </div>


              <div class="form-group">
                <label class=""><?php echo trans('server-ip-address') ?></label>
                <input type="text" class="form-control" name="ip" value="<?php   if(!empty($settings)){echo $settings->ip;} ?>" required>
                <p class="badge badge-primary-soft mb-1 mt-2 font-weight-normal fs-12"><i class="fa fa-info-circle"></i> <?php echo trans('ip-help-info') ?></p>
              </div>

            
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('type1') ?></label>
                    <input type="text" class="form-control" name="type1" value="<?php   if(!empty($settings)){echo  $settings->type1;} ?>" required>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('host1') ?></label>
                    <input type="text" class="form-control" name="host1" value="<?php  if(!empty($settings)){echo  $settings->host1;} ?>" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('value1') ?></label>
                    <input type="text" class="form-control" name="value1" value="<?php  if(!empty($settings)){echo  $settings->value1;} ?>" required>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('ttl1') ?></label>
                    <input type="text" class="form-control " name="ttl1" value="<?php  if(!empty($settings)){echo  $settings->ttl1;} ?>" required>
                  </div>
                </div>
              </div>


           
              <div class="row">

                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('type2') ?></label>
                    <input type="text" class="form-control" name="type2" value="<?php  if(!empty($settings)){echo  $settings->type2;} ?>" required>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('host2') ?></label>
                    <input type="text" class="form-control" name="host2" value="<?php  if(!empty($settings)){echo  $settings->host2;} ?>" required>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('value2') ?></label>
                    <input type="text" class="form-control" name="value2" value="<?php  if(!empty($settings)){echo  $settings->value2;} ?>" required>
                  </div>
                </div>
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label><?php echo trans('ttl2') ?></label>
                    <input type="text" class="form-control" name="ttl2" value="<?php  if(!empty($settings)){echo  $settings->ttl2;} ?>" required>
                  </div>
                </div>
              </div>

            </div>
          </div>
            
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <input type="hidden" name="user_id" value="<?php  if(!empty($settings)){echo  $settings->id;} ?>" ?>
          <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save-changes') ?></button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row_col hide_<?= $id?>">
	<div class="row">
		<div class="form-group col-sm-4">
			<label class="control-label p-0" for="example-input-normal"><?php echo trans('drugs') ?> <span class="text-danger">*</span></label>
			<div class="d_flex">
				<select class="form-control select2" name="drugs[]" required>
					<option value=""><?php echo trans('select-drug') ?></option>
					<?php foreach ($drugs as $drug): ?>
						<option value="<?php echo html_escape($drug->id); ?>">
							<?php echo html_escape($drug->name); ?>
						</option>
					<?php endforeach ?>
				</select> 
			</div>
		</div>
	</div>
	<div class="row"> 
		<div class="form-group col-sm-4">
          <div class="d_flex_input">
	            <select name="time_periods<?= $id; ?>[]" class="form-control" id="">
	              <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
	            </select>

	            <select name="time_periods<?= $id; ?>[]" class="form-control" id="">
	              <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
	            </select>

	            <select name="time_periods<?= $id; ?>[]" class="form-control" id="">
	              <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
	            </select>

	            <select name="time_periods<?= $id; ?>[]" class="form-control" id="">
	              <option value=""></option>
                  <option value="0">0 </option>
                  <option value="½">½ </option>
                  <option value="1">1 </option>
                  <option value="2">2 </option>
                  <option value="3">3</option>
                  <option value="4">4 </option>
	            </select>
          </div>
		</div>

		<div class="form-group col-sm-3">
			<div class="d_flex">
				<select name="duration_text<?= $id; ?>[]" class="form-control" id="">
	                <option value=""><?php echo trans('select') ?></option>
	                <?php foreach (get_dates() as $dates): ?>
	                	<option value="<?php echo html_escape($dates); ?>"><?php echo html_escape($dates); ?> </option>
	                <?php endforeach ?>
	            </select>
				<select name="duration<?= $id; ?>[]" class="form-control" id="">
					<option value=""><?php echo trans('time') ?></option>
                    <option value="Continue"><?php echo trans('continue') ?> </option>
                    <option value="Days"><?php echo trans('days') ?> </option>
                    <option value="Months"><?php echo trans('months') ?></option>
                    <option value="Years"><?php echo trans('years') ?> </option>
				</select>
			</div>
		</div>

		<div class="form-group col-sm-2">
			<select name="medicine_time<?= $id; ?>[]" class="form-control" id="">
				<option value=""><?php echo trans('beforeafter-meals') ?></option>
                <option value="After Meal"><?php echo trans('after-meal') ?></option>
    			<option value="Before Meal"><?php echo trans('before-meal') ?> </option>
			</select>
		</div>

		<div class="form-group col-sm-3">
			<div class="d_flex">
				<input type="text" name="note<?= $id; ?>[]" class="form-control" placeholder="Enter Note">
				<button type="button" title="Add new row" class="btn btn-light-primary add_increase_button" data-id='<?= $id;?>'><i class="fa fa-plus"></i></button>
				<button type="button"  class="btn btn-light-danger remove_field" data-id='<?= $id;?>'><i class="fa fa-close"></i></button>
			</div>
		</div>
	</div>
	<div class="drug_details_increase_field_<?= $id;?>"></div>
</div>
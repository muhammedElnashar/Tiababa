<label><?php echo trans('patient-name') ?> <span class="text-danger">*</span></label>
<select name="patient_name" id="patients" class="form-control select2">
	<option value=""><?php echo trans('select-patient') ?> </option>
	<?php foreach ($patients as $pt): ?>
		<?php if (empty($prescription)): ?>
			<option <?php if(isset($patient_id) && $patient_id == $pt->id){echo "selected";} ?> value="<?= $pt->id; ?>"><?= '<b>'.$pt->name.'</b> - '.$pt->mr_number.' - '.$pt->mobile;?></option>
		<?php else: ?>
			<option <?php if($prescription['patient_id'] == $pt->id){echo "selected";} ?> value="<?= $pt->id; ?>"><?= '<b>'.$pt->name.'</b> - '.$pt->mr_number.' - '.$pt->mobile;?></option>
		<?php endif ?>
	<?php endforeach ?>
</select>
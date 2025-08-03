<?php if (empty($times)): ?>
	<p><?php echo trans('schedule-not-available') ?></p>
<?php else: ?>
	<?php if (isset($page) && $page != 'Appointment'): ?>
		<p class="pick-date"><?php echo trans('pick-appointment-time-for') ?>  <span><?php echo my_date_show($date) ?></span></p>
	<?php endif ?>

	<?php foreach ($times as $time): ?>
		<?php $check = check_time($time->time, $date) ?>
		<div class="btn-group" data-aos="fade-in">
		    <label class="btn btn-light-primary btn-sm time_btn <?php if($check == TRUE){echo 'disabled';} ?>">
		      <input type="radio" class="time_inp" value="<?php echo $time->time ?>" name="time" autocomplete="off"> <?php echo $time->time ?>
		    </label>
		</div>
	<?php endforeach ?>
<?php endif ?>
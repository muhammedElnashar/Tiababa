
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container">

    <div class="col-md-10 offset-md-1">
  
        <div class="box list_area">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-video-camera"></i> Your Live Consultants </h3>
          </div>

          <div class="box-body">
            
            <div class="col-md-12 col-sm-12 col-xs-12 scroll">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Doctors Info</th>
                            <th>Schedule</th>
                            <th>Meeting Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i=1; foreach ($consults as $consult): ?>
                        <tr id="row_<?php echo html_escape($consult->id); ?>">
                            
                            <td><?= $i; ?></td>
                            <td>
                                <p class="mt-0 mb-5"><strong><?php echo html_escape($consult->dr_name); ?></strong></p>
                                <p class="mt-0 mb-5"><strong>Chamber: <?php echo html_escape($consult->chamber); ?></strong></p>
                            </td>
                            <td>
                                <p class="mt-0 mb-5"><span class="badge badge-pill badge-primary-soft"> Date: <?php echo html_escape($consult->date); ?></span></p>
                                <p class="mt-0 mb-5"><span class="badge badge-pill badge-primary-soft"> Time: <?php echo html_escape($consult->time); ?></span></p>
                            </td>
                            <td>
                                <?php if (!empty($consult->meeting_notes)): ?>
                                  <a href=""><p class="mt-0 mb-5"><?= $consult->meeting_notes; ?></p></a>
                                <?php endif ?>

                                <?php if (!empty($consult->files)): ?>
                                  <a href=""><p class="mt-0 mb-5">Attachment: <?php echo html_escape($consult->files); ?></p></a>
                                <?php endif ?>
                            </td>
                            
                            <td class="actions" width="12%">
                              <a href="<?php echo base_url('admin/live_consults/edit/'.html_escape($consult->id));?>" class="btn btn-primary brd-20" data-placement="top" title="Edit"><i class="fa fa-play-circle"></i> Join</a>
                            </td>
                        </tr>
                        
                      <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>

          </div>

          
        </div>

    </div>
  </section>
</div>

<section class="pt-6">
    <div class="container">

        <div class="row">
            <div class="col-md-10 col-lg-9 col-xl-8 mx-md-auto">
                <?php if (empty($faqs)): ?>
                    <?php include'include/not_found_msg.php'; ?>
                </div>
            </div>
        <?php else: ?>

        <div class="text-center mx-md-auto mb-5 mb-md-7 mb-lg-9">
            <h2><?php echo trans('frequently-asked-questions') ?></h2>
        </div>

        <div class="row">
            <?php $i=1; foreach ($faqs as $row): ?>
                <div class="col-md-12 col-lg-12 col-xl-12 shadow-sm">
                    <div class="accordion" id="accordion<?= $i; ?>">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link mb-0 text-dark collapsed" type="button" data-toggle="collapse" data-target="#collapse<?= $i; ?>" aria-expanded="false" aria-controls="collapse<?= $i; ?>">
                                      <?php echo html_escape($row->title); ?>
                                    </button>
                                </h2>
                            </div>

                            <div id="collapse<?= $i; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion<?= $i; ?>" style="">
                                <div class="card-body line-height-lg p-0 mt-3">
                                    <?= ($row->details); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php $i++; endforeach; ?>
        </div>

        <?php endif; ?>

    </div>
</section>
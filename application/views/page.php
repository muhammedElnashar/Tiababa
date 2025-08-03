<section class="section pt-6">
    <div class="container">
        <div class="section-heading section-heading--center">
            <h2 class="__title"><span><?php echo html_escape($page->title) ?></span></h2>
        </div>

        <div class="spacer py-2"></div>

        <div class="row">
            <div class="col-12">

                <div class="content-container">
                    <div class="faq">
                        <div class="accordion-container">
                            <p><?= $page->details ?></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
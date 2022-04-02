<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= $Lang->get('CONFIG__GENERAL_PREFERENCES') ?></h3>
                </div>
                <div class="card-body">

                    <form method="post">

                        <div class="nav-tabs-custom">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link text-dark active" href="#tab_1" data-toggle="tab" aria-expanded="true"><?= $Lang->get('CONFIG__GENERAL_PREFERENCES') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" href="#tab_2" data-toggle="tab" aria-expanded="false"><?= $Lang->get('CONFIG__OTHER_PREFERENCES') ?></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab_1">

                                    <div class="form-group">
                                        <label><?= $Lang->get('CONFIG__KEY_NAME') ?></label>
                                        <?= $this->Form->input(false, [
                                            'div' => false,
                                            'type' => 'text',
                                            'name' => 'name',
                                            'class' => 'form-control',
                                            'value' => $config['name']
                                        ]); ?>
                                    </div>

                                    <?php if ($shopIsInstalled) { ?>

                                        <div class="form-group">
                                            <label><?= $Lang->get('CONFIG__KEY_MONEY_NAME_SINGULAR') ?></label>
                                            <?= $this->Form->input(false, [
                                                'div' => false,
                                                'type' => 'text',
                                                'name' => 'money_name_singular',
                                                'class' => 'form-control',
                                                'value' => $config['money_name_singular']
                                            ]); ?>
                                        </div>

                                        <div class="form-group">
                                            <label><?= $Lang->get('CONFIG__KEY_MONEY_NAME_PLURAL') ?></label>
                                            <?= $this->Form->input(false, [
                                                'div' => false,
                                                'type' => 'text',
                                                'name' => 'money_name_plural',
                                                'class' => 'form-control',
                                                'value' => $config['money_name_plural']
                                            ]); ?>
                                        </div>

                                    <?php } ?>

                                    <?= $this->Html->script('bootstrap-4/plugins/bootstrap-select/bootstrap-select.min.js') ?>
                                    <?= $this->Html->css('bootstrap-4/plugins/bootstrap-select/bootstrap-select.min.css') ?>

                                    <div class="form-group">
                                        <label><?= $Lang->get('CONFIG__KEY_LANG') ?></label>
                                        <div class="form-group">
                                            <?= $this->Form->input(false, [
                                                'div' => false,
                                                'data-live-search' => 'true',
                                                'name' => 'lang',
                                                'class' => 'selectpicker',
                                                'options' => $config['languages_available'],
                                                'selected' => $config['lang']
                                            ]); ?>
                                            <a href="<?= $this->Html->url(['action' => 'editLang']) ?>"
                                               class="btn btn-info"><?= $Lang->get('CONFIG__EDIT_LANG_FILE') ?></a>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label><?= $Lang->get('CONFIG__KEY_VERSION') ?></label>
                                        <input type="text" value="<?= file_get_contents(ROOT . DS . 'VERSION') ?>"
                                               class="form-control disabled" disabled>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane fade" id="tab_2">

                                    <div class="form-group">
                                        <label><?= $Lang->get('CONFIG__KEY_CAPTCHA_TYPE') ?></label>
                                        <div class="radio">
                                            <input type="radio" name="captcha_type"
                                                   value="1" <?= ($config['captcha_type'] == '1') ? 'checked=""' : '' ?>>
                                            <label><?= $Lang->get('GLOBAL__TYPE_NORMAL') ?></label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="captcha_type"
                                                   value="2" <?= ($config['captcha_type'] == '2') ? 'checked=""' : '' ?>>
                                            <label><?= $Lang->get('CONFIG__TYPE_CAPTCHA_GOOGLE') ?></label>
                                        </div>

                                        <div class="radio">
                                            <input type="radio" name="captcha_type"
                                                   value="3" <?= ($config['captcha_type'] == '3') ? 'checked=""' : '' ?>>
                                            <label><?= $Lang->get('CONFIG__TYPE_CAPTCHA_HCAPTCHA') ?></label>
                                        </div>
                                    </div>

                                    <script type="text/javascript">
                                        $('input[name="captcha_type"]').on('change', function (e) {
                                            if ($(this).val() == '2' || $(this).val() == '3') {
                                                $('#captcha').slideDown(250);
                                            } else {
                                                $('#captcha').slideUp(250);
                                            }
                                        });
                                    </script>

                                    <div id="captcha"
                                         style="display:<?= ($config['captcha_type'] == '2' || $config['captcha_type'] == '3') ? 'block' : 'none' ?>;">
                                        <div class="form-group">
                                            <label><?= $Lang->get('CONFIG__KEY_CAPTCHA_SITEKEY') ?></label>
                                            <?= $this->Form->input(false, [
                                                'div' => false,
                                                'type' => 'text',
                                                'name' => 'captcha_sitekey',
                                                'class' => 'form-control',
                                                'value' => $config['captcha_sitekey'],
                                            ]); ?>
                                        </div>

                                        <div class="form-group">
                                            <label><?= $Lang->get('CONFIG__KEY_CAPTCHA_SECRET') ?></label>
                                            <?= $this->Form->input(false, [
                                                'div' => false,
                                                'type' => 'text',
                                                'name' => 'captcha_secret',
                                                'class' => 'form-control',
                                                'value' => $config['captcha_secret'],
                                            ]); ?>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label><?= $Lang->get('CONFIG__KEY_GOOGLE_ANALYTICS') ?></label>
                                        <?= $this->Form->input(false, [
                                            'div' => false,
                                            'type' => 'text',
                                            'name' => 'google_analytics',
                                            'class' => 'form-control',
                                            'value' => $config['google_analytics'],
                                            'maxlength' => '15'
                                        ]); ?>
                                    </div>

                                    <hr>

                                    <div class="form-group">
                                        <label><?= $Lang->get('CONFIG__KEY_END_LAYOUT_COE') ?></label>
                                        <?= $this->Form->textarea(false, [
                                            'div' => false,
                                            'rows' => '5',
                                            'type' => 'text',
                                            'name' => 'end_layout_code',
                                            'class' => 'form-control',
                                            'value' => $config['end_layout_code']
                                        ]); ?>
                                    </div>

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>

                        <input type="hidden" name="data[_Token][key]" value="<?= $csrfToken ?>">

                        <button class="btn btn-primary" type="submit"><?= $Lang->get('GLOBAL__SUBMIT') ?></button>
                        <a href="<?= $this->Html->url(['controller' => '', 'action' => '', 'admin' => true]) ?>"
                           type="button" class="btn btn-default"><?= $Lang->get('GLOBAL__CANCEL') ?></a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

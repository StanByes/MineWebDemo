<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $Lang->get('GLOBAL__ADMIN_PANEL'); ?> <small>Version 3.0</small></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a
                                href="<?= $this->Html->url('/') ?>"><?= $Lang->get('GLOBAL__HOME'); ?></a></li>
                    <li class="breadcrumb-item active"><?= $Lang->get('GLOBAL__ADMIN_PANEL'); ?></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <?= $Theme->displayAvailableUpdate() ?>
    <?= $EyPlugin->displayAvailableUpdate() ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title"><?= $Lang->get('DASHBOARD__LAST_ACTIONS') ?></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <th><?= $Lang->get('GLOBAL__ACTIONS') ?></th>
                            <th><?= $Lang->get('GLOBAL__CATEGORY') ?></th>
                            <th><?= $Lang->get('GLOBAL__CREATED') ?></th>
                            <th><?= $Lang->get('GLOBAL__AUTHOR') ?></th>
                        </tr>
                        <?php foreach ($History->get(false, 5) as $k => $v) { ?>
                            <tr>
                                <td><?= $Lang->history($v['History']['action']) ?></td>
                                <td><?= $v['History']['category'] ?></td>
                                <td><?= $Lang->date($v['History']['created']) ?></td>
                                <td><?= $v['History']['author'] ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

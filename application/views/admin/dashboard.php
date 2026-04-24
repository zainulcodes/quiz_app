<div class="wrapper">
    <div class="row">
        <div class="col-md-6">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3><?= $total_users ?></h3>
                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="<?= base_url('admin/users') ?>" class="small-box-footer">
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3><?= $total_soal ?></h3>
                    <p>Soal</p>
                </div>
                <div class="icon">
                    <i class="fas fa-book"></i>
                </div>
                <a href="<?= base_url('admin/questions') ?>" class="small-box-footer">
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
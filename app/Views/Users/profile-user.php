<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>
<div class="card mt-3 shadow-sm">
    <div class="card-body m-2">
        <div class="tab-content pt-2">

            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <div class="col-md-6">

                    <h5 class="card-title">About</h5>
                    <img src="<?= base_url() ?>/assets/img/user-default.png" width="200" alt="">
                    <!-- <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p> -->
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Profile Details</h5>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Username</div>
                        <div class="col-lg-9 col-md-8">: <?= ucfirst($_SESSION['username']) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Full Name</div>
                        <div class="col-lg-9 col-md-8">: <?= ucfirst($_SESSION['nama']) ?></div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8">: <?= ucfirst($_SESSION['email']) ?></div>
                    </div>
                    <h5 class="card-title">Level User</h5>
                    <ul>
                        <li>
                            <?= $_SESSION['role'] == 1 ? 'Administrator' : 'User' ?>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <?= $this->endSection('content') ?>
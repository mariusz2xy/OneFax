<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="page-top">
<?php $this->beginBody() ?>
        <div id="wrapper">

        <?php if(!Yii::$app->user->isGuest){?>
        <!-- Start of Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon">
                    <img src="/onenumber.png" style="width: 50%;">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading  -->
            <div class="sidebar-heading">
                Faxy
            </div>

            <!-- Nav Item  -->
            <li class="nav-item">
                <a class="nav-link" href="/faxes-list/index">
                    <i class="fas fa-fw fa-list-ul"></i>
                    <span>Lista faxów</span></a>
            </li>
           <li class="nav-item ">
                <a class="nav-link" href="/phonebook/index">
                    <i class="fas fa-fw fa-address-book"></i>
                    <span>Książka telefoniczna</span></a>
            </li>

        <?php if(Yii::$app->user->can('admin')) { ?>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Admin
            </div>

            <!-- Nav Item  -->
            <li class="nav-item ">
                <a class="nav-link" href="/users/index">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Użytkownicy</span></a>
            </li>

            <!-- Nav Item  -->
            <li class="nav-item ">
                <a class="nav-link" href="/clients-list/index">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Klienci</span></a>
            </li>

            <!-- Nav Item  -->
            <li class="nav-item ">
                <a class="nav-link" href="/dids-list/index">
                    <i class="fas fa-fw fa-list-ol"></i>
                    <span>Lista numerów</span></a>
            </li>

        <?php } ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline ">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
    <?php } ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php if(!Yii::$app->user->isGuest){?>
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">10+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Powiadomienia
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-fax text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">4 Maj, 2022</div>
                                        <span class="font-weight-bold">Nowa wiadomość faksowa! Od numeru 123456789</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-fax text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">2 Marzec, 2022</div>
                                        Nowa wiadomość faksowa! Od numeru 987654321
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-fax text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">28 Styczeń, 2022</div>
                                        Nowa wiadomość faksowa! Od numeru 123498765
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Pokaż wszystkie powiadomienia</a>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                         
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= strtoupper(Yii::$app->user->identity->username) ?></span>
                                <img class="img-profile rounded-circle"
                                    src="/sbadmin/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ustawienia
                                </a>
                                <div class="dropdown-divider"></div>
                                    <span>
                                       <?= Html::beginForm(['/site/logout'], 'post') ?>
                                       <?= Html::submitButton(
                                            '<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Wyloguj',
                                            ['class' => 'dropdown-item',]
                                        ) ?>
                                        <?= Html::endForm()?>
                                    </span>
                            </div>
                        </li>
                    </ul>

                </nav>
                <!-- End of Topbar -->

                <?php }?>

                <div class="site-content full-height">
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                    <?= $content ?>
                </div>

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Omega Enterprise Services Sp. z o.o. | Intelligent Technologies S.A.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>




                        <?php NavBar::begin([]);

                                echo Nav::widget([
                                'options' => [
                                    'class' => '',
                                    'style' => ''
                                ],
                                'items' => [
                                Yii::$app->user->isGuest ? (
                                    ['label' => 'Logowanie', 'url' => ['/site/login']]
                                ) : (
                                    '<li>'
                                    . Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Wyloguj (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-danger logout']
                                    )
                                    . Html::endForm()
                                    . '</li>'
                                )
                            ],
                        ]);
                        NavBar::end();
                        ?>

                   
                </div>
            </div>
        </div>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

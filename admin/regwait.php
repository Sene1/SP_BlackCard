<?php
require_once('../post/conn.php');
session_start();

$tokn = md5(uniqid(rand(), true)); // 매번 랜덤하게 생성될 보안인증 토큰
$_SESSION['tokn']=$tokn;

$member=member();
$card=card();

$sql = "select * from `register`";
$result = mysqli_query($connect,$sql);

$sql2 = "select * from `member` where verify='0'";
$accept = mysqli_query($connect,$sql2);


	if(isset($member["user_id"])){
		if ($member["verify"] == 1) {?>
<!DOCTYPE html>
<html lang="ko">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>신평고 - 블랙카드 관리자</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/admin">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-wrench"></i>
                </div>
                <div class="sidebar-brand-text mx-3">관리자</div>
            </a>
			
			<!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="/">
                    <i class="fas fa-fw fa-home"></i>
                    <span>메인화면</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
			
			<!-- Heading -->
            <div class="sidebar-heading">
                블랙카드 관리
            </div>
			
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/get">
                    <i class="fas fa-fw fa-credit-card"></i>
                    <span>지급 및 회수</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="/admin/gifts">
                    <i class="fas fa-fw fa-gifts"></i>
                    <span>상품 교환</span></a>
            </li>
			
			<!-- Divider -->
            <hr class="sidebar-divider">
			
			<!-- Heading -->
            <div class="sidebar-heading">
                로그
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/logs">
                    <i class="fas fa-fw fa-search"></i>
                    <span>카드지급 회수 로그</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="/admin/logs_reg">
                    <i class="fas fa-fw fa-user-edit"></i>
                    <span>가입신청 승인 거절 로그</span></a>
            </li>
			
			<!-- Divider -->
            <hr class="sidebar-divider">
			
            <!-- Heading -->
            <div class="sidebar-heading">
                학생 관리
            </div>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="/admin/users">
                    <i class="fas fa-fw fa-table"></i>
                    <span>학생 목록</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="/admin/regs">
                    <i class="fas fa-fw fa-users"></i>
                    <span>계정 목록</span></a>
            </li>
			<li class="nav-item active">
                <a class="nav-link" href="/admin/regwait">
                    <i class="fas fa-fw fa-pause"></i>
                    <span>가입 대기</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$member["name"]."(".$member["user_id"].")님";?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <a class="dropdown-item" href="/post/logout">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    로그아웃
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">가입 대기</h1>
                    <p class="mb-4">가입 신청이 온 계정을 확인하고, 계정 가입을 승인하거나, 거절할 수 있습니다.</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">가입 대기명단</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
											<th>학번</th>
                                            <th>이름</th>
                                            <th>이메일</th>
                                            <th>가입일</th>
                                            <th>수락</th>
                                            <th>거절</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
											<th>학번</th>
                                            <th>이름</th>
                                            <th>이메일</th>
                                            <th>가입일</th>
                                            <th>수락</th>
                                            <th>거절</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php while($row=mysqli_fetch_assoc($accept)){;?>
										<tr>
											<td><?=$row['hakbun']?></td>
                                            <td><?=$row['name']?></td>
                                            <td><?=$row['user_id']?></td>
                                            <td><?=$row['regdate']?></td>
											<form method="POST" action="/post/accept">
                                            <td><button href="#" class="btn btn-success btn-icon-split">
												<span class="icon text-white-50">
												<input type="hidden" name="accept_name" value="<?=$member["name"]?>">
												<input type="hidden" name="hakbun" value="<?=$row['hakbun']?>">
												<input type="hidden" name="name" value="<?=$row['name']?>">
												<input type="hidden" name="user_id" value="<?=$row['user_id']?>">
												<input type="hidden" name="regdate" value="<?=$row['regdate']?>">
												<input type='hidden' name='tokn' value='<?=$tokn?>'>
													<i class="fas fa-check"></i>
												</span>
												<span class="text">승인</span>
											</button></td>
											</form>
											<form method="POST" action="/post/deny">
                                            <td><button href="#" class="btn btn-danger btn-icon-split">
												<span class="icon text-white-50">
												<input type="hidden" name="accept_name" value="<?=$member["name"]?>">
												<input type="hidden" name="hakbun" value="<?=$row['hakbun']?>">
												<input type="hidden" name="name" value="<?=$row['name']?>">
												<input type="hidden" name="user_id" value="<?=$row['user_id']?>">
												<input type="hidden" name="regdate" value="<?=$row['regdate']?>">
												<input type='hidden' name='tokn' value='<?=$tokn?>'>
													<i class="fas fa-times"></i>
												</span>
												<span class="text">거절</span>
											</button></td>
											</form>
                                        </tr>
									<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; COMON 2021</span>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
	<?php } else {
	echo "<script>window.alert('아직 가입신청이 승인되지 않았습니다.');location.href='/'</script>"; }
	} else {
	echo "<script>location.href='/'</script>"; }?>
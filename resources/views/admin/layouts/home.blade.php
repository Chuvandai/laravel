<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->

        @include('admin.layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.layouts.header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                    <!DOCTYPE html>
                    <html lang="vi">

                    <head>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>Dashboard</title>
                        <!-- Thêm liên kết đến Bootstrap CSS -->
                        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
                            rel="stylesheet">
                        <!-- Thêm font-awesome cho các biểu tượng -->
                        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
                            rel="stylesheet">
                        <!-- Thêm liên kết đến Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    </head>

                    <body>

                        <!-- Sidebar -->
                            <!-- Page Content -->
                            <div id="page-content-wrapper" class="w-100">
                                <!-- Navbar -->
                               

                                <!-- Thông tin thống kê -->
                                <div class="container mt-4">
                                    <div class="row">
                                        <!-- Biểu đồ đơn hàng -->
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white">
                                                    Biểu đồ Đơn hàng
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="ordersChart"></canvas>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Biểu đồ sản phẩm -->
                                        <div class="col-lg-6 col-md-12 mb-4">
                                            <div class="card">
                                                <div class="card-header bg-success text-white">
                                                    Biểu đồ Sản phẩm
                                                </div>
                                                <div class="card-body">
                                                    <canvas id="productsChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bootstrap JS và Popper.js -->
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>

                        <!-- Biểu đồ Chart.js -->
                        <script>
                            // Biểu đồ Đơn hàng
                            var ctxOrders = document.getElementById('ordersChart').getContext('2d');
                            var ordersChart = new Chart(ctxOrders, {
                                type: 'bar',
                                data: {
                                    labels: ['Chờ xử lý', 'Đã xác nhận', 'Đang giao hàng', 'Đã giao', 'Hủy'],
                                    datasets: [{
                                        label: 'Số lượng đơn hàng',
                                        data: [120, 150, 100, 170, 50], // Dữ liệu mẫu
                                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });

                            // Biểu đồ Sản phẩm
                            var ctxProducts = document.getElementById('productsChart').getContext('2d');
                            var productsChart = new Chart(ctxProducts, {
                                type: 'pie',
                                data: {
                                    labels: ['Điện thoại', 'Laptop', 'Máy tính bảng', 'Phụ kiện'],
                                    datasets: [{
                                        label: 'Sản phẩm',
                                        data: [250, 300, 150, 100], // Dữ liệu mẫu
                                        backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F']
                                    }]
                                },
                                options: {
                                    responsive: true
                                }
                            });
                        </script>

                        <script>
                            // Toggle Sidebar
                            document.getElementById("menu-toggle").addEventListener("click", function() {
                                document.getElementById("sidebar-wrapper").classList.toggle("toggled");
                            });
                        </script>
                    </body>

                    </html>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            {{-- @include('admin.layouts.footer') --}}
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript -->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages -->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>


</body>

</html>

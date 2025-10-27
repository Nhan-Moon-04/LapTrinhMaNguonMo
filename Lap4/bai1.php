<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Lab 5 - Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h1 class="text-center mb-4">🎓 Lab 5 - Hệ thống quản lý</h1>
    
    <div class="row">
        <!-- Hệ thống quản lý sinh viên -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">👨‍🎓 Hệ thống quản lý Sinh viên</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Bài tập từ 1-11: CRUD sinh viên với phân trang, tìm kiếm, sắp xếp</p>
                    
                    <h6>Tính năng:</h6>
                    <ul class="list-unstyled">
                        <li>✅ Thêm/Sửa/Xóa sinh viên</li>
                        <li>✅ Phân trang danh sách</li>
                        <li>✅ Tìm kiếm theo tên/email</li>
                        <li>✅ Sắp xếp theo các trường</li>
                        <li>✅ Validation đầy đủ</li>
                        <li>✅ Prepared Statement</li>
                    </ul>
                    
                    <div class="mt-3">
                        <a href="list_students.php" class="btn btn-outline-primary btn-sm">Danh sách cơ bản</a>
                        <a href="pagination.php" class="btn btn-primary btn-sm">Đầy đủ tính năng</a>
                        <a href="add_student.php" class="btn btn-success btn-sm">Thêm sinh viên</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Hệ thống quản lý shop -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">🛒 Hệ thống quản lý Shop</h5>
                </div>
                <div class="card-body">
                    <p class="card-text">Lab 3: Bài tập 1-12 về SQL nâng cao với JOIN, GROUP BY, Subquery</p>
                    
                    <h6>Bài tập bao gồm:</h6>
                    <ul class="list-unstyled">
                        <li>📊 Thống kê sản phẩm theo loại</li>
                        <li>💰 Tính doanh thu theo ngày</li>
                        <li>🔍 Tìm loại hàng có >5 sản phẩm</li>
                        <li>👥 Khách hàng chi tiêu nhiều</li>
                        <li>🏆 Sản phẩm đắt nhất từng loại</li>
                        <li>📈 Top sản phẩm bán chạy</li>
                    </ul>
                    
                    <div class="mt-3">
                        <a href="shop_exercises.php" class="btn btn-success">Xem tất cả bài tập</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hướng dẫn cài đặt -->
    <div class="card mt-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">📝 Hướng dẫn cài đặt</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Cho hệ thống Sinh viên:</h6>
                    <ol>
                        <li>Import file <code>database.sql</code></li>
                        <li>Cấu hình <code>connect.php</code></li>
                        <li>Truy cập <code>pagination.php</code></li>
                    </ol>
                </div>
                <div class="col-md-6">
                    <h6>Cho hệ thống Shop:</h6>
                    <ol>
                        <li>Import file <code>shop_database.sql</code></li>
                        <li>Cấu hình <code>shop_connect.php</code></li>
                        <li>Truy cập <code>shop_exercises.php</code></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Thống kê files -->
    <div class="card mt-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">📁 Danh sách files trong dự án</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Hệ thống Sinh viên:</h6>
                    <ul class="list-unstyled">
                        <li>📄 <code>database.sql</code> - Database</li>
                        <li>📄 <code>connect.php</code> - Kết nối DB</li>
                        <li>📄 <code>list_students.php</code> - Danh sách</li>
                        <li>📄 <code>pagination.php</code> - Phân trang</li>
                        <li>📄 <code>add_student.php</code> - Thêm SV</li>
                        <li>📄 <code>edit_student.php</code> - Sửa SV</li>
                        <li>📄 <code>delete_student.php</code> - Xóa SV</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h6>Hệ thống Shop:</h6>
                    <ul class="list-unstyled">
                        <li>📄 <code>shop_database.sql</code> - Database shop</li>
                        <li>📄 <code>shop_connect.php</code> - Kết nối DB</li>
                        <li>📄 <code>shop_exercises.php</code> - Tất cả bài tập</li>
                        <li>🎯 <strong>12 bài tập SQL</strong> hoàn chỉnh</li>
                        <li>📊 Thống kê, báo cáo chi tiết</li>
                        <li>🔍 Hiển thị SQL query</li>
                        <li>📱 Giao diện responsive</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="mt-5 text-center">
        <small class="text-muted">
            Phát triển bởi Lab 5 Team | September 2025 | 
            <a href="README.md">Xem tài liệu chi tiết</a>
        </small>
    </footer>
</body>
</html>
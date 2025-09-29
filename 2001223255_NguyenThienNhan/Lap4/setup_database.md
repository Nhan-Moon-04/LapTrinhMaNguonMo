# Hướng dẫn tạo database lab3_shop

## Cách 1: Sử dụng phpMyAdmin (Dễ nhất)

1. Mở trình duyệt: `http://localhost/phpmyadmin`
2. Click tab "Import"
3. Chọn file `shop_database.sql`
4. Click "Go"

## Cách 2: Sử dụng MySQL Command Line

```bash
# Truy cập MySQL
mysql -u root -p

# Tạo database
CREATE DATABASE lab3_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Thoát MySQL
exit;

# Import file SQL
mysql -u root -p lab3_shop < shop_database.sql
```

## Cách 3: Chạy từng lệnh SQL

```sql
-- Tạo database
CREATE DATABASE lab3_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lab3_shop;

-- Sau đó copy paste toàn bộ nội dung từ shop_database.sql
```

## Kiểm tra database đã tạo thành công

```sql
SHOW DATABASES;
USE lab3_shop;
SHOW TABLES;
SELECT COUNT(*) FROM products;
```

## Lỗi thường gặp và cách khắc phục

### Lỗi: Access denied

- Kiểm tra username/password MySQL
- Thường là `root` và password trống với XAMPP/Laragon

### Lỗi: Unknown database

- Database chưa được tạo
- Chạy lại script tạo database

### Lỗi: Table doesn't exist

- Các bảng chưa được tạo
- Import lại file shop_database.sql

## Sau khi tạo database

1. Reload trang `shop_exercises.php`
2. Tất cả 12 bài tập sẽ hiển thị kết quả

-- Bài tập 08: Thêm cột birthday vào bảng students
ALTER TABLE students ADD COLUMN birthday DATE;

-- Cập nhật một số dữ liệu mẫu (tuỳ chọn)
UPDATE students SET birthday = '1995-01-15' WHERE id = 1;
UPDATE students SET birthday = '1998-03-22' WHERE id = 2;
UPDATE students SET birthday = '1997-07-10' WHERE id = 3;




CREATE TABLE students (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
email VARCHAR(100) UNIQUE,
phone VARCHAR(20));



INSERT INTO students (name, email, phone) VALUES
('Nguyen Van A', 'a@example.com', '0123456789'),
('Tran Thi B', 'b@example.com', '0987654321');
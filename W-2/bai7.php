<?php
// Định nghĩa lớp Book
class Book
{
    protected $title;
    protected $author;
    protected $price;

    public function __construct($title, $author, $price)
    {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function showInfo()
    {
        echo "<tr>
                <td>{$this->title}</td>
                <td>{$this->author}</td>
                <td>{$this->price} VND</td>
              </tr>";
    }
}

// Interface Downloadable
interface Downloadable
{
    public function download();
}

// Lớp Ebook kế thừa Book và triển khai Downloadable
class Ebook extends Book implements Downloadable
{
    private $fileSize; // dung lượng file

    public function __construct($title, $author, $price, $fileSize)
    {
        parent::__construct($title, $author, $price);
        $this->fileSize = $fileSize;
    }

    // Ghi đè phương thức showInfo
    public function showInfo()
    {
        echo "<tr>
                <td>{$this->title} (Ebook)</td>
                <td>{$this->author}</td>
                <td>{$this->price} VND</td>
                <td>{$this->fileSize} MB</td>
              </tr>";
    }

    public function download()
    {
        echo "<p>Đang tải xuống ebook: <b>{$this->title}</b> ({$this->fileSize} MB)...</p>";
    }
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f9f9f9;
        }

        h2 {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
            background: #fff;
        }

        table,
        th,
        td {
            border: 1px solid #ccc;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }

        p {
            text-align: center;
            font-style: italic;
        }
    </style>
</head>

<body>
    <h2>Danh sách Sách & Ebook</h2>
    <table>
        <tr>
            <th>Tiêu đề</th>
            <th>Tác giả</th>
            <th>Giá</th>
            <th>Dung lượng</th>
        </tr>
        <?php
        // Chạy thử
        $book1 = new Book("Lập trình PHP", "Kim Ngọc", 50000);
        $book1->showInfo();

        $ebook1 = new Ebook("Laravel cơ bản", "Trần Văn B", 80000, 5);
        $ebook1->showInfo();
        ?>
    </table>

    <?php
    // Hiện thông báo tải xuống
    $ebook1->download();
    ?>
</body>

</html>
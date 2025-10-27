<html>
<?php
class HocSinh
{
    private $MaHS;
    private $TenHS;
    private $DiemVan;
    private $DiemToan;

    function __construct($MaHS, $TenHS, $DiemVan, $DiemToan)
    {
        $this->MaHS = $MaHS;
        $this->TenHS = $TenHS;
        $this->DiemVan = $DiemVan;
        $this->DiemToan = $DiemToan;
    }

    function tinhDiemTrungBinhXepLoaiHocLuc()
    {
        $diemTB = ($this->DiemVan + $this->DiemToan) / 2;
        echo "Điểm trung bình: " . $diemTB . "<br>";

        if ($diemTB >= 9)
            return "Xếp loại học lực: Xuất sắc";
        else if ($diemTB >= 8)
            return "Xếp loại học lực: Giỏi";
        else if ($diemTB >= 7)
            return "Xếp loại học lực: Khá";
        else if ($diemTB >= 5)
            return "Xếp loại học lực: Trung bình";
        else
            return "Xếp loại học lực: Yếu";
    }

}
?>

<body>
    <?php
    $hs = new HocSinh("16112004", "Nguyễn Thiện Nhân", 8, 9);
    echo $hs->tinhDiemTrungBinhXepLoaiHocLuc();
    ?>

</html>


<?php
class Xe
{
    private $maXe;
    private $tenXe;
    private $hangSanXuat;
    private $namSanXuat;


    function __construct($maXe, $tenXe, $hangSanXuat, $namSanXuat)
    {
        $this->maXe = $maXe;
        $this->tenXe = $tenXe;
        $this->hangSanXuat = $hangSanXuat;
        $this->namSanXuat = $namSanXuat;
    }

    function tinhTuoiXe()
    {
        $tuoiXe = date("Y") - $this->namSanXuat;
        echo "Tuổi xe: " . $tuoiXe . "<br>";
        return $tuoiXe;
    }
}
?>

<body>
    <?php
    $x = new Xe("001", "Air Blade", "Honda", 2018);
    echo $x->tinhTuoiXe();
    ?>
</body>
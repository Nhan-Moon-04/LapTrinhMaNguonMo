<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Bài tập JavaScript</title>
</head>

<body>

    <h3>Bài 1: Đổi màu nền</h3>
    <button onclick="changeBg()">Đổi màu nền</button>

    <hr>

    <h3>Bài 2: Hiển thị text</h3>
    <input type="text" id="txt" placeholder="Nhập gì đó">
    <button onclick="showText()">Hiển thị</button>
    <div id="output"></div>

    <hr>


    <h3>Bài 3: Thêm item vào danh sách</h3>
    <input type="text" id="item" placeholder="Nhập item">
    <button onclick="addItem()">Thêm</button>
    <ul id="list"></ul>

    <script>

        function changeBg() {
            document.body.style.backgroundColor = "#" +
                Math.floor(Math.random() * 16777215).toString(16);
        }

        function showText() {
            document.getElementById("output").innerText =
                document.getElementById("txt").value;
        }


        function addItem() {
            let val = document.getElementById("item").value;
            if (val.trim() !== "") {
                let li = document.createElement("li");
                li.innerText = val;
                document.getElementById("list").appendChild(li);
                document.getElementById("item").value = "";
            }
        }
    </script>
</body>

</html>
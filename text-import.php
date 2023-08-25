<?php
include_once "DB.php";
/****
 * 1.建立資料庫及資料表
 * 2.建立上傳檔案機制
 * 3.取得檔案資源
 * 4.取得檔案內容
 * 5.建立SQL語法
 * 6.寫入資料庫
 * 7.結束檔案
 */

$dataTR = "";
$dataNO = "";
$dataPRE = "";
$dataCount = 0;
if (!empty($_FILES['text']['tmp_name'])) {
    $dataPRE .= "檔名是:" . $_FILES['text']['name'];
    $dataPRE .= "<br>";
    $dataPRE .= "檔案大小是:" . $_FILES['text']['size'];
    move_uploaded_file($_FILES['text']['tmp_name'], "./doc/{$_FILES['text']['name']}");
    $path = "./doc/{$_FILES['text']['name']}";
    // 使用 'r' 模式來讀取檔案
    $file = fopen($path, "r");
    // echo "<table>";
    if ($file) {
        // 讀取檔案到最後
        while (($line = fgets($file)) !== false) {
            $dataTR .= "<tr>";
            // echo $line;
            // $data = str_getcsv($line);
            $cols = explode(",", $line);
            // dd($data);
            if ($dataCount == 0) {
                $dataTR .= "<td>選取</td>";
            } else {
                $dataTR .= "<td><input type=\"checkbox\" name=\"data[]\"></td>";
            }
            for ($i = 0; $i < count($cols); $i++) {
                $dataTR .= "<td>" . $cols[$i] . "</td>";
            }
            if ($dataCount == 0) {
                $dataTR .= "<td>狀態</td>";
            } else {
                $dataTR .= "<td>狀態</td>";
            }

            $dataTR .= "</tr>";
            // echo "<br>";
            $dataCount++;
        }
        fclose($file);
    } else {
        // 檔案開啟失敗
        echo "檔案開啟失敗";
    }
    // echo "</table>";
}
function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>文字檔案匯入</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            border: 1px solid #ccc;
            box-shadow: 3px 3px 15px #aaa;
            padding: 20px;
            border-collapse: collapse;
            margin: auto;
        }

        td {
            border: 1px solid #ccc;
            padding: 5px 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="header">文字檔案匯入練習</h1>
    <!---建立檔案上傳機制--->
    <form action="?" method="post" enctype="multipart/form-data">
        <input type="file" name="text" id="text">
        <input type="submit" value="載入資料">
        <input type="button" value="上傳資料庫">
        <button onclick=""></button>
        <hr>
        <?= $dataPRE; ?>
        <table>
            <?= $dataNO; ?>
            <?= $dataTR; ?>
        </table>
        合計匯入資料表筆數:<?= $dataCount-1; ?>筆
    </form>


    <!----讀出匯入完成的資料----->



</body>

</html>
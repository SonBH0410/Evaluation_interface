<?php
    require_once "./connection.php";
    require_once "./models/danthuong.php";
    require_once "./models/congan.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <link href="assets/css/form.css" rel="stylesheet">
    <script src = "./son/html2canvas.js"></script>
    <title>Thử nghiệm</title>
    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0; width: 100%;}
        .tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
          font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-c3ow{border-color:inherit;text-align:center;vertical-align:top}
        .tg .tg-0pky{border-color:inherit;text-align:center;vertical-align:top}
    </style>
</head>
<body>
    <?php
        include "inc/header.php";
    ?>
    <div id = "screen">
        <div class="container">
            <div class="background-form">
                <?php 
                $max_result = 100;
                if (!isset($_POST['queryStr'])) {
                    $queryStr="Một người phụ nữ mặc một chiếc áo màu xanh, chân đi giầy thể thao đỏ";                                
                } else {
                    $queryStr = trim($_POST['queryStr'],' ');                      
                }        
                ?>      
                <form method = "post" name = "form1" id = "form_input">
                    <div class = "container">
                        <div class = "row">
                            <b class = "col-md-6"> Nhập câu mô tả người</b> 
                        </div>
                            <textarea id="queryStr" name="queryStr" rows="4" cols="150" wrap="soft" class = "col-sm-9"><?php echo($queryStr);?></textarea>
                        <div clas = "row">
                            <b class = "">Chọn số ảnh muốn hiển thị</b>
                        </div>
                        <div class = "row">
                            <p class = "col"> 
                                <select class = "form-control" name = "select">
                                    <!-- <option value = "05" name = "05"> 05 </option> -->
                                    <option value = "10" name = "10" selected> 10 </option>
                                    <!-- <option value = "15" name = "15"> 15 </option> -->
                                </select>
                            </p>
                            <p class = "col-2">
                                <input class = "btn btn-info" type = "submit" id = "btnSend" name = "btnSend" value='Tìm kiếm' /> 
                                <div id = "loading" class="spinner-border text-info" role="status"> </div>
                            </p>
                            <p class = "col-6">
                        </div>
                    </div>
                </form>
                <form name = "form2" id = "form_input">
                    <div class = "container">
                       <div class = "5pic" id = "5pic">  
                           <table class="tg mt-3 table table-bordered">
                               <td class="tg-0pky">01</td>
                               <td class="tg-0pky">02</td>
                               <td class="tg-0pky">03</td>
                               <td class="tg-0pky">04</td>
                               <td class="tg-0pky">05</td>            
                               <tr>
                                   <?php
                                      if (isset($_POST["queryStr"])){
                                      putenv('LANG=en_US.UTF-8'); 
                                      $output = null;
                                      $command = "python3 /var/www/html/personsearch/views/admins/test.py '$queryStr' $max_result 2>&1";
                                      $output = shell_exec($command);                                   
                                      $output = str_replace(';', ',', $output);
                                      $img_paths = explode(",", $output);
                                      $n = sizeof($img_paths);  
                                      
                                      $command2 = '/home/sonbh/sonbh_env/bin/python3 /home/sonbh/demo.py "' . $queryStr . '" "' . $output . '"'; 
                                      $output2 = shell_exec($command2);                                
                                      $result = json_decode($output2, true);
                                      
                                      $lengths = $result['lengths'];
                                      $temp_list = $result['temp_list'];
                                      
                                      $temp_list = implode(",", $temp_list) ;
                                      $img_paths2 = explode(",", $temp_list);
                                      echo "Kết quả : " . $lengths . "\n";
                    
                                      for ($x = 0; $x < 5; $x++){ 
                                          echo "<td class=\"tg-0pky\"><img src=/ps/images/"; 
                                          echo $img_paths2[$x];
                                          echo " style=\"height: 128px \">"; //</td>
                                          echo "
                                              <div class = 'form-group text-left' style = 'font-size: 13px'>
                                                  <br>
                                                  <div class = 'form-check form-check-inline'>
                                                      <input type = 'radio' class = 'form-check-input' name = 'danhgia$x' id = 'delivery$x' value  = 'agree'>
                                                      <label style = 'font-size: 15px' class = 'text-center'> Phù hợp </label>
                                                  </div>
                                                  <div class = 'form-check form-check-inline'>
                                                      <input type = 'radio' class = 'form-check-input' name = 'danhgia$x' id = 'delivery$x' value  = 'disagree' checked>
                                                      <label style = 'font-size: 15px'> Không phù hợp </label>
                                                  </div>
                                              </div> </td> ";
                                              } 
                                          }
                                    ?>
                                  </tr>
                              </table>
                          </div>
                          <div class = "10pic" id = "10pic">  
                            <table class="tg mt-3 table table-bordered">
                                <td class="tg-0pky">06</td>
                                <td class="tg-0pky">07</td>
                                <td class="tg-0pky">08</td>
                                <td class="tg-0pky">09</td>
                                <td class="tg-0pky">10</td>            
                                <tr>
                                    <?php
                                        if (isset($_POST["queryStr"])){
                                          for ($x = 5; $x < 10; $x++){ 
                                            echo "<td class=\"tg-0pky\"><img src=/ps/images/"; 
                                            echo $img_paths2[$x];
                                            echo " style=\"height: 128px \">"; //</td>
                                            echo "
                                                <div class = 'form-group text-left' style = 'font-size: 13px'>
                                                    <br>
                                                    <div class = 'form-check form-check-inline'>
                                                        <input type = 'radio' class = 'form-check-input' name = 'danhgia$x' id = 'delivery$x' value  = 'agree'>
                                                        <label style = 'font-size: 15px' class = 'text-center'> Phù hơp </label>
                                                    </div>
                                                    <div class = 'form-check form-check-inline'>
                                                        <input type = 'radio' class = 'form-check-input' name = 'danhgia$x' id = 'delivery$x' value  = 'disagree' checked>
                                                        <label style = 'font-size: 15px'> Không phù hợp </label>
                                                    </div>
                                                </div> </td> ";
                                                } 
                                            }
                                    ?>
                                </tr>
                              </table>
                          </div>
                          <div class = "15pic" id = "15pic">  
                              <table class="tg mt-3 table table-bordered">
                                  <td class="tg-0pky">11</td>
                                  <td class="tg-0pky">12</td>
                                  <td class="tg-0pky">13</td>
                                  <td class="tg-0pky">14</td>
                                  <td class="tg-0pky">15</td>            
                                  <tr>
                                      <?php
                                          if (isset($_POST["queryStr"])){
                                          for($x = 10; $x < 15; $x++){ 
                                              echo "<td class=\"tg-0pky\"><img src=/ps/images/"; 
                                              echo $img_paths[$x];
                                              echo " style=\"height: 128px \">"; //</td>
                                              echo "
                                                  <div class = 'form-group text-left' style = 'font-size: 13px'>
                                                      <br>
                                                      <div class = 'form-check form-check-inline'>
                                                          <input type = 'radio' class = 'form-check-input' name = 'danhgia$x' id = 'delivery$x' value  = 'agree'>
                                                          <label style = 'font-size: 15px' class = 'text-center'> Phù h?p </label>
                                                      </div>
                                                      <div class = 'form-check form-check-inline'>
                                                          <input type = 'radio' class = 'form-check-input' name = 'danhgia$x' id = 'delivery$x' value  = 'disagree' checked>
                                                          <label style = 'font-size: 15px'> Không phù h?p </label>
                                                      </div>
                                                  </div> </td> ";
                                                  } 
                                              }
                                      ?>
                                  </tr>
                              </table>
                          </div>
                    <div class = "container">
                        <div class = "row">
                            <button type = "submit" id = "btnPrint" class = "col-sm-3 btn btn-info" name = "Submit" > G?i k?t qu? ph?n h?i </button> 
                            <input type = "hidden" class = "col-sm-4" name = "nop" id = "nop" value = "0" >
                            <input type = "hidden" class = "col-sm-4" name = "nof" id = "nof" value = "0" >
                            <input type = "hidden" class = "col-sm-4" name = "account" id = "account" value = "0" >
                            <input type = "hidden" class = "col-sm-4" name = "type" id = "type" value = "0" >
                        </div>
                    </div>
                </form>
            </div> 
        </div>
    </div>
    <?php 
        include "inc/footer.php" ;
    ?>  
    <?php
        $value = '';
        echo ' 
            <script>
                document.getElementById("5pic").style.display = "none";
                document.getElementById("10pic").style.display = "none";
                document.getElementById("15pic").style.display = "none";
                document.getElementById("btnPrint").style.display = "none";
                document.getElementById("loading").style.display = "none";
            </script> ';
        if(isset($_POST["btnSend"])) {
            $value = trim($_POST['select']);
            if ($value == '05') {
                echo ' 
                    <script>
                        document.getElementById("5pic").style.display = "block";
                        document.getElementById("10pic").style.display = "none";
                        document.getElementById("15pic").style.display = "none";
                        document.getElementById("btnPrint").style.display = "block";
                    </script> ';
            } elseif ($value == '10') {
                echo ' 
                    <script>
                        document.getElementById("5pic").style.display = "block";
                        document.getElementById("10pic").style.display = "block";
                        document.getElementById("15pic").style.display = "none";
                        document.getElementById("btnPrint").style.display = "block";
                    </script> ';                                
            } elseif ($value == '15') {
                echo ' 
                    <script>
                        document.getElementById("5pic").style.display = "block";
                        document.getElementById("10pic").style.display = "block";
                        document.getElementById("15pic").style.display = "block";
                        document.getElementById("btnPrint").style.display = "block";
                    </script> ';                           
            }
        }
    ?>    
    <?php
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        if (isset($_SESSION['username']) && isset($_SESSION['loainguoidung'])){
            $account = strtolower($_SESSION['username']);
            $type = $_SESSION['loainguoidung'];
        } elseif (!isset($account) && !isset($type)) {
            $account = 'tester';
            $type = '3';
        }
        $queryStr = ''; $value = '';
        if(isset($_POST['btnSend'])){
            $queryStr = trim($_POST['queryStr']);
            $value = trim($_POST['select']);
        }
        date_default_timezone_set("Asia/Ho_Chi_Minh"); 
        $numoffolder = '';
        if(!empty($queryStr) && !empty($value)) {
            for($i = 0; $i < 1000; $i++) {
                $checkfolder =  './result/' . $type . '_' . $account . '/person' . $i;
                if(!file_exists($checkfolder)) {
                    mkdir( './result/' . $type . '_' . $account . '/person' . $i, 0777, true);
                    $numoffolder = $i;
                    break;
                }
            }
            $openfile = fopen($checkfolder . '/data'. $numoffolder . '.txt', 'a');
            fwrite($openfile, date("d/m/y") . "\t". date("H:i:s") . "\t" . $queryStr . "\t" .  $value . "\n" );
            fclose($openfile);
            $screenshotfile = './son/save-capture.php';
            copy($screenshotfile, $checkfolder.'/takescreenshot.php');
        }
    ?>
    <script>
        document.getElementById("btnSend").onclick = function() {
            document.getElementById("loading").style.display = "block";
            document.getElementById("btnSend").onclick = function(event){ event.preventDefault(); }
        }
        document.getElementById("btnPrint").onclick = function() {  
            document.getElementById("nop").value = numofpicture;
            document.getElementById("nof").value = numoffolder;
            document.getElementById("account").value = acn;
            document.getElementById("type").value = typ;
            doCapture();
            alert('Cám ơn bạn đã đánh giá thử nghiệm');
            document.getElementById("btnPrint").onclick = function(event){ event.preventDefault(); }
        }
        
        var type = "<?php echo "$type" ?>";   
        var user = "<?php echo "$account" ?>"; 
        var numoffolder = "<?php echo "$numoffolder" ?>";     
        var numofpicture = "<?php echo "$value" ?>";
        var acn = "<?php echo "$account"?>"; 
        var typ = "<?php echo "$type"?>";

        function doCapture() {
            window.scrollTo(0, 0);
            html2canvas(document.getElementById("screen")).then(function (canvas) {
                var ajax = new XMLHttpRequest();
                ajax.open("POST", './result/' + type + '_' + user + '/person' + numoffolder + '/takescreenshot.php', true);
                ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");                    
                var str = "image=" + canvas.toDataURL("image/jpeg", 0.9);
                ajax.send(str); 
                ajax.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                    }
                };
            });
        }
    </script>
    <script type = "text/javascript">
        $(document).ready(function()
        { 
            var submit = $("button[type='submit']");
            submit.click(function() {
                var dataForm = $('form#form_input').serialize();
                $.ajax({
                    type : 'POST', 
                    url : './result/data.php', 
                    data : dataForm,
                    success : function(data)  { 
                        console.log('Done', data);
                    }
                });
                return false;
            });
        });
    </script> 
</body>  
</htmL>

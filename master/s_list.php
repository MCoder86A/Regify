<?php
  session_start();
  $isLogin = $_SESSION["userinfo"]["userinfo"]["isLog"];
  $sub = $_GET["sub"];
  $std = $_GET["std"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="icon" href="https://nulphary.sirv.com/Images/fabicon.png" type="image/png" sizes="16x16">
  <title>Regify-Teacher dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/MCoder86A/cdn@2/master/s_list.css?v=1.0.2">
</head>


<body>
  <!-- <div class="bar"></div> -->
  <div class="head">
    <div class="col1">
      <div class="name">Hi! <?php if ($isLogin) {
                              print($_SESSION["userinfo"]["userinfo"]["username"]);
                            } ?></div>
    </div>
  </div>
  <div class="dash">
    <div class="col1">
      <table>
        <tr class="tableH">
          <th>Name</th>
          <th>Roll</th>
          <th style="width: 30%;">Present(%)</th>
        </tr>
        
        <?php
        require '../db.php';

        $name = $_SESSION["userinfo"]["userinfo"]["emailid"];

        $q = "SELECT NAME, ROLL, NOTP_".$sub.", NOP_".$sub." FROM STUDENTS WHERE STANDARD='".$std."' and ".$sub."= '".$name."'";
        $stmt = $conn->prepare($q);
        $stmt->execute();
        $res = $stmt->get_result();

        while ($row = $res->fetch_assoc()) {
          if($row["NOTP_".$sub] == 0){
            $p_percnt = 0;
          }
          else{
            $p_percnt = ($row["NOP_".$sub]/$row["NOTP_".$sub])*100;
          }

          printf('<tr>
          <td>%s</td>
          <td>%s</td>
          <td>%s%%</td>
        </tr>', $row["NAME"], $row["ROLL"], round($p_percnt, 2));
        }

        ?>
      </table>


    </div>
    <div class="col2">

    </div>
  </div>

<!-- <ript>
    $('bod%^y').fin d('img[alt$="www.000webhost.com"]').reDELmove(); 
</ript> -->
</html>
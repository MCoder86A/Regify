<?php
  session_start();
  $isLogin = $_SESSION["userinfo"]["userinfo"]["isLog"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://nulphary.sirv.com/Images/fabicon.png" type="image/png" sizes="16x16">
  <title>Regify-Teacher dashboard</title>
  <link rel="stylesheet" href="./style.css">
  <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
</head>


<body>
  <div class="bar"></div>
  <div class="head">
    <div class="col1">
      <div class="name">Hi! <?php if ($isLogin) {
                              print($_SESSION["userinfo"]["userinfo"]["username"]);
                            } ?></div>
    </div>
  </div>
  <div class="dash">
    <div class="col1">
      <ul>
        <?php
        require '../db.php';

        $stmt = $conn->prepare("SELECT DISTINCT SUB FROM SUBJECT");
        $stmt->execute();
        $res = $stmt->get_result();
        $_subject = $res->fetch_all();

        $_required_row = array();

        $name = $_SESSION["userinfo"]["userinfo"]["emailid"];
        foreach ($_subject as $val) {
          $stmt = $conn->prepare("SELECT DISTINCT STANDARD FROM STUDENTS where " . $val[0] . " = " . "'$name'");
          $stmt->execute();
          foreach ($stmt->get_result()->fetch_all() as $key) {
            array_push($_required_row, $key);
            printf('<li>
            <a href="s_list.php?sub=%s&std=%s" class="classroom">
              <div class="item">%s %s</div>
            </a>
            <div class="start_ico">
              <a href="live?sub=%s&std=%s"><img src="https://nulphary.sirv.com/Images/start.png"></a>
            </div>
            </li>', $val[0], $key[0], $key[0], $val[0], $val[0], $key[0]);
          }
        }

        ?>
        
      </ul>
<!-- <i class="fas fa-clipboard-list"></i> -->
    </div>
    <div class="col2">

    </div>
  </div>

</body>

</html>
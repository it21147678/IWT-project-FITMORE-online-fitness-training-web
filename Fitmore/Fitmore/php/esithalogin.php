<?php 

    include_once('conn.php');

    if(isset($_POST['Submit']))
        {
        $userName = $_POST['UN'];
        $password = $_POST['PW'];

       if(empty($userName) || empty($password))
       {
           echo'
           <script>
            alert("Empty fields");
            window.location="../html/login.html"
           </script>';
           exit();
       }
       else
       {
            $sql="SELECT Email,Pwd FROM tbl_user WHERE Email='$userName'";
            $result=mysqli_query($conn,$sql);
            
            if(!$result)
            {
                die("Query failed: " .mysqli_error($conn));
            }
            else
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    $db_userName = $row['Email'];
                    $db_password = $row['Pwd']; 
                }

                if($userName != $db_userName)
                {
                    echo'
                <script>
                    alert("Invalid Username");
                    window.location="../html/login.html";
                </script>';
                exit();
                }
                else if($password != $db_password)
                {
                    echo'
                <script>
                    alert("Invalid Password");
                    window.location="../html/login.html";
                </script>';
                exit();
                }
                else if($userName == $db_userName && $password == $db_password)
                {
                    session_start();
                    $_SESSION['userName'] = $db_userName;                    
                    header("location:../html/home.html?LoginSuccessful");
                }
            }
       }
}
else
{
    echo'<script>
            alert("Empty Fields");
            window.location="../html/login.html"
        </script>';
        exit();
}
?>
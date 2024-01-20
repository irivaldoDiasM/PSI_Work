<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div style="display: flex; flex-direction: row;">
        <div style="width: 50%; justify-content: center; align-items: center;">
         
        <center>
            <form action="register.php" method="post">
                <table  style="width: 300px ; background-color:#f19191" border="1" cellpadding="1">
                    <thead>
                        <tr>
                            <th colspan="2"><b>Register</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Username</label></td>
                            <td><input type="text" placeholder="Enter Username" name="c_username"  id="c_username" required></td>
                        </tr>
                        <tr>
                            <td><label>Password</label> </td>
                            <td><input type="password" placeholder="Enter Password" name="c_password" id="c_password" required> </td>
                        </tr>
                        <tr>
                            <td><label>Confirm Password</label> </td>
                            <td><input type="password" placeholder="Confirm Password" name="c_c_password" id="c_c_password"  required> </td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><button type="submit">Save</button></td>
                        </tr>

                    </tbody>
                </table>
            </form> 
</center>
        </div>

        <div  style="width: 50%; justify-content: center;">
            <?php
                if (isset($_GET['erro']) && $_GET['erro']==2) {
                    echo "<p style='color: red;'>Erro: ".$_GET['msg'].".</p>";
                }
            ?>
 <center>
            <form action="part1_correct.php" method="POST">
                <table  style="width: 300px ; background-color:#f19191" border="1" cellpadding="1">
                    <thead>
                        <tr>
                            <th colspan="2"><b>Part 1.1 - Correct Form</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Username</label></td>
                            <td><input type="text" placeholder="Enter Username" name="c_username" required></td>
                        </tr>
                        <tr>
                            <td><label>Password</label> </td>
                            <td><input type="password" placeholder="Enter Password" name="c_password" required> </td>
                        </tr>
                       
                        <tr>
                            <td align="right" colspan="2"><button type="submit" >Login</button></td>
                        </tr>

                    </tbody>
                </table>
            </form> 
        </div>
    </div>
  </center>

  <center>
    <form action="/part1_vulnerable.php" method="POST">
                <table  border="1" cellpadding="1" style="width: 300px; background-color:#f17474">
                    <thead>
                        <tr>
                            <th colspan="2"><b>Part 1.0 - Vulnerable Form</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Username</label></td>
                            <td><input type="text" placeholder="Enter Username" name="v_username" required></td>
                        </tr>
                        <tr>
                            <td><label>Password</label> </td>
                            <td><input type="password" placeholder="Enter Password" name="v_password" required> </td>
                        </tr>
                        <tr>
                            <td><label>Remember me</label></td>
                            <td><input  type="checkbox" checked="checked" name="v_remember"></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><button type="submit">Login</button></td>
                        </tr>
                    </tbody>
                </table>
            </form> 
    </center>
</body>
</html>
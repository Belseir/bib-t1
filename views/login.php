<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Login y Logout de usuarios con PHP y Ajax</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js" integrity="sha256-eTyxS0rkjpLEo16uXTS0uVCS4815lc40K2iVpWDvdSY=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="../public/css/stylesheet.css" />
    <script src="../public/js/functions.ajax.js"></script>
</head>

<body>
    <div id="allContent">
        <table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%">
            <tr>
                <td align="center" valign="middle" height="100%" width="100%">

                    <div id="alertBoxes"></div>
                    <span class="loginBlock"><span class="inner">
                            <?php
                            if (isset($_SESSION['username']) && isset($_SESSION['userid']) && $_SESSION['username'] != '' && $_SESSION['userid'] != '0') {

                                echo '<div class="session_on">
        Ya iniciaste sesión | Ahora has un <a href="javascript:void(0);" id="sessionKiller">logout</a>.<span class="timer" id="timer"  style="margin-left: 10px;"></span>
    </div>';
                            } else {
                                echo '<form method="post" action="../authentication/log.inout.ajax.php">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td>Usuario:</td>
                <td><input type="text" name="login_username" id="login_username" /></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" name="login_userpass" id="login_userpass" /></td>
            </tr>
            <tr>
                <td colspan="2" align="right"><span class="timer" id="timer"></span><button id="login_userbttn">Login</button></td>
            </tr>
        </table>
    </form>';
                            }
                            ?>

                        </span></span>

                </td>
            </tr>
        </table>
    </div>
</body>

</html>
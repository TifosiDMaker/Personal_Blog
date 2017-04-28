<?php
class Admin_Driver extends CI_Driver_Library
{
    public function sessionVali()
    {
        if (array_key_exists('id', $_SESSION)) {
            if ($_SESSION['id'] == 2) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function sessionExist()
    {
        if (array_key_exists('id', $_SESSION)) {
            return 1;
        } else {
            return 0;
        }
    }
}
?>


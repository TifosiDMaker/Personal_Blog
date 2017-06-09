<?php
class Admin_Driver extends CI_Driver_Library
{
    public function sessionVali()
    {
        if (array_key_exists('permission', $_SESSION)) {
            return $_SESSION['permission'];
        } else {
            return 0;
        }
    }

    public function sessionExist()
    {
        if (array_key_exists('permission', $_SESSION)) {
            return 1;
        } else {
            return 0;
        }
    }
}

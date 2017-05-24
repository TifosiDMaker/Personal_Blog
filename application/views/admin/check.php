<?php
if($_GET)
{
    $pw = md5($_GET['currentPassword']);
    return $pw = $this->tifosi_model->passwordQuery->password;
}
?>

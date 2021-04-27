<?php
session_start();
unset($_SESSION['nip']);
unset($_SESSION['level']);
$loginUrl = './';
print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
?>
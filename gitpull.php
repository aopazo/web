<?php
exec("git pull git@github.com:aopazo/web.git master", $output, $return_var);

?>

<html>
<body>
Output:
<?php echo $output; ?>
Return Var:
<?php echo $return_var; ?>
Script ejecutado.
</body>
</html>
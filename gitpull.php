<?php
require_once '/php/VersionControl/Git.php';

// Specify a directory
$git = new VersionControl_Git('../../../../public_html/sitionuevo/test');

// create new repository
$git->createClone('git@github.com:aopazo/web.git');
$commits = $git->getCommits();


// exec("git pull git@github.com:aopazo/web.git master", $output, $return_var);
// exec("ls", $output);
?>

<html>
<body>
Commits:
<?php echo $commits; ?>
<br />
Script ejecutado.
</body>
</html>
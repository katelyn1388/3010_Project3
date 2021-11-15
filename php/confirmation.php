<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        Its a confirmation page.
        <?php
            foreach($_POST as $key => $value) {
                echo "<br/>$key : $value<br/>";
            }
        ?>
    </body>
</html>

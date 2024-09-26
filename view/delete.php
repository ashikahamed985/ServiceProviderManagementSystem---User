<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
 
</head>
<body>
    <form method="post" action="../controller/delete-user-controller.php">
                            <input type="hidden" name="id" value="<?php echo $user['']; ?>">
                            <button type="submit" name="delete_user">Delete</button>
                            <button type="submit" name="delete_user">BACK</button>
                        </form>
</body>
</html>
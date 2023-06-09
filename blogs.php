<?php
$blog_page = true; //set a variable as a trigger for the if statement on the header 
include 'header.php';

if (!isset($_SESSION['logged_in'])) {
    header('Location: index.php');
}

//data insert
if (isset($_POST['create_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    //data preparation for insertion
    $insert = $conn->prepare("INSERT INTO blog_posting (post_title, post_content) VALUES(?,?)");
    //data binding
    $insert->execute([
        $title,
        $content
    ]);

    echo "<script>
            alert('Data Inserted!');
        </script>";
}

//data update
if (isset($_POST['update_post'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $update = $conn->prepare("UPDATE blog_posting SET post_title = ?, post_content = ? WHERE post_id = ?");
    //bind/execute the data since we use the prepare() function
    $update->execute([
        $title,
        $content,
        $id
    ]);
    echo "<script>alert('Posting Successfully Updated!')</script>";
}

//delete post
if (isset($_GET['delete'])) {
    $id = $_GET['id']; //get the id from the GET request variable

    //execute the delete command
    $delete = $conn->prepare("DELETE FROM blog_posting WHERE post_id = ?");
    //bind the variable id
    $delete->execute([$id]);

    //create a notification after the delete
    echo "<script>alert('Posting Deleted!')</script>";
}
?>
<h1>This is from blog page</h1>
<div class="row">
    <div class="col-4 ms-3">
        <?php
        if (isset($_GET['edit'])) {
            $id = $_GET['id'];

            $select = $conn->prepare("SELECT * FROM blog_posting WHERE post_id = ?");
            $select->execute([$id]);

            foreach ($select as $edit) { ?>
                <form method="POST" action="blogs.php" class="row shadow p-3 mt-3" novalidate>
                    <input type="hidden" name="id" value="<?= $edit['post_id']; ?>">
                    <div class="col-12">
                        <label for="validationCustom01" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="validationCustom01" placeholder="Enter your Title" value="<?= $edit['post_title']; ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="basic-url" class="form-label">Content</label>
                        <div class="input-group">
                            <textarea type="text" name="content" class="form-control" aria-describedby="basic-addon3 basic-addon4"><?= $edit['post_title']; ?></textarea>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <button class="btn btn-danger" name="update_post">Update Post</button>
                    </div>
                </form>

            <?php }
        } else { ?>
            <form method="POST" action="blogs.php" class="row shadow p-3 mt-3" novalidate>
                <div class="col-12">
                    <label for="validationCustom01" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" id="validationCustom01" placeholder="Enter your Title" required>
                </div>
                <div class="col-12">
                    <label for="basic-url" class="form-label">Content</label>
                    <div class="input-group">
                        <textarea type="text" name="content" class="form-control" aria-describedby="basic-addon3 basic-addon4"></textarea>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <button class="btn btn-primary" name="create_post">Create Post</button>
                </div>
            </form>

        <?php   } ?>
    </div>

    <div class="col">
        <table class="table shadow me-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cnt = 1;
                $id = $_SESSION['user_id']; //get the session id to make it unique only for the user who is logged in
                $rows = $conn->prepare("SELECT * FROM postings WHERE u_id = ?");
                $rows->execute([$id]);
                foreach ($rows as $data) { ?>

                    <tr>
                        <td><?php echo $cnt++; ?></td>
                        <td><?= $data['post_title']; ?></td>
                        <td><?= $data['post_content']; ?></td>
                        <td>
                            <a href="?edit&id=<?= $data['post_id']; ?>" class="text-decoration-none">✏</a> |
                            <a href="?delete&id=<?= $data['post_id']; ?>" class="text-decoration-none">❌</a>
                        </td>
                    </tr>

                <?php   } ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</body>

</html>
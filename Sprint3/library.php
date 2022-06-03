<?php
    require_once("config.php");
    require_once("session.php");
    $error_msg = '';

    if(isset($_POST['addBookAction'])){
        $book_name = $_POST['book_name'];
        $author = $_POST['author'];
        $user_email = $_POST['email'];

        $sql = "SELECT * FROM books WHERE book_name='$book_name'";
        $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
            $error_msg = "Book is already registered";
        }else{
            $sql = "INSERT INTO books (book_name, author, user_email) VALUES ('$book_name', '$author', '$user_email')";
    
            if (mysqli_query($conn, $sql)) {
                header("Location: library.php");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/library.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login - Bookmarked</title>
</head>
<body>
    <div class="nav" id="nav">
        <h1><a href="index.php">Bookmarked</a></h1>
    <div class="navs">
        <div class="nav-list">
            <ul>
                <li><a href="library.php">My Library</li></a>
                <li><a href="about.php">About</li></a>
                <li><a href="logout.php">Logout</li></a>
            </ul>
        </div>
    </div>
</div>

    <!------Library Page------>
    <div class="text1">
        <h1>My Library</h1>
    </div>
    <!-- Button to open the modal login form -->


    <div class="table-container">
        <div class="table-header">
            <p class="error-msg"><?php echo $error_msg ?></p>
            <button onclick="document.getElementById('addbook').style.display='block'" id="btn">+ Add a Book</button>
        </div>
        <div class="table-body">
            <table id="books">
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                </tr>
                <?php
                    $email = $_SESSION['email'];
                    $sql = "SELECT * FROM books WHERE user_email='$email'";
                    $result = mysqli_query($conn, $sql);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '
                                <tr>
                                    <td>'.$row['book_name'].'</td>
                                    <td>'.$row['author'].'</td>
                                </tr>
                            ';
                        }
                    }
                ?>
            </table>
        </div>
    </div>

    <!-- The Modal -->
    <div id="addbook" class="modal">
    <span onclick="document.getElementById('addbook').style.display='none'"
    class="close" title="Close Modal">&times;</span>

    <!-- Modal Content -->
    <form class="modal-content animate" id="modal-content" action="library.php" method="POST">
        <div class="txt1">
            <h2>Please enter the book details:</h2>
        </div>

        <div class="container">
        <input type="text" placeholder="Book Title" name="book_name" required>

        <input type="text" placeholder="Author" name="author" required>

        <input type="email" value="<?php echo $_SESSION['email'] ?>" name="email" hidden required>

        <button type="submit" class="subtn" name="addBookAction">Done</button>
        </div>

        <button type="button" onclick="document.getElementById('addbook').style.display='none'" class="cancelbtn" style="margin-top: -4.5rem">Cancel</button>
        </div>
    </form>
    </div>

    <script src="modal.js"></script>

</body>
</html>
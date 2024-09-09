<?php

$content = "";
$file_exists = false;
$file_content = "";
$file_list = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['put'])) {

        $content = $_POST['content'];
        if (file_put_contents('data.txt', $content) !== false) {
            $file_exists = true;
            $file_content = "Content successfully written to the file!";
        } else {
            $file_content = "Failed to write to the file.";
        }
    } elseif (isset($_POST['get'])) {

        if (file_exists('data.txt')) {
            $file_content = file_get_contents('data.txt');
        } else {
            $file_content = "File does not exist.";
        }
    } elseif (isset($_POST['check'])) {

        $file_exists = file_exists('data.txt');
    } elseif (isset($_POST['list'])) {

        if (file_exists('data.txt')) {
            $file_array = file('data.txt');
            $file_list = "<ul>";
            foreach ($file_array as $line) {
                $file_list .= "<li>" . htmlspecialchars($line) . "</li>";
            }
            $file_list .= "</ul>";
        } else {
            $file_list = "File does not exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP File Operations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h1 {
            color: Black;
            font-weight: bold;
            font-size: 25px;
        }
        h3 {
            color: #333;
            font-size: 18px;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="submit"] {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
        }
        textarea::placeholder {
          font-size: 16px;
          color: #888;
}
        label {
            font-size: 14px;
            color: #555;
        }
        pre {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PHP File Operations of Group 4</h1>

        <h3>Put File Contents (file_put_contents)</h3>
        <form action="" method="post">
            <textarea name="content" rows="4" placeholder="Enter content here..." required><?php echo htmlspecialchars($content); ?></textarea>
            <br><br>
            <input type="submit" name="put" value="Put File Contents">
        </form>

        <h3>Get File Contents (file_get_contents)</h3>
        <form action="" method="post">
            <input type="submit" name="get" value="Get File Contents">
        </form>

        <h3>Check if File Exists (file_exists)</h3>
        <form action="" method="post">
            <input type="submit" name="check" value="Check File Exists">
        </form>

        <h3>List File Contents (file)</h3>
        <form action="" method="post">
            <input type="submit" name="list" value="List File Contents">
        </form>

        <?php if (isset($_POST['put']) || isset($_POST['get']) || isset($_POST['check']) || isset($_POST['list'])): ?>
            <div>
                <?php if (isset($_POST['put'])): ?>
                    <h3>Result:</h3>
                    <pre><?php echo htmlspecialchars($file_content); ?></pre>
                <?php elseif (isset($_POST['get'])): ?>
                    <h3>File Contents:</h3>
                    <pre><?php echo htmlspecialchars($file_content); ?></pre>
                <?php elseif (isset($_POST['check'])): ?>
                    <h3>File Exists:</h3>
                    <p><?php echo $file_exists ? "The file 'data.txt' exists." : "The file 'data.txt' does not exist."; ?></p>
                <?php elseif (isset($_POST['list'])): ?>
                    <h3>File Contents Line by Line:</h3>
                    <?php echo $file_list; ?>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

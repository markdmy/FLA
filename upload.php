<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDirectory = "uploads/";

    foreach ($_FILES["fileToUpload"]["name"] as $key => $filename) {
        $targetFile = $targetDirectory . basename($filename);

        if (file_exists($targetFile)) {
            echo "Sorry, the file already exists.";
        } else {
            // Check file size (you can set a maximum file size if needed)
            if ($_FILES["fileToUpload"]["size"][$key] > 5242880) { // 5MB in bytes
                echo "Sorry, your file is too large. Max file size is 5MB";
            } else {
                // Allow only certain file formats
                $allowedFileTypes = array("jpg", "jpeg", "png", "pdf");
                $fileExtension = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                if (!in_array($fileExtension, $allowedFileTypes)) {
                    echo "Sorry, only JPG, JPEG, PNG, and PDF files are allowed.";
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $targetFile)) {
                        echo "The file " . htmlspecialchars($filename) . " has been uploaded successfully.";
                    } else {
                        echo "There was an error uploading your file.";
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Picture Upload</title>

</head>

<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="fileInput" name="fileToUpload[]" accept=".jpg, .jpeg, .png, .pdf" multiple onchange="handleFiles()">
        <ul id="fileList"></ul>
        <input type="submit" value="Upload Files" name="submit">
    </form>
    <script src="js/upload.js"></script>
</body>

</html>
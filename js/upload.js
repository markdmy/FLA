function handleFiles() {
    var fileInput = document.getElementById("fileInput");
    var fileList = document.getElementById("fileList");
    
    // Clears the previous file list
    fileList.innerHTML = "";
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
        var listItem = document.createElement("li");
        listItem.textContent = files[i].name;
        fileList.appendChild(listItem);
    }
}
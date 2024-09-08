document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('uploadForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(form);
        uploadFiles(formData);
    });

    function uploadFiles(formData) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload.php', true);

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = (e.loaded / e.total) * 100;
                console.log(`Upload Progress: ${percentComplete}%`);
            }
        });

        xhr.addEventListener('load', function() {
            if (xhr.status == 200) {
                window.location.href = 'confirm.php';
            } else {
                alert('Error uploading files!');
            }
        });

        xhr.send(formData);
    }
});

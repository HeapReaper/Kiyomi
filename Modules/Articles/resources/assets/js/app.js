const fileUploadUrl = '/articles/upload-media';

tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    height: 600,

    media_live_embeds: true,


    images_upload_url: fileUploadUrl,
    automatic_uploads: true,

    file_picker_types: 'image media',

    file_picker_callback: (callback, value, meta) => {
        const input = document.createElement('input');
        input.setAttribute('type', 'file');

        if (meta.filetype === 'image') {
            input.setAttribute('accept', 'image/*');
        } else if (meta.filetype === 'media') {
            input.setAttribute('accept', 'video/*');
        }

        input.onchange = function () {
            const file = this.files[0];
            console.log('File selected:', file);
            const formData = new FormData();
            formData.append('file', file);

            fetch(fileUploadUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(res => res.json())
                .then(data => {
                    if (data.location) {
                        callback(data.location);
                    } else {
                        alert('Upload failed');
                    }
                })
                .catch(err => {
                    console.error('Upload error:', err);
                    alert('Error uploading file: ', err);
                });
        };

        input.click();
    },

    images_upload_handler: (blobInfo, success, failure) => {
        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch(window.uploadConfig.fileUploadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            body: formData,
        })
            .then(response => response.json())
            .then(json => {
                if (json.location) {
                    success(json.location);
                } else {
                    failure('Upload failed: ' + (json.error || 'Unknown error'));
                }
            })
            .catch(err => {
                console.error('Fetch error: ' + err.message);
            });
    },

    drag_drop: true,
});

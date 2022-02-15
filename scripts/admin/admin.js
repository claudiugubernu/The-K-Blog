console.log('admin ready');

// Delete Thumbnail Post Image
if (document.querySelector('.edit-single-post-img')) {
    imgWrapper = document.querySelector('.thumbnail-img');
    img = document.querySelector('.edit-single-post-img');
    uploadImg = document.querySelector('.upload-thumbnail');

    document.querySelector('.delete-img-icon').addEventListener('click', () => {
        imgWrapper.style.display = 'none';
        img.src = ' ';
        uploadImg.classList.add('active');
    });
}
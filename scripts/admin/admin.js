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

// Check passwords input match
const checkPasswords = () => {
    let newPassword;
    let repeatNewPassword;

    if(document.querySelector('#new-password')) {
        document.querySelector('#new-password').addEventListener('keyup', () => {
            newPassword = document.querySelector('#new-password').value;
        });
    }
    if(document.querySelector('#repeat-new-password')) {
        document.querySelector('#repeat-new-password').addEventListener('keyup', () => {
            repeatNewPassword = document.querySelector('#repeat-new-password').value;
            if(newPassword === repeatNewPassword) {
                document.querySelector('#repeat-new-password').style.backgroundColor = '#96CED1';
            } else {
                document.querySelector('#repeat-new-password').style.backgroundColor = '#F58FA1';
            }
        });
    }
}

checkPasswords();
   
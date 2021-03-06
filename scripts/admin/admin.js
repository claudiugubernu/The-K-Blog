console.log('admin ready');

// Delete Thumbnail Post Image
if (document.querySelector('.edit-single-post-img')) {
    imgWrapper = document.querySelector('.thumbnail-img');
    img = document.querySelector('.edit-single-post-img');
    uploadImg = document.querySelector('.upload-thumbnail');

    document.querySelector('.delete-img-icon').addEventListener('click', () => {
        imgWrapper.style.display = 'none';
        img.src = '';
        document.querySelector('#existing-image').value = '';
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

// Hide/Show Secret Word in User Settings
const showSecretWord = () => {
    if (document.querySelector('.secret-word-btn')) {
        document.querySelector('.secret-word-btn').addEventListener('click', () => {
            document.querySelector('.secret-word-blur').classList.add('active');
            document.querySelector('.secret-word-btn').classList.add('active');
            coverSecretWord();
        });
    }
}

const coverSecretWord = () => {
    setTimeout(
    function() {
        document.querySelector('.secret-word-blur').classList.remove('active');
        document.querySelector('.secret-word-btn').classList.remove('active');
    },  8.0*1000);
}
showSecretWord();

// Navbar Extra Options Controller
const showExtraOptions = () => {
    let adminSignOut = document.querySelector('.admin-sign-out');
    if (adminSignOut) {
        adminSignOut.addEventListener('click', () => {
            document.querySelector('.fake-dropdown').classList.toggle('active');
        });
    }
}
showExtraOptions();

// Show Welcome Widget
const showWelcomeWidget = () => {
    let welcomeWidget = document.querySelector('.admin-welcome');

    function hideWidget() {
        welcomeWidget.classList.remove('active');
    }

    if(welcomeWidget) {
        if (welcomeWidget.classList.contains('logged-in')) {
            welcomeWidget.classList.add('active');
            // Add it to sessionStorage
            sessionStorage.setItem('welcomeWidget', 'true');
            // After 3 seconds hide the widget
            setTimeout(()=> {
                hideWidget();
            }, 2000);
        }
    }
}

if (!sessionStorage.getItem('welcomeWidget')) {
    showWelcomeWidget();
}
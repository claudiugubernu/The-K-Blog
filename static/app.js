/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./styles/app.scss":
/*!*************************!*\
  !*** ./styles/app.scss ***!
  \*************************/
/***/ (() => {

// extracted by mini-css-extract-plugin

/***/ }),

/***/ "./scripts/admin/admin.js":
/*!********************************!*\
  !*** ./scripts/admin/admin.js ***!
  \********************************/
/***/ (() => {

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

    adminSignOut.addEventListener('click', () => {
        document.querySelector('.fake-dropdown').classList.toggle('active');
    });
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

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!************************!*\
  !*** ./scripts/app.js ***!
  \************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../styles/app.scss */ "./styles/app.scss");
/* harmony import */ var _styles_app_scss__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_styles_app_scss__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _admin_admin_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./admin/admin.js */ "./scripts/admin/admin.js");
/* harmony import */ var _admin_admin_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_admin_admin_js__WEBPACK_IMPORTED_MODULE_1__);

// ADMIN JS //


console.log('ready');

})();

/******/ })()
;
//# sourceMappingURL=app.js.map
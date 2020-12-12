(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.NavigationController = void 0;
var NavigationController = /** @class */ (function () {
    function NavigationController() {
        var elements = window.document.querySelectorAll('.dropdown-trigger');
        var instances = M.Dropdown.init(elements, { hover: false, alignment: 'right' });
    }
    return NavigationController;
}());
exports.NavigationController = NavigationController;

},{}],2:[function(require,module,exports){
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
exports.ShareController = void 0;
var Fetch_1 = require("../Utility/Fetch");
var ShareController = /** @class */ (function () {
    function ShareController() {
        this.initializeModal();
        this.initializeShareLinks();
    }
    ShareController.prototype.initializeModal = function () {
        this.modal = window.document.querySelector('#shareModal');
        this.message = this.modal.querySelector('.modal-content p');
        this.acceptButton = this.modal.querySelector('.modal-footer .green');
        this.acceptButton.addEventListener('click', this.acceptButtonClicked.bind(this));
        this.instance = M.Modal.init(this.modal, { dismissible: false });
    };
    ShareController.prototype.initializeShareLinks = function () {
        var _this = this;
        this.shareLinks = [].slice.call(window.document.querySelectorAll('.share-link'));
        this.shareLinks.forEach(function (shareLink) {
            shareLink.addEventListener('click', _this.linkClicked.bind(_this));
        });
    };
    ShareController.prototype.linkClicked = function (event) {
        event.preventDefault();
        var shareLink = event.currentTarget;
        this.message.innerHTML = shareLink.dataset['message'];
        this.acceptButton.innerHTML = shareLink.dataset['ok'];
        if (shareLink.dataset['uri'] !== undefined) {
            this.acceptButton.dataset['action'] = 'share';
            this.acceptButton.dataset['uri'] = shareLink.dataset['uri'];
        }
        else {
            this.acceptButton.dataset['action'] = 'copy';
            this.acceptButton.dataset['uri'] = shareLink.href;
        }
        this.openModal();
    };
    ShareController.prototype.openModal = function () {
        this.instance.open();
    };
    ShareController.prototype.acceptButtonClicked = function () {
        if (this.acceptButton.dataset['action'] == 'share') {
            this.enableSharingViaAjax(this.acceptButton.dataset['uri']);
        }
        else {
            this.copyToClipboard(this.acceptButton.dataset['uri']);
        }
    };
    ShareController.prototype.enableSharingViaAjax = function (uri) {
        new Fetch_1.Fetch(uri).then(this.processResponse.bind(this));
    };
    ShareController.prototype.processResponse = function (response) {
        var data = JSON.parse(response.responseText);
        this.message.innerHTML = data['message'];
        this.acceptButton.innerHTML = data['ok'];
        this.acceptButton.dataset['action'] = 'copy';
        this.acceptButton.dataset['uri'] = data['href'];
        this.openModal();
    };
    ShareController.prototype.copyToClipboard = function (uri) {
        var temporaryElement = document.createElement('textarea');
        temporaryElement.value = uri;
        document.body.appendChild(temporaryElement);
        temporaryElement.select();
        document.execCommand('copy');
        document.body.removeChild(temporaryElement);
    };
    ;
    return ShareController;
}());
exports.ShareController = ShareController;

},{"../Utility/Fetch":3}],3:[function(require,module,exports){
'use strict';
Object.defineProperty(exports, "__esModule", { value: true });
exports.Fetch = void 0;
var Fetch = /** @class */ (function () {
    function Fetch(url, options) {
        this.onFulfillment = [];
        this.onError = [];
        this.onCompletion = [];
        var xhr = new XMLHttpRequest();
        var method = 'GET' || options.method;
        var internalFetchContext = this;
        xhr.onreadystatechange = function () {
            var _data = this;
            if (this.readyState == 4 && this.status == 200) {
                // Action to be performed when the document is read;
                internalFetchContext.onFulfillment.forEach(function (callback) {
                    callback(_data);
                });
                internalFetchContext.onCompletion.forEach(function (callback) {
                    callback(_data);
                });
            }
            else if (this.readyState == 4 && this.status !== 200) {
                internalFetchContext.onError.forEach(function (callback) {
                    callback(_data);
                });
                internalFetchContext.onCompletion.forEach(function (callback) {
                    callback(_data);
                });
            }
        };
        xhr.open(method, url, true);
        xhr.send();
    }
    Fetch.prototype.then = function (fulfillmentFunction) {
        this.onFulfillment.push(fulfillmentFunction);
        return this;
    };
    ;
    Fetch.prototype.catch = function (errorFunction) {
        this.onError.push(errorFunction);
        return this;
    };
    ;
    Fetch.prototype.finally = function (completionFunction) {
        this.onCompletion.push(completionFunction);
        return this;
    };
    ;
    return Fetch;
}());
exports.Fetch = Fetch;

},{}],4:[function(require,module,exports){
"use strict";
Object.defineProperty(exports, "__esModule", { value: true });
var ShareController_1 = require("./Controller/ShareController");
var NavigationController_1 = require("./Controller/NavigationController");
var PackingList = /** @class */ (function () {
    function PackingList() {
        new ShareController_1.ShareController();
        new NavigationController_1.NavigationController();
    }
    return PackingList;
}());
exports.default = PackingList;
new PackingList();

},{"./Controller/NavigationController":1,"./Controller/ShareController":2}]},{},[4])


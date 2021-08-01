nhn.husky.SE_LocalImage = jindo.$Class({
    name: "SE_LocalImage",
    $init: function (elAppContainer) {
        this._assignHTMLObjects(elAppContainer);
    },

    _assignHTMLObjects: function (elAppContainer) {
        this.oFile = cssquery.getSingle(".local-image", elAppContainer);
    },

    $ON_MSG_APP_READY: function () {
        this.oApp.exec("REGISTER_UI_EVENT", ["LocalImage", "click", "OPEN_FILE"]);
        this.oApp.registerBrowserEvent(this.oFile, 'change', 'BASE64_IMAGE_FROM_FILE');
    },

    $ON_OPEN_FILE: function () {
        this.oFile.click();
    },

    $ON_BASE64_IMAGE_FROM_FILE: function (ev) {
        var file = ev.element.files[0];
        var reader = new FileReader();
        var editor = this;
        reader.onloadend = function () {
            editor.oApp.exec("PASTE_HTML", ['<img src="' + reader.result + '"/>']);
        }
        reader.readAsDataURL(file);
    },

    _getBase64ImageFromURL: function (src, callback, outputFormat) {
        var img = new Image();
        img.crossOrigin = 'Anonymous';
        img.onload = function () {
            var canvas = document.createElement('CANVAS');
            var ctx = canvas.getContext('2d');
            var dataURL;
            canvas.height = this.naturalHeight;
            canvas.width = this.naturalWidth;
            ctx.drawImage(this, 0, 0);
            dataURL = canvas.toDataURL(outputFormat);
            callback(dataURL);
        };
        img.src = src;
        if (img.complete || img.complete === undefined) {
            img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
            img.src = src;
        }
    }
});

swef = {

    initialised                 : null
   ,apiEndpoint                 : ''
   ,apiPostKey                  : ''
   ,userUUID                    : ''
   ,waitElement                 : null

   ,_init : function (uuid) {
        if (this.initialised) {
            return;
        }
        // Define user
        this.userUUID           = uuid;
        // Handle all form submissions
        var forms               = document.getElementsByTagName ('form');
        for (i in forms) {
            if (typeof(forms[i])!='object') {
                continue;
            }
            forms[i].addEventListener  ('submit',this.wait);
        }
        // Wait element
        this.waitElement        = document.createElement ('div');
        this.waitElement.setAttribute ('id','wait');
        // Done
        this.initialised        = true;
    }

   ,apiSend : function (jsonObject,callbackFunction,callbackArgs) {
        var xhr                 = new XMLHttpRequest();
        xhr.open ('POST',this.apiEndpoint);
        xhr.setRequestHeader ('Content-Type','application/x-www-form-urlencoded');
        xhr.onload              = function () { callbackFunction (xhr,callbackArgs); }
        xhr.send (this.apiPostKey+'='+encodeURIComponent(JSON.stringify(jsonObject)));
    }

   ,apiSet (endpoint,postKey) {
        this.apiEndpoint        = endpoint;
        this.apiPostKey         = postKey;
    }

   ,escapeHTML : function (str) {
        var ele = document.createElement('p');
        var txt = document.createTextNode(str);
        ele.appendChild (txt);
        return ele.innerHTML;
    }

   ,notify : function (message) {
        while (this.notes.lastChild) {
            this.notes.removeChild (this.notes.lastChild);
        }
        this.note            = document.createElement ('div');
        this.note.setAttribute ('class','note');
        this.note.innerHTML  = message;
        this.notes.appendChild (this.note);
        this.notes.style.display = 'block';
    }

   ,notifyElement : function (elmtID) {
        this.notesID         = elmtID;
        this.notes           = document.getElementById (elmtID);
        if (this.notes==undefined) {
            this.notes       = document.createElement ('div');
            this.notes.setAttribute ('id',this.notesID);
            document.body.appendChild (this.notes);
            this.notes.style.display = 'none';
        }
        var notes            = this.notes;
        this.notes.addEventListener ('click',function () {
                notes.style.display = 'none';
            }
        );
    }

   ,objectInfo : function (obj) {
        return Object.getOwnPropertyNames (obj);
    }

   ,slug : function (str,elmtId) {
        str     = str.toString    ( );
        str     = str.toLowerCase ( );
        str     = str.replace     ( /\?/g,         '~' );     // ?            -> ~
        str     = str.replace     ( /\!/g,         '~' );     // !            -> ~
        str     = str.replace     ( /\~\~+/g,      '~' );     // n x ~        -> ~
        str     = str.replace     ( /\s+/g,        '-' );     // Space        -> -
        str     = str.replace     ( /\-\-+/g,      '-' );     // n x -        -> -
        str     = str.replace     ( /[^\w\-\~]+/g, ''  );     // Non-word     ->
        str     = str.replace     ( /^-+/,         ''  );     // Left trim
        str     = str.replace     ( /-+$/,         ''  );     // Right trim
        document.getElementById(elmtId).value = str;
    }

   ,title : function (elmt) {
        str     = elmt.value;
        str     = str.replace     ( /\s\s+/g,      ' ' );     // n x space    -> space
        str     = str.replace     ( /^\s+/,        ''  );     // Left trim
        str     = str.replace     ( /\s+$/,        ''  );     // Right trim
        elmt.value = str;
    }

   ,unwait : function ( ) {
        document.body.removeChild (this.waitElement);
    }

   ,wait : function ( ) {
        if (typeof(this.waitElement)!='object') {
            return;
        }
        document.body.appendChild (this.waitElement);
    }

}


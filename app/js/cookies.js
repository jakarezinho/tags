    
     //////////////////////// VUE//////////////////
        /// delete cookie ///
        ////document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        /////////// COKKIE USER //////
    
    ////// SET COOKIE USER
    export function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = `${cname}=${cvalue};SameSite=None;expires${expires};path=/;`

    }

     /// GET COOKIE USER  /////

    export function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    
        ///// CHECK COOKIE

    export function checkCookie() {
            var userid = getCookie("username");
            if (userid != "") {
                return userid
            } else {
                /// randon user id 
                let d = new Date();
                let n = d.getTime();

                userid = Math.floor(Math.random() * n);
                if (userid != "" && userid != null) {
                    setCookie("username", userid, 30);
                }
            }
            return userid

        }

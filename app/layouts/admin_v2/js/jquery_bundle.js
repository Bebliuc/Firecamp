/*
 * jQuery JavaScript Library v1.4.2
 * http://jquery.com/
 *
 * Copyright 2010, John Resig
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * Includes Sizzle.js
 * http://sizzlejs.com/
 * Copyright 2010, The Dojo Foundation
 * Released under the MIT, BSD, and GPL Licenses.
 *
 * Date: Sat Feb 13 22:33:48 2010 -0500
 */
(function (aO, I) {
    function a0() {
        if (!ah.isReady) {
            try {
                M.documentElement.doScroll("left")
            } catch (c) {
                setTimeout(a0, 1);
                return
            }
            ah.ready()
        }
    }
    function E(s, c) {
        c.src ? ah.ajax({
            url: c.src,
            async: false,
            dataType: "script"
        }) : ah.globalEval(c.text || c.textContent || c.innerHTML || "");
        c.parentNode && c.parentNode.removeChild(c)
    }
    function ap(s, c, K, F, G, w) {
        var A = s.length;
        if (typeof c === "object") {
            for (var J in c) {
                ap(s, J, c[J], F, G, K)
            }
            return s
        }
        if (K !== I) {
            F = !w && F && ah.isFunction(K);
            for (J = 0; J < A; J++) {
                G(s[J], c, F ? K.call(s[J], J, G(s[J], c)) : K, w)
            }
            return s
        }
        return A ? G(s[0], c) : I
    }
    function aF() {
        return (new Date).getTime()
    }
    function ao() {
        return false
    }
    function am() {
        return true
    }
    function aK(s, c, w) {
        w[0].type = s;
        return ah.event.handle.apply(c, w)
    }
    function ag(O) {
        var N, L = [],
            J = [],
            K = arguments,
            F, G, s, A, w, c;
        G = ah.data(this, "events");
        if (!(O.liveFired === this || !G || !G.live || O.button && O.type === "click")) {
            O.liveFired = this;
            var P = G.live.slice(0);
            for (A = 0; A < P.length; A++) {
                G = P[A];
                G.origType.replace(az, "") === O.type ? J.push(G.selector) : P.splice(A--, 1)
            }
            F = ah(O.target).closest(J, O.currentTarget);
            w = 0;
            for (c = F.length; w < c; w++) {
                for (A = 0; A < P.length; A++) {
                    G = P[A];
                    if (F[w].selector === G.selector) {
                        s = F[w].elem;
                        J = null;
                        if (G.preType === "mouseenter" || G.preType === "mouseleave") {
                            J = ah(O.relatedTarget).closest(G.selector)[0]
                        }
                        if (!J || J !== s) {
                            L.push({
                                elem: s,
                                handleObj: G
                            })
                        }
                    }
                }
            }
            w = 0;
            for (c = L.length; w < c; w++) {
                F = L[w];
                O.currentTarget = F.elem;
                O.data = F.handleObj.data;
                O.handleObj = F.handleObj;
                if (F.handleObj.origHandler.apply(F.elem, K) === false) {
                    N = false;
                    break
                }
            }
            return N
        }
    }
    function z(s, c) {
        return "live." + (s && s !== "*" ? s + "." : "") + c.replace(/\./g, "`").replace(/ /g, "&")
    }
    function l(c) {
        return !c || !c.parentNode || c.parentNode.nodeType === 11
    }
    function bj(s, c) {
        var w = 0;
        c.each(function () {
            if (this.nodeName === (s[w] && s[w].nodeName)) {
                var G = ah.data(s[w++]),
                    J = ah.data(this, G);
                if (G = G && G.events) {
                    delete J.handle;
                    J.events = {};
                    for (var A in G) {
                        for (var F in G[A]) {
                            ah.event.add(this, A, G[A][F], G[A][F].data)
                        }
                    }
                }
            }
        })
    }
    function a3(s, c, G) {
        var A, F, w;
        c = c && c[0] ? c[0].ownerDocument || c[0] : M;
        if (s.length === 1 && typeof s[0] === "string" && s[0].length < 512 && c === M && !aP.test(s[0]) && (ah.support.checkClone || !ak.test(s[0]))) {
            F = true;
            if (w = ah.fragments[s[0]]) {
                if (w !== 1) {
                    A = w
                }
            }
        }
        if (!A) {
            A = c.createDocumentFragment();
            ah.clean(s, c, A, G)
        }
        if (F) {
            ah.fragments[s[0]] = w ? A : 1
        }
        return {
            fragment: A,
            cacheable: F
        }
    }
    function aC(s, c) {
        var w = {};
        ah.each(D.concat.apply([], D.slice(0, c)), function () {
            w[this] = s
        });
        return w
    }
    function o(c) {
        return "scrollTo" in c && c.document ? c : c.nodeType === 9 ? c.defaultView || c.parentWindow : false
    }
    var ah = function (s, c) {
        return new ah.fn.init(s, c)
    },
        p = aO.jQuery,
        d = aO.$,
        M = aO.document,
        at, a7 = /^[^<]*(<[\w\W]+>)[^>]*$|^#([\w-]+)$/,
        aT = /^.[^:#\[\.,]*$/,
        an = /\S/,
        H = /^(\s|\u00A0)+|(\s|\u00A0)+$/g,
        q = /^<(\w+)\s*\/?>(?:<\/\1>)?$/,
        ax = navigator.userAgent,
        b = false,
        av = [],
        aB, a1 = Object.prototype.toString,
        aV = Object.prototype.hasOwnProperty,
        ay = Array.prototype.push,
        au = Array.prototype.slice,
        a6 = Array.prototype.indexOf;
    ah.fn = ah.prototype = {
        init: function (s, c) {
            var A, w;
            if (!s) {
                return this
            }
            if (s.nodeType) {
                this.context = this[0] = s;
                this.length = 1;
                return this
            }
            if (s === "body" && !c) {
                this.context = M;
                this[0] = M.body;
                this.selector = "body";
                this.length = 1;
                return this
            }
            if (typeof s === "string") {
                if ((A = a7.exec(s)) && (A[1] || !c)) {
                    if (A[1]) {
                        w = c ? c.ownerDocument || c : M;
                        if (s = q.exec(s)) {
                            if (ah.isPlainObject(c)) {
                                s = [M.createElement(s[1])];
                                ah.fn.attr.call(s, c, true)
                            } else {
                                s = [w.createElement(s[1])]
                            }
                        } else {
                            s = a3([A[1]], [w]);
                            s = (s.cacheable ? s.fragment.cloneNode(true) : s.fragment).childNodes
                        }
                        return ah.merge(this, s)
                    } else {
                        if (c = M.getElementById(A[2])) {
                            if (c.id !== A[2]) {
                                return at.find(s)
                            }
                            this.length = 1;
                            this[0] = c
                        }
                        this.context = M;
                        this.selector = s;
                        return this
                    }
                } else {
                    if (!c && /^\w+$/.test(s)) {
                        this.selector = s;
                        this.context = M;
                        s = M.getElementsByTagName(s);
                        return ah.merge(this, s)
                    } else {
                        return !c || c.jquery ? (c || at).find(s) : ah(c).find(s)
                    }
                }
            } else {
                if (ah.isFunction(s)) {
                    return at.ready(s)
                }
            }
            if (s.selector !== I) {
                this.selector = s.selector;
                this.context = s.context
            }
            return ah.makeArray(s, this)
        },
        selector: "",
        jquery: "1.4.2",
        length: 0,
        size: function () {
            return this.length
        },
        toArray: function () {
            return au.call(this, 0)
        },
        get: function (c) {
            return c == null ? this.toArray() : c < 0 ? this.slice(c)[0] : this[c]
        },
        pushStack: function (s, c, A) {
            var w = ah();
            ah.isArray(s) ? ay.apply(w, s) : ah.merge(w, s);
            w.prevObject = this;
            w.context = this.context;
            if (c === "find") {
                w.selector = this.selector + (this.selector ? " " : "") + A
            } else {
                if (c) {
                    w.selector = this.selector + "." + c + "(" + A + ")"
                }
            }
            return w
        },
        each: function (s, c) {
            return ah.each(this, s, c)
        },
        ready: function (c) {
            ah.bindReady();
            if (ah.isReady) {
                c.call(M, ah)
            } else {
                av && av.push(c)
            }
            return this
        },
        eq: function (c) {
            return c === -1 ? this.slice(c) : this.slice(c, +c + 1)
        },
        first: function () {
            return this.eq(0)
        },
        last: function () {
            return this.eq(-1)
        },
        slice: function () {
            return this.pushStack(au.apply(this, arguments), "slice", au.call(arguments).join(","))
        },
        map: function (c) {
            return this.pushStack(ah.map(this, function (s, w) {
                return c.call(s, w, s)
            }))
        },
        end: function () {
            return this.prevObject || ah(null)
        },
        push: ay,
        sort: [].sort,
        splice: [].splice
    };
    ah.fn.init.prototype = ah.fn;
    ah.extend = ah.fn.extend = function () {
        var s = arguments[0] || {},
            c = 1,
            K = arguments.length,
            F = false,
            G, w, A, J;
        if (typeof s === "boolean") {
            F = s;
            s = arguments[1] || {};
            c = 2
        }
        if (typeof s !== "object" && !ah.isFunction(s)) {
            s = {}
        }
        if (K === c) {
            s = this;
            --c
        }
        for (; c < K; c++) {
            if ((G = arguments[c]) != null) {
                for (w in G) {
                    A = s[w];
                    J = G[w];
                    if (s !== J) {
                        if (F && J && (ah.isPlainObject(J) || ah.isArray(J))) {
                            A = A && (ah.isPlainObject(A) || ah.isArray(A)) ? A : ah.isArray(J) ? [] : {};
                            s[w] = ah.extend(F, A, J)
                        } else {
                            if (J !== I) {
                                s[w] = J
                            }
                        }
                    }
                }
            }
        }
        return s
    };
    ah.extend({
        noConflict: function (c) {
            aO.$ = d;
            if (c) {
                aO.jQuery = p
            }
            return ah
        },
        isReady: false,
        ready: function () {
            if (!ah.isReady) {
                if (!M.body) {
                    return setTimeout(ah.ready, 13)
                }
                ah.isReady = true;
                if (av) {
                    for (var s, c = 0; s = av[c++];) {
                        s.call(M, ah)
                    }
                    av = null
                }
                ah.fn.triggerHandler && ah(M).triggerHandler("ready")
            }
        },
        bindReady: function () {
            if (!b) {
                b = true;
                if (M.readyState === "complete") {
                    return ah.ready()
                }
                if (M.addEventListener) {
                    M.addEventListener("DOMContentLoaded", aB, false);
                    aO.addEventListener("load", ah.ready, false)
                } else {
                    if (M.attachEvent) {
                        M.attachEvent("onreadystatechange", aB);
                        aO.attachEvent("onload", ah.ready);
                        var s = false;
                        try {
                            s = aO.frameElement == null
                        } catch (c) {}
                        M.documentElement.doScroll && s && a0()
                    }
                }
            }
        },
        isFunction: function (c) {
            return a1.call(c) === "[object Function]"
        },
        isArray: function (c) {
            return a1.call(c) === "[object Array]"
        },
        isPlainObject: function (s) {
            if (!s || a1.call(s) !== "[object Object]" || s.nodeType || s.setInterval) {
                return false
            }
            if (s.constructor && !aV.call(s, "constructor") && !aV.call(s.constructor.prototype, "isPrototypeOf")) {
                return false
            }
            var c;
            for (c in s) {}
            return c === I || aV.call(s, c)
        },
        isEmptyObject: function (s) {
            for (var c in s) {
                return false
            }
            return true
        },
        error: function (c) {
            throw c
        },
        parseJSON: function (c) {
            if (typeof c !== "string" || !c) {
                return null
            }
            c = ah.trim(c);
            if (/^[\],:{}\s]*$/.test(c.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, "@").replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, "]").replace(/(?:^|:|,)(?:\s*\[)+/g, ""))) {
                return aO.JSON && aO.JSON.parse ? aO.JSON.parse(c) : (new Function("return " + c))()
            } else {
                ah.error("Invalid JSON: " + c)
            }
        },
        noop: function () {},
        globalEval: function (s) {
            if (s && an.test(s)) {
                var c = M.getElementsByTagName("head")[0] || M.documentElement,
                    w = M.createElement("script");
                w.type = "text/javascript";
                if (ah.support.scriptEval) {
                    w.appendChild(M.createTextNode(s))
                } else {
                    w.text = s
                }
                c.insertBefore(w, c.firstChild);
                c.removeChild(w)
            }
        },
        nodeName: function (s, c) {
            return s.nodeName && s.nodeName.toUpperCase() === c.toUpperCase()
        },
        each: function (s, c, J) {
            var F, G = 0,
                w = s.length,
                A = w === I || ah.isFunction(s);
            if (J) {
                if (A) {
                    for (F in s) {
                        if (c.apply(s[F], J) === false) {
                            break
                        }
                    }
                } else {
                    for (; G < w;) {
                        if (c.apply(s[G++], J) === false) {
                            break
                        }
                    }
                }
            } else {
                if (A) {
                    for (F in s) {
                        if (c.call(s[F], F, s[F]) === false) {
                            break
                        }
                    }
                } else {
                    for (J = s[0]; G < w && c.call(J, G, J) !== false; J = s[++G]) {}
                }
            }
            return s
        },
        trim: function (c) {
            return (c || "").replace(H, "")
        },
        makeArray: function (s, c) {
            c = c || [];
            if (s != null) {
                s.length == null || typeof s === "string" || ah.isFunction(s) || typeof s !== "function" && s.setInterval ? ay.call(c, s) : ah.merge(c, s)
            }
            return c
        },
        inArray: function (s, c) {
            if (c.indexOf) {
                return c.indexOf(s)
            }
            for (var A = 0, w = c.length; A < w; A++) {
                if (c[A] === s) {
                    return A
                }
            }
            return -1
        },
        merge: function (s, c) {
            var F = s.length,
                w = 0;
            if (typeof c.length === "number") {
                for (var A = c.length; w < A; w++) {
                    s[F++] = c[w]
                }
            } else {
                for (; c[w] !== I;) {
                    s[F++] = c[w++]
                }
            }
            s.length = F;
            return s
        },
        grep: function (s, c, G) {
            for (var A = [], F = 0, w = s.length; F < w; F++) {
                !G !== !c(s[F], F) && A.push(s[F])
            }
            return A
        },
        map: function (s, c, J) {
            for (var F = [], G, w = 0, A = s.length; w < A; w++) {
                G = c(s[w], w, J);
                if (G != null) {
                    F[F.length] = G
                }
            }
            return F.concat.apply([], F)
        },
        guid: 1,
        proxy: function (s, c, w) {
            if (arguments.length === 2) {
                if (typeof c === "string") {
                    w = s;
                    s = w[c];
                    c = I
                } else {
                    if (c && !ah.isFunction(c)) {
                        w = c;
                        c = I
                    }
                }
            }
            if (!c && s) {
                c = function () {
                    return s.apply(w || this, arguments)
                }
            }
            if (s) {
                c.guid = s.guid = s.guid || c.guid || ah.guid++
            }
            return c
        },
        uaMatch: function (c) {
            c = c.toLowerCase();
            c = /(webkit)[ \/]([\w.]+)/.exec(c) || /(opera)(?:.*version)?[ \/]([\w.]+)/.exec(c) || /(msie) ([\w.]+)/.exec(c) || !/compatible/.test(c) && /(mozilla)(?:.*? rv:([\w.]+))?/.exec(c) || [];
            return {
                browser: c[1] || "",
                version: c[2] || "0"
            }
        },
        browser: {}
    });
    ax = ah.uaMatch(ax);
    if (ax.browser) {
        ah.browser[ax.browser] = true;
        ah.browser.version = ax.version
    }
    if (ah.browser.webkit) {
        ah.browser.safari = true
    }
    if (a6) {
        ah.inArray = function (s, c) {
            return a6.call(c, s)
        }
    }
    at = ah(M);
    if (M.addEventListener) {
        aB = function () {
            M.removeEventListener("DOMContentLoaded", aB, false);
            ah.ready()
        }
    } else {
        if (M.attachEvent) {
            aB = function () {
                if (M.readyState === "complete") {
                    M.detachEvent("onreadystatechange", aB);
                    ah.ready()
                }
            }
        }
    }(function () {
        ah.support = {};
        var L = M.documentElement,
            K = M.createElement("script"),
            J = M.createElement("div"),
            F = "script" + aF();
        J.style.display = "none";
        J.innerHTML = "   <link/><table></table><a href='/a' style='color:red;float:left;opacity:.55;'>a</a><input type='checkbox'/>";
        var G = J.getElementsByTagName("*"),
            w = J.getElementsByTagName("a")[0];
        if (!(!G || !G.length || !w)) {
            ah.support = {
                leadingWhitespace: J.firstChild.nodeType === 3,
                tbody: !J.getElementsByTagName("tbody").length,
                htmlSerialize: !! J.getElementsByTagName("link").length,
                style: /red/.test(w.getAttribute("style")),
                hrefNormalized: w.getAttribute("href") === "/a",
                opacity: /^0.55$/.test(w.style.opacity),
                cssFloat: !! w.style.cssFloat,
                checkOn: J.getElementsByTagName("input")[0].value === "on",
                optSelected: M.createElement("select").appendChild(M.createElement("option")).selected,
                parentNode: J.removeChild(J.appendChild(M.createElement("div"))).parentNode === null,
                deleteExpando: true,
                checkClone: false,
                scriptEval: false,
                noCloneEvent: true,
                boxModel: null
            };
            K.type = "text/javascript";
            try {
                K.appendChild(M.createTextNode("window." + F + "=1;"))
            } catch (A) {}
            L.insertBefore(K, L.firstChild);
            if (aO[F]) {
                ah.support.scriptEval = true;
                delete aO[F]
            }
            try {
                delete K.test
            } catch (c) {
                ah.support.deleteExpando = false
            }
            L.removeChild(K);
            if (J.attachEvent && J.fireEvent) {
                J.attachEvent("onclick", function s() {
                    ah.support.noCloneEvent = false;
                    J.detachEvent("onclick", s)
                });
                J.cloneNode(true).fireEvent("onclick")
            }
            J = M.createElement("div");
            J.innerHTML = "<input type='radio' name='radiotest' checked='checked'/>";
            L = M.createDocumentFragment();
            L.appendChild(J.firstChild);
            ah.support.checkClone = L.cloneNode(true).cloneNode(true).lastChild.checked;
            ah(function () {
                var N = M.createElement("div");
                N.style.width = N.style.paddingLeft = "1px";
                M.body.appendChild(N);
                ah.boxModel = ah.support.boxModel = N.offsetWidth === 2;
                M.body.removeChild(N).style.display = "none"
            });
            L = function (N) {
                var P = M.createElement("div");
                N = "on" + N;
                var O = N in P;
                if (!O) {
                    P.setAttribute(N, "return;");
                    O = typeof P[N] === "function"
                }
                return O
            };
            ah.support.submitBubbles = L("submit");
            ah.support.changeBubbles = L("change");
            L = K = J = G = w = null
        }
    })();
    ah.props = {
        "for": "htmlFor",
        "class": "className",
        readonly: "readOnly",
        maxlength: "maxLength",
        cellspacing: "cellSpacing",
        rowspan: "rowSpan",
        colspan: "colSpan",
        tabindex: "tabIndex",
        usemap: "useMap",
        frameborder: "frameBorder"
    };
    var aH = "jQuery" + aF(),
        e = 0,
        aS = {};
    ah.extend({
        cache: {},
        expando: aH,
        noData: {
            embed: true,
            object: true,
            applet: true
        },
        data: function (s, c, F) {
            if (!(s.nodeName && ah.noData[s.nodeName.toLowerCase()])) {
                s = s == aO ? aS : s;
                var w = s[aH],
                    A = ah.cache;
                if (!w && typeof c === "string" && F === I) {
                    return null
                }
                w || (w = ++e);
                if (typeof c === "object") {
                    s[aH] = w;
                    A[w] = ah.extend(true, {}, c)
                } else {
                    if (!A[w]) {
                        s[aH] = w;
                        A[w] = {}
                    }
                }
                s = A[w];
                if (F !== I) {
                    s[c] = F
                }
                return typeof c === "string" ? s[c] : s
            }
        },
        removeData: function (s, c) {
            if (!(s.nodeName && ah.noData[s.nodeName.toLowerCase()])) {
                s = s == aO ? aS : s;
                var F = s[aH],
                    w = ah.cache,
                    A = w[F];
                if (c) {
                    if (A) {
                        delete A[c];
                        ah.isEmptyObject(A) && ah.removeData(s)
                    }
                } else {
                    if (ah.support.deleteExpando) {
                        delete s[ah.expando]
                    } else {
                        s.removeAttribute && s.removeAttribute(ah.expando)
                    }
                    delete w[F]
                }
            }
        }
    });
    ah.fn.extend({
        data: function (s, c) {
            if (typeof s === "undefined" && this.length) {
                return ah.data(this[0])
            } else {
                if (typeof s === "object") {
                    return this.each(function () {
                        ah.data(this, s)
                    })
                }
            }
            var A = s.split(".");
            A[1] = A[1] ? "." + A[1] : "";
            if (c === I) {
                var w = this.triggerHandler("getData" + A[1] + "!", [A[0]]);
                if (w === I && this.length) {
                    w = ah.data(this[0], s)
                }
                return w === I && A[1] ? this.data(A[0]) : w
            } else {
                return this.trigger("setData" + A[1] + "!", [A[0], c]).each(function () {
                    ah.data(this, s, c)
                })
            }
        },
        removeData: function (c) {
            return this.each(function () {
                ah.removeData(this, c)
            })
        }
    });
    ah.extend({
        queue: function (s, c, A) {
            if (s) {
                c = (c || "fx") + "queue";
                var w = ah.data(s, c);
                if (!A) {
                    return w || []
                }
                if (!w || ah.isArray(A)) {
                    w = ah.data(s, c, ah.makeArray(A))
                } else {
                    w.push(A)
                }
                return w
            }
        },
        dequeue: function (s, c) {
            c = c || "fx";
            var A = ah.queue(s, c),
                w = A.shift();
            if (w === "inprogress") {
                w = A.shift()
            }
            if (w) {
                c === "fx" && A.unshift("inprogress");
                w.call(s, function () {
                    ah.dequeue(s, c)
                })
            }
        }
    });
    ah.fn.extend({
        queue: function (s, c) {
            if (typeof s !== "string") {
                c = s;
                s = "fx"
            }
            if (c === I) {
                return ah.queue(this[0], s)
            }
            return this.each(function () {
                var w = ah.queue(this, s, c);
                s === "fx" && w[0] !== "inprogress" && ah.dequeue(this, s)
            })
        },
        dequeue: function (c) {
            return this.each(function () {
                ah.dequeue(this, c)
            })
        },
        delay: function (s, c) {
            s = ah.fx ? ah.fx.speeds[s] || s : s;
            c = c || "fx";
            return this.queue(c, function () {
                var w = this;
                setTimeout(function () {
                    ah.dequeue(w, c)
                }, s)
            })
        },
        clearQueue: function (c) {
            return this.queue(c || "fx", [])
        }
    });
    var be = /[\n\t]/g,
        U = /\s+/,
        a8 = /\r/g,
        aM = /href|src|style/,
        aU = /(button|input)/i,
        aw = /(button|input|object|select|textarea)/i,
        S = /^(a|area)$/i,
        aY = /radio|checkbox/;
    ah.fn.extend({
        attr: function (s, c) {
            return ap(this, s, c, true, ah.attr)
        },
        removeAttr: function (c) {
            return this.each(function () {
                ah.attr(this, c, "");
                this.nodeType === 1 && this.removeAttribute(c)
            })
        },
        addClass: function (L) {
            if (ah.isFunction(L)) {
                return this.each(function (O) {
                    var N = ah(this);
                    N.addClass(L.call(this, O, N.attr("class")))
                })
            }
            if (L && typeof L === "string") {
                for (var K = (L || "").split(U), J = 0, F = this.length; J < F; J++) {
                    var G = this[J];
                    if (G.nodeType === 1) {
                        if (G.className) {
                            for (var w = " " + G.className + " ", A = G.className, c = 0, s = K.length; c < s; c++) {
                                if (w.indexOf(" " + K[c] + " ") < 0) {
                                    A += " " + K[c]
                                }
                            }
                            G.className = ah.trim(A)
                        } else {
                            G.className = L
                        }
                    }
                }
            }
            return this
        },
        removeClass: function (s) {
            if (ah.isFunction(s)) {
                return this.each(function (L) {
                    var N = ah(this);
                    N.removeClass(s.call(this, L, N.attr("class")))
                })
            }
            if (s && typeof s === "string" || s === I) {
                for (var c = (s || "").split(U), K = 0, F = this.length; K < F; K++) {
                    var G = this[K];
                    if (G.nodeType === 1 && G.className) {
                        if (s) {
                            for (var w = (" " + G.className + " ").replace(be, " "), A = 0, J = c.length; A < J; A++) {
                                w = w.replace(" " + c[A] + " ", " ")
                            }
                            G.className = ah.trim(w)
                        } else {
                            G.className = ""
                        }
                    }
                }
            }
            return this
        },
        toggleClass: function (s, c) {
            var A = typeof s,
                w = typeof c === "boolean";
            if (ah.isFunction(s)) {
                return this.each(function (G) {
                    var F = ah(this);
                    F.toggleClass(s.call(this, G, F.attr("class"), c), c)
                })
            }
            return this.each(function () {
                if (A === "string") {
                    for (var K, G = 0, J = ah(this), L = c, F = s.split(U); K = F[G++];) {
                        L = w ? L : !J.hasClass(K);
                        J[L ? "addClass" : "removeClass"](K)
                    }
                } else {
                    if (A === "undefined" || A === "boolean") {
                        this.className && ah.data(this, "__className__", this.className);
                        this.className = this.className || s === false ? "" : ah.data(this, "__className__") || ""
                    }
                }
            })
        },
        hasClass: function (s) {
            s = " " + s + " ";
            for (var c = 0, w = this.length; c < w; c++) {
                if ((" " + this[c].className + " ").replace(be, " ").indexOf(s) > -1) {
                    return true
                }
            }
            return false
        },
        val: function (s) {
            if (s === I) {
                var c = this[0];
                if (c) {
                    if (ah.nodeName(c, "option")) {
                        return (c.attributes.value || {}).specified ? c.value : c.text
                    }
                    if (ah.nodeName(c, "select")) {
                        var K = c.selectedIndex,
                            F = [],
                            G = c.options;
                        c = c.type === "select-one";
                        if (K < 0) {
                            return null
                        }
                        var w = c ? K : 0;
                        for (K = c ? K + 1 : G.length; w < K; w++) {
                            var A = G[w];
                            if (A.selected) {
                                s = ah(A).val();
                                if (c) {
                                    return s
                                }
                                F.push(s)
                            }
                        }
                        return F
                    }
                    if (aY.test(c.type) && !ah.support.checkOn) {
                        return c.getAttribute("value") === null ? "on" : c.value
                    }
                    return (c.value || "").replace(a8, "")
                }
                return I
            }
            var J = ah.isFunction(s);
            return this.each(function (L) {
                var P = ah(this),
                    O = s;
                if (this.nodeType === 1) {
                    if (J) {
                        O = s.call(this, L, P.val())
                    }
                    if (typeof O === "number") {
                        O += ""
                    }
                    if (ah.isArray(O) && aY.test(this.type)) {
                        this.checked = ah.inArray(P.val(), O) >= 0
                    } else {
                        if (ah.nodeName(this, "select")) {
                            var N = ah.makeArray(O);
                            ah("option", this).each(function () {
                                this.selected = ah.inArray(ah(this).val(), N) >= 0
                            });
                            if (!N.length) {
                                this.selectedIndex = -1
                            }
                        } else {
                            this.value = O
                        }
                    }
                }
            })
        }
    });
    ah.extend({
        attrFn: {
            val: true,
            css: true,
            html: true,
            text: true,
            data: true,
            width: true,
            height: true,
            offset: true
        },
        attr: function (s, c, G, A) {
            if (!s || s.nodeType === 3 || s.nodeType === 8) {
                return I
            }
            if (A && c in ah.attrFn) {
                return ah(s)[c](G)
            }
            A = s.nodeType !== 1 || !ah.isXMLDoc(s);
            var F = G !== I;
            c = A && ah.props[c] || c;
            if (s.nodeType === 1) {
                var w = aM.test(c);
                if (c in s && A && !w) {
                    if (F) {
                        c === "type" && aU.test(s.nodeName) && s.parentNode && ah.error("type property can't be changed");
                        s[c] = G
                    }
                    if (ah.nodeName(s, "form") && s.getAttributeNode(c)) {
                        return s.getAttributeNode(c).nodeValue
                    }
                    if (c === "tabIndex") {
                        return (c = s.getAttributeNode("tabIndex")) && c.specified ? c.value : aw.test(s.nodeName) || S.test(s.nodeName) && s.href ? 0 : I
                    }
                    return s[c]
                }
                if (!ah.support.style && A && c === "style") {
                    if (F) {
                        s.style.cssText = "" + G
                    }
                    return s.style.cssText
                }
                F && s.setAttribute(c, "" + G);
                s = !ah.support.hrefNormalized && A && w ? s.getAttribute(c, 2) : s.getAttribute(c);
                return s === null ? I : s
            }
            return ah.style(s, c, G)
        }
    });
    var az = /\.(.*)$/,
        r = function (c) {
            return c.replace(/[^\w\s\.\|`]/g, function (s) {
                return "\\" + s
            })
        };
    ah.event = {
        add: function (P, O, L, J) {
            if (!(P.nodeType === 3 || P.nodeType === 8)) {
                if (P.setInterval && P !== aO && !P.frameElement) {
                    P = aO
                }
                var K, F;
                if (L.handler) {
                    K = L;
                    L = K.handler
                }
                if (!L.guid) {
                    L.guid = ah.guid++
                }
                if (F = ah.data(P)) {
                    var G = F.events = F.events || {},
                        s = F.handle;
                    if (!s) {
                        F.handle = s = function () {
                            return typeof ah !== "undefined" && !ah.event.triggered ? ah.event.handle.apply(s.elem, arguments) : I
                        }
                    }
                    s.elem = P;
                    O = O.split(" ");
                    for (var A, w = 0, c; A = O[w++];) {
                        F = K ? ah.extend({}, K) : {
                            handler: L,
                            data: J
                        };
                        if (A.indexOf(".") > -1) {
                            c = A.split(".");
                            A = c.shift();
                            F.namespace = c.slice(0).sort().join(".")
                        } else {
                            c = [];
                            F.namespace = ""
                        }
                        F.type = A;
                        F.guid = L.guid;
                        var Q = G[A],
                            N = ah.event.special[A] || {};
                        if (!Q) {
                            Q = G[A] = [];
                            if (!N.setup || N.setup.call(P, J, c, s) === false) {
                                if (P.addEventListener) {
                                    P.addEventListener(A, s, false)
                                } else {
                                    P.attachEvent && P.attachEvent("on" + A, s)
                                }
                            }
                        }
                        if (N.add) {
                            N.add.call(P, F);
                            if (!F.handler.guid) {
                                F.handler.guid = L.guid
                            }
                        }
                        Q.push(F);
                        ah.event.global[A] = true
                    }
                    P = null
                }
            }
        },
        global: {},
        remove: function (R, Q, O, L) {
            if (!(R.nodeType === 3 || R.nodeType === 8)) {
                var N, J = 0,
                    K, A, G, F, c, T, P = ah.data(R),
                    s = P && P.events;
                if (P && s) {
                    if (Q && Q.type) {
                        O = Q.handler;
                        Q = Q.type
                    }
                    if (!Q || typeof Q === "string" && Q.charAt(0) === ".") {
                        Q = Q || "";
                        for (N in s) {
                            ah.event.remove(R, N + Q)
                        }
                    } else {
                        for (Q = Q.split(" "); N = Q[J++];) {
                            F = N;
                            K = N.indexOf(".") < 0;
                            A = [];
                            if (!K) {
                                A = N.split(".");
                                N = A.shift();
                                G = new RegExp("(^|\\.)" + ah.map(A.slice(0).sort(), r).join("\\.(?:.*\\.)?") + "(\\.|$)")
                            }
                            if (c = s[N]) {
                                if (O) {
                                    F = ah.event.special[N] || {};
                                    for (w = L || 0; w < c.length; w++) {
                                        T = c[w];
                                        if (O.guid === T.guid) {
                                            if (K || G.test(T.namespace)) {
                                                L == null && c.splice(w--, 1);
                                                F.remove && F.remove.call(R, T)
                                            }
                                            if (L != null) {
                                                break
                                            }
                                        }
                                    }
                                    if (c.length === 0 || L != null && c.length === 1) {
                                        if (!F.teardown || F.teardown.call(R, A) === false) {
                                            aG(R, N, P.handle)
                                        }
                                        delete s[N]
                                    }
                                } else {
                                    for (var w = 0; w < c.length; w++) {
                                        T = c[w];
                                        if (K || G.test(T.namespace)) {
                                            ah.event.remove(R, F, T.handler, w);
                                            c.splice(w--, 1)
                                        }
                                    }
                                }
                            }
                        }
                        if (ah.isEmptyObject(s)) {
                            if (Q = P.handle) {
                                Q.elem = null
                            }
                            delete P.events;
                            delete P.handle;
                            ah.isEmptyObject(P) && ah.removeData(R)
                        }
                    }
                }
            }
        },
        trigger: function (N, L, K, G) {
            var J = N.type || N;
            if (!G) {
                N = typeof N === "object" ? N[aH] ? N : ah.extend(ah.Event(J), N) : ah.Event(J);
                if (J.indexOf("!") >= 0) {
                    N.type = J = J.slice(0, -1);
                    N.exclusive = true
                }
                if (!K) {
                    N.stopPropagation();
                    ah.event.global[J] && ah.each(ah.cache, function () {
                        this.events && this.events[J] && ah.event.trigger(N, L, this.handle.elem)
                    })
                }
                if (!K || K.nodeType === 3 || K.nodeType === 8) {
                    return I
                }
                N.result = I;
                N.target = K;
                L = ah.makeArray(L);
                L.unshift(N)
            }
            N.currentTarget = K;
            (G = ah.data(K, "handle")) && G.apply(K, L);
            G = K.parentNode || K.ownerDocument;
            try {
                if (!(K && K.nodeName && ah.noData[K.nodeName.toLowerCase()])) {
                    if (K["on" + J] && K["on" + J].apply(K, L) === false) {
                        N.result = false
                    }
                }
            } catch (A) {}
            if (!N.isPropagationStopped() && G) {
                ah.event.trigger(N, L, G, true)
            } else {
                if (!N.isDefaultPrevented()) {
                    G = N.target;
                    var F, c = ah.nodeName(G, "a") && J === "click",
                        w = ah.event.special[J] || {};
                    if ((!w._default || w._default.call(K, N) === false) && !c && !(G && G.nodeName && ah.noData[G.nodeName.toLowerCase()])) {
                        try {
                            if (G[J]) {
                                if (F = G["on" + J]) {
                                    G["on" + J] = null
                                }
                                ah.event.triggered = true;
                                G[J]()
                            }
                        } catch (s) {}
                        if (F) {
                            G["on" + J] = F
                        }
                        ah.event.triggered = false
                    }
                }
            }
        },
        handle: function (s) {
            var c, J, F, G;
            s = arguments[0] = ah.event.fix(s || aO.event);
            s.currentTarget = this;
            c = s.type.indexOf(".") < 0 && !s.exclusive;
            if (!c) {
                J = s.type.split(".");
                s.type = J.shift();
                F = new RegExp("(^|\\.)" + J.slice(0).sort().join("\\.(?:.*\\.)?") + "(\\.|$)")
            }
            G = ah.data(this, "events");
            J = G[s.type];
            if (G && J) {
                J = J.slice(0);
                G = 0;
                for (var w = J.length; G < w; G++) {
                    var A = J[G];
                    if (c || F.test(A.namespace)) {
                        s.handler = A.handler;
                        s.data = A.data;
                        s.handleObj = A;
                        A = A.handler.apply(this, arguments);
                        if (A !== I) {
                            s.result = A;
                            if (A === false) {
                                s.preventDefault();
                                s.stopPropagation()
                            }
                        }
                        if (s.isImmediatePropagationStopped()) {
                            break
                        }
                    }
                }
            }
            return s.result
        },
        props: "altKey attrChange attrName bubbles button cancelable charCode clientX clientY ctrlKey currentTarget data detail eventPhase fromElement handler keyCode layerX layerY metaKey newValue offsetX offsetY originalTarget pageX pageY prevValue relatedNode relatedTarget screenX screenY shiftKey srcElement target toElement view wheelDelta which".split(" "),
        fix: function (s) {
            if (s[aH]) {
                return s
            }
            var c = s;
            s = ah.Event(c);
            for (var A = this.props.length, w; A;) {
                w = this.props[--A];
                s[w] = c[w]
            }
            if (!s.target) {
                s.target = s.srcElement || M
            }
            if (s.target.nodeType === 3) {
                s.target = s.target.parentNode
            }
            if (!s.relatedTarget && s.fromElement) {
                s.relatedTarget = s.fromElement === s.target ? s.toElement : s.fromElement
            }
            if (s.pageX == null && s.clientX != null) {
                c = M.documentElement;
                A = M.body;
                s.pageX = s.clientX + (c && c.scrollLeft || A && A.scrollLeft || 0) - (c && c.clientLeft || A && A.clientLeft || 0);
                s.pageY = s.clientY + (c && c.scrollTop || A && A.scrollTop || 0) - (c && c.clientTop || A && A.clientTop || 0)
            }
            if (!s.which && (s.charCode || s.charCode === 0 ? s.charCode : s.keyCode)) {
                s.which = s.charCode || s.keyCode
            }
            if (!s.metaKey && s.ctrlKey) {
                s.metaKey = s.ctrlKey
            }
            if (!s.which && s.button !== I) {
                s.which = s.button & 1 ? 1 : s.button & 2 ? 3 : s.button & 4 ? 2 : 0
            }
            return s
        },
        guid: 100000000,
        proxy: ah.proxy,
        special: {
            ready: {
                setup: ah.bindReady,
                teardown: ah.noop
            },
            live: {
                add: function (c) {
                    ah.event.add(this, c.origType, ah.extend({}, c, {
                        handler: ag
                    }))
                },
                remove: function (s) {
                    var c = true,
                        w = s.origType.replace(az, "");
                    ah.each(ah.data(this, "events").live || [], function () {
                        if (w === this.origType.replace(az, "")) {
                            return c = false
                        }
                    });
                    c && ah.event.remove(this, s.origType, ag)
                }
            },
            beforeunload: {
                setup: function (s, c, w) {
                    if (this.setInterval) {
                        this.onbeforeunload = w
                    }
                    return false
                },
                teardown: function (s, c) {
                    if (this.onbeforeunload === c) {
                        this.onbeforeunload = null
                    }
                }
            }
        }
    };
    var aG = M.removeEventListener ?
    function (s, c, w) {
        s.removeEventListener(c, w, false)
    } : function (s, c, w) {
        s.detachEvent("on" + c, w)
    };
    ah.Event = function (c) {
        if (!this.preventDefault) {
            return new ah.Event(c)
        }
        if (c && c.type) {
            this.originalEvent = c;
            this.type = c.type
        } else {
            this.type = c
        }
        this.timeStamp = aF();
        this[aH] = true
    };
    ah.Event.prototype = {
        preventDefault: function () {
            this.isDefaultPrevented = am;
            var c = this.originalEvent;
            if (c) {
                c.preventDefault && c.preventDefault();
                c.returnValue = false
            }
        },
        stopPropagation: function () {
            this.isPropagationStopped = am;
            var c = this.originalEvent;
            if (c) {
                c.stopPropagation && c.stopPropagation();
                c.cancelBubble = true
            }
        },
        stopImmediatePropagation: function () {
            this.isImmediatePropagationStopped = am;
            this.stopPropagation()
        },
        isDefaultPrevented: ao,
        isPropagationStopped: ao,
        isImmediatePropagationStopped: ao
    };
    var ae = function (s) {
        var c = s.relatedTarget;
        try {
            for (; c && c !== this;) {
                c = c.parentNode
            }
            if (c !== this) {
                s.type = s.data;
                ah.event.handle.apply(this, arguments)
            }
        } catch (w) {}
    },
        x = function (c) {
            c.type = c.data;
            ah.event.handle.apply(this, arguments)
        };
    ah.each({
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    }, function (s, c) {
        ah.event.special[s] = {
            setup: function (w) {
                ah.event.add(this, c, w && w.selector ? x : ae, s)
            },
            teardown: function (w) {
                ah.event.remove(this, c, w && w.selector ? x : ae)
            }
        }
    });
    if (!ah.support.submitBubbles) {
        ah.event.special.submit = {
            setup: function () {
                if (this.nodeName.toLowerCase() !== "form") {
                    ah.event.add(this, "click.specialSubmit", function (s) {
                        var c = s.target,
                            w = c.type;
                        if ((w === "submit" || w === "image") && ah(c).closest("form").length) {
                            return aK("submit", this, arguments)
                        }
                    });
                    ah.event.add(this, "keypress.specialSubmit", function (s) {
                        var c = s.target,
                            w = c.type;
                        if ((w === "text" || w === "password") && ah(c).closest("form").length && s.keyCode === 13) {
                            return aK("submit", this, arguments)
                        }
                    })
                } else {
                    return false
                }
            },
            teardown: function () {
                ah.event.remove(this, ".specialSubmit")
            }
        }
    }
    if (!ah.support.changeBubbles) {
        var t = /textarea|input|select/i,
            g, j = function (s) {
                var c = s.type,
                    w = s.value;
                if (c === "radio" || c === "checkbox") {
                    w = s.checked
                } else {
                    if (c === "select-multiple") {
                        w = s.selectedIndex > -1 ? ah.map(s.options, function (A) {
                            return A.selected
                        }).join("-") : ""
                    } else {
                        if (s.nodeName.toLowerCase() === "select") {
                            w = s.selectedIndex
                        }
                    }
                }
                return w
            },
            bd = function (s, c) {
                var F = s.target,
                    w, A;
                if (!(!t.test(F.nodeName) || F.readOnly)) {
                    w = ah.data(F, "_change_data");
                    A = j(F);
                    if (s.type !== "focusout" || F.type !== "radio") {
                        ah.data(F, "_change_data", A)
                    }
                    if (!(w === I || A === w)) {
                        if (w != null || A) {
                            s.type = "change";
                            return ah.event.trigger(s, c, F)
                        }
                    }
                }
            };
        ah.event.special.change = {
            filters: {
                focusout: bd,
                click: function (s) {
                    var c = s.target,
                        w = c.type;
                    if (w === "radio" || w === "checkbox" || c.nodeName.toLowerCase() === "select") {
                        return bd.call(this, s)
                    }
                },
                keydown: function (s) {
                    var c = s.target,
                        w = c.type;
                    if (s.keyCode === 13 && c.nodeName.toLowerCase() !== "textarea" || s.keyCode === 32 && (w === "checkbox" || w === "radio") || w === "select-multiple") {
                        return bd.call(this, s)
                    }
                },
                beforeactivate: function (c) {
                    c = c.target;
                    ah.data(c, "_change_data", j(c))
                }
            },
            setup: function () {
                if (this.type === "file") {
                    return false
                }
                for (var c in g) {
                    ah.event.add(this, c + ".specialChange", g[c])
                }
                return t.test(this.nodeName)
            },
            teardown: function () {
                ah.event.remove(this, ".specialChange");
                return t.test(this.nodeName)
            }
        };
        g = ah.event.special.change.filters
    }
    M.addEventListener && ah.each({
        focus: "focusin",
        blur: "focusout"
    }, function (s, c) {
        function w(A) {
            A = ah.event.fix(A);
            A.type = c;
            return ah.event.handle.call(this, A)
        }
        ah.event.special[c] = {
            setup: function () {
                this.addEventListener(s, w, true)
            },
            teardown: function () {
                this.removeEventListener(s, w, true)
            }
        }
    });
    ah.each(["bind", "one"], function (s, c) {
        ah.fn[c] = function (K, F, G) {
            if (typeof K === "object") {
                for (var w in K) {
                    this[c](w, F, K[w], G)
                }
                return this
            }
            if (ah.isFunction(F)) {
                G = F;
                F = I
            }
            var A = c === "one" ? ah.proxy(G, function (L) {
                ah(this).unbind(L, A);
                return G.apply(this, arguments)
            }) : G;
            if (K === "unload" && c !== "one") {
                this.one(K, F, G)
            } else {
                w = 0;
                for (var J = this.length; w < J; w++) {
                    ah.event.add(this[w], K, A, F)
                }
            }
            return this
        }
    });
    ah.fn.extend({
        unbind: function (s, c) {
            if (typeof s === "object" && !s.preventDefault) {
                for (var A in s) {
                    this.unbind(A, s[A])
                }
            } else {
                A = 0;
                for (var w = this.length; A < w; A++) {
                    ah.event.remove(this[A], s, c)
                }
            }
            return this
        },
        delegate: function (s, c, A, w) {
            return this.live(c, A, w, s)
        },
        undelegate: function (s, c, w) {
            return arguments.length === 0 ? this.unbind("live") : this.die(c, null, w, s)
        },
        trigger: function (s, c) {
            return this.each(function () {
                ah.event.trigger(s, c, this)
            })
        },
        triggerHandler: function (s, c) {
            if (this[0]) {
                s = ah.Event(s);
                s.preventDefault();
                s.stopPropagation();
                ah.event.trigger(s, c, this[0]);
                return s.result
            }
        },
        toggle: function (s) {
            for (var c = arguments, w = 1; w < c.length;) {
                ah.proxy(s, c[w++])
            }
            return this.click(ah.proxy(s, function (A) {
                var F = (ah.data(this, "lastToggle" + s.guid) || 0) % w;
                ah.data(this, "lastToggle" + s.guid, F + 1);
                A.preventDefault();
                return c[F].apply(this, arguments) || false
            }))
        },
        hover: function (s, c) {
            return this.mouseenter(s).mouseleave(c || s)
        }
    });
    var bh = {
        focus: "focusin",
        blur: "focusout",
        mouseenter: "mouseover",
        mouseleave: "mouseout"
    };
    ah.each(["live", "die"], function (s, c) {
        ah.fn[c] = function (O, L, N, J) {
            var K, A = 0,
                G, F, w = J || this.selector,
                P = J ? this : ah(this.context);
            if (ah.isFunction(L)) {
                N = L;
                L = I
            }
            for (O = (O || "").split(" ");
            (K = O[A++]) != null;) {
                J = az.exec(K);
                G = "";
                if (J) {
                    G = J[0];
                    K = K.replace(az, "")
                }
                if (K === "hover") {
                    O.push("mouseenter" + G, "mouseleave" + G)
                } else {
                    F = K;
                    if (K === "focus" || K === "blur") {
                        O.push(bh[K] + G);
                        K += G
                    } else {
                        K = (bh[K] || K) + G
                    }
                    c === "live" ? P.each(function () {
                        ah.event.add(this, z(K, w), {
                            data: L,
                            selector: w,
                            handler: N,
                            origType: K,
                            origHandler: N,
                            preType: F
                        })
                    }) : P.unbind(z(K, w), N)
                }
            }
            return this
        }
    });
    ah.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error".split(" "), function (s, c) {
        ah.fn[c] = function (w) {
            return w ? this.bind(c, w) : this.trigger(c)
        };
        if (ah.attrFn) {
            ah.attrFn[c] = true
        }
    });
    aO.attachEvent && !aO.addEventListener && aO.attachEvent("onunload", function () {
        for (var s in ah.cache) {
            if (ah.cache[s].handle) {
                try {
                    ah.event.remove(ah.cache[s].handle.elem)
                } catch (c) {}
            }
        }
    });
    (function () {
        function W(ab) {
            for (var aa = "", Z, Y = 0; ab[Y]; Y++) {
                Z = ab[Y];
                if (Z.nodeType === 3 || Z.nodeType === 4) {
                    aa += Z.nodeValue
                } else {
                    if (Z.nodeType !== 8) {
                        aa += W(Z.childNodes)
                    }
                }
            }
            return aa
        }
        function V(bb, ba, ab, aa, Y, Z) {
            Y = 0;
            for (var bm = aa.length; Y < bm; Y++) {
                var bn = aa[Y];
                if (bn) {
                    bn = bn[bb];
                    for (var bl = false; bn;) {
                        if (bn.sizcache === ab) {
                            bl = aa[bn.sizset];
                            break
                        }
                        if (bn.nodeType === 1 && !Z) {
                            bn.sizcache = ab;
                            bn.sizset = Y
                        }
                        if (bn.nodeName.toLowerCase() === ba) {
                            bl = bn;
                            break
                        }
                        bn = bn[bb]
                    }
                    aa[Y] = bl
                }
            }
        }
        function T(bb, ba, ab, aa, Y, Z) {
            Y = 0;
            for (var bm = aa.length; Y < bm; Y++) {
                var bn = aa[Y];
                if (bn) {
                    bn = bn[bb];
                    for (var bl = false; bn;) {
                        if (bn.sizcache === ab) {
                            bl = aa[bn.sizset];
                            break
                        }
                        if (bn.nodeType === 1) {
                            if (!Z) {
                                bn.sizcache = ab;
                                bn.sizset = Y
                            }
                            if (typeof ba !== "string") {
                                if (bn === ba) {
                                    bl = true;
                                    break
                                }
                            } else {
                                if (N.filter(ba, [bn]).length > 0) {
                                    bl = bn;
                                    break
                                }
                            }
                        }
                        bn = bn[bb]
                    }
                    aa[Y] = bl
                }
            }
        }
        var Q = /((?:\((?:\([^()]+\)|[^()]+)+\)|\[(?:\[[^[\]]*\]|['"][^'"]*['"]|[^[\]'"]+)+\]|\\.|[^ >+~,(\[\\]+)+|[>+~])(\s*,\s*)?((?:.|\r|\n)*)/g,
            R = 0,
            O = Object.prototype.toString,
            P = false,
            K = true;
        [0, 0].sort(function () {
            K = false;
            return 0
        });
        var N = function (bm, bl, ba, ab) {
            ba = ba || [];
            var Z = bl = bl || M;
            if (bl.nodeType !== 1 && bl.nodeType !== 9) {
                return []
            }
            if (!bm || typeof bm !== "string") {
                return ba
            }
            for (var aa = [], br, bs, bo, bb, bq = true, bn = s(bl), bp = bm;
            (Q.exec(""), br = Q.exec(bp)) !== null;) {
                bp = br[3];
                aa.push(br[1]);
                if (br[2]) {
                    bb = br[3];
                    break
                }
            }
            if (aa.length > 1 && G.exec(bm)) {
                if (aa.length === 2 && L.relative[aa[0]]) {
                    bs = X(aa[0] + aa[1], bl)
                } else {
                    for (bs = L.relative[aa[0]] ? [bl] : N(aa.shift(), bl); aa.length;) {
                        bm = aa.shift();
                        if (L.relative[bm]) {
                            bm += aa.shift()
                        }
                        bs = X(bm, bs)
                    }
                }
            } else {
                if (!ab && aa.length > 1 && bl.nodeType === 9 && !bn && L.match.ID.test(aa[0]) && !L.match.ID.test(aa[aa.length - 1])) {
                    br = N.find(aa.shift(), bl, bn);
                    bl = br.expr ? N.filter(br.expr, br.set)[0] : br.set[0]
                }
                if (bl) {
                    br = ab ? {
                        expr: aa.pop(),
                        set: c(ab)
                    } : N.find(aa.pop(), aa.length === 1 && (aa[0] === "~" || aa[0] === "+") && bl.parentNode ? bl.parentNode : bl, bn);
                    bs = br.expr ? N.filter(br.expr, br.set) : br.set;
                    if (aa.length > 0) {
                        bo = c(bs)
                    } else {
                        bq = false
                    }
                    for (; aa.length;) {
                        var Y = aa.pop();
                        br = Y;
                        if (L.relative[Y]) {
                            br = aa.pop()
                        } else {
                            Y = ""
                        }
                        if (br == null) {
                            br = bl
                        }
                        L.relative[Y](bo, br, bn)
                    }
                } else {
                    bo = []
                }
            }
            bo || (bo = bs);
            bo || N.error(Y || bm);
            if (O.call(bo) === "[object Array]") {
                if (bq) {
                    if (bl && bl.nodeType === 1) {
                        for (bm = 0; bo[bm] != null; bm++) {
                            if (bo[bm] && (bo[bm] === true || bo[bm].nodeType === 1 && A(bl, bo[bm]))) {
                                ba.push(bs[bm])
                            }
                        }
                    } else {
                        for (bm = 0; bo[bm] != null; bm++) {
                            bo[bm] && bo[bm].nodeType === 1 && ba.push(bs[bm])
                        }
                    }
                } else {
                    ba.push.apply(ba, bo)
                }
            } else {
                c(bo, ba)
            }
            if (bb) {
                N(bb, Z, ba, ab);
                N.uniqueSort(ba)
            }
            return ba
        };
        N.uniqueSort = function (Z) {
            if (J) {
                P = K;
                Z.sort(J);
                if (P) {
                    for (var Y = 1; Y < Z.length; Y++) {
                        Z[Y] === Z[Y - 1] && Z.splice(Y--, 1)
                    }
                }
            }
            return Z
        };
        N.matches = function (Z, Y) {
            return N(Z, null, null, Y)
        };
        N.find = function (bb, ba, ab) {
            var aa, Y;
            if (!bb) {
                return []
            }
            for (var Z = 0, bm = L.order.length; Z < bm; Z++) {
                var bn = L.order[Z];
                if (Y = L.leftMatch[bn].exec(bb)) {
                    var bl = Y[1];
                    Y.splice(1, 1);
                    if (bl.substr(bl.length - 1) !== "\\") {
                        Y[1] = (Y[1] || "").replace(/\\/g, "");
                        aa = L.find[bn](Y, ba, ab);
                        if (aa != null) {
                            bb = bb.replace(L.match[bn], "");
                            break
                        }
                    }
                }
            }
            aa || (aa = ba.getElementsByTagName("*"));
            return {
                set: aa,
                expr: bb
            }
        };
        N.filter = function (bn, bm, bb, ab) {
            for (var Z = bn, aa = [], bt = bm, bu, bq, bl = bm && bm[0] && s(bm[0]); bn && bm.length;) {
                for (var bs in L.filter) {
                    if ((bu = L.leftMatch[bs].exec(bn)) != null && bu[2]) {
                        var bo = L.filter[bs],
                            br, Y;
                        Y = bu[1];
                        bq = false;
                        bu.splice(1, 1);
                        if (Y.substr(Y.length - 1) !== "\\") {
                            if (bt === aa) {
                                aa = []
                            }
                            if (L.preFilter[bs]) {
                                if (bu = L.preFilter[bs](bu, bt, bb, aa, ab, bl)) {
                                    if (bu === true) {
                                        continue
                                    }
                                } else {
                                    bq = br = true
                                }
                            }
                            if (bu) {
                                for (var ba = 0;
                                (Y = bt[ba]) != null; ba++) {
                                    if (Y) {
                                        br = bo(Y, bu, ba, bt);
                                        var bp = ab ^ !! br;
                                        if (bb && br != null) {
                                            if (bp) {
                                                bq = true
                                            } else {
                                                bt[ba] = false
                                            }
                                        } else {
                                            if (bp) {
                                                aa.push(Y);
                                                bq = true
                                            }
                                        }
                                    }
                                }
                            }
                            if (br !== I) {
                                bb || (bt = aa);
                                bn = bn.replace(L.match[bs], "");
                                if (!bq) {
                                    return []
                                }
                                break
                            }
                        }
                    }
                }
                if (bn === Z) {
                    if (bq == null) {
                        N.error(bn)
                    } else {
                        break
                    }
                }
                Z = bn
            }
            return bt
        };
        N.error = function (Y) {
            throw "Syntax error, unrecognized expression: " + Y
        };
        var L = N.selectors = {
            order: ["ID", "NAME", "TAG"],
            match: {
                ID: /#((?:[\w\u00c0-\uFFFF-]|\\.)+)/,
                CLASS: /\.((?:[\w\u00c0-\uFFFF-]|\\.)+)/,
                NAME: /\[name=['"]*((?:[\w\u00c0-\uFFFF-]|\\.)+)['"]*\]/,
                ATTR: /\[\s*((?:[\w\u00c0-\uFFFF-]|\\.)+)\s*(?:(\S?=)\s*(['"]*)(.*?)\3|)\s*\]/,
                TAG: /^((?:[\w\u00c0-\uFFFF\*-]|\\.)+)/,
                CHILD: /:(only|nth|last|first)-child(?:\((even|odd|[\dn+-]*)\))?/,
                POS: /:(nth|eq|gt|lt|first|last|even|odd)(?:\((\d*)\))?(?=[^-]|$)/,
                PSEUDO: /:((?:[\w\u00c0-\uFFFF-]|\\.)+)(?:\((['"]?)((?:\([^\)]+\)|[^\(\)]*)+)\2\))?/
            },
            leftMatch: {},
            attrMap: {
                "class": "className",
                "for": "htmlFor"
            },
            attrHandle: {
                href: function (Y) {
                    return Y.getAttribute("href")
                }
            },
            relative: {
                "+": function (ab, aa) {
                    var Z = typeof aa === "string",
                        Y = Z && !/\W/.test(aa);
                    Z = Z && !Y;
                    if (Y) {
                        aa = aa.toLowerCase()
                    }
                    Y = 0;
                    for (var ba = ab.length, bb; Y < ba; Y++) {
                        if (bb = ab[Y]) {
                            for (;
                            (bb = bb.previousSibling) && bb.nodeType !== 1;) {}
                            ab[Y] = Z || bb && bb.nodeName.toLowerCase() === aa ? bb || false : bb === aa
                        }
                    }
                    Z && N.filter(aa, ab, true)
                },
                ">": function (ab, aa) {
                    var Z = typeof aa === "string";
                    if (Z && !/\W/.test(aa)) {
                        aa = aa.toLowerCase();
                        for (var Y = 0, ba = ab.length; Y < ba; Y++) {
                            var bb = ab[Y];
                            if (bb) {
                                Z = bb.parentNode;
                                ab[Y] = Z.nodeName.toLowerCase() === aa ? Z : false
                            }
                        }
                    } else {
                        Y = 0;
                        for (ba = ab.length; Y < ba; Y++) {
                            if (bb = ab[Y]) {
                                ab[Y] = Z ? bb.parentNode : bb.parentNode === aa
                            }
                        }
                        Z && N.filter(aa, ab, true)
                    }
                },
                "": function (ab, aa, Z) {
                    var Y = R++,
                        ba = T;
                    if (typeof aa === "string" && !/\W/.test(aa)) {
                        var bb = aa = aa.toLowerCase();
                        ba = V
                    }
                    ba("parentNode", aa, Y, ab, bb, Z)
                },
                "~": function (ab, aa, Z) {
                    var Y = R++,
                        ba = T;
                    if (typeof aa === "string" && !/\W/.test(aa)) {
                        var bb = aa = aa.toLowerCase();
                        ba = V
                    }
                    ba("previousSibling", aa, Y, ab, bb, Z)
                }
            },
            find: {
                ID: function (aa, Z, Y) {
                    if (typeof Z.getElementById !== "undefined" && !Y) {
                        return (aa = Z.getElementById(aa[1])) ? [aa] : []
                    }
                },
                NAME: function (ab, aa) {
                    if (typeof aa.getElementsByName !== "undefined") {
                        var Z = [];
                        aa = aa.getElementsByName(ab[1]);
                        for (var Y = 0, ba = aa.length; Y < ba; Y++) {
                            aa[Y].getAttribute("name") === ab[1] && Z.push(aa[Y])
                        }
                        return Z.length === 0 ? null : Z
                    }
                },
                TAG: function (Z, Y) {
                    return Y.getElementsByTagName(Z[1])
                }
            },
            preFilter: {
                CLASS: function (ba, ab, Z, Y, bb, bl) {
                    ba = " " + ba[1].replace(/\\/g, "") + " ";
                    if (bl) {
                        return ba
                    }
                    bl = 0;
                    for (var aa;
                    (aa = ab[bl]) != null; bl++) {
                        if (aa) {
                            if (bb ^ (aa.className && (" " + aa.className + " ").replace(/[\t\n]/g, " ").indexOf(ba) >= 0)) {
                                Z || Y.push(aa)
                            } else {
                                if (Z) {
                                    ab[bl] = false
                                }
                            }
                        }
                    }
                    return false
                },
                ID: function (Y) {
                    return Y[1].replace(/\\/g, "")
                },
                TAG: function (Y) {
                    return Y[1].toLowerCase()
                },
                CHILD: function (Z) {
                    if (Z[1] === "nth") {
                        var Y = /(-?)(\d*)n((?:\+|-)?\d*)/.exec(Z[2] === "even" && "2n" || Z[2] === "odd" && "2n+1" || !/\D/.test(Z[2]) && "0n+" + Z[2] || Z[2]);
                        Z[2] = Y[1] + (Y[2] || 1) - 0;
                        Z[3] = Y[3] - 0
                    }
                    Z[0] = R++;
                    return Z
                },
                ATTR: function (ab, aa, Z, Y, ba, bb) {
                    aa = ab[1].replace(/\\/g, "");
                    if (!bb && L.attrMap[aa]) {
                        ab[1] = L.attrMap[aa]
                    }
                    if (ab[2] === "~=") {
                        ab[4] = " " + ab[4] + " "
                    }
                    return ab
                },
                PSEUDO: function (ab, aa, Z, Y, ba) {
                    if (ab[1] === "not") {
                        if ((Q.exec(ab[3]) || "").length > 1 || /^\w/.test(ab[3])) {
                            ab[3] = N(ab[3], null, null, aa)
                        } else {
                            ab = N.filter(ab[3], aa, Z, true ^ ba);
                            Z || Y.push.apply(Y, ab);
                            return false
                        }
                    } else {
                        if (L.match.POS.test(ab[0]) || L.match.CHILD.test(ab[0])) {
                            return true
                        }
                    }
                    return ab
                },
                POS: function (Y) {
                    Y.unshift(true);
                    return Y
                }
            },
            filters: {
                enabled: function (Y) {
                    return Y.disabled === false && Y.type !== "hidden"
                },
                disabled: function (Y) {
                    return Y.disabled === true
                },
                checked: function (Y) {
                    return Y.checked === true
                },
                selected: function (Y) {
                    return Y.selected === true
                },
                parent: function (Y) {
                    return !!Y.firstChild
                },
                empty: function (Y) {
                    return !Y.firstChild
                },
                has: function (aa, Z, Y) {
                    return !!N(Y[3], aa).length
                },
                header: function (Y) {
                    return /h\d/i.test(Y.nodeName)
                },
                text: function (Y) {
                    return "text" === Y.type
                },
                radio: function (Y) {
                    return "radio" === Y.type
                },
                checkbox: function (Y) {
                    return "checkbox" === Y.type
                },
                file: function (Y) {
                    return "file" === Y.type
                },
                password: function (Y) {
                    return "password" === Y.type
                },
                submit: function (Y) {
                    return "submit" === Y.type
                },
                image: function (Y) {
                    return "image" === Y.type
                },
                reset: function (Y) {
                    return "reset" === Y.type
                },
                button: function (Y) {
                    return "button" === Y.type || Y.nodeName.toLowerCase() === "button"
                },
                input: function (Y) {
                    return /input|select|textarea|button/i.test(Y.nodeName)
                }
            },
            setFilters: {
                first: function (Z, Y) {
                    return Y === 0
                },
                last: function (ab, aa, Z, Y) {
                    return aa === Y.length - 1
                },
                even: function (Z, Y) {
                    return Y % 2 === 0
                },
                odd: function (Z, Y) {
                    return Y % 2 === 1
                },
                lt: function (aa, Z, Y) {
                    return Z < Y[3] - 0
                },
                gt: function (aa, Z, Y) {
                    return Z > Y[3] - 0
                },
                nth: function (aa, Z, Y) {
                    return Y[3] - 0 === Z
                },
                eq: function (aa, Z, Y) {
                    return Y[3] - 0 === Z
                }
            },
            filter: {
                PSEUDO: function (ab, aa, Z, Y) {
                    var ba = aa[1],
                        bb = L.filters[ba];
                    if (bb) {
                        return bb(ab, Z, aa, Y)
                    } else {
                        if (ba === "contains") {
                            return (ab.textContent || ab.innerText || W([ab]) || "").indexOf(aa[3]) >= 0
                        } else {
                            if (ba === "not") {
                                aa = aa[3];
                                Z = 0;
                                for (Y = aa.length; Z < Y; Z++) {
                                    if (aa[Z] === ab) {
                                        return false
                                    }
                                }
                                return true
                            } else {
                                N.error("Syntax error, unrecognized expression: " + ba)
                            }
                        }
                    }
                },
                CHILD: function (ba, ab) {
                    var Z = ab[1],
                        Y = ba;
                    switch (Z) {
                    case "only":
                    case "first":
                        for (; Y = Y.previousSibling;) {
                            if (Y.nodeType === 1) {
                                return false
                            }
                        }
                        if (Z === "first") {
                            return true
                        }
                        Y = ba;
                    case "last":
                        for (; Y = Y.nextSibling;) {
                            if (Y.nodeType === 1) {
                                return false
                            }
                        }
                        return true;
                    case "nth":
                        Z = ab[2];
                        var bb = ab[3];
                        if (Z === 1 && bb === 0) {
                            return true
                        }
                        ab = ab[0];
                        var bl = ba.parentNode;
                        if (bl && (bl.sizcache !== ab || !ba.nodeIndex)) {
                            var aa = 0;
                            for (Y = bl.firstChild; Y; Y = Y.nextSibling) {
                                if (Y.nodeType === 1) {
                                    Y.nodeIndex = ++aa
                                }
                            }
                            bl.sizcache = ab
                        }
                        ba = ba.nodeIndex - bb;
                        return Z === 0 ? ba === 0 : ba % Z === 0 && ba / Z >= 0
                    }
                },
                ID: function (Z, Y) {
                    return Z.nodeType === 1 && Z.getAttribute("id") === Y
                },
                TAG: function (Z, Y) {
                    return Y === "*" && Z.nodeType === 1 || Z.nodeName.toLowerCase() === Y
                },
                CLASS: function (Z, Y) {
                    return (" " + (Z.className || Z.getAttribute("class")) + " ").indexOf(Y) > -1
                },
                ATTR: function (ab, aa) {
                    var Z = aa[1];
                    ab = L.attrHandle[Z] ? L.attrHandle[Z](ab) : ab[Z] != null ? ab[Z] : ab.getAttribute(Z);
                    Z = ab + "";
                    var Y = aa[2];
                    aa = aa[4];
                    return ab == null ? Y === "!=" : Y === "=" ? Z === aa : Y === "*=" ? Z.indexOf(aa) >= 0 : Y === "~=" ? (" " + Z + " ").indexOf(aa) >= 0 : !aa ? Z && ab !== false : Y === "!=" ? Z !== aa : Y === "^=" ? Z.indexOf(aa) === 0 : Y === "$=" ? Z.substr(Z.length - aa.length) === aa : Y === "|=" ? Z === aa || Z.substr(0, aa.length + 1) === aa + "-" : false
                },
                POS: function (ab, aa, Z, Y) {
                    var ba = L.setFilters[aa[2]];
                    if (ba) {
                        return ba(ab, Z, aa, Y)
                    }
                }
            }
        },
            G = L.match.POS;
        for (var w in L.match) {
            L.match[w] = new RegExp(L.match[w].source + /(?![^\[]*\])(?![^\(]*\))/.source);
            L.leftMatch[w] = new RegExp(/(^(?:.|\r|\n)*?)/.source + L.match[w].source.replace(/\\(\d+)/g, function (Z, Y) {
                return "\\" + (Y - 0 + 1)
            }))
        }
        var c = function (Z, Y) {
            Z = Array.prototype.slice.call(Z, 0);
            if (Y) {
                Y.push.apply(Y, Z);
                return Y
            }
            return Z
        };
        try {
            Array.prototype.slice.call(M.documentElement.childNodes, 0)
        } catch (F) {
            c = function (ab, aa) {
                aa = aa || [];
                if (O.call(ab) === "[object Array]") {
                    Array.prototype.push.apply(aa, ab)
                } else {
                    if (typeof ab.length === "number") {
                        for (var Z = 0, Y = ab.length; Z < Y; Z++) {
                            aa.push(ab[Z])
                        }
                    } else {
                        for (Z = 0; ab[Z]; Z++) {
                            aa.push(ab[Z])
                        }
                    }
                }
                return aa
            }
        }
        var J;
        if (M.documentElement.compareDocumentPosition) {
            J = function (Z, Y) {
                if (!Z.compareDocumentPosition || !Y.compareDocumentPosition) {
                    if (Z == Y) {
                        P = true
                    }
                    return Z.compareDocumentPosition ? -1 : 1
                }
                Z = Z.compareDocumentPosition(Y) & 4 ? -1 : Z === Y ? 0 : 1;
                if (Z === 0) {
                    P = true
                }
                return Z
            }
        } else {
            if ("sourceIndex" in M.documentElement) {
                J = function (Z, Y) {
                    if (!Z.sourceIndex || !Y.sourceIndex) {
                        if (Z == Y) {
                            P = true
                        }
                        return Z.sourceIndex ? -1 : 1
                    }
                    Z = Z.sourceIndex - Y.sourceIndex;
                    if (Z === 0) {
                        P = true
                    }
                    return Z
                }
            } else {
                if (M.createRange) {
                    J = function (ab, aa) {
                        if (!ab.ownerDocument || !aa.ownerDocument) {
                            if (ab == aa) {
                                P = true
                            }
                            return ab.ownerDocument ? -1 : 1
                        }
                        var Z = ab.ownerDocument.createRange(),
                            Y = aa.ownerDocument.createRange();
                        Z.setStart(ab, 0);
                        Z.setEnd(ab, 0);
                        Y.setStart(aa, 0);
                        Y.setEnd(aa, 0);
                        ab = Z.compareBoundaryPoints(Range.START_TO_END, Y);
                        if (ab === 0) {
                            P = true
                        }
                        return ab
                    }
                }
            }
        }(function () {
            var aa = M.createElement("div"),
                Z = "script" + (new Date).getTime();
            aa.innerHTML = "<a name='" + Z + "'/>";
            var Y = M.documentElement;
            Y.insertBefore(aa, Y.firstChild);
            if (M.getElementById(Z)) {
                L.find.ID = function (ab, ba, bb) {
                    if (typeof ba.getElementById !== "undefined" && !bb) {
                        return (ba = ba.getElementById(ab[1])) ? ba.id === ab[1] || typeof ba.getAttributeNode !== "undefined" && ba.getAttributeNode("id").nodeValue === ab[1] ? [ba] : I : []
                    }
                };
                L.filter.ID = function (ab, ba) {
                    var bb = typeof ab.getAttributeNode !== "undefined" && ab.getAttributeNode("id");
                    return ab.nodeType === 1 && bb && bb.nodeValue === ba
                }
            }
            Y.removeChild(aa);
            Y = aa = null
        })();
        (function () {
            var Y = M.createElement("div");
            Y.appendChild(M.createComment(""));
            if (Y.getElementsByTagName("*").length > 0) {
                L.find.TAG = function (ab, aa) {
                    aa = aa.getElementsByTagName(ab[1]);
                    if (ab[1] === "*") {
                        ab = [];
                        for (var Z = 0; aa[Z]; Z++) {
                            aa[Z].nodeType === 1 && ab.push(aa[Z])
                        }
                        aa = ab
                    }
                    return aa
                }
            }
            Y.innerHTML = "<a href='#'></a>";
            if (Y.firstChild && typeof Y.firstChild.getAttribute !== "undefined" && Y.firstChild.getAttribute("href") !== "#") {
                L.attrHandle.href = function (Z) {
                    return Z.getAttribute("href", 2)
                }
            }
            Y = null
        })();
        M.querySelectorAll &&
        function () {
            var aa = N,
                Z = M.createElement("div");
            Z.innerHTML = "<p class='TEST'></p>";
            if (!(Z.querySelectorAll && Z.querySelectorAll(".TEST").length === 0)) {
                N = function (ab, bl, bm, ba) {
                    bl = bl || M;
                    if (!ba && bl.nodeType === 9 && !s(bl)) {
                        try {
                            return c(bl.querySelectorAll(ab), bm)
                        } catch (bb) {}
                    }
                    return aa(ab, bl, bm, ba)
                };
                for (var Y in aa) {
                    N[Y] = aa[Y]
                }
                Z = null
            }
        }();
        (function () {
            var Y = M.createElement("div");
            Y.innerHTML = "<div class='test e'></div><div class='test'></div>";
            if (!(!Y.getElementsByClassName || Y.getElementsByClassName("e").length === 0)) {
                Y.lastChild.className = "e";
                if (Y.getElementsByClassName("e").length !== 1) {
                    L.order.splice(1, 0, "CLASS");
                    L.find.CLASS = function (ab, aa, Z) {
                        if (typeof aa.getElementsByClassName !== "undefined" && !Z) {
                            return aa.getElementsByClassName(ab[1])
                        }
                    };
                    Y = null
                }
            }
        })();
        var A = M.compareDocumentPosition ?
        function (Z, Y) {
            return !!(Z.compareDocumentPosition(Y) & 16)
        } : function (Z, Y) {
            return Z !== Y && (Z.contains ? Z.contains(Y) : true)
        },
            s = function (Y) {
                return (Y = (Y ? Y.ownerDocument || Y : 0).documentElement) ? Y.nodeName !== "HTML" : false
            },
            X = function (ab, aa) {
                var Z = [],
                    Y = "",
                    ba;
                for (aa = aa.nodeType ? [aa] : aa; ba = L.match.PSEUDO.exec(ab);) {
                    Y += ba[0];
                    ab = ab.replace(L.match.PSEUDO, "")
                }
                ab = L.relative[ab] ? ab + "*" : ab;
                ba = 0;
                for (var bb = aa.length; ba < bb; ba++) {
                    N(ab, aa[ba], Z)
                }
                return N.filter(Y, Z)
            };
        ah.find = N;
        ah.expr = N.selectors;
        ah.expr[":"] = ah.expr.filters;
        ah.unique = N.uniqueSort;
        ah.text = W;
        ah.isXMLDoc = s;
        ah.contains = A
    })();
    var f = /Until$/,
        a9 = /^(?:parents|prevUntil|prevAll)/,
        aW = /,/;
    au = Array.prototype.slice;
    var aL = function (s, c, A) {
        if (ah.isFunction(c)) {
            return ah.grep(s, function (G, F) {
                return !!c.call(G, F, G) === A
            })
        } else {
            if (c.nodeType) {
                return ah.grep(s, function (F) {
                    return F === c === A
                })
            } else {
                if (typeof c === "string") {
                    var w = ah.grep(s, function (F) {
                        return F.nodeType === 1
                    });
                    if (aT.test(c)) {
                        return ah.filter(c, w, !A)
                    } else {
                        c = ah.filter(c, w)
                    }
                }
            }
        }
        return ah.grep(s, function (F) {
            return ah.inArray(F, c) >= 0 === A
        })
    };
    ah.fn.extend({
        find: function (s) {
            for (var c = this.pushStack("", "find", s), J = 0, F = 0, G = this.length; F < G; F++) {
                J = c.length;
                ah.find(s, this[F], c);
                if (F > 0) {
                    for (var w = J; w < c.length; w++) {
                        for (var A = 0; A < J; A++) {
                            if (c[A] === c[w]) {
                                c.splice(w--, 1);
                                break
                            }
                        }
                    }
                }
            }
            return c
        },
        has: function (s) {
            var c = ah(s);
            return this.filter(function () {
                for (var A = 0, w = c.length; A < w; A++) {
                    if (ah.contains(this, c[A])) {
                        return true
                    }
                }
            })
        },
        not: function (c) {
            return this.pushStack(aL(this, c, false), "not", c)
        },
        filter: function (c) {
            return this.pushStack(aL(this, c, true), "filter", c)
        },
        is: function (c) {
            return !!c && ah.filter(c, this).length > 0
        },
        closest: function (L, K) {
            if (ah.isArray(L)) {
                var J = [],
                    F = this[0],
                    G, w = {},
                    A;
                if (F && L.length) {
                    G = 0;
                    for (var c = L.length; G < c; G++) {
                        A = L[G];
                        w[A] || (w[A] = ah.expr.match.POS.test(A) ? ah(A, K || this.context) : A)
                    }
                    for (; F && F.ownerDocument && F !== K;) {
                        for (A in w) {
                            G = w[A];
                            if (G.jquery ? G.index(F) > -1 : ah(F).is(G)) {
                                J.push({
                                    selector: A,
                                    elem: F
                                });
                                delete w[A]
                            }
                        }
                        F = F.parentNode
                    }
                }
                return J
            }
            var s = ah.expr.match.POS.test(L) ? ah(L, K || this.context) : null;
            return this.map(function (O, N) {
                for (; N && N.ownerDocument && N !== K;) {
                    if (s ? s.index(N) > -1 : ah(N).is(L)) {
                        return N
                    }
                    N = N.parentNode
                }
                return null
            })
        },
        index: function (c) {
            if (!c || typeof c === "string") {
                return ah.inArray(this[0], c ? ah(c) : this.parent().children())
            }
            return ah.inArray(c.jquery ? c[0] : c, this)
        },
        add: function (s, c) {
            s = typeof s === "string" ? ah(s, c || this.context) : ah.makeArray(s);
            c = ah.merge(this.get(), s);
            return this.pushStack(l(s[0]) || l(c[0]) ? c : ah.unique(c))
        },
        andSelf: function () {
            return this.add(this.prevObject)
        }
    });
    ah.each({
        parent: function (c) {
            return (c = c.parentNode) && c.nodeType !== 11 ? c : null
        },
        parents: function (c) {
            return ah.dir(c, "parentNode")
        },
        parentsUntil: function (s, c, w) {
            return ah.dir(s, "parentNode", w)
        },
        next: function (c) {
            return ah.nth(c, 2, "nextSibling")
        },
        prev: function (c) {
            return ah.nth(c, 2, "previousSibling")
        },
        nextAll: function (c) {
            return ah.dir(c, "nextSibling")
        },
        prevAll: function (c) {
            return ah.dir(c, "previousSibling")
        },
        nextUntil: function (s, c, w) {
            return ah.dir(s, "nextSibling", w)
        },
        prevUntil: function (s, c, w) {
            return ah.dir(s, "previousSibling", w)
        },
        siblings: function (c) {
            return ah.sibling(c.parentNode.firstChild, c)
        },
        children: function (c) {
            return ah.sibling(c.firstChild)
        },
        contents: function (c) {
            return ah.nodeName(c, "iframe") ? c.contentDocument || c.contentWindow.document : ah.makeArray(c.childNodes)
        }
    }, function (s, c) {
        ah.fn[s] = function (F, w) {
            var A = ah.map(this, c, F);
            f.test(s) || (w = F);
            if (w && typeof w === "string") {
                A = ah.filter(w, A)
            }
            A = this.length > 1 ? ah.unique(A) : A;
            if ((this.length > 1 || aW.test(w)) && a9.test(s)) {
                A = A.reverse()
            }
            return this.pushStack(A, s, au.call(arguments).join(","))
        }
    });
    ah.extend({
        filter: function (s, c, w) {
            if (w) {
                s = ":not(" + s + ")"
            }
            return ah.find.matches(s, c)
        },
        dir: function (s, c, A) {
            var w = [];
            for (s = s[c]; s && s.nodeType !== 9 && (A === I || s.nodeType !== 1 || !ah(s).is(A));) {
                s.nodeType === 1 && w.push(s);
                s = s[c]
            }
            return w
        },
        nth: function (s, c, A) {
            c = c || 1;
            for (var w = 0; s; s = s[A]) {
                if (s.nodeType === 1 && ++w === c) {
                    break
                }
            }
            return s
        },
        sibling: function (s, c) {
            for (var w = []; s; s = s.nextSibling) {
                s.nodeType === 1 && s !== c && w.push(s)
            }
            return w
        }
    });
    var ai = / jQuery\d+="(?:\d+|null)"/g,
        ar = /^\s+/,
        B = /(<([\w:]+)[^>]*?)\/>/g,
        aD = /^(?:area|br|col|embed|hr|img|input|link|meta|param)$/i,
        m = /<([\w:]+)/,
        ac = /<tbody/i,
        u = /<|&#?\w+;/,
        aP = /<script|<object|<embed|<option|<style/i,
        ak = /checked\s*(?:[^=]|=\s*.checked.)/i,
        bk = function (s, c, w) {
            return aD.test(w) ? s : c + "></" + w + ">"
        },
        aJ = {
            option: [1, "<select multiple='multiple'>", "</select>"],
            legend: [1, "<fieldset>", "</fieldset>"],
            thead: [1, "<table>", "</table>"],
            tr: [2, "<table><tbody>", "</tbody></table>"],
            td: [3, "<table><tbody><tr>", "</tr></tbody></table>"],
            col: [2, "<table><tbody></tbody><colgroup>", "</colgroup></table>"],
            area: [1, "<map>", "</map>"],
            _default: [0, "", ""]
        };
    aJ.optgroup = aJ.option;
    aJ.tbody = aJ.tfoot = aJ.colgroup = aJ.caption = aJ.thead;
    aJ.th = aJ.td;
    if (!ah.support.htmlSerialize) {
        aJ._default = [1, "div<div>", "</div>"]
    }
    ah.fn.extend({
        text: function (c) {
            if (ah.isFunction(c)) {
                return this.each(function (s) {
                    var w = ah(this);
                    w.text(c.call(this, s, w.text()))
                })
            }
            if (typeof c !== "object" && c !== I) {
                return this.empty().append((this[0] && this[0].ownerDocument || M).createTextNode(c))
            }
            return ah.text(this)
        },
        wrapAll: function (s) {
            if (ah.isFunction(s)) {
                return this.each(function (w) {
                    ah(this).wrapAll(s.call(this, w))
                })
            }
            if (this[0]) {
                var c = ah(s, this[0].ownerDocument).eq(0).clone(true);
                this[0].parentNode && c.insertBefore(this[0]);
                c.map(function () {
                    for (var w = this; w.firstChild && w.firstChild.nodeType === 1;) {
                        w = w.firstChild
                    }
                    return w
                }).append(this)
            }
            return this
        },
        wrapInner: function (c) {
            if (ah.isFunction(c)) {
                return this.each(function (s) {
                    ah(this).wrapInner(c.call(this, s))
                })
            }
            return this.each(function () {
                var s = ah(this),
                    w = s.contents();
                w.length ? w.wrapAll(c) : s.append(c)
            })
        },
        wrap: function (c) {
            return this.each(function () {
                ah(this).wrapAll(c)
            })
        },
        unwrap: function () {
            return this.parent().each(function () {
                ah.nodeName(this, "body") || ah(this).replaceWith(this.childNodes)
            }).end()
        },
        append: function () {
            return this.domManip(arguments, true, function (c) {
                this.nodeType === 1 && this.appendChild(c)
            })
        },
        prepend: function () {
            return this.domManip(arguments, true, function (c) {
                this.nodeType === 1 && this.insertBefore(c, this.firstChild)
            })
        },
        before: function () {
            if (this[0] && this[0].parentNode) {
                return this.domManip(arguments, false, function (s) {
                    this.parentNode.insertBefore(s, this)
                })
            } else {
                if (arguments.length) {
                    var c = ah(arguments[0]);
                    c.push.apply(c, this.toArray());
                    return this.pushStack(c, "before", arguments)
                }
            }
        },
        after: function () {
            if (this[0] && this[0].parentNode) {
                return this.domManip(arguments, false, function (s) {
                    this.parentNode.insertBefore(s, this.nextSibling)
                })
            } else {
                if (arguments.length) {
                    var c = this.pushStack(this, "after", arguments);
                    c.push.apply(c, ah(arguments[0]).toArray());
                    return c
                }
            }
        },
        remove: function (s, c) {
            for (var A = 0, w;
            (w = this[A]) != null; A++) {
                if (!s || ah.filter(s, [w]).length) {
                    if (!c && w.nodeType === 1) {
                        ah.cleanData(w.getElementsByTagName("*"));
                        ah.cleanData([w])
                    }
                    w.parentNode && w.parentNode.removeChild(w)
                }
            }
            return this
        },
        empty: function () {
            for (var s = 0, c;
            (c = this[s]) != null; s++) {
                for (c.nodeType === 1 && ah.cleanData(c.getElementsByTagName("*")); c.firstChild;) {
                    c.removeChild(c.firstChild)
                }
            }
            return this
        },
        clone: function (s) {
            var c = this.map(function () {
                if (!ah.support.noCloneEvent && !ah.isXMLDoc(this)) {
                    var A = this.outerHTML,
                        w = this.ownerDocument;
                    if (!A) {
                        A = w.createElement("div");
                        A.appendChild(this.cloneNode(true));
                        A = A.innerHTML
                    }
                    return ah.clean([A.replace(ai, "").replace(/=([^="'>\s]+\/)>/g, '="$1">').replace(ar, "")], w)[0]
                } else {
                    return this.cloneNode(true)
                }
            });
            if (s === true) {
                bj(this, c);
                bj(this.find("*"), c.find("*"))
            }
            return c
        },
        html: function (s) {
            if (s === I) {
                return this[0] && this[0].nodeType === 1 ? this[0].innerHTML.replace(ai, "") : null
            } else {
                if (typeof s === "string" && !aP.test(s) && (ah.support.leadingWhitespace || !ar.test(s)) && !aJ[(m.exec(s) || ["", ""])[1].toLowerCase()]) {
                    s = s.replace(B, bk);
                    try {
                        for (var c = 0, A = this.length; c < A; c++) {
                            if (this[c].nodeType === 1) {
                                ah.cleanData(this[c].getElementsByTagName("*"));
                                this[c].innerHTML = s
                            }
                        }
                    } catch (w) {
                        this.empty().append(s)
                    }
                } else {
                    ah.isFunction(s) ? this.each(function (J) {
                        var F = ah(this),
                            G = F.html();
                        F.empty().append(function () {
                            return s.call(this, J, G)
                        })
                    }) : this.empty().append(s)
                }
            }
            return this
        },
        replaceWith: function (c) {
            if (this[0] && this[0].parentNode) {
                if (ah.isFunction(c)) {
                    return this.each(function (s) {
                        var A = ah(this),
                            w = A.html();
                        A.replaceWith(c.call(this, s, w))
                    })
                }
                if (typeof c !== "string") {
                    c = ah(c).detach()
                }
                return this.each(function () {
                    var s = this.nextSibling,
                        w = this.parentNode;
                    ah(this).remove();
                    s ? ah(s).before(c) : ah(w).append(c)
                })
            } else {
                return this.pushStack(ah(ah.isFunction(c) ? c() : c), "replaceWith", c)
            }
        },
        detach: function (c) {
            return this.remove(c, true)
        },
        domManip: function (O, N, L) {
            function J(P) {
                return ah.nodeName(P, "table") ? P.getElementsByTagName("tbody")[0] || P.appendChild(P.ownerDocument.createElement("tbody")) : P
            }
            var K, F, G = O[0],
                s = [],
                A;
            if (!ah.support.checkClone && arguments.length === 3 && typeof G === "string" && ak.test(G)) {
                return this.each(function () {
                    ah(this).domManip(O, N, L, true)
                })
            }
            if (ah.isFunction(G)) {
                return this.each(function (P) {
                    var Q = ah(this);
                    O[0] = G.call(this, P, N ? Q.html() : I);
                    Q.domManip(O, N, L)
                })
            }
            if (this[0]) {
                K = G && G.parentNode;
                K = ah.support.parentNode && K && K.nodeType === 11 && K.childNodes.length === this.length ? {
                    fragment: K
                } : a3(O, this, s);
                A = K.fragment;
                if (F = A.childNodes.length === 1 ? (A = A.firstChild) : A.firstChild) {
                    N = N && ah.nodeName(F, "tr");
                    for (var w = 0, c = this.length; w < c; w++) {
                        L.call(N ? J(this[w], F) : this[w], w > 0 || K.cacheable || this.length > 1 ? A.cloneNode(true) : A)
                    }
                }
                s.length && ah.each(s, E)
            }
            return this
        }
    });
    ah.fragments = {};
    ah.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (s, c) {
        ah.fn[s] = function (J) {
            var F = [];
            J = ah(J);
            var G = this.length === 1 && this[0].parentNode;
            if (G && G.nodeType === 11 && G.childNodes.length === 1 && J.length === 1) {
                J[c](this[0]);
                return this
            } else {
                G = 0;
                for (var w = J.length; G < w; G++) {
                    var A = (G > 0 ? this.clone(true) : this).get();
                    ah.fn[c].apply(ah(J[G]), A);
                    F = F.concat(A)
                }
                return this.pushStack(F, s, J.selector)
            }
        }
    });
    ah.extend({
        clean: function (O, N, L, J) {
            N = N || M;
            if (typeof N.createElement === "undefined") {
                N = N.ownerDocument || N[0] && N[0].ownerDocument || M
            }
            for (var K = [], F = 0, G;
            (G = O[F]) != null; F++) {
                if (typeof G === "number") {
                    G += ""
                }
                if (G) {
                    if (typeof G === "string" && !u.test(G)) {
                        G = N.createTextNode(G)
                    } else {
                        if (typeof G === "string") {
                            G = G.replace(B, bk);
                            var s = (m.exec(G) || ["", ""])[1].toLowerCase(),
                                A = aJ[s] || aJ._default,
                                w = A[0],
                                c = N.createElement("div");
                            for (c.innerHTML = A[1] + G + A[2]; w--;) {
                                c = c.lastChild
                            }
                            if (!ah.support.tbody) {
                                w = ac.test(G);
                                s = s === "table" && !w ? c.firstChild && c.firstChild.childNodes : A[1] === "<table>" && !w ? c.childNodes : [];
                                for (A = s.length - 1; A >= 0; --A) {
                                    ah.nodeName(s[A], "tbody") && !s[A].childNodes.length && s[A].parentNode.removeChild(s[A])
                                }
                            }!ah.support.leadingWhitespace && ar.test(G) && c.insertBefore(N.createTextNode(ar.exec(G)[0]), c.firstChild);
                            G = c.childNodes
                        }
                    }
                    if (G.nodeType) {
                        K.push(G)
                    } else {
                        K = ah.merge(K, G)
                    }
                }
            }
            if (L) {
                for (F = 0; K[F]; F++) {
                    if (J && ah.nodeName(K[F], "script") && (!K[F].type || K[F].type.toLowerCase() === "text/javascript")) {
                        J.push(K[F].parentNode ? K[F].parentNode.removeChild(K[F]) : K[F])
                    } else {
                        K[F].nodeType === 1 && K.splice.apply(K, [F + 1, 0].concat(ah.makeArray(K[F].getElementsByTagName("script"))));
                        L.appendChild(K[F])
                    }
                }
            }
            return K
        },
        cleanData: function (L) {
            for (var K, J, F = ah.cache, G = ah.event.special, w = ah.support.deleteExpando, A = 0, c;
            (c = L[A]) != null; A++) {
                if (J = c[ah.expando]) {
                    K = F[J];
                    if (K.events) {
                        for (var s in K.events) {
                            G[s] ? ah.event.remove(c, s) : aG(c, s, K.handle)
                        }
                    }
                    if (w) {
                        delete c[ah.expando]
                    } else {
                        c.removeAttribute && c.removeAttribute(ah.expando)
                    }
                    delete F[J]
                }
            }
        }
    });
    var h = /z-?index|font-?weight|opacity|zoom|line-?height/i,
        a4 = /alpha\([^)]*\)/,
        aQ = /opacity=([^)]*)/,
        aE = /float/i,
        ad = /-([a-z])/ig,
        bf = /([A-Z])/g,
        aZ = /^-?\d+(?:px)?$/i,
        aI = /^-?\d/,
        af = {
            position: "absolute",
            visibility: "hidden",
            display: "block"
        },
        y = ["Left", "Right"],
        k = ["Top", "Bottom"],
        bi = M.defaultView && M.defaultView.getComputedStyle,
        al = ah.support.cssFloat ? "cssFloat" : "styleFloat",
        v = function (s, c) {
            return c.toUpperCase()
        };
    ah.fn.css = function (s, c) {
        return ap(this, s, c, true, function (F, w, A) {
            if (A === I) {
                return ah.curCSS(F, w)
            }
            if (typeof A === "number" && !h.test(w)) {
                A += "px"
            }
            ah.style(F, w, A)
        })
    };
    ah.extend({
        style: function (s, c, F) {
            if (!s || s.nodeType === 3 || s.nodeType === 8) {
                return I
            }
            if ((c === "width" || c === "height") && parseFloat(F) < 0) {
                F = I
            }
            var w = s.style || s,
                A = F !== I;
            if (!ah.support.opacity && c === "opacity") {
                if (A) {
                    w.zoom = 1;
                    c = parseInt(F, 10) + "" === "NaN" ? "" : "alpha(opacity=" + F * 100 + ")";
                    s = w.filter || ah.curCSS(s, "filter") || "";
                    w.filter = a4.test(s) ? s.replace(a4, c) : c
                }
                return w.filter && w.filter.indexOf("opacity=") >= 0 ? parseFloat(aQ.exec(w.filter)[1]) / 100 + "" : ""
            }
            if (aE.test(c)) {
                c = al
            }
            c = c.replace(ad, v);
            if (A) {
                w[c] = F
            }
            return w[c]
        },
        css: function (s, c, J, F) {
            if (c === "width" || c === "height") {
                var G, w = c === "width" ? y : k;

                function A() {
                    G = c === "width" ? s.offsetWidth : s.offsetHeight;
                    F !== "border" && ah.each(w, function () {
                        F || (G -= parseFloat(ah.curCSS(s, "padding" + this, true)) || 0);
                        if (F === "margin") {
                            G += parseFloat(ah.curCSS(s, "margin" + this, true)) || 0
                        } else {
                            G -= parseFloat(ah.curCSS(s, "border" + this + "Width", true)) || 0
                        }
                    })
                }
                s.offsetWidth !== 0 ? A() : ah.swap(s, af, A);
                return Math.max(0, Math.round(G))
            }
            return ah.curCSS(s, c, J)
        },
        curCSS: function (s, c, G) {
            var A, F = s.style;
            if (!ah.support.opacity && c === "opacity" && s.currentStyle) {
                A = aQ.test(s.currentStyle.filter || "") ? parseFloat(RegExp.$1) / 100 + "" : "";
                return A === "" ? "1" : A
            }
            if (aE.test(c)) {
                c = al
            }
            if (!G && F && F[c]) {
                A = F[c]
            } else {
                if (bi) {
                    if (aE.test(c)) {
                        c = "float"
                    }
                    c = c.replace(bf, "-$1").toLowerCase();
                    F = s.ownerDocument.defaultView;
                    if (!F) {
                        return null
                    }
                    if (s = F.getComputedStyle(s, null)) {
                        A = s.getPropertyValue(c)
                    }
                    if (c === "opacity" && A === "") {
                        A = "1"
                    }
                } else {
                    if (s.currentStyle) {
                        G = c.replace(ad, v);
                        A = s.currentStyle[c] || s.currentStyle[G];
                        if (!aZ.test(A) && aI.test(A)) {
                            c = F.left;
                            var w = s.runtimeStyle.left;
                            s.runtimeStyle.left = s.currentStyle.left;
                            F.left = G === "fontSize" ? "1em" : A || 0;
                            A = F.pixelLeft + "px";
                            F.left = c;
                            s.runtimeStyle.left = w
                        }
                    }
                }
            }
            return A
        },
        swap: function (s, c, F) {
            var w = {};
            for (var A in c) {
                w[A] = s.style[A];
                s.style[A] = c[A]
            }
            F.call(s);
            for (A in c) {
                s.style[A] = w[A]
            }
        }
    });
    if (ah.expr && ah.expr.filters) {
        ah.expr.filters.hidden = function (s) {
            var c = s.offsetWidth,
                A = s.offsetHeight,
                w = s.nodeName.toLowerCase() === "tr";
            return c === 0 && A === 0 && !w ? true : c > 0 && A > 0 && !w ? false : ah.curCSS(s, "display") === "none"
        };
        ah.expr.filters.visible = function (c) {
            return !ah.expr.filters.hidden(c)
        }
    }
    var a2 = aF(),
        aN = /<script(.|\s)*?\/script>/gi,
        aj = /select|textarea/i,
        C = /color|date|datetime|email|hidden|month|number|password|range|search|tel|text|time|url|week/i,
        aA = /=\?(&|$)/,
        i = /\?/,
        n = /(\?|&)_=.*?(&|$)/,
        a = /^(\w+:)?\/\/([^\/?#]+)/,
        a5 = /%20/g,
        aR = ah.fn.load;
    ah.fn.extend({
        load: function (s, c, G) {
            if (typeof s !== "string") {
                return aR.call(this, s)
            } else {
                if (!this.length) {
                    return this
                }
            }
            var A = s.indexOf(" ");
            if (A >= 0) {
                var F = s.slice(A, s.length);
                s = s.slice(0, A)
            }
            A = "GET";
            if (c) {
                if (ah.isFunction(c)) {
                    G = c;
                    c = null
                } else {
                    if (typeof c === "object") {
                        c = ah.param(c, ah.ajaxSettings.traditional);
                        A = "POST"
                    }
                }
            }
            var w = this;
            ah.ajax({
                url: s,
                type: A,
                dataType: "html",
                data: c,
                complete: function (J, K) {
                    if (K === "success" || K === "notmodified") {
                        w.html(F ? ah("<div />").append(J.responseText.replace(aN, "")).find(F) : J.responseText)
                    }
                    G && w.each(G, [J.responseText, K, J])
                }
            });
            return this
        },
        serialize: function () {
            return ah.param(this.serializeArray())
        },
        serializeArray: function () {
            return this.map(function () {
                return this.elements ? ah.makeArray(this.elements) : this
            }).filter(function () {
                return this.name && !this.disabled && (this.checked || aj.test(this.nodeName) || C.test(this.type))
            }).map(function (s, c) {
                s = ah(this).val();
                return s == null ? null : ah.isArray(s) ? ah.map(s, function (w) {
                    return {
                        name: c.name,
                        value: w
                    }
                }) : {
                    name: c.name,
                    value: s
                }
            }).get()
        }
    });
    ah.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (s, c) {
        ah.fn[c] = function (w) {
            return this.bind(c, w)
        }
    });
    ah.extend({
        get: function (s, c, A, w) {
            if (ah.isFunction(c)) {
                w = w || A;
                A = c;
                c = null
            }
            return ah.ajax({
                type: "GET",
                url: s,
                data: c,
                success: A,
                dataType: w
            })
        },
        getScript: function (s, c) {
            return ah.get(s, null, c, "script")
        },
        getJSON: function (s, c, w) {
            return ah.get(s, c, w, "json")
        },
        post: function (s, c, A, w) {
            if (ah.isFunction(c)) {
                w = w || A;
                A = c;
                c = {}
            }
            return ah.ajax({
                type: "POST",
                url: s,
                data: c,
                success: A,
                dataType: w
            })
        },
        ajaxSetup: function (c) {
            ah.extend(ah.ajaxSettings, c)
        },
        ajaxSettings: {
            url: location.href,
            global: true,
            type: "GET",
            contentType: "application/x-www-form-urlencoded",
            processData: true,
            async: true,
            xhr: aO.XMLHttpRequest && (aO.location.protocol !== "file:" || !aO.ActiveXObject) ?
            function () {
                return new aO.XMLHttpRequest
            } : function () {
                try {
                    return new aO.ActiveXObject("Microsoft.XMLHTTP")
                } catch (c) {}
            },
            accepts: {
                xml: "application/xml, text/xml",
                html: "text/html",
                script: "text/javascript, application/javascript",
                json: "application/json, text/javascript",
                text: "text/plain",
                _default: "*/*"
            }
        },
        lastModified: {},
        etag: {},
        ajax: function (aa) {
            function Z() {
                X.success && X.success.call(P, K, R, s);
                X.global && W("ajaxSuccess", [s, X])
            }
            function Y() {
                X.complete && X.complete.call(P, s, R);
                X.global && W("ajaxComplete", [s, X]);
                X.global && !--ah.active && ah.event.trigger("ajaxStop")
            }
            function W(ba, bb) {
                (X.context ? ah(X.context) : ah.event).trigger(ba, bb)
            }
            var X = ah.extend(true, {}, ah.ajaxSettings, aa),
                Q, R, K, P = aa && aa.context || X,
                L = X.type.toUpperCase();
            if (X.data && X.processData && typeof X.data !== "string") {
                X.data = ah.param(X.data, X.traditional)
            }
            if (X.dataType === "jsonp") {
                if (L === "GET") {
                    aA.test(X.url) || (X.url += (i.test(X.url) ? "&" : "?") + (X.jsonp || "callback") + "=?")
                } else {
                    if (!X.data || !aA.test(X.data)) {
                        X.data = (X.data ? X.data + "&" : "") + (X.jsonp || "callback") + "=?"
                    }
                }
                X.dataType = "json"
            }
            if (X.dataType === "json" && (X.data && aA.test(X.data) || aA.test(X.url))) {
                Q = X.jsonpCallback || "jsonp" + a2++;
                if (X.data) {
                    X.data = (X.data + "").replace(aA, "=" + Q + "$1")
                }
                X.url = X.url.replace(aA, "=" + Q + "$1");
                X.dataType = "script";
                aO[Q] = aO[Q] ||
                function (ba) {
                    K = ba;
                    Z();
                    Y();
                    aO[Q] = I;
                    try {
                        delete aO[Q]
                    } catch (bb) {}
                    c && c.removeChild(F)
                }
            }
            if (X.dataType === "script" && X.cache === null) {
                X.cache = false
            }
            if (X.cache === false && L === "GET") {
                var G = aF(),
                    w = X.url.replace(n, "$1_=" + G + "$2");
                X.url = w + (w === X.url ? (i.test(X.url) ? "&" : "?") + "_=" + G : "")
            }
            if (X.data && L === "GET") {
                X.url += (i.test(X.url) ? "&" : "?") + X.data
            }
            X.global && !ah.active++ && ah.event.trigger("ajaxStart");
            G = (G = a.exec(X.url)) && (G[1] && G[1] !== location.protocol || G[2] !== location.host);
            if (X.dataType === "script" && L === "GET" && G) {
                var c = M.getElementsByTagName("head")[0] || M.documentElement,
                    F = M.createElement("script");
                F.src = X.url;
                if (X.scriptCharset) {
                    F.charset = X.scriptCharset
                }
                if (!Q) {
                    var J = false;
                    F.onload = F.onreadystatechange = function () {
                        if (!J && (!this.readyState || this.readyState === "loaded" || this.readyState === "complete")) {
                            J = true;
                            Z();
                            Y();
                            F.onload = F.onreadystatechange = null;
                            c && F.parentNode && c.removeChild(F)
                        }
                    }
                }
                c.insertBefore(F, c.firstChild);
                return I
            }
            var A = false,
                s = X.xhr();
            if (s) {
                X.username ? s.open(L, X.url, X.async, X.username, X.password) : s.open(L, X.url, X.async);
                try {
                    if (X.data || aa && aa.contentType) {
                        s.setRequestHeader("Content-Type", X.contentType)
                    }
                    if (X.ifModified) {
                        ah.lastModified[X.url] && s.setRequestHeader("If-Modified-Since", ah.lastModified[X.url]);
                        ah.etag[X.url] && s.setRequestHeader("If-None-Match", ah.etag[X.url])
                    }
                    G || s.setRequestHeader("X-Requested-With", "XMLHttpRequest");
                    s.setRequestHeader("Accept", X.dataType && X.accepts[X.dataType] ? X.accepts[X.dataType] + ", */*" : X.accepts._default)
                } catch (ab) {}
                if (X.beforeSend && X.beforeSend.call(P, s, X) === false) {
                    X.global && !--ah.active && ah.event.trigger("ajaxStop");
                    s.abort();
                    return false
                }
                X.global && W("ajaxSend", [s, X]);
                var V = s.onreadystatechange = function (bb) {
                    if (!s || s.readyState === 0 || bb === "abort") {
                        A || Y();
                        A = true;
                        if (s) {
                            s.onreadystatechange = ah.noop
                        }
                    } else {
                        if (!A && s && (s.readyState === 4 || bb === "timeout")) {
                            A = true;
                            s.onreadystatechange = ah.noop;
                            R = bb === "timeout" ? "timeout" : !ah.httpSuccess(s) ? "error" : X.ifModified && ah.httpNotModified(s, X.url) ? "notmodified" : "success";
                            var bl;
                            if (R === "success") {
                                try {
                                    K = ah.httpData(s, X.dataType, X)
                                } catch (ba) {
                                    R = "parsererror";
                                    bl = ba
                                }
                            }
                            if (R === "success" || R === "notmodified") {
                                Q || Z()
                            } else {
                                ah.handleError(X, s, R, bl)
                            }
                            Y();
                            bb === "timeout" && s.abort();
                            if (X.async) {
                                s = null
                            }
                        }
                    }
                };
                try {
                    var T = s.abort;
                    s.abort = function () {
                        s && T.call(s);
                        V("abort")
                    }
                } catch (O) {}
                X.async && X.timeout > 0 && setTimeout(function () {
                    s && !A && V("timeout")
                }, X.timeout);
                try {
                    s.send(L === "POST" || L === "PUT" || L === "DELETE" ? X.data : null)
                } catch (N) {
                    ah.handleError(X, s, null, N);
                    Y()
                }
                X.async || V();
                return s
            }
        },
        handleError: function (s, c, A, w) {
            if (s.error) {
                s.error.call(s.context || s, c, A, w)
            }
            if (s.global) {
                (s.context ? ah(s.context) : ah.event).trigger("ajaxError", [c, s, w])
            }
        },
        active: 0,
        httpSuccess: function (s) {
            try {
                return !s.status && location.protocol === "file:" || s.status >= 200 && s.status < 300 || s.status === 304 || s.status === 1223 || s.status === 0
            } catch (c) {}
            return false
        },
        httpNotModified: function (s, c) {
            var A = s.getResponseHeader("Last-Modified"),
                w = s.getResponseHeader("Etag");
            if (A) {
                ah.lastModified[c] = A
            }
            if (w) {
                ah.etag[c] = w
            }
            return s.status === 304 || s.status === 0
        },
        httpData: function (s, c, F) {
            var w = s.getResponseHeader("content-type") || "",
                A = c === "xml" || !c && w.indexOf("xml") >= 0;
            s = A ? s.responseXML : s.responseText;
            A && s.documentElement.nodeName === "parsererror" && ah.error("parsererror");
            if (F && F.dataFilter) {
                s = F.dataFilter(s, c)
            }
            if (typeof s === "string") {
                if (c === "json" || !c && w.indexOf("json") >= 0) {
                    s = ah.parseJSON(s)
                } else {
                    if (c === "script" || !c && w.indexOf("javascript") >= 0) {
                        ah.globalEval(s)
                    }
                }
            }
            return s
        },
        param: function (s, c) {
            function G(J, K) {
                if (ah.isArray(K)) {
                    ah.each(K, function (L, N) {
                        c || /\[\]$/.test(J) ? A(J, N) : G(J + "[" + (typeof N === "object" || ah.isArray(N) ? L : "") + "]", N)
                    })
                } else {
                    !c && K != null && typeof K === "object" ? ah.each(K, function (L, N) {
                        G(J + "[" + L + "]", N)
                    }) : A(J, K)
                }
            }
            function A(J, K) {
                K = ah.isFunction(K) ? K() : K;
                F[F.length] = encodeURIComponent(J) + "=" + encodeURIComponent(K)
            }
            var F = [];
            if (c === I) {
                c = ah.ajaxSettings.traditional
            }
            if (ah.isArray(s) || s.jquery) {
                ah.each(s, function () {
                    A(this.name, this.value)
                })
            } else {
                for (var w in s) {
                    G(w, s[w])
                }
            }
            return F.join("&").replace(a5, "+")
        }
    });
    var bg = {},
        bc = /toggle|show|hide/,
        aX = /^([+-]=)?([\d+-.]+)(.*)$/,
        aq, D = [
            ["height", "marginTop", "marginBottom", "paddingTop", "paddingBottom"],
            ["width", "marginLeft", "marginRight", "paddingLeft", "paddingRight"],
            ["opacity"]
        ];
    ah.fn.extend({
        show: function (s, c) {
            if (s || s === 0) {
                return this.animate(aC("show", 3), s, c)
            } else {
                s = 0;
                for (c = this.length; s < c; s++) {
                    var F = ah.data(this[s], "olddisplay");
                    this[s].style.display = F || "";
                    if (ah.css(this[s], "display") === "none") {
                        F = this[s].nodeName;
                        var w;
                        if (bg[F]) {
                            w = bg[F]
                        } else {
                            var A = ah("<" + F + " />").appendTo("body");
                            w = A.css("display");
                            if (w === "none") {
                                w = "block"
                            }
                            A.remove();
                            bg[F] = w
                        }
                        ah.data(this[s], "olddisplay", w)
                    }
                }
                s = 0;
                for (c = this.length; s < c; s++) {
                    this[s].style.display = ah.data(this[s], "olddisplay") || ""
                }
                return this
            }
        },
        hide: function (s, c) {
            if (s || s === 0) {
                return this.animate(aC("hide", 3), s, c)
            } else {
                s = 0;
                for (c = this.length; s < c; s++) {
                    var w = ah.data(this[s], "olddisplay");
                    !w && w !== "none" && ah.data(this[s], "olddisplay", ah.css(this[s], "display"))
                }
                s = 0;
                for (c = this.length; s < c; s++) {
                    this[s].style.display = "none"
                }
                return this
            }
        },
        _toggle: ah.fn.toggle,
        toggle: function (s, c) {
            var w = typeof s === "boolean";
            if (ah.isFunction(s) && ah.isFunction(c)) {
                this._toggle.apply(this, arguments)
            } else {
                s == null || w ? this.each(function () {
                    var A = w ? s : ah(this).is(":hidden");
                    ah(this)[A ? "show" : "hide"]()
                }) : this.animate(aC("toggle", 3), s, c)
            }
            return this
        },
        fadeTo: function (s, c, w) {
            return this.filter(":hidden").css("opacity", 0).show().end().animate({
                opacity: c
            }, s, w)
        },
        animate: function (s, c, F, w) {
            var A = ah.speed(c, F, w);
            if (ah.isEmptyObject(s)) {
                return this.each(A.complete)
            }
            return this[A.queue === false ? "each" : "queue"](function () {
                var J = ah.extend({}, A),
                    K, L = this.nodeType === 1 && ah(this).is(":hidden"),
                    G = this;
                for (K in s) {
                    var N = K.replace(ad, v);
                    if (K !== N) {
                        s[N] = s[K];
                        delete s[K];
                        K = N
                    }
                    if (s[K] === "hide" && L || s[K] === "show" && !L) {
                        return J.complete.call(this)
                    }
                    if ((K === "height" || K === "width") && this.style) {
                        J.display = ah.css(this, "display");
                        J.overflow = this.style.overflow
                    }
                    if (ah.isArray(s[K])) {
                        (J.specialEasing = J.specialEasing || {})[K] = s[K][1];
                        s[K] = s[K][0]
                    }
                }
                if (J.overflow != null) {
                    this.style.overflow = "hidden"
                }
                J.curAnim = ah.extend({}, s);
                ah.each(s, function (P, O) {
                    var T = new ah.fx(G, J, P);
                    if (bc.test(O)) {
                        T[O === "toggle" ? L ? "show" : "hide" : O](s)
                    } else {
                        var R = aX.exec(O),
                            V = T.cur(true) || 0;
                        if (R) {
                            O = parseFloat(R[2]);
                            var Q = R[3] || "px";
                            if (Q !== "px") {
                                G.style[P] = (O || 1) + Q;
                                V = (O || 1) / T.cur(true) * V;
                                G.style[P] = V + Q
                            }
                            if (R[1]) {
                                O = (R[1] === "-=" ? -1 : 1) * O + V
                            }
                            T.custom(V, O, Q)
                        } else {
                            T.custom(V, O, "")
                        }
                    }
                });
                return true
            })
        },
        stop: function (s, c) {
            var w = ah.timers;
            s && this.queue([]);
            this.each(function () {
                for (var A = w.length - 1; A >= 0; A--) {
                    if (w[A].elem === this) {
                        c && w[A](true);
                        w.splice(A, 1)
                    }
                }
            });
            c || this.dequeue();
            return this
        }
    });
    ah.each({
        slideDown: aC("show", 1),
        slideUp: aC("hide", 1),
        slideToggle: aC("toggle", 1),
        fadeIn: {
            opacity: "show"
        },
        fadeOut: {
            opacity: "hide"
        }
    }, function (s, c) {
        ah.fn[s] = function (A, w) {
            return this.animate(c, A, w)
        }
    });
    ah.extend({
        speed: function (s, c, A) {
            var w = s && typeof s === "object" ? s : {
                complete: A || !A && c || ah.isFunction(s) && s,
                duration: s,
                easing: A && c || c && !ah.isFunction(c) && c
            };
            w.duration = ah.fx.off ? 0 : typeof w.duration === "number" ? w.duration : ah.fx.speeds[w.duration] || ah.fx.speeds._default;
            w.old = w.complete;
            w.complete = function () {
                w.queue !== false && ah(this).dequeue();
                ah.isFunction(w.old) && w.old.call(this)
            };
            return w
        },
        easing: {
            linear: function (s, c, A, w) {
                return A + w * s
            },
            swing: function (s, c, A, w) {
                return (-Math.cos(s * Math.PI) / 2 + 0.5) * w + A
            }
        },
        timers: [],
        fx: function (s, c, w) {
            this.options = c;
            this.elem = s;
            this.prop = w;
            if (!c.orig) {
                c.orig = {}
            }
        }
    });
    ah.fx.prototype = {
        update: function () {
            this.options.step && this.options.step.call(this.elem, this.now, this);
            (ah.fx.step[this.prop] || ah.fx.step._default)(this);
            if ((this.prop === "height" || this.prop === "width") && this.elem.style) {
                this.elem.style.display = "block"
            }
        },
        cur: function (c) {
            if (this.elem[this.prop] != null && (!this.elem.style || this.elem.style[this.prop] == null)) {
                return this.elem[this.prop]
            }
            return (c = parseFloat(ah.css(this.elem, this.prop, c))) && c > -10000 ? c : parseFloat(ah.curCSS(this.elem, this.prop)) || 0
        },
        custom: function (s, c, F) {
            function w(G) {
                return A.step(G)
            }
            this.startTime = aF();
            this.start = s;
            this.end = c;
            this.unit = F || this.unit || "px";
            this.now = this.start;
            this.pos = this.state = 0;
            var A = this;
            w.elem = this.elem;
            if (w() && ah.timers.push(w) && !aq) {
                aq = setInterval(ah.fx.tick, 13)
            }
        },
        show: function () {
            this.options.orig[this.prop] = ah.style(this.elem, this.prop);
            this.options.show = true;
            this.custom(this.prop === "width" || this.prop === "height" ? 1 : 0, this.cur());
            ah(this.elem).show()
        },
        hide: function () {
            this.options.orig[this.prop] = ah.style(this.elem, this.prop);
            this.options.hide = true;
            this.custom(this.cur(), 0)
        },
        step: function (s) {
            var c = aF(),
                F = true;
            if (s || c >= this.options.duration + this.startTime) {
                this.now = this.end;
                this.pos = this.state = 1;
                this.update();
                this.options.curAnim[this.prop] = true;
                for (var w in this.options.curAnim) {
                    if (this.options.curAnim[w] !== true) {
                        F = false
                    }
                }
                if (F) {
                    if (this.options.display != null) {
                        this.elem.style.overflow = this.options.overflow;
                        s = ah.data(this.elem, "olddisplay");
                        this.elem.style.display = s ? s : this.options.display;
                        if (ah.css(this.elem, "display") === "none") {
                            this.elem.style.display = "block"
                        }
                    }
                    this.options.hide && ah(this.elem).hide();
                    if (this.options.hide || this.options.show) {
                        for (var A in this.options.curAnim) {
                            ah.style(this.elem, A, this.options.orig[A])
                        }
                    }
                    this.options.complete.call(this.elem)
                }
                return false
            } else {
                A = c - this.startTime;
                this.state = A / this.options.duration;
                s = this.options.easing || (ah.easing.swing ? "swing" : "linear");
                this.pos = ah.easing[this.options.specialEasing && this.options.specialEasing[this.prop] || s](this.state, A, 0, 1, this.options.duration);
                this.now = this.start + (this.end - this.start) * this.pos;
                this.update()
            }
            return true
        }
    };
    ah.extend(ah.fx, {
        tick: function () {
            for (var s = ah.timers, c = 0; c < s.length; c++) {
                s[c]() || s.splice(c--, 1)
            }
            s.length || ah.fx.stop()
        },
        stop: function () {
            clearInterval(aq);
            aq = null
        },
        speeds: {
            slow: 600,
            fast: 200,
            _default: 400
        },
        step: {
            opacity: function (c) {
                ah.style(c.elem, "opacity", c.now)
            },
            _default: function (c) {
                if (c.elem.style && c.elem.style[c.prop] != null) {
                    c.elem.style[c.prop] = (c.prop === "width" || c.prop === "height" ? Math.max(0, c.now) : c.now) + c.unit
                } else {
                    c.elem[c.prop] = c.now
                }
            }
        }
    });
    if (ah.expr && ah.expr.filters) {
        ah.expr.filters.animated = function (c) {
            return ah.grep(ah.timers, function (s) {
                return c === s.elem
            }).length
        }
    }
    ah.fn.offset = "getBoundingClientRect" in M.documentElement ?
    function (s) {
        var c = this[0];
        if (s) {
            return this.each(function (F) {
                ah.offset.setOffset(this, s, F)
            })
        }
        if (!c || !c.ownerDocument) {
            return null
        }
        if (c === c.ownerDocument.body) {
            return ah.offset.bodyOffset(c)
        }
        var A = c.getBoundingClientRect(),
            w = c.ownerDocument;
        c = w.body;
        w = w.documentElement;
        return {
            top: A.top + (self.pageYOffset || ah.support.boxModel && w.scrollTop || c.scrollTop) - (w.clientTop || c.clientTop || 0),
            left: A.left + (self.pageXOffset || ah.support.boxModel && w.scrollLeft || c.scrollLeft) - (w.clientLeft || c.clientLeft || 0)
        }
    } : function (N) {
        var L = this[0];
        if (N) {
            return this.each(function (O) {
                ah.offset.setOffset(this, N, O)
            })
        }
        if (!L || !L.ownerDocument) {
            return null
        }
        if (L === L.ownerDocument.body) {
            return ah.offset.bodyOffset(L)
        }
        ah.offset.initialize();
        var K = L.offsetParent,
            G = L,
            J = L.ownerDocument,
            A, F = J.documentElement,
            c = J.body;
        G = (J = J.defaultView) ? J.getComputedStyle(L, null) : L.currentStyle;
        for (var w = L.offsetTop, s = L.offsetLeft;
        (L = L.parentNode) && L !== c && L !== F;) {
            if (ah.offset.supportsFixedPosition && G.position === "fixed") {
                break
            }
            A = J ? J.getComputedStyle(L, null) : L.currentStyle;
            w -= L.scrollTop;
            s -= L.scrollLeft;
            if (L === K) {
                w += L.offsetTop;
                s += L.offsetLeft;
                if (ah.offset.doesNotAddBorder && !(ah.offset.doesAddBorderForTableAndCells && /^t(able|d|h)$/i.test(L.nodeName))) {
                    w += parseFloat(A.borderTopWidth) || 0;
                    s += parseFloat(A.borderLeftWidth) || 0
                }
                G = K;
                K = L.offsetParent
            }
            if (ah.offset.subtractsBorderForOverflowNotVisible && A.overflow !== "visible") {
                w += parseFloat(A.borderTopWidth) || 0;
                s += parseFloat(A.borderLeftWidth) || 0
            }
            G = A
        }
        if (G.position === "relative" || G.position === "static") {
            w += c.offsetTop;
            s += c.offsetLeft
        }
        if (ah.offset.supportsFixedPosition && G.position === "fixed") {
            w += Math.max(F.scrollTop, c.scrollTop);
            s += Math.max(F.scrollLeft, c.scrollLeft)
        }
        return {
            top: w,
            left: s
        }
    };
    ah.offset = {
        initialize: function () {
            var s = M.body,
                c = M.createElement("div"),
                G, A, F, w = parseFloat(ah.curCSS(s, "marginTop", true)) || 0;
            ah.extend(c.style, {
                position: "absolute",
                top: 0,
                left: 0,
                margin: 0,
                border: 0,
                width: "1px",
                height: "1px",
                visibility: "hidden"
            });
            c.innerHTML = "<div style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;'><div></div></div><table style='position:absolute;top:0;left:0;margin:0;border:5px solid #000;padding:0;width:1px;height:1px;' cellpadding='0' cellspacing='0'><tr><td></td></tr></table>";
            s.insertBefore(c, s.firstChild);
            G = c.firstChild;
            A = G.firstChild;
            F = G.nextSibling.firstChild.firstChild;
            this.doesNotAddBorder = A.offsetTop !== 5;
            this.doesAddBorderForTableAndCells = F.offsetTop === 5;
            A.style.position = "fixed";
            A.style.top = "20px";
            this.supportsFixedPosition = A.offsetTop === 20 || A.offsetTop === 15;
            A.style.position = A.style.top = "";
            G.style.overflow = "hidden";
            G.style.position = "relative";
            this.subtractsBorderForOverflowNotVisible = A.offsetTop === -5;
            this.doesNotIncludeMarginInBodyOffset = s.offsetTop !== w;
            s.removeChild(c);
            ah.offset.initialize = ah.noop
        },
        bodyOffset: function (s) {
            var c = s.offsetTop,
                w = s.offsetLeft;
            ah.offset.initialize();
            if (ah.offset.doesNotIncludeMarginInBodyOffset) {
                c += parseFloat(ah.curCSS(s, "marginTop", true)) || 0;
                w += parseFloat(ah.curCSS(s, "marginLeft", true)) || 0
            }
            return {
                top: c,
                left: w
            }
        },
        setOffset: function (s, c, J) {
            if (/static/.test(ah.curCSS(s, "position"))) {
                s.style.position = "relative"
            }
            var F = ah(s),
                G = F.offset(),
                w = parseInt(ah.curCSS(s, "top", true), 10) || 0,
                A = parseInt(ah.curCSS(s, "left", true), 10) || 0;
            if (ah.isFunction(c)) {
                c = c.call(s, J, G)
            }
            J = {
                top: c.top - G.top + w,
                left: c.left - G.left + A
            };
            "using" in c ? c.using.call(s, J) : F.css(J)
        }
    };
    ah.fn.extend({
        position: function () {
            if (!this[0]) {
                return null
            }
            var s = this[0],
                c = this.offsetParent(),
                A = this.offset(),
                w = /^body|html$/i.test(c[0].nodeName) ? {
                    top: 0,
                    left: 0
                } : c.offset();
            A.top -= parseFloat(ah.curCSS(s, "marginTop", true)) || 0;
            A.left -= parseFloat(ah.curCSS(s, "marginLeft", true)) || 0;
            w.top += parseFloat(ah.curCSS(c[0], "borderTopWidth", true)) || 0;
            w.left += parseFloat(ah.curCSS(c[0], "borderLeftWidth", true)) || 0;
            return {
                top: A.top - w.top,
                left: A.left - w.left
            }
        },
        offsetParent: function () {
            return this.map(function () {
                for (var c = this.offsetParent || M.body; c && !/^body|html$/i.test(c.nodeName) && ah.css(c, "position") === "static";) {
                    c = c.offsetParent
                }
                return c
            })
        }
    });
    ah.each(["Left", "Top"], function (s, c) {
        var w = "scroll" + c;
        ah.fn[w] = function (F) {
            var G = this[0],
                A;
            if (!G) {
                return null
            }
            if (F !== I) {
                return this.each(function () {
                    if (A = o(this)) {
                        A.scrollTo(!s ? F : ah(A).scrollLeft(), s ? F : ah(A).scrollTop())
                    } else {
                        this[w] = F
                    }
                })
            } else {
                return (A = o(G)) ? "pageXOffset" in A ? A[s ? "pageYOffset" : "pageXOffset"] : ah.support.boxModel && A.document.documentElement[w] || A.document.body[w] : G[w]
            }
        }
    });
    ah.each(["Height", "Width"], function (s, c) {
        var w = c.toLowerCase();
        ah.fn["inner" + c] = function () {
            return this[0] ? ah.css(this[0], w, false, "padding") : null
        };
        ah.fn["outer" + c] = function (A) {
            return this[0] ? ah.css(this[0], w, false, A ? "margin" : "border") : null
        };
        ah.fn[w] = function (A) {
            var F = this[0];
            if (!F) {
                return A == null ? null : this
            }
            if (ah.isFunction(A)) {
                return this.each(function (G) {
                    var J = ah(this);
                    J[w](A.call(this, G, J[w]()))
                })
            }
            return "scrollTo" in F && F.document ? F.document.compatMode === "CSS1Compat" && F.document.documentElement["client" + c] || F.document.body["client" + c] : F.nodeType === 9 ? Math.max(F.documentElement["client" + c], F.body["scroll" + c], F.documentElement["scroll" + c], F.body["offset" + c], F.documentElement["offset" + c]) : A === I ? ah.css(F, w) : this.css(w, typeof A === "string" ? A : A + "px")
        }
    });
    aO.jQuery = aO.$ = ah
})(window);
jQuery.noConflict();
var $j = jQuery;
(function (b) {
    b.hotkeys = {
        version: "0.8",
        specialKeys: {
            8: "backspace",
            9: "tab",
            13: "return",
            16: "shift",
            17: "ctrl",
            18: "alt",
            19: "pause",
            20: "capslock",
            27: "esc",
            32: "space",
            33: "pageup",
            34: "pagedown",
            35: "end",
            36: "home",
            37: "left",
            38: "up",
            39: "right",
            40: "down",
            45: "insert",
            46: "del",
            96: "0",
            97: "1",
            98: "2",
            99: "3",
            100: "4",
            101: "5",
            102: "6",
            103: "7",
            104: "8",
            105: "9",
            106: "*",
            107: "+",
            109: "-",
            110: ".",
            111: "/",
            112: "f1",
            113: "f2",
            114: "f3",
            115: "f4",
            116: "f5",
            117: "f6",
            118: "f7",
            119: "f8",
            120: "f9",
            121: "f10",
            122: "f11",
            123: "f12",
            144: "numlock",
            145: "scroll",
            191: "/",
            224: "meta"
        },
        shiftNums: {
            "`": "~",
            "1": "!",
            "2": "@",
            "3": "#",
            "4": "$",
            "5": "%",
            "6": "^",
            "7": "&",
            "8": "*",
            "9": "(",
            "0": ")",
            "-": "_",
            "=": "+",
            ";": ": ",
            "'": '"',
            ",": "<",
            ".": ">",
            "/": "?",
            "\\": "|"
        }
    };

    function a(d) {
        if (typeof d.data !== "string") {
            return
        }
        var c = d.handler,
            e = d.data.toLowerCase().split(" ");
        d.handler = function (n) {
            if (this !== n.target && (/textarea|select/i.test(n.target.nodeName) || n.target.type === "text")) {
                return
            }
            var h = n.type !== "keypress" && b.hotkeys.specialKeys[n.which],
                o = String.fromCharCode(n.which).toLowerCase(),
                k, m = "",
                g = {};
            if (n.altKey && h !== "alt") {
                m += "alt+"
            }
            if (n.ctrlKey && h !== "ctrl") {
                m += "ctrl+"
            }
            if (n.metaKey && !n.ctrlKey && h !== "meta") {
                m += "meta+"
            }
            if (n.shiftKey && h !== "shift") {
                m += "shift+"
            }
            if (h) {
                g[m + h] = true
            } else {
                g[m + o] = true;
                g[m + b.hotkeys.shiftNums[o]] = true;
                if (m === "shift+") {
                    g[b.hotkeys.shiftNums[o]] = true
                }
            }
            for (var j = 0, f = e.length; j < f; j++) {
                if (g[e[j]]) {
                    return c.apply(this, arguments)
                }
            }
        }
    }
    b.each(["keydown", "keyup", "keypress"], function () {
        b.event.special[this] = {
            add: a
        }
    })
})(jQuery);
var Shortcuts = {
    init: function () {
        if ($j("#PrevLink").exists()) {
            if (navigator.platform.match(/mac/i)) {
                $j(document).bind("keydown", "alt+ctrl+left", function () {
                    document.location = $j("#PrevLink").attr("href")
                })
            } else {
                $j(document).bind("keydown", "ctrl+left", function () {
                    document.location = $j("#PrevLink").attr("href")
                })
            }
        }
        if ($j("#NextLink").exists()) {
            if (navigator.platform.match(/mac/i)) {
                $j(document).bind("keydown", "alt+ctrl+right", function () {
                    document.location = $j("#NextLink").attr("href")
                })
            } else {
                $j(document).bind("keydown", "ctrl+right", function () {
                    document.location = $j("#NextLink").attr("href")
                })
            }
        }
    }
};
$j(document).ready(Shortcuts.init);
var SyntaxHighlighting = {
    refresh: function () {
        if ($j(".diff").length > 0) {
            return
        }
        $j(".highlighttable").each(function () {
            var a = $j(".content").width() - 55;
            var b = 0;
            $j(this).find(".linenos pre:lt(2)").each(function () {
                b += $j(this).innerWidth()
            });
            if (b == 0) {
                return
            }
            $j(this).find(".highlight").each(function () {
                $j(this).css("width", "");
                if ($j(this).width() > a) {
                    $j(this).css("width", a - b)
                }
            })
        })
    }
};
$j(document).ready(SyntaxHighlighting.refresh);
$j(window).resize(SyntaxHighlighting.refresh);
var Help = {
    init: function () {
        $j("#help").data("current", false);
        if ($j("#help").length == 0) {
            $j('<div id="help" class="hide"><div class="wrapper"><a href="#" class="close-help">Close</a><div class="scroll-area"><div class="wrapper"></div></div></div></div>').appendTo($j("body"))
        }
        $j("a[rel=help]").live("click", function (a) {
            a.preventDefault();
            Help.load(this)
        });
        $j("#help .close-help").click(function (a) {
            a.preventDefault();
            Help.hide()
        })
    },
    load: function (a) {
        if ($j("#help").data("current") == a) {
            Help.hide();
            return
        } else {
            Help.show();
            Help.refresh()
        }
        $j("#help").data("current", a);
        $j("#help .scroll-area .wrapper").html("").load($j(a).attr("href"), function () {
            $j("#help").removeClass("loading");
            Help.reset()
        })
    },
    show: function () {
        $j("#help").addClass("loading").showMe().animate({
            right: 0
        }, 250)
    },
    hide: function () {
        $j("#help").animate({
            right: -($j("#help").width() + 40)
        }, 250).data("current", false)
    },
    refresh: function () {
        $j("#help .scroll-area").css("height", $j(window).height() - 20)
    },
    reset: function () {
        $j("#help .scroll-area").jScrollPane()
    },
    resize: function () {
        $j(".jScrollPaneContainer").css("height", ($j(window).height() - 20) + "px");
        if ($j("#help").isHidden()) {
            return
        }
        Help.reset()
    }
};
$j(document).ready(Help.init);
$j(window).resize(Help.resize);
(function (a) {
    a.jScrollPane = {
        active: []
    };
    a.fn.jScrollPane = function (c) {
        c = a.extend({}, a.fn.jScrollPane.defaults, c);
        var b = function () {
            return false
        };
        return this.each(function () {
            var o = a(this);
            o.css("overflow", "hidden");
            var y = this;
            if (a(this).parent().is(".jScrollPaneContainer")) {
                var ac = c.maintainPosition ? o.position().top : 0;
                var l = a(this).parent();
                var E = l.innerWidth();
                var ad = l.outerHeight();
                var m = ad;
                a(">.jScrollPaneTrack, >.jScrollArrowUp, >.jScrollArrowDown", l).remove();
                o.css({
                    top: 0
                })
            } else {
                var ac = 0;
                this.originalPadding = o.css("paddingTop") + " " + o.css("paddingRight") + " " + o.css("paddingBottom") + " " + o.css("paddingLeft");
                this.originalSidePaddingTotal = (parseInt(o.css("paddingLeft")) || 0) + (parseInt(o.css("paddingRight")) || 0);
                var E = o.innerWidth();
                var ad = o.innerHeight();
                var m = ad;
                o.wrap(a("<div></div>").attr({
                    className: "jScrollPaneContainer"
                }).css({
                    height: ad + "px",
                    width: E + "px"
                }));
                a(document).bind("emchange", function (ae, af, p) {
                    o.jScrollPane(c)
                })
            }
            if (c.reinitialiseOnImageLoad) {
                var n = a.data(y, "jScrollPaneImagesToLoad") || a("img", o);
                var g = [];
                if (n.length) {
                    n.each(function (p, ae) {
                        a(this).bind("load", function () {
                            if (a.inArray(p, g) == -1) {
                                g.push(ae);
                                n = a.grep(n, function (ag, af) {
                                    return ag != ae
                                });
                                a.data(y, "jScrollPaneImagesToLoad", n);
                                c.reinitialiseOnImageLoad = false;
                                o.jScrollPane(c)
                            }
                        }).each(function (af, ag) {
                            if (this.complete || this.complete === undefined) {
                                this.src = this.src
                            }
                        })
                    })
                }
            }
            var P = this.originalSidePaddingTotal;
            var M = {
                height: "auto",
                width: E - c.scrollbarWidth - c.scrollbarMargin - P + "px"
            };
            if (c.scrollbarOnLeft) {
                M.paddingLeft = c.scrollbarMargin + c.scrollbarWidth + "px"
            } else {
                M.paddingRight = c.scrollbarMargin + "px"
            }
            o.css(M);
            var N = o.outerHeight();
            var J = ad / N;
            if (J < 0.99) {
                var h = o.parent();
                h.append(a("<div></div>").attr({
                    className: "jScrollPaneTrack"
                }).css({
                    width: c.scrollbarWidth + "px"
                }).append(a("<div></div>").attr({
                    className: "jScrollPaneDrag"
                }).css({
                    width: c.scrollbarWidth + "px"
                }).append(a("<div></div>").attr({
                    className: "jScrollPaneDragTop"
                }).css({
                    width: c.scrollbarWidth + "px"
                }), a("<div></div>").attr({
                    className: "jScrollPaneDragBottom"
                }).css({
                    width: c.scrollbarWidth + "px"
                }))));
                var Z = a(">.jScrollPaneTrack", h);
                var q = a(">.jScrollPaneTrack .jScrollPaneDrag", h);
                if (c.showArrows) {
                    var H;
                    var ab;
                    var t;
                    var R;
                    var K = function () {
                        if (R > 4 || R % 4 == 0) {
                            Y(U + ab * C)
                        }
                        R++
                    };
                    var k = function (p) {
                        a("html").unbind("mouseup", k);
                        H.removeClass("jScrollActiveArrowButton");
                        clearInterval(t)
                    };
                    var A = function () {
                        a("html").bind("mouseup", k);
                        H.addClass("jScrollActiveArrowButton");
                        R = 0;
                        K();
                        t = setInterval(K, 100)
                    };
                    h.append(a("<a></a>").attr({
                        href: "javascript:;",
                        className: "jScrollArrowUp"
                    }).css({
                        width: c.scrollbarWidth + "px"
                    }).html("Scroll up").bind("mousedown", function () {
                        H = a(this);
                        ab = -1;
                        A();
                        this.blur();
                        return false
                    }).bind("click", b), a("<a></a>").attr({
                        href: "javascript:;",
                        className: "jScrollArrowDown"
                    }).css({
                        width: c.scrollbarWidth + "px"
                    }).html("Scroll down").bind("mousedown", function () {
                        H = a(this);
                        ab = 1;
                        A();
                        this.blur();
                        return false
                    }).bind("click", b));
                    var r = a(">.jScrollArrowUp", h);
                    var j = a(">.jScrollArrowDown", h);
                    if (c.arrowSize) {
                        m = ad - c.arrowSize - c.arrowSize;
                        Z.css({
                            height: m + "px",
                            top: c.arrowSize + "px"
                        })
                    } else {
                        var S = r.height();
                        c.arrowSize = S;
                        m = ad - S - j.height();
                        Z.css({
                            height: m + "px",
                            top: S + "px"
                        })
                    }
                }
                var W = a(this).css({
                    position: "absolute",
                    overflow: "visible"
                });
                var d;
                var z;
                var C;
                var U = 0;
                var w = J * ad / 2;
                var B = function (ae, ag) {
                    var af = ag == "X" ? "Left" : "Top";
                    return ae["page" + ag] || (ae["client" + ag] + (document.documentElement["scroll" + af] || document.body["scroll" + af])) || 0
                };
                var G = function () {
                    return false
                };
                var V = function () {
                    O();
                    d = q.offset(false);
                    d.top -= U;
                    z = m - q[0].offsetHeight;
                    C = 2 * c.wheelSpeed * z / N
                };
                var e = function (p) {
                    V();
                    w = B(p, "Y") - U - d.top;
                    a("html").bind("mouseup", u).bind("mousemove", I);
                    if (a.browser.msie) {
                        a("html").bind("dragstart", G).bind("selectstart", G)
                    }
                    return false
                };
                var u = function () {
                    a("html").unbind("mouseup", u).unbind("mousemove", I);
                    w = J * ad / 2;
                    if (a.browser.msie) {
                        a("html").unbind("dragstart", G).unbind("selectstart", G)
                    }
                };
                var Y = function (ae) {
                    ae = ae < 0 ? 0 : (ae > z ? z : ae);
                    U = ae;
                    q.css({
                        top: ae + "px"
                    });
                    var af = ae / z;
                    W.css({
                        top: ((ad - N) * af) + "px"
                    });
                    o.trigger("scroll");
                    if (c.showArrows) {
                        r[ae == 0 ? "addClass" : "removeClass"]("disabled");
                        j[ae == z ? "addClass" : "removeClass"]("disabled")
                    }
                };
                var I = function (p) {
                    Y(B(p, "Y") - d.top - w)
                };
                var Q = Math.max(Math.min(J * (ad - c.arrowSize * 2), c.dragMaxHeight), c.dragMinHeight);
                q.css({
                    height: Q + "px"
                }).bind("mousedown", e);
                var L;
                var s;
                var i;
                var T = function () {
                    if (s > 8 || s % 4 == 0) {
                        Y((U - ((U - i) / 2)))
                    }
                    s++
                };
                var aa = function () {
                    clearInterval(L);
                    a("html").unbind("mouseup", aa).unbind("mousemove", F)
                };
                var F = function (p) {
                    i = B(p, "Y") - d.top - w
                };
                var v = function (p) {
                    V();
                    F(p);
                    s = 0;
                    a("html").bind("mouseup", aa).bind("mousemove", F);
                    L = setInterval(T, 100);
                    T()
                };
                Z.bind("mousedown", v);
                h.bind("mousewheel", function (ae, ag) {
                    V();
                    O();
                    var af = U;
                    Y(U - ag * C);
                    var p = af != U;
                    return !p
                });
                var f;
                var x;

                function D() {
                    var p = (f - U) / c.animateStep;
                    if (p > 1 || p < -1) {
                        Y(U + p)
                    } else {
                        Y(f);
                        O()
                    }
                }
                var O = function () {
                    if (x) {
                        clearInterval(x);
                        delete f
                    }
                };
                var X = function (af, p) {
                    if (typeof af == "string") {
                        $e = a(af, o);
                        if (!$e.length) {
                            return
                        }
                        af = $e.offset().top - o.offset().top
                    }
                    h.scrollTop(0);
                    O();
                    var ae = -af / (ad - N) * z;
                    if (p || !c.animateTo) {
                        Y(ae)
                    } else {
                        f = ae;
                        x = setInterval(D, c.animateInterval)
                    }
                };
                o[0].scrollTo = X;
                o[0].scrollBy = function (ae) {
                    var p = -parseInt(W.css("top")) || 0;
                    X(p + ae)
                };
                V();
                X(-ac, true);
                a("*", this).bind("focus", function (ah) {
                    var ag = a(this);
                    var aj = 0;
                    while (ag[0] != o[0]) {
                        aj += ag.position().top;
                        ag = ag.offsetParent()
                    }
                    var p = -parseInt(W.css("top")) || 0;
                    var ai = p + ad;
                    var af = aj > p && aj < ai;
                    if (!af) {
                        var ae = aj - c.scrollbarMargin;
                        if (aj > p) {
                            ae += a(this).height() + 15 + c.scrollbarMargin - ad
                        }
                        X(ae)
                    }
                });
                if (location.hash) {
                    X(location.hash)
                }
                a(document).bind("click", function (ae) {
                    $target = a(ae.target);
                    if ($target.is("a")) {
                        var p = $target.attr("href");
                        if (p.substr(0, 1) == "#") {
                            X(p)
                        }
                    }
                });
                a.jScrollPane.active.push(o[0])
            } else {
                o.css({
                    height: ad + "px",
                    width: E - this.originalSidePaddingTotal + "px",
                    padding: this.originalPadding
                });
                o.parent().unbind("mousewheel")
            }
        })
    };
    a.fn.jScrollPane.defaults = {
        scrollbarWidth: 10,
        scrollbarMargin: 5,
        wheelSpeed: 18,
        showArrows: false,
        arrowSize: 0,
        animateTo: false,
        dragMinHeight: 1,
        dragMaxHeight: 99999,
        animateInterval: 100,
        animateStep: 3,
        maintainPosition: true,
        scrollbarOnLeft: false,
        reinitialiseOnImageLoad: false
    };
    a(window).bind("unload", function () {
        var c = a.jScrollPane.active;
        for (var b = 0; b < c.length; b++) {
            c[b].scrollTo = c[b].scrollBy = null
        }
    })
})(jQuery);
(function (a) {
    a.fn.simpleTooltip = function (b) {
        var c = a.extend({}, a.fn.simpleTooltip.defaults, b);
        return this.each(function () {
            var d = a(this);
            d.data("title", d.attr("title")).removeAttr("title");
            d.hover(function (f) {
                a("body").append('<div id="tooltip"><p>' + d.data("title") + "</p></div>");
                a("#tooltip").css({
                    top: (f.pageY - c.xOffset) + "px",
                    left: (f.pageX + c.yOffset) + "px",
                    opacity: c.opacity
                })
            }, function () {
                a("#tooltip").remove()
            });
            d.mousemove(function (f) {
                a("#tooltip").css({
                    top: (f.pageY - c.xOffset) + "px",
                    left: (f.pageX + c.yOffset) + "px"
                })
            })
        })
    };
    a.fn.simpleTooltip.defaults = {
        title: null,
        xOffset: 10,
        yOffset: 20,
        opacity: 0.8
    }
})(jQuery);
jQuery.fn.autocomplete = function (p) {
    if (this.length == 0) {
        return
    }
    var c = jQuery.extend({
        type: "local",
        data: false,
        url: false,
        maxResults: 10,
        offset: 500,
        blankMessage: "Sorry, nothing found.",
        onTyping: function () {},
        onQuery: function () {},
        onShow: function () {},
        onClear: function () {},
        onSelect: function (q) {}
    }, p);
    var a = $j(this);
    var g = false;
    var d = 0;
    var b, k;
    o();
    a.keyup(function (q) {
        if (jQuery.inArray(q.keyCode, [13, 37, 38, 39, 40, 27]) != -1) {
            return
        }
        b = a.addClass("querying");
        window.clearTimeout(k);
        c.onTyping();
        k = window.setTimeout(function () {
            if (g) {
                return
            }
            c.onQuery();
            i()
        }, c.offset);
        h()
    });

    function o() {
        if ($j("#autocomplete").length == 0) {
            $j('<div id="autocomplete" class="hide"><p class="hide">' + c.blankMessage + "</p><ul></ul></div").appendTo($j("body"))
        }
        a.bind(($j.browser.opera ? "keypress" : "keydown") + ".autocomplete", function (q) {
            switch (q.keyCode) {
            case 38:
                q.preventDefault();
                d--;
                if (d < 0) {
                    d = $j("#autocomplete a").length - 1
                }
                break;
            case 40:
                q.preventDefault();
                d++;
                if (d >= $j("#autocomplete a").length) {
                    d = 0
                }
                break;
            case 13:
                q.preventDefault();
                l($j("#autocomplete a.selected"));
                break;
            case 27:
                c.onClear();
                a.blur();
                e();
                f();
                break
            }
            $j("#autocomplete").find("a").removeClass("selected").end().find("a:eq(" + d + ")").addClass("selected")
        })
    }
    function i() {
        g = true;
        switch (c.type) {
        case "local":
            var q = new Array();
            $j.each(c.data, function (r, s) {
                if (s.text.search(new RegExp(j(a.val()), "i")) != -1) {
                    q.push(c.data[r])
                }
            });
            n(q);
            break;
        case "remote":
            $j.ajax({
                url: c.url,
                dataType: "json",
                data: {
                    keywords: a.val()
                },
                success: function (r) {
                    n(r)
                }
            });
            break
        }
    }
    function n(q) {
        b.removeClass("querying");
        g = false;
        e();
        $j.each(q, function (r, s) {
            if (r >= c.maxResults) {
                return
            }
            $j('<li><a href="#" rel="' + s.id + '">' + s.text + "</a></li>").appendTo($j("#autocomplete ul"))
        });
        $j("#autocomplete a").click(function (r) {
            r.preventDefault();
            l(this)
        });
        if (q.length == 0) {
            $j("#autocomplete p").showMe()
        } else {
            $j("#autocomplete p").hideMe()
        }
        c.onShow();
        d = 0;
        $j("#autocomplete a:first").addClass("selected");
        m()
    }
    function l(q) {
        c.onSelect({
            id: $j(q).attr("rel"),
            text: $j(q).text()
        });
        f();
        e()
    }
    function m() {
        $j("#autocomplete").showMe().highlight()
    }
    function f() {
        $j("#autocomplete").hideMe()
    }
    function e() {
        $j("#autocomplete").find("a").removeClass("selected").end().find("ul").html("")
    }
    function h() {
        $j("#autocomplete").css({
            width: b.outerWidth(),
            top: b.offset().top + b.outerHeight(),
            left: b.offset().left
        })
    }
    function j(r) {
        var q = new RegExp("[.*+?|()\\[\\]{}\\\\]", "g");
        return r.replace(q, "\\$&")
    }
};
var Helpers = {
    init: function () {
        var a = '.new-window, a[rel="new-window"], a[rel="open-chat"], #specialPage .repo-help a';
        $j(a).each(function () {
            $j(this).attr({
                target: "_blank",
                title: "Opens a new window."
            })
        });
        if ($j(a).length > 0) {
            $j(a).simpleTooltip()
        }
        $j('a[rel="open-chat"]').live("click", function (b) {
            b.preventDefault();
            chat = window.open($j(this).attr("href"), "Chat", "width=520,height=380,toolbar=no,status=no,scrollbars=no,resizable=no");
            chat.focus()
        });
        Helpers.setSidebarHeight()
    },
    setSidebarHeight: function () {
        if ($j("#sidebar").length == 0) {
            return
        }
        $j("#sidebar").css("height", $j("#page .content").innerHeight())
    }
};
$j(document).ready(Helpers.init);
$j(window).resize(Helpers.setSidebarHeight);
jQuery.fn.extend({
    showMe: function () {
        return this.removeClass("hide")
    },
    hideMe: function () {
        return this.addClass("hide")
    },
    toggleMe: function () {
        return this.toggleClass("hide")
    },
    isHidden: function () {
        if (this.hasClass("hide")) {
            return true
        } else {
            return false
        }
    },
    highlight: function () {
        this.css("opacity", 0).animate({
            opacity: 1
        }, 250)
    },
    exists: function () {
        if (this.length == 0) {
            return false
        } else {
            return true
        }
    },
    centerize: function () {
        return this.css({
            left: ($j(window).width() / 2) - (this.innerWidth() / 2) + "px",
            top: ($j(window).height() / 2) - (this.innerHeight() / 2) + "px"
        })
    },
    disable: function () {
        return this.addClass("loading")
    },
    enable: function () {
        return this.removeClass("loading")
    }
});
var Forms = {
    init: function () {
        $j("input.url-convert").keyup(function () {
            $j(this).val($j(this).val().replace(/[^\w]/ig, "-").toLowerCase())
        });
        $j("a.confirm").click(function (a) {
            if (!confirm($j(this).attr("rel"))) {
                a.preventDefault()
            }
        });
        Forms.blankFields();
        Forms.ownerChange();
        Forms.colorLabelPreview();
        Forms.fixIE();
        Forms.loading();
        Forms.dataImport()
    },
    blankFields: function () {
        $j("input.blank, textarea.blank").each(function () {
            var a = $j(this);
            var b = a.attr("title");
            if (a.val() == "") {
                a.val(b)
            } else {
                a.removeClass("blank")
            }
            a.focus(function () {
                if (a.val() == b) {
                    a.val("")
                }
                a.removeClass("blank")
            });
            a.blur(function () {
                if (a.val() == "") {
                    if (!a.hasClass("blank")) {
                        a.addClass("blank")
                    }
                    a.val(b)
                }
            });
            a.parents("form").submit(function () {
                if (a.val() == b) {
                    a.val("")
                }
            })
        })
    },
    ownerChange: function () {
        $j("#account-owner select").data("owner", $j("#account-owner select").val());
        $j("#account-owner select").change(function () {
            if ($j(this).val() != $j(this).data("owner")) {
                $j(".message").showMe().highlight()
            } else {
                $j(".message").hideMe()
            }
        })
    },
    colorLabelPreview: function () {
        $j("#label-preview").siblings("select").change(function () {
            $j("#title h1 b").attr("class", "label-" + $(this).getValue());
            $j("#label-preview").attr("class", "rev-repo label-" + $(this).getValue());
            $j("#label-preview i").attr("class", "label-" + $(this).getValue())
        })
    },
    fixIE: function () {
        if (!$j.browser.msie) {
            return
        }
        $j(".forms fieldset:odd").addClass("even");
        $j(".forms fieldset:first").addClass("first");
        $j(".forms fieldset:last").addClass("last")
    },
    loading: function () {
      
    },
    dataImport: function () {
        if ($j("#data-import").length == 0) {
            return
        }
        $j("#data-import input:radio:checked").parents(".import-option").find(".details").showMe();
        $j("#data-import input:radio").change(function () {
            $j(".details").hideMe();
            $j(this).parents(".import-option").find(".details").showMe()
        })
    }
};
$j(document).ready(Forms.init);
var PopUp = {
    init: function () {
        if ($j("#popup").length == 0) {
            return
        }
        if ($j("#curtain").length == 0) {
            $j('<div id="curtain" class="hidden"></div>').appendTo($j("body"))
        }
        PopUp.lightsOff();
        PopUp.show();
        PopUp.refresh();
        $j('#popup *[rel="close-popup"]').click(function (a) {
            a.preventDefault();
            PopUp.lightsOn();
            PopUp.hide()
        });
        $j("#popup .get-started a:last").click(function (a) {
            Help.load($j(this))
        })
    },
    show: function () {
        $j("#popup").centerize().showMe()
    },
    hide: function () {
        $j("#popup").hideMe()
    },
    lightsOff: function () {
        $j("#curtain").showMe()
    },
    lightsOn: function () {
        $j("#curtain").hideMe()
    },
    refresh: function () {
        $j("#curtain").css({
            width: $j(window).width(),
            height: $j(window).height()
        });
        $j("#popup").centerize()
    }
};
$j(document).ready(PopUp.init);
$j(window).resize(PopUp.refresh);
$j(function () {
    $j(".repo-subscription .button").click(function (b) {
        b.preventDefault();
        var a = $j(this);
        $j(".repo-subscription .action").disable();
        $j.post(a.attr("href"), {
            _method: a.attr("rel")
        }, function () {
            $j(".repo-subscription").enable().find("p").toggleMe().end().find(".action").enable()
        })
    })
});

/*
 * jQuery Easing v1.3 - http://gsgd.co.uk/sandbox/jquery/easing/
 *
 * Uses the built in easing capabilities added In jQuery 1.1
 * to offer multiple easing options
 *
 * TERMS OF USE - jQuery Easing
 * 
 * Open source under the BSD License. 
 * 
 * Copyright © 2008 George McGinley Smith
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, 
 * are permitted provided that the following conditions are met:
 * 
 * Redistributions of source code must retain the above copyright notice, this list of 
 * conditions and the following disclaimer.
 * Redistributions in binary form must reproduce the above copyright notice, this list 
 * of conditions and the following disclaimer in the documentation and/or other materials 
 * provided with the distribution.
 * 
 * Neither the name of the author nor the names of contributors may be used to endorse 
 * or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY 
 * EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 *  COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 *  EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
 *  GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED 
 * AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 *  NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED 
 * OF THE POSSIBILITY OF SUCH DAMAGE. 
 *
*/

// t: current time, b: begInnIng value, c: change In value, d: duration
jQuery.easing['jswing'] = jQuery.easing['swing'];

jQuery.extend( jQuery.easing,
{
	def: 'easeOutQuad',
	swing: function (x, t, b, c, d) {
		//alert(jQuery.easing.default);
		return jQuery.easing[jQuery.easing.def](x, t, b, c, d);
	},
	easeInQuad: function (x, t, b, c, d) {
		return c*(t/=d)*t + b;
	},
	easeOutQuad: function (x, t, b, c, d) {
		return -c *(t/=d)*(t-2) + b;
	},
	easeInOutQuad: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t + b;
		return -c/2 * ((--t)*(t-2) - 1) + b;
	},
	easeInCubic: function (x, t, b, c, d) {
		return c*(t/=d)*t*t + b;
	},
	easeOutCubic: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t + 1) + b;
	},
	easeInOutCubic: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t + b;
		return c/2*((t-=2)*t*t + 2) + b;
	},
	easeInQuart: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t + b;
	},
	easeOutQuart: function (x, t, b, c, d) {
		return -c * ((t=t/d-1)*t*t*t - 1) + b;
	},
	easeInOutQuart: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t + b;
		return -c/2 * ((t-=2)*t*t*t - 2) + b;
	},
	easeInQuint: function (x, t, b, c, d) {
		return c*(t/=d)*t*t*t*t + b;
	},
	easeOutQuint: function (x, t, b, c, d) {
		return c*((t=t/d-1)*t*t*t*t + 1) + b;
	},
	easeInOutQuint: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return c/2*t*t*t*t*t + b;
		return c/2*((t-=2)*t*t*t*t + 2) + b;
	},
	easeInSine: function (x, t, b, c, d) {
		return -c * Math.cos(t/d * (Math.PI/2)) + c + b;
	},
	easeOutSine: function (x, t, b, c, d) {
		return c * Math.sin(t/d * (Math.PI/2)) + b;
	},
	easeInOutSine: function (x, t, b, c, d) {
		return -c/2 * (Math.cos(Math.PI*t/d) - 1) + b;
	},
	easeInExpo: function (x, t, b, c, d) {
		return (t==0) ? b : c * Math.pow(2, 10 * (t/d - 1)) + b;
	},
	easeOutExpo: function (x, t, b, c, d) {
		return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
	},
	easeInOutExpo: function (x, t, b, c, d) {
		if (t==0) return b;
		if (t==d) return b+c;
		if ((t/=d/2) < 1) return c/2 * Math.pow(2, 10 * (t - 1)) + b;
		return c/2 * (-Math.pow(2, -10 * --t) + 2) + b;
	},
	easeInCirc: function (x, t, b, c, d) {
		return -c * (Math.sqrt(1 - (t/=d)*t) - 1) + b;
	},
	easeOutCirc: function (x, t, b, c, d) {
		return c * Math.sqrt(1 - (t=t/d-1)*t) + b;
	},
	easeInOutCirc: function (x, t, b, c, d) {
		if ((t/=d/2) < 1) return -c/2 * (Math.sqrt(1 - t*t) - 1) + b;
		return c/2 * (Math.sqrt(1 - (t-=2)*t) + 1) + b;
	},
	easeInElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return -(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
	},
	easeOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
	},
	easeInOutElastic: function (x, t, b, c, d) {
		var s=1.70158;var p=0;var a=c;
		if (t==0) return b;  if ((t/=d/2)==2) return b+c;  if (!p) p=d*(.3*1.5);
		if (a < Math.abs(c)) { a=c; var s=p/4; }
		else var s = p/(2*Math.PI) * Math.asin (c/a);
		if (t < 1) return -.5*(a*Math.pow(2,10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )) + b;
		return a*Math.pow(2,-10*(t-=1)) * Math.sin( (t*d-s)*(2*Math.PI)/p )*.5 + c + b;
	},
	easeInBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*(t/=d)*t*((s+1)*t - s) + b;
	},
	easeOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158;
		return c*((t=t/d-1)*t*((s+1)*t + s) + 1) + b;
	},
	easeInOutBack: function (x, t, b, c, d, s) {
		if (s == undefined) s = 1.70158; 
		if ((t/=d/2) < 1) return c/2*(t*t*(((s*=(1.525))+1)*t - s)) + b;
		return c/2*((t-=2)*t*(((s*=(1.525))+1)*t + s) + 2) + b;
	},
	easeInBounce: function (x, t, b, c, d) {
		return c - jQuery.easing.easeOutBounce (x, d-t, 0, c, d) + b;
	},
	easeOutBounce: function (x, t, b, c, d) {
		if ((t/=d) < (1/2.75)) {
			return c*(7.5625*t*t) + b;
		} else if (t < (2/2.75)) {
			return c*(7.5625*(t-=(1.5/2.75))*t + .75) + b;
		} else if (t < (2.5/2.75)) {
			return c*(7.5625*(t-=(2.25/2.75))*t + .9375) + b;
		} else {
			return c*(7.5625*(t-=(2.625/2.75))*t + .984375) + b;
		}
	},
	easeInOutBounce: function (x, t, b, c, d) {
		if (t < d/2) return jQuery.easing.easeInBounce (x, t*2, 0, c, d) * .5 + b;
		return jQuery.easing.easeOutBounce (x, t*2-d, 0, c, d) * .5 + c*.5 + b;
	}
});
/*!
 * jQuery UI 1.8.9
 *
 * Copyright 2011, AUTHORS.txt (http://jqueryui.com/about)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://jquery.org/license
 *
 * http://docs.jquery.com/UI
 */
(function(b,c){function f(g){return!b(g).parents().andSelf().filter(function(){return b.curCSS(this,"visibility")==="hidden"||b.expr.filters.hidden(this)}).length}b.ui=b.ui||{};if(!b.ui.version){b.extend(b.ui,{version:"1.8.9",keyCode:{ALT:18,BACKSPACE:8,CAPS_LOCK:20,COMMA:188,COMMAND:91,COMMAND_LEFT:91,COMMAND_RIGHT:93,CONTROL:17,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,INSERT:45,LEFT:37,MENU:93,NUMPAD_ADD:107,NUMPAD_DECIMAL:110,NUMPAD_DIVIDE:111,NUMPAD_ENTER:108,NUMPAD_MULTIPLY:106,
NUMPAD_SUBTRACT:109,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SHIFT:16,SPACE:32,TAB:9,UP:38,WINDOWS:91}});b.fn.extend({_focus:b.fn.focus,focus:function(g,e){return typeof g==="number"?this.each(function(){var a=this;setTimeout(function(){b(a).focus();e&&e.call(a)},g)}):this._focus.apply(this,arguments)},scrollParent:function(){var g;g=b.browser.msie&&/(static|relative)/.test(this.css("position"))||/absolute/.test(this.css("position"))?this.parents().filter(function(){return/(relative|absolute|fixed)/.test(b.curCSS(this,
"position",1))&&/(auto|scroll)/.test(b.curCSS(this,"overflow",1)+b.curCSS(this,"overflow-y",1)+b.curCSS(this,"overflow-x",1))}).eq(0):this.parents().filter(function(){return/(auto|scroll)/.test(b.curCSS(this,"overflow",1)+b.curCSS(this,"overflow-y",1)+b.curCSS(this,"overflow-x",1))}).eq(0);return/fixed/.test(this.css("position"))||!g.length?b(document):g},zIndex:function(g){if(g!==c)return this.css("zIndex",g);if(this.length){g=b(this[0]);for(var e;g.length&&g[0]!==document;){e=g.css("position");
if(e==="absolute"||e==="relative"||e==="fixed"){e=parseInt(g.css("zIndex"),10);if(!isNaN(e)&&e!==0)return e}g=g.parent()}}return 0},disableSelection:function(){return this.bind((b.support.selectstart?"selectstart":"mousedown")+".ui-disableSelection",function(g){g.preventDefault()})},enableSelection:function(){return this.unbind(".ui-disableSelection")}});b.each(["Width","Height"],function(g,e){function a(j,n,q,l){b.each(d,function(){n-=parseFloat(b.curCSS(j,"padding"+this,true))||0;if(q)n-=parseFloat(b.curCSS(j,
"border"+this+"Width",true))||0;if(l)n-=parseFloat(b.curCSS(j,"margin"+this,true))||0});return n}var d=e==="Width"?["Left","Right"]:["Top","Bottom"],h=e.toLowerCase(),i={innerWidth:b.fn.innerWidth,innerHeight:b.fn.innerHeight,outerWidth:b.fn.outerWidth,outerHeight:b.fn.outerHeight};b.fn["inner"+e]=function(j){if(j===c)return i["inner"+e].call(this);return this.each(function(){b(this).css(h,a(this,j)+"px")})};b.fn["outer"+e]=function(j,n){if(typeof j!=="number")return i["outer"+e].call(this,j);return this.each(function(){b(this).css(h,
a(this,j,true,n)+"px")})}});b.extend(b.expr[":"],{data:function(g,e,a){return!!b.data(g,a[3])},focusable:function(g){var e=g.nodeName.toLowerCase(),a=b.attr(g,"tabindex");if("area"===e){e=g.parentNode;a=e.name;if(!g.href||!a||e.nodeName.toLowerCase()!=="map")return false;g=b("img[usemap=#"+a+"]")[0];return!!g&&f(g)}return(/input|select|textarea|button|object/.test(e)?!g.disabled:"a"==e?g.href||!isNaN(a):!isNaN(a))&&f(g)},tabbable:function(g){var e=b.attr(g,"tabindex");return(isNaN(e)||e>=0)&&b(g).is(":focusable")}});
b(function(){var g=document.body,e=g.appendChild(e=document.createElement("div"));b.extend(e.style,{minHeight:"100px",height:"auto",padding:0,borderWidth:0});b.support.minHeight=e.offsetHeight===100;b.support.selectstart="onselectstart"in e;g.removeChild(e).style.display="none"});b.extend(b.ui,{plugin:{add:function(g,e,a){g=b.ui[g].prototype;for(var d in a){g.plugins[d]=g.plugins[d]||[];g.plugins[d].push([e,a[d]])}},call:function(g,e,a){if((e=g.plugins[e])&&g.element[0].parentNode)for(var d=0;d<e.length;d++)g.options[e[d][0]]&&
e[d][1].apply(g.element,a)}},contains:function(g,e){return document.compareDocumentPosition?g.compareDocumentPosition(e)&16:g!==e&&g.contains(e)},hasScroll:function(g,e){if(b(g).css("overflow")==="hidden")return false;e=e&&e==="left"?"scrollLeft":"scrollTop";var a=false;if(g[e]>0)return true;g[e]=1;a=g[e]>0;g[e]=0;return a},isOverAxis:function(g,e,a){return g>e&&g<e+a},isOver:function(g,e,a,d,h,i){return b.ui.isOverAxis(g,a,h)&&b.ui.isOverAxis(e,d,i)}})}})(jQuery);
(function(b,c){if(b.cleanData){var f=b.cleanData;b.cleanData=function(e){for(var a=0,d;(d=e[a])!=null;a++)b(d).triggerHandler("remove");f(e)}}else{var g=b.fn.remove;b.fn.remove=function(e,a){return this.each(function(){if(!a)if(!e||b.filter(e,[this]).length)b("*",this).add([this]).each(function(){b(this).triggerHandler("remove")});return g.call(b(this),e,a)})}}b.widget=function(e,a,d){var h=e.split(".")[0],i;e=e.split(".")[1];i=h+"-"+e;if(!d){d=a;a=b.Widget}b.expr[":"][i]=function(j){return!!b.data(j,
e)};b[h]=b[h]||{};b[h][e]=function(j,n){arguments.length&&this._createWidget(j,n)};a=new a;a.options=b.extend(true,{},a.options);b[h][e].prototype=b.extend(true,a,{namespace:h,widgetName:e,widgetEventPrefix:b[h][e].prototype.widgetEventPrefix||e,widgetBaseClass:i},d);b.widget.bridge(e,b[h][e])};b.widget.bridge=function(e,a){b.fn[e]=function(d){var h=typeof d==="string",i=Array.prototype.slice.call(arguments,1),j=this;d=!h&&i.length?b.extend.apply(null,[true,d].concat(i)):d;if(h&&d.charAt(0)==="_")return j;
h?this.each(function(){var n=b.data(this,e),q=n&&b.isFunction(n[d])?n[d].apply(n,i):n;if(q!==n&&q!==c){j=q;return false}}):this.each(function(){var n=b.data(this,e);n?n.option(d||{})._init():b.data(this,e,new a(d,this))});return j}};b.Widget=function(e,a){arguments.length&&this._createWidget(e,a)};b.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",options:{disabled:false},_createWidget:function(e,a){b.data(a,this.widgetName,this);this.element=b(a);this.options=b.extend(true,{},this.options,
this._getCreateOptions(),e);var d=this;this.element.bind("remove."+this.widgetName,function(){d.destroy()});this._create();this._trigger("create");this._init()},_getCreateOptions:function(){return b.metadata&&b.metadata.get(this.element[0])[this.widgetName]},_create:function(){},_init:function(){},destroy:function(){this.element.unbind("."+this.widgetName).removeData(this.widgetName);this.widget().unbind("."+this.widgetName).removeAttr("aria-disabled").removeClass(this.widgetBaseClass+"-disabled ui-state-disabled")},
widget:function(){return this.element},option:function(e,a){var d=e;if(arguments.length===0)return b.extend({},this.options);if(typeof e==="string"){if(a===c)return this.options[e];d={};d[e]=a}this._setOptions(d);return this},_setOptions:function(e){var a=this;b.each(e,function(d,h){a._setOption(d,h)});return this},_setOption:function(e,a){this.options[e]=a;if(e==="disabled")this.widget()[a?"addClass":"removeClass"](this.widgetBaseClass+"-disabled ui-state-disabled").attr("aria-disabled",a);return this},
enable:function(){return this._setOption("disabled",false)},disable:function(){return this._setOption("disabled",true)},_trigger:function(e,a,d){var h=this.options[e];a=b.Event(a);a.type=(e===this.widgetEventPrefix?e:this.widgetEventPrefix+e).toLowerCase();d=d||{};if(a.originalEvent){e=b.event.props.length;for(var i;e;){i=b.event.props[--e];a[i]=a.originalEvent[i]}}this.element.trigger(a,d);return!(b.isFunction(h)&&h.call(this.element[0],a,d)===false||a.isDefaultPrevented())}}})(jQuery);
(function(b){b.widget("ui.mouse",{options:{cancel:":input,option",distance:1,delay:0},_mouseInit:function(){var c=this;this.element.bind("mousedown."+this.widgetName,function(f){return c._mouseDown(f)}).bind("click."+this.widgetName,function(f){if(true===b.data(f.target,c.widgetName+".preventClickEvent")){b.removeData(f.target,c.widgetName+".preventClickEvent");f.stopImmediatePropagation();return false}});this.started=false},_mouseDestroy:function(){this.element.unbind("."+this.widgetName)},_mouseDown:function(c){c.originalEvent=
c.originalEvent||{};if(!c.originalEvent.mouseHandled){this._mouseStarted&&this._mouseUp(c);this._mouseDownEvent=c;var f=this,g=c.which==1,e=typeof this.options.cancel=="string"?b(c.target).parents().add(c.target).filter(this.options.cancel).length:false;if(!g||e||!this._mouseCapture(c))return true;this.mouseDelayMet=!this.options.delay;if(!this.mouseDelayMet)this._mouseDelayTimer=setTimeout(function(){f.mouseDelayMet=true},this.options.delay);if(this._mouseDistanceMet(c)&&this._mouseDelayMet(c)){this._mouseStarted=
this._mouseStart(c)!==false;if(!this._mouseStarted){c.preventDefault();return true}}this._mouseMoveDelegate=function(a){return f._mouseMove(a)};this._mouseUpDelegate=function(a){return f._mouseUp(a)};b(document).bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate);c.preventDefault();return c.originalEvent.mouseHandled=true}},_mouseMove:function(c){if(b.browser.msie&&!(document.documentMode>=9)&&!c.button)return this._mouseUp(c);if(this._mouseStarted){this._mouseDrag(c);
return c.preventDefault()}if(this._mouseDistanceMet(c)&&this._mouseDelayMet(c))(this._mouseStarted=this._mouseStart(this._mouseDownEvent,c)!==false)?this._mouseDrag(c):this._mouseUp(c);return!this._mouseStarted},_mouseUp:function(c){b(document).unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate);if(this._mouseStarted){this._mouseStarted=false;c.target==this._mouseDownEvent.target&&b.data(c.target,this.widgetName+".preventClickEvent",
true);this._mouseStop(c)}return false},_mouseDistanceMet:function(c){return Math.max(Math.abs(this._mouseDownEvent.pageX-c.pageX),Math.abs(this._mouseDownEvent.pageY-c.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return true}})})(jQuery);
(function(b){b.widget("ui.draggable",b.ui.mouse,{widgetEventPrefix:"drag",options:{addClasses:true,appendTo:"parent",axis:false,connectToSortable:false,containment:false,cursor:"auto",cursorAt:false,grid:false,handle:false,helper:"original",iframeFix:false,opacity:false,refreshPositions:false,revert:false,revertDuration:500,scope:"default",scroll:true,scrollSensitivity:20,scrollSpeed:20,snap:false,snapMode:"both",snapTolerance:20,stack:false,zIndex:false},_create:function(){if(this.options.helper==
"original"&&!/^(?:r|a|f)/.test(this.element.css("position")))this.element[0].style.position="relative";this.options.addClasses&&this.element.addClass("ui-draggable");this.options.disabled&&this.element.addClass("ui-draggable-disabled");this._mouseInit()},destroy:function(){if(this.element.data("draggable")){this.element.removeData("draggable").unbind(".draggable").removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled");this._mouseDestroy();return this}},_mouseCapture:function(c){var f=
this.options;if(this.helper||f.disabled||b(c.target).is(".ui-resizable-handle"))return false;this.handle=this._getHandle(c);if(!this.handle)return false;return true},_mouseStart:function(c){var f=this.options;this.helper=this._createHelper(c);this._cacheHelperProportions();if(b.ui.ddmanager)b.ui.ddmanager.current=this;this._cacheMargins();this.cssPosition=this.helper.css("position");this.scrollParent=this.helper.scrollParent();this.offset=this.positionAbs=this.element.offset();this.offset={top:this.offset.top-
this.margins.top,left:this.offset.left-this.margins.left};b.extend(this.offset,{click:{left:c.pageX-this.offset.left,top:c.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()});this.originalPosition=this.position=this._generatePosition(c);this.originalPageX=c.pageX;this.originalPageY=c.pageY;f.cursorAt&&this._adjustOffsetFromHelper(f.cursorAt);f.containment&&this._setContainment();if(this._trigger("start",c)===false){this._clear();return false}this._cacheHelperProportions();
b.ui.ddmanager&&!f.dropBehaviour&&b.ui.ddmanager.prepareOffsets(this,c);this.helper.addClass("ui-draggable-dragging");this._mouseDrag(c,true);return true},_mouseDrag:function(c,f){this.position=this._generatePosition(c);this.positionAbs=this._convertPositionTo("absolute");if(!f){f=this._uiHash();if(this._trigger("drag",c,f)===false){this._mouseUp({});return false}this.position=f.position}if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||
this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";b.ui.ddmanager&&b.ui.ddmanager.drag(this,c);return false},_mouseStop:function(c){var f=false;if(b.ui.ddmanager&&!this.options.dropBehaviour)f=b.ui.ddmanager.drop(this,c);if(this.dropped){f=this.dropped;this.dropped=false}if((!this.element[0]||!this.element[0].parentNode)&&this.options.helper=="original")return false;if(this.options.revert=="invalid"&&!f||this.options.revert=="valid"&&f||this.options.revert===true||b.isFunction(this.options.revert)&&
this.options.revert.call(this.element,f)){var g=this;b(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){g._trigger("stop",c)!==false&&g._clear()})}else this._trigger("stop",c)!==false&&this._clear();return false},cancel:function(){this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear();return this},_getHandle:function(c){var f=!this.options.handle||!b(this.options.handle,this.element).length?true:false;b(this.options.handle,this.element).find("*").andSelf().each(function(){if(this==
c.target)f=true});return f},_createHelper:function(c){var f=this.options;c=b.isFunction(f.helper)?b(f.helper.apply(this.element[0],[c])):f.helper=="clone"?this.element.clone():this.element;c.parents("body").length||c.appendTo(f.appendTo=="parent"?this.element[0].parentNode:f.appendTo);c[0]!=this.element[0]&&!/(fixed|absolute)/.test(c.css("position"))&&c.css("position","absolute");return c},_adjustOffsetFromHelper:function(c){if(typeof c=="string")c=c.split(" ");if(b.isArray(c))c={left:+c[0],top:+c[1]||
0};if("left"in c)this.offset.click.left=c.left+this.margins.left;if("right"in c)this.offset.click.left=this.helperProportions.width-c.right+this.margins.left;if("top"in c)this.offset.click.top=c.top+this.margins.top;if("bottom"in c)this.offset.click.top=this.helperProportions.height-c.bottom+this.margins.top},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var c=this.offsetParent.offset();if(this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&b.ui.contains(this.scrollParent[0],
this.offsetParent[0])){c.left+=this.scrollParent.scrollLeft();c.top+=this.scrollParent.scrollTop()}if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&b.browser.msie)c={top:0,left:0};return{top:c.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:c.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var c=this.element.position();return{top:c.top-
(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:c.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}else return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var c=this.options;if(c.containment==
"parent")c.containment=this.helper[0].parentNode;if(c.containment=="document"||c.containment=="window")this.containment=[(c.containment=="document"?0:b(window).scrollLeft())-this.offset.relative.left-this.offset.parent.left,(c.containment=="document"?0:b(window).scrollTop())-this.offset.relative.top-this.offset.parent.top,(c.containment=="document"?0:b(window).scrollLeft())+b(c.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(c.containment=="document"?
0:b(window).scrollTop())+(b(c.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(c.containment)&&c.containment.constructor!=Array){var f=b(c.containment)[0];if(f){c=b(c.containment).offset();var g=b(f).css("overflow")!="hidden";this.containment=[c.left+(parseInt(b(f).css("borderLeftWidth"),10)||0)+(parseInt(b(f).css("paddingLeft"),10)||0)-this.margins.left,c.top+(parseInt(b(f).css("borderTopWidth"),
10)||0)+(parseInt(b(f).css("paddingTop"),10)||0)-this.margins.top,c.left+(g?Math.max(f.scrollWidth,f.offsetWidth):f.offsetWidth)-(parseInt(b(f).css("borderLeftWidth"),10)||0)-(parseInt(b(f).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,c.top+(g?Math.max(f.scrollHeight,f.offsetHeight):f.offsetHeight)-(parseInt(b(f).css("borderTopWidth"),10)||0)-(parseInt(b(f).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]}}else if(c.containment.constructor==
Array)this.containment=c.containment},_convertPositionTo:function(c,f){if(!f)f=this.position;c=c=="absolute"?1:-1;var g=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&b.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(g[0].tagName);return{top:f.top+this.offset.relative.top*c+this.offset.parent.top*c-(b.browser.safari&&b.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():
e?0:g.scrollTop())*c),left:f.left+this.offset.relative.left*c+this.offset.parent.left*c-(b.browser.safari&&b.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:g.scrollLeft())*c)}},_generatePosition:function(c){var f=this.options,g=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&b.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(g[0].tagName),a=c.pageX,d=c.pageY;
if(this.originalPosition){if(this.containment){if(c.pageX-this.offset.click.left<this.containment[0])a=this.containment[0]+this.offset.click.left;if(c.pageY-this.offset.click.top<this.containment[1])d=this.containment[1]+this.offset.click.top;if(c.pageX-this.offset.click.left>this.containment[2])a=this.containment[2]+this.offset.click.left;if(c.pageY-this.offset.click.top>this.containment[3])d=this.containment[3]+this.offset.click.top}if(f.grid){d=this.originalPageY+Math.round((d-this.originalPageY)/
f.grid[1])*f.grid[1];d=this.containment?!(d-this.offset.click.top<this.containment[1]||d-this.offset.click.top>this.containment[3])?d:!(d-this.offset.click.top<this.containment[1])?d-f.grid[1]:d+f.grid[1]:d;a=this.originalPageX+Math.round((a-this.originalPageX)/f.grid[0])*f.grid[0];a=this.containment?!(a-this.offset.click.left<this.containment[0]||a-this.offset.click.left>this.containment[2])?a:!(a-this.offset.click.left<this.containment[0])?a-f.grid[0]:a+f.grid[0]:a}}return{top:d-this.offset.click.top-
this.offset.relative.top-this.offset.parent.top+(b.browser.safari&&b.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:g.scrollTop()),left:a-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(b.browser.safari&&b.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:g.scrollLeft())}},_clear:function(){this.helper.removeClass("ui-draggable-dragging");this.helper[0]!=
this.element[0]&&!this.cancelHelperRemoval&&this.helper.remove();this.helper=null;this.cancelHelperRemoval=false},_trigger:function(c,f,g){g=g||this._uiHash();b.ui.plugin.call(this,c,[f,g]);if(c=="drag")this.positionAbs=this._convertPositionTo("absolute");return b.Widget.prototype._trigger.call(this,c,f,g)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}});b.extend(b.ui.draggable,{version:"1.8.9"});
b.ui.plugin.add("draggable","connectToSortable",{start:function(c,f){var g=b(this).data("draggable"),e=g.options,a=b.extend({},f,{item:g.element});g.sortables=[];b(e.connectToSortable).each(function(){var d=b.data(this,"sortable");if(d&&!d.options.disabled){g.sortables.push({instance:d,shouldRevert:d.options.revert});d._refreshItems();d._trigger("activate",c,a)}})},stop:function(c,f){var g=b(this).data("draggable"),e=b.extend({},f,{item:g.element});b.each(g.sortables,function(){if(this.instance.isOver){this.instance.isOver=
0;g.cancelHelperRemoval=true;this.instance.cancelHelperRemoval=false;if(this.shouldRevert)this.instance.options.revert=true;this.instance._mouseStop(c);this.instance.options.helper=this.instance.options._helper;g.options.helper=="original"&&this.instance.currentItem.css({top:"auto",left:"auto"})}else{this.instance.cancelHelperRemoval=false;this.instance._trigger("deactivate",c,e)}})},drag:function(c,f){var g=b(this).data("draggable"),e=this;b.each(g.sortables,function(){this.instance.positionAbs=
g.positionAbs;this.instance.helperProportions=g.helperProportions;this.instance.offset.click=g.offset.click;if(this.instance._intersectsWith(this.instance.containerCache)){if(!this.instance.isOver){this.instance.isOver=1;this.instance.currentItem=b(e).clone().appendTo(this.instance.element).data("sortable-item",true);this.instance.options._helper=this.instance.options.helper;this.instance.options.helper=function(){return f.helper[0]};c.target=this.instance.currentItem[0];this.instance._mouseCapture(c,
true);this.instance._mouseStart(c,true,true);this.instance.offset.click.top=g.offset.click.top;this.instance.offset.click.left=g.offset.click.left;this.instance.offset.parent.left-=g.offset.parent.left-this.instance.offset.parent.left;this.instance.offset.parent.top-=g.offset.parent.top-this.instance.offset.parent.top;g._trigger("toSortable",c);g.dropped=this.instance.element;g.currentItem=g.element;this.instance.fromOutside=g}this.instance.currentItem&&this.instance._mouseDrag(c)}else if(this.instance.isOver){this.instance.isOver=
0;this.instance.cancelHelperRemoval=true;this.instance.options.revert=false;this.instance._trigger("out",c,this.instance._uiHash(this.instance));this.instance._mouseStop(c,true);this.instance.options.helper=this.instance.options._helper;this.instance.currentItem.remove();this.instance.placeholder&&this.instance.placeholder.remove();g._trigger("fromSortable",c);g.dropped=false}})}});b.ui.plugin.add("draggable","cursor",{start:function(){var c=b("body"),f=b(this).data("draggable").options;if(c.css("cursor"))f._cursor=
c.css("cursor");c.css("cursor",f.cursor)},stop:function(){var c=b(this).data("draggable").options;c._cursor&&b("body").css("cursor",c._cursor)}});b.ui.plugin.add("draggable","iframeFix",{start:function(){var c=b(this).data("draggable").options;b(c.iframeFix===true?"iframe":c.iframeFix).each(function(){b('<div class="ui-draggable-iframeFix" style="background: #fff;"></div>').css({width:this.offsetWidth+"px",height:this.offsetHeight+"px",position:"absolute",opacity:"0.001",zIndex:1E3}).css(b(this).offset()).appendTo("body")})},
stop:function(){b("div.ui-draggable-iframeFix").each(function(){this.parentNode.removeChild(this)})}});b.ui.plugin.add("draggable","opacity",{start:function(c,f){c=b(f.helper);f=b(this).data("draggable").options;if(c.css("opacity"))f._opacity=c.css("opacity");c.css("opacity",f.opacity)},stop:function(c,f){c=b(this).data("draggable").options;c._opacity&&b(f.helper).css("opacity",c._opacity)}});b.ui.plugin.add("draggable","scroll",{start:function(){var c=b(this).data("draggable");if(c.scrollParent[0]!=
document&&c.scrollParent[0].tagName!="HTML")c.overflowOffset=c.scrollParent.offset()},drag:function(c){var f=b(this).data("draggable"),g=f.options,e=false;if(f.scrollParent[0]!=document&&f.scrollParent[0].tagName!="HTML"){if(!g.axis||g.axis!="x")if(f.overflowOffset.top+f.scrollParent[0].offsetHeight-c.pageY<g.scrollSensitivity)f.scrollParent[0].scrollTop=e=f.scrollParent[0].scrollTop+g.scrollSpeed;else if(c.pageY-f.overflowOffset.top<g.scrollSensitivity)f.scrollParent[0].scrollTop=e=f.scrollParent[0].scrollTop-
g.scrollSpeed;if(!g.axis||g.axis!="y")if(f.overflowOffset.left+f.scrollParent[0].offsetWidth-c.pageX<g.scrollSensitivity)f.scrollParent[0].scrollLeft=e=f.scrollParent[0].scrollLeft+g.scrollSpeed;else if(c.pageX-f.overflowOffset.left<g.scrollSensitivity)f.scrollParent[0].scrollLeft=e=f.scrollParent[0].scrollLeft-g.scrollSpeed}else{if(!g.axis||g.axis!="x")if(c.pageY-b(document).scrollTop()<g.scrollSensitivity)e=b(document).scrollTop(b(document).scrollTop()-g.scrollSpeed);else if(b(window).height()-
(c.pageY-b(document).scrollTop())<g.scrollSensitivity)e=b(document).scrollTop(b(document).scrollTop()+g.scrollSpeed);if(!g.axis||g.axis!="y")if(c.pageX-b(document).scrollLeft()<g.scrollSensitivity)e=b(document).scrollLeft(b(document).scrollLeft()-g.scrollSpeed);else if(b(window).width()-(c.pageX-b(document).scrollLeft())<g.scrollSensitivity)e=b(document).scrollLeft(b(document).scrollLeft()+g.scrollSpeed)}e!==false&&b.ui.ddmanager&&!g.dropBehaviour&&b.ui.ddmanager.prepareOffsets(f,c)}});b.ui.plugin.add("draggable",
"snap",{start:function(){var c=b(this).data("draggable"),f=c.options;c.snapElements=[];b(f.snap.constructor!=String?f.snap.items||":data(draggable)":f.snap).each(function(){var g=b(this),e=g.offset();this!=c.element[0]&&c.snapElements.push({item:this,width:g.outerWidth(),height:g.outerHeight(),top:e.top,left:e.left})})},drag:function(c,f){for(var g=b(this).data("draggable"),e=g.options,a=e.snapTolerance,d=f.offset.left,h=d+g.helperProportions.width,i=f.offset.top,j=i+g.helperProportions.height,n=
g.snapElements.length-1;n>=0;n--){var q=g.snapElements[n].left,l=q+g.snapElements[n].width,k=g.snapElements[n].top,m=k+g.snapElements[n].height;if(q-a<d&&d<l+a&&k-a<i&&i<m+a||q-a<d&&d<l+a&&k-a<j&&j<m+a||q-a<h&&h<l+a&&k-a<i&&i<m+a||q-a<h&&h<l+a&&k-a<j&&j<m+a){if(e.snapMode!="inner"){var o=Math.abs(k-j)<=a,p=Math.abs(m-i)<=a,s=Math.abs(q-h)<=a,r=Math.abs(l-d)<=a;if(o)f.position.top=g._convertPositionTo("relative",{top:k-g.helperProportions.height,left:0}).top-g.margins.top;if(p)f.position.top=g._convertPositionTo("relative",
{top:m,left:0}).top-g.margins.top;if(s)f.position.left=g._convertPositionTo("relative",{top:0,left:q-g.helperProportions.width}).left-g.margins.left;if(r)f.position.left=g._convertPositionTo("relative",{top:0,left:l}).left-g.margins.left}var u=o||p||s||r;if(e.snapMode!="outer"){o=Math.abs(k-i)<=a;p=Math.abs(m-j)<=a;s=Math.abs(q-d)<=a;r=Math.abs(l-h)<=a;if(o)f.position.top=g._convertPositionTo("relative",{top:k,left:0}).top-g.margins.top;if(p)f.position.top=g._convertPositionTo("relative",{top:m-g.helperProportions.height,
left:0}).top-g.margins.top;if(s)f.position.left=g._convertPositionTo("relative",{top:0,left:q}).left-g.margins.left;if(r)f.position.left=g._convertPositionTo("relative",{top:0,left:l-g.helperProportions.width}).left-g.margins.left}if(!g.snapElements[n].snapping&&(o||p||s||r||u))g.options.snap.snap&&g.options.snap.snap.call(g.element,c,b.extend(g._uiHash(),{snapItem:g.snapElements[n].item}));g.snapElements[n].snapping=o||p||s||r||u}else{g.snapElements[n].snapping&&g.options.snap.release&&g.options.snap.release.call(g.element,
c,b.extend(g._uiHash(),{snapItem:g.snapElements[n].item}));g.snapElements[n].snapping=false}}}});b.ui.plugin.add("draggable","stack",{start:function(){var c=b(this).data("draggable").options;c=b.makeArray(b(c.stack)).sort(function(g,e){return(parseInt(b(g).css("zIndex"),10)||0)-(parseInt(b(e).css("zIndex"),10)||0)});if(c.length){var f=parseInt(c[0].style.zIndex)||0;b(c).each(function(g){this.style.zIndex=f+g});this[0].style.zIndex=f+c.length}}});b.ui.plugin.add("draggable","zIndex",{start:function(c,
f){c=b(f.helper);f=b(this).data("draggable").options;if(c.css("zIndex"))f._zIndex=c.css("zIndex");c.css("zIndex",f.zIndex)},stop:function(c,f){c=b(this).data("draggable").options;c._zIndex&&b(f.helper).css("zIndex",c._zIndex)}})})(jQuery);
(function(b){b.widget("ui.droppable",{widgetEventPrefix:"drop",options:{accept:"*",activeClass:false,addClasses:true,greedy:false,hoverClass:false,scope:"default",tolerance:"intersect"},_create:function(){var c=this.options,f=c.accept;this.isover=0;this.isout=1;this.accept=b.isFunction(f)?f:function(g){return g.is(f)};this.proportions={width:this.element[0].offsetWidth,height:this.element[0].offsetHeight};b.ui.ddmanager.droppables[c.scope]=b.ui.ddmanager.droppables[c.scope]||[];b.ui.ddmanager.droppables[c.scope].push(this);
c.addClasses&&this.element.addClass("ui-droppable")},destroy:function(){for(var c=b.ui.ddmanager.droppables[this.options.scope],f=0;f<c.length;f++)c[f]==this&&c.splice(f,1);this.element.removeClass("ui-droppable ui-droppable-disabled").removeData("droppable").unbind(".droppable");return this},_setOption:function(c,f){if(c=="accept")this.accept=b.isFunction(f)?f:function(g){return g.is(f)};b.Widget.prototype._setOption.apply(this,arguments)},_activate:function(c){var f=b.ui.ddmanager.current;this.options.activeClass&&
this.element.addClass(this.options.activeClass);f&&this._trigger("activate",c,this.ui(f))},_deactivate:function(c){var f=b.ui.ddmanager.current;this.options.activeClass&&this.element.removeClass(this.options.activeClass);f&&this._trigger("deactivate",c,this.ui(f))},_over:function(c){var f=b.ui.ddmanager.current;if(!(!f||(f.currentItem||f.element)[0]==this.element[0]))if(this.accept.call(this.element[0],f.currentItem||f.element)){this.options.hoverClass&&this.element.addClass(this.options.hoverClass);
this._trigger("over",c,this.ui(f))}},_out:function(c){var f=b.ui.ddmanager.current;if(!(!f||(f.currentItem||f.element)[0]==this.element[0]))if(this.accept.call(this.element[0],f.currentItem||f.element)){this.options.hoverClass&&this.element.removeClass(this.options.hoverClass);this._trigger("out",c,this.ui(f))}},_drop:function(c,f){var g=f||b.ui.ddmanager.current;if(!g||(g.currentItem||g.element)[0]==this.element[0])return false;var e=false;this.element.find(":data(droppable)").not(".ui-draggable-dragging").each(function(){var a=
b.data(this,"droppable");if(a.options.greedy&&!a.options.disabled&&a.options.scope==g.options.scope&&a.accept.call(a.element[0],g.currentItem||g.element)&&b.ui.intersect(g,b.extend(a,{offset:a.element.offset()}),a.options.tolerance)){e=true;return false}});if(e)return false;if(this.accept.call(this.element[0],g.currentItem||g.element)){this.options.activeClass&&this.element.removeClass(this.options.activeClass);this.options.hoverClass&&this.element.removeClass(this.options.hoverClass);this._trigger("drop",
c,this.ui(g));return this.element}return false},ui:function(c){return{draggable:c.currentItem||c.element,helper:c.helper,position:c.position,offset:c.positionAbs}}});b.extend(b.ui.droppable,{version:"1.8.9"});b.ui.intersect=function(c,f,g){if(!f.offset)return false;var e=(c.positionAbs||c.position.absolute).left,a=e+c.helperProportions.width,d=(c.positionAbs||c.position.absolute).top,h=d+c.helperProportions.height,i=f.offset.left,j=i+f.proportions.width,n=f.offset.top,q=n+f.proportions.height;
switch(g){case "fit":return i<=e&&a<=j&&n<=d&&h<=q;case "intersect":return i<e+c.helperProportions.width/2&&a-c.helperProportions.width/2<j&&n<d+c.helperProportions.height/2&&h-c.helperProportions.height/2<q;case "pointer":return b.ui.isOver((c.positionAbs||c.position.absolute).top+(c.clickOffset||c.offset.click).top,(c.positionAbs||c.position.absolute).left+(c.clickOffset||c.offset.click).left,n,i,f.proportions.height,f.proportions.width);case "touch":return(d>=n&&d<=q||h>=n&&h<=q||d<n&&h>q)&&(e>=
i&&e<=j||a>=i&&a<=j||e<i&&a>j);default:return false}};b.ui.ddmanager={current:null,droppables:{"default":[]},prepareOffsets:function(c,f){var g=b.ui.ddmanager.droppables[c.options.scope]||[],e=f?f.type:null,a=(c.currentItem||c.element).find(":data(droppable)").andSelf(),d=0;a:for(;d<g.length;d++)if(!(g[d].options.disabled||c&&!g[d].accept.call(g[d].element[0],c.currentItem||c.element))){for(var h=0;h<a.length;h++)if(a[h]==g[d].element[0]){g[d].proportions.height=0;continue a}g[d].visible=g[d].element.css("display")!=
"none";if(g[d].visible){g[d].offset=g[d].element.offset();g[d].proportions={width:g[d].element[0].offsetWidth,height:g[d].element[0].offsetHeight};e=="mousedown"&&g[d]._activate.call(g[d],f)}}},drop:function(c,f){var g=false;b.each(b.ui.ddmanager.droppables[c.options.scope]||[],function(){if(this.options){if(!this.options.disabled&&this.visible&&b.ui.intersect(c,this,this.options.tolerance))g=g||this._drop.call(this,f);if(!this.options.disabled&&this.visible&&this.accept.call(this.element[0],c.currentItem||
c.element)){this.isout=1;this.isover=0;this._deactivate.call(this,f)}}});return g},drag:function(c,f){c.options.refreshPositions&&b.ui.ddmanager.prepareOffsets(c,f);b.each(b.ui.ddmanager.droppables[c.options.scope]||[],function(){if(!(this.options.disabled||this.greedyChild||!this.visible)){var g=b.ui.intersect(c,this,this.options.tolerance);if(g=!g&&this.isover==1?"isout":g&&this.isover==0?"isover":null){var e;if(this.options.greedy){var a=this.element.parents(":data(droppable):eq(0)");if(a.length){e=
b.data(a[0],"droppable");e.greedyChild=g=="isover"?1:0}}if(e&&g=="isover"){e.isover=0;e.isout=1;e._out.call(e,f)}this[g]=1;this[g=="isout"?"isover":"isout"]=0;this[g=="isover"?"_over":"_out"].call(this,f);if(e&&g=="isout"){e.isout=0;e.isover=1;e._over.call(e,f)}}}})}}})(jQuery);
(function(b){b.widget("ui.resizable",b.ui.mouse,{widgetEventPrefix:"resize",options:{alsoResize:false,animate:false,animateDuration:"slow",animateEasing:"swing",aspectRatio:false,autoHide:false,containment:false,ghost:false,grid:false,handles:"e,s,se",helper:false,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:1E3},_create:function(){var g=this,e=this.options;this.element.addClass("ui-resizable");b.extend(this,{_aspectRatio:!!e.aspectRatio,aspectRatio:e.aspectRatio,originalElement:this.element,
_proportionallyResizeElements:[],_helper:e.helper||e.ghost||e.animate?e.helper||"ui-resizable-helper":null});if(this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i)){/relative/.test(this.element.css("position"))&&b.browser.opera&&this.element.css({position:"relative",top:"auto",left:"auto"});this.element.wrap(b('<div class="ui-wrapper" style="overflow: hidden;"></div>').css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),
top:this.element.css("top"),left:this.element.css("left")}));this.element=this.element.parent().data("resizable",this.element.data("resizable"));this.elementIsWrapper=true;this.element.css({marginLeft:this.originalElement.css("marginLeft"),marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom")});this.originalElement.css({marginLeft:0,marginTop:0,marginRight:0,marginBottom:0});this.originalResizeStyle=
this.originalElement.css("resize");this.originalElement.css("resize","none");this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"}));this.originalElement.css({margin:this.originalElement.css("margin")});this._proportionallyResize()}this.handles=e.handles||(!b(".ui-resizable-handle",this.element).length?"e,s,se":{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",
nw:".ui-resizable-nw"});if(this.handles.constructor==String){if(this.handles=="all")this.handles="n,e,s,w,se,sw,ne,nw";var a=this.handles.split(",");this.handles={};for(var d=0;d<a.length;d++){var h=b.trim(a[d]),i=b('<div class="ui-resizable-handle '+("ui-resizable-"+h)+'"></div>');/sw|se|ne|nw/.test(h)&&i.css({zIndex:++e.zIndex});"se"==h&&i.addClass("ui-icon ui-icon-gripsmall-diagonal-se");this.handles[h]=".ui-resizable-"+h;this.element.append(i)}}this._renderAxis=function(j){j=j||this.element;for(var n in this.handles){if(this.handles[n].constructor==
String)this.handles[n]=b(this.handles[n],this.element).show();if(this.elementIsWrapper&&this.originalElement[0].nodeName.match(/textarea|input|select|button/i)){var q=b(this.handles[n],this.element),l=0;l=/sw|ne|nw|se|n|s/.test(n)?q.outerHeight():q.outerWidth();q=["padding",/ne|nw|n/.test(n)?"Top":/se|sw|s/.test(n)?"Bottom":/^e$/.test(n)?"Right":"Left"].join("");j.css(q,l);this._proportionallyResize()}b(this.handles[n])}};this._renderAxis(this.element);this._handles=b(".ui-resizable-handle",this.element).disableSelection();
this._handles.mouseover(function(){if(!g.resizing){if(this.className)var j=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i);g.axis=j&&j[1]?j[1]:"se"}});if(e.autoHide){this._handles.hide();b(this.element).addClass("ui-resizable-autohide").hover(function(){b(this).removeClass("ui-resizable-autohide");g._handles.show()},function(){if(!g.resizing){b(this).addClass("ui-resizable-autohide");g._handles.hide()}})}this._mouseInit()},destroy:function(){this._mouseDestroy();var g=function(a){b(a).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").unbind(".resizable").find(".ui-resizable-handle").remove()};
if(this.elementIsWrapper){g(this.element);var e=this.element;e.after(this.originalElement.css({position:e.css("position"),width:e.outerWidth(),height:e.outerHeight(),top:e.css("top"),left:e.css("left")})).remove()}this.originalElement.css("resize",this.originalResizeStyle);g(this.originalElement);return this},_mouseCapture:function(g){var e=false;for(var a in this.handles)if(b(this.handles[a])[0]==g.target)e=true;return!this.options.disabled&&e},_mouseStart:function(g){var e=this.options,a=this.element.position(),
d=this.element;this.resizing=true;this.documentScroll={top:b(document).scrollTop(),left:b(document).scrollLeft()};if(d.is(".ui-draggable")||/absolute/.test(d.css("position")))d.css({position:"absolute",top:a.top,left:a.left});b.browser.opera&&/relative/.test(d.css("position"))&&d.css({position:"relative",top:"auto",left:"auto"});this._renderProxy();a=c(this.helper.css("left"));var h=c(this.helper.css("top"));if(e.containment){a+=b(e.containment).scrollLeft()||0;h+=b(e.containment).scrollTop()||0}this.offset=
this.helper.offset();this.position={left:a,top:h};this.size=this._helper?{width:d.outerWidth(),height:d.outerHeight()}:{width:d.width(),height:d.height()};this.originalSize=this._helper?{width:d.outerWidth(),height:d.outerHeight()}:{width:d.width(),height:d.height()};this.originalPosition={left:a,top:h};this.sizeDiff={width:d.outerWidth()-d.width(),height:d.outerHeight()-d.height()};this.originalMousePosition={left:g.pageX,top:g.pageY};this.aspectRatio=typeof e.aspectRatio=="number"?e.aspectRatio:
this.originalSize.width/this.originalSize.height||1;e=b(".ui-resizable-"+this.axis).css("cursor");b("body").css("cursor",e=="auto"?this.axis+"-resize":e);d.addClass("ui-resizable-resizing");this._propagate("start",g);return true},_mouseDrag:function(g){var e=this.helper,a=this.originalMousePosition,d=this._change[this.axis];if(!d)return false;a=d.apply(this,[g,g.pageX-a.left||0,g.pageY-a.top||0]);if(this._aspectRatio||g.shiftKey)a=this._updateRatio(a,g);a=this._respectSize(a,g);this._propagate("resize",
g);e.css({top:this.position.top+"px",left:this.position.left+"px",width:this.size.width+"px",height:this.size.height+"px"});!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize();this._updateCache(a);this._trigger("resize",g,this.ui());return false},_mouseStop:function(g){this.resizing=false;var e=this.options,a=this;if(this._helper){var d=this._proportionallyResizeElements,h=d.length&&/textarea/i.test(d[0].nodeName);d=h&&b.ui.hasScroll(d[0],"left")?0:a.sizeDiff.height;
h={width:a.size.width-(h?0:a.sizeDiff.width),height:a.size.height-d};d=parseInt(a.element.css("left"),10)+(a.position.left-a.originalPosition.left)||null;var i=parseInt(a.element.css("top"),10)+(a.position.top-a.originalPosition.top)||null;e.animate||this.element.css(b.extend(h,{top:i,left:d}));a.helper.height(a.size.height);a.helper.width(a.size.width);this._helper&&!e.animate&&this._proportionallyResize()}b("body").css("cursor","auto");this.element.removeClass("ui-resizable-resizing");this._propagate("stop",
g);this._helper&&this.helper.remove();return false},_updateCache:function(g){this.offset=this.helper.offset();if(f(g.left))this.position.left=g.left;if(f(g.top))this.position.top=g.top;if(f(g.height))this.size.height=g.height;if(f(g.width))this.size.width=g.width},_updateRatio:function(g){var e=this.position,a=this.size,d=this.axis;if(g.height)g.width=a.height*this.aspectRatio;else if(g.width)g.height=a.width/this.aspectRatio;if(d=="sw"){g.left=e.left+(a.width-g.width);g.top=null}if(d=="nw"){g.top=
e.top+(a.height-g.height);g.left=e.left+(a.width-g.width)}return g},_respectSize:function(g){var e=this.options,a=this.axis,d=f(g.width)&&e.maxWidth&&e.maxWidth<g.width,h=f(g.height)&&e.maxHeight&&e.maxHeight<g.height,i=f(g.width)&&e.minWidth&&e.minWidth>g.width,j=f(g.height)&&e.minHeight&&e.minHeight>g.height;if(i)g.width=e.minWidth;if(j)g.height=e.minHeight;if(d)g.width=e.maxWidth;if(h)g.height=e.maxHeight;var n=this.originalPosition.left+this.originalSize.width,q=this.position.top+this.size.height,
l=/sw|nw|w/.test(a);a=/nw|ne|n/.test(a);if(i&&l)g.left=n-e.minWidth;if(d&&l)g.left=n-e.maxWidth;if(j&&a)g.top=q-e.minHeight;if(h&&a)g.top=q-e.maxHeight;if((e=!g.width&&!g.height)&&!g.left&&g.top)g.top=null;else if(e&&!g.top&&g.left)g.left=null;return g},_proportionallyResize:function(){if(this._proportionallyResizeElements.length)for(var g=this.helper||this.element,e=0;e<this._proportionallyResizeElements.length;e++){var a=this._proportionallyResizeElements[e];if(!this.borderDif){var d=[a.css("borderTopWidth"),
a.css("borderRightWidth"),a.css("borderBottomWidth"),a.css("borderLeftWidth")],h=[a.css("paddingTop"),a.css("paddingRight"),a.css("paddingBottom"),a.css("paddingLeft")];this.borderDif=b.map(d,function(i,j){i=parseInt(i,10)||0;j=parseInt(h[j],10)||0;return i+j})}b.browser.msie&&(b(g).is(":hidden")||b(g).parents(":hidden").length)||a.css({height:g.height()-this.borderDif[0]-this.borderDif[2]||0,width:g.width()-this.borderDif[1]-this.borderDif[3]||0})}},_renderProxy:function(){var g=this.options;this.elementOffset=
this.element.offset();if(this._helper){this.helper=this.helper||b('<div style="overflow:hidden;"></div>');var e=b.browser.msie&&b.browser.version<7,a=e?1:0;e=e?2:-1;this.helper.addClass(this._helper).css({width:this.element.outerWidth()+e,height:this.element.outerHeight()+e,position:"absolute",left:this.elementOffset.left-a+"px",top:this.elementOffset.top-a+"px",zIndex:++g.zIndex});this.helper.appendTo("body").disableSelection()}else this.helper=this.element},_change:{e:function(g,e){return{width:this.originalSize.width+
e}},w:function(g,e){return{left:this.originalPosition.left+e,width:this.originalSize.width-e}},n:function(g,e,a){return{top:this.originalPosition.top+a,height:this.originalSize.height-a}},s:function(g,e,a){return{height:this.originalSize.height+a}},se:function(g,e,a){return b.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[g,e,a]))},sw:function(g,e,a){return b.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[g,e,a]))},ne:function(g,e,a){return b.extend(this._change.n.apply(this,
arguments),this._change.e.apply(this,[g,e,a]))},nw:function(g,e,a){return b.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[g,e,a]))}},_propagate:function(g,e){b.ui.plugin.call(this,g,[e,this.ui()]);g!="resize"&&this._trigger(g,e,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}});b.extend(b.ui.resizable,
{version:"1.8.9"});b.ui.plugin.add("resizable","alsoResize",{start:function(){var g=b(this).data("resizable").options,e=function(a){b(a).each(function(){var d=b(this);d.data("resizable-alsoresize",{width:parseInt(d.width(),10),height:parseInt(d.height(),10),left:parseInt(d.css("left"),10),top:parseInt(d.css("top"),10),position:d.css("position")})})};if(typeof g.alsoResize=="object"&&!g.alsoResize.parentNode)if(g.alsoResize.length){g.alsoResize=g.alsoResize[0];e(g.alsoResize)}else b.each(g.alsoResize,
function(a){e(a)});else e(g.alsoResize)},resize:function(g,e){var a=b(this).data("resizable");g=a.options;var d=a.originalSize,h=a.originalPosition,i={height:a.size.height-d.height||0,width:a.size.width-d.width||0,top:a.position.top-h.top||0,left:a.position.left-h.left||0},j=function(n,q){b(n).each(function(){var l=b(this),k=b(this).data("resizable-alsoresize"),m={},o=q&&q.length?q:l.parents(e.originalElement[0]).length?["width","height"]:["width","height","top","left"];b.each(o,function(p,s){if((p=
(k[s]||0)+(i[s]||0))&&p>=0)m[s]=p||null});if(b.browser.opera&&/relative/.test(l.css("position"))){a._revertToRelativePosition=true;l.css({position:"absolute",top:"auto",left:"auto"})}l.css(m)})};typeof g.alsoResize=="object"&&!g.alsoResize.nodeType?b.each(g.alsoResize,function(n,q){j(n,q)}):j(g.alsoResize)},stop:function(){var g=b(this).data("resizable"),e=g.options,a=function(d){b(d).each(function(){var h=b(this);h.css({position:h.data("resizable-alsoresize").position})})};if(g._revertToRelativePosition){g._revertToRelativePosition=
false;typeof e.alsoResize=="object"&&!e.alsoResize.nodeType?b.each(e.alsoResize,function(d){a(d)}):a(e.alsoResize)}b(this).removeData("resizable-alsoresize")}});b.ui.plugin.add("resizable","animate",{stop:function(g){var e=b(this).data("resizable"),a=e.options,d=e._proportionallyResizeElements,h=d.length&&/textarea/i.test(d[0].nodeName),i=h&&b.ui.hasScroll(d[0],"left")?0:e.sizeDiff.height;h={width:e.size.width-(h?0:e.sizeDiff.width),height:e.size.height-i};i=parseInt(e.element.css("left"),10)+(e.position.left-
e.originalPosition.left)||null;var j=parseInt(e.element.css("top"),10)+(e.position.top-e.originalPosition.top)||null;e.element.animate(b.extend(h,j&&i?{top:j,left:i}:{}),{duration:a.animateDuration,easing:a.animateEasing,step:function(){var n={width:parseInt(e.element.css("width"),10),height:parseInt(e.element.css("height"),10),top:parseInt(e.element.css("top"),10),left:parseInt(e.element.css("left"),10)};d&&d.length&&b(d[0]).css({width:n.width,height:n.height});e._updateCache(n);e._propagate("resize",
g)}})}});b.ui.plugin.add("resizable","containment",{start:function(){var g=b(this).data("resizable"),e=g.element,a=g.options.containment;if(e=a instanceof b?a.get(0):/parent/.test(a)?e.parent().get(0):a){g.containerElement=b(e);if(/document/.test(a)||a==document){g.containerOffset={left:0,top:0};g.containerPosition={left:0,top:0};g.parentData={element:b(document),left:0,top:0,width:b(document).width(),height:b(document).height()||document.body.parentNode.scrollHeight}}else{var d=b(e),h=[];b(["Top",
"Right","Left","Bottom"]).each(function(n,q){h[n]=c(d.css("padding"+q))});g.containerOffset=d.offset();g.containerPosition=d.position();g.containerSize={height:d.innerHeight()-h[3],width:d.innerWidth()-h[1]};a=g.containerOffset;var i=g.containerSize.height,j=g.containerSize.width;j=b.ui.hasScroll(e,"left")?e.scrollWidth:j;i=b.ui.hasScroll(e)?e.scrollHeight:i;g.parentData={element:e,left:a.left,top:a.top,width:j,height:i}}}},resize:function(g){var e=b(this).data("resizable"),a=e.options,d=e.containerOffset,
h=e.position;g=e._aspectRatio||g.shiftKey;var i={top:0,left:0},j=e.containerElement;if(j[0]!=document&&/static/.test(j.css("position")))i=d;if(h.left<(e._helper?d.left:0)){e.size.width+=e._helper?e.position.left-d.left:e.position.left-i.left;if(g)e.size.height=e.size.width/a.aspectRatio;e.position.left=a.helper?d.left:0}if(h.top<(e._helper?d.top:0)){e.size.height+=e._helper?e.position.top-d.top:e.position.top;if(g)e.size.width=e.size.height*a.aspectRatio;e.position.top=e._helper?d.top:0}e.offset.left=
e.parentData.left+e.position.left;e.offset.top=e.parentData.top+e.position.top;a=Math.abs((e._helper?e.offset.left-i.left:e.offset.left-i.left)+e.sizeDiff.width);d=Math.abs((e._helper?e.offset.top-i.top:e.offset.top-d.top)+e.sizeDiff.height);h=e.containerElement.get(0)==e.element.parent().get(0);i=/relative|absolute/.test(e.containerElement.css("position"));if(h&&i)a-=e.parentData.left;if(a+e.size.width>=e.parentData.width){e.size.width=e.parentData.width-a;if(g)e.size.height=e.size.width/e.aspectRatio}if(d+
e.size.height>=e.parentData.height){e.size.height=e.parentData.height-d;if(g)e.size.width=e.size.height*e.aspectRatio}},stop:function(){var g=b(this).data("resizable"),e=g.options,a=g.containerOffset,d=g.containerPosition,h=g.containerElement,i=b(g.helper),j=i.offset(),n=i.outerWidth()-g.sizeDiff.width;i=i.outerHeight()-g.sizeDiff.height;g._helper&&!e.animate&&/relative/.test(h.css("position"))&&b(this).css({left:j.left-d.left-a.left,width:n,height:i});g._helper&&!e.animate&&/static/.test(h.css("position"))&&
b(this).css({left:j.left-d.left-a.left,width:n,height:i})}});b.ui.plugin.add("resizable","ghost",{start:function(){var g=b(this).data("resizable"),e=g.options,a=g.size;g.ghost=g.originalElement.clone();g.ghost.css({opacity:0.25,display:"block",position:"relative",height:a.height,width:a.width,margin:0,left:0,top:0}).addClass("ui-resizable-ghost").addClass(typeof e.ghost=="string"?e.ghost:"");g.ghost.appendTo(g.helper)},resize:function(){var g=b(this).data("resizable");g.ghost&&g.ghost.css({position:"relative",
height:g.size.height,width:g.size.width})},stop:function(){var g=b(this).data("resizable");g.ghost&&g.helper&&g.helper.get(0).removeChild(g.ghost.get(0))}});b.ui.plugin.add("resizable","grid",{resize:function(){var g=b(this).data("resizable"),e=g.options,a=g.size,d=g.originalSize,h=g.originalPosition,i=g.axis;e.grid=typeof e.grid=="number"?[e.grid,e.grid]:e.grid;var j=Math.round((a.width-d.width)/(e.grid[0]||1))*(e.grid[0]||1);e=Math.round((a.height-d.height)/(e.grid[1]||1))*(e.grid[1]||1);if(/^(se|s|e)$/.test(i)){g.size.width=
d.width+j;g.size.height=d.height+e}else if(/^(ne)$/.test(i)){g.size.width=d.width+j;g.size.height=d.height+e;g.position.top=h.top-e}else{if(/^(sw)$/.test(i)){g.size.width=d.width+j;g.size.height=d.height+e}else{g.size.width=d.width+j;g.size.height=d.height+e;g.position.top=h.top-e}g.position.left=h.left-j}}});var c=function(g){return parseInt(g,10)||0},f=function(g){return!isNaN(parseInt(g,10))}})(jQuery);
(function(b){b.widget("ui.selectable",b.ui.mouse,{options:{appendTo:"body",autoRefresh:true,distance:0,filter:"*",tolerance:"touch"},_create:function(){var c=this;this.element.addClass("ui-selectable");this.dragged=false;var f;this.refresh=function(){f=b(c.options.filter,c.element[0]);f.each(function(){var g=b(this),e=g.offset();b.data(this,"selectable-item",{element:this,$element:g,left:e.left,top:e.top,right:e.left+g.outerWidth(),bottom:e.top+g.outerHeight(),startselected:false,selected:g.hasClass("ui-selected"),
selecting:g.hasClass("ui-selecting"),unselecting:g.hasClass("ui-unselecting")})})};this.refresh();this.selectees=f.addClass("ui-selectee");this._mouseInit();this.helper=b("<div class='ui-selectable-helper'></div>")},destroy:function(){this.selectees.removeClass("ui-selectee").removeData("selectable-item");this.element.removeClass("ui-selectable ui-selectable-disabled").removeData("selectable").unbind(".selectable");this._mouseDestroy();return this},_mouseStart:function(c){var f=this;this.opos=[c.pageX,
c.pageY];if(!this.options.disabled){var g=this.options;this.selectees=b(g.filter,this.element[0]);this._trigger("start",c);b(g.appendTo).append(this.helper);this.helper.css({left:c.clientX,top:c.clientY,width:0,height:0});g.autoRefresh&&this.refresh();this.selectees.filter(".ui-selected").each(function(){var e=b.data(this,"selectable-item");e.startselected=true;if(!c.metaKey){e.$element.removeClass("ui-selected");e.selected=false;e.$element.addClass("ui-unselecting");e.unselecting=true;f._trigger("unselecting",
c,{unselecting:e.element})}});b(c.target).parents().andSelf().each(function(){var e=b.data(this,"selectable-item");if(e){var a=!c.metaKey||!e.$element.hasClass("ui-selected");e.$element.removeClass(a?"ui-unselecting":"ui-selected").addClass(a?"ui-selecting":"ui-unselecting");e.unselecting=!a;e.selecting=a;(e.selected=a)?f._trigger("selecting",c,{selecting:e.element}):f._trigger("unselecting",c,{unselecting:e.element});return false}})}},_mouseDrag:function(c){var f=this;this.dragged=true;if(!this.options.disabled){var g=
this.options,e=this.opos[0],a=this.opos[1],d=c.pageX,h=c.pageY;if(e>d){var i=d;d=e;e=i}if(a>h){i=h;h=a;a=i}this.helper.css({left:e,top:a,width:d-e,height:h-a});this.selectees.each(function(){var j=b.data(this,"selectable-item");if(!(!j||j.element==f.element[0])){var n=false;if(g.tolerance=="touch")n=!(j.left>d||j.right<e||j.top>h||j.bottom<a);else if(g.tolerance=="fit")n=j.left>e&&j.right<d&&j.top>a&&j.bottom<h;if(n){if(j.selected){j.$element.removeClass("ui-selected");j.selected=false}if(j.unselecting){j.$element.removeClass("ui-unselecting");
j.unselecting=false}if(!j.selecting){j.$element.addClass("ui-selecting");j.selecting=true;f._trigger("selecting",c,{selecting:j.element})}}else{if(j.selecting)if(c.metaKey&&j.startselected){j.$element.removeClass("ui-selecting");j.selecting=false;j.$element.addClass("ui-selected");j.selected=true}else{j.$element.removeClass("ui-selecting");j.selecting=false;if(j.startselected){j.$element.addClass("ui-unselecting");j.unselecting=true}f._trigger("unselecting",c,{unselecting:j.element})}if(j.selected)if(!c.metaKey&&
!j.startselected){j.$element.removeClass("ui-selected");j.selected=false;j.$element.addClass("ui-unselecting");j.unselecting=true;f._trigger("unselecting",c,{unselecting:j.element})}}}});return false}},_mouseStop:function(c){var f=this;this.dragged=false;b(".ui-unselecting",this.element[0]).each(function(){var g=b.data(this,"selectable-item");g.$element.removeClass("ui-unselecting");g.unselecting=false;g.startselected=false;f._trigger("unselected",c,{unselected:g.element})});b(".ui-selecting",this.element[0]).each(function(){var g=
b.data(this,"selectable-item");g.$element.removeClass("ui-selecting").addClass("ui-selected");g.selecting=false;g.selected=true;g.startselected=true;f._trigger("selected",c,{selected:g.element})});this._trigger("stop",c);this.helper.remove();return false}});b.extend(b.ui.selectable,{version:"1.8.9"})})(jQuery);
(function(b){b.widget("ui.sortable",b.ui.mouse,{widgetEventPrefix:"sort",options:{appendTo:"parent",axis:false,connectWith:false,containment:false,cursor:"auto",cursorAt:false,dropOnEmpty:true,forcePlaceholderSize:false,forceHelperSize:false,grid:false,handle:false,helper:"original",items:"> *",opacity:false,placeholder:false,revert:false,scroll:true,scrollSensitivity:20,scrollSpeed:20,scope:"default",tolerance:"intersect",zIndex:1E3},_create:function(){this.containerCache={};this.element.addClass("ui-sortable");
this.refresh();this.floating=this.items.length?/left|right/.test(this.items[0].item.css("float")):false;this.offset=this.element.offset();this._mouseInit()},destroy:function(){this.element.removeClass("ui-sortable ui-sortable-disabled").removeData("sortable").unbind(".sortable");this._mouseDestroy();for(var c=this.items.length-1;c>=0;c--)this.items[c].item.removeData("sortable-item");return this},_setOption:function(c,f){if(c==="disabled"){this.options[c]=f;this.widget()[f?"addClass":"removeClass"]("ui-sortable-disabled")}else b.Widget.prototype._setOption.apply(this,
arguments)},_mouseCapture:function(c,f){if(this.reverting)return false;if(this.options.disabled||this.options.type=="static")return false;this._refreshItems(c);var g=null,e=this;b(c.target).parents().each(function(){if(b.data(this,"sortable-item")==e){g=b(this);return false}});if(b.data(c.target,"sortable-item")==e)g=b(c.target);if(!g)return false;if(this.options.handle&&!f){var a=false;b(this.options.handle,g).find("*").andSelf().each(function(){if(this==c.target)a=true});if(!a)return false}this.currentItem=
g;this._removeCurrentsFromItems();return true},_mouseStart:function(c,f,g){f=this.options;var e=this;this.currentContainer=this;this.refreshPositions();this.helper=this._createHelper(c);this._cacheHelperProportions();this._cacheMargins();this.scrollParent=this.helper.scrollParent();this.offset=this.currentItem.offset();this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left};this.helper.css("position","absolute");this.cssPosition=this.helper.css("position");b.extend(this.offset,
{click:{left:c.pageX-this.offset.left,top:c.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()});this.originalPosition=this._generatePosition(c);this.originalPageX=c.pageX;this.originalPageY=c.pageY;f.cursorAt&&this._adjustOffsetFromHelper(f.cursorAt);this.domPosition={prev:this.currentItem.prev()[0],parent:this.currentItem.parent()[0]};this.helper[0]!=this.currentItem[0]&&this.currentItem.hide();this._createPlaceholder();f.containment&&this._setContainment();
if(f.cursor){if(b("body").css("cursor"))this._storedCursor=b("body").css("cursor");b("body").css("cursor",f.cursor)}if(f.opacity){if(this.helper.css("opacity"))this._storedOpacity=this.helper.css("opacity");this.helper.css("opacity",f.opacity)}if(f.zIndex){if(this.helper.css("zIndex"))this._storedZIndex=this.helper.css("zIndex");this.helper.css("zIndex",f.zIndex)}if(this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML")this.overflowOffset=this.scrollParent.offset();this._trigger("start",
c,this._uiHash());this._preserveHelperProportions||this._cacheHelperProportions();if(!g)for(g=this.containers.length-1;g>=0;g--)this.containers[g]._trigger("activate",c,e._uiHash(this));if(b.ui.ddmanager)b.ui.ddmanager.current=this;b.ui.ddmanager&&!f.dropBehaviour&&b.ui.ddmanager.prepareOffsets(this,c);this.dragging=true;this.helper.addClass("ui-sortable-helper");this._mouseDrag(c);return true},_mouseDrag:function(c){this.position=this._generatePosition(c);this.positionAbs=this._convertPositionTo("absolute");
if(!this.lastPositionAbs)this.lastPositionAbs=this.positionAbs;if(this.options.scroll){var f=this.options,g=false;if(this.scrollParent[0]!=document&&this.scrollParent[0].tagName!="HTML"){if(this.overflowOffset.top+this.scrollParent[0].offsetHeight-c.pageY<f.scrollSensitivity)this.scrollParent[0].scrollTop=g=this.scrollParent[0].scrollTop+f.scrollSpeed;else if(c.pageY-this.overflowOffset.top<f.scrollSensitivity)this.scrollParent[0].scrollTop=g=this.scrollParent[0].scrollTop-f.scrollSpeed;if(this.overflowOffset.left+
this.scrollParent[0].offsetWidth-c.pageX<f.scrollSensitivity)this.scrollParent[0].scrollLeft=g=this.scrollParent[0].scrollLeft+f.scrollSpeed;else if(c.pageX-this.overflowOffset.left<f.scrollSensitivity)this.scrollParent[0].scrollLeft=g=this.scrollParent[0].scrollLeft-f.scrollSpeed}else{if(c.pageY-b(document).scrollTop()<f.scrollSensitivity)g=b(document).scrollTop(b(document).scrollTop()-f.scrollSpeed);else if(b(window).height()-(c.pageY-b(document).scrollTop())<f.scrollSensitivity)g=b(document).scrollTop(b(document).scrollTop()+
f.scrollSpeed);if(c.pageX-b(document).scrollLeft()<f.scrollSensitivity)g=b(document).scrollLeft(b(document).scrollLeft()-f.scrollSpeed);else if(b(window).width()-(c.pageX-b(document).scrollLeft())<f.scrollSensitivity)g=b(document).scrollLeft(b(document).scrollLeft()+f.scrollSpeed)}g!==false&&b.ui.ddmanager&&!f.dropBehaviour&&b.ui.ddmanager.prepareOffsets(this,c)}this.positionAbs=this._convertPositionTo("absolute");if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+
"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";for(f=this.items.length-1;f>=0;f--){g=this.items[f];var e=g.item[0],a=this._intersectsWithPointer(g);if(a)if(e!=this.currentItem[0]&&this.placeholder[a==1?"next":"prev"]()[0]!=e&&!b.ui.contains(this.placeholder[0],e)&&(this.options.type=="semi-dynamic"?!b.ui.contains(this.element[0],e):true)){this.direction=a==1?"down":"up";if(this.options.tolerance=="pointer"||this._intersectsWithSides(g))this._rearrange(c,
g);else break;this._trigger("change",c,this._uiHash());break}}this._contactContainers(c);b.ui.ddmanager&&b.ui.ddmanager.drag(this,c);this._trigger("sort",c,this._uiHash());this.lastPositionAbs=this.positionAbs;return false},_mouseStop:function(c,f){if(c){b.ui.ddmanager&&!this.options.dropBehaviour&&b.ui.ddmanager.drop(this,c);if(this.options.revert){var g=this;f=g.placeholder.offset();g.reverting=true;b(this.helper).animate({left:f.left-this.offset.parent.left-g.margins.left+(this.offsetParent[0]==
document.body?0:this.offsetParent[0].scrollLeft),top:f.top-this.offset.parent.top-g.margins.top+(this.offsetParent[0]==document.body?0:this.offsetParent[0].scrollTop)},parseInt(this.options.revert,10)||500,function(){g._clear(c)})}else this._clear(c,f);return false}},cancel:function(){var c=this;if(this.dragging){this._mouseUp({target:null});this.options.helper=="original"?this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper"):this.currentItem.show();for(var f=this.containers.length-
1;f>=0;f--){this.containers[f]._trigger("deactivate",null,c._uiHash(this));if(this.containers[f].containerCache.over){this.containers[f]._trigger("out",null,c._uiHash(this));this.containers[f].containerCache.over=0}}}if(this.placeholder){this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]);this.options.helper!="original"&&this.helper&&this.helper[0].parentNode&&this.helper.remove();b.extend(this,{helper:null,dragging:false,reverting:false,_noFinalSort:null});
this.domPosition.prev?b(this.domPosition.prev).after(this.currentItem):b(this.domPosition.parent).prepend(this.currentItem)}return this},serialize:function(c){var f=this._getItemsAsjQuery(c&&c.connected),g=[];c=c||{};b(f).each(function(){var e=(b(c.item||this).attr(c.attribute||"id")||"").match(c.expression||/(.+)[-=_](.+)/);if(e)g.push((c.key||e[1]+"[]")+"="+(c.key&&c.expression?e[1]:e[2]))});!g.length&&c.key&&g.push(c.key+"=");return g.join("&")},toArray:function(c){var f=this._getItemsAsjQuery(c&&
c.connected),g=[];c=c||{};f.each(function(){g.push(b(c.item||this).attr(c.attribute||"id")||"")});return g},_intersectsWith:function(c){var f=this.positionAbs.left,g=f+this.helperProportions.width,e=this.positionAbs.top,a=e+this.helperProportions.height,d=c.left,h=d+c.width,i=c.top,j=i+c.height,n=this.offset.click.top,q=this.offset.click.left;n=e+n>i&&e+n<j&&f+q>d&&f+q<h;return this.options.tolerance=="pointer"||this.options.forcePointerForContainers||this.options.tolerance!="pointer"&&this.helperProportions[this.floating?
"width":"height"]>c[this.floating?"width":"height"]?n:d<f+this.helperProportions.width/2&&g-this.helperProportions.width/2<h&&i<e+this.helperProportions.height/2&&a-this.helperProportions.height/2<j},_intersectsWithPointer:function(c){var f=b.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,c.top,c.height);c=b.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,c.left,c.width);f=f&&c;c=this._getDragVerticalDirection();var g=this._getDragHorizontalDirection();if(!f)return false;return this.floating?
g&&g=="right"||c=="down"?2:1:c&&(c=="down"?2:1)},_intersectsWithSides:function(c){var f=b.ui.isOverAxis(this.positionAbs.top+this.offset.click.top,c.top+c.height/2,c.height);c=b.ui.isOverAxis(this.positionAbs.left+this.offset.click.left,c.left+c.width/2,c.width);var g=this._getDragVerticalDirection(),e=this._getDragHorizontalDirection();return this.floating&&e?e=="right"&&c||e=="left"&&!c:g&&(g=="down"&&f||g=="up"&&!f)},_getDragVerticalDirection:function(){var c=this.positionAbs.top-this.lastPositionAbs.top;
return c!=0&&(c>0?"down":"up")},_getDragHorizontalDirection:function(){var c=this.positionAbs.left-this.lastPositionAbs.left;return c!=0&&(c>0?"right":"left")},refresh:function(c){this._refreshItems(c);this.refreshPositions();return this},_connectWith:function(){var c=this.options;return c.connectWith.constructor==String?[c.connectWith]:c.connectWith},_getItemsAsjQuery:function(c){var f=[],g=[],e=this._connectWith();if(e&&c)for(c=e.length-1;c>=0;c--)for(var a=b(e[c]),d=a.length-1;d>=0;d--){var h=
b.data(a[d],"sortable");if(h&&h!=this&&!h.options.disabled)g.push([b.isFunction(h.options.items)?h.options.items.call(h.element):b(h.options.items,h.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),h])}g.push([b.isFunction(this.options.items)?this.options.items.call(this.element,null,{options:this.options,item:this.currentItem}):b(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]);for(c=g.length-1;c>=0;c--)g[c][0].each(function(){f.push(this)});
return b(f)},_removeCurrentsFromItems:function(){for(var c=this.currentItem.find(":data(sortable-item)"),f=0;f<this.items.length;f++)for(var g=0;g<c.length;g++)c[g]==this.items[f].item[0]&&this.items.splice(f,1)},_refreshItems:function(c){this.items=[];this.containers=[this];var f=this.items,g=[[b.isFunction(this.options.items)?this.options.items.call(this.element[0],c,{item:this.currentItem}):b(this.options.items,this.element),this]],e=this._connectWith();if(e)for(var a=e.length-1;a>=0;a--)for(var d=
b(e[a]),h=d.length-1;h>=0;h--){var i=b.data(d[h],"sortable");if(i&&i!=this&&!i.options.disabled){g.push([b.isFunction(i.options.items)?i.options.items.call(i.element[0],c,{item:this.currentItem}):b(i.options.items,i.element),i]);this.containers.push(i)}}for(a=g.length-1;a>=0;a--){c=g[a][1];e=g[a][0];h=0;for(d=e.length;h<d;h++){i=b(e[h]);i.data("sortable-item",c);f.push({item:i,instance:c,width:0,height:0,left:0,top:0})}}},refreshPositions:function(c){if(this.offsetParent&&this.helper)this.offset.parent=
this._getParentOffset();for(var f=this.items.length-1;f>=0;f--){var g=this.items[f],e=this.options.toleranceElement?b(this.options.toleranceElement,g.item):g.item;if(!c){g.width=e.outerWidth();g.height=e.outerHeight()}e=e.offset();g.left=e.left;g.top=e.top}if(this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(f=this.containers.length-1;f>=0;f--){e=this.containers[f].element.offset();this.containers[f].containerCache.left=e.left;this.containers[f].containerCache.top=
e.top;this.containers[f].containerCache.width=this.containers[f].element.outerWidth();this.containers[f].containerCache.height=this.containers[f].element.outerHeight()}return this},_createPlaceholder:function(c){var f=c||this,g=f.options;if(!g.placeholder||g.placeholder.constructor==String){var e=g.placeholder;g.placeholder={element:function(){var a=b(document.createElement(f.currentItem[0].nodeName)).addClass(e||f.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper")[0];
if(!e)a.style.visibility="hidden";return a},update:function(a,d){if(!(e&&!g.forcePlaceholderSize)){d.height()||d.height(f.currentItem.innerHeight()-parseInt(f.currentItem.css("paddingTop")||0,10)-parseInt(f.currentItem.css("paddingBottom")||0,10));d.width()||d.width(f.currentItem.innerWidth()-parseInt(f.currentItem.css("paddingLeft")||0,10)-parseInt(f.currentItem.css("paddingRight")||0,10))}}}}f.placeholder=b(g.placeholder.element.call(f.element,f.currentItem));f.currentItem.after(f.placeholder);
g.placeholder.update(f,f.placeholder)},_contactContainers:function(c){for(var f=null,g=null,e=this.containers.length-1;e>=0;e--)if(!b.ui.contains(this.currentItem[0],this.containers[e].element[0]))if(this._intersectsWith(this.containers[e].containerCache)){if(!(f&&b.ui.contains(this.containers[e].element[0],f.element[0]))){f=this.containers[e];g=e}}else if(this.containers[e].containerCache.over){this.containers[e]._trigger("out",c,this._uiHash(this));this.containers[e].containerCache.over=0}if(f)if(this.containers.length===
1){this.containers[g]._trigger("over",c,this._uiHash(this));this.containers[g].containerCache.over=1}else if(this.currentContainer!=this.containers[g]){f=1E4;e=null;for(var a=this.positionAbs[this.containers[g].floating?"left":"top"],d=this.items.length-1;d>=0;d--)if(b.ui.contains(this.containers[g].element[0],this.items[d].item[0])){var h=this.items[d][this.containers[g].floating?"left":"top"];if(Math.abs(h-a)<f){f=Math.abs(h-a);e=this.items[d]}}if(e||this.options.dropOnEmpty){this.currentContainer=
this.containers[g];e?this._rearrange(c,e,null,true):this._rearrange(c,null,this.containers[g].element,true);this._trigger("change",c,this._uiHash());this.containers[g]._trigger("change",c,this._uiHash(this));this.options.placeholder.update(this.currentContainer,this.placeholder);this.containers[g]._trigger("over",c,this._uiHash(this));this.containers[g].containerCache.over=1}}},_createHelper:function(c){var f=this.options;c=b.isFunction(f.helper)?b(f.helper.apply(this.element[0],[c,this.currentItem])):
f.helper=="clone"?this.currentItem.clone():this.currentItem;c.parents("body").length||b(f.appendTo!="parent"?f.appendTo:this.currentItem[0].parentNode)[0].appendChild(c[0]);if(c[0]==this.currentItem[0])this._storedCSS={width:this.currentItem[0].style.width,height:this.currentItem[0].style.height,position:this.currentItem.css("position"),top:this.currentItem.css("top"),left:this.currentItem.css("left")};if(c[0].style.width==""||f.forceHelperSize)c.width(this.currentItem.width());if(c[0].style.height==
""||f.forceHelperSize)c.height(this.currentItem.height());return c},_adjustOffsetFromHelper:function(c){if(typeof c=="string")c=c.split(" ");if(b.isArray(c))c={left:+c[0],top:+c[1]||0};if("left"in c)this.offset.click.left=c.left+this.margins.left;if("right"in c)this.offset.click.left=this.helperProportions.width-c.right+this.margins.left;if("top"in c)this.offset.click.top=c.top+this.margins.top;if("bottom"in c)this.offset.click.top=this.helperProportions.height-c.bottom+this.margins.top},_getParentOffset:function(){this.offsetParent=
this.helper.offsetParent();var c=this.offsetParent.offset();if(this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&b.ui.contains(this.scrollParent[0],this.offsetParent[0])){c.left+=this.scrollParent.scrollLeft();c.top+=this.scrollParent.scrollTop()}if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&b.browser.msie)c={top:0,left:0};return{top:c.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:c.left+(parseInt(this.offsetParent.css("borderLeftWidth"),
10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var c=this.currentItem.position();return{top:c.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:c.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}else return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.currentItem.css("marginLeft"),10)||0,top:parseInt(this.currentItem.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions=
{width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var c=this.options;if(c.containment=="parent")c.containment=this.helper[0].parentNode;if(c.containment=="document"||c.containment=="window")this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,b(c.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(b(c.containment=="document"?document:window).height()||
document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(c.containment)){var f=b(c.containment)[0];c=b(c.containment).offset();var g=b(f).css("overflow")!="hidden";this.containment=[c.left+(parseInt(b(f).css("borderLeftWidth"),10)||0)+(parseInt(b(f).css("paddingLeft"),10)||0)-this.margins.left,c.top+(parseInt(b(f).css("borderTopWidth"),10)||0)+(parseInt(b(f).css("paddingTop"),10)||0)-this.margins.top,c.left+(g?Math.max(f.scrollWidth,
f.offsetWidth):f.offsetWidth)-(parseInt(b(f).css("borderLeftWidth"),10)||0)-(parseInt(b(f).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,c.top+(g?Math.max(f.scrollHeight,f.offsetHeight):f.offsetHeight)-(parseInt(b(f).css("borderTopWidth"),10)||0)-(parseInt(b(f).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top]}},_convertPositionTo:function(c,f){if(!f)f=this.position;c=c=="absolute"?1:-1;var g=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=
document&&b.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(g[0].tagName);return{top:f.top+this.offset.relative.top*c+this.offset.parent.top*c-(b.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:g.scrollTop())*c),left:f.left+this.offset.relative.left*c+this.offset.parent.left*c-(b.browser.safari&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():
e?0:g.scrollLeft())*c)}},_generatePosition:function(c){var f=this.options,g=this.cssPosition=="absolute"&&!(this.scrollParent[0]!=document&&b.ui.contains(this.scrollParent[0],this.offsetParent[0]))?this.offsetParent:this.scrollParent,e=/(html|body)/i.test(g[0].tagName);if(this.cssPosition=="relative"&&!(this.scrollParent[0]!=document&&this.scrollParent[0]!=this.offsetParent[0]))this.offset.relative=this._getRelativeOffset();var a=c.pageX,d=c.pageY;if(this.originalPosition){if(this.containment){if(c.pageX-
this.offset.click.left<this.containment[0])a=this.containment[0]+this.offset.click.left;if(c.pageY-this.offset.click.top<this.containment[1])d=this.containment[1]+this.offset.click.top;if(c.pageX-this.offset.click.left>this.containment[2])a=this.containment[2]+this.offset.click.left;if(c.pageY-this.offset.click.top>this.containment[3])d=this.containment[3]+this.offset.click.top}if(f.grid){d=this.originalPageY+Math.round((d-this.originalPageY)/f.grid[1])*f.grid[1];d=this.containment?!(d-this.offset.click.top<
this.containment[1]||d-this.offset.click.top>this.containment[3])?d:!(d-this.offset.click.top<this.containment[1])?d-f.grid[1]:d+f.grid[1]:d;a=this.originalPageX+Math.round((a-this.originalPageX)/f.grid[0])*f.grid[0];a=this.containment?!(a-this.offset.click.left<this.containment[0]||a-this.offset.click.left>this.containment[2])?a:!(a-this.offset.click.left<this.containment[0])?a-f.grid[0]:a+f.grid[0]:a}}return{top:d-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(b.browser.safari&&
this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():e?0:g.scrollTop()),left:a-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(b.browser.safari&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():e?0:g.scrollLeft())}},_rearrange:function(c,f,g,e){g?g[0].appendChild(this.placeholder[0]):f.item[0].parentNode.insertBefore(this.placeholder[0],this.direction=="down"?f.item[0]:f.item[0].nextSibling);this.counter=
this.counter?++this.counter:1;var a=this,d=this.counter;window.setTimeout(function(){d==a.counter&&a.refreshPositions(!e)},0)},_clear:function(c,f){this.reverting=false;var g=[];!this._noFinalSort&&this.currentItem[0].parentNode&&this.placeholder.before(this.currentItem);this._noFinalSort=null;if(this.helper[0]==this.currentItem[0]){for(var e in this._storedCSS)if(this._storedCSS[e]=="auto"||this._storedCSS[e]=="static")this._storedCSS[e]="";this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")}else this.currentItem.show();
this.fromOutside&&!f&&g.push(function(a){this._trigger("receive",a,this._uiHash(this.fromOutside))});if((this.fromOutside||this.domPosition.prev!=this.currentItem.prev().not(".ui-sortable-helper")[0]||this.domPosition.parent!=this.currentItem.parent()[0])&&!f)g.push(function(a){this._trigger("update",a,this._uiHash())});if(!b.ui.contains(this.element[0],this.currentItem[0])){f||g.push(function(a){this._trigger("remove",a,this._uiHash())});for(e=this.containers.length-1;e>=0;e--)if(b.ui.contains(this.containers[e].element[0],
this.currentItem[0])&&!f){g.push(function(a){return function(d){a._trigger("receive",d,this._uiHash(this))}}.call(this,this.containers[e]));g.push(function(a){return function(d){a._trigger("update",d,this._uiHash(this))}}.call(this,this.containers[e]))}}for(e=this.containers.length-1;e>=0;e--){f||g.push(function(a){return function(d){a._trigger("deactivate",d,this._uiHash(this))}}.call(this,this.containers[e]));if(this.containers[e].containerCache.over){g.push(function(a){return function(d){a._trigger("out",
d,this._uiHash(this))}}.call(this,this.containers[e]));this.containers[e].containerCache.over=0}}this._storedCursor&&b("body").css("cursor",this._storedCursor);this._storedOpacity&&this.helper.css("opacity",this._storedOpacity);if(this._storedZIndex)this.helper.css("zIndex",this._storedZIndex=="auto"?"":this._storedZIndex);this.dragging=false;if(this.cancelHelperRemoval){if(!f){this._trigger("beforeStop",c,this._uiHash());for(e=0;e<g.length;e++)g[e].call(this,c);this._trigger("stop",c,this._uiHash())}return false}f||
this._trigger("beforeStop",c,this._uiHash());this.placeholder[0].parentNode.removeChild(this.placeholder[0]);this.helper[0]!=this.currentItem[0]&&this.helper.remove();this.helper=null;if(!f){for(e=0;e<g.length;e++)g[e].call(this,c);this._trigger("stop",c,this._uiHash())}this.fromOutside=false;return true},_trigger:function(){b.Widget.prototype._trigger.apply(this,arguments)===false&&this.cancel()},_uiHash:function(c){var f=c||this;return{helper:f.helper,placeholder:f.placeholder||b([]),position:f.position,
originalPosition:f.originalPosition,offset:f.positionAbs,item:f.currentItem,sender:c?c.element:null}}});b.extend(b.ui.sortable,{version:"1.8.9"})})(jQuery);
jQuery.effects||function(b,c){function f(l){var k;if(l&&l.constructor==Array&&l.length==3)return l;if(k=/rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/.exec(l))return[parseInt(k[1],10),parseInt(k[2],10),parseInt(k[3],10)];if(k=/rgb\(\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*,\s*([0-9]+(?:\.[0-9]+)?)\%\s*\)/.exec(l))return[parseFloat(k[1])*2.55,parseFloat(k[2])*2.55,parseFloat(k[3])*2.55];if(k=/#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/.exec(l))return[parseInt(k[1],
16),parseInt(k[2],16),parseInt(k[3],16)];if(k=/#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/.exec(l))return[parseInt(k[1]+k[1],16),parseInt(k[2]+k[2],16),parseInt(k[3]+k[3],16)];if(/rgba\(0, 0, 0, 0\)/.exec(l))return j.transparent;return j[b.trim(l).toLowerCase()]}function g(l,k){var m;do{m=b.curCSS(l,k);if(m!=""&&m!="transparent"||b.nodeName(l,"body"))break;k="backgroundColor"}while(l=l.parentNode);return f(m)}function e(){var l=document.defaultView?document.defaultView.getComputedStyle(this,null):this.currentStyle,
k={},m,o;if(l&&l.length&&l[0]&&l[l[0]])for(var p=l.length;p--;){m=l[p];if(typeof l[m]=="string"){o=m.replace(/\-(\w)/g,function(s,r){return r.toUpperCase()});k[o]=l[m]}}else for(m in l)if(typeof l[m]==="string")k[m]=l[m];return k}function a(l){var k,m;for(k in l){m=l[k];if(m==null||b.isFunction(m)||k in q||/scrollbar/.test(k)||!/color/i.test(k)&&isNaN(parseFloat(m)))delete l[k]}return l}function d(l,k){var m={_:0},o;for(o in k)if(l[o]!=k[o])m[o]=k[o];return m}function h(l,k,m,o){if(typeof l=="object"){o=
k;m=null;k=l;l=k.effect}if(b.isFunction(k)){o=k;m=null;k={}}if(typeof k=="number"||b.fx.speeds[k]){o=m;m=k;k={}}if(b.isFunction(m)){o=m;m=null}k=k||{};m=m||k.duration;m=b.fx.off?0:typeof m=="number"?m:m in b.fx.speeds?b.fx.speeds[m]:b.fx.speeds._default;o=o||k.complete;return[l,k,m,o]}function i(l){if(!l||typeof l==="number"||b.fx.speeds[l])return true;if(typeof l==="string"&&!b.effects[l])return true;return false}b.effects={};b.each(["backgroundColor","borderBottomColor","borderLeftColor","borderRightColor",
"borderTopColor","borderColor","color","outlineColor"],function(l,k){b.fx.step[k]=function(m){if(!m.colorInit){m.start=g(m.elem,k);m.end=f(m.end);m.colorInit=true}m.elem.style[k]="rgb("+Math.max(Math.min(parseInt(m.pos*(m.end[0]-m.start[0])+m.start[0],10),255),0)+","+Math.max(Math.min(parseInt(m.pos*(m.end[1]-m.start[1])+m.start[1],10),255),0)+","+Math.max(Math.min(parseInt(m.pos*(m.end[2]-m.start[2])+m.start[2],10),255),0)+")"}});var j={aqua:[0,255,255],azure:[240,255,255],beige:[245,245,220],black:[0,
0,0],blue:[0,0,255],brown:[165,42,42],cyan:[0,255,255],darkblue:[0,0,139],darkcyan:[0,139,139],darkgrey:[169,169,169],darkgreen:[0,100,0],darkkhaki:[189,183,107],darkmagenta:[139,0,139],darkolivegreen:[85,107,47],darkorange:[255,140,0],darkorchid:[153,50,204],darkred:[139,0,0],darksalmon:[233,150,122],darkviolet:[148,0,211],fuchsia:[255,0,255],gold:[255,215,0],green:[0,128,0],indigo:[75,0,130],khaki:[240,230,140],lightblue:[173,216,230],lightcyan:[224,255,255],lightgreen:[144,238,144],lightgrey:[211,
211,211],lightpink:[255,182,193],lightyellow:[255,255,224],lime:[0,255,0],magenta:[255,0,255],maroon:[128,0,0],navy:[0,0,128],olive:[128,128,0],orange:[255,165,0],pink:[255,192,203],purple:[128,0,128],violet:[128,0,128],red:[255,0,0],silver:[192,192,192],white:[255,255,255],yellow:[255,255,0],transparent:[255,255,255]},n=["add","remove","toggle"],q={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1};b.effects.animateClass=function(l,k,m,
o){if(b.isFunction(m)){o=m;m=null}return this.queue("fx",function(){var p=b(this),s=p.attr("style")||" ",r=a(e.call(this)),u,v=p.attr("className");b.each(n,function(w,y){l[y]&&p[y+"Class"](l[y])});u=a(e.call(this));p.attr("className",v);p.animate(d(r,u),k,m,function(){b.each(n,function(w,y){l[y]&&p[y+"Class"](l[y])});if(typeof p.attr("style")=="object"){p.attr("style").cssText="";p.attr("style").cssText=s}else p.attr("style",s);o&&o.apply(this,arguments)});r=b.queue(this);u=r.splice(r.length-1,1)[0];
r.splice(1,0,u);b.dequeue(this)})};b.fn.extend({_addClass:b.fn.addClass,addClass:function(l,k,m,o){return k?b.effects.animateClass.apply(this,[{add:l},k,m,o]):this._addClass(l)},_removeClass:b.fn.removeClass,removeClass:function(l,k,m,o){return k?b.effects.animateClass.apply(this,[{remove:l},k,m,o]):this._removeClass(l)},_toggleClass:b.fn.toggleClass,toggleClass:function(l,k,m,o,p){return typeof k=="boolean"||k===c?m?b.effects.animateClass.apply(this,[k?{add:l}:{remove:l},m,o,p]):this._toggleClass(l,
k):b.effects.animateClass.apply(this,[{toggle:l},k,m,o])},switchClass:function(l,k,m,o,p){return b.effects.animateClass.apply(this,[{add:k,remove:l},m,o,p])}});b.extend(b.effects,{version:"1.8.9",save:function(l,k){for(var m=0;m<k.length;m++)k[m]!==null&&l.data("ec.storage."+k[m],l[0].style[k[m]])},restore:function(l,k){for(var m=0;m<k.length;m++)k[m]!==null&&l.css(k[m],l.data("ec.storage."+k[m]))},setMode:function(l,k){if(k=="toggle")k=l.is(":hidden")?"show":"hide";return k},getBaseline:function(l,
k){var m;switch(l[0]){case "top":m=0;break;case "middle":m=0.5;break;case "bottom":m=1;break;default:m=l[0]/k.height}switch(l[1]){case "left":l=0;break;case "center":l=0.5;break;case "right":l=1;break;default:l=l[1]/k.width}return{x:l,y:m}},createWrapper:function(l){if(l.parent().is(".ui-effects-wrapper"))return l.parent();var k={width:l.outerWidth(true),height:l.outerHeight(true),"float":l.css("float")},m=b("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",
border:"none",margin:0,padding:0});l.wrap(m);m=l.parent();if(l.css("position")=="static"){m.css({position:"relative"});l.css({position:"relative"})}else{b.extend(k,{position:l.css("position"),zIndex:l.css("z-index")});b.each(["top","left","bottom","right"],function(o,p){k[p]=l.css(p);if(isNaN(parseInt(k[p],10)))k[p]="auto"});l.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})}return m.css(k).show()},removeWrapper:function(l){if(l.parent().is(".ui-effects-wrapper"))return l.parent().replaceWith(l);
return l},setTransition:function(l,k,m,o){o=o||{};b.each(k,function(p,s){unit=l.cssUnit(s);if(unit[0]>0)o[s]=unit[0]*m+unit[1]});return o}});b.fn.extend({effect:function(l){var k=h.apply(this,arguments),m={options:k[1],duration:k[2],callback:k[3]};k=m.options.mode;var o=b.effects[l];if(b.fx.off||!o)return k?this[k](m.duration,m.callback):this.each(function(){m.callback&&m.callback.call(this)});return o.call(this,m)},_show:b.fn.show,show:function(l){if(i(l))return this._show.apply(this,arguments);
else{var k=h.apply(this,arguments);k[1].mode="show";return this.effect.apply(this,k)}},_hide:b.fn.hide,hide:function(l){if(i(l))return this._hide.apply(this,arguments);else{var k=h.apply(this,arguments);k[1].mode="hide";return this.effect.apply(this,k)}},__toggle:b.fn.toggle,toggle:function(l){if(i(l)||typeof l==="boolean"||b.isFunction(l))return this.__toggle.apply(this,arguments);else{var k=h.apply(this,arguments);k[1].mode="toggle";return this.effect.apply(this,k)}},cssUnit:function(l){var k=this.css(l),
m=[];b.each(["em","px","%","pt"],function(o,p){if(k.indexOf(p)>0)m=[parseFloat(k),p]});return m}});b.easing.jswing=b.easing.swing;b.extend(b.easing,{def:"easeOutQuad",swing:function(l,k,m,o,p){return b.easing[b.easing.def](l,k,m,o,p)},easeInQuad:function(l,k,m,o,p){return o*(k/=p)*k+m},easeOutQuad:function(l,k,m,o,p){return-o*(k/=p)*(k-2)+m},easeInOutQuad:function(l,k,m,o,p){if((k/=p/2)<1)return o/2*k*k+m;return-o/2*(--k*(k-2)-1)+m},easeInCubic:function(l,k,m,o,p){return o*(k/=p)*k*k+m},easeOutCubic:function(l,
k,m,o,p){return o*((k=k/p-1)*k*k+1)+m},easeInOutCubic:function(l,k,m,o,p){if((k/=p/2)<1)return o/2*k*k*k+m;return o/2*((k-=2)*k*k+2)+m},easeInQuart:function(l,k,m,o,p){return o*(k/=p)*k*k*k+m},easeOutQuart:function(l,k,m,o,p){return-o*((k=k/p-1)*k*k*k-1)+m},easeInOutQuart:function(l,k,m,o,p){if((k/=p/2)<1)return o/2*k*k*k*k+m;return-o/2*((k-=2)*k*k*k-2)+m},easeInQuint:function(l,k,m,o,p){return o*(k/=p)*k*k*k*k+m},easeOutQuint:function(l,k,m,o,p){return o*((k=k/p-1)*k*k*k*k+1)+m},easeInOutQuint:function(l,
k,m,o,p){if((k/=p/2)<1)return o/2*k*k*k*k*k+m;return o/2*((k-=2)*k*k*k*k+2)+m},easeInSine:function(l,k,m,o,p){return-o*Math.cos(k/p*(Math.PI/2))+o+m},easeOutSine:function(l,k,m,o,p){return o*Math.sin(k/p*(Math.PI/2))+m},easeInOutSine:function(l,k,m,o,p){return-o/2*(Math.cos(Math.PI*k/p)-1)+m},easeInExpo:function(l,k,m,o,p){return k==0?m:o*Math.pow(2,10*(k/p-1))+m},easeOutExpo:function(l,k,m,o,p){return k==p?m+o:o*(-Math.pow(2,-10*k/p)+1)+m},easeInOutExpo:function(l,k,m,o,p){if(k==0)return m;if(k==
p)return m+o;if((k/=p/2)<1)return o/2*Math.pow(2,10*(k-1))+m;return o/2*(-Math.pow(2,-10*--k)+2)+m},easeInCirc:function(l,k,m,o,p){return-o*(Math.sqrt(1-(k/=p)*k)-1)+m},easeOutCirc:function(l,k,m,o,p){return o*Math.sqrt(1-(k=k/p-1)*k)+m},easeInOutCirc:function(l,k,m,o,p){if((k/=p/2)<1)return-o/2*(Math.sqrt(1-k*k)-1)+m;return o/2*(Math.sqrt(1-(k-=2)*k)+1)+m},easeInElastic:function(l,k,m,o,p){l=1.70158;var s=0,r=o;if(k==0)return m;if((k/=p)==1)return m+o;s||(s=p*0.3);if(r<Math.abs(o)){r=o;l=s/4}else l=
s/(2*Math.PI)*Math.asin(o/r);return-(r*Math.pow(2,10*(k-=1))*Math.sin((k*p-l)*2*Math.PI/s))+m},easeOutElastic:function(l,k,m,o,p){l=1.70158;var s=0,r=o;if(k==0)return m;if((k/=p)==1)return m+o;s||(s=p*0.3);if(r<Math.abs(o)){r=o;l=s/4}else l=s/(2*Math.PI)*Math.asin(o/r);return r*Math.pow(2,-10*k)*Math.sin((k*p-l)*2*Math.PI/s)+o+m},easeInOutElastic:function(l,k,m,o,p){l=1.70158;var s=0,r=o;if(k==0)return m;if((k/=p/2)==2)return m+o;s||(s=p*0.3*1.5);if(r<Math.abs(o)){r=o;l=s/4}else l=s/(2*Math.PI)*Math.asin(o/
r);if(k<1)return-0.5*r*Math.pow(2,10*(k-=1))*Math.sin((k*p-l)*2*Math.PI/s)+m;return r*Math.pow(2,-10*(k-=1))*Math.sin((k*p-l)*2*Math.PI/s)*0.5+o+m},easeInBack:function(l,k,m,o,p,s){if(s==c)s=1.70158;return o*(k/=p)*k*((s+1)*k-s)+m},easeOutBack:function(l,k,m,o,p,s){if(s==c)s=1.70158;return o*((k=k/p-1)*k*((s+1)*k+s)+1)+m},easeInOutBack:function(l,k,m,o,p,s){if(s==c)s=1.70158;if((k/=p/2)<1)return o/2*k*k*(((s*=1.525)+1)*k-s)+m;return o/2*((k-=2)*k*(((s*=1.525)+1)*k+s)+2)+m},easeInBounce:function(l,
k,m,o,p){return o-b.easing.easeOutBounce(l,p-k,0,o,p)+m},easeOutBounce:function(l,k,m,o,p){return(k/=p)<1/2.75?o*7.5625*k*k+m:k<2/2.75?o*(7.5625*(k-=1.5/2.75)*k+0.75)+m:k<2.5/2.75?o*(7.5625*(k-=2.25/2.75)*k+0.9375)+m:o*(7.5625*(k-=2.625/2.75)*k+0.984375)+m},easeInOutBounce:function(l,k,m,o,p){if(k<p/2)return b.easing.easeInBounce(l,k*2,0,o,p)*0.5+m;return b.easing.easeOutBounce(l,k*2-p,0,o,p)*0.5+o*0.5+m}})}(jQuery);
(function(b){b.effects.blind=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right"],e=b.effects.setMode(f,c.options.mode||"hide"),a=c.options.direction||"vertical";b.effects.save(f,g);f.show();var d=b.effects.createWrapper(f).css({overflow:"hidden"}),h=a=="vertical"?"height":"width";a=a=="vertical"?d.height():d.width();e=="show"&&d.css(h,0);var i={};i[h]=e=="show"?a:0;d.animate(i,c.duration,c.options.easing,function(){e=="hide"&&f.hide();b.effects.restore(f,
g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(f[0],arguments);f.dequeue()})})}})(jQuery);
(function(b){b.effects.bounce=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right"],e=b.effects.setMode(f,c.options.mode||"effect"),a=c.options.direction||"up",d=c.options.distance||20,h=c.options.times||5,i=c.duration||250;/show|hide/.test(e)&&g.push("opacity");b.effects.save(f,g);f.show();b.effects.createWrapper(f);var j=a=="up"||a=="down"?"top":"left";a=a=="up"||a=="left"?"pos":"neg";d=c.options.distance||(j=="top"?f.outerHeight({margin:true})/3:f.outerWidth({margin:true})/
3);if(e=="show")f.css("opacity",0).css(j,a=="pos"?-d:d);if(e=="hide")d/=h*2;e!="hide"&&h--;if(e=="show"){var n={opacity:1};n[j]=(a=="pos"?"+=":"-=")+d;f.animate(n,i/2,c.options.easing);d/=2;h--}for(n=0;n<h;n++){var q={},l={};q[j]=(a=="pos"?"-=":"+=")+d;l[j]=(a=="pos"?"+=":"-=")+d;f.animate(q,i/2,c.options.easing).animate(l,i/2,c.options.easing);d=e=="hide"?d*2:d/2}if(e=="hide"){n={opacity:0};n[j]=(a=="pos"?"-=":"+=")+d;f.animate(n,i/2,c.options.easing,function(){f.hide();b.effects.restore(f,g);b.effects.removeWrapper(f);
c.callback&&c.callback.apply(this,arguments)})}else{q={};l={};q[j]=(a=="pos"?"-=":"+=")+d;l[j]=(a=="pos"?"+=":"-=")+d;f.animate(q,i/2,c.options.easing).animate(l,i/2,c.options.easing,function(){b.effects.restore(f,g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(this,arguments)})}f.queue("fx",function(){f.dequeue()});f.dequeue()})}})(jQuery);
(function(b){b.effects.clip=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right","height","width"],e=b.effects.setMode(f,c.options.mode||"hide"),a=c.options.direction||"vertical";b.effects.save(f,g);f.show();var d=b.effects.createWrapper(f).css({overflow:"hidden"});d=f[0].tagName=="IMG"?d:f;var h={size:a=="vertical"?"height":"width",position:a=="vertical"?"top":"left"};a=a=="vertical"?d.height():d.width();if(e=="show"){d.css(h.size,0);d.css(h.position,
a/2)}var i={};i[h.size]=e=="show"?a:0;i[h.position]=e=="show"?0:a/2;d.animate(i,{queue:false,duration:c.duration,easing:c.options.easing,complete:function(){e=="hide"&&f.hide();b.effects.restore(f,g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(f[0],arguments);f.dequeue()}})})}})(jQuery);
(function(b){b.effects.drop=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right","opacity"],e=b.effects.setMode(f,c.options.mode||"hide"),a=c.options.direction||"left";b.effects.save(f,g);f.show();b.effects.createWrapper(f);var d=a=="up"||a=="down"?"top":"left";a=a=="up"||a=="left"?"pos":"neg";var h=c.options.distance||(d=="top"?f.outerHeight({margin:true})/2:f.outerWidth({margin:true})/2);if(e=="show")f.css("opacity",0).css(d,a=="pos"?-h:h);var i={opacity:e==
"show"?1:0};i[d]=(e=="show"?a=="pos"?"+=":"-=":a=="pos"?"-=":"+=")+h;f.animate(i,{queue:false,duration:c.duration,easing:c.options.easing,complete:function(){e=="hide"&&f.hide();b.effects.restore(f,g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(this,arguments);f.dequeue()}})})}})(jQuery);
(function(b){b.effects.explode=function(c){return this.queue(function(){var f=c.options.pieces?Math.round(Math.sqrt(c.options.pieces)):3,g=c.options.pieces?Math.round(Math.sqrt(c.options.pieces)):3;c.options.mode=c.options.mode=="toggle"?b(this).is(":visible")?"hide":"show":c.options.mode;var e=b(this).show().css("visibility","hidden"),a=e.offset();a.top-=parseInt(e.css("marginTop"),10)||0;a.left-=parseInt(e.css("marginLeft"),10)||0;for(var d=e.outerWidth(true),h=e.outerHeight(true),i=0;i<f;i++)for(var j=
0;j<g;j++)e.clone().appendTo("body").wrap("<div></div>").css({position:"absolute",visibility:"visible",left:-j*(d/g),top:-i*(h/f)}).parent().addClass("ui-effects-explode").css({position:"absolute",overflow:"hidden",width:d/g,height:h/f,left:a.left+j*(d/g)+(c.options.mode=="show"?(j-Math.floor(g/2))*(d/g):0),top:a.top+i*(h/f)+(c.options.mode=="show"?(i-Math.floor(f/2))*(h/f):0),opacity:c.options.mode=="show"?0:1}).animate({left:a.left+j*(d/g)+(c.options.mode=="show"?0:(j-Math.floor(g/2))*(d/g)),top:a.top+
i*(h/f)+(c.options.mode=="show"?0:(i-Math.floor(f/2))*(h/f)),opacity:c.options.mode=="show"?1:0},c.duration||500);setTimeout(function(){c.options.mode=="show"?e.css({visibility:"visible"}):e.css({visibility:"visible"}).hide();c.callback&&c.callback.apply(e[0]);e.dequeue();b("div.ui-effects-explode").remove()},c.duration||500)})}})(jQuery);
(function(b){b.effects.fade=function(c){return this.queue(function(){var f=b(this),g=b.effects.setMode(f,c.options.mode||"hide");f.animate({opacity:g},{queue:false,duration:c.duration,easing:c.options.easing,complete:function(){c.callback&&c.callback.apply(this,arguments);f.dequeue()}})})}})(jQuery);
(function(b){b.effects.fold=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right"],e=b.effects.setMode(f,c.options.mode||"hide"),a=c.options.size||15,d=!!c.options.horizFirst,h=c.duration?c.duration/2:b.fx.speeds._default/2;b.effects.save(f,g);f.show();var i=b.effects.createWrapper(f).css({overflow:"hidden"}),j=e=="show"!=d,n=j?["width","height"]:["height","width"];j=j?[i.width(),i.height()]:[i.height(),i.width()];var q=/([0-9]+)%/.exec(a);if(q)a=parseInt(q[1],
10)/100*j[e=="hide"?0:1];if(e=="show")i.css(d?{height:0,width:a}:{height:a,width:0});d={};q={};d[n[0]]=e=="show"?j[0]:a;q[n[1]]=e=="show"?j[1]:0;i.animate(d,h,c.options.easing).animate(q,h,c.options.easing,function(){e=="hide"&&f.hide();b.effects.restore(f,g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(f[0],arguments);f.dequeue()})})}})(jQuery);
(function(b){b.effects.highlight=function(c){return this.queue(function(){var f=b(this),g=["backgroundImage","backgroundColor","opacity"],e=b.effects.setMode(f,c.options.mode||"show"),a={backgroundColor:f.css("backgroundColor")};if(e=="hide")a.opacity=0;b.effects.save(f,g);f.show().css({backgroundImage:"none",backgroundColor:c.options.color||"#ffff99"}).animate(a,{queue:false,duration:c.duration,easing:c.options.easing,complete:function(){e=="hide"&&f.hide();b.effects.restore(f,g);e=="show"&&!b.support.opacity&&
this.style.removeAttribute("filter");c.callback&&c.callback.apply(this,arguments);f.dequeue()}})})}})(jQuery);
(function(b){b.effects.pulsate=function(c){return this.queue(function(){var f=b(this),g=b.effects.setMode(f,c.options.mode||"show");times=(c.options.times||5)*2-1;duration=c.duration?c.duration/2:b.fx.speeds._default/2;isVisible=f.is(":visible");animateTo=0;if(!isVisible){f.css("opacity",0).show();animateTo=1}if(g=="hide"&&isVisible||g=="show"&&!isVisible)times--;for(g=0;g<times;g++){f.animate({opacity:animateTo},duration,c.options.easing);animateTo=(animateTo+1)%2}f.animate({opacity:animateTo},duration,
c.options.easing,function(){animateTo==0&&f.hide();c.callback&&c.callback.apply(this,arguments)});f.queue("fx",function(){f.dequeue()}).dequeue()})}})(jQuery);
(function(b){b.effects.puff=function(c){return this.queue(function(){var f=b(this),g=b.effects.setMode(f,c.options.mode||"hide"),e=parseInt(c.options.percent,10)||150,a=e/100,d={height:f.height(),width:f.width()};b.extend(c.options,{fade:true,mode:g,percent:g=="hide"?e:100,from:g=="hide"?d:{height:d.height*a,width:d.width*a}});f.effect("scale",c.options,c.duration,c.callback);f.dequeue()})};b.effects.scale=function(c){return this.queue(function(){var f=b(this),g=b.extend(true,{},c.options),e=b.effects.setMode(f,
c.options.mode||"effect"),a=parseInt(c.options.percent,10)||(parseInt(c.options.percent,10)==0?0:e=="hide"?0:100),d=c.options.direction||"both",h=c.options.origin;if(e!="effect"){g.origin=h||["middle","center"];g.restore=true}h={height:f.height(),width:f.width()};f.from=c.options.from||(e=="show"?{height:0,width:0}:h);a={y:d!="horizontal"?a/100:1,x:d!="vertical"?a/100:1};f.to={height:h.height*a.y,width:h.width*a.x};if(c.options.fade){if(e=="show"){f.from.opacity=0;f.to.opacity=1}if(e=="hide"){f.from.opacity=
1;f.to.opacity=0}}g.from=f.from;g.to=f.to;g.mode=e;f.effect("size",g,c.duration,c.callback);f.dequeue()})};b.effects.size=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right","width","height","overflow","opacity"],e=["position","top","bottom","left","right","overflow","opacity"],a=["width","height","overflow"],d=["fontSize"],h=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"],i=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"],
j=b.effects.setMode(f,c.options.mode||"effect"),n=c.options.restore||false,q=c.options.scale||"both",l=c.options.origin,k={height:f.height(),width:f.width()};f.from=c.options.from||k;f.to=c.options.to||k;if(l){l=b.effects.getBaseline(l,k);f.from.top=(k.height-f.from.height)*l.y;f.from.left=(k.width-f.from.width)*l.x;f.to.top=(k.height-f.to.height)*l.y;f.to.left=(k.width-f.to.width)*l.x}var m={from:{y:f.from.height/k.height,x:f.from.width/k.width},to:{y:f.to.height/k.height,x:f.to.width/k.width}};
if(q=="box"||q=="both"){if(m.from.y!=m.to.y){g=g.concat(h);f.from=b.effects.setTransition(f,h,m.from.y,f.from);f.to=b.effects.setTransition(f,h,m.to.y,f.to)}if(m.from.x!=m.to.x){g=g.concat(i);f.from=b.effects.setTransition(f,i,m.from.x,f.from);f.to=b.effects.setTransition(f,i,m.to.x,f.to)}}if(q=="content"||q=="both")if(m.from.y!=m.to.y){g=g.concat(d);f.from=b.effects.setTransition(f,d,m.from.y,f.from);f.to=b.effects.setTransition(f,d,m.to.y,f.to)}b.effects.save(f,n?g:e);f.show();b.effects.createWrapper(f);
f.css("overflow","hidden").css(f.from);if(q=="content"||q=="both"){h=h.concat(["marginTop","marginBottom"]).concat(d);i=i.concat(["marginLeft","marginRight"]);a=g.concat(h).concat(i);f.find("*[width]").each(function(){child=b(this);n&&b.effects.save(child,a);var o={height:child.height(),width:child.width()};child.from={height:o.height*m.from.y,width:o.width*m.from.x};child.to={height:o.height*m.to.y,width:o.width*m.to.x};if(m.from.y!=m.to.y){child.from=b.effects.setTransition(child,h,m.from.y,child.from);
child.to=b.effects.setTransition(child,h,m.to.y,child.to)}if(m.from.x!=m.to.x){child.from=b.effects.setTransition(child,i,m.from.x,child.from);child.to=b.effects.setTransition(child,i,m.to.x,child.to)}child.css(child.from);child.animate(child.to,c.duration,c.options.easing,function(){n&&b.effects.restore(child,a)})})}f.animate(f.to,{queue:false,duration:c.duration,easing:c.options.easing,complete:function(){f.to.opacity===0&&f.css("opacity",f.from.opacity);j=="hide"&&f.hide();b.effects.restore(f,
n?g:e);b.effects.removeWrapper(f);c.callback&&c.callback.apply(this,arguments);f.dequeue()}})})}})(jQuery);
(function(b){b.effects.shake=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right"];b.effects.setMode(f,c.options.mode||"effect");var e=c.options.direction||"left",a=c.options.distance||20,d=c.options.times||3,h=c.duration||c.options.duration||140;b.effects.save(f,g);f.show();b.effects.createWrapper(f);var i=e=="up"||e=="down"?"top":"left",j=e=="up"||e=="left"?"pos":"neg";e={};var n={},q={};e[i]=(j=="pos"?"-=":"+=")+a;n[i]=(j=="pos"?"+=":"-=")+a*2;q[i]=
(j=="pos"?"-=":"+=")+a*2;f.animate(e,h,c.options.easing);for(a=1;a<d;a++)f.animate(n,h,c.options.easing).animate(q,h,c.options.easing);f.animate(n,h,c.options.easing).animate(e,h/2,c.options.easing,function(){b.effects.restore(f,g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(this,arguments)});f.queue("fx",function(){f.dequeue()});f.dequeue()})}})(jQuery);
(function(b){b.effects.slide=function(c){return this.queue(function(){var f=b(this),g=["position","top","bottom","left","right"],e=b.effects.setMode(f,c.options.mode||"show"),a=c.options.direction||"left";b.effects.save(f,g);f.show();b.effects.createWrapper(f).css({overflow:"hidden"});var d=a=="up"||a=="down"?"top":"left";a=a=="up"||a=="left"?"pos":"neg";var h=c.options.distance||(d=="top"?f.outerHeight({margin:true}):f.outerWidth({margin:true}));if(e=="show")f.css(d,a=="pos"?isNaN(h)?"-"+h:-h:h);
var i={};i[d]=(e=="show"?a=="pos"?"+=":"-=":a=="pos"?"-=":"+=")+h;f.animate(i,{queue:false,duration:c.duration,easing:c.options.easing,complete:function(){e=="hide"&&f.hide();b.effects.restore(f,g);b.effects.removeWrapper(f);c.callback&&c.callback.apply(this,arguments);f.dequeue()}})})}})(jQuery);
(function(b){b.effects.transfer=function(c){return this.queue(function(){var f=b(this),g=b(c.options.to),e=g.offset();g={top:e.top,left:e.left,height:g.innerHeight(),width:g.innerWidth()};e=f.offset();var a=b('<div class="ui-effects-transfer"></div>').appendTo(document.body).addClass(c.options.className).css({top:e.top,left:e.left,height:f.innerHeight(),width:f.innerWidth(),position:"absolute"}).animate(g,c.duration,c.options.easing,function(){a.remove();c.callback&&c.callback.apply(f[0],arguments);
f.dequeue()})})}})(jQuery);
(function(b){b.widget("ui.accordion",{options:{active:0,animated:"slide",autoHeight:true,clearStyle:false,collapsible:false,event:"click",fillSpace:false,header:"> li > :first-child,> :not(li):even",icons:{header:"ui-icon-triangle-1-e",headerSelected:"ui-icon-triangle-1-s"},navigation:false,navigationFilter:function(){return this.href.toLowerCase()===location.href.toLowerCase()}},_create:function(){var c=this,f=c.options;c.running=0;c.element.addClass("ui-accordion ui-widget ui-helper-reset").children("li").addClass("ui-accordion-li-fix");c.headers=
c.element.find(f.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all").bind("mouseenter.accordion",function(){f.disabled||b(this).addClass("ui-state-hover")}).bind("mouseleave.accordion",function(){f.disabled||b(this).removeClass("ui-state-hover")}).bind("focus.accordion",function(){f.disabled||b(this).addClass("ui-state-focus")}).bind("blur.accordion",function(){f.disabled||b(this).removeClass("ui-state-focus")});c.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom");
if(f.navigation){var g=c.element.find("a").filter(f.navigationFilter).eq(0);if(g.length){var e=g.closest(".ui-accordion-header");c.active=e.length?e:g.closest(".ui-accordion-content").prev()}}c.active=c._findActive(c.active||f.active).addClass("ui-state-default ui-state-active").toggleClass("ui-corner-all").toggleClass("ui-corner-top");c.active.next().addClass("ui-accordion-content-active");c._createIcons();c.resize();c.element.attr("role","tablist");c.headers.attr("role","tab").bind("keydown.accordion",
function(a){return c._keydown(a)}).next().attr("role","tabpanel");c.headers.not(c.active||"").attr({"aria-expanded":"false",tabIndex:-1}).next().hide();c.active.length?c.active.attr({"aria-expanded":"true",tabIndex:0}):c.headers.eq(0).attr("tabIndex",0);b.browser.safari||c.headers.find("a").attr("tabIndex",-1);f.event&&c.headers.bind(f.event.split(" ").join(".accordion ")+".accordion",function(a){c._clickHandler.call(c,a,this);a.preventDefault()})},_createIcons:function(){var c=this.options;if(c.icons){b("<span></span>").addClass("ui-icon "+
c.icons.header).prependTo(this.headers);this.active.children(".ui-icon").toggleClass(c.icons.header).toggleClass(c.icons.headerSelected);this.element.addClass("ui-accordion-icons")}},_destroyIcons:function(){this.headers.children(".ui-icon").remove();this.element.removeClass("ui-accordion-icons")},destroy:function(){var c=this.options;this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role");this.headers.unbind(".accordion").removeClass("ui-accordion-header ui-accordion-disabled ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("tabIndex");
this.headers.find("a").removeAttr("tabIndex");this._destroyIcons();var f=this.headers.next().css("display","").removeAttr("role").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-accordion-disabled ui-state-disabled");if(c.autoHeight||c.fillHeight)f.css("height","");return b.Widget.prototype.destroy.call(this)},_setOption:function(c,f){b.Widget.prototype._setOption.apply(this,arguments);c=="active"&&this.activate(f);if(c=="icons"){this._destroyIcons();
f&&this._createIcons()}if(c=="disabled")this.headers.add(this.headers.next())[f?"addClass":"removeClass"]("ui-accordion-disabled ui-state-disabled")},_keydown:function(c){if(!(this.options.disabled||c.altKey||c.ctrlKey)){var f=b.ui.keyCode,g=this.headers.length,e=this.headers.index(c.target),a=false;switch(c.keyCode){case f.RIGHT:case f.DOWN:a=this.headers[(e+1)%g];break;case f.LEFT:case f.UP:a=this.headers[(e-1+g)%g];break;case f.SPACE:case f.ENTER:this._clickHandler({target:c.target},c.target);
c.preventDefault()}if(a){b(c.target).attr("tabIndex",-1);b(a).attr("tabIndex",0);a.focus();return false}return true}},resize:function(){var c=this.options,f;if(c.fillSpace){if(b.browser.msie){var g=this.element.parent().css("overflow");this.element.parent().css("overflow","hidden")}f=this.element.parent().height();b.browser.msie&&this.element.parent().css("overflow",g);this.headers.each(function(){f-=b(this).outerHeight(true)});this.headers.next().each(function(){b(this).height(Math.max(0,f-b(this).innerHeight()+
b(this).height()))}).css("overflow","auto")}else if(c.autoHeight){f=0;this.headers.next().each(function(){f=Math.max(f,b(this).height("").height())}).height(f)}return this},activate:function(c){this.options.active=c;c=this._findActive(c)[0];this._clickHandler({target:c},c);return this},_findActive:function(c){return c?typeof c==="number"?this.headers.filter(":eq("+c+")"):this.headers.not(this.headers.not(c)):c===false?b([]):this.headers.filter(":eq(0)")},_clickHandler:function(c,f){var g=this.options;
if(!g.disabled)if(c.target){c=b(c.currentTarget||f);f=c[0]===this.active[0];g.active=g.collapsible&&f?false:this.headers.index(c);if(!(this.running||!g.collapsible&&f)){var e=this.active;i=c.next();d=this.active.next();h={options:g,newHeader:f&&g.collapsible?b([]):c,oldHeader:this.active,newContent:f&&g.collapsible?b([]):i,oldContent:d};var a=this.headers.index(this.active[0])>this.headers.index(c[0]);this.active=f?b([]):c;this._toggle(i,d,h,f,a);e.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(g.icons.headerSelected).addClass(g.icons.header);
if(!f){c.removeClass("ui-state-default ui-corner-all").addClass("ui-state-active ui-corner-top").children(".ui-icon").removeClass(g.icons.header).addClass(g.icons.headerSelected);c.next().addClass("ui-accordion-content-active")}}}else if(g.collapsible){this.active.removeClass("ui-state-active ui-corner-top").addClass("ui-state-default ui-corner-all").children(".ui-icon").removeClass(g.icons.headerSelected).addClass(g.icons.header);this.active.next().addClass("ui-accordion-content-active");var d=this.active.next(),
h={options:g,newHeader:b([]),oldHeader:g.active,newContent:b([]),oldContent:d},i=this.active=b([]);this._toggle(i,d,h)}},_toggle:function(c,f,g,e,a){var d=this,h=d.options;d.toShow=c;d.toHide=f;d.data=g;var i=function(){if(d)return d._completed.apply(d,arguments)};d._trigger("changestart",null,d.data);d.running=f.size()===0?c.size():f.size();if(h.animated){g={};g=h.collapsible&&e?{toShow:b([]),toHide:f,complete:i,down:a,autoHeight:h.autoHeight||h.fillSpace}:{toShow:c,toHide:f,complete:i,down:a,autoHeight:h.autoHeight||
h.fillSpace};if(!h.proxied)h.proxied=h.animated;if(!h.proxiedDuration)h.proxiedDuration=h.duration;h.animated=b.isFunction(h.proxied)?h.proxied(g):h.proxied;h.duration=b.isFunction(h.proxiedDuration)?h.proxiedDuration(g):h.proxiedDuration;e=b.ui.accordion.animations;var j=h.duration,n=h.animated;if(n&&!e[n]&&!b.easing[n])n="slide";e[n]||(e[n]=function(q){this.slide(q,{easing:n,duration:j||700})});e[n](g)}else{if(h.collapsible&&e)c.toggle();else{f.hide();c.show()}i(true)}f.prev().attr({"aria-expanded":"false",
tabIndex:-1}).blur();c.prev().attr({"aria-expanded":"true",tabIndex:0}).focus()},_completed:function(c){this.running=c?0:--this.running;if(!this.running){this.options.clearStyle&&this.toShow.add(this.toHide).css({height:"",overflow:""});this.toHide.removeClass("ui-accordion-content-active");if(this.toHide.length)this.toHide.parent()[0].className=this.toHide.parent()[0].className;this._trigger("change",null,this.data)}}});b.extend(b.ui.accordion,{version:"1.8.9",animations:{slide:function(c,f){c=
b.extend({easing:"swing",duration:300},c,f);if(c.toHide.size())if(c.toShow.size()){var g=c.toShow.css("overflow"),e=0,a={},d={},h;f=c.toShow;h=f[0].style.width;f.width(parseInt(f.parent().width(),10)-parseInt(f.css("paddingLeft"),10)-parseInt(f.css("paddingRight"),10)-(parseInt(f.css("borderLeftWidth"),10)||0)-(parseInt(f.css("borderRightWidth"),10)||0));b.each(["height","paddingTop","paddingBottom"],function(i,j){d[j]="hide";i=(""+b.css(c.toShow[0],j)).match(/^([\d+-.]+)(.*)$/);a[j]={value:i[1],
unit:i[2]||"px"}});c.toShow.css({height:0,overflow:"hidden"}).show();c.toHide.filter(":hidden").each(c.complete).end().filter(":visible").animate(d,{step:function(i,j){if(j.prop=="height")e=j.end-j.start===0?0:(j.now-j.start)/(j.end-j.start);c.toShow[0].style[j.prop]=e*a[j.prop].value+a[j.prop].unit},duration:c.duration,easing:c.easing,complete:function(){c.autoHeight||c.toShow.css("height","");c.toShow.css({width:h,overflow:g});c.complete()}})}else c.toHide.animate({height:"hide",paddingTop:"hide",
paddingBottom:"hide"},c);else c.toShow.animate({height:"show",paddingTop:"show",paddingBottom:"show"},c)},bounceslide:function(c){this.slide(c,{easing:c.down?"easeOutBounce":"swing",duration:c.down?1E3:200})}}})})(jQuery);
(function(b){b.widget("ui.autocomplete",{options:{appendTo:"body",delay:300,minLength:1,position:{my:"left top",at:"left bottom",collision:"none"},source:null},pending:0,_create:function(){var c=this,f=this.element[0].ownerDocument,g;this.element.addClass("ui-autocomplete-input").attr("autocomplete","off").attr({role:"textbox","aria-autocomplete":"list","aria-haspopup":"true"}).bind("keydown.autocomplete",function(e){if(!(c.options.disabled||c.element.attr("readonly"))){g=false;var a=b.ui.keyCode;
switch(e.keyCode){case a.PAGE_UP:c._move("previousPage",e);break;case a.PAGE_DOWN:c._move("nextPage",e);break;case a.UP:c._move("previous",e);e.preventDefault();break;case a.DOWN:c._move("next",e);e.preventDefault();break;case a.ENTER:case a.NUMPAD_ENTER:if(c.menu.active){g=true;e.preventDefault()}case a.TAB:if(!c.menu.active)return;c.menu.select(e);break;case a.ESCAPE:c.element.val(c.term);c.close(e);break;default:clearTimeout(c.searching);c.searching=setTimeout(function(){if(c.term!=c.element.val()){c.selectedItem=
null;c.search(null,e)}},c.options.delay);break}}}).bind("keypress.autocomplete",function(e){if(g){g=false;e.preventDefault()}}).bind("focus.autocomplete",function(){if(!c.options.disabled){c.selectedItem=null;c.previous=c.element.val()}}).bind("blur.autocomplete",function(e){if(!c.options.disabled){clearTimeout(c.searching);c.closing=setTimeout(function(){c.close(e);c._change(e)},150)}});this._initSource();this.response=function(){return c._response.apply(c,arguments)};this.menu=b("<ul></ul>").addClass("ui-autocomplete").appendTo(b(this.options.appendTo||
"body",f)[0]).mousedown(function(e){var a=c.menu.element[0];b(e.target).closest(".ui-menu-item").length||setTimeout(function(){b(document).one("mousedown",function(d){d.target!==c.element[0]&&d.target!==a&&!b.ui.contains(a,d.target)&&c.close()})},1);setTimeout(function(){clearTimeout(c.closing)},13)}).menu({focus:function(e,a){a=a.item.data("item.autocomplete");false!==c._trigger("focus",e,{item:a})&&/^key/.test(e.originalEvent.type)&&c.element.val(a.value)},selected:function(e,a){var d=a.item.data("item.autocomplete"),
h=c.previous;if(c.element[0]!==f.activeElement){c.element.focus();c.previous=h;setTimeout(function(){c.previous=h;c.selectedItem=d},1)}false!==c._trigger("select",e,{item:d})&&c.element.val(d.value);c.term=c.element.val();c.close(e);c.selectedItem=d},blur:function(){c.menu.element.is(":visible")&&c.element.val()!==c.term&&c.element.val(c.term)}}).zIndex(this.element.zIndex()+1).css({top:0,left:0}).hide().data("menu");b.fn.bgiframe&&this.menu.element.bgiframe()},destroy:function(){this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete").removeAttr("role").removeAttr("aria-autocomplete").removeAttr("aria-haspopup");
this.menu.element.remove();b.Widget.prototype.destroy.call(this)},_setOption:function(c,f){b.Widget.prototype._setOption.apply(this,arguments);c==="source"&&this._initSource();if(c==="appendTo")this.menu.element.appendTo(b(f||"body",this.element[0].ownerDocument)[0]);c==="disabled"&&f&&this.xhr&&this.xhr.abort()},_initSource:function(){var c=this,f,g;if(b.isArray(this.options.source)){f=this.options.source;this.source=function(e,a){a(b.ui.autocomplete.filter(f,e.term))}}else if(typeof this.options.source===
"string"){g=this.options.source;this.source=function(e,a){c.xhr&&c.xhr.abort();c.xhr=b.ajax({url:g,data:e,dataType:"json",success:function(d,h,i){i===c.xhr&&a(d);c.xhr=null},error:function(d){d===c.xhr&&a([]);c.xhr=null}})}}else this.source=this.options.source},search:function(c,f){c=c!=null?c:this.element.val();this.term=this.element.val();if(c.length<this.options.minLength)return this.close(f);clearTimeout(this.closing);if(this._trigger("search",f)!==false)return this._search(c)},_search:function(c){this.pending++;
this.element.addClass("ui-autocomplete-loading");this.source({term:c},this.response)},_response:function(c){if(!this.options.disabled&&c&&c.length){c=this._normalize(c);this._suggest(c);this._trigger("open")}else this.close();this.pending--;this.pending||this.element.removeClass("ui-autocomplete-loading")},close:function(c){clearTimeout(this.closing);if(this.menu.element.is(":visible")){this.menu.element.hide();this.menu.deactivate();this._trigger("close",c)}},_change:function(c){this.previous!==
this.element.val()&&this._trigger("change",c,{item:this.selectedItem})},_normalize:function(c){if(c.length&&c[0].label&&c[0].value)return c;return b.map(c,function(f){if(typeof f==="string")return{label:f,value:f};return b.extend({label:f.label||f.value,value:f.value||f.label},f)})},_suggest:function(c){var f=this.menu.element.empty().zIndex(this.element.zIndex()+1);this._renderMenu(f,c);this.menu.deactivate();this.menu.refresh();f.show();this._resizeMenu();f.position(b.extend({of:this.element},this.options.position))},
_resizeMenu:function(){var c=this.menu.element;c.outerWidth(Math.max(c.width("").outerWidth(),this.element.outerWidth()))},_renderMenu:function(c,f){var g=this;b.each(f,function(e,a){g._renderItem(c,a)})},_renderItem:function(c,f){return b("<li></li>").data("item.autocomplete",f).append(b("<a></a>").text(f.label)).appendTo(c)},_move:function(c,f){if(this.menu.element.is(":visible"))if(this.menu.first()&&/^previous/.test(c)||this.menu.last()&&/^next/.test(c)){this.element.val(this.term);this.menu.deactivate()}else this.menu[c](f);
else this.search(null,f)},widget:function(){return this.menu.element}});b.extend(b.ui.autocomplete,{escapeRegex:function(c){return c.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")},filter:function(c,f){var g=new RegExp(b.ui.autocomplete.escapeRegex(f),"i");return b.grep(c,function(e){return g.test(e.label||e.value||e)})}})})(jQuery);
(function(b){b.widget("ui.menu",{_create:function(){var c=this;this.element.addClass("ui-menu ui-widget ui-widget-content ui-corner-all").attr({role:"listbox","aria-activedescendant":"ui-active-menuitem"}).click(function(f){if(b(f.target).closest(".ui-menu-item a").length){f.preventDefault();c.select(f)}});this.refresh()},refresh:function(){var c=this;this.element.children("li:not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role","menuitem").children("a").addClass("ui-corner-all").attr("tabindex",
-1).mouseenter(function(f){c.activate(f,b(this).parent())}).mouseleave(function(){c.deactivate()})},activate:function(c,f){this.deactivate();if(this.hasScroll()){var g=f.offset().top-this.element.offset().top,e=this.element.attr("scrollTop"),a=this.element.height();if(g<0)this.element.attr("scrollTop",e+g);else g>=a&&this.element.attr("scrollTop",e+g-a+f.height())}this.active=f.eq(0).children("a").addClass("ui-state-hover").attr("id","ui-active-menuitem").end();this._trigger("focus",c,{item:f})},
deactivate:function(){if(this.active){this.active.children("a").removeClass("ui-state-hover").removeAttr("id");this._trigger("blur");this.active=null}},next:function(c){this.move("next",".ui-menu-item:first",c)},previous:function(c){this.move("prev",".ui-menu-item:last",c)},first:function(){return this.active&&!this.active.prevAll(".ui-menu-item").length},last:function(){return this.active&&!this.active.nextAll(".ui-menu-item").length},move:function(c,f,g){if(this.active){c=this.active[c+"All"](".ui-menu-item").eq(0);
c.length?this.activate(g,c):this.activate(g,this.element.children(f))}else this.activate(g,this.element.children(f))},nextPage:function(c){if(this.hasScroll())if(!this.active||this.last())this.activate(c,this.element.children(".ui-menu-item:first"));else{var f=this.active.offset().top,g=this.element.height(),e=this.element.children(".ui-menu-item").filter(function(){var a=b(this).offset().top-f-g+b(this).height();return a<10&&a>-10});e.length||(e=this.element.children(".ui-menu-item:last"));this.activate(c,
e)}else this.activate(c,this.element.children(".ui-menu-item").filter(!this.active||this.last()?":first":":last"))},previousPage:function(c){if(this.hasScroll())if(!this.active||this.first())this.activate(c,this.element.children(".ui-menu-item:last"));else{var f=this.active.offset().top,g=this.element.height();result=this.element.children(".ui-menu-item").filter(function(){var e=b(this).offset().top-f+g-b(this).height();return e<10&&e>-10});result.length||(result=this.element.children(".ui-menu-item:first"));
this.activate(c,result)}else this.activate(c,this.element.children(".ui-menu-item").filter(!this.active||this.first()?":last":":first"))},hasScroll:function(){return this.element.height()<this.element.attr("scrollHeight")},select:function(c){this._trigger("selected",c,{item:this.active})}})})(jQuery);
(function(b){var c,f=function(e){b(":ui-button",e.target.form).each(function(){var a=b(this).data("button");setTimeout(function(){a.refresh()},1)})},g=function(e){var a=e.name,d=e.form,h=b([]);if(a)h=d?b(d).find("[name='"+a+"']"):b("[name='"+a+"']",e.ownerDocument).filter(function(){return!this.form});return h};b.widget("ui.button",{options:{disabled:null,text:true,label:null,icons:{primary:null,secondary:null}},_create:function(){this.element.closest("form").unbind("reset.button").bind("reset.button",
f);if(typeof this.options.disabled!=="boolean")this.options.disabled=this.element.attr("disabled");this._determineButtonType();this.hasTitle=!!this.buttonElement.attr("title");var e=this,a=this.options,d=this.type==="checkbox"||this.type==="radio",h="ui-state-hover"+(!d?" ui-state-active":"");if(a.label===null)a.label=this.buttonElement.html();if(this.element.is(":disabled"))a.disabled=true;this.buttonElement.addClass("ui-button ui-widget ui-state-default ui-corner-all").attr("role","button").bind("mouseenter.button",
function(){if(!a.disabled){b(this).addClass("ui-state-hover");this===c&&b(this).addClass("ui-state-active")}}).bind("mouseleave.button",function(){a.disabled||b(this).removeClass(h)}).bind("focus.button",function(){b(this).addClass("ui-state-focus")}).bind("blur.button",function(){b(this).removeClass("ui-state-focus")});d&&this.element.bind("change.button",function(){e.refresh()});if(this.type==="checkbox")this.buttonElement.bind("click.button",function(){if(a.disabled)return false;b(this).toggleClass("ui-state-active");
e.buttonElement.attr("aria-pressed",e.element[0].checked)});else if(this.type==="radio")this.buttonElement.bind("click.button",function(){if(a.disabled)return false;b(this).addClass("ui-state-active");e.buttonElement.attr("aria-pressed",true);var i=e.element[0];g(i).not(i).map(function(){return b(this).button("widget")[0]}).removeClass("ui-state-active").attr("aria-pressed",false)});else{this.buttonElement.bind("mousedown.button",function(){if(a.disabled)return false;b(this).addClass("ui-state-active");
c=this;b(document).one("mouseup",function(){c=null})}).bind("mouseup.button",function(){if(a.disabled)return false;b(this).removeClass("ui-state-active")}).bind("keydown.button",function(i){if(a.disabled)return false;if(i.keyCode==b.ui.keyCode.SPACE||i.keyCode==b.ui.keyCode.ENTER)b(this).addClass("ui-state-active")}).bind("keyup.button",function(){b(this).removeClass("ui-state-active")});this.buttonElement.is("a")&&this.buttonElement.keyup(function(i){i.keyCode===b.ui.keyCode.SPACE&&b(this).click()})}this._setOption("disabled",
a.disabled)},_determineButtonType:function(){this.type=this.element.is(":checkbox")?"checkbox":this.element.is(":radio")?"radio":this.element.is("input")?"input":"button";if(this.type==="checkbox"||this.type==="radio"){this.buttonElement=this.element.parents().last().find("label[for="+this.element.attr("id")+"]");this.element.addClass("ui-helper-hidden-accessible");var e=this.element.is(":checked");e&&this.buttonElement.addClass("ui-state-active");this.buttonElement.attr("aria-pressed",e)}else this.buttonElement=
this.element},widget:function(){return this.buttonElement},destroy:function(){this.element.removeClass("ui-helper-hidden-accessible");this.buttonElement.removeClass("ui-button ui-widget ui-state-default ui-corner-all ui-state-hover ui-state-active  ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only").removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html());this.hasTitle||
this.buttonElement.removeAttr("title");b.Widget.prototype.destroy.call(this)},_setOption:function(e,a){b.Widget.prototype._setOption.apply(this,arguments);if(e==="disabled")a?this.element.attr("disabled",true):this.element.removeAttr("disabled");this._resetButton()},refresh:function(){var e=this.element.is(":disabled");e!==this.options.disabled&&this._setOption("disabled",e);if(this.type==="radio")g(this.element[0]).each(function(){b(this).is(":checked")?b(this).button("widget").addClass("ui-state-active").attr("aria-pressed",
true):b(this).button("widget").removeClass("ui-state-active").attr("aria-pressed",false)});else if(this.type==="checkbox")this.element.is(":checked")?this.buttonElement.addClass("ui-state-active").attr("aria-pressed",true):this.buttonElement.removeClass("ui-state-active").attr("aria-pressed",false)},_resetButton:function(){if(this.type==="input")this.options.label&&this.element.val(this.options.label);else{var e=this.buttonElement.removeClass("ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only"),
a=b("<span></span>").addClass("ui-button-text").html(this.options.label).appendTo(e.empty()).text(),d=this.options.icons,h=d.primary&&d.secondary;if(d.primary||d.secondary){e.addClass("ui-button-text-icon"+(h?"s":d.primary?"-primary":"-secondary"));d.primary&&e.prepend("<span class='ui-button-icon-primary ui-icon "+d.primary+"'></span>");d.secondary&&e.append("<span class='ui-button-icon-secondary ui-icon "+d.secondary+"'></span>");if(!this.options.text){e.addClass(h?"ui-button-icons-only":"ui-button-icon-only").removeClass("ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary");
this.hasTitle||e.attr("title",a)}}else e.addClass("ui-button-text-only")}}});b.widget("ui.buttonset",{options:{items:":button, :submit, :reset, :checkbox, :radio, a, :data(button)"},_create:function(){this.element.addClass("ui-buttonset")},_init:function(){this.refresh()},_setOption:function(e,a){e==="disabled"&&this.buttons.button("option",e,a);b.Widget.prototype._setOption.apply(this,arguments)},refresh:function(){this.buttons=this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function(){return b(this).button("widget")[0]}).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass("ui-corner-left").end().filter(":last").addClass("ui-corner-right").end().end()},
destroy:function(){this.element.removeClass("ui-buttonset");this.buttons.map(function(){return b(this).button("widget")[0]}).removeClass("ui-corner-left ui-corner-right").end().button("destroy");b.Widget.prototype.destroy.call(this)}})})(jQuery);
(function(b,c){function f(){this.debug=false;this._curInst=null;this._keyEvent=false;this._disabledInputs=[];this._inDialog=this._datepickerShowing=false;this._mainDivId="ui-datepicker-div";this._inlineClass="ui-datepicker-inline";this._appendClass="ui-datepicker-append";this._triggerClass="ui-datepicker-trigger";this._dialogClass="ui-datepicker-dialog";this._disableClass="ui-datepicker-disabled";this._unselectableClass="ui-datepicker-unselectable";this._currentClass="ui-datepicker-current-day";this._dayOverClass=
"ui-datepicker-days-cell-over";this.regional=[];this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su",
"Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:false,showMonthAfterYear:false,yearSuffix:""};this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:false,hideIfNoPrevNext:false,navigationAsDateFormat:false,gotoCurrent:false,changeMonth:false,changeYear:false,yearRange:"c-10:c+10",showOtherMonths:false,selectOtherMonths:false,showWeek:false,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",
minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:true,showButtonPanel:false,autoSize:false};b.extend(this._defaults,this.regional[""]);this.dpDiv=b('<div id="'+this._mainDivId+'" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>')}function g(a,d){b.extend(a,d);for(var h in d)if(d[h]==
null||d[h]==c)a[h]=d[h];return a}b.extend(b.ui,{datepicker:{version:"1.8.9"}});var e=(new Date).getTime();b.extend(f.prototype,{markerClassName:"hasDatepicker",log:function(){this.debug&&console.log.apply("",arguments)},_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(a){g(this._defaults,a||{});return this},_attachDatepicker:function(a,d){var h=null;for(var i in this._defaults){var j=a.getAttribute("date:"+i);if(j){h=h||{};try{h[i]=eval(j)}catch(n){h[i]=j}}}i=a.nodeName.toLowerCase();
j=i=="div"||i=="span";if(!a.id){this.uuid+=1;a.id="dp"+this.uuid}var q=this._newInst(b(a),j);q.settings=b.extend({},d||{},h||{});if(i=="input")this._connectDatepicker(a,q);else j&&this._inlineDatepicker(a,q)},_newInst:function(a,d){return{id:a[0].id.replace(/([^A-Za-z0-9_-])/g,"\\\\$1"),input:a,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:d,dpDiv:!d?this.dpDiv:b('<div class="'+this._inlineClass+' ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>')}},
_connectDatepicker:function(a,d){var h=b(a);d.append=b([]);d.trigger=b([]);if(!h.hasClass(this.markerClassName)){this._attachments(h,d);h.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp).bind("setData.datepicker",function(i,j,n){d.settings[j]=n}).bind("getData.datepicker",function(i,j){return this._get(d,j)});this._autoSize(d);b.data(a,"datepicker",d)}},_attachments:function(a,d){var h=this._get(d,"appendText"),i=this._get(d,"isRTL");d.append&&
d.append.remove();if(h){d.append=b('<span class="'+this._appendClass+'">'+h+"</span>");a[i?"before":"after"](d.append)}a.unbind("focus",this._showDatepicker);d.trigger&&d.trigger.remove();h=this._get(d,"showOn");if(h=="focus"||h=="both")a.focus(this._showDatepicker);if(h=="button"||h=="both"){h=this._get(d,"buttonText");var j=this._get(d,"buttonImage");d.trigger=b(this._get(d,"buttonImageOnly")?b("<img/>").addClass(this._triggerClass).attr({src:j,alt:h,title:h}):b('<button type="button"></button>').addClass(this._triggerClass).html(j==
""?h:b("<img/>").attr({src:j,alt:h,title:h})));a[i?"before":"after"](d.trigger);d.trigger.click(function(){b.datepicker._datepickerShowing&&b.datepicker._lastInput==a[0]?b.datepicker._hideDatepicker():b.datepicker._showDatepicker(a[0]);return false})}},_autoSize:function(a){if(this._get(a,"autoSize")&&!a.inline){var d=new Date(2009,11,20),h=this._get(a,"dateFormat");if(h.match(/[DM]/)){var i=function(j){for(var n=0,q=0,l=0;l<j.length;l++)if(j[l].length>n){n=j[l].length;q=l}return q};d.setMonth(i(this._get(a,
h.match(/MM/)?"monthNames":"monthNamesShort")));d.setDate(i(this._get(a,h.match(/DD/)?"dayNames":"dayNamesShort"))+20-d.getDay())}a.input.attr("size",this._formatDate(a,d).length)}},_inlineDatepicker:function(a,d){var h=b(a);if(!h.hasClass(this.markerClassName)){h.addClass(this.markerClassName).append(d.dpDiv).bind("setData.datepicker",function(i,j,n){d.settings[j]=n}).bind("getData.datepicker",function(i,j){return this._get(d,j)});b.data(a,"datepicker",d);this._setDate(d,this._getDefaultDate(d),
true);this._updateDatepicker(d);this._updateAlternate(d);d.dpDiv.show()}},_dialogDatepicker:function(a,d,h,i,j){a=this._dialogInst;if(!a){this.uuid+=1;this._dialogInput=b('<input type="text" id="'+("dp"+this.uuid)+'" style="position: absolute; top: -100px; width: 0px; z-index: -10;"/>');this._dialogInput.keydown(this._doKeyDown);b("body").append(this._dialogInput);a=this._dialogInst=this._newInst(this._dialogInput,false);a.settings={};b.data(this._dialogInput[0],"datepicker",a)}g(a.settings,i||{});
d=d&&d.constructor==Date?this._formatDate(a,d):d;this._dialogInput.val(d);this._pos=j?j.length?j:[j.pageX,j.pageY]:null;if(!this._pos)this._pos=[document.documentElement.clientWidth/2-100+(document.documentElement.scrollLeft||document.body.scrollLeft),document.documentElement.clientHeight/2-150+(document.documentElement.scrollTop||document.body.scrollTop)];this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px");a.settings.onSelect=h;this._inDialog=true;this.dpDiv.addClass(this._dialogClass);
this._showDatepicker(this._dialogInput[0]);b.blockUI&&b.blockUI(this.dpDiv);b.data(this._dialogInput[0],"datepicker",a);return this},_destroyDatepicker:function(a){var d=b(a),h=b.data(a,"datepicker");if(d.hasClass(this.markerClassName)){var i=a.nodeName.toLowerCase();b.removeData(a,"datepicker");if(i=="input"){h.append.remove();h.trigger.remove();d.removeClass(this.markerClassName).unbind("focus",this._showDatepicker).unbind("keydown",this._doKeyDown).unbind("keypress",this._doKeyPress).unbind("keyup",
this._doKeyUp)}else if(i=="div"||i=="span")d.removeClass(this.markerClassName).empty()}},_enableDatepicker:function(a){var d=b(a),h=b.data(a,"datepicker");if(d.hasClass(this.markerClassName)){var i=a.nodeName.toLowerCase();if(i=="input"){a.disabled=false;h.trigger.filter("button").each(function(){this.disabled=false}).end().filter("img").css({opacity:"1.0",cursor:""})}else if(i=="div"||i=="span")d.children("."+this._inlineClass).children().removeClass("ui-state-disabled");this._disabledInputs=b.map(this._disabledInputs,
function(j){return j==a?null:j})}},_disableDatepicker:function(a){var d=b(a),h=b.data(a,"datepicker");if(d.hasClass(this.markerClassName)){var i=a.nodeName.toLowerCase();if(i=="input"){a.disabled=true;h.trigger.filter("button").each(function(){this.disabled=true}).end().filter("img").css({opacity:"0.5",cursor:"default"})}else if(i=="div"||i=="span")d.children("."+this._inlineClass).children().addClass("ui-state-disabled");this._disabledInputs=b.map(this._disabledInputs,function(j){return j==a?null:
j});this._disabledInputs[this._disabledInputs.length]=a}},_isDisabledDatepicker:function(a){if(!a)return false;for(var d=0;d<this._disabledInputs.length;d++)if(this._disabledInputs[d]==a)return true;return false},_getInst:function(a){try{return b.data(a,"datepicker")}catch(d){throw"Missing instance data for this datepicker";}},_optionDatepicker:function(a,d,h){var i=this._getInst(a);if(arguments.length==2&&typeof d=="string")return d=="defaults"?b.extend({},b.datepicker._defaults):i?d=="all"?b.extend({},
i.settings):this._get(i,d):null;var j=d||{};if(typeof d=="string"){j={};j[d]=h}if(i){this._curInst==i&&this._hideDatepicker();var n=this._getDateDatepicker(a,true);g(i.settings,j);this._attachments(b(a),i);this._autoSize(i);this._setDateDatepicker(a,n);this._updateDatepicker(i)}},_changeDatepicker:function(a,d,h){this._optionDatepicker(a,d,h)},_refreshDatepicker:function(a){(a=this._getInst(a))&&this._updateDatepicker(a)},_setDateDatepicker:function(a,d){if(a=this._getInst(a)){this._setDate(a,d);
this._updateDatepicker(a);this._updateAlternate(a)}},_getDateDatepicker:function(a,d){(a=this._getInst(a))&&!a.inline&&this._setDateFromField(a,d);return a?this._getDate(a):null},_doKeyDown:function(a){var d=b.datepicker._getInst(a.target),h=true,i=d.dpDiv.is(".ui-datepicker-rtl");d._keyEvent=true;if(b.datepicker._datepickerShowing)switch(a.keyCode){case 9:b.datepicker._hideDatepicker();h=false;break;case 13:h=b("td."+b.datepicker._dayOverClass+":not(."+b.datepicker._currentClass+")",d.dpDiv);h[0]?
b.datepicker._selectDay(a.target,d.selectedMonth,d.selectedYear,h[0]):b.datepicker._hideDatepicker();return false;case 27:b.datepicker._hideDatepicker();break;case 33:b.datepicker._adjustDate(a.target,a.ctrlKey?-b.datepicker._get(d,"stepBigMonths"):-b.datepicker._get(d,"stepMonths"),"M");break;case 34:b.datepicker._adjustDate(a.target,a.ctrlKey?+b.datepicker._get(d,"stepBigMonths"):+b.datepicker._get(d,"stepMonths"),"M");break;case 35:if(a.ctrlKey||a.metaKey)b.datepicker._clearDate(a.target);h=a.ctrlKey||
a.metaKey;break;case 36:if(a.ctrlKey||a.metaKey)b.datepicker._gotoToday(a.target);h=a.ctrlKey||a.metaKey;break;case 37:if(a.ctrlKey||a.metaKey)b.datepicker._adjustDate(a.target,i?+1:-1,"D");h=a.ctrlKey||a.metaKey;if(a.originalEvent.altKey)b.datepicker._adjustDate(a.target,a.ctrlKey?-b.datepicker._get(d,"stepBigMonths"):-b.datepicker._get(d,"stepMonths"),"M");break;case 38:if(a.ctrlKey||a.metaKey)b.datepicker._adjustDate(a.target,-7,"D");h=a.ctrlKey||a.metaKey;break;case 39:if(a.ctrlKey||a.metaKey)b.datepicker._adjustDate(a.target,
i?-1:+1,"D");h=a.ctrlKey||a.metaKey;if(a.originalEvent.altKey)b.datepicker._adjustDate(a.target,a.ctrlKey?+b.datepicker._get(d,"stepBigMonths"):+b.datepicker._get(d,"stepMonths"),"M");break;case 40:if(a.ctrlKey||a.metaKey)b.datepicker._adjustDate(a.target,+7,"D");h=a.ctrlKey||a.metaKey;break;default:h=false}else if(a.keyCode==36&&a.ctrlKey)b.datepicker._showDatepicker(this);else h=false;if(h){a.preventDefault();a.stopPropagation()}},_doKeyPress:function(a){var d=b.datepicker._getInst(a.target);if(b.datepicker._get(d,
"constrainInput")){d=b.datepicker._possibleChars(b.datepicker._get(d,"dateFormat"));var h=String.fromCharCode(a.charCode==c?a.keyCode:a.charCode);return a.ctrlKey||a.metaKey||h<" "||!d||d.indexOf(h)>-1}},_doKeyUp:function(a){a=b.datepicker._getInst(a.target);if(a.input.val()!=a.lastVal)try{if(b.datepicker.parseDate(b.datepicker._get(a,"dateFormat"),a.input?a.input.val():null,b.datepicker._getFormatConfig(a))){b.datepicker._setDateFromField(a);b.datepicker._updateAlternate(a);b.datepicker._updateDatepicker(a)}}catch(d){b.datepicker.log(d)}return true},
_showDatepicker:function(a){a=a.target||a;if(a.nodeName.toLowerCase()!="input")a=b("input",a.parentNode)[0];if(!(b.datepicker._isDisabledDatepicker(a)||b.datepicker._lastInput==a)){var d=b.datepicker._getInst(a);b.datepicker._curInst&&b.datepicker._curInst!=d&&b.datepicker._curInst.dpDiv.stop(true,true);var h=b.datepicker._get(d,"beforeShow");g(d.settings,h?h.apply(a,[a,d]):{});d.lastVal=null;b.datepicker._lastInput=a;b.datepicker._setDateFromField(d);if(b.datepicker._inDialog)a.value="";if(!b.datepicker._pos){b.datepicker._pos=
b.datepicker._findPos(a);b.datepicker._pos[1]+=a.offsetHeight}var i=false;b(a).parents().each(function(){i|=b(this).css("position")=="fixed";return!i});if(i&&b.browser.opera){b.datepicker._pos[0]-=document.documentElement.scrollLeft;b.datepicker._pos[1]-=document.documentElement.scrollTop}h={left:b.datepicker._pos[0],top:b.datepicker._pos[1]};b.datepicker._pos=null;d.dpDiv.empty();d.dpDiv.css({position:"absolute",display:"block",top:"-1000px"});b.datepicker._updateDatepicker(d);h=b.datepicker._checkOffset(d,
h,i);d.dpDiv.css({position:b.datepicker._inDialog&&b.blockUI?"static":i?"fixed":"absolute",display:"none",left:h.left+"px",top:h.top+"px"});if(!d.inline){h=b.datepicker._get(d,"showAnim");var j=b.datepicker._get(d,"duration"),n=function(){b.datepicker._datepickerShowing=true;var q=d.dpDiv.find("iframe.ui-datepicker-cover");if(q.length){var l=b.datepicker._getBorders(d.dpDiv);q.css({left:-l[0],top:-l[1],width:d.dpDiv.outerWidth(),height:d.dpDiv.outerHeight()})}};d.dpDiv.zIndex(b(a).zIndex()+1);b.effects&&
b.effects[h]?d.dpDiv.show(h,b.datepicker._get(d,"showOptions"),j,n):d.dpDiv[h||"show"](h?j:null,n);if(!h||!j)n();d.input.is(":visible")&&!d.input.is(":disabled")&&d.input.focus();b.datepicker._curInst=d}}},_updateDatepicker:function(a){var d=this,h=b.datepicker._getBorders(a.dpDiv);a.dpDiv.empty().append(this._generateHTML(a));var i=a.dpDiv.find("iframe.ui-datepicker-cover");i.length&&i.css({left:-h[0],top:-h[1],width:a.dpDiv.outerWidth(),height:a.dpDiv.outerHeight()});a.dpDiv.find("button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a").bind("mouseout",
function(){b(this).removeClass("ui-state-hover");this.className.indexOf("ui-datepicker-prev")!=-1&&b(this).removeClass("ui-datepicker-prev-hover");this.className.indexOf("ui-datepicker-next")!=-1&&b(this).removeClass("ui-datepicker-next-hover")}).bind("mouseover",function(){if(!d._isDisabledDatepicker(a.inline?a.dpDiv.parent()[0]:a.input[0])){b(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover");b(this).addClass("ui-state-hover");this.className.indexOf("ui-datepicker-prev")!=
-1&&b(this).addClass("ui-datepicker-prev-hover");this.className.indexOf("ui-datepicker-next")!=-1&&b(this).addClass("ui-datepicker-next-hover")}}).end().find("."+this._dayOverClass+" a").trigger("mouseover").end();h=this._getNumberOfMonths(a);i=h[1];i>1?a.dpDiv.addClass("ui-datepicker-multi-"+i).css("width",17*i+"em"):a.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width("");a.dpDiv[(h[0]!=1||h[1]!=1?"add":"remove")+"Class"]("ui-datepicker-multi");a.dpDiv[(this._get(a,
"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl");a==b.datepicker._curInst&&b.datepicker._datepickerShowing&&a.input&&a.input.is(":visible")&&!a.input.is(":disabled")&&a.input.focus();if(a.yearshtml){var j=a.yearshtml;setTimeout(function(){j===a.yearshtml&&a.dpDiv.find("select.ui-datepicker-year:first").replaceWith(a.yearshtml);j=a.yearshtml=null},0)}},_getBorders:function(a){var d=function(h){return{thin:1,medium:2,thick:3}[h]||h};return[parseFloat(d(a.css("border-left-width"))),parseFloat(d(a.css("border-top-width")))]},
_checkOffset:function(a,d,h){var i=a.dpDiv.outerWidth(),j=a.dpDiv.outerHeight(),n=a.input?a.input.outerWidth():0,q=a.input?a.input.outerHeight():0,l=document.documentElement.clientWidth+b(document).scrollLeft(),k=document.documentElement.clientHeight+b(document).scrollTop();d.left-=this._get(a,"isRTL")?i-n:0;d.left-=h&&d.left==a.input.offset().left?b(document).scrollLeft():0;d.top-=h&&d.top==a.input.offset().top+q?b(document).scrollTop():0;d.left-=Math.min(d.left,d.left+i>l&&l>i?Math.abs(d.left+i-
l):0);d.top-=Math.min(d.top,d.top+j>k&&k>j?Math.abs(j+q):0);return d},_findPos:function(a){for(var d=this._get(this._getInst(a),"isRTL");a&&(a.type=="hidden"||a.nodeType!=1);)a=a[d?"previousSibling":"nextSibling"];a=b(a).offset();return[a.left,a.top]},_hideDatepicker:function(a){var d=this._curInst;if(!(!d||a&&d!=b.data(a,"datepicker")))if(this._datepickerShowing){a=this._get(d,"showAnim");var h=this._get(d,"duration"),i=function(){b.datepicker._tidyDialog(d);this._curInst=null};b.effects&&b.effects[a]?
d.dpDiv.hide(a,b.datepicker._get(d,"showOptions"),h,i):d.dpDiv[a=="slideDown"?"slideUp":a=="fadeIn"?"fadeOut":"hide"](a?h:null,i);a||i();if(a=this._get(d,"onClose"))a.apply(d.input?d.input[0]:null,[d.input?d.input.val():"",d]);this._datepickerShowing=false;this._lastInput=null;if(this._inDialog){this._dialogInput.css({position:"absolute",left:"0",top:"-100px"});if(b.blockUI){b.unblockUI();b("body").append(this.dpDiv)}}this._inDialog=false}},_tidyDialog:function(a){a.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")},
_checkExternalClick:function(a){if(b.datepicker._curInst){a=b(a.target);a[0].id!=b.datepicker._mainDivId&&a.parents("#"+b.datepicker._mainDivId).length==0&&!a.hasClass(b.datepicker.markerClassName)&&!a.hasClass(b.datepicker._triggerClass)&&b.datepicker._datepickerShowing&&!(b.datepicker._inDialog&&b.blockUI)&&b.datepicker._hideDatepicker()}},_adjustDate:function(a,d,h){a=b(a);var i=this._getInst(a[0]);if(!this._isDisabledDatepicker(a[0])){this._adjustInstDate(i,d+(h=="M"?this._get(i,"showCurrentAtPos"):
0),h);this._updateDatepicker(i)}},_gotoToday:function(a){a=b(a);var d=this._getInst(a[0]);if(this._get(d,"gotoCurrent")&&d.currentDay){d.selectedDay=d.currentDay;d.drawMonth=d.selectedMonth=d.currentMonth;d.drawYear=d.selectedYear=d.currentYear}else{var h=new Date;d.selectedDay=h.getDate();d.drawMonth=d.selectedMonth=h.getMonth();d.drawYear=d.selectedYear=h.getFullYear()}this._notifyChange(d);this._adjustDate(a)},_selectMonthYear:function(a,d,h){a=b(a);var i=this._getInst(a[0]);i._selectingMonthYear=
false;i["selected"+(h=="M"?"Month":"Year")]=i["draw"+(h=="M"?"Month":"Year")]=parseInt(d.options[d.selectedIndex].value,10);this._notifyChange(i);this._adjustDate(a)},_clickMonthYear:function(a){var d=this._getInst(b(a)[0]);d.input&&d._selectingMonthYear&&setTimeout(function(){d.input.focus()},0);d._selectingMonthYear=!d._selectingMonthYear},_selectDay:function(a,d,h,i){var j=b(a);if(!(b(i).hasClass(this._unselectableClass)||this._isDisabledDatepicker(j[0]))){j=this._getInst(j[0]);j.selectedDay=j.currentDay=
b("a",i).html();j.selectedMonth=j.currentMonth=d;j.selectedYear=j.currentYear=h;this._selectDate(a,this._formatDate(j,j.currentDay,j.currentMonth,j.currentYear))}},_clearDate:function(a){a=b(a);this._getInst(a[0]);this._selectDate(a,"")},_selectDate:function(a,d){a=this._getInst(b(a)[0]);d=d!=null?d:this._formatDate(a);a.input&&a.input.val(d);this._updateAlternate(a);var h=this._get(a,"onSelect");if(h)h.apply(a.input?a.input[0]:null,[d,a]);else a.input&&a.input.trigger("change");if(a.inline)this._updateDatepicker(a);
else{this._hideDatepicker();this._lastInput=a.input[0];typeof a.input[0]!="object"&&a.input.focus();this._lastInput=null}},_updateAlternate:function(a){var d=this._get(a,"altField");if(d){var h=this._get(a,"altFormat")||this._get(a,"dateFormat"),i=this._getDate(a),j=this.formatDate(h,i,this._getFormatConfig(a));b(d).each(function(){b(this).val(j)})}},noWeekends:function(a){a=a.getDay();return[a>0&&a<6,""]},iso8601Week:function(a){a=new Date(a.getTime());a.setDate(a.getDate()+4-(a.getDay()||7));var d=
a.getTime();a.setMonth(0);a.setDate(1);return Math.floor(Math.round((d-a)/864E5)/7)+1},parseDate:function(a,d,h){if(a==null||d==null)throw"Invalid arguments";d=typeof d=="object"?d.toString():d+"";if(d=="")return null;var i=(h?h.shortYearCutoff:null)||this._defaults.shortYearCutoff;i=typeof i!="string"?i:(new Date).getFullYear()%100+parseInt(i,10);for(var j=(h?h.dayNamesShort:null)||this._defaults.dayNamesShort,n=(h?h.dayNames:null)||this._defaults.dayNames,q=(h?h.monthNamesShort:null)||this._defaults.monthNamesShort,
l=(h?h.monthNames:null)||this._defaults.monthNames,k=h=-1,m=-1,o=-1,p=false,s=function(x){(x=y+1<a.length&&a.charAt(y+1)==x)&&y++;return x},r=function(x){var C=s(x);x=new RegExp("^\\d{1,"+(x=="@"?14:x=="!"?20:x=="y"&&C?4:x=="o"?3:2)+"}");x=d.substring(w).match(x);if(!x)throw"Missing number at position "+w;w+=x[0].length;return parseInt(x[0],10)},u=function(x,C,J){x=s(x)?J:C;for(C=0;C<x.length;C++)if(d.substr(w,x[C].length).toLowerCase()==x[C].toLowerCase()){w+=x[C].length;return C+1}throw"Unknown name at position "+
w;},v=function(){if(d.charAt(w)!=a.charAt(y))throw"Unexpected literal at position "+w;w++},w=0,y=0;y<a.length;y++)if(p)if(a.charAt(y)=="'"&&!s("'"))p=false;else v();else switch(a.charAt(y)){case "d":m=r("d");break;case "D":u("D",j,n);break;case "o":o=r("o");break;case "m":k=r("m");break;case "M":k=u("M",q,l);break;case "y":h=r("y");break;case "@":var B=new Date(r("@"));h=B.getFullYear();k=B.getMonth()+1;m=B.getDate();break;case "!":B=new Date((r("!")-this._ticksTo1970)/1E4);h=B.getFullYear();k=B.getMonth()+
1;m=B.getDate();break;case "'":if(s("'"))v();else p=true;break;default:v()}if(h==-1)h=(new Date).getFullYear();else if(h<100)h+=(new Date).getFullYear()-(new Date).getFullYear()%100+(h<=i?0:-100);if(o>-1){k=1;m=o;do{i=this._getDaysInMonth(h,k-1);if(m<=i)break;k++;m-=i}while(1)}B=this._daylightSavingAdjust(new Date(h,k-1,m));if(B.getFullYear()!=h||B.getMonth()+1!=k||B.getDate()!=m)throw"Invalid date";return B},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",
RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925))*24*60*60*1E7,formatDate:function(a,d,h){if(!d)return"";var i=(h?h.dayNamesShort:null)||this._defaults.dayNamesShort,j=(h?h.dayNames:null)||this._defaults.dayNames,n=(h?h.monthNamesShort:null)||this._defaults.monthNamesShort;h=(h?h.monthNames:null)||this._defaults.monthNames;var q=function(s){(s=p+1<a.length&&
a.charAt(p+1)==s)&&p++;return s},l=function(s,r,u){r=""+r;if(q(s))for(;r.length<u;)r="0"+r;return r},k=function(s,r,u,v){return q(s)?v[r]:u[r]},m="",o=false;if(d)for(var p=0;p<a.length;p++)if(o)if(a.charAt(p)=="'"&&!q("'"))o=false;else m+=a.charAt(p);else switch(a.charAt(p)){case "d":m+=l("d",d.getDate(),2);break;case "D":m+=k("D",d.getDay(),i,j);break;case "o":m+=l("o",(d.getTime()-(new Date(d.getFullYear(),0,0)).getTime())/864E5,3);break;case "m":m+=l("m",d.getMonth()+1,2);break;case "M":m+=k("M",
d.getMonth(),n,h);break;case "y":m+=q("y")?d.getFullYear():(d.getYear()%100<10?"0":"")+d.getYear()%100;break;case "@":m+=d.getTime();break;case "!":m+=d.getTime()*1E4+this._ticksTo1970;break;case "'":if(q("'"))m+="'";else o=true;break;default:m+=a.charAt(p)}return m},_possibleChars:function(a){for(var d="",h=false,i=function(n){(n=j+1<a.length&&a.charAt(j+1)==n)&&j++;return n},j=0;j<a.length;j++)if(h)if(a.charAt(j)=="'"&&!i("'"))h=false;else d+=a.charAt(j);else switch(a.charAt(j)){case "d":case "m":case "y":case "@":d+=
"0123456789";break;case "D":case "M":return null;case "'":if(i("'"))d+="'";else h=true;break;default:d+=a.charAt(j)}return d},_get:function(a,d){return a.settings[d]!==c?a.settings[d]:this._defaults[d]},_setDateFromField:function(a,d){if(a.input.val()!=a.lastVal){var h=this._get(a,"dateFormat"),i=a.lastVal=a.input?a.input.val():null,j,n;j=n=this._getDefaultDate(a);var q=this._getFormatConfig(a);try{j=this.parseDate(h,i,q)||n}catch(l){this.log(l);i=d?"":i}a.selectedDay=j.getDate();a.drawMonth=a.selectedMonth=
j.getMonth();a.drawYear=a.selectedYear=j.getFullYear();a.currentDay=i?j.getDate():0;a.currentMonth=i?j.getMonth():0;a.currentYear=i?j.getFullYear():0;this._adjustInstDate(a)}},_getDefaultDate:function(a){return this._restrictMinMax(a,this._determineDate(a,this._get(a,"defaultDate"),new Date))},_determineDate:function(a,d,h){var i=function(n){var q=new Date;q.setDate(q.getDate()+n);return q},j=function(n){try{return b.datepicker.parseDate(b.datepicker._get(a,"dateFormat"),n,b.datepicker._getFormatConfig(a))}catch(q){}var l=
(n.toLowerCase().match(/^c/)?b.datepicker._getDate(a):null)||new Date,k=l.getFullYear(),m=l.getMonth();l=l.getDate();for(var o=/([+-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,p=o.exec(n);p;){switch(p[2]||"d"){case "d":case "D":l+=parseInt(p[1],10);break;case "w":case "W":l+=parseInt(p[1],10)*7;break;case "m":case "M":m+=parseInt(p[1],10);l=Math.min(l,b.datepicker._getDaysInMonth(k,m));break;case "y":case "Y":k+=parseInt(p[1],10);l=Math.min(l,b.datepicker._getDaysInMonth(k,m));break}p=o.exec(n)}return new Date(k,
m,l)};if(d=(d=d==null||d===""?h:typeof d=="string"?j(d):typeof d=="number"?isNaN(d)?h:i(d):new Date(d.getTime()))&&d.toString()=="Invalid Date"?h:d){d.setHours(0);d.setMinutes(0);d.setSeconds(0);d.setMilliseconds(0)}return this._daylightSavingAdjust(d)},_daylightSavingAdjust:function(a){if(!a)return null;a.setHours(a.getHours()>12?a.getHours()+2:0);return a},_setDate:function(a,d,h){var i=!d,j=a.selectedMonth,n=a.selectedYear;d=this._restrictMinMax(a,this._determineDate(a,d,new Date));a.selectedDay=
a.currentDay=d.getDate();a.drawMonth=a.selectedMonth=a.currentMonth=d.getMonth();a.drawYear=a.selectedYear=a.currentYear=d.getFullYear();if((j!=a.selectedMonth||n!=a.selectedYear)&&!h)this._notifyChange(a);this._adjustInstDate(a);if(a.input)a.input.val(i?"":this._formatDate(a))},_getDate:function(a){return!a.currentYear||a.input&&a.input.val()==""?null:this._daylightSavingAdjust(new Date(a.currentYear,a.currentMonth,a.currentDay))},_generateHTML:function(a){var d=new Date;d=this._daylightSavingAdjust(new Date(d.getFullYear(),
d.getMonth(),d.getDate()));var h=this._get(a,"isRTL"),i=this._get(a,"showButtonPanel"),j=this._get(a,"hideIfNoPrevNext"),n=this._get(a,"navigationAsDateFormat"),q=this._getNumberOfMonths(a),l=this._get(a,"showCurrentAtPos"),k=this._get(a,"stepMonths"),m=q[0]!=1||q[1]!=1,o=this._daylightSavingAdjust(!a.currentDay?new Date(9999,9,9):new Date(a.currentYear,a.currentMonth,a.currentDay)),p=this._getMinMaxDate(a,"min"),s=this._getMinMaxDate(a,"max");l=a.drawMonth-l;var r=a.drawYear;if(l<0){l+=12;r--}if(s){var u=
this._daylightSavingAdjust(new Date(s.getFullYear(),s.getMonth()-q[0]*q[1]+1,s.getDate()));for(u=p&&u<p?p:u;this._daylightSavingAdjust(new Date(r,l,1))>u;){l--;if(l<0){l=11;r--}}}a.drawMonth=l;a.drawYear=r;u=this._get(a,"prevText");u=!n?u:this.formatDate(u,this._daylightSavingAdjust(new Date(r,l-k,1)),this._getFormatConfig(a));u=this._canAdjustMonth(a,-1,r,l)?'<a class="ui-datepicker-prev ui-corner-all" onclick="DP_jQuery_'+e+".datepicker._adjustDate('#"+a.id+"', -"+k+", 'M');\" title=\""+u+'"><span class="ui-icon ui-icon-circle-triangle-'+
(h?"e":"w")+'">'+u+"</span></a>":j?"":'<a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title="'+u+'"><span class="ui-icon ui-icon-circle-triangle-'+(h?"e":"w")+'">'+u+"</span></a>";var v=this._get(a,"nextText");v=!n?v:this.formatDate(v,this._daylightSavingAdjust(new Date(r,l+k,1)),this._getFormatConfig(a));j=this._canAdjustMonth(a,+1,r,l)?'<a class="ui-datepicker-next ui-corner-all" onclick="DP_jQuery_'+e+".datepicker._adjustDate('#"+a.id+"', +"+k+", 'M');\" title=\""+v+'"><span class="ui-icon ui-icon-circle-triangle-'+
(h?"w":"e")+'">'+v+"</span></a>":j?"":'<a class="ui-datepicker-next ui-corner-all ui-state-disabled" title="'+v+'"><span class="ui-icon ui-icon-circle-triangle-'+(h?"w":"e")+'">'+v+"</span></a>";k=this._get(a,"currentText");v=this._get(a,"gotoCurrent")&&a.currentDay?o:d;k=!n?k:this.formatDate(k,v,this._getFormatConfig(a));n=!a.inline?'<button type="button" class="ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all" onclick="DP_jQuery_'+e+'.datepicker._hideDatepicker();">'+this._get(a,
"closeText")+"</button>":"";i=i?'<div class="ui-datepicker-buttonpane ui-widget-content">'+(h?n:"")+(this._isInRange(a,v)?'<button type="button" class="ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all" onclick="DP_jQuery_'+e+".datepicker._gotoToday('#"+a.id+"');\">"+k+"</button>":"")+(h?"":n)+"</div>":"";n=parseInt(this._get(a,"firstDay"),10);n=isNaN(n)?0:n;k=this._get(a,"showWeek");v=this._get(a,"dayNames");this._get(a,"dayNamesShort");var w=this._get(a,"dayNamesMin"),y=
this._get(a,"monthNames"),B=this._get(a,"monthNamesShort"),x=this._get(a,"beforeShowDay"),C=this._get(a,"showOtherMonths"),J=this._get(a,"selectOtherMonths");this._get(a,"calculateWeek");for(var M=this._getDefaultDate(a),K="",G=0;G<q[0];G++){for(var N="",H=0;H<q[1];H++){var O=this._daylightSavingAdjust(new Date(r,l,a.selectedDay)),A=" ui-corner-all",D="";if(m){D+='<div class="ui-datepicker-group';if(q[1]>1)switch(H){case 0:D+=" ui-datepicker-group-first";A=" ui-corner-"+(h?"right":"left");break;case q[1]-
1:D+=" ui-datepicker-group-last";A=" ui-corner-"+(h?"left":"right");break;default:D+=" ui-datepicker-group-middle";A="";break}D+='">'}D+='<div class="ui-datepicker-header ui-widget-header ui-helper-clearfix'+A+'">'+(/all|left/.test(A)&&G==0?h?j:u:"")+(/all|right/.test(A)&&G==0?h?u:j:"")+this._generateMonthYearHeader(a,l,r,p,s,G>0||H>0,y,B)+'</div><table class="ui-datepicker-calendar"><thead><tr>';var E=k?'<th class="ui-datepicker-week-col">'+this._get(a,"weekHeader")+"</th>":"";for(A=0;A<7;A++){var z=
(A+n)%7;E+="<th"+((A+n+6)%7>=5?' class="ui-datepicker-week-end"':"")+'><span title="'+v[z]+'">'+w[z]+"</span></th>"}D+=E+"</tr></thead><tbody>";E=this._getDaysInMonth(r,l);if(r==a.selectedYear&&l==a.selectedMonth)a.selectedDay=Math.min(a.selectedDay,E);A=(this._getFirstDayOfMonth(r,l)-n+7)%7;E=m?6:Math.ceil((A+E)/7);z=this._daylightSavingAdjust(new Date(r,l,1-A));for(var P=0;P<E;P++){D+="<tr>";var Q=!k?"":'<td class="ui-datepicker-week-col">'+this._get(a,"calculateWeek")(z)+"</td>";for(A=0;A<7;A++){var I=
x?x.apply(a.input?a.input[0]:null,[z]):[true,""],F=z.getMonth()!=l,L=F&&!J||!I[0]||p&&z<p||s&&z>s;Q+='<td class="'+((A+n+6)%7>=5?" ui-datepicker-week-end":"")+(F?" ui-datepicker-other-month":"")+(z.getTime()==O.getTime()&&l==a.selectedMonth&&a._keyEvent||M.getTime()==z.getTime()&&M.getTime()==O.getTime()?" "+this._dayOverClass:"")+(L?" "+this._unselectableClass+" ui-state-disabled":"")+(F&&!C?"":" "+I[1]+(z.getTime()==o.getTime()?" "+this._currentClass:"")+(z.getTime()==d.getTime()?" ui-datepicker-today":
""))+'"'+((!F||C)&&I[2]?' title="'+I[2]+'"':"")+(L?"":' onclick="DP_jQuery_'+e+".datepicker._selectDay('#"+a.id+"',"+z.getMonth()+","+z.getFullYear()+', this);return false;"')+">"+(F&&!C?"&#xa0;":L?'<span class="ui-state-default">'+z.getDate()+"</span>":'<a class="ui-state-default'+(z.getTime()==d.getTime()?" ui-state-highlight":"")+(z.getTime()==o.getTime()?" ui-state-active":"")+(F?" ui-priority-secondary":"")+'" href="#">'+z.getDate()+"</a>")+"</td>";z.setDate(z.getDate()+1);z=this._daylightSavingAdjust(z)}D+=
Q+"</tr>"}l++;if(l>11){l=0;r++}D+="</tbody></table>"+(m?"</div>"+(q[0]>0&&H==q[1]-1?'<div class="ui-datepicker-row-break"></div>':""):"");N+=D}K+=N}K+=i+(b.browser.msie&&parseInt(b.browser.version,10)<7&&!a.inline?'<iframe src="javascript:false;" class="ui-datepicker-cover" frameborder="0"></iframe>':"");a._keyEvent=false;return K},_generateMonthYearHeader:function(a,d,h,i,j,n,q,l){var k=this._get(a,"changeMonth"),m=this._get(a,"changeYear"),o=this._get(a,"showMonthAfterYear"),p='<div class="ui-datepicker-title">',
s="";if(n||!k)s+='<span class="ui-datepicker-month">'+q[d]+"</span>";else{q=i&&i.getFullYear()==h;var r=j&&j.getFullYear()==h;s+='<select class="ui-datepicker-month" onchange="DP_jQuery_'+e+".datepicker._selectMonthYear('#"+a.id+"', this, 'M');\" onclick=\"DP_jQuery_"+e+".datepicker._clickMonthYear('#"+a.id+"');\">";for(var u=0;u<12;u++)if((!q||u>=i.getMonth())&&(!r||u<=j.getMonth()))s+='<option value="'+u+'"'+(u==d?' selected="selected"':"")+">"+l[u]+"</option>";s+="</select>"}o||(p+=s+(n||!(k&&
m)?"&#xa0;":""));a.yearshtml="";if(n||!m)p+='<span class="ui-datepicker-year">'+h+"</span>";else{l=this._get(a,"yearRange").split(":");var v=(new Date).getFullYear();q=function(w){w=w.match(/c[+-].*/)?h+parseInt(w.substring(1),10):w.match(/[+-].*/)?v+parseInt(w,10):parseInt(w,10);return isNaN(w)?v:w};d=q(l[0]);l=Math.max(d,q(l[1]||""));d=i?Math.max(d,i.getFullYear()):d;l=j?Math.min(l,j.getFullYear()):l;for(a.yearshtml+='<select class="ui-datepicker-year" onchange="DP_jQuery_'+e+".datepicker._selectMonthYear('#"+
a.id+"', this, 'Y');\" onclick=\"DP_jQuery_"+e+".datepicker._clickMonthYear('#"+a.id+"');\">";d<=l;d++)a.yearshtml+='<option value="'+d+'"'+(d==h?' selected="selected"':"")+">"+d+"</option>";a.yearshtml+="</select>";if(b.browser.mozilla)p+='<select class="ui-datepicker-year"><option value="'+h+'" selected="selected">'+h+"</option></select>";else{p+=a.yearshtml;a.yearshtml=null}}p+=this._get(a,"yearSuffix");if(o)p+=(n||!(k&&m)?"&#xa0;":"")+s;p+="</div>";return p},_adjustInstDate:function(a,d,h){var i=
a.drawYear+(h=="Y"?d:0),j=a.drawMonth+(h=="M"?d:0);d=Math.min(a.selectedDay,this._getDaysInMonth(i,j))+(h=="D"?d:0);i=this._restrictMinMax(a,this._daylightSavingAdjust(new Date(i,j,d)));a.selectedDay=i.getDate();a.drawMonth=a.selectedMonth=i.getMonth();a.drawYear=a.selectedYear=i.getFullYear();if(h=="M"||h=="Y")this._notifyChange(a)},_restrictMinMax:function(a,d){var h=this._getMinMaxDate(a,"min");a=this._getMinMaxDate(a,"max");d=h&&d<h?h:d;return d=a&&d>a?a:d},_notifyChange:function(a){var d=this._get(a,
"onChangeMonthYear");if(d)d.apply(a.input?a.input[0]:null,[a.selectedYear,a.selectedMonth+1,a])},_getNumberOfMonths:function(a){a=this._get(a,"numberOfMonths");return a==null?[1,1]:typeof a=="number"?[1,a]:a},_getMinMaxDate:function(a,d){return this._determineDate(a,this._get(a,d+"Date"),null)},_getDaysInMonth:function(a,d){return 32-(new Date(a,d,32)).getDate()},_getFirstDayOfMonth:function(a,d){return(new Date(a,d,1)).getDay()},_canAdjustMonth:function(a,d,h,i){var j=this._getNumberOfMonths(a);
h=this._daylightSavingAdjust(new Date(h,i+(d<0?d:j[0]*j[1]),1));d<0&&h.setDate(this._getDaysInMonth(h.getFullYear(),h.getMonth()));return this._isInRange(a,h)},_isInRange:function(a,d){var h=this._getMinMaxDate(a,"min");a=this._getMinMaxDate(a,"max");return(!h||d.getTime()>=h.getTime())&&(!a||d.getTime()<=a.getTime())},_getFormatConfig:function(a){var d=this._get(a,"shortYearCutoff");d=typeof d!="string"?d:(new Date).getFullYear()%100+parseInt(d,10);return{shortYearCutoff:d,dayNamesShort:this._get(a,
"dayNamesShort"),dayNames:this._get(a,"dayNames"),monthNamesShort:this._get(a,"monthNamesShort"),monthNames:this._get(a,"monthNames")}},_formatDate:function(a,d,h,i){if(!d){a.currentDay=a.selectedDay;a.currentMonth=a.selectedMonth;a.currentYear=a.selectedYear}d=d?typeof d=="object"?d:this._daylightSavingAdjust(new Date(i,h,d)):this._daylightSavingAdjust(new Date(a.currentYear,a.currentMonth,a.currentDay));return this.formatDate(this._get(a,"dateFormat"),d,this._getFormatConfig(a))}});b.fn.datepicker=
function(a){if(!b.datepicker.initialized){b(document).mousedown(b.datepicker._checkExternalClick).find("body").append(b.datepicker.dpDiv);b.datepicker.initialized=true}var d=Array.prototype.slice.call(arguments,1);if(typeof a=="string"&&(a=="isDisabled"||a=="getDate"||a=="widget"))return b.datepicker["_"+a+"Datepicker"].apply(b.datepicker,[this[0]].concat(d));if(a=="option"&&arguments.length==2&&typeof arguments[1]=="string")return b.datepicker["_"+a+"Datepicker"].apply(b.datepicker,[this[0]].concat(d));
return this.each(function(){typeof a=="string"?b.datepicker["_"+a+"Datepicker"].apply(b.datepicker,[this].concat(d)):b.datepicker._attachDatepicker(this,a)})};b.datepicker=new f;b.datepicker.initialized=false;b.datepicker.uuid=(new Date).getTime();b.datepicker.version="1.8.9";window["DP_jQuery_"+e]=b})(jQuery);
(function(b,c){var f={buttons:true,height:true,maxHeight:true,maxWidth:true,minHeight:true,minWidth:true,width:true},g={maxHeight:true,maxWidth:true,minHeight:true,minWidth:true};b.widget("ui.dialog",{options:{autoOpen:true,buttons:{},closeOnEscape:true,closeText:"close",dialogClass:"",draggable:true,hide:null,height:"auto",maxHeight:false,maxWidth:false,minHeight:150,minWidth:150,modal:false,position:{my:"center",at:"center",collision:"fit",using:function(e){var a=b(this).css(e).offset().top;a<0&&
b(this).css("top",e.top-a)}},resizable:true,show:null,stack:true,title:"",width:300,zIndex:1E3},_create:function(){this.originalTitle=this.element.attr("title");if(typeof this.originalTitle!=="string")this.originalTitle="";this.options.title=this.options.title||this.originalTitle;var e=this,a=e.options,d=a.title||"&#160;",h=b.ui.dialog.getTitleId(e.element),i=(e.uiDialog=b("<div></div>")).appendTo(document.body).hide().addClass("ui-dialog ui-widget ui-widget-content ui-corner-all "+a.dialogClass).css({zIndex:a.zIndex}).attr("tabIndex",
-1).css("outline",0).keydown(function(q){if(a.closeOnEscape&&q.keyCode&&q.keyCode===b.ui.keyCode.ESCAPE){e.close(q);q.preventDefault()}}).attr({role:"dialog","aria-labelledby":h}).mousedown(function(q){e.moveToTop(false,q)});e.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(i);var j=(e.uiDialogTitlebar=b("<div></div>")).addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(i),n=b('<a href="#"></a>').addClass("ui-dialog-titlebar-close ui-corner-all").attr("role",
"button").hover(function(){n.addClass("ui-state-hover")},function(){n.removeClass("ui-state-hover")}).focus(function(){n.addClass("ui-state-focus")}).blur(function(){n.removeClass("ui-state-focus")}).click(function(q){e.close(q);return false}).appendTo(j);(e.uiDialogTitlebarCloseText=b("<span></span>")).addClass("ui-icon ui-icon-closethick").text(a.closeText).appendTo(n);b("<span></span>").addClass("ui-dialog-title").attr("id",h).html(d).prependTo(j);if(b.isFunction(a.beforeclose)&&!b.isFunction(a.beforeClose))a.beforeClose=
a.beforeclose;j.find("*").add(j).disableSelection();a.draggable&&b.fn.draggable&&e._makeDraggable();a.resizable&&b.fn.resizable&&e._makeResizable();e._createButtons(a.buttons);e._isOpen=false;b.fn.bgiframe&&i.bgiframe()},_init:function(){this.options.autoOpen&&this.open()},destroy:function(){var e=this;e.overlay&&e.overlay.destroy();e.uiDialog.hide();e.element.unbind(".dialog").removeData("dialog").removeClass("ui-dialog-content ui-widget-content").hide().appendTo("body");e.uiDialog.remove();e.originalTitle&&
e.element.attr("title",e.originalTitle);return e},widget:function(){return this.uiDialog},close:function(e){var a=this,d,h;if(false!==a._trigger("beforeClose",e)){a.overlay&&a.overlay.destroy();a.uiDialog.unbind("keypress.ui-dialog");a._isOpen=false;if(a.options.hide)a.uiDialog.hide(a.options.hide,function(){a._trigger("close",e)});else{a.uiDialog.hide();a._trigger("close",e)}b.ui.dialog.overlay.resize();if(a.options.modal){d=0;b(".ui-dialog").each(function(){if(this!==a.uiDialog[0]){h=b(this).css("z-index");
isNaN(h)||(d=Math.max(d,h))}});b.ui.dialog.maxZ=d}return a}},isOpen:function(){return this._isOpen},moveToTop:function(e,a){var d=this,h=d.options;if(h.modal&&!e||!h.stack&&!h.modal)return d._trigger("focus",a);if(h.zIndex>b.ui.dialog.maxZ)b.ui.dialog.maxZ=h.zIndex;if(d.overlay){b.ui.dialog.maxZ+=1;d.overlay.$el.css("z-index",b.ui.dialog.overlay.maxZ=b.ui.dialog.maxZ)}e={scrollTop:d.element.attr("scrollTop"),scrollLeft:d.element.attr("scrollLeft")};b.ui.dialog.maxZ+=1;d.uiDialog.css("z-index",b.ui.dialog.maxZ);
d.element.attr(e);d._trigger("focus",a);return d},open:function(){if(!this._isOpen){var e=this,a=e.options,d=e.uiDialog;e.overlay=a.modal?new b.ui.dialog.overlay(e):null;e._size();e._position(a.position);d.show(a.show);e.moveToTop(true);a.modal&&d.bind("keypress.ui-dialog",function(h){if(h.keyCode===b.ui.keyCode.TAB){var i=b(":tabbable",this),j=i.filter(":first");i=i.filter(":last");if(h.target===i[0]&&!h.shiftKey){j.focus(1);return false}else if(h.target===j[0]&&h.shiftKey){i.focus(1);return false}}});
b(e.element.find(":tabbable").get().concat(d.find(".ui-dialog-buttonpane :tabbable").get().concat(d.get()))).eq(0).focus();e._isOpen=true;e._trigger("open");return e}},_createButtons:function(e){var a=this,d=false,h=b("<div></div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"),i=b("<div></div>").addClass("ui-dialog-buttonset").appendTo(h);a.uiDialog.find(".ui-dialog-buttonpane").remove();typeof e==="object"&&e!==null&&b.each(e,function(){return!(d=true)});if(d){b.each(e,function(j,
n){n=b.isFunction(n)?{click:n,text:j}:n;j=b('<button type="button"></button>').attr(n,true).unbind("click").click(function(){n.click.apply(a.element[0],arguments)}).appendTo(i);b.fn.button&&j.button()});h.appendTo(a.uiDialog)}},_makeDraggable:function(){function e(j){return{position:j.position,offset:j.offset}}var a=this,d=a.options,h=b(document),i;a.uiDialog.draggable({cancel:".ui-dialog-content, .ui-dialog-titlebar-close",handle:".ui-dialog-titlebar",containment:"document",start:function(j,n){i=
d.height==="auto"?"auto":b(this).height();b(this).height(b(this).height()).addClass("ui-dialog-dragging");a._trigger("dragStart",j,e(n))},drag:function(j,n){a._trigger("drag",j,e(n))},stop:function(j,n){d.position=[n.position.left-h.scrollLeft(),n.position.top-h.scrollTop()];b(this).removeClass("ui-dialog-dragging").height(i);a._trigger("dragStop",j,e(n));b.ui.dialog.overlay.resize()}})},_makeResizable:function(e){function a(j){return{originalPosition:j.originalPosition,originalSize:j.originalSize,
position:j.position,size:j.size}}e=e===c?this.options.resizable:e;var d=this,h=d.options,i=d.uiDialog.css("position");e=typeof e==="string"?e:"n,e,s,w,se,sw,ne,nw";d.uiDialog.resizable({cancel:".ui-dialog-content",containment:"document",alsoResize:d.element,maxWidth:h.maxWidth,maxHeight:h.maxHeight,minWidth:h.minWidth,minHeight:d._minHeight(),handles:e,start:function(j,n){b(this).addClass("ui-dialog-resizing");d._trigger("resizeStart",j,a(n))},resize:function(j,n){d._trigger("resize",j,a(n))},stop:function(j,
n){b(this).removeClass("ui-dialog-resizing");h.height=b(this).height();h.width=b(this).width();d._trigger("resizeStop",j,a(n));b.ui.dialog.overlay.resize()}}).css("position",i).find(".ui-resizable-se").addClass("ui-icon ui-icon-grip-diagonal-se")},_minHeight:function(){var e=this.options;return e.height==="auto"?e.minHeight:Math.min(e.minHeight,e.height)},_position:function(e){var a=[],d=[0,0],h;if(e){if(typeof e==="string"||typeof e==="object"&&"0"in e){a=e.split?e.split(" "):[e[0],e[1]];if(a.length===
1)a[1]=a[0];b.each(["left","top"],function(i,j){if(+a[i]===a[i]){d[i]=a[i];a[i]=j}});e={my:a.join(" "),at:a.join(" "),offset:d.join(" ")}}e=b.extend({},b.ui.dialog.prototype.options.position,e)}else e=b.ui.dialog.prototype.options.position;(h=this.uiDialog.is(":visible"))||this.uiDialog.show();this.uiDialog.css({top:0,left:0}).position(b.extend({of:window},e));h||this.uiDialog.hide()},_setOptions:function(e){var a=this,d={},h=false;b.each(e,function(i,j){a._setOption(i,j);if(i in f)h=true;if(i in
g)d[i]=j});h&&this._size();this.uiDialog.is(":data(resizable)")&&this.uiDialog.resizable("option",d)},_setOption:function(e,a){var d=this,h=d.uiDialog;switch(e){case "beforeclose":e="beforeClose";break;case "buttons":d._createButtons(a);break;case "closeText":d.uiDialogTitlebarCloseText.text(""+a);break;case "dialogClass":h.removeClass(d.options.dialogClass).addClass("ui-dialog ui-widget ui-widget-content ui-corner-all "+a);break;case "disabled":a?h.addClass("ui-dialog-disabled"):h.removeClass("ui-dialog-disabled");
break;case "draggable":var i=h.is(":data(draggable)");i&&!a&&h.draggable("destroy");!i&&a&&d._makeDraggable();break;case "position":d._position(a);break;case "resizable":(i=h.is(":data(resizable)"))&&!a&&h.resizable("destroy");i&&typeof a==="string"&&h.resizable("option","handles",a);!i&&a!==false&&d._makeResizable(a);break;case "title":b(".ui-dialog-title",d.uiDialogTitlebar).html(""+(a||"&#160;"));break}b.Widget.prototype._setOption.apply(d,arguments)},_size:function(){var e=this.options,a,d,h=
this.uiDialog.is(":visible");this.element.show().css({width:"auto",minHeight:0,height:0});if(e.minWidth>e.width)e.width=e.minWidth;a=this.uiDialog.css({height:"auto",width:e.width}).height();d=Math.max(0,e.minHeight-a);if(e.height==="auto")if(b.support.minHeight)this.element.css({minHeight:d,height:"auto"});else{this.uiDialog.show();e=this.element.css("height","auto").height();h||this.uiDialog.hide();this.element.height(Math.max(e,d))}else this.element.height(Math.max(e.height-a,0));this.uiDialog.is(":data(resizable)")&&
this.uiDialog.resizable("option","minHeight",this._minHeight())}});b.extend(b.ui.dialog,{version:"1.8.9",uuid:0,maxZ:0,getTitleId:function(e){e=e.attr("id");if(!e){this.uuid+=1;e=this.uuid}return"ui-dialog-title-"+e},overlay:function(e){this.$el=b.ui.dialog.overlay.create(e)}});b.extend(b.ui.dialog.overlay,{instances:[],oldInstances:[],maxZ:0,events:b.map("focus,mousedown,mouseup,keydown,keypress,click".split(","),function(e){return e+".dialog-overlay"}).join(" "),create:function(e){if(this.instances.length===
0){setTimeout(function(){b.ui.dialog.overlay.instances.length&&b(document).bind(b.ui.dialog.overlay.events,function(d){if(b(d.target).zIndex()<b.ui.dialog.overlay.maxZ)return false})},1);b(document).bind("keydown.dialog-overlay",function(d){if(e.options.closeOnEscape&&d.keyCode&&d.keyCode===b.ui.keyCode.ESCAPE){e.close(d);d.preventDefault()}});b(window).bind("resize.dialog-overlay",b.ui.dialog.overlay.resize)}var a=(this.oldInstances.pop()||b("<div></div>").addClass("ui-widget-overlay")).appendTo(document.body).css({width:this.width(),
height:this.height()});b.fn.bgiframe&&a.bgiframe();this.instances.push(a);return a},destroy:function(e){var a=b.inArray(e,this.instances);a!=-1&&this.oldInstances.push(this.instances.splice(a,1)[0]);this.instances.length===0&&b([document,window]).unbind(".dialog-overlay");e.remove();var d=0;b.each(this.instances,function(){d=Math.max(d,this.css("z-index"))});this.maxZ=d},height:function(){var e,a;if(b.browser.msie&&b.browser.version<7){e=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight);
a=Math.max(document.documentElement.offsetHeight,document.body.offsetHeight);return e<a?b(window).height()+"px":e+"px"}else return b(document).height()+"px"},width:function(){var e,a;if(b.browser.msie&&b.browser.version<7){e=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth);a=Math.max(document.documentElement.offsetWidth,document.body.offsetWidth);return e<a?b(window).width()+"px":e+"px"}else return b(document).width()+"px"},resize:function(){var e=b([]);b.each(b.ui.dialog.overlay.instances,
function(){e=e.add(this)});e.css({width:0,height:0}).css({width:b.ui.dialog.overlay.width(),height:b.ui.dialog.overlay.height()})}});b.extend(b.ui.dialog.overlay.prototype,{destroy:function(){b.ui.dialog.overlay.destroy(this.$el)}})})(jQuery);
(function(b){b.ui=b.ui||{};var c=/left|center|right/,f=/top|center|bottom/,g=b.fn.position,e=b.fn.offset;b.fn.position=function(a){if(!a||!a.of)return g.apply(this,arguments);a=b.extend({},a);var d=b(a.of),h=d[0],i=(a.collision||"flip").split(" "),j=a.offset?a.offset.split(" "):[0,0],n,q,l;if(h.nodeType===9){n=d.width();q=d.height();l={top:0,left:0}}else if(h.setTimeout){n=d.width();q=d.height();l={top:d.scrollTop(),left:d.scrollLeft()}}else if(h.preventDefault){a.at="left top";n=q=0;l={top:a.of.pageY,
left:a.of.pageX}}else{n=d.outerWidth();q=d.outerHeight();l=d.offset()}b.each(["my","at"],function(){var k=(a[this]||"").split(" ");if(k.length===1)k=c.test(k[0])?k.concat(["center"]):f.test(k[0])?["center"].concat(k):["center","center"];k[0]=c.test(k[0])?k[0]:"center";k[1]=f.test(k[1])?k[1]:"center";a[this]=k});if(i.length===1)i[1]=i[0];j[0]=parseInt(j[0],10)||0;if(j.length===1)j[1]=j[0];j[1]=parseInt(j[1],10)||0;if(a.at[0]==="right")l.left+=n;else if(a.at[0]==="center")l.left+=n/2;if(a.at[1]==="bottom")l.top+=
q;else if(a.at[1]==="center")l.top+=q/2;l.left+=j[0];l.top+=j[1];return this.each(function(){var k=b(this),m=k.outerWidth(),o=k.outerHeight(),p=parseInt(b.curCSS(this,"marginLeft",true))||0,s=parseInt(b.curCSS(this,"marginTop",true))||0,r=m+p+(parseInt(b.curCSS(this,"marginRight",true))||0),u=o+s+(parseInt(b.curCSS(this,"marginBottom",true))||0),v=b.extend({},l),w;if(a.my[0]==="right")v.left-=m;else if(a.my[0]==="center")v.left-=m/2;if(a.my[1]==="bottom")v.top-=o;else if(a.my[1]==="center")v.top-=
o/2;v.left=Math.round(v.left);v.top=Math.round(v.top);w={left:v.left-p,top:v.top-s};b.each(["left","top"],function(y,B){b.ui.position[i[y]]&&b.ui.position[i[y]][B](v,{targetWidth:n,targetHeight:q,elemWidth:m,elemHeight:o,collisionPosition:w,collisionWidth:r,collisionHeight:u,offset:j,my:a.my,at:a.at})});b.fn.bgiframe&&k.bgiframe();k.offset(b.extend(v,{using:a.using}))})};b.ui.position={fit:{left:function(a,d){var h=b(window);h=d.collisionPosition.left+d.collisionWidth-h.width()-h.scrollLeft();a.left=
h>0?a.left-h:Math.max(a.left-d.collisionPosition.left,a.left)},top:function(a,d){var h=b(window);h=d.collisionPosition.top+d.collisionHeight-h.height()-h.scrollTop();a.top=h>0?a.top-h:Math.max(a.top-d.collisionPosition.top,a.top)}},flip:{left:function(a,d){if(d.at[0]!=="center"){var h=b(window);h=d.collisionPosition.left+d.collisionWidth-h.width()-h.scrollLeft();var i=d.my[0]==="left"?-d.elemWidth:d.my[0]==="right"?d.elemWidth:0,j=d.at[0]==="left"?d.targetWidth:-d.targetWidth,n=-2*d.offset[0];a.left+=
d.collisionPosition.left<0?i+j+n:h>0?i+j+n:0}},top:function(a,d){if(d.at[1]!=="center"){var h=b(window);h=d.collisionPosition.top+d.collisionHeight-h.height()-h.scrollTop();var i=d.my[1]==="top"?-d.elemHeight:d.my[1]==="bottom"?d.elemHeight:0,j=d.at[1]==="top"?d.targetHeight:-d.targetHeight,n=-2*d.offset[1];a.top+=d.collisionPosition.top<0?i+j+n:h>0?i+j+n:0}}}};if(!b.offset.setOffset){b.offset.setOffset=function(a,d){if(/static/.test(b.curCSS(a,"position")))a.style.position="relative";var h=b(a),
i=h.offset(),j=parseInt(b.curCSS(a,"top",true),10)||0,n=parseInt(b.curCSS(a,"left",true),10)||0;i={top:d.top-i.top+j,left:d.left-i.left+n};"using"in d?d.using.call(a,i):h.css(i)};b.fn.offset=function(a){var d=this[0];if(!d||!d.ownerDocument)return null;if(a)return this.each(function(){b.offset.setOffset(this,a)});return e.call(this)}}})(jQuery);
(function(b,c){b.widget("ui.progressbar",{options:{value:0,max:100},min:0,_create:function(){this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({role:"progressbar","aria-valuemin":this.min,"aria-valuemax":this.options.max,"aria-valuenow":this._value()});this.valueDiv=b("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element);this.oldValue=this._value();this._refreshValue()},destroy:function(){this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow");
this.valueDiv.remove();b.Widget.prototype.destroy.apply(this,arguments)},value:function(f){if(f===c)return this._value();this._setOption("value",f);return this},_setOption:function(f,g){if(f==="value"){this.options.value=g;this._refreshValue();this._value()===this.options.max&&this._trigger("complete")}b.Widget.prototype._setOption.apply(this,arguments)},_value:function(){var f=this.options.value;if(typeof f!=="number")f=0;return Math.min(this.options.max,Math.max(this.min,f))},_percentage:function(){return 100*
this._value()/this.options.max},_refreshValue:function(){var f=this.value(),g=this._percentage();if(this.oldValue!==f){this.oldValue=f;this._trigger("change")}this.valueDiv.toggleClass("ui-corner-right",f===this.options.max).width(g.toFixed(0)+"%");this.element.attr("aria-valuenow",f)}});b.extend(b.ui.progressbar,{version:"1.8.9"})})(jQuery);
(function(b){b.widget("ui.slider",b.ui.mouse,{widgetEventPrefix:"slide",options:{animate:false,distance:0,max:100,min:0,orientation:"horizontal",range:false,step:1,value:0,values:null},_create:function(){var c=this,f=this.options;this._mouseSliding=this._keySliding=false;this._animateOff=true;this._handleIndex=null;this._detectOrientation();this._mouseInit();this.element.addClass("ui-slider ui-slider-"+this.orientation+" ui-widget ui-widget-content ui-corner-all");f.disabled&&this.element.addClass("ui-slider-disabled ui-disabled");
this.range=b([]);if(f.range){if(f.range===true){this.range=b("<div></div>");if(!f.values)f.values=[this._valueMin(),this._valueMin()];if(f.values.length&&f.values.length!==2)f.values=[f.values[0],f.values[0]]}else this.range=b("<div></div>");this.range.appendTo(this.element).addClass("ui-slider-range");if(f.range==="min"||f.range==="max")this.range.addClass("ui-slider-range-"+f.range);this.range.addClass("ui-widget-header")}b(".ui-slider-handle",this.element).length===0&&b("<a href='#'></a>").appendTo(this.element).addClass("ui-slider-handle");
if(f.values&&f.values.length)for(;b(".ui-slider-handle",this.element).length<f.values.length;)b("<a href='#'></a>").appendTo(this.element).addClass("ui-slider-handle");this.handles=b(".ui-slider-handle",this.element).addClass("ui-state-default ui-corner-all");this.handle=this.handles.eq(0);this.handles.add(this.range).filter("a").click(function(g){g.preventDefault()}).hover(function(){f.disabled||b(this).addClass("ui-state-hover")},function(){b(this).removeClass("ui-state-hover")}).focus(function(){if(f.disabled)b(this).blur();
else{b(".ui-slider .ui-state-focus").removeClass("ui-state-focus");b(this).addClass("ui-state-focus")}}).blur(function(){b(this).removeClass("ui-state-focus")});this.handles.each(function(g){b(this).data("index.ui-slider-handle",g)});this.handles.keydown(function(g){var e=true,a=b(this).data("index.ui-slider-handle"),d,h,i;if(!c.options.disabled){switch(g.keyCode){case b.ui.keyCode.HOME:case b.ui.keyCode.END:case b.ui.keyCode.PAGE_UP:case b.ui.keyCode.PAGE_DOWN:case b.ui.keyCode.UP:case b.ui.keyCode.RIGHT:case b.ui.keyCode.DOWN:case b.ui.keyCode.LEFT:e=
false;if(!c._keySliding){c._keySliding=true;b(this).addClass("ui-state-active");d=c._start(g,a);if(d===false)return}break}i=c.options.step;d=c.options.values&&c.options.values.length?(h=c.values(a)):(h=c.value());switch(g.keyCode){case b.ui.keyCode.HOME:h=c._valueMin();break;case b.ui.keyCode.END:h=c._valueMax();break;case b.ui.keyCode.PAGE_UP:h=c._trimAlignValue(d+(c._valueMax()-c._valueMin())/5);break;case b.ui.keyCode.PAGE_DOWN:h=c._trimAlignValue(d-(c._valueMax()-c._valueMin())/5);break;case b.ui.keyCode.UP:case b.ui.keyCode.RIGHT:if(d===
c._valueMax())return;h=c._trimAlignValue(d+i);break;case b.ui.keyCode.DOWN:case b.ui.keyCode.LEFT:if(d===c._valueMin())return;h=c._trimAlignValue(d-i);break}c._slide(g,a,h);return e}}).keyup(function(g){var e=b(this).data("index.ui-slider-handle");if(c._keySliding){c._keySliding=false;c._stop(g,e);c._change(g,e);b(this).removeClass("ui-state-active")}});this._refreshValue();this._animateOff=false},destroy:function(){this.handles.remove();this.range.remove();this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-slider-disabled ui-widget ui-widget-content ui-corner-all").removeData("slider").unbind(".slider");
this._mouseDestroy();return this},_mouseCapture:function(c){var f=this.options,g,e,a,d,h;if(f.disabled)return false;this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()};this.elementOffset=this.element.offset();g=this._normValueFromMouse({x:c.pageX,y:c.pageY});e=this._valueMax()-this._valueMin()+1;d=this;this.handles.each(function(i){var j=Math.abs(g-d.values(i));if(e>j){e=j;a=b(this);h=i}});if(f.range===true&&this.values(1)===f.min){h+=1;a=b(this.handles[h])}if(this._start(c,
h)===false)return false;this._mouseSliding=true;d._handleIndex=h;a.addClass("ui-state-active").focus();f=a.offset();this._clickOffset=!b(c.target).parents().andSelf().is(".ui-slider-handle")?{left:0,top:0}:{left:c.pageX-f.left-a.width()/2,top:c.pageY-f.top-a.height()/2-(parseInt(a.css("borderTopWidth"),10)||0)-(parseInt(a.css("borderBottomWidth"),10)||0)+(parseInt(a.css("marginTop"),10)||0)};this.handles.hasClass("ui-state-hover")||this._slide(c,h,g);return this._animateOff=true},_mouseStart:function(){return true},
_mouseDrag:function(c){var f=this._normValueFromMouse({x:c.pageX,y:c.pageY});this._slide(c,this._handleIndex,f);return false},_mouseStop:function(c){this.handles.removeClass("ui-state-active");this._mouseSliding=false;this._stop(c,this._handleIndex);this._change(c,this._handleIndex);this._clickOffset=this._handleIndex=null;return this._animateOff=false},_detectOrientation:function(){this.orientation=this.options.orientation==="vertical"?"vertical":"horizontal"},_normValueFromMouse:function(c){var f;
if(this.orientation==="horizontal"){f=this.elementSize.width;c=c.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)}else{f=this.elementSize.height;c=c.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)}f=c/f;if(f>1)f=1;if(f<0)f=0;if(this.orientation==="vertical")f=1-f;c=this._valueMax()-this._valueMin();return this._trimAlignValue(this._valueMin()+f*c)},_start:function(c,f){var g={handle:this.handles[f],value:this.value()};if(this.options.values&&this.options.values.length){g.value=
this.values(f);g.values=this.values()}return this._trigger("start",c,g)},_slide:function(c,f,g){var e;if(this.options.values&&this.options.values.length){e=this.values(f?0:1);if(this.options.values.length===2&&this.options.range===true&&(f===0&&g>e||f===1&&g<e))g=e;if(g!==this.values(f)){e=this.values();e[f]=g;c=this._trigger("slide",c,{handle:this.handles[f],value:g,values:e});this.values(f?0:1);c!==false&&this.values(f,g,true)}}else if(g!==this.value()){c=this._trigger("slide",c,{handle:this.handles[f],
value:g});c!==false&&this.value(g)}},_stop:function(c,f){var g={handle:this.handles[f],value:this.value()};if(this.options.values&&this.options.values.length){g.value=this.values(f);g.values=this.values()}this._trigger("stop",c,g)},_change:function(c,f){if(!this._keySliding&&!this._mouseSliding){var g={handle:this.handles[f],value:this.value()};if(this.options.values&&this.options.values.length){g.value=this.values(f);g.values=this.values()}this._trigger("change",c,g)}},value:function(c){if(arguments.length){this.options.value=
this._trimAlignValue(c);this._refreshValue();this._change(null,0)}return this._value()},values:function(c,f){var g,e,a;if(arguments.length>1){this.options.values[c]=this._trimAlignValue(f);this._refreshValue();this._change(null,c)}if(arguments.length)if(b.isArray(arguments[0])){g=this.options.values;e=arguments[0];for(a=0;a<g.length;a+=1){g[a]=this._trimAlignValue(e[a]);this._change(null,a)}this._refreshValue()}else return this.options.values&&this.options.values.length?this._values(c):this.value();
else return this._values()},_setOption:function(c,f){var g,e=0;if(b.isArray(this.options.values))e=this.options.values.length;b.Widget.prototype._setOption.apply(this,arguments);switch(c){case "disabled":if(f){this.handles.filter(".ui-state-focus").blur();this.handles.removeClass("ui-state-hover");this.handles.attr("disabled","disabled");this.element.addClass("ui-disabled")}else{this.handles.removeAttr("disabled");this.element.removeClass("ui-disabled")}break;case "orientation":this._detectOrientation();
this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation);this._refreshValue();break;case "value":this._animateOff=true;this._refreshValue();this._change(null,0);this._animateOff=false;break;case "values":this._animateOff=true;this._refreshValue();for(g=0;g<e;g+=1)this._change(null,g);this._animateOff=false;break}},_value:function(){var c=this.options.value;return c=this._trimAlignValue(c)},_values:function(c){var f,g;if(arguments.length){f=this.options.values[c];
return f=this._trimAlignValue(f)}else{f=this.options.values.slice();for(g=0;g<f.length;g+=1)f[g]=this._trimAlignValue(f[g]);return f}},_trimAlignValue:function(c){if(c<=this._valueMin())return this._valueMin();if(c>=this._valueMax())return this._valueMax();var f=this.options.step>0?this.options.step:1,g=(c-this._valueMin())%f;alignValue=c-g;if(Math.abs(g)*2>=f)alignValue+=g>0?f:-f;return parseFloat(alignValue.toFixed(5))},_valueMin:function(){return this.options.min},_valueMax:function(){return this.options.max},
_refreshValue:function(){var c=this.options.range,f=this.options,g=this,e=!this._animateOff?f.animate:false,a,d={},h,i,j,n;if(this.options.values&&this.options.values.length)this.handles.each(function(q){a=(g.values(q)-g._valueMin())/(g._valueMax()-g._valueMin())*100;d[g.orientation==="horizontal"?"left":"bottom"]=a+"%";b(this).stop(1,1)[e?"animate":"css"](d,f.animate);if(g.options.range===true)if(g.orientation==="horizontal"){if(q===0)g.range.stop(1,1)[e?"animate":"css"]({left:a+"%"},f.animate);
if(q===1)g.range[e?"animate":"css"]({width:a-h+"%"},{queue:false,duration:f.animate})}else{if(q===0)g.range.stop(1,1)[e?"animate":"css"]({bottom:a+"%"},f.animate);if(q===1)g.range[e?"animate":"css"]({height:a-h+"%"},{queue:false,duration:f.animate})}h=a});else{i=this.value();j=this._valueMin();n=this._valueMax();a=n!==j?(i-j)/(n-j)*100:0;d[g.orientation==="horizontal"?"left":"bottom"]=a+"%";this.handle.stop(1,1)[e?"animate":"css"](d,f.animate);if(c==="min"&&this.orientation==="horizontal")this.range.stop(1,
1)[e?"animate":"css"]({width:a+"%"},f.animate);if(c==="max"&&this.orientation==="horizontal")this.range[e?"animate":"css"]({width:100-a+"%"},{queue:false,duration:f.animate});if(c==="min"&&this.orientation==="vertical")this.range.stop(1,1)[e?"animate":"css"]({height:a+"%"},f.animate);if(c==="max"&&this.orientation==="vertical")this.range[e?"animate":"css"]({height:100-a+"%"},{queue:false,duration:f.animate})}}});b.extend(b.ui.slider,{version:"1.8.9"})})(jQuery);
(function(b,c){function f(){return++e}function g(){return++a}var e=0,a=0;b.widget("ui.tabs",{options:{add:null,ajaxOptions:null,cache:false,cookie:null,collapsible:false,disable:null,disabled:[],enable:null,event:"click",fx:null,idPrefix:"ui-tabs-",load:null,panelTemplate:"<div></div>",remove:null,select:null,show:null,spinner:"<em>Loading&#8230;</em>",tabTemplate:"<li><a href='#{href}'><span>#{label}</span></a></li>"},_create:function(){this._tabify(true)},_setOption:function(d,h){if(d=="selected")this.options.collapsible&&
h==this.options.selected||this.select(h);else{this.options[d]=h;this._tabify()}},_tabId:function(d){return d.title&&d.title.replace(/\s/g,"_").replace(/[^\w\u00c0-\uFFFF-]/g,"")||this.options.idPrefix+f()},_sanitizeSelector:function(d){return d.replace(/:/g,"\\:")},_cookie:function(){var d=this.cookie||(this.cookie=this.options.cookie.name||"ui-tabs-"+g());return b.cookie.apply(null,[d].concat(b.makeArray(arguments)))},_ui:function(d,h){return{tab:d,panel:h,index:this.anchors.index(d)}},_cleanup:function(){this.lis.filter(".ui-state-processing").removeClass("ui-state-processing").find("span:data(label.tabs)").each(function(){var d=
b(this);d.html(d.data("label.tabs")).removeData("label.tabs")})},_tabify:function(d){function h(r,u){r.css("display","");!b.support.opacity&&u.opacity&&r[0].style.removeAttribute("filter")}var i=this,j=this.options,n=/^#.+/;this.list=this.element.find("ol,ul").eq(0);this.lis=b(" > li:has(a[href])",this.list);this.anchors=this.lis.map(function(){return b("a",this)[0]});this.panels=b([]);this.anchors.each(function(r,u){var v=b(u).attr("href"),w=v.split("#")[0],y;if(w&&(w===location.toString().split("#")[0]||
(y=b("base")[0])&&w===y.href)){v=u.hash;u.href=v}if(n.test(v))i.panels=i.panels.add(i.element.find(i._sanitizeSelector(v)));else if(v&&v!=="#"){b.data(u,"href.tabs",v);b.data(u,"load.tabs",v.replace(/#.*$/,""));v=i._tabId(u);u.href="#"+v;u=i.element.find("#"+v);if(!u.length){u=b(j.panelTemplate).attr("id",v).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").insertAfter(i.panels[r-1]||i.list);u.data("destroy.tabs",true)}i.panels=i.panels.add(u)}else j.disabled.push(r)});if(d){this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all");
this.list.addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all");this.lis.addClass("ui-state-default ui-corner-top");this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom");if(j.selected===c){location.hash&&this.anchors.each(function(r,u){if(u.hash==location.hash){j.selected=r;return false}});if(typeof j.selected!=="number"&&j.cookie)j.selected=parseInt(i._cookie(),10);if(typeof j.selected!=="number"&&this.lis.filter(".ui-tabs-selected").length)j.selected=
this.lis.index(this.lis.filter(".ui-tabs-selected"));j.selected=j.selected||(this.lis.length?0:-1)}else if(j.selected===null)j.selected=-1;j.selected=j.selected>=0&&this.anchors[j.selected]||j.selected<0?j.selected:0;j.disabled=b.unique(j.disabled.concat(b.map(this.lis.filter(".ui-state-disabled"),function(r){return i.lis.index(r)}))).sort();b.inArray(j.selected,j.disabled)!=-1&&j.disabled.splice(b.inArray(j.selected,j.disabled),1);this.panels.addClass("ui-tabs-hide");this.lis.removeClass("ui-tabs-selected ui-state-active");
if(j.selected>=0&&this.anchors.length){i.element.find(i._sanitizeSelector(i.anchors[j.selected].hash)).removeClass("ui-tabs-hide");this.lis.eq(j.selected).addClass("ui-tabs-selected ui-state-active");i.element.queue("tabs",function(){i._trigger("show",null,i._ui(i.anchors[j.selected],i.element.find(i._sanitizeSelector(i.anchors[j.selected].hash))[0]))});this.load(j.selected)}b(window).bind("unload",function(){i.lis.add(i.anchors).unbind(".tabs");i.lis=i.anchors=i.panels=null})}else j.selected=this.lis.index(this.lis.filter(".ui-tabs-selected"));
this.element[j.collapsible?"addClass":"removeClass"]("ui-tabs-collapsible");j.cookie&&this._cookie(j.selected,j.cookie);d=0;for(var q;q=this.lis[d];d++)b(q)[b.inArray(d,j.disabled)!=-1&&!b(q).hasClass("ui-tabs-selected")?"addClass":"removeClass"]("ui-state-disabled");j.cache===false&&this.anchors.removeData("cache.tabs");this.lis.add(this.anchors).unbind(".tabs");if(j.event!=="mouseover"){var l=function(r,u){u.is(":not(.ui-state-disabled)")&&u.addClass("ui-state-"+r)},k=function(r,u){u.removeClass("ui-state-"+
r)};this.lis.bind("mouseover.tabs",function(){l("hover",b(this))});this.lis.bind("mouseout.tabs",function(){k("hover",b(this))});this.anchors.bind("focus.tabs",function(){l("focus",b(this).closest("li"))});this.anchors.bind("blur.tabs",function(){k("focus",b(this).closest("li"))})}var m,o;if(j.fx)if(b.isArray(j.fx)){m=j.fx[0];o=j.fx[1]}else m=o=j.fx;var p=o?function(r,u){b(r).closest("li").addClass("ui-tabs-selected ui-state-active");u.hide().removeClass("ui-tabs-hide").animate(o,o.duration||"normal",
function(){h(u,o);i._trigger("show",null,i._ui(r,u[0]))})}:function(r,u){b(r).closest("li").addClass("ui-tabs-selected ui-state-active");u.removeClass("ui-tabs-hide");i._trigger("show",null,i._ui(r,u[0]))},s=m?function(r,u){u.animate(m,m.duration||"normal",function(){i.lis.removeClass("ui-tabs-selected ui-state-active");u.addClass("ui-tabs-hide");h(u,m);i.element.dequeue("tabs")})}:function(r,u){i.lis.removeClass("ui-tabs-selected ui-state-active");u.addClass("ui-tabs-hide");i.element.dequeue("tabs")};
this.anchors.bind(j.event+".tabs",function(){var r=this,u=b(r).closest("li"),v=i.panels.filter(":not(.ui-tabs-hide)"),w=i.element.find(i._sanitizeSelector(r.hash));if(u.hasClass("ui-tabs-selected")&&!j.collapsible||u.hasClass("ui-state-disabled")||u.hasClass("ui-state-processing")||i.panels.filter(":animated").length||i._trigger("select",null,i._ui(this,w[0]))===false){this.blur();return false}j.selected=i.anchors.index(this);i.abort();if(j.collapsible)if(u.hasClass("ui-tabs-selected")){j.selected=
-1;j.cookie&&i._cookie(j.selected,j.cookie);i.element.queue("tabs",function(){s(r,v)}).dequeue("tabs");this.blur();return false}else if(!v.length){j.cookie&&i._cookie(j.selected,j.cookie);i.element.queue("tabs",function(){p(r,w)});i.load(i.anchors.index(this));this.blur();return false}j.cookie&&i._cookie(j.selected,j.cookie);if(w.length){v.length&&i.element.queue("tabs",function(){s(r,v)});i.element.queue("tabs",function(){p(r,w)});i.load(i.anchors.index(this))}else throw"jQuery UI Tabs: Mismatching fragment identifier.";
b.browser.msie&&this.blur()});this.anchors.bind("click.tabs",function(){return false})},_getIndex:function(d){if(typeof d=="string")d=this.anchors.index(this.anchors.filter("[href$="+d+"]"));return d},destroy:function(){var d=this.options;this.abort();this.element.unbind(".tabs").removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible").removeData("tabs");this.list.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all");this.anchors.each(function(){var h=
b.data(this,"href.tabs");if(h)this.href=h;var i=b(this).unbind(".tabs");b.each(["href","load","cache"],function(j,n){i.removeData(n+".tabs")})});this.lis.unbind(".tabs").add(this.panels).each(function(){b.data(this,"destroy.tabs")?b(this).remove():b(this).removeClass("ui-state-default ui-corner-top ui-tabs-selected ui-state-active ui-state-hover ui-state-focus ui-state-disabled ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide")});d.cookie&&this._cookie(null,d.cookie);return this},add:function(d,
h,i){if(i===c)i=this.anchors.length;var j=this,n=this.options;h=b(n.tabTemplate.replace(/#\{href\}/g,d).replace(/#\{label\}/g,h));d=!d.indexOf("#")?d.replace("#",""):this._tabId(b("a",h)[0]);h.addClass("ui-state-default ui-corner-top").data("destroy.tabs",true);var q=j.element.find("#"+d);q.length||(q=b(n.panelTemplate).attr("id",d).data("destroy.tabs",true));q.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom ui-tabs-hide");if(i>=this.lis.length){h.appendTo(this.list);q.appendTo(this.list[0].parentNode)}else{h.insertBefore(this.lis[i]);
q.insertBefore(this.panels[i])}n.disabled=b.map(n.disabled,function(l){return l>=i?++l:l});this._tabify();if(this.anchors.length==1){n.selected=0;h.addClass("ui-tabs-selected ui-state-active");q.removeClass("ui-tabs-hide");this.element.queue("tabs",function(){j._trigger("show",null,j._ui(j.anchors[0],j.panels[0]))});this.load(0)}this._trigger("add",null,this._ui(this.anchors[i],this.panels[i]));return this},remove:function(d){d=this._getIndex(d);var h=this.options,i=this.lis.eq(d).remove(),j=this.panels.eq(d).remove();
if(i.hasClass("ui-tabs-selected")&&this.anchors.length>1)this.select(d+(d+1<this.anchors.length?1:-1));h.disabled=b.map(b.grep(h.disabled,function(n){return n!=d}),function(n){return n>=d?--n:n});this._tabify();this._trigger("remove",null,this._ui(i.find("a")[0],j[0]));return this},enable:function(d){d=this._getIndex(d);var h=this.options;if(b.inArray(d,h.disabled)!=-1){this.lis.eq(d).removeClass("ui-state-disabled");h.disabled=b.grep(h.disabled,function(i){return i!=d});this._trigger("enable",null,
this._ui(this.anchors[d],this.panels[d]));return this}},disable:function(d){d=this._getIndex(d);var h=this.options;if(d!=h.selected){this.lis.eq(d).addClass("ui-state-disabled");h.disabled.push(d);h.disabled.sort();this._trigger("disable",null,this._ui(this.anchors[d],this.panels[d]))}return this},select:function(d){d=this._getIndex(d);if(d==-1)if(this.options.collapsible&&this.options.selected!=-1)d=this.options.selected;else return this;this.anchors.eq(d).trigger(this.options.event+".tabs");return this},
load:function(d){d=this._getIndex(d);var h=this,i=this.options,j=this.anchors.eq(d)[0],n=b.data(j,"load.tabs");this.abort();if(!n||this.element.queue("tabs").length!==0&&b.data(j,"cache.tabs"))this.element.dequeue("tabs");else{this.lis.eq(d).addClass("ui-state-processing");if(i.spinner){var q=b("span",j);q.data("label.tabs",q.html()).html(i.spinner)}this.xhr=b.ajax(b.extend({},i.ajaxOptions,{url:n,success:function(l,k){h.element.find(h._sanitizeSelector(j.hash)).html(l);h._cleanup();i.cache&&b.data(j,
"cache.tabs",true);h._trigger("load",null,h._ui(h.anchors[d],h.panels[d]));try{i.ajaxOptions.success(l,k)}catch(m){}},error:function(l,k){h._cleanup();h._trigger("load",null,h._ui(h.anchors[d],h.panels[d]));try{i.ajaxOptions.error(l,k,d,j)}catch(m){}}}));h.element.dequeue("tabs");return this}},abort:function(){this.element.queue([]);this.panels.stop(false,true);this.element.queue("tabs",this.element.queue("tabs").splice(-2,2));if(this.xhr){this.xhr.abort();delete this.xhr}this._cleanup();return this},
url:function(d,h){this.anchors.eq(d).removeData("cache.tabs").data("load.tabs",h);return this},length:function(){return this.anchors.length}});b.extend(b.ui.tabs,{version:"1.8.9"});b.extend(b.ui.tabs.prototype,{rotation:null,rotate:function(d,h){var i=this,j=this.options,n=i._rotate||(i._rotate=function(q){clearTimeout(i.rotation);i.rotation=setTimeout(function(){var l=j.selected;i.select(++l<i.anchors.length?l:0)},d);q&&q.stopPropagation()});h=i._unrotate||(i._unrotate=!h?function(q){q.clientX&&
i.rotate(null)}:function(){t=j.selected;n()});if(d){this.element.bind("tabsshow",n);this.anchors.bind(j.event+".tabs",h);n()}else{clearTimeout(i.rotation);this.element.unbind("tabsshow",n);this.anchors.unbind(j.event+".tabs",h);delete this._rotate;delete this._unrotate}return this}})})(jQuery);

/**
 * jQuery.ScrollTo - Easy element scrolling using jQuery.
 * Copyright (c) 2007-2009 Ariel Flesler - aflesler(at)gmail(dot)com | http://flesler.blogspot.com
 * Dual licensed under MIT and GPL.
 * Date: 5/25/2009
 * @author Ariel Flesler
 * @version 1.4.2
 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);
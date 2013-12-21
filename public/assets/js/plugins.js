/**
 * Rotator
 */
(function($) {
    var default_config = {
        fadeIn: 3000,
        stay: 3000,
        fadeOut: 3000
    };

    function fade(index, $elements, config) {
        $elements.eq(index)
        .fadeIn(config.fadeIn)
        .delay(config.stay)
        .fadeOut(config.fadeOut, function() {
            fade((index + 1) % $elements.length, $elements, config);
        });
    }

    $.fn.fadeLoop = function(config) {
        fade(0, this, $.extend({}, default_config, config));
        return this;
    };

}(jQuery));
/**
 * Waypoints - v2.0.3
 */
(function() {
    var t = [].indexOf || function(t) {
        for (var e = 0, n = this.length; e < n; e++) {
            if (e in this && this[e] === t)
                return e
        }
        return -1
    }, e = [].slice;
    (function(t, e) {
        if (typeof define === "function" && define.amd) {
            return define("waypoints", ["jquery"], function(n) {
                return e(n, t)
            })
        } else {
            return e(t.jQuery, t)
        }
    })(this, function(n, r) {
        var i, o, l, s, f, u, a, c, h, d, p, y, v, w, g;
        i = n(r);
        s = {
            horizontal: {},
            vertical: {}
        };
        f = 1;
        a = {};
        u = "waypoints-context-id";
        d = "resize.waypoints";
        p = "scroll.waypoints";
        y = 1;
        v = "waypoints-waypoint-ids";
        w = "waypoint";
        g = "waypoints";
        o = function() {
            function e(t) {
                var e = this;
                this.$element = t;
                this.element = t[0];
                this.didResize = false;
                this.didScroll = false;
                this.id = "context" + f++;
                this.oldScroll = {
                    x: t.scrollLeft(),
                    y: t.scrollTop()
                };
                this.waypoints = {
                    horizontal: {},
                    vertical: {}
                };
                t.data(u, this.id);
                a[this.id] = this;
                t.bind(p, function() {
                    var t;
                    if (!e.didScroll) {
                        e.didScroll = true;
                        t = function() {
                            e.doScroll();
                            return e.didScroll = false
                        };
                        return r.setTimeout(t, n[g].settings.scrollThrottle)
                    }
                });
                t.bind(d, function() {
                    var t;
                    if (!e.didResize) {
                        e.didResize = true;
                        t = function() {
                            n[g]("refresh");
                            return e.didResize = false
                        };
                        return r.setTimeout(t, n[g].settings.resizeThrottle)
                    }
                })
            }
            e.prototype.doScroll = function() {
                var e, i = this;
                e = {
                    horizontal: {
                        newScroll: this.$element.scrollLeft(),
                        oldScroll: this.oldScroll.x,
                        forward: "right",
                        backward: "left"
                    },
                    vertical: {
                        newScroll: this.$element.scrollTop(),
                        oldScroll: this.oldScroll.y,
                        forward: "down",
                        backward: "up"
                    }
                };
                if (t.call(r, "ontouchstart") >= 0 && (!e.vertical.oldScroll ||!e.vertical.newScroll)) {
                    n[g]("refresh")
                }
                n.each(e, function(t, e) {
                    var r, o, l;
                    l = [];
                    o = e.newScroll > e.oldScroll;
                    r = o ? e.forward : e.backward;
                    n.each(i.waypoints[t], function(t, n) {
                        var r, i;
                        if (e.oldScroll < (r = n.offset) && r <= e.newScroll) {
                            return l.push(n)
                        } else if (e.newScroll < (i = n.offset) && i <= e.oldScroll) {
                            return l.push(n)
                        }
                    });
                    l.sort(function(t, e) {
                        return t.offset - e.offset
                    });
                    if (!o) {
                        l.reverse()
                    }
                    return n.each(l, function(t, e) {
                        if (e.options.continuous || t === l.length-1) {
                            return e.trigger([r])
                        }
                    })
                });
                return this.oldScroll = {
                    x: e.horizontal.newScroll,
                    y: e.vertical.newScroll
                }
            };
            e.prototype.refresh = function() {
                var t, e, r, i = this;
                r = n.isWindow(this.element);
                e = this.$element.offset();
                this.doScroll();
                t = {
                    horizontal: {
                        contextOffset: r ? 0: e.left,
                        contextScroll: r ? 0: this.oldScroll.x,
                        contextDimension: this.$element.width(),
                        oldScroll: this.oldScroll.x,
                        forward: "right",
                        backward: "left",
                        offsetProp: "left"
                    },
                    vertical: {
                        contextOffset: r ? 0: e.top,
                        contextScroll: r ? 0: this.oldScroll.y,
                        contextDimension: r ? n[g]("viewportHeight"): this.$element.height(),
                        oldScroll: this.oldScroll.y,
                        forward: "down",
                        backward: "up",
                        offsetProp: "top"
                    }
                };
                return n.each(t, function(t, e) {
                    return n.each(i.waypoints[t], function(t, r) {
                        var i, o, l, s, f;
                        i = r.options.offset;
                        l = r.offset;
                        o = n.isWindow(r.element) ? 0 : r.$element.offset()[e.offsetProp];
                        if (n.isFunction(i)) {
                            i = i.apply(r.element)
                        } else if (typeof i === "string") {
                            i = parseFloat(i);
                            if (r.options.offset.indexOf("%")>-1) {
                                i = Math.ceil(e.contextDimension * i / 100)
                            }
                        }
                        r.offset = o - e.contextOffset + e.contextScroll - i;
                        if (r.options.onlyOnScroll && l != null ||!r.enabled) {
                            return 
                        }
                        if (l !== null && l < (s = e.oldScroll) && s <= r.offset) {
                            return r.trigger([e.backward])
                        } else if (l !== null && l > (f = e.oldScroll) && f >= r.offset) {
                            return r.trigger([e.forward])
                        } else if (l === null && e.oldScroll >= r.offset) {
                            return r.trigger([e.forward])
                        }
                    })
                })
            };
            e.prototype.checkEmpty = function() {
                if (n.isEmptyObject(this.waypoints.horizontal) && n.isEmptyObject(this.waypoints.vertical)) {
                    this.$element.unbind([d, p].join(" "));
                    return delete a[this.id]
                }
            };
            return e
        }();
        l = function() {
            function t(t, e, r) {
                var i, o;
                r = n.extend({}, n.fn[w].defaults, r);
                if (r.offset === "bottom-in-view") {
                    r.offset = function() {
                        var t;
                        t = n[g]("viewportHeight");
                        if (!n.isWindow(e.element)) {
                            t = e.$element.height()
                        }
                        return t - n(this).outerHeight()
                    }
                }
                this.$element = t;
                this.element = t[0];
                this.axis = r.horizontal ? "horizontal" : "vertical";
                this.callback = r.handler;
                this.context = e;
                this.enabled = r.enabled;
                this.id = "waypoints" + y++;
                this.offset = null;
                this.options = r;
                e.waypoints[this.axis][this.id] = this;
                s[this.axis][this.id] = this;
                i = (o = t.data(v)) != null ? o : [];
                i.push(this.id);
                t.data(v, i)
            }
            t.prototype.trigger = function(t) {
                if (!this.enabled) {
                    return 
                }
                if (this.callback != null) {
                    this.callback.apply(this.element, t)
                }
                if (this.options.triggerOnce) {
                    return this.destroy()
                }
            };
            t.prototype.disable = function() {
                return this.enabled = false
            };
            t.prototype.enable = function() {
                this.context.refresh();
                return this.enabled = true
            };
            t.prototype.destroy = function() {
                delete s[this.axis][this.id];
                delete this.context.waypoints[this.axis][this.id];
                return this.context.checkEmpty()
            };
            t.getWaypointsByElement = function(t) {
                var e, r;
                r = n(t).data(v);
                if (!r) {
                    return []
                }
                e = n.extend({}, s.horizontal, s.vertical);
                return n.map(r, function(t) {
                    return e[t]
                })
            };
            return t
        }();
        h = {
            init: function(t, e) {
                var r;
                if (e == null) {
                    e = {}
                }
                if ((r = e.handler) == null) {
                    e.handler = t
                }
                this.each(function() {
                    var t, r, i, s;
                    t = n(this);
                    i = (s = e.context) != null ? s : n.fn[w].defaults.context;
                    if (!n.isWindow(i)) {
                        i = t.closest(i)
                    }
                    i = n(i);
                    r = a[i.data(u)];
                    if (!r) {
                        r = new o(i)
                    }
                    return new l(t, r, e)
                });
                n[g]("refresh");
                return this
            },
            disable: function() {
                return h._invoke(this, "disable")
            },
            enable: function() {
                return h._invoke(this, "enable")
            },
            destroy: function() {
                return h._invoke(this, "destroy")
            },
            prev: function(t, e) {
                return h._traverse.call(this, t, e, function(t, e, n) {
                    if (e > 0) {
                        return t.push(n[e-1])
                    }
                })
            },
            next: function(t, e) {
                return h._traverse.call(this, t, e, function(t, e, n) {
                    if (e < n.length-1) {
                        return t.push(n[e + 1])
                    }
                })
            },
            _traverse: function(t, e, i) {
                var o, l;
                if (t == null) {
                    t = "vertical"
                }
                if (e == null) {
                    e = r
                }
                l = c.aggregate(e);
                o = [];
                this.each(function() {
                    var e;
                    e = n.inArray(this, l[t]);
                    return i(o, e, l[t])
                });
                return this.pushStack(o)
            },
            _invoke: function(t, e) {
                t.each(function() {
                    var t;
                    t = l.getWaypointsByElement(this);
                    return n.each(t, function(t, n) {
                        n[e]();
                        return true
                    })
                });
                return this
            }
        };
        n.fn[w] = function() {
            var t, r;
            r = arguments[0], t = 2 <= arguments.length ? e.call(arguments, 1) : [];
            if (h[r]) {
                return h[r].apply(this, t)
            } else if (n.isFunction(r)) {
                return h.init.apply(this, arguments)
            } else if (n.isPlainObject(r)) {
                return h.init.apply(this, [null, r])
            } else if (!r) {
                return n.error("jQuery Waypoints needs a callback function or handler option.")
            } else {
                return n.error("The " + r + " method does not exist in jQuery Waypoints.")
            }
        };
        n.fn[w].defaults = {
            context: r,
            continuous: true,
            enabled: true,
            horizontal: false,
            offset: 0,
            triggerOnce: false
        };
        c = {
            refresh: function() {
                return n.each(a, function(t, e) {
                    return e.refresh()
                })
            },
            viewportHeight: function() {
                var t;
                return (t = r.innerHeight) != null ? t : i.height()
            },
            aggregate: function(t) {
                var e, r, i;
                e = s;
                if (t) {
                    e = (i = a[n(t).data(u)]) != null ? i.waypoints : void 0
                }
                if (!e) {
                    return []
                }
                r = {
                    horizontal: [],
                    vertical: []
                };
                n.each(r, function(t, i) {
                    n.each(e[t], function(t, e) {
                        return i.push(e)
                    });
                    i.sort(function(t, e) {
                        return t.offset - e.offset
                    });
                    r[t] = n.map(i, function(t) {
                        return t.element
                    });
                    return r[t] = n.unique(r[t])
                });
                return r
            },
            above: function(t) {
                if (t == null) {
                    t = r
                }
                return c._filter(t, "vertical", function(t, e) {
                    return e.offset <= t.oldScroll.y
                })
            },
            below: function(t) {
                if (t == null) {
                    t = r
                }
                return c._filter(t, "vertical", function(t, e) {
                    return e.offset > t.oldScroll.y
                })
            },
            left: function(t) {
                if (t == null) {
                    t = r
                }
                return c._filter(t, "horizontal", function(t, e) {
                    return e.offset <= t.oldScroll.x
                })
            },
            right: function(t) {
                if (t == null) {
                    t = r
                }
                return c._filter(t, "horizontal", function(t, e) {
                    return e.offset > t.oldScroll.x
                })
            },
            enable: function() {
                return c._invoke("enable")
            },
            disable: function() {
                return c._invoke("disable")
            },
            destroy: function() {
                return c._invoke("destroy")
            },
            extendFn: function(t, e) {
                return h[t] = e
            },
            _invoke: function(t) {
                var e;
                e = n.extend({}, s.vertical, s.horizontal);
                return n.each(e, function(e, n) {
                    n[t]();
                    return true
                })
            },
            _filter: function(t, e, r) {
                var i, o;
                i = a[n(t).data(u)];
                if (!i) {
                    return []
                }
                o = [];
                n.each(i.waypoints[e], function(t, e) {
                    if (r(i, e)) {
                        return o.push(e)
                    }
                });
                o.sort(function(t, e) {
                    return t.offset - e.offset
                });
                return n.map(o, function(t) {
                    return t.element
                })
            }
        };
        n[g] = function() {
            var t, n;
            n = arguments[0], t = 2 <= arguments.length ? e.call(arguments, 1) : [];
            if (c[n]) {
                return c[n].apply(null, t)
            } else {
                return c.aggregate.call(null, n)
            }
        };
        n[g].settings = {
            resizeThrottle: 100,
            scrollThrottle: 30
        };
        return i.load(function() {
            return n[g]("refresh")
        })
    })
}).call(this);
/**
 * Uniform
 */
(function(e, t) {
    "use strict";
    function n(e) {
        var t = Array.prototype.slice.call(arguments, 1);
        return e.prop ? e.prop.apply(e, t) : e.attr.apply(e, t)
    }
    function s(e, t, n) {
        var s, a;
        for (s in n)
            n.hasOwnProperty(s) && (a = s.replace(/ |$/g, t.eventNamespace), e.bind(a, n[s]))
    }
    function a(e, t, n) {
        s(e, n, {
            focus: function() {
                t.addClass(n.focusClass)
            },
            blur: function() {
                t.removeClass(n.focusClass), t.removeClass(n.activeClass)
            },
            mouseenter: function() {
                t.addClass(n.hoverClass)
            },
            mouseleave: function() {
                t.removeClass(n.hoverClass), t.removeClass(n.activeClass)
            },
            "mousedown touchbegin": function() {
                e.is(":disabled") || t.addClass(n.activeClass)
            },
            "mouseup touchend": function() {
                t.removeClass(n.activeClass)
            }
        })
    }
    function i(e, t) {
        e.removeClass(t.hoverClass + " " + t.focusClass + " " + t.activeClass)
    }
    function r(e, t, n) {
        n ? e.addClass(t) : e.removeClass(t)
    }
    function l(e, t, n) {
        var s = "checked", a = t.is(":" + s);
        t.prop ? t.prop(s, a) : a ? t.attr(s, s) : t.removeAttr(s), r(e, n.checkedClass, a)
    }
    function u(e, t, n) {
        r(e, n.disabledClass, t.is(":disabled"))
    }
    function o(e, t, n) {
        switch (n) {
        case"after":
            return e.after(t), e.next();
        case"before":
            return e.before(t), e.prev();
        case"wrap":
            return e.wrap(t), e.parent()
        }
        return null
    }
    function c(t, s, a) {
        var i, r, l;
        return a || (a = {}), a = e.extend({
            bind: {},
            divClass: null,
            divWrap: "wrap",
            spanClass: null,
            spanHtml: null,
            spanWrap: "wrap"
        }, a), i = e("<div />"), r = e("<span />"), s.autoHide && t.is(":hidden") && "none" === t.css("display") && i.hide(), a.divClass && i.addClass(a.divClass), s.wrapperClass && i.addClass(s.wrapperClass), a.spanClass && r.addClass(a.spanClass), l = n(t, "id"), s.useID && l && n(i, "id", s.idPrefix + "-" + l), a.spanHtml && r.html(a.spanHtml), i = o(t, i, a.divWrap), r = o(t, r, a.spanWrap), u(i, t, s), {
            div: i, span: r
        }
    }
    function d(t, n) {
        var s;
        return n.wrapperClass ? (s = e("<span />").addClass(n.wrapperClass), s = o(t, s, "wrap")) : null
    }
    function f() {
        var t, n, s, a;
        return a = "rgb(120,2,153)", n = e('<div style="width:0;height:0;color:' + a + '" />'), e("body").append(n), s = n.get(0), t = window.getComputedStyle ? window.getComputedStyle(s, "").color : (s.currentStyle || s.style || {}).color, n.remove(), t.replace(/ /g, "") !== a
    }
    function p(t) {
        return t ? e("<span />").text(t).html() : ""
    }
    function m() {
        return navigator.cpuClass&&!navigator.product
    }
    function v() {
        return window.XMLHttpRequest !== void 0?!0 : !1
    }
    function h(e) {
        var t;
        return e[0].multiple?!0 : (t = n(e, "size"), !t || 1 >= t?!1 : !0)
    }
    function C() {
        return !1
    }
    function w(e, t) {
        var n = "none";
        s(e, t, {
            "selectstart dragstart mousedown": C
        }), e.css({
            MozUserSelect: n,
            msUserSelect: n,
            webkitUserSelect: n,
            userSelect: n
        })
    }
    function b(e, t, n) {
        var s = e.val();
        "" === s ? s = n.fileDefaultHtml : (s = s.split(/[\/\\]+/), s = s[s.length-1]), t.text(s)
    }
    function y(e, t, n) {
        var s, a;
        for (s = [], e.each(function() {
            var e;
            for (e in t)Object.prototype.hasOwnProperty.call(t, e) && (s.push({
                el: this, name: e, old: this.style[e]
            })
                , this.style[e] = t[e])
        }), n();
        s.length;
        )a = s.pop(), a.el.style[a.name] = a.old
    }
    function g(e, t) {
        var n;
        n = e.parents(), n.push(e[0]), n = n.not(":visible"), y(n, {
            visibility: "hidden",
            display: "block",
            position: "absolute"
        }, t)
    }
    function k(e, t) {
        return function() {
            e.unwrap().unwrap().unbind(t.eventNamespace)
        }
    }
    var H=!0, x=!1, A = [{
        match: function(e) {
            return e.is("a, button, :submit, :reset, input[type='button']")
        },
        apply: function(e, t) {
            var r, l, o, d, f;
            return l = t.submitDefaultHtml, e.is(":reset") && (l = t.resetDefaultHtml), d = e.is("a, button") ? function() {
                return e.html() || l
            } : function() {
                return p(n(e, "value")) || l
            }, o = c(e, t, {
                divClass: t.buttonClass,
                spanHtml: d()
            }), r = o.div, a(e, r, t), f=!1, s(r, t, {
                "click touchend": function() {
                    var t, s, a, i;
                    f || e.is(":disabled") || (f=!0, e[0].dispatchEvent ? (t = document.createEvent("MouseEvents"), t.initEvent("click", !0, !0), s = e[0].dispatchEvent(t), e.is("a") && s && (a = n(e, "target"), i = n(e, "href"), a && "_self" !== a ? window.open(i, a) : document.location.href = i)) : e.click(), f=!1)
                }
            }), w(r, t), {
                remove: function() {
                    return r.after(e), r.remove(), e.unbind(t.eventNamespace), e
                }, update: function() {
                    i(r, t), u(r, e, t), e.detach(), o.span.html(d()).append(e)
                }
            }
        }
    }, {
        match: function(e) {
            return e.is(":checkbox")
        },
        apply: function(e, t) {
            var n, r, o;
            return n = c(e, t, {
                divClass: t.checkboxClass
            }), r = n.div, o = n.span, a(e, r, t), s(e, t, {
                "click touchend": function() {
                    l(o, e, t)
                }
            }), l(o, e, t), {
                remove: k(e, t), update: function() {
                    i(r, t), o.removeClass(t.checkedClass), l(o, e, t), u(r, e, t)
                }
            }
        }
    }, {
        match: function(e) {
            return e.is(":file")
        },
        apply: function(t, r) {
            function l() {
                b(t, p, r)
            }
            var d, f, p, v;
            return d = c(t, r, {
                divClass: r.fileClass,
                spanClass: r.fileButtonClass,
                spanHtml: r.fileButtonHtml,
                spanWrap: "after"
            }), f = d.div, v = d.span, p = e("<span />").html(r.fileDefaultHtml), p.addClass(r.filenameClass), p = o(t, p, "after"), n(t, "size") || n(t, "size", f.width() / 10), a(t, f, r), l(), m() ? s(t, r, {
                click: function() {
                    t.trigger("change"), setTimeout(l, 0)
                }
            }) : s(t, r, {
                change: l
            }), w(p, r), w(v, r), {
                remove: function() {
                    return p.remove(), v.remove(), t.unwrap().unbind(r.eventNamespace)
                }, update: function() {
                    i(f, r), b(t, p, r), u(f, t, r)
                }
            }
        }
    }, {
        match: function(e) {
            if (e.is("input")) {
                var t = (" " + n(e, "type") + " ").toLowerCase(), s = " color date datetime datetime-local email month number password search tel text time url week ";
                return s.indexOf(t) >= 0
            }
            return !1
        },
        apply: function(e, t) {
            var s, i;
            return s = n(e, "type"), e.addClass(t.inputClass), i = d(e, t), a(e, e, t), t.inputAddTypeAsClass && e.addClass(s), {
                remove: function() {
                    e.removeClass(t.inputClass), t.inputAddTypeAsClass && e.removeClass(s), i && e.unwrap()
                }, update: C
            }
        }
    }, {
        match: function(e) {
            return e.is(":radio")
        },
        apply: function(t, r) {
            var o, d, f;
            return o = c(t, r, {
                divClass: r.radioClass
            }), d = o.div, f = o.span, a(t, d, r), s(t, r, {
                "click touchend": function() {
                    e.uniform.update(e(':radio[name="' + n(t, "name") + '"]'))
                }
            }), l(f, t, r), {
                remove: k(t, r), update: function() {
                    i(d, r), l(f, t, r), u(d, t, r)
                }
            }
        }
    }, {
        match: function(e) {
            return e.is("select")&&!h(e)?!0 : !1
        },
        apply: function(t, n) {
            var r, l, o, d;
            return n.selectAutoWidth && g(t, function() {
                d = t.width()
            }), r = c(t, n, {
                divClass: n.selectClass,
                spanHtml: (t.find(":selected:first") || t.find("option:first")).html(),
                spanWrap: "before"
            }), l = r.div, o = r.span, n.selectAutoWidth ? g(t, function() {
                y(e([o[0], l[0]]), {
                    display: "block"
                }, function() {
                    var e;
                    e = o.outerWidth() - o.width(), l.width(d + e), o.width(d)
                })
            }) : l.addClass("fixedWidth"), a(t, l, n), s(t, n, {
                change: function() {
                    o.html(t.find(":selected").html()), l.removeClass(n.activeClass)
                },
                "click touchend": function() {
                    var e = t.find(":selected").html();
                    o.html() !== e && t.trigger("change")
                },
                keyup: function() {
                    o.html(t.find(":selected").html())
                }
            }), w(o, n), {
                remove: function() {
                    return o.remove(), t.unwrap().unbind(n.eventNamespace), t
                }, update: function() {
                    n.selectAutoWidth ? (e.uniform.restore(t), t.uniform(n)) : (i(l, n), o.html(t.find(":selected").html()), u(l, t, n))
                }
            }
        }
    }, {
        match: function(e) {
            return e.is("select") && h(e)?!0 : !1
        },
        apply: function(e, t) {
            var n;
            return e.addClass(t.selectMultiClass), n = d(e, t), a(e, e, t), {
                remove: function() {
                    e.removeClass(t.selectMultiClass), n && e.unwrap()
                }, update: C
            }
        }
    }, {
        match: function(e) {
            return e.is("textarea")
        },
        apply: function(e, t) {
            var n;
            return e.addClass(t.textareaClass), n = d(e, t), a(e, e, t), {
                remove: function() {
                    e.removeClass(t.textareaClass), n && e.unwrap()
                }, update: C
            }
        }
    }
    ];
    m()&&!v() && (H=!1), e.uniform = {
        defaults: {
            activeClass: "active",
            autoHide: !0,
            buttonClass: "button",
            checkboxClass: "checker",
            checkedClass: "checked",
            disabledClass: "disabled",
            eventNamespace: ".uniform",
            fileButtonClass: "action",
            fileButtonHtml: "Choose File",
            fileClass: "uploader",
            fileDefaultHtml: "No file selected",
            filenameClass: "filename",
            focusClass: "focus",
            hoverClass: "hover",
            idPrefix: "uniform",
            inputAddTypeAsClass: !0,
            inputClass: "uniform-input",
            radioClass: "radio",
            resetDefaultHtml: "Reset",
            resetSelector: !1,
            selectAutoWidth: !0,
            selectClass: "selector",
            selectMultiClass: "uniform-multiselect",
            submitDefaultHtml: "Submit",
            textareaClass: "uniform",
            useID: !0,
            wrapperClass: null
        },
        elements: []
    }, e.fn.uniform = function(t) {
        var n = this;
        return t = e.extend({}, e.uniform.defaults, t), x || (x=!0, f() && (H=!1)), H ? (t.resetSelector && e(t.resetSelector).mouseup(function() {
            window.setTimeout(function() {
                e.uniform.update(n)
            }, 10)
        }), this.each(function() {
            var n, s, a, i = e(this);
            if (i.data("uniformed"))return e.uniform.update(i), void 0;
            for (n = 0;
            A.length > n;
            n += 1)if (s = A[n], s.match(i, t))return a = s.apply(i, t), i.data("uniformed", a), e.uniform.elements.push(i.get(0)), void 0
        })) : this
    }, e.uniform.restore = e.fn.uniform.restore = function(n) {
        n === t && (n = e.uniform.elements), e(n).each(function() {
            var t, n, s = e(this);
            n = s.data("uniformed"), n && (n.remove(), t = e.inArray(this, e.uniform.elements), t >= 0 && e.uniform.elements.splice(t, 1), s.removeData("uniformed"))
        })
    }, e.uniform.update = e.fn.uniform.update = function(n) {
        n === t && (n = e.uniform.elements), e(n).each(function() {
            var t, n = e(this);
            t = n.data("uniformed"), t && t.update(n, t.options)
        })
    }
})(jQuery);
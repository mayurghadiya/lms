if ("undefined" == typeof jQuery) throw new Error("Bootstrap's JavaScript requires jQuery");
if (+ function(a) {
        "use strict";
        var b = a.fn.jquery.split(" ")[0].split(".");
        if (b[0] < 2 && b[1] < 9 || 1 == b[0] && 9 == b[1] && b[2] < 1) throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher")
    }(jQuery), + function(a) {
        "use strict";

        function b() {
            var a = document.createElement("bootstrap"),
                b = {
                    WebkitTransition: "webkitTransitionEnd",
                    MozTransition: "transitionend",
                    OTransition: "oTransitionEnd otransitionend",
                    transition: "transitionend"
                };
            for (var c in b)
                if (void 0 !== a.style[c]) return {
                    end: b[c]
                };
            return !1
        }
        a.fn.emulateTransitionEnd = function(b) {
            var c = !1,
                d = this;
            a(this).one("bsTransitionEnd", function() {
                c = !0
            });
            var e = function() {
                c || a(d).trigger(a.support.transition.end)
            };
            return setTimeout(e, b), this
        }, a(function() {
            a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
                bindType: a.support.transition.end,
                delegateType: a.support.transition.end,
                handle: function(b) {
                    return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0
                }
            })
        })
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var c = a(this),
                    e = c.data("bs.alert");
                e || c.data("bs.alert", e = new d(this)), "string" == typeof b && e[b].call(c)
            })
        }
        var c = '[data-dismiss="alert"]',
            d = function(b) {
                a(b).on("click", c, this.close)
            };
        d.VERSION = "3.3.4", d.TRANSITION_DURATION = 150, d.prototype.close = function(b) {
            function c() {
                g.detach().trigger("closed.bs.alert").remove()
            }
            var e = a(this),
                f = e.attr("data-target");
            f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
            var g = a(f);
            b && b.preventDefault(), g.length || (g = e.closest(".alert")), g.trigger(b = a.Event("close.bs.alert")), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one("bsTransitionEnd", c).emulateTransitionEnd(d.TRANSITION_DURATION) : c())
        };
        var e = a.fn.alert;
        a.fn.alert = b, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function() {
            return a.fn.alert = e, this
        }, a(document).on("click.bs.alert.data-api", c, d.prototype.close)
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.button"),
                    f = "object" == typeof b && b;
                e || d.data("bs.button", e = new c(this, f)), "toggle" == b ? e.toggle() : b && e.setState(b)
            })
        }
        var c = function(b, d) {
            this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.isLoading = !1
        };
        c.VERSION = "3.3.4", c.DEFAULTS = {
            loadingText: "loading..."
        }, c.prototype.setState = function(b) {
            var c = "disabled",
                d = this.$element,
                e = d.is("input") ? "val" : "html",
                f = d.data();
            b += "Text", null == f.resetText && d.data("resetText", d[e]()), setTimeout(a.proxy(function() {
                d[e](null == f[b] ? this.options[b] : f[b]), "loadingText" == b ? (this.isLoading = !0, d.addClass(c).attr(c, c)) : this.isLoading && (this.isLoading = !1, d.removeClass(c).removeAttr(c))
            }, this), 0)
        }, c.prototype.toggle = function() {
            var a = !0,
                b = this.$element.closest('[data-toggle="buttons"]');
            if (b.length) {
                var c = this.$element.find("input");
                "radio" == c.prop("type") && (c.prop("checked") && this.$element.hasClass("active") ? a = !1 : b.find(".active").removeClass("active")), a && c.prop("checked", !this.$element.hasClass("active")).trigger("change")
            } else this.$element.attr("aria-pressed", !this.$element.hasClass("active"));
            a && this.$element.toggleClass("active")
        };
        var d = a.fn.button;
        a.fn.button = b, a.fn.button.Constructor = c, a.fn.button.noConflict = function() {
            return a.fn.button = d, this
        }, a(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function(c) {
            var d = a(c.target);
            d.hasClass("btn") || (d = d.closest(".btn")), b.call(d, "toggle"), c.preventDefault()
        }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function(b) {
            a(b.target).closest(".btn").toggleClass("focus", /^focus(in)?$/.test(b.type))
        })
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.carousel"),
                    f = a.extend({}, c.DEFAULTS, d.data(), "object" == typeof b && b),
                    g = "string" == typeof b ? b : f.slide;
                e || d.data("bs.carousel", e = new c(this, f)), "number" == typeof b ? e.to(b) : g ? e[g]() : f.interval && e.pause().cycle()
            })
        }
        var c = function(b, c) {
            this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = null, this.sliding = null, this.interval = null, this.$active = null, this.$items = null, this.options.keyboard && this.$element.on("keydown.bs.carousel", a.proxy(this.keydown, this)), "hover" == this.options.pause && !("ontouchstart" in document.documentElement) && this.$element.on("mouseenter.bs.carousel", a.proxy(this.pause, this)).on("mouseleave.bs.carousel", a.proxy(this.cycle, this))
        };
        c.VERSION = "3.3.4", c.TRANSITION_DURATION = 600, c.DEFAULTS = {
            interval: 5e3,
            pause: "hover",
            wrap: !0,
            keyboard: !0
        }, c.prototype.keydown = function(a) {
            if (!/input|textarea/i.test(a.target.tagName)) {
                switch (a.which) {
                    case 37:
                        this.prev();
                        break;
                    case 39:
                        this.next();
                        break;
                    default:
                        return
                }
                a.preventDefault()
            }
        }, c.prototype.cycle = function(b) {
            return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this
        }, c.prototype.getItemIndex = function(a) {
            return this.$items = a.parent().children(".item"), this.$items.index(a || this.$active)
        }, c.prototype.getItemForDirection = function(a, b) {
            var c = this.getItemIndex(b),
                d = "prev" == a && 0 === c || "next" == a && c == this.$items.length - 1;
            if (d && !this.options.wrap) return b;
            var e = "prev" == a ? -1 : 1,
                f = (c + e) % this.$items.length;
            return this.$items.eq(f)
        }, c.prototype.to = function(a) {
            var b = this,
                c = this.getItemIndex(this.$active = this.$element.find(".item.active"));
            return a > this.$items.length - 1 || 0 > a ? void 0 : this.sliding ? this.$element.one("slid.bs.carousel", function() {
                b.to(a)
            }) : c == a ? this.pause().cycle() : this.slide(a > c ? "next" : "prev", this.$items.eq(a))
        }, c.prototype.pause = function(b) {
            return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
        }, c.prototype.next = function() {
            return this.sliding ? void 0 : this.slide("next")
        }, c.prototype.prev = function() {
            return this.sliding ? void 0 : this.slide("prev")
        }, c.prototype.slide = function(b, d) {
            var e = this.$element.find(".item.active"),
                f = d || this.getItemForDirection(b, e),
                g = this.interval,
                h = "next" == b ? "left" : "right",
                i = this;
            if (f.hasClass("active")) return this.sliding = !1;
            var j = f[0],
                k = a.Event("slide.bs.carousel", {
                    relatedTarget: j,
                    direction: h
                });
            if (this.$element.trigger(k), !k.isDefaultPrevented()) {
                if (this.sliding = !0, g && this.pause(), this.$indicators.length) {
                    this.$indicators.find(".active").removeClass("active");
                    var l = a(this.$indicators.children()[this.getItemIndex(f)]);
                    l && l.addClass("active")
                }
                var m = a.Event("slid.bs.carousel", {
                    relatedTarget: j,
                    direction: h
                });
                return a.support.transition && this.$element.hasClass("slide") ? (f.addClass(b), f[0].offsetWidth, e.addClass(h), f.addClass(h), e.one("bsTransitionEnd", function() {
                    f.removeClass([b, h].join(" ")).addClass("active"), e.removeClass(["active", h].join(" ")), i.sliding = !1, setTimeout(function() {
                        i.$element.trigger(m)
                    }, 0)
                }).emulateTransitionEnd(c.TRANSITION_DURATION)) : (e.removeClass("active"), f.addClass("active"), this.sliding = !1, this.$element.trigger(m)), g && this.cycle(), this
            }
        };
        var d = a.fn.carousel;
        a.fn.carousel = b, a.fn.carousel.Constructor = c, a.fn.carousel.noConflict = function() {
            return a.fn.carousel = d, this
        };
        var e = function(c) {
            var d, e = a(this),
                f = a(e.attr("data-target") || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""));
            if (f.hasClass("carousel")) {
                var g = a.extend({}, f.data(), e.data()),
                    h = e.attr("data-slide-to");
                h && (g.interval = !1), b.call(f, g), h && f.data("bs.carousel").to(h), c.preventDefault()
            }
        };
        a(document).on("click.bs.carousel.data-api", "[data-slide]", e).on("click.bs.carousel.data-api", "[data-slide-to]", e), a(window).on("load", function() {
            a('[data-ride="carousel"]').each(function() {
                var c = a(this);
                b.call(c, c.data())
            })
        })
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            var c, d = b.attr("data-target") || (c = b.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "");
            return a(d)
        }

        function c(b) {
            return this.each(function() {
                var c = a(this),
                    e = c.data("bs.collapse"),
                    f = a.extend({}, d.DEFAULTS, c.data(), "object" == typeof b && b);
                !e && f.toggle && /show|hide/.test(b) && (f.toggle = !1), e || c.data("bs.collapse", e = new d(this, f)), "string" == typeof b && e[b]()
            })
        }
        var d = function(b, c) {
            this.$element = a(b), this.options = a.extend({}, d.DEFAULTS, c), this.$trigger = a('[data-toggle="collapse"][href="#' + b.id + '"],[data-toggle="collapse"][data-target="#' + b.id + '"]'), this.transitioning = null, this.options.parent ? this.$parent = this.getParent() : this.addAriaAndCollapsedClass(this.$element, this.$trigger), this.options.toggle && this.toggle()
        };
        d.VERSION = "3.3.4", d.TRANSITION_DURATION = 350, d.DEFAULTS = {
            toggle: !0
        }, d.prototype.dimension = function() {
            var a = this.$element.hasClass("width");
            return a ? "width" : "height"
        }, d.prototype.show = function() {
            if (!this.transitioning && !this.$element.hasClass("in")) {
                var b, e = this.$parent && this.$parent.children(".panel").children(".in, .collapsing");
                if (!(e && e.length && (b = e.data("bs.collapse"), b && b.transitioning))) {
                    var f = a.Event("show.bs.collapse");
                    if (this.$element.trigger(f), !f.isDefaultPrevented()) {
                        e && e.length && (c.call(e, "hide"), b || e.data("bs.collapse", null));
                        var g = this.dimension();
                        this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded", !0), this.$trigger.removeClass("collapsed").attr("aria-expanded", !0), this.transitioning = 1;
                        var h = function() {
                            this.$element.removeClass("collapsing").addClass("collapse in")[g](""), this.transitioning = 0, this.$element.trigger("shown.bs.collapse")
                        };
                        if (!a.support.transition) return h.call(this);
                        var i = a.camelCase(["scroll", g].join("-"));
                        this.$element.one("bsTransitionEnd", a.proxy(h, this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])
                    }
                }
            }
        }, d.prototype.hide = function() {
            if (!this.transitioning && this.$element.hasClass("in")) {
                var b = a.Event("hide.bs.collapse");
                if (this.$element.trigger(b), !b.isDefaultPrevented()) {
                    var c = this.dimension();
                    this.$element[c](this.$element[c]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded", !1), this.$trigger.addClass("collapsed").attr("aria-expanded", !1), this.transitioning = 1;
                    var e = function() {
                        this.transitioning = 0, this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                    };
                    return a.support.transition ? void this.$element[c](0).one("bsTransitionEnd", a.proxy(e, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : e.call(this)
                }
            }
        }, d.prototype.toggle = function() {
            this[this.$element.hasClass("in") ? "hide" : "show"]()
        }, d.prototype.getParent = function() {
            return a(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each(a.proxy(function(c, d) {
                var e = a(d);
                this.addAriaAndCollapsedClass(b(e), e)
            }, this)).end()
        }, d.prototype.addAriaAndCollapsedClass = function(a, b) {
            var c = a.hasClass("in");
            a.attr("aria-expanded", c), b.toggleClass("collapsed", !c).attr("aria-expanded", c)
        };
        var e = a.fn.collapse;
        a.fn.collapse = c, a.fn.collapse.Constructor = d, a.fn.collapse.noConflict = function() {
            return a.fn.collapse = e, this
        }, a(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(d) {
            var e = a(this);
            e.attr("data-target") || d.preventDefault();
            var f = b(e),
                g = f.data("bs.collapse"),
                h = g ? "toggle" : e.data();
            c.call(f, h)
        })
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            b && 3 === b.which || (a(e).remove(), a(f).each(function() {
                var d = a(this),
                    e = c(d),
                    f = {
                        relatedTarget: this
                    };
                e.hasClass("open") && (b && "click" == b.type && /input|textarea/i.test(b.target.tagName) && a.contains(e[0], b.target) || (e.trigger(b = a.Event("hide.bs.dropdown", f)), b.isDefaultPrevented() || (d.attr("aria-expanded", "false"), e.removeClass("open").trigger("hidden.bs.dropdown", f))))
            }))
        }

        function c(b) {
            var c = b.attr("data-target");
            c || (c = b.attr("href"), c = c && /#[A-Za-z]/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
            var d = c && a(c);
            return d && d.length ? d : b.parent()
        }

        function d(b) {
            return this.each(function() {
                var c = a(this),
                    d = c.data("bs.dropdown");
                d || c.data("bs.dropdown", d = new g(this)), "string" == typeof b && d[b].call(c)
            })
        }
        var e = ".dropdown-backdrop",
            f = '[data-toggle="dropdown"]',
            g = function(b) {
                a(b).on("click.bs.dropdown", this.toggle)
            };
        g.VERSION = "3.3.4", g.prototype.toggle = function(d) {
            var e = a(this);
            if (!e.is(".disabled, :disabled")) {
                var f = c(e),
                    g = f.hasClass("open");
                if (b(), !g) {
                    "ontouchstart" in document.documentElement && !f.closest(".navbar-nav").length && a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click", b);
                    var h = {
                        relatedTarget: this
                    };
                    if (f.trigger(d = a.Event("show.bs.dropdown", h)), d.isDefaultPrevented()) return;
                    e.trigger("focus").attr("aria-expanded", "true"), f.toggleClass("open").trigger("shown.bs.dropdown", h)
                }
                return !1
            }
        }, g.prototype.keydown = function(b) {
            if (/(38|40|27|32)/.test(b.which) && !/input|textarea/i.test(b.target.tagName)) {
                var d = a(this);
                if (b.preventDefault(), b.stopPropagation(), !d.is(".disabled, :disabled")) {
                    var e = c(d),
                        g = e.hasClass("open");
                    if (!g && 27 != b.which || g && 27 == b.which) return 27 == b.which && e.find(f).trigger("focus"), d.trigger("click");
                    var h = " li:not(.disabled):visible a",
                        i = e.find('[role="menu"]' + h + ', [role="listbox"]' + h);
                    if (i.length) {
                        var j = i.index(b.target);
                        38 == b.which && j > 0 && j--, 40 == b.which && j < i.length - 1 && j++, ~j || (j = 0), i.eq(j).trigger("focus")
                    }
                }
            }
        };
        var h = a.fn.dropdown;
        a.fn.dropdown = d, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function() {
            return a.fn.dropdown = h, this
        }, a(document).on("click.bs.dropdown.data-api", b).on("click.bs.dropdown.data-api", ".dropdown form", function(a) {
            a.stopPropagation()
        }).on("click.bs.dropdown.data-api", f, g.prototype.toggle).on("keydown.bs.dropdown.data-api", f, g.prototype.keydown).on("keydown.bs.dropdown.data-api", ".dropdown-menu", g.prototype.keydown)
    }(jQuery), + function(a) {
        "use strict";

        function b(b, d) {
            return this.each(function() {
                var e = a(this),
                    f = e.data("bs.modal"),
                    g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof b && b);
                f || e.data("bs.modal", f = new c(this, g)), "string" == typeof b ? f[b](d) : g.show && f.show(d)
            })
        }
        var c = function(b, c) {
            this.options = c, this.$body = a(document.body), this.$element = a(b), this.$dialog = this.$element.find(".modal-dialog"), this.$backdrop = null, this.isShown = null, this.originalBodyPad = null, this.scrollbarWidth = 0, this.ignoreBackdropClick = !1, this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function() {
                this.$element.trigger("loaded.bs.modal")
            }, this))
        };
        c.VERSION = "3.3.4", c.TRANSITION_DURATION = 300, c.BACKDROP_TRANSITION_DURATION = 150, c.DEFAULTS = {
            backdrop: !0,
            keyboard: !0,
            show: !0
        }, c.prototype.toggle = function(a) {
            return this.isShown ? this.hide() : this.show(a)
        }, c.prototype.show = function(b) {
            var d = this,
                e = a.Event("show.bs.modal", {
                    relatedTarget: b
                });
            this.$element.trigger(e), this.isShown || e.isDefaultPrevented() || (this.isShown = !0, this.checkScrollbar(), this.setScrollbar(), this.$body.addClass("modal-open"), this.escape(), this.resize(), this.$element.on("click.dismiss.bs.modal", '[data-dismiss="modal"]', a.proxy(this.hide, this)), this.$dialog.on("mousedown.dismiss.bs.modal", function() {
                d.$element.one("mouseup.dismiss.bs.modal", function(b) {
                    a(b.target).is(d.$element) && (d.ignoreBackdropClick = !0)
                })
            }), this.backdrop(function() {
                var e = a.support.transition && d.$element.hasClass("fade");
                d.$element.parent().length || d.$element.appendTo(d.$body), d.$element.show().scrollTop(0), d.adjustDialog(), e && d.$element[0].offsetWidth, d.$element.addClass("in"), d.enforceFocus();
                var f = a.Event("shown.bs.modal", {
                    relatedTarget: b
                });
                e ? d.$dialog.one("bsTransitionEnd", function() {
                    d.$element.trigger("focus").trigger(f)
                }).emulateTransitionEnd(c.TRANSITION_DURATION) : d.$element.trigger("focus").trigger(f)
            }))
        }, c.prototype.hide = function(b) {
            b && b.preventDefault(), b = a.Event("hide.bs.modal"), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.escape(), this.resize(), a(document).off("focusin.bs.modal"), this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"), this.$dialog.off("mousedown.dismiss.bs.modal"), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(c.TRANSITION_DURATION) : this.hideModal())
        }, c.prototype.enforceFocus = function() {
            a(document).off("focusin.bs.modal").on("focusin.bs.modal", a.proxy(function(a) {
                this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus")
            }, this))
        }, c.prototype.escape = function() {
            this.isShown && this.options.keyboard ? this.$element.on("keydown.dismiss.bs.modal", a.proxy(function(a) {
                27 == a.which && this.hide()
            }, this)) : this.isShown || this.$element.off("keydown.dismiss.bs.modal")
        }, c.prototype.resize = function() {
            this.isShown ? a(window).on("resize.bs.modal", a.proxy(this.handleUpdate, this)) : a(window).off("resize.bs.modal")
        }, c.prototype.hideModal = function() {
            var a = this;
            this.$element.hide(), this.backdrop(function() {
                a.$body.removeClass("modal-open"), a.resetAdjustments(), a.resetScrollbar(), a.$element.trigger("hidden.bs.modal")
            })
        }, c.prototype.removeBackdrop = function() {
            this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
        }, c.prototype.backdrop = function(b) {
            var d = this,
                e = this.$element.hasClass("fade") ? "fade" : "";
            if (this.isShown && this.options.backdrop) {
                var f = a.support.transition && e;
                if (this.$backdrop = a(document.createElement("div")).addClass("modal-backdrop " + e).appendTo(this.$body), this.$element.on("click.dismiss.bs.modal", a.proxy(function(a) {
                        return this.ignoreBackdropClick ? void(this.ignoreBackdropClick = !1) : void(a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus() : this.hide()))
                    }, this)), f && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b) return;
                f ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : b()
            } else if (!this.isShown && this.$backdrop) {
                this.$backdrop.removeClass("in");
                var g = function() {
                    d.removeBackdrop(), b && b()
                };
                a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION) : g()
            } else b && b()
        }, c.prototype.handleUpdate = function() {
            this.adjustDialog()
        }, c.prototype.adjustDialog = function() {
            var a = this.$element[0].scrollHeight > document.documentElement.clientHeight;
            this.$element.css({
                paddingLeft: !this.bodyIsOverflowing && a ? this.scrollbarWidth : "",
                paddingRight: this.bodyIsOverflowing && !a ? this.scrollbarWidth : ""
            })
        }, c.prototype.resetAdjustments = function() {
            this.$element.css({
                paddingLeft: "",
                paddingRight: ""
            })
        }, c.prototype.checkScrollbar = function() {
            var a = window.innerWidth;
            if (!a) {
                var b = document.documentElement.getBoundingClientRect();
                a = b.right - Math.abs(b.left)
            }
            this.bodyIsOverflowing = document.body.clientWidth < a, this.scrollbarWidth = this.measureScrollbar()
        }, c.prototype.setScrollbar = function() {
            var a = parseInt(this.$body.css("padding-right") || 0, 10);
            this.originalBodyPad = document.body.style.paddingRight || "", this.bodyIsOverflowing && this.$body.css("padding-right", a + this.scrollbarWidth)
        }, c.prototype.resetScrollbar = function() {
            this.$body.css("padding-right", this.originalBodyPad)
        }, c.prototype.measureScrollbar = function() {
            var a = document.createElement("div");
            a.className = "modal-scrollbar-measure", this.$body.append(a);
            var b = a.offsetWidth - a.clientWidth;
            return this.$body[0].removeChild(a), b
        };
        var d = a.fn.modal;
        a.fn.modal = b, a.fn.modal.Constructor = c, a.fn.modal.noConflict = function() {
            return a.fn.modal = d, this
        }, a(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(c) {
            var d = a(this),
                e = d.attr("href"),
                f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, "")),
                g = f.data("bs.modal") ? "toggle" : a.extend({
                    remote: !/#/.test(e) && e
                }, f.data(), d.data());
            d.is("a") && c.preventDefault(), f.one("show.bs.modal", function(a) {
                a.isDefaultPrevented() || f.one("hidden.bs.modal", function() {
                    d.is(":visible") && d.trigger("focus")
                })
            }), b.call(f, g, this)
        })
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.tooltip"),
                    f = "object" == typeof b && b;
                (e || !/destroy|hide/.test(b)) && (e || d.data("bs.tooltip", e = new c(this, f)), "string" == typeof b && e[b]())
            })
        }
        var c = function(a, b) {
            this.type = null, this.options = null, this.enabled = null, this.timeout = null, this.hoverState = null, this.$element = null, this.init("tooltip", a, b)
        };
        c.VERSION = "3.3.4", c.TRANSITION_DURATION = 150, c.DEFAULTS = {
            animation: !0,
            placement: "top",
            selector: !1,
            template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
            trigger: "hover focus",
            title: "",
            delay: 0,
            html: !1,
            container: !1,
            viewport: {
                selector: "body",
                padding: 0
            }
        }, c.prototype.init = function(b, c, d) {
            if (this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d), this.$viewport = this.options.viewport && a(this.options.viewport.selector || this.options.viewport), this.$element[0] instanceof document.constructor && !this.options.selector) throw new Error("`selector` option must be specified when initializing " + this.type + " on the window.document object!");
            for (var e = this.options.trigger.split(" "), f = e.length; f--;) {
                var g = e[f];
                if ("click" == g) this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));
                else if ("manual" != g) {
                    var h = "hover" == g ? "mouseenter" : "focusin",
                        i = "hover" == g ? "mouseleave" : "focusout";
                    this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
                }
            }
            this.options.selector ? this._options = a.extend({}, this.options, {
                trigger: "manual",
                selector: ""
            }) : this.fixTitle()
        }, c.prototype.getDefaults = function() {
            return c.DEFAULTS
        }, c.prototype.getOptions = function(b) {
            return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
                show: b.delay,
                hide: b.delay
            }), b
        }, c.prototype.getDelegateOptions = function() {
            var b = {},
                c = this.getDefaults();
            return this._options && a.each(this._options, function(a, d) {
                c[a] != d && (b[a] = d)
            }), b
        }, c.prototype.enter = function(b) {
            var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
            return c && c.$tip && c.$tip.is(":visible") ? void(c.hoverState = "in") : (c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function() {
                "in" == c.hoverState && c.show()
            }, c.options.delay.show)) : c.show())
        }, c.prototype.leave = function(b) {
            var c = b instanceof this.constructor ? b : a(b.currentTarget).data("bs." + this.type);
            return c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c)), clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function() {
                "out" == c.hoverState && c.hide()
            }, c.options.delay.hide)) : c.hide()
        }, c.prototype.show = function() {
            var b = a.Event("show.bs." + this.type);
            if (this.hasContent() && this.enabled) {
                this.$element.trigger(b);
                var d = a.contains(this.$element[0].ownerDocument.documentElement, this.$element[0]);
                if (b.isDefaultPrevented() || !d) return;
                var e = this,
                    f = this.tip(),
                    g = this.getUID(this.type);
                this.setContent(), f.attr("id", g), this.$element.attr("aria-describedby", g), this.options.animation && f.addClass("fade");
                var h = "function" == typeof this.options.placement ? this.options.placement.call(this, f[0], this.$element[0]) : this.options.placement,
                    i = /\s?auto?\s?/i,
                    j = i.test(h);
                j && (h = h.replace(i, "") || "top"), f.detach().css({
                    top: 0,
                    left: 0,
                    display: "block"
                }).addClass(h).data("bs." + this.type, this), this.options.container ? f.appendTo(this.options.container) : f.insertAfter(this.$element);
                var k = this.getPosition(),
                    l = f[0].offsetWidth,
                    m = f[0].offsetHeight;
                if (j) {
                    var n = h,
                        o = this.options.container ? a(this.options.container) : this.$element.parent(),
                        p = this.getPosition(o);
                    h = "bottom" == h && k.bottom + m > p.bottom ? "top" : "top" == h && k.top - m < p.top ? "bottom" : "right" == h && k.right + l > p.width ? "left" : "left" == h && k.left - l < p.left ? "right" : h, f.removeClass(n).addClass(h)
                }
                var q = this.getCalculatedOffset(h, k, l, m);
                this.applyPlacement(q, h);
                var r = function() {
                    var a = e.hoverState;
                    e.$element.trigger("shown.bs." + e.type), e.hoverState = null, "out" == a && e.leave(e)
                };
                a.support.transition && this.$tip.hasClass("fade") ? f.one("bsTransitionEnd", r).emulateTransitionEnd(c.TRANSITION_DURATION) : r()
            }
        }, c.prototype.applyPlacement = function(b, c) {
            var d = this.tip(),
                e = d[0].offsetWidth,
                f = d[0].offsetHeight,
                g = parseInt(d.css("margin-top"), 10),
                h = parseInt(d.css("margin-left"), 10);
            isNaN(g) && (g = 0), isNaN(h) && (h = 0), b.top = b.top + g, b.left = b.left + h, a.offset.setOffset(d[0], a.extend({
                using: function(a) {
                    d.css({
                        top: Math.round(a.top),
                        left: Math.round(a.left)
                    })
                }
            }, b), 0), d.addClass("in");
            var i = d[0].offsetWidth,
                j = d[0].offsetHeight;
            "top" == c && j != f && (b.top = b.top + f - j);
            var k = this.getViewportAdjustedDelta(c, b, i, j);
            k.left ? b.left += k.left : b.top += k.top;
            var l = /top|bottom/.test(c),
                m = l ? 2 * k.left - e + i : 2 * k.top - f + j,
                n = l ? "offsetWidth" : "offsetHeight";
            d.offset(b), this.replaceArrow(m, d[0][n], l)
        }, c.prototype.replaceArrow = function(a, b, c) {
            this.arrow().css(c ? "left" : "top", 50 * (1 - a / b) + "%").css(c ? "top" : "left", "")
        }, c.prototype.setContent = function() {
            var a = this.tip(),
                b = this.getTitle();
            a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
        }, c.prototype.hide = function(b) {
            function d() {
                "in" != e.hoverState && f.detach(), e.$element.removeAttr("aria-describedby").trigger("hidden.bs." + e.type), b && b()
            }
            var e = this,
                f = a(this.$tip),
                g = a.Event("hide.bs." + this.type);
            return this.$element.trigger(g), g.isDefaultPrevented() ? void 0 : (f.removeClass("in"), a.support.transition && f.hasClass("fade") ? f.one("bsTransitionEnd", d).emulateTransitionEnd(c.TRANSITION_DURATION) : d(), this.hoverState = null, this)
        }, c.prototype.fixTitle = function() {
            var a = this.$element;
            (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
        }, c.prototype.hasContent = function() {
            return this.getTitle()
        }, c.prototype.getPosition = function(b) {
            b = b || this.$element;
            var c = b[0],
                d = "BODY" == c.tagName,
                e = c.getBoundingClientRect();
            null == e.width && (e = a.extend({}, e, {
                width: e.right - e.left,
                height: e.bottom - e.top
            }));
            var f = d ? {
                    top: 0,
                    left: 0
                } : b.offset(),
                g = {
                    scroll: d ? document.documentElement.scrollTop || document.body.scrollTop : b.scrollTop()
                },
                h = d ? {
                    width: a(window).width(),
                    height: a(window).height()
                } : null;
            return a.extend({}, e, g, h, f)
        }, c.prototype.getCalculatedOffset = function(a, b, c, d) {
            return "bottom" == a ? {
                top: b.top + b.height,
                left: b.left + b.width / 2 - c / 2
            } : "top" == a ? {
                top: b.top - d,
                left: b.left + b.width / 2 - c / 2
            } : "left" == a ? {
                top: b.top + b.height / 2 - d / 2,
                left: b.left - c
            } : {
                top: b.top + b.height / 2 - d / 2,
                left: b.left + b.width
            }
        }, c.prototype.getViewportAdjustedDelta = function(a, b, c, d) {
            var e = {
                top: 0,
                left: 0
            };
            if (!this.$viewport) return e;
            var f = this.options.viewport && this.options.viewport.padding || 0,
                g = this.getPosition(this.$viewport);
            if (/right|left/.test(a)) {
                var h = b.top - f - g.scroll,
                    i = b.top + f - g.scroll + d;
                h < g.top ? e.top = g.top - h : i > g.top + g.height && (e.top = g.top + g.height - i)
            } else {
                var j = b.left - f,
                    k = b.left + f + c;
                j < g.left ? e.left = g.left - j : k > g.width && (e.left = g.left + g.width - k)
            }
            return e
        }, c.prototype.getTitle = function() {
            var a, b = this.$element,
                c = this.options;
            return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
        }, c.prototype.getUID = function(a) {
            do a += ~~(1e6 * Math.random()); while (document.getElementById(a));
            return a
        }, c.prototype.tip = function() {
            return this.$tip = this.$tip || a(this.options.template)
        }, c.prototype.arrow = function() {
            return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
        }, c.prototype.enable = function() {
            this.enabled = !0
        }, c.prototype.disable = function() {
            this.enabled = !1
        }, c.prototype.toggleEnabled = function() {
            this.enabled = !this.enabled
        }, c.prototype.toggle = function(b) {
            var c = this;
            b && (c = a(b.currentTarget).data("bs." + this.type), c || (c = new this.constructor(b.currentTarget, this.getDelegateOptions()), a(b.currentTarget).data("bs." + this.type, c))), c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
        }, c.prototype.destroy = function() {
            var a = this;
            clearTimeout(this.timeout), this.hide(function() {
                a.$element.off("." + a.type).removeData("bs." + a.type)
            })
        };
        var d = a.fn.tooltip;
        a.fn.tooltip = b, a.fn.tooltip.Constructor = c, a.fn.tooltip.noConflict = function() {
            return a.fn.tooltip = d, this
        }
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.popover"),
                    f = "object" == typeof b && b;
                (e || !/destroy|hide/.test(b)) && (e || d.data("bs.popover", e = new c(this, f)), "string" == typeof b && e[b]())
            })
        }
        var c = function(a, b) {
            this.init("popover", a, b)
        };
        if (!a.fn.tooltip) throw new Error("Popover requires tooltip.js");
        c.VERSION = "3.3.4", c.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
            placement: "right",
            trigger: "click",
            content: "",
            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
        }), c.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), c.prototype.constructor = c, c.prototype.getDefaults = function() {
            return c.DEFAULTS
        }, c.prototype.setContent = function() {
            var a = this.tip(),
                b = this.getTitle(),
                c = this.getContent();
            a.find(".popover-title")[this.options.html ? "html" : "text"](b), a.find(".popover-content").children().detach().end()[this.options.html ? "string" == typeof c ? "html" : "append" : "text"](c), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
        }, c.prototype.hasContent = function() {
            return this.getTitle() || this.getContent()
        }, c.prototype.getContent = function() {
            var a = this.$element,
                b = this.options;
            return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
        }, c.prototype.arrow = function() {
            return this.$arrow = this.$arrow || this.tip().find(".arrow")
        };
        var d = a.fn.popover;
        a.fn.popover = b, a.fn.popover.Constructor = c, a.fn.popover.noConflict = function() {
            return a.fn.popover = d, this
        }
    }(jQuery), + function(a) {
        "use strict";

        function b(c, d) {
            this.$body = a(document.body), this.$scrollElement = a(a(c).is(document.body) ? window : c), this.options = a.extend({}, b.DEFAULTS, d), this.selector = (this.options.target || "") + " .nav li > a", this.offsets = [], this.targets = [], this.activeTarget = null, this.scrollHeight = 0, this.$scrollElement.on("scroll.bs.scrollspy", a.proxy(this.process, this)), this.refresh(), this.process()
        }

        function c(c) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.scrollspy"),
                    f = "object" == typeof c && c;
                e || d.data("bs.scrollspy", e = new b(this, f)), "string" == typeof c && e[c]()
            })
        }
        b.VERSION = "3.3.4", b.DEFAULTS = {
            offset: 10
        }, b.prototype.getScrollHeight = function() {
            return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
        }, b.prototype.refresh = function() {
            var b = this,
                c = "offset",
                d = 0;
            this.offsets = [], this.targets = [], this.scrollHeight = this.getScrollHeight(), a.isWindow(this.$scrollElement[0]) || (c = "position", d = this.$scrollElement.scrollTop()), this.$body.find(this.selector).map(function() {
                var b = a(this),
                    e = b.data("target") || b.attr("href"),
                    f = /^#./.test(e) && a(e);
                return f && f.length && f.is(":visible") && [
                    [f[c]().top + d, e]
                ] || null
            }).sort(function(a, b) {
                return a[0] - b[0]
            }).each(function() {
                b.offsets.push(this[0]), b.targets.push(this[1])
            })
        }, b.prototype.process = function() {
            var a, b = this.$scrollElement.scrollTop() + this.options.offset,
                c = this.getScrollHeight(),
                d = this.options.offset + c - this.$scrollElement.height(),
                e = this.offsets,
                f = this.targets,
                g = this.activeTarget;
            if (this.scrollHeight != c && this.refresh(), b >= d) return g != (a = f[f.length - 1]) && this.activate(a);
            if (g && b < e[0]) return this.activeTarget = null, this.clear();
            for (a = e.length; a--;) g != f[a] && b >= e[a] && (void 0 === e[a + 1] || b < e[a + 1]) && this.activate(f[a])
        }, b.prototype.activate = function(b) {
            this.activeTarget = b, this.clear();
            var c = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
                d = a(c).parents("li").addClass("active");
            d.parent(".dropdown-menu").length && (d = d.closest("li.dropdown").addClass("active")), d.trigger("activate.bs.scrollspy")
        }, b.prototype.clear = function() {
            a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active")
        };
        var d = a.fn.scrollspy;
        a.fn.scrollspy = c, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function() {
            return a.fn.scrollspy = d, this
        }, a(window).on("load.bs.scrollspy.data-api", function() {
            a('[data-spy="scroll"]').each(function() {
                var b = a(this);
                c.call(b, b.data())
            })
        })
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.tab");
                e || d.data("bs.tab", e = new c(this)), "string" == typeof b && e[b]()
            })
        }
        var c = function(b) {
            this.element = a(b)
        };
        c.VERSION = "3.3.4", c.TRANSITION_DURATION = 150, c.prototype.show = function() {
            var b = this.element,
                c = b.closest("ul:not(.dropdown-menu)"),
                d = b.data("target");
            if (d || (d = b.attr("href"), d = d && d.replace(/.*(?=#[^\s]*$)/, "")), !b.parent("li").hasClass("active")) {
                var e = c.find(".active:last a"),
                    f = a.Event("hide.bs.tab", {
                        relatedTarget: b[0]
                    }),
                    g = a.Event("show.bs.tab", {
                        relatedTarget: e[0]
                    });
                if (e.trigger(f), b.trigger(g), !g.isDefaultPrevented() && !f.isDefaultPrevented()) {
                    var h = a(d);
                    this.activate(b.closest("li"), c), this.activate(h, h.parent(), function() {
                        e.trigger({
                            type: "hidden.bs.tab",
                            relatedTarget: b[0]
                        }), b.trigger({
                            type: "shown.bs.tab",
                            relatedTarget: e[0]
                        })
                    })
                }
            }
        }, c.prototype.activate = function(b, d, e) {
            function f() {
                g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !1), b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded", !0), h ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu").length && b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded", !0), e && e()
            }
            var g = d.find("> .active"),
                h = e && a.support.transition && (g.length && g.hasClass("fade") || !!d.find("> .fade").length);
            g.length && h ? g.one("bsTransitionEnd", f).emulateTransitionEnd(c.TRANSITION_DURATION) : f(), g.removeClass("in")
        };
        var d = a.fn.tab;
        a.fn.tab = b, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function() {
            return a.fn.tab = d, this
        };
        var e = function(c) {
            c.preventDefault(), b.call(a(this), "show")
        };
        a(document).on("click.bs.tab.data-api", '[data-toggle="tab"]', e).on("click.bs.tab.data-api", '[data-toggle="pill"]', e)
    }(jQuery), + function(a) {
        "use strict";

        function b(b) {
            return this.each(function() {
                var d = a(this),
                    e = d.data("bs.affix"),
                    f = "object" == typeof b && b;
                e || d.data("bs.affix", e = new c(this, f)), "string" == typeof b && e[b]()
            })
        }
        var c = function(b, d) {
            this.options = a.extend({}, c.DEFAULTS, d), this.$target = a(this.options.target).on("scroll.bs.affix.data-api", a.proxy(this.checkPosition, this)).on("click.bs.affix.data-api", a.proxy(this.checkPositionWithEventLoop, this)), this.$element = a(b), this.affixed = null, this.unpin = null, this.pinnedOffset = null, this.checkPosition()
        };
        c.VERSION = "3.3.4", c.RESET = "affix affix-top affix-bottom", c.DEFAULTS = {
            offset: 0,
            target: window
        }, c.prototype.getState = function(a, b, c, d) {
            var e = this.$target.scrollTop(),
                f = this.$element.offset(),
                g = this.$target.height();
            if (null != c && "top" == this.affixed) return c > e ? "top" : !1;
            if ("bottom" == this.affixed) return null != c ? e + this.unpin <= f.top ? !1 : "bottom" : a - d >= e + g ? !1 : "bottom";
            var h = null == this.affixed,
                i = h ? e : f.top,
                j = h ? g : b;
            return null != c && c >= e ? "top" : null != d && i + j >= a - d ? "bottom" : !1
        }, c.prototype.getPinnedOffset = function() {
            if (this.pinnedOffset) return this.pinnedOffset;
            this.$element.removeClass(c.RESET).addClass("affix");
            var a = this.$target.scrollTop(),
                b = this.$element.offset();
            return this.pinnedOffset = b.top - a
        }, c.prototype.checkPositionWithEventLoop = function() {
            setTimeout(a.proxy(this.checkPosition, this), 1)
        }, c.prototype.checkPosition = function() {
            if (this.$element.is(":visible")) {
                var b = this.$element.height(),
                    d = this.options.offset,
                    e = d.top,
                    f = d.bottom,
                    g = a(document.body).height();
                "object" != typeof d && (f = e = d), "function" == typeof e && (e = d.top(this.$element)), "function" == typeof f && (f = d.bottom(this.$element));
                var h = this.getState(g, b, e, f);
                if (this.affixed != h) {
                    null != this.unpin && this.$element.css("top", "");
                    var i = "affix" + (h ? "-" + h : ""),
                        j = a.Event(i + ".bs.affix");
                    if (this.$element.trigger(j), j.isDefaultPrevented()) return;
                    this.affixed = h, this.unpin = "bottom" == h ? this.getPinnedOffset() : null, this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix", "affixed") + ".bs.affix")
                }
                "bottom" == h && this.$element.offset({
                    top: g - b - f
                })
            }
        };
        var d = a.fn.affix;
        a.fn.affix = b, a.fn.affix.Constructor = c, a.fn.affix.noConflict = function() {
            return a.fn.affix = d, this
        }, a(window).on("load", function() {
            a('[data-spy="affix"]').each(function() {
                var c = a(this),
                    d = c.data();
                d.offset = d.offset || {}, null != d.offsetBottom && (d.offset.bottom = d.offsetBottom), null != d.offsetTop && (d.offset.top = d.offsetTop), b.call(c, d)
            })
        })
    }(jQuery), window.Modernizr = function(a, b, c) {
        function d(a) {
            o.cssText = a
        }

        function e(a, b) {
            return typeof a === b
        }
        var f, g, h, i = "2.8.2",
            j = {},
            k = !0,
            l = b.documentElement,
            m = "modernizr",
            n = b.createElement(m),
            o = n.style,
            p = ({}.toString, " -webkit- -moz- -o- -ms- ".split(" ")),
            q = {},
            r = [],
            s = r.slice,
            t = function(a, c, d, e) {
                var f, g, h, i, j = b.createElement("div"),
                    k = b.body,
                    n = k || b.createElement("body");
                if (parseInt(d, 10))
                    for (; d--;) h = b.createElement("div"), h.id = e ? e[d] : m + (d + 1), j.appendChild(h);
                return f = ["&#173;", '<style id="s', m, '">', a, "</style>"].join(""), j.id = m, (k ? j : n).innerHTML += f, n.appendChild(j), k || (n.style.background = "", n.style.overflow = "hidden", i = l.style.overflow, l.style.overflow = "hidden", l.appendChild(n)), g = c(j, a), k ? j.parentNode.removeChild(j) : (n.parentNode.removeChild(n), l.style.overflow = i), !!g
            },
            u = {}.hasOwnProperty;
        h = e(u, "undefined") || e(u.call, "undefined") ? function(a, b) {
            return b in a && e(a.constructor.prototype[b], "undefined")
        } : function(a, b) {
            return u.call(a, b)
        }, Function.prototype.bind || (Function.prototype.bind = function(a) {
            var b = this;
            if ("function" != typeof b) throw new TypeError;
            var c = s.call(arguments, 1),
                d = function() {
                    if (this instanceof d) {
                        var e = function() {};
                        e.prototype = b.prototype;
                        var f = new e,
                            g = b.apply(f, c.concat(s.call(arguments)));
                        return Object(g) === g ? g : f
                    }
                    return b.apply(a, c.concat(s.call(arguments)))
                };
            return d
        }), q.touch = function() {
            var c;
            return "ontouchstart" in a || a.DocumentTouch && b instanceof DocumentTouch ? c = !0 : t(["@media (", p.join("touch-enabled),("), m, ")", "{#modernizr{top:9px;position:absolute}}"].join(""), function(a) {
                c = 9 === a.offsetTop
            }), c
        };
        for (var v in q) h(q, v) && (g = v.toLowerCase(), j[g] = q[v](), r.push((j[g] ? "" : "no-") + g));
        return j.addTest = function(a, b) {
                if ("object" == typeof a)
                    for (var d in a) h(a, d) && j.addTest(d, a[d]);
                else {
                    if (a = a.toLowerCase(), j[a] !== c) return j;
                    b = "function" == typeof b ? b() : b, "undefined" != typeof k && k && (l.className += " " + (b ? "" : "no-") + a), j[a] = b
                }
                return j
            }, d(""), n = f = null,
            function(a, b) {
                function c(a, b) {
                    var c = a.createElement("p"),
                        d = a.getElementsByTagName("head")[0] || a.documentElement;
                    return c.innerHTML = "x<style>" + b + "</style>", d.insertBefore(c.lastChild, d.firstChild)
                }

                function d() {
                    var a = s.elements;
                    return "string" == typeof a ? a.split(" ") : a
                }

                function e(a) {
                    var b = r[a[p]];
                    return b || (b = {}, q++, a[p] = q, r[q] = b), b
                }

                function f(a, c, d) {
                    if (c || (c = b), k) return c.createElement(a);
                    d || (d = e(c));
                    var f;
                    return f = d.cache[a] ? d.cache[a].cloneNode() : o.test(a) ? (d.cache[a] = d.createElem(a)).cloneNode() : d.createElem(a), !f.canHaveChildren || n.test(a) || f.tagUrn ? f : d.frag.appendChild(f)
                }

                function g(a, c) {
                    if (a || (a = b), k) return a.createDocumentFragment();
                    c = c || e(a);
                    for (var f = c.frag.cloneNode(), g = 0, h = d(), i = h.length; i > g; g++) f.createElement(h[g]);
                    return f
                }

                function h(a, b) {
                    b.cache || (b.cache = {}, b.createElem = a.createElement, b.createFrag = a.createDocumentFragment, b.frag = b.createFrag()), a.createElement = function(c) {
                        return s.shivMethods ? f(c, a, b) : b.createElem(c)
                    }, a.createDocumentFragment = Function("h,f", "return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(" + d().join().replace(/[\w\-]+/g, function(a) {
                        return b.createElem(a), b.frag.createElement(a), 'c("' + a + '")'
                    }) + ");return n}")(s, b.frag)
                }

                function i(a) {
                    a || (a = b);
                    var d = e(a);
                    return !s.shivCSS || j || d.hasCSS || (d.hasCSS = !!c(a, "article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")), k || h(a, d), a
                }
                var j, k, l = "3.7.0",
                    m = a.html5 || {},
                    n = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,
                    o = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,
                    p = "_html5shiv",
                    q = 0,
                    r = {};
                ! function() {
                    try {
                        var a = b.createElement("a");
                        a.innerHTML = "<xyz></xyz>", j = "hidden" in a, k = 1 == a.childNodes.length || function() {
                            b.createElement("a");
                            var a = b.createDocumentFragment();
                            return "undefined" == typeof a.cloneNode || "undefined" == typeof a.createDocumentFragment || "undefined" == typeof a.createElement
                        }()
                    } catch (c) {
                        j = !0, k = !0
                    }
                }();
                var s = {
                    elements: m.elements || "abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video",
                    version: l,
                    shivCSS: m.shivCSS !== !1,
                    supportsUnknownElements: k,
                    shivMethods: m.shivMethods !== !1,
                    type: "default",
                    shivDocument: i,
                    createElement: f,
                    createDocumentFragment: g
                };
                a.html5 = s, i(b)
            }(this, b), j._version = i, j._prefixes = p, j.testStyles = t, l.className = l.className.replace(/(^|\s)no-js(\s|$)/, "$1$2") + (k ? " js " + r.join(" ") : ""), j
    }(this, this.document), function(a, b, c) {
        function d(a) {
            return "[object Function]" == q.call(a)
        }

        function e(a) {
            return "string" == typeof a
        }

        function f() {}

        function g(a) {
            return !a || "loaded" == a || "complete" == a || "uninitialized" == a
        }

        function h() {
            var a = r.shift();
            s = 1, a ? a.t ? o(function() {
                ("c" == a.t ? m.injectCss : m.injectJs)(a.s, 0, a.a, a.x, a.e, 1)
            }, 0) : (a(), h()) : s = 0
        }

        function i(a, c, d, e, f, i, j) {
            function k(b) {
                if (!n && g(l.readyState) && (t.r = n = 1, !s && h(), l.onload = l.onreadystatechange = null, b)) {
                    "img" != a && o(function() {
                        v.removeChild(l)
                    }, 50);
                    for (var d in A[c]) A[c].hasOwnProperty(d) && A[c][d].onload()
                }
            }
            var j = j || m.errorTimeout,
                l = b.createElement(a),
                n = 0,
                q = 0,
                t = {
                    t: d,
                    s: c,
                    e: f,
                    a: i,
                    x: j
                };
            1 === A[c] && (q = 1, A[c] = []), "object" == a ? l.data = c : (l.src = c, l.type = a), l.width = l.height = "0", l.onerror = l.onload = l.onreadystatechange = function() {
                k.call(this, q)
            }, r.splice(e, 0, t), "img" != a && (q || 2 === A[c] ? (v.insertBefore(l, u ? null : p), o(k, j)) : A[c].push(l))
        }

        function j(a, b, c, d, f) {
            return s = 0, b = b || "j", e(a) ? i("c" == b ? x : w, a, b, this.i++, c, d, f) : (r.splice(this.i++, 0, a), 1 == r.length && h()), this
        }

        function k() {
            var a = m;
            return a.loader = {
                load: j,
                i: 0
            }, a
        }
        var l, m, n = b.documentElement,
            o = a.setTimeout,
            p = b.getElementsByTagName("script")[0],
            q = {}.toString,
            r = [],
            s = 0,
            t = "MozAppearance" in n.style,
            u = t && !!b.createRange().compareNode,
            v = u ? n : p.parentNode,
            n = a.opera && "[object Opera]" == q.call(a.opera),
            n = !!b.attachEvent && !n,
            w = t ? "object" : n ? "script" : "img",
            x = n ? "script" : w,
            y = Array.isArray || function(a) {
                return "[object Array]" == q.call(a)
            },
            z = [],
            A = {},
            B = {
                timeout: function(a, b) {
                    return b.length && (a.timeout = b[0]), a
                }
            };
        m = function(a) {
            function b(a) {
                var b, c, d, a = a.split("!"),
                    e = z.length,
                    f = a.pop(),
                    g = a.length,
                    f = {
                        url: f,
                        origUrl: f,
                        prefixes: a
                    };
                for (c = 0; g > c; c++) d = a[c].split("="), (b = B[d.shift()]) && (f = b(f, d));
                for (c = 0; e > c; c++) f = z[c](f);
                return f
            }

            function g(a, e, f, g, h) {
                var i = b(a),
                    j = i.autoCallback;
                i.url.split(".").pop().split("?").shift(), i.bypass || (e && (e = d(e) ? e : e[a] || e[g] || e[a.split("/").pop().split("?")[0]]), i.instead ? i.instead(a, e, f, g, h) : (A[i.url] ? i.noexec = !0 : A[i.url] = 1, f.load(i.url, i.forceCSS || !i.forceJS && "css" == i.url.split(".").pop().split("?").shift() ? "c" : c, i.noexec, i.attrs, i.timeout), (d(e) || d(j)) && f.load(function() {
                    k(), e && e(i.origUrl, h, g), j && j(i.origUrl, h, g), A[i.url] = 2
                })))
            }

            function h(a, b) {
                function c(a, c) {
                    if (a) {
                        if (e(a)) c || (l = function() {
                            var a = [].slice.call(arguments);
                            m.apply(this, a), n()
                        }), g(a, l, b, 0, j);
                        else if (Object(a) === a)
                            for (i in h = function() {
                                    var b, c = 0;
                                    for (b in a) a.hasOwnProperty(b) && c++;
                                    return c
                                }(), a) a.hasOwnProperty(i) && (!c && !--h && (d(l) ? l = function() {
                                var a = [].slice.call(arguments);
                                m.apply(this, a), n()
                            } : l[i] = function(a) {
                                return function() {
                                    var b = [].slice.call(arguments);
                                    a && a.apply(this, b), n()
                                }
                            }(m[i])), g(a[i], l, b, i, j))
                    } else !c && n()
                }
                var h, i, j = !!a.test,
                    k = a.load || a.both,
                    l = a.callback || f,
                    m = l,
                    n = a.complete || f;
                c(j ? a.yep : a.nope, !!k), k && c(k)
            }
            var i, j, l = this.yepnope.loader;
            if (e(a)) g(a, 0, l, 0);
            else if (y(a))
                for (i = 0; i < a.length; i++) j = a[i], e(j) ? g(j, 0, l, 0) : y(j) ? m(j) : Object(j) === j && h(j, l);
            else Object(a) === a && h(a, l)
        }, m.addPrefix = function(a, b) {
            B[a] = b
        }, m.addFilter = function(a) {
            z.push(a)
        }, m.errorTimeout = 1e4, null == b.readyState && b.addEventListener && (b.readyState = "loading", b.addEventListener("DOMContentLoaded", l = function() {
            b.removeEventListener("DOMContentLoaded", l, 0), b.readyState = "complete"
        }, 0)), a.yepnope = k(), a.yepnope.executeStack = h, a.yepnope.injectJs = function(a, c, d, e, i, j) {
            var k, l, n = b.createElement("script"),
                e = e || m.errorTimeout;
            n.src = a;
            for (l in d) n.setAttribute(l, d[l]);
            c = j ? h : c || f, n.onreadystatechange = n.onload = function() {
                !k && g(n.readyState) && (k = 1, c(), n.onload = n.onreadystatechange = null)
            }, o(function() {
                k || (k = 1, c(1))
            }, e), i ? n.onload() : p.parentNode.insertBefore(n, p)
        }, a.yepnope.injectCss = function(a, c, d, e, g, i) {
            var j, e = b.createElement("link"),
                c = i ? h : c || f;
            e.href = a, e.rel = "stylesheet", e.type = "text/css";
            for (j in d) e.setAttribute(j, d[j]);
            g || (p.parentNode.insertBefore(e, p), o(c, 0))
        }
    }(this, document), Modernizr.load = function() {
        yepnope.apply(window, [].slice.call(arguments, 0))
    }, ! function(a, b, c) {
        "object" == typeof module && module && "object" == typeof module.exports ? module.exports = c : (a[b] = c, "function" == typeof define && define.amd && define(b, [], function() {
            return c
        }))
    }(this, "jRespond", function(a, b, c) {
        "use strict";
        return function(a) {
            var b = [],
                d = [],
                e = a,
                f = "",
                g = "",
                h = 0,
                i = 100,
                j = 500,
                k = j,
                l = function() {
                    var a = 0;
                    return a = "number" != typeof window.innerWidth ? 0 !== document.documentElement.clientWidth ? document.documentElement.clientWidth : document.body.clientWidth : window.innerWidth
                },
                m = function(a) {
                    if (a.length === c) n(a);
                    else
                        for (var b = 0; b < a.length; b++) n(a[b])
                },
                n = function(a) {
                    var e = a.breakpoint,
                        h = a.enter || c;
                    b.push(a), d.push(!1), q(e) && (h !== c && h.call(null, {
                        entering: f,
                        exiting: g
                    }), d[b.length - 1] = !0)
                },
                o = function() {
                    for (var a = [], e = [], h = 0; h < b.length; h++) {
                        var i = b[h].breakpoint,
                            j = b[h].enter || c,
                            k = b[h].exit || c;
                        "*" === i ? (j !== c && a.push(j), k !== c && e.push(k)) : q(i) ? (j === c || d[h] || a.push(j), d[h] = !0) : (k !== c && d[h] && e.push(k), d[h] = !1)
                    }
                    for (var l = {
                            entering: f,
                            exiting: g
                        }, m = 0; m < e.length; m++) e[m].call(null, l);
                    for (var n = 0; n < a.length; n++) a[n].call(null, l)
                },
                p = function(a) {
                    for (var b = !1, c = 0; c < e.length; c++)
                        if (a >= e[c].enter && a <= e[c].exit) {
                            b = !0;
                            break
                        }
                    b && f !== e[c].label ? (g = f, f = e[c].label, o()) : b || "" === f || (f = "", o())
                },
                q = function(a) {
                    if ("object" == typeof a) {
                        if (a.join().indexOf(f) >= 0) return !0
                    } else {
                        if ("*" === a) return !0;
                        if ("string" == typeof a && f === a) return !0
                    }
                },
                r = function() {
                    var a = l();
                    a !== h ? (k = i, p(a)) : k = j, h = a, setTimeout(r, k)
                };
            return r(), {
                addFunc: function(a) {
                    m(a)
                },
                getBreakpoint: function() {
                    return f
                }
            }
        }
    }(this, this.document)), function(a) {
        jQuery.fn.extend({
            slimScroll: function(b) {
                var c = a.extend({
                    width: "auto",
                    height: "250px",
                    size: "7px",
                    color: "#000",
                    position: "right",
                    distance: "1px",
                    start: "top",
                    opacity: .4,
                    alwaysVisible: !1,
                    disableFadeOut: !1,
                    railVisible: !1,
                    railColor: "#333",
                    railOpacity: .2,
                    railDraggable: !0,
                    railClass: "slimScrollRail",
                    barClass: "slimScrollBar",
                    wrapperClass: "slimScrollDiv",
                    allowPageScroll: !1,
                    wheelStep: 20,
                    touchScrollStep: 200,
                    borderRadius: "7px",
                    railBorderRadius: "7px"
                }, b);
                return this.each(function() {
                    function d(b) {
                        if (j) {
                            b = b || window.event;
                            var d = 0;
                            b.wheelDelta && (d = -b.wheelDelta / 120), b.detail && (d = b.detail / 3), a(b.target || b.srcTarget || b.srcElement).closest("." + c.wrapperClass).is(u.parent()) && e(d, !0), b.preventDefault && !s && b.preventDefault(), s || (b.returnValue = !1)
                        }
                    }

                    function e(a, b, d) {
                        s = !1;
                        var e = a,
                            f = u.outerHeight() - w.outerHeight();
                        b && (e = parseInt(w.css("top")) + a * parseInt(c.wheelStep) / 100 * w.outerHeight(), e = Math.min(Math.max(e, 0), f), e = a > 0 ? Math.ceil(e) : Math.floor(e), w.css({
                            top: e + "px"
                        })), p = parseInt(w.css("top")) / (u.outerHeight() - w.outerHeight()), e = p * (u[0].scrollHeight - u.outerHeight()), d && (e = a, a = e / u[0].scrollHeight * u.outerHeight(), a = Math.min(Math.max(a, 0), f), w.css({
                            top: a + "px"
                        })), u.scrollTop(e), u.trigger("slimscrolling", ~~e), h(), i()
                    }

                    function f() {
                        window.addEventListener ? (this.addEventListener("DOMMouseScroll", d, !1), this.addEventListener("mousewheel", d, !1), this.addEventListener("MozMousePixelScroll", null, !1)) : document.attachEvent("onmousewheel", d)
                    }

                    function g() {
                        o = Math.max(u.outerHeight() / u[0].scrollHeight * u.outerHeight(), r), w.css({
                            height: o + "px"
                        });
                        var a = o == u.outerHeight() ? "none" : "block";
                        w.css({
                            display: a
                        })
                    }

                    function h() {
                        g(), clearTimeout(m), p == ~~p ? (s = c.allowPageScroll, q != p && u.trigger("slimscroll", 0 == ~~p ? "top" : "bottom")) : s = !1, q = p, o >= u.outerHeight() ? s = !0 : (w.stop(!0, !0).fadeIn("fast"), c.railVisible && x.stop(!0, !0).fadeIn("fast"))
                    }

                    function i() {
                        c.alwaysVisible || (m = setTimeout(function() {
                            c.disableFadeOut && j || k || l || (w.fadeOut("slow"), x.fadeOut("slow"))
                        }, 1e3))
                    }
                    var j, k, l, m, n, o, p, q, r = 30,
                        s = !1,
                        u = a(this);
                    if (u.parent().hasClass(c.wrapperClass)) {
                        var v = u.scrollTop(),
                            w = u.parent().find("." + c.barClass),
                            x = u.parent().find("." + c.railClass);
                        if (g(), a.isPlainObject(b)) {
                            if ("height" in b && "auto" == b.height) {
                                u.parent().css("height", "auto"), u.css("height", "auto");
                                var y = u.parent().parent().height();
                                u.parent().css("height", y), u.css("height", y)
                            }
                            if ("scrollTo" in b) v = parseInt(c.scrollTo);
                            else if ("scrollBy" in b) v += parseInt(c.scrollBy);
                            else if ("destroy" in b) return w.remove(), x.remove(), void u.unwrap();
                            e(v, !1, !0)
                        }
                    } else {
                        c.height = "auto" == c.height ? u.parent().height() : c.height, v = a("<div></div>").addClass(c.wrapperClass).css({
                            position: "relative",
                            overflow: "hidden",
                            width: c.width,
                            height: c.height
                        }), u.css({
                            overflow: "hidden",
                            width: c.width,
                            height: c.height
                        });
                        var x = a("<div></div>").addClass(c.railClass).css({
                                width: c.size,
                                height: "100%",
                                position: "absolute",
                                top: 0,
                                display: c.alwaysVisible && c.railVisible ? "block" : "none",
                                "border-radius": c.railBorderRadius,
                                background: c.railColor,
                                opacity: c.railOpacity,
                                zIndex: 90
                            }),
                            w = a("<div></div>").addClass(c.barClass).css({
                                background: c.color,
                                width: c.size,
                                position: "absolute",
                                top: 0,
                                opacity: c.opacity,
                                display: c.alwaysVisible ? "block" : "none",
                                "border-radius": c.borderRadius,
                                BorderRadius: c.borderRadius,
                                MozBorderRadius: c.borderRadius,
                                WebkitBorderRadius: c.borderRadius,
                                zIndex: 99
                            }),
                            y = "right" == c.position ? {
                                right: c.distance
                            } : {
                                left: c.distance
                            };
                        x.css(y), w.css(y), u.wrap(v), u.parent().append(w), u.parent().append(x), c.railDraggable && w.bind("mousedown", function(b) {
                            var c = a(document);
                            return l = !0, t = parseFloat(w.css("top")), pageY = b.pageY, c.bind("mousemove.slimscroll", function(a) {
                                currTop = t + a.pageY - pageY, w.css("top", currTop), e(0, w.position().top, !1)
                            }), c.bind("mouseup.slimscroll", function() {
                                l = !1, i(), c.unbind(".slimscroll")
                            }), !1
                        }).bind("selectstart.slimscroll", function(a) {
                            return a.stopPropagation(), a.preventDefault(), !1
                        }), x.hover(function() {
                            h()
                        }, function() {
                            i()
                        }), w.hover(function() {
                            k = !0
                        }, function() {
                            k = !1
                        }), u.hover(function() {
                            j = !0, h(), i()
                        }, function() {
                            j = !1, i()
                        }), u.bind("touchstart", function(a) {
                            a.originalEvent.touches.length && (n = a.originalEvent.touches[0].pageY)
                        }), u.bind("touchmove", function(a) {
                            s || a.originalEvent.preventDefault(), a.originalEvent.touches.length && (e((n - a.originalEvent.touches[0].pageY) / c.touchScrollStep, !0), n = a.originalEvent.touches[0].pageY)
                        }), g(), "bottom" === c.start ? (w.css({
                            top: u.outerHeight() - w.outerHeight()
                        }), e(0, !0)) : "top" !== c.start && (e(a(c.start).position().top, null, !0), c.alwaysVisible || w.hide()), f()
                    }
                }), this
            }
        }), jQuery.fn.extend({
            slimscroll: jQuery.fn.slimScroll
        })
    }(jQuery), function(a) {
        jQuery.fn.extend({
            slimScrollHorizontal: function(b) {
                var c = {
                        wheelStep: 20,
                        height: "auto",
                        width: "250px",
                        size: "7px",
                        color: "#000",
                        position: "bottom",
                        distance: "1px",
                        start: "left",
                        opacity: .4,
                        alwaysVisible: !1,
                        disableFadeOut: !1,
                        railVisible: !1,
                        railColor: "#333",
                        railOpacity: "0.2",
                        railClass: "slimScrollRail",
                        barClass: "slimScrollBar",
                        wrapperClass: "slimScrollDiv",
                        allowPageScroll: !1,
                        scroll: 0,
                        touchScrollStep: 200
                    },
                    d = a.extend(c, b);
                return this.each(function() {
                    function b(a, b, c) {
                        var g = a;
                        if ("auto" == u.css("left") && u.css("left", "0px"), b) {
                            g = parseInt(u.css("left")) + a * parseInt(d.wheelStep) / 100 * u.outerWidth();
                            var h = r.outerWidth() - u.outerWidth();
                            g = Math.min(Math.max(g, 0), h), u.css({
                                left: g + "px"
                            })
                        }
                        if (m = parseInt(u.css("left")) / (r.outerWidth() - u.outerWidth()), g = m * (r[0].scrollWidth - r.outerWidth()), c) {
                            g = a;
                            var i = g / r[0].scrollWidth * r.outerWidth();
                            u.css({
                                left: i + "px"
                            })
                        }
                        r.scrollLeft(g), e(), f()
                    }

                    function c() {
                        l = Math.max(r.outerWidth() / r[0].scrollWidth * r.outerWidth(), p), u.css({
                            width: l + "px"
                        })
                    }

                    function e() {
                        if (c(), clearTimeout(j), m == ~~m && (q = d.allowPageScroll, n != m)) {
                            var a = 0 == ~~m ? "left" : "right";
                            r.trigger("slimscroll", a)
                        }
                        return n = m, l >= r.outerWidth() ? void(q = !0) : (u.stop(!0, !0).fadeIn("fast"), void(d.railVisible && t.stop(!0, !0).fadeIn("fast")))
                    }

                    function f() {
                        d.alwaysVisible || (j = setTimeout(function() {
                            d.disableFadeOut && g || h || i || (u.fadeOut("slow"), t.fadeOut("slow"))
                        }, 1e3))
                    }
                    var g, h, i, j, k, l, m, n, o = "<div></div>",
                        p = 30,
                        q = !1,
                        r = a(this);
                    if (r.parent().hasClass("slimScrollDiv")) return void(scroll && (u = r.parent().find(".slimScrollBar"), t = r.parent().find(".slimScrollRail"), b(r.scrollLeft() + parseInt(scroll), !1, !0)));
                    var s = a(o).addClass(d.wrapperClass).css({
                        position: "relative",
                        overflow: "hidden",
                        width: d.width,
                        height: d.height
                    });
                    r.css({
                        overflow: "hidden",
                        width: d.width,
                        height: d.height
                    });
                    var t = a(o).addClass(d.railClass).css({
                            width: "100%",
                            height: d.size,
                            position: "absolute",
                            bottom: 0,
                            display: d.alwaysVisible && d.railVisible ? "block" : "none",
                            "border-radius": d.size,
                            background: d.railColor,
                            opacity: d.railOpacity,
                            zIndex: 90
                        }),
                        u = a(o).addClass(d.barClass).css({
                            background: d.color,
                            height: d.size,
                            position: "absolute",
                            bottom: 0,
                            opacity: d.opacity,
                            display: d.alwaysVisible ? "block" : "none",
                            "border-radius": d.size,
                            BorderRadius: d.size,
                            MozBorderRadius: d.size,
                            WebkitBorderRadius: d.size,
                            zIndex: 99
                        }),
                        v = "top" == d.position ? {
                            top: d.distance
                        } : {
                            bottom: d.distance
                        };
                    t.css(v), u.css(v), r.wrap(s), r.parent().append(u), r.parent().append(t), u.draggable({
                        axis: "x",
                        containment: "parent",
                        start: function() {
                            i = !0
                        },
                        stop: function() {
                            i = !1, f()
                        },
                        drag: function() {
                            b(0, a(this).position().left, !1)
                        }
                    }), t.hover(function() {
                        e()
                    }, function() {
                        f()
                    }), u.hover(function() {
                        h = !0
                    }, function() {
                        h = !1
                    }), r.hover(function() {
                        g = !0, e(), f()
                    }, function() {
                        g = !1, f()
                    }), r.bind("touchstart", function(a) {
                        a.originalEvent.touches.length && (k = a.originalEvent.touches[0].pageX)
                    }), r.bind("touchmove", function(a) {
                        if (a.originalEvent.preventDefault(), a.originalEvent.touches.length) {
                            var c = (k - a.originalEvent.touches[0].pageX) / d.touchScrollStep;
                            b(c, !0)
                        }
                    });
                    var w = function(a) {
                            if (g) {
                                var a = a || window.event,
                                    c = 0;
                                a.wheelDelta && (c = -a.wheelDelta / 120), a.detail && (c = a.detail / 3), b(c, !0), a.preventDefault && !q && a.preventDefault(), q || (a.returnValue = !1)
                            }
                        },
                        x = function() {
                            window.addEventListener ? (this.addEventListener("DOMMouseScroll", w, !1), this.addEventListener("mousewheel", w, !1)) : document.attachEvent("onmousewheel", w)
                        };
                    x(), c(), "right" == d.start ? (u.css({
                        left: r.outerWidth() - u.outerWidth()
                    }), b(0, !0)) : "object" == typeof d.start && (b(a(d.start).position().left, null, !0), d.alwaysVisible || u.hide())
                }), this
            }
        }), jQuery.fn.extend({
            slimscrollHorizontal: jQuery.fn.slimScrollHorizontal
        })
    }(jQuery), function() {
        "use strict";

        function a(c, d) {
            function e(a, b) {
                return function() {
                    return a.apply(b, arguments)
                }
            }
            var f;
            if (d = d || {}, this.trackingClick = !1, this.trackingClickStart = 0, this.targetElement = null, this.touchStartX = 0, this.touchStartY = 0, this.lastTouchIdentifier = 0, this.touchBoundary = d.touchBoundary || 10, this.layer = c, this.tapDelay = d.tapDelay || 200, !a.notNeeded(c)) {
                for (var g = ["onMouse", "onClick", "onTouchStart", "onTouchMove", "onTouchEnd", "onTouchCancel"], h = this, i = 0, j = g.length; j > i; i++) h[g[i]] = e(h[g[i]], h);
                b && (c.addEventListener("mouseover", this.onMouse, !0), c.addEventListener("mousedown", this.onMouse, !0), c.addEventListener("mouseup", this.onMouse, !0)), c.addEventListener("click", this.onClick, !0), c.addEventListener("touchstart", this.onTouchStart, !1), c.addEventListener("touchmove", this.onTouchMove, !1), c.addEventListener("touchend", this.onTouchEnd, !1), c.addEventListener("touchcancel", this.onTouchCancel, !1), Event.prototype.stopImmediatePropagation || (c.removeEventListener = function(a, b, d) {
                    var e = Node.prototype.removeEventListener;
                    "click" === a ? e.call(c, a, b.hijacked || b, d) : e.call(c, a, b, d)
                }, c.addEventListener = function(a, b, d) {
                    var e = Node.prototype.addEventListener;
                    "click" === a ? e.call(c, a, b.hijacked || (b.hijacked = function(a) {
                        a.propagationStopped || b(a)
                    }), d) : e.call(c, a, b, d)
                }), "function" == typeof c.onclick && (f = c.onclick, c.addEventListener("click", function(a) {
                    f(a)
                }, !1), c.onclick = null)
            }
        }
        var b = navigator.userAgent.indexOf("Android") > 0,
            c = /iP(ad|hone|od)/.test(navigator.userAgent),
            d = c && /OS 4_\d(_\d)?/.test(navigator.userAgent),
            e = c && /OS ([6-9]|\d{2})_\d/.test(navigator.userAgent),
            f = navigator.userAgent.indexOf("BB10") > 0;
        a.prototype.needsClick = function(a) {
            switch (a.nodeName.toLowerCase()) {
                case "button":
                case "select":
                case "textarea":
                    if (a.disabled) return !0;
                    break;
                case "input":
                    if (c && "file" === a.type || a.disabled) return !0;
                    break;
                case "label":
                case "video":
                    return !0
            }
            return /\bneedsclick\b/.test(a.className)
        }, a.prototype.needsFocus = function(a) {
            switch (a.nodeName.toLowerCase()) {
                case "textarea":
                    return !0;
                case "select":
                    return !b;
                case "input":
                    switch (a.type) {
                        case "button":
                        case "checkbox":
                        case "file":
                        case "image":
                        case "radio":
                        case "submit":
                            return !1
                    }
                    return !a.disabled && !a.readOnly;
                default:
                    return /\bneedsfocus\b/.test(a.className)
            }
        }, a.prototype.sendClick = function(a, b) {
            var c, d;
            document.activeElement && document.activeElement !== a && document.activeElement.blur(), d = b.changedTouches[0], c = document.createEvent("MouseEvents"), c.initMouseEvent(this.determineEventType(a), !0, !0, window, 1, d.screenX, d.screenY, d.clientX, d.clientY, !1, !1, !1, !1, 0, null), c.forwardedTouchEvent = !0, a.dispatchEvent(c)
        }, a.prototype.determineEventType = function(a) {
            return b && "select" === a.tagName.toLowerCase() ? "mousedown" : "click"
        }, a.prototype.focus = function(a) {
            var b;
            c && a.setSelectionRange && 0 !== a.type.indexOf("date") && "time" !== a.type ? (b = a.value.length, a.setSelectionRange(b, b)) : a.focus()
        }, a.prototype.updateScrollParent = function(a) {
            var b, c;
            if (b = a.fastClickScrollParent, !b || !b.contains(a)) {
                c = a;
                do {
                    if (c.scrollHeight > c.offsetHeight) {
                        b = c, a.fastClickScrollParent = c;
                        break
                    }
                    c = c.parentElement
                } while (c)
            }
            b && (b.fastClickLastScrollTop = b.scrollTop)
        }, a.prototype.getTargetElementFromEventTarget = function(a) {
            return a.nodeType === Node.TEXT_NODE ? a.parentNode : a
        }, a.prototype.onTouchStart = function(a) {
            var b, e, f;
            if (a.targetTouches.length > 1) return !0;
            if (b = this.getTargetElementFromEventTarget(a.target), e = a.targetTouches[0], c) {
                if (f = window.getSelection(), f.rangeCount && !f.isCollapsed) return !0;
                if (!d) {
                    if (e.identifier && e.identifier === this.lastTouchIdentifier) return a.preventDefault(), !1;
                    this.lastTouchIdentifier = e.identifier, this.updateScrollParent(b)
                }
            }
            return this.trackingClick = !0, this.trackingClickStart = a.timeStamp, this.targetElement = b, this.touchStartX = e.pageX, this.touchStartY = e.pageY, a.timeStamp - this.lastClickTime < this.tapDelay && a.preventDefault(), !0
        }, a.prototype.touchHasMoved = function(a) {
            var b = a.changedTouches[0],
                c = this.touchBoundary;
            return Math.abs(b.pageX - this.touchStartX) > c || Math.abs(b.pageY - this.touchStartY) > c ? !0 : !1
        }, a.prototype.onTouchMove = function(a) {
            return this.trackingClick ? ((this.targetElement !== this.getTargetElementFromEventTarget(a.target) || this.touchHasMoved(a)) && (this.trackingClick = !1, this.targetElement = null), !0) : !0
        }, a.prototype.findControl = function(a) {
            return void 0 !== a.control ? a.control : a.htmlFor ? document.getElementById(a.htmlFor) : a.querySelector("button, input:not([type=hidden]), keygen, meter, output, progress, select, textarea")
        }, a.prototype.onTouchEnd = function(a) {
            var f, g, h, i, j, k = this.targetElement;
            if (!this.trackingClick) return !0;
            if (a.timeStamp - this.lastClickTime < this.tapDelay) return this.cancelNextClick = !0, !0;
            if (this.cancelNextClick = !1, this.lastClickTime = a.timeStamp, g = this.trackingClickStart, this.trackingClick = !1, this.trackingClickStart = 0, e && (j = a.changedTouches[0], k = document.elementFromPoint(j.pageX - window.pageXOffset, j.pageY - window.pageYOffset) || k, k.fastClickScrollParent = this.targetElement.fastClickScrollParent), h = k.tagName.toLowerCase(), "label" === h) {
                if (f = this.findControl(k)) {
                    if (this.focus(k), b) return !1;
                    k = f
                }
            } else if (this.needsFocus(k)) return a.timeStamp - g > 100 || c && window.top !== window && "input" === h ? (this.targetElement = null, !1) : (this.focus(k), this.sendClick(k, a), c && "select" === h || (this.targetElement = null, a.preventDefault()), !1);
            return c && !d && (i = k.fastClickScrollParent, i && i.fastClickLastScrollTop !== i.scrollTop) ? !0 : (this.needsClick(k) || (a.preventDefault(), this.sendClick(k, a)), !1)
        }, a.prototype.onTouchCancel = function() {
            this.trackingClick = !1, this.targetElement = null
        }, a.prototype.onMouse = function(a) {
            return this.targetElement ? a.forwardedTouchEvent ? !0 : a.cancelable && (!this.needsClick(this.targetElement) || this.cancelNextClick) ? (a.stopImmediatePropagation ? a.stopImmediatePropagation() : a.propagationStopped = !0, a.stopPropagation(), a.preventDefault(), !1) : !0 : !0
        }, a.prototype.onClick = function(a) {
            var b;
            return this.trackingClick ? (this.targetElement = null, this.trackingClick = !1, !0) : "submit" === a.target.type && 0 === a.detail ? !0 : (b = this.onMouse(a), b || (this.targetElement = null), b)
        }, a.prototype.destroy = function() {
            var a = this.layer;
            b && (a.removeEventListener("mouseover", this.onMouse, !0), a.removeEventListener("mousedown", this.onMouse, !0), a.removeEventListener("mouseup", this.onMouse, !0)), a.removeEventListener("click", this.onClick, !0), a.removeEventListener("touchstart", this.onTouchStart, !1), a.removeEventListener("touchmove", this.onTouchMove, !1), a.removeEventListener("touchend", this.onTouchEnd, !1), a.removeEventListener("touchcancel", this.onTouchCancel, !1)
        }, a.notNeeded = function(a) {
            var c, d, e;
            if ("undefined" == typeof window.ontouchstart) return !0;
            if (d = +(/Chrome\/([0-9]+)/.exec(navigator.userAgent) || [, 0])[1]) {
                if (!b) return !0;
                if (c = document.querySelector("meta[name=viewport]")) {
                    if (-1 !== c.content.indexOf("user-scalable=no")) return !0;
                    if (d > 31 && document.documentElement.scrollWidth <= window.outerWidth) return !0
                }
            }
            if (f && (e = navigator.userAgent.match(/Version\/([0-9]*)\.([0-9]*)/), e[1] >= 10 && e[2] >= 3 && (c = document.querySelector("meta[name=viewport]")))) {
                if (-1 !== c.content.indexOf("user-scalable=no")) return !0;
                if (document.documentElement.scrollWidth <= window.outerWidth) return !0
            }
            return "none" === a.style.msTouchAction ? !0 : !1
        }, a.attach = function(b, c) {
            return new a(b, c)
        }, "function" == typeof define && "object" == typeof define.amd && define.amd ? define(function() {
            return a
        }) : "undefined" != typeof module && module.exports ? (module.exports = a.attach, module.exports.FastClick = a) : window.FastClick = a
    }(), ! function(a) {
        "object" == typeof module && "object" == typeof module.exports ? module.exports = a(window.Velocity ? window.jQuery : require("jquery")) : "function" == typeof define && define.amd ? window.Velocity ? define(a) : define(["jquery"], a) : a(window.jQuery)
    }(function(a) {
        return function(b, c, d, e) {
            function f(a) {
                for (var b = -1, c = a ? a.length : 0, d = []; ++b < c;) {
                    var e = a[b];
                    e && d.push(e)
                }
                return d
            }

            function g(a) {
                return q.isNode(a) ? [a] : a
            }

            function h(a) {
                var b = n.data(a, "velocity");
                return null === b ? e : b
            }

            function i(a) {
                return function(b) {
                    return Math.round(b * a) * (1 / a)
                }
            }

            function j(a, b, d, e) {
                function f(a, b) {
                    return 1 - 3 * b + 3 * a
                }

                function g(a, b) {
                    return 3 * b - 6 * a
                }

                function h(a) {
                    return 3 * a
                }

                function i(a, b, c) {
                    return ((f(b, c) * a + g(b, c)) * a + h(b)) * a
                }

                function j(a, b, c) {
                    return 3 * f(b, c) * a * a + 2 * g(b, c) * a + h(b)
                }

                function k(b, c) {
                    for (var e = 0; p > e; ++e) {
                        var f = j(c, a, d);
                        if (0 === f) return c;
                        var g = i(c, a, d) - b;
                        c -= g / f
                    }
                    return c
                }

                function l() {
                    for (var b = 0; t > b; ++b) x[b] = i(b * u, a, d)
                }

                function m(b, c, e) {
                    var f, g, h = 0;
                    do g = c + (e - c) / 2, f = i(g, a, d) - b, f > 0 ? e = g : c = g; while (Math.abs(f) > r && ++h < s);
                    return g
                }

                function n(b) {
                    for (var c = 0, e = 1, f = t - 1; e != f && x[e] <= b; ++e) c += u;
                    --e;
                    var g = (b - x[e]) / (x[e + 1] - x[e]),
                        h = c + g * u,
                        i = j(h, a, d);
                    return i >= q ? k(b, h) : 0 == i ? h : m(b, c, c + u)
                }

                function o() {
                    y = !0, (a != b || d != e) && l()
                }
                var p = 4,
                    q = .001,
                    r = 1e-7,
                    s = 10,
                    t = 11,
                    u = 1 / (t - 1),
                    v = "Float32Array" in c;
                if (4 !== arguments.length) return !1;
                for (var w = 0; 4 > w; ++w)
                    if ("number" != typeof arguments[w] || isNaN(arguments[w]) || !isFinite(arguments[w])) return !1;
                a = Math.min(a, 1), d = Math.min(d, 1), a = Math.max(a, 0), d = Math.max(d, 0);
                var x = v ? new Float32Array(t) : new Array(t),
                    y = !1,
                    z = function(c) {
                        return y || o(), a === b && d === e ? c : 0 === c ? 0 : 1 === c ? 1 : i(n(c), b, e)
                    };
                z.getControlPoints = function() {
                    return [{
                        x: a,
                        y: b
                    }, {
                        x: d,
                        y: e
                    }]
                };
                var A = "generateBezier(" + [a, b, d, e] + ")";
                return z.toString = function() {
                    return A
                }, z
            }

            function k(a, b) {
                var c = a;
                return q.isString(a) ? t.Easings[a] || (c = !1) : c = q.isArray(a) && 1 === a.length ? i.apply(null, a) : q.isArray(a) && 2 === a.length ? u.apply(null, a.concat([b])) : q.isArray(a) && 4 === a.length ? j.apply(null, a) : !1, c === !1 && (c = t.Easings[t.defaults.easing] ? t.defaults.easing : s), c
            }

            function l(a) {
                if (a)
                    for (var b = (new Date).getTime(), c = 0, d = t.State.calls.length; d > c; c++)
                        if (t.State.calls[c]) {
                            var f = t.State.calls[c],
                                g = f[0],
                                i = f[2],
                                j = f[3];
                            j || (j = t.State.calls[c][3] = b - 16);
                            for (var k = Math.min((b - j) / i.duration, 1), n = 0, p = g.length; p > n; n++) {
                                var r = g[n],
                                    s = r.element;
                                if (h(s)) {
                                    var u = !1;
                                    i.display !== e && null !== i.display && "none" !== i.display && ("flex" === i.display && v.setPropertyValue(s, "display", (o ? "-ms-" : "-webkit-") + i.display), v.setPropertyValue(s, "display", i.display)), i.visibility && "hidden" !== i.visibility && v.setPropertyValue(s, "visibility", i.visibility);
                                    for (var w in r)
                                        if ("element" !== w) {
                                            var y, z = r[w],
                                                A = q.isString(z.easing) ? t.Easings[z.easing] : z.easing;
                                            if (y = 1 === k ? z.endValue : z.startValue + (z.endValue - z.startValue) * A(k), z.currentValue = y, v.Hooks.registered[w]) {
                                                var B = v.Hooks.getRoot(w),
                                                    C = h(s).rootPropertyValueCache[B];
                                                C && (z.rootPropertyValue = C)
                                            }
                                            var D = v.setPropertyValue(s, w, z.currentValue + (0 === parseFloat(y) ? "" : z.unitType), z.rootPropertyValue, z.scrollData);
                                            v.Hooks.registered[w] && (h(s).rootPropertyValueCache[B] = v.Normalizations.registered[B] ? v.Normalizations.registered[B]("extract", null, D[1]) : D[1]), "transform" === D[0] && (u = !0)
                                        }
                                    i.mobileHA && h(s).transformCache.translate3d === e && (h(s).transformCache.translate3d = "(0px, 0px, 0px)", u = !0), u && v.flushTransformCache(s)
                                }
                            }
                            i.display !== e && "none" !== i.display && (t.State.calls[c][2].display = !1), i.visibility && "hidden" !== i.visibility && (t.State.calls[c][2].visibility = !1), i.progress && i.progress.call(f[1], f[1], k, Math.max(0, j + i.duration - b), j), 1 === k && m(c)
                        }
                t.State.isTicking && x(l)
            }

            function m(a, b) {
                if (!t.State.calls[a]) return !1;
                for (var c = t.State.calls[a][0], d = t.State.calls[a][1], f = t.State.calls[a][2], g = t.State.calls[a][4], i = !1, j = 0, k = c.length; k > j; j++) {
                    var l = c[j].element;
                    if (b || f.loop || ("none" === f.display && v.setPropertyValue(l, "display", f.display), "hidden" === f.visibility && v.setPropertyValue(l, "visibility", f.visibility)), (n.queue(l)[1] === e || !/\.velocityQueueEntryFlag/i.test(n.queue(l)[1])) && h(l)) {
                        h(l).isAnimating = !1, h(l).rootPropertyValueCache = {};
                        var m = !1;
                        n.each(v.Lists.transforms3D, function(a, b) {
                            var c = /^scale/.test(b) ? 1 : 0,
                                d = h(l).transformCache[b];
                            h(l).transformCache[b] !== e && new RegExp("^\\(" + c + "[^.]").test(d) && (m = !0, delete h(l).transformCache[b])
                        }), f.mobileHA && (m = !0, delete h(l).transformCache.translate3d), m && v.flushTransformCache(l), v.Values.removeClass(l, "velocity-animating")
                    }
                    if (!b && f.complete && !f.loop && j === k - 1) try {
                        f.complete.call(d, d)
                    } catch (o) {
                        setTimeout(function() {
                            throw o
                        }, 1)
                    }
                    g && f.loop !== !0 && g(d), f.loop !== !0 || b || t(l, "reverse", {
                        loop: !0,
                        delay: f.delay
                    }), f.queue !== !1 && n.dequeue(l, f.queue)
                }
                t.State.calls[a] = !1;
                for (var p = 0, q = t.State.calls.length; q > p; p++)
                    if (t.State.calls[p] !== !1) {
                        i = !0;
                        break
                    }
                i === !1 && (t.State.isTicking = !1, delete t.State.calls, t.State.calls = [])
            }
            var n, o = function() {
                    if (d.documentMode) return d.documentMode;
                    for (var a = 7; a > 4; a--) {
                        var b = d.createElement("div");
                        if (b.innerHTML = "<!--[if IE " + a + "]><span></span><![endif]-->", b.getElementsByTagName("span").length) return b = null, a
                    }
                    return e
                }(),
                p = function() {
                    var a = 0;
                    return c.webkitRequestAnimationFrame || c.mozRequestAnimationFrame || function(b) {
                        var c, d = (new Date).getTime();
                        return c = Math.max(0, 16 - (d - a)), a = d + c, setTimeout(function() {
                            b(d + c)
                        }, c)
                    }
                }(),
                q = {
                    isString: function(a) {
                        return "string" == typeof a
                    },
                    isArray: Array.isArray || function(a) {
                        return "[object Array]" === Object.prototype.toString.call(a)
                    },
                    isFunction: function(a) {
                        return "[object Function]" === Object.prototype.toString.call(a)
                    },
                    isNode: function(a) {
                        return a && a.nodeType
                    },
                    isNodeList: function(a) {
                        return "object" == typeof a && /^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(a)) && a.length !== e && (0 === a.length || "object" == typeof a[0] && a[0].nodeType > 0)
                    },
                    isWrapped: function(a) {
                        return a && (a.jquery || c.Zepto && c.Zepto.zepto.isZ(a))
                    },
                    isSVG: function(a) {
                        return c.SVGElement && a instanceof SVGElement
                    },
                    isEmptyObject: function(a) {
                        var b;
                        for (b in a) return !1;
                        return !0
                    }
                };
            if (a && a.fn !== e ? n = a : c.Velocity && c.Velocity.Utilities && (n = c.Velocity.Utilities), !n) throw new Error("Velocity: Either jQuery or Velocity's jQuery shim must first be loaded.");
            if (b.Velocity !== e && b.Velocity.Utilities == e) throw new Error("Velocity: Namespace is occupied.");
            if (7 >= o) {
                if (a) return void(a.fn.velocity = a.fn.animate);
                throw new Error("Velocity: In IE<=7, Velocity falls back to jQuery, which must first be loaded.")
            }
            if (8 === o && !a) throw new Error("Velocity: In IE8, Velocity requires jQuery proper to be loaded; Velocity's jQuery shim does not work with IE8.");
            var r = 400,
                s = "swing",
                t = {
                    State: {
                        isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                        isAndroid: /Android/i.test(navigator.userAgent),
                        isGingerbread: /Android 2\.3\.[3-7]/i.test(navigator.userAgent),
                        isChrome: c.chrome,
                        isFirefox: /Firefox/i.test(navigator.userAgent),
                        prefixElement: d.createElement("div"),
                        prefixMatches: {},
                        scrollAnchor: null,
                        scrollPropertyLeft: null,
                        scrollPropertyTop: null,
                        isTicking: !1,
                        calls: []
                    },
                    CSS: {},
                    Utilities: n,
                    Sequences: {},
                    Easings: {},
                    Promise: c.Promise,
                    defaults: {
                        queue: "",
                        duration: r,
                        easing: s,
                        begin: null,
                        complete: null,
                        progress: null,
                        display: e,
                        loop: !1,
                        delay: !1,
                        mobileHA: !0,
                        _cacheValues: !0
                    },
                    init: function(a) {
                        n.data(a, "velocity", {
                            isSVG: q.isSVG(a),
                            isAnimating: !1,
                            computedStyle: null,
                            tweensContainer: null,
                            rootPropertyValueCache: {},
                            transformCache: {}
                        })
                    },
                    animate: null,
                    hook: null,
                    mock: !1,
                    version: {
                        major: 0,
                        minor: 11,
                        patch: 9
                    },
                    debug: !1
                };
            c.pageYOffset !== e ? (t.State.scrollAnchor = c, t.State.scrollPropertyLeft = "pageXOffset", t.State.scrollPropertyTop = "pageYOffset") : (t.State.scrollAnchor = d.documentElement || d.body.parentNode || d.body, t.State.scrollPropertyLeft = "scrollLeft", t.State.scrollPropertyTop = "scrollTop");
            var u = function() {
                function a(a) {
                    return -a.tension * a.x - a.friction * a.v
                }

                function b(b, c, d) {
                    var e = {
                        x: b.x + d.dx * c,
                        v: b.v + d.dv * c,
                        tension: b.tension,
                        friction: b.friction
                    };
                    return {
                        dx: e.v,
                        dv: a(e)
                    }
                }

                function c(c, d) {
                    var e = {
                            dx: c.v,
                            dv: a(c)
                        },
                        f = b(c, .5 * d, e),
                        g = b(c, .5 * d, f),
                        h = b(c, d, g),
                        i = 1 / 6 * (e.dx + 2 * (f.dx + g.dx) + h.dx),
                        j = 1 / 6 * (e.dv + 2 * (f.dv + g.dv) + h.dv);
                    return c.x = c.x + i * d, c.v = c.v + j * d, c
                }
                return function d(a, b, e) {
                    var f, g, h, i = {
                            x: -1,
                            v: 0,
                            tension: null,
                            friction: null
                        },
                        j = [0],
                        k = 0,
                        l = 1e-4,
                        m = .016;
                    for (a = parseFloat(a) || 500, b = parseFloat(b) || 20, e = e || null, i.tension = a, i.friction = b, f = null !== e, f ? (k = d(a, b), g = k / e * m) : g = m; h = c(h || i, g), j.push(1 + h.x), k += 16, Math.abs(h.x) > l && Math.abs(h.v) > l;);
                    return f ? function(a) {
                        return j[a * (j.length - 1) | 0]
                    } : k
                }
            }();
            t.Easings = {
                linear: function(a) {
                    return a
                },
                swing: function(a) {
                    return .5 - Math.cos(a * Math.PI) / 2
                },
                spring: function(a) {
                    return 1 - Math.cos(4.5 * a * Math.PI) * Math.exp(6 * -a)
                }
            }, n.each([
                ["ease", [.25, .1, .25, 1]],
                ["ease-in", [.42, 0, 1, 1]],
                ["ease-out", [0, 0, .58, 1]],
                ["ease-in-out", [.42, 0, .58, 1]],
                ["easeInSine", [.47, 0, .745, .715]],
                ["easeOutSine", [.39, .575, .565, 1]],
                ["easeInOutSine", [.445, .05, .55, .95]],
                ["easeInQuad", [.55, .085, .68, .53]],
                ["easeOutQuad", [.25, .46, .45, .94]],
                ["easeInOutQuad", [.455, .03, .515, .955]],
                ["easeInCubic", [.55, .055, .675, .19]],
                ["easeOutCubic", [.215, .61, .355, 1]],
                ["easeInOutCubic", [.645, .045, .355, 1]],
                ["easeInQuart", [.895, .03, .685, .22]],
                ["easeOutQuart", [.165, .84, .44, 1]],
                ["easeInOutQuart", [.77, 0, .175, 1]],
                ["easeInQuint", [.755, .05, .855, .06]],
                ["easeOutQuint", [.23, 1, .32, 1]],
                ["easeInOutQuint", [.86, 0, .07, 1]],
                ["easeInExpo", [.95, .05, .795, .035]],
                ["easeOutExpo", [.19, 1, .22, 1]],
                ["easeInOutExpo", [1, 0, 0, 1]],
                ["easeInCirc", [.6, .04, .98, .335]],
                ["easeOutCirc", [.075, .82, .165, 1]],
                ["easeInOutCirc", [.785, .135, .15, .86]]
            ], function(a, b) {
                t.Easings[b[0]] = j.apply(null, b[1])
            });
            var v = t.CSS = {
                RegEx: {
                    isHex: /^#([A-f\d]{3}){1,2}$/i,
                    valueUnwrap: /^[A-z]+\((.*)\)$/i,
                    wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
                    valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi
                },
                Lists: {
                    colors: ["fill", "stroke", "stopColor", "color", "backgroundColor", "borderColor", "borderTopColor", "borderRightColor", "borderBottomColor", "borderLeftColor", "outlineColor"],
                    transformsBase: ["translateX", "translateY", "scale", "scaleX", "scaleY", "skewX", "skewY", "rotateZ"],
                    transforms3D: ["transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY"]
                },
                Hooks: {
                    templates: {
                        textShadow: ["Color X Y Blur", "black 0px 0px 0px"],
                        boxShadow: ["Color X Y Blur Spread", "black 0px 0px 0px 0px"],
                        clip: ["Top Right Bottom Left", "0px 0px 0px 0px"],
                        backgroundPosition: ["X Y", "0% 0%"],
                        transformOrigin: ["X Y Z", "50% 50% 0px"],
                        perspectiveOrigin: ["X Y", "50% 50%"]
                    },
                    registered: {},
                    register: function() {
                        for (var a = 0; a < v.Lists.colors.length; a++) v.Hooks.templates[v.Lists.colors[a]] = ["Red Green Blue Alpha", "255 255 255 1"];
                        var b, c, d;
                        if (o)
                            for (b in v.Hooks.templates) {
                                c = v.Hooks.templates[b], d = c[0].split(" ");
                                var e = c[1].match(v.RegEx.valueSplit);
                                "Color" === d[0] && (d.push(d.shift()), e.push(e.shift()), v.Hooks.templates[b] = [d.join(" "), e.join(" ")])
                            }
                        for (b in v.Hooks.templates) {
                            c = v.Hooks.templates[b], d = c[0].split(" ");
                            for (var a in d) {
                                var f = b + d[a],
                                    g = a;
                                v.Hooks.registered[f] = [b, g]
                            }
                        }
                    },
                    getRoot: function(a) {
                        var b = v.Hooks.registered[a];
                        return b ? b[0] : a
                    },
                    cleanRootPropertyValue: function(a, b) {
                        return v.RegEx.valueUnwrap.test(b) && (b = b.match(v.Hooks.RegEx.valueUnwrap)[1]), v.Values.isCSSNullValue(b) && (b = v.Hooks.templates[a][1]), b
                    },
                    extractValue: function(a, b) {
                        var c = v.Hooks.registered[a];
                        if (c) {
                            var d = c[0],
                                e = c[1];
                            return b = v.Hooks.cleanRootPropertyValue(d, b), b.toString().match(v.RegEx.valueSplit)[e]
                        }
                        return b
                    },
                    injectValue: function(a, b, c) {
                        var d = v.Hooks.registered[a];
                        if (d) {
                            var e, f, g = d[0],
                                h = d[1];
                            return c = v.Hooks.cleanRootPropertyValue(g, c), e = c.toString().match(v.RegEx.valueSplit), e[h] = b, f = e.join(" ")
                        }
                        return c
                    }
                },
                Normalizations: {
                    registered: {
                        clip: function(a, b, c) {
                            switch (a) {
                                case "name":
                                    return "clip";
                                case "extract":
                                    var d;
                                    return v.RegEx.wrappedValueAlreadyExtracted.test(c) ? d = c : (d = c.toString().match(v.RegEx.valueUnwrap), d = d ? d[1].replace(/,(\s+)?/g, " ") : c), d;
                                case "inject":
                                    return "rect(" + c + ")"
                            }
                        },
                        opacity: function(a, b, c) {
                            if (8 >= o) switch (a) {
                                case "name":
                                    return "filter";
                                case "extract":
                                    var d = c.toString().match(/alpha\(opacity=(.*)\)/i);
                                    return c = d ? d[1] / 100 : 1;
                                case "inject":
                                    return b.style.zoom = 1, parseFloat(c) >= 1 ? "" : "alpha(opacity=" + parseInt(100 * parseFloat(c), 10) + ")"
                            } else switch (a) {
                                case "name":
                                    return "opacity";
                                case "extract":
                                    return c;
                                case "inject":
                                    return c
                            }
                        }
                    },
                    register: function() {
                        9 >= o || t.State.isGingerbread || (v.Lists.transformsBase = v.Lists.transformsBase.concat(v.Lists.transforms3D));
                        for (var a = 0; a < v.Lists.transformsBase.length; a++) ! function() {
                            var b = v.Lists.transformsBase[a];
                            v.Normalizations.registered[b] = function(a, c, d) {
                                switch (a) {
                                    case "name":
                                        return "transform";
                                    case "extract":
                                        return h(c) === e || h(c).transformCache[b] === e ? /^scale/i.test(b) ? 1 : 0 : h(c).transformCache[b].replace(/[()]/g, "");
                                    case "inject":
                                        var f = !1;
                                        switch (b.substr(0, b.length - 1)) {
                                            case "translate":
                                                f = !/(%|px|em|rem|vw|vh|\d)$/i.test(d);
                                                break;
                                            case "scal":
                                            case "scale":
                                                t.State.isAndroid && h(c).transformCache[b] === e && 1 > d && (d = 1), f = !/(\d)$/i.test(d);
                                                break;
                                            case "skew":
                                                f = !/(deg|\d)$/i.test(d);
                                                break;
                                            case "rotate":
                                                f = !/(deg|\d)$/i.test(d)
                                        }
                                        return f || (h(c).transformCache[b] = "(" + d + ")"), h(c).transformCache[b]
                                }
                            }
                        }();
                        for (var a = 0; a < v.Lists.colors.length; a++) ! function() {
                            var b = v.Lists.colors[a];
                            v.Normalizations.registered[b] = function(a, c, d) {
                                switch (a) {
                                    case "name":
                                        return b;
                                    case "extract":
                                        var f;
                                        if (v.RegEx.wrappedValueAlreadyExtracted.test(d)) f = d;
                                        else {
                                            var g, h = {
                                                black: "rgb(0, 0, 0)",
                                                blue: "rgb(0, 0, 255)",
                                                gray: "rgb(128, 128, 128)",
                                                green: "rgb(0, 128, 0)",
                                                red: "rgb(255, 0, 0)",
                                                white: "rgb(255, 255, 255)"
                                            };
                                            /^[A-z]+$/i.test(d) ? g = h[d] !== e ? h[d] : h.black : v.RegEx.isHex.test(d) ? g = "rgb(" + v.Values.hexToRgb(d).join(" ") + ")" : /^rgba?\(/i.test(d) || (g = h.black), f = (g || d).toString().match(v.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ")
                                        }
                                        return 8 >= o || 3 !== f.split(" ").length || (f += " 1"), f;
                                    case "inject":
                                        return 8 >= o ? 4 === d.split(" ").length && (d = d.split(/\s+/).slice(0, 3).join(" ")) : 3 === d.split(" ").length && (d += " 1"), (8 >= o ? "rgb" : "rgba") + "(" + d.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")"
                                }
                            }
                        }()
                    }
                },
                Names: {
                    camelCase: function(a) {
                        return a.replace(/-(\w)/g, function(a, b) {
                            return b.toUpperCase()
                        })
                    },
                    SVGAttribute: function(a) {
                        var b = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";
                        return (o || t.State.isAndroid && !t.State.isChrome) && (b += "|transform"), new RegExp("^(" + b + ")$", "i").test(a)
                    },
                    prefixCheck: function(a) {
                        if (t.State.prefixMatches[a]) return [t.State.prefixMatches[a], !0];
                        for (var b = ["", "Webkit", "Moz", "ms", "O"], c = 0, d = b.length; d > c; c++) {
                            var e;
                            if (e = 0 === c ? a : b[c] + a.replace(/^\w/, function(a) {
                                    return a.toUpperCase()
                                }), q.isString(t.State.prefixElement.style[e])) return t.State.prefixMatches[a] = e, [e, !0]
                        }
                        return [a, !1]
                    }
                },
                Values: {
                    hexToRgb: function(a) {
                        var b, c = /^#?([a-f\d])([a-f\d])([a-f\d])$/i,
                            d = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;
                        return a = a.replace(c, function(a, b, c, d) {
                            return b + b + c + c + d + d
                        }), b = d.exec(a), b ? [parseInt(b[1], 16), parseInt(b[2], 16), parseInt(b[3], 16)] : [0, 0, 0]
                    },
                    isCSSNullValue: function(a) {
                        return 0 == a || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(a)
                    },
                    getUnitType: function(a) {
                        return /^(rotate|skew)/i.test(a) ? "deg" : /(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(a) ? "" : "px"
                    },
                    getDisplayType: function(a) {
                        var b = a.tagName.toString().toLowerCase();
                        return /^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(b) ? "inline" : /^(li)$/i.test(b) ? "list-item" : /^(tr)$/i.test(b) ? "table-row" : "block"
                    },
                    addClass: function(a, b) {
                        a.classList ? a.classList.add(b) : a.className += (a.className.length ? " " : "") + b
                    },
                    removeClass: function(a, b) {
                        a.classList ? a.classList.remove(b) : a.className = a.className.toString().replace(new RegExp("(^|\\s)" + b.split(" ").join("|") + "(\\s|$)", "gi"), " ")
                    }
                },
                getPropertyValue: function(a, b, d, f) {
                    function g(a, b) {
                        function d() {
                            j && v.setPropertyValue(a, "display", "none")
                        }
                        var i = 0;
                        if (8 >= o) i = n.css(a, b);
                        else {
                            var j = !1;
                            if (/^(width|height)$/.test(b) && 0 === v.getPropertyValue(a, "display") && (j = !0, v.setPropertyValue(a, "display", v.Values.getDisplayType(a))), !f) {
                                if ("height" === b && "border-box" !== v.getPropertyValue(a, "boxSizing").toString().toLowerCase()) {
                                    var k = a.offsetHeight - (parseFloat(v.getPropertyValue(a, "borderTopWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "borderBottomWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingTop")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingBottom")) || 0);
                                    return d(), k
                                }
                                if ("width" === b && "border-box" !== v.getPropertyValue(a, "boxSizing").toString().toLowerCase()) {
                                    var l = a.offsetWidth - (parseFloat(v.getPropertyValue(a, "borderLeftWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "borderRightWidth")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingLeft")) || 0) - (parseFloat(v.getPropertyValue(a, "paddingRight")) || 0);
                                    return d(), l
                                }
                            }
                            var m;
                            m = h(a) === e ? c.getComputedStyle(a, null) : h(a).computedStyle ? h(a).computedStyle : h(a).computedStyle = c.getComputedStyle(a, null), (o || t.State.isFirefox) && "borderColor" === b && (b = "borderTopColor"), i = 9 === o && "filter" === b ? m.getPropertyValue(b) : m[b], ("" === i || null === i) && (i = a.style[b]), d()
                        }
                        if ("auto" === i && /^(top|right|bottom|left)$/i.test(b)) {
                            var p = g(a, "position");
                            ("fixed" === p || "absolute" === p && /top|left/i.test(b)) && (i = n(a).position()[b] + "px")
                        }
                        return i
                    }
                    var i;
                    if (v.Hooks.registered[b]) {
                        var j = b,
                            k = v.Hooks.getRoot(j);
                        d === e && (d = v.getPropertyValue(a, v.Names.prefixCheck(k)[0])), v.Normalizations.registered[k] && (d = v.Normalizations.registered[k]("extract", a, d)), i = v.Hooks.extractValue(j, d)
                    } else if (v.Normalizations.registered[b]) {
                        var l, m;
                        l = v.Normalizations.registered[b]("name", a), "transform" !== l && (m = g(a, v.Names.prefixCheck(l)[0]), v.Values.isCSSNullValue(m) && v.Hooks.templates[b] && (m = v.Hooks.templates[b][1])), i = v.Normalizations.registered[b]("extract", a, m)
                    }
                    return /^[\d-]/.test(i) || (i = h(a) && h(a).isSVG && v.Names.SVGAttribute(b) ? /^(height|width)$/i.test(b) ? a.getBBox()[b] : a.getAttribute(b) : g(a, v.Names.prefixCheck(b)[0])), v.Values.isCSSNullValue(i) && (i = 0), t.debug >= 2 && console.log("Get " + b + ": " + i), i
                },
                setPropertyValue: function(a, b, d, e, f) {
                    var g = b;
                    if ("scroll" === b) f.container ? f.container["scroll" + f.direction] = d : "Left" === f.direction ? c.scrollTo(d, f.alternateValue) : c.scrollTo(f.alternateValue, d);
                    else if (v.Normalizations.registered[b] && "transform" === v.Normalizations.registered[b]("name", a)) v.Normalizations.registered[b]("inject", a, d), g = "transform", d = h(a).transformCache[b];
                    else {
                        if (v.Hooks.registered[b]) {
                            var i = b,
                                j = v.Hooks.getRoot(b);
                            e = e || v.getPropertyValue(a, j), d = v.Hooks.injectValue(i, d, e), b = j
                        }
                        if (v.Normalizations.registered[b] && (d = v.Normalizations.registered[b]("inject", a, d), b = v.Normalizations.registered[b]("name", a)), g = v.Names.prefixCheck(b)[0], 8 >= o) try {
                            a.style[g] = d
                        } catch (k) {
                            t.debug && console.log("Browser does not support [" + d + "] for [" + g + "]")
                        } else h(a) && h(a).isSVG && v.Names.SVGAttribute(b) ? a.setAttribute(b, d) : a.style[g] = d;
                        t.debug >= 2 && console.log("Set " + b + " (" + g + "): " + d)
                    }
                    return [g, d]
                },
                flushTransformCache: function(a) {
                    function b(b) {
                        return parseFloat(v.getPropertyValue(a, b))
                    }
                    var c = "";
                    if ((o || t.State.isAndroid && !t.State.isChrome) && h(a).isSVG) {
                        var d = {
                            translate: [b("translateX"), b("translateY")],
                            skewX: [b("skewX")],
                            skewY: [b("skewY")],
                            scale: 1 !== b("scale") ? [b("scale"), b("scale")] : [b("scaleX"), b("scaleY")],
                            rotate: [b("rotateZ"), 0, 0]
                        };
                        n.each(h(a).transformCache, function(a) {
                            /^translate/i.test(a) ? a = "translate" : /^scale/i.test(a) ? a = "scale" : /^rotate/i.test(a) && (a = "rotate"), d[a] && (c += a + "(" + d[a].join(" ") + ") ", delete d[a])
                        })
                    } else {
                        var e, f;
                        n.each(h(a).transformCache, function(b) {
                            return e = h(a).transformCache[b], "transformPerspective" === b ? (f = e, !0) : (9 === o && "rotateZ" === b && (b = "rotate"), void(c += b + e + " "))
                        }), f && (c = "perspective" + f + " " + c)
                    }
                    v.setPropertyValue(a, "transform", c)
                }
            };
            v.Hooks.register(), v.Normalizations.register(), t.hook = function(a, b, c) {
                var d = e;
                return q.isWrapped(a) && (a = [].slice.call(a)), n.each(g(a), function(a, f) {
                    if (h(f) === e && t.init(f), c === e) d === e && (d = t.CSS.getPropertyValue(f, b));
                    else {
                        var g = t.CSS.setPropertyValue(f, b, c);
                        "transform" === g[0] && t.CSS.flushTransformCache(f), d = g
                    }
                }), d
            };
            var w = function() {
                function a() {
                    return i ? B.promise || null : j
                }

                function b() {
                    function a() {
                        function a(a, b) {
                            var c = e,
                                d = e,
                                f = e;
                            return q.isArray(a) ? (c = a[0], !q.isArray(a[1]) && /^[\d-]/.test(a[1]) || q.isFunction(a[1]) || v.RegEx.isHex.test(a[1]) ? f = a[1] : (q.isString(a[1]) && !v.RegEx.isHex.test(a[1]) || q.isArray(a[1])) && (d = b ? a[1] : k(a[1], i.duration), a[2] !== e && (f = a[2]))) : c = a, b || (d = d || i.easing), q.isFunction(c) && (c = c.call(g, y, x)), q.isFunction(f) && (f = f.call(g, y, x)), [c || 0, d, f]
                        }

                        function m(a, b) {
                            var c, d;
                            return d = (b || 0).toString().toLowerCase().replace(/[%A-z]+$/, function(a) {
                                return c = a, ""
                            }), c || (c = v.Values.getUnitType(a)), [d, c]
                        }

                        function o() {
                            var a = {
                                    myParent: g.parentNode || d.body,
                                    position: v.getPropertyValue(g, "position"),
                                    fontSize: v.getPropertyValue(g, "fontSize")
                                },
                                b = a.position === I.lastPosition && a.myParent === I.lastParent,
                                e = a.fontSize === I.lastFontSize;
                            I.lastParent = a.myParent, I.lastPosition = a.position, I.lastFontSize = a.fontSize;
                            var f = 100,
                                i = {};
                            if (e && b) i.emToPx = I.lastEmToPx, i.percentToPxWidth = I.lastPercentToPxWidth, i.percentToPxHeight = I.lastPercentToPxHeight;
                            else {
                                var j = h(g).isSVG ? d.createElementNS("http://www.w3.org/2000/svg", "rect") : d.createElement("div");
                                t.init(j), a.myParent.appendChild(j), n.each(["overflow", "overflowX", "overflowY"], function(a, b) {
                                    t.CSS.setPropertyValue(j, b, "hidden")
                                }), t.CSS.setPropertyValue(j, "position", a.position), t.CSS.setPropertyValue(j, "fontSize", a.fontSize), t.CSS.setPropertyValue(j, "boxSizing", "content-box"), n.each(["minWidth", "maxWidth", "width", "minHeight", "maxHeight", "height"], function(a, b) {
                                    t.CSS.setPropertyValue(j, b, f + "%")
                                }), t.CSS.setPropertyValue(j, "paddingLeft", f + "em"), i.percentToPxWidth = I.lastPercentToPxWidth = (parseFloat(v.getPropertyValue(j, "width", null, !0)) || 1) / f, i.percentToPxHeight = I.lastPercentToPxHeight = (parseFloat(v.getPropertyValue(j, "height", null, !0)) || 1) / f, i.emToPx = I.lastEmToPx = (parseFloat(v.getPropertyValue(j, "paddingLeft")) || 1) / f, a.myParent.removeChild(j)
                            }
                            return null === I.remToPx && (I.remToPx = parseFloat(v.getPropertyValue(d.body, "fontSize")) || 16), null === I.vwToPx && (I.vwToPx = parseFloat(c.innerWidth) / 100, I.vhToPx = parseFloat(c.innerHeight) / 100), i.remToPx = I.remToPx, i.vwToPx = I.vwToPx, i.vhToPx = I.vhToPx, t.debug >= 1 && console.log("Unit ratios: " + JSON.stringify(i), g), i
                        }
                        if (i.begin && 0 === y) try {
                            i.begin.call(p, p)
                        } catch (r) {
                            setTimeout(function() {
                                throw r
                            }, 1)
                        }
                        if ("scroll" === C) {
                            var w, z, A, D = /^x$/i.test(i.axis) ? "Left" : "Top",
                                E = parseFloat(i.offset) || 0;
                            i.container ? q.isWrapped(i.container) || q.isNode(i.container) ? (i.container = i.container[0] || i.container, w = i.container["scroll" + D], A = w + n(g).position()[D.toLowerCase()] + E) : i.container = null : (w = t.State.scrollAnchor[t.State["scrollProperty" + D]], z = t.State.scrollAnchor[t.State["scrollProperty" + ("Left" === D ? "Top" : "Left")]], A = n(g).offset()[D.toLowerCase()] + E), j = {
                                scroll: {
                                    rootPropertyValue: !1,
                                    startValue: w,
                                    currentValue: w,
                                    endValue: A,
                                    unitType: "",
                                    easing: i.easing,
                                    scrollData: {
                                        container: i.container,
                                        direction: D,
                                        alternateValue: z
                                    }
                                },
                                element: g
                            }, t.debug && console.log("tweensContainer (scroll): ", j.scroll, g)
                        } else if ("reverse" === C) {
                            if (!h(g).tweensContainer) return void n.dequeue(g, i.queue);
                            "none" === h(g).opts.display && (h(g).opts.display = "auto"), "hidden" === h(g).opts.visibility && (h(g).opts.visibility = "visible"), h(g).opts.loop = !1, h(g).opts.begin = null, h(g).opts.complete = null, u.easing || delete i.easing, u.duration || delete i.duration, i = n.extend({}, h(g).opts, i);
                            var F = n.extend(!0, {}, h(g).tweensContainer);
                            for (var G in F)
                                if ("element" !== G) {
                                    var H = F[G].startValue;
                                    F[G].startValue = F[G].currentValue = F[G].endValue, F[G].endValue = H, q.isEmptyObject(u) || (F[G].easing = i.easing), t.debug && console.log("reverse tweensContainer (" + G + "): " + JSON.stringify(F[G]), g)
                                }
                            j = F
                        } else if ("start" === C) {
                            var F;
                            h(g).tweensContainer && h(g).isAnimating === !0 && (F = h(g).tweensContainer), n.each(s, function(b, c) {
                                if (RegExp("^" + v.Lists.colors.join("$|^") + "$").test(b)) {
                                    var d = a(c, !0),
                                        f = d[0],
                                        g = d[1],
                                        h = d[2];
                                    if (v.RegEx.isHex.test(f)) {
                                        for (var i = ["Red", "Green", "Blue"], j = v.Values.hexToRgb(f), k = h ? v.Values.hexToRgb(h) : e, l = 0; l < i.length; l++) s[b + i[l]] = [j[l], g, k ? k[l] : k];
                                        delete s[b]
                                    }
                                }
                            });
                            for (var K in s) {
                                var L = a(s[K]),
                                    M = L[0],
                                    N = L[1],
                                    O = L[2];
                                K = v.Names.camelCase(K);
                                var P = v.Hooks.getRoot(K),
                                    Q = !1;
                                if (h(g).isSVG || v.Names.prefixCheck(P)[1] !== !1 || v.Normalizations.registered[P] !== e) {
                                    (i.display !== e && null !== i.display && "none" !== i.display || i.visibility && "hidden" !== i.visibility) && /opacity|filter/.test(K) && !O && 0 !== M && (O = 0), i._cacheValues && F && F[K] ? (O === e && (O = F[K].endValue + F[K].unitType), Q = h(g).rootPropertyValueCache[P]) : v.Hooks.registered[K] ? O === e ? (Q = v.getPropertyValue(g, P), O = v.getPropertyValue(g, K, Q)) : Q = v.Hooks.templates[P][1] : O === e && (O = v.getPropertyValue(g, K));
                                    var R, S, T, U = !1;
                                    if (R = m(K, O), O = R[0], T = R[1], R = m(K, M), M = R[0].replace(/^([+-\/*])=/, function(a, b) {
                                            return U = b, ""
                                        }), S = R[1], O = parseFloat(O) || 0, M = parseFloat(M) || 0, "%" === S && (/^(fontSize|lineHeight)$/.test(K) ? (M /= 100, S = "em") : /^scale/.test(K) ? (M /= 100, S = "") : /(Red|Green|Blue)$/i.test(K) && (M = M / 100 * 255, S = "")), /[\/*]/.test(U)) S = T;
                                    else if (T !== S && 0 !== O)
                                        if (0 === M) S = T;
                                        else {
                                            b = b || o();
                                            var V = /margin|padding|left|right|width|text|word|letter/i.test(K) || /X$/.test(K) || "x" === K ? "x" : "y";
                                            switch (T) {
                                                case "%":
                                                    O *= "x" === V ? b.percentToPxWidth : b.percentToPxHeight;
                                                    break;
                                                case "px":
                                                    break;
                                                default:
                                                    O *= b[T + "ToPx"]
                                            }
                                            switch (S) {
                                                case "%":
                                                    O *= 1 / ("x" === V ? b.percentToPxWidth : b.percentToPxHeight);
                                                    break;
                                                case "px":
                                                    break;
                                                default:
                                                    O *= 1 / b[S + "ToPx"]
                                            }
                                        }
                                    switch (U) {
                                        case "+":
                                            M = O + M;
                                            break;
                                        case "-":
                                            M = O - M;
                                            break;
                                        case "*":
                                            M = O * M;
                                            break;
                                        case "/":
                                            M = O / M
                                    }
                                    j[K] = {
                                        rootPropertyValue: Q,
                                        startValue: O,
                                        currentValue: O,
                                        endValue: M,
                                        unitType: S,
                                        easing: N
                                    }, t.debug && console.log("tweensContainer (" + K + "): " + JSON.stringify(j[K]), g)
                                } else t.debug && console.log("Skipping [" + P + "] due to a lack of browser support.")
                            }
                            j.element = g
                        }
                        j.element && (v.Values.addClass(g, "velocity-animating"), J.push(j), "" === i.queue && (h(g).tweensContainer = j, h(g).opts = i), h(g).isAnimating = !0, y === x - 1 ? (t.State.calls.length > 1e4 && (t.State.calls = f(t.State.calls)), t.State.calls.push([J, p, i, null, B.resolver]), t.State.isTicking === !1 && (t.State.isTicking = !0, l())) : y++)
                    }
                    var b, g = this,
                        i = n.extend({}, t.defaults, u),
                        j = {};
                    if (h(g) === e && t.init(g), parseFloat(i.delay) && i.queue !== !1 && n.queue(g, i.queue, function(a) {
                            t.velocityQueueEntryFlag = !0, h(g).delayTimer = {
                                setTimeout: setTimeout(a, parseFloat(i.delay)),
                                next: a
                            }
                        }), t.mock === !0) i.duration = 1;
                    else switch (i.duration.toString().toLowerCase()) {
                        case "fast":
                            i.duration = 200;
                            break;
                        case "normal":
                            i.duration = r;
                            break;
                        case "slow":
                            i.duration = 600;
                            break;
                        default:
                            i.duration = parseFloat(i.duration) || 1
                    }
                    i.easing = k(i.easing, i.duration), i.begin && !q.isFunction(i.begin) && (i.begin = null), i.progress && !q.isFunction(i.progress) && (i.progress = null), i.complete && !q.isFunction(i.complete) && (i.complete = null), i.display !== e && null !== i.display && (i.display = i.display.toString().toLowerCase(), "auto" === i.display && (i.display = t.CSS.Values.getDisplayType(g))), i.visibility && (i.visibility = i.visibility.toString().toLowerCase()), i.mobileHA = i.mobileHA && t.State.isMobile && !t.State.isGingerbread, i.queue === !1 ? i.delay ? setTimeout(a, i.delay) : a() : n.queue(g, i.queue, function(b, c) {
                        return c === !0 ? (B.promise && B.resolver(p), !0) : (t.velocityQueueEntryFlag = !0, void a(b))
                    }), "" !== i.queue && "fx" !== i.queue || "inprogress" === n.queue(g)[0] || n.dequeue(g)
                }
                var i, j, o, p, s, u, w = arguments[0] && (n.isPlainObject(arguments[0].properties) && !arguments[0].properties.names || q.isString(arguments[0].properties));
                if (q.isWrapped(this) ? (i = !1, o = 0, p = this, j = this) : (i = !0, o = 1, p = w ? arguments[0].elements : arguments[0]), p = q.isWrapped(p) ? [].slice.call(p) : p) {
                    w ? (s = arguments[0].properties, u = arguments[0].options) : (s = arguments[o], u = arguments[o + 1]);
                    var x = q.isArray(p) || q.isNodeList(p) ? p.length : 1,
                        y = 0;
                    if ("stop" !== s && !n.isPlainObject(u)) {
                        var z = o + 1;
                        u = {};
                        for (var A = z; A < arguments.length; A++) !q.isArray(arguments[A]) && /^\d/.test(arguments[A]) ? u.duration = parseFloat(arguments[A]) : q.isString(arguments[A]) || q.isArray(arguments[A]) ? u.easing = arguments[A] : q.isFunction(arguments[A]) && (u.complete = arguments[A])
                    }
                    var B = {
                        promise: null,
                        resolver: null,
                        rejecter: null
                    };
                    i && t.Promise && (B.promise = new t.Promise(function(a, b) {
                        B.resolver = a, B.rejecter = b
                    }));
                    var C;
                    switch (s) {
                        case "scroll":
                            C = "scroll";
                            break;
                        case "reverse":
                            C = "reverse";
                            break;
                        case "stop":
                            n.each(g(p), function(a, b) {
                                h(b) && h(b).delayTimer && (clearTimeout(h(b).delayTimer.setTimeout), h(b).delayTimer.next && h(b).delayTimer.next(), delete h(b).delayTimer)
                            });
                            var D = [];
                            return n.each(t.State.calls, function(a, b) {
                                b && n.each(g(b[1]), function(c, d) {
                                    var f = q.isString(u) ? u : "";
                                    return u !== e && b[2].queue !== f ? !0 : void n.each(g(p), function(b, c) {
                                        c === d && (u !== e && (n.each(n.queue(c, f), function(a, b) {
                                            q.isFunction(b) && b(null, !0)
                                        }), n.queue(c, f, [])), h(c) && "" === f && n.each(h(c).tweensContainer, function(a, b) {
                                            b.endValue = b.currentValue
                                        }), D.push(a))
                                    })
                                })
                            }), n.each(D, function(a, b) {
                                m(b, !0)
                            }), B.promise && B.resolver(p), a();
                        default:
                            if (!n.isPlainObject(s) || q.isEmptyObject(s)) {
                                if (q.isString(s) && t.Sequences[s]) {
                                    var E = n.extend({}, u),
                                        F = E.duration,
                                        G = E.delay || 0;
                                    return E.backwards === !0 && (p = (q.isWrapped(p) ? [].slice.call(p) : p).reverse()), n.each(g(p), function(a, b) {
                                        parseFloat(E.stagger) ? E.delay = G + parseFloat(E.stagger) * a : q.isFunction(E.stagger) && (E.delay = G + E.stagger.call(b, a, x)), E.drag && (E.duration = parseFloat(F) || (/^(callout|transition)/.test(s) ? 1e3 : r), E.duration = Math.max(E.duration * (E.backwards ? 1 - a / x : (a + 1) / x), .75 * E.duration, 200)), t.Sequences[s].call(b, b, E || {}, a, x, p, B.promise ? B : e)
                                    }), a()
                                }
                                var H = "Velocity: First argument (" + s + ") was not a property map, a known action, or a registered sequence. Aborting.";
                                return B.promise ? B.rejecter(new Error(H)) : console.log(H), a()
                            }
                            C = "start"
                    }
                    var I = {
                            lastParent: null,
                            lastPosition: null,
                            lastFontSize: null,
                            lastPercentToPxWidth: null,
                            lastPercentToPxHeight: null,
                            lastEmToPx: null,
                            remToPx: null,
                            vwToPx: null,
                            vhToPx: null
                        },
                        J = [];
                    n.each(g(p), function(a, c) {
                        q.isNode(c) && b.call(c)
                    });
                    var K, E = n.extend({}, t.defaults, u);
                    if (E.loop = parseInt(E.loop), K = 2 * E.loop - 1, E.loop)
                        for (var L = 0; K > L; L++) {
                            var M = {
                                delay: E.delay
                            };
                            L === K - 1 && (M.display = E.display, M.visibility = E.visibility, M.complete = E.complete), t(p, "reverse", M)
                        }
                    return a()
                }
            };
            t = n.extend(w, t), t.animate = w;
            var x = c.requestAnimationFrame || p;
            t.State.isMobile || d.hidden === e || d.addEventListener("visibilitychange", function() {
                d.hidden ? (x = function(a) {
                    return setTimeout(function() {
                        a(!0)
                    }, 16)
                }, l()) : x = c.requestAnimationFrame || p
            });
            var y;
            return a && a.fn !== e ? y = a : c.Zepto && (y = c.Zepto), (y || c).Velocity = t, y && (y.fn.velocity = w, y.fn.velocity.defaults = t.defaults), n.each(["Down", "Up"], function(a, b) {
                t.Sequences["slide" + b] = function(a, c, d, f, g, h) {
                    var i = n.extend({}, c),
                        j = i.begin,
                        k = i.complete,
                        l = {
                            height: "",
                            marginTop: "",
                            marginBottom: "",
                            paddingTop: "",
                            paddingBottom: ""
                        },
                        m = {};
                    i.display === e && (i.display = "Down" === b ? "inline" === t.CSS.Values.getDisplayType(a) ? "inline-block" : "block" : "none"), i.begin = function(a) {
                        j && j.call(a, a), m.overflowY = a.style.overflowY, a.style.overflowY = "hidden";
                        for (var c in l) {
                            m[c] = a.style[c];
                            var d = t.CSS.getPropertyValue(a, c);
                            l[c] = "Down" === b ? [d, 0] : [0, d]
                        }
                    }, i.complete = function(a) {
                        for (var b in m) a.style[b] = m[b];
                        k && k.call(a, a), h && h.resolver(g || a)
                    }, t(a, l, i)
                }
            }), n.each(["In", "Out"], function(a, b) {
                t.Sequences["fade" + b] = function(a, c, d, f, g, h) {
                    var i = n.extend({}, c),
                        j = {
                            opacity: "In" === b ? 1 : 0
                        },
                        k = i.complete;
                    i.complete = d !== f - 1 ? i.begin = null : function() {
                        k && k.call(a, a), h && h.resolver(g || a)
                    }, i.display === e && (i.display = "In" === b ? "auto" : "none"), t(this, j, i)
                }
            }), t
        }(a || window, window, document)
    }), function(a, b) {
        "use strict";
        a.quicksearch = {
            defaults: {
                delay: 100,
                selector: null,
                stripeRows: null,
                loader: null,
                noResults: "",
                matchedResultsCount: 0,
                bind: "keyup search input",
                removeDiacritics: !1,
                minValLength: 0,
                onBefore: a.noop,
                onAfter: a.noop,
                onValTooSmall: a.noop,
                show: function() {
                    a(this).show()
                },
                hide: function() {
                    a(this).hide()
                },
                prepareQuery: function(a) {
                    return a.toLowerCase().split(" ")
                },
                testQuery: function(a, b) {
                    for (var c = 0; c < a.length; c += 1)
                        if (-1 === b.indexOf(a[c])) return !1;
                    return !0
                }
            },
            diacriticsRemovalMap: [{
                base: "A",
                letters: /[\u0041\u24B6\uFF21\u00C0\u00C1\u00C2\u1EA6\u1EA4\u1EAA\u1EA8\u00C3\u0100\u0102\u1EB0\u1EAE\u1EB4\u1EB2\u0226\u01E0\u00C4\u01DE\u1EA2\u00C5\u01FA\u01CD\u0200\u0202\u1EA0\u1EAC\u1EB6\u1E00\u0104\u023A\u2C6F]/g
            }, {
                base: "AA",
                letters: /[\uA732]/g
            }, {
                base: "AE",
                letters: /[\u00C6\u01FC\u01E2]/g
            }, {
                base: "AO",
                letters: /[\uA734]/g
            }, {
                base: "AU",
                letters: /[\uA736]/g
            }, {
                base: "AV",
                letters: /[\uA738\uA73A]/g
            }, {
                base: "AY",
                letters: /[\uA73C]/g
            }, {
                base: "B",
                letters: /[\u0042\u24B7\uFF22\u1E02\u1E04\u1E06\u0243\u0182\u0181]/g
            }, {
                base: "C",
                letters: /[\u0043\u24B8\uFF23\u0106\u0108\u010A\u010C\u00C7\u1E08\u0187\u023B\uA73E]/g
            }, {
                base: "D",
                letters: /[\u0044\u24B9\uFF24\u1E0A\u010E\u1E0C\u1E10\u1E12\u1E0E\u0110\u018B\u018A\u0189\uA779]/g
            }, {
                base: "DZ",
                letters: /[\u01F1\u01C4]/g
            }, {
                base: "Dz",
                letters: /[\u01F2\u01C5]/g
            }, {
                base: "E",
                letters: /[\u0045\u24BA\uFF25\u00C8\u00C9\u00CA\u1EC0\u1EBE\u1EC4\u1EC2\u1EBC\u0112\u1E14\u1E16\u0114\u0116\u00CB\u1EBA\u011A\u0204\u0206\u1EB8\u1EC6\u0228\u1E1C\u0118\u1E18\u1E1A\u0190\u018E]/g
            }, {
                base: "F",
                letters: /[\u0046\u24BB\uFF26\u1E1E\u0191\uA77B]/g
            }, {
                base: "G",
                letters: /[\u0047\u24BC\uFF27\u01F4\u011C\u1E20\u011E\u0120\u01E6\u0122\u01E4\u0193\uA7A0\uA77D\uA77E]/g
            }, {
                base: "H",
                letters: /[\u0048\u24BD\uFF28\u0124\u1E22\u1E26\u021E\u1E24\u1E28\u1E2A\u0126\u2C67\u2C75\uA78D]/g
            }, {
                base: "I",
                letters: /[\u0049\u24BE\uFF29\u00CC\u00CD\u00CE\u0128\u012A\u012C\u0130\u00CF\u1E2E\u1EC8\u01CF\u0208\u020A\u1ECA\u012E\u1E2C\u0197]/g
            }, {
                base: "J",
                letters: /[\u004A\u24BF\uFF2A\u0134\u0248]/g
            }, {
                base: "K",
                letters: /[\u004B\u24C0\uFF2B\u1E30\u01E8\u1E32\u0136\u1E34\u0198\u2C69\uA740\uA742\uA744\uA7A2]/g
            }, {
                base: "L",
                letters: /[\u004C\u24C1\uFF2C\u013F\u0139\u013D\u1E36\u1E38\u013B\u1E3C\u1E3A\u0141\u023D\u2C62\u2C60\uA748\uA746\uA780]/g
            }, {
                base: "LJ",
                letters: /[\u01C7]/g
            }, {
                base: "Lj",
                letters: /[\u01C8]/g
            }, {
                base: "M",
                letters: /[\u004D\u24C2\uFF2D\u1E3E\u1E40\u1E42\u2C6E\u019C]/g
            }, {
                base: "N",
                letters: /[\u004E\u24C3\uFF2E\u01F8\u0143\u00D1\u1E44\u0147\u1E46\u0145\u1E4A\u1E48\u0220\u019D\uA790\uA7A4]/g
            }, {
                base: "NJ",
                letters: /[\u01CA]/g
            }, {
                base: "Nj",
                letters: /[\u01CB]/g
            }, {
                base: "O",
                letters: /[\u004F\u24C4\uFF2F\u00D2\u00D3\u00D4\u1ED2\u1ED0\u1ED6\u1ED4\u00D5\u1E4C\u022C\u1E4E\u014C\u1E50\u1E52\u014E\u022E\u0230\u00D6\u022A\u1ECE\u0150\u01D1\u020C\u020E\u01A0\u1EDC\u1EDA\u1EE0\u1EDE\u1EE2\u1ECC\u1ED8\u01EA\u01EC\u00D8\u01FE\u0186\u019F\uA74A\uA74C]/g
            }, {
                base: "OI",
                letters: /[\u01A2]/g
            }, {
                base: "OO",
                letters: /[\uA74E]/g
            }, {
                base: "OU",
                letters: /[\u0222]/g
            }, {
                base: "P",
                letters: /[\u0050\u24C5\uFF30\u1E54\u1E56\u01A4\u2C63\uA750\uA752\uA754]/g
            }, {
                base: "Q",
                letters: /[\u0051\u24C6\uFF31\uA756\uA758\u024A]/g
            }, {
                base: "R",
                letters: /[\u0052\u24C7\uFF32\u0154\u1E58\u0158\u0210\u0212\u1E5A\u1E5C\u0156\u1E5E\u024C\u2C64\uA75A\uA7A6\uA782]/g
            }, {
                base: "S",
                letters: /[\u0053\u24C8\uFF33\u1E9E\u015A\u1E64\u015C\u1E60\u0160\u1E66\u1E62\u1E68\u0218\u015E\u2C7E\uA7A8\uA784]/g
            }, {
                base: "T",
                letters: /[\u0054\u24C9\uFF34\u1E6A\u0164\u1E6C\u021A\u0162\u1E70\u1E6E\u0166\u01AC\u01AE\u023E\uA786]/g
            }, {
                base: "TZ",
                letters: /[\uA728]/g
            }, {
                base: "U",
                letters: /[\u0055\u24CA\uFF35\u00D9\u00DA\u00DB\u0168\u1E78\u016A\u1E7A\u016C\u00DC\u01DB\u01D7\u01D5\u01D9\u1EE6\u016E\u0170\u01D3\u0214\u0216\u01AF\u1EEA\u1EE8\u1EEE\u1EEC\u1EF0\u1EE4\u1E72\u0172\u1E76\u1E74\u0244]/g
            }, {
                base: "V",
                letters: /[\u0056\u24CB\uFF36\u1E7C\u1E7E\u01B2\uA75E\u0245]/g
            }, {
                base: "VY",
                letters: /[\uA760]/g
            }, {
                base: "W",
                letters: /[\u0057\u24CC\uFF37\u1E80\u1E82\u0174\u1E86\u1E84\u1E88\u2C72]/g
            }, {
                base: "X",
                letters: /[\u0058\u24CD\uFF38\u1E8A\u1E8C]/g
            }, {
                base: "Y",
                letters: /[\u0059\u24CE\uFF39\u1EF2\u00DD\u0176\u1EF8\u0232\u1E8E\u0178\u1EF6\u1EF4\u01B3\u024E\u1EFE]/g
            }, {
                base: "Z",
                letters: /[\u005A\u24CF\uFF3A\u0179\u1E90\u017B\u017D\u1E92\u1E94\u01B5\u0224\u2C7F\u2C6B\uA762]/g
            }, {
                base: "a",
                letters: /[\u0061\u24D0\uFF41\u1E9A\u00E0\u00E1\u00E2\u1EA7\u1EA5\u1EAB\u1EA9\u00E3\u0101\u0103\u1EB1\u1EAF\u1EB5\u1EB3\u0227\u01E1\u00E4\u01DF\u1EA3\u00E5\u01FB\u01CE\u0201\u0203\u1EA1\u1EAD\u1EB7\u1E01\u0105\u2C65\u0250]/g
            }, {
                base: "aa",
                letters: /[\uA733]/g
            }, {
                base: "ae",
                letters: /[\u00E6\u01FD\u01E3]/g
            }, {
                base: "ao",
                letters: /[\uA735]/g
            }, {
                base: "au",
                letters: /[\uA737]/g
            }, {
                base: "av",
                letters: /[\uA739\uA73B]/g
            }, {
                base: "ay",
                letters: /[\uA73D]/g
            }, {
                base: "b",
                letters: /[\u0062\u24D1\uFF42\u1E03\u1E05\u1E07\u0180\u0183\u0253]/g
            }, {
                base: "c",
                letters: /[\u0063\u24D2\uFF43\u0107\u0109\u010B\u010D\u00E7\u1E09\u0188\u023C\uA73F\u2184]/g
            }, {
                base: "d",
                letters: /[\u0064\u24D3\uFF44\u1E0B\u010F\u1E0D\u1E11\u1E13\u1E0F\u0111\u018C\u0256\u0257\uA77A]/g
            }, {
                base: "dz",
                letters: /[\u01F3\u01C6]/g
            }, {
                base: "e",
                letters: /[\u0065\u24D4\uFF45\u00E8\u00E9\u00EA\u1EC1\u1EBF\u1EC5\u1EC3\u1EBD\u0113\u1E15\u1E17\u0115\u0117\u00EB\u1EBB\u011B\u0205\u0207\u1EB9\u1EC7\u0229\u1E1D\u0119\u1E19\u1E1B\u0247\u025B\u01DD]/g
            }, {
                base: "f",
                letters: /[\u0066\u24D5\uFF46\u1E1F\u0192\uA77C]/g
            }, {
                base: "g",
                letters: /[\u0067\u24D6\uFF47\u01F5\u011D\u1E21\u011F\u0121\u01E7\u0123\u01E5\u0260\uA7A1\u1D79\uA77F]/g
            }, {
                base: "h",
                letters: /[\u0068\u24D7\uFF48\u0125\u1E23\u1E27\u021F\u1E25\u1E29\u1E2B\u1E96\u0127\u2C68\u2C76\u0265]/g
            }, {
                base: "hv",
                letters: /[\u0195]/g
            }, {
                base: "i",
                letters: /[\u0069\u24D8\uFF49\u00EC\u00ED\u00EE\u0129\u012B\u012D\u00EF\u1E2F\u1EC9\u01D0\u0209\u020B\u1ECB\u012F\u1E2D\u0268\u0131]/g
            }, {
                base: "j",
                letters: /[\u006A\u24D9\uFF4A\u0135\u01F0\u0249]/g
            }, {
                base: "k",
                letters: /[\u006B\u24DA\uFF4B\u1E31\u01E9\u1E33\u0137\u1E35\u0199\u2C6A\uA741\uA743\uA745\uA7A3]/g
            }, {
                base: "l",
                letters: /[\u006C\u24DB\uFF4C\u0140\u013A\u013E\u1E37\u1E39\u013C\u1E3D\u1E3B\u017F\u0142\u019A\u026B\u2C61\uA749\uA781\uA747]/g
            }, {
                base: "lj",
                letters: /[\u01C9]/g
            }, {
                base: "m",
                letters: /[\u006D\u24DC\uFF4D\u1E3F\u1E41\u1E43\u0271\u026F]/g
            }, {
                base: "n",
                letters: /[\u006E\u24DD\uFF4E\u01F9\u0144\u00F1\u1E45\u0148\u1E47\u0146\u1E4B\u1E49\u019E\u0272\u0149\uA791\uA7A5]/g
            }, {
                base: "nj",
                letters: /[\u01CC]/g
            }, {
                base: "o",
                letters: /[\u006F\u24DE\uFF4F\u00F2\u00F3\u00F4\u1ED3\u1ED1\u1ED7\u1ED5\u00F5\u1E4D\u022D\u1E4F\u014D\u1E51\u1E53\u014F\u022F\u0231\u00F6\u022B\u1ECF\u0151\u01D2\u020D\u020F\u01A1\u1EDD\u1EDB\u1EE1\u1EDF\u1EE3\u1ECD\u1ED9\u01EB\u01ED\u00F8\u01FF\u0254\uA74B\uA74D\u0275]/g
            }, {
                base: "oi",
                letters: /[\u01A3]/g
            }, {
                base: "ou",
                letters: /[\u0223]/g
            }, {
                base: "oo",
                letters: /[\uA74F]/g
            }, {
                base: "p",
                letters: /[\u0070\u24DF\uFF50\u1E55\u1E57\u01A5\u1D7D\uA751\uA753\uA755]/g
            }, {
                base: "q",
                letters: /[\u0071\u24E0\uFF51\u024B\uA757\uA759]/g
            }, {
                base: "r",
                letters: /[\u0072\u24E1\uFF52\u0155\u1E59\u0159\u0211\u0213\u1E5B\u1E5D\u0157\u1E5F\u024D\u027D\uA75B\uA7A7\uA783]/g
            }, {
                base: "s",
                letters: /[\u0073\u24E2\uFF53\u00DF\u015B\u1E65\u015D\u1E61\u0161\u1E67\u1E63\u1E69\u0219\u015F\u023F\uA7A9\uA785\u1E9B]/g
            }, {
                base: "t",
                letters: /[\u0074\u24E3\uFF54\u1E6B\u1E97\u0165\u1E6D\u021B\u0163\u1E71\u1E6F\u0167\u01AD\u0288\u2C66\uA787]/g
            }, {
                base: "tz",
                letters: /[\uA729]/g
            }, {
                base: "u",
                letters: /[\u0075\u24E4\uFF55\u00F9\u00FA\u00FB\u0169\u1E79\u016B\u1E7B\u016D\u00FC\u01DC\u01D8\u01D6\u01DA\u1EE7\u016F\u0171\u01D4\u0215\u0217\u01B0\u1EEB\u1EE9\u1EEF\u1EED\u1EF1\u1EE5\u1E73\u0173\u1E77\u1E75\u0289]/g
            }, {
                base: "v",
                letters: /[\u0076\u24E5\uFF56\u1E7D\u1E7F\u028B\uA75F\u028C]/g
            }, {
                base: "vy",
                letters: /[\uA761]/g
            }, {
                base: "w",
                letters: /[\u0077\u24E6\uFF57\u1E81\u1E83\u0175\u1E87\u1E85\u1E98\u1E89\u2C73]/g
            }, {
                base: "x",
                letters: /[\u0078\u24E7\uFF58\u1E8B\u1E8D]/g
            }, {
                base: "y",
                letters: /[\u0079\u24E8\uFF59\u1EF3\u00FD\u0177\u1EF9\u0233\u1E8F\u00FF\u1EF7\u1E99\u1EF5\u01B4\u024F\u1EFF]/g
            }, {
                base: "z",
                letters: /[\u007A\u24E9\uFF5A\u017A\u1E91\u017C\u017E\u1E93\u1E95\u01B6\u0225\u0240\u2C6C\uA763]/g
            }]
        }, a.fn.quicksearch = function(c, d) {
            this.removeDiacritics = function(b) {
                for (var c = a.quicksearch.diacriticsRemovalMap, d = 0; d < c.length; d++) b = b.replace(c[d].letters, c[d].base);
                return b
            };
            var e, f, g, h, i = "",
                j = "",
                k = this,
                l = a.extend({}, a.quicksearch.defaults, d);
            return l.noResults = l.noResults ? a(l.noResults) : a(), l.loader = l.loader ? a(l.loader) : a(), this.go = function() {
                var a, b = 0,
                    c = 0,
                    d = 0,
                    e = !0,
                    h = 0 === i.replace(" ", "").length;
                for (l.removeDiacritics && (i = k.removeDiacritics(i)), a = l.prepareQuery(i), b = 0, c = g.length; c > b; b++) a.length > 0 && a[0].length < l.minValLength ? (l.show.apply(g[b]), e = !1, d++) : h || l.testQuery(a, f[b], g[b]) ? (l.show.apply(g[b]), e = !1, d++) : l.hide.apply(g[b]);
                return e ? this.results(!1) : (this.results(!0), this.stripe()), this.matchedResultsCount = d, this.loader(!1), l.onAfter.call(this), j = i, this
            }, this.search = function(a) {
                i = a, k.trigger()
            }, this.reset = function() {
                i = "", this.loader(!0), l.onBefore.call(this), b.clearTimeout(e), e = b.setTimeout(function() {
                    k.go()
                }, l.delay)
            }, this.currentMatchedResults = function() {
                return this.matchedResultsCount
            }, this.stripe = function() {
                if ("object" == typeof l.stripeRows && null !== l.stripeRows) {
                    var b = l.stripeRows.join(" "),
                        c = l.stripeRows.length;
                    h.not(":hidden").each(function(d) {
                        a(this).removeClass(b).addClass(l.stripeRows[d % c])
                    })
                }
                return this
            }, this.strip_html = function(b) {
                var c = b.replace(new RegExp("<[^<]+\\>", "g"), "");
                return c = a.trim(c.toLowerCase())
            }, this.results = function(a) {
                return l.noResults.length && l.noResults[a ? "hide" : "show"](), this
            }, this.loader = function(a) {
                return l.loader.length && l.loader[a ? "show" : "hide"](), this
            }, this.cache = function(b) {
                b = "undefined" == typeof b ? !0 : b, h = l.noResults ? a(c).not(l.noResults) : a(c);
                var d = "string" == typeof l.selector ? h.find(l.selector) : a(c).not(l.noResults);
                return f = d.map(function() {
                    var a = k.strip_html(this.innerHTML);
                    return l.removeDiacritics ? k.removeDiacritics(a) : a
                }), g = h.map(function() {
                    return this
                }), i = i || this.val() || "", b && this.go(), this
            }, this.trigger = function() {
                return i.length < l.minValLength && i.length > j.length || i.length < l.minValLength - 1 && i.length < j.length ? (l.onValTooSmall.call(this, i), k.go()) : (this.loader(!0), l.onBefore.call(this), b.clearTimeout(e), e = b.setTimeout(function() {
                    k.go()
                }, l.delay)), this
            }, this.cache(), this.results(!0), this.stripe(), this.loader(!1), this.each(function() {
                a(this).on(l.bind, function() {
                    i = a(this).val(), k.trigger()
                }), a(this).on(l.resetBind, function() {
                    i = "", k.reset()
                })
            })
        }
    }(jQuery, this, document), function(a, b) {
        "use strict";
        "function" == typeof define && define.amd ? define(["jquery"], b) : "object" == typeof exports ? module.exports = b(require("jquery")) : a.bootbox = b(a.jQuery)
    }(this, function a(b, c) {
        "use strict";

        function d(a) {
            var b = q[o.locale];
            return b ? b[a] : q.en[a]
        }

        function e(a, c, d) {
            a.stopPropagation(), a.preventDefault();
            var e = b.isFunction(d) && d(a) === !1;
            e || c.modal("hide")
        }

        function f(a) {
            var b, c = 0;
            for (b in a) c++;
            return c
        }

        function g(a, c) {
            var d = 0;
            b.each(a, function(a, b) {
                c(a, b, d++)
            })
        }

        function h(a) {
            var c, d;
            if ("object" != typeof a) throw new Error("Please supply an object of options");
            if (!a.message) throw new Error("Please specify a message");
            return a = b.extend({}, o, a), a.buttons || (a.buttons = {}), a.backdrop = a.backdrop ? "static" : !1, c = a.buttons, d = f(c), g(c, function(a, e, f) {
                if (b.isFunction(e) && (e = c[a] = {
                        callback: e
                    }), "object" !== b.type(e)) throw new Error("button with key " + a + " must be an object");
                e.label || (e.label = a), e.className || (e.className = 2 >= d && f === d - 1 ? "btn-primary" : "btn-default")
            }), a
        }

        function i(a, b) {
            var c = a.length,
                d = {};
            if (1 > c || c > 2) throw new Error("Invalid argument length");
            return 2 === c || "string" == typeof a[0] ? (d[b[0]] = a[0], d[b[1]] = a[1]) : d = a[0], d
        }

        function j(a, c, d) {
            return b.extend(!0, {}, a, i(c, d))
        }

        function k(a, b, c, d) {
            var e = {
                className: "bootbox-" + a,
                buttons: l.apply(null, b)
            };
            return m(j(e, d, c), b)
        }

        function l() {
            for (var a = {}, b = 0, c = arguments.length; c > b; b++) {
                var e = arguments[b],
                    f = e.toLowerCase(),
                    g = e.toUpperCase();
                a[f] = {
                    label: d(g)
                }
            }
            return a
        }

        function m(a, b) {
            var d = {};
            return g(b, function(a, b) {
                d[b] = !0
            }), g(a.buttons, function(a) {
                if (d[a] === c) throw new Error("button key " + a + " is not allowed (options are " + b.join("\n") + ")")
            }), a
        }
        var n = {
                dialog: "<div class='bootbox modal' tabindex='-1' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='bootbox-body'></div></div></div></div></div>",
                header: "<div class='modal-header'><h4 class='modal-title'></h4></div>",
                footer: "<div class='modal-footer'></div>",
                closeButton: "<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>",
                form: "<form class='bootbox-form'></form>",
                inputs: {
                    text: "<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",
                    textarea: "<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",
                    email: "<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",
                    select: "<select class='bootbox-input bootbox-input-select form-control'></select>",
                    checkbox: "<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",
                    date: "<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",
                    time: "<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",
                    number: "<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",
                    password: "<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"
                }
            },
            o = {
                locale: "en",
                backdrop: !0,
                animate: !0,
                className: null,
                closeButton: !0,
                show: !0,
                container: "body"
            },
            p = {};
        p.alert = function() {
            var a;
            if (a = k("alert", ["ok"], ["message", "callback"], arguments), a.callback && !b.isFunction(a.callback)) throw new Error("alert requires callback property to be a function when provided");
            return a.buttons.ok.callback = a.onEscape = function() {
                return b.isFunction(a.callback) ? a.callback() : !0
            }, p.dialog(a)
        }, p.confirm = function() {
            var a;
            if (a = k("confirm", ["cancel", "confirm"], ["message", "callback"], arguments), a.buttons.cancel.callback = a.onEscape = function() {
                    return a.callback(!1)
                }, a.buttons.confirm.callback = function() {
                    return a.callback(!0)
                }, !b.isFunction(a.callback)) throw new Error("confirm requires a callback");
            return p.dialog(a)
        }, p.prompt = function() {
            var a, d, e, f, h, i, k;
            f = b(n.form), d = {
                className: "bootbox-prompt",
                buttons: l("cancel", "confirm"),
                value: "",
                inputType: "text"
            }, a = m(j(d, arguments, ["title", "callback"]), ["cancel", "confirm"]), i = a.show === c ? !0 : a.show;
            var o = ["date", "time", "number"],
                q = document.createElement("input");
            if (q.setAttribute("type", a.inputType), o[a.inputType] && (a.inputType = q.type), a.message = f, a.buttons.cancel.callback = a.onEscape = function() {
                    return a.callback(null)
                }, a.buttons.confirm.callback = function() {
                    var c;
                    switch (a.inputType) {
                        case "text":
                        case "textarea":
                        case "email":
                        case "select":
                        case "date":
                        case "time":
                        case "number":
                        case "password":
                            c = h.val();
                            break;
                        case "checkbox":
                            var d = h.find("input:checked");
                            c = [], g(d, function(a, d) {
                                c.push(b(d).val())
                            })
                    }
                    return a.callback(c)
                }, a.show = !1, !a.title) throw new Error("prompt requires a title");
            if (!b.isFunction(a.callback)) throw new Error("prompt requires a callback");
            if (!n.inputs[a.inputType]) throw new Error("invalid prompt type");
            switch (h = b(n.inputs[a.inputType]), a.inputType) {
                case "text":
                case "textarea":
                case "email":
                case "date":
                case "time":
                case "number":
                case "password":
                    h.val(a.value);
                    break;
                case "select":
                    var r = {};
                    if (k = a.inputOptions || [], !k.length) throw new Error("prompt with select requires options");
                    g(k, function(a, d) {
                        var e = h;
                        if (d.value === c || d.text === c) throw new Error("given options in wrong format");
                        d.group && (r[d.group] || (r[d.group] = b("<optgroup/>").attr("label", d.group)), e = r[d.group]), e.append("<option value='" + d.value + "'>" + d.text + "</option>")
                    }), g(r, function(a, b) {
                        h.append(b)
                    }), h.val(a.value);
                    break;
                case "checkbox":
                    var s = b.isArray(a.value) ? a.value : [a.value];
                    if (k = a.inputOptions || [], !k.length) throw new Error("prompt with checkbox requires options");
                    if (!k[0].value || !k[0].text) throw new Error("given options in wrong format");
                    h = b("<div/>"), g(k, function(c, d) {
                        var e = b(n.inputs[a.inputType]);
                        e.find("input").attr("value", d.value), e.find("label").append(d.text), g(s, function(a, b) {
                            b === d.value && e.find("input").prop("checked", !0)
                        }), h.append(e)
                    })
            }
            return a.placeholder && h.attr("placeholder", a.placeholder), a.pattern && h.attr("pattern", a.pattern), f.append(h), f.on("submit", function(a) {
                a.preventDefault(), a.stopPropagation(), e.find(".btn-primary").click()
            }), e = p.dialog(a), e.off("shown.bs.modal"), e.on("shown.bs.modal", function() {
                h.focus()
            }), i === !0 && e.modal("show"), e
        }, p.dialog = function(a) {
            a = h(a);
            var c = b(n.dialog),
                d = c.find(".modal-dialog"),
                f = c.find(".modal-body"),
                i = a.buttons,
                j = "",
                k = {
                    onEscape: a.onEscape
                };
            if (g(i, function(a, b) {
                    j += "<button data-bb-handler='" + a + "' type='button' class='btn " + b.className + "'>" + b.label + "</button>", k[a] = b.callback
                }), f.find(".bootbox-body").html(a.message), a.animate === !0 && c.addClass("fade"), a.className && c.addClass(a.className), "large" === a.size && d.addClass("modal-lg"), "small" === a.size && d.addClass("modal-sm"), a.title && f.before(n.header), a.closeButton) {
                var l = b(n.closeButton);
                a.title ? c.find(".modal-header").prepend(l) : l.css("margin-top", "-10px").prependTo(f)
            }
            return a.title && c.find(".modal-title").html(a.title), j.length && (f.after(n.footer), c.find(".modal-footer").html(j)), c.on("hidden.bs.modal", function(a) {
                a.target === this && c.remove()
            }), c.on("shown.bs.modal", function() {
                c.find(".btn-primary:first").focus()
            }), c.on("escape.close.bb", function(a) {
                k.onEscape && e(a, c, k.onEscape)
            }), c.on("click", ".modal-footer button", function(a) {
                var d = b(this).data("bb-handler");
                e(a, c, k[d])
            }), c.on("click", ".bootbox-close-button", function(a) {
                e(a, c, k.onEscape)
            }), c.on("keyup", function(a) {
                27 === a.which && c.trigger("escape.close.bb")
            }), b(a.container).append(c), c.modal({
                backdrop: a.backdrop,
                keyboard: !1,
                show: !1
            }), a.show && c.modal("show"), c
        }, p.setDefaults = function() {
            var a = {};
            2 === arguments.length ? a[arguments[0]] = arguments[1] : a = arguments[0], b.extend(o, a)
        }, p.hideAll = function() {
            b(".bootbox").modal("hide")
        };
        var q = {
            br: {
                OK: "OK",
                CANCEL: "Cancelar",
                CONFIRM: "Sim"
            },
            da: {
                OK: "OK",
                CANCEL: "Annuller",
                CONFIRM: "Accepter"
            },
            de: {
                OK: "OK",
                CANCEL: "Abbrechen",
                CONFIRM: "Akzeptieren"
            },
            el: {
                OK: "Εντάξει",
                CANCEL: "Ακύρωση",
                CONFIRM: "Επιβεβαίωση"
            },
            en: {
                OK: "OK",
                CANCEL: "Cancel",
                CONFIRM: "OK"
            },
            es: {
                OK: "OK",
                CANCEL: "Cancelar",
                CONFIRM: "Aceptar"
            },
            fi: {
                OK: "OK",
                CANCEL: "Peruuta",
                CONFIRM: "OK"
            },
            fr: {
                OK: "OK",
                CANCEL: "Annuler",
                CONFIRM: "D'accord"
            },
            he: {
                OK: "אישור",
                CANCEL: "ביטול",
                CONFIRM: "אישור"
            },
            it: {
                OK: "OK",
                CANCEL: "Annulla",
                CONFIRM: "Conferma"
            },
            lt: {
                OK: "Gerai",
                CANCEL: "Atšaukti",
                CONFIRM: "Patvirtinti"
            },
            lv: {
                OK: "Labi",
                CANCEL: "Atcelt",
                CONFIRM: "Apstiprināt"
            },
            nl: {
                OK: "OK",
                CANCEL: "Annuleren",
                CONFIRM: "Accepteren"
            },
            no: {
                OK: "OK",
                CANCEL: "Avbryt",
                CONFIRM: "OK"
            },
            pl: {
                OK: "OK",
                CANCEL: "Anuluj",
                CONFIRM: "Potwierdź"
            },
            ru: {
                OK: "OK",
                CANCEL: "Отмена",
                CONFIRM: "Применить"
            },
            sv: {
                OK: "OK",
                CANCEL: "Avbryt",
                CONFIRM: "OK"
            },
            tr: {
                OK: "Tamam",
                CANCEL: "İptal",
                CONFIRM: "Onayla"
            },
            zh_CN: {
                OK: "OK",
                CANCEL: "取消",
                CONFIRM: "确认"
            },
            zh_TW: {
                OK: "OK",
                CANCEL: "取消",
                CONFIRM: "確認"
            }
        };
        return p.init = function(c) {
            return a(c || b)
        }, p
    }), function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
    }(function(a) {
        "use strict";
        var b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q, r, s, t, u, v, w, x, y, z, A, B, C, D, E, F, G, H = {},
            I = 0;
        b = function() {
                return {
                    common: {
                        type: "line",
                        lineColor: "#00f",
                        fillColor: "#cdf",
                        defaultPixelsPerValue: 3,
                        width: "auto",
                        height: "auto",
                        composite: !1,
                        tagValuesAttribute: "values",
                        tagOptionsPrefix: "spark",
                        enableTagOptions: !1,
                        enableHighlight: !0,
                        highlightLighten: 1.4,
                        tooltipSkipNull: !0,
                        tooltipPrefix: "",
                        tooltipSuffix: "",
                        disableHiddenCheck: !1,
                        numberFormatter: !1,
                        numberDigitGroupCount: 3,
                        numberDigitGroupSep: ",",
                        numberDecimalMark: ".",
                        disableTooltips: !1,
                        disableInteraction: !1
                    },
                    line: {
                        spotColor: "#f80",
                        highlightSpotColor: "#5f5",
                        highlightLineColor: "#f22",
                        spotRadius: 1.5,
                        minSpotColor: "#f80",
                        maxSpotColor: "#f80",
                        lineWidth: 1,
                        normalRangeMin: void 0,
                        normalRangeMax: void 0,
                        normalRangeColor: "#ccc",
                        drawNormalOnTop: !1,
                        chartRangeMin: void 0,
                        chartRangeMax: void 0,
                        chartRangeMinX: void 0,
                        chartRangeMaxX: void 0,
                        tooltipFormat: new d('<span style="color: {{color}}">&#9679;</span> {{prefix}}{{y}}{{suffix}}')
                    },
                    bar: {
                        barColor: "#3366cc",
                        negBarColor: "#f44",
                        stackedBarColor: ["#3366cc", "#dc3912", "#ff9900", "#109618", "#66aa00", "#dd4477", "#0099c6", "#990099"],
                        zeroColor: void 0,
                        nullColor: void 0,
                        zeroAxis: !0,
                        barWidth: 4,
                        barSpacing: 1,
                        chartRangeMax: void 0,
                        chartRangeMin: void 0,
                        chartRangeClip: !1,
                        colorMap: void 0,
                        tooltipFormat: new d('<span style="color: {{color}}">&#9679;</span> {{prefix}}{{value}}{{suffix}}')
                    },
                    tristate: {
                        barWidth: 4,
                        barSpacing: 1,
                        posBarColor: "#6f6",
                        negBarColor: "#f44",
                        zeroBarColor: "#999",
                        colorMap: {},
                        tooltipFormat: new d('<span style="color: {{color}}">&#9679;</span> {{value:map}}'),
                        tooltipValueLookups: {
                            map: {
                                "-1": "Loss",
                                0: "Draw",
                                1: "Win"
                            }
                        }
                    },
                    discrete: {
                        lineHeight: "auto",
                        thresholdColor: void 0,
                        thresholdValue: 0,
                        chartRangeMax: void 0,
                        chartRangeMin: void 0,
                        chartRangeClip: !1,
                        tooltipFormat: new d("{{prefix}}{{value}}{{suffix}}")
                    },
                    bullet: {
                        targetColor: "#f33",
                        targetWidth: 3,
                        performanceColor: "#33f",
                        rangeColors: ["#d3dafe", "#a8b6ff", "#7f94ff"],
                        base: void 0,
                        tooltipFormat: new d("{{fieldkey:fields}} - {{value}}"),
                        tooltipValueLookups: {
                            fields: {
                                r: "Range",
                                p: "Performance",
                                t: "Target"
                            }
                        }
                    },
                    pie: {
                        offset: 0,
                        sliceColors: ["#3366cc", "#dc3912", "#ff9900", "#109618", "#66aa00", "#dd4477", "#0099c6", "#990099"],
                        borderWidth: 0,
                        borderColor: "#000",
                        tooltipFormat: new d('<span style="color: {{color}}">&#9679;</span> {{value}} ({{percent.1}}%)')
                    },
                    box: {
                        raw: !1,
                        boxLineColor: "#000",
                        boxFillColor: "#cdf",
                        whiskerColor: "#000",
                        outlierLineColor: "#333",
                        outlierFillColor: "#fff",
                        medianColor: "#f00",
                        showOutliers: !0,
                        outlierIQR: 1.5,
                        spotRadius: 1.5,
                        target: void 0,
                        targetColor: "#4a2",
                        chartRangeMax: void 0,
                        chartRangeMin: void 0,
                        tooltipFormat: new d("{{field:fields}}: {{value}}"),
                        tooltipFormatFieldlistKey: "field",
                        tooltipValueLookups: {
                            fields: {
                                lq: "Lower Quartile",
                                med: "Median",
                                uq: "Upper Quartile",
                                lo: "Left Outlier",
                                ro: "Right Outlier",
                                lw: "Left Whisker",
                                rw: "Right Whisker"
                            }
                        }
                    }
                }
            }, A = '.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}', c = function() {
                var b, c;
                return b = function() {
                    this.init.apply(this, arguments)
                }, arguments.length > 1 ? (arguments[0] ? (b.prototype = a.extend(new arguments[0], arguments[arguments.length - 1]), b._super = arguments[0].prototype) : b.prototype = arguments[arguments.length - 1], arguments.length > 2 && (c = Array.prototype.slice.call(arguments, 1, -1), c.unshift(b.prototype), a.extend.apply(a, c))) : b.prototype = arguments[0], b.prototype.cls = b, b
            }, a.SPFormatClass = d = c({
                fre: /\{\{([\w.]+?)(:(.+?))?\}\}/g,
                precre: /(\w+)\.(\d+)/,
                init: function(a, b) {
                    this.format = a, this.fclass = b
                },
                render: function(a, b, c) {
                    var d, e, f, g, h, i = this,
                        k = a;
                    return this.format.replace(this.fre, function() {
                        var a;
                        return e = arguments[1], f = arguments[3], d = i.precre.exec(e), d ? (h = d[2], e = d[1]) : h = !1, g = k[e], void 0 === g ? "" : f && b && b[f] ? (a = b[f], a.get ? b[f].get(g) || g : b[f][g] || g) : (j(g) && (g = c.get("numberFormatter") ? c.get("numberFormatter")(g) : o(g, h, c.get("numberDigitGroupCount"), c.get("numberDigitGroupSep"), c.get("numberDecimalMark"))), g)
                    })
                }
            }), a.spformat = function(a, b) {
                return new d(a, b)
            }, e = function(a, b, c) {
                return b > a ? b : a > c ? c : a
            }, f = function(a, b) {
                var c;
                return 2 === b ? (c = Math.floor(a.length / 2), a.length % 2 ? a[c] : (a[c - 1] + a[c]) / 2) : a.length % 2 ? (c = (a.length * b + b) / 4, c % 1 ? (a[Math.floor(c)] + a[Math.floor(c) - 1]) / 2 : a[c - 1]) : (c = (a.length * b + 2) / 4, c % 1 ? (a[Math.floor(c)] + a[Math.floor(c) - 1]) / 2 : a[c - 1])
            }, g = function(a) {
                var b;
                switch (a) {
                    case "undefined":
                        a = void 0;
                        break;
                    case "null":
                        a = null;
                        break;
                    case "true":
                        a = !0;
                        break;
                    case "false":
                        a = !1;
                        break;
                    default:
                        b = parseFloat(a), a == b && (a = b)
                }
                return a
            }, h = function(a) {
                var b, c = [];
                for (b = a.length; b--;) c[b] = g(a[b]);
                return c
            }, i = function(a, b) {
                var c, d, e = [];
                for (c = 0, d = a.length; d > c; c++) a[c] !== b && e.push(a[c]);
                return e
            }, j = function(a) {
                return !isNaN(parseFloat(a)) && isFinite(a)
            }, o = function(b, c, d, e, f) {
                var g, h;
                for (b = (c === !1 ? parseFloat(b).toString() : b.toFixed(c)).split(""), g = (g = a.inArray(".", b)) < 0 ? b.length : g, g < b.length && (b[g] = f), h = g - d; h > 0; h -= d) b.splice(h, 0, e);
                return b.join("")
            }, k = function(a, b, c) {
                var d;
                for (d = b.length; d--;)
                    if ((!c || null !== b[d]) && b[d] !== a) return !1;
                return !0
            }, l = function(a) {
                var b, c = 0;
                for (b = a.length; b--;) c += "number" == typeof a[b] ? a[b] : 0;
                return c
            }, n = function(b) {
                return a.isArray(b) ? b : [b]
            }, m = function(a) {
                var b;
                document.createStyleSheet ? document.createStyleSheet().cssText = a : (b = document.createElement("style"), b.type = "text/css", document.getElementsByTagName("head")[0].appendChild(b), b["string" == typeof document.body.style.WebkitAppearance ? "innerText" : "innerHTML"] = a)
            }, a.fn.simpledraw = function(b, c, d, e) {
                var f, g;
                if (d && (f = this.data("_jqs_vcanvas"))) return f;
                if (void 0 === b && (b = a(this).innerWidth()), void 0 === c && (c = a(this).innerHeight()), a.fn.sparkline.hasCanvas) f = new E(b, c, this, e);
                else {
                    if (!a.fn.sparkline.hasVML) return !1;
                    f = new F(b, c, this)
                }
                return g = a(this).data("_jqs_mhandler"), g && g.registerCanvas(f), f
            }, a.fn.cleardraw = function() {
                var a = this.data("_jqs_vcanvas");
                a && a.reset()
            }, a.RangeMapClass = p = c({
                init: function(a) {
                    var b, c, d = [];
                    for (b in a) a.hasOwnProperty(b) && "string" == typeof b && b.indexOf(":") > -1 && (c = b.split(":"), c[0] = 0 === c[0].length ? -1 / 0 : parseFloat(c[0]), c[1] = 0 === c[1].length ? 1 / 0 : parseFloat(c[1]), c[2] = a[b], d.push(c));
                    this.map = a, this.rangelist = d || !1
                },
                get: function(a) {
                    var b, c, d, e = this.rangelist;
                    if (void 0 !== (d = this.map[a])) return d;
                    if (e)
                        for (b = e.length; b--;)
                            if (c = e[b], c[0] <= a && c[1] >= a) return c[2];
                    return void 0
                }
            }), a.range_map = function(a) {
                return new p(a)
            }, q = c({
                init: function(b, c) {
                    var d = a(b);
                    this.$el = d, this.options = c, this.currentPageX = 0, this.currentPageY = 0, this.el = b, this.splist = [], this.tooltip = null, this.over = !1, this.displayTooltips = !c.get("disableTooltips"), this.highlightEnabled = !c.get("disableHighlight")
                },
                registerSparkline: function(a) {
                    this.splist.push(a), this.over && this.updateDisplay()
                },
                registerCanvas: function(b) {
                    var c = a(b.canvas);
                    this.canvas = b, this.$canvas = c, c.mouseenter(a.proxy(this.mouseenter, this)), c.mouseleave(a.proxy(this.mouseleave, this)), c.click(a.proxy(this.mouseclick, this))
                },
                reset: function(a) {
                    this.splist = [], this.tooltip && a && (this.tooltip.remove(), this.tooltip = void 0)
                },
                mouseclick: function(b) {
                    var c = a.Event("sparklineClick");
                    c.originalEvent = b, c.sparklines = this.splist, this.$el.trigger(c)
                },
                mouseenter: function(b) {
                    a(document.body).unbind("mousemove.jqs"), a(document.body).bind("mousemove.jqs", a.proxy(this.mousemove, this)), this.over = !0, this.currentPageX = b.pageX, this.currentPageY = b.pageY, this.currentEl = b.target, !this.tooltip && this.displayTooltips && (this.tooltip = new r(this.options), this.tooltip.updatePosition(b.pageX, b.pageY)), this.updateDisplay()
                },
                mouseleave: function() {
                    a(document.body).unbind("mousemove.jqs");
                    var b, c, d = this.splist,
                        e = d.length,
                        f = !1;
                    for (this.over = !1, this.currentEl = null, this.tooltip && (this.tooltip.remove(), this.tooltip = null), c = 0; e > c; c++) b = d[c], b.clearRegionHighlight() && (f = !0);
                    f && this.canvas.render()
                },
                mousemove: function(a) {
                    this.currentPageX = a.pageX, this.currentPageY = a.pageY, this.currentEl = a.target, this.tooltip && this.tooltip.updatePosition(a.pageX, a.pageY), this.updateDisplay()
                },
                updateDisplay: function() {
                    var b, c, d, e, f, g = this.splist,
                        h = g.length,
                        i = !1,
                        j = this.$canvas.offset(),
                        k = this.currentPageX - j.left,
                        l = this.currentPageY - j.top;
                    if (this.over) {
                        for (d = 0; h > d; d++) c = g[d], e = c.setRegionHighlight(this.currentEl, k, l), e && (i = !0);
                        if (i) {
                            if (f = a.Event("sparklineRegionChange"), f.sparklines = this.splist, this.$el.trigger(f), this.tooltip) {
                                for (b = "", d = 0; h > d; d++) c = g[d], b += c.getCurrentRegionTooltip();
                                this.tooltip.setContent(b)
                            }
                            this.disableHighlight || this.canvas.render()
                        }
                        null === e && this.mouseleave()
                    }
                }
            }), r = c({
                sizeStyle: "position: static !important;display: block !important;visibility: hidden !important;float: left !important;",
                init: function(b) {
                    var c, d = b.get("tooltipClassname", "jqstooltip"),
                        e = this.sizeStyle;
                    this.container = b.get("tooltipContainer") || document.body, this.tooltipOffsetX = b.get("tooltipOffsetX", 10), this.tooltipOffsetY = b.get("tooltipOffsetY", 12), a("#jqssizetip").remove(), a("#jqstooltip").remove(), this.sizetip = a("<div/>", {
                        id: "jqssizetip",
                        style: e,
                        "class": d
                    }), this.tooltip = a("<div/>", {
                        id: "jqstooltip",
                        "class": d
                    }).appendTo(this.container), c = this.tooltip.offset(), this.offsetLeft = c.left, this.offsetTop = c.top, this.hidden = !0, a(window).unbind("resize.jqs scroll.jqs"), a(window).bind("resize.jqs scroll.jqs", a.proxy(this.updateWindowDims, this)), this.updateWindowDims()
                },
                updateWindowDims: function() {
                    this.scrollTop = a(window).scrollTop(), this.scrollLeft = a(window).scrollLeft(), this.scrollRight = this.scrollLeft + a(window).width(), this.updatePosition()
                },
                getSize: function(a) {
                    this.sizetip.html(a).appendTo(this.container), this.width = this.sizetip.width() + 1, this.height = this.sizetip.height(), this.sizetip.remove()
                },
                setContent: function(a) {
                    return a ? (this.getSize(a), this.tooltip.html(a).css({
                        width: this.width,
                        height: this.height,
                        visibility: "visible"
                    }), void(this.hidden && (this.hidden = !1, this.updatePosition()))) : (this.tooltip.css("visibility", "hidden"), void(this.hidden = !0))
                },
                updatePosition: function(a, b) {
                    if (void 0 === a) {
                        if (void 0 === this.mousex) return;
                        a = this.mousex - this.offsetLeft, b = this.mousey - this.offsetTop
                    } else this.mousex = a -= this.offsetLeft, this.mousey = b -= this.offsetTop;
                    this.height && this.width && !this.hidden && (b -= this.height + this.tooltipOffsetY, a += this.tooltipOffsetX, b < this.scrollTop && (b = this.scrollTop), a < this.scrollLeft ? a = this.scrollLeft : a + this.width > this.scrollRight && (a = this.scrollRight - this.width), this.tooltip.css({
                        left: a,
                        top: b
                    }))
                },
                remove: function() {
                    this.tooltip.remove(), this.sizetip.remove(), this.sizetip = this.tooltip = void 0, a(window).unbind("resize.jqs scroll.jqs")
                }
            }), B = function() {
                m(A)
            }, a(B), G = [], a.fn.sparkline = function(b, c) {
                return this.each(function() {
                    var d, e, f = new a.fn.sparkline.options(this, c),
                        g = a(this);
                    if (d = function() {
                            var c, d, e, h, i, j, k;
                            return "html" === b || void 0 === b ? (k = this.getAttribute(f.get("tagValuesAttribute")), (void 0 === k || null === k) && (k = g.html()), c = k.replace(/(^\s*<!--)|(-->\s*$)|\s+/g, "").split(",")) : c = b, d = "auto" === f.get("width") ? c.length * f.get("defaultPixelsPerValue") : f.get("width"), "auto" === f.get("height") ? f.get("composite") && a.data(this, "_jqs_vcanvas") || (h = document.createElement("span"), h.innerHTML = "a", g.html(h), e = a(h).innerHeight() || a(h).height(), a(h).remove(), h = null) : e = f.get("height"), f.get("disableInteraction") ? i = !1 : (i = a.data(this, "_jqs_mhandler"), i ? f.get("composite") || i.reset() : (i = new q(this, f), a.data(this, "_jqs_mhandler", i))), f.get("composite") && !a.data(this, "_jqs_vcanvas") ? void(a.data(this, "_jqs_errnotify") || (alert("Attempted to attach a composite sparkline to an element with no existing sparkline"), a.data(this, "_jqs_errnotify", !0))) : (j = new(a.fn.sparkline[f.get("type")])(this, c, f, d, e), j.render(), void(i && i.registerSparkline(j)))
                        }, a(this).html() && !f.get("disableHiddenCheck") && a(this).is(":hidden") || a.fn.jquery < "1.3.0" && a(this).parents().is(":hidden") || !a(this).parents("body").length) {
                        if (!f.get("composite") && a.data(this, "_jqs_pending"))
                            for (e = G.length; e; e--) G[e - 1][0] == this && G.splice(e - 1, 1);
                        G.push([this, d]), a.data(this, "_jqs_pending", !0)
                    } else d.call(this)
                })
            }, a.fn.sparkline.defaults = b(), a.sparkline_display_visible = function() {
                var b, c, d, e = [];
                for (c = 0, d = G.length; d > c; c++) b = G[c][0], a(b).is(":visible") && !a(b).parents().is(":hidden") ? (G[c][1].call(b), a.data(G[c][0], "_jqs_pending", !1), e.push(c)) : a(b).closest("html").length || a.data(b, "_jqs_pending") || (a.data(G[c][0], "_jqs_pending", !1), e.push(c));
                for (c = e.length; c; c--) G.splice(e[c - 1], 1)
            }, a.fn.sparkline.options = c({
                init: function(b, c) {
                    var d, e, f, g;
                    this.userOptions = c = c || {}, this.tag = b, this.tagValCache = {}, e = a.fn.sparkline.defaults, f = e.common, this.tagOptionsPrefix = c.enableTagOptions && (c.tagOptionsPrefix || f.tagOptionsPrefix), g = this.getTagSetting("type"), d = g === H ? e[c.type || f.type] : e[g], this.mergedOptions = a.extend({}, f, d, c)
                },
                getTagSetting: function(a) {
                    var b, c, d, e, f = this.tagOptionsPrefix;
                    if (f === !1 || void 0 === f) return H;
                    if (this.tagValCache.hasOwnProperty(a)) b = this.tagValCache.key;
                    else {
                        if (b = this.tag.getAttribute(f + a), void 0 === b || null === b) b = H;
                        else if ("[" === b.substr(0, 1))
                            for (b = b.substr(1, b.length - 2).split(","), c = b.length; c--;) b[c] = g(b[c].replace(/(^\s*)|(\s*$)/g, ""));
                        else if ("{" === b.substr(0, 1))
                            for (d = b.substr(1, b.length - 2).split(","), b = {}, c = d.length; c--;) e = d[c].split(":", 2), b[e[0].replace(/(^\s*)|(\s*$)/g, "")] = g(e[1].replace(/(^\s*)|(\s*$)/g, ""));
                        else b = g(b);
                        this.tagValCache.key = b
                    }
                    return b
                },
                get: function(a, b) {
                    var c, d = this.getTagSetting(a);
                    return d !== H ? d : void 0 === (c = this.mergedOptions[a]) ? b : c
                }
            }), a.fn.sparkline._base = c({
                disabled: !1,
                init: function(b, c, d, e, f) {
                    this.el = b, this.$el = a(b), this.values = c, this.options = d, this.width = e, this.height = f, this.currentRegion = void 0
                },
                initTarget: function() {
                    var a = !this.options.get("disableInteraction");
                    (this.target = this.$el.simpledraw(this.width, this.height, this.options.get("composite"), a)) ? (this.canvasWidth = this.target.pixelWidth, this.canvasHeight = this.target.pixelHeight) : this.disabled = !0
                },
                render: function() {
                    return this.disabled ? (this.el.innerHTML = "", !1) : !0
                },
                getRegion: function() {},
                setRegionHighlight: function(a, b, c) {
                    var d, e = this.currentRegion,
                        f = !this.options.get("disableHighlight");
                    return b > this.canvasWidth || c > this.canvasHeight || 0 > b || 0 > c ? null : (d = this.getRegion(a, b, c), e !== d ? (void 0 !== e && f && this.removeHighlight(), this.currentRegion = d, void 0 !== d && f && this.renderHighlight(), !0) : !1)
                },
                clearRegionHighlight: function() {
                    return void 0 !== this.currentRegion ? (this.removeHighlight(), this.currentRegion = void 0, !0) : !1
                },
                renderHighlight: function() {
                    this.changeHighlight(!0)
                },
                removeHighlight: function() {
                    this.changeHighlight(!1)
                },
                changeHighlight: function() {},
                getCurrentRegionTooltip: function() {
                    var b, c, e, f, g, h, i, j, k, l, m, n, o, p, q = this.options,
                        r = "",
                        s = [];
                    if (void 0 === this.currentRegion) return "";
                    if (b = this.getCurrentRegionFields(), m = q.get("tooltipFormatter")) return m(this, q, b);
                    if (q.get("tooltipChartTitle") && (r += '<div class="jqs jqstitle">' + q.get("tooltipChartTitle") + "</div>\n"), c = this.options.get("tooltipFormat"), !c) return "";
                    if (a.isArray(c) || (c = [c]), a.isArray(b) || (b = [b]), i = this.options.get("tooltipFormatFieldlist"), j = this.options.get("tooltipFormatFieldlistKey"), i && j) {
                        for (k = [], h = b.length; h--;) l = b[h][j], -1 != (p = a.inArray(l, i)) && (k[p] = b[h]);
                        b = k
                    }
                    for (e = c.length, o = b.length, h = 0; e > h; h++)
                        for (n = c[h], "string" == typeof n && (n = new d(n)), f = n.fclass || "jqsfield", p = 0; o > p; p++) b[p].isNull && q.get("tooltipSkipNull") || (a.extend(b[p], {
                            prefix: q.get("tooltipPrefix"),
                            suffix: q.get("tooltipSuffix")
                        }), g = n.render(b[p], q.get("tooltipValueLookups"), q), s.push('<div class="' + f + '">' + g + "</div>"));
                    return s.length ? r + s.join("\n") : ""
                },
                getCurrentRegionFields: function() {},
                calcHighlightColor: function(a, b) {
                    var c, d, f, g, h = b.get("highlightColor"),
                        i = b.get("highlightLighten");
                    if (h) return h;
                    if (i && (c = /^#([0-9a-f])([0-9a-f])([0-9a-f])$/i.exec(a) || /^#([0-9a-f]{2})([0-9a-f]{2})([0-9a-f]{2})$/i.exec(a))) {
                        for (f = [], d = 4 === a.length ? 16 : 1, g = 0; 3 > g; g++) f[g] = e(Math.round(parseInt(c[g + 1], 16) * d * i), 0, 255);
                        return "rgb(" + f.join(",") + ")"
                    }
                    return a
                }
            }), s = {
                changeHighlight: function(b) {
                    var c, d = this.currentRegion,
                        e = this.target,
                        f = this.regionShapes[d];
                    f && (c = this.renderRegion(d, b), a.isArray(c) || a.isArray(f) ? (e.replaceWithShapes(f, c), this.regionShapes[d] = a.map(c, function(a) {
                        return a.id
                    })) : (e.replaceWithShape(f, c), this.regionShapes[d] = c.id))
                },
                render: function() {
                    var b, c, d, e, f = this.values,
                        g = this.target,
                        h = this.regionShapes;
                    if (this.cls._super.render.call(this)) {
                        for (d = f.length; d--;)
                            if (b = this.renderRegion(d))
                                if (a.isArray(b)) {
                                    for (c = [], e = b.length; e--;) b[e].append(), c.push(b[e].id);
                                    h[d] = c
                                } else b.append(), h[d] = b.id;
                        else h[d] = null;
                        g.render()
                    }
                }
            }, a.fn.sparkline.line = t = c(a.fn.sparkline._base, {
                type: "line",
                init: function(a, b, c, d, e) {
                    t._super.init.call(this, a, b, c, d, e), this.vertices = [], this.regionMap = [], this.xvalues = [], this.yvalues = [], this.yminmax = [], this.hightlightSpotId = null, this.lastShapeId = null, this.initTarget()
                },
                getRegion: function(a, b) {
                    var c, d = this.regionMap;
                    for (c = d.length; c--;)
                        if (null !== d[c] && b >= d[c][0] && b <= d[c][1]) return d[c][2];
                    return void 0
                },
                getCurrentRegionFields: function() {
                    var a = this.currentRegion;
                    return {
                        isNull: null === this.yvalues[a],
                        x: this.xvalues[a],
                        y: this.yvalues[a],
                        color: this.options.get("lineColor"),
                        fillColor: this.options.get("fillColor"),
                        offset: a
                    }
                },
                renderHighlight: function() {
                    var a, b, c = this.currentRegion,
                        d = this.target,
                        e = this.vertices[c],
                        f = this.options,
                        g = f.get("spotRadius"),
                        h = f.get("highlightSpotColor"),
                        i = f.get("highlightLineColor");
                    e && (g && h && (a = d.drawCircle(e[0], e[1], g, void 0, h), this.highlightSpotId = a.id, d.insertAfterShape(this.lastShapeId, a)), i && (b = d.drawLine(e[0], this.canvasTop, e[0], this.canvasTop + this.canvasHeight, i), this.highlightLineId = b.id, d.insertAfterShape(this.lastShapeId, b)))
                },
                removeHighlight: function() {
                    var a = this.target;
                    this.highlightSpotId && (a.removeShapeId(this.highlightSpotId), this.highlightSpotId = null), this.highlightLineId && (a.removeShapeId(this.highlightLineId), this.highlightLineId = null)
                },
                scanValues: function() {
                    var a, b, c, d, e, f = this.values,
                        g = f.length,
                        h = this.xvalues,
                        i = this.yvalues,
                        j = this.yminmax;
                    for (a = 0; g > a; a++) b = f[a], c = "string" == typeof f[a], d = "object" == typeof f[a] && f[a] instanceof Array, e = c && f[a].split(":"), c && 2 === e.length ? (h.push(Number(e[0])), i.push(Number(e[1])), j.push(Number(e[1]))) : d ? (h.push(b[0]), i.push(b[1]), j.push(b[1])) : (h.push(a), null === f[a] || "null" === f[a] ? i.push(null) : (i.push(Number(b)), j.push(Number(b))));
                    this.options.get("xvalues") && (h = this.options.get("xvalues")), this.maxy = this.maxyorg = Math.max.apply(Math, j), this.miny = this.minyorg = Math.min.apply(Math, j), this.maxx = Math.max.apply(Math, h), this.minx = Math.min.apply(Math, h), this.xvalues = h, this.yvalues = i, this.yminmax = j
                },
                processRangeOptions: function() {
                    var a = this.options,
                        b = a.get("normalRangeMin"),
                        c = a.get("normalRangeMax");
                    void 0 !== b && (b < this.miny && (this.miny = b), c > this.maxy && (this.maxy = c)), void 0 !== a.get("chartRangeMin") && (a.get("chartRangeClip") || a.get("chartRangeMin") < this.miny) && (this.miny = a.get("chartRangeMin")), void 0 !== a.get("chartRangeMax") && (a.get("chartRangeClip") || a.get("chartRangeMax") > this.maxy) && (this.maxy = a.get("chartRangeMax")), void 0 !== a.get("chartRangeMinX") && (a.get("chartRangeClipX") || a.get("chartRangeMinX") < this.minx) && (this.minx = a.get("chartRangeMinX")), void 0 !== a.get("chartRangeMaxX") && (a.get("chartRangeClipX") || a.get("chartRangeMaxX") > this.maxx) && (this.maxx = a.get("chartRangeMaxX"))
                },
                drawNormalRange: function(a, b, c, d, e) {
                    var f = this.options.get("normalRangeMin"),
                        g = this.options.get("normalRangeMax"),
                        h = b + Math.round(c - c * ((g - this.miny) / e)),
                        i = Math.round(c * (g - f) / e);
                    this.target.drawRect(a, h, d, i, void 0, this.options.get("normalRangeColor")).append()
                },
                render: function() {
                    var b, c, d, e, f, g, h, i, j, k, l, m, n, o, q, r, s, u, v, w, x, y, z, A, B, C = this.options,
                        D = this.target,
                        E = this.canvasWidth,
                        F = this.canvasHeight,
                        G = this.vertices,
                        H = C.get("spotRadius"),
                        I = this.regionMap;
                    if (t._super.render.call(this) && (this.scanValues(), this.processRangeOptions(), z = this.xvalues, A = this.yvalues, this.yminmax.length && !(this.yvalues.length < 2))) {
                        for (e = f = 0, b = this.maxx - this.minx === 0 ? 1 : this.maxx - this.minx, c = this.maxy - this.miny === 0 ? 1 : this.maxy - this.miny, d = this.yvalues.length - 1, H && (4 * H > E || 4 * H > F) && (H = 0), H && (x = C.get("highlightSpotColor") && !C.get("disableInteraction"), (x || C.get("minSpotColor") || C.get("spotColor") && A[d] === this.miny) && (F -= Math.ceil(H)), (x || C.get("maxSpotColor") || C.get("spotColor") && A[d] === this.maxy) && (F -= Math.ceil(H), e += Math.ceil(H)), (x || (C.get("minSpotColor") || C.get("maxSpotColor")) && (A[0] === this.miny || A[0] === this.maxy)) && (f += Math.ceil(H), E -= Math.ceil(H)), (x || C.get("spotColor") || C.get("minSpotColor") || C.get("maxSpotColor") && (A[d] === this.miny || A[d] === this.maxy)) && (E -= Math.ceil(H))), F--, void 0 === C.get("normalRangeMin") || C.get("drawNormalOnTop") || this.drawNormalRange(f, e, F, E, c), h = [], i = [h], o = q = null, r = A.length, B = 0; r > B; B++) j = z[B], l = z[B + 1], k = A[B], m = f + Math.round((j - this.minx) * (E / b)), n = r - 1 > B ? f + Math.round((l - this.minx) * (E / b)) : E, q = m + (n - m) / 2, I[B] = [o || 0, q, B], o = q, null === k ? B && (null !== A[B - 1] && (h = [], i.push(h)), G.push(null)) : (k < this.miny && (k = this.miny), k > this.maxy && (k = this.maxy), h.length || h.push([m, e + F]), g = [m, e + Math.round(F - F * ((k - this.miny) / c))], h.push(g), G.push(g));
                        for (s = [], u = [], v = i.length, B = 0; v > B; B++) h = i[B], h.length && (C.get("fillColor") && (h.push([h[h.length - 1][0], e + F]), u.push(h.slice(0)), h.pop()), h.length > 2 && (h[0] = [h[0][0], h[1][1]]), s.push(h));
                        for (v = u.length, B = 0; v > B; B++) D.drawShape(u[B], C.get("fillColor"), C.get("fillColor")).append();
                        for (void 0 !== C.get("normalRangeMin") && C.get("drawNormalOnTop") && this.drawNormalRange(f, e, F, E, c), v = s.length, B = 0; v > B; B++) D.drawShape(s[B], C.get("lineColor"), void 0, C.get("lineWidth")).append();
                        if (H && C.get("valueSpots"))
                            for (w = C.get("valueSpots"), void 0 === w.get && (w = new p(w)), B = 0; r > B; B++) y = w.get(A[B]), y && D.drawCircle(f + Math.round((z[B] - this.minx) * (E / b)), e + Math.round(F - F * ((A[B] - this.miny) / c)), H, void 0, y).append();
                        H && C.get("spotColor") && null !== A[d] && D.drawCircle(f + Math.round((z[z.length - 1] - this.minx) * (E / b)), e + Math.round(F - F * ((A[d] - this.miny) / c)), H, void 0, C.get("spotColor")).append(), this.maxy !== this.minyorg && (H && C.get("minSpotColor") && (j = z[a.inArray(this.minyorg, A)], D.drawCircle(f + Math.round((j - this.minx) * (E / b)), e + Math.round(F - F * ((this.minyorg - this.miny) / c)), H, void 0, C.get("minSpotColor")).append()), H && C.get("maxSpotColor") && (j = z[a.inArray(this.maxyorg, A)], D.drawCircle(f + Math.round((j - this.minx) * (E / b)), e + Math.round(F - F * ((this.maxyorg - this.miny) / c)), H, void 0, C.get("maxSpotColor")).append())), this.lastShapeId = D.getLastShapeId(), this.canvasTop = e, D.render()
                    }
                }
            }), a.fn.sparkline.bar = u = c(a.fn.sparkline._base, s, {
                type: "bar",
                init: function(b, c, d, f, j) {
                    var k, l, m, n, o, q, r, s, t, v, w, x, y, z, A, B, C, D, E, F, G, H, I = parseInt(d.get("barWidth"), 10),
                        J = parseInt(d.get("barSpacing"), 10),
                        K = d.get("chartRangeMin"),
                        L = d.get("chartRangeMax"),
                        M = d.get("chartRangeClip"),
                        N = 1 / 0,
                        O = -1 / 0;
                    for (u._super.init.call(this, b, c, d, f, j), q = 0, r = c.length; r > q; q++) F = c[q], k = "string" == typeof F && F.indexOf(":") > -1, (k || a.isArray(F)) && (A = !0, k && (F = c[q] = h(F.split(":"))), F = i(F, null), l = Math.min.apply(Math, F), m = Math.max.apply(Math, F), N > l && (N = l), m > O && (O = m));
                    this.stacked = A, this.regionShapes = {}, this.barWidth = I, this.barSpacing = J, this.totalBarWidth = I + J, this.width = f = c.length * I + (c.length - 1) * J, this.initTarget(), M && (y = void 0 === K ? -1 / 0 : K, z = void 0 === L ? 1 / 0 : L), o = [], n = A ? [] : o;
                    var P = [],
                        Q = [];
                    for (q = 0, r = c.length; r > q; q++)
                        if (A)
                            for (B = c[q], c[q] = E = [], P[q] = 0, n[q] = Q[q] = 0, C = 0, D = B.length; D > C; C++) F = E[C] = M ? e(B[C], y, z) : B[C], null !== F && (F > 0 && (P[q] += F), 0 > N && O > 0 ? 0 > F ? Q[q] += Math.abs(F) : n[q] += F : n[q] += Math.abs(F - (0 > F ? O : N)), o.push(F));
                        else F = M ? e(c[q], y, z) : c[q], F = c[q] = g(F), null !== F && o.push(F);
                    this.max = x = Math.max.apply(Math, o), this.min = w = Math.min.apply(Math, o), this.stackMax = O = A ? Math.max.apply(Math, P) : x, this.stackMin = N = A ? Math.min.apply(Math, o) : w, void 0 !== d.get("chartRangeMin") && (d.get("chartRangeClip") || d.get("chartRangeMin") < w) && (w = d.get("chartRangeMin")), void 0 !== d.get("chartRangeMax") && (d.get("chartRangeClip") || d.get("chartRangeMax") > x) && (x = d.get("chartRangeMax")), this.zeroAxis = t = d.get("zeroAxis", !0), v = 0 >= w && x >= 0 && t ? 0 : 0 == t ? w : w > 0 ? w : x, this.xaxisOffset = v, s = A ? Math.max.apply(Math, n) + Math.max.apply(Math, Q) : x - w, this.canvasHeightEf = t && 0 > w ? this.canvasHeight - 2 : this.canvasHeight - 1, v > w ? (H = A && x >= 0 ? O : x, G = (H - v) / s * this.canvasHeight, G !== Math.ceil(G) && (this.canvasHeightEf -= 2, G = Math.ceil(G))) : G = this.canvasHeight, this.yoffset = G, a.isArray(d.get("colorMap")) ? (this.colorMapByIndex = d.get("colorMap"), this.colorMapByValue = null) : (this.colorMapByIndex = null, this.colorMapByValue = d.get("colorMap"), this.colorMapByValue && void 0 === this.colorMapByValue.get && (this.colorMapByValue = new p(this.colorMapByValue))), this.range = s
                },
                getRegion: function(a, b) {
                    var c = Math.floor(b / this.totalBarWidth);
                    return 0 > c || c >= this.values.length ? void 0 : c
                },
                getCurrentRegionFields: function() {
                    var a, b, c = this.currentRegion,
                        d = n(this.values[c]),
                        e = [];
                    for (b = d.length; b--;) a = d[b], e.push({
                        isNull: null === a,
                        value: a,
                        color: this.calcColor(b, a, c),
                        offset: c
                    });
                    return e
                },
                calcColor: function(b, c, d) {
                    var e, f, g = this.colorMapByIndex,
                        h = this.colorMapByValue,
                        i = this.options;
                    return e = i.get(this.stacked ? "stackedBarColor" : 0 > c ? "negBarColor" : "barColor"), 0 === c && void 0 !== i.get("zeroColor") && (e = i.get("zeroColor")), h && (f = h.get(c)) ? e = f : g && g.length > d && (e = g[d]), a.isArray(e) ? e[b % e.length] : e
                },
                renderRegion: function(b, c) {
                    var d, e, f, g, h, i, j, l, m, n, o = this.values[b],
                        p = this.options,
                        q = this.xaxisOffset,
                        r = [],
                        s = this.range,
                        t = this.stacked,
                        u = this.target,
                        v = b * this.totalBarWidth,
                        w = this.canvasHeightEf,
                        x = this.yoffset;
                    if (o = a.isArray(o) ? o : [o], j = o.length, l = o[0], g = k(null, o), n = k(q, o, !0), g) return p.get("nullColor") ? (f = c ? p.get("nullColor") : this.calcHighlightColor(p.get("nullColor"), p), d = x > 0 ? x - 1 : x, u.drawRect(v, d, this.barWidth - 1, 0, f, f)) : void 0;
                    for (h = x, i = 0; j > i; i++) {
                        if (l = o[i], t && l === q) {
                            if (!n || m) continue;
                            m = !0
                        }
                        e = s > 0 ? Math.floor(w * (Math.abs(l - q) / s)) + 1 : 1, q > l || l === q && 0 === x ? (d = h, h += e) : (d = x - e, x -= e), f = this.calcColor(i, l, b), c && (f = this.calcHighlightColor(f, p)), r.push(u.drawRect(v, d, this.barWidth - 1, e - 1, f, f))
                    }
                    return 1 === r.length ? r[0] : r
                }
            }), a.fn.sparkline.tristate = v = c(a.fn.sparkline._base, s, {
                type: "tristate",
                init: function(b, c, d, e, f) {
                    var g = parseInt(d.get("barWidth"), 10),
                        h = parseInt(d.get("barSpacing"), 10);
                    v._super.init.call(this, b, c, d, e, f), this.regionShapes = {}, this.barWidth = g, this.barSpacing = h, this.totalBarWidth = g + h, this.values = a.map(c, Number), this.width = e = c.length * g + (c.length - 1) * h, a.isArray(d.get("colorMap")) ? (this.colorMapByIndex = d.get("colorMap"), this.colorMapByValue = null) : (this.colorMapByIndex = null, this.colorMapByValue = d.get("colorMap"), this.colorMapByValue && void 0 === this.colorMapByValue.get && (this.colorMapByValue = new p(this.colorMapByValue))), this.initTarget()
                },
                getRegion: function(a, b) {
                    return Math.floor(b / this.totalBarWidth)
                },
                getCurrentRegionFields: function() {
                    var a = this.currentRegion;
                    return {
                        isNull: void 0 === this.values[a],
                        value: this.values[a],
                        color: this.calcColor(this.values[a], a),
                        offset: a
                    }
                },
                calcColor: function(a, b) {
                    var c, d, e = this.values,
                        f = this.options,
                        g = this.colorMapByIndex,
                        h = this.colorMapByValue;
                    return c = h && (d = h.get(a)) ? d : g && g.length > b ? g[b] : f.get(e[b] < 0 ? "negBarColor" : e[b] > 0 ? "posBarColor" : "zeroBarColor")
                },
                renderRegion: function(a, b) {
                    var c, d, e, f, g, h, i = this.values,
                        j = this.options,
                        k = this.target;
                    return c = k.pixelHeight, e = Math.round(c / 2), f = a * this.totalBarWidth, i[a] < 0 ? (g = e, d = e - 1) : i[a] > 0 ? (g = 0, d = e - 1) : (g = e - 1, d = 2), h = this.calcColor(i[a], a), null !== h ? (b && (h = this.calcHighlightColor(h, j)), k.drawRect(f, g, this.barWidth - 1, d - 1, h, h)) : void 0
                }
            }), a.fn.sparkline.discrete = w = c(a.fn.sparkline._base, s, {
                type: "discrete",
                init: function(b, c, d, e, f) {
                    w._super.init.call(this, b, c, d, e, f), this.regionShapes = {}, this.values = c = a.map(c, Number), this.min = Math.min.apply(Math, c), this.max = Math.max.apply(Math, c), this.range = this.max - this.min, this.width = e = "auto" === d.get("width") ? 2 * c.length : this.width, this.interval = Math.floor(e / c.length), this.itemWidth = e / c.length, void 0 !== d.get("chartRangeMin") && (d.get("chartRangeClip") || d.get("chartRangeMin") < this.min) && (this.min = d.get("chartRangeMin")), void 0 !== d.get("chartRangeMax") && (d.get("chartRangeClip") || d.get("chartRangeMax") > this.max) && (this.max = d.get("chartRangeMax")), this.initTarget(), this.target && (this.lineHeight = "auto" === d.get("lineHeight") ? Math.round(.3 * this.canvasHeight) : d.get("lineHeight"))
                },
                getRegion: function(a, b) {
                    return Math.floor(b / this.itemWidth)
                },
                getCurrentRegionFields: function() {
                    var a = this.currentRegion;
                    return {
                        isNull: void 0 === this.values[a],
                        value: this.values[a],
                        offset: a
                    }
                },
                renderRegion: function(a, b) {
                    var c, d, f, g, h = this.values,
                        i = this.options,
                        j = this.min,
                        k = this.max,
                        l = this.range,
                        m = this.interval,
                        n = this.target,
                        o = this.canvasHeight,
                        p = this.lineHeight,
                        q = o - p;
                    return d = e(h[a], j, k), g = a * m, c = Math.round(q - q * ((d - j) / l)), f = i.get(i.get("thresholdColor") && d < i.get("thresholdValue") ? "thresholdColor" : "lineColor"), b && (f = this.calcHighlightColor(f, i)), n.drawLine(g, c, g, c + p, f)
                }
            }), a.fn.sparkline.bullet = x = c(a.fn.sparkline._base, {
                type: "bullet",
                init: function(a, b, c, d, e) {
                    var f, g, i;
                    x._super.init.call(this, a, b, c, d, e), this.values = b = h(b), i = b.slice(), i[0] = null === i[0] ? i[2] : i[0], i[1] = null === b[1] ? i[2] : i[1], f = Math.min.apply(Math, b), g = Math.max.apply(Math, b), f = void 0 === c.get("base") ? 0 > f ? f : 0 : c.get("base"), this.min = f, this.max = g, this.range = g - f, this.shapes = {}, this.valueShapes = {}, this.regiondata = {}, this.width = d = "auto" === c.get("width") ? "4.0em" : d, this.target = this.$el.simpledraw(d, e, c.get("composite")), b.length || (this.disabled = !0), this.initTarget()
                },
                getRegion: function(a, b, c) {
                    var d = this.target.getShapeAt(a, b, c);
                    return void 0 !== d && void 0 !== this.shapes[d] ? this.shapes[d] : void 0
                },
                getCurrentRegionFields: function() {
                    var a = this.currentRegion;
                    return {
                        fieldkey: a.substr(0, 1),
                        value: this.values[a.substr(1)],
                        region: a
                    }
                },
                changeHighlight: function(a) {
                    var b, c = this.currentRegion,
                        d = this.valueShapes[c];
                    switch (delete this.shapes[d], c.substr(0, 1)) {
                        case "r":
                            b = this.renderRange(c.substr(1), a);
                            break;
                        case "p":
                            b = this.renderPerformance(a);
                            break;
                        case "t":
                            b = this.renderTarget(a)
                    }
                    this.valueShapes[c] = b.id, this.shapes[b.id] = c, this.target.replaceWithShape(d, b)
                },
                renderRange: function(a, b) {
                    var c = this.values[a],
                        d = Math.round(this.canvasWidth * ((c - this.min) / this.range)),
                        e = this.options.get("rangeColors")[a - 2];
                    return b && (e = this.calcHighlightColor(e, this.options)), this.target.drawRect(0, 0, d - 1, this.canvasHeight - 1, e, e)
                },
                renderPerformance: function(a) {
                    var b = this.values[1],
                        c = Math.round(this.canvasWidth * ((b - this.min) / this.range)),
                        d = this.options.get("performanceColor");
                    return a && (d = this.calcHighlightColor(d, this.options)), this.target.drawRect(0, Math.round(.3 * this.canvasHeight), c - 1, Math.round(.4 * this.canvasHeight) - 1, d, d)
                },
                renderTarget: function(a) {
                    var b = this.values[0],
                        c = Math.round(this.canvasWidth * ((b - this.min) / this.range) - this.options.get("targetWidth") / 2),
                        d = Math.round(.1 * this.canvasHeight),
                        e = this.canvasHeight - 2 * d,
                        f = this.options.get("targetColor");
                    return a && (f = this.calcHighlightColor(f, this.options)), this.target.drawRect(c, d, this.options.get("targetWidth") - 1, e - 1, f, f)
                },
                render: function() {
                    var a, b, c = this.values.length,
                        d = this.target;
                    if (x._super.render.call(this)) {
                        for (a = 2; c > a; a++) b = this.renderRange(a).append(), this.shapes[b.id] = "r" + a, this.valueShapes["r" + a] = b.id;
                        null !== this.values[1] && (b = this.renderPerformance().append(), this.shapes[b.id] = "p1", this.valueShapes.p1 = b.id), null !== this.values[0] && (b = this.renderTarget().append(), this.shapes[b.id] = "t0", this.valueShapes.t0 = b.id), d.render()
                    }
                }
            }), a.fn.sparkline.pie = y = c(a.fn.sparkline._base, {
                type: "pie",
                init: function(b, c, d, e, f) {
                    var g, h = 0;
                    if (y._super.init.call(this, b, c, d, e, f), this.shapes = {}, this.valueShapes = {}, this.values = c = a.map(c, Number), "auto" === d.get("width") && (this.width = this.height), c.length > 0)
                        for (g = c.length; g--;) h += c[g];
                    this.total = h, this.initTarget(), this.radius = Math.floor(Math.min(this.canvasWidth, this.canvasHeight) / 2)
                },
                getRegion: function(a, b, c) {
                    var d = this.target.getShapeAt(a, b, c);
                    return void 0 !== d && void 0 !== this.shapes[d] ? this.shapes[d] : void 0
                },
                getCurrentRegionFields: function() {
                    var a = this.currentRegion;
                    return {
                        isNull: void 0 === this.values[a],
                        value: this.values[a],
                        percent: this.values[a] / this.total * 100,
                        color: this.options.get("sliceColors")[a % this.options.get("sliceColors").length],
                        offset: a
                    }
                },
                changeHighlight: function(a) {
                    var b = this.currentRegion,
                        c = this.renderSlice(b, a),
                        d = this.valueShapes[b];
                    delete this.shapes[d], this.target.replaceWithShape(d, c), this.valueShapes[b] = c.id, this.shapes[c.id] = b
                },
                renderSlice: function(a, b) {
                    var c, d, e, f, g, h = this.target,
                        i = this.options,
                        j = this.radius,
                        k = i.get("borderWidth"),
                        l = i.get("offset"),
                        m = 2 * Math.PI,
                        n = this.values,
                        o = this.total,
                        p = l ? 2 * Math.PI * (l / 360) : 0;
                    for (f = n.length, e = 0; f > e; e++) {
                        if (c = p, d = p, o > 0 && (d = p + m * (n[e] / o)), a === e) return g = i.get("sliceColors")[e % i.get("sliceColors").length], b && (g = this.calcHighlightColor(g, i)), h.drawPieSlice(j, j, j - k, c, d, void 0, g);
                        p = d
                    }
                },
                render: function() {
                    var a, b, c = this.target,
                        d = this.values,
                        e = this.options,
                        f = this.radius,
                        g = e.get("borderWidth");
                    if (y._super.render.call(this)) {
                        for (g && c.drawCircle(f, f, Math.floor(f - g / 2), e.get("borderColor"), void 0, g).append(), b = d.length; b--;) d[b] && (a = this.renderSlice(b).append(), this.valueShapes[b] = a.id, this.shapes[a.id] = b);
                        c.render()
                    }
                }
            }), a.fn.sparkline.box = z = c(a.fn.sparkline._base, {
                type: "box",
                init: function(b, c, d, e, f) {
                    z._super.init.call(this, b, c, d, e, f), this.values = a.map(c, Number), this.width = "auto" === d.get("width") ? "4.0em" : e, this.initTarget(), this.values.length || (this.disabled = 1)
                },
                getRegion: function() {
                    return 1
                },
                getCurrentRegionFields: function() {
                    var a = [{
                        field: "lq",
                        value: this.quartiles[0]
                    }, {
                        field: "med",
                        value: this.quartiles[1]
                    }, {
                        field: "uq",
                        value: this.quartiles[2]
                    }];
                    return void 0 !== this.loutlier && a.push({
                        field: "lo",
                        value: this.loutlier
                    }), void 0 !== this.routlier && a.push({
                        field: "ro",
                        value: this.routlier
                    }), void 0 !== this.lwhisker && a.push({
                        field: "lw",
                        value: this.lwhisker
                    }), void 0 !== this.rwhisker && a.push({
                        field: "rw",
                        value: this.rwhisker
                    }), a
                },
                render: function() {
                    var a, b, c, d, e, g, h, i, j, k, l, m = this.target,
                        n = this.values,
                        o = n.length,
                        p = this.options,
                        q = this.canvasWidth,
                        r = this.canvasHeight,
                        s = void 0 === p.get("chartRangeMin") ? Math.min.apply(Math, n) : p.get("chartRangeMin"),
                        t = void 0 === p.get("chartRangeMax") ? Math.max.apply(Math, n) : p.get("chartRangeMax"),
                        u = 0;
                    if (z._super.render.call(this)) {
                        if (p.get("raw")) p.get("showOutliers") && n.length > 5 ? (b = n[0], a = n[1], d = n[2], e = n[3], g = n[4], h = n[5], i = n[6]) : (a = n[0], d = n[1], e = n[2], g = n[3], h = n[4]);
                        else if (n.sort(function(a, b) {
                                return a - b
                            }), d = f(n, 1), e = f(n, 2), g = f(n, 3), c = g - d, p.get("showOutliers")) {
                            for (a = h = void 0, j = 0; o > j; j++) void 0 === a && n[j] > d - c * p.get("outlierIQR") && (a = n[j]), n[j] < g + c * p.get("outlierIQR") && (h = n[j]);
                            b = n[0], i = n[o - 1]
                        } else a = n[0], h = n[o - 1];
                        this.quartiles = [d, e, g], this.lwhisker = a, this.rwhisker = h, this.loutlier = b, this.routlier = i, l = q / (t - s + 1), p.get("showOutliers") && (u = Math.ceil(p.get("spotRadius")), q -= 2 * Math.ceil(p.get("spotRadius")), l = q / (t - s + 1), a > b && m.drawCircle((b - s) * l + u, r / 2, p.get("spotRadius"), p.get("outlierLineColor"), p.get("outlierFillColor")).append(), i > h && m.drawCircle((i - s) * l + u, r / 2, p.get("spotRadius"), p.get("outlierLineColor"), p.get("outlierFillColor")).append()), m.drawRect(Math.round((d - s) * l + u), Math.round(.1 * r), Math.round((g - d) * l), Math.round(.8 * r), p.get("boxLineColor"), p.get("boxFillColor")).append(), m.drawLine(Math.round((a - s) * l + u), Math.round(r / 2), Math.round((d - s) * l + u), Math.round(r / 2), p.get("lineColor")).append(), m.drawLine(Math.round((a - s) * l + u), Math.round(r / 4), Math.round((a - s) * l + u), Math.round(r - r / 4), p.get("whiskerColor")).append(), m.drawLine(Math.round((h - s) * l + u), Math.round(r / 2), Math.round((g - s) * l + u), Math.round(r / 2), p.get("lineColor")).append(), m.drawLine(Math.round((h - s) * l + u), Math.round(r / 4), Math.round((h - s) * l + u), Math.round(r - r / 4), p.get("whiskerColor")).append(), m.drawLine(Math.round((e - s) * l + u), Math.round(.1 * r), Math.round((e - s) * l + u), Math.round(.9 * r), p.get("medianColor")).append(), p.get("target") && (k = Math.ceil(p.get("spotRadius")), m.drawLine(Math.round((p.get("target") - s) * l + u), Math.round(r / 2 - k), Math.round((p.get("target") - s) * l + u), Math.round(r / 2 + k), p.get("targetColor")).append(), m.drawLine(Math.round((p.get("target") - s) * l + u - k), Math.round(r / 2), Math.round((p.get("target") - s) * l + u + k), Math.round(r / 2), p.get("targetColor")).append()), m.render()
                    }
                }
            }),
            function() {
                document.namespaces && !document.namespaces.v ? (a.fn.sparkline.hasVML = !0, document.namespaces.add("v", "urn:schemas-microsoft-com:vml", "#default#VML")) : a.fn.sparkline.hasVML = !1;
                var b = document.createElement("canvas");
                a.fn.sparkline.hasCanvas = !(!b.getContext || !b.getContext("2d"))
            }(), C = c({
                init: function(a, b, c, d) {
                    this.target = a, this.id = b, this.type = c, this.args = d
                },
                append: function() {
                    return this.target.appendShape(this), this
                }
            }), D = c({
                _pxregex: /(\d+)(px)?\s*$/i,
                init: function(b, c, d) {
                    b && (this.width = b, this.height = c, this.target = d, this.lastShapeId = null, d[0] && (d = d[0]), a.data(d, "_jqs_vcanvas", this))
                },
                drawLine: function(a, b, c, d, e, f) {
                    return this.drawShape([
                        [a, b],
                        [c, d]
                    ], e, f)
                },
                drawShape: function(a, b, c, d) {
                    return this._genShape("Shape", [a, b, c, d])
                },
                drawCircle: function(a, b, c, d, e, f) {
                    return this._genShape("Circle", [a, b, c, d, e, f])
                },
                drawPieSlice: function(a, b, c, d, e, f, g) {
                    return this._genShape("PieSlice", [a, b, c, d, e, f, g])
                },
                drawRect: function(a, b, c, d, e, f) {
                    return this._genShape("Rect", [a, b, c, d, e, f])
                },
                getElement: function() {
                    return this.canvas
                },
                getLastShapeId: function() {
                    return this.lastShapeId
                },
                reset: function() {
                    alert("reset not implemented")
                },
                _insert: function(b, c) {
                    a(c).html(b)
                },
                _calculatePixelDims: function(b, c, d) {
                    var e;
                    e = this._pxregex.exec(c), this.pixelHeight = e ? e[1] : a(d).height(), e = this._pxregex.exec(b), this.pixelWidth = e ? e[1] : a(d).width()
                },
                _genShape: function(a, b) {
                    var c = I++;
                    return b.unshift(c), new C(this, c, a, b)
                },
                appendShape: function() {
                    alert("appendShape not implemented")
                },
                replaceWithShape: function() {
                    alert("replaceWithShape not implemented")
                },
                insertAfterShape: function() {
                    alert("insertAfterShape not implemented")
                },
                removeShapeId: function() {
                    alert("removeShapeId not implemented")
                },
                getShapeAt: function() {
                    alert("getShapeAt not implemented")
                },
                render: function() {
                    alert("render not implemented")
                }
            }), E = c(D, {
                init: function(b, c, d, e) {
                    E._super.init.call(this, b, c, d), this.canvas = document.createElement("canvas"), d[0] && (d = d[0]), a.data(d, "_jqs_vcanvas", this), a(this.canvas).css({
                        display: "inline-block",
                        width: b,
                        height: c,
                        verticalAlign: "top"
                    }), this._insert(this.canvas, d), this._calculatePixelDims(b, c, this.canvas), this.canvas.width = this.pixelWidth, this.canvas.height = this.pixelHeight, this.interact = e, this.shapes = {}, this.shapeseq = [], this.currentTargetShapeId = void 0, a(this.canvas).css({
                        width: this.pixelWidth,
                        height: this.pixelHeight
                    })
                },
                _getContext: function(a, b, c) {
                    var d = this.canvas.getContext("2d");
                    return void 0 !== a && (d.strokeStyle = a), d.lineWidth = void 0 === c ? 1 : c, void 0 !== b && (d.fillStyle = b), d
                },
                reset: function() {
                    var a = this._getContext();
                    a.clearRect(0, 0, this.pixelWidth, this.pixelHeight), this.shapes = {}, this.shapeseq = [], this.currentTargetShapeId = void 0
                },
                _drawShape: function(a, b, c, d, e) {
                    var f, g, h = this._getContext(c, d, e);
                    for (h.beginPath(), h.moveTo(b[0][0] + .5, b[0][1] + .5), f = 1, g = b.length; g > f; f++) h.lineTo(b[f][0] + .5, b[f][1] + .5);
                    void 0 !== c && h.stroke(), void 0 !== d && h.fill(), void 0 !== this.targetX && void 0 !== this.targetY && h.isPointInPath(this.targetX, this.targetY) && (this.currentTargetShapeId = a)
                },
                _drawCircle: function(a, b, c, d, e, f, g) {
                    var h = this._getContext(e, f, g);
                    h.beginPath(), h.arc(b, c, d, 0, 2 * Math.PI, !1), void 0 !== this.targetX && void 0 !== this.targetY && h.isPointInPath(this.targetX, this.targetY) && (this.currentTargetShapeId = a), void 0 !== e && h.stroke(), void 0 !== f && h.fill()
                },
                _drawPieSlice: function(a, b, c, d, e, f, g, h) {
                    var i = this._getContext(g, h);
                    i.beginPath(), i.moveTo(b, c), i.arc(b, c, d, e, f, !1), i.lineTo(b, c), i.closePath(), void 0 !== g && i.stroke(), h && i.fill(), void 0 !== this.targetX && void 0 !== this.targetY && i.isPointInPath(this.targetX, this.targetY) && (this.currentTargetShapeId = a)
                },
                _drawRect: function(a, b, c, d, e, f, g) {
                    return this._drawShape(a, [
                        [b, c],
                        [b + d, c],
                        [b + d, c + e],
                        [b, c + e],
                        [b, c]
                    ], f, g)
                },
                appendShape: function(a) {
                    return this.shapes[a.id] = a, this.shapeseq.push(a.id), this.lastShapeId = a.id, a.id
                },
                replaceWithShape: function(a, b) {
                    var c, d = this.shapeseq;
                    for (this.shapes[b.id] = b, c = d.length; c--;) d[c] == a && (d[c] = b.id);
                    delete this.shapes[a]
                },
                replaceWithShapes: function(a, b) {
                    var c, d, e, f = this.shapeseq,
                        g = {};
                    for (d = a.length; d--;) g[a[d]] = !0;
                    for (d = f.length; d--;) c = f[d], g[c] && (f.splice(d, 1), delete this.shapes[c], e = d);
                    for (d = b.length; d--;) f.splice(e, 0, b[d].id), this.shapes[b[d].id] = b[d]
                },
                insertAfterShape: function(a, b) {
                    var c, d = this.shapeseq;
                    for (c = d.length; c--;)
                        if (d[c] === a) return d.splice(c + 1, 0, b.id), void(this.shapes[b.id] = b)
                },
                removeShapeId: function(a) {
                    var b, c = this.shapeseq;
                    for (b = c.length; b--;)
                        if (c[b] === a) {
                            c.splice(b, 1);
                            break
                        }
                    delete this.shapes[a]
                },
                getShapeAt: function(a, b, c) {
                    return this.targetX = b, this.targetY = c, this.render(), this.currentTargetShapeId
                },
                render: function() {
                    var a, b, c, d = this.shapeseq,
                        e = this.shapes,
                        f = d.length,
                        g = this._getContext();
                    for (g.clearRect(0, 0, this.pixelWidth, this.pixelHeight), c = 0; f > c; c++) a = d[c], b = e[a], this["_draw" + b.type].apply(this, b.args);
                    this.interact || (this.shapes = {}, this.shapeseq = [])
                }
            }), F = c(D, {
                init: function(b, c, d) {
                    var e;
                    F._super.init.call(this, b, c, d), d[0] && (d = d[0]), a.data(d, "_jqs_vcanvas", this), this.canvas = document.createElement("span"), a(this.canvas).css({
                        display: "inline-block",
                        position: "relative",
                        overflow: "hidden",
                        width: b,
                        height: c,
                        margin: "0px",
                        padding: "0px",
                        verticalAlign: "top"
                    }), this._insert(this.canvas, d), this._calculatePixelDims(b, c, this.canvas), this.canvas.width = this.pixelWidth, this.canvas.height = this.pixelHeight, e = '<v:group coordorigin="0 0" coordsize="' + this.pixelWidth + " " + this.pixelHeight + '" style="position:absolute;top:0;left:0;width:' + this.pixelWidth + "px;height=" + this.pixelHeight + 'px;"></v:group>', this.canvas.insertAdjacentHTML("beforeEnd", e), this.group = a(this.canvas).children()[0], this.rendered = !1, this.prerender = ""
                },
                _drawShape: function(a, b, c, d, e) {
                    var f, g, h, i, j, k, l, m = [];
                    for (l = 0, k = b.length; k > l; l++) m[l] = "" + b[l][0] + "," + b[l][1];
                    return f = m.splice(0, 1), e = void 0 === e ? 1 : e, g = void 0 === c ? ' stroked="false" ' : ' strokeWeight="' + e + 'px" strokeColor="' + c + '" ', h = void 0 === d ? ' filled="false"' : ' fillColor="' + d + '" filled="true" ', i = m[0] === m[m.length - 1] ? "x " : "", j = '<v:shape coordorigin="0 0" coordsize="' + this.pixelWidth + " " + this.pixelHeight + '"  id="jqsshape' + a + '" ' + g + h + ' style="position:absolute;left:0px;top:0px;height:' + this.pixelHeight + "px;width:" + this.pixelWidth + 'px;padding:0px;margin:0px;"  path="m ' + f + " l " + m.join(", ") + " " + i + 'e"> </v:shape>'
                },
                _drawCircle: function(a, b, c, d, e, f, g) {
                    var h, i, j;
                    return b -= d, c -= d, h = void 0 === e ? ' stroked="false" ' : ' strokeWeight="' + g + 'px" strokeColor="' + e + '" ', i = void 0 === f ? ' filled="false"' : ' fillColor="' + f + '" filled="true" ', j = '<v:oval  id="jqsshape' + a + '" ' + h + i + ' style="position:absolute;top:' + c + "px; left:" + b + "px; width:" + 2 * d + "px; height:" + 2 * d + 'px"></v:oval>'
                },
                _drawPieSlice: function(a, b, c, d, e, f, g, h) {
                    var i, j, k, l, m, n, o, p;
                    if (e === f) return "";
                    if (f - e === 2 * Math.PI && (e = 0, f = 2 * Math.PI), j = b + Math.round(Math.cos(e) * d), k = c + Math.round(Math.sin(e) * d), l = b + Math.round(Math.cos(f) * d), m = c + Math.round(Math.sin(f) * d), j === l && k === m) {
                        if (f - e < Math.PI) return "";
                        j = l = b + d, k = m = c
                    }
                    return j === l && k === m && f - e < Math.PI ? "" : (i = [b - d, c - d, b + d, c + d, j, k, l, m], n = void 0 === g ? ' stroked="false" ' : ' strokeWeight="1px" strokeColor="' + g + '" ', o = void 0 === h ? ' filled="false"' : ' fillColor="' + h + '" filled="true" ', p = '<v:shape coordorigin="0 0" coordsize="' + this.pixelWidth + " " + this.pixelHeight + '"  id="jqsshape' + a + '" ' + n + o + ' style="position:absolute;left:0px;top:0px;height:' + this.pixelHeight + "px;width:" + this.pixelWidth + 'px;padding:0px;margin:0px;"  path="m ' + b + "," + c + " wa " + i.join(", ") + ' x e"> </v:shape>')
                },
                _drawRect: function(a, b, c, d, e, f, g) {
                    return this._drawShape(a, [
                        [b, c],
                        [b, c + e],
                        [b + d, c + e],
                        [b + d, c],
                        [b, c]
                    ], f, g)
                },
                reset: function() {
                    this.group.innerHTML = ""
                },
                appendShape: function(a) {
                    var b = this["_draw" + a.type].apply(this, a.args);
                    return this.rendered ? this.group.insertAdjacentHTML("beforeEnd", b) : this.prerender += b, this.lastShapeId = a.id, a.id
                },
                replaceWithShape: function(b, c) {
                    var d = a("#jqsshape" + b),
                        e = this["_draw" + c.type].apply(this, c.args);
                    d[0].outerHTML = e
                },
                replaceWithShapes: function(b, c) {
                    var d, e = a("#jqsshape" + b[0]),
                        f = "",
                        g = c.length;
                    for (d = 0; g > d; d++) f += this["_draw" + c[d].type].apply(this, c[d].args);
                    for (e[0].outerHTML = f, d = 1; d < b.length; d++) a("#jqsshape" + b[d]).remove()
                },
                insertAfterShape: function(b, c) {
                    var d = a("#jqsshape" + b),
                        e = this["_draw" + c.type].apply(this, c.args);
                    d[0].insertAdjacentHTML("afterEnd", e)
                },
                removeShapeId: function(b) {
                    var c = a("#jqsshape" + b);
                    this.group.removeChild(c[0])
                },
                getShapeAt: function(a) {
                    var b = a.id.substr(8);
                    return b
                },
                render: function() {
                    this.rendered || (this.group.innerHTML = this.prerender, this.rendered = !0)
                }
            })
    }), function(a) {
        "use strict";
        var b = function(b, c) {
            this.options = c, this.$elementFilestyle = [], this.$element = a(b)
        };
        b.prototype = {
            clear: function() {
                this.$element.val(""), this.$elementFilestyle.find(":text").val("")
            },
            destroy: function() {
                this.$element.removeAttr("style").removeData("filestyle").val(""), this.$elementFilestyle.remove()
            },
            disabled: function(a) {
                if (a === !0) this.options.disabled || (this.$element.attr("disabled", "true"), this.$elementFilestyle.find("label").attr("disabled", "true"), this.options.disabled = !0);
                else {
                    if (a !== !1) return this.options.disabled;
                    this.options.disabled && (this.$element.removeAttr("disabled"), this.$elementFilestyle.find("label").removeAttr("disabled"), this.options.disabled = !1)
                }
            },
            buttonBefore: function(a) {
                if (a === !0) this.options.buttonBefore || (this.options.buttonBefore = !0, this.options.input && (this.$elementFilestyle.remove(), this.constructor(), this.pushNameFiles()));
                else {
                    if (a !== !1) return this.options.buttonBefore;
                    this.options.buttonBefore && (this.options.buttonBefore = !1, this.options.input && (this.$elementFilestyle.remove(), this.constructor(), this.pushNameFiles()))
                }
            },
            icon: function(a) {
                if (a === !0) this.options.icon || (this.options.icon = !0, this.$elementFilestyle.find("label").prepend(this.htmlIcon()));
                else {
                    if (a !== !1) return this.options.icon;
                    this.options.icon && (this.options.icon = !1, this.$elementFilestyle.find(".filestyleicon").remove())
                }
            },
            input: function(a) {
                if (a === !0) this.options.input || (this.options.input = !0, this.options.buttonBefore ? this.$elementFilestyle.append(this.htmlInput()) : this.$elementFilestyle.prepend(this.htmlInput()), this.$elementFilestyle.find(".badge").remove(), this.pushNameFiles(), this.$elementFilestyle.find(".group-span-filestyle").addClass("input-group-btn"));
                else {
                    if (a !== !1) return this.options.input;
                    if (this.options.input) {
                        this.options.input = !1, this.$elementFilestyle.find(":text").remove();
                        var b = this.pushNameFiles();
                        b.length > 0 && this.$elementFilestyle.find("label").append(' <span class="badge">' + b.length + "</span>"), this.$elementFilestyle.find(".group-span-filestyle").removeClass("input-group-btn")
                    }
                }
            },
            size: function(a) {
                if (void 0 === a) return this.options.size;
                var b = this.$elementFilestyle.find("label"),
                    c = this.$elementFilestyle.find("input");
                b.removeClass("btn-lg btn-sm"), c.removeClass("input-lg input-sm"), "nr" != a && (b.addClass("btn-" + a), c.addClass("input-" + a))
            },
            buttonText: function(a) {
                return void 0 === a ? this.options.buttonText : (this.options.buttonText = a, void this.$elementFilestyle.find("label span").html(this.options.buttonText))
            },
            buttonName: function(a) {
                return void 0 === a ? this.options.buttonName : (this.options.buttonName = a, void this.$elementFilestyle.find("label").attr({
                    "class": "btn " + this.options.buttonName
                }))
            },
            iconName: function(a) {
                return void 0 === a ? this.options.iconName : void this.$elementFilestyle.find(".filestyleicon").attr({
                    "class": ".filestyleicon " + this.options.iconName
                })
            },
            htmlIcon: function() {
                return this.options.icon ? '<span class="filestyleicon ' + this.options.iconName + '"></span> ' : ""
            },
            htmlInput: function() {
                return this.options.input ? '<input type="text" class="form-control ' + ("nr" == this.options.size ? "" : "input-" + this.options.size) + '" disabled> ' : ""
            },
            pushNameFiles: function() {
                var a = "",
                    b = [];
                void 0 === this.$element[0].files ? b[0] = {
                    name: this.$element.value
                } : b = this.$element[0].files;
                for (var c = 0; c < b.length; c++) a += b[c].name.split("\\").pop() + ", ";
                return this.$elementFilestyle.find(":text").val("" !== a ? a.replace(/\, $/g, "") : ""), b
            },
            constructor: function() {
                var b = this,
                    c = "",
                    d = b.$element.attr("id"),
                    e = "";
                "" !== d && d || (d = "filestyle-" + a(".bootstrap-filestyle").length, b.$element.attr({
                    id: d
                })), e = '<span class="group-span-filestyle ' + (b.options.input ? "input-group-btn" : "") + '"><label for="' + d + '" class="btn ' + b.options.buttonName + " " + ("nr" == b.options.size ? "" : "btn-" + b.options.size) + '" ' + (b.options.disabled ? 'disabled="true"' : "") + ">" + b.htmlIcon() + b.options.buttonText + "</label></span>", c = b.options.buttonBefore ? e + b.htmlInput() : b.htmlInput() + e, b.$elementFilestyle = a('<div class="bootstrap-filestyle input-group">' + c + "</div>"), b.$elementFilestyle.find(".group-span-filestyle").attr("tabindex", "0").keypress(function(a) {
                    return 13 === a.keyCode || 32 === a.charCode ? (b.$elementFilestyle.find("label").click(), !1) : void 0
                }), b.$element.css({
                    position: "absolute",
                    clip: "rect(0px 0px 0px 0px)"
                }).attr("tabindex", "-1").after(b.$elementFilestyle), b.options.disabled && b.$element.attr("disabled", "true"), b.$element.change(function() {
                    var a = b.pushNameFiles();
                    0 == b.options.input ? 0 == b.$elementFilestyle.find(".badge").length ? b.$elementFilestyle.find("label").append(' <span class="badge">' + a.length + "</span>") : 0 == a.length ? b.$elementFilestyle.find(".badge").remove() : b.$elementFilestyle.find(".badge").html(a.length) : b.$elementFilestyle.find(".badge").remove()
                }), window.navigator.userAgent.search(/firefox/i) > -1 && b.$elementFilestyle.find("label").click(function() {
                    return b.$element.click(), !1
                })
            }
        };
        var c = a.fn.filestyle;
        a.fn.filestyle = function(c, d) {
            var e = "",
                f = this.each(function() {
                    if ("file" === a(this).attr("type")) {
                        var f = a(this),
                            g = f.data("filestyle"),
                            h = a.extend({}, a.fn.filestyle.defaults, c, "object" == typeof c && c);
                        g || (f.data("filestyle", g = new b(this, h)), g.constructor()), "string" == typeof c && (e = g[c](d))
                    }
                });
            return void 0 !== typeof e ? e : f
        }, a.fn.filestyle.defaults = {
            buttonText: "Choose file",
            iconName: "filestyleicon-folder-open",
            buttonName: "btn-default",
            size: "nr",
            input: !0,
            icon: !0,
            buttonBefore: !1,
            disabled: !1
        }, a.fn.filestyle.noConflict = function() {
            return a.fn.filestyle = c, this
        }, a(function() {
            a(".filestyle").each(function() {
                var b = a(this),
                    c = {
                        input: "false" === b.attr("data-input") ? !1 : !0,
                        icon: "false" === b.attr("data-icon") ? !1 : !0,
                        buttonBefore: "true" === b.attr("data-buttonBefore") ? !0 : !1,
                        disabled: "true" === b.attr("data-disabled") ? !0 : !1,
                        size: b.attr("data-size"),
                        buttonText: b.attr("data-buttonText"),
                        buttonName: b.attr("data-buttonName"),
                        iconName: b.attr("data-iconName")
                    };
                b.filestyle(c)
            })
        })
    }(window.jQuery), function(a) {
        "undefined" == typeof a.fn.each2 && a.extend(a.fn, {
            each2: function(b) {
                for (var c = a([0]), d = -1, e = this.length; ++d < e && (c.context = c[0] = this[d]) && b.call(c[0], d, c) !== !1;);
                return this
            }
        })
    }(jQuery), function(a, b) {
        "use strict";

        function c(b) {
            var c = a(document.createTextNode(""));
            b.before(c), c.before(b), c.remove()
        }

        function d(a) {
            function b(a) {
                return O[a] || a
            }
            return a.replace(/[^\u0000-\u007E]/g, b)
        }

        function e(a, b) {
            for (var c = 0, d = b.length; d > c; c += 1)
                if (g(a, b[c])) return c;
            return -1
        }

        function f() {
            var b = a(N);
            b.appendTo(document.body);
            var c = {
                width: b.width() - b[0].clientWidth,
                height: b.height() - b[0].clientHeight
            };
            return b.remove(), c
        }

        function g(a, c) {
            return a === c ? !0 : a === b || c === b ? !1 : null === a || null === c ? !1 : a.constructor === String ? a + "" == c + "" : c.constructor === String ? c + "" == a + "" : !1
        }

        function h(a, b, c) {
            var d, e, f;
            if (null === a || a.length < 1) return [];
            for (d = a.split(b), e = 0, f = d.length; f > e; e += 1) d[e] = c(d[e]);
            return d
        }

        function i(a) {
            return a.outerWidth(!1) - a.width()
        }

        function j(c) {
            var d = "keyup-change-value";
            c.on("keydown", function() {
                a.data(c, d) === b && a.data(c, d, c.val())
            }), c.on("keyup", function() {
                var e = a.data(c, d);
                e !== b && c.val() !== e && (a.removeData(c, d), c.trigger("keyup-change"))
            })
        }

        function k(c) {
            c.on("mousemove", function(c) {
                var d = L;
                (d === b || d.x !== c.pageX || d.y !== c.pageY) && a(c.target).trigger("mousemove-filtered", c)
            })
        }

        function l(a, c, d) {
            d = d || b;
            var e;
            return function() {
                var b = arguments;
                window.clearTimeout(e), e = window.setTimeout(function() {
                    c.apply(d, b)
                }, a)
            }
        }

        function m(a, b) {
            var c = l(a, function(a) {
                b.trigger("scroll-debounced", a)
            });
            b.on("scroll", function(a) {
                e(a.target, b.get()) >= 0 && c(a)
            })
        }

        function n(a) {
            a[0] !== document.activeElement && window.setTimeout(function() {
                var b, c = a[0],
                    d = a.val().length;
                a.focus();
                var e = c.offsetWidth > 0 || c.offsetHeight > 0;
                e && c === document.activeElement && (c.setSelectionRange ? c.setSelectionRange(d, d) : c.createTextRange && (b = c.createTextRange(), b.collapse(!1), b.select()))
            }, 0)
        }

        function o(b) {
            b = a(b)[0];
            var c = 0,
                d = 0;
            if ("selectionStart" in b) c = b.selectionStart, d = b.selectionEnd - c;
            else if ("selection" in document) {
                b.focus();
                var e = document.selection.createRange();
                d = document.selection.createRange().text.length, e.moveStart("character", -b.value.length), c = e.text.length - d
            }
            return {
                offset: c,
                length: d
            }
        }

        function p(a) {
            a.preventDefault(), a.stopPropagation()
        }

        function q(a) {
            a.preventDefault(), a.stopImmediatePropagation()
        }

        function r(b) {
            if (!I) {
                var c = b[0].currentStyle || window.getComputedStyle(b[0], null);
                I = a(document.createElement("div")).css({
                    position: "absolute",
                    left: "-10000px",
                    top: "-10000px",
                    display: "none",
                    fontSize: c.fontSize,
                    fontFamily: c.fontFamily,
                    fontStyle: c.fontStyle,
                    fontWeight: c.fontWeight,
                    letterSpacing: c.letterSpacing,
                    textTransform: c.textTransform,
                    whiteSpace: "nowrap"
                }), I.attr("class", "select2-sizer"), a(document.body).append(I)
            }
            return I.text(b.val()), I.width()
        }

        function s(b, c, d) {
            var e, f, g = [];
            e = a.trim(b.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each2(function() {
                0 === this.indexOf("select2-") && g.push(this)
            })), e = a.trim(c.attr("class")), e && (e = "" + e, a(e.split(/\s+/)).each2(function() {
                0 !== this.indexOf("select2-") && (f = d(this), f && g.push(f))
            })), b.attr("class", g.join(" "))
        }

        function t(a, b, c, e) {
            var f = d(a.toUpperCase()).indexOf(d(b.toUpperCase())),
                g = b.length;
            return 0 > f ? void c.push(e(a)) : (c.push(e(a.substring(0, f))), c.push("<span class='select2-match'>"), c.push(e(a.substring(f, f + g))), c.push("</span>"), void c.push(e(a.substring(f + g, a.length))))
        }

        function u(a) {
            var b = {
                "\\": "&#92;",
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#39;",
                "/": "&#47;"
            };
            return String(a).replace(/[&<>"'\/\\]/g, function(a) {
                return b[a]
            })
        }

        function v(c) {
            var d, e = null,
                f = c.quietMillis || 100,
                g = c.url,
                h = this;
            return function(i) {
                window.clearTimeout(d), d = window.setTimeout(function() {
                    var d = c.data,
                        f = g,
                        j = c.transport || a.fn.select2.ajaxDefaults.transport,
                        k = {
                            type: c.type || "GET",
                            cache: c.cache || !1,
                            jsonpCallback: c.jsonpCallback || b,
                            dataType: c.dataType || "json"
                        },
                        l = a.extend({}, a.fn.select2.ajaxDefaults.params, k);
                    d = d ? d.call(h, i.term, i.page, i.context) : null, f = "function" == typeof f ? f.call(h, i.term, i.page, i.context) : f, e && "function" == typeof e.abort && e.abort(), c.params && (a.isFunction(c.params) ? a.extend(l, c.params.call(h)) : a.extend(l, c.params)), a.extend(l, {
                        url: f,
                        dataType: c.dataType,
                        data: d,
                        success: function(a) {
                            var b = c.results(a, i.page, i);
                            i.callback(b)
                        },
                        error: function(a, b, c) {
                            var d = {
                                hasError: !0,
                                jqXHR: a,
                                textStatus: b,
                                errorThrown: c
                            };
                            i.callback(d)
                        }
                    }), e = j.call(h, l)
                }, f)
            }
        }

        function w(b) {
            var c, d, e = b,
                f = function(a) {
                    return "" + a.text
                };
            a.isArray(e) && (d = e, e = {
                results: d
            }), a.isFunction(e) === !1 && (d = e, e = function() {
                return d
            });
            var g = e();
            return g.text && (f = g.text, a.isFunction(f) || (c = g.text, f = function(a) {
                    return a[c]
                })),
                function(b) {
                    var c, d = b.term,
                        g = {
                            results: []
                        };
                    return "" === d ? void b.callback(e()) : (c = function(e, g) {
                        var h, i;
                        if (e = e[0], e.children) {
                            h = {};
                            for (i in e) e.hasOwnProperty(i) && (h[i] = e[i]);
                            h.children = [], a(e.children).each2(function(a, b) {
                                c(b, h.children)
                            }), (h.children.length || b.matcher(d, f(h), e)) && g.push(h)
                        } else b.matcher(d, f(e), e) && g.push(e)
                    }, a(e().results).each2(function(a, b) {
                        c(b, g.results)
                    }), void b.callback(g))
                }
        }

        function x(c) {
            var d = a.isFunction(c);
            return function(e) {
                var f = e.term,
                    g = {
                        results: []
                    },
                    h = d ? c(e) : c;
                a.isArray(h) && (a(h).each(function() {
                    var a = this.text !== b,
                        c = a ? this.text : this;
                    ("" === f || e.matcher(f, c)) && g.results.push(a ? this : {
                        id: this,
                        text: this
                    })
                }), e.callback(g))
            }
        }

        function y(b, c) {
            if (a.isFunction(b)) return !0;
            if (!b) return !1;
            if ("string" == typeof b) return !0;
            throw new Error(c + " must be a string, function, or falsy value")
        }

        function z(b, c) {
            if (a.isFunction(b)) {
                var d = Array.prototype.slice.call(arguments, 2);
                return b.apply(c, d)
            }
            return b
        }

        function A(b) {
            var c = 0;
            return a.each(b, function(a, b) {
                b.children ? c += A(b.children) : c++
            }), c
        }

        function B(a, c, d, e) {
            var f, h, i, j, k, l = a,
                m = !1;
            if (!e.createSearchChoice || !e.tokenSeparators || e.tokenSeparators.length < 1) return b;
            for (;;) {
                for (h = -1, i = 0, j = e.tokenSeparators.length; j > i && (k = e.tokenSeparators[i], h = a.indexOf(k), !(h >= 0)); i++);
                if (0 > h) break;
                if (f = a.substring(0, h), a = a.substring(h + k.length), f.length > 0 && (f = e.createSearchChoice.call(this, f, c), f !== b && null !== f && e.id(f) !== b && null !== e.id(f))) {
                    for (m = !1, i = 0, j = c.length; j > i; i++)
                        if (g(e.id(f), e.id(c[i]))) {
                            m = !0;
                            break
                        }
                    m || d(f)
                }
            }
            return l !== a ? a : void 0
        }

        function C() {
            var b = this;
            a.each(arguments, function(a, c) {
                b[c].remove(), b[c] = null
            })
        }

        function D(b, c) {
            var d = function() {};
            return d.prototype = new b, d.prototype.constructor = d, d.prototype.parent = b.prototype, d.prototype = a.extend(d.prototype, c), d
        }
        if (window.Select2 === b) {
            var E, F, G, H, I, J, K, L = {
                    x: 0,
                    y: 0
                },
                M = {
                    TAB: 9,
                    ENTER: 13,
                    ESC: 27,
                    SPACE: 32,
                    LEFT: 37,
                    UP: 38,
                    RIGHT: 39,
                    DOWN: 40,
                    SHIFT: 16,
                    CTRL: 17,
                    ALT: 18,
                    PAGE_UP: 33,
                    PAGE_DOWN: 34,
                    HOME: 36,
                    END: 35,
                    BACKSPACE: 8,
                    DELETE: 46,
                    isArrow: function(a) {
                        switch (a = a.which ? a.which : a) {
                            case M.LEFT:
                            case M.RIGHT:
                            case M.UP:
                            case M.DOWN:
                                return !0
                        }
                        return !1
                    },
                    isControl: function(a) {
                        var b = a.which;
                        switch (b) {
                            case M.SHIFT:
                            case M.CTRL:
                            case M.ALT:
                                return !0
                        }
                        return a.metaKey ? !0 : !1
                    },
                    isFunctionKey: function(a) {
                        return a = a.which ? a.which : a, a >= 112 && 123 >= a
                    }
                },
                N = "<div class='select2-measure-scrollbar'></div>",
                O = {
                    "Ⓐ": "A",
                    "Ａ": "A",
                    "À": "A",
                    "Á": "A",
                    "Â": "A",
                    "Ầ": "A",
                    "Ấ": "A",
                    "Ẫ": "A",
                    "Ẩ": "A",
                    "Ã": "A",
                    "Ā": "A",
                    "Ă": "A",
                    "Ằ": "A",
                    "Ắ": "A",
                    "Ẵ": "A",
                    "Ẳ": "A",
                    "Ȧ": "A",
                    "Ǡ": "A",
                    "Ä": "A",
                    "Ǟ": "A",
                    "Ả": "A",
                    "Å": "A",
                    "Ǻ": "A",
                    "Ǎ": "A",
                    "Ȁ": "A",
                    "Ȃ": "A",
                    "Ạ": "A",
                    "Ậ": "A",
                    "Ặ": "A",
                    "Ḁ": "A",
                    "Ą": "A",
                    "Ⱥ": "A",
                    "Ɐ": "A",
                    "Ꜳ": "AA",
                    "Æ": "AE",
                    "Ǽ": "AE",
                    "Ǣ": "AE",
                    "Ꜵ": "AO",
                    "Ꜷ": "AU",
                    "Ꜹ": "AV",
                    "Ꜻ": "AV",
                    "Ꜽ": "AY",
                    "Ⓑ": "B",
                    "Ｂ": "B",
                    "Ḃ": "B",
                    "Ḅ": "B",
                    "Ḇ": "B",
                    "Ƀ": "B",
                    "Ƃ": "B",
                    "Ɓ": "B",
                    "Ⓒ": "C",
                    "Ｃ": "C",
                    "Ć": "C",
                    "Ĉ": "C",
                    "Ċ": "C",
                    "Č": "C",
                    "Ç": "C",
                    "Ḉ": "C",
                    "Ƈ": "C",
                    "Ȼ": "C",
                    "Ꜿ": "C",
                    "Ⓓ": "D",
                    "Ｄ": "D",
                    "Ḋ": "D",
                    "Ď": "D",
                    "Ḍ": "D",
                    "Ḑ": "D",
                    "Ḓ": "D",
                    "Ḏ": "D",
                    "Đ": "D",
                    "Ƌ": "D",
                    "Ɗ": "D",
                    "Ɖ": "D",
                    "Ꝺ": "D",
                    "Ǳ": "DZ",
                    "Ǆ": "DZ",
                    "ǲ": "Dz",
                    "ǅ": "Dz",
                    "Ⓔ": "E",
                    "Ｅ": "E",
                    "È": "E",
                    "É": "E",
                    "Ê": "E",
                    "Ề": "E",
                    "Ế": "E",
                    "Ễ": "E",
                    "Ể": "E",
                    "Ẽ": "E",
                    "Ē": "E",
                    "Ḕ": "E",
                    "Ḗ": "E",
                    "Ĕ": "E",
                    "Ė": "E",
                    "Ë": "E",
                    "Ẻ": "E",
                    "Ě": "E",
                    "Ȅ": "E",
                    "Ȇ": "E",
                    "Ẹ": "E",
                    "Ệ": "E",
                    "Ȩ": "E",
                    "Ḝ": "E",
                    "Ę": "E",
                    "Ḙ": "E",
                    "Ḛ": "E",
                    "Ɛ": "E",
                    "Ǝ": "E",
                    "Ⓕ": "F",
                    "Ｆ": "F",
                    "Ḟ": "F",
                    "Ƒ": "F",
                    "Ꝼ": "F",
                    "Ⓖ": "G",
                    "Ｇ": "G",
                    "Ǵ": "G",
                    "Ĝ": "G",
                    "Ḡ": "G",
                    "Ğ": "G",
                    "Ġ": "G",
                    "Ǧ": "G",
                    "Ģ": "G",
                    "Ǥ": "G",
                    "Ɠ": "G",
                    "Ꞡ": "G",
                    "Ᵹ": "G",
                    "Ꝿ": "G",
                    "Ⓗ": "H",
                    "Ｈ": "H",
                    "Ĥ": "H",
                    "Ḣ": "H",
                    "Ḧ": "H",
                    "Ȟ": "H",
                    "Ḥ": "H",
                    "Ḩ": "H",
                    "Ḫ": "H",
                    "Ħ": "H",
                    "Ⱨ": "H",
                    "Ⱶ": "H",
                    "Ɥ": "H",
                    "Ⓘ": "I",
                    "Ｉ": "I",
                    "Ì": "I",
                    "Í": "I",
                    "Î": "I",
                    "Ĩ": "I",
                    "Ī": "I",
                    "Ĭ": "I",
                    "İ": "I",
                    "Ï": "I",
                    "Ḯ": "I",
                    "Ỉ": "I",
                    "Ǐ": "I",
                    "Ȉ": "I",
                    "Ȋ": "I",
                    "Ị": "I",
                    "Į": "I",
                    "Ḭ": "I",
                    "Ɨ": "I",
                    "Ⓙ": "J",
                    "Ｊ": "J",
                    "Ĵ": "J",
                    "Ɉ": "J",
                    "Ⓚ": "K",
                    "Ｋ": "K",
                    "Ḱ": "K",
                    "Ǩ": "K",
                    "Ḳ": "K",
                    "Ķ": "K",
                    "Ḵ": "K",
                    "Ƙ": "K",
                    "Ⱪ": "K",
                    "Ꝁ": "K",
                    "Ꝃ": "K",
                    "Ꝅ": "K",
                    "Ꞣ": "K",
                    "Ⓛ": "L",
                    "Ｌ": "L",
                    "Ŀ": "L",
                    "Ĺ": "L",
                    "Ľ": "L",
                    "Ḷ": "L",
                    "Ḹ": "L",
                    "Ļ": "L",
                    "Ḽ": "L",
                    "Ḻ": "L",
                    "Ł": "L",
                    "Ƚ": "L",
                    "Ɫ": "L",
                    "Ⱡ": "L",
                    "Ꝉ": "L",
                    "Ꝇ": "L",
                    "Ꞁ": "L",
                    "Ǉ": "LJ",
                    "ǈ": "Lj",
                    "Ⓜ": "M",
                    "Ｍ": "M",
                    "Ḿ": "M",
                    "Ṁ": "M",
                    "Ṃ": "M",
                    "Ɱ": "M",
                    "Ɯ": "M",
                    "Ⓝ": "N",
                    "Ｎ": "N",
                    "Ǹ": "N",
                    "Ń": "N",
                    "Ñ": "N",
                    "Ṅ": "N",
                    "Ň": "N",
                    "Ṇ": "N",
                    "Ņ": "N",
                    "Ṋ": "N",
                    "Ṉ": "N",
                    "Ƞ": "N",
                    "Ɲ": "N",
                    "Ꞑ": "N",
                    "Ꞥ": "N",
                    "Ǌ": "NJ",
                    "ǋ": "Nj",
                    "Ⓞ": "O",
                    "Ｏ": "O",
                    "Ò": "O",
                    "Ó": "O",
                    "Ô": "O",
                    "Ồ": "O",
                    "Ố": "O",
                    "Ỗ": "O",
                    "Ổ": "O",
                    "Õ": "O",
                    "Ṍ": "O",
                    "Ȭ": "O",
                    "Ṏ": "O",
                    "Ō": "O",
                    "Ṑ": "O",
                    "Ṓ": "O",
                    "Ŏ": "O",
                    "Ȯ": "O",
                    "Ȱ": "O",
                    "Ö": "O",
                    "Ȫ": "O",
                    "Ỏ": "O",
                    "Ő": "O",
                    "Ǒ": "O",
                    "Ȍ": "O",
                    "Ȏ": "O",
                    "Ơ": "O",
                    "Ờ": "O",
                    "Ớ": "O",
                    "Ỡ": "O",
                    "Ở": "O",
                    "Ợ": "O",
                    "Ọ": "O",
                    "Ộ": "O",
                    "Ǫ": "O",
                    "Ǭ": "O",
                    "Ø": "O",
                    "Ǿ": "O",
                    "Ɔ": "O",
                    "Ɵ": "O",
                    "Ꝋ": "O",
                    "Ꝍ": "O",
                    "Ƣ": "OI",
                    "Ꝏ": "OO",
                    "Ȣ": "OU",
                    "Ⓟ": "P",
                    "Ｐ": "P",
                    "Ṕ": "P",
                    "Ṗ": "P",
                    "Ƥ": "P",
                    "Ᵽ": "P",
                    "Ꝑ": "P",
                    "Ꝓ": "P",
                    "Ꝕ": "P",
                    "Ⓠ": "Q",
                    "Ｑ": "Q",
                    "Ꝗ": "Q",
                    "Ꝙ": "Q",
                    "Ɋ": "Q",
                    "Ⓡ": "R",
                    "Ｒ": "R",
                    "Ŕ": "R",
                    "Ṙ": "R",
                    "Ř": "R",
                    "Ȑ": "R",
                    "Ȓ": "R",
                    "Ṛ": "R",
                    "Ṝ": "R",
                    "Ŗ": "R",
                    "Ṟ": "R",
                    "Ɍ": "R",
                    "Ɽ": "R",
                    "Ꝛ": "R",
                    "Ꞧ": "R",
                    "Ꞃ": "R",
                    "Ⓢ": "S",
                    "Ｓ": "S",
                    "ẞ": "S",
                    "Ś": "S",
                    "Ṥ": "S",
                    "Ŝ": "S",
                    "Ṡ": "S",
                    "Š": "S",
                    "Ṧ": "S",
                    "Ṣ": "S",
                    "Ṩ": "S",
                    "Ș": "S",
                    "Ş": "S",
                    "Ȿ": "S",
                    "Ꞩ": "S",
                    "Ꞅ": "S",
                    "Ⓣ": "T",
                    "Ｔ": "T",
                    "Ṫ": "T",
                    "Ť": "T",
                    "Ṭ": "T",
                    "Ț": "T",
                    "Ţ": "T",
                    "Ṱ": "T",
                    "Ṯ": "T",
                    "Ŧ": "T",
                    "Ƭ": "T",
                    "Ʈ": "T",
                    "Ⱦ": "T",
                    "Ꞇ": "T",
                    "Ꜩ": "TZ",
                    "Ⓤ": "U",
                    "Ｕ": "U",
                    "Ù": "U",
                    "Ú": "U",
                    "Û": "U",
                    "Ũ": "U",
                    "Ṹ": "U",
                    "Ū": "U",
                    "Ṻ": "U",
                    "Ŭ": "U",
                    "Ü": "U",
                    "Ǜ": "U",
                    "Ǘ": "U",
                    "Ǖ": "U",
                    "Ǚ": "U",
                    "Ủ": "U",
                    "Ů": "U",
                    "Ű": "U",
                    "Ǔ": "U",
                    "Ȕ": "U",
                    "Ȗ": "U",
                    "Ư": "U",
                    "Ừ": "U",
                    "Ứ": "U",
                    "Ữ": "U",
                    "Ử": "U",
                    "Ự": "U",
                    "Ụ": "U",
                    "Ṳ": "U",
                    "Ų": "U",
                    "Ṷ": "U",
                    "Ṵ": "U",
                    "Ʉ": "U",
                    "Ⓥ": "V",
                    "Ｖ": "V",
                    "Ṽ": "V",
                    "Ṿ": "V",
                    "Ʋ": "V",
                    "Ꝟ": "V",
                    "Ʌ": "V",
                    "Ꝡ": "VY",
                    "Ⓦ": "W",
                    "Ｗ": "W",
                    "Ẁ": "W",
                    "Ẃ": "W",
                    "Ŵ": "W",
                    "Ẇ": "W",
                    "Ẅ": "W",
                    "Ẉ": "W",
                    "Ⱳ": "W",
                    "Ⓧ": "X",
                    "Ｘ": "X",
                    "Ẋ": "X",
                    "Ẍ": "X",
                    "Ⓨ": "Y",
                    "Ｙ": "Y",
                    "Ỳ": "Y",
                    "Ý": "Y",
                    "Ŷ": "Y",
                    "Ỹ": "Y",
                    "Ȳ": "Y",
                    "Ẏ": "Y",
                    "Ÿ": "Y",
                    "Ỷ": "Y",
                    "Ỵ": "Y",
                    "Ƴ": "Y",
                    "Ɏ": "Y",
                    "Ỿ": "Y",
                    "Ⓩ": "Z",
                    "Ｚ": "Z",
                    "Ź": "Z",
                    "Ẑ": "Z",
                    "Ż": "Z",
                    "Ž": "Z",
                    "Ẓ": "Z",
                    "Ẕ": "Z",
                    "Ƶ": "Z",
                    "Ȥ": "Z",
                    "Ɀ": "Z",
                    "Ⱬ": "Z",
                    "Ꝣ": "Z",
                    "ⓐ": "a",
                    "ａ": "a",
                    "ẚ": "a",
                    "à": "a",
                    "á": "a",
                    "â": "a",
                    "ầ": "a",
                    "ấ": "a",
                    "ẫ": "a",
                    "ẩ": "a",
                    "ã": "a",
                    "ā": "a",
                    "ă": "a",
                    "ằ": "a",
                    "ắ": "a",
                    "ẵ": "a",
                    "ẳ": "a",
                    "ȧ": "a",
                    "ǡ": "a",
                    "ä": "a",
                    "ǟ": "a",
                    "ả": "a",
                    "å": "a",
                    "ǻ": "a",
                    "ǎ": "a",
                    "ȁ": "a",
                    "ȃ": "a",
                    "ạ": "a",
                    "ậ": "a",
                    "ặ": "a",
                    "ḁ": "a",
                    "ą": "a",
                    "ⱥ": "a",
                    "ɐ": "a",
                    "ꜳ": "aa",
                    "æ": "ae",
                    "ǽ": "ae",
                    "ǣ": "ae",
                    "ꜵ": "ao",
                    "ꜷ": "au",
                    "ꜹ": "av",
                    "ꜻ": "av",
                    "ꜽ": "ay",
                    "ⓑ": "b",
                    "ｂ": "b",
                    "ḃ": "b",
                    "ḅ": "b",
                    "ḇ": "b",
                    "ƀ": "b",
                    "ƃ": "b",
                    "ɓ": "b",
                    "ⓒ": "c",
                    "ｃ": "c",
                    "ć": "c",
                    "ĉ": "c",
                    "ċ": "c",
                    "č": "c",
                    "ç": "c",
                    "ḉ": "c",
                    "ƈ": "c",
                    "ȼ": "c",
                    "ꜿ": "c",
                    "ↄ": "c",
                    "ⓓ": "d",
                    "ｄ": "d",
                    "ḋ": "d",
                    "ď": "d",
                    "ḍ": "d",
                    "ḑ": "d",
                    "ḓ": "d",
                    "ḏ": "d",
                    "đ": "d",
                    "ƌ": "d",
                    "ɖ": "d",
                    "ɗ": "d",
                    "ꝺ": "d",
                    "ǳ": "dz",
                    "ǆ": "dz",
                    "ⓔ": "e",
                    "ｅ": "e",
                    "è": "e",
                    "é": "e",
                    "ê": "e",
                    "ề": "e",
                    "ế": "e",
                    "ễ": "e",
                    "ể": "e",
                    "ẽ": "e",
                    "ē": "e",
                    "ḕ": "e",
                    "ḗ": "e",
                    "ĕ": "e",
                    "ė": "e",
                    "ë": "e",
                    "ẻ": "e",
                    "ě": "e",
                    "ȅ": "e",
                    "ȇ": "e",
                    "ẹ": "e",
                    "ệ": "e",
                    "ȩ": "e",
                    "ḝ": "e",
                    "ę": "e",
                    "ḙ": "e",
                    "ḛ": "e",
                    "ɇ": "e",
                    "ɛ": "e",
                    "ǝ": "e",
                    "ⓕ": "f",
                    "ｆ": "f",
                    "ḟ": "f",
                    "ƒ": "f",
                    "ꝼ": "f",
                    "ⓖ": "g",
                    "ｇ": "g",
                    "ǵ": "g",
                    "ĝ": "g",
                    "ḡ": "g",
                    "ğ": "g",
                    "ġ": "g",
                    "ǧ": "g",
                    "ģ": "g",
                    "ǥ": "g",
                    "ɠ": "g",
                    "ꞡ": "g",
                    "ᵹ": "g",
                    "ꝿ": "g",
                    "ⓗ": "h",
                    "ｈ": "h",
                    "ĥ": "h",
                    "ḣ": "h",
                    "ḧ": "h",
                    "ȟ": "h",
                    "ḥ": "h",
                    "ḩ": "h",
                    "ḫ": "h",
                    "ẖ": "h",
                    "ħ": "h",
                    "ⱨ": "h",
                    "ⱶ": "h",
                    "ɥ": "h",
                    "ƕ": "hv",
                    "ⓘ": "i",
                    "ｉ": "i",
                    "ì": "i",
                    "í": "i",
                    "î": "i",
                    "ĩ": "i",
                    "ī": "i",
                    "ĭ": "i",
                    "ï": "i",
                    "ḯ": "i",
                    "ỉ": "i",
                    "ǐ": "i",
                    "ȉ": "i",
                    "ȋ": "i",
                    "ị": "i",
                    "į": "i",
                    "ḭ": "i",
                    "ɨ": "i",
                    "ı": "i",
                    "ⓙ": "j",
                    "ｊ": "j",
                    "ĵ": "j",
                    "ǰ": "j",
                    "ɉ": "j",
                    "ⓚ": "k",
                    "ｋ": "k",
                    "ḱ": "k",
                    "ǩ": "k",
                    "ḳ": "k",
                    "ķ": "k",
                    "ḵ": "k",
                    "ƙ": "k",
                    "ⱪ": "k",
                    "ꝁ": "k",
                    "ꝃ": "k",
                    "ꝅ": "k",
                    "ꞣ": "k",
                    "ⓛ": "l",
                    "ｌ": "l",
                    "ŀ": "l",
                    "ĺ": "l",
                    "ľ": "l",
                    "ḷ": "l",
                    "ḹ": "l",
                    "ļ": "l",
                    "ḽ": "l",
                    "ḻ": "l",
                    "ſ": "l",
                    "ł": "l",
                    "ƚ": "l",
                    "ɫ": "l",
                    "ⱡ": "l",
                    "ꝉ": "l",
                    "ꞁ": "l",
                    "ꝇ": "l",
                    "ǉ": "lj",
                    "ⓜ": "m",
                    "ｍ": "m",
                    "ḿ": "m",
                    "ṁ": "m",
                    "ṃ": "m",
                    "ɱ": "m",
                    "ɯ": "m",
                    "ⓝ": "n",
                    "ｎ": "n",
                    "ǹ": "n",
                    "ń": "n",
                    "ñ": "n",
                    "ṅ": "n",
                    "ň": "n",
                    "ṇ": "n",
                    "ņ": "n",
                    "ṋ": "n",
                    "ṉ": "n",
                    "ƞ": "n",
                    "ɲ": "n",
                    "ŉ": "n",
                    "ꞑ": "n",
                    "ꞥ": "n",
                    "ǌ": "nj",
                    "ⓞ": "o",
                    "ｏ": "o",
                    "ò": "o",
                    "ó": "o",
                    "ô": "o",
                    "ồ": "o",
                    "ố": "o",
                    "ỗ": "o",
                    "ổ": "o",
                    "õ": "o",
                    "ṍ": "o",
                    "ȭ": "o",
                    "ṏ": "o",
                    "ō": "o",
                    "ṑ": "o",
                    "ṓ": "o",
                    "ŏ": "o",
                    "ȯ": "o",
                    "ȱ": "o",
                    "ö": "o",
                    "ȫ": "o",
                    "ỏ": "o",
                    "ő": "o",
                    "ǒ": "o",
                    "ȍ": "o",
                    "ȏ": "o",
                    "ơ": "o",
                    "ờ": "o",
                    "ớ": "o",
                    "ỡ": "o",
                    "ở": "o",
                    "ợ": "o",
                    "ọ": "o",
                    "ộ": "o",
                    "ǫ": "o",
                    "ǭ": "o",
                    "ø": "o",
                    "ǿ": "o",
                    "ɔ": "o",
                    "ꝋ": "o",
                    "ꝍ": "o",
                    "ɵ": "o",
                    "ƣ": "oi",
                    "ȣ": "ou",
                    "ꝏ": "oo",
                    "ⓟ": "p",
                    "ｐ": "p",
                    "ṕ": "p",
                    "ṗ": "p",
                    "ƥ": "p",
                    "ᵽ": "p",
                    "ꝑ": "p",
                    "ꝓ": "p",
                    "ꝕ": "p",
                    "ⓠ": "q",
                    "ｑ": "q",
                    "ɋ": "q",
                    "ꝗ": "q",
                    "ꝙ": "q",
                    "ⓡ": "r",
                    "ｒ": "r",
                    "ŕ": "r",
                    "ṙ": "r",
                    "ř": "r",
                    "ȑ": "r",
                    "ȓ": "r",
                    "ṛ": "r",
                    "ṝ": "r",
                    "ŗ": "r",
                    "ṟ": "r",
                    "ɍ": "r",
                    "ɽ": "r",
                    "ꝛ": "r",
                    "ꞧ": "r",
                    "ꞃ": "r",
                    "ⓢ": "s",
                    "ｓ": "s",
                    "ß": "s",
                    "ś": "s",
                    "ṥ": "s",
                    "ŝ": "s",
                    "ṡ": "s",
                    "š": "s",
                    "ṧ": "s",
                    "ṣ": "s",
                    "ṩ": "s",
                    "ș": "s",
                    "ş": "s",
                    "ȿ": "s",
                    "ꞩ": "s",
                    "ꞅ": "s",
                    "ẛ": "s",
                    "ⓣ": "t",
                    "ｔ": "t",
                    "ṫ": "t",
                    "ẗ": "t",
                    "ť": "t",
                    "ṭ": "t",
                    "ț": "t",
                    "ţ": "t",
                    "ṱ": "t",
                    "ṯ": "t",
                    "ŧ": "t",
                    "ƭ": "t",
                    "ʈ": "t",
                    "ⱦ": "t",
                    "ꞇ": "t",
                    "ꜩ": "tz",
                    "ⓤ": "u",
                    "ｕ": "u",
                    "ù": "u",
                    "ú": "u",
                    "û": "u",
                    "ũ": "u",
                    "ṹ": "u",
                    "ū": "u",
                    "ṻ": "u",
                    "ŭ": "u",
                    "ü": "u",
                    "ǜ": "u",
                    "ǘ": "u",
                    "ǖ": "u",
                    "ǚ": "u",
                    "ủ": "u",
                    "ů": "u",
                    "ű": "u",
                    "ǔ": "u",
                    "ȕ": "u",
                    "ȗ": "u",
                    "ư": "u",
                    "ừ": "u",
                    "ứ": "u",
                    "ữ": "u",
                    "ử": "u",
                    "ự": "u",
                    "ụ": "u",
                    "ṳ": "u",
                    "ų": "u",
                    "ṷ": "u",
                    "ṵ": "u",
                    "ʉ": "u",
                    "ⓥ": "v",
                    "ｖ": "v",
                    "ṽ": "v",
                    "ṿ": "v",
                    "ʋ": "v",
                    "ꝟ": "v",
                    "ʌ": "v",
                    "ꝡ": "vy",
                    "ⓦ": "w",
                    "ｗ": "w",
                    "ẁ": "w",
                    "ẃ": "w",
                    "ŵ": "w",
                    "ẇ": "w",
                    "ẅ": "w",
                    "ẘ": "w",
                    "ẉ": "w",
                    "ⱳ": "w",
                    "ⓧ": "x",
                    "ｘ": "x",
                    "ẋ": "x",
                    "ẍ": "x",
                    "ⓨ": "y",
                    "ｙ": "y",
                    "ỳ": "y",
                    "ý": "y",
                    "ŷ": "y",
                    "ỹ": "y",
                    "ȳ": "y",
                    "ẏ": "y",
                    "ÿ": "y",
                    "ỷ": "y",
                    "ẙ": "y",
                    "ỵ": "y",
                    "ƴ": "y",
                    "ɏ": "y",
                    "ỿ": "y",
                    "ⓩ": "z",
                    "ｚ": "z",
                    "ź": "z",
                    "ẑ": "z",
                    "ż": "z",
                    "ž": "z",
                    "ẓ": "z",
                    "ẕ": "z",
                    "ƶ": "z",
                    "ȥ": "z",
                    "ɀ": "z",
                    "ⱬ": "z",
                    "ꝣ": "z",
                    "Ά": "Α",
                    "Έ": "Ε",
                    "Ή": "Η",
                    "Ί": "Ι",
                    "Ϊ": "Ι",
                    "Ό": "Ο",
                    "Ύ": "Υ",
                    "Ϋ": "Υ",
                    "Ώ": "Ω",
                    "ά": "α",
                    "έ": "ε",
                    "ή": "η",
                    "ί": "ι",
                    "ϊ": "ι",
                    "ΐ": "ι",
                    "ό": "ο",
                    "ύ": "υ",
                    "ϋ": "υ",
                    "ΰ": "υ",
                    "ω": "ω",
                    "ς": "σ"
                };
            J = a(document), H = function() {
                var a = 1;
                return function() {
                    return a++
                }
            }(), E = D(Object, {
                bind: function(a) {
                    var b = this;
                    return function() {
                        a.apply(b, arguments)
                    }
                },
                init: function(c) {
                    var d, e, g = ".select2-results";
                    this.opts = c = this.prepareOpts(c), this.id = c.id, c.element.data("select2") !== b && null !== c.element.data("select2") && c.element.data("select2").destroy(), this.container = this.createContainer(), this.liveRegion = a(".select2-hidden-accessible"), 0 == this.liveRegion.length && (this.liveRegion = a("<span>", {
                        role: "status",
                        "aria-live": "polite"
                    }).addClass("select2-hidden-accessible").appendTo(document.body)), this.containerId = "s2id_" + (c.element.attr("id") || "autogen" + H()), this.containerEventName = this.containerId.replace(/([.])/g, "_").replace(/([;&,\-\.\+\*\~':"\!\^#$%@\[\]\(\)=>\|])/g, "\\$1"), this.container.attr("id", this.containerId), this.container.attr("title", c.element.attr("title")), this.body = a(document.body), s(this.container, this.opts.element, this.opts.adaptContainerCssClass), this.container.attr("style", c.element.attr("style")), this.container.css(z(c.containerCss, this.opts.element)), this.container.addClass(z(c.containerCssClass, this.opts.element)), this.elementTabIndex = this.opts.element.attr("tabindex"), this.opts.element.data("select2", this).attr("tabindex", "-1").before(this.container).on("click.select2", p), this.container.data("select2", this), this.dropdown = this.container.find(".select2-drop"), s(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass), this.dropdown.addClass(z(c.dropdownCssClass, this.opts.element)), this.dropdown.data("select2", this), this.dropdown.on("click", p), this.results = d = this.container.find(g), this.search = e = this.container.find("input.select2-input"), this.queryCount = 0, this.resultsPage = 0, this.context = null, this.initContainer(), this.container.on("click", p), k(this.results), this.dropdown.on("mousemove-filtered", g, this.bind(this.highlightUnderEvent)), this.dropdown.on("touchstart touchmove touchend", g, this.bind(function(a) {
                        this._touchEvent = !0, this.highlightUnderEvent(a)
                    })), this.dropdown.on("touchmove", g, this.bind(this.touchMoved)), this.dropdown.on("touchstart touchend", g, this.bind(this.clearTouchMoved)), this.dropdown.on("click", this.bind(function() {
                        this._touchEvent && (this._touchEvent = !1, this.selectHighlighted())
                    })), m(80, this.results), this.dropdown.on("scroll-debounced", g, this.bind(this.loadMoreIfNeeded)), a(this.container).on("change", ".select2-input", function(a) {
                        a.stopPropagation()
                    }), a(this.dropdown).on("change", ".select2-input", function(a) {
                        a.stopPropagation()
                    }), a.fn.mousewheel && d.mousewheel(function(a, b, c, e) {
                        var f = d.scrollTop();
                        e > 0 && 0 >= f - e ? (d.scrollTop(0), p(a)) : 0 > e && d.get(0).scrollHeight - d.scrollTop() + e <= d.height() && (d.scrollTop(d.get(0).scrollHeight - d.height()), p(a))
                    }), j(e), e.on("keyup-change input paste", this.bind(this.updateResults)), e.on("focus", function() {
                        e.addClass("select2-focused")
                    }), e.on("blur", function() {
                        e.removeClass("select2-focused")
                    }), this.dropdown.on("mouseup", g, this.bind(function(b) {
                        a(b.target).closest(".select2-result-selectable").length > 0 && (this.highlightUnderEvent(b), this.selectHighlighted(b))
                    })), this.dropdown.on("click mouseup mousedown touchstart touchend focusin", function(a) {
                        a.stopPropagation()
                    }), this.nextSearchTerm = b, a.isFunction(this.opts.initSelection) && (this.initSelection(), this.monitorSource()), null !== c.maximumInputLength && this.search.attr("maxlength", c.maximumInputLength);
                    var h = c.element.prop("disabled");
                    h === b && (h = !1), this.enable(!h);
                    var i = c.element.prop("readonly");
                    i === b && (i = !1), this.readonly(i), K = K || f(), this.autofocus = c.element.prop("autofocus"), c.element.prop("autofocus", !1), this.autofocus && this.focus(), this.search.attr("placeholder", c.searchInputPlaceholder)
                },
                destroy: function() {
                    var a = this.opts.element,
                        c = a.data("select2"),
                        d = this;
                    this.close(), a.length && a[0].detachEvent && d._sync && a.each(function() {
                        d._sync && this.detachEvent("onpropertychange", d._sync)
                    }), this.propertyObserver && (this.propertyObserver.disconnect(), this.propertyObserver = null), this._sync = null, c !== b && (c.container.remove(), c.liveRegion.remove(), c.dropdown.remove(), a.show().removeData("select2").off(".select2").prop("autofocus", this.autofocus || !1), this.elementTabIndex ? a.attr({
                        tabindex: this.elementTabIndex
                    }) : a.removeAttr("tabindex"), a.show()), C.call(this, "container", "liveRegion", "dropdown", "results", "search")
                },
                optionToData: function(a) {
                    return a.is("option") ? {
                        id: a.prop("value"),
                        text: a.text(),
                        element: a.get(),
                        css: a.attr("class"),
                        disabled: a.prop("disabled"),
                        locked: g(a.attr("locked"), "locked") || g(a.data("locked"), !0)
                    } : a.is("optgroup") ? {
                        text: a.attr("label"),
                        children: [],
                        element: a.get(),
                        css: a.attr("class")
                    } : void 0
                },
                prepareOpts: function(c) {
                    var d, e, f, i, j = this;
                    if (d = c.element, "select" === d.get(0).tagName.toLowerCase() && (this.select = e = c.element), e && a.each(["id", "multiple", "ajax", "query", "createSearchChoice", "initSelection", "data", "tags"], function() {
                            if (this in c) throw new Error("Option '" + this + "' is not allowed for Select2 when attached to a <select> element.")
                        }), c = a.extend({}, {
                            populateResults: function(d, e, f) {
                                var g, h = this.opts.id,
                                    i = this.liveRegion;
                                (g = function(d, e, k) {
                                    var l, m, n, o, p, q, r, s, t, u;
                                    d = c.sortResults(d, e, f);
                                    var v = [];
                                    for (l = 0, m = d.length; m > l; l += 1) n = d[l], p = n.disabled === !0, o = !p && h(n) !== b, q = n.children && n.children.length > 0, r = a("<li></li>"), r.addClass("select2-results-dept-" + k), r.addClass("select2-result"), r.addClass(o ? "select2-result-selectable" : "select2-result-unselectable"), p && r.addClass("select2-disabled"), q && r.addClass("select2-result-with-children"), r.addClass(j.opts.formatResultCssClass(n)), r.attr("role", "presentation"), s = a(document.createElement("div")), s.addClass("select2-result-label"), s.attr("id", "select2-result-label-" + H()), s.attr("role", "option"), u = c.formatResult(n, s, f, j.opts.escapeMarkup), u !== b && (s.html(u), r.append(s)), q && (t = a("<ul></ul>"), t.addClass("select2-result-sub"), g(n.children, t, k + 1), r.append(t)), r.data("select2-data", n), v.push(r[0]);
                                    e.append(v), i.text(c.formatMatches(d.length))
                                })(e, d, 0)
                            }
                        }, a.fn.select2.defaults, c), "function" != typeof c.id && (f = c.id, c.id = function(a) {
                            return a[f]
                        }), a.isArray(c.element.data("select2Tags"))) {
                        if ("tags" in c) throw "tags specified as both an attribute 'data-select2-tags' and in options of Select2 " + c.element.attr("id");
                        c.tags = c.element.data("select2Tags")
                    }
                    if (e ? (c.query = this.bind(function(a) {
                            var c, e, f, g = {
                                    results: [],
                                    more: !1
                                },
                                h = a.term;
                            f = function(b, c) {
                                var d;
                                b.is("option") ? a.matcher(h, b.text(), b) && c.push(j.optionToData(b)) : b.is("optgroup") && (d = j.optionToData(b), b.children().each2(function(a, b) {
                                    f(b, d.children)
                                }), d.children.length > 0 && c.push(d))
                            }, c = d.children(), this.getPlaceholder() !== b && c.length > 0 && (e = this.getPlaceholderOption(), e && (c = c.not(e))), c.each2(function(a, b) {
                                f(b, g.results)
                            }), a.callback(g)
                        }), c.id = function(a) {
                            return a.id
                        }) : "query" in c || ("ajax" in c ? (i = c.element.data("ajax-url"), i && i.length > 0 && (c.ajax.url = i), c.query = v.call(c.element, c.ajax)) : "data" in c ? c.query = w(c.data) : "tags" in c && (c.query = x(c.tags), c.createSearchChoice === b && (c.createSearchChoice = function(b) {
                            return {
                                id: a.trim(b),
                                text: a.trim(b)
                            }
                        }), c.initSelection === b && (c.initSelection = function(b, d) {
                            var e = [];
                            a(h(b.val(), c.separator, c.transformVal)).each(function() {
                                var b = {
                                        id: this,
                                        text: this
                                    },
                                    d = c.tags;
                                a.isFunction(d) && (d = d()), a(d).each(function() {
                                    return g(this.id, b.id) ? (b = this, !1) : void 0
                                }), e.push(b)
                            }), d(e)
                        }))), "function" != typeof c.query) throw "query function not defined for Select2 " + c.element.attr("id");
                    if ("top" === c.createSearchChoicePosition) c.createSearchChoicePosition = function(a, b) {
                        a.unshift(b)
                    };
                    else if ("bottom" === c.createSearchChoicePosition) c.createSearchChoicePosition = function(a, b) {
                        a.push(b)
                    };
                    else if ("function" != typeof c.createSearchChoicePosition) throw "invalid createSearchChoicePosition option must be 'top', 'bottom' or a custom function";
                    return c
                },
                monitorSource: function() {
                    var c, d = this.opts.element,
                        e = this;
                    d.on("change.select2", this.bind(function() {
                        this.opts.element.data("select2-change-triggered") !== !0 && this.initSelection()
                    })), this._sync = this.bind(function() {
                        var a = d.prop("disabled");
                        a === b && (a = !1), this.enable(!a);
                        var c = d.prop("readonly");
                        c === b && (c = !1), this.readonly(c), this.container && (s(this.container, this.opts.element, this.opts.adaptContainerCssClass), this.container.addClass(z(this.opts.containerCssClass, this.opts.element))), this.dropdown && (s(this.dropdown, this.opts.element, this.opts.adaptDropdownCssClass), this.dropdown.addClass(z(this.opts.dropdownCssClass, this.opts.element)))
                    }), d.length && d[0].attachEvent && d.each(function() {
                        this.attachEvent("onpropertychange", e._sync)
                    }), c = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver, c !== b && (this.propertyObserver && (delete this.propertyObserver, this.propertyObserver = null), this.propertyObserver = new c(function(b) {
                        a.each(b, e._sync)
                    }), this.propertyObserver.observe(d.get(0), {
                        attributes: !0,
                        subtree: !1
                    }))
                },
                triggerSelect: function(b) {
                    var c = a.Event("select2-selecting", {
                        val: this.id(b),
                        object: b,
                        choice: b
                    });
                    return this.opts.element.trigger(c), !c.isDefaultPrevented()
                },
                triggerChange: function(b) {
                    b = b || {}, b = a.extend({}, b, {
                        type: "change",
                        val: this.val()
                    }), this.opts.element.data("select2-change-triggered", !0), this.opts.element.trigger(b), this.opts.element.data("select2-change-triggered", !1), this.opts.element.click(), this.opts.blurOnChange && this.opts.element.blur()
                },
                isInterfaceEnabled: function() {
                    return this.enabledInterface === !0
                },
                enableInterface: function() {
                    var a = this._enabled && !this._readonly,
                        b = !a;
                    return a === this.enabledInterface ? !1 : (this.container.toggleClass("select2-container-disabled", b), this.close(), this.enabledInterface = a, !0)
                },
                enable: function(a) {
                    a === b && (a = !0), this._enabled !== a && (this._enabled = a, this.opts.element.prop("disabled", !a), this.enableInterface())
                },
                disable: function() {
                    this.enable(!1)
                },
                readonly: function(a) {
                    a === b && (a = !1), this._readonly !== a && (this._readonly = a, this.opts.element.prop("readonly", a), this.enableInterface())
                },
                opened: function() {
                    return this.container ? this.container.hasClass("select2-dropdown-open") : !1
                },
                positionDropdown: function() {
                    var b, c, d, e, f, g = this.dropdown,
                        h = this.container,
                        i = h.offset(),
                        j = h.outerHeight(!1),
                        k = h.outerWidth(!1),
                        l = g.outerHeight(!1),
                        m = a(window),
                        n = m.width(),
                        o = m.height(),
                        p = m.scrollLeft() + n,
                        q = m.scrollTop() + o,
                        r = i.top + j,
                        s = i.left,
                        t = q >= r + l,
                        u = i.top - l >= m.scrollTop(),
                        v = g.outerWidth(!1),
                        w = function() {
                            return p >= s + v
                        },
                        x = function() {
                            return i.left + p + h.outerWidth(!1) > v
                        },
                        y = g.hasClass("select2-drop-above");
                    y ? (c = !0, !u && t && (d = !0, c = !1)) : (c = !1, !t && u && (d = !0, c = !0)), d && (g.hide(), i = this.container.offset(), j = this.container.outerHeight(!1), k = this.container.outerWidth(!1), l = g.outerHeight(!1), p = m.scrollLeft() + n, q = m.scrollTop() + o, r = i.top + j, s = i.left, v = g.outerWidth(!1), g.show(), this.focusSearch()), this.opts.dropdownAutoWidth ? (f = a(".select2-results", g)[0], g.addClass("select2-drop-auto-width"), g.css("width", ""), v = g.outerWidth(!1) + (f.scrollHeight === f.clientHeight ? 0 : K.width), v > k ? k = v : v = k, l = g.outerHeight(!1)) : this.container.removeClass("select2-drop-auto-width"), "static" !== this.body.css("position") && (b = this.body.offset(), r -= b.top, s -= b.left), !w() && x() && (s = i.left + this.container.outerWidth(!1) - v), e = {
                        left: s,
                        width: k
                    }, c ? (this.container.addClass("select2-drop-above"), g.addClass("select2-drop-above"), l = g.outerHeight(!1), e.top = i.top - l, e.bottom = "auto") : (e.top = r, e.bottom = "auto", this.container.removeClass("select2-drop-above"), g.removeClass("select2-drop-above")), e = a.extend(e, z(this.opts.dropdownCss, this.opts.element)), g.css(e)
                },
                shouldOpen: function() {
                    var b;
                    return this.opened() ? !1 : this._enabled === !1 || this._readonly === !0 ? !1 : (b = a.Event("select2-opening"), this.opts.element.trigger(b), !b.isDefaultPrevented())
                },
                clearDropdownAlignmentPreference: function() {
                    this.container.removeClass("select2-drop-above"), this.dropdown.removeClass("select2-drop-above")
                },
                open: function() {
                    return this.shouldOpen() ? (this.opening(), J.on("mousemove.select2Event", function(a) {
                        L.x = a.pageX, L.y = a.pageY
                    }), !0) : !1
                },
                opening: function() {
                    var b, d = this.containerEventName,
                        e = "scroll." + d,
                        f = "resize." + d,
                        g = "orientationchange." + d;
                    this.container.addClass("select2-dropdown-open").addClass("select2-container-active"), this.clearDropdownAlignmentPreference(), this.dropdown[0] !== this.body.children().last()[0] && this.dropdown.detach().appendTo(this.body), b = a("#select2-drop-mask"), 0 === b.length && (b = a(document.createElement("div")), b.attr("id", "select2-drop-mask").attr("class", "select2-drop-mask"), b.hide(), b.appendTo(this.body), b.on("mousedown touchstart click", function(d) {
                        c(b);
                        var e, f = a("#select2-drop");
                        f.length > 0 && (e = f.data("select2"), e.opts.selectOnBlur && e.selectHighlighted({
                            noFocus: !0
                        }), e.close(), d.preventDefault(), d.stopPropagation())
                    })), this.dropdown.prev()[0] !== b[0] && this.dropdown.before(b), a("#select2-drop").removeAttr("id"), this.dropdown.attr("id", "select2-drop"), b.show(), this.positionDropdown(), this.dropdown.show(), this.positionDropdown(), this.dropdown.addClass("select2-drop-active");
                    var h = this;
                    this.container.parents().add(window).each(function() {
                        a(this).on(f + " " + e + " " + g, function() {
                            h.opened() && h.positionDropdown()
                        })
                    })
                },
                close: function() {
                    if (this.opened()) {
                        var b = this.containerEventName,
                            c = "scroll." + b,
                            d = "resize." + b,
                            e = "orientationchange." + b;
                        this.container.parents().add(window).each(function() {
                            a(this).off(c).off(d).off(e)
                        }), this.clearDropdownAlignmentPreference(), a("#select2-drop-mask").hide(), this.dropdown.removeAttr("id"), this.dropdown.hide(), this.container.removeClass("select2-dropdown-open").removeClass("select2-container-active"), this.results.empty(), J.off("mousemove.select2Event"), this.clearSearch(), this.search.removeClass("select2-active"), this.opts.element.trigger(a.Event("select2-close"))
                    }
                },
                externalSearch: function(a) {
                    this.open(), this.search.val(a), this.updateResults(!1)
                },
                clearSearch: function() {},
                getMaximumSelectionSize: function() {
                    return z(this.opts.maximumSelectionSize, this.opts.element)
                },
                ensureHighlightVisible: function() {
                    var b, c, d, e, f, g, h, i, j = this.results;
                    if (c = this.highlight(), !(0 > c)) {
                        if (0 == c) return void j.scrollTop(0);
                        b = this.findHighlightableChoices().find(".select2-result-label"), d = a(b[c]), i = (d.offset() || {}).top || 0, e = i + d.outerHeight(!0), c === b.length - 1 && (h = j.find("li.select2-more-results"), h.length > 0 && (e = h.offset().top + h.outerHeight(!0))), f = j.offset().top + j.outerHeight(!1), e > f && j.scrollTop(j.scrollTop() + (e - f)), g = i - j.offset().top, 0 > g && "none" != d.css("display") && j.scrollTop(j.scrollTop() + g)
                    }
                },
                findHighlightableChoices: function() {
                    return this.results.find(".select2-result-selectable:not(.select2-disabled):not(.select2-selected)")
                },
                moveHighlight: function(b) {
                    for (var c = this.findHighlightableChoices(), d = this.highlight(); d > -1 && d < c.length;) {
                        d += b;
                        var e = a(c[d]);
                        if (e.hasClass("select2-result-selectable") && !e.hasClass("select2-disabled") && !e.hasClass("select2-selected")) {
                            this.highlight(d);
                            break
                        }
                    }
                },
                highlight: function(b) {
                    var c, d, f = this.findHighlightableChoices();
                    return 0 === arguments.length ? e(f.filter(".select2-highlighted")[0], f.get()) : (b >= f.length && (b = f.length - 1), 0 > b && (b = 0), this.removeHighlight(), c = a(f[b]), c.addClass("select2-highlighted"), this.search.attr("aria-activedescendant", c.find(".select2-result-label").attr("id")), this.ensureHighlightVisible(), this.liveRegion.text(c.text()), d = c.data("select2-data"), void(d && this.opts.element.trigger({
                        type: "select2-highlight",
                        val: this.id(d),
                        choice: d
                    })))
                },
                removeHighlight: function() {
                    this.results.find(".select2-highlighted").removeClass("select2-highlighted")
                },
                touchMoved: function() {
                    this._touchMoved = !0
                },
                clearTouchMoved: function() {
                    this._touchMoved = !1
                },
                countSelectableResults: function() {
                    return this.findHighlightableChoices().length
                },
                highlightUnderEvent: function(b) {
                    var c = a(b.target).closest(".select2-result-selectable");
                    if (c.length > 0 && !c.is(".select2-highlighted")) {
                        var d = this.findHighlightableChoices();
                        this.highlight(d.index(c))
                    } else 0 == c.length && this.removeHighlight()
                },
                loadMoreIfNeeded: function() {
                    var a, b = this.results,
                        c = b.find("li.select2-more-results"),
                        d = this.resultsPage + 1,
                        e = this,
                        f = this.search.val(),
                        g = this.context;
                    0 !== c.length && (a = c.offset().top - b.offset().top - b.height(), a <= this.opts.loadMorePadding && (c.addClass("select2-active"), this.opts.query({
                        element: this.opts.element,
                        term: f,
                        page: d,
                        context: g,
                        matcher: this.opts.matcher,
                        callback: this.bind(function(a) {
                            e.opened() && (e.opts.populateResults.call(this, b, a.results, {
                                term: f,
                                page: d,
                                context: g
                            }), e.postprocessResults(a, !1, !1), a.more === !0 ? (c.detach().appendTo(b).html(e.opts.escapeMarkup(z(e.opts.formatLoadMore, e.opts.element, d + 1))), window.setTimeout(function() {
                                e.loadMoreIfNeeded()
                            }, 10)) : c.remove(), e.positionDropdown(), e.resultsPage = d, e.context = a.context, this.opts.element.trigger({
                                type: "select2-loaded",
                                items: a
                            }))
                        })
                    })))
                },
                tokenize: function() {},
                updateResults: function(c) {
                    function d() {
                        j.removeClass("select2-active"), m.positionDropdown(), m.liveRegion.text(k.find(".select2-no-results,.select2-selection-limit,.select2-searching").length ? k.text() : m.opts.formatMatches(k.find('.select2-result-selectable:not(".select2-selected")').length))
                    }

                    function e(a) {
                        k.html(a), d()
                    }
                    var f, h, i, j = this.search,
                        k = this.results,
                        l = this.opts,
                        m = this,
                        n = j.val(),
                        o = a.data(this.container, "select2-last-term");
                    if ((c === !0 || !o || !g(n, o)) && (a.data(this.container, "select2-last-term", n), c === !0 || this.showSearchInput !== !1 && this.opened())) {
                        i = ++this.queryCount;
                        var p = this.getMaximumSelectionSize();
                        if (p >= 1 && (f = this.data(), a.isArray(f) && f.length >= p && y(l.formatSelectionTooBig, "formatSelectionTooBig"))) return void e("<li class='select2-selection-limit'>" + z(l.formatSelectionTooBig, l.element, p) + "</li>");
                        if (j.val().length < l.minimumInputLength) return e(y(l.formatInputTooShort, "formatInputTooShort") ? "<li class='select2-no-results'>" + z(l.formatInputTooShort, l.element, j.val(), l.minimumInputLength) + "</li>" : ""), void(c && this.showSearch && this.showSearch(!0));
                        if (l.maximumInputLength && j.val().length > l.maximumInputLength) return void e(y(l.formatInputTooLong, "formatInputTooLong") ? "<li class='select2-no-results'>" + z(l.formatInputTooLong, l.element, j.val(), l.maximumInputLength) + "</li>" : "");
                        l.formatSearching && 0 === this.findHighlightableChoices().length && e("<li class='select2-searching'>" + z(l.formatSearching, l.element) + "</li>"), j.addClass("select2-active"), this.removeHighlight(), h = this.tokenize(), h != b && null != h && j.val(h), this.resultsPage = 1, l.query({
                            element: l.element,
                            term: j.val(),
                            page: this.resultsPage,
                            context: null,
                            matcher: l.matcher,
                            callback: this.bind(function(f) {
                                var h;
                                if (i == this.queryCount) {
                                    if (!this.opened()) return void this.search.removeClass("select2-active");
                                    if (f.hasError !== b && y(l.formatAjaxError, "formatAjaxError")) return void e("<li class='select2-ajax-error'>" + z(l.formatAjaxError, l.element, f.jqXHR, f.textStatus, f.errorThrown) + "</li>");
                                    if (this.context = f.context === b ? null : f.context, this.opts.createSearchChoice && "" !== j.val() && (h = this.opts.createSearchChoice.call(m, j.val(), f.results), h !== b && null !== h && m.id(h) !== b && null !== m.id(h) && 0 === a(f.results).filter(function() {
                                            return g(m.id(this), m.id(h))
                                        }).length && this.opts.createSearchChoicePosition(f.results, h)), 0 === f.results.length && y(l.formatNoMatches, "formatNoMatches")) return void e("<li class='select2-no-results'>" + z(l.formatNoMatches, l.element, j.val()) + "</li>");
                                    k.empty(), m.opts.populateResults.call(this, k, f.results, {
                                        term: j.val(),
                                        page: this.resultsPage,
                                        context: null
                                    }), f.more === !0 && y(l.formatLoadMore, "formatLoadMore") && (k.append("<li class='select2-more-results'>" + l.escapeMarkup(z(l.formatLoadMore, l.element, this.resultsPage)) + "</li>"), window.setTimeout(function() {
                                        m.loadMoreIfNeeded()
                                    }, 10)), this.postprocessResults(f, c), d(), this.opts.element.trigger({
                                        type: "select2-loaded",
                                        items: f
                                    })
                                }
                            })
                        })
                    }
                },
                cancel: function() {
                    this.close()
                },
                blur: function() {
                    this.opts.selectOnBlur && this.selectHighlighted({
                        noFocus: !0
                    }), this.close(), this.container.removeClass("select2-container-active"), this.search[0] === document.activeElement && this.search.blur(), this.clearSearch(), this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus")
                },
                focusSearch: function() {
                    n(this.search)
                },
                selectHighlighted: function(a) {
                    if (this._touchMoved) return void this.clearTouchMoved();
                    var b = this.highlight(),
                        c = this.results.find(".select2-highlighted"),
                        d = c.closest(".select2-result").data("select2-data");
                    d ? (this.highlight(b), this.onSelect(d, a)) : a && a.noFocus && this.close()
                },
                getPlaceholder: function() {
                    var a;
                    return this.opts.element.attr("placeholder") || this.opts.element.attr("data-placeholder") || this.opts.element.data("placeholder") || this.opts.placeholder || ((a = this.getPlaceholderOption()) !== b ? a.text() : b)
                },
                getPlaceholderOption: function() {
                    if (this.select) {
                        var c = this.select.children("option").first();
                        if (this.opts.placeholderOption !== b) return "first" === this.opts.placeholderOption && c || "function" == typeof this.opts.placeholderOption && this.opts.placeholderOption(this.select);
                        if ("" === a.trim(c.text()) && "" === c.val()) return c
                    }
                },
                initContainerWidth: function() {
                    function c() {
                        var c, d, e, f, g, h;
                        if ("off" === this.opts.width) return null;
                        if ("element" === this.opts.width) return 0 === this.opts.element.outerWidth(!1) ? "auto" : this.opts.element.outerWidth(!1) + "px";
                        if ("copy" === this.opts.width || "resolve" === this.opts.width) {
                            if (c = this.opts.element.attr("style"), c !== b)
                                for (d = c.split(";"), f = 0, g = d.length; g > f; f += 1)
                                    if (h = d[f].replace(/\s/g, ""), e = h.match(/^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i), null !== e && e.length >= 1) return e[1];
                            return "resolve" === this.opts.width ? (c = this.opts.element.css("width"), c.indexOf("%") > 0 ? c : 0 === this.opts.element.outerWidth(!1) ? "auto" : this.opts.element.outerWidth(!1) + "px") : null
                        }
                        return a.isFunction(this.opts.width) ? this.opts.width() : this.opts.width
                    }
                    var d = c.call(this);
                    null !== d && this.container.css("width", d)
                }
            }), F = D(E, {
                createContainer: function() {
                    var b = a(document.createElement("div")).attr({
                        "class": "select2-container"
                    }).html(["<a href='javascript:void(0)' class='select2-choice' tabindex='-1'>", "   <span class='select2-chosen'>&#160;</span><abbr class='select2-search-choice-close'></abbr>", "   <span class='select2-arrow' role='presentation'><b role='presentation'></b></span>", "</a>", "<label for='' class='select2-offscreen'></label>", "<input class='select2-focusser select2-offscreen' type='text' aria-haspopup='true' role='button' />", "<div class='select2-drop select2-display-none'>", "   <div class='select2-search'>", "       <label for='' class='select2-offscreen'></label>", "       <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input' role='combobox' aria-expanded='true'", "       aria-autocomplete='list' />", "   </div>", "   <ul class='select2-results' role='listbox'>", "   </ul>", "</div>"].join(""));
                    return b
                },
                enableInterface: function() {
                    this.parent.enableInterface.apply(this, arguments) && this.focusser.prop("disabled", !this.isInterfaceEnabled())
                },
                opening: function() {
                    var c, d, e;
                    this.opts.minimumResultsForSearch >= 0 && this.showSearch(!0), this.parent.opening.apply(this, arguments), this.showSearchInput !== !1 && this.search.val(this.focusser.val()), this.opts.shouldFocusInput(this) && (this.search.focus(), c = this.search.get(0), c.createTextRange ? (d = c.createTextRange(), d.collapse(!1), d.select()) : c.setSelectionRange && (e = this.search.val().length, c.setSelectionRange(e, e))), "" === this.search.val() && this.nextSearchTerm != b && (this.search.val(this.nextSearchTerm), this.search.select()), this.focusser.prop("disabled", !0).val(""), this.updateResults(!0), this.opts.element.trigger(a.Event("select2-open"))
                },
                close: function() {
                    this.opened() && (this.parent.close.apply(this, arguments), this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus())
                },
                focus: function() {
                    this.opened() ? this.close() : (this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus())
                },
                isFocused: function() {
                    return this.container.hasClass("select2-container-active")
                },
                cancel: function() {
                    this.parent.cancel.apply(this, arguments), this.focusser.prop("disabled", !1), this.opts.shouldFocusInput(this) && this.focusser.focus()
                },
                destroy: function() {
                    a("label[for='" + this.focusser.attr("id") + "']").attr("for", this.opts.element.attr("id")), this.parent.destroy.apply(this, arguments), C.call(this, "selection", "focusser")
                },
                initContainer: function() {
                    var b, d, e = this.container,
                        f = this.dropdown,
                        g = H();
                    this.showSearch(this.opts.minimumResultsForSearch < 0 ? !1 : !0), this.selection = b = e.find(".select2-choice"), this.focusser = e.find(".select2-focusser"), b.find(".select2-chosen").attr("id", "select2-chosen-" + g), this.focusser.attr("aria-labelledby", "select2-chosen-" + g), this.results.attr("id", "select2-results-" + g), this.search.attr("aria-owns", "select2-results-" + g), this.focusser.attr("id", "s2id_autogen" + g), d = a("label[for='" + this.opts.element.attr("id") + "']"), this.opts.element.focus(this.bind(function() {
                        this.focus()
                    })), this.focusser.prev().text(d.text()).attr("for", this.focusser.attr("id"));
                    var h = this.opts.element.attr("title");
                    this.opts.element.attr("title", h || d.text()), this.focusser.attr("tabindex", this.elementTabIndex), this.search.attr("id", this.focusser.attr("id") + "_search"), this.search.prev().text(a("label[for='" + this.focusser.attr("id") + "']").text()).attr("for", this.search.attr("id")), this.search.on("keydown", this.bind(function(a) {
                        if (this.isInterfaceEnabled() && 229 != a.keyCode) {
                            if (a.which === M.PAGE_UP || a.which === M.PAGE_DOWN) return void p(a);
                            switch (a.which) {
                                case M.UP:
                                case M.DOWN:
                                    return this.moveHighlight(a.which === M.UP ? -1 : 1), void p(a);
                                case M.ENTER:
                                    return this.selectHighlighted(), void p(a);
                                case M.TAB:
                                    return void this.selectHighlighted({
                                        noFocus: !0
                                    });
                                case M.ESC:
                                    return this.cancel(a), void p(a)
                            }
                        }
                    })), this.search.on("blur", this.bind(function() {
                        document.activeElement === this.body.get(0) && window.setTimeout(this.bind(function() {
                            this.opened() && this.search.focus()
                        }), 0)
                    })), this.focusser.on("keydown", this.bind(function(a) {
                        if (this.isInterfaceEnabled() && a.which !== M.TAB && !M.isControl(a) && !M.isFunctionKey(a) && a.which !== M.ESC) {
                            if (this.opts.openOnEnter === !1 && a.which === M.ENTER) return void p(a);
                            if (a.which == M.DOWN || a.which == M.UP || a.which == M.ENTER && this.opts.openOnEnter) {
                                if (a.altKey || a.ctrlKey || a.shiftKey || a.metaKey) return;
                                return this.open(), void p(a)
                            }
                            return a.which == M.DELETE || a.which == M.BACKSPACE ? (this.opts.allowClear && this.clear(), void p(a)) : void 0
                        }
                    })), j(this.focusser), this.focusser.on("keyup-change input", this.bind(function(a) {
                        if (this.opts.minimumResultsForSearch >= 0) {
                            if (a.stopPropagation(), this.opened()) return;
                            this.open()
                        }
                    })), b.on("mousedown touchstart", "abbr", this.bind(function(a) {
                        this.isInterfaceEnabled() && (this.clear(), q(a), this.close(), this.selection && this.selection.focus())
                    })), b.on("mousedown touchstart", this.bind(function(d) {
                        c(b), this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.opened() ? this.close() : this.isInterfaceEnabled() && this.open(), p(d)
                    })), f.on("mousedown touchstart", this.bind(function() {
                        this.opts.shouldFocusInput(this) && this.search.focus()
                    })), b.on("focus", this.bind(function(a) {
                        p(a)
                    })), this.focusser.on("focus", this.bind(function() {
                        this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.container.addClass("select2-container-active")
                    })).on("blur", this.bind(function() {
                        this.opened() || (this.container.removeClass("select2-container-active"), this.opts.element.trigger(a.Event("select2-blur")))
                    })), this.search.on("focus", this.bind(function() {
                        this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.container.addClass("select2-container-active")
                    })), this.initContainerWidth(), this.opts.element.hide(), this.setPlaceholder()
                },
                clear: function(b) {
                    var c = this.selection.data("select2-data");
                    if (c) {
                        var d = a.Event("select2-clearing");
                        if (this.opts.element.trigger(d), d.isDefaultPrevented()) return;
                        var e = this.getPlaceholderOption();
                        this.opts.element.val(e ? e.val() : ""), this.selection.find(".select2-chosen").empty(), this.selection.removeData("select2-data"), this.setPlaceholder(), b !== !1 && (this.opts.element.trigger({
                            type: "select2-removed",
                            val: this.id(c),
                            choice: c
                        }), this.triggerChange({
                            removed: c
                        }))
                    }
                },
                initSelection: function() {
                    if (this.isPlaceholderOptionSelected()) this.updateSelection(null), this.close(), this.setPlaceholder();
                    else {
                        var a = this;
                        this.opts.initSelection.call(null, this.opts.element, function(c) {
                            c !== b && null !== c && (a.updateSelection(c), a.close(), a.setPlaceholder(), a.nextSearchTerm = a.opts.nextSearchTerm(c, a.search.val()))
                        })
                    }
                },
                isPlaceholderOptionSelected: function() {
                    var a;
                    return this.getPlaceholder() === b ? !1 : (a = this.getPlaceholderOption()) !== b && a.prop("selected") || "" === this.opts.element.val() || this.opts.element.val() === b || null === this.opts.element.val()
                },
                prepareOpts: function() {
                    var b = this.parent.prepareOpts.apply(this, arguments),
                        c = this;
                    return "select" === b.element.get(0).tagName.toLowerCase() ? b.initSelection = function(a, b) {
                        var d = a.find("option").filter(function() {
                            return this.selected && !this.disabled
                        });
                        b(c.optionToData(d))
                    } : "data" in b && (b.initSelection = b.initSelection || function(c, d) {
                        var e = c.val(),
                            f = null;
                        b.query({
                            matcher: function(a, c, d) {
                                var h = g(e, b.id(d));
                                return h && (f = d), h
                            },
                            callback: a.isFunction(d) ? function() {
                                d(f)
                            } : a.noop
                        })
                    }), b
                },
                getPlaceholder: function() {
                    return this.select && this.getPlaceholderOption() === b ? b : this.parent.getPlaceholder.apply(this, arguments)
                },
                setPlaceholder: function() {
                    var a = this.getPlaceholder();
                    if (this.isPlaceholderOptionSelected() && a !== b) {
                        if (this.select && this.getPlaceholderOption() === b) return;
                        this.selection.find(".select2-chosen").html(this.opts.escapeMarkup(a)), this.selection.addClass("select2-default"), this.container.removeClass("select2-allowclear")
                    }
                },
                postprocessResults: function(a, b, c) {
                    var d = 0,
                        e = this;
                    if (this.findHighlightableChoices().each2(function(a, b) {
                            return g(e.id(b.data("select2-data")), e.opts.element.val()) ? (d = a, !1) : void 0
                        }), c !== !1 && this.highlight(b === !0 && d >= 0 ? d : 0), b === !0) {
                        var f = this.opts.minimumResultsForSearch;
                        f >= 0 && this.showSearch(A(a.results) >= f)
                    }
                },
                showSearch: function(b) {
                    this.showSearchInput !== b && (this.showSearchInput = b, this.dropdown.find(".select2-search").toggleClass("select2-search-hidden", !b), this.dropdown.find(".select2-search").toggleClass("select2-offscreen", !b), a(this.dropdown, this.container).toggleClass("select2-with-searchbox", b))
                },
                onSelect: function(a, b) {
                    if (this.triggerSelect(a)) {
                        var c = this.opts.element.val(),
                            d = this.data();
                        this.opts.element.val(this.id(a)), this.updateSelection(a), this.opts.element.trigger({
                            type: "select2-selected",
                            val: this.id(a),
                            choice: a
                        }), this.nextSearchTerm = this.opts.nextSearchTerm(a, this.search.val()), this.close(), b && b.noFocus || !this.opts.shouldFocusInput(this) || this.focusser.focus(), g(c, this.id(a)) || this.triggerChange({
                            added: a,
                            removed: d
                        })
                    }
                },
                updateSelection: function(a) {
                    var c, d, e = this.selection.find(".select2-chosen");
                    this.selection.data("select2-data", a), e.empty(), null !== a && (c = this.opts.formatSelection(a, e, this.opts.escapeMarkup)), c !== b && e.append(c), d = this.opts.formatSelectionCssClass(a, e), d !== b && e.addClass(d), this.selection.removeClass("select2-default"), this.opts.allowClear && this.getPlaceholder() !== b && this.container.addClass("select2-allowclear")
                },
                val: function() {
                    var a, c = !1,
                        d = null,
                        e = this,
                        f = this.data();
                    if (0 === arguments.length) return this.opts.element.val();
                    if (a = arguments[0], arguments.length > 1 && (c = arguments[1]), this.select) this.select.val(a).find("option").filter(function() {
                        return this.selected
                    }).each2(function(a, b) {
                        return d = e.optionToData(b), !1
                    }), this.updateSelection(d), this.setPlaceholder(), c && this.triggerChange({
                        added: d,
                        removed: f
                    });
                    else {
                        if (!a && 0 !== a) return void this.clear(c);
                        if (this.opts.initSelection === b) throw new Error("cannot call val() if initSelection() is not defined");
                        this.opts.element.val(a), this.opts.initSelection(this.opts.element, function(a) {
                            e.opts.element.val(a ? e.id(a) : ""), e.updateSelection(a), e.setPlaceholder(), c && e.triggerChange({
                                added: a,
                                removed: f
                            })
                        })
                    }
                },
                clearSearch: function() {
                    this.search.val(""), this.focusser.val("")
                },
                data: function(a) {
                    var c, d = !1;
                    return 0 === arguments.length ? (c = this.selection.data("select2-data"), c == b && (c = null), c) : (arguments.length > 1 && (d = arguments[1]), void(a ? (c = this.data(), this.opts.element.val(a ? this.id(a) : ""), this.updateSelection(a), d && this.triggerChange({
                        added: a,
                        removed: c
                    })) : this.clear(d)))
                }
            }), G = D(E, {
                createContainer: function() {
                    var b = a(document.createElement("div")).attr({
                        "class": "select2-container select2-container-multi"
                    }).html(["<ul class='select2-choices'>", "  <li class='select2-search-field'>", "    <label for='' class='select2-offscreen'></label>", "    <input type='text' autocomplete='off' autocorrect='off' autocapitalize='off' spellcheck='false' class='select2-input'>", "  </li>", "</ul>", "<div class='select2-drop select2-drop-multi select2-display-none'>", "   <ul class='select2-results'>", "   </ul>", "</div>"].join(""));
                    return b
                },
                prepareOpts: function() {
                    var b = this.parent.prepareOpts.apply(this, arguments),
                        c = this;
                    return "select" === b.element.get(0).tagName.toLowerCase() ? b.initSelection = function(a, b) {
                        var d = [];
                        a.find("option").filter(function() {
                            return this.selected && !this.disabled
                        }).each2(function(a, b) {
                            d.push(c.optionToData(b))
                        }), b(d)
                    } : "data" in b && (b.initSelection = b.initSelection || function(c, d) {
                        var e = h(c.val(), b.separator, b.transformVal),
                            f = [];
                        b.query({
                            matcher: function(c, d, h) {
                                var i = a.grep(e, function(a) {
                                    return g(a, b.id(h))
                                }).length;
                                return i && f.push(h), i
                            },
                            callback: a.isFunction(d) ? function() {
                                for (var a = [], c = 0; c < e.length; c++)
                                    for (var h = e[c], i = 0; i < f.length; i++) {
                                        var j = f[i];
                                        if (g(h, b.id(j))) {
                                            a.push(j), f.splice(i, 1);
                                            break
                                        }
                                    }
                                d(a)
                            } : a.noop
                        })
                    }), b
                },
                selectChoice: function(a) {
                    var b = this.container.find(".select2-search-choice-focus");
                    b.length && a && a[0] == b[0] || (b.length && this.opts.element.trigger("choice-deselected", b), b.removeClass("select2-search-choice-focus"), a && a.length && (this.close(), a.addClass("select2-search-choice-focus"), this.opts.element.trigger("choice-selected", a)))
                },
                destroy: function() {
                    a("label[for='" + this.search.attr("id") + "']").attr("for", this.opts.element.attr("id")), this.parent.destroy.apply(this, arguments), C.call(this, "searchContainer", "selection")
                },
                initContainer: function() {
                    var b, c = ".select2-choices";
                    this.searchContainer = this.container.find(".select2-search-field"), this.selection = b = this.container.find(c);
                    var d = this;
                    this.selection.on("click", ".select2-container:not(.select2-container-disabled) .select2-search-choice:not(.select2-locked)", function() {
                        d.search[0].focus(), d.selectChoice(a(this))
                    }), this.search.attr("id", "s2id_autogen" + H()), this.search.prev().text(a("label[for='" + this.opts.element.attr("id") + "']").text()).attr("for", this.search.attr("id")), this.opts.element.focus(this.bind(function() {
                        this.focus()
                    })), this.search.on("input paste", this.bind(function() {
                        this.search.attr("placeholder") && 0 == this.search.val().length || this.isInterfaceEnabled() && (this.opened() || this.open())
                    })), this.search.attr("tabindex", this.elementTabIndex), this.keydowns = 0, this.search.on("keydown", this.bind(function(a) {
                        if (this.isInterfaceEnabled()) {
                            ++this.keydowns;
                            var c = b.find(".select2-search-choice-focus"),
                                d = c.prev(".select2-search-choice:not(.select2-locked)"),
                                e = c.next(".select2-search-choice:not(.select2-locked)"),
                                f = o(this.search);
                            if (c.length && (a.which == M.LEFT || a.which == M.RIGHT || a.which == M.BACKSPACE || a.which == M.DELETE || a.which == M.ENTER)) {
                                var g = c;
                                return a.which == M.LEFT && d.length ? g = d : a.which == M.RIGHT ? g = e.length ? e : null : a.which === M.BACKSPACE ? this.unselect(c.first()) && (this.search.width(10), g = d.length ? d : e) : a.which == M.DELETE ? this.unselect(c.first()) && (this.search.width(10), g = e.length ? e : null) : a.which == M.ENTER && (g = null), this.selectChoice(g), p(a), void(g && g.length || this.open())
                            }
                            if ((a.which === M.BACKSPACE && 1 == this.keydowns || a.which == M.LEFT) && 0 == f.offset && !f.length) return this.selectChoice(b.find(".select2-search-choice:not(.select2-locked)").last()), void p(a);
                            if (this.selectChoice(null), this.opened()) switch (a.which) {
                                case M.UP:
                                case M.DOWN:
                                    return this.moveHighlight(a.which === M.UP ? -1 : 1), void p(a);
                                case M.ENTER:
                                    return this.selectHighlighted(), void p(a);
                                case M.TAB:
                                    return this.selectHighlighted({
                                        noFocus: !0
                                    }), void this.close();
                                case M.ESC:
                                    return this.cancel(a), void p(a)
                            }
                            if (a.which !== M.TAB && !M.isControl(a) && !M.isFunctionKey(a) && a.which !== M.BACKSPACE && a.which !== M.ESC) {
                                if (a.which === M.ENTER) {
                                    if (this.opts.openOnEnter === !1) return;
                                    if (a.altKey || a.ctrlKey || a.shiftKey || a.metaKey) return
                                }
                                this.open(), (a.which === M.PAGE_UP || a.which === M.PAGE_DOWN) && p(a), a.which === M.ENTER && p(a)
                            }
                        }
                    })), this.search.on("keyup", this.bind(function() {
                        this.keydowns = 0, this.resizeSearch()
                    })), this.search.on("blur", this.bind(function(b) {
                        this.container.removeClass("select2-container-active"), this.search.removeClass("select2-focused"), this.selectChoice(null), this.opened() || this.clearSearch(), b.stopImmediatePropagation(), this.opts.element.trigger(a.Event("select2-blur"))
                    })), this.container.on("click", c, this.bind(function(b) {
                        this.isInterfaceEnabled() && (a(b.target).closest(".select2-search-choice").length > 0 || (this.selectChoice(null), this.clearPlaceholder(), this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.open(), this.focusSearch(), b.preventDefault()))
                    })), this.container.on("focus", c, this.bind(function() {
                        this.isInterfaceEnabled() && (this.container.hasClass("select2-container-active") || this.opts.element.trigger(a.Event("select2-focus")), this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"), this.clearPlaceholder())
                    })), this.initContainerWidth(), this.opts.element.hide(), this.clearSearch()
                },
                enableInterface: function() {
                    this.parent.enableInterface.apply(this, arguments) && this.search.prop("disabled", !this.isInterfaceEnabled())
                },
                initSelection: function() {
                    if ("" === this.opts.element.val() && "" === this.opts.element.text() && (this.updateSelection([]), this.close(), this.clearSearch()), this.select || "" !== this.opts.element.val()) {
                        var a = this;
                        this.opts.initSelection.call(null, this.opts.element, function(c) {
                            c !== b && null !== c && (a.updateSelection(c), a.close(), a.clearSearch())
                        })
                    }
                },
                clearSearch: function() {
                    var a = this.getPlaceholder(),
                        c = this.getMaxSearchWidth();
                    a !== b && 0 === this.getVal().length && this.search.hasClass("select2-focused") === !1 ? (this.search.val(a).addClass("select2-default"), this.search.width(c > 0 ? c : this.container.css("width"))) : this.search.val("").width(10)
                },
                clearPlaceholder: function() {
                    this.search.hasClass("select2-default") && this.search.val("").removeClass("select2-default")
                },
                opening: function() {
                    this.clearPlaceholder(), this.resizeSearch(), this.parent.opening.apply(this, arguments), this.focusSearch(), "" === this.search.val() && this.nextSearchTerm != b && (this.search.val(this.nextSearchTerm), this.search.select()), this.updateResults(!0), this.opts.shouldFocusInput(this) && this.search.focus(), this.opts.element.trigger(a.Event("select2-open"))
                },
                close: function() {
                    this.opened() && this.parent.close.apply(this, arguments)
                },
                focus: function() {
                    this.close(), this.search.focus()
                },
                isFocused: function() {
                    return this.search.hasClass("select2-focused")
                },
                updateSelection: function(b) {
                    var c = [],
                        d = [],
                        f = this;
                    a(b).each(function() {
                        e(f.id(this), c) < 0 && (c.push(f.id(this)), d.push(this))
                    }), b = d, this.selection.find(".select2-search-choice").remove(), a(b).each(function() {
                        f.addSelectedChoice(this)
                    }), f.postprocessResults()
                },
                tokenize: function() {
                    var a = this.search.val();
                    a = this.opts.tokenizer.call(this, a, this.data(), this.bind(this.onSelect), this.opts), null != a && a != b && (this.search.val(a), a.length > 0 && this.open())
                },
                onSelect: function(a, c) {
                    this.triggerSelect(a) && "" !== a.text && (this.addSelectedChoice(a), this.opts.element.trigger({
                        type: "selected",
                        val: this.id(a),
                        choice: a
                    }), this.nextSearchTerm = this.opts.nextSearchTerm(a, this.search.val()), this.clearSearch(), this.updateResults(), (this.select || !this.opts.closeOnSelect) && this.postprocessResults(a, !1, this.opts.closeOnSelect === !0), this.opts.closeOnSelect ? (this.close(), this.search.width(10)) : this.countSelectableResults() > 0 ? (this.search.width(10), this.resizeSearch(), this.getMaximumSelectionSize() > 0 && this.val().length >= this.getMaximumSelectionSize() ? this.updateResults(!0) : this.nextSearchTerm != b && (this.search.val(this.nextSearchTerm), this.updateResults(), this.search.select()), this.positionDropdown()) : (this.close(), this.search.width(10)), this.triggerChange({
                        added: a
                    }), c && c.noFocus || this.focusSearch())
                },
                cancel: function() {
                    this.close(), this.focusSearch()
                },
                addSelectedChoice: function(c) {
                    var d, e, f = !c.locked,
                        g = a("<li class='select2-search-choice'>    <div></div>    <a href='#' class='select2-search-choice-close' tabindex='-1'></a></li>"),
                        h = a("<li class='select2-search-choice select2-locked'><div></div></li>"),
                        i = f ? g : h,
                        j = this.id(c),
                        k = this.getVal();
                    d = this.opts.formatSelection(c, i.find("div"), this.opts.escapeMarkup), d != b && i.find("div").replaceWith(a("<div></div>").html(d)), e = this.opts.formatSelectionCssClass(c, i.find("div")), e != b && i.addClass(e), f && i.find(".select2-search-choice-close").on("mousedown", p).on("click dblclick", this.bind(function(b) {
                        this.isInterfaceEnabled() && (this.unselect(a(b.target)), this.selection.find(".select2-search-choice-focus").removeClass("select2-search-choice-focus"), p(b), this.close(), this.focusSearch())
                    })).on("focus", this.bind(function() {
                        this.isInterfaceEnabled() && (this.container.addClass("select2-container-active"), this.dropdown.addClass("select2-drop-active"))
                    })), i.data("select2-data", c), i.insertBefore(this.searchContainer), k.push(j), this.setVal(k)
                },
                unselect: function(b) {
                    var c, d, f = this.getVal();
                    if (b = b.closest(".select2-search-choice"), 0 === b.length) throw "Invalid argument: " + b + ". Must be .select2-search-choice";
                    if (c = b.data("select2-data")) {
                        var g = a.Event("select2-removing");
                        if (g.val = this.id(c), g.choice = c, this.opts.element.trigger(g), g.isDefaultPrevented()) return !1;
                        for (;
                            (d = e(this.id(c), f)) >= 0;) f.splice(d, 1), this.setVal(f), this.select && this.postprocessResults();
                        return b.remove(), this.opts.element.trigger({
                            type: "select2-removed",
                            val: this.id(c),
                            choice: c
                        }), this.triggerChange({
                            removed: c
                        }), !0
                    }
                },
                postprocessResults: function(a, b, c) {
                    var d = this.getVal(),
                        f = this.results.find(".select2-result"),
                        g = this.results.find(".select2-result-with-children"),
                        h = this;
                    f.each2(function(a, b) {
                        var c = h.id(b.data("select2-data"));
                        e(c, d) >= 0 && (b.addClass("select2-selected"), b.find(".select2-result-selectable").addClass("select2-selected"))
                    }), g.each2(function(a, b) {
                        b.is(".select2-result-selectable") || 0 !== b.find(".select2-result-selectable:not(.select2-selected)").length || b.addClass("select2-selected")
                    }), -1 == this.highlight() && c !== !1 && this.opts.closeOnSelect === !0 && h.highlight(0), !this.opts.createSearchChoice && !f.filter(".select2-result:not(.select2-selected)").length > 0 && (!a || a && !a.more && 0 === this.results.find(".select2-no-results").length) && y(h.opts.formatNoMatches, "formatNoMatches") && this.results.append("<li class='select2-no-results'>" + z(h.opts.formatNoMatches, h.opts.element, h.search.val()) + "</li>")
                },
                getMaxSearchWidth: function() {
                    return this.selection.width() - i(this.search)
                },
                resizeSearch: function() {
                    var a, b, c, d, e, f = i(this.search);
                    a = r(this.search) + 10, b = this.search.offset().left, c = this.selection.width(), d = this.selection.offset().left, e = c - (b - d) - f, a > e && (e = c - f), 40 > e && (e = c - f), 0 >= e && (e = a), this.search.width(Math.floor(e))
                },
                getVal: function() {
                    var a;
                    return this.select ? (a = this.select.val(), null === a ? [] : a) : (a = this.opts.element.val(), h(a, this.opts.separator, this.opts.transformVal))
                },
                setVal: function(b) {
                    var c;
                    this.select ? this.select.val(b) : (c = [], a(b).each(function() {
                        e(this, c) < 0 && c.push(this)
                    }), this.opts.element.val(0 === c.length ? "" : c.join(this.opts.separator)))
                },
                buildChangeDetails: function(a, b) {
                    for (var b = b.slice(0), a = a.slice(0), c = 0; c < b.length; c++)
                        for (var d = 0; d < a.length; d++) g(this.opts.id(b[c]), this.opts.id(a[d])) && (b.splice(c, 1), c > 0 && c--, a.splice(d, 1), d--);
                    return {
                        added: b,
                        removed: a
                    }
                },
                val: function(c, d) {
                    var e, f = this;
                    if (0 === arguments.length) return this.getVal();
                    if (e = this.data(), e.length || (e = []), !c && 0 !== c) return this.opts.element.val(""), this.updateSelection([]), this.clearSearch(), void(d && this.triggerChange({
                        added: this.data(),
                        removed: e
                    }));
                    if (this.setVal(c), this.select) this.opts.initSelection(this.select, this.bind(this.updateSelection)), d && this.triggerChange(this.buildChangeDetails(e, this.data()));
                    else {
                        if (this.opts.initSelection === b) throw new Error("val() cannot be called if initSelection() is not defined");
                        this.opts.initSelection(this.opts.element, function(b) {
                            var c = a.map(b, f.id);
                            f.setVal(c), f.updateSelection(b), f.clearSearch(), d && f.triggerChange(f.buildChangeDetails(e, f.data()))
                        })
                    }
                    this.clearSearch()
                },
                onSortStart: function() {
                    if (this.select) throw new Error("Sorting of elements is not supported when attached to <select>. Attach to <input type='hidden'/> instead.");
                    this.search.width(0), this.searchContainer.hide()
                },
                onSortEnd: function() {
                    var b = [],
                        c = this;
                    this.searchContainer.show(), this.searchContainer.appendTo(this.searchContainer.parent()), this.resizeSearch(), this.selection.find(".select2-search-choice").each(function() {
                        b.push(c.opts.id(a(this).data("select2-data")))
                    }), this.setVal(b), this.triggerChange()
                },
                data: function(b, c) {
                    var d, e, f = this;
                    return 0 === arguments.length ? this.selection.children(".select2-search-choice").map(function() {
                        return a(this).data("select2-data")
                    }).get() : (e = this.data(), b || (b = []), d = a.map(b, function(a) {
                        return f.opts.id(a)
                    }), this.setVal(d), this.updateSelection(b), this.clearSearch(), c && this.triggerChange(this.buildChangeDetails(e, this.data())), void 0)
                }
            }), a.fn.select2 = function() {
                var c, d, f, g, h, i = Array.prototype.slice.call(arguments, 0),
                    j = ["val", "destroy", "opened", "open", "close", "focus", "isFocused", "container", "dropdown", "onSortStart", "onSortEnd", "enable", "disable", "readonly", "positionDropdown", "data", "search"],
                    k = ["opened", "isFocused", "container", "dropdown"],
                    l = ["val", "data"],
                    m = {
                        search: "externalSearch"
                    };
                return this.each(function() {
                    if (0 === i.length || "object" == typeof i[0]) c = 0 === i.length ? {} : a.extend({}, i[0]), c.element = a(this), "select" === c.element.get(0).tagName.toLowerCase() ? h = c.element.prop("multiple") : (h = c.multiple || !1, "tags" in c && (c.multiple = h = !0)), d = h ? new window.Select2["class"].multi : new window.Select2["class"].single, d.init(c);
                    else {
                        if ("string" != typeof i[0]) throw "Invalid arguments to select2 plugin: " + i;
                        if (e(i[0], j) < 0) throw "Unknown method: " + i[0];
                        if (g = b, d = a(this).data("select2"), d === b) return;
                        if (f = i[0], "container" === f ? g = d.container : "dropdown" === f ? g = d.dropdown : (m[f] && (f = m[f]), g = d[f].apply(d, i.slice(1))), e(i[0], k) >= 0 || e(i[0], l) >= 0 && 1 == i.length) return !1
                    }
                }), g === b ? this : g
            }, a.fn.select2.defaults = {
                width: "copy",
                loadMorePadding: 0,
                closeOnSelect: !0,
                openOnEnter: !0,
                containerCss: {},
                dropdownCss: {},
                containerCssClass: "",
                dropdownCssClass: "",
                formatResult: function(a, b, c, d) {
                    var e = [];
                    return t(this.text(a), c.term, e, d), e.join("")
                },
                transformVal: function(b) {
                    return a.trim(b)
                },
                formatSelection: function(a, c, d) {
                    return a ? d(this.text(a)) : b
                },
                sortResults: function(a) {
                    return a
                },
                formatResultCssClass: function(a) {
                    return a.css
                },
                formatSelectionCssClass: function() {
                    return b
                },
                minimumResultsForSearch: 0,
                minimumInputLength: 0,
                maximumInputLength: null,
                maximumSelectionSize: 0,
                id: function(a) {
                    return a == b ? null : a.id
                },
                text: function(b) {
                    return b && this.data && this.data.text ? a.isFunction(this.data.text) ? this.data.text(b) : b[this.data.text] : b.text
                },
                matcher: function(a, b) {
                    return d("" + b).toUpperCase().indexOf(d("" + a).toUpperCase()) >= 0
                },
                separator: ",",
                tokenSeparators: [],
                tokenizer: B,
                escapeMarkup: u,
                blurOnChange: !1,
                selectOnBlur: !1,
                adaptContainerCssClass: function(a) {
                    return a
                },
                adaptDropdownCssClass: function() {
                    return null
                },
                nextSearchTerm: function() {
                    return b
                },
                searchInputPlaceholder: "",
                createSearchChoicePosition: "top",
                shouldFocusInput: function(a) {
                    var b = "ontouchstart" in window || navigator.msMaxTouchPoints > 0;
                    return b && a.opts.minimumResultsForSearch < 0 ? !1 : !0
                }
            }, a.fn.select2.locales = [], a.fn.select2.locales.en = {
                formatMatches: function(a) {
                    return 1 === a ? "One result is available, press enter to select it." : a + " results are available, use up and down arrow keys to navigate."
                },
                formatNoMatches: function() {
                    return "No matches found"
                },
                formatAjaxError: function() {
                    return "Loading failed"
                },
                formatInputTooShort: function(a, b) {
                    var c = b - a.length;
                    return "Please enter " + c + " or more character" + (1 == c ? "" : "s")
                },
                formatInputTooLong: function(a, b) {
                    var c = a.length - b;
                    return "Please delete " + c + " character" + (1 == c ? "" : "s")
                },
                formatSelectionTooBig: function(a) {
                    return "You can only select " + a + " item" + (1 == a ? "" : "s")
                },
                formatLoadMore: function() {
                    return "Loading more results…"
                },
                formatSearching: function() {
                    return "Searching…"
                }
            }, a.extend(a.fn.select2.defaults, a.fn.select2.locales.en), a.fn.select2.ajaxDefaults = {
                transport: a.ajax,
                params: {
                    type: "GET",
                    cache: !1,
                    dataType: "json"
                }
            }, window.Select2 = {
                query: {
                    ajax: v,
                    local: w,
                    tags: x
                },
                util: {
                    debounce: l,
                    markMatch: t,
                    escapeMarkup: u,
                    stripDiacritics: d
                },
                "class": {
                    "abstract": E,
                    single: F,
                    multi: G
                }
            }
        }
    }(jQuery), function(a) {
        "function" == typeof define && define.amd ? define(["jquery"], a) : a(jQuery)
    }(function(a) {
        a.extend(a.fn, {
            validate: function(b) {
                if (!this.length) return void(b && b.debug && window.console && console.warn("Nothing selected, can't validate, returning nothing."));
                var c = a.data(this[0], "validator");
                return c ? c : (this.attr("novalidate", "novalidate"), c = new a.validator(b, this[0]), a.data(this[0], "validator", c), c.settings.onsubmit && (this.validateDelegate(":submit", "click", function(b) {
                    c.settings.submitHandler && (c.submitButton = b.target), a(b.target).hasClass("cancel") && (c.cancelSubmit = !0), void 0 !== a(b.target).attr("formnovalidate") && (c.cancelSubmit = !0)
                }), this.submit(function(b) {
                    function d() {
                        var d, e;
                        return c.settings.submitHandler ? (c.submitButton && (d = a("<input type='hidden'/>").attr("name", c.submitButton.name).val(a(c.submitButton).val()).appendTo(c.currentForm)), e = c.settings.submitHandler.call(c, c.currentForm, b), c.submitButton && d.remove(), void 0 !== e ? e : !1) : !0
                    }
                    return c.settings.debug && b.preventDefault(), c.cancelSubmit ? (c.cancelSubmit = !1, d()) : c.form() ? c.pendingRequest ? (c.formSubmitted = !0, !1) : d() : (c.focusInvalid(), !1)
                })), c)
            },
            valid: function() {
                var b, c;
                return a(this[0]).is("form") ? b = this.validate().form() : (b = !0, c = a(this[0].form).validate(), this.each(function() {
                    b = c.element(this) && b
                })), b
            },
            removeAttrs: function(b) {
                var c = {},
                    d = this;
                return a.each(b.split(/\s/), function(a, b) {
                    c[b] = d.attr(b), d.removeAttr(b)
                }), c
            },
            rules: function(b, c) {
                var d, e, f, g, h, i, j = this[0];
                if (b) switch (d = a.data(j.form, "validator").settings, e = d.rules, f = a.validator.staticRules(j), b) {
                    case "add":
                        a.extend(f, a.validator.normalizeRule(c)), delete f.messages, e[j.name] = f, c.messages && (d.messages[j.name] = a.extend(d.messages[j.name], c.messages));
                        break;
                    case "remove":
                        return c ? (i = {}, a.each(c.split(/\s/), function(b, c) {
                            i[c] = f[c], delete f[c], "required" === c && a(j).removeAttr("aria-required")
                        }), i) : (delete e[j.name], f)
                }
                return g = a.validator.normalizeRules(a.extend({}, a.validator.classRules(j), a.validator.attributeRules(j), a.validator.dataRules(j), a.validator.staticRules(j)), j), g.required && (h = g.required, delete g.required, g = a.extend({
                    required: h
                }, g), a(j).attr("aria-required", "true")), g.remote && (h = g.remote, delete g.remote, g = a.extend(g, {
                    remote: h
                })), g
            }
        }), a.extend(a.expr[":"], {
            blank: function(b) {
                return !a.trim("" + a(b).val())
            },
            filled: function(b) {
                return !!a.trim("" + a(b).val())
            },
            unchecked: function(b) {
                return !a(b).prop("checked")
            }
        }), a.validator = function(b, c) {
            this.settings = a.extend(!0, {}, a.validator.defaults, b), this.currentForm = c, this.init()
        }, a.validator.format = function(b, c) {
            return 1 === arguments.length ? function() {
                var c = a.makeArray(arguments);
                return c.unshift(b), a.validator.format.apply(this, c)
            } : (arguments.length > 2 && c.constructor !== Array && (c = a.makeArray(arguments).slice(1)), c.constructor !== Array && (c = [c]), a.each(c, function(a, c) {
                b = b.replace(new RegExp("\\{" + a + "\\}", "g"), function() {
                    return c
                })
            }), b)
        }, a.extend(a.validator, {
            defaults: {
                messages: {},
                groups: {},
                rules: {},
                errorClass: "error",
                validClass: "valid",
                errorElement: "label",
                focusCleanup: !1,
                focusInvalid: !0,
                errorContainer: a([]),
                errorLabelContainer: a([]),
                onsubmit: !0,
                ignore: ":hidden",
                ignoreTitle: !1,
                onfocusin: function(a) {
                    this.lastActive = a, this.settings.focusCleanup && (this.settings.unhighlight && this.settings.unhighlight.call(this, a, this.settings.errorClass, this.settings.validClass), this.hideThese(this.errorsFor(a)))
                },
                onfocusout: function(a) {
                    this.checkable(a) || !(a.name in this.submitted) && this.optional(a) || this.element(a)
                },
                onkeyup: function(a, b) {
                    (9 !== b.which || "" !== this.elementValue(a)) && (a.name in this.submitted || a === this.lastElement) && this.element(a)
                },
                onclick: function(a) {
                    a.name in this.submitted ? this.element(a) : a.parentNode.name in this.submitted && this.element(a.parentNode)
                },
                highlight: function(b, c, d) {
                    "radio" === b.type ? this.findByName(b.name).addClass(c).removeClass(d) : a(b).addClass(c).removeClass(d)
                },
                unhighlight: function(b, c, d) {
                    "radio" === b.type ? this.findByName(b.name).removeClass(c).addClass(d) : a(b).removeClass(c).addClass(d)
                }
            },
            setDefaults: function(b) {
                a.extend(a.validator.defaults, b)
            },
            messages: {
                required: "This field is required.",
                remote: "Please fix this field.",
                email: "Please enter a valid email address.",
                url: "Please enter a valid URL.",
                date: "Please enter a valid date.",
                dateISO: "Please enter a valid date ( ISO ).",
                number: "Please enter a valid number.",
                digits: "Please enter only digits.",
                creditcard: "Please enter a valid credit card number.",
                equalTo: "Please enter the same value again.",
                maxlength: a.validator.format("Please enter no more than {0} characters."),
                minlength: a.validator.format("Please enter at least {0} characters."),
                rangelength: a.validator.format("Please enter a value between {0} and {1} characters long."),
                range: a.validator.format("Please enter a value between {0} and {1}."),
                max: a.validator.format("Please enter a value less than or equal to {0}."),
                min: a.validator.format("Please enter a value greater than or equal to {0}.")
            },
            autoCreateRanges: !1,
            prototype: {
                init: function() {
                    function b(b) {
                        var c = a.data(this[0].form, "validator"),
                            d = "on" + b.type.replace(/^validate/, ""),
                            e = c.settings;
                        e[d] && !this.is(e.ignore) && e[d].call(c, this[0], b)
                    }
                    this.labelContainer = a(this.settings.errorLabelContainer), this.errorContext = this.labelContainer.length && this.labelContainer || a(this.currentForm), this.containers = a(this.settings.errorContainer).add(this.settings.errorLabelContainer), this.submitted = {}, this.valueCache = {}, this.pendingRequest = 0, this.pending = {}, this.invalid = {}, this.reset();
                    var c, d = this.groups = {};
                    a.each(this.settings.groups, function(b, c) {
                        "string" == typeof c && (c = c.split(/\s/)), a.each(c, function(a, c) {
                            d[c] = b
                        })
                    }), c = this.settings.rules, a.each(c, function(b, d) {
                        c[b] = a.validator.normalizeRule(d)
                    }), a(this.currentForm).validateDelegate(":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'] ,[type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']", "focusin focusout keyup", b).validateDelegate("select, option, [type='radio'], [type='checkbox']", "click", b), this.settings.invalidHandler && a(this.currentForm).bind("invalid-form.validate", this.settings.invalidHandler), a(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required", "true")
                },
                form: function() {
                    return this.checkForm(), a.extend(this.submitted, this.errorMap), this.invalid = a.extend({}, this.errorMap), this.valid() || a(this.currentForm).triggerHandler("invalid-form", [this]), this.showErrors(), this.valid()
                },
                checkForm: function() {
                    this.prepareForm();
                    for (var a = 0, b = this.currentElements = this.elements(); b[a]; a++) this.check(b[a]);
                    return this.valid()
                },
                element: function(b) {
                    var c = this.clean(b),
                        d = this.validationTargetFor(c),
                        e = !0;
                    return this.lastElement = d, void 0 === d ? delete this.invalid[c.name] : (this.prepareElement(d), this.currentElements = a(d), e = this.check(d) !== !1, e ? delete this.invalid[d.name] : this.invalid[d.name] = !0), a(b).attr("aria-invalid", !e), this.numberOfInvalids() || (this.toHide = this.toHide.add(this.containers)), this.showErrors(), e
                },
                showErrors: function(b) {
                    if (b) {
                        a.extend(this.errorMap, b), this.errorList = [];
                        for (var c in b) this.errorList.push({
                            message: b[c],
                            element: this.findByName(c)[0]
                        });
                        this.successList = a.grep(this.successList, function(a) {
                            return !(a.name in b)
                        })
                    }
                    this.settings.showErrors ? this.settings.showErrors.call(this, this.errorMap, this.errorList) : this.defaultShowErrors()
                },
                resetForm: function() {
                    a.fn.resetForm && a(this.currentForm).resetForm(), this.submitted = {}, this.lastElement = null, this.prepareForm(), this.hideErrors(), this.elements().removeClass(this.settings.errorClass).removeData("previousValue").removeAttr("aria-invalid")
                },
                numberOfInvalids: function() {
                    return this.objectLength(this.invalid)
                },
                objectLength: function(a) {
                    var b, c = 0;
                    for (b in a) c++;
                    return c
                },
                hideErrors: function() {
                    this.hideThese(this.toHide)
                },
                hideThese: function(a) {
                    a.not(this.containers).text(""), this.addWrapper(a).hide()
                },
                valid: function() {
                    return 0 === this.size()
                },
                size: function() {
                    return this.errorList.length
                },
                focusInvalid: function() {
                    if (this.settings.focusInvalid) try {
                        a(this.findLastActive() || this.errorList.length && this.errorList[0].element || []).filter(":visible").focus().trigger("focusin")
                    } catch (b) {}
                },
                findLastActive: function() {
                    var b = this.lastActive;
                    return b && 1 === a.grep(this.errorList, function(a) {
                        return a.element.name === b.name
                    }).length && b
                },
                elements: function() {
                    var b = this,
                        c = {};
                    return a(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, [disabled], [readonly]").not(this.settings.ignore).filter(function() {
                        return !this.name && b.settings.debug && window.console && console.error("%o has no name assigned", this), this.name in c || !b.objectLength(a(this).rules()) ? !1 : (c[this.name] = !0, !0)
                    })
                },
                clean: function(b) {
                    return a(b)[0]
                },
                errors: function() {
                    var b = this.settings.errorClass.split(" ").join(".");
                    return a(this.settings.errorElement + "." + b, this.errorContext)
                },
                reset: function() {
                    this.successList = [], this.errorList = [], this.errorMap = {}, this.toShow = a([]), this.toHide = a([]), this.currentElements = a([])
                },
                prepareForm: function() {
                    this.reset(), this.toHide = this.errors().add(this.containers)
                },
                prepareElement: function(a) {
                    this.reset(), this.toHide = this.errorsFor(a)
                },
                elementValue: function(b) {
                    var c, d = a(b),
                        e = b.type;
                    return "radio" === e || "checkbox" === e ? a("input[name='" + b.name + "']:checked").val() : "number" === e && "undefined" != typeof b.validity ? b.validity.badInput ? !1 : d.val() : (c = d.val(), "string" == typeof c ? c.replace(/\r/g, "") : c)
                },
                check: function(b) {
                    b = this.validationTargetFor(this.clean(b));
                    var c, d, e, f = a(b).rules(),
                        g = a.map(f, function(a, b) {
                            return b
                        }).length,
                        h = !1,
                        i = this.elementValue(b);
                    for (d in f) {
                        e = {
                            method: d,
                            parameters: f[d]
                        };
                        try {
                            if (c = a.validator.methods[d].call(this, i, b, e.parameters), "dependency-mismatch" === c && 1 === g) {
                                h = !0;
                                continue
                            }
                            if (h = !1, "pending" === c) return void(this.toHide = this.toHide.not(this.errorsFor(b)));
                            if (!c) return this.formatAndAdd(b, e), !1
                        } catch (j) {
                            throw this.settings.debug && window.console && console.log("Exception occurred when checking element " + b.id + ", check the '" + e.method + "' method.", j), j
                        }
                    }
                    if (!h) return this.objectLength(f) && this.successList.push(b), !0
                },
                customDataMessage: function(b, c) {
                    return a(b).data("msg" + c.charAt(0).toUpperCase() + c.substring(1).toLowerCase()) || a(b).data("msg")
                },
                customMessage: function(a, b) {
                    var c = this.settings.messages[a];
                    return c && (c.constructor === String ? c : c[b])
                },
                findDefined: function() {
                    for (var a = 0; a < arguments.length; a++)
                        if (void 0 !== arguments[a]) return arguments[a];
                    return void 0
                },
                defaultMessage: function(b, c) {
                    return this.findDefined(this.customMessage(b.name, c), this.customDataMessage(b, c), !this.settings.ignoreTitle && b.title || void 0, a.validator.messages[c], "<strong>Warning: No message defined for " + b.name + "</strong>")
                },
                formatAndAdd: function(b, c) {
                    var d = this.defaultMessage(b, c.method),
                        e = /\$?\{(\d+)\}/g;
                    "function" == typeof d ? d = d.call(this, c.parameters, b) : e.test(d) && (d = a.validator.format(d.replace(e, "{$1}"), c.parameters)), this.errorList.push({
                        message: d,
                        element: b,
                        method: c.method
                    }), this.errorMap[b.name] = d, this.submitted[b.name] = d
                },
                addWrapper: function(a) {
                    return this.settings.wrapper && (a = a.add(a.parent(this.settings.wrapper))), a
                },
                defaultShowErrors: function() {
                    var a, b, c;
                    for (a = 0; this.errorList[a]; a++) c = this.errorList[a], this.settings.highlight && this.settings.highlight.call(this, c.element, this.settings.errorClass, this.settings.validClass), this.showLabel(c.element, c.message);
                    if (this.errorList.length && (this.toShow = this.toShow.add(this.containers)), this.settings.success)
                        for (a = 0; this.successList[a]; a++) this.showLabel(this.successList[a]);
                    if (this.settings.unhighlight)
                        for (a = 0, b = this.validElements(); b[a]; a++) this.settings.unhighlight.call(this, b[a], this.settings.errorClass, this.settings.validClass);
                    this.toHide = this.toHide.not(this.toShow), this.hideErrors(), this.addWrapper(this.toShow).show()
                },
                validElements: function() {
                    return this.currentElements.not(this.invalidElements())
                },
                invalidElements: function() {
                    return a(this.errorList).map(function() {
                        return this.element
                    })
                },
                showLabel: function(b, c) {
                    var d, e, f, g = this.errorsFor(b),
                        h = this.idOrName(b),
                        i = a(b).attr("aria-describedby");
                    g.length ? (g.removeClass(this.settings.validClass).addClass(this.settings.errorClass), g.html(c)) : (g = a("<" + this.settings.errorElement + ">").attr("id", h + "-error").addClass(this.settings.errorClass).html(c || ""), d = g, this.settings.wrapper && (d = g.hide().show().wrap("<" + this.settings.wrapper + "/>").parent()), this.labelContainer.length ? this.labelContainer.append(d) : this.settings.errorPlacement ? this.settings.errorPlacement(d, a(b)) : d.insertAfter(b), g.is("label") ? g.attr("for", h) : 0 === g.parents("label[for='" + h + "']").length && (f = g.attr("id").replace(/(:|\.|\[|\])/g, "\\$1"), i ? i.match(new RegExp("\\b" + f + "\\b")) || (i += " " + f) : i = f, a(b).attr("aria-describedby", i), e = this.groups[b.name], e && a.each(this.groups, function(b, c) {
                        c === e && a("[name='" + b + "']", this.currentForm).attr("aria-describedby", g.attr("id"))
                    }))), !c && this.settings.success && (g.text(""), "string" == typeof this.settings.success ? g.addClass(this.settings.success) : this.settings.success(g, b)), this.toShow = this.toShow.add(g)
                },
                errorsFor: function(b) {
                    var c = this.idOrName(b),
                        d = a(b).attr("aria-describedby"),
                        e = "label[for='" + c + "'], label[for='" + c + "'] *";
                    return d && (e = e + ", #" + d.replace(/\s+/g, ", #")), this.errors().filter(e)
                },
                idOrName: function(a) {
                    return this.groups[a.name] || (this.checkable(a) ? a.name : a.id || a.name)
                },
                validationTargetFor: function(b) {
                    return this.checkable(b) && (b = this.findByName(b.name)), a(b).not(this.settings.ignore)[0]
                },
                checkable: function(a) {
                    return /radio|checkbox/i.test(a.type)
                },
                findByName: function(b) {
                    return a(this.currentForm).find("[name='" + b + "']")
                },
                getLength: function(b, c) {
                    switch (c.nodeName.toLowerCase()) {
                        case "select":
                            return a("option:selected", c).length;
                        case "input":
                            if (this.checkable(c)) return this.findByName(c.name).filter(":checked").length
                    }
                    return b.length
                },
                depend: function(a, b) {
                    return this.dependTypes[typeof a] ? this.dependTypes[typeof a](a, b) : !0
                },
                dependTypes: {
                    "boolean": function(a) {
                        return a
                    },
                    string: function(b, c) {
                        return !!a(b, c.form).length
                    },
                    "function": function(a, b) {
                        return a(b)
                    }
                },
                optional: function(b) {
                    var c = this.elementValue(b);
                    return !a.validator.methods.required.call(this, c, b) && "dependency-mismatch"
                },
                startRequest: function(a) {
                    this.pending[a.name] || (this.pendingRequest++, this.pending[a.name] = !0)
                },
                stopRequest: function(b, c) {
                    this.pendingRequest--, this.pendingRequest < 0 && (this.pendingRequest = 0), delete this.pending[b.name], c && 0 === this.pendingRequest && this.formSubmitted && this.form() ? (a(this.currentForm).submit(), this.formSubmitted = !1) : !c && 0 === this.pendingRequest && this.formSubmitted && (a(this.currentForm).triggerHandler("invalid-form", [this]), this.formSubmitted = !1)
                },
                previousValue: function(b) {
                    return a.data(b, "previousValue") || a.data(b, "previousValue", {
                        old: null,
                        valid: !0,
                        message: this.defaultMessage(b, "remote")
                    })
                }
            },
            classRuleSettings: {
                required: {
                    required: !0
                },
                email: {
                    email: !0
                },
                url: {
                    url: !0
                },
                date: {
                    date: !0
                },
                dateISO: {
                    dateISO: !0
                },
                number: {
                    number: !0
                },
                digits: {
                    digits: !0
                },
                creditcard: {
                    creditcard: !0
                }
            },
            addClassRules: function(b, c) {
                b.constructor === String ? this.classRuleSettings[b] = c : a.extend(this.classRuleSettings, b)
            },
            classRules: function(b) {
                var c = {},
                    d = a(b).attr("class");
                return d && a.each(d.split(" "), function() {
                    this in a.validator.classRuleSettings && a.extend(c, a.validator.classRuleSettings[this])
                }), c
            },
            attributeRules: function(b) {
                var c, d, e = {},
                    f = a(b),
                    g = b.getAttribute("type");
                for (c in a.validator.methods) "required" === c ? (d = b.getAttribute(c), "" === d && (d = !0), d = !!d) : d = f.attr(c), /min|max/.test(c) && (null === g || /number|range|text/.test(g)) && (d = Number(d)), d || 0 === d ? e[c] = d : g === c && "range" !== g && (e[c] = !0);
                return e.maxlength && /-1|2147483647|524288/.test(e.maxlength) && delete e.maxlength, e
            },
            dataRules: function(b) {
                var c, d, e = {},
                    f = a(b);
                for (c in a.validator.methods) d = f.data("rule" + c.charAt(0).toUpperCase() + c.substring(1).toLowerCase()), void 0 !== d && (e[c] = d);
                return e
            },
            staticRules: function(b) {
                var c = {},
                    d = a.data(b.form, "validator");
                return d.settings.rules && (c = a.validator.normalizeRule(d.settings.rules[b.name]) || {}), c
            },
            normalizeRules: function(b, c) {
                return a.each(b, function(d, e) {
                    if (e === !1) return void delete b[d];
                    if (e.param || e.depends) {
                        var f = !0;
                        switch (typeof e.depends) {
                            case "string":
                                f = !!a(e.depends, c.form).length;
                                break;
                            case "function":
                                f = e.depends.call(c, c)
                        }
                        f ? b[d] = void 0 !== e.param ? e.param : !0 : delete b[d]
                    }
                }), a.each(b, function(d, e) {
                    b[d] = a.isFunction(e) ? e(c) : e
                }), a.each(["minlength", "maxlength"], function() {
                    b[this] && (b[this] = Number(b[this]))
                }), a.each(["rangelength", "range"], function() {
                    var c;
                    b[this] && (a.isArray(b[this]) ? b[this] = [Number(b[this][0]), Number(b[this][1])] : "string" == typeof b[this] && (c = b[this].replace(/[\[\]]/g, "").split(/[\s,]+/), b[this] = [Number(c[0]), Number(c[1])]))
                }), a.validator.autoCreateRanges && (null != b.min && null != b.max && (b.range = [b.min, b.max], delete b.min, delete b.max), null != b.minlength && null != b.maxlength && (b.rangelength = [b.minlength, b.maxlength], delete b.minlength, delete b.maxlength)), b
            },
            normalizeRule: function(b) {
                if ("string" == typeof b) {
                    var c = {};
                    a.each(b.split(/\s/), function() {
                        c[this] = !0
                    }), b = c
                }
                return b
            },
            addMethod: function(b, c, d) {
                a.validator.methods[b] = c, a.validator.messages[b] = void 0 !== d ? d : a.validator.messages[b], c.length < 3 && a.validator.addClassRules(b, a.validator.normalizeRule(b))
            },
            methods: {
                required: function(b, c, d) {
                    if (!this.depend(d, c)) return "dependency-mismatch";
                    if ("select" === c.nodeName.toLowerCase()) {
                        var e = a(c).val();
                        return e && e.length > 0
                    }
                    return this.checkable(c) ? this.getLength(b, c) > 0 : a.trim(b).length > 0
                },
                email: function(a, b) {
                    return this.optional(b) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)
                },
                url: function(a, b) {
                    return this.optional(b) || /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(a)
                },
                date: function(a, b) {
                    return this.optional(b) || !/Invalid|NaN/.test(new Date(a).toString())
                },
                dateISO: function(a, b) {
                    return this.optional(b) || /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(a)
                },
                number: function(a, b) {
                    return this.optional(b) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)
                },
                digits: function(a, b) {
                    return this.optional(b) || /^\d+$/.test(a)
                },
                creditcard: function(a, b) {
                    if (this.optional(b)) return "dependency-mismatch";
                    if (/[^0-9 \-]+/.test(a)) return !1;
                    var c, d, e = 0,
                        f = 0,
                        g = !1;
                    if (a = a.replace(/\D/g, ""), a.length < 13 || a.length > 19) return !1;
                    for (c = a.length - 1; c >= 0; c--) d = a.charAt(c), f = parseInt(d, 10), g && (f *= 2) > 9 && (f -= 9), e += f, g = !g;
                    return e % 10 === 0
                },
                minlength: function(b, c, d) {
                    var e = a.isArray(b) ? b.length : this.getLength(b, c);
                    return this.optional(c) || e >= d
                },
                maxlength: function(b, c, d) {
                    var e = a.isArray(b) ? b.length : this.getLength(b, c);
                    return this.optional(c) || d >= e
                },
                rangelength: function(b, c, d) {
                    var e = a.isArray(b) ? b.length : this.getLength(b, c);
                    return this.optional(c) || e >= d[0] && e <= d[1]
                },
                min: function(a, b, c) {
                    return this.optional(b) || a >= c
                },
                max: function(a, b, c) {
                    return this.optional(b) || c >= a
                },
                range: function(a, b, c) {
                    return this.optional(b) || a >= c[0] && a <= c[1]
                },
                equalTo: function(b, c, d) {
                    var e = a(d);
                    return this.settings.onfocusout && e.unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
                        a(c).valid()
                    }), b === e.val()
                },
                remote: function(b, c, d) {
                    if (this.optional(c)) return "dependency-mismatch";
                    var e, f, g = this.previousValue(c);
                    return this.settings.messages[c.name] || (this.settings.messages[c.name] = {}), g.originalMessage = this.settings.messages[c.name].remote, this.settings.messages[c.name].remote = g.message, d = "string" == typeof d && {
                        url: d
                    } || d, g.old === b ? g.valid : (g.old = b, e = this, this.startRequest(c), f = {}, f[c.name] = b, a.ajax(a.extend(!0, {
                        url: d,
                        mode: "abort",
                        port: "validate" + c.name,
                        dataType: "json",
                        data: f,
                        context: e.currentForm,
                        success: function(d) {
                            var f, h, i, j = d === !0 || "true" === d;
                            e.settings.messages[c.name].remote = g.originalMessage, j ? (i = e.formSubmitted, e.prepareElement(c), e.formSubmitted = i, e.successList.push(c), delete e.invalid[c.name], e.showErrors()) : (f = {}, h = d || e.defaultMessage(c, "remote"), f[c.name] = g.message = a.isFunction(h) ? h(b) : h, e.invalid[c.name] = !0, e.showErrors(f)), g.valid = j, e.stopRequest(c, j)
                        }
                    }, d)), "pending")
                }
            }
        }), a.format = function() {
            throw "$.format has been deprecated. Please use $.validator.format instead."
        };
        var b, c = {};
        a.ajaxPrefilter ? a.ajaxPrefilter(function(a, b, d) {
            var e = a.port;
            "abort" === a.mode && (c[e] && c[e].abort(), c[e] = d)
        }) : (b = a.ajax, a.ajax = function(d) {
            var e = ("mode" in d ? d : a.ajaxSettings).mode,
                f = ("port" in d ? d : a.ajaxSettings).port;
            return "abort" === e ? (c[f] && c[f].abort(), c[f] = b.apply(this, arguments), c[f]) : b.apply(this, arguments)
        }), a.extend(a.fn, {
            validateDelegate: function(b, c, d) {
                return this.bind(c, function(c) {
                    var e = a(c.target);
                    return e.is(b) ? d.apply(e, arguments) : void 0
                })
            }
        })
    }), ! function(a) {
        "function" == typeof define && define.amd ? define(["jquery", "./jquery.validate.min"], a) : a(jQuery)
    }(function(a) {
        ! function() {
            function b(a) {
                return a.replace(/<.[^<>]*?>/g, " ").replace(/&nbsp;|&#160;/gi, " ").replace(/[.(),;:!?%#$'\"_+=\/\-“”’]*/g, "")
            }
            a.validator.addMethod("maxWords", function(a, c, d) {
                return this.optional(c) || b(a).match(/\b\w+\b/g).length <= d
            }, a.validator.format("Please enter {0} words or less.")), a.validator.addMethod("minWords", function(a, c, d) {
                return this.optional(c) || b(a).match(/\b\w+\b/g).length >= d
            }, a.validator.format("Please enter at least {0} words.")), a.validator.addMethod("rangeWords", function(a, c, d) {
                var e = b(a),
                    f = /\b\w+\b/g;
                return this.optional(c) || e.match(f).length >= d[0] && e.match(f).length <= d[1]
            }, a.validator.format("Please enter between {0} and {1} words."))
        }(), a.validator.addMethod("accept", function(b, c, d) {
            var e, f, g = "string" == typeof d ? d.replace(/\s/g, "").replace(/,/g, "|") : "image/*",
                h = this.optional(c);
            if (h) return h;
            if ("file" === a(c).attr("type") && (g = g.replace(/\*/g, ".*"), c.files && c.files.length))
                for (e = 0; e < c.files.length; e++)
                    if (f = c.files[e], !f.type.match(new RegExp(".?(" + g + ")$", "i"))) return !1;
            return !0
        }, a.validator.format("Please enter a value with a valid mimetype.")), a.validator.addMethod("alphanumeric", function(a, b) {
            return this.optional(b) || /^\w+$/i.test(a)
        }, "Letters, numbers, and underscores only please"), a.validator.addMethod("bankaccountNL", function(a, b) {
            if (this.optional(b)) return !0;
            if (!/^[0-9]{9}|([0-9]{2} ){3}[0-9]{3}$/.test(a)) return !1;
            var c, d, e, f = a.replace(/ /g, ""),
                g = 0,
                h = f.length;
            for (c = 0; h > c; c++) d = h - c, e = f.substring(c, c + 1), g += d * e;
            return g % 11 === 0
        }, "Please specify a valid bank account number"), a.validator.addMethod("bankorgiroaccountNL", function(b, c) {
            return this.optional(c) || a.validator.methods.bankaccountNL.call(this, b, c) || a.validator.methods.giroaccountNL.call(this, b, c)
        }, "Please specify a valid bank or giro account number"), a.validator.addMethod("bic", function(a, b) {
            return this.optional(b) || /^([A-Z]{6}[A-Z2-9][A-NP-Z1-2])(X{3}|[A-WY-Z0-9][A-Z0-9]{2})?$/.test(a)
        }, "Please specify a valid BIC code"), a.validator.addMethod("cifES", function(a) {
            "use strict";
            var b, c, d, e, f, g, h = [];
            if (a = a.toUpperCase(), !a.match("((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)")) return !1;
            for (d = 0; 9 > d; d++) h[d] = parseInt(a.charAt(d), 10);
            for (c = h[2] + h[4] + h[6], e = 1; 8 > e; e += 2) f = (2 * h[e]).toString(), g = f.charAt(1), c += parseInt(f.charAt(0), 10) + ("" === g ? 0 : parseInt(g, 10));
            return /^[ABCDEFGHJNPQRSUVW]{1}/.test(a) ? (c += "", b = 10 - parseInt(c.charAt(c.length - 1), 10), a += b, h[8].toString() === String.fromCharCode(64 + b) || h[8].toString() === a.charAt(a.length - 1)) : !1
        }, "Please specify a valid CIF number."), a.validator.addMethod("creditcardtypes", function(a, b, c) {
            if (/[^0-9\-]+/.test(a)) return !1;
            a = a.replace(/\D/g, "");
            var d = 0;
            return c.mastercard && (d |= 1), c.visa && (d |= 2), c.amex && (d |= 4), c.dinersclub && (d |= 8), c.enroute && (d |= 16), c.discover && (d |= 32), c.jcb && (d |= 64), c.unknown && (d |= 128), c.all && (d = 255), 1 & d && /^(5[12345])/.test(a) ? 16 === a.length : 2 & d && /^(4)/.test(a) ? 16 === a.length : 4 & d && /^(3[47])/.test(a) ? 15 === a.length : 8 & d && /^(3(0[012345]|[68]))/.test(a) ? 14 === a.length : 16 & d && /^(2(014|149))/.test(a) ? 15 === a.length : 32 & d && /^(6011)/.test(a) ? 16 === a.length : 64 & d && /^(3)/.test(a) ? 16 === a.length : 64 & d && /^(2131|1800)/.test(a) ? 15 === a.length : 128 & d ? !0 : !1
        }, "Please enter a valid credit card number."), a.validator.addMethod("currency", function(a, b, c) {
            var d, e = "string" == typeof c,
                f = e ? c : c[0],
                g = e ? !0 : c[1];
            return f = f.replace(/,/g, ""), f = g ? f + "]" : f + "]?", d = "^[" + f + "([1-9]{1}[0-9]{0,2}(\\,[0-9]{3})*(\\.[0-9]{0,2})?|[1-9]{1}[0-9]{0,}(\\.[0-9]{0,2})?|0(\\.[0-9]{0,2})?|(\\.[0-9]{1,2})?)$", d = new RegExp(d), this.optional(b) || d.test(a)
        }, "Please specify a valid currency"), a.validator.addMethod("dateFA", function(a, b) {
            return this.optional(b) || /^[1-4]\d{3}\/((0?[1-6]\/((3[0-1])|([1-2][0-9])|(0?[1-9])))|((1[0-2]|(0?[7-9]))\/(30|([1-2][0-9])|(0?[1-9]))))$/.test(a)
        }, "Please enter a correct date"), a.validator.addMethod("dateITA", function(a, b) {
            var c, d, e, f, g, h = !1,
                i = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
            return i.test(a) ? (c = a.split("/"), d = parseInt(c[0], 10), e = parseInt(c[1], 10), f = parseInt(c[2], 10), g = new Date(f, e - 1, d, 12, 0, 0, 0), h = g.getUTCFullYear() === f && g.getUTCMonth() === e - 1 && g.getUTCDate() === d ? !0 : !1) : h = !1, this.optional(b) || h
        }, "Please enter a correct date"), a.validator.addMethod("dateNL", function(a, b) {
            return this.optional(b) || /^(0?[1-9]|[12]\d|3[01])[\.\/\-](0?[1-9]|1[012])[\.\/\-]([12]\d)?(\d\d)$/.test(a)
        }, "Please enter a correct date"), a.validator.addMethod("extension", function(a, b, c) {
            return c = "string" == typeof c ? c.replace(/,/g, "|") : "png|jpe?g|gif", this.optional(b) || a.match(new RegExp(".(" + c + ")$", "i"))
        }, a.validator.format("Please enter a value with a valid extension.")), a.validator.addMethod("giroaccountNL", function(a, b) {
            return this.optional(b) || /^[0-9]{1,7}$/.test(a)
        }, "Please specify a valid giro account number"), a.validator.addMethod("iban", function(a, b) {
            if (this.optional(b)) return !0;
            var c, d, e, f, g, h, i, j, k, l = a.replace(/ /g, "").toUpperCase(),
                m = "",
                n = !0,
                o = "",
                p = "";
            if (!/^([a-zA-Z0-9]{4} ){2,8}[a-zA-Z0-9]{1,4}|[a-zA-Z0-9]{12,34}$/.test(l)) return !1;
            if (c = l.substring(0, 2), h = {
                    AL: "\\d{8}[\\dA-Z]{16}",
                    AD: "\\d{8}[\\dA-Z]{12}",
                    AT: "\\d{16}",
                    AZ: "[\\dA-Z]{4}\\d{20}",
                    BE: "\\d{12}",
                    BH: "[A-Z]{4}[\\dA-Z]{14}",
                    BA: "\\d{16}",
                    BR: "\\d{23}[A-Z][\\dA-Z]",
                    BG: "[A-Z]{4}\\d{6}[\\dA-Z]{8}",
                    CR: "\\d{17}",
                    HR: "\\d{17}",
                    CY: "\\d{8}[\\dA-Z]{16}",
                    CZ: "\\d{20}",
                    DK: "\\d{14}",
                    DO: "[A-Z]{4}\\d{20}",
                    EE: "\\d{16}",
                    FO: "\\d{14}",
                    FI: "\\d{14}",
                    FR: "\\d{10}[\\dA-Z]{11}\\d{2}",
                    GE: "[\\dA-Z]{2}\\d{16}",
                    DE: "\\d{18}",
                    GI: "[A-Z]{4}[\\dA-Z]{15}",
                    GR: "\\d{7}[\\dA-Z]{16}",
                    GL: "\\d{14}",
                    GT: "[\\dA-Z]{4}[\\dA-Z]{20}",
                    HU: "\\d{24}",
                    IS: "\\d{22}",
                    IE: "[\\dA-Z]{4}\\d{14}",
                    IL: "\\d{19}",
                    IT: "[A-Z]\\d{10}[\\dA-Z]{12}",
                    KZ: "\\d{3}[\\dA-Z]{13}",
                    KW: "[A-Z]{4}[\\dA-Z]{22}",
                    LV: "[A-Z]{4}[\\dA-Z]{13}",
                    LB: "\\d{4}[\\dA-Z]{20}",
                    LI: "\\d{5}[\\dA-Z]{12}",
                    LT: "\\d{16}",
                    LU: "\\d{3}[\\dA-Z]{13}",
                    MK: "\\d{3}[\\dA-Z]{10}\\d{2}",
                    MT: "[A-Z]{4}\\d{5}[\\dA-Z]{18}",
                    MR: "\\d{23}",
                    MU: "[A-Z]{4}\\d{19}[A-Z]{3}",
                    MC: "\\d{10}[\\dA-Z]{11}\\d{2}",
                    MD: "[\\dA-Z]{2}\\d{18}",
                    ME: "\\d{18}",
                    NL: "[A-Z]{4}\\d{10}",
                    NO: "\\d{11}",
                    PK: "[\\dA-Z]{4}\\d{16}",
                    PS: "[\\dA-Z]{4}\\d{21}",
                    PL: "\\d{24}",
                    PT: "\\d{21}",
                    RO: "[A-Z]{4}[\\dA-Z]{16}",
                    SM: "[A-Z]\\d{10}[\\dA-Z]{12}",
                    SA: "\\d{2}[\\dA-Z]{18}",
                    RS: "\\d{18}",
                    SK: "\\d{20}",
                    SI: "\\d{15}",
                    ES: "\\d{20}",
                    SE: "\\d{20}",
                    CH: "\\d{5}[\\dA-Z]{12}",
                    TN: "\\d{20}",
                    TR: "\\d{5}[\\dA-Z]{17}",
                    AE: "\\d{3}\\d{16}",
                    GB: "[A-Z]{4}\\d{14}",
                    VG: "[\\dA-Z]{4}\\d{16}"
                }, g = h[c], "undefined" != typeof g && (i = new RegExp("^[A-Z]{2}\\d{2}" + g + "$", ""), !i.test(l))) return !1;
            for (d = l.substring(4, l.length) + l.substring(0, 4), j = 0; j < d.length; j++) e = d.charAt(j), "0" !== e && (n = !1), n || (m += "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ".indexOf(e));
            for (k = 0; k < m.length; k++) f = m.charAt(k), p = "" + o + f, o = p % 97;
            return 1 === o
        }, "Please specify a valid IBAN"), a.validator.addMethod("integer", function(a, b) {
            return this.optional(b) || /^-?\d+$/.test(a)
        }, "A positive or negative non-decimal number please"), a.validator.addMethod("ipv4", function(a, b) {
            return this.optional(b) || /^(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)\.(25[0-5]|2[0-4]\d|[01]?\d\d?)$/i.test(a)
        }, "Please enter a valid IP v4 address."), a.validator.addMethod("ipv6", function(a, b) {
            return this.optional(b) || /^((([0-9A-Fa-f]{1,4}:){7}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}:[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){5}:([0-9A-Fa-f]{1,4}:)?[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){4}:([0-9A-Fa-f]{1,4}:){0,2}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){3}:([0-9A-Fa-f]{1,4}:){0,3}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){2}:([0-9A-Fa-f]{1,4}:){0,4}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){6}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(([0-9A-Fa-f]{1,4}:){0,5}:((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|(::([0-9A-Fa-f]{1,4}:){0,5}((\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b)\.){3}(\b((25[0-5])|(1\d{2})|(2[0-4]\d)|(\d{1,2}))\b))|([0-9A-Fa-f]{1,4}::([0-9A-Fa-f]{1,4}:){0,5}[0-9A-Fa-f]{1,4})|(::([0-9A-Fa-f]{1,4}:){0,6}[0-9A-Fa-f]{1,4})|(([0-9A-Fa-f]{1,4}:){1,7}:))$/i.test(a)
        }, "Please enter a valid IP v6 address."), a.validator.addMethod("lettersonly", function(a, b) {
            return this.optional(b) || /^[a-z]+$/i.test(a)
        }, "Letters only please"), a.validator.addMethod("letterswithbasicpunc", function(a, b) {
            return this.optional(b) || /^[a-z\-.,()'"\s]+$/i.test(a)
        }, "Letters or punctuation only please"), a.validator.addMethod("mobileNL", function(a, b) {
            return this.optional(b) || /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)6((\s|\s?\-\s?)?[0-9]){8}$/.test(a)
        }, "Please specify a valid mobile number"), a.validator.addMethod("mobileUK", function(a, b) {
            return a = a.replace(/\(|\)|\s+|-/g, ""), this.optional(b) || a.length > 9 && a.match(/^(?:(?:(?:00\s?|\+)44\s?|0)7(?:[1345789]\d{2}|624)\s?\d{3}\s?\d{3})$/)
        }, "Please specify a valid mobile number"), a.validator.addMethod("nieES", function(a) {
            "use strict";
            return a = a.toUpperCase(), a.match("((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)") ? /^[T]{1}/.test(a) ? a[8] === /^[T]{1}[A-Z0-9]{8}$/.test(a) : /^[XYZ]{1}/.test(a) ? a[8] === "TRWAGMYFPDXBNJZSQVHLCKE".charAt(a.replace("X", "0").replace("Y", "1").replace("Z", "2").substring(0, 8) % 23) : !1 : !1
        }, "Please specify a valid NIE number."), a.validator.addMethod("nifES", function(a) {
            "use strict";
            return a = a.toUpperCase(), a.match("((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)") ? /^[0-9]{8}[A-Z]{1}$/.test(a) ? "TRWAGMYFPDXBNJZSQVHLCKE".charAt(a.substring(8, 0) % 23) === a.charAt(8) : /^[KLM]{1}/.test(a) ? a[8] === String.fromCharCode(64) : !1 : !1
        }, "Please specify a valid NIF number."), a.validator.addMethod("nowhitespace", function(a, b) {
            return this.optional(b) || /^\S+$/i.test(a)
        }, "No white space please"), a.validator.addMethod("pattern", function(a, b, c) {
            return this.optional(b) ? !0 : ("string" == typeof c && (c = new RegExp("^(?:" + c + ")$")), c.test(a))
        }, "Invalid format."), a.validator.addMethod("phoneNL", function(a, b) {
            return this.optional(b) || /^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9]){8}$/.test(a)
        }, "Please specify a valid phone number."), a.validator.addMethod("phoneUK", function(a, b) {
            return a = a.replace(/\(|\)|\s+|-/g, ""), this.optional(b) || a.length > 9 && a.match(/^(?:(?:(?:00\s?|\+)44\s?)|(?:\(?0))(?:\d{2}\)?\s?\d{4}\s?\d{4}|\d{3}\)?\s?\d{3}\s?\d{3,4}|\d{4}\)?\s?(?:\d{5}|\d{3}\s?\d{3})|\d{5}\)?\s?\d{4,5})$/)
        }, "Please specify a valid phone number"), a.validator.addMethod("phoneUS", function(a, b) {
            return a = a.replace(/\s+/g, ""), this.optional(b) || a.length > 9 && a.match(/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/)
        }, "Please specify a valid phone number"), a.validator.addMethod("phonesUK", function(a, b) {
            return a = a.replace(/\(|\)|\s+|-/g, ""), this.optional(b) || a.length > 9 && a.match(/^(?:(?:(?:00\s?|\+)44\s?|0)(?:1\d{8,9}|[23]\d{9}|7(?:[1345789]\d{8}|624\d{6})))$/)
        }, "Please specify a valid uk phone number"), a.validator.addMethod("postalCodeCA", function(a, b) {
            return this.optional(b) || /^[ABCEGHJKLMNPRSTVXY]\d[A-Z] \d[A-Z]\d$/.test(a)
        }, "Please specify a valid postal code"), a.validator.addMethod("postalcodeBR", function(a, b) {
            return this.optional(b) || /^\d{2}.\d{3}-\d{3}?$|^\d{5}-?\d{3}?$/.test(a)
        }, "Informe um CEP válido."), a.validator.addMethod("postalcodeIT", function(a, b) {
            return this.optional(b) || /^\d{5}$/.test(a)
        }, "Please specify a valid postal code"), a.validator.addMethod("postalcodeNL", function(a, b) {
            return this.optional(b) || /^[1-9][0-9]{3}\s?[a-zA-Z]{2}$/.test(a)
        }, "Please specify a valid postal code"), a.validator.addMethod("postcodeUK", function(a, b) {
            return this.optional(b) || /^((([A-PR-UWYZ][0-9])|([A-PR-UWYZ][0-9][0-9])|([A-PR-UWYZ][A-HK-Y][0-9])|([A-PR-UWYZ][A-HK-Y][0-9][0-9])|([A-PR-UWYZ][0-9][A-HJKSTUW])|([A-PR-UWYZ][A-HK-Y][0-9][ABEHMNPRVWXY]))\s?([0-9][ABD-HJLNP-UW-Z]{2})|(GIR)\s?(0AA))$/i.test(a)
        }, "Please specify a valid UK postcode"), a.validator.addMethod("require_from_group", function(b, c, d) {
            var e = a(d[1], c.form),
                f = e.eq(0),
                g = f.data("valid_req_grp") ? f.data("valid_req_grp") : a.extend({}, this),
                h = e.filter(function() {
                    return g.elementValue(this)
                }).length >= d[0];
            return f.data("valid_req_grp", g), a(c).data("being_validated") || (e.data("being_validated", !0), e.each(function() {
                g.element(this)
            }), e.data("being_validated", !1)), h
        }, a.validator.format("Please fill at least {0} of these fields.")), a.validator.addMethod("skip_or_fill_minimum", function(b, c, d) {
            var e = a(d[1], c.form),
                f = e.eq(0),
                g = f.data("valid_skip") ? f.data("valid_skip") : a.extend({}, this),
                h = e.filter(function() {
                    return g.elementValue(this)
                }).length,
                i = 0 === h || h >= d[0];
            return f.data("valid_skip", g), a(c).data("being_validated") || (e.data("being_validated", !0), e.each(function() {
                g.element(this)
            }), e.data("being_validated", !1)), i
        }, a.validator.format("Please either skip these fields or fill at least {0} of them.")), jQuery.validator.addMethod("stateUS", function(a, b, c) {
            var d, e = "undefined" == typeof c,
                f = e || "undefined" == typeof c.caseSensitive ? !1 : c.caseSensitive,
                g = e || "undefined" == typeof c.includeTerritories ? !1 : c.includeTerritories,
                h = e || "undefined" == typeof c.includeMilitary ? !1 : c.includeMilitary;
            return d = g || h ? g && h ? "^(A[AEKLPRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$" : g ? "^(A[KLRSZ]|C[AOT]|D[CE]|FL|G[AU]|HI|I[ADLN]|K[SY]|LA|M[ADEINOPST]|N[CDEHJMVY]|O[HKR]|P[AR]|RI|S[CD]|T[NX]|UT|V[AIT]|W[AIVY])$" : "^(A[AEKLPRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$" : "^(A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])$", d = f ? new RegExp(d) : new RegExp(d, "i"), this.optional(b) || d.test(a)
        }, "Please specify a valid state"), a.validator.addMethod("strippedminlength", function(b, c, d) {
            return a(b).text().length >= d
        }, a.validator.format("Please enter at least {0} characters")), a.validator.addMethod("time", function(a, b) {
            return this.optional(b) || /^([01]\d|2[0-3])(:[0-5]\d){1,2}$/.test(a)
        }, "Please enter a valid time, between 00:00 and 23:59"), a.validator.addMethod("time12h", function(a, b) {
            return this.optional(b) || /^((0?[1-9]|1[012])(:[0-5]\d){1,2}(\ ?[AP]M))$/i.test(a)
        }, "Please enter a valid time in 12-hour am/pm format"), a.validator.addMethod("url2", function(a, b) {
            return this.optional(b) || /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(a)
        }, a.validator.messages.url), a.validator.addMethod("vinUS", function(a) {
            if (17 !== a.length) return !1;
            var b, c, d, e, f, g, h = ["A", "B", "C", "D", "E", "F", "G", "H", "J", "K", "L", "M", "N", "P", "R", "S", "T", "U", "V", "W", "X", "Y", "Z"],
                i = [1, 2, 3, 4, 5, 6, 7, 8, 1, 2, 3, 4, 5, 7, 9, 2, 3, 4, 5, 6, 7, 8, 9],
                j = [8, 7, 6, 5, 4, 3, 2, 10, 0, 9, 8, 7, 6, 5, 4, 3, 2],
                k = 0;
            for (b = 0; 17 > b; b++) {
                if (e = j[b], d = a.slice(b, b + 1), 8 === b && (g = d), isNaN(d)) {
                    for (c = 0; c < h.length; c++)
                        if (d.toUpperCase() === h[c]) {
                            d = i[c], d *= e, isNaN(g) && 8 === c && (g = h[c]);
                            break
                        }
                } else d *= e;
                k += d
            }
            return f = k % 11, 10 === f && (f = "X"), f === g ? !0 : !1
        }, "The specified vehicle identification number (VIN) is invalid."), a.validator.addMethod("zipcodeUS", function(a, b) {
            return this.optional(b) || /^\d{5}(-\d{4})?$/.test(a)
        }, "The specified US ZIP Code is invalid"), a.validator.addMethod("ziprange", function(a, b) {
            return this.optional(b) || /^90[2-5]\d\{2\}-\d{4}$/.test(a)
        }, "Your ZIP-code must be in the range 902xx-xxxx to 905xx-xxxx")
    }), function(a) {
        a.supr = function(b, d) {
            var e = {
                    customScroll: {
                        color: "#fff",
                        rscolor: "#fff",
                        size: "3px",
                        opacity: "1",
                        alwaysVisible: !1
                    },
                    header: {
                        fixed: !0,
                        shrink: !0
                    },
                    breadcrumbs: {
                        auto: !0,
                        homeicon: "s16 icomoon-icon-screen-2",
                        dividerIcon: "s16 icomoon-icon-arrow-right-3"
                    },
                    sidebar: {
                        fixed: !0,
                        rememberToggle: !0,
                        offCanvas: !0
                    },
                    rightSidebar: {
                        fixed: !0,
                        rememberToggle: !0
                    },
                    sideNav: {
                        toggleMode: !0,
                        showArrows: !0,
                        sideNavArrowIcon: "icomoon-icon-arrow-down-2 s16",
                        subOpenSpeed: 300,
                        subCloseSpeed: 400,
                        animationEasing: "linear",
                        absoluteUrl: !1,
                        subDir: ""
                    },
                    panels: {
                        refreshIcon: "im-spinner6",
                        toggleIcon: "im-minus",
                        collapseIcon: "im-plus",
                        closeIcon: "im-close",
                        showControlsOnHover: !0,
                        loadingEffect: "facebook",
                        loaderColor: "#bac3d2",
                        rememberSortablePosition: !0
                    },
                    accordion: {
                        toggleIcon: "l-arrows-minus s16",
                        collapseIcon: "l-arrows-plus s16"
                    },
                    tables: {
                        responsive: !0,
                        customscroll: !0
                    },
                    alerts: {
                        animation: !0,
                        closeEffect: "bounceOutDown"
                    },
                    dropdownMenu: {
                        animation: !0,
                        openEffect: "fadeIn"
                    },
                    backToTop: !0
                },
                f = this;
            f.settings = {};
            var b = (a(b), b);
            f.init = function() {
                if (f.settings = a.extend({}, e, d), this.browserSelector(), this.storejs(), this.firstImpression(), this.mouseWheel(), this.retinaReady(), this.toggleSidebar(), this.sideBarNav(), this.setCurrentNav(), this.waitMe(), this.panels(), this.checkBoxesAndRadios(), this.accordions(), this.quickSearch(), this.equalHeight(), this.respondjs(), f.settings.backToTop && this.backToTop(), f.settings.breadcrumbs.auto && this.breadCrumbs(), a(".modal").on("show.bs.modal", function() {
                        f.centerModal()
                    }), f.settings.dropdownMenu.animation && this.dropdownMenuAnimations(), this.dropdownMenuFix(), this.animatedProgressBars(), f.settings.tables.responsive && this.responsiveTables(), this.emailApp(), this.toDoWidget(), f.settings.header.fixed && 1 == store.get("fixed-header") && this.fixedHeader(!0), f.settings.header.shrink && this.shrinkHeader(), f.settings.sidebar.fixed && 1 == store.get("fixed-left-sidebar") && this.fixedSidebar("left"), f.settings.rightSidebar.fixed && 1 == store.get("fixed-right-sidebar") && this.fixedSidebar("right"), f.settings.sidebar.rememberToggle) {
                    var b = f.getBreakPoint();
                    (1 == store.get("sidebarToggle") && "large" == b || 1 == store.get("sidebarToggle") && "laptop" == b) && (f.toggleLeftSidebar(), f.sideBarNavToggle(), f.collapseSideBarNav(!1), f.removeFixedSidebar("left"))
                }
                if (f.settings.rightSidebar.rememberToggle) {
                    var b = f.getBreakPoint();
                    (1 == store.get("rightSidebarToggle") && "large" == b || 1 == store.get("rightSidebarToggle") && "laptop" == b) && (f.toggleRightSidebarBtn("hide"), f.hideRightSidebar()), (1 == store.get("rightSidebarToggle") && "tablet" == b || 1 == store.get("rightSidebarToggle") && "phone" == b) && f.toggleRightSidebarBtn("hide")
                }
                a(window).load(function() {
                    0 == store.get("fixed-header") && 1 == store.get("fixed-right-sidebar") && f.rightSidebarTopPosition(), f.stickyFooter()
                }), a(window).resize(function() {
                    f.centerModal(), f.stickyFooter()
                }), a(window).scroll(function() {
                    0 == store.get("fixed-header") && 1 == store.get("fixed-right-sidebar") && f.rightSidebarTopPosition(), f.stickyFooter()
                })
            }, f.stickyFooter = function() {
                $footer = a("#footer");
                var b = a(".page-content");
                $footer.css(b.height() < a(window).height() ? {
                    position: "absolute"
                } : {
                    position: "static"
                })
            }, f.getBreakPoint = function() {
                var a = jRespond([{
                    label: "phone",
                    enter: 0,
                    exit: 767
                }, {
                    label: "tablet",
                    enter: 768,
                    exit: 979
                }, {
                    label: "laptop",
                    enter: 980,
                    exit: 1366
                }, {
                    label: "large",
                    enter: 1367,
                    exit: 1e4
                }]);
                return a.getBreakpoint()
            }, f.fixedHeader = function(b) {
                var c = a("#header");
                return 1 == b ? (c.addClass("header-fixed"), store.set("fixed-header", 1), a("body").addClass("fixed-header"), !0) : (c.removeClass("header-fixed"), store.set("fixed-header", 0), a("body").removeClass("fixed-header"), !1)
            }, f.fixedSidebar = function(b) {
                var c = a(".page-sidebar"),
                    d = a("#right-sidebar"),
                    e = f.getBreakPoint();
                return "left" !== b || "large" != e && "laptop" != e && c.hasClass("collapse-sidebar") ? "right" !== b || "large" != e && "laptop" != e ? void 0 : (d.addClass("sidebar-fixed"), f.addScrollTo(d.find(".sidebar-scrollarea"), "right", f.settings.customScroll.rscolor), store.set("fixed-right-sidebar", 1), a("body").addClass("fixed-right-sidebar"), !0) : (c.addClass("sidebar-fixed"), f.addScrollTo(c.find(".sidebar-scrollarea"), "right", f.settings.customScroll.color), store.set("fixed-left-sidebar", 1), a("body").addClass("fixed-left-sidebar"), !0)
            }, f.rightSidebarTopPosition = function() {
                var b = a(document).scrollTop();
                b > 49 ? a("#right-sidebar").addClass("rstop") : a("#right-sidebar").removeClass("rstop")
            }, f.addScrollTo = function(a, b, c) {
                a.slimScroll({
                    position: b,
                    height: "100%",
                    distance: "0px",
                    railVisible: !1,
                    size: f.settings.customScroll.size,
                    color: c,
                    railOpacity: f.settings.customScroll.opacity,
                    railColor: f.settings.customScroll.railColor
                })
            }, f.removeScrollTo = function(a) {
                a.parent().hasClass("slimScrollDiv") && (a.parent().replaceWith(a), a.attr("style", ""))
            }, f.removeFixedSidebar = function(b) {
                if ("left" === b) {
                    var c = a("#sidebar .sidebar-scrollarea");
                    a("#sidebar").removeClass("sidebar-fixed"), f.removeScrollTo(c), store.set("fixed-left-sidebar", 0), a("body").removeClass("fixed-left-sidebar")
                }
                if ("right" === b) {
                    var c = a("#right-sidebar .sidebar-scrollarea");
                    a("#right-sidebar").removeClass("sidebar-fixed"), f.removeScrollTo(c), store.set("fixed-right-sidebar", 0), a("body").removeClass("fixed-right-sidebar")
                }
            }, f.toggleRightSidebarBtn = function(b) {
                var c = a("#toggle-right-sidebar");
                "hide" === b && (c.addClass("hide-right-sidebar"), store.set("rightSidebarToggle", 1), c.find("i").removeClass("s16 icomoon-icon-indent-increase").addClass("s16 icomoon-icon-indent-decrease")), "show" === b && (c.removeClass("hide-right-sidebar"), store.set("rightSidebarToggle", 0), c.find("i").removeClass("s16 icomoon-icon-indent-decrease").addClass("s16 icomoon-icon-indent-increase"))
            }, f.toggleSidebar = function() {
                var b = a(".collapseBtn"),
                    c = a("#toggle-right-sidebar"),
                    d = f.getBreakPoint(),
                    e = (a("#sidebar .sidebar-scrollarea"), a(".page-content"), a(".page-sidebar"));
                c.on("click", function(b) {
                    b.preventDefault(), a(this).hasClass("hide-right-sidebar") ? (f.toggleRightSidebarBtn("show"), f.showRightSidebar()) : (f.hideRightSidebar(), f.toggleRightSidebarBtn("hide"))
                }), b.on("click", function(a) {
                    a.preventDefault(), e.hasClass("hide-sidebar") ? f.showLeftSidebar() : e.hasClass("collapse-sidebar") ? (f.unToggleLeftSidebar(), f.collapseSideBarNav(!0)) : "phone" == d ? f.hideLeftSidebar() : (f.toggleLeftSidebar(), f.collapseSideBarNav(!1), f.stickyFooter()), e.hasClass("collapse-sidebar") ? (store.set("sidebarToggle", 1), f.sideBarNavToggle()) : store.set("sidebarToggle", 0)
                })
            }, f.hideRightSidebar = function() {
                var b = f.getBreakPoint();
                a("#right-sidebar").addClass("hide-sidebar"), a("#right-sidebarbg").addClass("hide-sidebar"), a(".page-content, #footer").removeClass("right-sidebar-page"), ("laptop" == b || "tablet" == b || "phone" == b) && a(".page-content").removeClass("rOverLap"), a("#back-to-top").removeClass("rightsidebar")
            }, f.showRightSidebar = function() {
                var b = f.getBreakPoint();
                a("#right-sidebar").removeClass("hide-sidebar"), a("#right-sidebarbg").removeClass("hide-sidebar"), ("laptop" == b || "tablet" == b || "phone" == b) && a(".page-content").addClass("rOverLap"), a(".page-content, #footer").addClass("right-sidebar-page"), a("#back-to-top").addClass("rightsidebar")
            }, f.hideLeftSidebar = function() {
                var b = f.getBreakPoint();
                a(".page-sidebar").addClass("hide-sidebar"), a("#sidebarbg").addClass("hide-sidebar"), a(".page-content, #footer").addClass("full-page"), a(".page-content, #footer").removeClass("sidebar-page"), "phone" != b || f.settings.sidebar.offCanvas || a(".page-content").addClass("overLap"), ("phone" == b && f.settings.sidebar.offCanvas || "tablet" == b && f.settings.sidebar.offCanvas) && a(".page-content, #footer").removeClass("offCanvas")
            }, f.toggleLeftSidebar = function() {
                var b = f.getBreakPoint(),
                    c = a("#sidebar .sidebar-scrollarea");
                f.settings.sidebar.fixed && f.removeScrollTo(c), a(".page-sidebar, #sidebarbg").addClass("collapse-sidebar"), a(".page-content, #footer").addClass("collapsed-sidebar"), a(".page-content, #footer").removeClass("sidebar-page"), "tablet" != b || f.settings.sidebar.offCanvas || a(".page-content, #footer").removeClass("overLap")
            }, f.unToggleLeftSidebar = function() {
                var b = f.getBreakPoint(),
                    c = a("#sidebar .sidebar-scrollarea");
                f.settings.sidebar.fixed && f.addScrollTo(c, "right", f.settings.customScroll.color), a(".page-sidebar, #sidebarbg").removeClass("collapse-sidebar"), a(".page-content, #footer").removeClass("collapsed-sidebar"), a(".page-content, #footer").addClass("sidebar-page"), "tablet" != b || f.settings.sidebar.offCanvas || a(".page-content, #footer").addClass("overLap")
            }, f.showLeftSidebar = function() {
                var b = f.getBreakPoint(),
                    c = a("#sidebar .sidebar-scrollarea");
                f.settings.sidebar.fixed && f.addScrollTo(c), a(".page-sidebar").removeClass("hide-sidebar"), a("#sidebarbg").removeClass("hide-sidebar"), a("#sidebarbg").removeClass("collapse-sidebar"), a(".page-sidebar").removeClass("collapse-sidebar"), a(".page-content, #footer").removeClass("full-page"), ("large" == b || "laptop" == b && !f.settings.sidebar.offCanvas) && a(".page-content, #footer").removeClass("overLap"), "phone" != b || f.settings.sidebar.offCanvas || a(".page-content, #footer").addClass("overLap"), ("phone" == b && f.settings.sidebar.offCanvas || "tablet" == b && f.settings.sidebar.offCanvas) && a(".page-content, #footer").addClass("offCanvas"), a(".page-content, #footer").removeClass("collapsed-sidebar"), a(".page-content, #footer").addClass("sidebar-page")
            }, f.sideBarNav = function() {
                var b = (a(".page-sidebar .sidebar-scrollarea"), a(".mainnav> ul")),
                    c = (b.find("li.current"), b.find("li")),
                    d = b.find("a"),
                    e = b.find("li>ul.sub");
                e.closest("li").addClass("hasSub"), e.prev("a").hasClass("notExpand") || e.prev("a").addClass("notExpand"), f.settings.sideNav.showArrows && (a(".mainnav").hasClass("show-arrows") || a(".mainnav").addClass("show-arrows"), e.prev("a").find("i.hasDrop").length || e.prev("a").prepend('<i class="' + f.settings.sideNav.sideNavArrowIcon + ' hasDrop"></i>')), d.on("click", function(d) {
                    var e = a(this);
                    e.hasClass("notExpand") ? (d.preventDefault(), a(".page-sidebar").hasClass("collapse-sidebar") || (a(this).closest("li").closest("ul").hasClass("show") ? (e.next("ul").slideDown(f.settings.sideNav.subOpenSpeed, f.settings.sideNav.animationEasing), e.next("ul").addClass("show"), e.addClass("expand").removeClass("notExpand"), c.removeClass("highlight-menu"), e.closest("li.hasSub").addClass("highlight-menu")) : (navexpand = b.find("li.hasSub .expand"), navexpand.next("ul").removeClass("show"), navexpand.next("ul").slideUp(f.settings.sideNav.subCloseSpeed, f.settings.sideNav.animationEasing), navexpand.addClass("notExpand").removeClass("expand"), navexpand.find(".sideNav-arrow").removeClass("rotateM180").addClass("rotate0"), e.next("ul").slideDown(f.settings.sideNav.subOpenSpeed, f.settings.sideNav.animationEasing), e.next("ul").addClass("show"), e.addClass("expand").removeClass("notExpand"), c.removeClass("highlight-menu"), e.closest("li.hasSub").addClass("highlight-menu")))) : e.hasClass("expand") && (d.preventDefault(), e.next("ul").removeClass("show"), e.next("ul").slideUp(f.settings.sideNav.subCloseSpeed, f.settings.sideNav.animationEasing), e.addClass("notExpand").removeClass("expand"), c.removeClass("highlight-menu"))
                })
            }, f.sideBarNavToggle = function() {
                var b = a(".mainnav"),
                    c = b.find("li");
                Modernizr.touch ? c.click(function() {
                    _this = a(this), _this.hasClass("hover-li") ? _this.removeClass("hover-li") : (c.each(function() {
                        a(this).removeClass("hover-li")
                    }), _this.addClass("hover-li"))
                }) : c.hover(function() {
                    a(this).addClass("hover-li")
                }, function() {
                    a(this).removeClass("hover-li")
                })
            }, f.setCurrentNav = function() {
                var b = document.domain,
                    c = a(".mainnav> ul"),
                    d = c.find("a");
                if ("" === b) {
                    var e = window.location.pathname.split("/"),
                        g = e.pop();
                    this.setCurrentClass(d, g)
                } else if (f.settings.sideNav.absoluteUrl) {
                    var h = "http://" + b + window.location.pathname;
                    setCurrentClass(d, h)
                } else {
                    var i = window.location.pathname.split("/"),
                        i = i.pop();
                    if ("" != f.settings.sideNav.subDir) var i = window.location.pathname + f.settings.sideNav.subDir;
                    this.setCurrentClass(d, i)
                }
            }, f.setCurrentClass = function(b, c) {
                b.each(function() {
                    var b = a(this).attr("href");
                    if (b === c) {
                        if (a(this).addClass("active"), f.settings.header.fixed && 1 == store.get("fixed-header") && a(this).append("<span class='indicator'></span>"), ulElem = a(this).closest("ul"), ulElem.hasClass("sub")) {
                            ulElem.addClass("show").css("display", "block");
                            var d = a(this).closest("li.hasSub").children("a.notExpand");
                            d.removeClass("notExpand").addClass("expand active-state"), d.closest("li.hasSub").addClass("highlight-menu")
                        }
                    } else "" == c && (c = "index.html"), b === c && (a(this).addClass("active"), f.settings.header.fixed && 1 == store.get("fixed-header") && a(this).append("<span class='indicator'></span>"))
                })
            }, f.panels = function() {
                var b = a(".panel");
                b.each(function(b) {
                    self = a(this), panelHeading = self.find(".panel-heading"), panelsid = "supr" + b, self.attr("id", panelsid), (self.hasClass("toggle") || self.hasClass("panelClose") || self.hasClass("panelRefresh")) && (panelHeading.find(".panel-controls-right").length ? panelControlsRight = panelHeading.find(".panel-controls-right") : (panelHeading.append('<div class="panel-controls panel-controls-right">'), panelControlsRight = panelHeading.find(".panel-controls-right"))), self.hasClass("panelRefresh") && !panelControlsRight.find("a.panel-refresh").length && panelControlsRight.append('<a href="#" class="panel-refresh"><i class="' + f.settings.panels.refreshIcon + '"></i></a>'), self.hasClass("toggle") && !panelControlsRight.find("a.toggle").length && (self.hasClass("panel-closed") ? (panelControlsRight.append('<a href="#" class="toggle panel-maximize"><i class="' + f.settings.panels.collapseIcon + '"></i></a>'), self.find(".panel-body").slideToggle(0), self.find(".panel-footer").slideToggle(0), self.find(".panel-heading").toggleClass("min")) : panelControlsRight.append('<a href="#" class="toggle panel-minimize"><i class="' + f.settings.panels.toggleIcon + '"></i></a>')), self.hasClass("panelClose") && !panelControlsRight.find("a.panel-close").length && panelControlsRight.append('<a href="#" class="panel-close"><i class="' + f.settings.panels.closeIcon + '"></i></a>'), self.hasClass("showControls") ? (self.find(".panel-controls-left").addClass("panel-controls-show"), self.find(".panel-controls-right").addClass("panel-controls-show")) : f.settings.panels.showControlsOnHover && (self.find(".panel-controls-left").addClass("panel-controls-hide"), self.find(".panel-controls-right").addClass("panel-controls-hide"));
                    var c = a(this).find(".scroll"),
                        d = c.data("height");
                    c.slimScroll({
                        position: "right",
                        height: "100%",
                        distance: "0",
                        railVisible: !1,
                        size: f.settings.customScroll.size,
                        color: "#777",
                        railOpacity: f.settings.customScroll.opacity,
                        railColor: "#fff",
                        height: d
                    });
                    var e = a(this).find(".scroll-horizontal");
                    e.slimScrollHorizontal({
                        size: f.settings.customScroll.size,
                        color: "#777",
                        railOpacity: f.settings.customScroll.opacity,
                        railColor: "#fff",
                        width: "100%",
                        positon: "bottom",
                        start: "left",
                        railVisible: !0
                    })
                }), panelControls = b.find(".panel-controls"), panelControlsLink = panelControls.find("a"), f.settings.panels.showControlsOnHover && b.hover(function() {
                    a(this).find(".panel-controls").hasClass("panel-controls-hide") && a(this).find(".panel-controls").fadeIn(300)
                }, function() {
                    a(this).find(".panel-controls").hasClass("panel-controls-hide") && a(this).find(".panel-controls").fadeOut(300)
                }), panelControlsLink.click(function(b) {
                    b.preventDefault(), self = a(this), thisIcon = self.find("i"), thisPanel = self.closest(".panel"), thisPanelBody = thisPanel.find(".panel-body"), thisPanelFooter = thisPanel.find(".panel-footer"), thisPanelHeading = thisPanel.find(".panel-heading"), self.hasClass("panel-close") && setTimeout(function() {
                        thisPanel.remove()
                    }, 500), self.hasClass("toggle") && (self.toggleClass("panel-minimize panel-maximize"), thisIcon.toggleClass(f.settings.panels.toggleIcon + " " + f.settings.panels.collapseIcon), thisPanelBody.slideToggle(200), thisPanelFooter.slideToggle(200), thisPanelHeading.toggleClass("min")), self.hasClass("panel-refresh") && (self.closest(".panel").waitMe({
                        effect: f.settings.panels.loadingEffect,
                        text: "",
                        bg: "rgba(255,255,255,0.7)",
                        color: f.settings.panels.loaderColor
                    }), setTimeout(function() {
                        self.closest(".panel").waitMe("hide")
                    }, 3e3))
                });
                var c = "panels_position_" + h;
                if (!a(".contentwrapper").hasClass("notSortable")) {
                    var d = a(".contentwrapper").find(".sortable-layout"),
                        e = d.find(".panelMove"),
                        g = e.find(".panel-heading"),
                        h = window.location.href,
                        i = localStorage.getItem(c);
                    if (f.settings.panels.rememberSortablePosition && i) {
                        var j = JSON.parse(i);
                        for (var k in j.grid) {
                            var l = d.eq(k);
                            for (var m in j.grid[k].section) l.append(a("#" + j.grid[k].section[m].id))
                        }
                    }
                    d.sortable({
                        items: e,
                        handle: g,
                        placeholder: "panel-placeholder",
                        forcePlaceholderSize: !0,
                        helper: "original",
                        forceHelperSize: !0,
                        cursor: "move",
                        delay: 200,
                        opacity: .8,
                        zIndex: 1e4,
                        tolerance: "pointer",
                        iframeFix: !1,
                        revert: !0,
                        update: function(a, b) {
                            f.settings.panels.rememberSortablePosition && panelSavePosition(b.item)
                        }
                    }).sortable("option", "connectWith", d), a(".reset-layout").click(function() {
                        bootbox.confirm({
                            message: "Warning!!! This action will reset panels position",
                            title: "Are you sure ?",
                            className: "modal-style2",
                            callback: function(a) {
                                a && (localStorage.removeItem(c), location.reload())
                            }
                        }), f.centerModal()
                    }), panelSavePosition = function() {
                        var b = [];
                        d.each(function() {
                            var c = [];
                            a(this).children(".panelMove").each(function() {
                                var b = {};
                                b.id = a(this).attr("id"), c.push(b)
                            });
                            var d = {
                                section: c
                            };
                            b.push(d)
                        });
                        var e = JSON.stringify({
                            grid: b
                        });
                        i != e && localStorage.setItem(c, e, null)
                    }
                }
            }, f.waitMe = function() {
                ! function(a) {
                    a.fn.waitMe = function(b) {
                        return this.each(function() {
                            function c() {
                                k.removeClass(l + "_container"), k.find("." + l).remove()
                            }
                            var d, e, f, g, h, i, j, k = a(this),
                                l = "waitMe",
                                m = !1,
                                n = "background-color",
                                o = "",
                                p = "",
                                q = {
                                    init: function() {
                                        function c() {
                                            g = a('<div class="' + l + '"></div>');
                                            var b = "width:" + j.sizeW + ";height:" + j.sizeH;
                                            switch (j.effect) {
                                                case "none":
                                                    f = 0;
                                                    break;
                                                case "bounce":
                                                    f = 3, h = "", i = b;
                                                    break;
                                                case "rotateplane":
                                                    f = 1, h = "", i = b;
                                                    break;
                                                case "stretch":
                                                    f = 5, h = "", i = b;
                                                    break;
                                                case "orbit":
                                                    f = 2, h = b, i = "";
                                                    break;
                                                case "roundBounce":
                                                    f = 12, h = b, i = "";
                                                    break;
                                                case "win8":
                                                    f = 5, m = !0, h = b, i = b;
                                                    break;
                                                case "win8_linear":
                                                    f = 5, m = !0, h = b, i = "";
                                                    break;
                                                case "ios":
                                                    f = 12, h = b, i = "";
                                                    break;
                                                case "facebook":
                                                    f = 3, h = "", i = b;
                                                    break;
                                                case "rotation":
                                                    f = 1, n = "border-color", h = "", i = b;
                                                    break;
                                                case "timer":
                                                    f = 2, o = "border-color:" + j.color, h = b, i = "";
                                                    break;
                                                case "pulse":
                                                    f = 1, n = "border-color", h = "", i = b;
                                                    break;
                                                case "progressBar":
                                                    f = 1, h = "", i = b;
                                                    break;
                                                case "bouncePulse":
                                                    f = 3, h = "", i = b
                                            }
                                            if ("" == j.sizeW && "" == j.sizeH && (i = "", h = ""), "" != h && "" != o && (o = ";" + o), f > 0) {
                                                e = a('<div class="' + l + "_progress " + j.effect + '"></div>');
                                                for (var c = 1; f >= c; ++c) p += m ? '<div class="' + l + "_progress_elem" + c + '" style="' + i + '"><div style="' + n + ":" + j.color + '"></div></div>' : '<div class="' + l + "_progress_elem" + c + '" style="' + n + ":" + j.color + ";" + i + '"></div>';
                                                e = a('<div class="' + l + "_progress " + j.effect + '" style="' + h + o + '">' + p + "</div>")
                                            }
                                            j.text && (d = a('<div class="' + l + '_text" style="color:' + j.color + '">' + j.text + "</div>")), k.find("> ." + l) && k.find("> ." + l).remove(), waitMeDivObj = a('<div class="' + l + '_content"></div>'), waitMeDivObj.append(e, d), g.append(waitMeDivObj), "HTML" == k[0].tagName && (k = a("body")), k.addClass(l + "_container").append(g), k.find("> ." + l).css({
                                                background: j.bg
                                            }), k.find("." + l + "_content").css({
                                                marginTop: -k.find("." + l + "_content").outerHeight() / 2 + "px"
                                            })
                                        }
                                        var q = {
                                            effect: "bounce",
                                            text: "",
                                            bg: "rgba(255,255,255,0.7)",
                                            color: "#000",
                                            sizeW: "",
                                            sizeH: ""
                                        };
                                        j = a.extend(q, b), c()
                                    },
                                    hide: function() {
                                        c()
                                    }
                                };
                            return q[b] ? q[b].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? void(a.event.special.destroyed = {
                                remove: function(a) {
                                    a.handler && a.handler()
                                }
                            }) : q.init.apply(this, arguments)
                        })
                    }
                }(jQuery)
            }, f.backToTop = function() {
                a(window).scroll(function() {
                    a(window).scrollTop() > 200 ? a("#back-to-top").fadeIn(200) : a("#back-to-top").fadeOut(200)
                }), a("#back-to-top, .back-to-top").click(function() {
                    return a("html, body").animate({
                        scrollTop: 0
                    }, "800"), !1
                })
            }, f.centerModal = function() {
                a(".modal").each(function() {
                    0 == a(this).hasClass("in") && a(this).show();
                    var b = a(window).height() - 60,
                        c = a(this).find(".modal-header").outerHeight() || 2,
                        d = a(this).find(".modal-footer").outerHeight() || 2;
                    a(this).find(".modal-content").css({
                        "max-height": function() {
                            return b
                        }
                    }), a(this).find(".modal-body").css({
                        "max-height": function() {
                            return b - (c + d)
                        }
                    }), a(this).find(".modal-dialog").addClass("modal-dialog-center").css({
                        "margin-top": function() {
                            return -(a(this).outerHeight() / 2)
                        },
                        "margin-left": function() {
                            return -(a(this).outerWidth() / 2)
                        }
                    }), 0 == a(this).hasClass("in") && a(this).hide()
                })
            }, f.accordions = function() {
                var b = a(".accordion");
                b.collapse(), accPutIcon = function() {
                    b.each(function() {
                        accExp = a(this).find(".panel-collapse.in"), accExp.prev(".panel-heading").addClass("content-in").find("a.accordion-toggle").append('<i class="' + f.settings.accordion.toggleIcon + '"></i>'), accNor = a(this).find(".panel-collapse").not(".panel-collapse.in"), accNor.prev(".panel-heading").find("a.accordion-toggle").append('<i class="' + f.settings.accordion.collapseIcon + '"></i>')
                    })
                }, accUpdIcon = function() {
                    b.each(function() {
                        accExp = a(this).find(".panel-collapse.in"), accExp.prev(".panel-heading").find("i").remove(), accExp.prev(".panel-heading").addClass("content-in").find("a.accordion-toggle").append('<i class="' + f.settings.accordion.toggleIcon + '"></i>'), accNor = a(this).find(".panel-collapse").not(".panel-collapse.in"), accNor.prev(".panel-heading").find("i").remove(), accNor.prev(".panel-heading").removeClass("content-in").find("a.accordion-toggle").append('<i class="' + f.settings.accordion.collapseIcon + '"></i>')
                    })
                }, accPutIcon(), a(".accordion").on("shown.bs.collapse", function() {
                    accUpdIcon()
                }).on("hidden.bs.collapse", function() {
                    accUpdIcon()
                })
            }, f.breadCrumbs = function() {
                var b = a(".heading > .breadcrumb"),
                    c = '<i class="' + f.settings.breadcrumbs.homeicon + '"></i>',
                    d = a(".mainnav a.active"),
                    e = d.closest(".sub");
                b.empty(), b.append("<li>You are here:</li>"), b.append('<li><a href="index.html" class="tip" title="back to dashboard">' + c + "</a></li>"), b.append('<span class="divider"><i class="' + f.settings.breadcrumbs.dividerIcon + '"></i></span>'), e.closest("li").hasClass("hasSub") ? (navel1 = e.prev("a.active-state"), link = navel1.attr("href"), text1 = navel1.children(".notification").remove().end().text().trim(), b.append('<li><a href="' + link + '">' + text1 + "</a></li>"), text = d.children(".notification").remove().end().text(), b.append('<span class="divider"><i class="' + f.settings.breadcrumbs.dividerIcon + '"></i></span>'), b.append("<li>" + text + "</li>")) : (text = d.children(".notification").remove().end().text(), b.append("<li>" + text + "</li>"))
            }, f.checkBoxesAndRadios = function() {
                var b = a("input[type=checkbox]"),
                    c = a("input[type=radio]");
                b.each(function(b) {
                    chboxClass = "undefined" == typeof a(this).data("class") ? "checkbox-custom" : a(this).data("class"), "undefined" == typeof a(this).attr("id") ? (chboxId = "chbox" + b, a(this).attr("id", chboxId)) : chboxId = a(this).attr("id"), chboxLabeltxt = "undefined" == typeof a(this).data("label") ? "" : a(this).data("label"), a(this).parent().hasClass(chboxClass) || a(this).parent().hasClass("toggle") || (a(this).wrap('<div class="' + chboxClass + '">'), a(this).parent().append('<label for="' + chboxId + '">' + chboxLabeltxt + "</label>"))
                }), c.each(function(b) {
                    radioClass = "undefined" == typeof a(this).data("class") ? "radio-custom" : a(this).data("class"), "undefined" == typeof a(this).attr("id") ? (radioId = "radio" + b, a(this).attr("id", radioId)) : radioId = a(this).attr("id"), radioLabeltxt = "undefined" == typeof a(this).data("label") ? "" : a(this).data("label"), a(this).parent().hasClass(radioClass) || a(this).parent().hasClass("toggle") || (a(this).wrap('<div class="' + radioClass + '">'), a(this).parent().append('<label for="' + radioId + '">' + radioLabeltxt + "</label>"))
                })
            }, f.shrinkHeader = function() {
                var b, c, d, e = a("#header"),
                    f = a("body");
                return d = e.position().top, b = a(document), c = !1, a(window).on("scroll touchmove", function() {
                    return c = !0
                }), setInterval(function() {
                    return c ? (e.toggleClass("shrink", b.scrollTop() > d), f.toggleClass("shrink-header", b.scrollTop() > d), c = !1) : void 0
                }, 250)
            }, f.storejs = function() {
                ! function(a) {
                    function b() {
                        try {
                            return h in a && a[h]
                        } catch (b) {
                            return !1
                        }
                    }

                    function c(a) {
                        return function() {
                            var b = Array.prototype.slice.call(arguments, 0);
                            b.unshift(e), j.appendChild(e), e.addBehavior("#default#userData"), e.load(h);
                            var c = a.apply(f, b);
                            return j.removeChild(e), c
                        }
                    }

                    function d(a) {
                        return a.replace(/^d/, "___$&").replace(m, "___")
                    }
                    var e, f = {},
                        g = a.document,
                        h = "localStorage",
                        i = "script";
                    if (f.disabled = !1, f.set = function() {}, f.get = function() {}, f.remove = function() {}, f.clear = function() {}, f.transact = function(a, b, c) {
                            var d = f.get(a);
                            null == c && (c = b, b = null), "undefined" == typeof d && (d = b || {}), c(d), f.set(a, d)
                        }, f.getAll = function() {}, f.forEach = function() {}, f.serialize = function(a) {
                            return JSON.stringify(a)
                        }, f.deserialize = function(a) {
                            if ("string" != typeof a) return void 0;
                            try {
                                return JSON.parse(a)
                            } catch (b) {
                                return a || void 0
                            }
                        }, b()) e = a[h], f.set = function(a, b) {
                        return void 0 === b ? f.remove(a) : (e.setItem(a, f.serialize(b)), b)
                    }, f.get = function(a) {
                        return f.deserialize(e.getItem(a))
                    }, f.remove = function(a) {
                        e.removeItem(a)
                    }, f.clear = function() {
                        e.clear()
                    }, f.getAll = function() {
                        var a = {};
                        return f.forEach(function(b, c) {
                            a[b] = c
                        }), a
                    }, f.forEach = function(a) {
                        for (var b = 0; b < e.length; b++) {
                            var c = e.key(b);
                            a(c, f.get(c))
                        }
                    };
                    else if (g.documentElement.addBehavior) {
                        var j, k;
                        try {
                            k = new ActiveXObject("htmlfile"), k.open(), k.write("<" + i + ">document.w=window</" + i + '><iframe src="/favicon.ico"></iframe>'), k.close(), j = k.w.frames[0].document, e = j.createElement("div")
                        } catch (l) {
                            e = g.createElement("div"), j = g.body
                        }
                        var m = new RegExp("[!\"#$%&'()*+,/\\\\:;<=>?@[\\]^`{|}~]", "g");
                        f.set = c(function(a, b, c) {
                            return b = d(b), void 0 === c ? f.remove(b) : (a.setAttribute(b, f.serialize(c)), a.save(h), c)
                        }), f.get = c(function(a, b) {
                            return b = d(b), f.deserialize(a.getAttribute(b))
                        }), f.remove = c(function(a, b) {
                            b = d(b), a.removeAttribute(b), a.save(h)
                        }), f.clear = c(function(a) {
                            var b = a.XMLDocument.documentElement.attributes;
                            a.load(h);
                            for (var c, d = 0; c = b[d]; d++) a.removeAttribute(c.name);
                            a.save(h)
                        }), f.getAll = function() {
                            var a = {};
                            return f.forEach(function(b, c) {
                                a[b] = c
                            }), a
                        }, f.forEach = c(function(a, b) {
                            for (var c, d = a.XMLDocument.documentElement.attributes, e = 0; c = d[e]; ++e) b(c.name, f.deserialize(a.getAttribute(c.name)))
                        })
                    }
                    try {
                        var n = "__storejs__";
                        f.set(n, n), f.get(n) != n && (f.disabled = !0), f.remove(n)
                    } catch (l) {
                        f.disabled = !0
                    }
                    f.enabled = !f.disabled, "undefined" != typeof module && module.exports && this.module !== module ? module.exports = f : "function" == typeof define && define.amd ? define(f) : a.store = f
                }(Function("return this")())
            }, f.mouseWheel = function() {
                ! function(a) {
                    function b(b) {
                        var c = b || window.event,
                            d = [].slice.call(arguments, 1),
                            e = 0,
                            f = 0,
                            g = 0;
                        return b = a.event.fix(c), b.type = "mousewheel", c.wheelDelta && (e = c.wheelDelta / 120), c.detail && (e = -c.detail / 3), g = e, void 0 !== c.axis && c.axis === c.HORIZONTAL_AXIS && (g = 0, f = -1 * e), void 0 !== c.wheelDeltaY && (g = c.wheelDeltaY / 120), void 0 !== c.wheelDeltaX && (f = -1 * c.wheelDeltaX / 120), d.unshift(b, e, f, g), (a.event.dispatch || a.event.handle).apply(this, d)
                    }
                    var c = ["DOMMouseScroll", "mousewheel"];
                    if (a.event.fixHooks)
                        for (var d = c.length; d;) a.event.fixHooks[c[--d]] = a.event.mouseHooks;
                    a.event.special.mousewheel = {
                        setup: function() {
                            if (this.addEventListener)
                                for (var a = c.length; a;) this.addEventListener(c[--a], b, !1);
                            else this.onmousewheel = b
                        },
                        teardown: function() {
                            if (this.removeEventListener)
                                for (var a = c.length; a;) this.removeEventListener(c[--a], b, !1);
                            else this.onmousewheel = null
                        }
                    }, a.fn.extend({
                        mousewheel: function(a) {
                            return a ? this.bind("mousewheel", a) : this.trigger("mousewheel")
                        },
                        unmousewheel: function(a) {
                            return this.unbind("mousewheel", a)
                        }
                    })
                }(jQuery)
            }, f.dropdownMenuFix = function() {
                var b = f.getBreakPoint();
                a("ul.dropdown-menu").each("phone" == b || "tablet" == b ? function() {
                    a(this).removeClass("right"), a(this).removeClass("left");
                    var b = a(this).parent().innerWidth(),
                        c = a(this).innerWidth(),
                        d = b / 2 - c / 2;
                    d += "px", a(this).css("margin-left", d)
                } : function() {
                    if (!a(this).hasClass("left")) {
                        var b = a(this).parent().innerWidth(),
                            c = a(this).innerWidth(),
                            d = b / 2 - c / 2;
                        d += "px", a(this).css("margin-left", d)
                    }
                }), a(".dropdown-form").click(function(a) {
                    a.stopPropagation()
                })
            }, f.expandSideBarNav = function() {
                nav = a(".mainnav"), nava = nav.find("a"), nava.next("ul").slideDown(f.settings.sideNav.subOpenSpeed, f.settings.sideNav.animationEasing), nava.next("ul").addClass("expand"), nava.addClass("drop").removeClass("notExpand")
            }, f.collapseSideBarNav = function(b) {
                nav = a(".mainnav"), nava = nav.find("a.expand"), navactiv = nav.find("a.active-state"), b ? (navactiv.next("ul").slideDown(f.settings.sideNav.subOpenSpeed, f.settings.sideNav.animationEasing).addClass("show"), navactiv.addClass("expand").removeClass("notExpand")) : (nava.next("ul").slideUp(f.settings.sideNav.subOpenSpeed, f.settings.sideNav.animationEasing), nava.next("ul").removeClass("show"), setTimeout(function() {
                    nava.next("ul").removeAttr("style")
                }, f.settings.sideNav.subCloseSpeed), nava.addClass("notExpand").removeClass("expand"))
            }, f.dropdownMenuAnimations = function() {
                openEffect = "animated " + f.settings.dropdownMenu.openEffect, a(".dropdown").on("show.bs.dropdown", function() {
                    a(this).find(".dropdown-menu").addClass(openEffect)
                })
            }, f.retinaReady = function() {
                ! function() {
                    function a() {}

                    function b(a) {
                        return f.retinaImageSuffix + a
                    }

                    function c(a, c) {
                        if (this.path = a || "", "undefined" != typeof c && null !== c) this.at_2x_path = c, this.perform_check = !1;
                        else {
                            if (void 0 !== document.createElement) {
                                var d = document.createElement("a");
                                d.href = this.path, d.pathname = d.pathname.replace(g, b), this.at_2x_path = d.href
                            } else {
                                var e = this.path.split("?");
                                e[0] = e[0].replace(g, b), this.at_2x_path = e.join("?")
                            }
                            this.perform_check = !0
                        }
                    }

                    function d(a) {
                        this.el = a, this.path = new c(this.el.getAttribute("src"), this.el.getAttribute("data-at2x"));
                        var b = this;
                        this.path.check_2x_variant(function(a) {
                            a && b.swap()
                        })
                    }
                    var e = "undefined" == typeof exports ? window : exports,
                        f = {
                            retinaImageSuffix: "@2x",
                            check_mime_type: !0,
                            force_original_dimensions: !0
                        };
                    e.Retina = a, a.configure = function(a) {
                        null === a && (a = {});
                        for (var b in a) a.hasOwnProperty(b) && (f[b] = a[b])
                    }, a.init = function(a) {
                        null === a && (a = e);
                        var b = a.onload || function() {};
                        a.onload = function() {
                            var a, c, e = document.getElementsByTagName("img"),
                                f = [];
                            for (a = 0; a < e.length; a += 1) c = e[a], c.getAttributeNode("data-no-retina") || f.push(new d(c));
                            b()
                        }
                    }, a.isRetina = function() {
                        var a = "(-webkit-min-device-pixel-ratio: 1.5), (min--moz-device-pixel-ratio: 1.5), (-o-min-device-pixel-ratio: 3/2), (min-resolution: 1.5dppx)";
                        return e.devicePixelRatio > 1 ? !0 : e.matchMedia && e.matchMedia(a).matches ? !0 : !1
                    };
                    var g = /\.\w+$/;
                    e.RetinaImagePath = c, c.confirmed_paths = [], c.prototype.is_external = function() {
                        return !(!this.path.match(/^https?\:/i) || this.path.match("//" + document.domain))
                    }, c.prototype.check_2x_variant = function(a) {
                        var b, d = this;
                        return this.is_external() ? a(!1) : this.perform_check || "undefined" == typeof this.at_2x_path || null === this.at_2x_path ? this.at_2x_path in c.confirmed_paths ? a(!0) : (b = new XMLHttpRequest, b.open("HEAD", this.at_2x_path), b.onreadystatechange = function() {
                            if (4 !== b.readyState) return a(!1);
                            if (b.status >= 200 && b.status <= 399) {
                                if (f.check_mime_type) {
                                    var e = b.getResponseHeader("Content-Type");
                                    if (null === e || !e.match(/^image/i)) return a(!1)
                                }
                                return c.confirmed_paths.push(d.at_2x_path), a(!0)
                            }
                            return a(!1)
                        }, void b.send()) : a(!0)
                    }, e.RetinaImage = d, d.prototype.swap = function(a) {
                        function b() {
                            c.el.complete ? (f.force_original_dimensions && (c.el.setAttribute("width", c.el.offsetWidth), c.el.setAttribute("height", c.el.offsetHeight)), c.el.setAttribute("src", a)) : setTimeout(b, 5)
                        }
                        "undefined" == typeof a && (a = this.path.at_2x_path);
                        var c = this;
                        b()
                    }, a.isRetina() && a.init(e)
                }()
            }, f.waitMe = function() {
                ! function(a) {
                    a.fn.waitMe = function(b) {
                        return this.each(function() {
                            var c, d, e, f, g, h, i, j = a(this),
                                k = !1,
                                l = "background-color",
                                m = "",
                                n = {
                                    init: function() {
                                        switch (i = a.extend({
                                            effect: "bounce",
                                            text: "",
                                            bg: "rgba(255,255,255,0.7)",
                                            color: "#000",
                                            sizeW: "",
                                            sizeH: ""
                                        }, b), f = a('<div class="waitMe"></div>'), i.effect) {
                                            case "none":
                                                e = 0;
                                                break;
                                            case "bounce":
                                                e = 3, g = "", h = "width:" + i.sizeW + ";height:" + i.sizeH;
                                                break;
                                            case "rotateplane":
                                                e = 1, g = "", h = "width:" + i.sizeW + ";height:" + i.sizeH;
                                                break;
                                            case "stretch":
                                                e = 5, g = "", h = "width:" + i.sizeW + ";height:" + i.sizeH;
                                                break;
                                            case "orbit":
                                                e = 2, g = "width:" + i.sizeW + ";height:" + i.sizeH, h = "";
                                                break;
                                            case "roundBounce":
                                                e = 12, g = "width:" + i.sizeW + ";height:" + i.sizeH, h = "";
                                                break;
                                            case "win8":
                                                e = 5, k = !0, g = "width:" + i.sizeW + ";height:" + i.sizeH, h = "width:" + i.sizeW + ";height:" + i.sizeH;
                                                break;
                                            case "win8_linear":
                                                e = 5, k = !0, g = "width:" + i.sizeW + ";height:" + i.sizeH, h = "";
                                                break;
                                            case "ios":
                                                e = 12, g = "width:" + i.sizeW + ";height:" + i.sizeH, h = "";
                                                break;
                                            case "facebook":
                                                e = 3, g = "", h = "width:" + i.sizeW + ";height:" + i.sizeH;
                                                break;
                                            case "rotation":
                                                e = 1, l = "border-color", g = "", h = "width:" + i.sizeW + ";height:" + i.sizeH
                                        }
                                        if ("" == i.sizeW && "" == i.sizeH && (g = h = ""), e > 0) {
                                            d = a('<div class="waitMe_progress ' + i.effect + '"></div>');
                                            for (var n = 1; e >= n; ++n) m = k ? m + ('<div class="waitMe_progress_elem' + n + '" style="' + h + '"><div style="' + l + ":" + i.color + '"></div></div>') : m + ('<div class="waitMe_progress_elem' + n + '" style="' + l + ":" + i.color + ";" + h + '"></div>');
                                            d = a('<div class="waitMe_progress ' + i.effect + '" style="' + g + '">' + m + "</div>")
                                        }
                                        i.text && (c = a('<div class="waitMe_text" style="color:' + i.color + '">' + i.text + "</div>")), j.find("> .waitMe") && j.find("> .waitMe").remove(), waitMeDivObj = a('<div class="waitMe_content"></div>'), waitMeDivObj.append(d, c), f.append(waitMeDivObj), "HTML" == j[0].tagName && (j = a("body")), j.addClass("waitMe_container").append(f), j.find("> .waitMe").css({
                                            background: i.bg
                                        }), j.find(".waitMe_content").css({
                                            marginTop: -j.find(".waitMe_content").outerHeight() / 2 + "px"
                                        })
                                    },
                                    hide: function() {
                                        j.removeClass("waitMe_container"), j.find(".waitMe").remove()
                                    }
                                };
                            return n[b] ? n[b].apply(this, Array.prototype.slice.call(arguments, 1)) : "object" != typeof b && b ? void(a.event.special.destroyed = {
                                remove: function(a) {
                                    a.handler && a.handler()
                                }
                            }) : n.init.apply(this, arguments)
                        })
                    }
                }(jQuery)
            }, f.animatedProgressBars = function() {
                ! function(a) {
                    "use strict";
                    var b = function(c, d) {
                        this.$element = a(c), this.options = a.extend({}, b.defaults, d)
                    };
                    b.defaults = {
                        transition_delay: 300,
                        refresh_speed: 50,
                        display_text: "none",
                        use_percentage: !0,
                        percent_format: function(a) {
                            return a + "%"
                        },
                        amount_format: function(a, b) {
                            return a + " / " + b
                        },
                        update: a.noop,
                        done: a.noop,
                        fail: a.noop
                    }, b.prototype.transition = function() {
                        var c = this.$element,
                            d = c.parent(),
                            e = this.$back_text,
                            f = this.$front_text,
                            g = this.options,
                            h = parseInt(c.attr("data-transitiongoal")),
                            i = parseInt(c.attr("aria-valuemin")) || 0,
                            j = parseInt(c.attr("aria-valuemax")) || 100,
                            k = d.hasClass("vertical"),
                            l = g.update && "function" == typeof g.update ? g.update : b.defaults.update,
                            m = g.done && "function" == typeof g.done ? g.done : b.defaults.done,
                            n = g.fail && "function" == typeof g.fail ? g.fail : b.defaults.fail;
                        if (isNaN(h)) return void n("data-transitiongoal not set");
                        var o = Math.round(100 * (h - i) / (j - i));
                        if ("center" === g.display_text && !e && !f) {
                            this.$back_text = e = a("<span>").addClass("progressbar-back-text").prependTo(d), this.$front_text = f = a("<span>").addClass("progressbar-front-text").prependTo(c);
                            var p;
                            k ? (p = d.css("height"), e.css({
                                height: p,
                                "line-height": p
                            }), f.css({
                                height: p,
                                "line-height": p
                            }), a(window).resize(function() {
                                p = d.css("height"), e.css({
                                    height: p,
                                    "line-height": p
                                }), f.css({
                                    height: p,
                                    "line-height": p
                                })
                            })) : (p = d.css("width"), f.css({
                                width: p
                            }), a(window).resize(function() {
                                p = d.css("width"), f.css({
                                    width: p
                                })
                            }))
                        }
                        setTimeout(function() {
                            var a, b, n, p, q;
                            k ? c.css("height", o + "%") : c.css("width", o + "%");
                            var r = setInterval(function() {
                                k ? (n = c.height(), p = d.height()) : (n = c.width(), p = d.width()), a = Math.round(100 * n / p), b = Math.round(i + n / p * (j - i)), a >= o && (a = o, b = h, m(c), clearInterval(r)), "none" !== g.display_text && (q = g.use_percentage ? g.percent_format(a) : g.amount_format(b, j, i), "fill" === g.display_text ? c.text(q) : "center" === g.display_text && (e.text(q), f.text(q))), c.attr("aria-valuenow", b), l(a, c)
                            }, g.refresh_speed)
                        }, g.transition_delay)
                    };
                    var c = a.fn.progressbar;
                    a.fn.progressbar = function(c) {
                        return this.each(function() {
                            var d = a(this),
                                e = d.data("bs.progressbar"),
                                f = "object" == typeof c && c;
                            e || d.data("bs.progressbar", e = new b(this, f)), e.transition()
                        })
                    }, a.fn.progressbar.Constructor = b, a.fn.progressbar.noConflict = function() {
                        return a.fn.progressbar = c, this
                    }
                }(window.jQuery)
            }, f.browserSelector = function() {
                function a(a) {
                    var b = a.toLowerCase(),
                        d = function(a) {
                            return b.indexOf(a) > -1
                        },
                        e = "gecko",
                        f = "webkit",
                        g = "safari",
                        h = "opera",
                        i = "mobile",
                        j = document.documentElement,
                        k = [!/opera|webtv/i.test(b) && /msie\s(\d)/.test(b) ? "ie ie" + RegExp.$1 : d("firefox/2") ? e + " ff2" : d("firefox/3.5") ? e + " ff3 ff3_5" : d("firefox/3.6") ? e + " ff3 ff3_6" : d("firefox/3") ? e + " ff3" : d("gecko/") ? e : d("opera") ? h + (/version\/(\d+)/.test(b) ? " " + h + RegExp.$1 : /opera(\s|\/)(\d+)/.test(b) ? " " + h + RegExp.$2 : "") : d("konqueror") ? "konqueror" : d("blackberry") ? i + " blackberry" : d("android") ? i + " android" : d("chrome") ? f + " chrome" : d("iron") ? f + " iron" : d("applewebkit/") ? f + " " + g + (/version\/(\d+)/.test(b) ? " " + g + RegExp.$1 : "") : d("mozilla/") ? e : "", d("j2me") ? i + " j2me" : d("iphone") ? i + " iphone" : d("ipod") ? i + " ipod" : d("ipad") ? i + " ipad" : d("mac") ? "mac" : d("darwin") ? "mac" : d("webtv") ? "webtv" : d("win") ? "win" + (d("windows nt 6.0") ? " vista" : "") : d("freebsd") ? "freebsd" : d("x11") || d("linux") ? "linux" : "", "js"];
                    return c = k.join(" "), j.className += " " + c, c
                }
                a(navigator.userAgent)
            }, f.firstImpression = function() {
                window.firstImpression = function(a, b) {
                    var c, d, e, f;
                    return c = function(a, b, c) {
                        var d, e, f;
                        return arguments.length > 1 && "[object Object]" !== String(b) ? (c = c || {}, (null === b || void 0 === b) && (c.expires = -1), "number" == typeof c.expires && (d = c.expires, f = c.expires = new Date, f.setTime(f.getTime() + 24 * d * 60 * 60 * 1e3)), c.path = "/", document.cookie = [encodeURIComponent(a), "=", encodeURIComponent(b), c.expires ? "; expires=" + c.expires.toUTCString() : "", c.path ? "; path=" + c.path : "", c.domain ? "; domain=" + c.domain : "", c.secure ? "; secure" : ""].join("")) : (e = new RegExp("(?:^|; )" + encodeURIComponent(a) + "=([^;]*)").exec(document.cookie), e ? decodeURIComponent(e[1]) : null)
                    }, void 0 === a && (a = "_firstImpression"), void 0 === b && (b = 730), null === a ? void c("_firstImpression", null) : null === b ? void c(a, null) : (d = function() {
                        return c(a)
                    }, e = function() {
                        c(a, !0, {
                            expires: b
                        })
                    }, (f = function() {
                        var a = d();
                        return a || e(), !a
                    })())
                }
            }, f.matchHeight = function() {
                ! function(a) {
                    var b = -1,
                        c = -1,
                        d = function(b) {
                            var c = null,
                                d = [];
                            return a(b).each(function() {
                                var b = a(this),
                                    f = b.offset().top - e(b.css("margin-top")),
                                    g = 0 < d.length ? d[d.length - 1] : null;
                                null === g ? d.push(b) : 1 >= Math.floor(Math.abs(c - f)) ? d[d.length - 1] = g.add(b) : d.push(b), c = f
                            }), d
                        },
                        e = function(a) {
                            return parseFloat(a) || 0
                        },
                        f = function(b) {
                            var c = {
                                byRow: !0,
                                remove: !1,
                                property: "height"
                            };
                            return "object" == typeof b && (c = a.extend(c, b)), "boolean" == typeof b && (c.byRow = b), "remove" === b && (c.remove = !0), c
                        },
                        g = a.fn.matchHeight = function(b) {
                            if (b = f(b), b.remove) {
                                var c = this;
                                return this.css(b.property, ""), a.each(g._groups, function(a, b) {
                                    b.elements = b.elements.not(c)
                                }), this
                            }
                            return 1 >= this.length ? this : (g._groups.push({
                                elements: this,
                                options: b
                            }), g._apply(this, b), this)
                        };
                    g._groups = [], g._throttle = 80, g._maintainScroll = !1, g._beforeUpdate = null, g._afterUpdate = null, g._apply = function(b, c) {
                        var h = f(c),
                            i = a(b),
                            j = [i],
                            k = a(window).scrollTop(),
                            l = a("html").outerHeight(!0),
                            m = i.parents().filter(":hidden");
                        return m.css("display", "block"), h.byRow && (i.each(function() {
                            var b = a(this),
                                c = "inline-block" === b.css("display") ? "inline-block" : "block";
                            b.data("style-cache", b.attr("style")), b.css({
                                display: c,
                                "padding-top": "0",
                                "padding-bottom": "0",
                                "margin-top": "0",
                                "margin-bottom": "0",
                                "border-top-width": "0",
                                "border-bottom-width": "0",
                                height: "100px"
                            })
                        }), j = d(i), i.each(function() {
                            var b = a(this);
                            b.attr("style", b.data("style-cache") || "").css("height", "")
                        })), a.each(j, function(b, c) {
                            var d = a(c),
                                f = 0;
                            h.byRow && 1 >= d.length || (d.each(function() {
                                var b = a(this),
                                    c = {
                                        display: "inline-block" === b.css("display") ? "inline-block" : "block"
                                    };
                                c[h.property] = "", b.css(c), b.outerHeight(!1) > f && (f = b.outerHeight(!1)), b.css("display", "")
                            }), d.each(function() {
                                var b = a(this),
                                    c = 0;
                                "border-box" !== b.css("box-sizing") && (c += e(b.css("border-top-width")) + e(b.css("border-bottom-width")), c += e(b.css("padding-top")) + e(b.css("padding-bottom"))), b.css(h.property, f - c)
                            }))
                        }), m.css("display", ""), g._maintainScroll && a(window).scrollTop(k / l * a("html").outerHeight(!0)), this
                    }, g._applyDataApi = function() {
                        var b = {};
                        a("[data-match-height], [data-mh]").each(function() {
                            var c = a(this),
                                d = c.attr("data-match-height") || c.attr("data-mh");
                            b[d] = d in b ? b[d].add(c) : c
                        }), a.each(b, function() {
                            this.matchHeight(!0)
                        })
                    };
                    var h = function(b) {
                        g._beforeUpdate && g._beforeUpdate(b, g._groups), a.each(g._groups, function() {
                            g._apply(this.elements, this.options)
                        }), g._afterUpdate && g._afterUpdate(b, g._groups)
                    };
                    g._update = function(d, e) {
                        if (e && "resize" === e.type) {
                            var f = a(window).width();
                            if (f === b) return;
                            b = f
                        }
                        d ? -1 === c && (c = setTimeout(function() {
                            h(e), c = -1
                        }, g._throttle)) : h(e)
                    }, a(g._applyDataApi), a(window).bind("load", function(a) {
                        g._update(!1, a)
                    }), a(window).bind("resize orientationchange", function(a) {
                        g._update(!0, a)
                    })
                }(jQuery)
            }, f.equalHeight = function() {
                f.matchHeight()
            }, f.quickSearch = function() {
                a(".chat-search input").length && a(".chat-search input").val("").quicksearch(".user-list .list-group-item", {
                    removeDiacritics: !0
                }), a(".todo-search input").length && a(".todo-search input").val("").quicksearch(".todo-list .todo-task-item"), a(".users-search input").length && a(".users-search input").val("").quicksearch(".recent-users-widget .list-group-item"), a(".icon-search").length && a(".icon-search").val("").quicksearch(".col-md-3", {
                    removeDiacritics: !0
                })
            }, f.resSearchButton = function() {
                var b = a(".resSearchBtn"),
                    c = a(".closeSearchForm"),
                    d = a("#header .navbar-form");
                b.click(function() {
                    d.addClass("show animated fadeIn"), c.addClass("show")
                }), c.click(function() {
                    a(this).removeClass("show"), d.removeClass("show animated fadeIn")
                })
            }, f.resSidebarButton = function() {
                var b = a("#showNav");
                b.click(function() {
                    a(this).hasClass("sidebar-showed") ? (f.hideLeftSidebar(), a(this).removeClass("sidebar-showed")) : (f.showLeftSidebar(), a(this).addClass("sidebar-showed"))
                })
            }, f.responsiveTables = function() {
                var b = a(".table").not(".non-responsive");
                b.each(function() {
                    a(this).wrap('<div class="table-responsive" />'), f.settings.tables.customscroll && a("div.table-responsive").slimScrollHorizontal({
                        size: f.settings.customScroll.size,
                        color: "#f3f3f3",
                        railOpacity: "0.3",
                        width: "100%",
                        positon: "bottom",
                        start: "left",
                        railVisible: !0,
                        distance: "3px"
                    })
                })
            }, f.emailApp = function() {
                var b = a("#email-sidebar"),
                    c = a("#email-content");
                a("#email-toggle").click(function() {
                    a(this).hasClass("pushed") ? (a(this).removeClass("pushed"), b.removeClass("email-sidebar-hide"), b.addClass("email-sidebar-show"), c.removeClass("email-content-expand"), c.addClass("email-content-contract")) : (a(this).addClass("pushed"), b.removeClass("email-sidebar-show"), b.addClass("email-sidebar-hide"), c.removeClass("email-content-contract"), c.addClass("email-content-expand"))
                })
            }, f.collapseEmailAppSidebar = function() {
                var b = a("#email-sidebar"),
                    c = a("#email-content");
                b.removeClass("email-sidebar-show"), b.addClass("email-sidebar-hide"), c.removeClass("email-content-contract"), c.addClass("email-content-expand"), a("#email-toggle").addClass("pushed")
            }, f.expandEmailAppSidebar = function() {
                var b = a("#email-sidebar"),
                    c = a("#email-content");
                b.removeClass("email-sidebar-hide"), b.addClass("email-sidebar-show"), c.removeClass("email-content-expand"), c.addClass("email-content-contract"), a("#email-toggle").removeClass("pushed")
            }, f.toDoWidget = function() {
                var b = a(".todo-widget"),
                    c = b.find(".todo-task-item"),
                    d = c.find('input[type="checkbox"]'),
                    e = c.find(".close");
                d.change(function() {
                    a(this).prop("checked") ? a(this).closest(".todo-task-item").addClass("task-done") : a(this).closest(".todo-task-item").removeClass("task-done")
                }), e.click(function() {
                    a(this).closest(".todo-task-item").fadeOut("500")
                })
            }, f.removeDefaultClassess = function() {
                var b = (f.getBreakPoint(), a("#sidebar")),
                    c = a("#right-sidebar"),
                    d = a(".page-content");
                d.addClass("sidebar-page"), d.addClass("right-sidebar-page"), b.removeClass("hidden-lg hidden-md hidden-sm hidden-xs"), c.removeClass("hidden-lg hidden-md hidden-sm hidden-xs"), a("#sidebarbg, #right-sidebarbg").removeClass("hidden-lg hidden-md hidden-sm hidden-xs")
            }, f.respondjs = function() {
                var b = jRespond([{
                    label: "phone",
                    enter: 0,
                    exit: 767
                }, {
                    label: "tablet",
                    enter: 768,
                    exit: 979
                }, {
                    label: "laptop",
                    enter: 980,
                    exit: 1366
                }, {
                    label: "large",
                    enter: 1367,
                    exit: 1e4
                }]);
                return b.addFunc({
                    breakpoint: "large",
                    enter: function() {
                        f.removeDefaultClassess(), store.set("rightSidebarToggle", 0), f.toggleRightSidebarBtn("show"), f.showRightSidebar()
                    },
                    exit: function() {}
                }), b.addFunc({
                    breakpoint: "laptop",
                    enter: function() {
                        f.removeDefaultClassess(), f.hideRightSidebar()
                    },
                    exit: function() {}
                }), b.addFunc({
                    breakpoint: "tablet",
                    enter: function() {
                        f.removeDefaultClassess(), f.toggleLeftSidebar(), f.sideBarNavToggle(), f.collapseSideBarNav(!1), f.hideRightSidebar(), f.dropdownMenuFix()
                    },
                    exit: function() {
                        f.showLeftSidebar(), f.dropdownMenuFix()
                    }
                }), b.addFunc({
                    breakpoint: "phone",
                    enter: function() {
                        f.removeDefaultClassess(), f.dropdownMenuFix(), f.hideLeftSidebar(), f.collapseEmailAppSidebar(), a("#email-content").addClass("email-content-offCanvas"), f.hideRightSidebar()
                    },
                    exit: function() {
                        f.showLeftSidebar(), a("#email-content").removeClass("email-content-offCanvas"), f.expandEmailAppSidebar()
                    }
                }), b
            }, f.init()
        }, a.fn.supr = function(b) {
            return this.each(function() {
                if (void 0 == a(this).data("supr")) {
                    var c = new a.supr(this, b);
                    a(this).data("supr", c)
                }
            })
        }
    }(jQuery), window.console || (console = {
        log: function() {}
    }), navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement("style");
    msViewportStyle.appendChild(document.createTextNode("@-ms-viewport{width:auto!important}")), document.querySelector("head").appendChild(msViewportStyle)
}
var nua = navigator.userAgent,
    isAndroid = nua.indexOf("Mozilla/5.0") > -1 && nua.indexOf("Android ") > -1 && nua.indexOf("AppleWebKit") > -1 && -1 === nua.indexOf("Chrome");
isAndroid && $("select.form-control").removeClass("form-control").css("width", "100%"), window.addEventListener("load", function() {
    FastClick.attach(document.body)
}, !1), $(document).ready(function() {
    $("a[href^=#]").click(function(a) {
        a.preventDefault()
    }), $("body").supr({
        customScroll: {
            color: "#c4c4c4",
            rscolor: "#95A5A6",
            size: "5px",
            opacity: "1",
            alwaysVisible: !1
        },
        header: {
            fixed: !0,
            shrink: !0
        },
        breadcrumbs: {
            auto: !0,
            homeicon: "s16 icomoon-icon-screen-2",
            dividerIcon: "s16 icomoon-icon-arrow-right-3"
        },
        sidebar: {
            fixed: !0,
            rememberToggle: !0,
            offCanvas: !1
        },
        rightSidebar: {
            fixed: !0,
            rememberToggle: !0
        },
        sideNav: {
            toggleMode: !0,
            showArrows: !0,
            sideNavArrowIcon: "icomoon-icon-arrow-down-2 s16",
            subOpenSpeed: 200,
            subCloseSpeed: 300,
            animationEasing: "linear",
            absoluteUrl: !1,
            subDir: ""
        },
        panels: {
            refreshIcon: "brocco-icon-refresh s12",
            toggleIcon: "minia-icon-arrow-down-3",
            collapseIcon: "minia-icon-arrow-up-3",
            closeIcon: "icomoon-icon-close",
            showControlsOnHover: !1,
            loadingEffect: "rotateplane",
            loaderColor: "#616469",
            rememberSortablePosition: !0
        },
        accordion: {
            toggleIcon: "minia-icon-arrow-up-3 s12",
            collapseIcon: "minia-icon-arrow-down-3 s12"
        },
        tables: {
            responsive: !0,
            customscroll: !0
        },
        alerts: {
            animation: !0,
            closeEffect: "bounceOutDown"
        },
        dropdownMenu: {
            animation: !0,
            openEffect: "fadeIn"
        },
        backToTop: !0
    }), $("[data-toggle=tooltip]").tooltip({
        container: "body"
    }), $(".tip").tooltip({
        placement: "top",
        container: "body"
    }), $(".tipR").tooltip({
        placement: "right",
        container: "body"
    }), $(".tipB").tooltip({
        placement: "bottom",
        container: "body"
    }), $(".tipL").tooltip({
        placement: "left",
        container: "body"
    }), $("[data-toggle=popover]").popover({
        html: !0
    });
    var a = $("body").data("supr");
    firstImpression() && (a.settings.header.fixed ? store.set("fixed-header", 1) : store.set("fixed-header", 0), a.settings.sidebar.fixed ? store.set("fixed-left-sidebar", 1) : store.set("fixed-left-sidebar", 0), a.settings.rightSidebar.fixed ? store.set("fixed-right-sidebar", 1) : store.set("fixed-right-sidebar", 0)), 1 == store.get("fixed-header") ? $("#fixed-header-toggle").prop("checked", !0) : $("#fixed-header-toggle").prop("checked", !1), 1 == store.get("fixed-left-sidebar") ? $("#fixed-left-sidebar").prop("checked", !0) : $("#fixed-left-sidebar").prop("checked", !1), 1 == store.get("fixed-right-sidebar") ? $("#fixed-right-sidebar").prop("checked", !0) : $("#fixed-right-sidebar").prop("checked", !1), $("#fixed-header-toggle").on("change", function() {
        a.fixedHeader(this.checked ? !0 : !1)
    }), $("#fixed-left-sidebar").on("change", function() {
        this.checked ? a.fixedSidebar("left") : a.removeFixedSidebar("left")
    }), $("#fixed-right-sidebar").on("change", function() {
        this.checked ? a.fixedSidebar("right") : a.removeFixedSidebar("right")
    })
}), $(document).ready(function() {
    $(".select2").select2({
        placeholder: "Select state"
    }), $(":file").not(".unstyled").filestyle(), $("#validate").validate({
        ignore: null,
        ignore: 'input[type="hidden"]',
        errorPlacement: function(a, b) {
            var c = b.closest(".input-group");
            c.get(0) || (c = b), "checkbox" === c.get(0).type && (c = b.parent()), "" !== a.text() && c.after(a)
        },
        errorClass: "help-block",
        rules: {
            email: {
                required: !0,
                email: !0
            },
            select2: "required",
            password: {
                required: !0,
                minlength: 5
            },
            textarea: {
                required: !0,
                minlength: 10
            },
            maxLenght: {
                required: !0,
                maxlength: 10
            },
            rangelenght: {
                required: !0,
                rangelength: [10, 20]
            },
            url: {
                required: !0,
                url: !0
            },
            range: {
                required: !0,
                range: [5, 10]
            },
            minval: {
                required: !0,
                min: 13
            },
            maxval: {
                required: !0,
                max: 13
            },
            date: {
                required: !0,
                date: !0
            },
            number: {
                required: !0,
                number: !0
            },
            digits: {
                required: !0,
                digits: !0
            },
            ccard: {
                required: !0,
                creditcard: !0
            },
            agree: "required"
        },
        messages: {
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            agree: "Please accept our policy",
            textarea: "Write some info for you",
            select2: "Please select something"
        },
        highlight: function(a) {
            $(a).closest(".form-group").removeClass("has-success").addClass("has-error")
        },
        success: function(a) {
            $(a).closest(".form-group").removeClass("has-error"), a.remove()
        }
    })
});
var positive = [1, 5, 3, 7, 8, 6, 10],
    negative = [10, 6, 8, 7, 3, 5, 1],
    negative1 = [7, 6, 8, 7, 6, 5, 4];
$("#stat1").sparkline(positive, {
    height: 15,
    spotRadius: 0,
    barColor: "#9FC569",
    type: "bar"
}), $("#stat2").sparkline(negative, {
    height: 15,
    spotRadius: 0,
    barColor: "#ED7A53",
    type: "bar"
}), $("#stat3").sparkline(negative1, {
    height: 15,
    spotRadius: 0,
    barColor: "#ED7A53",
    type: "bar"
}), $("#stat4").sparkline(positive, {
    height: 15,
    spotRadius: 0,
    barColor: "#9FC569",
    type: "bar"
}), $("#stat5").sparkline(positive, {
    height: 15,
    spotRadius: 0,
    barColor: "#9FC569",
    type: "bar"
}), $("#stat6").sparkline(positive, {
    width: 70,
    height: 20,
    lineColor: "#88bbc8",
    fillColor: "#f2f7f9",
    spotColor: "#e72828",
    maxSpotColor: "#005e20",
    minSpotColor: "#f7941d",
    spotRadius: 3,
    lineWidth: 2
});
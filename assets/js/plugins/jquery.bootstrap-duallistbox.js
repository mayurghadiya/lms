! function(e, t, n, i) {
    function s(t, n) {
        this.element = e(t), this.settings = e.extend({}, C, n), this._defaults = C, this._name = S, this.init()
    }

    function l(e) {
        e.element.trigger("change")
    }

    function o(t) {
        t.element.find("option").each(function(n, i) {
            var s = e(i);
            "undefined" == typeof s.data("original-index") && s.data("original-index", t.elementCount++), "undefined" == typeof s.data("_selected") && s.data("_selected", !1)
        })
    }

    function r(t, n, i) {
        t.element.find("option").each(function(t, s) {
            var l = e(s);
            l.data("original-index") === n && l.prop("selected", i)
        })
    }

    function a(e, t) {
        return e.replace(/\{(\d+)\}/g, function(e, n) {
            return "undefined" != typeof t[n] ? t[n] : e
        })
    }

    function c(e) {
        if (e.settings.infoText) {
            var t = e.elements.select1.find("option").length,
                n = e.elements.select2.find("option").length,
                i = e.element.find("option").length - e.selectedElements,
                s = e.selectedElements,
                l = "";
            l = 0 === i ? e.settings.infoTextEmpty : t === i ? a(e.settings.infoText, [t, i]) : a(e.settings.infoTextFiltered, [t, i]), e.elements.info1.html(l), e.elements.box1.toggleClass("filtered", !(t === i || 0 === i)), l = 0 === s ? e.settings.infoTextEmpty : n === s ? a(e.settings.infoText, [n, s]) : a(e.settings.infoTextFiltered, [n, s]), e.elements.info2.html(l), e.elements.box2.toggleClass("filtered", !(n === s || 0 === s))
        }
    }

    function h(t) {
        t.selectedElements = 0, t.elements.select1.empty(), t.elements.select2.empty(), t.element.find("option").each(function(n, i) {
            var s = e(i);
            s.prop("selected") ? (t.selectedElements++, t.elements.select2.append(s.clone(!0).prop("selected", s.data("_selected")))) : t.elements.select1.append(s.clone(!0).prop("selected", s.data("_selected")))
        }), t.settings.showFilterInputs && (m(t, 1), m(t, 2)), c(t)
    }

    function m(t, n) {
        if (t.settings.showFilterInputs) {
            f(t, n), t.elements["select" + n].empty().scrollTop(0);
            var i = new RegExp(e.trim(t.elements["filterInput" + n].val()), "gi"),
                s = t.element;
            s = 1 === n ? s.find("option").not(":selected") : s.find("option:selected"), s.each(function(s, l) {
                var o = e(l),
                    r = !0;
                (l.text.match(i) || t.settings.filterOnValues && o.attr("value").match(i)) && (r = !1, t.elements["select" + n].append(o.clone(!0).prop("selected", o.data("_selected")))), t.element.find("option").eq(o.data("original-index")).data("filtered" + n, r)
            }), c(t)
        }
    }

    function f(t, n) {
        t.elements["select" + n].find("option").each(function(n, i) {
            var s = e(i);
            t.element.find("option").eq(s.data("original-index")).data("_selected", s.prop("selected"))
        })
    }

    function d(t) {
        t.find("option").sort(function(t, n) {
            return e(t).data("original-index") > e(n).data("original-index") ? 1 : -1
        }).appendTo(t)
    }

    function u(e) {
        e.elements.select1.find("option").each(function() {
            e.element.find("option").data("_selected", !1)
        })
    }

    function p(t) {
        "all" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect ? "moved" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect || f(t, 1) : (f(t, 1), f(t, 2)), t.elements.select1.find("option:selected").each(function(n, i) {
            var s = e(i);
            s.data("filtered1") || r(t, s.data("original-index"), !0)
        }), h(t), l(t), d(t.elements.select2)
    }

    function v(t) {
        "all" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect ? "moved" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect || f(t, 2) : (f(t, 1), f(t, 2)), t.elements.select2.find("option:selected").each(function(n, i) {
            var s = e(i);
            s.data("filtered2") || r(t, s.data("original-index"), !1)
        }), h(t), l(t), d(t.elements.select1)
    }

    function g(t) {
        "all" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect ? "moved" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect || f(t, 1) : (f(t, 1), f(t, 2)), t.element.find("option").each(function(t, n) {
            var i = e(n);
            i.data("filtered1") || i.prop("selected", !0)
        }), h(t), l(t)
    }

    function b(t) {
        "all" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect ? "moved" !== t.settings.preserveSelectionOnMove || t.settings.moveOnSelect || f(t, 2) : (f(t, 1), f(t, 2)), t.element.find("option").each(function(t, n) {
            var i = e(n);
            i.data("filtered2") || i.prop("selected", !1)
        }), h(t), l(t)
    }

    function x(e) {
        e.elements.form.submit(function(t) {
            e.elements.filterInput1.is(":focus") ? (t.preventDefault(), e.elements.filterInput1.focusout()) : e.elements.filterInput2.is(":focus") && (t.preventDefault(), e.elements.filterInput2.focusout())
        }), e.element.on("bootstrapDualListbox.refresh", function(t, n) {
            e.refresh(n)
        }), e.elements.filterClear1.on("click", function() {
            e.setNonSelectedFilter("", !0)
        }), e.elements.filterClear2.on("click", function() {
            e.setSelectedFilter("", !0)
        }), e.elements.moveButton.on("click", function() {
            p(e)
        }), e.elements.moveAllButton.on("click", function() {
            g(e)
        }), e.elements.removeButton.on("click", function() {
            v(e)
        }), e.elements.removeAllButton.on("click", function() {
            b(e)
        }), e.elements.filterInput1.on("change keyup", function() {
            m(e, 1)
        }), e.elements.filterInput2.on("change keyup", function() {
            m(e, 2)
        })
    }
    var S = "bootstrapDualListbox",
        C = {
            bootstrap2Compatible: !1,
            filterTextClear: "show all",
            filterPlaceHolder: "Filter",
            moveSelectedLabel: "Move selected",
            moveAllLabel: "Move all",
            removeSelectedLabel: "Remove selected",
            removeAllLabel: "Remove all",
            moveOnSelect: !0,
            preserveSelectionOnMove: !1,
            selectedListLabel: !1,
            nonSelectedListLabel: !1,
            helperSelectNamePostfix: "_helper",
            selectorMinimalHeight: 100,
            showFilterInputs: !0,
            nonSelectedFilter: "",
            selectedFilter: "",
            infoText: "Showing all {0}",
            infoTextFiltered: '<span class="label label-warning">Filtered</span> {0} from {1}',
            infoTextEmpty: "Empty list",
            filterOnValues: !1
        },
        L = /android/i.test(navigator.userAgent.toLowerCase());
    s.prototype = {
        init: function() {
            this.container = e('<div class="bootstrap-duallistbox-container"> <div class="box1">   <label></label>   <span class="info-container">     <span class="info"></span>     <button type="button" class="btn clear1 pull-right"></button>   </span>   <input class="filter" type="text">   <div class="btn-group buttons">     <button type="button" class="btn moveall">       <i></i>       <i></i>     </button>     <button type="button" class="btn move">       <i></i>     </button>   </div>   <select multiple="multiple"></select> </div> <div class="box2">   <label></label>   <span class="info-container">     <span class="info"></span>     <button type="button" class="btn clear2 pull-right"></button>   </span>   <input class="filter" type="text">   <div class="btn-group buttons">     <button type="button" class="btn remove">       <i></i>     </button>     <button type="button" class="btn removeall">       <i></i>       <i></i>     </button>   </div>   <select multiple="multiple"></select> </div></div>').insertBefore(this.element), this.elements = {
                originalSelect: this.element,
                box1: e(".box1", this.container),
                box2: e(".box2", this.container),
                filterInput1: e(".box1 .filter", this.container),
                filterInput2: e(".box2 .filter", this.container),
                filterClear1: e(".box1 .clear1", this.container),
                filterClear2: e(".box2 .clear2", this.container),
                label1: e(".box1 > label", this.container),
                label2: e(".box2 > label", this.container),
                info1: e(".box1 .info", this.container),
                info2: e(".box2 .info", this.container),
                select1: e(".box1 select", this.container),
                select2: e(".box2 select", this.container),
                moveButton: e(".box1 .move", this.container),
                removeButton: e(".box2 .remove", this.container),
                moveAllButton: e(".box1 .moveall", this.container),
                removeAllButton: e(".box2 .removeall", this.container),
                form: e(e(".box1 .filter", this.container)[0].form)
            }, this.originalSelectName = this.element.attr("name") || "";
            var t = "bootstrap-duallistbox-nonselected-list_" + this.originalSelectName,
                n = "bootstrap-duallistbox-selected-list_" + this.originalSelectName;
            return this.elements.select1.attr("id", t), this.elements.select2.attr("id", n), this.elements.label1.attr("for", t), this.elements.label2.attr("for", n), this.selectedElements = 0, this.elementCount = 0, this.setBootstrap2Compatible(this.settings.bootstrap2Compatible), this.setFilterTextClear(this.settings.filterTextClear), this.setFilterPlaceHolder(this.settings.filterPlaceHolder), this.setMoveSelectedLabel(this.settings.moveSelectedLabel), this.setMoveAllLabel(this.settings.moveAllLabel), this.setRemoveSelectedLabel(this.settings.removeSelectedLabel), this.setRemoveAllLabel(this.settings.removeAllLabel), this.setMoveOnSelect(this.settings.moveOnSelect), this.setPreserveSelectionOnMove(this.settings.preserveSelectionOnMove), this.setSelectedListLabel(this.settings.selectedListLabel), this.setNonSelectedListLabel(this.settings.nonSelectedListLabel), this.setHelperSelectNamePostfix(this.settings.helperSelectNamePostfix), this.setSelectOrMinimalHeight(this.settings.selectorMinimalHeight), o(this), this.setShowFilterInputs(this.settings.showFilterInputs), this.setNonSelectedFilter(this.settings.nonSelectedFilter), this.setSelectedFilter(this.settings.selectedFilter), this.setInfoText(this.settings.infoText), this.setInfoTextFiltered(this.settings.infoTextFiltered), this.setInfoTextEmpty(this.settings.infoTextEmpty), this.setFilterOnValues(this.settings.filterOnValues), this.element.hide(), x(this), h(this), this.element
        },
        setBootstrap2Compatible: function(e, t) {
            return this.settings.bootstrap2Compatible = e, e ? (this.container.removeClass("row").addClass("row-fluid bs2compatible"), this.container.find(".box1, .box2").removeClass("col-md-6").addClass("span6"), this.container.find(".clear1, .clear2").removeClass("btn-default btn-xs").addClass("btn-mini"), this.container.find("input, select").removeClass("form-control"), this.container.find(".btn").removeClass("btn-default"), this.container.find(".moveall > i, .move > i").removeClass("glyphicon glyphicon-arrow-right").addClass("icon-arrow-right"), this.container.find(".removeall > i, .remove > i").removeClass("glyphicon glyphicon-arrow-left").addClass("icon-arrow-left")) : (this.container.removeClass("row-fluid bs2compatible").addClass("row"), this.container.find(".box1, .box2").removeClass("span6").addClass("col-md-6"), this.container.find(".clear1, .clear2").removeClass("btn-mini").addClass("btn-default btn-xs"), this.container.find("input, select").addClass("form-control"), this.container.find(".btn").addClass("btn-default"), this.container.find(".moveall > i, .move > i").removeClass("icon-arrow-right").addClass("glyphicon glyphicon-arrow-right"), this.container.find(".removeall > i, .remove > i").removeClass("icon-arrow-left").addClass("glyphicon glyphicon-arrow-left")), t && h(this), this.element
        },
        setFilterTextClear: function(e, t) {
            return this.settings.filterTextClear = e, this.elements.filterClear1.html(e), this.elements.filterClear2.html(e), t && h(this), this.element
        },
        setFilterPlaceHolder: function(e, t) {
            return this.settings.filterPlaceHolder = e, this.elements.filterInput1.attr("placeholder", e), this.elements.filterInput2.attr("placeholder", e), t && h(this), this.element
        },
        setMoveSelectedLabel: function(e, t) {
            return this.settings.moveSelectedLabel = e, this.elements.moveButton.attr("title", e), t && h(this), this.element
        },
        setMoveAllLabel: function(e, t) {
            return this.settings.moveAllLabel = e, this.elements.moveAllButton.attr("title", e), t && h(this), this.element
        },
        setRemoveSelectedLabel: function(e, t) {
            return this.settings.removeSelectedLabel = e, this.elements.removeButton.attr("title", e), t && h(this), this.element
        },
        setRemoveAllLabel: function(e, t) {
            return this.settings.removeAllLabel = e, this.elements.removeAllButton.attr("title", e), t && h(this), this.element
        },
        setMoveOnSelect: function(e, t) {
            if (L && (e = !0), this.settings.moveOnSelect = e, this.settings.moveOnSelect) {
                this.container.addClass("moveonselect");
                var n = this;
                this.elements.select1.on("change", function() {
                    p(n)
                }), this.elements.select2.on("change", function() {
                    v(n)
                })
            } else this.container.removeClass("moveonselect"), this.elements.select1.off("change"), this.elements.select2.off("change");
            return t && h(this), this.element
        },
        setPreserveSelectionOnMove: function(e, t) {
            return L && (e = !1), this.settings.preserveSelectionOnMove = e, t && h(this), this.element
        },
        setSelectedListLabel: function(e, t) {
            return this.settings.selectedListLabel = e, e ? this.elements.label2.show().html(e) : this.elements.label2.hide().html(e), t && h(this), this.element
        },
        setNonSelectedListLabel: function(e, t) {
            return this.settings.nonSelectedListLabel = e, e ? this.elements.label1.show().html(e) : this.elements.label1.hide().html(e), t && h(this), this.element
        },
        setHelperSelectNamePostfix: function(e, t) {
            return this.settings.helperSelectNamePostfix = e, e ? (this.elements.select1.attr("name", this.originalSelectName + e + "1"), this.elements.select2.attr("name", this.originalSelectName + e + "2")) : (this.elements.select1.removeAttr("name"), this.elements.select2.removeAttr("name")), t && h(this), this.element
        },
        setSelectOrMinimalHeight: function(e, t) {
            this.settings.selectorMinimalHeight = e;
            var n = this.element.height();
            return this.element.height() < e && (n = e), this.elements.select1.height(n), this.elements.select2.height(n), t && h(this), this.element
        },
        setShowFilterInputs: function(e, t) {
            return e ? (this.elements.filterInput1.show(), this.elements.filterInput2.show()) : (this.setNonSelectedFilter(""), this.setSelectedFilter(""), h(this), this.elements.filterInput1.hide(), this.elements.filterInput2.hide()), this.settings.showFilterInputs = e, t && h(this), this.element
        },
        setNonSelectedFilter: function(e, t) {
            return this.settings.showFilterInputs ? (this.settings.nonSelectedFilter = e, this.elements.filterInput1.val(e), t && h(this), this.element) : void 0
        },
        setSelectedFilter: function(e, t) {
            return this.settings.showFilterInputs ? (this.settings.selectedFilter = e, this.elements.filterInput2.val(e), t && h(this), this.element) : void 0
        },
        setInfoText: function(e, t) {
            return this.settings.infoText = e, t && h(this), this.element
        },
        setInfoTextFiltered: function(e, t) {
            return this.settings.infoTextFiltered = e, t && h(this), this.element
        },
        setInfoTextEmpty: function(e, t) {
            return this.settings.infoTextEmpty = e, t && h(this), this.element
        },
        setFilterOnValues: function(e, t) {
            return this.settings.filterOnValues = e, t && h(this), this.element
        },
        getContainer: function() {
            return this.container
        },
        refresh: function(e) {
            o(this), e ? u(this) : (f(this, 1), f(this, 2)), h(this)
        },
        destroy: function() {
            return this.container.remove(), this.element.show(), e.data(this, "plugin_" + S, null), this.element
        }
    }, e.fn[S] = function(t) {
        var n = arguments;
        if (t === i || "object" == typeof t) return this.each(function() {
            e(this).is("select") ? e.data(this, "plugin_" + S) || e.data(this, "plugin_" + S, new s(this, t)) : e(this).find("select").each(function(n, i) {
                e(i).bootstrapDualListbox(t)
            })
        });
        if ("string" == typeof t && "_" !== t[0] && "init" !== t) {
            var l;
            return this.each(function() {
                var i = e.data(this, "plugin_" + S);
                i instanceof s && "function" == typeof i[t] && (l = i[t].apply(i, Array.prototype.slice.call(n, 1)))
            }), l !== i ? l : this
        }
    }
}(jQuery, window, document);
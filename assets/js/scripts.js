/*!
 * knockout-daterangepicker
 * version: 0.1.0
 * authors: Sensor Tower team
 * license: MIT
 * https://sensortower.github.io/daterangepicker
 */
(function() {
    var t, e, n, a, r, i, o, s, c, u, d, l = function(t, e) {
            function n() {
                this.constructor = t
            }
            for (var a in e) h.call(e, a) && (t[a] = e[a]);
            return n.prototype = e.prototype, t.prototype = new n, t.__super__ = e.prototype, t
        },
        h = {}.hasOwnProperty,
        p = function(t, e) {
            return function() {
                return t.apply(e, arguments)
            }
        };
    u = function() {
        function t() {}
        return t.patchCurrentLocale = function(t) {
            return moment.locale(moment.locale(), t)
        }, t.setFirstDayOfTheWeek = function(t) {
            var e;
            if (t = (t % 7 + 7) % 7, moment.localeData().firstDayOfWeek() !== t) return e = t - moment.localeData().firstDayOfWeek(), this.patchCurrentLocale({
                week: {
                    dow: t,
                    doy: moment.localeData().firstDayOfYear()
                }
            })
        }, t.tz = function(t) {
            var e, n;
            return e = Array.prototype.slice.call(arguments, 0, -1), n = arguments[arguments.length - 1], moment.tz ? moment.tz.apply(null, e.concat([n])) : n && "utc" === n.toLowerCase() ? moment.utc.apply(null, e) : moment.apply(null, e)
        }, t
    }(), c = function() {
        function t(t, e) {
            this.date = t.clone(), this.period = e
        }
        return t.array = function(t, e, n) {
            var a, r, i, o, s;
            for (r = new this(t, n), s = [], a = i = 0, o = e - 1; 0 <= o ? i <= o : i >= o; a = 0 <= o ? ++i : --i) s.push(r.next());
            return s
        }, t.prototype.next = function() {
            var t;
            return t = this.date, this.date = t.clone().add(1, this.period), t.clone()
        }, t
    }(), e = function() {
        function t() {}
        return t.rotateArray = function(t, e) {
            return e %= t.length, t.slice(e).concat(t.slice(0, e))
        }, t.uniqArray = function(t) {
            var e, n, a, r;
            for (r = [], n = 0, a = t.length; n < a; n++) e = t[n], r.indexOf(e) === -1 && r.push(e);
            return r
        }, t
    }(), $.fn.daterangepicker = function(t, e) {
        return null == t && (t = {}), this.each(function() {
            var n;
            if (n = $(this), !n.data("daterangepicker")) return t.anchorElement = n, e && (t.callback = e), t.callback = $.proxy(t.callback, this), n.data("daterangepicker", new s(t))
        }), this
    }, ko.bindingHandlers.stopBinding = {
        init: function() {
            return {
                controlsDescendantBindings: !0
            }
        }
    }, ko.virtualElements.allowedBindings.stopBinding = !0, ko.bindingHandlers.daterangepicker = function() {
        return $.extend(this, {
            _optionsKey: "daterangepickerOptions",
            _formatKey: "daterangepickerFormat",
            init: function(t, e, n) {
                var a, r;
                return a = e(), r = ko.unwrap(n.get(this._optionsKey)) || {}, $(t).daterangepicker(r, function(t, e, n) {
                    return a([t, e])
                })
            },
            update: function(t, e, n) {
                var a, r, i, o, s, c, u;
                return a = $(t), s = e()(), c = s[0], i = s[1], r = ko.unwrap(n.get(this._formatKey)) || "MMM D, YYYY", u = moment(c).format(r), o = moment(i).format(r), ko.ignoreDependencies(function() {
                    var t;
                    return a.data("daterangepicker").standalone() || (t = a.data("daterangepicker").single() ? u : u + " – " + o, a.val(t).text(t)), a.data("daterangepicker").startDate(c), a.data("daterangepicker").endDate(i)
                })
            }
        })
    }(), o = function() {
        function t(t, e, n) {
            this.title = t, this.startDate = e, this.endDate = n
        }
        return t
    }(), t = function(t) {
        function e() {
            return e.__super__.constructor.apply(this, arguments)
        }
        return l(e, t), e
    }(o), i = function(t) {
        function e() {
            return e.__super__.constructor.apply(this, arguments)
        }
        return l(e, t), e
    }(o), d = function() {
        function t() {}
        return t.allPeriods = [/*"day", "week",, "year"*/ "month", "quarter", "year"], t.scale = function(t) {
            return "day" === t || "week" === t ? "month" : "year"
        }, t.showWeekDayNames = function(t) {
            return "day" === t || "week" === t
        }, t.nextPageArguments = function(t) {
            var e, n;
            return e = "year" === t ? 9 : 1, n = this.scale(t), [e, n]
        }, t.format = function(t) {
            switch (t) {
                case "day":
                case "week":
                    return "D";
                case "month":
                    return "MMM";
                case "quarter":
                    return "\\QQ";
                case "year":
                    return "YYYY"
            }
        }, t.title = function(t) {
            switch (t) {
                case "day":
                    return "Day";
                case "week":
                    return "Week";
                case "month":
                    return "Month";
                case "quarter":
                    return "Quarter";
                case "year":
                    return "Year"
            }
        }, t.dimentions = function(t) {
            switch (t) {
                case "day":
                    return [7, 6];
                case "week":
                    return [1, 6];
                case "month":
                    return [3, 4];
                case "quarter":
                    return [2, 2];
                case "year":
                    return [3, 3]
            }
        }, t.methods = ["scale", "showWeekDayNames", "nextPageArguments", "format", "title", "dimentions"], t.extendObservable = function(e) {
            return this.methods.forEach(function(n) {
                return e[n] = function() {
                    return t[n](e())
                }
            }), e
        }, t
    }(), r = function() {
        function e(t) {
            null == t && (t = {}), this.firstDayOfWeek = this._firstDayOfWeek(t.firstDayOfWeek), this.timeZone = this._timeZone(t.timeZone), this.periods = this._periods(t.periods), this.customPeriodRanges = this._customPeriodRanges(t.customPeriodRanges), this.period = this._period(t.period), this.single = this._single(t.single), this.opened = this._opened(t.opened), this.expanded = this._expanded(t.expanded), this.standalone = this._standalone(t.standalone), this.hideWeekdays = this._hideWeekdays(t.hideWeekdays), this.locale = this._locale(t.locale), this.orientation = this._orientation(t.orientation), this.forceUpdate = t.forceUpdate, this.minDate = this._minDate(t.minDate), this.maxDate = this._maxDate(t.maxDate), this.startDate = this._startDate(t.startDate), this.endDate = this._endDate(t.endDate), this.ranges = this._ranges(t.ranges), this.isCustomPeriodRangeActive = ko.observable(!1), this.anchorElement = this._anchorElement(t.anchorElement), this.parentElement = this._parentElement(t.parentElement), this.callback = this._callback(t.callback), this.firstDayOfWeek.subscribe(function(t) {
                return u.setFirstDayOfTheWeek(t)
            }), u.setFirstDayOfTheWeek(this.firstDayOfWeek())
        }
        return e.prototype.extend = function(t) {
            var e, n, a, r;
            n = this, a = [];
            for (e in n) r = n[e], this.hasOwnProperty(e) && "_" !== e[0] && a.push(t[e] = r);
            return a
        }, e.prototype._firstDayOfWeek = function(t) {
            return ko.observable(t ? t : 0)
        }, e.prototype._timeZone = function(t) {
            return ko.observable(t || "UTC")
        }, e.prototype._periods = function(t) {
            return ko.observableArray(t || d.allPeriods)
        }, e.prototype._customPeriodRanges = function(t) {
            var e, n, a;
            t || (t = {}), e = [];
            for (n in t) a = t[n], e.push(this.parseRange(a, n));
            return e
        }, e.prototype._period = function(t) {
            if (t || (t = this.periods()[0]), "day" !== t && "week" !== t && "month" !== t && "quarter" !== t && "year" !== t) throw new Error("Invalid period");
            return d.extendObservable(ko.observable(t))
        }, e.prototype._single = function(t) {
            return ko.observable(t || !1)
        }, e.prototype._opened = function(t) {
            return ko.observable(t || !1)
        }, e.prototype._expanded = function(t) {
            return ko.observable(t || !1)
        }, e.prototype._standalone = function(t) {
            return ko.observable(t || !1)
        }, e.prototype._hideWeekdays = function(t) {
            return ko.observable(t || !1)
        }, e.prototype._minDate = function(t) {
            var e, n;
            return t instanceof Array && (n = t, t = n[0], e = n[1]), t || (t = moment().subtract(30, "years")), this._dateObservable(t, e)
        }, e.prototype._maxDate = function(t) {
            var e, n;
            return t instanceof Array && (n = t, t = n[0], e = n[1]), t || (t = moment()), this._dateObservable(t, e, this.minDate)
        }, e.prototype._startDate = function(t) {
            return t || (t = moment().subtract(29, "days")), this._dateObservable(t, null, this.minDate, this.maxDate)
        }, e.prototype._endDate = function(t) {
            return t || (t = moment()), this._dateObservable(t, null, this.startDate, this.maxDate)
        }, e.prototype._ranges = function(e) {
            var n, a, r;
            if (e || (e = this._defaultRanges()), !$.isPlainObject(e)) throw new Error("Invalid ranges parameter (should be a plain object)");
            n = [];
            for (a in e) switch (r = e[a]) {
                case "all-time":
                    n.push(new t(a, this.minDate().clone(), this.maxDate().clone()));
                    break;
                case "custom":
                    n.push(new i(a));
                    break;
                default:
                    n.push(this.parseRange(r, a))
            }
            return n
        }, e.prototype.parseRange = function(t, e) {
            var n, a, r, i;
            if (!$.isArray(t)) throw new Error("Value should be an array");
            if (r = t[0], n = t[1], !r) throw new Error("Missing start date");
            if (!n) throw new Error("Missing end date");
            if (a = u.tz(r, this.timeZone()), i = u.tz(n, this.timeZone()), !a.isValid()) throw new Error("Invalid start date");
            if (!i.isValid()) throw new Error("Invalid end date");
            return new o(e, a, i)
        }, e.prototype._locale = function(t) {
            return $.extend({
                applyButtonTitle: "Apply",
                cancelButtonTitle: "Cancel",
                inputFormat: "L",
                startLabel: "Start",
                endLabel: "End"
            }, t || {})
        }, e.prototype._orientation = function(t) {
            if (t || (t = "right"), "right" !== t && "left" !== t) throw new Error("Invalid orientation");
            return ko.observable(t)
        }, e.prototype._dateObservable = function(t, e, n, a) {
            var r, i, o, s;
            return s = ko.observable(), r = ko.computed({
                read: function() {
                    return s()
                },
                write: function(t) {
                    return function(t) {
                        var e;
                        if (t = r.fit(t), e = s(), !e || !t.isSame(e)) return s(t)
                    }
                }(this)
            }), r.mode = e || "inclusive", o = function(t) {
                return function(e) {
                    var a;
                    if (n) {
                        switch (a = n(), n.mode) {
                            case "extended":
                                a = a.clone().startOf(t.period());
                                break;
                            case "exclusive":
                                a = a.clone().endOf(t.period()).add(1, "millisecond")
                        }
                        e = moment.max(a, e)
                    }
                    return e
                }
            }(this), i = function(t) {
                return function(e) {
                    var n;
                    if (a) {
                        switch (n = a(), a.mode) {
                            case "extended":
                                n = n.clone().endOf(t.period());
                                break;
                            case "exclusive":
                                n = n.clone().startOf(t.period()).subtract(1, "millisecond")
                        }
                        e = moment.min(n, e)
                    }
                    return e
                }
            }(this), r.fit = function(t) {
                return function(e) {
                    return e = u.tz(e, t.timeZone()), i(o(e))
                }
            }(this), r(t), r.clone = function(t) {
                return function() {
                    return t._dateObservable(s(), r.mode, n, a)
                }
            }(this), r.isWithinBoundaries = function(t) {
                return function(e) {
                    var r, i, o, s, c, d, l;
                    return e = u.tz(e, t.timeZone()), s = n(), i = a(), r = e.isBetween(s, i, t.period()), l = e.isSame(s, t.period()), d = e.isSame(i, t.period()), c = "exclusive" === n.mode, o = "exclusive" === a.mode, r || !c && l && !(o && d) || !o && d && !(c && l)
                }
            }(this), n && (r.minBoundary = n, n.subscribe(function() {
                return r(s())
            })), a && (r.maxBoundary = a, a.subscribe(function() {
                return r(s())
            })), r
        }, e.prototype._defaultRanges = function() {
            return {
                /*"Last 30 days": [moment().subtract(29, "days"), moment()],
                "Last 90 days": [moment().subtract(89, "days"), moment()],
                "Last Year": [moment().subtract(1, "year").add(1, "day"), moment()],
                "All Time": "all-time",
                "Custom Range": "custom"*/
            }
        }, e.prototype._anchorElement = function(t) {
            return $(t)
        }, e.prototype._parentElement = function(t) {
            return $(t || (this.standalone() ? this.anchorElement : "body"))
        }, e.prototype._callback = function(t) {
            if (t && !$.isFunction(t)) throw new Error("Invalid callback (not a function)");
            return t
        }, e
    }(), n = function() {
        function t(t) {
            this.clickNextButton = p(this.clickNextButton, this), this.clickPrevButton = p(this.clickPrevButton, this), this.currentDate = t.currentDate, this.period = t.period, this.timeZone = t.timeZone, this.firstDate = t.firstDate, this.firstYearOfDecade = t.firstYearOfDecade, this.prevDate = ko.pureComputed(function(t) {
                return function() {
                    var e, n, a;
                    return a = t.period.nextPageArguments(), e = a[0], n = a[1], t.currentDate().clone().subtract(e, n)
                }
            }(this)), this.nextDate = ko.pureComputed(function(t) {
                return function() {
                    var e, n, a;
                    return a = t.period.nextPageArguments(), e = a[0], n = a[1], t.currentDate().clone().add(e, n)
                }
            }(this)), this.selectedMonth = ko.computed({
                read: function(t) {
                    return function() {
                        return t.currentDate().month()
                    }
                }(this),
                write: function(t) {
                    return function(e) {
                        var n;
                        if (n = t.currentDate().clone().month(e), !n.isSame(t.currentDate(), "month")) return t.currentDate(n)
                    }
                }(this),
                pure: !0
            }), this.selectedYear = ko.computed({
                read: function(t) {
                    return function() {
                        return t.currentDate().year()
                    }
                }(this),
                write: function(t) {
                    return function(e) {
                        var n;
                        if (n = t.currentDate().clone().year(e), !n.isSame(t.currentDate(), "year")) return t.currentDate(n)
                    }
                }(this),
                pure: !0
            }), this.selectedDecade = ko.computed({
                read: function(t) {
                    return function() {
                        return t.firstYearOfDecade(t.currentDate()).year()
                    }
                }(this),
                write: function(t) {
                    return function(e) {
                        var n, a, r;
                        if (r = (t.currentDate().year() - t.selectedDecade()) % 9, a = e + r, n = t.currentDate().clone().year(a), !n.isSame(t.currentDate(), "year")) return t.currentDate(n)
                    }
                }(this),
                pure: !0
            })
        }
        return t.prototype.clickPrevButton = function() {
            return this.currentDate(this.prevDate())
        }, t.prototype.clickNextButton = function() {
            return this.currentDate(this.nextDate())
        }, t.prototype.prevArrowCss = function() {
            var t, e;
            return t = this.firstDate().clone().subtract(1, "millisecond"), "day" !== (e = this.period()) && "week" !== e || (t = t.endOf("month")), {
                "arrow-hidden": !this.currentDate.isWithinBoundaries(t)
            }
        }, t.prototype.nextArrowCss = function() {
            var t, e, n, a, r;
            return n = this.period.dimentions(), t = n[0], r = n[1], e = this.firstDate().clone().add(t * r, this.period()), "day" !== (a = this.period()) && "week" !== a || (e = e.startOf("month")), {
                "arrow-hidden": !this.currentDate.isWithinBoundaries(e)
            }
        }, t.prototype.monthOptions = function() {
            var t, e, n;
            return e = this.currentDate.minBoundary().isSame(this.currentDate(), "year") ? this.currentDate.minBoundary().month() : 0, t = this.currentDate.maxBoundary().isSame(this.currentDate(), "year") ? this.currentDate.maxBoundary().month() : 11,
                function() {
                    n = [];
                    for (var a = e; e <= t ? a <= t : a >= t; e <= t ? a++ : a--) n.push(a);
                    return n
                }.apply(this)
        }, t.prototype.yearOptions = function() {
            var t, e;
            return function() {
                e = [];
                for (var n = t = this.currentDate.minBoundary().year(), a = this.currentDate.maxBoundary().year(); t <= a ? n <= a : n >= a; t <= a ? n++ : n--) e.push(n);
                return e
            }.apply(this)
        }, t.prototype.decadeOptions = function() {
            return e.uniqArray(this.yearOptions().map(function(t) {
                return function(e) {
                    var n;
                    return n = u.tz([e], t.timeZone()), t.firstYearOfDecade(n).year()
                }
            }(this)))
        }, t.prototype.monthSelectorAvailable = function() {
            var t;
            return "day" === (t = this.period()) || "week" === t
        }, t.prototype.yearSelectorAvailable = function() {
            return "year" !== this.period()
        }, t.prototype.decadeSelectorAvailable = function() {
            return "year" === this.period()
        }, t.prototype.monthFormatter = function(t) {
            return moment.utc([2015, t]).format("MMM")
        }, t.prototype.yearFormatter = function(t) {
            return moment.utc([t]).format("YYYY")
        }, t.prototype.decadeFormatter = function(t) {
            var e, n, a, r;
            return n = d.dimentions("year"), e = n[0], a = n[1], r = t + e * a - 1, t + " – " + r
        }, t
    }(), a = function() {
        function t(t, e, a) {
            this.cssForDate = p(this.cssForDate, this), this.eventsForDate = p(this.eventsForDate, this), this.formatDateTemplate = p(this.formatDateTemplate, this), this.tableValues = p(this.tableValues, this), this.inRange = p(this.inRange, this), this.period = t.period, this.single = t.single, this.timeZone = t.timeZone, this.locale = t.locale, this.startDate = t.startDate, this.endDate = t.endDate, this.isCustomPeriodRangeActive = t.isCustomPeriodRangeActive, this.type = a, this.label = t.locale[a + "Label"] || "", this.hoverDate = ko.observable(null), this.activeDate = e, this.currentDate = e.clone(), this.inputDate = ko.computed({
                read: function(t) {
                    return function() {
                        return (t.hoverDate() || t.activeDate()).format(t.locale.inputFormat)
                    }
                }(this),
                write: function(t) {
                    return function(e) {
                        var n;
                        if (n = u.tz(e, t.locale.inputFormat, t.timeZone()), n.isValid()) return t.activeDate(n)
                    }
                }(this),
                pure: !0
            }), this.firstDate = ko.pureComputed(function(t) {
                return function() {
                    var e, n;
                    switch (e = t.currentDate().clone().startOf(t.period.scale()), t.period()) {
                        case "day":
                        case "week":
                            n = e.clone(), e.weekday(0), (e.isAfter(n) || e.isSame(n, "day")) && e.subtract(1, "week");
                            break;
                        case "year":
                            e = t.firstYearOfDecade(e)
                    }
                    return e
                }
            }(this)), this.activeDate.subscribe(function(t) {
                return function(e) {
                    return t.currentDate(e)
                }
            }(this)), this.headerView = new n(this)
        }
        return t.prototype.calendar = function() {
            var t, e, n, a, r, i, o, s, u, d;
            for (i = this.period.dimentions(), e = i[0], d = i[1], a = new c(this.firstDate(), this.period()), s = [], u = r = 1, o = d; 1 <= o ? r <= o : r >= o; u = 1 <= o ? ++r : --r) s.push(function() {
                var r, i, o;
                for (o = [], t = r = 1, i = e; 1 <= i ? r <= i : r >= i; t = 1 <= i ? ++r : --r) n = a.next(), "end" === this.type ? o.push(n.endOf(this.period())) : o.push(n.startOf(this.period()));
                return o
            }.call(this));
            return s
        }, t.prototype.weekDayNames = function() {
            return e.rotateArray(moment.weekdaysMin(), moment.localeData().firstDayOfWeek())
        }, t.prototype.inRange = function(t) {
            return t.isAfter(this.startDate(), this.period()) && t.isBefore(this.endDate(), this.period()) || t.isSame(this.startDate(), this.period()) || t.isSame(this.endDate(), this.period())
        }, t.prototype.tableValues = function(t) {
            var e, n, a;
            switch (e = this.period.format(), this.period()) {
                case "day":
                case "month":
                case "year":
                    return [{
                        html: t.format(e)
                    }];
                case "week":
                    return t = t.clone().startOf(this.period()), c.array(t, 7, "day").map(function(t) {
                        return function(n) {
                            return {
                                html: n.format(e),
                                css: {
                                    "week-day": !0,
                                    unavailable: t.cssForDate(n, !0).unavailable
                                }
                            }
                        }
                    }(this));
                case "quarter":
                    return a = t.format(e), t = t.clone().startOf("quarter"), n = c.array(t, 3, "month").map(function(t) {
                        return t.format("MMM")
                    }), [{
                        html: a + "<br><span class='months'>" + n.join(", ") + "</span>"
                    }]
            }
        }, t.prototype.formatDateTemplate = function(t) {
            return {
                nodes: $("<div>" + this.formatDate(t) + "</div>").children()
            }
        }, t.prototype.eventsForDate = function(t) {
            return {
                click: function(e) {
                    return function() {
                        if (e.activeDate.isWithinBoundaries(t)) return e.activeDate(t)
                    }
                }(this),
                mouseenter: function(e) {
                    return function() {
                        if (e.activeDate.isWithinBoundaries(t)) return e.hoverDate(e.activeDate.fit(t))
                    }
                }(this),
                mouseleave: function(t) {
                    return function() {
                        return t.hoverDate(null)
                    }
                }(this)
            }
        }, t.prototype.cssForDate = function(t, e) {
            var n, a, r, i, o;
            return i = t.isSame(this.activeDate(), this.period()), o = this.activeDate.isWithinBoundaries(t), e || (e = "day" === this.period()), n = !t.isSame(this.currentDate(), "month"), a = this.inRange(t), r = {
                "in-range": !this.single() && (a || i)
            }, r[this.type + "-date"] = i, r.clickable = o && !this.isCustomPeriodRangeActive(), r["out-of-boundaries"] = !o || this.isCustomPeriodRangeActive(), r.unavailable = e && n, r
        }, t.prototype.firstYearOfDecade = function(t) {
            var e, n, a, r;
            return e = u.tz(moment(), this.timeZone()).year(), n = e - 4, a = Math.floor((t.year() - n) / 9), r = n + 9 * a, u.tz([r], this.timeZone())
        }, t
    }(), s = function() {
        function t(t) {
            var e, n, i, o;
            null == t && (t = {}), this.outsideClick = p(this.outsideClick, this), this.setCustomPeriodRange = p(this.setCustomPeriodRange, this), this.setDateRange = p(this.setDateRange, this), new r(t).extend(this), this.startCalendar = new a(this, this.startDate, "start"), this.endCalendar = new a(this, this.endDate, "end"), this.startDateInput = this.startCalendar.inputDate, this.endDateInput = this.endCalendar.inputDate, this.dateRange = ko.observable([this.startDate(), this.endDate()]), this.startDate.subscribe(function(t) {
                return function(e) {
                    return t.single() ? (t.endDate(e.clone().endOf(t.period())), t.updateDateRange(), t.close()) : (t.endDate().isSame(e) && t.endDate(t.endDate().clone().endOf(t.period())), t.standalone() ? t.updateDateRange() : void 0)
                }
            }(this)), this.style = ko.observable({}), this.callback && (this.dateRange.subscribe(function(t) {
                return function(e) {
                    var n, a;
                    return a = e[0], n = e[1], t.callback(a.clone(), n.clone(), t.period())
                }
            }(this)), this.forceUpdate && (n = this.dateRange(), i = n[0], e = n[1], this.callback(i.clone(), e.clone(), this.period()))), this.anchorElement && (o = $('<div data-bind="stopBinding: true"></div>').appendTo(this.parentElement), this.containerElement = $(this.constructor.template).appendTo(o), ko.applyBindings(this, this.containerElement.get(0)), this.anchorElement.click(function(t) {
                return function() {
                    return t.updatePosition(), t.toggle()
                }
            }(this)), this.standalone() || $(document).on("mousedown.daterangepicker", this.outsideClick).on("touchend.daterangepicker", this.outsideClick).on("click.daterangepicker", "[data-toggle=dropdown]", this.outsideClick).on("focusin.daterangepicker", this.outsideClick)), this.opened() && this.updatePosition()
        }
        return t.prototype.periodProxy = d, t.prototype.calendars = function() {
            return this.single() ? [this.startCalendar] : [this.startCalendar, this.endCalendar]
        }, t.prototype.updateDateRange = function() {
            return this.dateRange([this.startDate(), this.endDate()])
        }, t.prototype.cssClasses = function() {
            var t, e, n, a, r;
            for (n = {
                    single: this.single(),
                    opened: this.standalone() || this.opened(),
                    expanded: this.standalone() || this.single() || this.expanded(),
                    standalone: this.standalone(),
                    "hide-weekdays": this.hideWeekdays(),
                    "hide-periods": this.periods().length + this.customPeriodRanges.length === 1,
                    "orientation-left": "left" === this.orientation(),
                    "orientation-right": "right" === this.orientation()
                }, r = d.allPeriods, t = 0, e = r.length; t < e; t++) a = r[t], n[a + "-period"] = a === this.period();
            return n
        }, t.prototype.isActivePeriod = function(t) {
            return this.period() === t
        }, t.prototype.isActiveDateRange = function(t) {
            var e, n, a, r;
            if (t.constructor === i) {
                for (r = this.ranges, n = 0, a = r.length; n < a; n++)
                    if (e = r[n], e.constructor !== i && this.isActiveDateRange(e)) return !1;
                return !0
            }
            return this.startDate().isSame(t.startDate, "day") && this.endDate().isSame(t.endDate, "day")
        }, t.prototype.isActiveCustomPeriodRange = function(t) {
            return this.isActiveDateRange(t) && this.isCustomPeriodRangeActive()
        }, t.prototype.inputFocus = function() {
            return this.expanded(!0)
        }, t.prototype.setPeriod = function(t) {
            return this.isCustomPeriodRangeActive(!1), this.period(t), this.expanded(!0)
        }, t.prototype.setDateRange = function(t) {
            return t.constructor === i ? this.expanded(!0) : (this.expanded(!1), this.close(), this.period("day"), this.startDate(t.startDate), this.endDate(t.endDate), this.updateDateRange())
        }, t.prototype.setCustomPeriodRange = function(t) {
            return this.isCustomPeriodRangeActive(!0), this.setDateRange(t)
        }, t.prototype.applyChanges = function() {
            return this.close(), this.updateDateRange()
        }, t.prototype.cancelChanges = function() {
            return this.close()
        }, t.prototype.open = function() {
            return this.opened(!0)
        }, t.prototype.close = function() {
            if (!this.standalone()) return this.opened(!1)
        }, t.prototype.toggle = function() {
            return this.opened() ? this.close() : this.open()
        }, t.prototype.updatePosition = function() {
            var t, e, n;
            if (!this.standalone()) {
                switch (t = {
                        top: 0,
                        left: 0
                    }, e = $(window).width(), this.parentElement.is("body") || (t = {
                        top: this.parentElement.offset().top - this.parentElement.scrollTop(),
                        left: this.parentElement.offset().left - this.parentElement.scrollLeft()
                    }, e = this.parentElement.get(0).clientWidth + this.parentElement.offset().left), n = {
                        top: this.anchorElement.offset().top + this.anchorElement.outerHeight() - t.top + "px",
                        left: "auto",
                        right: "auto"
                    }, this.orientation()) {
                    case "left":
                        this.containerElement.offset().left < 0 ? n.left = "9px" : n.right = e - this.anchorElement.offset().left - this.anchorElement.outerWidth() + "px";
                        break;
                    default:
                        this.containerElement.offset().left + this.containerElement.outerWidth() > $(window).width() ? n.right = "0" : n.left = this.anchorElement.offset().left - t.left + "px"
                }
                return this.style(n)
            }
        }, t.prototype.outsideClick = function(t) {
            var e;
            if (e = $(t.target), !("focusin" === t.type || e.closest(this.anchorElement).length || e.closest(this.containerElement).length || e.closest(".calendar").length)) return this.close()
        }, t
    }(), s.template = '<div class="daterangepicker" data-bind="css: $data.cssClasses(), style: $data.style()"> <div class="controls"> <ul class="periods"> <!-- ko foreach: $data.periods --> <li class="period" data-bind="css: {active: $parent.isActivePeriod($data) && !$parent.isCustomPeriodRangeActive()}, text: $parent.periodProxy.title($data), click: function(){ $parent.setPeriod($data); }"></li> <!-- /ko --> <!-- ko foreach: $data.customPeriodRanges --> <li class="period" data-bind="css: {active: $parent.isActiveCustomPeriodRange($data)}, text: $data.title, click: function(){ $parent.setCustomPeriodRange($data); }"></li> <!-- /ko --> </ul> <ul class="ranges" data-bind="foreach: $data.ranges"> <li class="range" data-bind="css: {active: $parent.isActiveDateRange($data)}, text: $data.title, click: function(){ $parent.setDateRange($data); }"></li> </ul> <form data-bind="submit: $data.applyChanges"> <div class="custom-range-inputs"> <input type="text" data-bind="value: $data.startDateInput, event: {focus: $data.inputFocus}" readonly/> <input type="text" data-bind="value: $data.endDateInput, event: {focus: $data.inputFocus}" readonly/> </div> <div class="custom-range-buttons"> <button class="apply-btn" type="submit" data-bind="text: $data.locale.applyButtonTitle, click: $data.applyChanges"></button> <button class="cancel-btn" data-bind="text: $data.locale.cancelButtonTitle, click: $data.cancelChanges"></button> </div> </form> </div> <!-- ko foreach: $data.calendars() --> <div class="calendar"> <div class="calendar-title" data-bind="text: $data.label"></div> <div class="calendar-header" data-bind="with: $data.headerView"> <div class="arrow" data-bind="css: $data.prevArrowCss()"> <button data-bind="click: $data.clickPrevButton"><span class="arrow-left"></span></button> </div> <div class="calendar-selects"> <select class="month-select" data-bind="options: $data.monthOptions(), optionsText: $data.monthFormatter, valueAllowUnset: true, value: $data.selectedMonth, css: {hidden: !$data.monthSelectorAvailable()}"></select> <select class="year-select" data-bind="options: $data.yearOptions(), optionsText: $data.yearFormatter, valueAllowUnset: true, value: $data.selectedYear, css: {hidden: !$data.yearSelectorAvailable()}"></select> <select class="decade-select" data-bind="options: $data.decadeOptions(), optionsText: $data.decadeFormatter, valueAllowUnset: true, value: $data.selectedDecade, css: {hidden: !$data.decadeSelectorAvailable()}"></select> </div> <div class="arrow" data-bind="css: $data.nextArrowCss()"> <button data-bind="click: $data.clickNextButton"><span class="arrow-right"></span></button> </div> </div> <div class="calendar-table"> <!-- ko if: $parent.periodProxy.showWeekDayNames($data.period()) --> <div class="table-row weekdays" data-bind="foreach: $data.weekDayNames()"> <div class="table-col"> <div class="table-value-wrapper"> <div class="table-value" data-bind="text: $data"></div> </div> </div> </div> <!-- /ko --> <!-- ko foreach: $data.calendar() --> <div class="table-row" data-bind="foreach: $data"> <div class="table-col" data-bind="event: $parents[1].eventsForDate($data), css: $parents[1].cssForDate($data)"> <div class="table-value-wrapper" data-bind="foreach: $parents[1].tableValues($data)"> <div class="table-value" data-bind="html: $data.html, css: $data.css"></div> </div> </div> </div> <!-- /ko --> </div> </div> <!-- /ko --> </div>', $.extend($.fn.daterangepicker, {
        ArrayUtils: e,
        MomentIterator: c,
        MomentUtil: u,
        Period: d,
        Config: r,
        DateRange: o,
        AllTimeDateRange: t,
        CustomDateRange: i,
        DateRangePickerView: s,
        CalendarView: a,
        CalendarHeaderView: n
    })
}).call(this);


$(".daterangepicker_field").daterangepicker({
    //forceUpdate: true,
    callback: function(startDate, endDate, period) {
        var title = startDate.format('MM-DD-YYYY') + ' to ' + endDate.format('MM-DD-YYYY');
        $(this).val(title)
    }
});
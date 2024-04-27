! function (t) {
    var e = {};

    function n(c) {
        if (e[c]) return e[c].exports;
        var r = e[c] = {
            i: c,
            l: !1,
            exports: {}
        };
        return t[c].call(r.exports, r, r.exports, n), r.l = !0, r.exports
    }
    n.m = t, n.c = e, n.d = function (t, e, c) {
        n.o(t, e) || Object.defineProperty(t, e, {
            enumerable: !0,
            get: c
        })
    }, n.r = function (t) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(t, Symbol.toStringTag, {
            value: "Module"
        }), Object.defineProperty(t, "__esModule", {
            value: !0
        })
    }, n.t = function (t, e) {
        if (1 & e && (t = n(t)), 8 & e) return t;
        if (4 & e && "object" == typeof t && t && t.__esModule) return t;
        var c = Object.create(null);
        if (n.r(c), Object.defineProperty(c, "default", {
                enumerable: !0,
                value: t
            }), 2 & e && "string" != typeof t)
            for (var r in t) n.d(c, r, function (e) {
                return t[e]
            }.bind(null, r));
        return c
    }, n.n = function (t) {
        var e = t && t.__esModule ? function () {
            return t.default
        } : function () {
            return t
        };
        return n.d(e, "a", e), e
    }, n.o = function (t, e) {
        return Object.prototype.hasOwnProperty.call(t, e)
    }, n.p = "", n(n.s = 8)
}([function (t, e) {
    ! function () {
        t.exports = this.wp.element
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.editor
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.blocks
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.components
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.compose
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.richText
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.blockEditor
    }()
}, function (t, e) {
    ! function () {
        t.exports = this.wp.data
    }()
}, function (t, e, n) {
    "use strict";
    n.r(e);
    var c = n(0),
        r = n(2),
        a = n(1);

    function o(t, e) {
        var n = !(arguments.length > 2 && void 0 !== arguments[2]) || arguments[2] ? " " : "";
        return void 0 !== t[e] ? n + t[e] : ""
    }
    Object(r.registerBlockType)("kikoiro1/sub-info", {
        title: "補足情報",
        icon: "editor-ul",
        category: "kikoiro1",
        example: {},
        edit: function (t) {
            t.className;
            return Object(c.createElement)("div", {
                class: "test2"
            }, Object(c.createElement)(a.InnerBlocks, {
                allowedBlocks: ["core/image", "core/paragraph"],
                template: [
                    ["core/paragraph", {
                        placeholder: "title"
                    }],
                    ["core/paragraph", {
                        placeholder: "content"
                    }]
                ]
            }))
        },
        save: function () {
            return Object(c.createElement)("div", null, Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    }), Object(r.registerBlockType)("kikoiro1/references", {
        title: "参考文献",
        icon: "editor-ol",
        category: "kikoiro1",
        attributes: {
            titleContent: {
                selector: "h2",
                type: "string",
                source: "html",
                default: "参考文献"
            },
            content: {
                selector: "ol",
                type: "array",
                source: "children"
            }
        },
        edit: function (t) {
            var e = t.attributes.content,
                n = t.attributes.titleContent;
            return Object(c.createElement)("div", {
                class: "references" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText, {
                tagName: "h2",
                value: n,
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            }), Object(c.createElement)(a.RichText, {
                tagName: "ol",
                value: e,
                multiline: "li",
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "references" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText.Content, {
                tagName: "h2",
                value: t.attributes.titleContent
            }), Object(c.createElement)(a.RichText.Content, {
                tagName: "ol",
                value: t.attributes.content
            }))
        }
    }), Object(r.registerBlockType)("kikoiro1/point-list", {
        title: "ポイントリスト",
        icon: "editor-ul",
        category: "kikoiro1",
        attributes: {
            titleContent: {
                selector: "span",
                type: "string",
                source: "html",
                default: "タイトル"
            }
        },
        edit: function (t) {
            var e = t.attributes.titleContent;
            return Object(c.createElement)("div", {
                class: "point-list" + o(t.attributes, "className")
            }, Object(c.createElement)("h4", null, Object(c.createElement)(a.RichText, {
                tagName: "span",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            })), Object(c.createElement)(a.InnerBlocks, {
                allowedBlocks: ["core/list", "core/paragraph"],
                template: [
                    ["core/list", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "point-list" + o(t.attributes, "className")
            }, Object(c.createElement)("h4", null, Object(c.createElement)(a.RichText.Content, {
                tagName: "span",
                value: t.attributes.titleContent
            })), Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    }), Object(r.registerBlockType)("kikoiro1/interview-q", {
        title: "インタビュー設問",
        icon: "microphone",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "p",
                type: "string",
                source: "html",
                default: "設問"
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/interview-q", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/paragraph", {
                        content: e
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return Object(c.createElement)(a.RichText, {
                tagName: "p",
                className: "interview_q",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "p",
                className: "interview_q",
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/interview-a", {
        title: "インタビュー回答",
        icon: "microphone",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "p",
                type: "string",
                source: "html",
                default: "設問"
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/interview-a", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/paragraph", {
                        content: e
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return Object(c.createElement)(a.RichText, {
                tagName: "p",
                className: "interview_a",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "p",
                className: "interview_a",
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/interviewee-profile", {
        title: "インタビュイープロフィール（当事者本人）",
        icon: "admin-users",
        category: "kikoiro1",
        edit: function (t) {
            return Object(c.createElement)("div", {
                class: "interviewee_profile" + o(t.attributes, "className")
            }, Object(c.createElement)("h4", null, "お話を伺った方のプロフィール"), Object(c.createElement)(a.InnerBlocks, {
                templateLock: "all",
                template: [
                    ["core/list", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "interviewee_profile" + o(t.attributes, "className")
            }, Object(c.createElement)("h4", null, "お話を伺った方のプロフィール"), Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    }), Object(r.registerBlockType)("kikoiro1/interviewee-profile-f", {
        title: "インタビュイープロフィール（当事者家族）",
        icon: "admin-users",
        category: "kikoiro1",
        edit: function (t) {
            return Object(c.createElement)("div", {
                class: "interviewee_profile" + o(t.attributes, "className")
            }, Object(c.createElement)("h4", null, "お話を伺った方のプロフィール"), Object(c.createElement)(a.InnerBlocks, {
                templateLock: "all",
                template: [
                    ["core/list", {}],
                    ["core/paragraph", {
                        placeholder: "誰が当事者か（例：「娘さんのこと」）"
                    }],
                    ["core/list", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "interviewee_profile" + o(t.attributes, "className")
            }, Object(c.createElement)("h4", null, "お話を伺った方のプロフィール"), Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    }), Object(r.registerBlockType)("kikoiro1/nextpage", {
        title: "改ページ",
        icon: "editor-break",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "strong",
                type: "string",
                source: "html",
                default: ""
            }
        },
        edit: function (t) {
            var e = t.attributes.content;
            return Object(c.createElement)("p", {
                class: "nextpage" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText, {
                tagName: "strong",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            }), Object(c.createElement)("span", {
                dangerouslySetInnerHTML: {
                    __html: "\x3c!--nextpage--\x3e"
                }
            }))
        },
        save: function (t) {
            return Object(c.createElement)("p", {
                class: "nextpage" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText.Content, {
                tagName: "strong",
                value: t.attributes.content
            }), Object(c.createElement)("span", {
                dangerouslySetInnerHTML: {
                    __html: "\x3c!--nextpage--\x3e"
                }
            }))
        }
    }), Object(r.registerBlockType)("kikoiro1/medical-desc", {
        title: "医学的説明",
        icon: "editor-table",
        category: "kikoiro1",
        attributes: {
            titleContent: {
                selector: "h3",
                type: "string",
                source: "html"
            },
            titleContent2: {
                selector: "h4",
                type: "string",
                source: "html"
            }
        },
        edit: function (t) {
            var e = t.attributes.titleContent,
                n = t.attributes.titleContent2;
            return Object(c.createElement)("div", {
                class: "medical-desc" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText, {
                tagName: "h3",
                value: e,
                placeholder: "タイトル",
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            }), Object(c.createElement)(a.RichText, {
                tagName: "h4",
                value: n,
                placeholder: "サブタイトル",
                onChange: function (e) {
                    t.setAttributes({
                        titleContent2: e
                    })
                }
            }), Object(c.createElement)(a.InnerBlocks, {
                allowedBlocks: ["kikoiro1/medical-desc-disease", "kikoiro1/medical-desc-point"],
                template: [
                    ["kikoiro1/medical-desc-disease", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "medical-desc" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText.Content, {
                tagName: "h3",
                value: t.attributes.titleContent
            }), Object(c.createElement)(a.RichText.Content, {
                tagName: "h4",
                value: t.attributes.titleContent2
            }), Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    }), Object(r.registerBlockType)("kikoiro1/medical-desc-disease", {
        title: "医学的説明-疾患",
        icon: "editor-table",
        category: "kikoiro1",
        parent: ["kikoiro1/medical-desc"],
        attributes: {
            titleContent: {
                selector: "h4",
                type: "string",
                source: "html"
            }
        },
        edit: function (t) {
            var e = t.attributes.titleContent;
            return Object(c.createElement)("div", {
                class: "medical-desc-disease"
            }, Object(c.createElement)(a.RichText, {
                tagName: "h4",
                value: e,
                placeholder: "表題",
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            }), Object(c.createElement)(a.InnerBlocks, {
                templateLock: "all",
                template: [
                    ["core/table", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "medical-desc-disease"
            }, Object(c.createElement)(a.RichText.Content, {
                tagName: "h4",
                value: t.attributes.titleContent
            }), Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    }), Object(r.registerBlockType)("kikoiro1/medical-desc-point", {
        title: "医学的説明-ポイント",
        icon: "editor-ul",
        category: "kikoiro1",
        parent: ["kikoiro1/medical-desc"],
        attributes: {
            titleContent: {
                selector: "h4",
                type: "string",
                source: "html"
            },
            content: {
                selector: "ul",
                type: "array",
                source: "children"
            }
        },
        edit: function (t) {
            var e = t.attributes.titleContent,
                n = t.attributes.content;
            return Object(c.createElement)("div", {
                className: "medical-desc-point"
            }, Object(c.createElement)(a.RichText, {
                tagName: "h4",
                value: e,
                placeholder: "タイトル",
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            }), Object(c.createElement)(a.RichText, {
                tagName: "ul",
                value: n,
                multiline: "li",
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                className: "medical-desc-point"
            }, Object(c.createElement)(a.RichText.Content, {
                tagName: "h4",
                value: t.attributes.titleContent
            }), Object(c.createElement)(a.RichText.Content, {
                tagName: "ul",
                value: t.attributes.content
            }))
        }
    });
    var i = n(3);
    Object(r.registerBlockType)("kikoiro1/main-ul", {
        title: "本文-リスト",
        icon: "editor-ul",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "ul",
                type: "string",
                source: "html",
                multiline: "li",
                default: ""
            },
            isWhiteBackground: {
                type: "boolean",
                default: !1
            },
            isWideVerticalMargin: {
                type: "boolean",
                default: !1
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/list"],
                transform: function (t) {
                    return console.log(t), Object(r.createBlock)("kikoiro1/main-ul", {
                        content: t.values
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/list"],
                transform: function (t) {
                    return console.log(t), Object(r.createBlock)("core/list", {
                        values: t.content,
                        ordered: !1
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return [Object(c.createElement)(a.InspectorControls, null, Object(c.createElement)(i.PanelBody, {
                title: "設定"
            }, Object(c.createElement)(i.CheckboxControl, {
                label: "背景色を白にする",
                checked: t.attributes.isWhiteBackground || !1,
                onChange: function (e) {
                    t.setAttributes({
                        isWhiteBackground: e
                    })
                }
            }), Object(c.createElement)(i.CheckboxControl, {
                label: "行マージン広め",
                checked: t.attributes.isWideVerticalMargin || !1,
                onChange: function (e) {
                    t.setAttributes({
                        isWideVerticalMargin: e
                    })
                }
            }))), Object(c.createElement)(a.RichText, {
                tagName: "ul",
                className: "withPadding ".concat(o(t.attributes, "className"), " \n                    ").concat(!0 === t.attributes.isWhiteBackground ? "whiteBackground" : "", " \n                    ").concat(!0 === t.attributes.isWideVerticalMargin ? "withItemBottomMarginWide" : "withItemBottomMargin"),
                multiline: "li",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })]
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "ul",
                className: "withPadding ".concat(o(t.attributes, "className"), " \n                    ").concat(!0 === t.attributes.isWhiteBackground ? "whiteBackground" : "", " \n                    ").concat(!0 === t.attributes.isWideVerticalMargin ? "withItemBottomMarginWide" : "withItemBottomMargin"),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/main-ol", {
        title: "本文-リスト",
        icon: "editor-ol",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "ol",
                type: "string",
                source: "html",
                multiline: "li",
                default: ""
            },
            isWhiteBackground: {
                type: "boolean",
                default: !1
            },
            isWideVerticalMargin: {
                type: "boolean",
                default: !1
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/list"],
                transform: function (t) {
                    return console.log(t), Object(r.createBlock)("kikoiro1/main-ol", {
                        content: t.values
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/list"],
                transform: function (t) {
                    return console.log(t), Object(r.createBlock)("core/list", {
                        values: t.content,
                        ordered: !1
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return [Object(c.createElement)(a.InspectorControls, null, Object(c.createElement)(i.PanelBody, {
                title: "設定"
            }, Object(c.createElement)(i.CheckboxControl, {
                label: "背景色を白にする",
                checked: t.attributes.isWhiteBackground || !1,
                onChange: function (e) {
                    t.setAttributes({
                        isWhiteBackground: e
                    })
                }
            }), Object(c.createElement)(i.CheckboxControl, {
                label: "行マージン広め",
                checked: t.attributes.isWideVerticalMargin || !1,
                onChange: function (e) {
                    t.setAttributes({
                        isWideVerticalMargin: e
                    })
                }
            }))), Object(c.createElement)(a.RichText, {
                tagName: "ol",
                className: "withPadding ".concat(o(t.attributes, "className"), " \n                    ").concat(!0 === t.attributes.isWhiteBackground ? "whiteBackground" : "", " \n                    ").concat(!0 === t.attributes.isWideVerticalMargin ? "withItemBottomMarginWide" : "withItemBottomMargin"),
                multiline: "li",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })]
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "ol",
                className: "withPadding ".concat(o(t.attributes, "className"), " \n                    ").concat(!0 === t.attributes.isWhiteBackground ? "whiteBackground" : "", " \n                    ").concat(!0 === t.attributes.isWideVerticalMargin ? "withItemBottomMarginWide" : "withItemBottomMargin"),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/h3", {
        title: "見出し（H3）",
        icon: "editor-textcolor",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "h3",
                type: "string",
                source: "html",
                default: ""
            },
            headingStyle: {
                type: "string",
                default: "normal"
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/heading", "kikoiro1/h4"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/h3", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/heading"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/heading", {
                        content: e,
                        level: 3
                    })
                }
            }, {
                type: "block",
                blocks: ["kikoiro1/h4"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/h4", {
                        content: e
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return [Object(c.createElement)(a.InspectorControls, null, Object(c.createElement)(i.PanelBody, {
                title: "設定"
            }, Object(c.createElement)(i.RadioControl, {
                label: "スタイル",
                help: "",
                selected: t.attributes.headingStyle || "normal",
                options: [{
                    label: "ノーマル",
                    value: "normal"
                }, {
                    label: "下線付き",
                    value: "underline"
                }, {
                    label: "●付き",
                    value: "dot"
                }],
                onChange: function (e) {
                    t.setAttributes({
                        headingStyle: e
                    })
                }
            }))), Object(c.createElement)(a.RichText, {
                tagName: "h3",
                multiline: "false",
                className: "".concat(t.attributes.headingStyle, " ").concat(o(t.attributes, "className")),
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })]
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "h3",
                multiline: "false",
                className: "".concat(t.attributes.headingStyle, " ").concat(o(t.attributes, "className")),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/h4", {
        title: "見出し（H4）",
        icon: "editor-textcolor",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "h4",
                type: "string",
                source: "html",
                default: ""
            },
            headingStyle: {
                type: "string",
                default: "normal"
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/heading"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/h4", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/heading"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/heading", {
                        content: e,
                        level: 4
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return [Object(c.createElement)(a.InspectorControls, null, Object(c.createElement)(i.PanelBody, {
                title: "設定"
            }, Object(c.createElement)(i.RadioControl, {
                label: "スタイル",
                help: "",
                selected: t.attributes.headingStyle || "normal",
                options: [{
                    label: "ノーマル",
                    value: "normal"
                }, {
                    label: "下線付き",
                    value: "underline"
                }, {
                    label: "●付き",
                    value: "dot"
                }],
                onChange: function (e) {
                    t.setAttributes({
                        headingStyle: e
                    })
                }
            }))), Object(c.createElement)(a.RichText, {
                tagName: "h4",
                multiline: "false",
                className: "".concat(t.attributes.headingStyle, " ").concat(o(t.attributes, "className")),
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })]
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "h4",
                multiline: "false",
                className: "".concat(t.attributes.headingStyle, " ").concat(o(t.attributes, "className")),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/faq-item", {
        title: "FAQアイテム",
        icon: "editor-help",
        category: "kikoiro1",
        attributes: {
            titleContent: {
                selector: "span",
                type: "string",
                source: "html",
                default: ""
            }
        },
        edit: function (t) {
            var e = t.attributes.titleContent;
            return Object(c.createElement)("div", {
                class: "faqItem" + o(t.attributes, "className")
            }, Object(c.createElement)("h2", null, Object(c.createElement)(a.RichText, {
                tagName: "span",
                value: e,
                placeholder: "質問タイトル",
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            })), Object(c.createElement)(a.InnerBlocks, {
                allowedBlocks: ["core/paragraph"],
                template: [
                    ["core/paragraph", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "faqItem" + o(t.attributes, "className")
            }, Object(c.createElement)("h2", null, Object(c.createElement)(a.RichText.Content, {
                tagName: "span",
                value: t.attributes.titleContent
            })), Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    });
    var l = n(4),
        s = n(6),
        u = n(7),
        b = n(5),
        m = Object(l.compose)(Object(u.withSelect)((function (t) {
            return {
                selectedBlock: t("core/editor").getSelectedBlock()
            }
        })), Object(l.ifCondition)((function (t) {
            return t.selectedBlock && "core/heading" !== t.selectedBlock.name
        })))((function (t) {
            return Object(c.createElement)(s.RichTextToolbarButton, {
                icon: "admin-appearance",
                title: "マーカー",
                onClick: function () {
                    t.onChange(Object(b.toggleFormat)(t.value, {
                        type: "kikoiro1/marker"
                    }))
                },
                isActive: t.isActive
            })
        }));
    Object(b.registerFormatType)("kikoiro1/marker", {
        title: "マーカー",
        tagName: "span",
        className: "emphasize",
        edit: m
    }), Object(r.registerBlockType)("kikoiro1/separator", {
        title: "仕切り線",
        icon: "minus",
        category: "kikoiro1",
        attributes: {
            isFullWidth: {
                type: "boolean",
                default: !1
            }
        },
        edit: function (t) {
            return [Object(c.createElement)(a.InspectorControls, null, Object(c.createElement)(i.PanelBody, {
                title: "設定"
            }, Object(c.createElement)(i.CheckboxControl, {
                label: "コンテンツ幅に合わせる",
                checked: t.attributes.isFullWidth || !1,
                onChange: function (e) {
                    t.setAttributes({
                        isFullWidth: e
                    })
                }
            }))), Object(c.createElement)("hr", {
                className: "contentSeparator ".concat(o(t.attributes, "className"), " ").concat(!0 === t.attributes.isFullWidth ? "fullWidth" : "")
            })]
        },
        save: function (t) {
            return Object(c.createElement)("hr", {
                className: "contentSeparator ".concat(o(t.attributes, "className"), " ").concat(!0 === t.attributes.isFullWidth ? "fullWidth" : "")
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/p", {
        title: "本文段落",
        icon: "editor-paragraph",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "p",
                type: "string",
                source: "html",
                default: ""
            },
            id: {
                type: "string",
                default: ""
            },
            useAsAnchor: {
                type: "boolean",
                default: !1
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/p", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/paragraph", {
                        content: e
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return [Object(c.createElement)(a.InspectorControls, null, Object(c.createElement)(i.PanelBody, {
                title: "設定"
            }, Object(c.createElement)(i.TextControl, {
                label: "ID",
                value: t.attributes.id,
                onChange: function (e) {
                    t.setAttributes({
                        id: e
                    })
                }
            }), Object(c.createElement)(i.CheckboxControl, {
                label: "アンカーとして使用",
                checked: t.attributes.useAsAnchor || !1,
                onChange: function (e) {
                    t.setAttributes({
                        useAsAnchor: e
                    })
                }
            }))), Object(c.createElement)(a.RichText, {
                tagName: "p",
                multiline: "false",
                id: "".concat(t.attributes.id),
                className: "".concat(!0 === t.attributes.useAsAnchor ? "anchorLink" : "", " ").concat(o(t.attributes, "className")),
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })]
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "p",
                multiline: "false",
                id: "".concat(t.attributes.id),
                className: "".concat(!0 === t.attributes.useAsAnchor ? "anchorLink" : "", " ").concat(o(t.attributes, "className")),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/annotation", {
        title: "注釈",
        icon: "editor-ul",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "ul",
                type: "array",
                source: "children"
            }
        },
        edit: function (t) {
            var e = t.attributes.content;
            return Object(c.createElement)("div", {
                class: "annotation" + o(t.attributes, "className")
            }, Object(c.createElement)("hr", {
                class: "contentSeparator fullWidth"
            }), Object(c.createElement)(a.RichText, {
                tagName: "ul",
                multiline: "li",
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "annotation" + o(t.attributes, "className")
            }, Object(c.createElement)("hr", {
                class: "contentSeparator fullWidth"
            }), Object(c.createElement)(a.RichText.Content, {
                tagName: "ul",
                value: t.attributes.content
            }))
        }
    }), Object(r.registerBlockType)("kikoiro1/process", {
        title: "本文-手順",
        icon: "editor-ol",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "p",
                type: "string",
                source: "html",
                default: ""
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/process", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/paragraph", {
                        content: e
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return [Object(c.createElement)(a.RichText, {
                tagName: "p",
                className: "process ".concat(o(t.attributes, "className")),
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })]
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "p",
                className: "process ".concat(o(t.attributes, "className")),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/detail-button", {
        title: "ボタン（別ページへ移動）",
        icon: "arrow-right-alt",
        category: "kikoiro1",
        attributes: {
            content: {
                selector: "p",
                type: "string",
                source: "html",
                default: ""
            }
        },
        transforms: {
            from: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("kikoiro1/detail-button", {
                        content: e
                    })
                }
            }],
            to: [{
                type: "block",
                blocks: ["core/paragraph"],
                transform: function (t) {
                    var e = t.content;
                    return Object(r.createBlock)("core/paragraph", {
                        content: e
                    })
                }
            }]
        },
        edit: function (t) {
            var e = t.attributes.content;
            return Object(c.createElement)(a.RichText, {
                tagName: "p",
                multiline: "false",
                className: "readMore ".concat(o(t.attributes, "className")),
                value: e,
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            })
        },
        save: function (t) {
            return Object(c.createElement)(a.RichText.Content, {
                tagName: "p",
                multiline: "false",
                className: "readMore ".concat(o(t.attributes, "className")),
                value: t.attributes.content
            })
        }
    }), Object(r.registerBlockType)("kikoiro1/sources", {
        title: "出典",
        icon: "editor-ul",
        category: "kikoiro1",
        attributes: {
            titleContent: {
                selector: "h2",
                type: "string",
                source: "html",
                default: "出典"
            },
            content: {
                selector: "ul",
                type: "array",
                source: "children"
            }
        },
        edit: function (t) {
            var e = t.attributes.content,
                n = t.attributes.titleContent;
            return Object(c.createElement)("div", {
                class: "references" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText, {
                tagName: "h2",
                value: n,
                onChange: function (e) {
                    t.setAttributes({
                        titleContent: e
                    })
                }
            }), Object(c.createElement)(a.RichText, {
                tagName: "ul",
                value: e,
                multiline: "li",
                onChange: function (e) {
                    t.setAttributes({
                        content: e
                    })
                }
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "references" + o(t.attributes, "className")
            }, Object(c.createElement)(a.RichText.Content, {
                tagName: "h2",
                value: t.attributes.titleContent
            }), Object(c.createElement)(a.RichText.Content, {
                tagName: "ul",
                value: t.attributes.content
            }))
        }
    }), Object(r.registerBlockType)("kikoiro1/author-profile", {
        title: "序文（著者紹介）",
        icon: "admin-users",
        category: "kikoiro1",
        edit: function (t) {
            return Object(c.createElement)("div", {
                class: "author_profile" + o(t.attributes, "className")
            }, Object(c.createElement)(a.InnerBlocks, {
                allowedBlocks: ["core/paragraph"],
                templateLock: "",
                template: [
                    ["core/paragraph", {}]
                ]
            }))
        },
        save: function (t) {
            return Object(c.createElement)("div", {
                class: "author_profile" + o(t.attributes, "className")
            }, Object(c.createElement)(a.InnerBlocks.Content, null))
        }
    })
}]);
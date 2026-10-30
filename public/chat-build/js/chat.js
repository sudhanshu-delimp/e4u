/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/chat/actions.js":
/*!**************************************!*\
  !*** ./resources/js/chat/actions.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initChatActions: () => (/* binding */ initChatActions)
/* harmony export */ });
/* harmony import */ var _render__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./render */ "./resources/js/chat/render.js");
/* harmony import */ var _dialogs__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./dialogs */ "./resources/js/chat/dialogs.js");
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }



/**
 * Row menu actions (Contact Info, Archive, Delete) and the header Contact Info button.
 * Capture-phase listeners keep the older static UI script from running its demo handlers.
 */
function initChatActions(ctx) {
  var root = ctx.root,
    state = ctx.state,
    api = ctx.api,
    notify = ctx.notify,
    findConv = ctx.findConv,
    loadList = ctx.loadList,
    closeActive = ctx.closeActive,
    closeAllChatMenus = ctx.closeAllChatMenus,
    isUserOnline = ctx.isUserOnline,
    renderList = ctx.renderList,
    renderMessages = ctx.renderMessages,
    updateBlockUi = ctx.updateBlockUi,
    hideBlocked = ctx.hideBlocked;
  var overlay = null;
  function closeModal() {
    if (!overlay) {
      return;
    }
    overlay.remove();
    overlay = null;
    document.removeEventListener('keydown', onKey, true);
  }
  function onKey(event) {
    if (event.key === 'Escape') {
      event.stopPropagation();
      closeModal();
    }
  }
  function openContactModal(info) {
    closeModal();
    var online = isUserOnline({
      id: info.id,
      last_online_at: info.last_online_at
    });
    var status = 'Offline';
    if (online) {
      status = 'Active now';
    } else if (info.last_online_at) {
      status = 'Last seen ' + info.last_online_at;
    }
    var rows = [['Member ID', info.member_id], ['Type', info.type], ['Phone', info.phone || 'N/A'], ['Email', info.email || 'N/A'], ['Location', info.location], ['Home state', info.home_state], ['Member since', info.member_since]
    // ['Status', status],
    ].filter(function (row) {
      return row[1];
    });
    var rowsHtml = rows.map(function (row) {
      return "\n            <div class=\"form-group row border-bottom\">\n                <label class=\"col-sm-5\"><strong>".concat(_render__WEBPACK_IMPORTED_MODULE_0__.escapeHtml(row[0]), ":</strong></label>\n                <div class=\"col-sm-7 text-right\">\n                    ").concat(_render__WEBPACK_IMPORTED_MODULE_0__.escapeHtml(row[1]), "\n                </div>\n            </div>\n        ");
    }).join('');
    overlay = document.createElement('div');
    overlay.className = 'chat-contact-overlay';

    // Sits above the whole page, so the modal and its backdrop are always visible
    overlay.setAttribute('style', 'position:fixed;inset:0;z-index:99999;');
    overlay.innerHTML = "\n            <div class=\"modal-backdrop fade show\"></div>\n\n            <div class=\"modal fade upload-modal modal-form-cancel show\"\n                 role=\"dialog\"\n                 aria-modal=\"true\"\n                 style=\"display:block;overflow-y:auto;\">\n\n                <div class=\"modal-dialog modal-dialog-centered modal-md\"\n                     role=\"document\">\n\n                    <div class=\"modal-content\">\n\n                        <div class=\"modal-header\">\n                            <h5 class=\"modal-title\">\n                                <img src=\"/assets/dashboard/img/list-profile.png\"\n                                     class=\"custompopicon\"\n                                     alt=\"Contact\">\n                                Contact Details\n                            </h5>\n\n                            <button type=\"button\"\n                                    class=\"close chat-contact-close\"\n                                    aria-label=\"Close\">\n                                <span aria-hidden=\"true\">\n                                    <img src=\"/assets/app/img/newcross.png\"\n                                         class=\"img-fluid img_resize_in_smscreen\"\n                                         alt=\"Close\">\n                                </span>\n                            </button>\n                        </div>\n\n                        <div class=\"modal-body\">\n                            <div class=\"container p-0\">\n\n                                <div class=\"text-center mb-4\">\n                                    <div class=\"d-flex justify-content-center mb-3\">\n                                        <div style=\"position:relative;\">\n                                            <div style=\"".concat(_render__WEBPACK_IMPORTED_MODULE_0__.avatarStyle(info.color), "width:84px;height:84px;border-radius:16px;font-size:26px;\">\n                                                ").concat(_render__WEBPACK_IMPORTED_MODULE_0__.avatarInner({
      name: info.name,
      avatar: info.avatar
    }), "\n                                            </div>\n                                            ").concat(online ? '<span style="position:absolute;right:-4px;bottom:-4px;width:16px;height:16px;border-radius:50%;background:#22c55e;border:3px solid #fff;"></span>' : '', "\n                                        </div>\n                                    </div>\n\n                                    <h5>").concat(_render__WEBPACK_IMPORTED_MODULE_0__.escapeHtml(info.name || ''), "</h5>\n\n                                    <p class=\"mb-0\">\n                                        ").concat(_render__WEBPACK_IMPORTED_MODULE_0__.escapeHtml(status), "\n                                    </p>\n                                </div>\n\n                                <hr>\n\n                                ").concat(rowsHtml, "\n\n                            </div>\n                        </div>\n\n                    </div>\n                </div>\n            </div>\n        ");
    overlay.addEventListener('click', function (event) {
      // The close buttons, the dark area around the dialog, or the backdrop
      if (event.target.closest('.chat-contact-close') || event.target.classList.contains('modal') || event.target.classList.contains('modal-backdrop')) {
        closeModal();
      }
    });
    document.body.appendChild(overlay);
    document.addEventListener('keydown', onKey, true);
  }
  function showContact(_x) {
    return _showContact.apply(this, arguments);
  }
  function _showContact() {
    _showContact = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(id) {
      var res, _t;
      return _regenerator().w(function (_context) {
        while (1) switch (_context.p = _context.n) {
          case 0:
            _context.p = 0;
            _context.n = 1;
            return api.contact(id);
          case 1:
            res = _context.v;
            openContactModal(res.data);
            _context.n = 3;
            break;
          case 2:
            _context.p = 2;
            _t = _context.v;
            notify(_t.message || 'Could not load contact info.', 'error');
          case 3:
            return _context.a(2);
        }
      }, _callee, null, [[0, 2]]);
    }));
    return _showContact.apply(this, arguments);
  }
  function archiveChat(_x2) {
    return _archiveChat.apply(this, arguments);
  }
  function _archiveChat() {
    _archiveChat = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2(id) {
      var conv, archive, _t2;
      return _regenerator().w(function (_context2) {
        while (1) switch (_context2.p = _context2.n) {
          case 0:
            conv = findConv(id);
            archive = !(conv && conv.is_archived);
            _context2.p = 1;
            _context2.n = 2;
            return api.archive(id, archive);
          case 2:
            if (state.activeId === id) {
              closeActive();
            }
            _context2.n = 3;
            return loadList();
          case 3:
            if (archive) {
              showAlert('success', 'Chat archived.');
            } else {
              showAlert('success', 'Chat moved back to your list.');
            }
            _context2.n = 5;
            break;
          case 4:
            _context2.p = 4;
            _t2 = _context2.v;
            notify(_t2.message || 'Action failed.', 'error');
          case 5:
            return _context2.a(2);
        }
      }, _callee2, null, [[1, 4]]);
    }));
    return _archiveChat.apply(this, arguments);
  }
  function deleteChat(_x3) {
    return _deleteChat.apply(this, arguments);
  }
  function _deleteChat() {
    _deleteChat = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee3(id) {
      var ok, _t3;
      return _regenerator().w(function (_context3) {
        while (1) switch (_context3.p = _context3.n) {
          case 0:
            _context3.n = 1;
            return (0,_dialogs__WEBPACK_IMPORTED_MODULE_1__.confirmAction)({
              title: 'Delete this chat?',
              text: 'The other person will still keep it.',
              confirmText: 'Delete',
              danger: true
            });
          case 1:
            ok = _context3.v;
            if (ok) {
              _context3.n = 2;
              break;
            }
            return _context3.a(2);
          case 2:
            _context3.p = 2;
            _context3.n = 3;
            return api.deleteChat(id);
          case 3:
            if (state.activeId === id) {
              closeActive();
            }
            _context3.n = 4;
            return loadList();
          case 4:
            notify('Chat deleted.', 'success');
            _context3.n = 6;
            break;
          case 5:
            _context3.p = 5;
            _t3 = _context3.v;
            notify(_t3.message || 'Chat could not be deleted.', 'error');
          case 6:
            return _context3.a(2);
        }
      }, _callee3, null, [[2, 5]]);
    }));
    return _deleteChat.apply(this, arguments);
  }
  function closeHeaderMenu() {
    var wrapper = document.querySelector('.more-wrapper');
    if (wrapper) {
      wrapper.classList.remove('open');
    }
  }
  function clearChat() {
    return _clearChat.apply(this, arguments);
  }
  function _clearChat() {
    _clearChat = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee4() {
      var conv, ok, _t4;
      return _regenerator().w(function (_context4) {
        while (1) switch (_context4.p = _context4.n) {
          case 0:
            conv = findConv(state.activeId);
            if (conv) {
              _context4.n = 1;
              break;
            }
            return _context4.a(2);
          case 1:
            _context4.n = 2;
            return (0,_dialogs__WEBPACK_IMPORTED_MODULE_1__.confirmAction)({
              title: 'Clear this chat?',
              text: 'The other person will still keep the messages.',
              confirmText: 'Clear chat',
              danger: true
            });
          case 2:
            ok = _context4.v;
            if (ok) {
              _context4.n = 3;
              break;
            }
            return _context4.a(2);
          case 3:
            _context4.p = 3;
            _context4.n = 4;
            return api.clear(conv.id);
          case 4:
            state.messages = [];
            state.hasMore = false;
            conv.last = null;
            conv.unread = 0;
            renderMessages();
            renderList();
            notify('Chat cleared.', 'success');
            _context4.n = 6;
            break;
          case 5:
            _context4.p = 5;
            _t4 = _context4.v;
            notify(_t4.message || 'Chat could not be cleared.', 'error');
          case 6:
            return _context4.a(2);
        }
      }, _callee4, null, [[3, 5]]);
    }));
    return _clearChat.apply(this, arguments);
  }
  function toggleBlock() {
    return _toggleBlock.apply(this, arguments);
  }
  function _toggleBlock() {
    _toggleBlock = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee5() {
      var conv, unblock, ok, _t5;
      return _regenerator().w(function (_context5) {
        while (1) switch (_context5.p = _context5.n) {
          case 0:
            conv = findConv(state.activeId);
            if (conv) {
              _context5.n = 1;
              break;
            }
            return _context5.a(2);
          case 1:
            unblock = !!conv.blocked_by_me;
            if (unblock) {
              _context5.n = 3;
              break;
            }
            _context5.n = 2;
            return (0,_dialogs__WEBPACK_IMPORTED_MODULE_1__.confirmAction)({
              title: 'Block this user?',
              text: 'You will not be able to message each other.',
              confirmText: 'Block',
              danger: true
            });
          case 2:
            ok = _context5.v;
            if (ok) {
              _context5.n = 3;
              break;
            }
            return _context5.a(2);
          case 3:
            _context5.p = 3;
            if (!unblock) {
              _context5.n = 5;
              break;
            }
            _context5.n = 4;
            return api.unblock(conv.id);
          case 4:
            _context5.n = 6;
            break;
          case 5:
            _context5.n = 6;
            return api.block(conv.id);
          case 6:
            conv.blocked_by_me = !unblock;

            // Massage Centre: a blocked person leaves the list right away
            if (!(hideBlocked && !unblock)) {
              _context5.n = 8;
              break;
            }
            closeActive();
            _context5.n = 7;
            return loadList();
          case 7:
            notify('User blocked.', 'success');
            return _context5.a(2);
          case 8:
            updateBlockUi(conv);
            notify(unblock ? 'User unblocked.' : 'User blocked.', 'success');
            _context5.n = 10;
            break;
          case 9:
            _context5.p = 9;
            _t5 = _context5.v;
            notify(_t5.message || 'Action failed.', 'error');
          case 10:
            return _context5.a(2);
        }
      }, _callee5, null, [[3, 9]]);
    }));
    return _toggleBlock.apply(this, arguments);
  }
  document.addEventListener('click', function (event) {
    var target = event.target;
    if (!root.contains(target)) {
      return;
    }

    // Buttons inside a chat row menu
    var action = target.closest('.chat-action');
    if (action) {
      event.preventDefault();
      event.stopPropagation();
      var item = action.closest('.chat-user');
      closeAllChatMenus();
      if (!item) {
        return;
      }
      var id = Number(item.dataset.id);
      if (action.dataset.action === 'contact') {
        showContact(id);
      } else if (action.dataset.action === 'archive') {
        archiveChat(id);
      } else if (action.dataset.action === 'delete') {
        deleteChat(id);
      }
      return;
    }

    // Clear Chat in the header menu
    if (target.closest('#clearChatBtn')) {
      event.preventDefault();
      event.stopPropagation();
      closeHeaderMenu();
      clearChat();
      return;
    }

    // Block / Unblock in the header menu, and Unblock in the banner
    if (target.closest('#blockUserBtn') || target.closest('.chat-unblock')) {
      event.preventDefault();
      event.stopPropagation();
      closeHeaderMenu();
      toggleBlock();
      return;
    }

    // Contact Info in the header three dots menu
    if (target.closest('#contactInfoBtn')) {
      event.preventDefault();
      event.stopPropagation();
      var wrapper = document.querySelector('.more-wrapper');
      if (wrapper) {
        wrapper.classList.remove('open');
      }
      if (state.activeId) {
        showContact(state.activeId);
      }
    }
  }, true);
}

/***/ }),

/***/ "./resources/js/chat/api.js":
/*!**********************************!*\
  !*** ./resources/js/chat/api.js ***!
  \**********************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   createApi: () => (/* binding */ createApi)
/* harmony export */ });
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
function createApi(_ref) {
  var csrf = _ref.csrf,
    routes = _ref.routes;
  function request(_x) {
    return _request.apply(this, arguments);
  } // Conversation URLs are built from the messages route: .../conversations/__ID__/messages
  function _request() {
    _request = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(url) {
      var options,
        headers,
        response,
        data,
        message,
        first,
        error,
        _args = arguments,
        _t;
      return _regenerator().w(function (_context) {
        while (1) switch (_context.p = _context.n) {
          case 0:
            options = _args.length > 1 && _args[1] !== undefined ? _args[1] : {};
            headers = {
              'Accept': 'application/json',
              'X-Requested-With': 'XMLHttpRequest',
              'X-CSRF-TOKEN': csrf || ''
            }; // JSON bodies need a content type, FormData sets its own boundary
            if (typeof options.body === 'string') {
              headers['Content-Type'] = 'application/json';
            }
            _context.n = 1;
            return fetch(url, _objectSpread(_objectSpread({
              credentials: 'same-origin'
            }, options), {}, {
              headers: headers
            }));
          case 1:
            response = _context.v;
            data = null;
            _context.p = 2;
            _context.n = 3;
            return response.json();
          case 3:
            data = _context.v;
            _context.n = 5;
            break;
          case 4:
            _context.p = 4;
            _t = _context.v;
            data = null;
          case 5:
            if (response.ok) {
              _context.n = 6;
              break;
            }
            message = data && data.message ? data.message : 'Request failed'; // Laravel validation errors: show the first one
            if (data && data.errors) {
              first = Object.values(data.errors)[0];
              message = Array.isArray(first) ? first[0] : message;
            }
            error = new Error(message);
            error.status = response.status;
            error.data = data;
            throw error;
          case 6:
            return _context.a(2, data);
        }
      }, _callee, null, [[2, 4]]);
    }));
    return _request.apply(this, arguments);
  }
  var conversationUrl = function conversationUrl(id, suffix) {
    return routes.messages.replace('__ID__', id).replace(/\/messages$/, suffix ? '/' + suffix : '');
  };
  var withId = function withId(template, id) {
    return template.replace('__ID__', id);
  };
  var query = function query(params) {
    var text = new URLSearchParams(params || {}).toString();
    return text ? '?' + text : '';
  };
  return {
    conversations: function conversations(params) {
      return request(routes.conversations + query(params));
    },
    members: function members(q) {
      return request(routes.members + query({
        q: q
      }));
    },
    start: function start(userId) {
      return request(routes.conversations, {
        method: 'POST',
        body: JSON.stringify({
          user_id: userId
        })
      });
    },
    messages: function messages(id, params) {
      return request(withId(routes.messages, id) + query(params));
    },
    send: function send(id, body, files) {
      if (files && files.length) {
        var form = new FormData();
        if (body) {
          form.append('body', body);
        }
        files.forEach(function (file) {
          return form.append('files[]', file);
        });
        return request(withId(routes.messages, id), {
          method: 'POST',
          body: form
        });
      }
      return request(withId(routes.messages, id), {
        method: 'POST',
        body: JSON.stringify({
          body: body
        })
      });
    },
    read: function read(id) {
      return request(withId(routes.read, id), {
        method: 'POST'
      });
    },
    typing: function typing(id) {
      return request(withId(routes.typing, id), {
        method: 'POST'
      });
    },
    contact: function contact(id) {
      return request(conversationUrl(id, 'contact'));
    },
    archive: function archive(id, archived) {
      return request(conversationUrl(id, 'archive'), {
        method: 'POST',
        body: JSON.stringify({
          archived: archived
        })
      });
    },
    deleteChat: function deleteChat(id) {
      return request(conversationUrl(id, 'delete'), {
        method: 'POST'
      });
    },
    clear: function clear(id) {
      return request(conversationUrl(id, 'clear'), {
        method: 'POST'
      });
    },
    block: function block(id) {
      return request(conversationUrl(id, 'block'), {
        method: 'POST'
      });
    },
    unblock: function unblock(id) {
      return request(conversationUrl(id, 'block'), {
        method: 'DELETE'
      });
    },
    editMessage: function editMessage(id, body) {
      return request(withId(routes.message, id), {
        method: 'PATCH',
        body: JSON.stringify({
          body: body
        })
      });
    },
    deleteMessage: function deleteMessage(id, mode) {
      return request(withId(routes.message, id), {
        method: 'DELETE',
        body: JSON.stringify({
          mode: mode
        })
      });
    }
  };
}

/***/ }),

/***/ "./resources/js/chat/controller.js":
/*!*****************************************!*\
  !*** ./resources/js/chat/controller.js ***!
  \*****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initChat: () => (/* binding */ initChat)
/* harmony export */ });
/* harmony import */ var _socket__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./socket */ "./resources/js/chat/socket.js");
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./api */ "./resources/js/chat/api.js");
/* harmony import */ var _render__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./render */ "./resources/js/chat/render.js");
/* harmony import */ var _actions__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./actions */ "./resources/js/chat/actions.js");
/* harmony import */ var _dialogs__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./dialogs */ "./resources/js/chat/dialogs.js");
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
// import { createEcho } from './echo';






// UI filter value -> server filter value
var FILTERS = {
  chats: 'active',
  archived: 'archived',
  deleted: 'deleted'
};

// Radio value -> server location value
var LOCATIONS = {
  'your-location': 'mine',
  australia: 'australia'
};
var EMPTY_STYLE = 'padding:24px;text-align:center;color:#6b7280;font-size:14px;';
var MAX_FILE_BYTES = 50 * 1024 * 1024;
var MAX_FILES = 10;
var TYPING_SEND_GAP_MS = 2000;
var TYPING_SHOW_MS = 3500;
var FILE_ACCEPT = 'image/*,video/*,.heic,.heif,.avif,.tif,.tiff,.mkv,.avi,.wmv,.flv,.3gp,.3g2,.mpg,.mpeg,.ogv,.m4v';
var IMAGE_EXT = ['jpg', 'jpeg', 'jpe', 'jfif', 'png', 'gif', 'webp', 'bmp', 'avif', 'heic', 'heif', 'tif', 'tiff', 'ico'];
var VIDEO_EXT = ['mp4', 'm4v', 'mov', 'webm', 'ogv', 'mkv', 'avi', 'wmv', 'flv', '3gp', '3g2', 'mpg', 'mpeg'];
var PREVIEWABLE_IMAGES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/avif'];

// 'image', 'video' or null when the file type is not supported
function fileKind(file) {
  var ext = (file.name.split('.').pop() || '').toLowerCase();
  if (ext === 'svg' || file.type === 'image/svg+xml') {
    return null;
  }
  if (file.type.indexOf('image/') === 0 || IMAGE_EXT.indexOf(ext) !== -1) {
    return 'image';
  }
  if (file.type.indexOf('video/') === 0 || VIDEO_EXT.indexOf(ext) !== -1) {
    return 'video';
  }
  return null;
}

/**
 * Show a message with the site's global showAlert(type, message).
 * Falls back to a plain alert when that function is not on the page.
 */
function notify(message, type) {
  var text = message || 'Something went wrong.';
  if (typeof showAlert === 'function') {
    showAlert(type || 'error', text);
    return;
  }
  (0,_dialogs__WEBPACK_IMPORTED_MODULE_4__.notice)(type || 'error', text);
}
function initChat(root) {
  if (root.dataset.chatReady) {
    return;
  }
  root.dataset.chatReady = '1';
  var config = JSON.parse(root.dataset.config || '{}');
  var me = config.me;
  var api = (0,_api__WEBPACK_IMPORTED_MODULE_1__.createApi)(config);
  // const echo = createEcho(config.csrf);
  var socket = (0,_socket__WEBPACK_IMPORTED_MODULE_0__.createSocket)(config.socketUrl, config.socketToken);
  _render__WEBPACK_IMPORTED_MODULE_2__.configure({
    avatarBase: config.avatarBase || ''
  });
  var el = {
    list: document.getElementById('chatList'),
    messages: document.getElementById('messages'),
    input: document.getElementById('messageInput'),
    sendBtn: document.getElementById('sendBtn'),
    fileInput: document.getElementById('fileInput'),
    composer: document.querySelector('.message-composer'),
    headerAvatar: document.getElementById('chatHeaderAvatar'),
    headerName: document.getElementById('chatUserName'),
    headerStatus: document.getElementById('chatStatus'),
    headerMeta: document.getElementById('chatUserMeta'),
    sidebar: document.getElementById('sidebar'),
    overlay: document.getElementById('sidebarOverlay'),
    modal: document.getElementById('addMemberModal'),
    memberSearch: document.getElementById('memberSearchInput'),
    memberResults: document.getElementById('memberResults')
  };
  var checkedRadio = document.querySelector('input[name="location"]:checked');
  var state = {
    filter: 'active',
    location: LOCATIONS[checkedRadio ? checkedRadio.value : 'your-location'] || 'mine',
    conversations: [],
    pending: null,
    // chat started from the modal that has no message yet
    activeId: null,
    messages: [],
    hasMore: false,
    loadingOlder: false,
    sending: false,
    online: new Set(),
    // user ids currently on the chat page
    typing: {},
    // conversation id -> hide timer
    lastTypingSent: 0,
    pendingFiles: [],
    editingId: null,
    previewUrls: []
  };

  /* ---------------------------------------------------
     Helpers
  --------------------------------------------------- */

  function findConv(id) {
    return state.conversations.find(function (c) {
      return c.id === id;
    }) || (state.pending && state.pending.id === id ? state.pending : null);
  }
  function visibleConversations() {
    var list = state.conversations.slice();
    if (state.pending && !list.some(function (c) {
      return c.id === state.pending.id;
    })) {
      list.unshift(state.pending);
    }
    return list;
  }
  function messageContext() {
    var conv = findConv(state.activeId);
    return {
      me: me,
      peer: conv ? conv.user : {
        name: '?',
        color: '#6B7280'
      }
    };
  }
  function isUserOnline(user) {
    return state.online.has(user.id) || _render__WEBPACK_IMPORTED_MODULE_2__.isOnline(user.last_online_at);
  }
  function scrollBottom() {
    el.messages.scrollTop = el.messages.scrollHeight;
  }
  function prepareVideos(scope) {
    scope.querySelectorAll('video:not([data-ready])').forEach(function (video) {
      video.dataset.ready = '1';
      video.preload = 'metadata';
      video.setAttribute('playsinline', '');
      var original = (video.getAttribute('src') || '').split('#')[0];
      if (!original) {
        return;
      }
      video.src = original + '#t=0.1';
      var tries = 0;
      var retry = function retry() {
        if (tries >= 6 || video.readyState > 0) {
          return;
        }
        tries++;
        video.src = original + (original.indexOf('?') === -1 ? '?' : '&') + '_r=' + Date.now() + '#t=0.1';
        video.load();
      };
      video.addEventListener('error', function () {
        return setTimeout(retry, 1500 * (tries + 1));
      });
      video.addEventListener('loadedmetadata', function () {
        tries = 6;
      });
      setTimeout(retry, 2500);
    });
  }
  function showSending(files) {
    hideSending();
    if (!document.getElementById('chatSpinStyle')) {
      var style = document.createElement('style');
      style.id = 'chatSpinStyle';
      style.textContent = '@keyframes chatSpin{to{transform:rotate(360deg)}}';
      document.head.appendChild(style);
    }
    var row = document.createElement('div');
    row.id = 'chatSending';
    row.className = 'message-row sent';
    row.innerHTML = "<div class=\"message-wrapper\"><div class=\"message-bubble\" style=\"display:flex;align-items:center;gap:10px;\">\n        <span style=\"width:18px;height:18px;border:3px solid #e5e7eb;border-top-color:#ff3c5f;border-radius:50%;display:inline-block;animation:chatSpin .8s linear infinite;\"></span>\n        <span>Sending ".concat(files.length, " file(s)... large videos can take a few minutes. Please do not close this page.</span>\n    </div></div>");
    el.messages.appendChild(row);
    scrollBottom();
  }
  function hideSending() {
    var row = document.getElementById('chatSending');
    if (row) {
      row.remove();
    }
  }
  function closeSidebarOnMobile() {
    if (window.innerWidth <= 800) {
      root.classList.add('mobile-chat-open');
      if (el.sidebar) {
        el.sidebar.classList.remove('open');
      }
      if (el.overlay) {
        el.overlay.classList.remove('show');
      }
    }
  }
  function closeMemberModal() {
    if (el.modal) {
      el.modal.classList.remove('show');
    }
  }
  function closeAllChatMenus() {
    document.querySelectorAll('.more-info-wrapper.open').forEach(function (w) {
      return w.classList.remove('open');
    });
  }

  // Leave the open chat (after it is archived or deleted)
  // Leave the open chat (after it is archived or deleted)
  function closeActive() {
    state.activeId = null;
    state.messages = [];
    state.hasMore = false;
    root.classList.remove('mobile-chat-open');
    clearAttachPreview();
    renderHeader(null);
    renderMessages();
    updateBlockUi(null);
    setComposerEnabled(false);
    renderList();
  }

  // Block state of the open chat: header menu label, banner and composer
  function updateBlockUi(conv) {
    var button = document.getElementById('blockUserBtn');
    var old = document.getElementById('chatBlockBanner');
    if (old) {
      old.remove();
    }
    if (!conv) {
      return;
    }
    var unblockable = (config.unblockable || []).map(Number).indexOf(Number(conv.user.type)) !== -1;
    if (button) {
      button.style.display = unblockable ? 'none' : '';
      button.innerHTML = '<i class="bi bi-slash-circle"></i> ' + (conv.blocked_by_me ? 'Unblock User' : 'Block User');
    }
    var blocked = !!(conv.blocked_by_me || conv.blocked_me);
    if (blocked) {
      var banner = document.createElement('div');
      banner.id = 'chatBlockBanner';
      banner.setAttribute('style', 'padding:10px 14px;border-top:1px solid #e5e7eb;background:#fff7ed;font-size:13px;display:flex;justify-content:space-between;align-items:center;gap:10px;');
      banner.innerHTML = conv.blocked_by_me ? 'You blocked this user. <button type="button" class="chat-unblock" style="border:0;background:transparent;color:#e11d48;font-weight:600;cursor:pointer;">Unblock</button>' : 'You cannot reply to this conversation.';
      el.composer.parentNode.insertBefore(banner, el.composer);
    }
    setComposerEnabled(!blocked);
  }
  function setComposerEnabled(enabled) {
    el.input.disabled = !enabled;
    el.sendBtn.disabled = !enabled;
  }

  /* ---------------------------------------------------
     Rendering
  --------------------------------------------------- */

  function renderList() {
    var list = visibleConversations();
    if (!list.length) {
      el.list.innerHTML = "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">No chats here. Click New to start one.</div>");
      return;
    }
    var ctx = {
      states: config.states || {},
      activeId: state.activeId,
      isOnline: isUserOnline,
      isTyping: function isTyping(id) {
        return !!state.typing[id];
      }
    };
    el.list.innerHTML = list.map(function (conv) {
      return _render__WEBPACK_IMPORTED_MODULE_2__.chatItemHtml(conv, ctx);
    }).join('');
  }
  function renderHeader(conv) {
    if (!conv) {
      el.headerAvatar.innerHTML = '';
      el.headerAvatar.removeAttribute('style');
      el.headerName.textContent = 'Select a chat';
      el.headerStatus.innerHTML = '';
      el.headerMeta.innerHTML = '';
      return;
    }
    var user = conv.user;
    var online = isUserOnline(user);
    var typing = !!state.typing[conv.id];
    var abbr = (config.states || {})[user.location_id] || '-';
    el.headerAvatar.setAttribute('style', _render__WEBPACK_IMPORTED_MODULE_2__.avatarStyle(user.color));
    el.headerAvatar.innerHTML = _render__WEBPACK_IMPORTED_MODULE_2__.avatarInner(user);
    el.headerName.textContent = user.name;
    el.headerStatus.innerHTML = typing ? '<span style="color:#25a244;font-style:italic;">typing...</span>' : "<span class=\"status-dot".concat(online ? '' : ' offline', "\"></span> ").concat(online ? 'Active' : 'Offline');
    el.headerMeta.innerHTML = "Type: ".concat(_render__WEBPACK_IMPORTED_MODULE_2__.escapeHtml((config.typeLabels || {})[user.type] || ''), " <span>|</span> ") + "Member ID: ".concat(_render__WEBPACK_IMPORTED_MODULE_2__.escapeHtml(user.member_id), " <span>|</span> ") + "Location: ".concat(_render__WEBPACK_IMPORTED_MODULE_2__.escapeHtml(abbr));
  }
  function renderMessages() {
    if (!state.activeId) {
      el.messages.innerHTML = "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">Select a chat to start messaging.</div>");
      return;
    }
    if (!state.messages.length) {
      el.messages.innerHTML = "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">No messages yet. Say hello!</div>");
      return;
    }
    var ctx = messageContext();
    el.messages.innerHTML = state.messages.map(function (msg, i) {
      return _render__WEBPACK_IMPORTED_MODULE_2__.messageHtml(msg, state.messages[i - 1], ctx);
    }).join('');
    prepareVideos(el.messages);
  }
  function appendMessage(msg) {
    if (state.messages.some(function (m) {
      return m.id === msg.id;
    })) {
      return;
    }
    var prev = state.messages[state.messages.length - 1];
    state.messages.push(msg);
    if (state.messages.length === 1) {
      renderMessages();
    } else {
      el.messages.insertAdjacentHTML('beforeend', _render__WEBPACK_IMPORTED_MODULE_2__.messageHtml(msg, prev, messageContext()));
    }
    prepareVideos(el.messages);
    scrollBottom();
  }

  // Re-draw the parts that show presence and typing
  function refreshLiveUi() {
    renderList();
    var conv = findConv(state.activeId);
    if (conv) {
      renderHeader(conv);
    }
  }

  /* ---------------------------------------------------
     Data loading
  --------------------------------------------------- */
  function loadList() {
    return _loadList.apply(this, arguments);
  }
  function _loadList() {
    _loadList = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2() {
      var res, _t2;
      return _regenerator().w(function (_context2) {
        while (1) switch (_context2.p = _context2.n) {
          case 0:
            _context2.p = 0;
            _context2.n = 1;
            return api.conversations({
              filter: state.filter,
              location: state.location
            });
          case 1:
            res = _context2.v;
            state.conversations = res.data || [];
            if (state.pending && state.conversations.some(function (c) {
              return c.id === state.pending.id;
            })) {
              state.pending = null;
            }
            _context2.n = 3;
            break;
          case 2:
            _context2.p = 2;
            _t2 = _context2.v;
            console.error('Chat list failed', _t2);
            state.conversations = [];
          case 3:
            renderList();
          case 4:
            return _context2.a(2);
        }
      }, _callee2, null, [[0, 2]]);
    }));
    return _loadList.apply(this, arguments);
  }
  function loadMessages(_x) {
    return _loadMessages.apply(this, arguments);
  }
  function _loadMessages() {
    _loadMessages = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee3(older) {
      var id, params, res, previousHeight;
      return _regenerator().w(function (_context3) {
        while (1) switch (_context3.n) {
          case 0:
            id = state.activeId;
            params = {
              limit: 30
            };
            if (older && state.messages.length) {
              params.before_id = state.messages[0].id;
            }
            _context3.n = 1;
            return api.messages(id, params);
          case 1:
            res = _context3.v;
            if (!(state.activeId !== id)) {
              _context3.n = 2;
              break;
            }
            return _context3.a(2);
          case 2:
            state.hasMore = !!res.has_more;
            if (older) {
              previousHeight = el.messages.scrollHeight;
              state.messages = res.data.concat(state.messages);
              renderMessages();
              el.messages.scrollTop = el.messages.scrollHeight - previousHeight;
            } else {
              state.messages = res.data;
              renderMessages();
              scrollBottom();
            }
          case 3:
            return _context3.a(2);
        }
      }, _callee3);
    }));
    return _loadMessages.apply(this, arguments);
  }
  function markRead(id) {
    var conv = findConv(id);
    if (conv && conv.unread > 0) {
      conv.unread = 0;
      renderList();
    }
    api.read(id)["catch"](function () {});
  }
  function openConversation(_x2) {
    return _openConversation.apply(this, arguments);
  }
  /* ---------------------------------------------------
     Attachments
  --------------------------------------------------- */
  function _openConversation() {
    _openConversation = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee4(id) {
      var conv, _t3;
      return _regenerator().w(function (_context4) {
        while (1) switch (_context4.p = _context4.n) {
          case 0:
            conv = findConv(id);
            if (conv) {
              _context4.n = 1;
              break;
            }
            return _context4.a(2);
          case 1:
            state.activeId = id;
            state.messages = [];
            state.hasMore = false;
            clearAttachPreview();
            renderList();
            renderHeader(conv);
            renderMessages();
            setComposerEnabled(true);
            updateBlockUi(conv);
            closeSidebarOnMobile();
            _context4.p = 2;
            _context4.n = 3;
            return loadMessages(false);
          case 3:
            _context4.n = 5;
            break;
          case 4:
            _context4.p = 4;
            _t3 = _context4.v;
            console.error('Messages failed', _t3);
            return _context4.a(2);
          case 5:
            if (state.activeId === id) {
              markRead(id);
              if (window.innerWidth > 800) {
                el.input.focus();
              }
            }
          case 6:
            return _context4.a(2);
        }
      }, _callee4, null, [[2, 4]]);
    }));
    return _openConversation.apply(this, arguments);
  }
  function clearAttachPreview() {
    cancelEdit();
    var box = document.getElementById('chatAttachPreview');
    if (box) {
      box.remove();
    }
    state.previewUrls.forEach(function (url) {
      return URL.revokeObjectURL(url);
    });
    state.previewUrls = [];
    state.pendingFiles = [];
  }

  // function showAttachPreview(file) {
  //     clearAttachPreview();

  //     state.pendingFile = file;

  //     let thumb;

  //     if (PREVIEWABLE_IMAGES.indexOf(file.type) !== -1) {
  //         state.previewUrl = URL.createObjectURL(file);
  //         thumb = `<img src="${state.previewUrl}" alt="" style="width:44px;height:44px;object-fit:cover;border-radius:6px;">`;
  //     } else {
  //         const icon = fileKind(file) === 'image' ? 'bi-image' : 'bi-camera-video';
  //         thumb = `<span style="width:44px;height:44px;border-radius:6px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:20px;"><i class="bi ${icon}"></i></span>`;
  //     }

  //     const box = document.createElement('div');

  //     box.id = 'chatAttachPreview';
  //     box.setAttribute('style', 'display:flex;align-items:center;gap:10px;padding:8px 14px;border-top:1px solid #e5e7eb;background:#f9fafb;font-size:13px;');
  //     box.innerHTML = `
  //         ${thumb}
  //         <span style="flex:1;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
  //             ${view.escapeHtml(file.name)} (${view.formatSize(file.size)})
  //         </span>
  //         <button type="button" class="chat-attach-remove" title="Remove"
  //             style="border:0;background: #ff3c5f;font-size:20px;line-height:1;cursor:pointer;">&times;</button>
  //     `;

  //     el.composer.parentNode.insertBefore(box, el.composer);
  // }

  function renderAttachPreview() {
    var old = document.getElementById('chatAttachPreview');
    if (old) {
      old.remove();
    }
    state.previewUrls.forEach(function (url) {
      return URL.revokeObjectURL(url);
    });
    state.previewUrls = [];
    if (!state.pendingFiles.length) {
      return;
    }
    var thumbs = state.pendingFiles.map(function (file, index) {
      var thumb;
      if (PREVIEWABLE_IMAGES.indexOf(file.type) !== -1) {
        var url = URL.createObjectURL(file);
        state.previewUrls.push(url);
        thumb = "<img src=\"".concat(url, "\" alt=\"\" style=\"width:56px;height:56px;object-fit:cover;border-radius:6px;display:block;\">");
      } else {
        var icon = fileKind(file) === 'image' ? 'bi-image' : 'bi-camera-video';
        thumb = "<span style=\"width:56px;height:56px;border-radius:6px;background:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:22px;\"><i class=\"bi ".concat(icon, "\"></i></span>");
      }
      return "<div style=\"position:relative;flex:0 0 auto;\" title=\"".concat(_render__WEBPACK_IMPORTED_MODULE_2__.escapeHtml(file.name), "\">\n                ").concat(thumb, "\n                <button type=\"button\" class=\"chat-attach-remove\" data-index=\"").concat(index, "\" title=\"Remove\"\n                    style=\"position:absolute;top:-6px;right:-14px;width:20px;height:20px;border-radius:50%;border:0;background:#ff3c5f;color:#fff;font-size:14px;line-height:20px;padding:0;cursor:pointer;\">&times;</button>\n            </div>");
    }).join('');
    var box = document.createElement('div');
    box.id = 'chatAttachPreview';
    box.setAttribute('style', 'display:flex;align-items:center;gap:12px;padding:10px 14px;border-top:1px solid #e5e7eb;background:#f9fafb;font-size:13px;overflow-x:auto;');
    box.innerHTML = thumbs + "<span style=\"color:#6b7280;white-space:nowrap;\">".concat(state.pendingFiles.length, " file(s)</span>");
    el.composer.parentNode.insertBefore(box, el.composer);
  }
  function onFileChosen() {
    var chosen = Array.from(el.fileInput.files || []);

    // Reset so choosing the same file again still fires a change event
    el.fileInput.value = '';
    if (!chosen.length) {
      return;
    }
    if (!state.activeId) {
      notify('Select a chat first.', 'error');
      return;
    }
    for (var _i = 0, _chosen = chosen; _i < _chosen.length; _i++) {
      var file = _chosen[_i];
      if (state.pendingFiles.length >= MAX_FILES) {
        notify('You can send up to ' + MAX_FILES + ' files at a time.', 'error');
        break;
      }
      if (!fileKind(file)) {
        notify(file.name + ': this file type is not supported.', 'error');
        continue;
      }
      if (file.size > MAX_FILE_BYTES) {
        notify(file.name + ' is too large. Maximum size is 50 MB.', 'error');
        continue;
      }
      state.pendingFiles.push(file);
    }
    renderAttachPreview();
    el.input.focus();
  }

  /* ---------------------------------------------------
     Sending and receiving
  --------------------------------------------------- */

  function touchConversation(msg, options) {
    var conv = state.conversations.find(function (c) {
      return c.id === msg.conversation_id;
    });
    if (!conv && state.pending && state.pending.id === msg.conversation_id) {
      conv = state.pending;
      state.conversations.unshift(conv);
      state.pending = null;
    }
    if (!conv) {
      return false;
    }
    conv.last = {
      preview: _render__WEBPACK_IMPORTED_MODULE_2__.previewText(msg),
      created_at: msg.created_at,
      mine: options.mine
    };
    conv.unread = options.unread;
    state.conversations = [conv].concat(state.conversations.filter(function (c) {
      return c !== conv;
    }));
    return true;
  }

  /* ---------------------------------------------------
  Edit and delete one message
  --------------------------------------------------- */

  function messageById(id) {
    return state.messages.find(function (m) {
      return m.id === id;
    });
  }

  // Swap one message for its new version and redraw, keeping the scroll position
  function replaceMessage(msg) {
    var position = state.messages.findIndex(function (m) {
      return m.id === msg.id;
    });
    if (position === -1) {
      return;
    }
    var scroll = el.messages.scrollTop;
    state.messages[position] = msg;
    renderMessages();
    el.messages.scrollTop = scroll;
  }
  function cancelEdit() {
    state.editingId = null;
    var banner = document.getElementById('chatEditBanner');
    if (banner) {
      banner.remove();
    }
  }
  function startEdit(id) {
    var msg = messageById(id);
    if (!msg || msg.deleted) {
      return;
    }
    if (!_render__WEBPACK_IMPORTED_MODULE_2__.canEdit(msg)) {
      notify('Messages can be edited only within 15 minutes.', 'error');
      renderMessages();
      return;
    }

    // Also clears any selected attachments and an earlier edit
    clearAttachPreview();
    state.editingId = id;
    var banner = document.createElement('div');
    banner.id = 'chatEditBanner';
    banner.setAttribute('style', 'display:flex;align-items:center;justify-content:space-between;gap:10px;padding:8px 14px;border-top:1px solid #e5e7eb;background:#eff6ff;font-size:13px;');
    banner.innerHTML = '<span><i class="bi bi-pencil"></i> Editing message</span>' + '<button type="button" class="chat-edit-cancel" aria-label="Cancel" style="border:0;background:transparent;font-size:20px;line-height:1;cursor:pointer;">&times;</button>';
    el.composer.parentNode.insertBefore(banner, el.composer);
    el.input.value = msg.body || '';
    resizeComposerInput();
    el.input.focus();
  }
  function deleteMessage(_x3) {
    return _deleteMessage.apply(this, arguments);
  } // The other person edited or deleted a message
  function _deleteMessage() {
    _deleteMessage = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee5(id) {
      var msg, mode, res, scroll, _t4;
      return _regenerator().w(function (_context5) {
        while (1) switch (_context5.p = _context5.n) {
          case 0:
            msg = messageById(id);
            if (!(!msg || msg.deleted)) {
              _context5.n = 1;
              break;
            }
            return _context5.a(2);
          case 1:
            _context5.n = 2;
            return (0,_dialogs__WEBPACK_IMPORTED_MODULE_4__.chooseDelete)({
              allowEveryone: msg.sender_id === me.id
            });
          case 2:
            mode = _context5.v;
            if (mode) {
              _context5.n = 3;
              break;
            }
            return _context5.a(2);
          case 3:
            _context5.p = 3;
            _context5.n = 4;
            return api.deleteMessage(id, mode);
          case 4:
            res = _context5.v;
            if (state.editingId === id) {
              cancelEdit();
              el.input.value = '';
              resizeComposerInput();
            }
            if (mode === 'me') {
              scroll = el.messages.scrollTop;
              state.messages = state.messages.filter(function (m) {
                return m.id !== id;
              });
              renderMessages();
              el.messages.scrollTop = scroll;
            } else {
              replaceMessage(res.data);
            }
            loadList();
            _context5.n = 6;
            break;
          case 5:
            _context5.p = 5;
            _t4 = _context5.v;
            notify(_t4.message || 'Message could not be deleted.', 'error');
          case 6:
            return _context5.a(2);
        }
      }, _callee5, null, [[3, 5]]);
    }));
    return _deleteMessage.apply(this, arguments);
  }
  function onMessageChanged(msg) {
    if (!msg) {
      return;
    }
    if (msg.conversation_id === state.activeId) {
      replaceMessage(msg);
    }
    loadList();
  }
  function sendMessage() {
    return _sendMessage.apply(this, arguments);
  }
  function _sendMessage() {
    _sendMessage = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee6() {
      var body, files, res, _res, _t5, _t6;
      return _regenerator().w(function (_context6) {
        while (1) switch (_context6.p = _context6.n) {
          case 0:
            body = el.input.value.trim();
            files = state.pendingFiles.slice();
            if (!state.sending) {
              _context6.n = 1;
              break;
            }
            return _context6.a(2);
          case 1:
            if (!state.editingId) {
              _context6.n = 9;
              break;
            }
            if (body) {
              _context6.n = 2;
              break;
            }
            notify('A message cannot be empty. Use delete instead.', 'error');
            return _context6.a(2);
          case 2:
            if (!files.length) {
              _context6.n = 3;
              break;
            }
            notify('Attachments cannot be added while editing.', 'error');
            return _context6.a(2);
          case 3:
            state.sending = true;
            _context6.p = 4;
            _context6.n = 5;
            return api.editMessage(state.editingId, body);
          case 5:
            res = _context6.v;
            replaceMessage(res.data);
            cancelEdit();
            el.input.value = '';
            resizeComposerInput();
            loadList();
            _context6.n = 7;
            break;
          case 6:
            _context6.p = 6;
            _t5 = _context6.v;
            notify(_t5.message || 'Message could not be edited.', 'error');
          case 7:
            _context6.p = 7;
            state.sending = false;
            el.input.focus();
            return _context6.f(7);
          case 8:
            return _context6.a(2);
          case 9:
            if (!(!body && !files.length || !state.activeId)) {
              _context6.n = 10;
              break;
            }
            return _context6.a(2);
          case 10:
            state.sending = true;
            el.sendBtn.disabled = true;
            if (files.length) {
              showSending(files);
            }
            _context6.p = 11;
            _context6.n = 12;
            return api.send(state.activeId, body, files);
          case 12:
            _res = _context6.v;
            hideSending();
            root.querySelector('#emojiPicker').classList.remove('show');
            el.input.value = '';
            resizeComposerInput();
            clearAttachPreview();
            appendMessage(_res.data);
            touchConversation(_res.data, {
              mine: true,
              unread: 0
            });
            renderList();
            _context6.n = 14;
            break;
          case 13:
            _context6.p = 13;
            _t6 = _context6.v;
            notify(_t6.message || 'Message could not be sent.', 'error');
          case 14:
            _context6.p = 14;
            hideSending();
            state.sending = false;
            el.sendBtn.disabled = false;
            el.input.focus();
            return _context6.f(14);
          case 15:
            return _context6.a(2);
        }
      }, _callee6, null, [[11, 13, 14, 15], [4, 6, 7, 8]]);
    }));
    return _sendMessage.apply(this, arguments);
  }
  function onIncoming(msg) {
    if (!msg || msg.sender_id === me.id) {
      return;
    }
    clearTyping(msg.conversation_id);
    var active = msg.conversation_id === state.activeId;
    var known = findConv(msg.conversation_id);
    if (active) {
      appendMessage(msg);
    }
    var touched = touchConversation(msg, {
      mine: false,
      unread: active ? 0 : (known ? known.unread : 0) + 1
    });
    if (!touched) {
      // Brand new conversation, fetch the list again
      loadList();
      return;
    }
    renderList();
    if (active) {
      // This also turns the sender's ticks blue
      api.read(msg.conversation_id)["catch"](function () {});
    }
  }

  /* ---------------------------------------------------
     Typing, seen ticks, presence
  --------------------------------------------------- */

  function clearTyping(conversationId) {
    if (state.typing[conversationId]) {
      clearTimeout(state.typing[conversationId]);
      delete state.typing[conversationId];
    }
  }
  function onTyping(event) {
    if (!event || event.user_id === me.id) {
      return;
    }
    var id = event.conversation_id;
    clearTyping(id);
    state.typing[id] = setTimeout(function () {
      delete state.typing[id];
      refreshLiveUi();
    }, TYPING_SHOW_MS);
    refreshLiveUi();
  }
  function onInputTyping() {
    resizeComposerInput();
    if (!state.activeId || !el.input.value) {
      return;
    }
    var now = Date.now();
    if (now - state.lastTypingSent < TYPING_SEND_GAP_MS) {
      return;
    }
    state.lastTypingSent = now;
    api.typing(state.activeId)["catch"](function () {});
  }
  function resizeComposerInput() {
    if (el.input.tagName !== 'TEXTAREA') {
      return;
    }
    el.input.style.height = 'auto';
    el.input.style.height = Math.min(el.input.scrollHeight, 160) + 'px';
  }

  // A person went offline: drop every online sign for them right away
  function markOffline(userId) {
    state.online["delete"](userId);
    state.conversations.forEach(function (conv) {
      if (conv.user.id === userId) {
        conv.user.last_online_at = null;
      }
    });
    if (state.pending && state.pending.user.id === userId) {
      state.pending.user.last_online_at = null;
    }
    refreshLiveUi();
  }
  function onMessagesRead(event) {
    if (!event || event.conversation_id !== state.activeId) {
      return;
    }
    var upTo = event.up_to_id;
    state.messages.forEach(function (m) {
      if (m.sender_id === me.id && m.id <= upTo && !m.read_at) {
        m.read_at = event.read_at;
      }
    });
    el.messages.querySelectorAll('.message-row.sent').forEach(function (row) {
      if (Number(row.dataset.id) > upTo) {
        return;
      }
      var icon = row.querySelector('.chat-tick');
      if (icon) {
        icon.className = 'bi bi-check2-all chat-tick';
        icon.style.color = '#34B7F1';
      }
    });
  }

  /* ---------------------------------------------------
     New chat modal
  --------------------------------------------------- */

  var MEMBER_HINT = "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">Type a Member ID to search.</div>");
  var memberTimer = null;
  function searchMembers(_x4) {
    return _searchMembers.apply(this, arguments);
  }
  function _searchMembers() {
    _searchMembers = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee7(term) {
      var res, _t7;
      return _regenerator().w(function (_context7) {
        while (1) switch (_context7.p = _context7.n) {
          case 0:
            // Show a loading line only when there are no results on screen yet
            if (!el.memberResults.querySelector('.member-result')) {
              el.memberResults.innerHTML = "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">Loading...</div>");
            }
            _context7.p = 1;
            _context7.n = 2;
            return api.members(term);
          case 2:
            res = _context7.v;
            if (!(el.memberSearch.value.trim() !== term)) {
              _context7.n = 3;
              break;
            }
            return _context7.a(2);
          case 3:
            if (res.data.length) {
              el.memberResults.innerHTML = res.data.map(function (m) {
                return {
                  m: m,
                  online: isUserOnline(m)
                };
              }).sort(function (a, b) {
                return Number(b.online) - Number(a.online);
              }).map(function (x) {
                return _render__WEBPACK_IMPORTED_MODULE_2__.memberResultHtml(x.m, x.online);
              }).join('');
            } else {
              el.memberResults.innerHTML = term ? '<div class="no-search-result"><i class="bi bi-person-x"></i> No eligible member found</div>' : "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">No members available to add.</div>");
            }
            _context7.n = 5;
            break;
          case 4:
            _context7.p = 4;
            _t7 = _context7.v;
            el.memberResults.innerHTML = "<div class=\"chat-empty\" style=\"".concat(EMPTY_STYLE, "\">Could not load members. Try again.</div>");
          case 5:
            return _context7.a(2);
        }
      }, _callee7, null, [[1, 4]]);
    }));
    return _searchMembers.apply(this, arguments);
  }
  function startChat(_x5) {
    return _startChat.apply(this, arguments);
  }
  function _startChat() {
    _startChat = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee8(member) {
      var res, _t8;
      return _regenerator().w(function (_context8) {
        while (1) switch (_context8.p = _context8.n) {
          case 0:
            _context8.p = 0;
            _context8.n = 1;
            return api.start(member.id);
          case 1:
            res = _context8.v;
            if (!findConv(res.conversation_id)) {
              state.pending = {
                id: res.conversation_id,
                user: {
                  id: member.id,
                  name: member.name,
                  member_id: member.member_id,
                  avatar: member.avatar,
                  color: member.color,
                  location_id: null,
                  last_online_at: null
                },
                last: null,
                unread: 0
              };
            }
            closeMemberModal();
            renderList();
            openConversation(res.conversation_id);
            loadList();
            _context8.n = 3;
            break;
          case 2:
            _context8.p = 2;
            _t8 = _context8.v;
            notify(_t8.message || 'Chat could not be started.', 'error');
          case 3:
            return _context8.a(2);
        }
      }, _callee8, null, [[0, 2]]);
    }));
    return _startChat.apply(this, arguments);
  }
  if (el.memberSearch) {
    el.memberSearch.addEventListener('input', function () {
      clearTimeout(memberTimer);
      var term = this.value.trim();

      // An empty box shows everyone who can be added
      memberTimer = setTimeout(function () {
        return searchMembers(term);
      }, term ? 300 : 0);
    });
  }
  el.memberResults.addEventListener('click', function (event) {
    var row = event.target.closest('.member-result');
    if (!row) {
      return;
    }
    startChat({
      id: Number(row.dataset.userId),
      name: row.dataset.memberName,
      member_id: row.dataset.memberId,
      avatar: row.dataset.avatar,
      color: row.dataset.color
    });
  });

  /* ---------------------------------------------------
     Events
     Capture-phase listeners run before the older static UI script,
     so demo handlers for the same elements never fire.
  --------------------------------------------------- */

  document.addEventListener('click', function (event) {
    var target = event.target;
    var filterWrapper = root.querySelector('.filter-wrapper');
    var filterBtn = root.querySelector('#filterBtn');
    if (!root.contains(target)) {
      filterWrapper.classList.remove('open');
      filterBtn.setAttribute('aria-expanded', 'false');
      return;
    }
    if (target.closest('#mobileMenu')) {
      event.preventDefault();
      event.stopPropagation();
      root.classList.remove('mobile-chat-open');
      return;
    }
    var composerTools = root.querySelector('.composer-tools-menu');
    var composerMenuBtn = root.querySelector('#composerMenuBtn');
    if (target.closest('#composerMenuBtn')) {
      event.preventDefault();
      event.stopPropagation();
      var isOpen = composerTools.classList.toggle('open');
      composerMenuBtn.setAttribute('aria-expanded', String(isOpen));
      return;
    }
    if (!target.closest('.composer-tools-menu')) {
      composerTools.classList.remove('open');
      composerMenuBtn.setAttribute('aria-expanded', 'false');
    } else if (target.closest('#attachmentBtn, #emojiBtn')) {
      composerTools.classList.remove('open');
      composerMenuBtn.setAttribute('aria-expanded', 'false');
    }
    if (target.closest('#filterBtn')) {
      event.preventDefault();
      event.stopPropagation();
      var _isOpen = filterWrapper.classList.toggle('open');
      var headerMenu = root.querySelector('.more-wrapper');
      filterBtn.setAttribute('aria-expanded', String(_isOpen));
      if (headerMenu) {
        headerMenu.classList.remove('open');
      }
      closeAllChatMenus();
      return;
    }
    if (!target.closest('.filter-wrapper')) {
      filterWrapper.classList.remove('open');
      filterBtn.setAttribute('aria-expanded', 'false');
    }

    // Send button
    if (target.closest('#sendBtn')) {
      event.preventDefault();
      event.stopPropagation();
      sendMessage();
      return;
    }
    // Edit, delete and cancel-edit on messages
    var editBtn = target.closest('.chat-msg-edit');
    if (editBtn) {
      event.preventDefault();
      event.stopPropagation();
      startEdit(Number(editBtn.closest('.message-row').dataset.id));
      return;
    }
    var deleteBtn = target.closest('.chat-msg-delete');
    if (deleteBtn) {
      event.preventDefault();
      event.stopPropagation();
      deleteMessage(Number(deleteBtn.closest('.message-row').dataset.id));
      return;
    }
    if (target.closest('.chat-edit-cancel')) {
      event.preventDefault();
      event.stopPropagation();
      cancelEdit();
      el.input.value = '';
      resizeComposerInput();
      return;
    }

    // Remove one selected attachment
    var removeBtn = target.closest('.chat-attach-remove');
    if (removeBtn) {
      event.preventDefault();
      event.stopPropagation();
      state.pendingFiles.splice(Number(removeBtn.dataset.index), 1);
      renderAttachPreview();
      return;
    }

    // Three dots on a chat row
    var dots = target.closest('.chat-user .chatInfoBtn');
    if (dots) {
      event.preventDefault();
      event.stopPropagation();
      var wrapper = dots.closest('.more-info-wrapper');
      var wasOpen = wrapper.classList.contains('open');
      closeAllChatMenus();
      if (!wasOpen) {
        wrapper.classList.add('open');
      }
      return;
    }

    // Mark as read from the row menu
    var mark = target.closest('.chat-mark-read');
    if (mark) {
      event.preventDefault();
      event.stopPropagation();
      var item = mark.closest('.chat-user');
      closeAllChatMenus();
      if (item) {
        markRead(Number(item.dataset.id));
      }
      return;
    }

    // New button: show everyone who can be added (the older script opens the modal)
    if (target.closest('#newChatBtn')) {
      el.memberSearch.value = '';
      searchMembers('');
    }

    // Filter options (do not stop propagation, the old script still closes the dropdown)
    var option = target.closest('#filterDropdown .filter-option');
    if (option) {
      event.preventDefault();
      event.stopPropagation();
      state.filter = FILTERS[option.dataset.filter] || 'active';
      root.querySelectorAll('#filterDropdown .filter-option').forEach(function (filterOption) {
        filterOption.classList.toggle('active', filterOption === option);
      });
      filterWrapper.classList.remove('open');
      filterBtn.setAttribute('aria-expanded', 'false');
      loadList();
    }
  }, true);
  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      var filterWrapper = root.querySelector('.filter-wrapper');
      var filterBtn = root.querySelector('#filterBtn');
      var headerMenu = root.querySelector('.more-wrapper');
      var emojiPicker = root.querySelector('#emojiPicker');
      var composerTools = root.querySelector('.composer-tools-menu');
      var composerMenuBtn = root.querySelector('#composerMenuBtn');
      var filterWasOpen = filterWrapper.classList.contains('open');
      var composerMenuWasOpen = composerTools.classList.contains('open');
      filterWrapper.classList.remove('open');
      filterBtn.setAttribute('aria-expanded', 'false');
      composerTools.classList.remove('open');
      composerMenuBtn.setAttribute('aria-expanded', 'false');
      if (filterWasOpen) {
        filterBtn.focus();
      } else if (composerMenuWasOpen) {
        composerMenuBtn.focus();
      }
      if (headerMenu) {
        headerMenu.classList.remove('open');
      }
      if (emojiPicker) {
        emojiPicker.classList.remove('show');
      }
      closeAllChatMenus();
      return;
    }
    if (event.target !== el.input || event.isComposing) {
      return;
    }
    if (event.key === 'Enter' && !event.shiftKey) {
      event.preventDefault();
      event.stopPropagation();
      sendMessage();
    }
  }, true);

  // The file input: take over from the old script that only pasted the file name
  document.addEventListener('change', function (event) {
    if (event.target === el.fileInput) {
      event.stopPropagation();
      onFileChosen();
    }
  }, true);
  document.addEventListener('change', function (event) {
    if (event.target.matches && event.target.matches('input[name="location"]')) {
      state.location = LOCATIONS[event.target.value] || 'mine';
      loadList();
    }
  });

  // A photo that fails to load falls back to the initials
  document.addEventListener('error', function (event) {
    var target = event.target;
    if (target && target.classList && target.classList.contains('chat-avatar-img')) {
      target.replaceWith(document.createTextNode(target.dataset.initials || '?'));
    }
  }, true);
  el.input.addEventListener('input', onInputTyping);
  resizeComposerInput();
  el.list.addEventListener('click', function (event) {
    if (event.target.closest('.more-info-wrapper')) {
      return;
    }
    var item = event.target.closest('.chat-user');
    if (item) {
      openConversation(Number(item.dataset.id));
    }
  });
  el.messages.addEventListener('scroll', /*#__PURE__*/_asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee() {
    var _t;
    return _regenerator().w(function (_context) {
      while (1) switch (_context.p = _context.n) {
        case 0:
          if (!(el.messages.scrollTop > 40 || !state.hasMore || state.loadingOlder || !state.activeId)) {
            _context.n = 1;
            break;
          }
          return _context.a(2);
        case 1:
          state.loadingOlder = true;
          _context.p = 2;
          _context.n = 3;
          return loadMessages(true);
        case 3:
          _context.n = 5;
          break;
        case 4:
          _context.p = 4;
          _t = _context.v;
          console.error('Older messages failed', _t);
        case 5:
          _context.p = 5;
          state.loadingOlder = false;
          return _context.f(5);
        case 6:
          return _context.a(2);
      }
    }, _callee, null, [[2, 4, 5, 6]]);
  })));

  /* ---------------------------------------------------
     Start
  --------------------------------------------------- */

  if (el.fileInput) {
    el.fileInput.accept = FILE_ACCEPT;
    el.fileInput.multiple = true;
  }
  renderHeader(null);
  renderMessages();
  setComposerEnabled(false);
  el.memberResults.innerHTML = MEMBER_HINT;
  socket.on('MessageSent', onIncoming);
  socket.on('UserTyping', onTyping);
  socket.on('MessagesRead', onMessagesRead);
  socket.on('MessageChanged', onMessageChanged);
  socket.on('presence:here', function (ids) {
    state.online = new Set(ids);
    refreshLiveUi();
  });
  socket.on('presence:joining', function (u) {
    state.online.add(u.id);
    refreshLiveUi();
  });
  socket.on('presence:leaving', function (u) {
    return markOffline(u.id);
  });
  socket.on('UserOffline', function (e) {
    return markOffline(Number(e.user_id));
  });
  (0,_actions__WEBPACK_IMPORTED_MODULE_3__.initChatActions)({
    root: root,
    state: state,
    api: api,
    notify: notify,
    findConv: findConv,
    loadList: loadList,
    closeActive: closeActive,
    closeAllChatMenus: closeAllChatMenus,
    isUserOnline: isUserOnline,
    hideBlocked: config.hideBlockedChats,
    renderList: renderList,
    renderMessages: renderMessages,
    updateBlockUi: updateBlockUi
  });
  loadList();
}

/***/ }),

/***/ "./resources/js/chat/dialogs.js":
/*!**************************************!*\
  !*** ./resources/js/chat/dialogs.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   chooseDelete: () => (/* binding */ chooseDelete),
/* harmony export */   confirmAction: () => (/* binding */ confirmAction),
/* harmony export */   notice: () => (/* binding */ notice)
/* harmony export */ });
function _regenerator() { /*! regenerator-runtime -- Copyright (c) 2014-present, Facebook, Inc. -- license (MIT): https://github.com/babel/babel/blob/main/packages/babel-helpers/LICENSE */ var e, t, r = "function" == typeof Symbol ? Symbol : {}, n = r.iterator || "@@iterator", o = r.toStringTag || "@@toStringTag"; function i(r, n, o, i) { var c = n && n.prototype instanceof Generator ? n : Generator, u = Object.create(c.prototype); return _regeneratorDefine2(u, "_invoke", function (r, n, o) { var i, c, u, f = 0, p = o || [], y = !1, G = { p: 0, n: 0, v: e, a: d, f: d.bind(e, 4), d: function d(t, r) { return i = t, c = 0, u = e, G.n = r, a; } }; function d(r, n) { for (c = r, u = n, t = 0; !y && f && !o && t < p.length; t++) { var o, i = p[t], d = G.p, l = i[2]; r > 3 ? (o = l === n) && (u = i[(c = i[4]) ? 5 : (c = 3, 3)], i[4] = i[5] = e) : i[0] <= d && ((o = r < 2 && d < i[1]) ? (c = 0, G.v = n, G.n = i[1]) : d < l && (o = r < 3 || i[0] > n || n > l) && (i[4] = r, i[5] = n, G.n = l, c = 0)); } if (o || r > 1) return a; throw y = !0, n; } return function (o, p, l) { if (f > 1) throw TypeError("Generator is already running"); for (y && 1 === p && d(p, l), c = p, u = l; (t = c < 2 ? e : u) || !y;) { i || (c ? c < 3 ? (c > 1 && (G.n = -1), d(c, u)) : G.n = u : G.v = u); try { if (f = 2, i) { if (c || (o = "next"), t = i[o]) { if (!(t = t.call(i, u))) throw TypeError("iterator result is not an object"); if (!t.done) return t; u = t.value, c < 2 && (c = 0); } else 1 === c && (t = i["return"]) && t.call(i), c < 2 && (u = TypeError("The iterator does not provide a '" + o + "' method"), c = 1); i = e; } else if ((t = (y = G.n < 0) ? u : r.call(n, G)) !== a) break; } catch (t) { i = e, c = 1, u = t; } finally { f = 1; } } return { value: t, done: y }; }; }(r, o, i), !0), u; } var a = {}; function Generator() {} function GeneratorFunction() {} function GeneratorFunctionPrototype() {} t = Object.getPrototypeOf; var c = [][n] ? t(t([][n]())) : (_regeneratorDefine2(t = {}, n, function () { return this; }), t), u = GeneratorFunctionPrototype.prototype = Generator.prototype = Object.create(c); function f(e) { return Object.setPrototypeOf ? Object.setPrototypeOf(e, GeneratorFunctionPrototype) : (e.__proto__ = GeneratorFunctionPrototype, _regeneratorDefine2(e, o, "GeneratorFunction")), e.prototype = Object.create(u), e; } return GeneratorFunction.prototype = GeneratorFunctionPrototype, _regeneratorDefine2(u, "constructor", GeneratorFunctionPrototype), _regeneratorDefine2(GeneratorFunctionPrototype, "constructor", GeneratorFunction), GeneratorFunction.displayName = "GeneratorFunction", _regeneratorDefine2(GeneratorFunctionPrototype, o, "GeneratorFunction"), _regeneratorDefine2(u), _regeneratorDefine2(u, o, "Generator"), _regeneratorDefine2(u, n, function () { return this; }), _regeneratorDefine2(u, "toString", function () { return "[object Generator]"; }), (_regenerator = function _regenerator() { return { w: i, m: f }; })(); }
function _regeneratorDefine2(e, r, n, t) { var i = Object.defineProperty; try { i({}, "", {}); } catch (e) { i = 0; } _regeneratorDefine2 = function _regeneratorDefine(e, r, n, t) { function o(r, n) { _regeneratorDefine2(e, r, function (e) { return this._invoke(r, n, e); }); } r ? i ? i(e, r, { value: n, enumerable: !t, configurable: !t, writable: !t }) : e[r] = n : (o("next", 0), o("throw", 1), o("return", 2)); }, _regeneratorDefine2(e, r, n, t); }
function asyncGeneratorStep(n, t, e, r, o, a, c) { try { var i = n[a](c), u = i.value; } catch (n) { return void e(n); } i.done ? t(u) : Promise.resolve(u).then(r, o); }
function _asyncToGenerator(n) { return function () { var t = this, e = arguments; return new Promise(function (r, o) { var a = n.apply(t, e); function _next(n) { asyncGeneratorStep(a, r, o, _next, _throw, "next", n); } function _throw(n) { asyncGeneratorStep(a, r, o, _next, _throw, "throw", n); } _next(void 0); }); }; }
/**
 * Dialogs for the chat, built on SweetAlert. Works with SweetAlert2 (window.Swal)
 * and with sweetalert 2.x (window.swal). Browser alert() and confirm() are never used.
 */
function isSwal2() {
  return !!(window.Swal && typeof window.Swal.fire === 'function');
}
function isSwal() {
  return typeof window.swal === 'function';
}
function missing() {
  console.error('SweetAlert is not loaded on this page.');
}

// Yes / No question. Resolves to true when the user confirms.
function confirmAction(_x) {
  return _confirmAction.apply(this, arguments);
}

// Delete a message. Resolves to 'me', 'everyone' or null (cancelled).
function _confirmAction() {
  _confirmAction = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee(_ref) {
    var title, text, confirmText, danger, result, value;
    return _regenerator().w(function (_context) {
      while (1) switch (_context.n) {
        case 0:
          title = _ref.title, text = _ref.text, confirmText = _ref.confirmText, danger = _ref.danger;
          if (!isSwal2()) {
            _context.n = 2;
            break;
          }
          _context.n = 1;
          return window.Swal.fire({
            title: title,
            text: text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmText || 'Yes',
            cancelButtonText: 'Cancel',
            confirmButtonColor: danger ? '#e11d48' : undefined,
            reverseButtons: true
          });
        case 1:
          result = _context.v;
          return _context.a(2, !!result.isConfirmed);
        case 2:
          if (!isSwal()) {
            _context.n = 4;
            break;
          }
          _context.n = 3;
          return window.swal({
            title: title,
            text: text,
            icon: 'warning',
            buttons: ['Cancel', confirmText || 'Yes'],
            dangerMode: !!danger
          });
        case 3:
          value = _context.v;
          return _context.a(2, !!value);
        case 4:
          missing();
          return _context.a(2, false);
      }
    }, _callee);
  }));
  return _confirmAction.apply(this, arguments);
}
function chooseDelete(_x2) {
  return _chooseDelete.apply(this, arguments);
}

// A short message (type is 'success' or 'error')
function _chooseDelete() {
  _chooseDelete = _asyncToGenerator(/*#__PURE__*/_regenerator().m(function _callee2(_ref2) {
    var allowEveryone, ok, result, value;
    return _regenerator().w(function (_context2) {
      while (1) switch (_context2.n) {
        case 0:
          allowEveryone = _ref2.allowEveryone;
          if (allowEveryone) {
            _context2.n = 2;
            break;
          }
          _context2.n = 1;
          return confirmAction({
            title: 'Delete this message?',
            text: 'It will be removed only for you.',
            confirmText: 'Delete for me',
            danger: true
          });
        case 1:
          ok = _context2.v;
          return _context2.a(2, ok ? 'me' : null);
        case 2:
          if (!isSwal2()) {
            _context2.n = 5;
            break;
          }
          _context2.n = 3;
          return window.Swal.fire({
            title: 'Delete this message?',
            icon: 'warning',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Delete for everyone',
            denyButtonText: 'Delete for me',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#e11d48'
          });
        case 3:
          result = _context2.v;
          if (!result.isConfirmed) {
            _context2.n = 4;
            break;
          }
          return _context2.a(2, 'everyone');
        case 4:
          return _context2.a(2, result.isDenied ? 'me' : null);
        case 5:
          if (!isSwal()) {
            _context2.n = 7;
            break;
          }
          _context2.n = 6;
          return window.swal({
            title: 'Delete this message?',
            icon: 'warning',
            buttons: {
              cancel: 'Cancel',
              me: {
                text: 'Delete for me',
                value: 'me'
              },
              everyone: {
                text: 'Delete for everyone',
                value: 'everyone',
                className: 'swal-button--danger'
              }
            }
          });
        case 6:
          value = _context2.v;
          return _context2.a(2, value === 'me' || value === 'everyone' ? value : null);
        case 7:
          missing();
          return _context2.a(2, null);
      }
    }, _callee2);
  }));
  return _chooseDelete.apply(this, arguments);
}
function notice(type, text) {
  var icon = type === 'success' ? 'success' : 'error';
  if (isSwal2()) {
    window.Swal.fire({
      icon: icon,
      text: text
    });
    return;
  }
  if (isSwal()) {
    window.swal({
      icon: icon,
      text: text
    });
    return;
  }
  missing();
}

/***/ }),

/***/ "./resources/js/chat/lightbox.js":
/*!***************************************!*\
  !*** ./resources/js/chat/lightbox.js ***!
  \***************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   initLightbox: () => (/* binding */ initLightbox)
/* harmony export */ });
/**
 * Click a photo in a chat bubble to open a viewer for every photo and video of that message.
 * Arrow buttons, the keyboard arrows and a swipe move between items.
 * Esc, the close button or a click on the dark area closes it.
 */
function initLightbox(root) {
  var overlay = null;
  var stage = null;
  var counter = null;
  var items = [];
  var index = 0;
  var touchStartX = 0;
  function show() {
    var item = items[index];
    var node = document.createElement(item.kind === 'video' ? 'video' : 'img');
    node.src = item.src;
    node.setAttribute('style', 'max-width:100%;max-height:100%;border-radius:8px;box-shadow:0 10px 40px rgba(0,0,0,.5);');
    if (item.kind === 'video') {
      node.controls = true;
      node.autoplay = true;
    }
    stage.innerHTML = '';
    stage.appendChild(node);
    counter.textContent = items.length > 1 ? index + 1 + ' / ' + items.length : '';
  }
  function move(step) {
    if (items.length < 2) {
      return;
    }
    index = (index + step + items.length) % items.length;
    show();
  }
  function onKey(event) {
    if (event.key === 'Escape') {
      event.stopPropagation();
      close();
    } else if (event.key === 'ArrowRight') {
      move(1);
    } else if (event.key === 'ArrowLeft') {
      move(-1);
    }
  }
  function close() {
    if (!overlay) {
      return;
    }
    overlay.remove();
    overlay = null;
    document.removeEventListener('keydown', onKey, true);
  }
  function open(list, start) {
    close();
    items = list;
    index = start;
    var arrow = 'position:absolute;top:50%;transform:translateY(-50%);border:0;background:rgba(255,255,255,.18);' + 'color:#fff;width:44px;height:44px;border-radius:50%;font-size:20px;cursor:pointer;';
    var showArrows = items.length > 1;
    overlay = document.createElement('div');
    overlay.setAttribute('style', 'position:fixed;inset:0;z-index:99999;background:rgba(0,0,0,.88);' + 'display:flex;align-items:center;justify-content:center;');
    overlay.innerHTML = "\n            <button type=\"button\" class=\"chat-lb-close\" aria-label=\"Close\"\n                style=\"position:absolute;top:14px;right:20px;border:0;background:transparent;color:#fff;font-size:34px;line-height:1;cursor:pointer;\">&times;</button>\n            ".concat(showArrows ? "<button type=\"button\" class=\"chat-lb-prev\" aria-label=\"Previous\" style=\"".concat(arrow, "left:16px;\">&#10094;</button>") : '', "\n            <div class=\"chat-lb-stage\" style=\"width:100%;height:100%;padding:56px 72px;box-sizing:border-box;display:flex;align-items:center;justify-content:center;\"></div>\n            ").concat(showArrows ? "<button type=\"button\" class=\"chat-lb-next\" aria-label=\"Next\" style=\"".concat(arrow, "right:16px;\">&#10095;</button>") : '', "\n            <div class=\"chat-lb-counter\" style=\"position:absolute;bottom:16px;left:0;right:0;text-align:center;color:#fff;font-size:14px;\"></div>\n        ");
    stage = overlay.querySelector('.chat-lb-stage');
    counter = overlay.querySelector('.chat-lb-counter');
    overlay.addEventListener('click', function (event) {
      if (event.target.closest('.chat-lb-prev')) {
        move(-1);
      } else if (event.target.closest('.chat-lb-next')) {
        move(1);
      } else if (event.target === overlay || event.target === stage || event.target.closest('.chat-lb-close')) {
        close();
      }
    });
    overlay.addEventListener('touchstart', function (event) {
      touchStartX = event.changedTouches[0].clientX;
    });
    overlay.addEventListener('touchend', function (event) {
      var distance = event.changedTouches[0].clientX - touchStartX;
      if (Math.abs(distance) > 50) {
        move(distance < 0 ? 1 : -1);
      }
    });
    document.body.appendChild(overlay);
    document.addEventListener('keydown', onKey, true);
    show();
  }
  root.addEventListener('click', function (event) {
    var link = event.target.closest('a.chat-media');
    if (!link) {
      return;
    }

    // Stop the link from opening a new tab
    event.preventDefault();
    var bubble = link.closest('.message-bubble');
    var nodes = Array.from(bubble.querySelectorAll('.chat-media'));
    open(nodes.map(function (node) {
      return {
        kind: node.dataset.kind,
        src: node.tagName === 'A' ? node.getAttribute('href') : node.currentSrc || node.src
      };
    }), nodes.indexOf(link));
  });
}

/***/ }),

/***/ "./resources/js/chat/render.js":
/*!*************************************!*\
  !*** ./resources/js/chat/render.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   EDIT_WINDOW_MS: () => (/* binding */ EDIT_WINDOW_MS),
/* harmony export */   avatarInner: () => (/* binding */ avatarInner),
/* harmony export */   avatarStyle: () => (/* binding */ avatarStyle),
/* harmony export */   canEdit: () => (/* binding */ canEdit),
/* harmony export */   chatItemHtml: () => (/* binding */ chatItemHtml),
/* harmony export */   configure: () => (/* binding */ configure),
/* harmony export */   dayLabel: () => (/* binding */ dayLabel),
/* harmony export */   escapeHtml: () => (/* binding */ escapeHtml),
/* harmony export */   formatSize: () => (/* binding */ formatSize),
/* harmony export */   formatTime: () => (/* binding */ formatTime),
/* harmony export */   initials: () => (/* binding */ initials),
/* harmony export */   isOnline: () => (/* binding */ isOnline),
/* harmony export */   listTime: () => (/* binding */ listTime),
/* harmony export */   memberResultHtml: () => (/* binding */ memberResultHtml),
/* harmony export */   messageHtml: () => (/* binding */ messageHtml),
/* harmony export */   nl2br: () => (/* binding */ nl2br),
/* harmony export */   previewText: () => (/* binding */ previewText),
/* harmony export */   sameDay: () => (/* binding */ sameDay)
/* harmony export */ });
var DAY_MS = 86400000;
var ONLINE_WINDOW_MS = 5 * 60 * 1000;
var EDIT_WINDOW_MS = 15 * 60 * 1000;
// A message can be edited for 15 minutes after it was sent (the server checks this too)
function canEdit(msg) {
  return Date.now() - new Date(msg.created_at).getTime() <= EDIT_WINDOW_MS;
}
var SHOWABLE_IMAGES = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/bmp', 'image/avif'];
var PLAYABLE_VIDEOS = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'];
function hasImageGallery(attachments) {
  return attachments.length >= 4 && attachments.every(function (attachment) {
    return attachment.kind === 'image' && SHOWABLE_IMAGES.indexOf(String(attachment.mime || '').toLowerCase()) !== -1;
  });
}
var settings = {
  avatarBase: ''
};
function configure(options) {
  Object.assign(settings, options || {});
}
function escapeHtml(text) {
  return String(text === null || text === undefined ? '' : text).replace(/[&<>"']/g, function (ch) {
    return {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    }[ch];
  });
}
function nl2br(text) {
  return escapeHtml(text).replace(/\n/g, '<br>');
}

/**
 * First letter of the first name and of the last name.
 */
function initials(name) {
  var parts = String(name || '').trim().split(/\s+/).filter(Boolean);
  if (!parts.length) {
    return '?';
  }
  if (parts.length === 1) {
    return parts[0].charAt(0).toUpperCase();
  }
  return (parts[0].charAt(0) + parts[parts.length - 1].charAt(0)).toUpperCase();
}
function avatarStyle(color) {
  return 'background:' + escapeHtml(color || '#6B7280') + ';color:#fff;display:flex;align-items:center;justify-content:center;font-weight:600;overflow:hidden;';
}
function avatarUrl(path) {
  if (!path) {
    return '';
  }
  var value = String(path).trim();

  // Full URLs and root-relative paths are used as they are
  if (/^(https?:)?\/\//.test(value) || value.charAt(0) === '/') {
    return value;
  }

  // Avatars live in /avatars. The stored value can be "avatars/x.png" or only "x.png"
  var relative = value.indexOf('/') === -1 ? 'avatars/' + value : value.replace(/^\/+/, '');
  return settings.avatarBase + '/' + relative;
}

/**
 * Inner HTML of an avatar circle: the photo when there is one,
 * otherwise the initials. A broken photo falls back to initials (see controller.js).
 */
function avatarInner(person) {
  var text = escapeHtml(initials(person.name));
  var url = avatarUrl(person.avatar);
  if (!url) {
    return text;
  }
  return "<img class=\"chat-avatar-img\" src=\"".concat(escapeHtml(url), "\" alt=\"\" data-initials=\"").concat(text, "\"\n        style=\"width:100%;height:100%;object-fit:cover;border-radius:inherit;\">");
}
function isOnline(lastOnlineAt) {
  if (!lastOnlineAt) {
    return false;
  }
  var time = new Date(String(lastOnlineAt).replace(' ', 'T')).getTime();
  return !isNaN(time) && Math.abs(Date.now() - time) < ONLINE_WINDOW_MS;
}
function sameDay(a, b) {
  var x = new Date(a);
  var y = new Date(b);
  return x.getFullYear() === y.getFullYear() && x.getMonth() === y.getMonth() && x.getDate() === y.getDate();
}
function formatTime(iso) {
  return new Date(iso).toLocaleTimeString([], {
    hour: '2-digit',
    minute: '2-digit'
  });
}
function formatSize(bytes) {
  if (bytes >= 1048576) {
    return (bytes / 1048576).toFixed(1) + ' MB';
  }
  return Math.max(1, Math.round(bytes / 1024)) + ' KB';
}
function dayLabel(iso) {
  var date = new Date(iso);
  var now = new Date();
  if (sameDay(date, now)) {
    return 'Today';
  }
  if (sameDay(date, new Date(now.getTime() - DAY_MS))) {
    return 'Yesterday';
  }
  return date.toLocaleDateString('en-GB', {
    day: 'numeric',
    month: 'short',
    year: 'numeric'
  });
}
function listTime(iso) {
  var date = new Date(iso);
  var now = new Date();
  if (sameDay(date, now)) {
    return formatTime(iso);
  }
  if (sameDay(date, new Date(now.getTime() - DAY_MS))) {
    return 'Yesterday';
  }
  return date.toLocaleDateString('en-GB', {
    day: 'numeric',
    month: 'short'
  });
}
function previewText(message) {
  if (message.type === 'image') {
    return 'Photo';
  }
  if (message.type === 'video') {
    return 'Video';
  }
  return message.body || '';
}

/**
 * One row of the sidebar chat list.
 * ctx: { states, activeId, isOnline(user), isTyping(conversationId) }
 */
function chatItemHtml(conv, ctx) {
  var user = conv.user;
  var abbr = ctx.states[user.location_id] || '';
  var online = ctx.isOnline(user);
  var active = conv.id === ctx.activeId ? ' active' : '';
  var previewHtml;
  if (ctx.isTyping(conv.id)) {
    previewHtml = '<span style="color:#25a244;font-style:italic;">typing...</span>';
  } else {
    var preview = conv.last ? (conv.last.mine ? 'You: ' : '') + conv.last.preview : 'No messages yet';
    previewHtml = escapeHtml(preview);
  }
  var time = conv.last ? listTime(conv.last.created_at) : '';
  return "\n        <div class=\"chat-user".concat(active, "\"\n            data-id=\"").concat(conv.id, "\"\n            data-name=\"").concat(escapeHtml(user.name), "\"\n            data-member=\"").concat(escapeHtml(user.member_id), "\"\n            data-location=\"").concat(escapeHtml(abbr), "\">\n\n            <div class=\"avatar avatar-light\" style=\"").concat(avatarStyle(user.color), "\">\n                ").concat(avatarInner(user), "\n                 \n            </div>\n\n            <div class=\"user-info\">\n\n               \n                <div class=\"user-name\">\n                    ").concat(escapeHtml(user.name), "\n                    <span class=\"user-type\">(").concat(escapeHtml(user.member_id), ")</span>\n                    <span class=\"status-dot").concat(online ? '' : ' offline', "\"></span>\n                </div>\n\n                <div class=\"user-top\">\n                    <span class=\"user-type\">").concat(previewHtml, "</span>\n                    <span class=\"user-time\">").concat(escapeHtml(time), "</span>\n                </div>\n\n                <div class=\"more-info-wrapper\">\n\n                    <button type=\"button\" class=\"chatInfoBtn\" aria-label=\"More options\">\n                        <i class=\"bi bi-three-dots-vertical\"></i>\n                    </button>\n\n                    <div class=\"more-info-dropdown\">\n\n                        <button type=\"button\" class=\"contactInfoBtn chat-mark-read\">\n                            <i class=\"bi bi-check-circle\"></i>\n                            Mark as Read\n                        </button>\n\n                        <button type=\"button\" class=\"filter-option chat-action\" data-action=\"contact\">\n                            <i class=\"bi bi-person-vcard\"></i>\n                            Contact Info\n                        </button>\n\n                        <button type=\"button\" class=\"filter-option chat-action\" data-action=\"archive\">\n                            <i class=\"bi bi-archive\"></i>\n                            ").concat(conv.is_archived ? 'Unarchive' : 'Archive', "\n                        </button>\n                        <div class=\"dropdown-divider\"></div>\n                        <button type=\"button\" class=\"filter-option chat-action danger-option\" data-action=\"delete\">\n                            <i class=\"bi bi-trash3\"></i>\n                            Delete\n                        </button>\n\n                    </div>\n\n                </div>\n\n            </div>\n\n            ").concat(conv.unread > 0 ? "<span class=\"unread-count\">".concat(conv.unread, "</span>") : '', "\n\n        </div>\n    ");
}
function attachmentsHtml(msg) {
  var list = msg.attachments || [];
  var many = list.length > 1;
  if (hasImageGallery(list)) {
    var tiles = list.map(function (attachment, index) {
      var url = escapeHtml(attachment.url);
      var hidden = index > 3 ? ' chat-gallery-hidden' : '';
      var overlay = index === 3 ? "<span class=\"chat-gallery-more\" aria-hidden=\"true\"><i class=\"bi bi-plus-lg\"></i><span>".concat(list.length - 3, "</span></span>") : '';
      return "<a href=\"".concat(url, "\" class=\"chat-media chat-gallery-tile").concat(hidden, "\" data-kind=\"image\"\n                target=\"_blank\" rel=\"noopener\" aria-label=\"View image ").concat(index + 1, " of ").concat(list.length, "\">\n                <img src=\"").concat(url, "\" alt=\"\" loading=\"lazy\">\n                ").concat(overlay, "\n            </a>");
    }).join('');
    return "<div class=\"chat-image-gallery\">".concat(tiles, "</div>");
  }
  var html = list.map(function (a) {
    var url = escapeHtml(a.url);
    var mime = String(a.mime || '').toLowerCase();
    if (a.kind === 'image' && SHOWABLE_IMAGES.indexOf(mime) !== -1) {
      var size = many ? 'width:110px;height:110px;object-fit:cover;' : 'max-width:240px;max-height:260px;';
      return "<a href=\"".concat(url, "\" class=\"chat-media\" data-kind=\"image\" target=\"_blank\" rel=\"noopener\">\n                <img src=\"").concat(url, "\" alt=\"\" loading=\"lazy\" style=\"").concat(size, "border-radius:8px;display:block;\">\n            </a>");
    }
    if (a.kind === 'video' && PLAYABLE_VIDEOS.indexOf(mime) !== -1) {
      var _size = many ? 'width:180px;height:120px;object-fit:cover;' : 'max-width:260px;max-height:260px;';
      return "<video src=\"".concat(url, "\" class=\"chat-media\" data-kind=\"video\" controls preload=\"metadata\"\n                style=\"").concat(_size, "border-radius:8px;display:block;\"></video>");
    }

    // Formats a browser cannot show inline (HEIC, MKV, AVI...): download card
    var label = a.kind === 'image' ? 'Photo' : 'Video';
    var format = escapeHtml((mime.split('/')[1] || 'file').replace(/^x-/, '').toUpperCase());
    return "<a href=\"".concat(url, "\" download\n            style=\"display:flex;align-items:center;gap:8px;text-decoration:none;color:inherit;\">\n            <i class=\"bi bi-file-earmark-arrow-down\" style=\"font-size:22px;\"></i>\n            <span>").concat(label, " (").concat(format, ", ").concat(escapeHtml(formatSize(a.size)), ")<br><small>Tap to download</small></span>\n        </a>");
  }).join('');
  return many ? "<div style=\"display:flex;flex-wrap:wrap;gap:7px;\">".concat(html, "</div>") : html;
}

/**
 * One message bubble, with a date divider when the day changes.
 * ctx: { me: {id, name, avatar, color}, peer: {name, avatar, color} }
 */
function messageHtml(msg, prev, ctx) {
  var mine = msg.sender_id === ctx.me.id;
  var person = mine ? ctx.me : ctx.peer;
  var divider = !prev || !sameDay(prev.created_at, msg.created_at) ? "<div class=\"date-divider\"><span>".concat(escapeHtml(dayLabel(msg.created_at)), "</span></div>") : '';
  var avatar = "\n        <div class=\"message-avatar\" style=\"".concat(avatarStyle(person.color), "\">\n            ").concat(avatarInner(person), "\n        </div>");

  // One grey tick = sent, two blue ticks = seen
  var tick = '';
  if (mine && !msg.deleted) {
    tick = msg.read_at ? '<i class="bi bi-check2-all chat-tick" style="color:#34B7F1;"></i>' : '<i class="bi bi-check2 chat-tick"></i>';
  }
  var content;
  if (msg.deleted) {
    content = '<div style="font-style:italic;opacity:.7;"><i class="bi bi-slash-circle"></i> This message was deleted</div>';
  } else {
    var caption = msg.body ? "<div>".concat(nl2br(msg.body), "</div>") : '';
    content = attachmentsHtml(msg) + caption;
  }
  var edited = !msg.deleted && msg.edited ? ' <span style="opacity:.6;">(edited)</span>' : '';

  // Edit (first 15 minutes only) and delete, on my own messages
  // Delete on every message, edit only on my own text messages (first 15 minutes)
  var actions = '';
  if (!msg.deleted) {
    var buttonStyle = 'border:0;background:transparent;padding:0 4px;cursor:pointer;color:inherit;font-size:12px; margin:0px;';
    var hasFiles = (msg.attachments || []).length > 0;
    var edit = mine && !hasFiles && msg.body && canEdit(msg) ? "<button type=\"button\" class=\"chat-msg-edit\" title=\"Edit\" style=\"".concat(buttonStyle, "\"><i class=\"bi bi-pencil\"></i></button>") : '';
    var remove = "<button type=\"button\" class=\"chat-msg-delete\" title=\"Delete\" style=\"".concat(buttonStyle, "\"><i class=\"bi bi-trash3\"></i></button>");
    actions = "<span class=\"chat-msg-actions\" style=\"margin-left:8px;opacity:.65;\">".concat(edit).concat(remove, "</span>");
  }
  var bubble = "\n        <div class=\"message-wrapper\">\n            <div class=\"message-bubble".concat(hasImageGallery(msg.attachments || []) ? ' chat-gallery-bubble' : '', "\">").concat(content, "</div>\n            <div class=\"message-time\">\n                ").concat(escapeHtml(formatTime(msg.created_at))).concat(edited, "\n                ").concat(tick, "\n                ").concat(actions, "\n            </div>\n        </div>");
  return "\n        ".concat(divider, "\n        <div class=\"message-row ").concat(mine ? 'sent' : 'received', "\" data-id=\"").concat(msg.id, "\">\n            ").concat(mine ? bubble + avatar : avatar + bubble, "\n        </div>\n    ");
}

/**
 * One result row inside the New chat modal.
 */
function memberResultHtml(member, online) {
  return "\n        <div class=\"member-result\"\n            data-user-id=\"".concat(member.id, "\"\n            data-member-id=\"").concat(escapeHtml(member.member_id), "\"\n            data-member-name=\"").concat(escapeHtml(member.name), "\"\n            data-avatar=\"").concat(escapeHtml(member.avatar || ''), "\"\n            data-color=\"").concat(escapeHtml(member.color), "\"\n            data-location=\"\">\n\n            <div class=\"member-avatar\" style=\"").concat(avatarStyle(member.color), "\">\n                ").concat(avatarInner(member), "\n            </div>\n\n            <div class=\"member-info\">\n                <strong>").concat(escapeHtml(member.name), "</strong>\n                <span>").concat(escapeHtml(member.member_id)).concat(member.type_label ? ' · ' + escapeHtml(member.type_label) : '', "</span>\n            </div>\n            <span class=\"member-status").concat(online ? '' : ' offline', "\">").concat(online ? 'Online' : 'Offline', "</span>\n\n            <button type=\"button\" class=\"add-member-action\">\n                <i class=\"bi bi-plus-lg\"></i>\n            </button>\n\n        </div>\n    ");
}

/***/ }),

/***/ "./resources/js/chat/socket.js":
/*!*************************************!*\
  !*** ./resources/js/chat/socket.js ***!
  \*************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   createSocket: () => (/* binding */ createSocket)
/* harmony export */ });
/* harmony import */ var socket_io_client__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! socket.io-client */ "./node_modules/socket.io-client/build/esm/index.js");

var socket = null;
function createSocket(url, token) {
  if (!socket) socket = (0,socket_io_client__WEBPACK_IMPORTED_MODULE_0__.io)(url, {
    auth: {
      token: token
    },
    transports: ['websocket', 'polling']
  });
  return socket;
}

/***/ }),

/***/ "./node_modules/debug/src/browser.js":
/*!*******************************************!*\
  !*** ./node_modules/debug/src/browser.js ***!
  \*******************************************/
/***/ ((module, exports, __webpack_require__) => {

/* provided dependency */ var process = __webpack_require__(/*! process/browser.js */ "./node_modules/process/browser.js");
/* eslint-env browser */

/**
 * This is the web browser implementation of `debug()`.
 */

exports.formatArgs = formatArgs;
exports.save = save;
exports.load = load;
exports.useColors = useColors;
exports.storage = localstorage();
exports.destroy = (() => {
	let warned = false;

	return () => {
		if (!warned) {
			warned = true;
			console.warn('Instance method `debug.destroy()` is deprecated and no longer does anything. It will be removed in the next major version of `debug`.');
		}
	};
})();

/**
 * Colors.
 */

exports.colors = [
	'#0000CC',
	'#0000FF',
	'#0033CC',
	'#0033FF',
	'#0066CC',
	'#0066FF',
	'#0099CC',
	'#0099FF',
	'#00CC00',
	'#00CC33',
	'#00CC66',
	'#00CC99',
	'#00CCCC',
	'#00CCFF',
	'#3300CC',
	'#3300FF',
	'#3333CC',
	'#3333FF',
	'#3366CC',
	'#3366FF',
	'#3399CC',
	'#3399FF',
	'#33CC00',
	'#33CC33',
	'#33CC66',
	'#33CC99',
	'#33CCCC',
	'#33CCFF',
	'#6600CC',
	'#6600FF',
	'#6633CC',
	'#6633FF',
	'#66CC00',
	'#66CC33',
	'#9900CC',
	'#9900FF',
	'#9933CC',
	'#9933FF',
	'#99CC00',
	'#99CC33',
	'#CC0000',
	'#CC0033',
	'#CC0066',
	'#CC0099',
	'#CC00CC',
	'#CC00FF',
	'#CC3300',
	'#CC3333',
	'#CC3366',
	'#CC3399',
	'#CC33CC',
	'#CC33FF',
	'#CC6600',
	'#CC6633',
	'#CC9900',
	'#CC9933',
	'#CCCC00',
	'#CCCC33',
	'#FF0000',
	'#FF0033',
	'#FF0066',
	'#FF0099',
	'#FF00CC',
	'#FF00FF',
	'#FF3300',
	'#FF3333',
	'#FF3366',
	'#FF3399',
	'#FF33CC',
	'#FF33FF',
	'#FF6600',
	'#FF6633',
	'#FF9900',
	'#FF9933',
	'#FFCC00',
	'#FFCC33'
];

/**
 * Currently only WebKit-based Web Inspectors, Firefox >= v31,
 * and the Firebug extension (any Firefox version) are known
 * to support "%c" CSS customizations.
 *
 * TODO: add a `localStorage` variable to explicitly enable/disable colors
 */

// eslint-disable-next-line complexity
function useColors() {
	// NB: In an Electron preload script, document will be defined but not fully
	// initialized. Since we know we're in Chrome, we'll just detect this case
	// explicitly
	if (typeof window !== 'undefined' && window.process && (window.process.type === 'renderer' || window.process.__nwjs)) {
		return true;
	}

	// Internet Explorer and Edge do not support colors.
	if (typeof navigator !== 'undefined' && navigator.userAgent && navigator.userAgent.toLowerCase().match(/(edge|trident)\/(\d+)/)) {
		return false;
	}

	let m;

	// Is webkit? http://stackoverflow.com/a/16459606/376773
	// document is undefined in react-native: https://github.com/facebook/react-native/pull/1632
	// eslint-disable-next-line no-return-assign
	return (typeof document !== 'undefined' && document.documentElement && document.documentElement.style && document.documentElement.style.WebkitAppearance) ||
		// Is firebug? http://stackoverflow.com/a/398120/376773
		(typeof window !== 'undefined' && window.console && (window.console.firebug || (window.console.exception && window.console.table))) ||
		// Is firefox >= v31?
		// https://developer.mozilla.org/en-US/docs/Tools/Web_Console#Styling_messages
		(typeof navigator !== 'undefined' && navigator.userAgent && (m = navigator.userAgent.toLowerCase().match(/firefox\/(\d+)/)) && parseInt(m[1], 10) >= 31) ||
		// Double check webkit in userAgent just in case we are in a worker
		(typeof navigator !== 'undefined' && navigator.userAgent && navigator.userAgent.toLowerCase().match(/applewebkit\/(\d+)/));
}

/**
 * Colorize log arguments if enabled.
 *
 * @api public
 */

function formatArgs(args) {
	args[0] = (this.useColors ? '%c' : '') +
		this.namespace +
		(this.useColors ? ' %c' : ' ') +
		args[0] +
		(this.useColors ? '%c ' : ' ') +
		'+' + module.exports.humanize(this.diff);

	if (!this.useColors) {
		return;
	}

	const c = 'color: ' + this.color;
	args.splice(1, 0, c, 'color: inherit');

	// The final "%c" is somewhat tricky, because there could be other
	// arguments passed either before or after the %c, so we need to
	// figure out the correct index to insert the CSS into
	let index = 0;
	let lastC = 0;
	args[0].replace(/%[a-zA-Z%]/g, match => {
		if (match === '%%') {
			return;
		}
		index++;
		if (match === '%c') {
			// We only are interested in the *last* %c
			// (the user may have provided their own)
			lastC = index;
		}
	});

	args.splice(lastC, 0, c);
}

/**
 * Invokes `console.debug()` when available.
 * No-op when `console.debug` is not a "function".
 * If `console.debug` is not available, falls back
 * to `console.log`.
 *
 * @api public
 */
exports.log = console.debug || console.log || (() => {});

/**
 * Save `namespaces`.
 *
 * @param {String} namespaces
 * @api private
 */
function save(namespaces) {
	try {
		if (namespaces) {
			exports.storage.setItem('debug', namespaces);
		} else {
			exports.storage.removeItem('debug');
		}
	} catch (error) {
		// Swallow
		// XXX (@Qix-) should we be logging these?
	}
}

/**
 * Load `namespaces`.
 *
 * @return {String} returns the previously persisted debug modes
 * @api private
 */
function load() {
	let r;
	try {
		r = exports.storage.getItem('debug') || exports.storage.getItem('DEBUG') ;
	} catch (error) {
		// Swallow
		// XXX (@Qix-) should we be logging these?
	}

	// If debug isn't set in LS, and we're in Electron, try to load $DEBUG
	if (!r && typeof process !== 'undefined' && 'env' in process) {
		r = process.env.DEBUG;
	}

	return r;
}

/**
 * Localstorage attempts to return the localstorage.
 *
 * This is necessary because safari throws
 * when a user disables cookies/localstorage
 * and you attempt to access it.
 *
 * @return {LocalStorage}
 * @api private
 */

function localstorage() {
	try {
		// TVMLKit (Apple TV JS Runtime) does not have a window object, just localStorage in the global context
		// The Browser also has localStorage in the global context.
		return localStorage;
	} catch (error) {
		// Swallow
		// XXX (@Qix-) should we be logging these?
	}
}

module.exports = __webpack_require__(/*! ./common */ "./node_modules/debug/src/common.js")(exports);

const {formatters} = module.exports;

/**
 * Map %j to `JSON.stringify()`, since no Web Inspectors do that by default.
 */

formatters.j = function (v) {
	try {
		return JSON.stringify(v);
	} catch (error) {
		return '[UnexpectedJSONParseError]: ' + error.message;
	}
};


/***/ }),

/***/ "./node_modules/debug/src/common.js":
/*!******************************************!*\
  !*** ./node_modules/debug/src/common.js ***!
  \******************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {


/**
 * This is the common logic for both the Node.js and web browser
 * implementations of `debug()`.
 */

function setup(env) {
	createDebug.debug = createDebug;
	createDebug.default = createDebug;
	createDebug.coerce = coerce;
	createDebug.disable = disable;
	createDebug.enable = enable;
	createDebug.enabled = enabled;
	createDebug.humanize = __webpack_require__(/*! ms */ "./node_modules/ms/index.js");
	createDebug.destroy = destroy;

	Object.keys(env).forEach(key => {
		createDebug[key] = env[key];
	});

	/**
	* The currently active debug mode names, and names to skip.
	*/

	createDebug.names = [];
	createDebug.skips = [];

	/**
	* Map of special "%n" handling functions, for the debug "format" argument.
	*
	* Valid key names are a single, lower or upper-case letter, i.e. "n" and "N".
	*/
	createDebug.formatters = {};

	/**
	* Selects a color for a debug namespace
	* @param {String} namespace The namespace string for the debug instance to be colored
	* @return {Number|String} An ANSI color code for the given namespace
	* @api private
	*/
	function selectColor(namespace) {
		let hash = 0;

		for (let i = 0; i < namespace.length; i++) {
			hash = ((hash << 5) - hash) + namespace.charCodeAt(i);
			hash |= 0; // Convert to 32bit integer
		}

		return createDebug.colors[Math.abs(hash) % createDebug.colors.length];
	}
	createDebug.selectColor = selectColor;

	/**
	* Create a debugger with the given `namespace`.
	*
	* @param {String} namespace
	* @return {Function}
	* @api public
	*/
	function createDebug(namespace) {
		let prevTime;
		let enableOverride = null;
		let namespacesCache;
		let enabledCache;

		function debug(...args) {
			// Disabled?
			if (!debug.enabled) {
				return;
			}

			const self = debug;

			// Set `diff` timestamp
			const curr = Number(new Date());
			const ms = curr - (prevTime || curr);
			self.diff = ms;
			self.prev = prevTime;
			self.curr = curr;
			prevTime = curr;

			args[0] = createDebug.coerce(args[0]);

			if (typeof args[0] !== 'string') {
				// Anything else let's inspect with %O
				args.unshift('%O');
			}

			// Apply any `formatters` transformations
			let index = 0;
			args[0] = args[0].replace(/%([a-zA-Z%])/g, (match, format) => {
				// If we encounter an escaped % then don't increase the array index
				if (match === '%%') {
					return '%';
				}
				index++;
				const formatter = createDebug.formatters[format];
				if (typeof formatter === 'function') {
					const val = args[index];
					match = formatter.call(self, val);

					// Now we need to remove `args[index]` since it's inlined in the `format`
					args.splice(index, 1);
					index--;
				}
				return match;
			});

			// Apply env-specific formatting (colors, etc.)
			createDebug.formatArgs.call(self, args);

			const logFn = self.log || createDebug.log;
			logFn.apply(self, args);
		}

		debug.namespace = namespace;
		debug.useColors = createDebug.useColors();
		debug.color = createDebug.selectColor(namespace);
		debug.extend = extend;
		debug.destroy = createDebug.destroy; // XXX Temporary. Will be removed in the next major release.

		Object.defineProperty(debug, 'enabled', {
			enumerable: true,
			configurable: false,
			get: () => {
				if (enableOverride !== null) {
					return enableOverride;
				}
				if (namespacesCache !== createDebug.namespaces) {
					namespacesCache = createDebug.namespaces;
					enabledCache = createDebug.enabled(namespace);
				}

				return enabledCache;
			},
			set: v => {
				enableOverride = v;
			}
		});

		// Env-specific initialization logic for debug instances
		if (typeof createDebug.init === 'function') {
			createDebug.init(debug);
		}

		return debug;
	}

	function extend(namespace, delimiter) {
		const newDebug = createDebug(this.namespace + (typeof delimiter === 'undefined' ? ':' : delimiter) + namespace);
		newDebug.log = this.log;
		return newDebug;
	}

	/**
	* Enables a debug mode by namespaces. This can include modes
	* separated by a colon and wildcards.
	*
	* @param {String} namespaces
	* @api public
	*/
	function enable(namespaces) {
		createDebug.save(namespaces);
		createDebug.namespaces = namespaces;

		createDebug.names = [];
		createDebug.skips = [];

		const split = (typeof namespaces === 'string' ? namespaces : '')
			.trim()
			.replace(/\s+/g, ',')
			.split(',')
			.filter(Boolean);

		for (const ns of split) {
			if (ns[0] === '-') {
				createDebug.skips.push(ns.slice(1));
			} else {
				createDebug.names.push(ns);
			}
		}
	}

	/**
	 * Checks if the given string matches a namespace template, honoring
	 * asterisks as wildcards.
	 *
	 * @param {String} search
	 * @param {String} template
	 * @return {Boolean}
	 */
	function matchesTemplate(search, template) {
		let searchIndex = 0;
		let templateIndex = 0;
		let starIndex = -1;
		let matchIndex = 0;

		while (searchIndex < search.length) {
			if (templateIndex < template.length && (template[templateIndex] === search[searchIndex] || template[templateIndex] === '*')) {
				// Match character or proceed with wildcard
				if (template[templateIndex] === '*') {
					starIndex = templateIndex;
					matchIndex = searchIndex;
					templateIndex++; // Skip the '*'
				} else {
					searchIndex++;
					templateIndex++;
				}
			} else if (starIndex !== -1) { // eslint-disable-line no-negated-condition
				// Backtrack to the last '*' and try to match more characters
				templateIndex = starIndex + 1;
				matchIndex++;
				searchIndex = matchIndex;
			} else {
				return false; // No match
			}
		}

		// Handle trailing '*' in template
		while (templateIndex < template.length && template[templateIndex] === '*') {
			templateIndex++;
		}

		return templateIndex === template.length;
	}

	/**
	* Disable debug output.
	*
	* @return {String} namespaces
	* @api public
	*/
	function disable() {
		const namespaces = [
			...createDebug.names,
			...createDebug.skips.map(namespace => '-' + namespace)
		].join(',');
		createDebug.enable('');
		return namespaces;
	}

	/**
	* Returns true if the given mode name is enabled, false otherwise.
	*
	* @param {String} name
	* @return {Boolean}
	* @api public
	*/
	function enabled(name) {
		for (const skip of createDebug.skips) {
			if (matchesTemplate(name, skip)) {
				return false;
			}
		}

		for (const ns of createDebug.names) {
			if (matchesTemplate(name, ns)) {
				return true;
			}
		}

		return false;
	}

	/**
	* Coerce `val`.
	*
	* @param {Mixed} val
	* @return {Mixed}
	* @api private
	*/
	function coerce(val) {
		if (val instanceof Error) {
			return val.stack || val.message;
		}
		return val;
	}

	/**
	* XXX DO NOT USE. This is a temporary stub function.
	* XXX It WILL be removed in the next major release.
	*/
	function destroy() {
		console.warn('Instance method `debug.destroy()` is deprecated and no longer does anything. It will be removed in the next major version of `debug`.');
	}

	createDebug.enable(createDebug.load());

	return createDebug;
}

module.exports = setup;


/***/ }),

/***/ "./node_modules/ms/index.js":
/*!**********************************!*\
  !*** ./node_modules/ms/index.js ***!
  \**********************************/
/***/ ((module) => {

/**
 * Helpers.
 */

var s = 1000;
var m = s * 60;
var h = m * 60;
var d = h * 24;
var w = d * 7;
var y = d * 365.25;

/**
 * Parse or format the given `val`.
 *
 * Options:
 *
 *  - `long` verbose formatting [false]
 *
 * @param {String|Number} val
 * @param {Object} [options]
 * @throws {Error} throw an error if val is not a non-empty string or a number
 * @return {String|Number}
 * @api public
 */

module.exports = function (val, options) {
  options = options || {};
  var type = typeof val;
  if (type === 'string' && val.length > 0) {
    return parse(val);
  } else if (type === 'number' && isFinite(val)) {
    return options.long ? fmtLong(val) : fmtShort(val);
  }
  throw new Error(
    'val is not a non-empty string or a valid number. val=' +
      JSON.stringify(val)
  );
};

/**
 * Parse the given `str` and return milliseconds.
 *
 * @param {String} str
 * @return {Number}
 * @api private
 */

function parse(str) {
  str = String(str);
  if (str.length > 100) {
    return;
  }
  var match = /^(-?(?:\d+)?\.?\d+) *(milliseconds?|msecs?|ms|seconds?|secs?|s|minutes?|mins?|m|hours?|hrs?|h|days?|d|weeks?|w|years?|yrs?|y)?$/i.exec(
    str
  );
  if (!match) {
    return;
  }
  var n = parseFloat(match[1]);
  var type = (match[2] || 'ms').toLowerCase();
  switch (type) {
    case 'years':
    case 'year':
    case 'yrs':
    case 'yr':
    case 'y':
      return n * y;
    case 'weeks':
    case 'week':
    case 'w':
      return n * w;
    case 'days':
    case 'day':
    case 'd':
      return n * d;
    case 'hours':
    case 'hour':
    case 'hrs':
    case 'hr':
    case 'h':
      return n * h;
    case 'minutes':
    case 'minute':
    case 'mins':
    case 'min':
    case 'm':
      return n * m;
    case 'seconds':
    case 'second':
    case 'secs':
    case 'sec':
    case 's':
      return n * s;
    case 'milliseconds':
    case 'millisecond':
    case 'msecs':
    case 'msec':
    case 'ms':
      return n;
    default:
      return undefined;
  }
}

/**
 * Short format for `ms`.
 *
 * @param {Number} ms
 * @return {String}
 * @api private
 */

function fmtShort(ms) {
  var msAbs = Math.abs(ms);
  if (msAbs >= d) {
    return Math.round(ms / d) + 'd';
  }
  if (msAbs >= h) {
    return Math.round(ms / h) + 'h';
  }
  if (msAbs >= m) {
    return Math.round(ms / m) + 'm';
  }
  if (msAbs >= s) {
    return Math.round(ms / s) + 's';
  }
  return ms + 'ms';
}

/**
 * Long format for `ms`.
 *
 * @param {Number} ms
 * @return {String}
 * @api private
 */

function fmtLong(ms) {
  var msAbs = Math.abs(ms);
  if (msAbs >= d) {
    return plural(ms, msAbs, d, 'day');
  }
  if (msAbs >= h) {
    return plural(ms, msAbs, h, 'hour');
  }
  if (msAbs >= m) {
    return plural(ms, msAbs, m, 'minute');
  }
  if (msAbs >= s) {
    return plural(ms, msAbs, s, 'second');
  }
  return ms + ' ms';
}

/**
 * Pluralization helper.
 */

function plural(ms, msAbs, n, name) {
  var isPlural = msAbs >= n * 1.5;
  return Math.round(ms / n) + ' ' + name + (isPlural ? 's' : '');
}


/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/***/ ((module) => {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),

/***/ "./node_modules/@socket.io/component-emitter/lib/esm/index.js":
/*!********************************************************************!*\
  !*** ./node_modules/@socket.io/component-emitter/lib/esm/index.js ***!
  \********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Emitter: () => (/* binding */ Emitter)
/* harmony export */ });
/**
 * Initialize a new `Emitter`.
 *
 * @api public
 */

function Emitter(obj) {
  if (obj) return mixin(obj);
}

/**
 * Mixin the emitter properties.
 *
 * @param {Object} obj
 * @return {Object}
 * @api private
 */

function mixin(obj) {
  for (var key in Emitter.prototype) {
    obj[key] = Emitter.prototype[key];
  }
  return obj;
}

/**
 * Listen on the given `event` with `fn`.
 *
 * @param {String} event
 * @param {Function} fn
 * @return {Emitter}
 * @api public
 */

Emitter.prototype.on =
Emitter.prototype.addEventListener = function(event, fn){
  this._callbacks = this._callbacks || {};
  (this._callbacks['$' + event] = this._callbacks['$' + event] || [])
    .push(fn);
  return this;
};

/**
 * Adds an `event` listener that will be invoked a single
 * time then automatically removed.
 *
 * @param {String} event
 * @param {Function} fn
 * @return {Emitter}
 * @api public
 */

Emitter.prototype.once = function(event, fn){
  function on() {
    this.off(event, on);
    fn.apply(this, arguments);
  }

  on.fn = fn;
  this.on(event, on);
  return this;
};

/**
 * Remove the given callback for `event` or all
 * registered callbacks.
 *
 * @param {String} event
 * @param {Function} fn
 * @return {Emitter}
 * @api public
 */

Emitter.prototype.off =
Emitter.prototype.removeListener =
Emitter.prototype.removeAllListeners =
Emitter.prototype.removeEventListener = function(event, fn){
  this._callbacks = this._callbacks || {};

  // all
  if (0 == arguments.length) {
    this._callbacks = {};
    return this;
  }

  // specific event
  var callbacks = this._callbacks['$' + event];
  if (!callbacks) return this;

  // remove all handlers
  if (1 == arguments.length) {
    delete this._callbacks['$' + event];
    return this;
  }

  // remove specific handler
  var cb;
  for (var i = 0; i < callbacks.length; i++) {
    cb = callbacks[i];
    if (cb === fn || cb.fn === fn) {
      callbacks.splice(i, 1);
      break;
    }
  }

  // Remove event specific arrays for event types that no
  // one is subscribed for to avoid memory leak.
  if (callbacks.length === 0) {
    delete this._callbacks['$' + event];
  }

  return this;
};

/**
 * Emit `event` with the given args.
 *
 * @param {String} event
 * @param {Mixed} ...
 * @return {Emitter}
 */

Emitter.prototype.emit = function(event){
  this._callbacks = this._callbacks || {};

  var args = new Array(arguments.length - 1)
    , callbacks = this._callbacks['$' + event];

  for (var i = 1; i < arguments.length; i++) {
    args[i - 1] = arguments[i];
  }

  if (callbacks) {
    callbacks = callbacks.slice(0);
    for (var i = 0, len = callbacks.length; i < len; ++i) {
      callbacks[i].apply(this, args);
    }
  }

  return this;
};

// alias used for reserved events (protected method)
Emitter.prototype.emitReserved = Emitter.prototype.emit;

/**
 * Return array of callbacks for `event`.
 *
 * @param {String} event
 * @return {Array}
 * @api public
 */

Emitter.prototype.listeners = function(event){
  this._callbacks = this._callbacks || {};
  return this._callbacks['$' + event] || [];
};

/**
 * Check if this emitter has `event` handlers.
 *
 * @param {String} event
 * @return {Boolean}
 * @api public
 */

Emitter.prototype.hasListeners = function(event){
  return !! this.listeners(event).length;
};


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/contrib/has-cors.js":
/*!*********************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/contrib/has-cors.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   hasCORS: () => (/* binding */ hasCORS)
/* harmony export */ });
// imported from https://github.com/component/has-cors
let value = false;
try {
    value = typeof XMLHttpRequest !== 'undefined' &&
        'withCredentials' in new XMLHttpRequest();
}
catch (err) {
    // if XMLHttp support is disabled in IE then it will throw
    // when trying to create
}
const hasCORS = value;


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/contrib/parseqs.js":
/*!********************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/contrib/parseqs.js ***!
  \********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   decode: () => (/* binding */ decode),
/* harmony export */   encode: () => (/* binding */ encode)
/* harmony export */ });
// imported from https://github.com/galkn/querystring
/**
 * Compiles a querystring
 * Returns string representation of the object
 *
 * @param {Object}
 * @api private
 */
function encode(obj) {
    let str = '';
    for (let i in obj) {
        if (obj.hasOwnProperty(i)) {
            if (str.length)
                str += '&';
            str += encodeURIComponent(i) + '=' + encodeURIComponent(obj[i]);
        }
    }
    return str;
}
/**
 * Parses a simple querystring into an object
 *
 * @param {String} qs
 * @api private
 */
function decode(qs) {
    let qry = {};
    let pairs = qs.split('&');
    for (let i = 0, l = pairs.length; i < l; i++) {
        let pair = pairs[i].split('=');
        qry[decodeURIComponent(pair[0])] = decodeURIComponent(pair[1]);
    }
    return qry;
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/contrib/parseuri.js":
/*!*********************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/contrib/parseuri.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   parse: () => (/* binding */ parse)
/* harmony export */ });
// imported from https://github.com/galkn/parseuri
/**
 * Parses a URI
 *
 * Note: we could also have used the built-in URL object, but it isn't supported on all platforms.
 *
 * See:
 * - https://developer.mozilla.org/en-US/docs/Web/API/URL
 * - https://caniuse.com/url
 * - https://www.rfc-editor.org/rfc/rfc3986#appendix-B
 *
 * History of the parse() method:
 * - first commit: https://github.com/socketio/socket.io-client/commit/4ee1d5d94b3906a9c052b459f1a818b15f38f91c
 * - export into its own module: https://github.com/socketio/engine.io-client/commit/de2c561e4564efeb78f1bdb1ba39ef81b2822cb3
 * - reimport: https://github.com/socketio/engine.io-client/commit/df32277c3f6d622eec5ed09f493cae3f3391d242
 *
 * @author Steven Levithan <stevenlevithan.com> (MIT license)
 * @api private
 */
const re = /^(?:(?![^:@\/?#]+:[^:@\/]*@)(http|https|ws|wss):\/\/)?((?:(([^:@\/?#]*)(?::([^:@\/?#]*))?)?@)?((?:[a-f0-9]{0,4}:){2,7}[a-f0-9]{0,4}|[^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/;
const parts = [
    'source', 'protocol', 'authority', 'userInfo', 'user', 'password', 'host', 'port', 'relative', 'path', 'directory', 'file', 'query', 'anchor'
];
function parse(str) {
    if (str.length > 8000) {
        throw "URI too long";
    }
    const src = str, b = str.indexOf('['), e = str.indexOf(']');
    if (b != -1 && e != -1) {
        str = str.substring(0, b) + str.substring(b, e).replace(/:/g, ';') + str.substring(e, str.length);
    }
    let m = re.exec(str || ''), uri = {}, i = 14;
    while (i--) {
        uri[parts[i]] = m[i] || '';
    }
    if (b != -1 && e != -1) {
        uri.source = src;
        uri.host = uri.host.substring(1, uri.host.length - 1).replace(/;/g, ':');
        uri.authority = uri.authority.replace('[', '').replace(']', '').replace(/;/g, ':');
        uri.ipv6uri = true;
    }
    uri.pathNames = pathNames(uri, uri['path']);
    uri.queryKey = queryKey(uri, uri['query']);
    return uri;
}
function pathNames(obj, path) {
    const regx = /\/{2,9}/g, names = path.replace(regx, "/").split("/");
    if (path.slice(0, 1) == '/' || path.length === 0) {
        names.splice(0, 1);
    }
    if (path.slice(-1) == '/') {
        names.splice(names.length - 1, 1);
    }
    return names;
}
function queryKey(uri, query) {
    const data = {};
    query.replace(/(?:^|&)([^&=]*)=?([^&]*)/g, function ($0, $1, $2) {
        if ($1) {
            data[$1] = $2;
        }
    });
    return data;
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/globals.js":
/*!************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/globals.js ***!
  \************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   createCookieJar: () => (/* binding */ createCookieJar),
/* harmony export */   defaultBinaryType: () => (/* binding */ defaultBinaryType),
/* harmony export */   globalThisShim: () => (/* binding */ globalThisShim),
/* harmony export */   nextTick: () => (/* binding */ nextTick)
/* harmony export */ });
const nextTick = (() => {
    const isPromiseAvailable = typeof Promise === "function" && typeof Promise.resolve === "function";
    if (isPromiseAvailable) {
        return (cb) => Promise.resolve().then(cb);
    }
    else {
        return (cb, setTimeoutFn) => setTimeoutFn(cb, 0);
    }
})();
const globalThisShim = (() => {
    if (typeof self !== "undefined") {
        return self;
    }
    else if (typeof window !== "undefined") {
        return window;
    }
    else {
        return Function("return this")();
    }
})();
const defaultBinaryType = "arraybuffer";
function createCookieJar() { }


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/index.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Fetch: () => (/* reexport safe */ _transports_polling_fetch_js__WEBPACK_IMPORTED_MODULE_6__.Fetch),
/* harmony export */   NodeWebSocket: () => (/* reexport safe */ _transports_websocket_node_js__WEBPACK_IMPORTED_MODULE_8__.WS),
/* harmony export */   NodeXHR: () => (/* reexport safe */ _transports_polling_xhr_node_js__WEBPACK_IMPORTED_MODULE_7__.XHR),
/* harmony export */   Socket: () => (/* reexport safe */ _socket_js__WEBPACK_IMPORTED_MODULE_0__.Socket),
/* harmony export */   Transport: () => (/* reexport safe */ _transport_js__WEBPACK_IMPORTED_MODULE_1__.Transport),
/* harmony export */   TransportError: () => (/* reexport safe */ _transport_js__WEBPACK_IMPORTED_MODULE_1__.TransportError),
/* harmony export */   WebSocket: () => (/* reexport safe */ _transports_websocket_node_js__WEBPACK_IMPORTED_MODULE_8__.WS),
/* harmony export */   WebTransport: () => (/* reexport safe */ _transports_webtransport_js__WEBPACK_IMPORTED_MODULE_9__.WT),
/* harmony export */   XHR: () => (/* reexport safe */ _transports_polling_xhr_node_js__WEBPACK_IMPORTED_MODULE_7__.XHR),
/* harmony export */   installTimerFunctions: () => (/* reexport safe */ _util_js__WEBPACK_IMPORTED_MODULE_3__.installTimerFunctions),
/* harmony export */   nextTick: () => (/* reexport safe */ _globals_node_js__WEBPACK_IMPORTED_MODULE_5__.nextTick),
/* harmony export */   parse: () => (/* reexport safe */ _contrib_parseuri_js__WEBPACK_IMPORTED_MODULE_4__.parse),
/* harmony export */   protocol: () => (/* binding */ protocol),
/* harmony export */   transports: () => (/* reexport safe */ _transports_index_js__WEBPACK_IMPORTED_MODULE_2__.transports)
/* harmony export */ });
/* harmony import */ var _socket_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./socket.js */ "./node_modules/engine.io-client/build/esm/socket.js");
/* harmony import */ var _transport_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./transport.js */ "./node_modules/engine.io-client/build/esm/transport.js");
/* harmony import */ var _transports_index_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./transports/index.js */ "./node_modules/engine.io-client/build/esm/transports/index.js");
/* harmony import */ var _util_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./util.js */ "./node_modules/engine.io-client/build/esm/util.js");
/* harmony import */ var _contrib_parseuri_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./contrib/parseuri.js */ "./node_modules/engine.io-client/build/esm/contrib/parseuri.js");
/* harmony import */ var _globals_node_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./globals.node.js */ "./node_modules/engine.io-client/build/esm/globals.js");
/* harmony import */ var _transports_polling_fetch_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./transports/polling-fetch.js */ "./node_modules/engine.io-client/build/esm/transports/polling-fetch.js");
/* harmony import */ var _transports_polling_xhr_node_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! ./transports/polling-xhr.js */ "./node_modules/engine.io-client/build/esm/transports/polling-xhr.js");
/* harmony import */ var _transports_websocket_node_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! ./transports/websocket.js */ "./node_modules/engine.io-client/build/esm/transports/websocket.js");
/* harmony import */ var _transports_webtransport_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! ./transports/webtransport.js */ "./node_modules/engine.io-client/build/esm/transports/webtransport.js");


const protocol = _socket_js__WEBPACK_IMPORTED_MODULE_0__.Socket.protocol;













/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/socket.js":
/*!***********************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/socket.js ***!
  \***********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Socket: () => (/* binding */ Socket)
/* harmony export */ });
/* harmony import */ var _transports_index_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./transports/index.js */ "./node_modules/engine.io-client/build/esm/transports/index.js");
/* harmony import */ var _util_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./util.js */ "./node_modules/engine.io-client/build/esm/util.js");
/* harmony import */ var _contrib_parseqs_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./contrib/parseqs.js */ "./node_modules/engine.io-client/build/esm/contrib/parseqs.js");
/* harmony import */ var _contrib_parseuri_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./contrib/parseuri.js */ "./node_modules/engine.io-client/build/esm/contrib/parseuri.js");
/* harmony import */ var _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @socket.io/component-emitter */ "./node_modules/@socket.io/component-emitter/lib/esm/index.js");
/* harmony import */ var engine_io_parser__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! engine.io-parser */ "./node_modules/engine.io-parser/build/esm/index.js");
/* harmony import */ var _globals_node_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ./globals.node.js */ "./node_modules/engine.io-client/build/esm/globals.js");







const withEventListeners = typeof addEventListener === "function" &&
    typeof removeEventListener === "function";
const OFFLINE_EVENT_LISTENERS = [];
if (withEventListeners) {
    // within a ServiceWorker, any event handler for the 'offline' event must be added on the initial evaluation of the
    // script, so we create one single event listener here which will forward the event to the socket instances
    addEventListener("offline", () => {
        OFFLINE_EVENT_LISTENERS.forEach((listener) => listener());
    }, false);
}
/**
 * This class provides a WebSocket-like interface to connect to an Engine.IO server. The connection will be established
 * with one of the available low-level transports, like HTTP long-polling, WebSocket, or WebTransport.
 *
 * This class comes with an upgrade mechanism, which means that once the connection is established with the first
 * low-level transport, it will try to upgrade to a better transport.
 *
 * @example
 * import { Socket } from "engine.io-client";
 *
 * const socket = new Socket();
 *
 * socket.on("open", () => {
 *   socket.send("hello");
 * });
 *
 */
class Socket extends _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_4__.Emitter {
    constructor(uri, opts = {}) {
        var _a, _b;
        super();
        this.binaryType = _globals_node_js__WEBPACK_IMPORTED_MODULE_6__.defaultBinaryType;
        this.writeBuffer = [];
        this._prevBufferLen = 0;
        this._upgrades = [];
        this._pingInterval = -1;
        this._pingTimeout = -1;
        this._maxPayload = -1;
        /**
         * The expiration timestamp of the {@link _pingTimeoutTimer} object is tracked, in case the timer is throttled and the
         * callback is not fired on time. This can happen for example when a laptop is suspended or when a phone is locked.
         */
        this._pingTimeoutTime = Infinity;
        if (uri && "object" === typeof uri) {
            opts = uri;
            uri = null;
        }
        if (uri) {
            const parsedUri = (0,_contrib_parseuri_js__WEBPACK_IMPORTED_MODULE_3__.parse)(uri);
            opts.hostname = parsedUri.host;
            opts.secure =
                parsedUri.protocol === "https" || parsedUri.protocol === "wss";
            opts.port = parsedUri.port;
            if (parsedUri.query)
                opts.query = parsedUri.query;
        }
        else if (opts.host) {
            opts.hostname = (0,_contrib_parseuri_js__WEBPACK_IMPORTED_MODULE_3__.parse)(opts.host).host;
        }
        (0,_util_js__WEBPACK_IMPORTED_MODULE_1__.installTimerFunctions)(this, opts);
        this.secure =
            null != opts.secure
                ? opts.secure
                : typeof location !== "undefined" && "https:" === location.protocol;
        if (opts.hostname && !opts.port) {
            // if no port is specified manually, use the protocol default
            opts.port = this.secure ? "443" : "80";
        }
        this.hostname =
            opts.hostname ||
                (typeof location !== "undefined" ? location.hostname : "localhost");
        this.port =
            opts.port ||
                (typeof location !== "undefined" && location.port
                    ? location.port
                    : this.secure
                        ? "443"
                        : "80");
        if (opts.transportImplementations && opts.transports) {
            throw new Error("specifying both 'transportImplementations' and 'transports' options is not supported");
        }
        if (opts.transportImplementations ||
            (((_a = opts.transports) === null || _a === void 0 ? void 0 : _a.length) && typeof opts.transports[0] === "function")) {
            // 'transports' option as an array of transport implementations is kept for backward compatibility
            this.transports = [];
            this._transportsByName = Object.create(null);
            ((_b = opts.transportImplementations) !== null && _b !== void 0 ? _b : opts.transports).forEach((t) => {
                const transportName = t.prototype.name;
                this.transports.push(transportName);
                this._transportsByName[transportName] = t;
            });
        }
        else {
            this.transports = opts.transports
                ? [...opts.transports]
                : ["polling", "websocket", "webtransport"];
            this._transportsByName = _transports_index_js__WEBPACK_IMPORTED_MODULE_0__.transports;
        }
        this.opts = Object.assign({
            path: "/engine.io",
            agent: false,
            withCredentials: false,
            upgrade: true,
            timestampParam: "t",
            rememberUpgrade: false,
            addTrailingSlash: true,
            rejectUnauthorized: true,
            perMessageDeflate: {
                threshold: 1024,
            },
            transportOptions: {},
            closeOnBeforeunload: false,
        }, opts);
        this.opts.path =
            this.opts.path.replace(/\/$/, "") +
                (this.opts.addTrailingSlash ? "/" : "");
        if (typeof this.opts.query === "string") {
            this.opts.query = (0,_contrib_parseqs_js__WEBPACK_IMPORTED_MODULE_2__.decode)(this.opts.query);
        }
        if (withEventListeners) {
            if (this.opts.closeOnBeforeunload) {
                // Firefox closes the connection when the "beforeunload" event is emitted but not Chrome. This event listener
                // ensures every browser behaves the same (no "disconnect" event at the Socket.IO level when the page is
                // closed/reloaded)
                this._beforeunloadEventListener = () => {
                    if (this.transport) {
                        // silently close the transport
                        this.transport.removeAllListeners();
                        this.transport.close();
                    }
                };
                addEventListener("beforeunload", this._beforeunloadEventListener, false);
            }
            if (this.hostname !== "localhost") {
                this._offlineEventListener = () => {
                    this._onClose("transport close", {
                        description: "network connection lost",
                    });
                };
                OFFLINE_EVENT_LISTENERS.push(this._offlineEventListener);
            }
        }
        if (this.opts.withCredentials) {
            this._cookieJar = (0,_globals_node_js__WEBPACK_IMPORTED_MODULE_6__.createCookieJar)();
        }
        this._open();
    }
    /**
     * Creates transport of the given type.
     *
     * @param {String} name - transport name
     * @return {Transport}
     * @private
     */
    createTransport(name) {
        const query = Object.assign({}, this.opts.query);
        // append engine.io protocol identifier
        query.EIO = engine_io_parser__WEBPACK_IMPORTED_MODULE_5__.protocol;
        // transport name
        query.transport = name;
        // session id if we already have one
        if (this.id)
            query.sid = this.id;
        const opts = Object.assign({}, this.opts, {
            query,
            socket: this,
            hostname: this.hostname,
            secure: this.secure,
            port: this.port,
        }, this.opts.transportOptions[name]);
        return new this._transportsByName[name](opts);
    }
    /**
     * Initializes transport to use and starts probe.
     *
     * @private
     */
    _open() {
        if (this.transports.length === 0) {
            // Emit error on next tick so it can be listened to
            this.setTimeoutFn(() => {
                this.emitReserved("error", "No transports available");
            }, 0);
            return;
        }
        const transportName = this.opts.rememberUpgrade &&
            Socket.priorWebsocketSuccess &&
            this.transports.indexOf("websocket") !== -1
            ? "websocket"
            : this.transports[0];
        this.readyState = "opening";
        const transport = this.createTransport(transportName);
        transport.open();
        this.setTransport(transport);
    }
    /**
     * Sets the current transport. Disables the existing one (if any).
     *
     * @private
     */
    setTransport(transport) {
        if (this.transport) {
            this.transport.removeAllListeners();
        }
        // set up transport
        this.transport = transport;
        // set up transport listeners
        transport
            .on("drain", this._onDrain.bind(this))
            .on("packet", this._onPacket.bind(this))
            .on("error", this._onError.bind(this))
            .on("close", (reason) => this._onClose("transport close", reason));
    }
    /**
     * Probes a transport.
     *
     * @param {String} name - transport name
     * @private
     */
    _probe(name) {
        let transport = this.createTransport(name);
        let failed = false;
        Socket.priorWebsocketSuccess = false;
        const onTransportOpen = () => {
            if (failed)
                return;
            transport.send([{ type: "ping", data: "probe" }]);
            transport.once("packet", (msg) => {
                if (failed)
                    return;
                if ("pong" === msg.type && "probe" === msg.data) {
                    this.upgrading = true;
                    this.emitReserved("upgrading", transport);
                    if (!transport)
                        return;
                    Socket.priorWebsocketSuccess = "websocket" === transport.name;
                    this.transport.pause(() => {
                        if (failed)
                            return;
                        if ("closed" === this.readyState)
                            return;
                        cleanup();
                        this.setTransport(transport);
                        transport.send([{ type: "upgrade" }]);
                        this.emitReserved("upgrade", transport);
                        transport = null;
                        this.upgrading = false;
                        this.flush();
                    });
                }
                else {
                    const err = new Error("probe error");
                    // @ts-ignore
                    err.transport = transport.name;
                    this.emitReserved("upgradeError", err);
                }
            });
        };
        function freezeTransport() {
            if (failed)
                return;
            // Any callback called by transport should be ignored since now
            failed = true;
            cleanup();
            transport.close();
            transport = null;
        }
        // Handle any error that happens while probing
        const onerror = (err) => {
            const error = new Error("probe error: " + err);
            // @ts-ignore
            error.transport = transport.name;
            freezeTransport();
            this.emitReserved("upgradeError", error);
        };
        function onTransportClose() {
            onerror("transport closed");
        }
        // When the socket is closed while we're probing
        function onclose() {
            onerror("socket closed");
        }
        // When the socket is upgraded while we're probing
        function onupgrade(to) {
            if (transport && to.name !== transport.name) {
                freezeTransport();
            }
        }
        // Remove all listeners on the transport and on self
        const cleanup = () => {
            transport.removeListener("open", onTransportOpen);
            transport.removeListener("error", onerror);
            transport.removeListener("close", onTransportClose);
            this.off("close", onclose);
            this.off("upgrading", onupgrade);
        };
        transport.once("open", onTransportOpen);
        transport.once("error", onerror);
        transport.once("close", onTransportClose);
        this.once("close", onclose);
        this.once("upgrading", onupgrade);
        if (this._upgrades.indexOf("webtransport") !== -1 &&
            name !== "webtransport") {
            // favor WebTransport
            this.setTimeoutFn(() => {
                if (!failed) {
                    transport.open();
                }
            }, 200);
        }
        else {
            transport.open();
        }
    }
    /**
     * Called when connection is deemed open.
     *
     * @private
     */
    onOpen() {
        this.readyState = "open";
        Socket.priorWebsocketSuccess = "websocket" === this.transport.name;
        this.emitReserved("open");
        this.flush();
        if ("open" === this.readyState && this.opts.upgrade) {
            for (let i = 0; i < this._upgrades.length; i++) {
                this._probe(this._upgrades[i]);
            }
        }
    }
    /**
     * Handles a packet.
     *
     * @private
     */
    _onPacket(packet) {
        if ("opening" === this.readyState ||
            "open" === this.readyState ||
            "closing" === this.readyState) {
            this.emitReserved("packet", packet);
            // Socket is live - any packet counts
            this.emitReserved("heartbeat");
            switch (packet.type) {
                case "open":
                    this.onHandshake(JSON.parse(packet.data));
                    break;
                case "ping":
                    this._sendPacket("pong");
                    this.emitReserved("ping");
                    this.emitReserved("pong");
                    this._resetPingTimeout();
                    break;
                case "error":
                    const err = new Error("server error");
                    // @ts-ignore
                    err.code = packet.data;
                    this._onError(err);
                    break;
                case "message":
                    this.emitReserved("data", packet.data);
                    this.emitReserved("message", packet.data);
                    break;
            }
        }
        else {
        }
    }
    /**
     * Called upon handshake completion.
     *
     * @param {Object} data - handshake obj
     * @private
     */
    onHandshake(data) {
        this.emitReserved("handshake", data);
        this.id = data.sid;
        this.transport.query.sid = data.sid;
        this._upgrades = this._filterUpgrades(data.upgrades);
        this._pingInterval = data.pingInterval;
        this._pingTimeout = data.pingTimeout;
        this._maxPayload = data.maxPayload;
        this.onOpen();
        // In case open handler closes socket
        if ("closed" === this.readyState)
            return;
        this._resetPingTimeout();
    }
    /**
     * Sets and resets ping timeout timer based on server pings.
     *
     * @private
     */
    _resetPingTimeout() {
        this.clearTimeoutFn(this._pingTimeoutTimer);
        const delay = this._pingInterval + this._pingTimeout;
        this._pingTimeoutTime = Date.now() + delay;
        this._pingTimeoutTimer = this.setTimeoutFn(() => {
            this._onClose("ping timeout");
        }, delay);
        if (this.opts.autoUnref) {
            this._pingTimeoutTimer.unref();
        }
    }
    /**
     * Called on `drain` event
     *
     * @private
     */
    _onDrain() {
        this.writeBuffer.splice(0, this._prevBufferLen);
        // setting prevBufferLen = 0 is very important
        // for example, when upgrading, upgrade packet is sent over,
        // and a nonzero prevBufferLen could cause problems on `drain`
        this._prevBufferLen = 0;
        if (0 === this.writeBuffer.length) {
            this.emitReserved("drain");
        }
        else {
            this.flush();
        }
    }
    /**
     * Flush write buffers.
     *
     * @private
     */
    flush() {
        if ("closed" !== this.readyState &&
            this.transport.writable &&
            !this.upgrading &&
            this.writeBuffer.length) {
            const packets = this._getWritablePackets();
            this.transport.send(packets);
            // keep track of current length of writeBuffer
            // splice writeBuffer and callbackBuffer on `drain`
            this._prevBufferLen = packets.length;
            this.emitReserved("flush");
        }
    }
    /**
     * Ensure the encoded size of the writeBuffer is below the maxPayload value sent by the server (only for HTTP
     * long-polling)
     *
     * @private
     */
    _getWritablePackets() {
        const shouldCheckPayloadSize = this._maxPayload &&
            this.transport.name === "polling" &&
            this.writeBuffer.length > 1;
        if (!shouldCheckPayloadSize) {
            return this.writeBuffer;
        }
        let payloadSize = 1; // first packet type
        for (let i = 0; i < this.writeBuffer.length; i++) {
            const data = this.writeBuffer[i].data;
            if (data) {
                payloadSize += (0,_util_js__WEBPACK_IMPORTED_MODULE_1__.byteLength)(data);
            }
            if (i > 0 && payloadSize > this._maxPayload) {
                return this.writeBuffer.slice(0, i);
            }
            payloadSize += 2; // separator + packet type
        }
        return this.writeBuffer;
    }
    /**
     * Checks whether the heartbeat timer has expired but the socket has not yet been notified.
     *
     * Note: this method is private for now because it does not really fit the WebSocket API, but if we put it in the
     * `write()` method then the message would not be buffered by the Socket.IO client.
     *
     * @return {boolean}
     * @private
     */
    /* private */ _hasPingExpired() {
        if (!this._pingTimeoutTime)
            return true;
        const hasExpired = Date.now() > this._pingTimeoutTime;
        if (hasExpired) {
            this._pingTimeoutTime = 0;
            (0,_globals_node_js__WEBPACK_IMPORTED_MODULE_6__.nextTick)(() => {
                this._onClose("ping timeout");
            }, this.setTimeoutFn);
        }
        return hasExpired;
    }
    /**
     * Sends a message.
     *
     * @param {String} msg - message.
     * @param {Object} options.
     * @param {Function} fn - callback function.
     * @return {Socket} for chaining.
     */
    write(msg, options, fn) {
        this._sendPacket("message", msg, options, fn);
        return this;
    }
    /**
     * Sends a message. Alias of {@link Socket#write}.
     *
     * @param {String} msg - message.
     * @param {Object} options.
     * @param {Function} fn - callback function.
     * @return {Socket} for chaining.
     */
    send(msg, options, fn) {
        this._sendPacket("message", msg, options, fn);
        return this;
    }
    /**
     * Sends a packet.
     *
     * @param {String} type - packet type.
     * @param {String} data.
     * @param {Object} options.
     * @param {Function} fn - callback function.
     * @private
     */
    _sendPacket(type, data, options, fn) {
        if ("function" === typeof data) {
            fn = data;
            data = undefined;
        }
        if ("function" === typeof options) {
            fn = options;
            options = null;
        }
        if ("closing" === this.readyState || "closed" === this.readyState) {
            return;
        }
        options = options || {};
        options.compress = false !== options.compress;
        const packet = {
            type: type,
            data: data,
            options: options,
        };
        this.emitReserved("packetCreate", packet);
        this.writeBuffer.push(packet);
        if (fn)
            this.once("flush", fn);
        this.flush();
    }
    /**
     * Closes the connection.
     */
    close() {
        const close = () => {
            this._onClose("forced close");
            this.transport.close();
        };
        const cleanupAndClose = () => {
            this.off("upgrade", cleanupAndClose);
            this.off("upgradeError", cleanupAndClose);
            close();
        };
        const waitForUpgrade = () => {
            // wait for upgrade to finish since we can't send packets while pausing a transport
            this.once("upgrade", cleanupAndClose);
            this.once("upgradeError", cleanupAndClose);
        };
        if ("opening" === this.readyState || "open" === this.readyState) {
            this.readyState = "closing";
            if (this.writeBuffer.length) {
                this.once("drain", () => {
                    if (this.upgrading) {
                        waitForUpgrade();
                    }
                    else {
                        close();
                    }
                });
            }
            else if (this.upgrading) {
                waitForUpgrade();
            }
            else {
                close();
            }
        }
        return this;
    }
    /**
     * Called upon transport error
     *
     * @private
     */
    _onError(err) {
        Socket.priorWebsocketSuccess = false;
        if (this.opts.tryAllTransports &&
            this.transports.length > 1 &&
            this.readyState === "opening") {
            this.transports.shift();
            return this._open();
        }
        this.emitReserved("error", err);
        this._onClose("transport error", err);
    }
    /**
     * Called upon transport close.
     *
     * @private
     */
    _onClose(reason, description) {
        if ("opening" === this.readyState ||
            "open" === this.readyState ||
            "closing" === this.readyState) {
            // clear timers
            this.clearTimeoutFn(this._pingTimeoutTimer);
            // stop event from firing again for transport
            this.transport.removeAllListeners("close");
            // ensure transport won't stay open
            this.transport.close();
            // ignore further transport communication
            this.transport.removeAllListeners();
            if (withEventListeners) {
                if (this._beforeunloadEventListener) {
                    removeEventListener("beforeunload", this._beforeunloadEventListener, false);
                }
                if (this._offlineEventListener) {
                    const i = OFFLINE_EVENT_LISTENERS.indexOf(this._offlineEventListener);
                    if (i !== -1) {
                        OFFLINE_EVENT_LISTENERS.splice(i, 1);
                    }
                }
            }
            // set ready state
            this.readyState = "closed";
            // clear session id
            this.id = null;
            // emit close event
            this.emitReserved("close", reason, description);
            // clean buffers after, so users can still
            // grab the buffers on `close` event
            this.writeBuffer = [];
            this._prevBufferLen = 0;
        }
    }
    /**
     * Filters upgrades, returning only those matching client transports.
     *
     * @param {Array} upgrades - server upgrades
     * @private
     */
    _filterUpgrades(upgrades) {
        const filteredUpgrades = [];
        for (let i = 0; i < upgrades.length; i++) {
            if (~this.transports.indexOf(upgrades[i]))
                filteredUpgrades.push(upgrades[i]);
        }
        return filteredUpgrades;
    }
}
Socket.protocol = engine_io_parser__WEBPACK_IMPORTED_MODULE_5__.protocol;


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transport.js":
/*!**************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transport.js ***!
  \**************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Transport: () => (/* binding */ Transport),
/* harmony export */   TransportError: () => (/* binding */ TransportError)
/* harmony export */ });
/* harmony import */ var engine_io_parser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! engine.io-parser */ "./node_modules/engine.io-parser/build/esm/index.js");
/* harmony import */ var _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @socket.io/component-emitter */ "./node_modules/@socket.io/component-emitter/lib/esm/index.js");
/* harmony import */ var _util_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./util.js */ "./node_modules/engine.io-client/build/esm/util.js");
/* harmony import */ var _contrib_parseqs_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./contrib/parseqs.js */ "./node_modules/engine.io-client/build/esm/contrib/parseqs.js");




class TransportError extends Error {
    constructor(reason, description, context) {
        super(reason);
        this.description = description;
        this.context = context;
        this.type = "TransportError";
    }
}
class Transport extends _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_1__.Emitter {
    /**
     * Transport abstract constructor.
     *
     * @param {Object} opts - options
     * @protected
     */
    constructor(opts) {
        super();
        this.writable = false;
        (0,_util_js__WEBPACK_IMPORTED_MODULE_2__.installTimerFunctions)(this, opts);
        this.opts = opts;
        this.query = opts.query;
        this.socket = opts.socket;
        this.supportsBinary = !opts.forceBase64;
    }
    /**
     * Emits an error.
     *
     * @param {String} reason
     * @param description
     * @param context - the error context
     * @return {Transport} for chaining
     * @protected
     */
    onError(reason, description, context) {
        super.emitReserved("error", new TransportError(reason, description, context));
        return this;
    }
    /**
     * Opens the transport.
     */
    open() {
        this.readyState = "opening";
        this.doOpen();
        return this;
    }
    /**
     * Closes the transport.
     */
    close() {
        if (this.readyState === "opening" || this.readyState === "open") {
            this.doClose();
            this.onClose();
        }
        return this;
    }
    /**
     * Sends multiple packets.
     *
     * @param {Array} packets
     */
    send(packets) {
        if (this.readyState === "open") {
            this.write(packets);
        }
        else {
            // this might happen if the transport was silently closed in the beforeunload event handler
        }
    }
    /**
     * Called upon open
     *
     * @protected
     */
    onOpen() {
        this.readyState = "open";
        this.writable = true;
        super.emitReserved("open");
    }
    /**
     * Called with data.
     *
     * @param {String} data
     * @protected
     */
    onData(data) {
        const packet = (0,engine_io_parser__WEBPACK_IMPORTED_MODULE_0__.decodePacket)(data, this.socket.binaryType);
        this.onPacket(packet);
    }
    /**
     * Called with a decoded packet.
     *
     * @protected
     */
    onPacket(packet) {
        super.emitReserved("packet", packet);
    }
    /**
     * Called upon close.
     *
     * @protected
     */
    onClose(details) {
        this.readyState = "closed";
        super.emitReserved("close", details);
    }
    /**
     * Pauses the transport, in order not to lose packets during an upgrade.
     *
     * @param onPause
     */
    pause(onPause) { }
    createUri(schema, query = {}) {
        return (schema +
            "://" +
            this._hostname() +
            this._port() +
            this.opts.path +
            this._query(query));
    }
    _hostname() {
        const hostname = this.opts.hostname;
        return hostname.indexOf(":") === -1 ? hostname : "[" + hostname + "]";
    }
    _port() {
        if (this.opts.port &&
            ((this.opts.secure && Number(this.opts.port) !== 443) ||
                (!this.opts.secure && Number(this.opts.port) !== 80))) {
            return ":" + this.opts.port;
        }
        else {
            return "";
        }
    }
    _query(query) {
        const encodedQuery = (0,_contrib_parseqs_js__WEBPACK_IMPORTED_MODULE_3__.encode)(query);
        return encodedQuery.length ? "?" + encodedQuery : "";
    }
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transports/index.js":
/*!*********************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transports/index.js ***!
  \*********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   transports: () => (/* binding */ transports)
/* harmony export */ });
/* harmony import */ var _polling_xhr_node_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./polling-xhr.node.js */ "./node_modules/engine.io-client/build/esm/transports/polling-xhr.js");
/* harmony import */ var _websocket_node_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./websocket.node.js */ "./node_modules/engine.io-client/build/esm/transports/websocket.js");
/* harmony import */ var _webtransport_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./webtransport.js */ "./node_modules/engine.io-client/build/esm/transports/webtransport.js");



const transports = {
    websocket: _websocket_node_js__WEBPACK_IMPORTED_MODULE_1__.WS,
    webtransport: _webtransport_js__WEBPACK_IMPORTED_MODULE_2__.WT,
    polling: _polling_xhr_node_js__WEBPACK_IMPORTED_MODULE_0__.XHR,
};


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transports/polling-fetch.js":
/*!*****************************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transports/polling-fetch.js ***!
  \*****************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Fetch: () => (/* binding */ Fetch)
/* harmony export */ });
/* harmony import */ var _polling_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./polling.js */ "./node_modules/engine.io-client/build/esm/transports/polling.js");

/**
 * HTTP long-polling based on the built-in `fetch()` method.
 *
 * Usage: browser, Node.js (since v18), Deno, Bun
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/fetch
 * @see https://caniuse.com/fetch
 * @see https://nodejs.org/api/globals.html#fetch
 */
class Fetch extends _polling_js__WEBPACK_IMPORTED_MODULE_0__.Polling {
    doPoll() {
        this._fetch()
            .then((res) => {
            if (!res.ok) {
                return this.onError("fetch read error", res.status, res);
            }
            res.text().then((data) => this.onData(data));
        })
            .catch((err) => {
            this.onError("fetch read error", err);
        });
    }
    doWrite(data, callback) {
        this._fetch(data)
            .then((res) => {
            if (!res.ok) {
                return this.onError("fetch write error", res.status, res);
            }
            callback();
        })
            .catch((err) => {
            this.onError("fetch write error", err);
        });
    }
    _fetch(data) {
        var _a;
        const isPost = data !== undefined;
        const headers = new Headers(this.opts.extraHeaders);
        if (isPost) {
            headers.set("content-type", "text/plain;charset=UTF-8");
        }
        (_a = this.socket._cookieJar) === null || _a === void 0 ? void 0 : _a.appendCookies(headers);
        return fetch(this.uri(), {
            method: isPost ? "POST" : "GET",
            body: isPost ? data : null,
            headers,
            credentials: this.opts.withCredentials ? "include" : "omit",
        }).then((res) => {
            var _a;
            // @ts-ignore getSetCookie() was added in Node.js v19.7.0
            (_a = this.socket._cookieJar) === null || _a === void 0 ? void 0 : _a.parseCookies(res.headers.getSetCookie());
            return res;
        });
    }
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transports/polling-xhr.js":
/*!***************************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transports/polling-xhr.js ***!
  \***************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BaseXHR: () => (/* binding */ BaseXHR),
/* harmony export */   Request: () => (/* binding */ Request),
/* harmony export */   XHR: () => (/* binding */ XHR)
/* harmony export */ });
/* harmony import */ var _polling_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./polling.js */ "./node_modules/engine.io-client/build/esm/transports/polling.js");
/* harmony import */ var _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @socket.io/component-emitter */ "./node_modules/@socket.io/component-emitter/lib/esm/index.js");
/* harmony import */ var _util_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../util.js */ "./node_modules/engine.io-client/build/esm/util.js");
/* harmony import */ var _globals_node_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../globals.node.js */ "./node_modules/engine.io-client/build/esm/globals.js");
/* harmony import */ var _contrib_has_cors_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ../contrib/has-cors.js */ "./node_modules/engine.io-client/build/esm/contrib/has-cors.js");





function empty() { }
class BaseXHR extends _polling_js__WEBPACK_IMPORTED_MODULE_0__.Polling {
    /**
     * XHR Polling constructor.
     *
     * @param {Object} opts
     * @package
     */
    constructor(opts) {
        super(opts);
        if (typeof location !== "undefined") {
            const isSSL = "https:" === location.protocol;
            let port = location.port;
            // some user agents have empty `location.port`
            if (!port) {
                port = isSSL ? "443" : "80";
            }
            this.xd =
                (typeof location !== "undefined" &&
                    opts.hostname !== location.hostname) ||
                    port !== opts.port;
        }
    }
    /**
     * Sends data.
     *
     * @param {String} data - data to send.
     * @param {Function} fn - called upon flush.
     * @private
     */
    doWrite(data, fn) {
        const req = this.request({
            method: "POST",
            data: data,
        });
        req.on("success", fn);
        req.on("error", (xhrStatus, context) => {
            this.onError("xhr post error", xhrStatus, context);
        });
    }
    /**
     * Starts a poll cycle.
     *
     * @private
     */
    doPoll() {
        const req = this.request();
        req.on("data", this.onData.bind(this));
        req.on("error", (xhrStatus, context) => {
            this.onError("xhr poll error", xhrStatus, context);
        });
        this.pollXhr = req;
    }
}
class Request extends _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_1__.Emitter {
    /**
     * Request constructor
     *
     * @param {Object} options
     * @package
     */
    constructor(createRequest, uri, opts) {
        super();
        this.createRequest = createRequest;
        (0,_util_js__WEBPACK_IMPORTED_MODULE_2__.installTimerFunctions)(this, opts);
        this._opts = opts;
        this._method = opts.method || "GET";
        this._uri = uri;
        this._data = undefined !== opts.data ? opts.data : null;
        this._create();
    }
    /**
     * Creates the XHR object and sends the request.
     *
     * @private
     */
    _create() {
        var _a;
        const opts = (0,_util_js__WEBPACK_IMPORTED_MODULE_2__.pick)(this._opts, "agent", "pfx", "key", "passphrase", "cert", "ca", "ciphers", "rejectUnauthorized", "autoUnref");
        opts.xdomain = !!this._opts.xd;
        const xhr = (this._xhr = this.createRequest(opts));
        try {
            xhr.open(this._method, this._uri, true);
            try {
                if (this._opts.extraHeaders) {
                    // @ts-ignore
                    xhr.setDisableHeaderCheck && xhr.setDisableHeaderCheck(true);
                    for (let i in this._opts.extraHeaders) {
                        if (this._opts.extraHeaders.hasOwnProperty(i)) {
                            xhr.setRequestHeader(i, this._opts.extraHeaders[i]);
                        }
                    }
                }
            }
            catch (e) { }
            if ("POST" === this._method) {
                try {
                    xhr.setRequestHeader("Content-type", "text/plain;charset=UTF-8");
                }
                catch (e) { }
            }
            try {
                xhr.setRequestHeader("Accept", "*/*");
            }
            catch (e) { }
            (_a = this._opts.cookieJar) === null || _a === void 0 ? void 0 : _a.addCookies(xhr);
            // ie6 check
            if ("withCredentials" in xhr) {
                xhr.withCredentials = this._opts.withCredentials;
            }
            if (this._opts.requestTimeout) {
                xhr.timeout = this._opts.requestTimeout;
            }
            xhr.onreadystatechange = () => {
                var _a;
                if (xhr.readyState === 3) {
                    (_a = this._opts.cookieJar) === null || _a === void 0 ? void 0 : _a.parseCookies(
                    // @ts-ignore
                    xhr.getResponseHeader("set-cookie"));
                }
                if (4 !== xhr.readyState)
                    return;
                if (200 === xhr.status || 1223 === xhr.status) {
                    this._onLoad();
                }
                else {
                    // make sure the `error` event handler that's user-set
                    // does not throw in the same tick and gets caught here
                    this.setTimeoutFn(() => {
                        this._onError(typeof xhr.status === "number" ? xhr.status : 0);
                    }, 0);
                }
            };
            xhr.send(this._data);
        }
        catch (e) {
            // Need to defer since .create() is called directly from the constructor
            // and thus the 'error' event can only be only bound *after* this exception
            // occurs.  Therefore, also, we cannot throw here at all.
            this.setTimeoutFn(() => {
                this._onError(e);
            }, 0);
            return;
        }
        if (typeof document !== "undefined") {
            this._index = Request.requestsCount++;
            Request.requests[this._index] = this;
        }
    }
    /**
     * Called upon error.
     *
     * @private
     */
    _onError(err) {
        this.emitReserved("error", err, this._xhr);
        this._cleanup(true);
    }
    /**
     * Cleans up house.
     *
     * @private
     */
    _cleanup(fromError) {
        if ("undefined" === typeof this._xhr || null === this._xhr) {
            return;
        }
        this._xhr.onreadystatechange = empty;
        if (fromError) {
            try {
                this._xhr.abort();
            }
            catch (e) { }
        }
        if (typeof document !== "undefined") {
            delete Request.requests[this._index];
        }
        this._xhr = null;
    }
    /**
     * Called upon load.
     *
     * @private
     */
    _onLoad() {
        const data = this._xhr.responseText;
        if (data !== null) {
            this.emitReserved("data", data);
            this.emitReserved("success");
            this._cleanup();
        }
    }
    /**
     * Aborts the request.
     *
     * @package
     */
    abort() {
        this._cleanup();
    }
}
Request.requestsCount = 0;
Request.requests = {};
/**
 * Aborts pending requests when unloading the window. This is needed to prevent
 * memory leaks (e.g. when using IE) and to ensure that no spurious error is
 * emitted.
 */
if (typeof document !== "undefined") {
    // @ts-ignore
    if (typeof attachEvent === "function") {
        // @ts-ignore
        attachEvent("onunload", unloadHandler);
    }
    else if (typeof addEventListener === "function") {
        const terminationEvent = "onpagehide" in _globals_node_js__WEBPACK_IMPORTED_MODULE_3__.globalThisShim ? "pagehide" : "unload";
        addEventListener(terminationEvent, unloadHandler, false);
    }
}
function unloadHandler() {
    for (let i in Request.requests) {
        if (Request.requests.hasOwnProperty(i)) {
            Request.requests[i].abort();
        }
    }
}
const hasXHR2 = (function () {
    const xhr = newRequest({
        xdomain: false,
    });
    return xhr && xhr.responseType !== null;
})();
/**
 * HTTP long-polling based on the built-in `XMLHttpRequest` object.
 *
 * Usage: browser
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest
 */
class XHR extends BaseXHR {
    constructor(opts) {
        super(opts);
        const forceBase64 = opts && opts.forceBase64;
        this.supportsBinary = hasXHR2 && !forceBase64;
    }
    request(opts = {}) {
        Object.assign(opts, { xd: this.xd }, this.opts);
        return new Request(newRequest, this.uri(), opts);
    }
}
function newRequest(opts) {
    const xdomain = opts.xdomain;
    // XMLHttpRequest can be disabled on IE
    try {
        if ("undefined" !== typeof XMLHttpRequest && (!xdomain || _contrib_has_cors_js__WEBPACK_IMPORTED_MODULE_4__.hasCORS)) {
            return new XMLHttpRequest();
        }
    }
    catch (e) { }
    if (!xdomain) {
        try {
            return new _globals_node_js__WEBPACK_IMPORTED_MODULE_3__.globalThisShim[["Active"].concat("Object").join("X")]("Microsoft.XMLHTTP");
        }
        catch (e) { }
    }
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transports/polling.js":
/*!***********************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transports/polling.js ***!
  \***********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Polling: () => (/* binding */ Polling)
/* harmony export */ });
/* harmony import */ var _transport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../transport.js */ "./node_modules/engine.io-client/build/esm/transport.js");
/* harmony import */ var _util_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../util.js */ "./node_modules/engine.io-client/build/esm/util.js");
/* harmony import */ var engine_io_parser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! engine.io-parser */ "./node_modules/engine.io-parser/build/esm/index.js");



class Polling extends _transport_js__WEBPACK_IMPORTED_MODULE_0__.Transport {
    constructor() {
        super(...arguments);
        this._polling = false;
    }
    get name() {
        return "polling";
    }
    /**
     * Opens the socket (triggers polling). We write a PING message to determine
     * when the transport is open.
     *
     * @protected
     */
    doOpen() {
        this._poll();
    }
    /**
     * Pauses polling.
     *
     * @param {Function} onPause - callback upon buffers are flushed and transport is paused
     * @package
     */
    pause(onPause) {
        this.readyState = "pausing";
        const pause = () => {
            this.readyState = "paused";
            onPause();
        };
        if (this._polling || !this.writable) {
            let total = 0;
            if (this._polling) {
                total++;
                this.once("pollComplete", function () {
                    --total || pause();
                });
            }
            if (!this.writable) {
                total++;
                this.once("drain", function () {
                    --total || pause();
                });
            }
        }
        else {
            pause();
        }
    }
    /**
     * Starts polling cycle.
     *
     * @private
     */
    _poll() {
        this._polling = true;
        this.doPoll();
        this.emitReserved("poll");
    }
    /**
     * Overloads onData to detect payloads.
     *
     * @protected
     */
    onData(data) {
        const callback = (packet) => {
            // if its the first message we consider the transport open
            if ("opening" === this.readyState && packet.type === "open") {
                this.onOpen();
            }
            // if its a close packet, we close the ongoing requests
            if ("close" === packet.type) {
                this.onClose({ description: "transport closed by the server" });
                return false;
            }
            // otherwise bypass onData and handle the message
            this.onPacket(packet);
        };
        // decode payload
        (0,engine_io_parser__WEBPACK_IMPORTED_MODULE_2__.decodePayload)(data, this.socket.binaryType).forEach(callback);
        // if an event did not trigger closing
        if ("closed" !== this.readyState) {
            // if we got data we're not polling
            this._polling = false;
            this.emitReserved("pollComplete");
            if ("open" === this.readyState) {
                this._poll();
            }
            else {
            }
        }
    }
    /**
     * For polling, send a close packet.
     *
     * @protected
     */
    doClose() {
        const close = () => {
            this.write([{ type: "close" }]);
        };
        if ("open" === this.readyState) {
            close();
        }
        else {
            // in case we're trying to close while
            // handshaking is in progress (GH-164)
            this.once("open", close);
        }
    }
    /**
     * Writes a packets payload.
     *
     * @param {Array} packets - data packets
     * @protected
     */
    write(packets) {
        this.writable = false;
        (0,engine_io_parser__WEBPACK_IMPORTED_MODULE_2__.encodePayload)(packets, (data) => {
            this.doWrite(data, () => {
                this.writable = true;
                this.emitReserved("drain");
            });
        });
    }
    /**
     * Generates uri for connection.
     *
     * @private
     */
    uri() {
        const schema = this.opts.secure ? "https" : "http";
        const query = this.query || {};
        // cache busting is forced
        if (false !== this.opts.timestampRequests) {
            query[this.opts.timestampParam] = (0,_util_js__WEBPACK_IMPORTED_MODULE_1__.randomString)();
        }
        if (!this.supportsBinary && !query.sid) {
            query.b64 = 1;
        }
        return this.createUri(schema, query);
    }
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transports/websocket.js":
/*!*************************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transports/websocket.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   BaseWS: () => (/* binding */ BaseWS),
/* harmony export */   WS: () => (/* binding */ WS)
/* harmony export */ });
/* harmony import */ var _transport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../transport.js */ "./node_modules/engine.io-client/build/esm/transport.js");
/* harmony import */ var _util_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../util.js */ "./node_modules/engine.io-client/build/esm/util.js");
/* harmony import */ var engine_io_parser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! engine.io-parser */ "./node_modules/engine.io-parser/build/esm/index.js");
/* harmony import */ var _globals_node_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../globals.node.js */ "./node_modules/engine.io-client/build/esm/globals.js");




// detect ReactNative environment
const isReactNative = typeof navigator !== "undefined" &&
    typeof navigator.product === "string" &&
    navigator.product.toLowerCase() === "reactnative";
class BaseWS extends _transport_js__WEBPACK_IMPORTED_MODULE_0__.Transport {
    get name() {
        return "websocket";
    }
    doOpen() {
        const uri = this.uri();
        const protocols = this.opts.protocols;
        // React Native only supports the 'headers' option, and will print a warning if anything else is passed
        const opts = isReactNative
            ? {}
            : (0,_util_js__WEBPACK_IMPORTED_MODULE_1__.pick)(this.opts, "agent", "perMessageDeflate", "pfx", "key", "passphrase", "cert", "ca", "ciphers", "rejectUnauthorized", "localAddress", "protocolVersion", "origin", "maxPayload", "family", "checkServerIdentity");
        if (this.opts.extraHeaders) {
            opts.headers = this.opts.extraHeaders;
        }
        try {
            this.ws = this.createSocket(uri, protocols, opts);
        }
        catch (err) {
            return this.emitReserved("error", err);
        }
        this.ws.binaryType = this.socket.binaryType;
        this.addEventListeners();
    }
    /**
     * Adds event listeners to the socket
     *
     * @private
     */
    addEventListeners() {
        this.ws.onopen = () => {
            if (this.opts.autoUnref) {
                this.ws._socket.unref();
            }
            this.onOpen();
        };
        this.ws.onclose = (closeEvent) => this.onClose({
            description: "websocket connection closed",
            context: closeEvent,
        });
        this.ws.onmessage = (ev) => this.onData(ev.data);
        this.ws.onerror = (e) => this.onError("websocket error", e);
    }
    write(packets) {
        this.writable = false;
        // encodePacket efficient as it uses WS framing
        // no need for encodePayload
        for (let i = 0; i < packets.length; i++) {
            const packet = packets[i];
            const lastPacket = i === packets.length - 1;
            (0,engine_io_parser__WEBPACK_IMPORTED_MODULE_2__.encodePacket)(packet, this.supportsBinary, (data) => {
                // Sometimes the websocket has already been closed but the browser didn't
                // have a chance of informing us about it yet, in that case send will
                // throw an error
                try {
                    this.doWrite(packet, data);
                }
                catch (e) {
                }
                if (lastPacket) {
                    // fake drain
                    // defer to next tick to allow Socket to clear writeBuffer
                    (0,_globals_node_js__WEBPACK_IMPORTED_MODULE_3__.nextTick)(() => {
                        this.writable = true;
                        this.emitReserved("drain");
                    }, this.setTimeoutFn);
                }
            });
        }
    }
    doClose() {
        if (typeof this.ws !== "undefined") {
            this.ws.onerror = () => { };
            this.ws.close();
            this.ws = null;
        }
    }
    /**
     * Generates uri for connection.
     *
     * @private
     */
    uri() {
        const schema = this.opts.secure ? "wss" : "ws";
        const query = this.query || {};
        // append timestamp to URI
        if (this.opts.timestampRequests) {
            query[this.opts.timestampParam] = (0,_util_js__WEBPACK_IMPORTED_MODULE_1__.randomString)();
        }
        // communicate binary support capabilities
        if (!this.supportsBinary) {
            query.b64 = 1;
        }
        return this.createUri(schema, query);
    }
}
const WebSocketCtor = _globals_node_js__WEBPACK_IMPORTED_MODULE_3__.globalThisShim.WebSocket || _globals_node_js__WEBPACK_IMPORTED_MODULE_3__.globalThisShim.MozWebSocket;
/**
 * WebSocket transport based on the built-in `WebSocket` object.
 *
 * Usage: browser, Node.js (since v21), Deno, Bun
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/WebSocket
 * @see https://caniuse.com/mdn-api_websocket
 * @see https://nodejs.org/api/globals.html#websocket
 */
class WS extends BaseWS {
    createSocket(uri, protocols, opts) {
        return !isReactNative
            ? protocols
                ? new WebSocketCtor(uri, protocols)
                : new WebSocketCtor(uri)
            : new WebSocketCtor(uri, protocols, opts);
    }
    doWrite(_packet, data) {
        this.ws.send(data);
    }
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/transports/webtransport.js":
/*!****************************************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/transports/webtransport.js ***!
  \****************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   WT: () => (/* binding */ WT)
/* harmony export */ });
/* harmony import */ var _transport_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../transport.js */ "./node_modules/engine.io-client/build/esm/transport.js");
/* harmony import */ var _globals_node_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../globals.node.js */ "./node_modules/engine.io-client/build/esm/globals.js");
/* harmony import */ var engine_io_parser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! engine.io-parser */ "./node_modules/engine.io-parser/build/esm/index.js");



/**
 * WebTransport transport based on the built-in `WebTransport` object.
 *
 * Usage: browser, Node.js (with the `@fails-components/webtransport` package)
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/WebTransport
 * @see https://caniuse.com/webtransport
 */
class WT extends _transport_js__WEBPACK_IMPORTED_MODULE_0__.Transport {
    get name() {
        return "webtransport";
    }
    doOpen() {
        try {
            // @ts-ignore
            this._transport = new WebTransport(this.createUri("https"), this.opts.transportOptions[this.name]);
        }
        catch (err) {
            return this.emitReserved("error", err);
        }
        this._transport.closed
            .then(() => {
            this.onClose();
        })
            .catch((err) => {
            this.onError("webtransport error", err);
        });
        // note: we could have used async/await, but that would require some additional polyfills
        this._transport.ready.then(() => {
            this._transport.createBidirectionalStream().then((stream) => {
                const decoderStream = (0,engine_io_parser__WEBPACK_IMPORTED_MODULE_2__.createPacketDecoderStream)(Number.MAX_SAFE_INTEGER, this.socket.binaryType);
                const reader = stream.readable.pipeThrough(decoderStream).getReader();
                const encoderStream = (0,engine_io_parser__WEBPACK_IMPORTED_MODULE_2__.createPacketEncoderStream)();
                encoderStream.readable.pipeTo(stream.writable);
                this._writer = encoderStream.writable.getWriter();
                const read = () => {
                    reader
                        .read()
                        .then(({ done, value }) => {
                        if (done) {
                            return;
                        }
                        this.onPacket(value);
                        read();
                    })
                        .catch((err) => {
                    });
                };
                read();
                const packet = { type: "open" };
                if (this.query.sid) {
                    packet.data = `{"sid":"${this.query.sid}"}`;
                }
                this._writer.write(packet).then(() => this.onOpen());
            });
        });
    }
    write(packets) {
        this.writable = false;
        for (let i = 0; i < packets.length; i++) {
            const packet = packets[i];
            const lastPacket = i === packets.length - 1;
            this._writer.write(packet).then(() => {
                if (lastPacket) {
                    (0,_globals_node_js__WEBPACK_IMPORTED_MODULE_1__.nextTick)(() => {
                        this.writable = true;
                        this.emitReserved("drain");
                    }, this.setTimeoutFn);
                }
            });
        }
    }
    doClose() {
        var _a;
        (_a = this._transport) === null || _a === void 0 ? void 0 : _a.close();
    }
}


/***/ }),

/***/ "./node_modules/engine.io-client/build/esm/util.js":
/*!*********************************************************!*\
  !*** ./node_modules/engine.io-client/build/esm/util.js ***!
  \*********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   byteLength: () => (/* binding */ byteLength),
/* harmony export */   installTimerFunctions: () => (/* binding */ installTimerFunctions),
/* harmony export */   pick: () => (/* binding */ pick),
/* harmony export */   randomString: () => (/* binding */ randomString)
/* harmony export */ });
/* harmony import */ var _globals_node_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./globals.node.js */ "./node_modules/engine.io-client/build/esm/globals.js");

function pick(obj, ...attr) {
    return attr.reduce((acc, k) => {
        if (obj.hasOwnProperty(k)) {
            acc[k] = obj[k];
        }
        return acc;
    }, {});
}
// Keep a reference to the real timeout functions so they can be used when overridden
const NATIVE_SET_TIMEOUT = _globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim.setTimeout;
const NATIVE_CLEAR_TIMEOUT = _globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim.clearTimeout;
function installTimerFunctions(obj, opts) {
    if (opts.useNativeTimers) {
        obj.setTimeoutFn = NATIVE_SET_TIMEOUT.bind(_globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim);
        obj.clearTimeoutFn = NATIVE_CLEAR_TIMEOUT.bind(_globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim);
    }
    else {
        obj.setTimeoutFn = _globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim.setTimeout.bind(_globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim);
        obj.clearTimeoutFn = _globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim.clearTimeout.bind(_globals_node_js__WEBPACK_IMPORTED_MODULE_0__.globalThisShim);
    }
}
// base64 encoded buffers are about 33% bigger (https://en.wikipedia.org/wiki/Base64)
const BASE64_OVERHEAD = 1.33;
// we could also have used `new Blob([obj]).size`, but it isn't supported in IE9
function byteLength(obj) {
    if (typeof obj === "string") {
        return utf8Length(obj);
    }
    // arraybuffer or blob
    return Math.ceil((obj.byteLength || obj.size) * BASE64_OVERHEAD);
}
function utf8Length(str) {
    let c = 0, length = 0;
    for (let i = 0, l = str.length; i < l; i++) {
        c = str.charCodeAt(i);
        if (c < 0x80) {
            length += 1;
        }
        else if (c < 0x800) {
            length += 2;
        }
        else if (c < 0xd800 || c >= 0xe000) {
            length += 3;
        }
        else {
            i++;
            length += 4;
        }
    }
    return length;
}
/**
 * Generates a random 8-characters string.
 */
function randomString() {
    return (Date.now().toString(36).substring(3) +
        Math.random().toString(36).substring(2, 5));
}


/***/ }),

/***/ "./node_modules/engine.io-parser/build/esm/commons.js":
/*!************************************************************!*\
  !*** ./node_modules/engine.io-parser/build/esm/commons.js ***!
  \************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ERROR_PACKET: () => (/* binding */ ERROR_PACKET),
/* harmony export */   PACKET_TYPES: () => (/* binding */ PACKET_TYPES),
/* harmony export */   PACKET_TYPES_REVERSE: () => (/* binding */ PACKET_TYPES_REVERSE)
/* harmony export */ });
const PACKET_TYPES = Object.create(null); // no Map = no polyfill
PACKET_TYPES["open"] = "0";
PACKET_TYPES["close"] = "1";
PACKET_TYPES["ping"] = "2";
PACKET_TYPES["pong"] = "3";
PACKET_TYPES["message"] = "4";
PACKET_TYPES["upgrade"] = "5";
PACKET_TYPES["noop"] = "6";
const PACKET_TYPES_REVERSE = Object.create(null);
Object.keys(PACKET_TYPES).forEach((key) => {
    PACKET_TYPES_REVERSE[PACKET_TYPES[key]] = key;
});
const ERROR_PACKET = { type: "error", data: "parser error" };



/***/ }),

/***/ "./node_modules/engine.io-parser/build/esm/contrib/base64-arraybuffer.js":
/*!*******************************************************************************!*\
  !*** ./node_modules/engine.io-parser/build/esm/contrib/base64-arraybuffer.js ***!
  \*******************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   decode: () => (/* binding */ decode),
/* harmony export */   encode: () => (/* binding */ encode)
/* harmony export */ });
// imported from https://github.com/socketio/base64-arraybuffer
const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
// Use a lookup table to find the index.
const lookup = typeof Uint8Array === 'undefined' ? [] : new Uint8Array(256);
for (let i = 0; i < chars.length; i++) {
    lookup[chars.charCodeAt(i)] = i;
}
const encode = (arraybuffer) => {
    let bytes = new Uint8Array(arraybuffer), i, len = bytes.length, base64 = '';
    for (i = 0; i < len; i += 3) {
        base64 += chars[bytes[i] >> 2];
        base64 += chars[((bytes[i] & 3) << 4) | (bytes[i + 1] >> 4)];
        base64 += chars[((bytes[i + 1] & 15) << 2) | (bytes[i + 2] >> 6)];
        base64 += chars[bytes[i + 2] & 63];
    }
    if (len % 3 === 2) {
        base64 = base64.substring(0, base64.length - 1) + '=';
    }
    else if (len % 3 === 1) {
        base64 = base64.substring(0, base64.length - 2) + '==';
    }
    return base64;
};
const decode = (base64) => {
    let bufferLength = base64.length * 0.75, len = base64.length, i, p = 0, encoded1, encoded2, encoded3, encoded4;
    if (base64[base64.length - 1] === '=') {
        bufferLength--;
        if (base64[base64.length - 2] === '=') {
            bufferLength--;
        }
    }
    const arraybuffer = new ArrayBuffer(bufferLength), bytes = new Uint8Array(arraybuffer);
    for (i = 0; i < len; i += 4) {
        encoded1 = lookup[base64.charCodeAt(i)];
        encoded2 = lookup[base64.charCodeAt(i + 1)];
        encoded3 = lookup[base64.charCodeAt(i + 2)];
        encoded4 = lookup[base64.charCodeAt(i + 3)];
        bytes[p++] = (encoded1 << 2) | (encoded2 >> 4);
        bytes[p++] = ((encoded2 & 15) << 4) | (encoded3 >> 2);
        bytes[p++] = ((encoded3 & 3) << 6) | (encoded4 & 63);
    }
    return arraybuffer;
};


/***/ }),

/***/ "./node_modules/engine.io-parser/build/esm/decodePacket.browser.js":
/*!*************************************************************************!*\
  !*** ./node_modules/engine.io-parser/build/esm/decodePacket.browser.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   decodePacket: () => (/* binding */ decodePacket)
/* harmony export */ });
/* harmony import */ var _commons_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./commons.js */ "./node_modules/engine.io-parser/build/esm/commons.js");
/* harmony import */ var _contrib_base64_arraybuffer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./contrib/base64-arraybuffer.js */ "./node_modules/engine.io-parser/build/esm/contrib/base64-arraybuffer.js");


const withNativeArrayBuffer = typeof ArrayBuffer === "function";
const decodePacket = (encodedPacket, binaryType) => {
    if (typeof encodedPacket !== "string") {
        return {
            type: "message",
            data: mapBinary(encodedPacket, binaryType),
        };
    }
    const type = encodedPacket.charAt(0);
    if (type === "b") {
        return {
            type: "message",
            data: decodeBase64Packet(encodedPacket.substring(1), binaryType),
        };
    }
    const packetType = _commons_js__WEBPACK_IMPORTED_MODULE_0__.PACKET_TYPES_REVERSE[type];
    if (!packetType) {
        return _commons_js__WEBPACK_IMPORTED_MODULE_0__.ERROR_PACKET;
    }
    return encodedPacket.length > 1
        ? {
            type: _commons_js__WEBPACK_IMPORTED_MODULE_0__.PACKET_TYPES_REVERSE[type],
            data: encodedPacket.substring(1),
        }
        : {
            type: _commons_js__WEBPACK_IMPORTED_MODULE_0__.PACKET_TYPES_REVERSE[type],
        };
};
const decodeBase64Packet = (data, binaryType) => {
    if (withNativeArrayBuffer) {
        const decoded = (0,_contrib_base64_arraybuffer_js__WEBPACK_IMPORTED_MODULE_1__.decode)(data);
        return mapBinary(decoded, binaryType);
    }
    else {
        return { base64: true, data }; // fallback for old browsers
    }
};
const mapBinary = (data, binaryType) => {
    switch (binaryType) {
        case "blob":
            if (data instanceof Blob) {
                // from WebSocket + binaryType "blob"
                return data;
            }
            else {
                // from HTTP long-polling or WebTransport
                return new Blob([data]);
            }
        case "arraybuffer":
        default:
            if (data instanceof ArrayBuffer) {
                // from HTTP long-polling (base64) or WebSocket + binaryType "arraybuffer"
                return data;
            }
            else {
                // from WebTransport (Uint8Array)
                return data.buffer;
            }
    }
};


/***/ }),

/***/ "./node_modules/engine.io-parser/build/esm/encodePacket.browser.js":
/*!*************************************************************************!*\
  !*** ./node_modules/engine.io-parser/build/esm/encodePacket.browser.js ***!
  \*************************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   encodePacket: () => (/* binding */ encodePacket),
/* harmony export */   encodePacketToBinary: () => (/* binding */ encodePacketToBinary)
/* harmony export */ });
/* harmony import */ var _commons_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./commons.js */ "./node_modules/engine.io-parser/build/esm/commons.js");

const withNativeBlob = typeof Blob === "function" ||
    (typeof Blob !== "undefined" &&
        Object.prototype.toString.call(Blob) === "[object BlobConstructor]");
const withNativeArrayBuffer = typeof ArrayBuffer === "function";
// ArrayBuffer.isView method is not defined in IE10
const isView = (obj) => {
    return typeof ArrayBuffer.isView === "function"
        ? ArrayBuffer.isView(obj)
        : obj && obj.buffer instanceof ArrayBuffer;
};
const encodePacket = ({ type, data }, supportsBinary, callback) => {
    if (withNativeBlob && data instanceof Blob) {
        if (supportsBinary) {
            return callback(data);
        }
        else {
            return encodeBlobAsBase64(data, callback);
        }
    }
    else if (withNativeArrayBuffer &&
        (data instanceof ArrayBuffer || isView(data))) {
        if (supportsBinary) {
            return callback(data);
        }
        else {
            return encodeBlobAsBase64(new Blob([data]), callback);
        }
    }
    // plain string
    return callback(_commons_js__WEBPACK_IMPORTED_MODULE_0__.PACKET_TYPES[type] + (data || ""));
};
const encodeBlobAsBase64 = (data, callback) => {
    const fileReader = new FileReader();
    fileReader.onload = function () {
        const content = fileReader.result.split(",")[1];
        callback("b" + (content || ""));
    };
    return fileReader.readAsDataURL(data);
};
function toArray(data) {
    if (data instanceof Uint8Array) {
        return data;
    }
    else if (data instanceof ArrayBuffer) {
        return new Uint8Array(data);
    }
    else {
        return new Uint8Array(data.buffer, data.byteOffset, data.byteLength);
    }
}
let TEXT_ENCODER;
function encodePacketToBinary(packet, callback) {
    if (withNativeBlob && packet.data instanceof Blob) {
        return packet.data.arrayBuffer().then(toArray).then(callback);
    }
    else if (withNativeArrayBuffer &&
        (packet.data instanceof ArrayBuffer || isView(packet.data))) {
        return callback(toArray(packet.data));
    }
    encodePacket(packet, false, (encoded) => {
        if (!TEXT_ENCODER) {
            TEXT_ENCODER = new TextEncoder();
        }
        callback(TEXT_ENCODER.encode(encoded));
    });
}



/***/ }),

/***/ "./node_modules/engine.io-parser/build/esm/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/engine.io-parser/build/esm/index.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   createPacketDecoderStream: () => (/* binding */ createPacketDecoderStream),
/* harmony export */   createPacketEncoderStream: () => (/* binding */ createPacketEncoderStream),
/* harmony export */   decodePacket: () => (/* reexport safe */ _decodePacket_js__WEBPACK_IMPORTED_MODULE_1__.decodePacket),
/* harmony export */   decodePayload: () => (/* binding */ decodePayload),
/* harmony export */   encodePacket: () => (/* reexport safe */ _encodePacket_js__WEBPACK_IMPORTED_MODULE_0__.encodePacket),
/* harmony export */   encodePayload: () => (/* binding */ encodePayload),
/* harmony export */   protocol: () => (/* binding */ protocol)
/* harmony export */ });
/* harmony import */ var _encodePacket_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./encodePacket.js */ "./node_modules/engine.io-parser/build/esm/encodePacket.browser.js");
/* harmony import */ var _decodePacket_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./decodePacket.js */ "./node_modules/engine.io-parser/build/esm/decodePacket.browser.js");
/* harmony import */ var _commons_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./commons.js */ "./node_modules/engine.io-parser/build/esm/commons.js");



const SEPARATOR = String.fromCharCode(30); // see https://en.wikipedia.org/wiki/Delimiter#ASCII_delimited_text
const encodePayload = (packets, callback) => {
    // some packets may be added to the array while encoding, so the initial length must be saved
    const length = packets.length;
    const encodedPackets = new Array(length);
    let count = 0;
    packets.forEach((packet, i) => {
        // force base64 encoding for binary packets
        (0,_encodePacket_js__WEBPACK_IMPORTED_MODULE_0__.encodePacket)(packet, false, (encodedPacket) => {
            encodedPackets[i] = encodedPacket;
            if (++count === length) {
                callback(encodedPackets.join(SEPARATOR));
            }
        });
    });
};
const decodePayload = (encodedPayload, binaryType) => {
    const encodedPackets = encodedPayload.split(SEPARATOR);
    const packets = [];
    for (let i = 0; i < encodedPackets.length; i++) {
        const decodedPacket = (0,_decodePacket_js__WEBPACK_IMPORTED_MODULE_1__.decodePacket)(encodedPackets[i], binaryType);
        packets.push(decodedPacket);
        if (decodedPacket.type === "error") {
            break;
        }
    }
    return packets;
};
function createPacketEncoderStream() {
    return new TransformStream({
        transform(packet, controller) {
            (0,_encodePacket_js__WEBPACK_IMPORTED_MODULE_0__.encodePacketToBinary)(packet, (encodedPacket) => {
                const payloadLength = encodedPacket.length;
                let header;
                // inspired by the WebSocket format: https://developer.mozilla.org/en-US/docs/Web/API/WebSockets_API/Writing_WebSocket_servers#decoding_payload_length
                if (payloadLength < 126) {
                    header = new Uint8Array(1);
                    new DataView(header.buffer).setUint8(0, payloadLength);
                }
                else if (payloadLength < 65536) {
                    header = new Uint8Array(3);
                    const view = new DataView(header.buffer);
                    view.setUint8(0, 126);
                    view.setUint16(1, payloadLength);
                }
                else {
                    header = new Uint8Array(9);
                    const view = new DataView(header.buffer);
                    view.setUint8(0, 127);
                    view.setBigUint64(1, BigInt(payloadLength));
                }
                // first bit indicates whether the payload is plain text (0) or binary (1)
                if (packet.data && typeof packet.data !== "string") {
                    header[0] |= 0x80;
                }
                controller.enqueue(header);
                controller.enqueue(encodedPacket);
            });
        },
    });
}
let TEXT_DECODER;
function totalLength(chunks) {
    return chunks.reduce((acc, chunk) => acc + chunk.length, 0);
}
function concatChunks(chunks, size) {
    if (chunks[0].length === size) {
        return chunks.shift();
    }
    const buffer = new Uint8Array(size);
    let j = 0;
    for (let i = 0; i < size; i++) {
        buffer[i] = chunks[0][j++];
        if (j === chunks[0].length) {
            chunks.shift();
            j = 0;
        }
    }
    if (chunks.length && j < chunks[0].length) {
        chunks[0] = chunks[0].slice(j);
    }
    return buffer;
}
function createPacketDecoderStream(maxPayload, binaryType) {
    if (!TEXT_DECODER) {
        TEXT_DECODER = new TextDecoder();
    }
    const chunks = [];
    let state = 0 /* State.READ_HEADER */;
    let expectedLength = -1;
    let isBinary = false;
    return new TransformStream({
        transform(chunk, controller) {
            chunks.push(chunk);
            while (true) {
                if (state === 0 /* State.READ_HEADER */) {
                    if (totalLength(chunks) < 1) {
                        break;
                    }
                    const header = concatChunks(chunks, 1);
                    isBinary = (header[0] & 0x80) === 0x80;
                    expectedLength = header[0] & 0x7f;
                    if (expectedLength < 126) {
                        state = 3 /* State.READ_PAYLOAD */;
                    }
                    else if (expectedLength === 126) {
                        state = 1 /* State.READ_EXTENDED_LENGTH_16 */;
                    }
                    else {
                        state = 2 /* State.READ_EXTENDED_LENGTH_64 */;
                    }
                }
                else if (state === 1 /* State.READ_EXTENDED_LENGTH_16 */) {
                    if (totalLength(chunks) < 2) {
                        break;
                    }
                    const headerArray = concatChunks(chunks, 2);
                    expectedLength = new DataView(headerArray.buffer, headerArray.byteOffset, headerArray.length).getUint16(0);
                    state = 3 /* State.READ_PAYLOAD */;
                }
                else if (state === 2 /* State.READ_EXTENDED_LENGTH_64 */) {
                    if (totalLength(chunks) < 8) {
                        break;
                    }
                    const headerArray = concatChunks(chunks, 8);
                    const view = new DataView(headerArray.buffer, headerArray.byteOffset, headerArray.length);
                    const n = view.getUint32(0);
                    if (n > Math.pow(2, 53 - 32) - 1) {
                        // the maximum safe integer in JavaScript is 2^53 - 1
                        controller.enqueue(_commons_js__WEBPACK_IMPORTED_MODULE_2__.ERROR_PACKET);
                        break;
                    }
                    expectedLength = n * Math.pow(2, 32) + view.getUint32(4);
                    state = 3 /* State.READ_PAYLOAD */;
                }
                else {
                    if (totalLength(chunks) < expectedLength) {
                        break;
                    }
                    const data = concatChunks(chunks, expectedLength);
                    controller.enqueue((0,_decodePacket_js__WEBPACK_IMPORTED_MODULE_1__.decodePacket)(isBinary ? data : TEXT_DECODER.decode(data), binaryType));
                    state = 0 /* State.READ_HEADER */;
                }
                if (expectedLength === 0 || expectedLength > maxPayload) {
                    controller.enqueue(_commons_js__WEBPACK_IMPORTED_MODULE_2__.ERROR_PACKET);
                    break;
                }
            }
        },
    });
}
const protocol = 4;



/***/ }),

/***/ "./node_modules/socket.io-client/build/esm/contrib/backo2.js":
/*!*******************************************************************!*\
  !*** ./node_modules/socket.io-client/build/esm/contrib/backo2.js ***!
  \*******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Backoff: () => (/* binding */ Backoff)
/* harmony export */ });
/**
 * Initialize backoff timer with `opts`.
 *
 * - `min` initial timeout in milliseconds [100]
 * - `max` max timeout [10000]
 * - `jitter` [0]
 * - `factor` [2]
 *
 * @param {Object} opts
 * @api public
 */
function Backoff(opts) {
    opts = opts || {};
    this.ms = opts.min || 100;
    this.max = opts.max || 10000;
    this.factor = opts.factor || 2;
    this.jitter = opts.jitter > 0 && opts.jitter <= 1 ? opts.jitter : 0;
    this.attempts = 0;
}
/**
 * Return the backoff duration.
 *
 * @return {Number}
 * @api public
 */
Backoff.prototype.duration = function () {
    var ms = this.ms * Math.pow(this.factor, this.attempts++);
    if (this.jitter) {
        var rand = Math.random();
        var deviation = Math.floor(rand * this.jitter * ms);
        ms = (Math.floor(rand * 10) & 1) == 0 ? ms - deviation : ms + deviation;
    }
    return Math.min(ms, this.max) | 0;
};
/**
 * Reset the number of attempts.
 *
 * @api public
 */
Backoff.prototype.reset = function () {
    this.attempts = 0;
};
/**
 * Set the minimum duration
 *
 * @api public
 */
Backoff.prototype.setMin = function (min) {
    this.ms = min;
};
/**
 * Set the maximum duration
 *
 * @api public
 */
Backoff.prototype.setMax = function (max) {
    this.max = max;
};
/**
 * Set the jitter
 *
 * @api public
 */
Backoff.prototype.setJitter = function (jitter) {
    this.jitter = jitter;
};


/***/ }),

/***/ "./node_modules/socket.io-client/build/esm/index.js":
/*!**********************************************************!*\
  !*** ./node_modules/socket.io-client/build/esm/index.js ***!
  \**********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Fetch: () => (/* reexport safe */ engine_io_client__WEBPACK_IMPORTED_MODULE_4__.Fetch),
/* harmony export */   Manager: () => (/* reexport safe */ _manager_js__WEBPACK_IMPORTED_MODULE_1__.Manager),
/* harmony export */   NodeWebSocket: () => (/* reexport safe */ engine_io_client__WEBPACK_IMPORTED_MODULE_4__.NodeWebSocket),
/* harmony export */   NodeXHR: () => (/* reexport safe */ engine_io_client__WEBPACK_IMPORTED_MODULE_4__.NodeXHR),
/* harmony export */   Socket: () => (/* reexport safe */ _socket_js__WEBPACK_IMPORTED_MODULE_2__.Socket),
/* harmony export */   WebSocket: () => (/* reexport safe */ engine_io_client__WEBPACK_IMPORTED_MODULE_4__.WebSocket),
/* harmony export */   WebTransport: () => (/* reexport safe */ engine_io_client__WEBPACK_IMPORTED_MODULE_4__.WebTransport),
/* harmony export */   XHR: () => (/* reexport safe */ engine_io_client__WEBPACK_IMPORTED_MODULE_4__.XHR),
/* harmony export */   connect: () => (/* binding */ lookup),
/* harmony export */   "default": () => (/* binding */ lookup),
/* harmony export */   io: () => (/* binding */ lookup),
/* harmony export */   protocol: () => (/* reexport safe */ socket_io_parser__WEBPACK_IMPORTED_MODULE_3__.protocol)
/* harmony export */ });
/* harmony import */ var _url_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./url.js */ "./node_modules/socket.io-client/build/esm/url.js");
/* harmony import */ var _manager_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./manager.js */ "./node_modules/socket.io-client/build/esm/manager.js");
/* harmony import */ var _socket_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./socket.js */ "./node_modules/socket.io-client/build/esm/socket.js");
/* harmony import */ var socket_io_parser__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! socket.io-parser */ "./node_modules/socket.io-parser/build/esm-debug/index.js");
/* harmony import */ var engine_io_client__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! engine.io-client */ "./node_modules/engine.io-client/build/esm/index.js");



/**
 * Managers cache.
 */
const cache = {};
function lookup(uri, opts) {
    if (typeof uri === "object") {
        opts = uri;
        uri = undefined;
    }
    opts = opts || {};
    const parsed = (0,_url_js__WEBPACK_IMPORTED_MODULE_0__.url)(uri, opts.path || "/socket.io");
    const source = parsed.source;
    const id = parsed.id;
    const path = parsed.path;
    const sameNamespace = cache[id] && path in cache[id]["nsps"];
    const newConnection = opts.forceNew ||
        opts["force new connection"] ||
        false === opts.multiplex ||
        sameNamespace;
    let io;
    if (newConnection) {
        io = new _manager_js__WEBPACK_IMPORTED_MODULE_1__.Manager(source, opts);
    }
    else {
        if (!cache[id]) {
            cache[id] = new _manager_js__WEBPACK_IMPORTED_MODULE_1__.Manager(source, opts);
        }
        io = cache[id];
    }
    if (parsed.query && !opts.query) {
        opts.query = parsed.queryKey;
    }
    return io.socket(parsed.path, opts);
}
// so that "lookup" can be used both as a function (e.g. `io(...)`) and as a
// namespace (e.g. `io.connect(...)`), for backward compatibility
Object.assign(lookup, {
    Manager: _manager_js__WEBPACK_IMPORTED_MODULE_1__.Manager,
    Socket: _socket_js__WEBPACK_IMPORTED_MODULE_2__.Socket,
    io: lookup,
    connect: lookup,
});
/**
 * Protocol version.
 *
 * @public
 */

/**
 * Expose constructors for standalone build.
 *
 * @public
 */




/***/ }),

/***/ "./node_modules/socket.io-client/build/esm/manager.js":
/*!************************************************************!*\
  !*** ./node_modules/socket.io-client/build/esm/manager.js ***!
  \************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Manager: () => (/* binding */ Manager)
/* harmony export */ });
/* harmony import */ var engine_io_client__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! engine.io-client */ "./node_modules/engine.io-client/build/esm/index.js");
/* harmony import */ var _socket_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./socket.js */ "./node_modules/socket.io-client/build/esm/socket.js");
/* harmony import */ var socket_io_parser__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! socket.io-parser */ "./node_modules/socket.io-parser/build/esm-debug/index.js");
/* harmony import */ var _on_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./on.js */ "./node_modules/socket.io-client/build/esm/on.js");
/* harmony import */ var _contrib_backo2_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./contrib/backo2.js */ "./node_modules/socket.io-client/build/esm/contrib/backo2.js");
/* harmony import */ var _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @socket.io/component-emitter */ "./node_modules/@socket.io/component-emitter/lib/esm/index.js");






class Manager extends _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_5__.Emitter {
    constructor(uri, opts) {
        var _a;
        super();
        this.nsps = {};
        this.subs = [];
        if (uri && "object" === typeof uri) {
            opts = uri;
            uri = undefined;
        }
        opts = opts || {};
        opts.path = opts.path || "/socket.io";
        this.opts = opts;
        (0,engine_io_client__WEBPACK_IMPORTED_MODULE_0__.installTimerFunctions)(this, opts);
        this.reconnection(opts.reconnection !== false);
        this.reconnectionAttempts(opts.reconnectionAttempts || Infinity);
        this.reconnectionDelay(opts.reconnectionDelay || 1000);
        this.reconnectionDelayMax(opts.reconnectionDelayMax || 5000);
        this.randomizationFactor((_a = opts.randomizationFactor) !== null && _a !== void 0 ? _a : 0.5);
        this.backoff = new _contrib_backo2_js__WEBPACK_IMPORTED_MODULE_4__.Backoff({
            min: this.reconnectionDelay(),
            max: this.reconnectionDelayMax(),
            jitter: this.randomizationFactor(),
        });
        this.timeout(null == opts.timeout ? 20000 : opts.timeout);
        this._readyState = "closed";
        this.uri = uri;
        const _parser = opts.parser || socket_io_parser__WEBPACK_IMPORTED_MODULE_2__;
        this.encoder = new _parser.Encoder();
        this.decoder = new _parser.Decoder();
        this._autoConnect = opts.autoConnect !== false;
        if (this._autoConnect)
            this.open();
    }
    reconnection(v) {
        if (!arguments.length)
            return this._reconnection;
        this._reconnection = !!v;
        if (!v) {
            this.skipReconnect = true;
        }
        return this;
    }
    reconnectionAttempts(v) {
        if (v === undefined)
            return this._reconnectionAttempts;
        this._reconnectionAttempts = v;
        return this;
    }
    reconnectionDelay(v) {
        var _a;
        if (v === undefined)
            return this._reconnectionDelay;
        this._reconnectionDelay = v;
        (_a = this.backoff) === null || _a === void 0 ? void 0 : _a.setMin(v);
        return this;
    }
    randomizationFactor(v) {
        var _a;
        if (v === undefined)
            return this._randomizationFactor;
        this._randomizationFactor = v;
        (_a = this.backoff) === null || _a === void 0 ? void 0 : _a.setJitter(v);
        return this;
    }
    reconnectionDelayMax(v) {
        var _a;
        if (v === undefined)
            return this._reconnectionDelayMax;
        this._reconnectionDelayMax = v;
        (_a = this.backoff) === null || _a === void 0 ? void 0 : _a.setMax(v);
        return this;
    }
    timeout(v) {
        if (!arguments.length)
            return this._timeout;
        this._timeout = v;
        return this;
    }
    /**
     * Starts trying to reconnect if reconnection is enabled and we have not
     * started reconnecting yet
     *
     * @private
     */
    maybeReconnectOnOpen() {
        // Only try to reconnect if it's the first time we're connecting
        if (!this._reconnecting &&
            this._reconnection &&
            this.backoff.attempts === 0) {
            // keeps reconnection from firing twice for the same reconnection loop
            this.reconnect();
        }
    }
    /**
     * Sets the current transport `socket`.
     *
     * @param {Function} fn - optional, callback
     * @return self
     * @public
     */
    open(fn) {
        if (~this._readyState.indexOf("open"))
            return this;
        this.engine = new engine_io_client__WEBPACK_IMPORTED_MODULE_0__.Socket(this.uri, this.opts);
        const socket = this.engine;
        const self = this;
        this._readyState = "opening";
        this.skipReconnect = false;
        // emit `open`
        const openSubDestroy = (0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(socket, "open", function () {
            self.onopen();
            fn && fn();
        });
        const onError = (err) => {
            this.cleanup();
            this._readyState = "closed";
            this.emitReserved("error", err);
            if (fn) {
                fn(err);
            }
            else {
                // Only do this if there is no fn to handle the error
                this.maybeReconnectOnOpen();
            }
        };
        // emit `error`
        const errorSub = (0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(socket, "error", onError);
        if (false !== this._timeout) {
            const timeout = this._timeout;
            // set timer
            const timer = this.setTimeoutFn(() => {
                openSubDestroy();
                onError(new Error("timeout"));
                socket.close();
            }, timeout);
            if (this.opts.autoUnref) {
                timer.unref();
            }
            this.subs.push(() => {
                this.clearTimeoutFn(timer);
            });
        }
        this.subs.push(openSubDestroy);
        this.subs.push(errorSub);
        return this;
    }
    /**
     * Alias for open()
     *
     * @return self
     * @public
     */
    connect(fn) {
        return this.open(fn);
    }
    /**
     * Called upon transport open.
     *
     * @private
     */
    onopen() {
        // clear old subs
        this.cleanup();
        // mark as open
        this._readyState = "open";
        this.emitReserved("open");
        // add new subs
        const socket = this.engine;
        this.subs.push((0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(socket, "ping", this.onping.bind(this)), (0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(socket, "data", this.ondata.bind(this)), (0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(socket, "error", this.onerror.bind(this)), (0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(socket, "close", this.onclose.bind(this)), 
        // @ts-ignore
        (0,_on_js__WEBPACK_IMPORTED_MODULE_3__.on)(this.decoder, "decoded", this.ondecoded.bind(this)));
    }
    /**
     * Called upon a ping.
     *
     * @private
     */
    onping() {
        this.emitReserved("ping");
    }
    /**
     * Called with data.
     *
     * @private
     */
    ondata(data) {
        try {
            this.decoder.add(data);
        }
        catch (e) {
            this.onclose("parse error", e);
        }
    }
    /**
     * Called when parser fully decodes a packet.
     *
     * @private
     */
    ondecoded(packet) {
        // the nextTick call prevents an exception in a user-provided event listener from triggering a disconnection due to a "parse error"
        (0,engine_io_client__WEBPACK_IMPORTED_MODULE_0__.nextTick)(() => {
            this.emitReserved("packet", packet);
        }, this.setTimeoutFn);
    }
    /**
     * Called upon socket error.
     *
     * @private
     */
    onerror(err) {
        this.emitReserved("error", err);
    }
    /**
     * Creates a new socket for the given `nsp`.
     *
     * @return {Socket}
     * @public
     */
    socket(nsp, opts) {
        let socket = this.nsps[nsp];
        if (!socket) {
            socket = new _socket_js__WEBPACK_IMPORTED_MODULE_1__.Socket(this, nsp, opts);
            this.nsps[nsp] = socket;
        }
        else if (this._autoConnect && !socket.active) {
            socket.connect();
        }
        return socket;
    }
    /**
     * Called upon a socket close.
     *
     * @param socket
     * @private
     */
    _destroy(socket) {
        const nsps = Object.keys(this.nsps);
        for (const nsp of nsps) {
            const socket = this.nsps[nsp];
            if (socket.active) {
                return;
            }
        }
        this._close();
    }
    /**
     * Writes a packet.
     *
     * @param packet
     * @private
     */
    _packet(packet) {
        const encodedPackets = this.encoder.encode(packet);
        for (let i = 0; i < encodedPackets.length; i++) {
            this.engine.write(encodedPackets[i], packet.options);
        }
    }
    /**
     * Clean up transport subscriptions and packet buffer.
     *
     * @private
     */
    cleanup() {
        this.subs.forEach((subDestroy) => subDestroy());
        this.subs.length = 0;
        this.decoder.destroy();
    }
    /**
     * Close the current socket.
     *
     * @private
     */
    _close() {
        this.skipReconnect = true;
        this._reconnecting = false;
        this.onclose("forced close");
    }
    /**
     * Alias for close()
     *
     * @private
     */
    disconnect() {
        return this._close();
    }
    /**
     * Called when:
     *
     * - the low-level engine is closed
     * - the parser encountered a badly formatted packet
     * - all sockets are disconnected
     *
     * @private
     */
    onclose(reason, description) {
        var _a;
        this.cleanup();
        (_a = this.engine) === null || _a === void 0 ? void 0 : _a.close();
        this.backoff.reset();
        this._readyState = "closed";
        this.emitReserved("close", reason, description);
        if (this._reconnection && !this.skipReconnect) {
            this.reconnect();
        }
    }
    /**
     * Attempt a reconnection.
     *
     * @private
     */
    reconnect() {
        if (this._reconnecting || this.skipReconnect)
            return this;
        const self = this;
        if (this.backoff.attempts >= this._reconnectionAttempts) {
            this.backoff.reset();
            this.emitReserved("reconnect_failed");
            this._reconnecting = false;
        }
        else {
            const delay = this.backoff.duration();
            this._reconnecting = true;
            const timer = this.setTimeoutFn(() => {
                if (self.skipReconnect)
                    return;
                this.emitReserved("reconnect_attempt", self.backoff.attempts);
                // check again for the case socket closed in above events
                if (self.skipReconnect)
                    return;
                self.open((err) => {
                    if (err) {
                        self._reconnecting = false;
                        self.reconnect();
                        this.emitReserved("reconnect_error", err);
                    }
                    else {
                        self.onreconnect();
                    }
                });
            }, delay);
            if (this.opts.autoUnref) {
                timer.unref();
            }
            this.subs.push(() => {
                this.clearTimeoutFn(timer);
            });
        }
    }
    /**
     * Called upon successful reconnect.
     *
     * @private
     */
    onreconnect() {
        const attempt = this.backoff.attempts;
        this._reconnecting = false;
        this.backoff.reset();
        this.emitReserved("reconnect", attempt);
    }
}


/***/ }),

/***/ "./node_modules/socket.io-client/build/esm/on.js":
/*!*******************************************************!*\
  !*** ./node_modules/socket.io-client/build/esm/on.js ***!
  \*******************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   on: () => (/* binding */ on)
/* harmony export */ });
function on(obj, ev, fn) {
    obj.on(ev, fn);
    return function subDestroy() {
        obj.off(ev, fn);
    };
}


/***/ }),

/***/ "./node_modules/socket.io-client/build/esm/socket.js":
/*!***********************************************************!*\
  !*** ./node_modules/socket.io-client/build/esm/socket.js ***!
  \***********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Socket: () => (/* binding */ Socket)
/* harmony export */ });
/* harmony import */ var socket_io_parser__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! socket.io-parser */ "./node_modules/socket.io-parser/build/esm-debug/index.js");
/* harmony import */ var _on_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./on.js */ "./node_modules/socket.io-client/build/esm/on.js");
/* harmony import */ var _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @socket.io/component-emitter */ "./node_modules/@socket.io/component-emitter/lib/esm/index.js");



/**
 * Internal events.
 * These events can't be emitted by the user.
 */
const RESERVED_EVENTS = Object.freeze({
    connect: 1,
    connect_error: 1,
    disconnect: 1,
    disconnecting: 1,
    // EventEmitter reserved events: https://nodejs.org/api/events.html#events_event_newlistener
    newListener: 1,
    removeListener: 1,
});
/**
 * A Socket is the fundamental class for interacting with the server.
 *
 * A Socket belongs to a certain Namespace (by default /) and uses an underlying {@link Manager} to communicate.
 *
 * @example
 * const socket = io();
 *
 * socket.on("connect", () => {
 *   console.log("connected");
 * });
 *
 * // send an event to the server
 * socket.emit("foo", "bar");
 *
 * socket.on("foobar", () => {
 *   // an event was received from the server
 * });
 *
 * // upon disconnection
 * socket.on("disconnect", (reason) => {
 *   console.log(`disconnected due to ${reason}`);
 * });
 */
class Socket extends _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_2__.Emitter {
    /**
     * `Socket` constructor.
     */
    constructor(io, nsp, opts) {
        super();
        /**
         * Whether the socket is currently connected to the server.
         *
         * @example
         * const socket = io();
         *
         * socket.on("connect", () => {
         *   console.log(socket.connected); // true
         * });
         *
         * socket.on("disconnect", () => {
         *   console.log(socket.connected); // false
         * });
         */
        this.connected = false;
        /**
         * Whether the connection state was recovered after a temporary disconnection. In that case, any missed packets will
         * be transmitted by the server.
         */
        this.recovered = false;
        /**
         * Buffer for packets received before the CONNECT packet
         */
        this.receiveBuffer = [];
        /**
         * Buffer for packets that will be sent once the socket is connected
         */
        this.sendBuffer = [];
        /**
         * The queue of packets to be sent with retry in case of failure.
         *
         * Packets are sent one by one, each waiting for the server acknowledgement, in order to guarantee the delivery order.
         * @private
         */
        this._queue = [];
        /**
         * A sequence to generate the ID of the {@link QueuedPacket}.
         * @private
         */
        this._queueSeq = 0;
        this.ids = 0;
        /**
         * A map containing acknowledgement handlers.
         *
         * The `withError` attribute is used to differentiate handlers that accept an error as first argument:
         *
         * - `socket.emit("test", (err, value) => { ... })` with `ackTimeout` option
         * - `socket.timeout(5000).emit("test", (err, value) => { ... })`
         * - `const value = await socket.emitWithAck("test")`
         *
         * From those that don't:
         *
         * - `socket.emit("test", (value) => { ... });`
         *
         * In the first case, the handlers will be called with an error when:
         *
         * - the timeout is reached
         * - the socket gets disconnected
         *
         * In the second case, the handlers will be simply discarded upon disconnection, since the client will never receive
         * an acknowledgement from the server.
         *
         * @private
         */
        this.acks = {};
        this.flags = {};
        this.io = io;
        this.nsp = nsp;
        if (opts && opts.auth) {
            this.auth = opts.auth;
        }
        this._opts = Object.assign({}, opts);
        if (this.io._autoConnect)
            this.open();
    }
    /**
     * Whether the socket is currently disconnected
     *
     * @example
     * const socket = io();
     *
     * socket.on("connect", () => {
     *   console.log(socket.disconnected); // false
     * });
     *
     * socket.on("disconnect", () => {
     *   console.log(socket.disconnected); // true
     * });
     */
    get disconnected() {
        return !this.connected;
    }
    /**
     * Subscribe to open, close and packet events
     *
     * @private
     */
    subEvents() {
        if (this.subs)
            return;
        const io = this.io;
        this.subs = [
            (0,_on_js__WEBPACK_IMPORTED_MODULE_1__.on)(io, "open", this.onopen.bind(this)),
            (0,_on_js__WEBPACK_IMPORTED_MODULE_1__.on)(io, "packet", this.onpacket.bind(this)),
            (0,_on_js__WEBPACK_IMPORTED_MODULE_1__.on)(io, "error", this.onerror.bind(this)),
            (0,_on_js__WEBPACK_IMPORTED_MODULE_1__.on)(io, "close", this.onclose.bind(this)),
        ];
    }
    /**
     * Whether the Socket will try to reconnect when its Manager connects or reconnects.
     *
     * @example
     * const socket = io();
     *
     * console.log(socket.active); // true
     *
     * socket.on("disconnect", (reason) => {
     *   if (reason === "io server disconnect") {
     *     // the disconnection was initiated by the server, you need to manually reconnect
     *     console.log(socket.active); // false
     *   }
     *   // else the socket will automatically try to reconnect
     *   console.log(socket.active); // true
     * });
     */
    get active() {
        return !!this.subs;
    }
    /**
     * "Opens" the socket.
     *
     * @example
     * const socket = io({
     *   autoConnect: false
     * });
     *
     * socket.connect();
     */
    connect() {
        if (this.connected)
            return this;
        this.subEvents();
        if (!this.io["_reconnecting"])
            this.io.open(); // ensure open
        if ("open" === this.io._readyState)
            this.onopen();
        return this;
    }
    /**
     * Alias for {@link connect()}.
     */
    open() {
        return this.connect();
    }
    /**
     * Sends a `message` event.
     *
     * This method mimics the WebSocket.send() method.
     *
     * @see https://developer.mozilla.org/en-US/docs/Web/API/WebSocket/send
     *
     * @example
     * socket.send("hello");
     *
     * // this is equivalent to
     * socket.emit("message", "hello");
     *
     * @return self
     */
    send(...args) {
        args.unshift("message");
        this.emit.apply(this, args);
        return this;
    }
    /**
     * Override `emit`.
     * If the event is in `events`, it's emitted normally.
     *
     * @example
     * socket.emit("hello", "world");
     *
     * // all serializable datastructures are supported (no need to call JSON.stringify)
     * socket.emit("hello", 1, "2", { 3: ["4"], 5: Uint8Array.from([6]) });
     *
     * // with an acknowledgement from the server
     * socket.emit("hello", "world", (val) => {
     *   // ...
     * });
     *
     * @return self
     */
    emit(ev, ...args) {
        var _a, _b, _c;
        if (RESERVED_EVENTS.hasOwnProperty(ev)) {
            throw new Error('"' + ev.toString() + '" is a reserved event name');
        }
        args.unshift(ev);
        if (this._opts.retries && !this.flags.fromQueue && !this.flags.volatile) {
            this._addToQueue(args);
            return this;
        }
        const packet = {
            type: socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.EVENT,
            data: args,
        };
        packet.options = {};
        packet.options.compress = this.flags.compress !== false;
        // event ack callback
        if ("function" === typeof args[args.length - 1]) {
            const id = this.ids++;
            const ack = args.pop();
            this._registerAckCallback(id, ack);
            packet.id = id;
        }
        const isTransportWritable = (_b = (_a = this.io.engine) === null || _a === void 0 ? void 0 : _a.transport) === null || _b === void 0 ? void 0 : _b.writable;
        const isConnected = this.connected && !((_c = this.io.engine) === null || _c === void 0 ? void 0 : _c._hasPingExpired());
        const discardPacket = this.flags.volatile && !isTransportWritable;
        if (discardPacket) {
        }
        else if (isConnected) {
            this.notifyOutgoingListeners(packet);
            this.packet(packet);
        }
        else {
            this.sendBuffer.push(packet);
        }
        this.flags = {};
        return this;
    }
    /**
     * @private
     */
    _registerAckCallback(id, ack) {
        var _a;
        const timeout = (_a = this.flags.timeout) !== null && _a !== void 0 ? _a : this._opts.ackTimeout;
        if (timeout === undefined) {
            this.acks[id] = ack;
            return;
        }
        // @ts-ignore
        const timer = this.io.setTimeoutFn(() => {
            delete this.acks[id];
            for (let i = 0; i < this.sendBuffer.length; i++) {
                if (this.sendBuffer[i].id === id) {
                    this.sendBuffer.splice(i, 1);
                }
            }
            ack.call(this, new Error("operation has timed out"));
        }, timeout);
        const fn = (...args) => {
            // @ts-ignore
            this.io.clearTimeoutFn(timer);
            ack.apply(this, args);
        };
        fn.withError = true;
        this.acks[id] = fn;
    }
    /**
     * Emits an event and waits for an acknowledgement
     *
     * @example
     * // without timeout
     * const response = await socket.emitWithAck("hello", "world");
     *
     * // with a specific timeout
     * try {
     *   const response = await socket.timeout(1000).emitWithAck("hello", "world");
     * } catch (err) {
     *   // the server did not acknowledge the event in the given delay
     * }
     *
     * @return a Promise that will be fulfilled when the server acknowledges the event
     */
    emitWithAck(ev, ...args) {
        return new Promise((resolve, reject) => {
            const fn = (arg1, arg2) => {
                return arg1 ? reject(arg1) : resolve(arg2);
            };
            fn.withError = true;
            args.push(fn);
            this.emit(ev, ...args);
        });
    }
    /**
     * Add the packet to the queue.
     * @param args
     * @private
     */
    _addToQueue(args) {
        let ack;
        if (typeof args[args.length - 1] === "function") {
            ack = args.pop();
        }
        const packet = {
            id: this._queueSeq++,
            tryCount: 0,
            pending: false,
            args,
            flags: Object.assign({ fromQueue: true }, this.flags),
        };
        args.push((err, ...responseArgs) => {
            if (packet !== this._queue[0]) {
            }
            const hasError = err !== null;
            if (hasError) {
                if (packet.tryCount > this._opts.retries) {
                    this._queue.shift();
                    if (ack) {
                        ack(err);
                    }
                }
            }
            else {
                this._queue.shift();
                if (ack) {
                    ack(null, ...responseArgs);
                }
            }
            packet.pending = false;
            return this._drainQueue();
        });
        this._queue.push(packet);
        this._drainQueue();
    }
    /**
     * Send the first packet of the queue, and wait for an acknowledgement from the server.
     * @param force - whether to resend a packet that has not been acknowledged yet
     *
     * @private
     */
    _drainQueue(force = false) {
        if (!this.connected || this._queue.length === 0) {
            return;
        }
        const packet = this._queue[0];
        if (packet.pending && !force) {
            return;
        }
        packet.pending = true;
        packet.tryCount++;
        this.flags = packet.flags;
        this.emit.apply(this, packet.args);
    }
    /**
     * Sends a packet.
     *
     * @param packet
     * @private
     */
    packet(packet) {
        packet.nsp = this.nsp;
        this.io._packet(packet);
    }
    /**
     * Called upon engine `open`.
     *
     * @private
     */
    onopen() {
        if (typeof this.auth == "function") {
            this.auth((data) => {
                this._sendConnectPacket(data);
            });
        }
        else {
            this._sendConnectPacket(this.auth);
        }
    }
    /**
     * Sends a CONNECT packet to initiate the Socket.IO session.
     *
     * @param data
     * @private
     */
    _sendConnectPacket(data) {
        this.packet({
            type: socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.CONNECT,
            data: this._pid
                ? Object.assign({ pid: this._pid, offset: this._lastOffset }, data)
                : data,
        });
    }
    /**
     * Called upon engine or manager `error`.
     *
     * @param err
     * @private
     */
    onerror(err) {
        if (!this.connected) {
            this.emitReserved("connect_error", err);
        }
    }
    /**
     * Called upon engine `close`.
     *
     * @param reason
     * @param description
     * @private
     */
    onclose(reason, description) {
        this.connected = false;
        delete this.id;
        this.emitReserved("disconnect", reason, description);
        this._clearAcks();
    }
    /**
     * Clears the acknowledgement handlers upon disconnection, since the client will never receive an acknowledgement from
     * the server.
     *
     * @private
     */
    _clearAcks() {
        Object.keys(this.acks).forEach((id) => {
            const isBuffered = this.sendBuffer.some((packet) => String(packet.id) === id);
            if (!isBuffered) {
                // note: handlers that do not accept an error as first argument are ignored here
                const ack = this.acks[id];
                delete this.acks[id];
                if (ack.withError) {
                    ack.call(this, new Error("socket has been disconnected"));
                }
            }
        });
    }
    /**
     * Called with socket packet.
     *
     * @param packet
     * @private
     */
    onpacket(packet) {
        const sameNamespace = packet.nsp === this.nsp;
        if (!sameNamespace)
            return;
        switch (packet.type) {
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.CONNECT:
                if (packet.data && packet.data.sid) {
                    this.onconnect(packet.data.sid, packet.data.pid);
                }
                else {
                    this.emitReserved("connect_error", new Error("It seems you are trying to reach a Socket.IO server in v2.x with a v3.x client, but they are not compatible (more information here: https://socket.io/docs/v3/migrating-from-2-x-to-3-0/)"));
                }
                break;
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.EVENT:
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.BINARY_EVENT:
                this.onevent(packet);
                break;
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.ACK:
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.BINARY_ACK:
                this.onack(packet);
                break;
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.DISCONNECT:
                this.ondisconnect();
                break;
            case socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.CONNECT_ERROR:
                this.destroy();
                const err = new Error(packet.data.message);
                err.data = packet.data.data;
                this.emitReserved("connect_error", err);
                break;
        }
    }
    /**
     * Called upon a server event.
     *
     * @param packet
     * @private
     */
    onevent(packet) {
        const args = packet.data || [];
        if (null != packet.id) {
            args.push(this.ack(packet.id));
        }
        if (this.connected) {
            this.emitEvent(args);
        }
        else {
            this.receiveBuffer.push(Object.freeze(args));
        }
    }
    emitEvent(args) {
        if (this._anyListeners && this._anyListeners.length) {
            const listeners = this._anyListeners.slice();
            for (const listener of listeners) {
                listener.apply(this, args);
            }
        }
        super.emit.apply(this, args);
        if (this._pid && args.length && typeof args[args.length - 1] === "string") {
            this._lastOffset = args[args.length - 1];
        }
    }
    /**
     * Produces an ack callback to emit with an event.
     *
     * @private
     */
    ack(id) {
        const self = this;
        let sent = false;
        return function (...args) {
            // prevent double callbacks
            if (sent)
                return;
            sent = true;
            self.packet({
                type: socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.ACK,
                id: id,
                data: args,
            });
        };
    }
    /**
     * Called upon a server acknowledgement.
     *
     * @param packet
     * @private
     */
    onack(packet) {
        const ack = this.acks[packet.id];
        if (typeof ack !== "function") {
            return;
        }
        delete this.acks[packet.id];
        // @ts-ignore FIXME ack is incorrectly inferred as 'never'
        if (ack.withError) {
            packet.data.unshift(null);
        }
        // @ts-ignore
        ack.apply(this, packet.data);
    }
    /**
     * Called upon server connect.
     *
     * @private
     */
    onconnect(id, pid) {
        this.id = id;
        this.recovered = pid && this._pid === pid;
        this._pid = pid; // defined only if connection state recovery is enabled
        this.connected = true;
        this.emitBuffered();
        this._drainQueue(true);
        this.emitReserved("connect");
    }
    /**
     * Emit buffered events (received and emitted).
     *
     * @private
     */
    emitBuffered() {
        this.receiveBuffer.forEach((args) => this.emitEvent(args));
        this.receiveBuffer = [];
        this.sendBuffer.forEach((packet) => {
            this.notifyOutgoingListeners(packet);
            this.packet(packet);
        });
        this.sendBuffer = [];
    }
    /**
     * Called upon server disconnect.
     *
     * @private
     */
    ondisconnect() {
        this.destroy();
        this.onclose("io server disconnect");
    }
    /**
     * Called upon forced client/server side disconnections,
     * this method ensures the manager stops tracking us and
     * that reconnections don't get triggered for this.
     *
     * @private
     */
    destroy() {
        if (this.subs) {
            // clean subscriptions to avoid reconnections
            this.subs.forEach((subDestroy) => subDestroy());
            this.subs = undefined;
        }
        this.io["_destroy"](this);
    }
    /**
     * Disconnects the socket manually. In that case, the socket will not try to reconnect.
     *
     * If this is the last active Socket instance of the {@link Manager}, the low-level connection will be closed.
     *
     * @example
     * const socket = io();
     *
     * socket.on("disconnect", (reason) => {
     *   // console.log(reason); prints "io client disconnect"
     * });
     *
     * socket.disconnect();
     *
     * @return self
     */
    disconnect() {
        if (this.connected) {
            this.packet({ type: socket_io_parser__WEBPACK_IMPORTED_MODULE_0__.PacketType.DISCONNECT });
        }
        // remove socket from pool
        this.destroy();
        if (this.connected) {
            // fire events
            this.onclose("io client disconnect");
        }
        return this;
    }
    /**
     * Alias for {@link disconnect()}.
     *
     * @return self
     */
    close() {
        return this.disconnect();
    }
    /**
     * Sets the compress flag.
     *
     * @example
     * socket.compress(false).emit("hello");
     *
     * @param compress - if `true`, compresses the sending data
     * @return self
     */
    compress(compress) {
        this.flags.compress = compress;
        return this;
    }
    /**
     * Sets a modifier for a subsequent event emission that the event message will be dropped when this socket is not
     * ready to send messages.
     *
     * @example
     * socket.volatile.emit("hello"); // the server may or may not receive it
     *
     * @returns self
     */
    get volatile() {
        this.flags.volatile = true;
        return this;
    }
    /**
     * Sets a modifier for a subsequent event emission that the callback will be called with an error when the
     * given number of milliseconds have elapsed without an acknowledgement from the server:
     *
     * @example
     * socket.timeout(5000).emit("my-event", (err) => {
     *   if (err) {
     *     // the server did not acknowledge the event in the given delay
     *   }
     * });
     *
     * @returns self
     */
    timeout(timeout) {
        this.flags.timeout = timeout;
        return this;
    }
    /**
     * Adds a listener that will be fired when any event is emitted. The event name is passed as the first argument to the
     * callback.
     *
     * @example
     * socket.onAny((event, ...args) => {
     *   console.log(`got ${event}`);
     * });
     *
     * @param listener
     */
    onAny(listener) {
        this._anyListeners = this._anyListeners || [];
        this._anyListeners.push(listener);
        return this;
    }
    /**
     * Adds a listener that will be fired when any event is emitted. The event name is passed as the first argument to the
     * callback. The listener is added to the beginning of the listeners array.
     *
     * @example
     * socket.prependAny((event, ...args) => {
     *   console.log(`got event ${event}`);
     * });
     *
     * @param listener
     */
    prependAny(listener) {
        this._anyListeners = this._anyListeners || [];
        this._anyListeners.unshift(listener);
        return this;
    }
    /**
     * Removes the listener that will be fired when any event is emitted.
     *
     * @example
     * const catchAllListener = (event, ...args) => {
     *   console.log(`got event ${event}`);
     * }
     *
     * socket.onAny(catchAllListener);
     *
     * // remove a specific listener
     * socket.offAny(catchAllListener);
     *
     * // or remove all listeners
     * socket.offAny();
     *
     * @param listener
     */
    offAny(listener) {
        if (!this._anyListeners) {
            return this;
        }
        if (listener) {
            const listeners = this._anyListeners;
            for (let i = 0; i < listeners.length; i++) {
                if (listener === listeners[i]) {
                    listeners.splice(i, 1);
                    return this;
                }
            }
        }
        else {
            this._anyListeners = [];
        }
        return this;
    }
    /**
     * Returns an array of listeners that are listening for any event that is specified. This array can be manipulated,
     * e.g. to remove listeners.
     */
    listenersAny() {
        return this._anyListeners || [];
    }
    /**
     * Adds a listener that will be fired when any event is emitted. The event name is passed as the first argument to the
     * callback.
     *
     * Note: acknowledgements sent to the server are not included.
     *
     * @example
     * socket.onAnyOutgoing((event, ...args) => {
     *   console.log(`sent event ${event}`);
     * });
     *
     * @param listener
     */
    onAnyOutgoing(listener) {
        this._anyOutgoingListeners = this._anyOutgoingListeners || [];
        this._anyOutgoingListeners.push(listener);
        return this;
    }
    /**
     * Adds a listener that will be fired when any event is emitted. The event name is passed as the first argument to the
     * callback. The listener is added to the beginning of the listeners array.
     *
     * Note: acknowledgements sent to the server are not included.
     *
     * @example
     * socket.prependAnyOutgoing((event, ...args) => {
     *   console.log(`sent event ${event}`);
     * });
     *
     * @param listener
     */
    prependAnyOutgoing(listener) {
        this._anyOutgoingListeners = this._anyOutgoingListeners || [];
        this._anyOutgoingListeners.unshift(listener);
        return this;
    }
    /**
     * Removes the listener that will be fired when any event is emitted.
     *
     * @example
     * const catchAllListener = (event, ...args) => {
     *   console.log(`sent event ${event}`);
     * }
     *
     * socket.onAnyOutgoing(catchAllListener);
     *
     * // remove a specific listener
     * socket.offAnyOutgoing(catchAllListener);
     *
     * // or remove all listeners
     * socket.offAnyOutgoing();
     *
     * @param [listener] - the catch-all listener (optional)
     */
    offAnyOutgoing(listener) {
        if (!this._anyOutgoingListeners) {
            return this;
        }
        if (listener) {
            const listeners = this._anyOutgoingListeners;
            for (let i = 0; i < listeners.length; i++) {
                if (listener === listeners[i]) {
                    listeners.splice(i, 1);
                    return this;
                }
            }
        }
        else {
            this._anyOutgoingListeners = [];
        }
        return this;
    }
    /**
     * Returns an array of listeners that are listening for any event that is specified. This array can be manipulated,
     * e.g. to remove listeners.
     */
    listenersAnyOutgoing() {
        return this._anyOutgoingListeners || [];
    }
    /**
     * Notify the listeners for each packet sent
     *
     * @param packet
     *
     * @private
     */
    notifyOutgoingListeners(packet) {
        if (this._anyOutgoingListeners && this._anyOutgoingListeners.length) {
            const listeners = this._anyOutgoingListeners.slice();
            for (const listener of listeners) {
                listener.apply(this, packet.data);
            }
        }
    }
}


/***/ }),

/***/ "./node_modules/socket.io-client/build/esm/url.js":
/*!********************************************************!*\
  !*** ./node_modules/socket.io-client/build/esm/url.js ***!
  \********************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   url: () => (/* binding */ url)
/* harmony export */ });
/* harmony import */ var engine_io_client__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! engine.io-client */ "./node_modules/engine.io-client/build/esm/index.js");

/**
 * URL parser.
 *
 * @param uri - url
 * @param path - the request path of the connection
 * @param loc - An object meant to mimic window.location.
 *        Defaults to window.location.
 * @public
 */
function url(uri, path = "", loc) {
    let obj = uri;
    // default to window.location
    loc = loc || (typeof location !== "undefined" && location);
    if (null == uri)
        uri = loc.protocol + "//" + loc.host;
    // relative path support
    if (typeof uri === "string") {
        if ("/" === uri.charAt(0)) {
            if ("/" === uri.charAt(1)) {
                uri = loc.protocol + uri;
            }
            else {
                uri = loc.host + uri;
            }
        }
        if (!/^(https?|wss?):\/\//.test(uri)) {
            if ("undefined" !== typeof loc) {
                uri = loc.protocol + "//" + uri;
            }
            else {
                uri = "https://" + uri;
            }
        }
        // parse
        obj = (0,engine_io_client__WEBPACK_IMPORTED_MODULE_0__.parse)(uri);
    }
    // make sure we treat `localhost:80` and `localhost` equally
    if (!obj.port) {
        if (/^(http|ws)$/.test(obj.protocol)) {
            obj.port = "80";
        }
        else if (/^(http|ws)s$/.test(obj.protocol)) {
            obj.port = "443";
        }
    }
    obj.path = obj.path || "/";
    const ipv6 = obj.host.indexOf(":") !== -1;
    const host = ipv6 ? "[" + obj.host + "]" : obj.host;
    // define unique id
    obj.id = obj.protocol + "://" + host + ":" + obj.port + path;
    // define href
    obj.href =
        obj.protocol +
            "://" +
            host +
            (loc && loc.port === obj.port ? "" : ":" + obj.port);
    return obj;
}


/***/ }),

/***/ "./node_modules/socket.io-parser/build/esm-debug/binary.js":
/*!*****************************************************************!*\
  !*** ./node_modules/socket.io-parser/build/esm-debug/binary.js ***!
  \*****************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   deconstructPacket: () => (/* binding */ deconstructPacket),
/* harmony export */   reconstructPacket: () => (/* binding */ reconstructPacket)
/* harmony export */ });
/* harmony import */ var _is_binary_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./is-binary.js */ "./node_modules/socket.io-parser/build/esm-debug/is-binary.js");

/**
 * Replaces every Buffer | ArrayBuffer | Blob | File in packet with a numbered placeholder.
 *
 * @param {Object} packet - socket.io event packet
 * @return {Object} with deconstructed packet and list of buffers
 * @public
 */
function deconstructPacket(packet) {
    const buffers = [];
    const packetData = packet.data;
    const pack = packet;
    pack.data = _deconstructPacket(packetData, buffers);
    pack.attachments = buffers.length; // number of binary 'attachments'
    return { packet: pack, buffers: buffers };
}
function _deconstructPacket(data, buffers, toJSON) {
    if (!data)
        return data;
    if ((0,_is_binary_js__WEBPACK_IMPORTED_MODULE_0__.isBinary)(data)) {
        const placeholder = { _placeholder: true, num: buffers.length };
        buffers.push(data);
        return placeholder;
    }
    else if (Array.isArray(data)) {
        const newData = new Array(data.length);
        for (let i = 0; i < data.length; i++) {
            newData[i] = _deconstructPacket(data[i], buffers);
        }
        return newData;
    }
    else if (typeof data === "object" && !(data instanceof Date)) {
        if (data.toJSON && typeof data.toJSON === "function" && !toJSON) {
            return _deconstructPacket(data.toJSON(), buffers, true);
        }
        const newData = {};
        for (const key in data) {
            if (Object.prototype.hasOwnProperty.call(data, key)) {
                newData[key] = _deconstructPacket(data[key], buffers);
            }
        }
        return newData;
    }
    return data;
}
/**
 * Reconstructs a binary packet from its placeholder packet and buffers
 *
 * @param {Object} packet - event packet with placeholders
 * @param {Array} buffers - binary buffers to put in placeholder positions
 * @return {Object} reconstructed packet
 * @public
 */
function reconstructPacket(packet, buffers) {
    packet.data = _reconstructPacket(packet.data, buffers);
    delete packet.attachments; // no longer useful
    return packet;
}
function _reconstructPacket(data, buffers) {
    if (!data)
        return data;
    if (data && data._placeholder === true) {
        const isIndexValid = typeof data.num === "number" &&
            data.num >= 0 &&
            data.num < buffers.length;
        if (isIndexValid) {
            return buffers[data.num]; // appropriate buffer (should be natural order anyway)
        }
        else {
            throw new Error("illegal attachments");
        }
    }
    else if (Array.isArray(data)) {
        for (let i = 0; i < data.length; i++) {
            data[i] = _reconstructPacket(data[i], buffers);
        }
    }
    else if (typeof data === "object") {
        for (const key in data) {
            if (Object.prototype.hasOwnProperty.call(data, key)) {
                data[key] = _reconstructPacket(data[key], buffers);
            }
        }
    }
    return data;
}


/***/ }),

/***/ "./node_modules/socket.io-parser/build/esm-debug/index.js":
/*!****************************************************************!*\
  !*** ./node_modules/socket.io-parser/build/esm-debug/index.js ***!
  \****************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   Decoder: () => (/* binding */ Decoder),
/* harmony export */   Encoder: () => (/* binding */ Encoder),
/* harmony export */   PacketType: () => (/* binding */ PacketType),
/* harmony export */   isPacketValid: () => (/* binding */ isPacketValid),
/* harmony export */   protocol: () => (/* binding */ protocol)
/* harmony export */ });
/* harmony import */ var _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @socket.io/component-emitter */ "./node_modules/@socket.io/component-emitter/lib/esm/index.js");
/* harmony import */ var _binary_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./binary.js */ "./node_modules/socket.io-parser/build/esm-debug/binary.js");
/* harmony import */ var _is_binary_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./is-binary.js */ "./node_modules/socket.io-parser/build/esm-debug/is-binary.js");
/* harmony import */ var debug__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! debug */ "./node_modules/debug/src/browser.js");



 // debug()
const debug = debug__WEBPACK_IMPORTED_MODULE_3__("socket.io-parser"); // debug()
/**
 * These strings must not be used as event names, as they have a special meaning.
 */
const RESERVED_EVENTS = [
    "connect", // used on the client side
    "connect_error", // used on the client side
    "disconnect", // used on both sides
    "disconnecting", // used on the server side
    "newListener", // used by the Node.js EventEmitter
    "removeListener", // used by the Node.js EventEmitter
];
/**
 * Protocol version.
 *
 * @public
 */
const protocol = 5;
var PacketType;
(function (PacketType) {
    PacketType[PacketType["CONNECT"] = 0] = "CONNECT";
    PacketType[PacketType["DISCONNECT"] = 1] = "DISCONNECT";
    PacketType[PacketType["EVENT"] = 2] = "EVENT";
    PacketType[PacketType["ACK"] = 3] = "ACK";
    PacketType[PacketType["CONNECT_ERROR"] = 4] = "CONNECT_ERROR";
    PacketType[PacketType["BINARY_EVENT"] = 5] = "BINARY_EVENT";
    PacketType[PacketType["BINARY_ACK"] = 6] = "BINARY_ACK";
})(PacketType || (PacketType = {}));
/**
 * A socket.io Encoder instance
 */
class Encoder {
    /**
     * Encoder constructor
     *
     * @param {function} replacer - custom replacer to pass down to JSON.parse
     */
    constructor(replacer) {
        this.replacer = replacer;
    }
    /**
     * Encode a packet as a single string if non-binary, or as a
     * buffer sequence, depending on packet type.
     *
     * @param {Object} obj - packet object
     */
    encode(obj) {
        debug("encoding packet %j", obj);
        if (obj.type === PacketType.EVENT || obj.type === PacketType.ACK) {
            if ((0,_is_binary_js__WEBPACK_IMPORTED_MODULE_2__.hasBinary)(obj)) {
                return this.encodeAsBinary({
                    type: obj.type === PacketType.EVENT
                        ? PacketType.BINARY_EVENT
                        : PacketType.BINARY_ACK,
                    nsp: obj.nsp,
                    data: obj.data,
                    id: obj.id,
                });
            }
        }
        return [this.encodeAsString(obj)];
    }
    /**
     * Encode packet as string.
     */
    encodeAsString(obj) {
        // first is type
        let str = "" + obj.type;
        // attachments if we have them
        if (obj.type === PacketType.BINARY_EVENT ||
            obj.type === PacketType.BINARY_ACK) {
            str += obj.attachments + "-";
        }
        // if we have a namespace other than `/`
        // we append it followed by a comma `,`
        if (obj.nsp && "/" !== obj.nsp) {
            str += obj.nsp + ",";
        }
        // immediately followed by the id
        if (null != obj.id) {
            str += obj.id;
        }
        // json data
        if (null != obj.data) {
            str += JSON.stringify(obj.data, this.replacer);
        }
        debug("encoded %j as %s", obj, str);
        return str;
    }
    /**
     * Encode packet as 'buffer sequence' by removing blobs, and
     * deconstructing packet into object with placeholders and
     * a list of buffers.
     */
    encodeAsBinary(obj) {
        const deconstruction = (0,_binary_js__WEBPACK_IMPORTED_MODULE_1__.deconstructPacket)(obj);
        const pack = this.encodeAsString(deconstruction.packet);
        const buffers = deconstruction.buffers;
        buffers.unshift(pack); // add packet info to beginning of data list
        return buffers; // write all the buffers
    }
}
/**
 * A socket.io Decoder instance
 *
 * @return {Object} decoder
 */
class Decoder extends _socket_io_component_emitter__WEBPACK_IMPORTED_MODULE_0__.Emitter {
    /**
     * Decoder constructor
     */
    constructor(opts) {
        super();
        this.opts = Object.assign({
            reviver: undefined,
            maxAttachments: 10,
        }, typeof opts === "function" ? { reviver: opts } : opts);
    }
    /**
     * Decodes an encoded packet string into packet JSON.
     *
     * @param {String} obj - encoded packet
     */
    add(obj) {
        let packet;
        if (typeof obj === "string") {
            if (this.reconstructor) {
                throw new Error("got plaintext data when reconstructing a packet");
            }
            packet = this.decodeString(obj);
            const isBinaryEvent = packet.type === PacketType.BINARY_EVENT;
            if (isBinaryEvent || packet.type === PacketType.BINARY_ACK) {
                packet.type = isBinaryEvent ? PacketType.EVENT : PacketType.ACK;
                // binary packet's json
                this.reconstructor = new BinaryReconstructor(packet);
            }
            else {
                // non-binary full packet
                super.emitReserved("decoded", packet);
            }
        }
        else if ((0,_is_binary_js__WEBPACK_IMPORTED_MODULE_2__.isBinary)(obj) || obj.base64) {
            // raw binary data
            if (!this.reconstructor) {
                throw new Error("got binary data when not reconstructing a packet");
            }
            else {
                packet = this.reconstructor.takeBinaryData(obj);
                if (packet) {
                    // received final buffer
                    this.reconstructor = null;
                    super.emitReserved("decoded", packet);
                }
            }
        }
        else {
            throw new Error("Unknown type: " + obj);
        }
    }
    /**
     * Decode a packet String (JSON data)
     *
     * @param {String} str
     * @return {Object} packet
     */
    decodeString(str) {
        let i = 0;
        // look up type
        const p = {
            type: Number(str.charAt(0)),
        };
        if (PacketType[p.type] === undefined) {
            throw new Error("unknown packet type " + p.type);
        }
        // look up attachments if type binary
        if (p.type === PacketType.BINARY_EVENT ||
            p.type === PacketType.BINARY_ACK) {
            const start = i + 1;
            while (str.charAt(++i) !== "-" && i != str.length) { }
            const buf = str.substring(start, i);
            if (buf != Number(buf) || str.charAt(i) !== "-") {
                throw new Error("Illegal attachments");
            }
            const n = Number(buf);
            if (!isInteger(n) || n < 1) {
                throw new Error("Illegal attachments");
            }
            else if (n > this.opts.maxAttachments) {
                throw new Error("too many attachments");
            }
            p.attachments = n;
        }
        // look up namespace (if any)
        if ("/" === str.charAt(i + 1)) {
            const start = i + 1;
            while (++i) {
                const c = str.charAt(i);
                if ("," === c)
                    break;
                if (i === str.length)
                    break;
            }
            p.nsp = str.substring(start, i);
        }
        else {
            p.nsp = "/";
        }
        // look up id
        const next = str.charAt(i + 1);
        if ("" !== next && Number(next) == next) {
            const start = i + 1;
            while (++i) {
                const c = str.charAt(i);
                if (null == c || Number(c) != c) {
                    --i;
                    break;
                }
                if (i === str.length)
                    break;
            }
            p.id = Number(str.substring(start, i + 1));
        }
        // look up json data
        if (str.charAt(++i)) {
            const payload = this.tryParse(str.substr(i));
            if (Decoder.isPayloadValid(p.type, payload)) {
                p.data = payload;
            }
            else {
                throw new Error("invalid payload");
            }
        }
        debug("decoded %s as %j", str, p);
        return p;
    }
    tryParse(str) {
        try {
            return JSON.parse(str, this.opts.reviver);
        }
        catch (e) {
            return false;
        }
    }
    static isPayloadValid(type, payload) {
        switch (type) {
            case PacketType.CONNECT:
                return isObject(payload);
            case PacketType.DISCONNECT:
                return payload === undefined;
            case PacketType.CONNECT_ERROR:
                return typeof payload === "string" || isObject(payload);
            case PacketType.EVENT:
            case PacketType.BINARY_EVENT:
                return (Array.isArray(payload) &&
                    (typeof payload[0] === "number" ||
                        (typeof payload[0] === "string" &&
                            RESERVED_EVENTS.indexOf(payload[0]) === -1)));
            case PacketType.ACK:
            case PacketType.BINARY_ACK:
                return Array.isArray(payload);
        }
    }
    /**
     * Deallocates a parser's resources
     */
    destroy() {
        if (this.reconstructor) {
            this.reconstructor.finishedReconstruction();
            this.reconstructor = null;
        }
    }
}
/**
 * A manager of a binary event's 'buffer sequence'. Should
 * be constructed whenever a packet of type BINARY_EVENT is
 * decoded.
 *
 * @param {Object} packet
 * @return {BinaryReconstructor} initialized reconstructor
 */
class BinaryReconstructor {
    constructor(packet) {
        this.packet = packet;
        this.buffers = [];
        this.reconPack = packet;
    }
    /**
     * Method to be called when binary data received from connection
     * after a BINARY_EVENT packet.
     *
     * @param {Buffer | ArrayBuffer} binData - the raw binary data received
     * @return {null | Object} returns null if more binary data is expected or
     *   a reconstructed packet object if all buffers have been received.
     */
    takeBinaryData(binData) {
        this.buffers.push(binData);
        if (this.buffers.length === this.reconPack.attachments) {
            // done with buffer list
            const packet = (0,_binary_js__WEBPACK_IMPORTED_MODULE_1__.reconstructPacket)(this.reconPack, this.buffers);
            this.finishedReconstruction();
            return packet;
        }
        return null;
    }
    /**
     * Cleans up binary packet reconstruction variables.
     */
    finishedReconstruction() {
        this.reconPack = null;
        this.buffers = [];
    }
}
function isNamespaceValid(nsp) {
    return typeof nsp === "string";
}
// see https://caniuse.com/mdn-javascript_builtins_number_isinteger
const isInteger = Number.isInteger ||
    function (value) {
        return (typeof value === "number" &&
            isFinite(value) &&
            Math.floor(value) === value);
    };
function isAckIdValid(id) {
    return id === undefined || isInteger(id);
}
// see https://stackoverflow.com/questions/8511281/check-if-a-value-is-an-object-in-javascript
function isObject(value) {
    return Object.prototype.toString.call(value) === "[object Object]";
}
function isDataValid(type, payload) {
    switch (type) {
        case PacketType.CONNECT:
            return payload === undefined || isObject(payload);
        case PacketType.DISCONNECT:
            return payload === undefined;
        case PacketType.EVENT:
            return (Array.isArray(payload) &&
                (typeof payload[0] === "number" ||
                    (typeof payload[0] === "string" &&
                        RESERVED_EVENTS.indexOf(payload[0]) === -1)));
        case PacketType.ACK:
            return Array.isArray(payload);
        case PacketType.CONNECT_ERROR:
            return typeof payload === "string" || isObject(payload);
        default:
            return false;
    }
}
function isPacketValid(packet) {
    return (isNamespaceValid(packet.nsp) &&
        isAckIdValid(packet.id) &&
        isDataValid(packet.type, packet.data));
}


/***/ }),

/***/ "./node_modules/socket.io-parser/build/esm-debug/is-binary.js":
/*!********************************************************************!*\
  !*** ./node_modules/socket.io-parser/build/esm-debug/is-binary.js ***!
  \********************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   hasBinary: () => (/* binding */ hasBinary),
/* harmony export */   isBinary: () => (/* binding */ isBinary)
/* harmony export */ });
const withNativeArrayBuffer = typeof ArrayBuffer === "function";
const isView = (obj) => {
    return typeof ArrayBuffer.isView === "function"
        ? ArrayBuffer.isView(obj)
        : obj.buffer instanceof ArrayBuffer;
};
const toString = Object.prototype.toString;
const withNativeBlob = typeof Blob === "function" ||
    (typeof Blob !== "undefined" &&
        toString.call(Blob) === "[object BlobConstructor]");
const withNativeFile = typeof File === "function" ||
    (typeof File !== "undefined" &&
        toString.call(File) === "[object FileConstructor]");
/**
 * Returns true if obj is a Buffer, an ArrayBuffer, a Blob or a File.
 *
 * @private
 */
function isBinary(obj) {
    return ((withNativeArrayBuffer && (obj instanceof ArrayBuffer || isView(obj))) ||
        (withNativeBlob && obj instanceof Blob) ||
        (withNativeFile && obj instanceof File));
}
function hasBinary(obj, toJSON) {
    if (!obj || typeof obj !== "object") {
        return false;
    }
    if (Array.isArray(obj)) {
        for (let i = 0, l = obj.length; i < l; i++) {
            if (hasBinary(obj[i])) {
                return true;
            }
        }
        return false;
    }
    if (isBinary(obj)) {
        return true;
    }
    if (obj.toJSON &&
        typeof obj.toJSON === "function" &&
        arguments.length === 1) {
        return hasBinary(obj.toJSON(), true);
    }
    for (const key in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, key) && hasBinary(obj[key])) {
            return true;
        }
    }
    return false;
}


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
(() => {
"use strict";
/*!************************************!*\
  !*** ./resources/js/chat/index.js ***!
  \************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _controller__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./controller */ "./resources/js/chat/controller.js");
/* harmony import */ var _lightbox__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./lightbox */ "./resources/js/chat/lightbox.js");


document.addEventListener('DOMContentLoaded', function () {
  var root = document.getElementById('chatApp');
  if (root) {
    (0,_controller__WEBPACK_IMPORTED_MODULE_0__.initChat)(root);
    (0,_lightbox__WEBPACK_IMPORTED_MODULE_1__.initLightbox)(root);
  }
});
})();

/******/ })()
;
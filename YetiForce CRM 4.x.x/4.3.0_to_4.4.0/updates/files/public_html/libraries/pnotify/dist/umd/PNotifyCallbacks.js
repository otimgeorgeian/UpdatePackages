var _typeof="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t};!function(t,e){"object"===("undefined"==typeof exports?"undefined":_typeof(exports))&&"undefined"!=typeof module?module.exports=e(require("./PNotify")):"function"==typeof define&&define.amd?define("PNotifyCallbacks",["./PNotify"],e):t.PNotifyCallbacks=e(PNotify)}(this,function(f){"use strict";var o=(f=f&&f.__esModule?f.default:f).prototype.open,r=f.prototype.close,a=function(t,e,n){var o=t?t.get().modules:e.modules,r=o&&o.Callbacks?o.Callbacks:{};return r[n]?r[n]:function(){return!0}};function t(t){var e,n;n=t,(e=this)._handlers=Object.create(null),e._bind=n._bind,e.options=n,e.root=n.root||e,e.store=e.root.store||n.store,this._state=s({},t.data),this._intro=!0,this._fragment=(this._state,{c:i,m:i,p:i,d:i}),t.target&&(this._fragment.c(),this._mount(t.target,t.anchor))}function i(){}function s(t,e){for(var n in e)t[n]=e[n];return t}function e(t){for(;t&&t.length;)t.shift()()}return f.prototype.open=function(){if(!1!==a(this,null,"beforeOpen")(this)){for(var t=arguments.length,e=Array(t),n=0;n<t;n++)e[n]=arguments[n];o.apply(this,e),a(this,null,"afterOpen")(this)}},f.prototype.close=function(t){if(!1!==a(this,null,"beforeClose")(this,t)){for(var e=arguments.length,n=Array(1<e?e-1:0),o=1;o<e;o++)n[o-1]=arguments[o];r.apply(this,[t].concat(n)),a(this,null,"afterClose")(this,t)}},s(t.prototype,{destroy:function(t){this.destroy=i,this.fire("destroy"),this.set=i,this._fragment.d(!1!==t),this._fragment=null,this._state={}},get:function(){return this._state},fire:function(t,e){var n=t in this._handlers&&this._handlers[t].slice();if(!n)return;for(var o=0;o<n.length;o+=1){var r=n[o];r.__calling||(r.__calling=!0,r.call(this,e),r.__calling=!1)}},on:function(t,e){var n=this._handlers[t]||(this._handlers[t]=[]);return n.push(e),{cancel:function(){var t=n.indexOf(e);~t&&n.splice(t,1)}}},set:function(t){if(this._set(s({},t)),this.root._lock)return;this.root._lock=!0,e(this.root._beforecreate),e(this.root._oncreate),e(this.root._aftercreate),this.root._lock=!1},_set:function(t){var e=this._state,n={},o=!1;for(var r in t)this._differs(t[r],e[r])&&(n[r]=o=!0);if(!o)return;this._state=s(s({},e),t),this._recompute(n,this._state),this._bind&&this._bind(n,this._state);this._fragment&&(this.fire("state",{changed:n,current:this._state,previous:e}),this._fragment.p(n,this._state),this.fire("update",{changed:n,current:this._state,previous:e}))},_mount:function(t,e){this._fragment[this._fragment.i?"i":"m"](t,e||null)},_differs:function(t,e){return t!=t?e==e:t!==e||t&&"object"===(void 0===t?"undefined":_typeof(t))||"function"==typeof t}}),t.prototype._recompute=i,function(t){t.key="Callbacks",t.getCallbacks=a;var e=f.alert,n=f.notice,o=f.info,r=f.success,i=f.error,s=function(t,e){a(null,e,"beforeInit")(e);var n=t(e);return a(n,null,"afterInit")(n),n};f.alert=function(t){return s(e,t)},f.notice=function(t){return s(n,t)},f.info=function(t){return s(o,t)},f.success=function(t){return s(r,t)},f.error=function(t){return s(i,t)},f.modules.Callbacks=t}(t),t});
//# sourceMappingURL=PNotifyCallbacks.js.map
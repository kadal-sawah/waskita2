!function(e,t){"function"==typeof define&&define.amd?define([],t):"object"==typeof exports?module.exports=t():e.React.tagify=t()}(this,function(){"use strict";function i(e){return(i="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}Object.defineProperty(exports,"__esModule",{value:!0}),exports.default=void 0;var e,T=function(e){if(e&&e.__esModule)return e;if(null===e||"object"!==i(e)&&"function"!=typeof e)return{default:e};var t=a();if(t&&t.has(e))return t.get(e);var r={},n=Object.defineProperty&&Object.getOwnPropertyDescriptor;for(var o in e)if(Object.prototype.hasOwnProperty.call(e,o)){var u=n?Object.getOwnPropertyDescriptor(e,o):null;u&&(u.get||u.set)?Object.defineProperty(r,o,u):r[o]=e[o]}r.default=e,t&&t.set(e,r);return r}(require("react")),F=require("react-dom/server"),t=require("prop-types"),N=(e=require("./tagify.min.js"))&&e.__esModule?e:{default:e};function a(){if("function"!=typeof WeakMap)return null;var e=new WeakMap;return a=function(){return e},e}function P(e){return function(e){if(Array.isArray(e)){for(var t=0,r=new Array(e.length);t<e.length;t++)r[t]=e[t];return r}}(e)||function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}require("./tagify.css");function r(e){function t(e){E.current=e}var r=e.name,n=e.value,o=void 0===n?"":n,u=e.loading,i=void 0!==u&&u,a=e.onChange,c=void 0===a?function(e){return e}:a,f=e.readOnly,l=e.settings,s=void 0===l?{}:l,d=e.InputMode,p=void 0===d?"input":d,y=e.autoFocus,g=e.className,m=e.whitelist,v=e.tagifyRef,b=e.placeholder,h=void 0===b?"":b,w=e.defaultValue,O=e.showFilteredDropdown,j=(0,T.useRef)(),E=(0,T.useRef)(),S=(0,T.useRef)(),M=(0,T.useMemo)(function(){return{ref:t,name:r,value:"string"==typeof o?o:JSON.stringify(o),className:g,readOnly:f,onChange:c,autoFocus:y,placeholder:h,defaultValue:w}},[w,h,y,g,c,f,o,r]);return(0,T.useEffect)(function(){return function(e){if(e)for(var r in e){String(e[r]).includes(".createElement")&&function(){var t=e[r];e[r]=function(e){return(0,F.renderToStaticMarkup)(T.default.createElement(t,e))}}()}}(s.templates),S.current=new N.default(E.current,s),v&&(v.current=S.current),function(){S.current.destroy()}},[]),(0,T.useEffect)(function(){j.current&&S.current.loadOriginalValues(o)},[o]),(0,T.useEffect)(function(){var e;j.current&&(e=S.current.settings.whitelist).splice.apply(e,[0,S.current.settings.whitelist.length].concat(P(m||[])))},[m]),(0,T.useEffect)(function(){j.current&&S.current.loading(i)},[i]),(0,T.useEffect)(function(){var e=S.current;j.current&&(O?(e.dropdown.show.call(e,O),e.toggleFocusClass(!0)):e.dropdown.hide.call(e))},[O]),(0,T.useEffect)(function(){j.current=!0},[]),T.default.createElement("div",{className:"tags-input"},T.default.createElement(p,M))}r.propTypes={name:t.string,value:(0,t.oneOfType)([t.string,t.array]),loading:t.bool,onChange:t.func,readOnly:t.bool,settings:t.object,InputMode:t.string,autoFocus:t.bool,className:t.string,tagifyRef:t.object,whitelist:t.array,placeholder:t.string,defaultValue:(0,t.oneOfType)([t.string,t.array]),showFilteredDropdown:(0,t.oneOfType)([t.string,t.bool])};var n=T.default.memo(r);n.displayName="Tags";var o=n;return exports.default=o,n});
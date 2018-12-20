/*
 * Cookies.js - 1.2.3
 * https://github.com/ScottHamper/Cookies
 *
 * This is free and unencumbered software released into the public domain.
 */
(function (global, undefined) {
    'use strict';

    var factory = function (window) {
        if (typeof window.document !== 'object') {
            throw new Error('Cookies.js requires a `window` with a `document` object');
        }

        var Cookies = function (key, value, options) {
            return arguments.length === 1 ?
                Cookies.get(key) : Cookies.set(key, value, options);
        };

        // Allows for setter injection in unit tests
        Cookies._document = window.document;

        // Used to ensure cookie keys do not collide with
        // built-in `Object` properties
        Cookies._cacheKeyPrefix = 'cookey.'; // Hurr hurr, :)
        
        Cookies._maxExpireDate = new Date('Fri, 31 Dec 9999 23:59:59 UTC');

        Cookies.defaults = {
            path: '/',
            secure: false
        };

        Cookies.get = function (key) {
            if (Cookies._cachedDocumentCookie !== Cookies._document.cookie) {
                Cookies._renewCache();
            }
            
            var value = Cookies._cache[Cookies._cacheKeyPrefix + key];

            return value === undefined ? undefined : decodeURIComponent(value);
        };

        Cookies.set = function (key, value, options) {
            options = Cookies._getExtendedOptions(options);
            options.expires = Cookies._getExpiresDate(value === undefined ? -1 : options.expires);

            Cookies._document.cookie = Cookies._generateCookieString(key, value, options);

            return Cookies;
        };

        Cookies.expire = function (key, options) {
            return Cookies.set(key, undefined, options);
        };

        Cookies._getExtendedOptions = function (options) {
            return {
                path: options && options.path || Cookies.defaults.path,
                domain: options && options.domain || Cookies.defaults.domain,
                expires: options && options.expires || Cookies.defaults.expires,
                secure: options && options.secure !== undefined ?  options.secure : Cookies.defaults.secure
            };
        };

        Cookies._isValidDate = function (date) {
            return Object.prototype.toString.call(date) === '[object Date]' && !isNaN(date.getTime());
        };

        Cookies._getExpiresDate = function (expires, now) {
            now = now || new Date();

            if (typeof expires === 'number') {
                expires = expires === Infinity ?
                    Cookies._maxExpireDate : new Date(now.getTime() + expires * 1000);
            } else if (typeof expires === 'string') {
                expires = new Date(expires);
            }

            if (expires && !Cookies._isValidDate(expires)) {
                throw new Error('`expires` parameter cannot be converted to a valid Date instance');
            }

            return expires;
        };

        Cookies._generateCookieString = function (key, value, options) {
            key = key.replace(/[^#$&+\^`|]/g, encodeURIComponent);
            key = key.replace(/\(/g, '%28').replace(/\)/g, '%29');
            value = (value + '').replace(/[^!#$&-+\--:<-\[\]-~]/g, encodeURIComponent);
            options = options || {};

            var cookieString = key + '=' + value;
            cookieString += options.path ? ';path=' + options.path : '';
            cookieString += options.domain ? ';domain=' + options.domain : '';
            cookieString += options.expires ? ';expires=' + options.expires.toUTCString() : '';
            cookieString += options.secure ? ';secure' : '';

            return cookieString;
        };

        Cookies._getCacheFromString = function (documentCookie) {
            var cookieCache = {};
            var cookiesArray = documentCookie ? documentCookie.split('; ') : [];

            for (var i = 0; i < cookiesArray.length; i++) {
                var cookieKvp = Cookies._getKeyValuePairFromCookieString(cookiesArray[i]);

                if (cookieCache[Cookies._cacheKeyPrefix + cookieKvp.key] === undefined) {
                    cookieCache[Cookies._cacheKeyPrefix + cookieKvp.key] = cookieKvp.value;
                }
            }

            return cookieCache;
        };

        Cookies._getKeyValuePairFromCookieString = function (cookieString) {
            // "=" is a valid character in a cookie value according to RFC6265, so cannot `split('=')`
            var separatorIndex = cookieString.indexOf('=');

            // IE omits the "=" when the cookie value is an empty string
            separatorIndex = separatorIndex < 0 ? cookieString.length : separatorIndex;

            var key = cookieString.substr(0, separatorIndex);
            var decodedKey;
            try {
                decodedKey = decodeURIComponent(key);
            } catch (e) {
                if (console && typeof console.error === 'function') {
                    console.error('Could not decode cookie with key "' + key + '"', e);
                }
            }
            
            return {
                key: decodedKey,
                value: cookieString.substr(separatorIndex + 1) // Defer decoding value until accessed
            };
        };

        Cookies._renewCache = function () {
            Cookies._cache = Cookies._getCacheFromString(Cookies._document.cookie);
            Cookies._cachedDocumentCookie = Cookies._document.cookie;
        };

        Cookies._areEnabled = function () {
            var testKey = 'cookies.js';
            var areEnabled = Cookies.set(testKey, 1).get(testKey) === '1';
            Cookies.expire(testKey);
            return areEnabled;
        };

        Cookies.enabled = Cookies._areEnabled();

        return Cookies;
    };
    var cookiesExport = (global && typeof global.document === 'object') ? factory(global) : factory;

    // AMD support
    if (typeof define === 'function' && define.amd) {
        define(function () { return cookiesExport; });
    // CommonJS/Node.js support
    } else if (typeof exports === 'object') {
        // Support Node.js specific `module.exports` (which can be a function)
        if (typeof module === 'object' && typeof module.exports === 'object') {
            exports = module.exports = cookiesExport;
        }
        // But always support CommonJS module 1.1.1 spec (`exports` cannot be a function)
        exports.Cookies = cookiesExport;
    } else {
        global.Cookies = cookiesExport;
    }
})(typeof window === 'undefined' ? this : window);
	/*
	
	Methods
	Cookies.set(key, value [, options])
	Alias: Cookies(key, value [, options])

	Sets a cookie in the document. If the cookie does not already exist, it will be created. Returns the Cookies object.

	Option	Description	Default
	path	A string value of the path of the cookie	"/"
	domain	A string value of the domain of the cookie	undefined
	expires	A number (of seconds), a date parsable string, or a Date object of when the cookie will expire	undefined
	secure	A boolean value of whether or not the cookie should only be available over SSL	false
	A default value for any option may be set in the Cookies.defaults object.

	Example Usage

	// Setting a cookie value
	Cookies.set('key', 'value');

	// Chaining sets together
	Cookies.set('key', 'value').set('hello', 'world');

	// Setting cookies with additional options
	Cookies.set('key', 'value', { domain: 'www.example.com', secure: true });

	// Setting cookies with expiration values
	Cookies.set('key', 'value', { expires: 600 }); // Expires in 10 minutes
	Cookies.set('key', 'value', { expires: '01/01/2012' });
	Cookies.set('key', 'value', { expires: new Date(2012, 0, 1) });
	Cookies.set('key', 'value', { expires: Infinity });

	// Using the alias
	Cookies('key', 'value', { secure: true });
	Cookies.get(key)
	Alias: Cookies(key)

	Returns the value of the most locally scoped cookie with the specified key.

	Example Usage

	// First set a cookie
	Cookies.set('key', 'value');

	// Get the cookie value
	Cookies.get('key'); // "value"

	// Using the alias
	Cookies('key'); // "value"
	Cookies.expire(key [, options])
	Alias: Cookies(key, undefined [, options])

	Expires a cookie, removing it from the document. Returns the Cookies object.

	Option	Description	Default
	path	A string value of the path of the cookie	"/"
	domain	A string value of the domain of the cookie	undefined
	A default value for any option may be set in the Cookies.defaults object.

	Example Usage

	// First set a cookie and get its value
	Cookies.set('key', 'value').get('key'); // "value"

	// Expire the cookie and try to get its value
	Cookies.expire('key').get('key'); // undefined

	// Using the alias
	Cookies('key', undefined);
	Properties
	Cookies.enabled
	A boolean value of whether or not the browser has cookies enabled.

	Example Usage

	if (Cookies.enabled) {
		Cookies.set('key', 'value');
	}
	Cookies.defaults
	An object representing default options to be used when setting and expiring cookie values.

	Option	Description	Default
	path	A string value of the path of the cookie	"/"
	domain	A string value of the domain of the cookie	undefined
	expires	A number (of seconds), a date parsable string, or a Date object of when the cookie will expire	undefined
	secure	A boolean value of whether or not the cookie should only be available over SSL	false
	Example Usage

	Cookies.defaults = {
		path: '/',
		secure: true
	};

	Cookies.set('key', 'value'); // Will be secure and have a path of '/'
	Cookies.expire('key'); // Will expire the cookie with a path of '/'

	*/
					function setCookie(name,value,days) {
						var expires = "";
						if (days) {
							var date = new Date();
							date.setTime(date.getTime() + (days*24*60*60*1000));
							expires = "; expires=" + date.toUTCString();
						}
						document.cookie = name + "=" + (value || "")  + expires + "; path=/";
					}
					function getCookie(name) {
						var nameEQ = name + "=";
						var decodedCookie = decodeURIComponent(document.cookie);
						var ca =decodedCookie.split(';'); ;//document.cookie.split(';');
						for(var i=0;i < ca.length;i++) {
							var c = ca[i];
							while (c.charAt(0)==' ') c = c.substring(1,c.length);
							if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
						}
						return null;
					}
					function eraseCookie(name) {   
						document.cookie = name+'=; Max-Age=-99999999;';  
					}

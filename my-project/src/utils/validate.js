
/* 是否手机号*/
function trim(_string){
	_string=""+_string+"";
	return _string.replace(/(^\s*)|(\s*$)/g, "");
}
export function isMobilePhone(str) {
    const reg = /^1[34578]\d{9}$/i;
    return reg.test(trim(str));
}

/* 是否是邮箱*/
export function isEmail(str) {
  const reg = /^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$/i;
  return reg.test(trim(str));
}

/* 合法uri*/
export function validateURL(textval) {
  const urlregex = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
  return urlregex.test(textval);
}

/* 小写字母*/
export function validateLowerCase(str) {
  const reg = /^[a-z]+$/;
  return reg.test(str);
}

/* 大写字母*/
export function validateUpperCase(str) {
  const reg = /^[A-Z]+$/;
  return reg.test(str);
}

/* 大小写字母*/
export function validatAlphabets(str) {
  const reg = /^[A-Za-z]+$/;
  return reg.test(str);
}

/**
 * 排序
 */
export function orderBy(arr) {
    var comparator = null;
    var sortKeys = undefined;
    arr = convertArray(arr);

    // determine order (last argument)
    var args = toArray(arguments, 1);
    var order = args[args.length - 1];
    if (typeof order === 'number') {
        order = order < 0 ? -1 : 1;
        args = args.length > 1 ? args.slice(0, -1) : args;
    } else {
        order = 1;
    }

    // determine sortKeys & comparator
    var firstArg = args[0];
    if (!firstArg) {
        return arr;
    } else if (typeof firstArg === 'function') {
        // custom comparator
        comparator = function(a, b) {
            return firstArg(a, b) * order;
        };
    } else {
        // string keys. flatten first
        sortKeys = Array.prototype.concat.apply([], args);
        comparator = function(a, b, i) {
            i = i || 0;
            return i >= sortKeys.length - 1 ? baseCompare(a, b, i) : baseCompare(a, b, i) || comparator(a, b, i + 1);
        };
    }

    function baseCompare(a, b, sortKeyIndex) {
        var sortKey = sortKeys[sortKeyIndex];
        if (sortKey) {
            if (sortKey !== '$key') {
                if (isObject(a) && '$value' in a) a = a.$value;
                if (isObject(b) && '$value' in b) b = b.$value;
            }
            a = isObject(a) ? getPath(a, sortKey) : a;
            b = isObject(b) ? getPath(b, sortKey) : b;
        }
        return a === b ? 0 : a > b ? order : -order;
    }

    // sort on a copy to avoid mutating original array
    return arr.slice().sort(comparator);
};

'use strict';

import { isPrimitive as isNumber } from '@stdlib/assert-is-number';
import isObject from '@stdlib/assert-is-plain-object';
import isnan from '@stdlib/assert-is-nan';
import indexOf from '@stdlib/utils-index-of';
import hasOwnProp from '@stdlib/assert-has-own-property';
import format from '@stdlib/string-format';

var alternative = [ 'two-sided', 'less', 'greater' ];


function validate( opts, options ) {
	if ( !isObject( options ) ) {
		return new TypeError( format( 'invalid argument. Options argument must be an object. Value: `%s`.', options ) );
	}
	if ( hasOwnProp( options, 'alpha' ) ) {
		opts.alpha = options.alpha;
		if (
			!isNumber( opts.alpha ) ||
			isnan( opts.alpha ) ||
			opts.alpha < 0.0 ||
			opts.alpha > 1.0
		) {
			return new TypeError( format( 'invalid option. `%s` option must be a number on the interval: [0, 1]. Option: `%s`.', 'alpha', opts.alpha ) );
		}
	}
	if ( hasOwnProp( options, 'alternative' ) ) {
		opts.alternative = options.alternative;
		if ( indexOf( alternative, opts.alternative ) === -1 ) {
			return new TypeError( format( 'invalid option. `%s` option must be one of the following: "%s". Option: `%s`.', 'alternative', alternative.join( '", "' ), opts.alternative ) );
		}
	}
	if ( hasOwnProp( options, 'rho' ) ) {
		opts.rho = options.rho;
		if (
			!isNumber( opts.rho ) ||
			isnan( opts.rho ) ||
			opts.rho < -1.0 ||
			opts.rho > 1.0
		) {
			return new TypeError( format( 'invalid option. `%s` option must be a number on the interval: [-1, 1]. Option: `%s`.', 'rho', opts.rho ) );
		}
	}
	return null;
}


// EXPORTS //

export default validate;

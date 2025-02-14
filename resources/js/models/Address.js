import { Model } from '@weapnl/js-junction';
import City from './City.js';

export default class Address extends Model {
    // All the model properties which are fully readable and fillable on the API
    static attributes() {
        return {
            // Note: id is ALWAYS required
            id: {
                // Default value to be assigned when creating the empty property.
                default: null,

                // Will be used to cast from/to json. Has higher priority than the seperate 'fromJson' and 'toJson' methods.
                type: Number, // Type will be used to cast from and to json

                // Casts that will be performed when creating the model from json.
                // Allows:
                // - Functions
                // - Array of functions, executed from left to right and each following function gets the return value of the previous.
                // - Javascript types
                // - Models that inherit from the Model class.
                fromJson: _.toNumber,
                toJson: [_.toString, _.trim],

                // The key which is used when parsing the attribute from/to json. By default the snake_case version of the attribute name will be used.
                jsonKey: 'id',
            },

            // All options are optional and if no options are given an empty object should be passed.
            name: {
                default: '',
                type: String,
            },
            street: {
                default: '',
                type: String,
            },
            postalCode: {
                default: '',
                type: String,
            },
            cityId: {
                default: null,
                type: Number,
            },
        };
    }

    // Relations of the model which are defined in the API
    static relations() {
        return {
            city: {
                // Value(s) of the relation will be cast to the type. Same casts are allowed as the attributes.
                // If a list of items is returned, the cast will be preformed on each item seperately.
                type: City,
            },
        };
    }

    // Used to know what URL to send the request to.
    static get endpoint() {
        return 'addresses';
    }
}

const path = require('path');

module.exports = {
    entry: {
        admin: './resources/js/admin.js'
    },

    output: {
        path: path.resolve(__dirname, 'assets/js')
    }
};

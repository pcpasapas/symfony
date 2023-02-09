/* eslint-disable no-undef */
module.exports = {
    "env": {
        "browser": true,
        "es2021": true,
        "node" : true
    },
    "extends": [
        "eslint:recommended",
        "plugin:vue/vue3-essential"
    ],
    "overrides": [
    ],
    "parserOptions": {
        "ecmaVersion": "latest",
        "sourceType": "module",
        "parser": '@babel/eslint-parser',
        "requireConfigFile": false,
    },
    "plugins": [
        "vue"
    ],
    "rules": {
    }
}


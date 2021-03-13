module.exports = {
    'env': {
        'browser': true
    },
    'extends': [
        'plugin:vue/recommended',
        'eslint:recommended',
    ],
    'parserOptions': {
        'ecmaVersion': 8
    },
    'rules': {
        'vue/no-v-html':'off',
        'vue/html-indent': [
            'error',
            4,
            {'baseIndent': 1}
        ],
        'vue/max-attributes-per-line': ['error', {
            'singleline': 2,
            'multiline': {
                'max': 1,
                'allowFirstLine': false
            }
        }],
        'indent': [
            'error',
            4
        ],
        'linebreak-style': [
            'error',
            'unix'
        ],
        'quotes': [
            'error',
            'single'
        ],
        'semi': [
            'error',
            'always'
        ]
    }
};

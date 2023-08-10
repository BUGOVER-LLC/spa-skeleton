/** @format */

import { mdiEyeOffOutline, mdiEyeOutline, mdiFacebook, mdiGithub, mdiGoogle, mdiTwitter } from '@mdi/js';
import { ValidationObserver, ValidationProvider, extend, validate } from 'vee-validate';
import { email, max, min, required } from 'vee-validate/dist/rules';

import httpAxios from '@/services/httpAxios.js';

extend('email', email);
extend('min', min);
extend('max', max);
extend('required', required);

export default {
    name: 'LoginModule',

    components: {
        ValidationProvider,
        ValidationObserver,
    },

    metaInfo() {
        return {
            title: this.$t('auth.login'),
        };
    },

    data() {
        return {
            isPasswordVisible: false,
            socialLink: [
                {
                    icon: mdiFacebook,
                    color: '#4267b2',
                    colorInDark: '#4267b2',
                },
                {
                    icon: mdiTwitter,
                    color: '#1da1f2',
                    colorInDark: '#1da1f2',
                },
                {
                    icon: mdiGithub,
                    color: '#272727',
                    colorInDark: '#fff',
                },
                {
                    icon: mdiGoogle,
                    color: '#db4437',
                    colorInDark: '#db4437',
                },
            ],
            icons: {
                mdiEyeOutline,
                mdiEyeOffOutline,
            },
            loginData: {
                email: '',
                password: '',
                remember: false,
            },
            errors: {
                email: false,
                password: false,
            },
            loginRules: {
                email: 'min:6|email|required|max:150',
                password: 'min:3|max:64|required',
            },
        };
    },

    methods: {
        login() {
            validate().then(result => {
                console.log(result);
                if (result && result.valid) {
                    const self = this;

                    Object.keys(this.errors).forEach(key => {
                        self.errors[key] = false;
                    });

                    httpAxios({
                        url: `${this.$backendUrl}login`,
                        method: 'POST',
                        data: self.loginData,
                    }).then(response => {
                        self.$store.commit('LOGGED_USER', response.data);
                        self.$router.push({ name: 'adminDashboard' });
                    });
                }
            });
        },
    },
};
